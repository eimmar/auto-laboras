<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 20.15
 */

namespace Model;


class Team implements Entity
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
     * @var float
     */
    private $yearlyBudget;

    /**
     * @var bool
     */
    private $isProfessional;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Team
     */
    public function setId(int $id): Team
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
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getYearlyBudget(): float
    {
        return $this->yearlyBudget;
    }

    /**
     * @param float $yearlyBudget
     * @return Team
     */
    public function setYearlyBudget(float $yearlyBudget): Team
    {
        $this->yearlyBudget = $yearlyBudget;
        return $this;
    }

    /**
     * @return bool
     */
    public function isProfessional(): bool
    {
        return $this->isProfessional;
    }

    /**
     * @param bool $isProfessional
     * @return Team
     */
    public function setIsProfessional(bool $isProfessional): Team
    {
        $this->isProfessional = $isProfessional;
        return $this;
    }
}