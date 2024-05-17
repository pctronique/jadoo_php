-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mariadb:3309
-- Généré le : jeu. 21 avr. 2022 à 17:12
-- Version du serveur : 10.4.18-MariaDB-1:10.4.18+maria~focal-log
-- Version de PHP : 7.4.20

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

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `Id_Categorie` int(10) NOT NULL,
  `Categorie` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Id_Categorie`, `Categorie`) VALUES
(1, 'plats_chaud'),
(2, 'makis');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `Id` int(10) NOT NULL,
  `Nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Prenom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Message` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

CREATE TABLE `plats` (
  `Id` int(10) NOT NULL,
  `Nom` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Id_Categorie` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`Id`, `Nom`, `Description`, `Image`, `Id_Categorie`) VALUES
(1, 'Tonkatsu-Teishoku', 'Échine de porc panée à la japonaise \"Tonkatsu-Teishoku\"', 'plat_3.png', 1),
(2, 'Udon', 'Nouilles japonaises chaudes à base de farine de blé \"Udon\"', 'plat_2.png', 1),
(3, 'Tsukuné', 'Boulettes de poulet au gingembre sauce sucrée salée \"Tsukuné\"', 'plat_1.png', 1),
(4, 'Ikura Rolls', 'Oeufs de saumon', 'maki_4.png', 2),
(5, 'Ebi', 'Crevette, avocat, menthe, coriandre', 'maki_3.png', 2),
(6, 'California Rolls', 'Saumon, avocat et mayonnaise', 'maki_2.png', 2),
(7, 'California Tobiko', 'Saumon, thon, mayonnaise', 'maki_1.png', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id_Categorie`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `key_id_categorie` (`Id_Categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id_Categorie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plats`
--
ALTER TABLE `plats`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `plats`
--
ALTER TABLE `plats`
  ADD CONSTRAINT `key_id_categorie` FOREIGN KEY (`Id_Categorie`) REFERENCES `categories` (`Id_Categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
