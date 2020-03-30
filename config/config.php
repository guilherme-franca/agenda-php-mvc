<?php

define('APP_PATH', 'http://localhost/agenda');
define('DS', str_replace('\\', '/', DIRECTORY_SEPARATOR));

define('CSS', APP_PATH.DS.'public/css/');
define('IMG', APP_PATH.DS.'public/img/');
define('JS', APP_PATH.DS.'public/js/');

include_once 'vendor/autoload.php';
include_once 'autoload.php';