-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.11.1-MariaDB - mariadb.org binary distribution
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
DROP DATABASE IF EXISTS `carpool`;
CREATE DATABASE IF NOT EXISTS `carpool` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `carpool`;

-- Listage de la structure de la table carpool. carpooling
DROP TABLE IF EXISTS `carpooling`;
CREATE TABLE IF NOT EXISTS `carpooling` (
  `id` int(11) NOT NULL,
  `Carpooling_time` datetime NOT NULL,
  `Carpolling_3/4` tinyint(2) NOT NULL,
  `Driver_id` int(11) NOT NULL,
  `Driver_validate` varchar(45) NOT NULL,
  `Places_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Carpooling_teachers_idx` (`Driver_id`),
  KEY `fk_Carpooling_Places1_idx` (`Places_id`),
  CONSTRAINT `fk_Carpooling_Places1` FOREIGN KEY (`Places_id`) REFERENCES `places` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Carpooling_teachers` FOREIGN KEY (`Driver_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table carpool. edt
DROP TABLE IF EXISTS `edt`;
CREATE TABLE IF NOT EXISTS `edt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EDT_schedule` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idEDT_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table carpool. edtread
DROP TABLE IF EXISTS `edtread`;
CREATE TABLE IF NOT EXISTS `edtread` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duree` varchar(50) DEFAULT '0',
  `frequence` varchar(3) DEFAULT '0',
  `professeur` varchar(50) DEFAULT '0',
  `abrev` varchar(3) DEFAULT '0',
  `codemat` varchar(15) DEFAULT '0',
  `classe` varchar(350) DEFAULT '0',
  `jour` varchar(10) DEFAULT '0',
  `heure` varchar(5) DEFAULT '0',
  `semaines` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=530 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table carpool. edt_has_teachers
DROP TABLE IF EXISTS `edt_has_teachers`;
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

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la procédure carpool. edt_treat
DROP PROCEDURE IF EXISTS `edt_treat`;
DELIMITER //
CREATE PROCEDURE `edt_treat`()
BEGIN
 
DECLARE myvar MEDIUMTEXT ;
DECLARE myrow MEDIUMTEXT DEFAULT '0';
DECLARE myvalue VARCHAR(1500);
DECLARE intfor INT DEFAULT 2;
DECLARE myduree VARCHAR(50);
DECLARE myfrec VARCHAR(3); 
DECLARE myname VARCHAR(50);
DECLARE myabv VARCHAR(3);
DECLARE mymat VARCHAR(15);
DECLARE myclass VARCHAR(350);
DECLARE myday VARCHAR(10);
DECLARE mytime VARCHAR(5);
declare myweek VARCHAR(50);



-- Assigning the string to the variable 

SET myvar = (SELECT EDT_schedule  FROM edt);

WHILE myrow != '' DO

set myrow = (SELECT SUBSTRING_INDEX(myvar ,'\r\n',intfor));
SET myrow = (select SUBSTRING_INDEX(myrow ,'\r\n',-1));

if myrow != '' then
FOR i IN 2..18
DO 
set myvalue = (SELECT SUBSTRING_INDEX(myrow ,';',i));
SET myvalue = (select SUBSTRING_INDEX(myvalue ,';',-1));
if i = 2 then
SET myduree = myvalue;
ELSEIF i = 3 then
SET myfrec = myvalue;
ELSEIF i = 4 then
SET myname = myvalue;
ELSEIF i = 5 && (myname != '') then
SET myabv = myvalue;
ELSEIF i = 6 then
SET mymat = myvalue;
ELSEIF i = 8 && (myname != '') then
SET myclass = myvalue;
ELSEIF i = 15 then
SET myday = myvalue;
ELSEIF i = 16 then
SET mytime = myvalue;
ELSEIF i = 18 then
SET myweek = myvalue;
END if;
END FOR;

if myname != '' then
INSERT INTO edtread (duree, frequence ,professeur, abrev, codemat, classe, jour, heure, semaines) 
VALUES (myduree, myfrec, myname, myabv, mymat, myclass, myday, mytime, myweek );
END if;
END if;
SET intfor = intfor +1;
END while;
insert into teachers (acronyme, teacher_lastname) SELECT distinct  abrev , professeur FROM carpool.edtread; 
END//
DELIMITER ;

-- Listage de la structure de la table carpool. places
DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Place_name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Place_name_UNIQUE` (`Place_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table carpool. teachers
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronyme` varchar(3) DEFAULT NULL,
  `teacher_lastname` varchar(45) DEFAULT NULL,
  `teacher_Password` varchar(45) DEFAULT NULL,
  `teacher_car_seats` int(4) DEFAULT NULL,
  `teacher_email` varchar(200) DEFAULT NULL,
  `Places_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronyme` (`acronyme`),
  KEY `fk_teachers_Places1_idx` (`Places_id`),
  CONSTRAINT `fk_teachers_Places1` FOREIGN KEY (`Places_id`) REFERENCES `places` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table carpool. teachers_has_carpooling
DROP TABLE IF EXISTS `teachers_has_carpooling`;
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

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
