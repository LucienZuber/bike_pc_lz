-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 02 nov. 2017 à 09:30
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bike_pc_lz`
--

-- --------------------------------------------------------

--
-- Structure de la table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `departure_id` int(11) NOT NULL,
  `arrival_id` int(11) NOT NULL,
  `nbr_bike` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `departure_hour` datetime NOT NULL,
  `arrival_hour` datetime NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `arrival` (`arrival_id`),
  KEY `departure` (`departure_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `booking`
--

INSERT INTO `booking` (`_id`, `departure_id`, `arrival_id`, `nbr_bike`, `name`, `mail`, `phone`, `departure_hour`, `arrival_hour`) VALUES
(1, 1, 22, 2, 'Lucien Zuber', 'lucienzuber@gmail.com', '079 443 86 38', '2017-11-16 17:40:00', '2017-11-16 18:32:00');

-- --------------------------------------------------------

--
-- Structure de la table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `driver_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  KEY `driver` (`driver_id`),
  KEY `regiondriver` (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`_id`, `name`, `admin_id`) VALUES
(40, 'Anniviers', 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`_id`, `name`) VALUES
(1, 'superAdmin'),
(2, 'admin'),
(4, 'driver');

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `region` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `station`
--

INSERT INTO `station` (`_id`, `name`, `region_id`) VALUES
(1, 'Sierre, poste/gare', 40),
(2, 'Sierre, Chemin des Pins', 40),
(3, 'Sierre, Parc de Finges', 40),
(4, 'Sierre, Bois-de-Finges', 40),
(5, 'Sierre, Sentier de Chippis', 40),
(6, 'Niouc, village', 40),
(7, 'Niouc, Les Saints Innocents', 40),
(8, 'Les Pontis', 40),
(9, 'Vissoie, Les Barmes', 40),
(10, 'Fang', 40),
(11, 'Vissoie, poste', 40),
(12, 'Vissoie, Les Morands', 40),
(13, 'Ayer, Cuimey', 40),
(14, 'Mission', 40),
(15, 'Ayer, Val d\'Uccle', 40),
(16, 'Ayer, Blanche Pierre', 40),
(17, 'Ayer, Prarrayer', 40),
(18, 'Ayer, anc. poste', 40),
(19, 'Ayer, Les Grands Praz', 40),
(20, 'Ayer, Les Morasses', 40),
(21, 'Mottec', 40),
(22, 'Zinal, Pralong', 40),
(23, 'Zinal, Le Bouillet', 40),
(24, 'Zinal, poste', 40);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`_id`, `name`, `password`, `mail`, `phone`, `role_id`) VALUES
(1, 'Lucienz', '1234', 'lucienzuber@gmail.com', '0794438638', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `arrival` FOREIGN KEY (`arrival_id`) REFERENCES `station` (`_id`),
  ADD CONSTRAINT `departure` FOREIGN KEY (`departure_id`) REFERENCES `station` (`_id`);

--
-- Contraintes pour la table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `driver` FOREIGN KEY (`driver_id`) REFERENCES `user` (`_id`),
  ADD CONSTRAINT `regiondriver` FOREIGN KEY (`region_id`) REFERENCES `region` (`_id`);

--
-- Contraintes pour la table `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `admin` FOREIGN KEY (`admin_id`) REFERENCES `user` (`_id`);

--
-- Contraintes pour la table `station`
--
ALTER TABLE `station`
  ADD CONSTRAINT `regionstation` FOREIGN KEY (`region_id`) REFERENCES `region` (`_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `role` (`_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
