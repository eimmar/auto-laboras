<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.22
 * Time: 15.31
 */

namespace Repository;


class GearboxRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'gear_count',
            'name',
            'date_manufactured',
        ];

        $this->joinFields = [
            'manufacturer_id' => new ManufacturerRepository(),
            'type' => new GearboxTypeRepository()
        ];

        $this->tableName = 'gearboxes';
    }
}
