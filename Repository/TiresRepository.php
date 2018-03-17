<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 16.01
 */

namespace Repository;


class TiresRepository extends BaseRepository
{
    public function setUpFields(): void
    {
        $this->fields = [
            'id',
            'width',
            'aspect_ratio',
            'date_manufactured',
        ];

        $this->joinFields = [
            'speed_index' => new SpeedIndexRepository(),
            'rim_size' => new RimSizeRepository(),
            'manufacturer_id' => new ManufacturerRepository()
        ];
    }

    /**
     * @return array
     */
    public function getOptionsList()
    {
        return $this->executeRawSql(
            'SELECT t.id, concat(m.name, t.width, t.aspect_ratio) AS name ' .
            'FROM ' . $this->getTableName() . ' t' .
            'LEFT JOIN manufacturers m ON t.manufacturer_id = m.id',
            []
        );
    }
}
