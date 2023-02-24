-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.10.1-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour carpool
CREATE DATABASE IF NOT EXISTS `carpool` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `carpool`;

-- Listage de la structure de la table carpool. carpooling
CREATE TABLE IF NOT EXISTS `carpooling` (
  `id` int(11) NOT NULL,
  `Carpooling_time` datetime NOT NULL,
  `Carpolling_3/4` tinyint(2) NOT NULL,
  `Driver_id` int(11) NOT NULL,
  `Driver_validate` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Places_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Carpooling_teachers_idx` (`Driver_id`),
  KEY `fk_Carpooling_Places1_idx` (`Places_id`),
  CONSTRAINT `fk_Carpooling_Places1` FOREIGN KEY (`Places_id`) REFERENCES `places` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Carpooling_teachers` FOREIGN KEY (`Driver_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.carpooling : ~0 rows (environ)
/*!40000 ALTER TABLE `carpooling` DISABLE KEYS */;
/*!40000 ALTER TABLE `carpooling` ENABLE KEYS */;

-- Listage de la structure de la table carpool. edt
CREATE TABLE IF NOT EXISTS `edt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EDT_schedule` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idEDT_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.edt : ~0 rows (environ)
/*!40000 ALTER TABLE `edt` DISABLE KEYS */;
INSERT INTO `edt` (`id`, `EDT_schedule`) VALUES
	(1, 'NUMERO;DURÉE;FRÉQUENCE;PROFESSEUR;ABREV.;CODEMAT;MATIERE;CLASSE;SALLE;DISCIPLI;ALT;MOD;PONDERE;REPART;JOUR;HEURE;TYPE;SEMAINES\r\n1;4h00;H;Margairaz;JMZ;MATH;Mathématiques;YA-T1a;YV-C210;;S2;CG;1;;lundi;07h00;COURS;[24..25,28..33]\r\n2;3h00;H;Boinot;JBT;PHYGEN;Physique;YA-T1a-b{YA-T1a, YA-T1b};YV-C211;;H;CG;1;;lundi;01h00;COURS;[24..25,27..33]\r\n3;1h00;H;Lio;ELO;1-AAL;Acc. l\'alimentation;YS-MI1a;YV-A102;;S2;CG;1;;jeudi;05h00;COURS;[24..25,27..33]\r\n4;2h00;H;Pillonel;OPL;1-EQR;Env. quotidien et relations;YS-MI1a;YV-A102;;S2;CG;1;;jeudi;03h00;COURS;[24..25,27]\r\n5;2h00;H;Schnyder;SSR;SOCI;Société;YS-C2k;YV-D101;;H;CG;1;;mercredi;04h00;COURS;[24..25,27..29,31..33]\r\n6;1h00;H;Chenevard;LCD;COMCOL;Communication;YS-C3g;YV-D006;;22;CG;1;;lundi;01h00;COURS;[24..25,27..33]\r\n7;1h00;H;Steinmann;ASN;LACO;Langue et communication;YS-C2g;YV-D003;;H;CG;1;;mercredi;03h00;COURS;[24..25,27..33]\r\n8;1h00;H;Schnyder;SSR;LACO;Langue et communication;YS-C2k;YV-D101;;H;CG;1;;mercredi;03h00;COURS;[24..25,27..29,31..33]\r\n9;2h00;H;Toro Breijo;PTO;SOCIO_MP;Sciences sociales MP;YS-MI1a;YV-A102;;H;CG;1;;vendredi;09h00;COURS;[24..25,27..32]\r\n');
/*!40000 ALTER TABLE `edt` ENABLE KEYS */;

-- Listage de la structure de la table carpool. edtline
CREATE TABLE IF NOT EXISTS `edtline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edtline` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.edtline : ~0 rows (environ)
/*!40000 ALTER TABLE `edtline` DISABLE KEYS */;
/*!40000 ALTER TABLE `edtline` ENABLE KEYS */;

-- Listage de la structure de la table carpool. edtread
CREATE TABLE IF NOT EXISTS `edtread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `durée` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `frequence` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `professeur` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `abrev` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `codemat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `matière` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `classe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `discipline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `alt` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `mod` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `pondere` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `repart` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `jour` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `heure` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `semaines` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.edtread : ~0 rows (environ)
/*!40000 ALTER TABLE `edtread` DISABLE KEYS */;
/*!40000 ALTER TABLE `edtread` ENABLE KEYS */;

-- Listage de la structure de la table carpool. edt_has_teachers
CREATE TABLE IF NOT EXISTS `edt_has_teachers` (
  `EDT_id` int(11) NOT NULL,
  `teachers_id` int(11) NOT NULL,
  `Starting_hour` datetime NOT NULL,
  `Finnishing_hour` datetime NOT NULL,
  PRIMARY KEY (`EDT_id`,`teachers_id`),
  KEY `fk_EDT_has_teachers_teachers1_idx` (`teachers_id`),
  KEY `fk_EDT_has_teachers_EDT1_idx` (`EDT_id`),
  CONSTRAINT `fk_EDT_has_teachers_EDT1` FOREIGN KEY (`EDT_id`) REFERENCES `edt` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_EDT_has_teachers_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.edt_has_teachers : ~0 rows (environ)
/*!40000 ALTER TABLE `edt_has_teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `edt_has_teachers` ENABLE KEYS */;

-- Listage de la structure de la procédure carpool. edt_treat
DELIMITER //
CREATE PROCEDURE `edt_treat`()
BEGIN
 
DECLARE myvar MEDIUMTEXT ;
DECLARE myrow MEDIUMTEXT DEFAULT '0';
DECLARE intfor INT DEFAULT 2;

-- Assigning the string to the variable

SET myvar = (SELECT EDT_schedule  FROM edt);

WHILE myrow != '' DO

set myrow = (SELECT SUBSTRING_INDEX(myvar ,'\r\n',intfor));
SET myrow = (select SUBSTRING_INDEX(myrow ,'\r\n',-1));
if myrow != '' then
INSERT INTO edtline (edtline) VALUES (myrow);
END if;
SET intfor = intfor +1;
END while;
END//
DELIMITER ;

-- Listage de la structure de la procédure carpool. edt_treat2
DELIMITER //
CREATE PROCEDURE `edt_treat2`()
BEGIN
 
DECLARE myvar MEDIUMTEXT ;
DECLARE myrow VARCHAR(1500);


-- Assigning the string to the variable

SET myvar = (SELECT EDTline  FROM edtline LIMIT 1);


FOR i IN 2..17
DO 
set myrow = (SELECT SUBSTRING_INDEX(myvar ,';',i));
SET myrow = (select SUBSTRING_INDEX(myrow ,';',-1));
INSERT INTO edtread (edtline) VALUES (myrow);

END for;
END//
DELIMITER ;

-- Listage de la structure de la table carpool. places
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Place_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Place_name_UNIQUE` (`Place_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.places : ~0 rows (environ)
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
/*!40000 ALTER TABLE `places` ENABLE KEYS */;

-- Listage de la structure de la table carpool. teachers
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_firstname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_lastname` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_Password` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_car_seats` int(4) NOT NULL,
  `teacher_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Places_id` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teacher_email_UNIQUE` (`teacher_email`),
  KEY `fk_teachers_Places1_idx` (`Places_id`),
  CONSTRAINT `fk_teachers_Places1` FOREIGN KEY (`Places_id`) REFERENCES `places` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.teachers : ~0 rows (environ)
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;

-- Listage de la structure de la table carpool. teachers_has_carpooling
CREATE TABLE IF NOT EXISTS `teachers_has_carpooling` (
  `teachers_id` int(11) NOT NULL,
  `Carpooling_id` int(11) NOT NULL,
  `teacher_validation` tinyint(2) NOT NULL,
  PRIMARY KEY (`teachers_id`,`Carpooling_id`),
  KEY `fk_teachers_has_Carpooling_Carpooling1_idx` (`Carpooling_id`),
  KEY `fk_teachers_has_Carpooling_teachers1_idx` (`teachers_id`),
  CONSTRAINT `fk_teachers_has_Carpooling_Carpooling1` FOREIGN KEY (`Carpooling_id`) REFERENCES `carpooling` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_teachers_has_Carpooling_teachers1` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table carpool.teachers_has_carpooling : ~0 rows (environ)
/*!40000 ALTER TABLE `teachers_has_carpooling` DISABLE KEYS */;
/*!40000 ALTER TABLE `teachers_has_carpooling` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
