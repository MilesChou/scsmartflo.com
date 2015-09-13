SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ------------------------------
--  Table structure for `config`
-- ------------------------------
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------
--  Table structure for `download`
-- --------------------------------
CREATE TABLE `download` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ---------------------------------------
--  Table structure for `productCategory`
-- ---------------------------------------
CREATE TABLE `productCategory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------
--  Table structure for `product`
-- -------------------------------
CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ---------------------
--  Records of `config`
-- ---------------------
BEGIN;
INSERT INTO `config` VALUES ('1', '{}');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
