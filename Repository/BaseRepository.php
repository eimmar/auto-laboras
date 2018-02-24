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
     * Markių kiekio radimas
     * @return int
     */
    public function getListCount(): int
    {
        $query = 'SELECT COUNT(id) as amount FROM ' . $this->tableName;
        $stmt = Mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();

        return $data[0]['amount'];
    }

    /**
     * @param array $data
     */
    public function insertEntity($data)
    {
        $query = 'INSERT INTO ' . $this->tableName . ' (' . implode(',', $this->getFieldsToInsert())
            . ') VALUES' . $this->getFieldsPlaceHolder();

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute([$data['id'], $data['pavadinimas']]);
    }

    /**
     * @param array $data
     */
    public function updateEntity($data)
    {
        $query = 'UPDATE ' . $this->tableName . ' SET `pavadinimas` = ? WHERE id = ?';
        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute(array($data['pavadinimas'], $data['id']));
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
        $query = 'DELETE FROM ' . $this->tableName . ' WHERE `id` = ?';
        $stmt = Mysql::getInstance()->prepare($query);

        try {
            $stmt->execute(array($id));
        } catch (PDOException $e) {
            return false;
        }

        return true;
    }


    /**
     * @return string
     */
    private function getFieldsPlaceHolder(): string
    {
        return '(' . trim(str_repeat('?, ', count($this->getFieldsToInsert())), ',') .  ')';
    }

    /**
     * @return array
     */
    private function getFieldsToInsert(): array
    {
        return array_filter($this->getFields(), function ($field) {
            return $field !== 'id';
        });
    }
}