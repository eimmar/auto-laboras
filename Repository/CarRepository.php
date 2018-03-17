<?php
namespace Repository;

use Model\Car;
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
            'drive_wheels',
            'body_type',
            'engine_id',
            'model_id',
            'gearbox_id',
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
}
