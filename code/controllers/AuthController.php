<?php

require_once 'code/model/UserModel.php';

class AuthController {

    private $model;
    
    private $action;

    public function __construct($action) {
        $this->action = $action;
        $this->model = new UserModel();
    }

    public function handle() {
        if ($this->action == 'login') {
            $message = $this->connectUser();
            require_once 'code/views/header.php';
            require_once 'code/views/login.php';
            require_once 'code/views/footer.php';
        } elseif ($this->action == 'register') {
            if($this->newUser()) {
                header('Location:index.php?login');
                exit();
            }
            require_once 'code/views/header.php';
            require_once 'code/views/register.php';
            require_once 'code/views/footer.php';
        }
    }

    private function newUser () {
            if (isset($_POST['ok'])) {
                // extraction du ($_POST);
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $pass = $_POST['pass'];
                $adress = $_POST['adress'];
                $date_naissance = $_POST['date_naissance'];
                $pseudo = $_POST['pseudo'];
                $role = $_POST['role'];
                return $this->model->createUser ($nom, $prenom, $email, MD5($pass), $adress, $date_naissance, $pseudo, $role);
        }
    }

private function connectUser() {
    if (isset($_POST['ok'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $pass = MD5($_POST['pass']);
            if ($email != "" && $pass != "") {
                $rep = $this->model->logUser ($email, $pass);
                if ($rep != NULL && $rep['utilisateur_id'] != false) {
                    session_start();
                    $_SESSION['uti_id'] = $rep['utilisateur_id'];
                    header("Location: index.php?profile");
                } else {
                    return "Email ou mdp incorrect veuillez réessayer!";
                }
            }
        }
    }
    return '';
}

}