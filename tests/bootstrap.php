<?php

error_reporting(E_ALL);

include_once dirname(__DIR__).'/src/autoloader.php';

if(class_exists('PHPUnit_Framework_Error_Notice')) {
    class_alias('PHPUnit_Framework_Error_Notice', 'PHPUnit\Framework\Error\Notice');
}

PHPUnit\Framework\Error\Notice::$enabled = true;
