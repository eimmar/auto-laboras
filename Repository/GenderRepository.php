<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.27
 */

namespace Repository;


use Model\Gender;

class GenderRepository extends BaseRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
        ];
    }

    /**
     * @param int $id
     * @return Gender|bool
     */
    public function getModel($id)
    {
        return parent::getModel($id);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Gender[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        return parent::getModels($limit, $offset);
    }
}