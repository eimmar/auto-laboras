<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.13
 */

namespace Model;


class Track implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $distanceMeters;

    /**
     * @var string
     */
    private $location;

    /**
     * @var \DateTime
     */
    private $openingDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Track
     */
    public function setId(int $id): Track
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Track
     */
    public function setName(string $name): Track
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getDistanceMeters(): int
    {
        return $this->distanceMeters;
    }

    /**
     * @param int $distanceMeters
     * @return Track
     */
    public function setDistanceMeters(int $distanceMeters): Track
    {
        $this->distanceMeters = $distanceMeters;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Track
     */
    public function setLocation(string $location): Track
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getOpeningDate(): \DateTime
    {
        return $this->openingDate;
    }

    /**
     * @param \DateTime $openingDate
     * @return Track
     */
    public function setOpeningDate(\DateTime $openingDate): Track
    {
        $this->openingDate = $openingDate;
        return $this;
    }
}