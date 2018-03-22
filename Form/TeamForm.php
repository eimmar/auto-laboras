<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.25
 * Time: 11.28
 */

namespace Form;


class TeamForm extends BaseForm
{

    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        return $this
            ->setName('Komanda')
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
                    ->setName('yearlyBudget')
                    ->setLabel('Metinis biudzetas EUR')
                    ->setValue($this->getFieldValue('yearlyBudget'))
                    ->setIsRequired(true)
                    ->setValidation('price')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::CHECKBOX_TYPE)
                    ->setName('isProfessional')
                    ->setLabel('Profesionali komanda')
                    ->setValue($this->getFieldValue('isProfessional'))
            );
    }
}
