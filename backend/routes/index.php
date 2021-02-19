<?php

use function src\slimConfiguration;
use App\Controllers\ClientsController;

$app = new \Slim\App(slimConfiguration());

// ========================================

$app->add(new Tuupola\Middleware\CorsMiddleware([
  "origin" => ["http://localhost:8001/"],
  "methods" => ["GET", "POST", "PUT", "DELETE", "OPTIONS"],    
  "headers.allow" => ["Origin", "Content-Type", "Authorization", "Accept", "ignoreLoadingBar", "X-Requested-With", "Access-Control-Allow-Origin"],
  "headers.expose" => [],
  "credentials" => true,
  "cache" => 0,        
]));

$app->get('/clients', ClientsController::class . ':getClients');
$app->post('/clients', ClientsController::class . ':insertClient');
$app->put('/clients', ClientsController::class . ':updateClient');
$app->delete('/clients', ClientsController::class . ':deleteClient');

// ========================================

$app->run();