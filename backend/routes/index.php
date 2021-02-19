<?php

use function src\slimConfiguration;
use App\Controllers\ClientsController;

$app = new \Slim\App(slimConfiguration());

// ========================================

$app->add(new Tuupola\Middleware\CorsMiddleware);

$app->get('/clients', ClientsController::class . ':getClients');
$app->post('/clients', ClientsController::class . ':insertClient');
$app->put('/clients', ClientsController::class . ':updateClient');
$app->delete('/clients', ClientsController::class . ':deleteClient');

// ========================================

$app->run();