<?php

use Framework\Kernel;
use Framework\Request;
use App\RouteProvider;

require __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$kernel->registerRoutes(new RouteProvider());

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($path)) {
    $path = '/';
}

$request = new Request($_SERVER['REQUEST_METHOD'], $path, $_GET, $_POST);

$response = $kernel->handleRequest($request);

$response->echo();
