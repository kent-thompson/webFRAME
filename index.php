<?php
// file paths
const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__ . DS;
const APP = ROOT . 'app' . DS;
const CORE = APP . 'core'. DS;
const VIEWS = APP . 'views' . DS;
const MODEL = APP . 'model' . DS;
const DATABASE = ROOT . DS . 'database' . DS;
const CONTROLLER = APP . 'controller' . DS;
const SERVICE = APP . 'service' . DS;
const API = APP . 'api' . DS;
const GLOSSY = ROOT . 'glossy2'. DS;

// can add any number of other REST RM types like PUT, DELETE etc
const GET = 1;
const POST = 2;

// xdebug_info();
// phpinfo();

require_once CORE . 'Application.php';

try {
    new App\core\Application;
} catch( \Exception $e ) {
    require_once SERVICE . 'ErrorHandler.php';
    \App\service\Call404( 'Exception: ' . $e->getMessage(), __FILE__, __LINE__ );
} catch( \Error $er ) {
    require_once SERVICE . 'ErrorHandler.php';
    \App\service\Call404( 'Error: ' . $er->getMessage(), __FILE__, __LINE__ );
}
