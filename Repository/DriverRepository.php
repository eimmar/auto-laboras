<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.25
 */

namespace Repository;

use Model\Driver;

class DriverRepository extends BaseRepository
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
            'team_id' => new TeamRepository(),
            'gender' => new GenderRepository(),
        ];
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
