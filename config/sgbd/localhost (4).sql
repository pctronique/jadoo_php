-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 28 avr. 2022 à 09:52
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
(4, 'cvc', 'cxvc', 'hh@juu.hy', 'vvcx vvv c', 1, '2022-04-25 07:53:14'),
(5, 'ludovic', 'hhf', 'fgfdgd@oii.ju', 'wwwwwwwééééé bbn', 1, '2022-04-26 09:13:10'),
(6, 'fgfg', 'gfgffg', 'gfgfgf@fggfgf.ggf', 'hhjhjhjhjh gngn', 1, '2022-04-26 12:21:05'),
(7, 'sdfdg', 'dgfdgd', 'ffffdf@lllk.jh', 'dfdgds fgfdhdfh', 0, '2022-04-26 12:21:33'),
(8, 'fdgdf', 'dfgdf', 'vvb@fgfgf.hjhhj', 'ezrzetzeezt fdhdf', 0, '2022-04-26 12:22:06');

--
-- Déchargement des données de la table `modifier_plat`
--

INSERT INTO `modifier_plat` (`id_creation_plat`, `id_plats`, `id_user`, `date_creation`) VALUES
(1, 1, 1, '2022-04-25 09:58:03'),
(2, 2, 1, '2022-04-25 09:59:18'),
(3, 3, 1, '2022-04-25 09:59:18'),
(4, 4, 1, '2022-04-25 09:59:18'),
(5, 5, 1, '2022-04-25 09:59:18'),
(6, 6, 1, '2022-04-25 09:59:18');

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `Nom`, `Description`, `Image`, `Id_Categorie`, `date_plat`, `jeton`) VALUES
(1, 'Tonkatsu-Teishoku', 'Échine de porc panée à la japonaise \"Tonkatsu-Teishoku\"', 'plat_3.png', 1, '2022-04-25 09:52:29', '732e4ab10788650f0c2cd7584d7f9eca'),
(2, 'Udon', 'Nouilles japonaises chaudes à base de farine de blé \"Udon\"', 'plat_2.png', 1, '2022-04-25 09:52:29', '46a74ee837c9f669875747b8b00b8e5e'),
(3, 'Tsukuné', 'Boulettes de poulet au gingembre sauce sucrée salée \"Tsukuné\"', 'plat_1.png', 1, '2022-04-25 09:52:29', 'f5e9d919dcd9340c418b770dbd4e2b6f'),
(4, 'Ikura Rolls', 'Oeufs de saumon', 'maki_4.png', 2, '2022-04-25 09:52:29', 'a78db9f9a44ba5792f736f78fbe45d2a'),
(5, 'Ebi', 'Crevette, avocat, menthe, coriandre', 'maki_3.png', 2, '2022-04-25 09:52:29', 'bd6fe781fd4c03dc7c85f3d26a81ee08'),
(6, 'California Rolls', 'Saumon, avocat et mayonnaise', 'maki_2.png', 2, '2022-04-25 09:52:29', 'baa401dcb0ca86ad180cae29bad5d19e'),
(7, 'California Tobiko', 'Saumon, thon, mayonnaise', 'maki_1.png', 2, '2022-04-25 07:52:29', '9642d412a847065bd79a6022043b7c3b'),
(10, 'Avocat wasabi', 'Un maki surprenant alliant onctuosité.', 'img_tmp_1651129206.png', 2, '2022-04-28 07:00:06', '6d36c53a70dacabd2c81d1a5f70ab12d'),
(11, 'Saumon fumé', 'Le saumon fumé associé à la betterave et l\'aneth.', 'img_tmp_1651129673.png', 2, '2022-04-28 07:07:53', '59bbddd8888d3c7dc15686dcff00b9ea'),
(12, 'Aburi Roll', 'L\'onctuosité du fromage frais au saumon.', 'img_tmp_1651129918.png', 2, '2022-04-28 07:11:58', '39b32fa4e24e0ce5be14ce36f8b3fed2'),
(13, 'Chicken Katsu', 'Légumes croquants qui s\'allient avec le poulet.', 'img_tmp_1651130279.png', 2, '2022-04-28 07:17:59', '74932fe4aa1f7e70190520d77d04d290'),
(14, 'Ratatouille provençale', 'La ratatouille est une spécialité provençale (niçoise pour être précis).', 'img_tmp_1651130537.png', 1, '2022-04-28 07:22:17', '6ea0c06f54991ef5ca8151906d346ab0'),
(15, 'Tenders de poulet', 'Qui ne connait pas les tenders ? Les célébres morceaux de poulet.', 'img_tmp_1651130834.png', 1, '2022-04-28 07:27:14', '416b98fbc68798457de5deac01e093f2'),
(16, 'Choucroute', 'Choucroute, se consomme traditionnellement avec des variantes locales.', 'img_tmp_1651131138.jpg', 1, '2022-04-28 07:32:18', '735e49fb415676d299999258e33c31bf');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `firstname`, `email`, `login`, `pass`, `id_admin`, `date`, `jeton`) VALUES
(1, 'NAULOT', 'Ludovic', 'l.naulot@codeur.online', 'pctronique', 'Z3lnWWNPYTlxaFFwTDd6Yg$Nb15Ed5/8QofdG5wksbrZt8xE2gcqbZ9gzQnpDyheEk', 1, '2022-04-25 06:57:00', 'efadf19a37742b5a58b6ac2c9e98be38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
