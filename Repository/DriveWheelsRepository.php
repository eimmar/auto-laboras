<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 18.16
 */

namespace Repository;


class DriveWheelsRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name'
        ];
    }
}
