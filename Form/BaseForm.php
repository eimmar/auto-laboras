<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 01.45
 */
namespace Form;


use Model\Entity;
use ReflectionClass;
use ReflectionProperty;
use Utils\Validator;

abstract class BaseForm
{
    /**
     * @var Field[]|null
     */
    protected $fields;

    /**
     * @var array|null
     */
    protected $formData;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    private $isValid;

    /**
     * @var bool
     */
    private $isSubmitted;

    /**
     * @var array
     */
    private $rawData;

    /**
     * @var Validator
     */
    private $validator;


    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public abstract function buildForm();

    /**
     * BaseForm constructor.
     * @param $entity
     * @param bool $isEdit
     * @throws \ReflectionException
     */
    public function __construct($entity, bool $isEdit)
    {
        $this->setName('Forma');
        $this->setFormData($entity);
        $this->buildForm();
        $this->isSubmitted = isset($_POST['submit']) ? true : false;
        $this->isValid = true;
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
     * @return BaseForm
     */
    public function setName(string $name): BaseForm
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @return bool
     */
    public function isSubmitted(): bool
    {
        return $this->isSubmitted;
    }

    /**
     * @return array
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }

    /**
     * @param mixed $entity
     * @throws \ReflectionException
     */
    protected function setFormData($entity)
    {
        $reflection = new ReflectionClass($entity);
        $fields = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

        array_walk($fields, function (ReflectionProperty $field) use ($entity) {
            $field->setAccessible(true);
            $value = $field->getValue($entity);
            $this->formData[$field->getName()] = $value instanceof Entity ? (int) $value->getId() : $value;
        });
    }

    /**
     * @return BaseForm
     */
    public function validate() : BaseForm
    {
        if ($this->isSubmitted()) {
            $this->validator = new Validator();
            foreach ($_POST as $key => $value) {
                $this->setFieldValue($key, $value);
            }

            if (!$this->validator->validate($this)) {

                $this->isValid = false;
            } else {
                $this->isValid = true;
                $this->rawData = $this->validator->preparePostFieldsForSQL();
            }

        }

        return $this;
    }

    /**
     * @param $key
     * @return string|null
     */
    protected function getFieldValue(string $key)
    {
        $value = array_key_exists($key, $this->formData) ? $this->formData[$key] : null;
        $value = $value instanceof \DateTime ? $value->format('Y-m-d') : $value;
        return $value;
    }

    /**
     * @return Field[]|null
     */
    public function getFields() : ?array
    {
        return $this->fields;
    }

    /**
     * @param string $fieldName
     * @param mixed $fieldValue
     * @return BaseForm
     */
    public function setFieldValue($fieldName, $fieldValue) : BaseForm
    {
        array_key_exists($fieldName, $this->fields) ? $this->fields[$fieldName]->setValue($fieldValue) : null;
        return $this;
    }

    /**
     * @param Field[] $fields
     * @return BaseForm
     */
    public function setFields($fields) : BaseForm
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @param Field $field
     * @return BaseForm
     */
    public function addField($field) : BaseForm
    {
        $this->fields[$field->getName()] = $field;
        return $this;
    }
}
