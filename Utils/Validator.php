<?php
namespace Utils;

/**
 * Pork Formvalidator. validates fields by regexes and can sanatize them. Uses PHP filter_var built-in functions and extra regexes 
 * @package pork
 */

use Form\BaseForm;
use Form\Field;


/**
 * Pork.FormValidator
 * Validates arrays or properties by setting up simple arrays
 * 
 * @package pork
 * @author SchizoDuckie
 * @copyright SchizoDuckie 2009
 * @version 1.0
 * @access public
 */
class Validator
{
    public $regexes = [
		'date' => "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$", // 2016-01-15
		'datetime' => "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}(:[0-9]{1,2})?\$", // 2016-01-15 12:12, 2016-01-15 12:12:00
		'positivenumber' => "^[0-9\.]+\$", // teigiami sveikieji skaičiai bei skaičiai su kableliu (pvz.: 25.14)
		'price' => "^([1-9][0-9]*|0)(\.[0-9]{2})?\$", // kaina (pvz.: 25.99)
		'anything' => "^[\d\D]{1,}\$", // bet koks simbolis
		'alfanum' => "^[0-9a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ ,.-_\\s\?\!]+\$", // tekstas
		'not_empty' => "[a-z0-9A-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ]+", // bet kokia reikšmė, kuri prasideda raide arba skaitmeniu
		'words' => "^[A-Za-ząčęėįšųūžĄČĘĖĮŠŲŪŽ]+[A-Za-ząčęėįšųūžĄČĘĖĮŠŲŪŽ \\s]*\$", // žodžiai
		'phone' => "^[0-9]{9,14}\$" // telefonas (pvz.: 860000000)
		/* BE ŠIŲ FORMATŲ DAR GALIMA NAUDOTI STANDARTINIUS:
		 * email,
		 * int,
		 * float,
		 * boolen,
		 * ip,
		 * url*/
    ];

    /**
     * @var array
     */
    private $fieldRenameMap = [
        'tire_id'               => 'tires_id',
        'weather_conditions_id' => 'weather_conditions',
        'drive_wheels_id'       => 'drive_wheels',
        'body_type_id'          => 'body_type'
    ];

    /**
     * @var Field[]
     */
    private $fields;

    /**
     * @param BaseForm[] $forms
     * @return bool
     */
    private function isEmbeddedFormBeingUsed($forms)
    {
        $used = false;
        if ($forms && count($forms) === 1) {
            foreach ($forms[0]->getFields() as $field) {
                if ($field->getValue()) {
                    $used = true;
                    break;
                }
            }
        } elseif (count($forms) > 1) {
            $used = true;
        }

        return $used;
    }

    /**
	 * Patikrinamas reikšių masyvas
     * @param BaseForm $form
	 * @return bool
	 */
    public function validate($form)
    {
        $this->fields = $form->getFields();
    	$haveFailures = false;

    	foreach ($this->fields as $field) {

            $result = $this->validateItem($field);
			if ($result === true && $field->getMaxLength()) {
                if (strlen($field->getValue()) > $field->getMaxLength()) {
                    $result = false;
                }
			}

			if ($result === false) {
				$haveFailures = true;
				$field->setHasError(true);
			}

			if ($field->getType() === BaseForm::FORM_TYPE && $field->getValue()) {
			    /** @var BaseForm $fieldForm */
                foreach ($field->getValue() as $fieldForm) {
			        if (!$fieldForm->isValid() && $this->isEmbeddedFormBeingUsed($field->getValue())) {
                        $haveFailures = true;
                        break;
                    }
                }
            }
    	}

    	return (!$haveFailures);
    }

    /**
	 * Pagal nurodytą tipą patikrinama viena reikšmė
	 * @param Field $field
	 * @return bool
	 */
    public function validateItem($field)
    {
        if (is_array($field->getValue()) || $field->getType() === BaseForm::FORM_TYPE) {
            return true;
        }

        $value = trim($field->getValue());

        if ($value && array_key_exists($field->getValidation(), $this->regexes)) {
            $return =  filter_var(
                $value,
                FILTER_VALIDATE_REGEXP,
                ["options" =>
                    [
                        "regexp" => '!' . $this->regexes[$field->getValidation()] . '!i'
                    ]
                ]) !== false;

            return ($return);
        }

        if ($field->isRequired() && strlen($value) === 0) {
            return false;
        }

        $filter = false;
        switch ($field->getValidation()) {
            case 'email':
                $value = substr($value, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;
                break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'float':
                $filter = FILTER_VALIDATE_FLOAT;
                break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
                break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
                break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
                break;
        }

        return ($filter === false) ? true : filter_var($value, $filter) !== false;
    }

    /**
     * @return array
     */
	public function preparePostFieldsForSQL()
    {
		$data = [];

		foreach ($this->fields as $field) {
		    if ($field->getType() === BaseForm::FORM_TYPE) {
		        continue;
            }

			$key = strtolower(preg_replace('@([A-Z])@', '_$1', $field->getName()));
			$key = $field->isForeignKey() ? $key . '_id' : $key;

            if (array_key_exists($key, $this->fieldRenameMap)) {
                $key = $this->fieldRenameMap[$key];
            }

			if ($field->getType() === BaseForm::CHECKBOX_TYPE) {
			    $field->setValue($field->getValue() === 'on' ? 1 : 0);
            }
            $value = strlen($field->getValue()) ? htmlentities($field->getValue()) : null;

			$data[strtolower($key)] = $value;
		}

		return $data;
	}
}
