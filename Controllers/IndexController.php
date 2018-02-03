<?php
namespace Controllers;

use Utils\Template;

class IndexController
{
    public static $defaultAction = "index";

    public function indexAction()
    {
        Template::getInstance()->setView('index');
    }
}

