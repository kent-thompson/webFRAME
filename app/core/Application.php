<?php
namespace App\core;

$InstanceMethod;                    // The 'Oddity'

class Application {
    protected $controller;          // = 'home'; // using the controller name for simplicity
    protected $controllerPath;      // file path to file
    // protected $action;           // = 'index';
    protected $params = [];
            
    public function __construct() {
        global $InstanceMethod;

        $this->setReqMethod();
        $this->parseURL();
        $this->invoke();
    }

    protected function setReqMethod() {
        // can add any number of other REST RM types like PUT, DELETE etc.
        $val = strtoupper($_SERVER['REQUEST_METHOD']);
        switch( $val ) {
            case 'GET':
                $this->params[0] = GET;    
                break;
            case 'POST':
                if( !empty($_POST) ) { 
                    $this->params[0] = POST;
                } else {
                    $GLOBALS['error_data'] = 'POST Request Sent With NO Data';
                    include_once VIEWS . '404.php';
                }
                break;
        }
    }

    protected function parseURL() {
        global $InstanceMethod;

        // controller and action paths and names are set
        $request = trim($_SERVER['REQUEST_URI'], '/');
        if( empty($request) ) {
            // first time with no querystring; ex: website.com = Default
            $this->controllerPath = CONTROLLER . 'home.php';
            $this->controller = 'App\\controller\\home';
            // $this->action = 'index';
            $InstanceMethod = 'index';
        } else {
            $url = parse_url( $request );
            $urlPath = explode( '/', $url['path'] );

            // based upon index position, we know controller / action-page / params
            if( count($urlPath) == 1 ) {
                $this->controllerPath = CONTROLLER . 'home.php';
                $this->controller = 'App\\controller\\home';
                // $this->action = $urlPath[0];
                $InstanceMethod = $urlPath[0];
            } else if( count($urlPath) > 1 ) {
                if( $urlPath[0] == 'api' ) {
                    $this->controllerPath = API . $urlPath[1] . '.php'; // now current controller PATH
                    $this->controller = "App\\api\\" . $urlPath[1];     // now current controller CLASS
                    // $this->action = $urlPath[2];                     // function
                    $InstanceMethod = $urlPath[2];
                } else {
                    $this->controllerPath = CONTROLLER . $urlPath[0] . '.php';  // now current controller
                    $this->controller = "App\\controller\\" . $urlPath[0];
                    // $this->action = $urlPath[1];                             // function
                    $InstanceMethod = $urlPath[1];
                }
            }
         }
    }

    protected function invoke() {
        global $InstanceMethod;

        // form of auto class loader from file path, controller class gets instantiated and action / function invoked
        if( file_exists( $this->controllerPath ) ) {    
            try {
                require_once $this->controllerPath;

                $this->controller = new $this->controller;
            } catch( \Exception $e ) {
                echo $e->getMessage(), __LINE__,'<br>';
                return;
            } catch( \Error $er) {
                echo $er->getMessage(), __LINE__,'<br>';
                return;
            }
        } else {
            $GLOBALS['error_data'] = 'Controller ' . $this->controller;
            include_once VIEWS . '404.php';
            return;
        }

        // function / "action" called
        if( method_exists($this->controller, $InstanceMethod) ) {
            try {
                // invoke an instance method
                //$instanceMethod = $this->action;

                $this->controller->$InstanceMethod( $this->params );    // The MAGIC
                // call_user_func_array( [$this->controller, $this->action], $this->params );
                
            } catch( \Exception $e ) {
                echo $e->getMessage(), __LINE__;
                return;
            } catch( \Error $er ) {
                echo $er->getMessage(), __LINE__;
                return;
            }
        } else {
            $classObj = new \ReflectionClass( $this->controller );
            echo 'ERROR: No '. $classObj->getName() . '\\' . $InstanceMethod . ' - Action Missing <br>';
        }
    }
}