<?php
namespace Repository;

use Model\Car;
use PDOException;
use Utils\Mysql;

/**
 * Automobilių redagavimo klasė
 *
 * @author ISK
 */

class CarRepository extends EntityRepository
{

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'date_manufactured',
            'weight_kg',
            'price',
            'is_road_legal',
            'seats',
            'top_speed_kph',
            'drive_wheels',
            'body_type',
            'engine_id',
            'model_id',
            'gearbox_id',
        ];
    }

    /**
     * Automobilio išrinkimas
     * @param int $id
     * @return Car|bool
     */
    public function getModel($id)
    {
        $query = "SELECT" . implode(',', $this->getFields()) . "FROM `" . $this->getTableName() . "WHERE `id` = ?";

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetchAll();

        if (count($data) == 0) {
            return false;
        }

        $model = get_class($this->entity);

        return $this->hydrateObject($data, new $model());
    }


    /**
     * Automobilių sąrašo išrinkimas
     * @param int $limit
     * @param int $offset
     * @return Car[]
     */
    public function getModels($limit = null, $offset = null): array
    {
        $query = "SELECT
        `" . DB_PREFIX . "automobiliai`.`id`,
        `" . DB_PREFIX . "automobiliai`.`valstybinis_nr`,
        `" . DB_PREFIX . "auto_busenos`.`name` AS `busena`,
        `" . DB_PREFIX . "modeliai`.`pavadinimas` AS `modelis`,
        `" . DB_PREFIX . "markes`.`pavadinimas` AS `marke`
      FROM
        `" . DB_PREFIX . "automobiliai`
      LEFT JOIN `" . DB_PREFIX . "modeliai`
        ON `" . DB_PREFIX . "automobiliai`.`fk_modelis` = `" . DB_PREFIX . "modeliai`.`id`
      LEFT JOIN `" . DB_PREFIX . "markes`
        ON `" . DB_PREFIX . "modeliai`.`fk_marke` = `" . DB_PREFIX . "markes`.`id`
      LEFT JOIN `" . DB_PREFIX . "auto_busenos`
        ON `" . DB_PREFIX . "automobiliai`.`busena` = `" . DB_PREFIX . "auto_busenos`.`id`";
        $parameters = [];

        if (isset($limit)) {
            $query .= " LIMIT ?";
            $parameters[] = $limit;
        }
        if (isset($offset)) {
            $query .= " OFFSET ?";
            $parameters[] = $offset;
        }

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute($parameters);
        return $stmt->fetchAll();
    }

    /**
     * Pavarų dėžių sąrašo išrinkimas
     * @return array
     */
    public function getGearboxList(): array
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "pavaru_dezes`";
        $stmt = mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();
        return $data;
    }

    /**
     * Degalų tipo sąrašo išrinkimas
     * @return array
     */
    public function getFuelTypeList(): array
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "degalu_tipai`";
        $stmt = mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();
        return $data;
    }

    /**
     * Kėbulo tipų sąrašo išrinkimas
     * @return array
     */
    public function getBodyTypeList(): array
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "kebulu_tipai`";
        $stmt = mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();
        return $data;
    }

    /**
     * Bagažo tipų sąrašo išrinkimas
     * @return array
     */
    public function getLuggageTypeList(): array
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "lagaminai`";
        $stmt = mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();
        return $data;
    }

    /**
     * Automobilio būsenų sąrašo išrinkimas
     * @return array
     */
    public function getCarStateList(): array
    {
        $query = "SELECT * FROM `" . DB_PREFIX . "auto_busenos`";
        $stmt = mysql::getInstance()->query($query);
        $data = $stmt->fetchAll();
        return $data;
    }
}

