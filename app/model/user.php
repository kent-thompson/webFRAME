<?php
namespace App\model;
require_once CORE . 'Database.php';

class User {
    private $db;
    private $pdo;

    public function __construct() {
        try {
            $this->db = new \App\core\Database;
            $this->pdo = $this->db->connect();
        } catch( \Exception $e ) {
            echo $e->getMessage(), __LINE__,'<br>';
        } catch( \Error $er ) {
            echo $er->getMessage(), __LINE__,'<br>';
        }        
    }

    
    public function createUser( &$user ) {
        $user->password = password_hash( $user->password, PASSWORD_DEFAULT );
        //$sql = "INSERT INTO Users ( UserName, FirstName, LastName, Birthday, Email, Password ) VALUES( '$user->uname', '$user->firstName', '$user->lastName', '$user->birthday', '$user->email', '$user->password' )";

        try {
        $stmt = $this->pdo->prepare("INSERT INTO Users (UserName, FirstName, LastName, Birthday, Email, Password) VALUES(:UserName, :FirstName, :LastName, :Birthday, :Email, :Password)");
        } catch( \Exception $e ) {
            echo $e->getMessage(), __LINE__;
            // return;
        } catch( \Error $er ) {
            echo $er->getMessage(), __LINE__;
        }

        $stmt->bindParam(':UserName', $user->uname);
        $stmt->bindParam(':FirstName', $user->firstName);
        $stmt->bindParam(':LastName', $user->lastName);
        $stmt->bindParam(':Birthday', $user->birthday);
        $stmt->bindParam(':Email', $user->email);
        $stmt->bindParam(':Password', $user->password);
        return $stmt->execute();
    }


    public function getUserByID( $id, &$data ) {
        // $sql = "SELECT UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, '%m-%d-%Y') As Birthday, Password FROM Users where UserID = $id;";
        $sql = "SELECT UserID, UserName, FirstName, LastName, Email, Birthday, Password FROM Users where UserID = $id;";
        $qry = $this->pdo->query( $sql );
        $data = $qry->fetch();
    }


    public function getUserByName( $uname, &$data ) {
        $qry = $this->pdo->query("select UserID, UserName, FirstName, LastName, Email, Birthday, Password from Users where UserName = '$uname';");
        $data = $qry->fetch();
    }

    public function deleteUserByID( $id ) {
        $this->pdo->exec( "delete from Users where UserID = $id;" );
    }

    public function updateUserByID( $id ) {
        // $id = $_POST['docid'];
        $uname = trim($_POST['uname']); // TODO: validate
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $bdate = trim($_POST['birthday']);

        //$sql = "UPDATE `test-db`.Users SET UserName = :uname, FirstName = :fname, LastName = :lname, Birthday = :bdate, Email = :email WHERE UserID = :id;";
        $sql = "UPDATE `test-db`.Users SET UserName = '$uname', FirstName = '$fname', LastName = '$lname', Birthday = '$bdate', Email = '$email' WHERE UserID = $id;";
        $stmt =  $this->pdo->prepare( $sql );

        // $stmt->bindValue(":id", $id);
        // $stmt->bindValue(":uname", $uname);
        // $stmt->bindValue(":fname", $fname);
        // $stmt->bindValue(":lname", $lname);
        // $stmt->bindValue(":bdate", $bdate);
        // $stmt->bindValue(":email", $email);
        $stmt->execute();
        return true;
    }

    public function getAllUsers( &$data ) {
        //$sql = "SELECT UserID, UserName, FirstName, LastName, Email, DATE_FORMAT(Birthday, '%m-%d-%Y') As Birthday, Password FROM Users";
        $sql = "SELECT UserID, UserName, FirstName, LastName, Email, Birthday, Password FROM Users";
        $qry = $this->pdo->query( $sql );
        $data = $qry->fetchAll();
    }
}
