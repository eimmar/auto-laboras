<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.21
 */

namespace Model;


use Enums\Gender;

class Driver implements Entity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var int
     */
    private $age;

    /**
     * @var int
     */
    private $drivingExperianceYears;

    /**
     * @var Team
     */
    private $team;

    /**
     * @var Gender
     */
    private $gender;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Driver
     */
    public function setId(int $id): Driver
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Driver
     */
    public function setFirstName(string $firstName): Driver
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Driver
     */
    public function setLastName(string $lastName): Driver
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return Driver
     */
    public function setAge(int $age): Driver
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return int
     */
    public function getDrivingExperianceYears(): int
    {
        return $this->drivingExperianceYears;
    }

    /**
     * @param int $drivingExperianceYears
     * @return Driver
     */
    public function setDrivingExperianceYears(int $drivingExperianceYears): Driver
    {
        $this->drivingExperianceYears = $drivingExperianceYears;
        return $this;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return Driver
     */
    public function setTeam(Team $team): Driver
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     * @return Driver
     */
    public function setGender(Gender $gender): Driver
    {
        $this->gender = $gender;
        return $this;
    }
}