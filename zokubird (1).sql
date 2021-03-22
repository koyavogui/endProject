-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 mars 2021 à 11:45
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zokubird`
--

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE `activities` (
  `idActivite` int(11) NOT NULL,
  `authorActivity` varchar(300) NOT NULL,
  `actionActivity` text NOT NULL,
  `descActivity` text NOT NULL,
  `page` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`idActivite`, `authorActivity`, `actionActivity`, `descActivity`, `page`, `create_at`) VALUES
(125, 'Administrateur: Sow assatou', 'Modification autorisation', 'Debloquer Basiti: Superviseur', 96, '2021-02-27 09:19:34'),
(126, 'Administrateur: Sow assatou', 'Modification autorisation', 'Bloquer Basiti: Superviseur', 96, '2021-02-27 09:19:38'),
(127, 'Administrateur: Sow assatou', 'Modification autorisation', 'Debloquer Basiti: Superviseur', 96, '2021-02-27 09:19:41'),
(128, 'Utilisateur', 'Q: Bonjour comment', 'Une réponse a été trouvée', 96, '2021-02-27 09:35:17'),
(129, 'Utilisateur', 'Q: je vais bien et chez vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:35:26'),
(130, 'Utilisateur', 'Q: qui êtes-vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:35:34'),
(131, 'Editeur: Appia  Kwouamé', 'Ajout d\'intélligence', 'Q: qui êtes vous ?, R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 09:36:23'),
(132, 'Utilisateur', 'Q: qui êtes-vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:36:29'),
(133, 'Utilisateur', 'Q: qui êtes-vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:36:38'),
(134, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous, R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 09:36:57'),
(135, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-02-27 09:37:01'),
(136, 'Utilisateur', 'Q: parler', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:37:07'),
(137, 'Utilisateur', 'Q: parlez-moi de vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:37:11'),
(138, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous, R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 09:37:46'),
(139, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous |dite moi plus sur vous, R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 09:38:52'),
(140, 'Utilisateur', 'Q: dites-moi plus sur vous', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 09:40:09'),
(141, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous | dites-moi plus sur vous, R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 09:40:27'),
(142, 'Utilisateur', 'Q: dites-moi plus', 'Une réponse a été trouvée', 96, '2021-02-27 09:40:38'),
(143, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous | dites-moi plus sur vous , R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-02-27 13:04:16'),
(144, 'Utilisateur', 'Q: après après', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 13:15:16'),
(145, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-02-27 13:15:31'),
(146, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-02-27 13:47:31'),
(147, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-02-27 13:47:38'),
(148, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-02-27 13:48:22'),
(149, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-02-27 13:48:55'),
(150, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-02-27 13:51:01'),
(151, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-02-27 13:51:07'),
(152, 'Utilisateur', 'Q: comment vous contacter', 'Aucune réponse n’a été trouvée', 96, '2021-02-27 13:51:13'),
(153, 'Editeur: Appia  Kwouamé', 'Enregistrement d\'une intélligence non trouvé', 'Q: comment vous contacter, R: Pour nous contacter veillez pensez à un beau plat de spagheti', 96, '2021-02-27 13:53:21'),
(154, 'Utilisateur', 'Q: comment vous contacter', 'Une réponse a été trouvée', 96, '2021-02-27 13:53:31'),
(155, 'Administrateur: Sow assatou', 'Ajout utilisateur', 'Innoce: Editeur', 96, '2021-02-27 13:56:28'),
(156, 'Editeur: Innoce', 'Modification autorisation', 'Bloquer Innoce: Editeur', 96, '2021-02-27 13:56:57'),
(157, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-03-03 08:31:36'),
(158, 'Utilisateur', 'Q: je vais bien et vous', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 08:31:43'),
(159, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:31:51'),
(160, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:32:41'),
(161, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:32:55'),
(162, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-03-03 08:34:07'),
(163, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous | dites-moi plus sur vous , R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-03-03 08:37:09'),
(164, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:37:49'),
(165, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:38:48'),
(166, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:41:56'),
(167, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:46:31'),
(168, 'Utilisateur', 'Q: parle-moi de', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 08:50:02'),
(169, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 08:50:10'),
(170, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: qui êtes vous ? | qui êtes-vous |  parlez-moi de vous | dites-moi plus sur vous , R: Nous sommes le meilleur Kiosque de spaghetti au monde', 96, '2021-03-03 09:03:25'),
(171, 'Utilisateur', 'Q: mets joker', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:09:50'),
(172, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:09:54'),
(173, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:11:52'),
(174, 'Utilisateur', 'Q: qui est', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:14:29'),
(175, 'Utilisateur', 'Q: qui est vous', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:14:35'),
(176, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:14:42'),
(177, 'Utilisateur', 'Q: Kiabi', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:16:14'),
(178, 'Utilisateur', 'Q: qu\'y a-t-il', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:16:18'),
(179, 'Utilisateur', 'Q: je n\'ai pas la réponse à cette question', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:16:23'),
(180, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:16:32'),
(181, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2021-03-03 09:17:44'),
(182, 'Utilisateur', 'Q: qui êtes-vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:17:48'),
(183, 'Utilisateur', 'Q: qui est', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:19:24'),
(184, 'Utilisateur', 'Q: je veux savoir', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:21:04'),
(185, 'Utilisateur', 'Q: mais pourquoi on fait', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:22:25'),
(186, 'Utilisateur', 'Q: pourquoi vous faites', 'Aucune réponse n’a été trouvée', 96, '2021-03-03 09:22:32'),
(187, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:30:25'),
(188, 'Utilisateur', 'Q: parlez-moi de vous', 'Une réponse a été trouvée', 96, '2021-03-03 09:30:42');

-- --------------------------------------------------------

--
-- Structure de la table `echecs`
--

CREATE TABLE `echecs` (
  `idEchec` int(11) NOT NULL,
  `questionEchec` varchar(500) NOT NULL,
  `ipEchec` varchar(500) NOT NULL,
  `statusEchec` int(11) NOT NULL DEFAULT 0,
  `idPage` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `echecs`
--

INSERT INTO `echecs` (`idEchec`, `questionEchec`, `ipEchec`, `statusEchec`, `idPage`, `create_at`) VALUES
(33, 'je vais bien et chez vous', '192.02.258.15', 0, 96, '2021-02-27 09:35:26'),
(34, 'qui êtes-vous', '192.02.258.15', 1, 96, '2021-02-27 13:05:23'),
(35, 'qui êtes-vous', '192.02.258.15', 1, 96, '2021-02-27 13:05:19'),
(36, 'qui êtes-vous', '192.02.258.15', 1, 96, '2021-02-27 13:05:15'),
(37, 'parler', '192.02.258.15', 0, 96, '2021-02-27 09:37:07'),
(38, 'parlez-moi de vous', '192.02.258.15', 0, 96, '2021-02-27 09:37:11'),
(39, 'dites-moi plus sur vous', '192.02.258.15', 0, 96, '2021-02-27 09:40:08'),
(40, 'après après', '192.02.258.15', 0, 96, '2021-02-27 13:15:16'),
(41, 'comment vous contacter', '192.02.258.15', 1, 96, '2021-02-27 13:53:21'),
(42, 'je vais bien et vous', '192.02.258.15', 0, 96, '2021-03-03 08:31:43'),
(43, 'parle-moi de', '192.02.258.15', 0, 96, '2021-03-03 08:50:02'),
(44, 'mets joker', '192.02.258.15', 0, 96, '2021-03-03 09:09:50'),
(45, 'qui est', '192.02.258.15', 0, 96, '2021-03-03 09:14:29'),
(46, 'qui est vous', '192.02.258.15', 0, 96, '2021-03-03 09:14:35'),
(47, 'Kiabi', '192.02.258.15', 0, 96, '2021-03-03 09:16:13'),
(48, 'qu\'y a-t-il', '192.02.258.15', 0, 96, '2021-03-03 09:16:18'),
(49, 'je n\'ai pas la réponse à cette question', '192.02.258.15', 0, 96, '2021-03-03 09:16:23'),
(50, 'qui est', '192.02.258.15', 0, 96, '2021-03-03 09:19:24'),
(51, 'je veux savoir', '192.02.258.15', 0, 96, '2021-03-03 09:21:04'),
(52, 'mais pourquoi on fait', '192.02.258.15', 0, 96, '2021-03-03 09:22:25'),
(53, 'pourquoi vous faites', '192.02.258.15', 0, 96, '2021-03-03 09:22:32');

-- --------------------------------------------------------

--
-- Structure de la table `intellects`
--

CREATE TABLE `intellects` (
  `idIntellect` int(11) NOT NULL,
  `questionsIntellect` varchar(500) NOT NULL,
  `answersIntellect` varchar(500) NOT NULL,
  `imageIntellect` varchar(100) NOT NULL,
  `ressourceIntelect` text NOT NULL,
  `userIntellect` int(10) NOT NULL,
  `pageIntellect` int(10) NOT NULL,
  `statusEchec` int(11) NOT NULL DEFAULT 0,
  `create_at` date NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `intellects`
--

INSERT INTO `intellects` (`idIntellect`, `questionsIntellect`, `answersIntellect`, `imageIntellect`, `ressourceIntelect`, `userIntellect`, `pageIntellect`, `statusEchec`, `create_at`, `update_at`) VALUES
(19, 'qui êtes vous ? | qui êtes-vous |  parlez-moi de vous | dites-moi plus sur vous ', 'Nous sommes le meilleur Kiosque de spaghetti au monde', '', 'https://www.youtube.com/embed/ogAhBq2CrvY', 135, 96, 0, '2021-02-27', '2021-03-03 09:15:58'),
(20, 'comment vous contacter', 'Pour nous contacter veillez pensez à un beau plat de spagheti', '', '', 135, 96, 41, '2021-02-27', '2021-02-27 13:53:21');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `numPage` int(11) NOT NULL,
  `nomPage` varchar(100) NOT NULL,
  `userPage` int(50) NOT NULL,
  `countriePage` int(50) NOT NULL,
  `cityPage` int(50) NOT NULL,
  `adressPage` varchar(60) NOT NULL,
  `emailPage` varchar(60) NOT NULL,
  `imgPage` varchar(50) NOT NULL,
  `descPage` varchar(50) NOT NULL,
  `nomDossierPage` varchar(200) NOT NULL,
  `youtubePage` varchar(50) NOT NULL,
  `facebookPage` varchar(60) NOT NULL,
  `twitterPage` varchar(60) NOT NULL,
  `sitePage` varchar(60) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`numPage`, `nomPage`, `userPage`, `countriePage`, `cityPage`, `adressPage`, `emailPage`, `imgPage`, `descPage`, `nomDossierPage`, `youtubePage`, `facebookPage`, `twitterPage`, `sitePage`, `create_at`) VALUES
(90, 'Mouvement Flambeaux-Lumières de Côte d\'Ivoire', 101, 1, 79, '', 'editeur@gmail.com', 'pageBird_5fbc4d315ee001606176049_394.jpg', '', 'mouvementflambeauxlumieresdecotedivoire', '', '', '', '', '2020-10-28 01:10:37'),
(96, 'sowassatou', 134, 1, 10, 'Liberté', 'spaguetthi@gmail.com', 'pageBird_603a2b5f969ce1614424927_681.jpg', '  Meilleur restaurant pour le spaghetti', 'sowassatou', '', '', '', '', '2020-12-09 12:17:18'),
(97, 'simplon.ci', 137, 1, 79, 'Ens', '', '', '', 'simplon.ci', '', '', '', '', '2020-12-22 15:51:23');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `idPays` int(11) NOT NULL,
  `nomPays` varchar(255) NOT NULL,
  `descriptionPays` text NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `img` text NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`idPays`, `nomPays`, `descriptionPays`, `lat`, `lng`, `img`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(1, 'CÃ´te d\'Ivoire', 'La CÃ´te d\'Ivoire est un pays d\'Afrique de l\'Ouest dotÃ© de stations balnÃ©aires, de forÃªts tropicales et d\'un patrimoine colonial franÃ§ais. Abidjan, sur la cÃ´te Atlantique, est le principal centre urbain du pays. Ses sites modernes regroupent la Pyramide, un Ã©difice en bÃ©ton faisant penser Ã  une ziggourat. La cathÃ©drale Saint-Paul est une structure inclinÃ©e rattachÃ©e Ã  une immense croix. Au nord du quartier central des affaires, le parc national du Banco est une rÃ©serve de forÃªt tropicale au sein de laquelle serpentent des chemins de randonnÃ©e.', -5.347744, 6.855122, 'cover.jpeg', '2020-10-19 23:45:57', '2020-10-19 23:45:57', 39),
(2, 'Ghana', '', 0, 0, '', '2020-10-19 23:45:57', '2020-10-19 23:45:57', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(50) NOT NULL,
  `fullNamesUser` varchar(50) NOT NULL,
  `emailUser` varchar(225) NOT NULL,
  `phoneUser` varchar(225) NOT NULL,
  `passwordUser` text NOT NULL,
  `roleUser` varchar(30) NOT NULL,
  `statusUser` int(11) NOT NULL,
  `parentUser` int(11) NOT NULL,
  `imageUser` varchar(100) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `fullNamesUser`, `emailUser`, `phoneUser`, `passwordUser`, `roleUser`, `statusUser`, `parentUser`, `imageUser`, `create_at`) VALUES
(138, 'Innoce', 'innocent@gmail.com', '080505404', '$2y$10$nBkWR2qxQyaPD5xhKR/W8.sHz5VZQ9mjJiV4pbomkqaDo2gee7Hb.', 'Editeur', 1, 134, '', '2021-02-27 13:56:28');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `idVille` int(11) NOT NULL,
  `nomVille` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `descriptionVille` text COLLATE utf8_estonian_ci NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `img` text COLLATE utf8_estonian_ci NOT NULL,
  `idPays` int(11) NOT NULL,
  `dateAjout` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateModification` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

--
-- Déchargement des données de la table `ville`
--

INSERT INTO `ville` (`idVille`, `nomVille`, `descriptionVille`, `lat`, `lng`, `img`, `idPays`, `dateAjout`, `dateModification`, `idUtilisateur`) VALUES
(10, 'adjame', '', 5.36507, -4.02357, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 39),
(11, 'attecoube', '', 5.33625, -4.04145, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 39),
(12, 'cocody', '', 5.36022, -3.96744, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 39),
(13, 'koumassi', '', 5.30298, -3.94194, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(14, 'marcory', '', 5.30271, -3.98274, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(15, 'plateau', '', 5.32332, -4.02357, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(16, 'portbouet', '', 5.27725, -3.8859, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(17, 'treichville', '', 5.29209, -4.01336, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(18, 'yopougon', '', 5.31767, -4.08999, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(19, 'abengourou', '', 6.7157, -3.48013, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(20, 'aboisso', '', 5.47451, -3.20308, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(21, 'adzope', '', 6.10715, -3.85535, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(22, 'agboville', '', 5.9355, -4.22308, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(23, 'agnibilekrou', '', 7.13028, -3.20308, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(24, 'anyama', '', 5.48771, -4.05166, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(26, 'beoumi', '', 7.67309, -5.57223, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(27, 'bingerville', '', 5.35036, -3.87571, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(28, 'bocanda', '', 7.06591, -4.49543, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(29, 'bondoukou', '', 8.04788, -2.80786, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(30, 'bongouanou', '', 6.6487, -4.20515, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(31, 'bonoua', '', 5.27118, -3.59393, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(33, 'boundiali', '', 9.51836, -6.48232, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(34, 'dabou', '', 5.32621, -4.36679, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(35, 'daloa', '', 6.88833, -6.43969, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(36, 'bouaflÃ©', '', 6.98274, -5.74051, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(37, 'dananÃ©', '', 7.2676, -8.14478, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(38, 'daoukro', '', 7.0654, -3.95724, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(39, 'dimbokro', '', 6.65747, -4.71223, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(40, 'divo', '', 5.84154, -5.36255, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(41, 'douekoue', '', 6.74738, -7.36246, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(42, 'ferkessedougou', '', 9.5842, -5.19536, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(43, 'gagnoa', '', 6.15144, -5.95154, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(44, 'gohitafla', '', 7.48828, -5.88024, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(45, 'grandlahou', '', 5.13652, -5.02605, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(46, 'grandbassam', '', 5.22594, -3.75367, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(47, 'Grand-Bereby', '', 4.65137, -6.92205, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(48, 'guiglo', '', 6.54906, -7.49765, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(49, 'issia', '', 6.48761, -6.58368, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(50, 'jacqueville', '', 5.20598, -4.42335, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(52, 'katiola', '', 8.14023, -5.09631, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(53, 'korhogo', '', 9.46693, -5.61426, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(55, 'mbahiakro', '', 7.4548, -4.3411, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(58, 'mankono', '', 8.05991, -6.18983, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(59, 'odienne', '', 9.51888, -7.55722, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(60, 'oumÃ©', '', 6.37413, -5.40966, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(61, 'sassandra', '', 4.95128, -6.09175, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(62, 'seguela', '', 7.96018, -6.6745, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(63, 'sinfra', '', 6.62334, -5.91456, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(64, 'soubrÃ©', '', 5.78662, -6.58902, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(65, 'tengrela', '', 10.482, -6.41306, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(66, 'tiassale', '', 5.90426, -4.82614, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(67, 'Toulepleu', '', 6.57956, -8.4102, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(68, 'toumodi', '', 6.55603, -5.01565, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(69, 'vavoua', '', 7.37506, -6.47699, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(70, 'yamoussoukro', '', 6.82762, -5.28934, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(71, 'zuenoula', '', 7.42404, -6.05204, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(72, 'Bouna', '', 9.27166, -2.99256, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(73, 'lakota', '', 5.85947, -5.67735, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(74, 'kani', '', 8.47784, -6.60504, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(75, 'man', '', 7.40643, -7.55722, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(76, 'dabakala', '', 8.36626, -4.43364, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(77, 'kong', '', 9.15102, -4.61018, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(78, 'Touba', '', 8.28417, -7.68194, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(79, 'bouake', '', 7.69047, -5.03905, '', 1, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(80, 'Accra', '', 5.5600141, -0.2057437, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(81, 'Kumasi', '', 6.698081, -1.6230404, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(82, 'Tamale', '', 9.4051992, -0.8423986, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(83, 'Sekondi-Takoradi', '', 4.927456, -1.7490216, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(84, 'Ashaiman', '', 5.694385, -0.029529, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0),
(85, 'Sunyani', '', 7.3384389, -2.3309226, '', 2, '2020-10-19 23:43:28', '2020-10-19 23:43:28', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`idActivite`);

--
-- Index pour la table `echecs`
--
ALTER TABLE `echecs`
  ADD PRIMARY KEY (`idEchec`);

--
-- Index pour la table `intellects`
--
ALTER TABLE `intellects`
  ADD PRIMARY KEY (`idIntellect`);

--
-- Index pour la table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`numPage`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT pour la table `echecs`
--
ALTER TABLE `echecs`
  MODIFY `idEchec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `intellects`
--
ALTER TABLE `intellects`
  MODIFY `idIntellect` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `pages`
--
ALTER TABLE `pages`
  MODIFY `numPage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
