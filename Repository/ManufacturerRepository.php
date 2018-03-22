<?php
namespace Repository;



class ManufacturerRepository extends BaseRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'name',
            'date_founded',
            'headquarters',
            'workers_count',
            'founder',
        ];
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteEntity($id): bool
    {
//        $query = 'DELETE engines, gearboxes, models, tires FROM engines ' .
//        'LEFT JOIN gearboxes ON gearboxes.manufacturer_id = engines.manufacturer_id ' .
//        'LEFT JOIN models ON models.manufacturer_id = engines.manufacturer_id ' .
//        'LEFT JOIN tires ON tires.manufacturer_id = engines.manufacturer_id ' .
//        'WHERE engines.manufacturer_id = ?';

//        $stmt = Mysql::getInstance()->prepare($query);
//
//        try {
//            $stmt->execute([$id]);
//        } catch (PDOException $e) {
//            return false;
//        }

        return parent::deleteEntity($id);
    }
}
