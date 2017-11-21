-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 21 Novembre 2017 à 11:41
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

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
  `dateLastConnexion` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`adm_id`, `nomAdm`, `login`, `password`, `email`, `dateLastConnexion`) VALUES
(1, 'szer', 'bigmoletos', 'aze', 'bigmoletos@yopmail.com', '2017-11-05 10:28:39'),
(2, 'eefef', 'feefefef', '116e055b63d8698142614628d179f5f9', 'dsdss@sasaa', '2017-11-05 11:26:33'),
(3, 'hgrrgrrt', 'ooli', '$2y$10$iMUaF.EQHduZy7n3BiDm3.6kJ85jicc0MilInBvnNXDOfD.77pLSC', 'bigmoletos@yopmail.com', '2017-11-05 11:42:51'),
(4, '  fanny  ', '  fanny  ', '$2y$10$LTr7MIoOGfIzYhBItMwyvuwWTiP1s.13gyTYdiFeDssvaZHCF7N.q', 'fleur@free.fr', '1510676138'),
(5, '  ededed  ', '  deded  ', '$2y$10$1eDVz3mJKueRXHglKEYC.uX.bCxnSw29xCdvyyTNmIozf5uS73YiS', 'dded@free.fr', '1510730593');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `nom` varchar(48) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(48) CHARACTER SET latin1 NOT NULL,
  `mail` varchar(48) CHARACTER SET latin1 NOT NULL,
  `adresse` varchar(250) CHARACTER SET latin1 NOT NULL,
  `cp` int(5) NOT NULL,
  `ville` varchar(48) CHARACTER SET latin1 NOT NULL,
  `tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(48) CHARACTER SET latin1 NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_id` varchar(48) COLLATE utf8_unicode_ci NOT NULL,
  `newsLetterInscription` tinyint(1) NOT NULL,
  `clientValide` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`client_id`, `nom`, `prenom`, `mail`, `adresse`, `cp`, `ville`, `tel`, `ip`, `dateInscription`, `session_id`, `newsLetterInscription`, `clientValide`) VALUES
(1, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '2017-11-06 17:54:57', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(2, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '2017-11-04 17:58:15', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(3, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '2017-11-04 17:58:29', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(4, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '', '2017-11-04 17:58:40', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(5, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '', '2017-11-04 18:00:47', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(6, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '::1', '2017-11-04 18:08:37', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(7, 'rizotto', 'tropcuit', 'rizotto@yopmail.com', '1 avenue du rizotto', 13789, 'NIMES', '(06)94 83 02 03', '::1', '2017-11-04 18:08:56', 'u7h35sjr87tl4lfmfpbdpogqu3', 1, 0),
(8, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '::1', '2017-11-04 18:22:59', 'u7h35sjr87tl4lfmfpbdpogqu3', 0, 0),
(9, 'riz', 'cuit', 'riz@yopmail.com', '1 avenue du riz rouge', 13045, 'SAINTE MARIE DE LA MER', '(04)55 55 32 22', '::1', '2017-11-05 18:23:15', 'u7h35sjr87tl4lfmfpbdpogqu3', 0, 0),
(11, 'legrand', 'david', 'sdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-06 11:25:47', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(13, 'legrand', 'david', 'dsdsmp@ikol.fr', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-06 15:32:16', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(35, 'riz', 'cuit', 'bigmoletos@yopmailcom', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '2017-11-07 13:23:08', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(36, 'riz', 'cuit', 'bigmoletos@yopmail.comi', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '2017-11-07 13:25:05', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(37, 'legrand', 'david', 'david@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 13:28:56', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(41, 'rizoto', 'tropcuit', 'rizzoto@yopmail.com', '16 avenue de la paella', 23561, 'marseille', '(01)85 42 47 57', '::1', '2017-11-07 13:53:58', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(42, 'rizoto', 'tropcuit', 'rizzo@yopmail.com', '16 avenue de la paella', 23561, 'marseille', '(01)85 42 47 57', '::1', '2017-11-07 13:54:23', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(43, 'test', 'test', 'test@test.test', 'test', 12345, 'test', '(01)11 11 11 11', '::1', '2017-11-07 14:10:48', 'g5tenp0jm923ttfpkibgak2ne3', 1, 1),
(44, 'legrand', 'david', 'dada@dadad.da', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 14:12:47', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(45, 'cuit', 'cuit', 'oplo@syopmailco', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '2017-11-07 14:32:01', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(46, 'cuit', 'cuit', 'oletos@yopmail.com', '1 avenue du riz', 13015, 'marseille', '(07)65 32 58 62', '::1', '2017-11-07 14:36:50', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(47, 'legrand', 'david', 'sdssd@dfdfddf.encore', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 14:41:10', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(48, 'legrand', 'david', 'pm@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 14:51:39', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(49, 'legrand', 'david', 'oosdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 14:59:44', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(50, 'legrand', 'david', 'gerty@gtrr.gt', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 15:15:12', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(51, 'legrand', 'david', 'iopsdssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 16:16:40', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(52, 'legrand', 'david', 'sloiudssd@dfdfddf', '3 route des parapluies', 13695, 'Martigues', '(04)44 44 11 14', '::1', '2017-11-07 16:33:20', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(53, 'desmedt', 'franck', 'desmedt@free.fr', '15 route du puit vert', 97564, 'le robert', NULL, '::1', '2017-11-21 11:06:25', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1),
(54, 'desmedt', 'franck', 'romaiuin@free.fr', '15 route du puit vert', 97564, 'le robert', NULL, '::1', '2017-11-21 11:31:34', 'g5tenp0jm923ttfpkibgak2ne3', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dates_jeux`
--

CREATE TABLE `dates_jeux` (
  `id_dates_jeux` int(11) NOT NULL,
  `date_debut_jeu` datetime NOT NULL,
  `date_fin_jeu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `dates_jeux`
--

INSERT INTO `dates_jeux` (`id_dates_jeux`, `date_debut_jeu`, `date_fin_jeu`) VALUES
(1, '2017-11-06 00:00:00', '2017-11-24 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `gagnants`
--

CREATE TABLE `gagnants` (
  `gagnant_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `dateGain` datetime NOT NULL,
  `lot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ig`
--

CREATE TABLE `ig` (
  `label` varchar(10) DEFAULT NULL,
  `ID` int(3) DEFAULT NULL,
  `timestamp` int(10) DEFAULT NULL,
  `jour` varchar(10) DEFAULT NULL,
  `heure` varchar(8) DEFAULT NULL,
  `datetime` varchar(19) DEFAULT NULL,
  `lotDispo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ig`
--

INSERT INTO `ig` (`label`, `ID`, `timestamp`, `jour`, `heure`, `datetime`, `lotDispo`) VALUES
('casquette', 1, 1509952690, '2017-11-06', '08:18:10', '2017-11-06 08:18:10', 0),
('porte-clé', 2, 1509957354, '2017-11-06', '09:35:54', '2017-11-06 09:35:54', 0),
('porte-clé', 3, 1509961893, '2017-11-06', '10:51:33', '2017-11-06 10:51:33', 0),
('casquette', 4, 1509966509, '2017-11-06', '12:08:29', '2017-11-06 12:08:29', 0),
('casquette', 5, 1509970961, '2017-11-06', '13:22:41', '2017-11-06 13:22:41', 0),
('porte-clé', 6, 1509975470, '2017-11-06', '14:37:50', '2017-11-06 14:37:50', 0),
('casquette', 7, 1509979834, '2017-11-06', '15:50:34', '2017-11-06 15:50:34', 0),
('casquette', 8, 1509984229, '2017-11-06', '17:03:49', '2017-11-06 17:03:49', 1),
('casquette', 9, 1509988742, '2017-11-06', '18:19:02', '2017-11-06 18:19:02', 1),
('casquette', 10, 1509993051, '2017-11-06', '19:30:51', '2017-11-06 19:30:51', 1),
('casquette', 11, 1509997513, '2017-11-06', '20:45:13', '2017-11-06 20:45:13', 1),
('casquette', 12, 1510002146, '2017-11-06', '22:02:26', '2017-11-06 22:02:26', 1),
('casquette', 13, 1510006565, '2017-11-06', '23:16:05', '2017-11-06 23:16:05', 1),
('casquette', 14, 1510011094, '2017-11-07', '00:31:34', '2017-11-07 00:31:34', 1),
('casquette', 15, 1510015732, '2017-11-07', '01:48:52', '2017-11-07 01:48:52', 1),
('casquette', 16, 1510019962, '2017-11-07', '02:59:22', '2017-11-07 02:59:22', 1),
('casquette', 17, 1510024297, '2017-11-07', '04:11:37', '2017-11-07 04:11:37', 1),
('casquette', 18, 1510028729, '2017-11-07', '05:25:29', '2017-11-07 05:25:29', 1),
('casquette', 19, 1510033185, '2017-11-07', '06:39:45', '2017-11-07 06:39:45', 1),
('casquette', 20, 1510037440, '2017-11-07', '07:50:40', '2017-11-07 07:50:40', 1),
('casquette', 21, 1510042107, '2017-11-07', '09:08:27', '2017-11-07 09:08:27', 1),
('casquette', 22, 1510046592, '2017-11-07', '10:23:12', '2017-11-07 10:23:12', 1),
('casquette', 23, 1510050793, '2017-11-07', '11:33:13', '2017-11-07 11:33:13', 1),
('casquette', 24, 1510055365, '2017-11-07', '12:49:25', '2017-11-07 12:49:25', 1),
('casquette', 25, 1510059984, '2017-11-07', '14:06:24', '2017-11-07 14:06:24', 1),
('casquette', 26, 1510064415, '2017-11-07', '15:20:15', '2017-11-07 15:20:15', 1),
('porte-clé', 27, 1510068815, '2017-11-07', '16:33:35', '2017-11-07 16:33:35', 1),
('casquette', 28, 1510073139, '2017-11-07', '17:45:39', '2017-11-07 17:45:39', 1),
('casquette', 29, 1510077735, '2017-11-07', '19:02:15', '2017-11-07 19:02:15', 1),
('casquette', 30, 1510081991, '2017-11-07', '20:13:11', '2017-11-07 20:13:11', 1),
('casquette', 31, 1510086368, '2017-11-07', '21:26:08', '2017-11-07 21:26:08', 1),
('casquette', 32, 1510090707, '2017-11-07', '22:38:27', '2017-11-07 22:38:27', 1),
('casquette', 33, 1510094990, '2017-11-07', '23:49:50', '2017-11-07 23:49:50', 1),
('casquette', 34, 1510099657, '2017-11-08', '01:07:37', '2017-11-08 01:07:37', 1),
('casquette', 35, 1510104314, '2017-11-08', '02:25:14', '2017-11-08 02:25:14', 1),
('casquette', 36, 1510108553, '2017-11-08', '03:35:53', '2017-11-08 03:35:53', 1),
('casquette', 37, 1510113119, '2017-11-08', '04:51:59', '2017-11-08 04:51:59', 1),
('casquette', 38, 1510117324, '2017-11-08', '06:02:04', '2017-11-08 06:02:04', 1),
('casquette', 39, 1510121888, '2017-11-08', '07:18:08', '2017-11-08 07:18:08', 1),
('casquette', 40, 1510126260, '2017-11-08', '08:31:00', '2017-11-08 08:31:00', 1),
('casquette', 41, 1510130910, '2017-11-08', '09:48:30', '2017-11-08 09:48:30', 1),
('casquette', 42, 1510135448, '2017-11-08', '11:04:08', '2017-11-08 11:04:08', 1),
('casquette', 43, 1510140073, '2017-11-08', '12:21:13', '2017-11-08 12:21:13', 1),
('casquette', 44, 1510144434, '2017-11-08', '13:33:54', '2017-11-08 13:33:54', 1),
('casquette', 45, 1510148892, '2017-11-08', '14:48:12', '2017-11-08 14:48:12', 1),
('porte-clé', 46, 1510153101, '2017-11-08', '15:58:21', '2017-11-08 15:58:21', 1),
('casquette', 47, 1510157744, '2017-11-08', '17:15:44', '2017-11-08 17:15:44', 1),
('casquette', 48, 1510162297, '2017-11-08', '18:31:37', '2017-11-08 18:31:37', 1),
('casquette', 49, 1510166934, '2017-11-08', '19:48:54', '2017-11-08 19:48:54', 1),
('porte-clé', 50, 1510171339, '2017-11-08', '21:02:19', '2017-11-08 21:02:19', 1),
('safari', 51, 1510176003, '2017-11-08', '22:20:03', '2017-11-08 22:20:03', 1),
('casquette', 52, 1510180573, '2017-11-08', '23:36:13', '2017-11-08 23:36:13', 1),
('porte-clé', 53, 1510185204, '2017-11-09', '00:53:24', '2017-11-09 00:53:24', 1),
('casquette', 54, 1510189835, '2017-11-09', '02:10:35', '2017-11-09 02:10:35', 1),
('casquette', 55, 1510194327, '2017-11-09', '03:25:27', '2017-11-09 03:25:27', 1),
('casquette', 56, 1510198605, '2017-11-09', '04:36:45', '2017-11-09 04:36:45', 1),
('casquette', 57, 1510203210, '2017-11-09', '05:53:30', '2017-11-09 05:53:30', 1),
('porte-clé', 58, 1510207840, '2017-11-09', '07:10:40', '2017-11-09 07:10:40', 1),
('casquette', 59, 1510212494, '2017-11-09', '08:28:14', '2017-11-09 08:28:14', 1),
('casquette', 60, 1510216758, '2017-11-09', '09:39:18', '2017-11-09 09:39:18', 1),
('casquette', 61, 1510221243, '2017-11-09', '10:54:03', '2017-11-09 10:54:03', 1),
('porte-clé', 62, 1510225630, '2017-11-09', '12:07:10', '2017-11-09 12:07:10', 1),
('casquette', 63, 1510230102, '2017-11-09', '13:21:42', '2017-11-09 13:21:42', 1),
('casquette', 64, 1510234493, '2017-11-09', '14:34:53', '2017-11-09 14:34:53', 1),
('casquette', 65, 1510238928, '2017-11-09', '15:48:48', '2017-11-09 15:48:48', 1),
('casquette', 66, 1510243538, '2017-11-09', '17:05:38', '2017-11-09 17:05:38', 1),
('safari', 67, 1510248013, '2017-11-09', '18:20:13', '2017-11-09 18:20:13', 1),
('casquette', 68, 1510252297, '2017-11-09', '19:31:37', '2017-11-09 19:31:37', 1),
('casquette', 69, 1510256677, '2017-11-09', '20:44:37', '2017-11-09 20:44:37', 1),
('casquette', 70, 1510260998, '2017-11-09', '21:56:38', '2017-11-09 21:56:38', 1),
('casquette', 71, 1510265462, '2017-11-09', '23:11:02', '2017-11-09 23:11:02', 1),
('casquette', 72, 1510269751, '2017-11-10', '00:22:31', '2017-11-10 00:22:31', 1),
('porte-clé', 73, 1510274237, '2017-11-10', '01:37:17', '2017-11-10 01:37:17', 1),
('casquette', 74, 1510278463, '2017-11-10', '02:47:43', '2017-11-10 02:47:43', 1),
('casquette', 75, 1510282950, '2017-11-10', '04:02:30', '2017-11-10 04:02:30', 1),
('casquette', 76, 1510287461, '2017-11-10', '05:17:41', '2017-11-10 05:17:41', 1),
('casquette', 77, 1510292138, '2017-11-10', '06:35:38', '2017-11-10 06:35:38', 1),
('casquette', 78, 1510296448, '2017-11-10', '07:47:28', '2017-11-10 07:47:28', 1),
('casquette', 79, 1510300795, '2017-11-10', '08:59:55', '2017-11-10 08:59:55', 1),
('casquette', 80, 1510305129, '2017-11-10', '10:12:09', '2017-11-10 10:12:09', 1),
('casquette', 81, 1510309767, '2017-11-10', '11:29:27', '2017-11-10 11:29:27', 1),
('casquette', 82, 1510314086, '2017-11-10', '12:41:26', '2017-11-10 12:41:26', 1),
('porte-clé', 83, 1510318657, '2017-11-10', '13:57:37', '2017-11-10 13:57:37', 1),
('casquette', 84, 1510323001, '2017-11-10', '15:10:01', '2017-11-10 15:10:01', 1),
('casquette', 85, 1510327295, '2017-11-10', '16:21:35', '2017-11-10 16:21:35', 1),
('casquette', 86, 1510331531, '2017-11-10', '17:32:11', '2017-11-10 17:32:11', 1),
('casquette', 87, 1510336013, '2017-11-10', '18:46:53', '2017-11-10 18:46:53', 1),
('casquette', 88, 1510340418, '2017-11-10', '20:00:18', '2017-11-10 20:00:18', 1),
('porte-clé', 89, 1510344709, '2017-11-10', '21:11:49', '2017-11-10 21:11:49', 1),
('casquette', 90, 1510348996, '2017-11-10', '22:23:16', '2017-11-10 22:23:16', 1),
('casquette', 91, 1510353602, '2017-11-10', '23:40:02', '2017-11-10 23:40:02', 1),
('casquette', 92, 1510358226, '2017-11-11', '00:57:06', '2017-11-11 00:57:06', 1),
('porte-clé', 93, 1510362780, '2017-11-11', '02:13:00', '2017-11-11 02:13:00', 1),
('casquette', 94, 1510367238, '2017-11-11', '03:27:18', '2017-11-11 03:27:18', 1),
('porte-clé', 95, 1510371505, '2017-11-11', '04:38:25', '2017-11-11 04:38:25', 1),
('porte-clé', 96, 1510375888, '2017-11-11', '05:51:28', '2017-11-11 05:51:28', 1),
('casquette', 97, 1510380174, '2017-11-11', '07:02:54', '2017-11-11 07:02:54', 1),
('casquette', 98, 1510384667, '2017-11-11', '08:17:47', '2017-11-11 08:17:47', 1),
('casquette', 99, 1510389139, '2017-11-11', '09:32:19', '2017-11-11 09:32:19', 1),
('casquette', 100, 1510393408, '2017-11-11', '10:43:28', '2017-11-11 10:43:28', 1),
('casquette', 101, 1510397782, '2017-11-11', '11:56:22', '2017-11-11 11:56:22', 1),
('casquette', 102, 1510402158, '2017-11-11', '13:09:18', '2017-11-11 13:09:18', 1),
('porte-clé', 103, 1510406703, '2017-11-11', '14:25:03', '2017-11-11 14:25:03', 1),
('casquette', 104, 1510411330, '2017-11-11', '15:42:10', '2017-11-11 15:42:10', 1),
('casquette', 105, 1510415832, '2017-11-11', '16:57:12', '2017-11-11 16:57:12', 1),
('casquette', 106, 1510420166, '2017-11-11', '18:09:26', '2017-11-11 18:09:26', 1),
('casquette', 107, 1510424696, '2017-11-11', '19:24:56', '2017-11-11 19:24:56', 1),
('porte-clé', 108, 1510429297, '2017-11-11', '20:41:37', '2017-11-11 20:41:37', 1),
('safari', 109, 1510433893, '2017-11-11', '21:58:13', '2017-11-11 21:58:13', 1),
('casquette', 110, 1510438244, '2017-11-11', '23:10:44', '2017-11-11 23:10:44', 1),
('casquette', 111, 1510442476, '2017-11-12', '00:21:16', '2017-11-12 00:21:16', 1),
('casquette', 112, 1510447013, '2017-11-12', '01:36:53', '2017-11-12 01:36:53', 1),
('casquette', 113, 1510451352, '2017-11-12', '02:49:12', '2017-11-12 02:49:12', 1),
('porte-clé', 114, 1510456005, '2017-11-12', '04:06:45', '2017-11-12 04:06:45', 1),
('casquette', 115, 1510460664, '2017-11-12', '05:24:24', '2017-11-12 05:24:24', 1),
('porte-clé', 116, 1510465203, '2017-11-12', '06:40:03', '2017-11-12 06:40:03', 1),
('casquette', 117, 1510469822, '2017-11-12', '07:57:02', '2017-11-12 07:57:02', 1),
('casquette', 118, 1510474084, '2017-11-12', '09:08:04', '2017-11-12 09:08:04', 1),
('casquette', 119, 1510478737, '2017-11-12', '10:25:37', '2017-11-12 10:25:37', 1),
('porte-clé', 120, 1510483210, '2017-11-12', '11:40:10', '2017-11-12 11:40:10', 1),
('casquette', 121, 1510487848, '2017-11-12', '12:57:28', '2017-11-12 12:57:28', 1),
('casquette', 122, 1510492214, '2017-11-12', '14:10:14', '2017-11-12 14:10:14', 1),
('casquette', 123, 1510500215, '2017-11-12', '16:23:35', '2017-11-12 16:23:35', 1);

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE `lot` (
  `lot_id` int(11) NOT NULL,
  `ig_id` int(11) NOT NULL,
  `nomLot` varchar(48) CHARACTER SET latin1 NOT NULL,
  `description` varchar(48) CHARACTER SET latin1 NOT NULL,
  `dateSejour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `client_Id` int(11) NOT NULL,
  `dateParticipation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Index pour la table `dates_jeux`
--
ALTER TABLE `dates_jeux`
  ADD PRIMARY KEY (`id_dates_jeux`);

--
-- Index pour la table `gagnants`
--
ALTER TABLE `gagnants`
  ADD PRIMARY KEY (`gagnant_id`),
  ADD UNIQUE KEY `client_id` (`client_id`),
  ADD UNIQUE KEY `lot_id` (`lot_id`);

--
-- Index pour la table `ig`
--
ALTER TABLE `ig`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Index pour la table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Index pour la table `lot`
--
ALTER TABLE `lot`
  ADD PRIMARY KEY (`lot_id`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`client_Id`),
  ADD UNIQUE KEY `client_Id` (`client_Id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `dates_jeux`
--
ALTER TABLE `dates_jeux`
  MODIFY `id_dates_jeux` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `gagnants`
--
ALTER TABLE `gagnants`
  MODIFY `gagnant_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lot`
--
ALTER TABLE `lot`
  MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `gagnants`
--
ALTER TABLE `gagnants`
  ADD CONSTRAINT `gagnants_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`),
  ADD CONSTRAINT `gagnants_ibfk_2` FOREIGN KEY (`lot_id`) REFERENCES `lot` (`lot_id`);

--
-- Contraintes pour la table `lot`
--
ALTER TABLE `lot`
  ADD CONSTRAINT `lot_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `log` (`log_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
