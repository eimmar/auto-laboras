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

abstract class BaseForm
{
    /**
     * @var Field[]|null
     */
    protected $fields;

    /**
     * BaseForm constructor.
     * @param Entity $entity
     */
    public function __construct($entity)
    {
        $this->buildForm($entity);
    }

    /**
     * @return Field[]|null
     */
    public function getFields() : ?array
    {
        return $this->fields;
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
     */
    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }
    
    /**
     * @param Entity $entity
     * @param bool $loadData
     * @return BaseForm
     * @throws \ReflectionException
     */
    public function buildForm(Entity $entity, bool $loadData = false)
    {
        $reflection = new ReflectionClass($entity);
        $fields = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);
        $fields = array_filter($fields, function ($field) {
            return $field->name !== 'id';
        });

        foreach ($fields as $field) {

            $formField = (new Field())
                ->setLabel($field->name)
                ->setClass($field->name)
                ->setName($field)
                ->setType('text')
                ->setMaxLength(32);

            if ($loadData) {
                $getField = 'get' . $field->name;
                $field->setDefaultValue($entity->$getField());
            }

            $this->addField($formField);
        }

        return $this->addField(
            (new Field())
                ->setLabel('Pateikti')
                ->setName('submit')
                ->setDefaultValue('Pateikti')
                ->setType('submit')
        );
    }
}