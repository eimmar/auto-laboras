<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 18.32
 */

namespace Model;


class Model extends CommonEntity implements Entity
{
    /**
     * @var string
     */
    private $generation;

    /**
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * @return string
     */
    public function getGeneration(): string
    {
        return $this->generation;
    }

    /**
     * @param string $generation
     * @return Model
     */
    public function setGeneration(string $generation): Model
    {
        $this->generation = $generation;
        return $this;
    }

    /**
     * @return Manufacturer
     */
    public function getManufacturer(): Manufacturer
    {
        return $this->manufacturer;
    }

    /**
     * @param Manufacturer $manufacturer
     * @return Model
     */
    public function setManufacturer(Manufacturer $manufacturer): Model
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
