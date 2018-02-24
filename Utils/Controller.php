<?php
namespace Utils;


use Controllers\BaseController;

class Controller
{

    public function __construct()
    {
        $module = Routing::getModule();
        $action = Routing::getAction();
        $controllerName = '\Controllers\\' . ucfirst($module) . 'Controller';

        /** @var BaseController $controller */
        $controller = new $controllerName();
        if (empty($action)) {
            $action = $controller->getDefaultAction();
        }

        $actionName = $action . 'Action';

        $controller->$actionName();
    }

}
