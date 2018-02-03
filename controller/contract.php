<?php


use Model\Contracts;

require_once 'Utils/paging.class.php';
require_once 'Utils/validator.class.php';
require_once 'Model/Cars.php';
require_once 'Model/Customers.php';
require_once 'Model/Employees.php';
require_once 'Model/Services.php';


class contractController {

  public static $defaultAction = "list";

  // nustatome privalomus laukus
  private $required = array('nr', 'sutarties_data', 'nuomos_data_laikas', 'planuojama_grazinimo_data_laikas', 'pradine_rida', 'kaina', 'degalu_kiekis_paimant', 'busena', 'fk_klientas', 'fk_darbuotojas', 'fk_automobilis', 'fk_grazinimo_vieta', 'fk_paemimo_vieta', 'kiekiai');

  // nustatome laukų validatorių tipus
  private $validations = array (
    'nr' => 'positivenumber',
    'sutarties_data' => 'date',
    'nuomos_data_laikas' => 'datetime',
    'planuojama_grazinimo_data_laikas' => 'datetime',
    'faktine_grazinimo_data_laikas' => 'datetime',
    'pradine_rida' => 'int',
    'galine_rida' => 'int',
    'kaina' => 'price',
    'degalu_kiekis_paimant' => 'int',
    'dagalu_kiekis_grazinus' => 'int',
    'busena' => 'positivenumber',
    'fk_klientas' => 'alfanum',
    'fk_darbuotojas' => 'alfanum',
    'fk_automobilis' => 'positivenumber',
    'fk_grazinimo_vieta' => 'positivenumber',
    'fk_paemimo_vieta' => 'positivenumber',
    'kiekiai' => 'int'
  );

  public function listAction() {
    // suskaičiuojame bendrą įrašų kiekį
    $elementCount = Model\Contracts::getContractListCount();

    // sukuriame puslapiavimo klasės objektą
    $paging = new paging(NUMBER_OF_ROWS_IN_PAGE);

    // suformuojame sąrašo puslapius
    $paging->process($elementCount, routing::getPageId());

    // išrenkame nurodyto puslapio markes
    $data = Contracts::getContractList($paging->size, $paging->first);

    $template = template::getInstance();

    $template->assign('data', $data);
    $template->assign('pagingData', $paging->data);

    if(!empty($_GET['id_error']))
      $template->assign('id_error', true);

    $template->setView("contract_list");
  }

  public function createAction() {
    $data = $this->validateInput();
    // If entered data was valid
    if ($data) {
      // Insert row into database
      if (Contracts::insertContract($data)) {
        // Enter ordered services into database
        Contracts::updateOrderedServices($data);

        // Redirect back to the list
        routing::redirect(routing::getModule(), 'list');
      } else {
        // Overwrite fields array with submitted $_POST values
        $template = template::getInstance();
        $template->assign('fields', $_POST);
        $template->assign('formErrors', "Duplicate ID!");
        $this->showForm();
      }
    } else {
      $this->showForm();
    }
  }

  public function editAction() {
    $id = routing::getId();

    $contract = Contracts::getContract($id);
    if ($contract == false) {
      routing::redirect(routing::getModule(), 'list', 'id_error=1');
      return;
    }
    $contract['uzsakytos_paslaugos'] = Contracts::getOrderedServices($id);

    $template = template::getInstance();
    $template->assign('fields', $contract);

    $data = $this->validateInput();
    // If Entered data was valid
    if ($data) {
      $data['nr'] = $id;

      // Update it in database
      Contracts::updateContract($data);

      // Update ordered services
      Contracts::updateOrderedServices($data);

      // Redirect back to the list
      routing::redirect(routing::getModule(), 'list');
    } else {
      $this->showForm();
    }
  }

  private function showForm() {
    $template = template::getInstance();
    $services = services::getPricedServices();
    $template->assign('services', $services);

    $template->assign('customerList', customers::getCustomersList());
    $template->assign('employeesList', employees::getEmployeesList());
    $template->assign('contractStates', Contracts::getContractStates());
    $template->assign('carsList', Cars::getCarList());
    $template->assign('parkingLots', Contracts::getParkingLots());
    $template->assign('required', $this->required);

    $template->setView("contract_form");
  }

  private function validateInput() {
    // Check if we even have any input
    if (empty($_POST['submit'])) {
      return false;
    }

    // Create Validator object
    $validator = new validator($this->validations, $this->required);
    if(!$validator->validate($_POST)) {
      // laukų reikšmių kintamajam priskiriame įvestų laukų reikšmes
      $fields = $_POST;

      if(!empty($_POST['kiekiai'])) {
        foreach(array_values($_POST['kiekiai']) as $key => $val) {
          $fields['uzsakytos_paslaugos'][$key]['kiekis'] = $val;
        }
      }
      $template = template::getInstance();
      $template->assign('fields', $fields);
      $formErrors = $validator->getErrorHTML();
      $template->assign('formErrors', $formErrors);
      return false;
    }

    // Prepare data array to be entered into SQL DB
    $data = $validator->preparePostFieldsForSQL();
    return $data;
  }

  public function deleteAction() {
    $id = routing::getId();

    // pašaliname užsakytas paslaugas
    Contracts::deleteOrderedServices($id);

    // šaliname sutartį
    Contracts::deleteContract($id);

    // nukreipiame į sutarčių puslapį
    routing::redirect(routing::getModule(), 'list');
  }

};

