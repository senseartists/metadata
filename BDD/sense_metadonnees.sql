-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 31 juil. 2023 à 15:08
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sense_metadonnees`
--

-- --------------------------------------------------------

--
-- Structure de la table `artist`
--

DROP TABLE IF EXISTS `artist`;
CREATE TABLE IF NOT EXISTS `artist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `telephone` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `social_security_number` int DEFAULT NULL,
  `tax_domicile` int DEFAULT NULL,
  `musical_genre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `IPI` int DEFAULT NULL,
  `COAD` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users1` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artist`
--

INSERT INTO `artist` (`id`, `artist_name`, `name`, `surname`, `date_of_birth`, `gender`, `nationality`, `address`, `telephone`, `email`, `social_security_number`, `tax_domicile`, `musical_genre`, `IPI`, `COAD`, `id_users`) VALUES
(1, 'Jeremy Talon', 'Jeremy', 'Talon', NULL, 'Male', 'French', '', 0, '', 0, 0, 'eletronic', 1022393202, '', 1),
(2, 'Enzo Carniel', 'Enzo', 'Carniel', '0000-00-00', 'Male', 'French', '', 0, '', 0, 0, 'eletronic', 0, '', 1),
(3, 'Hugo LX', 'Hugo', 'Lascoux', '0000-00-00', 'Male', 'French', '', 0, '', 0, 0, '', 0, '', 1),
(5, 'Ill Sugi', '', '', '0000-00-00', 'Male', 'Japanese', '', 0, '', 0, 0, '', 0, '', 1),
(6, 'Soprano', 'Said', 'M\'Roumbaba', '1979-01-14', 'Male', 'French', '', 0, '', 0, 0, 'Pop', 0, '', 3),
(7, 'Indila', 'Adila', 'Sedraïa', '1984-06-26', 'Female', 'French', '', 0, '', 0, 0, '', 0, '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `artist_track`
--

DROP TABLE IF EXISTS `artist_track`;
CREATE TABLE IF NOT EXISTS `artist_track` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_track` int NOT NULL,
  `id_artist` int NOT NULL,
  `role_artist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_track` (`id_track`),
  KEY `fk_artist6` (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `artist_track`
--

INSERT INTO `artist_track` (`id`, `id_track`, `id_artist`, `role_artist`) VALUES
(1, 1, 1, 'singer'),
(2, 2, 1, 'Singer'),
(3, 3, 1, 'Singer'),
(4, 4, 6, 'Singer'),
(5, 4, 7, 'Singer');

-- --------------------------------------------------------

--
-- Structure de la table `copyright`
--

DROP TABLE IF EXISTS `copyright`;
CREATE TABLE IF NOT EXISTS `copyright` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_date` int NOT NULL,
  `end_date` int NOT NULL,
  `rights_holder` int NOT NULL,
  `id_artist` int NOT NULL,
  `id_track` int NOT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`id_track`),
  KEY `fk_track3` (`id_track`),
  KEY `fk_artist3` (`id_artist`),
  KEY `fk_users2` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `custom_identifiers`
--

DROP TABLE IF EXISTS `custom_identifiers`;
CREATE TABLE IF NOT EXISTS `custom_identifiers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `platform_name` varchar(255) NOT NULL,
  `identifiant` int NOT NULL,
  `id_track` int NOT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_track` (`id_track`),
  KEY `fk_users3` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `file`
--

DROP TABLE IF EXISTS `file`;
CREATE TABLE IF NOT EXISTS `file` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file1` text NOT NULL,
  `file2` text NOT NULL,
  `file3` text NOT NULL,
  `file4` text NOT NULL,
  `file5` text NOT NULL,
  `id_users` int NOT NULL,
  `id_artist` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_artist5` (`id_artist`),
  KEY `fk_users6` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `file`
--

INSERT INTO `file` (`id`, `file1`, `file2`, `file3`, `file4`, `file5`, `id_users`, `id_artist`) VALUES
(1, 'telechargements/file_64c3e29bbf5721.37851699.jpg', '', '', '', '', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `label`
--

DROP TABLE IF EXISTS `label`;
CREATE TABLE IF NOT EXISTS `label` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `id_users` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `fk_users4` (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `label`
--

INSERT INTO `label` (`id`, `name`, `country`, `id_users`) VALUES
(1, 'Menace', 'France', 1),
(2, 'Parlophone Music', 'France', 3);

-- --------------------------------------------------------

--
-- Structure de la table `link`
--

DROP TABLE IF EXISTS `link`;
CREATE TABLE IF NOT EXISTS `link` (
  `id` int NOT NULL AUTO_INCREMENT,
  `instagram` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `spotify` text NOT NULL,
  `tiktok` text NOT NULL,
  `other` text NOT NULL,
  `id_users` int NOT NULL,
  `id_artist` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users5` (`id_users`),
  KEY `fk_artist4` (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `link`
--

INSERT INTO `link` (`id`, `instagram`, `facebook`, `twitter`, `spotify`, `tiktok`, `other`, `id_users`, `id_artist`) VALUES
(2, '', '', '', 'https://open.spotify.com/intl-fr/artist/3ZCxlp3z1vzDcPN3kgPwcJ', '', '', 1, 1),
(3, 'https://www.instagram.com/sopranopsy4/?hl=fr', '', 'https://twitter.com/Sopranopsy4?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor', 'https://open.spotify.com/intl-fr/artist/2RJBv9wXbW6m539q9NOfW1', '', '', 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `release`
--

DROP TABLE IF EXISTS `release`;
CREATE TABLE IF NOT EXISTS `release` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_release` varchar(255) NOT NULL,
  `date_release` date NOT NULL,
  `type_release` varchar(255) NOT NULL,
  `code_upc` varchar(255) NOT NULL,
  `catalog_number` varchar(255) NOT NULL,
  `id_label` int NOT NULL,
  `id_users` int NOT NULL,
  `id_artist` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_label` (`id_label`),
  KEY `id_users5` (`id_users`),
  KEY `ibfk_release` (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `release`
--

INSERT INTO `release` (`id`, `name_release`, `date_release`, `type_release`, `code_upc`, `catalog_number`, `id_label`, `id_users`, `id_artist`) VALUES
(1, 'Outs', '0000-00-00', 'Album digital', '', 'MNC001', 1, 1, 1),
(2, 'La Colombe et le Corbeau', '0000-00-00', 'Album', '', '', 2, 3, 6);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `track`
--

DROP TABLE IF EXISTS `track`;
CREATE TABLE IF NOT EXISTS `track` (
  `id` int NOT NULL AUTO_INCREMENT,
  `track_number` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` time NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(255) NOT NULL,
  `subgenre` varchar(255) NOT NULL,
  `mood` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pitch/description` text NOT NULL,
  `code_isrc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `code_iswc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_users` int NOT NULL,
  `id_release` int DEFAULT NULL,
  `id_copyright` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ibfk_track` (`id_users`),
  KEY `ibfk_track2` (`id_release`),
  KEY `ibfk_track3` (`id_copyright`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `track`
--

INSERT INTO `track` (`id`, `track_number`, `title`, `duration`, `release_date`, `genre`, `subgenre`, `mood`, `language`, `pitch/description`, `code_isrc`, `code_iswc`, `id_users`, `id_release`, `id_copyright`) VALUES
(1, 1, 'Sides', '02:03:00', '0000-00-00', 'ELECTRONIC', '', '', 'Instrumental', '', 'US25X1900559', NULL, 1, 1, NULL),
(2, 2, 'Deter', '01:21:00', '0000-00-00', 'ELECTRONIC', '', '', 'Instrumental', '', 'US25X1900560', NULL, 1, 1, NULL),
(3, 3, 'Theme', '02:52:00', '0000-00-00', 'ELECTRONIC', '', '', 'Instrumental', '', 'US25X1900561', '0', 1, 1, NULL),
(4, 4, 'Hiro', '04:42:00', '2023-07-31', 'Pop', '', 'Sad', 'French', '', '', '', 3, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `date_of_birth`, `id_role`) VALUES
(1, 'Melissa', 'noupeuhoumelissa@gmail.com', '$2y$10$pn/JDMcnmSCZ09umuQFe1.0i.BL4W4hsM1688xA2sOKrJIQcPKORW', 'female', '2002-09-19', 2),
(2, 'Sense', 'contact@senseartists.com', '$2y$10$k67f84KotmEDzl7qbIGvZOntmsuJ/4cREG/NdzpZiEv0r9zniEkwO', 'female', '2002-09-19', 1),
(3, 'Stage', 'melissa95160@outlook.fr', '$2y$10$EXWBLY/.ikujWa84LBrPR.euC7XORE.fsPLd1hsPGNxbyAFGYYqBS', 'female', '2002-09-19', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `artist`
--
ALTER TABLE `artist`
  ADD CONSTRAINT `fk_users1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `artist_track`
--
ALTER TABLE `artist_track`
  ADD CONSTRAINT `fk_artist6` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_track6` FOREIGN KEY (`id_track`) REFERENCES `track` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `copyright`
--
ALTER TABLE `copyright`
  ADD CONSTRAINT `fk_artist3` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_track3` FOREIGN KEY (`id_track`) REFERENCES `track` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_users2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `custom_identifiers`
--
ALTER TABLE `custom_identifiers`
  ADD CONSTRAINT `fk_track` FOREIGN KEY (`id_track`) REFERENCES `track` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_users3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `fk_artist5` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_users6` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `label`
--
ALTER TABLE `label`
  ADD CONSTRAINT `fk_users4` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `fk_artist4` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_users5` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `release`
--
ALTER TABLE `release`
  ADD CONSTRAINT `ibfk_release` FOREIGN KEY (`id_artist`) REFERENCES `artist` (`id`),
  ADD CONSTRAINT `id_label` FOREIGN KEY (`id_label`) REFERENCES `label` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_users5` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `track`
--
ALTER TABLE `track`
  ADD CONSTRAINT `ibfk_track` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ibfk_track2` FOREIGN KEY (`id_release`) REFERENCES `release` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ibfk_track3` FOREIGN KEY (`id_copyright`) REFERENCES `copyright` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
