<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.14
 */

namespace Repository;


use PDOException;
use Utils\Mysql;

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

    /**
     * @param array $criteria
     * @return array|bool
     */
    public function getReportData($criteria)
    {
        $query = 'SELECT tracks.*, COUNT(laps.id) as lapCount, AVG(laps.lap_time_ms) as avgTime FROM tracks, laps ';
        $query .= 'WHERE laps.date_lapped >= :date_from AND laps.date_lapped <= :date_to AND tracks.id = laps.track_id ';
        $query .= 'GROUP BY tracks.id ORDER BY lapCount DESC';

        $stmt = Mysql::getInstance()->prepare($query);

        try {
            $stmt->execute($criteria);
        } catch (PDOException $e) {
            return false;
        }

        return $stmt->fetchAll();
    }
}
