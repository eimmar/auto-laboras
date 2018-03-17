<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 16.01
 */

namespace Repository;


class SpeedIndexRepository extends BaseRepository
{
    public function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name'
        ];
    }
}
