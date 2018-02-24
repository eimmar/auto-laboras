<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 01.45
 */
namespace Form;


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
    private $rawFields;

    /**
     * @var Validator
     */
    private $validator;


    /**
     * @param mixed $entity
     * @param bool $isEdit
     * @return mixed
     * @throws \ReflectionException
     */
    public abstract function buildForm($entity, bool $isEdit);

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
        $this->buildForm($entity, $isEdit);
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
     * @param Validator $validator
     * @return BaseForm
     */
    public function setValidator(Validator $validator): BaseForm
    {
        $this->validator = $validator;
        return $this;
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
    public function getRawFields(): array
    {
        return $this->rawFields;
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
            $this->formData[$field->getName()] = $field->getValue($entity);
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
                $this->rawFields = $this->validator->preparePostFieldsForSQL();
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
