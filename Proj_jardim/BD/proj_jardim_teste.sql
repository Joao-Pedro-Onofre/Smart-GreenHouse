-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2022 at 04:13 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj_jardim_teste`
--

-- --------------------------------------------------------

--
-- Table structure for table `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipo_disp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `nome`, `valor`, `estado`, `hora`, `tipo_disp`) VALUES
(1, 'sensor_temperatura_1', 60, 1, '2022-05-10 18:40:18', 1),
(2, 'sensor_temperatura_2', 0, 1, '2022-05-10 16:01:55', 1),
(3, 'sensor_humidade_1', 0, 1, '2022-05-10 16:01:55', 1),
(4, 'sensor_humidade_2', 0, 1, '2022-05-10 16:01:55', 1),
(5, 'sensor_luz_1', 60, 1, '2022-05-10 18:41:16', 1),
(6, 'sensor_luz_2', 0, 1, '2022-05-10 16:04:12', 1),
(7, 'sensor_vento_1', 0, 1, '2022-05-10 16:04:12', 1),
(8, 'sensor_vento_2', 0, 1, '2022-05-10 16:04:12', 1),
(9, 'sensor_dioxido_1', 0, 1, '2022-05-10 16:05:29', 1),
(10, 'sensor_dioxido_2', 0, 1, '2022-05-10 16:05:29', 1),
(11, 'atuador_AC_1', 18, 1, '2022-05-12 17:17:30', 2),
(12, 'atuador_AC_2', 0, 1, '2022-05-10 16:22:04', 2),
(13, 'atuador_janela_1', 0, 1, '2022-05-12 17:54:53', 2),
(14, 'atuador_janela_2', 0, 1, '2022-05-10 16:22:04', 2),
(15, 'atuador_luz_1', 0, 0, '2022-05-12 17:55:44', 2),
(16, 'atuador_luz_2', 0, 1, '2022-05-10 16:22:04', 2),
(17, 'atuador_rega_teto_1', 0, 1, '2022-05-12 17:56:32', 2),
(18, 'atuador_rega_teto_2', 0, 1, '2022-05-10 16:22:04', 2),
(19, 'atuador_porta_1', 0, 1, '2022-05-12 17:56:38', 2);

-- --------------------------------------------------------

--
-- Table structure for table `log_atuadores_bool`
--

CREATE TABLE `log_atuadores_bool` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_atuadores_bool`
--

INSERT INTO `log_atuadores_bool` (`id`, `nome`, `valor`, `estado`, `hora`) VALUES
(1, '', NULL, 1, '2022-05-12 17:06:59'),
(2, 'sensor_temperatura_1', NULL, 1, '2022-05-12 17:07:50'),
(3, 'atuador_AC_1', NULL, 0, '2022-05-12 17:13:58'),
(4, 'atuador_AC_1', NULL, 1, '2022-05-12 17:14:42'),
(5, 'atuador_AC_1', NULL, 0, '2022-05-12 17:15:32'),
(6, 'atuador_AC_1', NULL, 1, '2022-05-12 17:15:45'),
(7, 'atuador_AC_1', NULL, 1, '2022-05-12 17:15:46'),
(8, 'atuador_AC_1', NULL, 1, '2022-05-12 17:17:31'),
(9, 'atuador_AC_1', 18, 1, '2022-05-12 17:19:00'),
(10, 'atuador_janela_1', 0, 0, '2022-05-12 17:52:45'),
(11, 'atuador_janela_1', 0, 1, '2022-05-12 17:54:53'),
(12, 'atuador_luz_1', 0, 0, '2022-05-12 17:55:44'),
(13, 'atuador_rega_teto_1', 0, 0, '2022-05-12 17:56:31'),
(14, 'atuador_rega_teto_1', 0, 1, '2022-05-12 17:56:32'),
(15, 'atuador_porta_1', 0, 0, '2022-05-12 17:56:37'),
(16, 'atuador_porta_1', 0, 1, '2022-05-12 17:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `log_sensor_dioxido`
--

CREATE TABLE `log_sensor_dioxido` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_sensor_humidade`
--

CREATE TABLE `log_sensor_humidade` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_sensor_luz`
--

CREATE TABLE `log_sensor_luz` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_sensor_temperatura`
--

CREATE TABLE `log_sensor_temperatura` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_sensor_temperatura`
--

INSERT INTO `log_sensor_temperatura` (`id`, `nome`, `valor`, `estado`, `hora`) VALUES
(1, 'sensor_temperatura_1', 60, 1, '2022-05-12 18:19:40'),
(2, 'sensor_temperatura_1', 60, 1, '2022-05-12 18:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `log_sensor_vento`
--

CREATE TABLE `log_sensor_vento` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_dispositivo`
--

CREATE TABLE `tipo_dispositivo` (
  `id` int(11) NOT NULL,
  `nome_tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_dispositivo`
--

INSERT INTO `tipo_dispositivo` (`id`, `nome_tipo`) VALUES
(1, 'sensor'),
(2, 'atuador');

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tipos Dispositivo` (`tipo_disp`);

--
-- Indexes for table `log_atuadores_bool`
--
ALTER TABLE `log_atuadores_bool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sensor_dioxido`
--
ALTER TABLE `log_sensor_dioxido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sensor_humidade`
--
ALTER TABLE `log_sensor_humidade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sensor_luz`
--
ALTER TABLE `log_sensor_luz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sensor_temperatura`
--
ALTER TABLE `log_sensor_temperatura`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_sensor_vento`
--
ALTER TABLE `log_sensor_vento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `log_atuadores_bool`
--
ALTER TABLE `log_atuadores_bool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `log_sensor_dioxido`
--
ALTER TABLE `log_sensor_dioxido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_sensor_humidade`
--
ALTER TABLE `log_sensor_humidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_sensor_luz`
--
ALTER TABLE `log_sensor_luz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_sensor_temperatura`
--
ALTER TABLE `log_sensor_temperatura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_sensor_vento`
--
ALTER TABLE `log_sensor_vento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_dispositivo`
--
ALTER TABLE `tipo_dispositivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD CONSTRAINT `Tipos Dispositivo` FOREIGN KEY (`tipo_disp`) REFERENCES `tipo_dispositivo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
