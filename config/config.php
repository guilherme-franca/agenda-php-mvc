<?php

define('APP_PATH', 'http://localhost/projects/agenda');
define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));

define('CSS', APP_PATH.DS.'public/css/');
define('IMG', APP_PATH.DS.'public/img/');
define('JS', APP_PATH.DS.'public/js/');

/**
 * Genarete BASE URL | Link
 * For images, files javascript and css
 * 
 */
function assests($target) {
    return APP_PATH . DS . 'public' . DS . $target;
}

function config($name) {
    $path = __DIR__ . DS . $name . '.php';
    echo $path . "<br><br>";
    return (file_exists($path)) ? include $path : [];
}

include_once 'vendor/autoload.php';
include_once 'autoload.php';