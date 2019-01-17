-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour orm
CREATE DATABASE IF NOT EXISTS `orm` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `orm`;

-- Listage de la structure de la table orm. article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(36) NOT NULL,
  `descr` text,
  `tarif` decimal(10,2) DEFAULT NULL,
  `id_categ` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- Listage des données de la table orm.article : ~3 rows (environ)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `nom`, `descr`, `tarif`, `id_categ`) VALUES
	(64, 'velo', 'beau velo de course rouge', 59.95, 1),
	(65, 'biclou', 'beau velo de course bleu', 214.56, 1),
	(66, 'roller', 'roller presque neufs', 66.66, 1),
	(67, 'velo', 'test1', 59.95, 1),
	(68, 'biclou', 'test2', 214.56, 1);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Listage de la structure de la table orm. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `descr` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table orm.categorie : ~0 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id`, `nom`, `descr`) VALUES
	(1, 'sport', 'articles de sport');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
