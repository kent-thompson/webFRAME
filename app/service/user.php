<?php
namespace App\service;

class User {
    private $reqType;
    //private $errors = [];

     public function __construct( $reqtype_ ) {
        $this->reqType = $reqtype_;
     }

    public function validate( &$user, &$errors ) {

        if( $this->reqType != POST )  {
            return false;
        }

        // id
        if( isset($_POST['docid']) ) {
            $id = trim($_POST['docid']);
            if( filter_var($id, FILTER_VALIDATE_INT) !== false ) {
                $user->Id = $id;
            }
        }

        // user uname
        if( isset($_POST['uname']) ) {
            $username = trim($_POST['uname']);
            if (empty($username)) {
                $errors['uname'] = 'Please enter a username';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors['uname'] = 'Username must contain only letters and numbers';
            } else if (strlen($username) < 6 || strlen($username) > 20) {
                $errors['uname'] = 'Username must be between 6 and 20 characters long';
            }
            $user->uname = $username;
        }

        // first name
        if( isset($_POST['fname']) ) {
            $fname = trim($_POST['fname']);
            if (empty($fname)) {
                $errors['fname'] = 'Please enter a first name';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $fname)) {
                $errors['fname'] = 'First name must contain only letters and numbers';
            } else if (strlen($fname) < 6 || strlen($fname) > 20) {
                $errors['fname'] = 'First name must be between 6 and 20 characters long';
            }
            $user->firstName = $fname;
        }

        // last name
        if( isset($_POST['lname']) ) {
            $lname = trim($_POST['lname']);
            if (empty($lname)) {
                $errors['lname'] = 'Please enter a last name';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $lname)) {
                $errors['lname'] = 'Last name must contain only letters and numbers';
            } else if (strlen($lname) < 6 || strlen($lname) > 20) {
                $errors['lname'] = 'Last name must be between 6 and 20 characters long';
            }
            $user->lastName = $lname;
        }

        // birthday
        if (isset($_POST['birthday'])) {
            $dob = trim($_POST['birthday']);
            if (empty($dob)) {
                $errors['dob'] = 'Please enter a date of birth';
            } else {
                $date = date_parse($dob);
                if (!checkdate($date['month'], $date['day'], $date['year'])) {
                    $errors['dob'] = 'Please enter a valid date of birth';
                }
            }
            $user->birthday = $dob;
        }

        // email
        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);
            if (empty($email)) {
                $errors['email'] = 'Please enter an email address';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please enter a valid email address';
            }
            $user->email = $email;
        }

        // passwword
        if( isset($_POST['psw']) ) {
            $pwd = trim($_POST['psw']);
            if (empty($pwd)) {
                $errors['psw'] = 'Please enter a Password';
            } else if ( ! ctype_alnum( $pwd) ) {
                $errors['psw'] = 'Somehow there are Illegal Characters in the Password, Please Use Different Password';
            } else if (strlen($pwd) < 6 || strlen($pwd) > 20) {
                $errors['psw'] = 'Password must be between 6 and 20 characters long';
            }
            $user->password = $pwd;
        }

        if( count($errors) > 0 ) {
            return false;
        } else {
            return true;
        }
    }
}
