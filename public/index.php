<?php

session_start();

require_once __DIR__.'/../app/Core/Router.php';
require_once __DIR__.'/../app/Core/Database.php';

$router = new Router();
$router->handleRequest();
