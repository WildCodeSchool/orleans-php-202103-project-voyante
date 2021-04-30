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

-- Base de données :  projet_voyance
--

-- --------------------------------------------------------
CREATE DATABASE  IF NOT EXISTS projet_voyance; /*!40100 DEFAULT CHARACTER SET latin1 */

USE projet_voyance;

-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(255),
  `price1hour` INT NOT NULL,
  `price30min` INT
);

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`name`, `description`, `price1hour`) VALUES
("Au cabinet", "Pendant le rendez-vous nous pratiquons le tirage de carte de tarot, la lecture des lignes de la main, l'astrologie avancée et la lecture de votre avenir.", 75);
INSERT INTO `service` (`name`, `description`, `price1hour`, `price30min`) VALUES
("À distance", "Nous pratiquons la même prestation qu'en rendez-vous au cabinet, le tout adapté pour lire votre avenir de manière toute aussi précise. Consultation par téléphone ou visioconférence.", 75, 50);

-------------------------------------------------------------
--
-- Base de données :  `testimony`
--
--
-- Structure de la table `testimony`
--
DROP TABLE IF EXISTS `testimony`;
CREATE TABLE `testimony` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR (80) NOT NULL,
  `mail` VARCHAR (320) NOT NULL,
  `message` TEXT,
  `validation` BOOLEAN
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `testimony`
--

INSERT INTO `testimony` (`id`, `name`, `mail`, `message`, `validation`) VALUES
(1, 'océane', 'océane.h@gmail.com', "Je recommande Nathalie, qui explique très bien comment elle fonctionne et 
je la remercie pour les réponses qu'elle a pu me donner !", TRUE ),
(2, 'clémence', 'clémence.d@gmail.com', "J'ai consulté Mme MILLIET 2 fois en quatre ans et je ne peux que vous la recommander, 
elle est bienveillante, vous met à l'aise, vous explique parfaitement bien comment va se dérouler la séance et on ressort de chez elle véritablement apaisée. 
Pour ma part en tout cas, je suis ravie et toutes ces prédictions et avertissements se sont avérées utiles et justes.", TRUE ),
(3, 'claire', 'claire.b@gmail.com', "Une question quant à votre présent et/ou votre avenir ? Je vous recommande Nathalie. 
Tout simplement stupéfiante ! Bienveillante, pédagogue, sensible, souriante et pertinente !En 1h, le doute à fait place à l’évidence... 
Tout simplement : merci d’être sur mon chemin ! À bientôt...", TRUE );

--
-- AUTO_INCREMENT pour la table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
