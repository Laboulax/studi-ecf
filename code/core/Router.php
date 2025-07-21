<?php

class Router {
    private $routes = [];

    public function addRoute($uri, $controller) {
        $this->routes[$uri] = $controller;
    }

    public function handleRequest($uri) {
        echo ($uri);
        if (array_key_exists($uri, $this->routes)) {
           $controller = $this->routes[$uri];
           $controller->handle();
        } else {
           require_once 'code/views/header.php';
        require_once 'code/views/home.php';
        require_once 'code/views/footer.php'; 
        }
    }
}
