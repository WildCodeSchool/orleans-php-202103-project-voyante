-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------
--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(255),
  `price1hour` INT NOT NULL,
  `price30min` INT
)

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`name`, `description`, `price1hour`) VALUES
(`Au cabinet`, `Pendant le rendez-vous nous pratiquons le tirage de carte de tarot, la lecture des lignes de la main, l'astrologie avancée et la lecture de votre avenir.`, 75);
INSERT INTO `service` (`name`, `description`, `price1hour`, `price30min`) VALUES
(`À distance`, `Nous pratiquons la même prestation qu'en rendez-vous au cabinet, le tout adapté pour lire votre avenir de manière toute aussi précise. Consultation par téléphone ou visioconférence.`, 75, 50);
