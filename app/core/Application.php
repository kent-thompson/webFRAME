<?php
namespace App\core;

$gAction;

class Application {
    protected $controller;          // current controller object
    protected $controllerPath;      // file path to file
    // protected $action;           // = 'index';
    protected $params = [];


    public function __construct() {
        $this->setReqMethod();
        $this->parseURL();
        $this->invokeClass();
        $this->invokeMethod();
    }


    protected function setReqMethod() {
        // can add any number of other REST RM types like PUT, DELETE etc.
        $val = strtoupper( $_SERVER['REQUEST_METHOD'] );
        switch( $val ) {
            case 'GET':
                $this->params[0] = GET;
                break;
            case 'POST':
                    $this->params[0] = POST;
                break;
        }
    }


    protected function parseURL() {
        global $gAction;
        // controller and action paths and names are set

        $request = trim( $_SERVER['REQUEST_URI'], '/' );
        if( empty($request) ) {
            // by convention, if no querystring; ex: web-app.com uses default: home controller and index action
            $this->controllerPath = CONTROLLER . 'home.php';
            $this->controller = 'App\\controller\\home';
            // $this->action = 'index';
            $gAction = 'index';
            return;
        }

       $url = parse_url( $request );
       $urlPath = explode( '/', $url['path'] );
        // by convention, if only one element, it's a home page action - see views/sidebar
        if( count($urlPath) == 1 ) {
            $this->controllerPath = CONTROLLER . 'home.php';
            $this->controller = 'App\\controller\\home';
            // $this->action = $urlPath[0];
            $gAction = $urlPath[0];
            return;
        }

        // based upon index position, we know api, non-api / controller / action-page / params
        if( count($urlPath) > 1 ) {
            if( $urlPath[0] == 'api' ) {
                $this->controllerPath = API . $urlPath[1] . '.php'; // now current controller PATH
                $this->controller = "App\\api\\" . $urlPath[1];     // now current controller CLASS
                // $this->action = $urlPath[2];                     // method / function
                $gAction = $urlPath[2];
            } else {
                $this->controllerPath = CONTROLLER . $urlPath[0] . '.php';  // now current controller
                $this->controller = "App\\controller\\" . $urlPath[0];      // now current controller CLASS
                // $this->action = $urlPath[1];                             // method / function
                $gAction = $urlPath[1];
            }
        }
    }


    protected function invokeClass() {
 
        // auto class loader from file path, controller class gets instantiated and action / function invoked
        if( file_exists($this->controllerPath) ) {
            try {
                require_once $this->controllerPath;
                $this->controller = new $this->controller( $this->params );

            } catch( \Exception $e ) {
                $this->displayProblem( 'Exception: ' . $e->getMessage(), __FILE__, __LINE__ );
                return false;
            } catch( \Error $er ) {
                $isErrror = true;                
                $this->displayProblem( 'Error: ' . $er->getMessage(), __FILE__, __LINE__ );
                return false;
            }
        } else {
            $this->displayProblem( 'Error: Controller ' . $this->controller . ' Missing', __FILE__, __LINE__ );
             return false;
        }
    }


    protected function invokeMethod() {
        global $gAction;
        // function / "action" called

        if( method_exists($this->controller, $gAction) ) {
            try {
                // invoke an instance method
                // call_user_func_array( [$this->controller, $this->action], $this->params ); DO NOT become Emotionally invested in your code. This allows discussion and rapid change.
                // $gAction = $this->action; ugh...

                    $this->controller->$gAction( $this->params );    // The MAGIC

            } catch( \Exception $e ) {
                $this->displayProblem( 'Exception: ' . $e->getMessage(), __FILE__, __LINE__ );
                return false;
            } catch( \Error $er ) {
                $this->displayProblem( 'Error: ' . $er->getMessage(), __FILE__, __LINE__ );
                return false;
            }
        } else {
            $classObj = new \ReflectionClass( $this->controller );
            $this->displayProblem( 'Error: ' . $classObj->getName() . '\\' . $gAction . ' Missing',  __FILE__, __LINE__ );
            return false;
        }
        return true;
    }

    public function displayProblem( $msg, $file, $line ) {
        require_once SERVICE . 'ErrorHandler.php';
        \App\service\Call404( $msg, $file, $line );
    }
}