<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.14
 */

namespace Repository;


use Model\Track;

class TrackRepository extends EntityRepository
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

    /**
     * @param int $id
     * @return Track|bool
     */
    public function getModel($id)
    {
        return parent::getModel($id);
    }


    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Track[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        return parent::getModels($limit, $offset);
    }
}