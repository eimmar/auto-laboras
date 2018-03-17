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
     * @var bool
     */
    private $isForeignKey;

    /**
     * @var FieldOption[]|null
     */
    private $options;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var bool
     */
    private $hasError;

    /**
     * @var BaseForm|null
     */
    private $formType;

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
        $this->setIsRequired(false);
        $this->setHasError(false);
        $this->setIsForeignKey(false);
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
     * @return bool
     */
    public function isForeignKey(): bool
    {
        return $this->isForeignKey;
    }

    /**
     * @param bool $isForeignKey
     * @return Field
     */
    public function setIsForeignKey(bool $isForeignKey): Field
    {
        $this->isForeignKey = $isForeignKey;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->hasError;
    }

    /**
     * @param bool $hasError
     * @return Field
     */
    public function setHasError(bool $hasError): Field
    {
        $this->hasError = $hasError;
        return $this;
    }

    /**
     * @return FieldOption[]|null
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param FieldOption[]|null $options
     * @return Field
     */
    public function setOptions(?array $options): Field
    {
        foreach ($options as $option) {
            $this->addOption(new FieldOption(current($option), end($option)));
        }
        return $this;
    }

    /**
     * @param FieldOption $option
     * @return Field
     */
    public function addOption(FieldOption $option): Field
    {
        $this->options[] = $option;
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
     * @return Field
     */
    public function setValue($value): Field
    {
        $this->value = $value;
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

    /**
     * @return BaseForm|null
     */
    public function getFormType(): ?BaseForm
    {
        return $this->formType;
    }

    /**
     * @param BaseForm|null $formType
     * @return Field
     */
    public function setFormType(?BaseForm $formType): Field
    {
        $this->formType = $formType;
        return $this;
    }
}
