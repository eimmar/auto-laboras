<?php
namespace Controllers;

use Model\Contracts;
use Model\Services;
use Utils\Routing;
use Utils\Template;
use Utils\Validator;

class ReportController
{
  public static $defaultAction = "index";

  // List all the available reports
  private static $reports = array(
    1 => array(
      "title" => "Sutarčių ataskaita",
      "description" => "Per laikotarpį sudarytų sutarčių ataskaita.",
      "reportName" => "ContractReport"
    ),

    2 => array(
      "title" => "Užsakytų paslaugų ataskaita",
      "description" => "Per laikotarpį užsakytų papildomų paslaugų ataskaita.",
      "reportName" => "ServiceReport"
    ),

    3 => array(
      "title" => "Vėluojamų grąžinti automobilių ataskaita",
      "description" => "Negrąžintų arba pavėluotai grąžintų automobilių ataskaita.",
      "reportName" => "DelayedCarsReport"
    )
  );

  public function indexAction() {
    $template = Template::getInstance();
    $template->setView("reportIndex");

    $template->assign("reports", self::$reports);
  }

  public function viewAction() {

    // Find out which report are we working with
    $id = Routing::getId();
    if (!empty(self::$reports[$id])) {
      $report = '\Report\\' . self::$reports[$id]["reportName"];

      $rC = new $report();
      if (!empty($_POST['submit'])) {
        $rC->showResult();
      } else {
        $rC->showForm();
      }
    } else {
      //error, report not found
      die("Report {$id} not found!");
    }
  }
}

