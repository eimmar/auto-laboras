<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 22.18
 */

namespace Model;


use PDOException;
use Utils\Mysql;

abstract class Entity
{
    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var array
     */
    protected $fields;

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
    public function getFields(): array
    {
        return $this->fields;
    }

    protected abstract function setUpFields(): void;

    protected abstract function setUpTableName(): void;

    public function __construct()
    {
        $this->setUpTableName();
        $this->setUpFields();
    }

    /**
     * @param int $id
     * @return array|bool
     */
    public function getEntity($id)
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ?';

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();

        if (count($data) == 0) {
            return false;
        }

        return $data[0];
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getEntityList($limit = null, $offset = null): array
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

        return $data;
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
     * @return int|null
     */
    public function getMaxId(): ?int
    {
        $query = 'SELECT MAX(`id`) as `latestId` FROM ' . $this->tableName;
        $stmt = Mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();

        return $data[0]['latestId'];
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