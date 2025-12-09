<?php

declare(strict_types=1);

$config = require __DIR__ . '/../bootstrap.php';

use App\Routing\Router;

$route = $_GET['route'] ?? 'not-found';
$request = array_merge($_GET, $_POST);

$router = new Router($config);
$response = $router->dispatch($route, $request);

http_response_code($response['status'] ?? 200);
header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
