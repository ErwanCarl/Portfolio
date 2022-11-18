<?php

require_once('../Autoloader.php');
Autoloader::register();

use App\router\Router;

require_once '../src/router/Routes.php';
require_once '../src/router/helpers.php';

// To go back to the project root and define supervar as a path
define('TEMPLATE_DIR', realpath(dirname(__DIR__)).'/templates');
define('PUBLIC_DIR', realpath(dirname(__DIR__)).'/public');

//Starting session
session_start();

// Start the routing
Router::start();
