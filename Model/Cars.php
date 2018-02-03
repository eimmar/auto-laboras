<?php
namespace Model;

use PDOException;
use Utils\Mysql;

/**
 * Automobilių redagavimo klasė
 *
 * @author ISK
 */

class Cars extends Entity
{

    /**
     * Automobilio išrinkimas
     * @param int $id
     * @return array|bool
     */
    public function getEntity($id)
    {
        $query = "SELECT
        `id`,
        `valstybinis_nr`,
        `pagaminimo_data`,
        `rida`,
        `radijas`,
        `grotuvas`,
        `kondicionierius`,
        `vietu_skaicius`,
        `registravimo_data`,
        `verte`,
        `pavaru_deze`,
        `degalu_tipas`,
        `kebulas`,
        `bagazo_dydis`,
        `busena`,
        `fk_modelis` AS `modelis`
      FROM `" . DB_PREFIX . "automobiliai`
      WHERE `id` = ?";

        $stmt = Mysql::getInstance()->prepare($query);
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();

        if (count($data) == 0) {
            return false;
        }

        return $data[0];
    }


    /**
     * Automobilių sąrašo išrinkimas
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getEntityList($limit = null, $offset = null): array
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

    protected function setUpFields(): void
    {
        $this->fields = [
            'id',
            'valstybinis_nr',
            'pagaminimo_data',
            'rida',
            'radijas',
            'grotuvas',
            'kondicionierius',
            'vietu_skaicius',
            'registravimo_data',
            'verte',
            'pavaru_deze',
            'degalu_tipas',
            'kebulas',
            'bagazo_dydis',
            'busena',
            'fk_modelis'
        ];
    }

    protected function setUpTableName(): void
    {
        $this->tableName = DB_PREFIX . '.' . 'automobiliai';
    }
}

