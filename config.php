<?php
require_once 'init.php';
define('DB_SERVER', 'localhost');
define('DB_NAME', 'auto_laboras');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_PREFIX', '');

define('NUMBER_OF_ROWS_IN_PAGE', 10);

define('DEFAULT_CONTROLLER', 'index');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);