<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.14
 */

namespace Repository;


class TrackRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'distance_meters',
            'location',
            'opening_date',
        ];
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
//        $query = 'DELETE FROM laps WHERE labs.track_id = ?';
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
