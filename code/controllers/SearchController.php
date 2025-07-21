<?php

class SearchController {
    public function handle() {
        $ville = "";
        
if (isset($_POST['ville'])) {
    $ville = "value = ". $_POST['ville'];
}
        require_once 'code/views/header.php';
        require_once 'code/views/search.php';
        require_once 'code/views/footer.php';
}
}