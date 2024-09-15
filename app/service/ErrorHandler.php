<?php
namespace App\service;

//This file represents an "entry point" to gracefully handle and report errors and exeptions.
// Could go on to LOG errors, display various page types 404, 500 et cetra, and make them end-user 'pretty.'
// Whateever the Proplen Domains dictates. It can spring from here.

function Call404( $data, $file, $line ) {
    $GLOBALS['error_data'] = $data;
    $GLOBALS['error_file'] = $file;
    $GLOBALS['error_line'] =  $line;
    require_once VIEWS . '404.php';
    exit();
}