<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.17
 */

namespace Repository;


class TeamRepository extends BaseRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'yearly_budget',
            'is_professional',
        ];
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
//        $query = 'DELETE drivers, laps FROM drivers LEFT JOIN laps ON laps.driver_id = drivers.id WHERE drivers.team_id = ?';
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
