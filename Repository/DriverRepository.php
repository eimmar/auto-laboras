<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.25
 */

namespace Repository;


use Enums\Gender;
use Model\Driver;
use Model\Entity;
use Model\Team;

class DriverRepository extends EntityRepository
{
    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'first_name',
            'last_name',
            'age',
            'driving_experience_years',
        ];

        $this->joinFields = [
            'team_id' => new TeamRepository(new Team()),
            'gender' => new GenderRepository(new Gender()),
        ];
    }

    protected function getModelSql()
    {
        $model = strtolower(get_class($this->entity)) . 's';

        $selectCols = '';
        $joins = '';

        foreach ($this->getFields() as $field) {
            $selectCols = $model . '.' . $field . ', ';
        }

        /**
         * @var string $field
         * @var EntityRepository $repository
         */
        foreach ($this->getJoinFields() as $field => $repository) {
            foreach ($repository->getFields() as $field) {
                $selectCols .= $repository->getTableName() . '.' . $field . ', ';
            }

            $joins .= ' LEFT JOIN ' . $repository->getTableName() .
                ' ON ' . $this->getTableName() . '.' . $field .' = ' . $repository->getTableName() . '.id ';
        }

        return 'SELECT ' . trim($selectCols, ',') . ' FROM ' . $this->tableName . $joins;

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
     * @return Driver|bool
     */
    public function getModel($id)
    {
        return parent::getModel($id);
    }

    /**
     * @param int|null $limit
     * @param int|null $offset
     * @return Driver[]
     */
    public function getModels(int $limit = null, int $offset = null): array
    {
        return parent::getModels($limit, $offset);
    }
}