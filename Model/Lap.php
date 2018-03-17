<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 12.37
 */

namespace Model;


class Lap implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $lapTimeMs;

    /**
     * @var \DateTime
     */
    private $dateLapped;

    /**
     * @var string
     */
    private $note;

    /**
     * @var WeatherConditions
     */
    private $weatherConditions;

    /**
     * @var Car
     */
    private $car;

    /**
     * @var Driver
     */
    private $driver;

    /**
     * @var Tires
     */
    private $tires;

    /**
     * @var Track
     */
    private $track;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Lap
     */
    public function setId(int $id): Lap
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getLapTimeMs(): int
    {
        return $this->lapTimeMs;
    }

    /**
     * @param int $lapTimeMs
     * @return Lap
     */
    public function setLapTimeMs(int $lapTimeMs): Lap
    {
        $this->lapTimeMs = $lapTimeMs;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateLapped(): \DateTime
    {
        return $this->dateLapped;
    }

    /**
     * @param \DateTime $dateLapped
     * @return Lap
     */
    public function setDateLapped(\DateTime $dateLapped): Lap
    {
        $this->dateLapped = $dateLapped;
        return $this;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Lap
     */
    public function setNote(string $note): Lap
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return WeatherConditions
     */
    public function getWeatherConditions(): WeatherConditions
    {
        return $this->weatherConditions;
    }

    /**
     * @param WeatherConditions $weatherConditions
     * @return Lap
     */
    public function setWeatherConditions(WeatherConditions $weatherConditions): Lap
    {
        $this->weatherConditions = $weatherConditions;
        return $this;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car;
    }

    /**
     * @param Car $car
     * @return Lap
     */
    public function setCar(Car $car): Lap
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return Driver
     */
    public function getDriver(): Driver
    {
        return $this->driver;
    }

    /**
     * @param Driver $driver
     * @return Lap
     */
    public function setDriver(Driver $driver): Lap
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     * @return Tires
     */
    public function getTires(): Tires
    {
        return $this->tires;
    }

    /**
     * @param Tires $tires
     * @return Lap
     */
    public function setTires(Tires $tires): Lap
    {
        $this->tires = $tires;
        return $this;
    }

    /**
     * @return Track
     */
    public function getTrack(): Track
    {
        return $this->track;
    }

    /**
     * @param Track $track
     * @return Lap
     */
    public function setTrack(Track $track): Lap
    {
        $this->track = $track;
        return $this;
    }
}
