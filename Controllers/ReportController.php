<?php
namespace Controllers;

use Model\Contracts;
use Model\Services;
use Utils\Routing;
use Utils\Template;
use Utils\Validator;

class ReportController extends BaseController
{
    /**
     * @var array
     */
    private $reports;

    public function __construct()
    {
        $namespace = explode('\\', get_class($this));
        $this->setControllerPrefix(strtolower(str_replace('Controller', '', end($namespace))))
            ->setDefaultAction('index');

        $this->reports = [
            1 => [
                "title" => "Užsakytų paslaugų ataskaita",
                "description" => "Per laikotarpį užsakytų papildomų paslaugų ataskaita.",
                "reportName" => "ServiceReport"
            ],
            2 => [
                "title" => "Vėluojamų grąžinti automobilių ataskaita",
                "description" => "Negrąžintų arba pavėluotai grąžintų automobilių ataskaita.",
                "reportName" => "DelayedCarsReport"
            ]
        ];
    }

    public function indexAction()
    {
        $template = Template::getInstance();
        $template->setView("reportIndex");
        $template->assign("reports", $this->reports);
    }

    public function viewAction()
    {
        $id = Routing::getId();
        if (!empty($this->reports[$id])) {
            $report = '\Report\\' . $this->reports[$id]["reportName"];

            $rC = new $report();
            if (!empty($_POST['submit'])) {
                $rC->showResult();
            } else {
                $rC->showForm();
            }
        } else {

            die("Report {$id} not found!");
        }
    }
}
