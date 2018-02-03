<?php
namespace Report;

use Model\Contracts;
use Utils\Template;
use Utils\Validator;

/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 21.08
 */

class DelayedCarsReport {

    // nustatome laukų validatorių tipus
    private  $validations = array (
        'dataNuo' => 'date',
        'dataIki' => 'date'
    );

    public function showForm() {
        Template::getInstance()->setView("delayed_cars_report_form");
    }

    /**
     *
     */
    public function showResult() {
        $template = Template::getInstance();

        // sukuriame validatoriaus objektą
        $validator = new Validator($this->validations);

        if($validator->validate($_POST)) {
            // suformuojame laukų reikšmių masyvą SQL užklausai
            $data = $validator->preparePostFieldsForSQL();

            // išrenkame ataskaitos duomenis
            $delayedCarsData = Contracts::getDelayedCars($data['dataNuo'], $data['dataIki']);

            $template->assign("delayedCarsData", $delayedCarsData);
            $template->assign("data", $data);

            $template->setView("delayed_cars_report");
        } else {

            $this->showForm();

            // gauname klaidų pranešimą
            $formErrors = $validator->getErrorHTML();

            // gauname įvestus laukus
            $fields = $_POST;

            $template->assign("formErrors", $formErrors);
            $template->assign("fields", $fields);
        }
    }
}