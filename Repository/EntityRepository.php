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

abstract class EntityRepository
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var array
     */
    protected $fields;

    protected $joinFields;


    /**
     * @var Entity;
     */
    protected $entity;

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

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

    protected abstract function setUpFields(): void;


    protected function setUpTableName(): void
    {
        $this->tableName = DB_PREFIX . '.' . strtolower(get_class($this->entity)) . 's';
    }

    /**
     * @return string
     */
    protected function getModelSql()
    {
        $model = strtolower(get_class($this->entity)) . 's';

        $selectCols = '';
        $joins = '';

        foreach ($this->getFields() as $field) {
            $selectCols = $model . '.' . $field . ', ';
        }

        /**
         * @var string $field
         * @var EntityRepository $repository
         */
        foreach ($this->getJoinFields() as $field => $repository) {
            foreach ($repository->getFields() as $field) {
                $selectCols .= $repository->getTableName() . '.' . $field . ', ';
            }

            $joins .= ' LEFT JOIN ' . $repository->getTableName() .
                ' ON ' . $this->getTableName() . '.' . $field .' = ' . $repository->getTableName() . '.id ';
        }

        return 'SELECT ' . trim($selectCols, ',') . ' FROM ' . $this->tableName . $joins;
    }

    public function __construct($entity)
    {
        $this->setUpTableName();
        $this->setUpFields();
        $this->entity = $entity;
    }

    /**
     * @param int $id
     * @return Entity|bool
     */
    public function getModel(int $id)
    {
        $query = $this->getModelSql();

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();

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
        $query      = 'SELECT * FROM ' . $this->tableName;
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
     * @param array $data
     * @param mixed $entity
     * @return mixed
     */
    protected function hydrateObject(array $data, Entity $entity)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . str_replace('_', '', ucfirst($key));
            call_user_func_array([$entity, $setter], [$value]);
        }

        return $entity;
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