-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `Reserve`;
CREATE DATABASE `Reserve` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Reserve`;

DROP TABLE IF EXISTS `espetaculos`;
CREATE TABLE `espetaculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `valor` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `espetaculos` (`id`, `titulo`, `valor`) VALUES
(1,	'Lago dos Cisnes',	23.76),
(2,	'Quebra Nozes',	23.76),
(3,	'A Megera Domada',	23.76),
(17,	'Novo Espetáculo',	25);

DROP TABLE IF EXISTS `poltronas`;
CREATE TABLE `poltronas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `espetaculo_id` int(11) NOT NULL,
  `poltrona` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `espetaculo_id` (`espetaculo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

INSERT INTO `poltronas` (`id`, `espetaculo_id`, `poltrona`) VALUES
(64,	1,	'A1'),
(71,	2,	'B2'),
(72,	2,	'B3'),
(73,	2,	'B4'),
(74,	2,	'B5'),
(76,	13,	'D4'),
(77,	13,	'D5'),
(78,	13,	'D6'),
(79,	13,	'E6'),
(80,	13,	'E10'),
(81,	3,	'B3'),
(82,	3,	'B7'),
(83,	3,	'B8'),
(84,	3,	'D6'),
(85,	3,	'D5'),
(86,	3,	'D4'),
(90,	1,	'B5'),
(91,	2,	'C3'),
(92,	2,	'C4'),
(93,	1,	'B1'),
(95,	13,	'C3'),
(96,	2,	'D2'),
(98,	1,	'D3'),
(99,	2,	'C5'),
(103,	1,	'A2'),
(110,	1,	'D4'),
(111,	1,	'C7'),
(112,	1,	'A7'),
(115,	1,	'C8'),
(118,	1,	'C1'),
(119,	1,	'D5'),
(120,	1,	'D6'),
(132,	1,	'B7'),
(135,	1,	'C4'),
(139,	2,	'C2'),
(143,	1,	'B6'),
(144,	1,	'A3'),
(145,	1,	'D2'),
(146,	1,	'E2'),
(147,	1,	'D1'),
(148,	1,	'E3'),
(149,	1,	'A5'),
(151,	1,	'E1'),
(152,	2,	'D3'),
(153,	2,	'D4'),
(154,	2,	'D5'),
(155,	2,	'E2'),
(157,	1,	'B2'),
(159,	1,	'B3'),
(160,	1,	'A4'),
(161,	1,	'A6'),
(162,	1,	'C3'),
(163,	1,	'C2'),
(164,	17,	'E4'),
(165,	17,	'B4'),
(166,	17,	'A7'),
(167,	1,	'B4'),
(168,	1,	'A10');

-- 2018-08-07 03:53:06
