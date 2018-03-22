<?php
namespace Repository;
use Model\Car;
use PDO;
use PDOException;
use Utils\Mysql;


/**
 * Automobilių redagavimo klasė
 *
 * @author ISK
 */

class CarRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'date_manufactured',
            'weight_kg',
            'price',
            'is_road_legal',
            'seats',
            'top_speed_kph',
        ];

        $this->joinFields = [
            'drive_wheels' => new DriveWheelsRepository(),
            'body_type' => new BodyTypeRepository(),
            'engine_id' => new EngineRepository(),
            'model_id' => new ModelRepository(),
            'gearbox_id' => new GearboxRepository(),
        ];
    }

    /**
     * @return array
     */
    public function getOptionsList()
    {
        return $this->executeRawSql(
            'SELECT c.id, concat(mn.name, " ", m.name, " ", m.generation, " id: " ,c.id) AS name ' .
            'FROM ' . $this->getTableName() . ' AS c ' .
            'LEFT JOIN models m ON c.model_id = m.id ' .
            'LEFT JOIN manufacturers mn ON m.manufacturer_id = mn.id',
            []
        );
    }

    /**
     * @return string
     */
    protected function getModelSql(bool $rawSql = false)
    {
        if ($rawSql) {
            return 'SELECT cars.id, cars.date_manufactured, cars.weight_kg, cars.price, cars.is_road_legal, cars.seats, cars.top_speed_kph, ' .
                'drive_wheels.name as drive_wheels, ' .
                'body_types.name as body_type, ' .
                'engines.power_kw, engines.torque, engines.capacity_ml, engines.cilinder_count, ' .
                'models.name as model_name, models.generation, ' .
                'gearboxes.gear_count, ' .
                'gearbox_types.name AS gearbox_type ' .
                'FROM auto_laboras.cars ' .
                'LEFT JOIN drive_wheels ON cars.drive_wheels = drive_wheels.id ' .
                'LEFT JOIN body_types ON cars.body_type = body_types.id ' .
                'LEFT JOIN engines ON cars.engine_id = engines.id ' .
                'LEFT JOIN models ON cars.model_id = models.id ' .
                'LEFT JOIN gearboxes ON cars.gearbox_id = gearboxes.id ' .
                'LEFT JOIN gearbox_types ON gearboxes.type = gearbox_types.id ' .
                'ORDER BY cars.id ASC';
        } else {
            return parent::getModelSql();
        }
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Car[]|array
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        $query      = $this->getModelSql(true);
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
        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
//        $query = 'DELETE FROM laps WHERE labs.car_id = ?';
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
