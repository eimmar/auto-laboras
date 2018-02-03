<?php
require_once 'Utils/template.class.php';

class indexController {
  public static $defaultAction = "index";

  public function indexAction() {
    template::getInstance()->setView('index');
  }
}

