<?php
namespace App\core;

$InstanceMethod;

class Application {
    protected $controller;          // current controller object
    protected $controllerPath;      // file path to file
    // protected $action;           // = 'index';
    protected $params = [];
            
    public function __construct() {
        $this->setReqMethod();
        $this->parseURL();
        $this->invoke();
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
        global $InstanceMethod;
        // controller and action paths and names are set

        $request = trim( $_SERVER['REQUEST_URI'], '/' );
        if( empty($request) ) {
            // by convention, if no querystring; ex: web-app.com uses default: home controller and index action
            $this->controllerPath = CONTROLLER . 'home.php';
            $this->controller = 'App\\controller\\home';
            // $this->action = 'index';
            $InstanceMethod = 'index';
            return;
        }

       $url = parse_url( $request );
       $urlPath = explode( '/', $url['path'] );
        // by convention, if only one element, it's a home page action - see views/sidebar
        if( count($urlPath) == 1 ) {
            $this->controllerPath = CONTROLLER . 'home.php';
            $this->controller = 'App\\controller\\home';
            // $this->action = $urlPath[0];
            $InstanceMethod = $urlPath[0];
            return;
        }

        // based upon index position, we know api, non-api / controller / action-page / params
        if( count($urlPath) > 1 ) {
            if( $urlPath[0] == 'api' ) {
                $this->controllerPath = API . $urlPath[1] . '.php'; // now current controller PATH
                $this->controller = "App\\api\\" . $urlPath[1];     // now current controller CLASS
                // $this->action = $urlPath[2];                     // method / function
                $InstanceMethod = $urlPath[2];
            } else {
                $this->controllerPath = CONTROLLER . $urlPath[0] . '.php';  // now current controller
                $this->controller = "App\\controller\\" . $urlPath[0];      // now current controller CLASS
                // $this->action = $urlPath[1];                             // method / function
                $InstanceMethod = $urlPath[1];
            }
        }
    }


    protected function invoke() {
        global $InstanceMethod;

        // auto class loader from file path, controller class gets instantiated and action / function invoked
        if( file_exists($this->controllerPath) ) {
            try {
                require_once $this->controllerPath;
                $this->controller = new $this->controller( $this->params );

            } catch( \Exception $e ) {
                require_once SERVICE . 'ErrorHandler.php';
                \App\service\Call404( 'Exception: ' . $e->getMessage(), __FILE__, __LINE__ );
                return;
            } catch( \Error $er ) {
                require_once SERVICE . 'ErrorHandler.php';
                \App\service\Call404( 'Error: ' . $er->getMessage(), __FILE__, __LINE__ );
                return;
            }
        } else {
            require_once SERVICE . 'ErrorHandler.php';
            \App\service\Call404( 'Error: Controller ' . $this->controller . ' Missing', __FILE__, __LINE__ );
            return;
        }

        // function / "action" called
        if( method_exists($this->controller, $InstanceMethod) ) {
            try {
                // invoke an instance method
                // call_user_func_array( [$this->controller, $this->action], $this->params ); DO NOT become Emotionally invested in your code. This allows discussion and rapid change.
                // $instanceMethod = $this->action; ugh...

                $this->controller->$InstanceMethod( $this->params );    // The MAGIC

            } catch( \Exception $e ) {
                require_once SERVICE . 'ErrorHandler.php';
                \App\service\Call404( 'Exception: ' . $e->getMessage(), __FILE__, __LINE__ );
                return;
            } catch( \Error $er ) {
                require_once SERVICE . 'ErrorHandler.php';
                \App\service\Call404( 'Error: ' . $er->getMessage(), __FILE__, __LINE__ );
                return;
            }
        } else {
            $classObj = new \ReflectionClass( $this->controller );
            $data = 'Error: ' . $classObj->getName() . '\\' . $InstanceMethod . ' Missing';
            require_once SERVICE . 'ErrorHandler.php';
            \App\service\Call404( $data, __FILE__, __LINE__ );
        }
    }
}