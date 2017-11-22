-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 22 Novembre 2017 à 06:46
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
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `nom` varchar(48) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(48) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(48) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(250) CHARACTER SET utf8 NOT NULL,
  `cp` int(5) NOT NULL,
  `ville` varchar(48) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `ip` varchar(48) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_id` varchar(48) CHARACTER SET utf8 NOT NULL,
  `newsLetterInscription` tinyint(1) NOT NULL,
  `clientValide` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`client_id`, `nom`, `prenom`, `mail`, `adresse`, `cp`, `ville`, `tel`, `ip`, `password`, `dateInscription`, `session_id`, `newsLetterInscription`, `clientValide`) VALUES
(1, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '', '2017-11-06 17:54:57', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(2, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '', '2017-11-04 17:58:15', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(3, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '', '2017-11-04 17:58:29', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(4, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '', '2017-11-04 17:58:40', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(5, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '', '', '2017-11-04 18:00:47', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(6, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '::1', '', '2017-11-04 18:08:37', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(7, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '::1', '', '2017-11-04 18:08:56', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(8, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '::1', '', '2017-11-04 18:22:59', 'u7h35sjr87tl4lfmfpbdpogqu3', 0, 0),
(9, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '::1', '', '2017-11-05 18:23:15', 'u7h35sjr87tl4lfmfpbdpogqu3', 0, 0),
(11, 'legrand', 'david', 'sdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-06 11:25:47', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(13, 'legrand', 'david', 'dsdsmp@ikol.fr', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-06 15:32:16', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(35, 'riz', 'cuit', 'bigmoletos@yopmailcom', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '', '2017-11-07 13:23:08', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(36, 'riz', 'cuit', 'bigmoletos@yopmail.comi', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '', '2017-11-07 13:25:05', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(37, 'legrand', 'david', 'david@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 13:28:56', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(41, 'rizoto', 'tropcuit', 'rizzoto@yopmail.com', '16 avenue de la paella', 23561, 'marseille', '(01)85 42 47 57', '::1', '', '2017-11-07 13:53:58', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(42, 'rizoto', 'tropcuit', 'rizzo@yopmail.com', '16 avenue de la paella', 23561, 'marseille', '(01)85 42 47 57', '::1', '', '2017-11-07 13:54:23', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(43, 'test', 'test', 'test@test.test', 'test', 12345, 'test', '(01)11 11 11 11', '::1', '', '2017-11-07 14:10:48', 'g5tenp0jm923ttfpkibgak2ne3', 1, 1),
(44, 'legrand', 'david', 'dada@dadad.da', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 14:12:47', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(45, 'cuit', 'cuit', 'oplo@syopmailco', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '', '2017-11-07 14:32:01', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(46, 'cuit', 'cuit', 'oletos@yopmail.com', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '', '2017-11-07 14:36:50', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(47, 'legrand', 'david', 'sdssd@dfdfddf.encore', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 14:41:10', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(48, 'legrand', 'david', 'pm@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 14:51:39', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(49, 'legrand', 'david', 'oosdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 14:59:44', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(50, 'legrand', 'david', 'gerty@gtrr.gt', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 15:15:12', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(51, 'legrand', 'david', 'iopsdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 16:16:40', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(52, 'legrand', 'david', 'sloiudssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '', '2017-11-07 16:33:20', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(53, 'desmedt', 'franck', 'desmedt@free.fr', '15 route du puit vert', 97564, 'le robert', NULL, '::1', '', '2017-11-21 11:06:25', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(54, 'desmedt', 'franck', 'romaiuin@free.fr', '15 route du puit vert', 97564, 'le robert', NULL, '::1', '', '2017-11-21 11:31:34', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
