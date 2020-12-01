-- Script SQL pour implémenter la BD du site du restaurant LEILA.

-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'categorie'
-- 
-- ---

DROP TABLE IF EXISTS `categorie`;
		
CREATE TABLE `categorie` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'plat'
-- 
-- ---

DROP TABLE IF EXISTS `plat`;
		
CREATE TABLE `plat` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  `portion` TINYINT NOT NULL DEFAULT 1,
  `prix` DECIMAL(5,2) NOT NULL,
  `date_ajout` DATE NULL DEFAULT NULL,
  `id_categorie` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'vin'
-- 
-- ---

DROP TABLE IF EXISTS `vin`;
		
CREATE TABLE `vin` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(200) NOT NULL,
  `description` VARCHAR(200) NULL DEFAULT NULL,
  `provenance` VARCHAR(50) NOT NULL,
  `prix` DECIMAL(6,2) NOT NULL,
  `date_ajout` DATE NULL DEFAULT NULL,
  `id_categorie` INTEGER NOT NULL,
  PRIMARY KEY (`id`)
);


-- Nous avons inversé l'ordre des blocs 'Table Properties' et 'Foreign Keys'
-- pour que 'Table Properties' soit en premier.
-- De plus, nous avons enlevé les marques de commentaires des instructions du bloc 
-- 'Table Properies' pour que le changement vers le moteur de stockage InnoDB 
-- soit effectué :

-- ---
-- Table Properties
-- ---

ALTER TABLE `categorie` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `plat` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `vin` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `plat` ADD FOREIGN KEY (id_categorie) REFERENCES `categorie` (`id`);
ALTER TABLE `vin` ADD FOREIGN KEY (id_categorie) REFERENCES `categorie` (`id`);


-- ---
-- Test Data
-- ---

-- INSERT INTO `categorie` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `plat` (`id`,`nom`,`description`,`portion`,`prix`,`date_ajout`,`id_categorie`) VALUES
-- ('','','','','','','');
-- INSERT INTO `vin` (`id`,`nom`,`description`,`provenance`,`prix`,`date_ajout`,`id_categorie`) VALUES
-- ('','','','','','','');