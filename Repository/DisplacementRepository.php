<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.22
 * Time: 16.11
 */

namespace Repository;


class DisplacementRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name'
        ];
    }
}
