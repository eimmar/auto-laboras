<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 18.26
 */

namespace Model;


abstract class CommonEntity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CommonEntity
     */
    public function setId(int $id): CommonEntity
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
     * @return CommonEntity
     */
    public function setName(string $name): CommonEntity
    {
        $this->name = $name;
        return $this;
    }
}
