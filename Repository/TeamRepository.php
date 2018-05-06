<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.17
 */

namespace Repository;


use PDO;
use PDOException;
use Utils\Mysql;

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

    /**
     * @param array $criteria
     * @return array|bool
     */
    public function getReportData($criteria)
    {
        $query = 'SELECT teams.name, teams.yearly_budget, teams.is_professional, drivers.first_name, drivers.last_name, ';
        $query .= 'AVG(laps.lap_time_ms) as avgTime, COUNT(laps.id) as lapCount, GROUP_CONCAT(DISTINCT(tracks.name)) as trackNames, AVG(tracks.distance_meters) as avgDistance ';
        $query .= 'FROM teams, drivers, tracks, laps ';
        $query .= 'WHERE drivers.team_id = teams.id AND laps.driver_id = drivers.id AND laps.track_id = tracks.id ';
        $query .= 'AND laps.date_lapped >= :date_from AND laps.date_lapped <= :date_to ';
        $query .= 'GROUP BY teams.id, drivers.id ORDER BY teams.name, avgTime ASC';

        $stmt = Mysql::getInstance()->prepare($query);

        try {
            $stmt->execute($criteria);
        } catch (PDOException $e) {
            return false;
        }

        return $stmt->fetchAll(PDO::FETCH_GROUP);
    }
}
