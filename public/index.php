<?php

require_once '../vendor/autoload.php';

use App\router\Router;

require_once '../src/router/Routes.php';
require_once '../src/router/helpers.php';

// To define const to go back the project root and reach specific files
define('TEMPLATE_DIR', realpath(dirname(__DIR__)).'/templates');
define('PUBLIC_DIR', realpath(dirname(__DIR__)).'/public');

//Starting session
session_start();

// Start the routing
Router::start();
