<?php
namespace Controllers;

use Utils\Template;

class IndexController
{
    /**
     * @var string
     */
    private $defaultAction = "index";

    /**
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }
    public function indexAction()
    {
        Template::getInstance()->setView('index');
    }
}
