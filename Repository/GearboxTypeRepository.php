<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.22
 * Time: 16.24
 */

namespace Repository;


class GearboxTypeRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name'
        ];
    }
}
