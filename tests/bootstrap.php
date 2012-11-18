<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

/**
 * Bootstrap file for unit tests
 */


define('APP_DIR', dirname(dirname(__FILE__)));

require_once (dirname(__FILE__)."/../tools/autoload.php" );


error_reporting(E_ALL | E_STRICT);

// register silently failing autoloader
spl_autoload_register(function($class)
{
    $filename = dirname(__FILE__).'\\..\\'.$class.'.php';
    $filename = str_replace('\\','/', $filename);

    if(file_exists($filename)) require_once $filename;

});

function build($object){
    return $object;
}
