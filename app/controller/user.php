<?php
namespace App\controller;
require_once CORE . 'ControllerBase.php';
require_once MODEL . 'user.php';

require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// SERVER SIDE RENDER
class User extends \App\core\ControllerBase {
    private $model;

	public function __construct() {
        //parent::__construct();
        try {
            $this->model = new \App\model\User; // note the 'root' \ global call path
        } catch( \Exception $e ) {
            echo $e->getMessage(), __LINE__,'<br>';
            return false;
        } catch( \Error $er) {
            echo $er->getMessage(), __LINE__,'<br>';
            return false;
        }        
        // try {
        //     $this->userService = new \App\service\User;
        // } catch( \Exception $e ) {
        //     echo $e->getMessage(), __LINE__,'<br>';
        // } catch( \Error $er) {
        //     echo $er->getMessage(), __LINE__,'<br>';
        // }        

	}

    public function getAllUsers( $reqInfo ) {
        parent::AuthUI();

        $data = [];
        $this->model->getAllUsers( $data );
        
        // load HTML table and render
        // foreach ($data as $row) {
        //     echo $row['UserID'] .' '. $row['FirstName'] .' '. $row['LastName'] . '<br>';
        // }
    }

	public function getUserForm( $reqInfo ) {
        require_once VIEWS . 'head_begin.php';
        require_once VIEWS . 'top_content.php';
        require_once VIEWS . 'sidebar.php';
        if( $reqInfo[0] == GET ) {
            require_once VIEWS . 'userForm.php';
        }
        // if( $reqInfo[0] == POST ) {
        //     //$id = $_POST['id'];
        //     $uname = $_POST['uname'];
            
        //     $data = [];
        //     $this->model->getUserByName( $uname, $data );  // $data passed as an OUT param
        //     // load HTML form and render
        // }
        require_once VIEWS . 'footer.php';
	}

    public function updateUser( $reqInfo ) {
        parent::AuthUI();
        if( $reqInfo[0] == POST ) {

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $data = [];
            $this->model->getUserByID( $id, $data );
            //echo json_encode( $data );
            // fill out form and send back
        }
    }
}//class
