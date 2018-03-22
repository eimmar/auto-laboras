<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.25
 */

namespace Repository;

use Model\Driver;

class DriverRepository extends BaseRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'first_name',
            'last_name',
            'age',
            'driving_experience_years',
        ];

        $this->joinFields = [
            'team_id' => new TeamRepository(),
            'gender' => new GenderRepository(),
        ];
    }

    public function getOptionsList()
    {
        return $this->executeRawSql(
            'SELECT id, concat(first_name, " ", last_name) AS name ' .
            'FROM ' . $this->getTableName(),
            []
        );
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
//        $query = 'DELETE FROM laps WHERE labs.driver_id = ?';
//        $stmt = Mysql::getInstance()->prepare($query);
//
//        try {
//            $stmt->execute([$id]);
//        } catch (PDOException $e) {
//            return false;
//        }

        return parent::deleteEntity($id);
    }
}
