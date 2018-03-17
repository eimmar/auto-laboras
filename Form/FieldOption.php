<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.25
 * Time: 12.26
 */

namespace Form;


class FieldOption
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var mixed
     */
    private $value;

    /**
     * FieldOption constructor.
     * @param string $label
     * @param mixed $value
     */
    public function __construct($value, string $label)
    {
        $this->setValue($value);
        $this->setLabel($label);
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return FieldOption
     */
    public function setLabel(string $label): FieldOption
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return FieldOption
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
