<?php

use Utils\Controller;
use Utils\Routing;
use Utils\Template;

session_start();
// nuskaitome konfigūracijų failą
require_once 'config.php';


$controller = new Controller();

$template = Template::getInstance();
$template->assign('module', Routing::getModule());
$template->assign('id', Routing::getId());
$template->render();

