<?php
namespace App\service;

// grap usrs from model
class User {
    // public function __construct() {
    // }

    public function getUser( $id, &$data ) {
        // get data from DB
        $data['id'] = 56;
        $data['name'] = 'Sammy';
        $data['job'] = 'Gardener';
        //return $data;
    }
}
