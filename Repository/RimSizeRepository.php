<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 16.02
 */

namespace Repository;


class RimSizeRepository extends BaseRepository
{
    public function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name'
        ];
    }
}
