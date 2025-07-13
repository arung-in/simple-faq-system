<?php

use SimpleFaqSystem\Http\Request;
use SimpleFaqSystem\Http\Response;
use SimpleFaqSystem\Http\Kernel;

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';

$request = Request::create();
$kernel = new Kernel();
$response = $kernel->handle($request);
$response->setContent();
