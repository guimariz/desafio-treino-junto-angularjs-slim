<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . './vendor/autoload.php';
require __DIR__ . './env.php';
require __DIR__ . './src/slimConfiguration.php';
require __DIR__ . './routes/index.php';

