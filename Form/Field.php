<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 02.01
 */

namespace Form;


class Field
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $class;

    /**
     * @var bool
     */
    private $isRequired;

    /**
     * @var array|null
     */
    private $options;

    /**
     * @var string|null
     */
    private $defaultValue;

    /**
     * @var string|null
     */
    private $validation;

    /**
     * @var int|null
     */
    private $maxLength;

    public function __construct()
    {
        $this->isRequired = false;
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
     * @return Field
     */
    public function setName(string $name): Field
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Field
     */
    public function setType(string $type): Field
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return Field
     */
    public function setLabel(?string $label): Field
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param null|string $class
     * @return Field
     */
    public function setClass(?string $class): Field
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }

    /**
     * @param bool $isRequired
     * @return Field
     */
    public function setIsRequired(bool $isRequired): Field
    {
        $this->isRequired = $isRequired;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param array|null $options
     * @return Field
     */
    public function setOptions(?array $options): Field
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getDefaultValue(): ?string
    {
        return $this->defaultValue;
    }

    /**
     * @param null|string $defaultValue
     * @return Field
     */
    public function setDefaultValue(?string $defaultValue): Field
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getValidation(): ?string
    {
        return $this->validation;
    }

    /**
     * @param null|string $validation
     * @return Field
     */
    public function setValidation(?string $validation): Field
    {
        $this->validation = $validation;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * @param int|null $maxLength
     * @return Field
     */
    public function setMaxLength(?int $maxLength): Field
    {
        $this->maxLength = $maxLength;
        return $this;
    }
}