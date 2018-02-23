<?php
namespace Repository;

use Model\Manufacturer;


class ManufacturerRepository extends EntityRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'date_founded',
            'headquarters',
            'workers_count',
            'founder',
        ];
    }

    /**
     * @param int $id
     * @return Manufacturer|bool
     */
    public function getModel($id)
    {
        return parent::getModel($id);
    }


    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Manufacturer[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        return parent::getModels($limit, $offset);
    }

}

