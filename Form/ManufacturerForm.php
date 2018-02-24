<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 02.14
 */

namespace Form;


use Model\Manufacturer;


class ManufacturerForm extends BaseForm
{
    /**
     * @param Manufacturer $entity
     * @param bool $isEdit
     * @return BaseForm
     * @throws \ReflectionException
     */
    public function buildForm($entity, bool $isEdit)
    {
        return $this
            ->setName('Gamintojas')
            ->addField(
                (new Field())
                    ->setType('text')
                    ->setMaxLength(32)
                    ->setName('name')
                    ->setLabel('Pavadinimas')
                    ->setValue($this->getFieldValue('name'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType('text')
                    ->setMaxLength(32)
                    ->setName('headquarters')
                    ->setLabel('Bustine')
                    ->setValue($this->getFieldValue('headquarters'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType('text')
                    ->setMaxLength(10)
                    ->setName('workersCount')
                    ->setLabel('Darbuotoju skaicius')
                    ->setValue($this->getFieldValue('workersCount'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType('text')
                    ->setMaxLength(32)
                    ->setName('founder')
                    ->setLabel('Ikurejas')
                    ->setValue($this->getFieldValue('founder'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType('text')
                    ->setMaxLength(32)
                    ->setName('dateFounded')
                    ->setLabel('Ikurimo data')
                    ->setValue($this->getFieldValue('dateFounded'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            );
    }
}