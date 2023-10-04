<?php
// file paths
const DS = DIRECTORY_SEPARATOR;
const ROOT = __DIR__ . DS;
const APP = ROOT . 'app' . DS;
const CORE = APP . 'core'. DS;
const VIEWS = APP . 'views' . DS;
const MODEL = APP . 'model' . DS;
const DATABASE = APP . 'database' . DS;
const CONTROLLER = APP . 'controller' . DS;
const SERVICE = APP . 'service' . DS;
const API = APP . 'api' . DS;
const GLOSSY = ROOT . 'glossy2'. DS;

const GET = 1;
const POST = 2;

// xdebug_info();
// phpinfo();

require_once CORE . 'Application.php';

try {
	new App\core\Application;
} catch(\Exception $e ) {
	echo $e->getMessage(), __LINE__;
} catch( \Error $er) {
	echo $er->getMessage(), __LINE__;
}
