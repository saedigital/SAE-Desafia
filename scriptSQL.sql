
-- Criar banco de dados 
CREATE DATABASE IF NOT EXISTS `db_teatro` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `db_teatro`;


-- Criar procedure SP_obterEspetaculo
DELIMITER //
CREATE PROCEDURE `SP_obterEspetaculo`(IN `id` INT)
BEGIN
SELECT id_espetaculo, espetaculo, DATE_FORMAT(date,'%d/%m/%Y') as date, TIME_FORMAT(hora,'%H:%i') as hora FROM tbl_espetaculo WHERE id_espetaculo = id;
END//
DELIMITER ;


-- Criar procedure SP_obterPoltronasReserva
DELIMITER //
CREATE PROCEDURE `SP_obterPoltronasReserva`(IN `id` INT)
BEGIN
Select tbl_reserva.id_reserva, tbl_reservas_poltrona.id_poltrona, poltrona From tbl_reserva Inner Join
tbl_reservas_poltrona On tbl_reservas_poltrona.id_reserva = tbl_reserva.id_reserva Inner Join
tbl_poltrona On tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona Where tbl_reserva.id_reserva = id ;
END//
DELIMITER ;


-- Criar procedure SP_obterReservasEspetaculo
DELIMITER //
CREATE PROCEDURE `SP_obterReservasEspetaculo`(IN `id` INT)
BEGIN
SELECT tbl_espetaculo.id_espetaculo, espetaculo, Date_Format(date, '%d/%m/%Y') As date, Time_Format(hora, '%H:%i') As hora, tbl_reserva.id_reserva,
            tbl_poltrona.id_poltrona, poltrona FROM tbl_espetaculo INNER JOIN tbl_reserva ON tbl_espetaculo.id_espetaculo = tbl_reserva.id_espetaculo 
            INNER JOIN tbl_reservas_poltrona ON tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva 
            INNER JOIN  tbl_poltrona ON tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona WHERE tbl_espetaculo.id_espetaculo = id ;
END//
DELIMITER ;


-- Criar procedure SP_obterReservasUsuario
DELIMITER //
CREATE PROCEDURE `SP_obterReservasUsuario`()
BEGIN
Select espetaculo, Date_Format(date, '%d/%m/%Y') As date, Time_Format(hora, '%H:%i') As hora, tbl_reserva.id_reserva,
Sum(tbl_valores_poltrona.valor) As valor From tbl_espetaculo 
Inner Join tbl_reserva On tbl_espetaculo.id_espetaculo = tbl_reserva.id_espetaculo 
Inner Join tbl_reservas_poltrona On tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva 
Inner Join tbl_poltrona On tbl_poltrona.id_poltrona = tbl_reservas_poltrona.id_poltrona
Inner Join tbl_valores_poltrona On tbl_valores_poltrona.id_tipo_poltrona = tbl_poltrona.id_tipo_poltrona
Group By espetaculo, Date_Format(date, '%d/%m/%Y'), 
Time_Format(tbl_espetaculo.hora, '%H:%i'), tbl_reserva.id_reserva ;
END//
DELIMITER ;


-- Criar procedure SP_obterTodosEspetaculos
DELIMITER //
CREATE PROCEDURE `SP_obterTodosEspetaculos`()
BEGIN
SELECT tbl_espetaculo.id_espetaculo, tbl_espetaculo.espetaculo,
DATE_FORMAT(tbl_espetaculo.date, '%d/%m/%Y') AS date,
TIME_FORMAT(tbl_espetaculo.hora, '%H:%i') AS hora,
(SELECT COUNT(tbl_poltrona.poltrona) FROM tbl_poltrona) AS totalpoltrona,
COUNT(tbl_poltrona.poltrona) AS poltronareservada,
((SELECT COUNT(tbl_poltrona.poltrona) FROM tbl_poltrona) - COUNT(tbl_poltrona.poltrona)) AS disponivel,
IFNULL(TRUNCATE(Sum(tbl_valores_poltrona.valor), 2), 0) AS valortotal,
TIMESTAMP(tbl_espetaculo.date,tbl_espetaculo.hora) AS datahora       
FROM
tbl_poltrona INNER JOIN tbl_valores_poltrona On tbl_poltrona.id_tipo_poltrona =  tbl_valores_poltrona.id_tipo_poltrona 
INNER JOIN tbl_reservas_poltrona On tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona 
INNER JOIN tbl_reserva On tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva 
RIGHT Join tbl_espetaculo On tbl_reserva.id_espetaculo = tbl_espetaculo.id_espetaculo
WHERE TIMESTAMPDIFF(MINUTE, NOW(), TIMESTAMP(tbl_espetaculo.date,tbl_espetaculo.hora)) > 0 
GROUP BY tbl_espetaculo.id_espetaculo, tbl_espetaculo.espetaculo ORDER BY date, hora; 
END//
DELIMITER ;


-- Criar procedure SP_obterTodosEspetaculosAdmin
DELIMITER //
CREATE PROCEDURE `SP_obterTodosEspetaculosAdmin`()
BEGIN
SELECT  tbl_espetaculo.id_espetaculo, tbl_espetaculo.espetaculo,
DATE_FORMAT(tbl_espetaculo.date, '%d/%m/%Y') AS date,
TIME_FORMAT(tbl_espetaculo.hora, '%H:%i') AS hora,
(SELECT COUNT(tbl_poltrona.poltrona) FROM tbl_poltrona) AS totalpoltrona,
COUNT(tbl_poltrona.poltrona) AS poltronareservada,
((SELECT COUNT(tbl_poltrona.poltrona) FROM tbl_poltrona) - COUNT(tbl_poltrona.poltrona)) AS disponivel,
IFNULL(TRUNCATE(Sum(tbl_valores_poltrona.valor), 2), 0) AS valortotal,
DATEDIFF (DATE_FORMAT(tbl_espetaculo.date, '%Y-%m-%d'), DATE_FORMAT(NOW(), '%Y-%m-%d')) as datadif,
TIMEDIFF(TIME_FORMAT(tbl_espetaculo.hora, '%H:%i'), TIME_FORMAT(NOW(),'%H:%i')) as horadif
FROM
tbl_poltrona INNER JOIN tbl_valores_poltrona On tbl_poltrona.id_tipo_poltrona =  tbl_valores_poltrona.id_tipo_poltrona 
INNER JOIN tbl_reservas_poltrona On tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona 
INNER JOIN tbl_reserva On tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva 
RIGHT Join tbl_espetaculo On tbl_reserva.id_espetaculo = tbl_espetaculo.id_espetaculo
GROUP BY tbl_espetaculo.id_espetaculo, tbl_espetaculo.espetaculo ORDER BY date, hora; 
END//
DELIMITER ;


-- Criar procedure SP_obterTotalArrecadacao
DELIMITER //
CREATE PROCEDURE `SP_obterTotalArrecadacao`()
BEGIN
SELECT TRUNCATE(SUM(tbl_valores_poltrona.valor), 2) AS valortotal FROM
tbl_poltrona INNER JOIN tbl_valores_poltrona ON tbl_poltrona.id_tipo_poltrona = tbl_valores_poltrona.id_tipo_poltrona 
INNER JOIN tbl_reservas_poltrona ON tbl_reservas_poltrona.id_poltrona = tbl_poltrona.id_poltrona 
INNER JOIN tbl_reserva ON tbl_reserva.id_reserva = tbl_reservas_poltrona.id_reserva
RIGHT JOIN tbl_espetaculo ON tbl_reserva.id_espetaculo = tbl_espetaculo.id_espetaculo ;
END//
DELIMITER ;


-- Criar procedure SP_obterValorPoltrona
DELIMITER //
CREATE PROCEDURE `SP_obterValorPoltrona`()
BEGIN
SELECT id_tipo_poltrona, valor FROM tbl_valores_poltrona WHERE id_tipo_poltrona = 1 ;
END//
DELIMITER ;


-- Criar tabela tbl_espetaculo
CREATE TABLE IF NOT EXISTS `tbl_espetaculo` (
  `id_espetaculo` int(11) NOT NULL AUTO_INCREMENT,
  `espetaculo` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id_espetaculo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Criar tabela tbl_poltrona
CREATE TABLE IF NOT EXISTS `tbl_poltrona` (
  `id_poltrona` int(11) NOT NULL AUTO_INCREMENT,
  `poltrona` varchar(5) DEFAULT NULL,
  `id_tipo_poltrona` int(2) NOT NULL,
  PRIMARY KEY (`id_poltrona`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Inserir dados na tabela tbl_poltrona
INSERT INTO `tbl_poltrona` (`id_poltrona`, `poltrona`, `id_tipo_poltrona`) VALUES
	(1, '1_1', 1),
	(2, '1_2', 1),
	(3, '1_3', 1),
	(4, '1_4', 1),
	(5, '1_5', 1),
	(6, '1_6', 1),
	(7, '1_7', 1),
	(8, '1_8', 1),
	(9, '1_9', 1),
	(10, '1_10', 1),
	(11, '2_1', 1),
	(12, '2_2', 1),
	(13, '2_3', 1),
	(14, '2_4', 1),
	(15, '2_5', 1),
	(16, '2_6', 1),
	(17, '2_7', 1),
	(18, '2_8', 1),
	(19, '2_9', 1),
	(20, '2_10', 1);


-- Criar tabela tbl_reserva
CREATE TABLE IF NOT EXISTS `tbl_reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_espetaculo` int(11) NOT NULL,
  PRIMARY KEY (`id_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;


-- Criar tabela tbl_reservas_poltrona
CREATE TABLE IF NOT EXISTS `tbl_reservas_poltrona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reserva` int(11) NOT NULL,
  `id_poltrona` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_num_reserva` (`id_reserva`),
  CONSTRAINT `fk_num_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `tbl_reserva` (`id_reserva`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Criar tabela tbl_valores_poltrona
CREATE TABLE IF NOT EXISTS `tbl_valores_poltrona` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_tipo_poltrona` int(2) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Inserir dados na tabela tbl_valores_poltrona
INSERT INTO `tbl_valores_poltrona` (`id`, `id_tipo_poltrona`, `valor`) VALUES
	(1, 1, 23.76);
