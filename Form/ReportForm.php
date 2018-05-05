<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.5.5
 * Time: 13.04
 */

namespace Form;


class ReportForm extends BaseForm
{
    /**
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildForm()
    {
        return $this
            ->setName('Ataskaita')
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('dateFrom')
                    ->setLabel('Nuo')
                    ->setValue($this->getFieldValue('dateFrom'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            )
            ->addField(
                (new Field())
                    ->setType(BaseForm::TEXT_TYPE)
                    ->setMaxLength(10)
                    ->setName('dateTo')
                    ->setLabel('iki')
                    ->setValue($this->getFieldValue('dateTo'))
                    ->setClass('date')
                    ->setIsRequired(true)
                    ->setValidation('date')
            );
    }
}
