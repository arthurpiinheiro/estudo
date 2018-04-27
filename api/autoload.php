<?php

define('BASE_PATH', realpath(dirname(__FILE__)));

function my_autoloader($class)
{
    $class = str_replace('\\', '/', $class);
    include_once BASE_PATH . '/' . $class . '.php';
}

spl_autoload_register('my_autoloader');