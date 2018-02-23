<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 19.59
 */

namespace Model;


class Manufacturer implements Entity
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
     * @var \DateTime
     */
    private $dateFounded;

    /**
     * @var string
     */
    private $headquarters;

    /**
     * @var int
     */
    private $workersCount;

    /**
     * @var string
     */
    private $founder;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Manufacturer
     */
    public function setId(int $id): Manufacturer
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
     * @return Manufacturer
     */
    public function setName(string $name): Manufacturer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateFounded(): \DateTime
    {
        return $this->dateFounded;
    }

    /**
     * @param \DateTime $dateFounded
     * @return Manufacturer
     */
    public function setDateFounded(\DateTime $dateFounded): Manufacturer
    {
        $this->dateFounded = $dateFounded;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeadquarters(): string
    {
        return $this->headquarters;
    }

    /**
     * @param string $headquarters
     * @return Manufacturer
     */
    public function setHeadquarters(string $headquarters): Manufacturer
    {
        $this->headquarters = $headquarters;
        return $this;
    }

    /**
     * @return int
     */
    public function getWorkersCount(): int
    {
        return $this->workersCount;
    }

    /**
     * @param int $workersCount
     * @return Manufacturer
     */
    public function setWorkersCount(int $workersCount): Manufacturer
    {
        $this->workersCount = $workersCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getFounder(): string
    {
        return $this->founder;
    }

    /**
     * @param string $founder
     * @return Manufacturer
     */
    public function setFounder(string $founder): Manufacturer
    {
        $this->founder = $founder;
        return $this;
    }
}