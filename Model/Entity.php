<?php

namespace Model;
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.23
 * Time: 19.32
 */
interface Entity
{
    /**
     * @return int
     */
    public function getId() : int;

    /**
     * @param int $id
     * @return mixed
     */
    public function setId(int $id);
}
