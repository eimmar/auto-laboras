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
}
