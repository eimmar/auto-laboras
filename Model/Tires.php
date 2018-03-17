<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 12.45
 */

namespace Model;


class Tires implements Entity
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
     * @return Tires
     */
    public function setId(int $id): Tires
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
     * @return Tires
     */
    public function setWidth(int $width): Tires
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
     * @return Tires
     */
    public function setAspectRatio(int $aspectRatio): Tires
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
     * @return Tires
     */
    public function setDateManufactured(\DateTime $dateManufactured): Tires
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
     * @return Tires
     */
    public function setSpeedIndex(SpeedIndex $speedIndex): Tires
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
     * @return Tires
     */
    public function setRimSize(RimSize $rimSize): Tires
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
     * @return Tires
     */
    public function setManufacturer(Manufacturer $manufacturer): Tires
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
}
