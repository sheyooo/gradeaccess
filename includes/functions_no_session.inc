<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Africa/Lagos');

function my_autoloader($class) {
    include __DIR__ . '../../classes/' . $class . '.php';
}

spl_autoload_register('my_autoloader');
new Session();
?>