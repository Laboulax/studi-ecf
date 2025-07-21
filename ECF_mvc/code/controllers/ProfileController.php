<?php

require_once 'code/model/UserModel.php';

session_start();

class ProfileController {

    private $model;


    public function __construct() {
        $this->model = new UserModel();
    }

    public function handle() {

        
            
        $utilisateur_id = $_SESSION['uti_id'];
        $this->dlImage($utilisateur_id);
        $info_user = $this->model->getUserById($utilisateur_id);
        if ($info_user != NULL && $info_user['utilisateur_id'] != false) {
            $nom = $info_user['Nom'];
            $prenom = $info_user['Prenom'];
            $email = $info_user['email'];
            $adress = $info_user['adress'];
            $photo = $info_user['photo'];
            $pseudo = $info_user['pseudo'];
        }
        else {
            header("index.php?login");
        }

        $this->addTrajet ();
        
        
        $trajet_futur = "";

        $trajet_user = $this->model->futurTrajets($utilisateur_id);
        
        foreach ($trajet_user as $value) {
            $trajet_futur .=

            "<tr>
            <td> ".$value['lieu_depart']." </td>
            <td> ".$value['lieu_arrivee']." </td>
            <td> ".$value['date_depart']." </td>
            <td> ".$value['heure_depart']." </td>
            <td> ".$value['heure_arrivee']." </td>
            <td> ".$value['hdif']." </td>
            <td> ".$value['prix_personne']." €</td>
            <td> ".$value['nb_place']." </td>
            </tr>";

        }

        $trajet_fait = "";

        $trajet_user = $this->model->faitTrajets($utilisateur_id);
        
        foreach ($trajet_user as $value) {
            $trajet_fait .=

            "<tr>
            <td> ".$value['lieu_depart']." </td>
            <td> ".$value['lieu_arrivee']." </td>
            <td> ".$value['date_depart']." </td>
            <td> ".$value['heure_depart']." </td>
            <td> ".$value['heure_arrivee']." </td>
            <td> ".$value['hdif']." </td>
            <td> ".$value['prix_personne']." €</td>
            </tr>";

        }

        $this->addCar($utilisateur_id);

        $voiture_user = "";
        $list_voiture = "";

        $voiture_info = $this->model->voiture_user($utilisateur_id);
        
        foreach ($voiture_info as $value) {
            $voiture_user .=

            "<tr>
            <td> ".$value['modele']." </td>
            <td> ".$value['immatriculation']." </td>
            <td> ".$value['libelle']." </td>
            </tr>";

            $list_voiture .=

            "<option value=".$value['voiture_id'].">".$value['libelle']." - ".$value['modele']."</option>";

        }

        $list_marque = "";

        $marque_info = $this->model->select_marque();
        
        foreach ($marque_info as $value) {
            $list_marque .=

            "<option value=".$value['marque_id'].">".$value['libelle']."</option>"
;
        }
        
        

        require_once 'code/views/profile.php';
    }

private function addCar($utilisateur_id) {
    if (isset($_POST['addCar'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $modele = $_POST['modele'];
            $immat = $_POST['immat'];
            $marque = $_POST['marque'];
            if ($modele != "" && $immat != "" && $marque !="0") {
                $this->model->createCar ($modele, $immat, $marque, $utilisateur_id);
            }
        }
    }
    return '';
}

private function addTrajet() {
    if (isset($_POST['addTrajet'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tav_Vdepart = $_POST['tav_Vdepart'];
            $tav_Varrivee = $_POST['tav_Varrivee'];
            $tav_dateD = $_POST['tav_dateD'];
            $tav_dateA = $_POST['tav_dateA'];
            $tav_Hdepart = $_POST['tav_Hdepart'];
            $tav_Harrivee = $_POST['tav_Harrivee'];
            $tav_prix = $_POST['tav_prix'];
            $tav_place = $_POST['tav_place'];
            $voiture_id = $_POST['voiture_id'];
            
            if ($tav_Vdepart != "" && $tav_Varrivee != "" && $tav_dateD !="" && $tav_dateA !="" && $tav_place !="" && $tav_Hdepart !="" && $tav_Harrivee !="" && $tav_prix !="") {
                $this->model->createTrajet ($tav_Vdepart , $tav_Varrivee , $tav_dateD , $tav_dateA, $tav_place , $tav_Hdepart , $tav_Harrivee , $tav_prix, $voiture_id);
            }
        }
    }
    return '';
}

    public function dlImage ($utilisateur_id) 
    {
        if (isset ($_POST['profilPic'])) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $this->model->profilPic($imageData, $utilisateur_id);
    } else {
    echo "Aucun fichier envoyé.";
        }
        }
    }
}