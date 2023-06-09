-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 juin 2023 à 06:42
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `homeaway`
--

-- --------------------------------------------------------

--
-- Structure de la table ` book`
--

DROP TABLE IF EXISTS ` book`;
CREATE TABLE IF NOT EXISTS ` book` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `id_person` int NOT NULL,
  `id_logement` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `logement` (`id_logement`),
  KEY `person` (`id_person`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `cancel`
--

DROP TABLE IF EXISTS `cancel`;
CREATE TABLE IF NOT EXISTS `cancel` (
  `id_cancel` int NOT NULL AUTO_INCREMENT,
  `id_reservation` int NOT NULL,
  `cancellation_date` date NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cancel`),
  KEY `book` (`id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(300) NOT NULL,
  `id_logement` int NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `logement` (`id_logement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int NOT NULL AUTO_INCREMENT,
  `id_person` int NOT NULL,
  `title` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL,
  `surface` int NOT NULL,
  `description` varchar(1000) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `price_by_night` int NOT NULL,
  `number_of_person` int NOT NULL,
  `number_of_beds` int NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `piscine` tinyint(1) NOT NULL,
  `animals` tinyint(1) NOT NULL,
  `kitchen` tinyint(1) NOT NULL,
  `garden` tinyint(1) NOT NULL,
  `tv` tinyint(1) NOT NULL,
  `climatisation` tinyint(1) NOT NULL,
  `camera` tinyint(1) NOT NULL,
  `home_textiles` tinyint(1) NOT NULL,
  `spa` tinyint(1) NOT NULL,
  `jacuzzi` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_logement`),
  KEY `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `id_person`, `title`, `type`, `surface`, `description`, `adress`, `city`, `price_by_night`, `number_of_person`, `number_of_beds`, `parking`, `wifi`, `piscine`, `animals`, `kitchen`, `garden`, `tv`, `climatisation`, `camera`, `home_textiles`, `spa`, `jacuzzi`) VALUES
(2, 5, 'appartement vue sur mer ', 'appartement ', 70, 'bel appartement avec vue sur la mer ', 'Bd Henri IV, 34000 Montpellier', 'Montpellier', 75, 4, 2, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0),
(3, 3, 'maison avec piscine', 'maison ', 130, 'une magnifique maison idéalement située à Marseille, offrant un cadre de vie exceptionnel avec sa piscine et son spa privés. Cette maison spacieuse et luxueuse est parfaite pour ceux qui recherchent une résidence élégante et relaxante dans l\'une des villes les plus ensoleillées de France.\r\nSurface habitable : 130m2\r\nChambres : 2\r\nSalles de bains : oui\r\nPiscine privée : profitez des chaudes journées d\'été en vous rafraîchissant dans votre propre piscine.\r\nSpa : détendez-vous dans le spa privé, idéal pour se relaxer après une longue journée.\r\nCuisine entièrement équipée : parfaite pour les amateurs de cuisine, cette cuisine moderne offre tout l\'équipement nécessaire pour préparer de délicieux repas.\r\nGarage : un espace de stationnement sécurisé pour votre véhicule.\r\nLa maison est située dans un quartier prisé de Marseille, offrant une tranquillité absolue tout en étant à proximité des commodités, des commerces, des écoles et des transports en commun. Profitez de la vie urbaine dynamique ', '7 eme arrondissement 13000 ', 'Marseille', 150, 4, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0),
(4, 4, 'logement insolite dans une bulle ', 'bulle rigide ', 19, 'La bulle rigide accueil uniquement jusqu\'à 2 personnes , petits déjeuner compris , panier repas\r\nVenez vous ressourcer et vous détendre au sein d’un univers accueillant et confortable, au milieu de la nature, en toute intimité.\r\nImaginez-vous lâcher prise dans un univers hors du commun, en pleine nature, plongé dans une eau chaude, bercé par le crépitement d’un feu de bois.\r\nPuis, laissez courir votre imagination et découvrez l’émerveillement de nuits à la belle étoile à l’abri d’un Stellarium , avec tout le confort d’une chambre d’hôtel.\r\nIl y a une salle de bain , WC , lit rond , canapé convertible , salon intérieur , salon extérieur , cuisine extérieur ( frigo , plancha , évier , micro onde... ) hot tub (spa ) ,\r\n', '66 AVENUE DE ROME, ZAC du Grand Saint-Charles 66000 ', 'PERPIGNAN', 180, 2, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(150) NOT NULL,
  `phone_number` int NOT NULL,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `person`
--

INSERT INTO `person` (`id_person`, `name`, `firstname`, `date_of_birth`, `password`, `phone_number`, `mail`) VALUES
(2, 'mathieu', 'peinet', '1998-02-01', '$2y$10$0x9v9PJRdOEI6ln.WrU.BuC.otpBY9L9mspoKOWs27Jwtz.AcMPeW', 656589689, 'maty@gmail.com'),
(3, 'kevin', 'tracol', '1990-02-01', '$2y$10$BSvIxwNAu6SOcfI0aQUEpOM8wXagMEGV20ie1pIzaUxS4EBLGSqSe', 756896369, 'kev@live.fr'),
(4, 'viviane', 'harty', '1991-02-01', '$2y$10$byi7irlk7VE7UoQ6zPwXbu6T2t/Xsd29sG3yWljMcjR5.JSB9eILi', 689698745, 'vivi@yahoo.fr'),
(5, 'courtney', 'cox', '1984-06-09', '$2y$10$TXHDEDYEwR4s.nPmkbpxnOh3oAtJaJTI8K0U5r6KUi92/yWUKLTb.', 756548587, 'coco@live.fr');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table ` book`
--
ALTER TABLE ` book`
  ADD CONSTRAINT ` book_ibfk_1` FOREIGN KEY (`id_logement`) REFERENCES `logement` (`id_logement`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT ` book_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `cancel`
--
ALTER TABLE `cancel`
  ADD CONSTRAINT `cancel_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES ` book` (`id_reservation`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_logement`) REFERENCES `logement` (`id_logement`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `logement`
--
ALTER TABLE `logement`
  ADD CONSTRAINT `logement_ibfk_1` FOREIGN KEY (`id_person`) REFERENCES `person` (`id_person`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
