-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 juil. 2025 à 17:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoride`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `avis_id` int(11) NOT NULL,
  `commentaire` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `avis_users`
--

CREATE TABLE `avis_users` (
  `au_utilisateur_id` char(36) NOT NULL,
  `au_avis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `configurations`
--

CREATE TABLE `configurations` (
  `id_configuration` int(11) NOT NULL,
  `config_user` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `covoiturages`
--

CREATE TABLE `covoiturages` (
  `covoiturage_id` int(11) NOT NULL,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  `lieu_depart` varchar(50) NOT NULL,
  `date_arrivee` date NOT NULL,
  `heure_arrivee` time NOT NULL,
  `lieu_arrivee` varchar(50) NOT NULL,
  `statut` varchar(50) NOT NULL,
  `nb_place` int(50) NOT NULL,
  `prix_personne` float NOT NULL,
  `car_covoit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `covoiturages`
--

INSERT INTO `covoiturages` (`covoiturage_id`, `date_depart`, `heure_depart`, `lieu_depart`, `date_arrivee`, `heure_arrivee`, `lieu_arrivee`, `statut`, `nb_place`, `prix_personne`, `car_covoit`) VALUES
(10, '2025-10-17', '14:00:00', 'nantes', '2025-10-17', '14:00:00', 'paris', '', 2, 23, 3),
(11, '2025-07-17', '14:00:00', 'Nantes', '2025-07-17', '16:00:00', 'Paris', '', 2, 100, 3);

-- --------------------------------------------------------

--
-- Structure de la table `covoiturage_users`
--

CREATE TABLE `covoiturage_users` (
  `ac_utilisateur_id` char(36) NOT NULL,
  `ac_covoiturage_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

CREATE TABLE `marques` (
  `marque_id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`marque_id`, `libelle`) VALUES
(1, 'Citroën'),
(2, 'Volkswagen'),
(3, 'Fiat'),
(4, 'Peugeot'),
(5, 'Renault'),
(6, 'Mercedes'),
(7, 'BMW'),
(8, 'Tesla'),
(9, 'Audi'),
(10, 'Porsche'),
(11, 'Skoda'),
(12, 'Toyota'),
(13, 'Ferrari');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id_parametre` int(11) NOT NULL,
  `config_param` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role_id`, `libelle`) VALUES
(1, 'admin'),
(2, 'chauffeur'),
(3, 'passager');

-- --------------------------------------------------------

--
-- Structure de la table `role_users`
--

CREATE TABLE `role_users` (
  `ru_utilisateur_id` char(36) NOT NULL,
  `ru_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role_users`
--

INSERT INTO `role_users` (`ru_utilisateur_id`, `ru_role_id`) VALUES
('2d49e08d-6250-11f0-adf3-1c1b0d38290d', 3),
('61eeb15b-63cf-11f0-a147-1c1b0d38290d', 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `utilisateur_id` char(36) NOT NULL DEFAULT (UUID()),
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `date_naissance` varchar(50) NOT NULL,
  `photo` longblob DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`utilisateur_id`, `Nom`, `Prenom`, `email`, `password`, `adress`, `date_naissance`, `photo`, `pseudo`) VALUES
('2d49e08d-6250-11f0-adf3-1c1b0d38290d', 'Lecor', 'Quentin', 'quent1@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '10 rue des coquins polissons', '1991-10-10', NULL, 'Kent1'),
('61eeb15b-63cf-11f0-a147-1c1b0d38290d', 'Laboulais', 'Antoine', 'pipoufilou@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '26 RUE DU PETIT BEL AIR', '1010-10-10', NULL, 'Ant1');

-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `voiture_id` int(11) NOT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `immatriculation` varchar(50) DEFAULT NULL,
  `energie` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `date_premiere_immat` varchar(50) DEFAULT NULL,
  `appartient_voiture` char(36) NOT NULL,
  `marque_voiture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`voiture_id`, `modele`, `immatriculation`, `energie`, `couleur`, `date_premiere_immat`, `appartient_voiture`, `marque_voiture`) VALUES
(3, 'A3', 'BG 206 BB', NULL, NULL, NULL, '2d49e08d-6250-11f0-adf3-1c1b0d38290d', 9),
(6, 'Polo', 'TT 111 PO', NULL, NULL, NULL, '2d49e08d-6250-11f0-adf3-1c1b0d38290d', 2),
(7, 'TT', 'QT 101 LC', NULL, NULL, NULL, '2d49e08d-6250-11f0-adf3-1c1b0d38290d', 9);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`avis_id`);

--
-- Index pour la table `avis_users`
--
ALTER TABLE `avis_users`
  ADD PRIMARY KEY (`au_utilisateur_id`,`au_avis_id`),
  ADD KEY `au_avis_id` (`au_avis_id`);

--
-- Index pour la table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id_configuration`),
  ADD KEY `config_user` (`config_user`);

--
-- Index pour la table `covoiturages`
--
ALTER TABLE `covoiturages`
  ADD PRIMARY KEY (`covoiturage_id`),
  ADD KEY `car_covoit` (`car_covoit`);

--
-- Index pour la table `covoiturage_users`
--
ALTER TABLE `covoiturage_users`
  ADD PRIMARY KEY (`ac_utilisateur_id`,`ac_covoiturage_id`),
  ADD KEY `ac_covoiturage_id` (`ac_covoiturage_id`);

--
-- Index pour la table `marques`
--
ALTER TABLE `marques`
  ADD PRIMARY KEY (`marque_id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id_parametre`),
  ADD KEY `config_param` (`config_param`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`ru_utilisateur_id`,`ru_role_id`),
  ADD KEY `ru_role_id` (`ru_role_id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`utilisateur_id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`voiture_id`),
  ADD KEY `appartient_voiture` (`appartient_voiture`),
  ADD KEY `marque_voiture` (`marque_voiture`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `avis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id_configuration` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `covoiturages`
--
ALTER TABLE `covoiturages`
  MODIFY `covoiturage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `marques`
--
ALTER TABLE `marques`
  MODIFY `marque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id_parametre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `voiture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_users`
--
ALTER TABLE `avis_users`
  ADD CONSTRAINT `avis_users_ibfk_1` FOREIGN KEY (`au_utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`),
  ADD CONSTRAINT `avis_users_ibfk_2` FOREIGN KEY (`au_avis_id`) REFERENCES `avis` (`avis_id`);

--
-- Contraintes pour la table `configurations`
--
ALTER TABLE `configurations`
  ADD CONSTRAINT `configurations_ibfk_1` FOREIGN KEY (`config_user`) REFERENCES `utilisateurs` (`utilisateur_id`);

--
-- Contraintes pour la table `covoiturages`
--
ALTER TABLE `covoiturages`
  ADD CONSTRAINT `covoiturages_ibfk_1` FOREIGN KEY (`car_covoit`) REFERENCES `voitures` (`voiture_id`);

--
-- Contraintes pour la table `covoiturage_users`
--
ALTER TABLE `covoiturage_users`
  ADD CONSTRAINT `covoiturage_users_ibfk_1` FOREIGN KEY (`ac_utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`),
  ADD CONSTRAINT `covoiturage_users_ibfk_2` FOREIGN KEY (`ac_covoiturage_id`) REFERENCES `covoiturages` (`covoiturage_id`);

--
-- Contraintes pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD CONSTRAINT `parametres_ibfk_1` FOREIGN KEY (`config_param`) REFERENCES `configurations` (`id_configuration`);

--
-- Contraintes pour la table `role_users`
--
ALTER TABLE `role_users`
  ADD CONSTRAINT `role_users_ibfk_1` FOREIGN KEY (`ru_utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`),
  ADD CONSTRAINT `role_users_ibfk_2` FOREIGN KEY (`ru_role_id`) REFERENCES `roles` (`role_id`);

--
-- Contraintes pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_ibfk_1` FOREIGN KEY (`appartient_voiture`) REFERENCES `utilisateurs` (`utilisateur_id`),
  ADD CONSTRAINT `voitures_ibfk_2` FOREIGN KEY (`marque_voiture`) REFERENCES `marques` (`marque_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
