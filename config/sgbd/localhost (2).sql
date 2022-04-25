-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 25 avr. 2022 à 12:35
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jadoo`
--
CREATE DATABASE IF NOT EXISTS `jadoo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `jadoo`;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `name_admin`) VALUES
(1, 'admin'),
(2, 'utilisateur');

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Id_Categorie`, `Categorie`) VALUES
(1, 'plats_chaud'),
(2, 'makis');

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`Id`, `Nom`, `Prenom`, `Email`, `Message`, `lu`, `date`) VALUES
(1, 'NAULOT', 'Ludovic', 'l.naulot@codeur.online', 'Bientôt l\'été ou pas :).', 1, '2022-04-25 07:10:03'),
(2, 'NAULOT', 'Ludovic', 'l.naulot@codeur.online', 'Bonjour ca va.', 1, '2022-04-25 07:25:03'),
(3, 'naulot', 'ludovic', 'fgfdgd@oii.ju', 'cvcvcvc cvcv', 1, '2022-04-25 07:52:14'),
(4, 'cvc', 'cxvc', 'hh@juu.hy', 'vvcx vvv c', 1, '2022-04-25 07:53:14');

--
-- Déchargement des données de la table `modifier_plat`
--

INSERT INTO `modifier_plat` (`id_creation_plat`, `id_plats`, `id_user`, `date_creation`) VALUES
(1, 1, 1, '2022-04-25 09:58:03'),
(2, 2, 1, '2022-04-25 09:59:18'),
(3, 3, 1, '2022-04-25 09:59:18'),
(4, 4, 1, '2022-04-25 09:59:18'),
(5, 5, 1, '2022-04-25 09:59:18'),
(6, 6, 1, '2022-04-25 09:59:18'),
(7, 7, 1, '2022-04-25 09:59:18');

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `Nom`, `Description`, `Image`, `Id_Categorie`, `date_plat`, `jeton`) VALUES
(1, 'Tonkatsu-Teishoku', 'Échine de porc panée à la japonaise \"Tonkatsu-Teishoku\"', 'plat_3.png', 1, '2022-04-25 09:52:29', 'sdsfdssdfdsfssdfsd'),
(2, 'Udon', 'Nouilles japonaises chaudes à base de farine de blé \"Udon\"', 'plat_2.png', 1, '2022-04-25 09:52:29', 'efeefrfrfefrfrfrrfrfrfrf'),
(3, 'Tsukuné', 'Boulettes de poulet au gingembre sauce sucrée salée \"Tsukuné\"', 'plat_1.png', 1, '2022-04-25 09:52:29', 'dfssdfsrthjhjhghgk'),
(4, 'Ikura Rolls', 'Oeufs de saumon', 'maki_4.png', 2, '2022-04-25 09:52:29', 'kjjhkjkhkhkhk'),
(5, 'Ebi', 'Crevette, avocat, menthe, coriandre', 'maki_3.png', 2, '2022-04-25 09:52:29', 'fhgfhfhffhghgh'),
(6, 'California Rolls', 'Saumon, avocat et mayonnaise', 'maki_2.png', 2, '2022-04-25 09:52:29', 'fhffnnnfgggfngf'),
(7, 'California Tobiko', 'Saumon, thon, mayonnaise', 'maki_1.png', 2, '2022-04-25 09:52:29', 'fghfjjhkhjkjhkjhkhj');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `firstname`, `email`, `login`, `pass`, `id_admin`, `date`, `jeton`) VALUES
(1, 'NAULOT', 'Ludovic', 'l.naulot@codeur.online', 'pctronique', 'Z3lnWWNPYTlxaFFwTDd6Yg$Nb15Ed5/8QofdG5wksbrZt8xE2gcqbZ9gzQnpDyheEk', 1, '2022-04-25 06:57:00', 'dfgfdgdfbcvbKLHLHkjK:!:;');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
