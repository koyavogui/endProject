-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 09 déc. 2020 à 17:50
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

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
(59, '101', '', '119', 110, '2020-12-08 04:32:24'),
(61, '101', 'Ajout utilisateur', '122', 110, '2020-12-08 04:32:23'),
(62, '101', 'Modification autorisation', '122', 90, '2020-12-08 04:41:22'),
(63, '101', 'Modification autorisation', '111', 90, '2020-12-08 04:42:34'),
(64, '101', 'Modification autorisation', '120', 90, '2020-12-08 04:42:39'),
(65, '101', 'Modification autorisation', '120', 90, '2020-12-08 04:42:45'),
(66, '101', 'Modification autorisation', '111', 90, '2020-12-08 04:42:50'),
(67, '0', 'Modification autorisation', '111', 90, '2020-12-08 04:42:34'),
(68, '0', 'Modification autorisation', '122', 90, '2020-12-08 05:24:48'),
(69, 'Superviseur: Mack  Simplon', 'Modification autorisation', '122', 90, '2020-12-08 05:25:17'),
(70, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Michel Téan: Superviseur', 90, '2020-12-08 05:32:46'),
(71, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Michel Téan: Superviseur', 90, '2020-12-08 05:34:47'),
(72, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Bloquer Michel Téan: Superviseur', 90, '2020-12-08 05:36:50'),
(73, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Debloquer Michel Téan: Superviseur', 90, '2020-12-08 05:36:54'),
(74, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Bloquer Diomandé GRace: Superviseur', 90, '2020-12-08 05:36:57'),
(75, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Bloquer Gueaba Suzy: Editeur', 90, '2020-12-08 05:37:00'),
(76, 'Administrateur: Mack  Simplon', 'Modification autorisation', 'Debloquer Gueaba Suzy: Editeur', 90, '2020-12-08 05:37:19'),
(77, 'Administrateur: Mack  Simplon', 'Ajout utilisateur', 'Amany Americ: Editeur', 90, '2020-12-08 10:40:32'),
(78, 'Administrateur: Mack  Simplon', 'Ajout utilisateur', 'Esmone Gahié: Superviseur', 90, '2020-12-08 10:50:04'),
(79, 'Editeur: Gueaba Suzy', 'Enregistrement d\'une intélligence non trouvé', 'Q: je voudrais savoir vous avez combien de temps, R: on en a pas assez', 90, '2020-12-08 11:28:50'),
(80, 'Editeur: Gueaba Suzy', 'Enregistrement d\'une intélligence non trouvé', 'Q: je voudrais savoir vous avez combien de temps, R: on en a pas assez', 90, '2020-12-08 11:31:07'),
(81, 'Editeur: Gueaba Suzy', 'Modification d\'intélligence', 'Q: je voudrais savoir vous avez combien de temps, R: on en a pas assez pour vous en faite', 90, '2020-12-08 11:33:42'),
(82, 'Utilisateur', 'Q: ok c\'est compris', 'Une réponse a été trouvée', 90, '2020-12-08 18:28:25'),
(83, 'Utilisateur', 'Q: d\'accord', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:29:33'),
(84, 'Utilisateur', 'Q: ok', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:29:40'),
(85, 'Utilisateur', 'Q: ou bien au pire des cas', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:29:58'),
(86, 'Utilisateur', 'Q: il y a pas de souci je vais', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:30:19'),
(87, 'Utilisateur', 'Q: ok ça compte', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:33:35'),
(88, 'Utilisateur', 'Q: ok c\'est', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:33:39'),
(89, 'Utilisateur', 'Q: ou bien au pays des cas', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:33:50'),
(90, 'Utilisateur', 'Q: ou bien au pire des cas', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:33:57'),
(91, 'Utilisateur', 'Q: ou bien au pire des cas', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:34:07'),
(92, 'Utilisateur', 'Q: ok c\'est compris', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:34:15'),
(93, 'Utilisateur', 'Q: il n\'y a pas de souci je vais', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:34:24'),
(94, 'Utilisateur', 'Q: je voudrais savoir vous avez combien de temps', 'Aucune réponse n’a été trouvée', 90, '2020-12-08 18:34:34'),
(95, '127', 'Enregistrement', 'Création compte adminitration et enregistrement de page', 0, '2020-12-09 06:42:21'),
(96, '127', 'Enregistrement', 'Création compte adminitration et enregistrement de page', 0, '2020-12-09 06:44:13'),
(97, '130', 'Enregistrement', 'Création compte adminitration et enregistrement de page', 0, '2020-12-09 06:47:35'),
(98, '131', 'Enregistrement', 'Création compte adminitration et enregistrement de page', 0, '2020-12-09 07:01:23'),
(99, 'Administrateur: Cohorte 2', 'Ajout utilisateur', 'Kouamé emeron: Editeur', 95, '2020-12-09 07:04:02'),
(100, 'Administrateur: Cohorte 2', 'Ajout utilisateur', 'Rebecca manegbo: Superviseur', 95, '2020-12-09 07:05:51'),
(101, 'Administrateur: Cohorte 2', 'Modification autorisation', 'Bloquer Rebecca manegbo: Superviseur', 95, '2020-12-09 07:06:31'),
(102, 'Administrateur: Cohorte 2', 'Modification autorisation', 'Debloquer Rebecca manegbo: Superviseur', 95, '2020-12-09 07:06:41'),
(103, 'Utilisateur', 'Q: je veux savoir pourquoi vous n\'avez pas des fois', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 07:08:52'),
(104, 'Utilisateur', 'Q: vous êtes nouveau sur la plate-forme', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 07:09:06'),
(105, 'Editeur: Kouamé emeron', 'Enregistrement d\'une intélligence non trouvé', 'Q: vous êtes nouveau sur la plate-forme, R: Oui mais mais nous existons depuis deux ans déjà en côte d\'ivoire', 95, '2020-12-09 07:09:47'),
(106, 'Utilisateur', 'Q: vous êtes nouveau sur la plage', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 07:10:00'),
(107, 'Utilisateur', 'Q: vous êtes nouveau sur la plate-forme', 'Une réponse a été trouvée', 95, '2020-12-09 07:10:09'),
(108, 'Utilisateur', 'Q: non non', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 11:32:36'),
(109, 'Utilisateur', 'Q: vois les choses là', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 11:54:17'),
(110, 'Utilisateur', 'Q: comment ça se dit', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 11:55:36'),
(111, 'Utilisateur', 'Q: les choses', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 11:57:33'),
(112, '134', 'Enregistrement', 'Création compte adminitration et enregistrement de page', 0, '2020-12-09 12:17:19'),
(113, 'Administrateur: Sow assatou', 'Ajout utilisateur', 'Appia  Kwouamé: Editeur', 96, '2020-12-09 12:24:28'),
(114, 'Administrateur: Sow assatou', 'Modification autorisation', 'Bloquer Appia  Kwouamé: Editeur', 96, '2020-12-09 12:24:43'),
(115, 'Administrateur: Sow assatou', 'Modification autorisation', 'Debloquer Appia  Kwouamé: Editeur', 96, '2020-12-09 12:24:51'),
(116, 'Administrateur: Sow assatou', 'Ajout utilisateur', 'Basiti: Superviseur', 96, '2020-12-09 12:25:14'),
(117, 'Utilisateur', 'Q: Bonjour', 'Aucune réponse n’a été trouvée', 96, '2020-12-09 12:27:01'),
(118, 'Utilisateur', 'Q: pourquoi tu n\'as pas là', 'Aucune réponse n’a été trouvée', 96, '2020-12-09 12:27:14'),
(119, 'Utilisateur', 'Q: Bonjour', 'Aucune réponse n’a été trouvée', 95, '2020-12-09 12:27:23'),
(120, 'Editeur: Appia  Kwouamé', 'Enregistrement d\'une intélligence non trouvé', 'Q: Bonjour, R: Bonjour comment vous allez ?', 96, '2020-12-09 12:30:58'),
(121, 'Utilisateur', 'Q: Bonjour', 'Une réponse a été trouvée', 96, '2020-12-09 12:31:16'),
(122, 'Editeur: Appia  Kwouamé', 'Modification d\'intélligence', 'Q: Bonjour | salut | comment ça va ?| hello | il y a quelqu\'un, R: Bonjour comment vous allez ?', 96, '2020-12-09 12:32:01'),
(123, 'Utilisateur', 'Q: Salut', 'Une réponse a été trouvée', 96, '2020-12-09 12:36:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`idActivite`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
