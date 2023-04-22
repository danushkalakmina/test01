<?php
spl_autoload_register('myJavaScripAutoLoader');
spl_autoload_register('myAutoLoader');

function myJavaScripAutoLoader($className){
    $path = "../classes/";
    $extension = ".class.php";
    $fullpath = $path.$className.$extension;

    if (!file_exists($fullpath)) {
       return false;
    }
    include_once $fullpath;
}

function myAutoLoader($className){
    $path = "classes/";
    $extension = ".class.php";
    $fullpath = $path.$className.$extension;

    if (!file_exists($fullpath)) {
       return false;
    }
    include_once $fullpath;
}


?>