<?php
namespace App\api;
require_once CORE . 'ControllerBase.php';
require_once MODEL . 'user.php';

require_once 'vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class User extends \App\core\ControllerBase {
    private $model;

	public function __construct() {
        header("Content-Type: application/json");
        try {
            $this->model = new \App\model\User; // note the 'root' \ global call path
        } catch( \Exception $e ) {
            echo $e->getMessage(), __LINE__,'<br>';
            return;
        } catch( \Error $er) {
            echo $er->getMessage(), __LINE__,'<br>';
            return;
        }
        #region \App\service\User
        // try {
        //     $this->userService = new \App\service\User;
        // } catch( \Exception $e ) {
        //     echo $e->getMessage(), __LINE__,'<br>';
        // } catch( \Error $er) {
        //     echo $er->getMessage(), __LINE__,'<br>';
        // }
        #endregion     
	}

    public function getAllUsers() {
        parent::AuthApi();

        $data = [];
        $this->model->getAllUsers( $data );
        echo json_encode( $data );
    }

    public function getUser( $reqInfo ) {
        parent::AuthApi();
        if( $reqInfo[0] == POST ) {

            $id = $_POST['docid'];
            $data = [];
            $this->model->getUserByID( $id, $data );
            echo json_encode( $data );

            //$data = [ 'color' => 'red', 'style' => 'obtuse'];
            //$this->setPayload( $data );
        }
    }

    public function addUser( $reqInfo ) {
        parent::AuthApi();

        // TODO use service layer to validate request
        if( $reqInfo[0] == POST ) {
            $ret = $this->model->createUser();
            echo json_encode( $ret );
        }
    }

    public function updateUser( $reqInfo ) {
        parent::AuthApi();
        
        if( $reqInfo[0] == POST ) {
            $id = $_POST['docid'];
            //$fname = $_POST['fname'];
            //$lname = $_POST['lname'];
            $ret = $this->model->updateUserByID( $id );
            echo json_encode( $ret );
        }
    }

    public function deleteUserById( $reqInfo ) {
        parent::AuthApi();
        if( $reqInfo[0] == POST ) {
            $id = $_POST['docid'];

            // $data = [];
            $rslt = $this->model->deleteUserByID( $id );
            echo json_encode( $rslt );
        }
    }

    public function login( $reqInfo ) {
        if( $reqInfo[0] == POST ) {
            $uname = trim($_POST['uname']);
            $pwd = trim($_POST['psw']);

            $data = [];
            $this->model->getUserByName( $uname, $data );  // $data passed as an OUT param            

            // compare passwords
            $rslt = password_verify( $pwd, $data['Password'] );
            if( $rslt == false ) {
                $GLOBALS['error_data'] = 'Incorrect Login Data';
                include_once VIEWS . '404.php';
                return;
            }

            $payload = [
                'iat' => time(),
                'exp' => time() + 60*60*4, // + 4 hours
                'role' => 'user',
                'ID' => $data['UserID'],
                'UserName' => $data['UserName']
            ];

            // send back jwt
            try {
                $jwt = JWT::encode($payload, $this->secretKey, 'HS256');
            } catch( \Exception $e ) {
                echo $e->getMessage(), __LINE__,'<br>';
                return false;
            } catch( \Error $er) {
                echo $er->getMessage(), __LINE__,'<br>';
                return false;
            }                    
            header( 'Authorization: Bearer ' . $jwt );
            echo '{}';
        }
    }
}