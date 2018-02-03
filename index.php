<?php
session_start();

// nuskaitome konfigūracijų failą
require_once 'config.php';

// iškviečiame prisijungimo prie duomenų bazės klasę
require_once 'Utils/Mysql.php';

require_once 'Utils/routing.class.php';
require_once 'Utils/controller.class.php';
require_once 'Utils/template.class.php';

$controller = new controller();

$template = template::getInstance();
$template->assign('module', routing::getModule());
$template->assign('id', routing::getId());
$template->render();

