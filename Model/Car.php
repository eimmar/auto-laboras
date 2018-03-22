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
    private $dateManufactured;

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
     * @var DriveWheels
     */
    private $driveWheels;

    /**
     * @var BodyType
     */
    private $bodyType;

    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var Gearbox
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
        return $this->dateManufactured;
    }

    /**
     * @param \DateTime $dateManufactured
     * @return Car
     */
    public function setDateManufactured(\DateTime $dateManufactured): Car
    {
        $this->dateManufactured = $dateManufactured;
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
     * @return DriveWheels
     */
    public function getDriveWheels(): DriveWheels
    {
        return $this->driveWheels;
    }

    /**
     * @param DriveWheels $driveWheels
     * @return Car
     */
    public function setDriveWheels(DriveWheels $driveWheels): Car
    {
        $this->driveWheels = $driveWheels;
        return $this;
    }

    /**
     * @return BodyType
     */
    public function getBodyType(): BodyType
    {
        return $this->bodyType;
    }

    /**
     * @param BodyType $bodyType
     * @return Car
     */
    public function setBodyType(BodyType $bodyType): Car
    {
        $this->bodyType = $bodyType;
        return $this;
    }

    /**
     * @return Engine
     */
    public function getEngine(): Engine
    {
        return $this->engine;
    }

    /**
     * @param Engine $engine
     * @return Car
     */
    public function setEngine(Engine $engine): Car
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     * @return Car
     */
    public function setModel(Model $model): Car
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return Gearbox
     */
    public function getGearbox(): Gearbox
    {
        return $this->gearbox;
    }

    /**
     * @param Gearbox $gearbox
     * @return Car
     */
    public function setGearbox(Gearbox $gearbox): Car
    {
        $this->gearbox = $gearbox;
        return $this;
    }
}
