<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.25
 * Time: 11.13
 */

namespace Form;


class TrackForm extends BaseForm
{

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        return $this
            ->setName('Trasa')
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
                    ->setMaxLength(11)
                    ->setName('distanceMeters')
                    ->setLabel('Distancija (m)')
                    ->setValue($this->getFieldValue('distanceMeters'))
                    ->setIsRequired(true)
                    ->setValidation('positivenumber')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(100)
                    ->setName('location')
                    ->setLabel('Vietove')
                    ->setValue($this->getFieldValue('location'))
                    ->setIsRequired(true)
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('openingDate')
                    ->setLabel('Atidarymo data')
                    ->setValue($this->getFieldValue('openingDate'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            );
    }
}
