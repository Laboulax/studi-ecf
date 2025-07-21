<?php

class HomeController {
    public function handle() {
        require_once 'code/views/header.php';
        require_once 'code/views/home.php';
        require_once 'code/views/footer.php';
    }
}