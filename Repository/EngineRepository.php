<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.22
 * Time: 15.28
 */

namespace Repository;


class EngineRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'power_kw',
            'torque',
            'capacity_ml',
            'cilinder_count',
            'date_manufactured',
//            'displacement',
//            'fuel_type',
//            'manufacturer_id'
        ];

        $this->joinFields = [
            'displacement' => new DisplacementRepository(),
            'fuel_type',
            'manufacturer_id'
        ];
    }

    public function getOptionsList()
    {
        return $this->executeRawSql(
            'SELECT e.id, concat(mn.name, " ", ROUND(e.capacity_ml / 1000, 1), " ", ' .
            'd.name, e.cilinder_count, " ", e.power_kw, "Kw") AS name ' .
            'FROM ' . $this->getTableName() . ' AS e ' .
            'LEFT JOIN displacements d ON e.displacement = d.id ' .
            'LEFT JOIN manufacturers mn ON e.manufacturer_id = mn.id',
            []
        );
    }
}
