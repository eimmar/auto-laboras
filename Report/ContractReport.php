<?php
namespace Report;

use Model\Contracts;
use Utils\Template;
use Utils\Validator;

/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 21.11
 */

class ContractReport
{

    // nustatome laukų validatorių tipus
    private  $validations = array (
        'dataNuo' => 'date',
        'dataIki' => 'date'
    );

    public function showForm() {
        Template::getInstance()->setView("contract_report_form");
    }

    public function showResult() {
        $template = Template::getInstance();

        // sukuriame validatoriaus objektą
        $validator = new Validator($this->validations);

        if($validator->validate($_POST)) {
            // suformuojame laukų reikšmių masyvą SQL užklausai
            $data = $validator->preparePostFieldsForSQL();

            // išrenkame ataskaitos duomenis
            $contractData = Contracts::getCustomerContracts($data['dataNuo'], $data['dataIki']);
            $totalPrice = Contracts::getSumPriceOfContracts($data['dataNuo'], $data['dataIki']);
            $totalServicePrice = Contracts::getSumPriceOfOrderedServices($data['dataNuo'], $data['dataIki']);

            $template->assign("data", $data);
            $template->assign("contractData", $contractData);
            $template->assign("totalPrice", $totalPrice);
            $template->assign("totalServicePrice", $totalServicePrice);

            $template->setView("contract_report");
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
