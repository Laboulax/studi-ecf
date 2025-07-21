<?php

require_once 'code/core/Router.php';
require_once 'code/controllers/HomeController.php';
require_once 'code/controllers/AuthController.php';
require_once 'code/controllers/SearchController.php';
require_once 'code/controllers/ProfileController.php';

$router = new Router();

// Définir les routes
$router->addRoute('/', new HomeController());
$router->addRoute('/?login', new AuthController('login'));
$router->addRoute('/?register', new AuthController('register'));
$router->addRoute('/?search', new SearchController());
$router->addRoute('/?profile', new ProfileController());

// Gérer la requête
$uri = $_SERVER['REQUEST_URI'];
$router->handleRequest($uri);



