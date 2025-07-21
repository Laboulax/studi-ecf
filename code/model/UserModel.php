<?php

require_once 'code/database/db.php';

class UserModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getUserById($utilisateur_id) {
        $query = "SELECT * FROM `utilisateurs` WHERE utilisateur_id = :utilisateur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($nom, $prenom, $email, $pass, $adress, $date_naissance, $pseudo, $role) {
        $query ="INSERT INTO `utilisateurs` (`Nom`, `Prenom`, `email`, `password`, `adress`, `date_naissance`, `photo`, `pseudo`) 
        VALUES (:nom, :prenom, :email, :pass, :adress, :date_naissance, NULL, :pseudo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':adress', $adress);
        $stmt->bindParam(':date_naissance', $date_naissance);
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

$query = "INSERT INTO `role_users` (`ru_utilisateur_id`, `ru_role_id`)
        SELECT (SELECT utilisateur_id FROM `utilisateurs` WHERE email=:email AND password=:pass) AS a,
        (SELECT role_id FROM `roles` WHERE libelle=:role) AS b";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':role', $role);
        
        return $stmt->execute();
        
    }

    public function logUser ($email, $pass) {
        $query = "SELECT * FROM `utilisateurs` WHERE email=:email AND password=:pass";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function futurTrajets ($utilisateur_id) {
        $query = "SELECT *, TIMEDIFF(heure_arrivee, heure_depart) AS 'hdif' FROM `covoiturages` INNER JOIN `voitures` ON car_covoit = voiture_id  WHERE appartient_voiture = :utilisateur_id AND NOW()<=date_arrivee" ;
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        return $stmt;
    }

    public function faitTrajets ($utilisateur_id) {
        $query = "SELECT *, TIMEDIFF(heure_arrivee, heure_depart) AS 'hdif' FROM `covoiturages` INNER JOIN `voitures` ON car_covoit = voiture_id  WHERE appartient_voiture = :utilisateur_id AND NOW()>date_arrivee";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        return $stmt;
    }

    public function voiture_user ($utilisateur_id) {
        $query = "SELECT * FROM `voitures` INNER JOIN `marques` ON marque_voiture = marque_id  WHERE appartient_voiture = :utilisateur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->execute();
        return $stmt;
    }

    public function select_marque () {
        $query = "SELECT * FROM `marques`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createCar($modele, $immat, $marque, $utilisateur_id) {
        $query ="INSERT INTO `voitures`( `modele`, `immatriculation`, `appartient_voiture`, `marque_voiture`) VALUES 
        (:modele, :immat,  :utilisateur_id, :marque)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':immat', $immat);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
    
        return $stmt->execute();
    }

    public function createTrajet($tav_Vdepart , $tav_Varrivee , $tav_dateD , $tav_dateA, $tav_place , $tav_Hdepart , $tav_Harrivee , $tav_prix, $voiture_id) {
        $query ="INSERT INTO `covoiturages`(`date_depart`, `heure_depart`, `lieu_depart`, `date_arrivee`, `heure_arrivee`, `lieu_arrivee`, `nb_place`, `prix_personne`, `car_covoit`)
        VALUES (:tav_dateD  , :tav_Hdepart , :tav_Vdepart , :tav_dateA ,  :tav_Harrivee , :tav_Varrivee ,  :tav_place ,  :tav_prix, :voiture_id)";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tav_dateD', $tav_dateD);
        $stmt->bindParam(':tav_Hdepart', $tav_Hdepart);
        $stmt->bindParam(':tav_Vdepart', $tav_Vdepart);
        $stmt->bindParam(':tav_dateA', $tav_dateA);
        $stmt->bindParam(':tav_Harrivee', $tav_Harrivee);
        $stmt->bindParam(':tav_Varrivee', $tav_Varrivee);
        $stmt->bindParam(':tav_place', $tav_place);
        $stmt->bindParam(':tav_prix', $tav_prix);
        $stmt->bindParam(':voiture_id', $voiture_id);
    
        return $stmt->execute();
    }

    public function profilPic ($photo , $utilisateur_id) {
    $query = "UPDATE `utilisateurs` SET `photo` = :photo WHERE utilisateur_id = :utilisateur_id ";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':photo', $photo, PDO::PARAM_LOB);
    $stmt->bindParam(':utilisateur_id', $utilisateur_id);

    if ($stmt->execute()) {
        echo "Image enregistrée avec succès !";
    } else {
        echo "Erreur lors de l'enregistrement.";
    }
}

}

