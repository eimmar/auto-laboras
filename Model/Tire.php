<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 12.45
 */

namespace Model;


class Tire implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $aspectRatio;

    /**
     * @var \DateTime
     */
    private $dateManufactured;

    /**
     * @var SpeedIndex
     */
    private $speedIndex;

    /**
     * @var RimSize
     */
    private $rimSize;

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
     * @return Tire
     */
    public function setId(int $id): Tire
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Tire
     */
    public function setWidth(int $width): Tire
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getAspectRatio(): int
    {
        return $this->aspectRatio;
    }

    /**
     * @param int $aspectRatio
     * @return Tire
     */
    public function setAspectRatio(int $aspectRatio): Tire
    {
        $this->aspectRatio = $aspectRatio;
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
     * @return Tire
     */
    public function setDateManufactured(\DateTime $dateManufactured): Tire
    {
        $this->dateManufactured = $dateManufactured;
        return $this;
    }

    /**
     * @return SpeedIndex
     */
    public function getSpeedIndex(): SpeedIndex
    {
        return $this->speedIndex;
    }

    /**
     * @param SpeedIndex $speedIndex
     * @return Tire
     */
    public function setSpeedIndex(SpeedIndex $speedIndex): Tire
    {
        $this->speedIndex = $speedIndex;
        return $this;
    }

    /**
     * @return RimSize
     */
    public function getRimSize(): RimSize
    {
        return $this->rimSize;
    }

    /**
     * @param RimSize $rimSize
     * @return Tire
     */
    public function setRimSize(RimSize $rimSize): Tire
    {
        $this->rimSize = $rimSize;
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
     * @return Tire
     */
    public function setManufacturer(Manufacturer $manufacturer): Tire
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
