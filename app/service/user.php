<?php
namespace App\service;

class User {

    private $reqType;
    private $strMsg = ' must contain only letters and numbers';
    
     public function __construct( $reqtype_ ) {
        $this->reqType = $reqtype_;
     }


     public function validateLogin( &$user, &$errors ) {    // uname and password passed in using $user
        $this->validateUName( $user, $errors );
        $this->validatePwd( $user, $errors );
        if( count($errors) > 0 ) {
            return false;
        } else {
            return true;
        }
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
        $this->validateUName( $user, $errors );

        // if( isset($_POST['uname']) ) {
        //     $username = trim($_POST['uname']);
        //     if (empty($username)) {
        //         $errors['uname'] = 'Please enter a username';
        //     } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        //         $errors['uname'] = 'Username' . $strMsg;
        //     } else if (strlen($username) < 6 || strlen($username) > 20) {
        //         $errors['uname'] = 'Username must be between 6 and 20 characters long';
        //     }
        //     $user->uname = $username;
        //  }

        // first name
        if( isset($_POST['fname']) ) {
            $fname = trim($_POST['fname']);
            if (empty($fname)) {
                $errors['fname'] = 'Please enter a first name';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $fname)) {
                $errors['fname'] = 'First name' . $strMsg;
            } else if (strlen($fname) < 3 || strlen($fname) > 20) {
                $errors['fname'] = 'First name must be between 3 and 20 characters long';
            }
            $user->firstName = $fname;
        }

        // last name
        if( isset($_POST['lname']) ) {
            $lname = trim($_POST['lname']);
            if (empty($lname)) {
                $errors['lname'] = 'Please enter a last name';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $lname)) {
                $errors['lname'] = 'Last name' . $strMsg;
            } else if (strlen($lname) < 3 || strlen($lname) > 20) {
                $errors['lname'] = 'Last name must be between 3 and 20 characters long';
            }
            $user->lastName = $lname;
        }

        // birthday
        if( isset($_POST['birthday']) ) {
            $dob = trim($_POST['birthday']);
            if (empty($dob)) {
                $errors['dob'] = 'Please enter a Date of Birth';
            } else {
                $date = date_parse($dob);
                if (!checkdate($date['month'], $date['day'], $date['year'])) {
                    $errors['dob'] = 'Please enter a valid Date of Birth';
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
        $this->validatePwd( $user, $errors );

        // if( isset($_POST['psw']) ) {
        //     $pwd = trim($_POST['psw']);
        //     if (empty($pwd)) {
        //         $errors['psw'] = 'Please enter a Password';
        //     //} else if ( ! ctype_alnum( $pwd) ) {
        //     } else if (!preg_match('/^[a-zA-Z0-9\s\p{P}]+$/', $pwd)) {              
        //         $errors['psw'] = 'Illegal Characters in Password, Please Use Alpha-Numeric Characters and Punctuation';
        //     } else if (strlen($pwd) < 8 || strlen($pwd) > 20) {
        //         $errors['psw'] = 'Password must be between 8 and 20 characters long';
        //     }
        //     $user->password = $pwd;
        // }

        if( count($errors) > 0 ) {
            return false;
        } else {
            return true;
        }
    }

    private function validateUName( &$user, &$errors ) {
        if( isset($_POST['uname']) ) {
            $username = trim($_POST['uname']);
            if (empty($username)) {
                $errors['uname'] = 'Please enter a username';
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                $errors['uname'] = 'Username' . $strMsg;
            } else if (strlen($username) < 6 || strlen($username) > 20) {
                $errors['uname'] = 'Username must be between 6 and 20 characters long';
            }
            $user->uname = $username;
        }
    }


    private function validatePwd( &$user, &$errors ) {
        if( isset($_POST['psw']) ) {
            $pwd = trim($_POST['psw']);
            if (empty($pwd)) {
                $errors['psw'] = 'Please enter a Password';
            } else if (!preg_match('/^[a-zA-Z0-9\s\p{P}]+$/', $pwd)) {              
                $errors['psw'] = 'Illegal Characters in Password, Please Use Alpha-Numeric Characters and Punctuation';
            } else if (strlen($pwd) < 6 || strlen($pwd) > 20) {
                $errors['psw'] = 'Password must be between 6 and 20 characters long';
            }
            $user->password = $pwd;
        }
    }

}//
