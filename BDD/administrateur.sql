-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 05 Novembre 2017 à 14:24
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `safariz`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `adm_id` int(11) NOT NULL,
  `nomAdm` varchar(48) CHARACTER SET latin1 NOT NULL,
  `login` varchar(48) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `email` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `dateLastConnexion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`adm_id`, `nomAdm`, `login`, `password`, `email`, `dateLastConnexion`) VALUES
(1, 'szer', 'bigmoletos', 'aze', 'bigmoletos@yopmail.com', '2017-11-05 10:28:39'),
(2, 'eefef', 'feefefef', '116e055b63d8698142614628d179f5f9', 'dsdss@sasaa', '2017-11-05 11:26:33'),
(3, 'hgrrgrrt', 'ooli', '$2y$10$iMUaF.EQHduZy7n3BiDm3.6kJ85jicc0MilInBvnNXDOfD.77pLSC', 'bigmoletos@yopmail.com', '2017-11-05 11:42:51');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`adm_id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
