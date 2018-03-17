<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 02.14
 */

namespace Form;


class ManufacturerForm extends BaseForm
{
    /**
     * @return BaseForm
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        return $this
            ->setName('Gamintojas')
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(100)
                    ->setName('name')
                    ->setLabel('Pavadinimas')
                    ->setValue($this->getFieldValue('name'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(100)
                    ->setName('headquarters')
                    ->setLabel('Bustine')
                    ->setValue($this->getFieldValue('headquarters'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(11)
                    ->setName('workersCount')
                    ->setLabel('Darbuotoju skaicius')
                    ->setValue($this->getFieldValue('workersCount'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(255)
                    ->setName('founder')
                    ->setLabel('Ikurejas')
                    ->setValue($this->getFieldValue('founder'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('dateFounded')
                    ->setLabel('Ikurimo data')
                    ->setValue($this->getFieldValue('dateFounded'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            );
    }
}