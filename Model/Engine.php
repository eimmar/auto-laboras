<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 18.20
 */

namespace Model;


class Engine implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $powerKw;

    /**
     * @var int
     */
    private $torque;

    /**
     * @var int
     */
    private $capacityMl;

    /**
     * @var int
     */
    private $cilinderCount;

    /**
     * @var \DateTime
     */
    private $dateManufactured;

    /**
     * @var Displacement
     */
    private $displacement;

    /**
     * @var FuelType
     */
    private $fuelType;

    /**
     * @var Manufacturer
     */
    private $manufacturer;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Engine
     */
    public function setId(int $id): Engine
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPowerKw(): int
    {
        return $this->powerKw;
    }

    /**
     * @param int $powerKw
     * @return Engine
     */
    public function setPowerKw(int $powerKw): Engine
    {
        $this->powerKw = $powerKw;
        return $this;
    }

    /**
     * @return int
     */
    public function getTorque(): int
    {
        return $this->torque;
    }

    /**
     * @param int $torque
     * @return Engine
     */
    public function setTorque(int $torque): Engine
    {
        $this->torque = $torque;
        return $this;
    }

    /**
     * @return int
     */
    public function getCapacityMl(): int
    {
        return $this->capacityMl;
    }

    /**
     * @param int $capacityMl
     * @return Engine
     */
    public function setCapacityMl(int $capacityMl): Engine
    {
        $this->capacityMl = $capacityMl;
        return $this;
    }

    /**
     * @return int
     */
    public function getCilinderCount(): int
    {
        return $this->cilinderCount;
    }

    /**
     * @param int $cilinderCount
     * @return Engine
     */
    public function setCilinderCount(int $cilinderCount): Engine
    {
        $this->cilinderCount = $cilinderCount;
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
     * @return Engine
     */
    public function setDateManufactured(\DateTime $dateManufactured): Engine
    {
        $this->dateManufactured = $dateManufactured;
        return $this;
    }

    /**
     * @return Displacement
     */
    public function getDisplacement(): Displacement
    {
        return $this->displacement;
    }

    /**
     * @param Displacement $displacement
     * @return Engine
     */
    public function setDisplacement(Displacement $displacement): Engine
    {
        $this->displacement = $displacement;
        return $this;
    }

    /**
     * @return FuelType
     */
    public function getFuelType(): FuelType
    {
        return $this->fuelType;
    }

    /**
     * @param FuelType $fuelType
     * @return Engine
     */
    public function setFuelType(FuelType $fuelType): Engine
    {
        $this->fuelType = $fuelType;
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
     * @return Engine
     */
    public function setManufacturer(Manufacturer $manufacturer): Engine
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
