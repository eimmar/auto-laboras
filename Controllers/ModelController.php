<?php
namespace Controllers;

use Model\Brands;
use Model\Models;
use Utils\Paging;
use Utils\Routing;
use Utils\Template;
use Utils\Validator;

class ModelController
{

  public static $defaultAction = "list";

  // nustatome privalomus laukus
  private $required = array('pavadinimas', 'fk_marke');

  // maksimalūs leidžiami laukų ilgiai
  private $maxLengths = array ('pavadinimas' => 20);

  // nustatome laukų validatorių tipus
  private $validations = array (
    'pavadinimas' => 'anything',
    'fk_marke' => 'positivenumber'
  );

  public function listAction() {
    // suskaičiuojame bendrą įrašų kiekį
    $elementCount = Models::getModelListCount();

    // sukuriame puslapiavimo klasės objektą
    $paging = new Paging(NUMBER_OF_ROWS_IN_PAGE);

    // suformuojame sąrašo puslapius
    $paging->process($elementCount, Routing::getPageId());

    // išrenkame nurodyto puslapio markes
    $data = models::getModelList($paging->size, $paging->first);

    $template = Template::getInstance();

    $template->assign('data', $data);
    $template->assign('pagingData', $paging->data);

    if(!empty($_GET['delete_error']))
      $template->assign('delete_error', true);

    if(!empty($_GET['id_error']))
      $template->assign('id_error', true);

    $template->setView("model_list");
  }

  public function createAction() {
    $data = $this->validateInput();
    // If entered data was valid
    if ($data) {
      // Find max ID in the database
      $latestId = models::getMaxIdOfModel();
      // Increment it by one
      $data['id'] = $latestId + 1;

      // Insert row into database
      models::insertModel($data);

      // Redirect back to the list
      Routing::redirect(Routing::getModule(), 'list');
    } else {
      $this->showForm();
    }
  }

  public function editAction() {
    $id = Routing::getId();

    $model = models::getModel($id);
    if ($model == false) {
      Routing::redirect(Routing::getModule(), 'list', 'id_error=1');
      return;
    }

    // Fill form fields with current data
    $template = Template::getInstance();
    $template->assign('fields', $model);

    $data = $this->validateInput();
    // If Entered data was valid
    if ($data) {
      $data['id'] = $id;

      // Update it in database
      models::updateModel($data);

      // Redirect back to the list
      Routing::redirect(Routing::getModule(), 'list');
    } else {
      $this->showForm();
    }
  }

  private function showForm() {
    $template = Template::getInstance();
    $template->assign('Brands', Brands::getBrandList());
    $template->assign('required', $this->required);
    $template->assign('maxLengths', $this->maxLengths);
    $template->setView("model_form");
  }

  private function validateInput() {
    // Check if we even have any input
    if (empty($_POST['submit'])) {
      return false;
    }

    // Create Validator object
    $validator = new Validator($this->validations,
      $this->required, $this->maxLengths);

    if(!$validator->validate($_POST)) {
      $template = Template::getInstance();

      // Overwrite fields array with submitted $_POST values
      $template->assign('fields', $_POST);

      // Get error message
      $formErrors = $validator->getErrorHTML();
      $template->assign('formErrors', $formErrors);
      return false;
    }

    // Prepare data array to be entered into SQL DB
    $data = $validator->preparePostFieldsForSQL();
    return $data;
  }

  public function deleteAction() {
    $id = Routing::getId();

    // remove Model
    $err = (models::deleteModel($id)) ? '' : 'delete_error=1';

    // redirect back to list page
    Routing::redirect(Routing::getModule(), 'list', $err);
  }

};

