-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 août 2018 à 15:16
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `symfonyajax`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BFDD3168A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `title`, `content`) VALUES
(1, 2, 'Mon chapeau', 'Je vends mon chapeau'),
(2, 3, 'ma bagnole', 'Je vends ma Citroen'),
(3, 3, 'une belle maison', 'Je vends ma ma maison'),
(4, 4, 'Mon Chat', 'Je vends mon Chat'),
(5, 5, 'Mon Annonce', 'J achtète tout'),
(6, 6, 'Mon Truc trop cher', 'Je vends mon truc de user 6'),
(7, 7, 'Mon annonce de user 7', 'Je vends mon contenu de user 7'),
(8, 8, 'Mon annonce de user 8', 'Je vends mon contenu de user 8');

-- --------------------------------------------------------

--
-- Structure de la table `follower`
--

DROP TABLE IF EXISTS `follower`;
CREATE TABLE IF NOT EXISTS `follower` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `followed_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B9D60946AC24F853` (`follower_id`),
  KEY `IDX_B9D60946D956F010` (`followed_id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `follower`
--

INSERT INTO `follower` (`id`, `follower_id`, `followed_id`) VALUES
(167, 1, 4),
(179, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20180814123926'),
('20180814152611'),
('20180814222921'),
('20180814223541'),
('20180815221152'),
('20180815225758'),
('20180816092309');

-- --------------------------------------------------------

--
-- Structure de la table `number`
--

DROP TABLE IF EXISTS `number`;
CREATE TABLE IF NOT EXISTS `number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `number`
--

INSERT INTO `number` (`id`, `value`, `created_at`) VALUES
(281, '0', '2018-08-14'),
(282, '0', '2018-08-14'),
(283, '0', '2018-08-15'),
(284, '0', '2018-08-15'),
(285, '0', '2018-08-15'),
(286, '0', '2018-08-15'),
(287, '0', '2018-08-15'),
(288, '0', '2018-08-15'),
(289, '0', '2018-08-15'),
(290, '0', '2018-08-15'),
(291, '0', '2018-08-15'),
(292, '0', '2018-08-15'),
(293, '0', '2018-08-15'),
(294, '0', '2018-08-15'),
(295, '0', '2018-08-15');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'sandro'),
(2, 'John'),
(3, 'Richardson'),
(4, 'Bibi'),
(5, 'Léo'),
(6, 'George'),
(7, 'Bradley'),
(8, 'Greenwood');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_BFDD3168A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `FK_B9D60946AC24F853` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_B9D60946D956F010` FOREIGN KEY (`followed_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
