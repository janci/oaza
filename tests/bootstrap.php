<?php
/**
 * Bootstrap file for unit tests
 */

require_once (dirname(__FILE__)."/../tools/autoload.php" );


error_reporting(E_ALL | E_STRICT);

// register silently failing autoloader
spl_autoload_register(function($class)
{
    $filename = dirname(__FILE__).'\\..\\'.$class.'.php';
    $filename = str_replace('\\','/', $filename);

    if(file_exists($filename)) require_once $filename;

});
