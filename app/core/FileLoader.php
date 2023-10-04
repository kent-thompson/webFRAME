<?php
namespace App\core;

// ** FILE NOT USED - Refactored Out **


spl_autoload_register('App\core\FileLoader');
function FileLoader($className) {
    // $path = 
    $ext = '.php';
    $fullPath = $className . $ext;

    if( !file_exists($fullPath) ) {
        return false;            
    }

    include_once $fullPath;
}

