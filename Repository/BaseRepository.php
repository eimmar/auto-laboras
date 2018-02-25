<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 22.18
 */

namespace Repository;


use Model\Entity;
use PDOException;
use Utils\Mysql;

abstract class BaseRepository
{
    const JOIN_DELIMITER = '___';

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var array
     */
    protected $joinFields = [];

    /**
     * @var Entity;
     */
    protected $entity;


    public function __construct()
    {
        $namespace = explode('\\', get_class($this));
        $entityName = str_replace('Repository', '', end($namespace));
        $fullEntity = '\Model\\' . $entityName;
        $this->entity = new $fullEntity();
        $this->tableName = strtolower($entityName) . 's';

        $this->setUpFields();
    }

    protected abstract function setUpFields(): void;

    /**
     * @return array
     */
    protected function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array|null
     */
    protected function getJoinFields() : ?array
    {
        return $this->joinFields;
    }

    /**
     * @return Entity
     */
    protected function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return string
     */
    protected function getModelSql()
    {
        $selectCols = '';
        $joins = '';

        foreach ($this->getFields() as $field) {
            $selectCols .= $this->getTableName() . '.' . $field . ', ';
        }

        /**
         * @var string $field
         * @var BaseRepository $repository
         */
        foreach ($this->getJoinFields() as $joinField => $repository) {

            foreach ($repository->getFields() as $field) {
                $selectCols .= $repository->getTableName() . '.' . $field . ' AS ' .
                    self::JOIN_DELIMITER . $repository->getTableName() . self::JOIN_DELIMITER . $field . ', ';
            }

            $joins .= ' LEFT JOIN ' . $repository->getTableName() .
                ' ON ' . $this->getTableName() . '.' . $joinField .' = ' . $repository->getTableName() . '.id ';
        }

        return 'SELECT ' . trim($selectCols, ', ') . ' FROM ' . DB_NAME . '.' . $this->getTableName() . $joins . ' ';
    }

    /**
     * @param array $data
     * @param mixed $entity
     * @return mixed
     */
    protected function hydrateObject(array $data, Entity $entity)
    {
        $joinedData = array_filter(
            $data,
            function ($key) {
                return preg_match('@' . self::JOIN_DELIMITER . '@', $key);
            },
            ARRAY_FILTER_USE_KEY
        );

        $data = array_filter(
            $data,
            function ($key) {
                return !preg_match('@' . self::JOIN_DELIMITER . '@', $key);
            },
            ARRAY_FILTER_USE_KEY
        );

        foreach ($data as $key => $value) {
            $this->hydrateField($key, $value, $entity);
        }

        /**
         * @var string $joinField
         * @var BaseRepository $repository
         */
        foreach ($this->getJoinFields() as $joinField => $repository) {
            $childEntity = clone $repository->getEntity();
            $joinField = str_replace('_id', '', $joinField);

            foreach ($joinedData as $key => $value) {
                if (preg_match('@' . self::JOIN_DELIMITER . $joinField .'@', $key)) {

                    $realKey = explode('___', $key);
                    $realKey = end($realKey);
                    $this->hydrateField($realKey, $value, $childEntity);
                }
            }

            $this->hydrateField($joinField, $childEntity, $entity);
        }


        return $entity;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param Entity $entity
     */
    private function hydrateField($key, $value, $entity)
    {
        $setter = 'set' . str_replace('_', '', ucfirst($key));
        $value = preg_match('@date@', $key) ? new \DateTime($value) : $value;
        call_user_func_array([$entity, $setter], [$value]);
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param int $id
     * @return Entity|bool
     */
    public function getModel(int $id)
    {
        $query = $this->getModelSql() . 'WHERE ' . $this->getTableName() . '.id = ?';

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if (count($data) == 0) {
            return false;
        }

        $model = get_class($this->entity);
        return $this->hydrateObject($data, new $model());
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Entity[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        $query      = $this->getModelSql();
        $parameters = [];

        if (isset($limit)) {
            $query .= " LIMIT ?";
            $parameters[] = $limit;
        }

        if (isset($offset)) {
            $query .= " OFFSET ?";
            $parameters[] = $offset;
        }

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute($parameters);
        $data = $stmt->fetchAll();

        $entityList = [];
        $model = get_class($this->entity);

        foreach ($data as $row) {
            $entityList[] = $this->hydrateObject($row, new $model());
        }

        return $entityList;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function executeRawSql(string $sql, array $params) : array
    {
        $stmt = Mysql::getInstance()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Markių kiekio radimas
     * @return int
     */
    public function getListCount(): int
    {
        $query = 'SELECT COUNT(id) as amount FROM ' . $this->tableName;
        $stmt = Mysql::getInstance()->query($query);
        $data = $stmt->fetch();

        return $data['amount'];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insertEntity($data) : bool
    {
        $cols = '';
        $vals =  '';

        foreach (array_keys($data) as $colName) {
            $cols .= $colName . ', ';
            $vals .= sprintf(':%s, ', $colName);
        }

        $query = sprintf(
            'INSERT INTO %s (%s) VALUES (%s);',
            $this->tableName,
            trim($cols, ', '),
            trim($vals, ', ')
        );

        try {
            $stmt = Mysql::getInstance()->prepare($query);
            $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    /**
     * @param array $data
     * @return Entity
     */
    public function createEntity($data = []) : Entity
    {
        $entity = clone $this->getEntity();

        foreach ($data as $key => $value) {
            $setData = 'set' . ucfirst($key);
            $entity->$setData($value);
        }

        return $entity;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateEntity($id, $data) : bool
    {
        $query = sprintf('UPDATE %s SET ', $this->tableName);
        foreach (array_keys($data) as $colName) {

            $query .= sprintf(' %s = :%s , ', $colName, $colName);
        }
        $query = trim($query, ', ') . ' WHERE id = :id';

        $data['id'] = $id;

        $stmt = Mysql::getInstance()->prepare($query);
        try {
            $stmt->execute($data);
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
        $query = sprintf('DELETE FROM %s WHERE `id` = ?', $this->tableName);
        $stmt = Mysql::getInstance()->prepare($query);

        try {
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }
}
