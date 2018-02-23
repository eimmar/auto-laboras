<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.17
 */

namespace Repository;


use Model\Team;

class TeamRepository extends EntityRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'yearly_budget',
            'is_professional',
        ];
    }

    /**
     * @param int $id
     * @return Team|bool
     */
    public function getModel($id)
    {
        return parent::getModel($id);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Team[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        return parent::getModels($limit, $offset);
    }
}