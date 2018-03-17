<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 18.34
 */

namespace Model;


class Gearbox extends CommonEntity implements Entity
{
    /**
     * @var int
     */
    private $gearCount;

    /**
     * @var \DateTime
     */
    private $dateManufactured;

    /**
     * @var GearboxType
     */
    private $type;

    /**
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * @return int
     */
    public function getGearCount(): int
    {
        return $this->gearCount;
    }

    /**
     * @param int $gearCount
     * @return Gearbox
     */
    public function setGearCount(int $gearCount): Gearbox
    {
        $this->gearCount = $gearCount;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateManufactured(): \DateTime
    {
        return $this->dateManufactured;
    }

    /**
     * @param \DateTime $dateManufactured
     * @return Gearbox
     */
    public function setDateManufactured(\DateTime $dateManufactured): Gearbox
    {
        $this->dateManufactured = $dateManufactured;
        return $this;
    }

    /**
     * @return GearboxType
     */
    public function getType(): GearboxType
    {
        return $this->type;
    }

    /**
     * @param GearboxType $type
     * @return Gearbox
     */
    public function setType(GearboxType $type): Gearbox
    {
        $this->type = $type;
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
     * @return Gearbox
     */
    public function setManufacturer(Manufacturer $manufacturer): Gearbox
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
