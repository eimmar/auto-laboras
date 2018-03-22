<?php

namespace Repository;


class ModelRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'generation'
        ];

        $this->joinFields = [
            'manufacturer_id' => new ManufacturerRepository()
        ];
    }

    /**
     * @return array
     */
    public function getOptionsList()
    {
        return $this->executeRawSql(
            'SELECT id, concat(models.name, " ", generation) AS name FROM ' . $this->getTableName(),
            []
        );
    }
}
