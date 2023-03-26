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


-- Listage de la structure de la base pour snows
CREATE DATABASE IF NOT EXISTS `snows` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci */;
USE `snows`;

-- Listage de la structure de la table snows. carpooling
CREATE TABLE IF NOT EXISTS `carpooling` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `carpooling_time` datetime NOT NULL,
  `carpooling_34` tinyint(4) DEFAULT NULL,
  `driver_validate` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `place_id` bigint(20) unsigned NOT NULL,
  `driver_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carpooling_place_id_foreign` (`place_id`),
  KEY `carpooling_driver_id_foreign` (`driver_id`),
  CONSTRAINT `carpooling_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `users` (`id`),
  CONSTRAINT `carpooling_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. edt
CREATE TABLE IF NOT EXISTS `edt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `edt_schedule` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. edtread
CREATE TABLE IF NOT EXISTS `edtread` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `duree` tinyint(4) DEFAULT NULL,
  `frequence` varchar(3) DEFAULT NULL,
  `professeur` varchar(50) DEFAULT NULL,
  `abrev` varchar(3) DEFAULT NULL,
  `codemat` varchar(15) DEFAULT NULL,
  `classe` varchar(350) DEFAULT NULL,
  `jour` tinyint(3) DEFAULT NULL,
  `heure` tinyint(4) DEFAULT NULL,
  `semaines` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3458 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la procédure snows. edt_treat
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
SET myduree = (SELECT cast(SUBSTRING(myvalue ,1,1) AS int));
ELSEIF i = 3 then
SET myfrec = myvalue;
ELSEIF i = 4 then
SET myname = myvalue;
ELSEIF i = 5 && (myname != '') then
SET myabv = myvalue;
ELSEIF i = 6 then
SET mymat = myvalue;
ELSEIF i = 8 && (myname != '') then
SET myclass = (select SUBSTRING(myvalue ,1,350));
ELSEIF i = 15 then
if myvalue = 'lundi' then
SET myday = 0;
ELSEIF myvalue = 'mardi' then
SET myday = 1;
ELSEIF myvalue = 'mercredi' then
SET myday = 2;
ELSEIF myvalue = 'jeudi' then
SET myday = 3;
ELSEIF myvalue = 'vendredi' then
SET myday = 4;
ELSEIF myvalue = 'samedi' then
SET myday = 5;
END if;
ELSEIF i = 16 then
SET mytime = (select cast(SUBSTRING(myvalue ,1,2)AS int));
ELSEIF i = 18 then
SET myweek = (select SUBSTRING(myvalue ,2,LENGTH(myvalue)-2));
END if;
END FOR;

if myname != '' then
INSERT INTO edtread (duree, frequence ,professeur, abrev, codemat, classe, jour, heure, semaine) 
VALUES (myduree, myfrec, myname, myabv, mymat, myclass, myday, mytime, myweek );
END if;
END if;
SET intfor = intfor +1;
END while;
insert into users (username, last_name) SELECT distinct  abrev , professeur FROM snows.edtread; 
END//
DELIMITER ;

-- Listage de la structure de la table snows. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. places
CREATE TABLE IF NOT EXISTS `places` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `places_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `car_seat` int(11) DEFAULT NULL,
  `place_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_place_id_foreign` (`place_id`),
  CONSTRAINT `users_place_id_foreign` FOREIGN KEY (`place_id`) REFERENCES `places` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=663 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. users_does_edt
CREATE TABLE IF NOT EXISTS `users_does_edt` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `starting_hour` datetime NOT NULL,
  `finnishing_hour` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `edt_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_does_edt_users_id_foreign` (`users_id`),
  CONSTRAINT `users_does_edt_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table snows. users_has_carpooling
CREATE TABLE IF NOT EXISTS `users_has_carpooling` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_confirm` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `users_id` bigint(20) unsigned NOT NULL,
  `carpooling_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_has_carpooling_users_id_foreign` (`users_id`),
  KEY `users_has_carpooling_carpooling_id_foreign` (`carpooling_id`),
  CONSTRAINT `users_has_carpooling_carpooling_id_foreign` FOREIGN KEY (`carpooling_id`) REFERENCES `carpooling` (`id`),
  CONSTRAINT `users_has_carpooling_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
