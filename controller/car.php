<?php
require_once 'Utils/paging.class.php';
require_once 'Utils/validator.class.php';
require_once 'Model/Cars.php';
require_once 'Model/Brands.php';
require_once 'Model/Models.php';


class carController {

  public static $defaultAction = "list";

  // nustatome privalomus laukus
  private $required = array('modelis', 'valstybinis_nr', 'pagaminimo_data', 'pavaru_deze', 'degalu_tipas', 'kebulas', 'bagazo_dydis', 'busena', 'rida', 'vietu_skaicius', 'registravimo_data', 'verte');

  // maksimalūs leidžiami laukų ilgiai
  private $maxLengths = array (
    'valstybinis_nr' => 6
  );

  // nustatome laukų validatorių tipus
  private $validations = array (
    'modelis' => 'positivenumber',
    'valstybinis_nr' => 'alfanum',
    'pavaru_deze' => 'positivenumber',
    'degalu_tipas' => 'positivenumber',
    'kebulas' => 'positivenumber',
    'bagazo_dydis' => 'positivenumber',
    'busena' => 'positivenumber',
    'pagaminimo_data' => 'date',
    'rida' => 'positivenumber',
    'vietu_skaicius' => 'positivenumber',
    'registravimo_data' => 'date',
    'verte' => 'price'
  );

  public function listAction() {
    // suskaičiuojame bendrą įrašų kiekį
    $elementCount = Cars::getCarListCount();

    // sukuriame puslapiavimo klasės objektą
    $paging = new paging(NUMBER_OF_ROWS_IN_PAGE);

    // suformuojame sąrašo puslapius
    $paging->process($elementCount, routing::getPageId());

    // išrenkame nurodyto puslapio markes
    $data = Cars::getCarList($paging->size, $paging->first);

    $template = template::getInstance();

    $template->assign('data', $data);
    $template->assign('pagingData', $paging->data);

    if(!empty($_GET['delete_error']))
      $template->assign('delete_error', true);

    if(!empty($_GET['id_error']))
      $template->assign('id_error', true);

    $template->setView("car_list");
  }

  public function createAction() {
    $data = $this->validateInput();
    // If entered data was valid
    if ($data) {
      // Find max ID in the database
      $latestId = Cars::getMaxIdOfCar();
      // Increment it by one
      $data['id'] = $latestId + 1;

      // Insert row into database
      Cars::insertCar($data);

      // Redirect back to the list
      routing::redirect(routing::getModule(), 'list');
    } else {
      $this->showForm();
    }
  }

  public function editAction() {
    $id = routing::getId();

    $car = Cars::getCar($id);
    if ($car == false) {
      routing::redirect(routing::getModule(), 'list', 'id_error=1');
      return;
    }

    // Fill form fields with current data
    $template = template::getInstance();
    $template->assign('fields', $car);

    $data = $this->validateInput();
    // If Entered data was valid
    if ($data) {
      $data['id'] = $id;

      // Update it in DataBase
      Cars::updateCar($data);

      // Redirect back to the list
      routing::redirect(routing::getModule(), 'list');
    } else {
      $this->showForm();
    }
  }

  private function showForm() {
    $template = template::getInstance();

    $brandsModels = models::getBrandsAndModels();
    $gearboxes = Cars::getGearboxList();
    $fueltypes = Cars::getFuelTypeList();
    $bodytypes = Cars::getBodyTypeList();
    $luggage = Cars::getLuggageTypeList();
    $car_states = Cars::getCarStateList();

    $template->assign('brandsModels', $brandsModels);
    $template->assign('gearboxes', $gearboxes);
    $template->assign('fueltypes', $fueltypes);
    $template->assign('bodytypes', $bodytypes);
    $template->assign('luggage', $luggage);
    $template->assign('car_states', $car_states);

    $template->assign('required', $this->required);
    $template->assign('maxLengths', $this->maxLengths);
    $template->setView("car_form");
  }

  private function validateInput() {
    // Check if we even have any input
    if (empty($_POST['submit'])) {
      return false;
    }

    // Create Validator object
    $validator = new validator($this->validations,
      $this->required, $this->maxLengths);

    if(!$validator->validate($_POST)) {
      $template = template::getInstance();

      // Overwrite fields array with submitted $_POST values
      $template->assign('fields', $_POST);

      // Get error message
      $formErrors = $validator->getErrorHTML();
      $template->assign('formErrors', $formErrors);
      return false;
    }

    // Prepare data array to be entered into SQL DB
    $data = $validator->preparePostFieldsForSQL();

    // Fix checkbox values
    $data['radijas'] = (!empty($data['radijas']) && $data['radijas'] == 'on') ? 1 : 0;

    $data['grotuvas'] = (!empty($data['grotuvas']) && $data['grotuvas'] == 'on') ? 1 : 0;

    $data['kondicionierius'] =  (!empty($data['kondicionierius']) && $data['kondicionierius'] == 'on') ? 1 : 0;
    return $data;
  }

  public function deleteAction() {
    $id = routing::getId();

    // pašaliname automobilį
    $err = (Cars::deleteCar($id)) ? '' : 'delete_error=1';

    // nukreipiame į automobilių puslapį
    routing::redirect(routing::getModule(), 'list', $err);
  }

};

