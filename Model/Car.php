<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 19.37
 */

namespace Model;


class Car implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date_manufactured;

    /**
     * @var int
     */
    private $weightKg;

    /**
     * @var float
     */
    private $price;

    /**
     * @var bool
     */
    private $isRoadLegal;

    /**
     * @var int
     */
    private $seats;

    /**
     * @var int
     */
    private $topSpeedKph;

    /**
     * @var int
     */
    private $driveWheels;

    /**
     * @var int
     */
    private $bodyType;

    /**
     * @var int
     */
    private $engine;

    /**
     * @var int
     */
    private $model;

    /**
     * @var int
     */
    private $gearbox;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Car
     */
    public function setId(int $id): Car
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateManufactured(): \DateTime
    {
        return $this->date_manufactured;
    }

    /**
     * @param \DateTime $date_manufactured
     * @return Car
     */
    public function setDateManufactured(\DateTime $date_manufactured): Car
    {
        $this->date_manufactured = $date_manufactured;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeightKg(): int
    {
        return $this->weightKg;
    }

    /**
     * @param int $weightKg
     * @return Car
     */
    public function setWeightKg(int $weightKg): Car
    {
        $this->weightKg = $weightKg;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Car
     */
    public function setPrice(float $price): Car
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRoadLegal(): bool
    {
        return $this->isRoadLegal;
    }

    /**
     * @param bool $isRoadLegal
     * @return Car
     */
    public function setIsRoadLegal(bool $isRoadLegal): Car
    {
        $this->isRoadLegal = $isRoadLegal;
        return $this;
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     * @return Car
     */
    public function setSeats(int $seats): Car
    {
        $this->seats = $seats;
        return $this;
    }

    /**
     * @return int
     */
    public function getTopSpeedKph(): int
    {
        return $this->topSpeedKph;
    }

    /**
     * @param int $topSpeedKph
     * @return Car
     */
    public function setTopSpeedKph(int $topSpeedKph): Car
    {
        $this->topSpeedKph = $topSpeedKph;
        return $this;
    }

    /**
     * @return int
     */
    public function getDriveWheels(): int
    {
        return $this->driveWheels;
    }

    /**
     * @param int $driveWheels
     * @return Car
     */
    public function setDriveWheels(int $driveWheels): Car
    {
        $this->driveWheels = $driveWheels;
        return $this;
    }

    /**
     * @return int
     */
    public function getBodyType(): int
    {
        return $this->bodyType;
    }

    /**
     * @param int $bodyType
     * @return Car
     */
    public function setBodyType(int $bodyType): Car
    {
        $this->bodyType = $bodyType;
        return $this;
    }

    /**
     * @return int
     */
    public function getEngine(): int
    {
        return $this->engine;
    }

    /**
     * @param int $engine
     * @return Car
     */
    public function setEngine(int $engine): Car
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return int
     */
    public function getModel(): int
    {
        return $this->model;
    }

    /**
     * @param int $model
     * @return Car
     */
    public function setModel(int $model): Car
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return int
     */
    public function getGearbox(): int
    {
        return $this->gearbox;
    }

    /**
     * @param int $gearbox
     * @return Car
     */
    public function setGearbox(int $gearbox): Car
    {
        $this->gearbox = $gearbox;
        return $this;
    }
}