<?php

//Bsaic Setup - should not be changed

error_reporting(E_ALL);
ini_set("display_startup_errors","1");
ini_set("display_errors","1");

require_once 'vendor/autoload.php';

/**
 * Error and Exception handling
 */
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

// load config
require_once 'config/config.php';

// load routes
$routes = require('routes/web.php');
$router = new Core\Router();
$router($routes);

