<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.27
 */

namespace Repository;


use Enums\Gender;
use Model\Entity;

class GenderRepository extends EntityRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
        ];
    }

    protected function hydrateObject(array $data, Entity $entity)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . str_replace('_', '', ucfirst($key));
            call_user_func_array([$entity, $setter], [$value]);
        }

        return $entity;
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