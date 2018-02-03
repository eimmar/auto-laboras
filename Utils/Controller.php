<?php
namespace Utils;


class Controller
{

  public function __construct() {
    // Select and launch the correct Controller and action
    $module = Routing::getModule();
    $action = Routing::getAction();

    $controllerName = '\Controllers\\' . ucfirst($module) . 'Controller';
    if (empty($action))
      $action = $controllerName::$defaultAction;

    $actionName = $action . 'Action';

    $controller = new $controllerName();
    $controller->$actionName();
  }

};

