<?php

require './vendor/autoload.php';

use App\Core\Router;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();

require_once('./routes/web.php');

$router->dispatch($_SERVER['REQUEST_URI']);