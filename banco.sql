-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 30-Jul-2018 às 17:11
-- Versão do servidor: 5.6.31
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_testes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ticketsLimit` int(11) DEFAULT NULL,
  `ticketsActive` int(11) DEFAULT '0',
  `ticketsCancel` int(11) DEFAULT '0',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Events`
--

INSERT INTO `Events` (`id`, `name`, `ticketsLimit`, `ticketsActive`, `ticketsCancel`, `start_at`, `end_at`, `address`, `city`, `state`) VALUES
(1, 'Evento Jumen', 1500, 3, 2, '2018-07-31 00:00:00', '2018-08-31 00:00:00', 'Sudoeste', 'Brasília', 'DF'),
(2, 'Evento de Teste 2', 1500, 1, 2, '2018-07-31 00:00:00', '2018-08-04 00:00:00', 'QD LT', 'Acajutiba', 'BA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Tickets`
--

CREATE TABLE IF NOT EXISTS `Tickets` (
  `id` int(11) NOT NULL,
  `eventId` int(11) DEFAULT NULL,
  `reservedBy` int(11) DEFAULT NULL,
  `reservationToken` varchar(255) DEFAULT NULL,
  `reservationTo` varchar(255) DEFAULT NULL,
  `reservationCpf` varchar(255) DEFAULT NULL,
  `reservationPolt` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Tickets`
--

INSERT INTO `Tickets` (`id`, `eventId`, `reservedBy`, `reservationToken`, `reservationTo`, `reservationCpf`, `reservationPolt`, `status`, `create_at`, `update_at`) VALUES
(2, 1, 1, '7cc23dd6-4dfd-4455-9f30-9b5f243aa4c4', 'Joanes da Silva', '5769960', 'B101', 'Cancelada', '2018-07-30 14:50:02', '2018-07-30 15:56:29'),
(4, 1, 1, 'c276e179-e757-44de-81bc-25553def2f5a', 'Maicon Wilson', '123', 'B102', 'Cancelada', '2018-07-30 15:05:33', '2018-07-30 15:57:07'),
(5, 2, 1, '176fc409-555f-4d5e-a52a-1f9997f8baeb', 'Maicon', '5769960', 'B100', 'Cancelada', '2018-07-30 15:06:10', '2018-07-30 16:33:47'),
(6, 2, 1, 'eb2fa520-77ff-4bc6-ab4a-89264900b2ca', 'Maicon Da Silva', '5769960', 'B101', 'Cancelada', '2018-07-30 15:06:54', '2018-07-30 15:57:30'),
(8, 2, 1, 'fbdf489f-8a86-4cf8-a8c1-424def593fde', 'Joanes da Silva', 'dsadsa', 'B103', 'Ativa', '2018-07-30 15:13:42', NULL),
(9, 1, 1, '2d25164e-c490-48f2-823a-e1563d54e76f', 'Joanes da Silva', '456498498', 'B100', 'Ativa', '2018-07-30 16:52:13', NULL),
(10, 1, 1, '16b16539-1abb-4420-8237-c4d17f5ec252', 'Joanes Merchant', '546546', 'B155', 'Ativa', '2018-07-30 16:52:33', NULL),
(11, 1, 1, 'd0d9c681-d0b3-4c88-97f5-13251c966d49', 'Batata Frita', '5456465465', 'B458', 'Ativa', '2018-07-30 16:53:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access` int(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `access`) VALUES
(1, 'admin', '$2y$10$A65ASD56654DS46554D64.PlUz2us/TGmgzBn4cBqCOykzST0GHte', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Events`
--
ALTER TABLE `Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
