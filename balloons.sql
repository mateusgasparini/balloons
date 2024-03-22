-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Mar-2024 às 03:44
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `balloons`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `event`
--

CREATE TABLE `event` (
  `IDe` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `color` varchar(7) NOT NULL,
  `situation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_has_description`
--

CREATE TABLE `event_has_description` (
  `IDehd` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `IDe` int(11) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_has_guests`
--

CREATE TABLE `event_has_guests` (
  `IDehg` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `IDe` int(11) NOT NULL,
  `guests` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_has_location`
--

CREATE TABLE `event_has_location` (
  `IDehl` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `IDe` int(11) NOT NULL,
  `location` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_has_time`
--

CREATE TABLE `event_has_time` (
  `IDeht` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `IDe` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_has_transport`
--

CREATE TABLE `event_has_transport` (
  `IDehtr` int(11) NOT NULL,
  `IDu` int(11) NOT NULL,
  `IDe` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `IDu` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`IDe`);

--
-- Índices para tabela `event_has_description`
--
ALTER TABLE `event_has_description`
  ADD PRIMARY KEY (`IDehd`);

--
-- Índices para tabela `event_has_guests`
--
ALTER TABLE `event_has_guests`
  ADD PRIMARY KEY (`IDehg`);

--
-- Índices para tabela `event_has_location`
--
ALTER TABLE `event_has_location`
  ADD PRIMARY KEY (`IDehl`);

--
-- Índices para tabela `event_has_time`
--
ALTER TABLE `event_has_time`
  ADD PRIMARY KEY (`IDeht`);

--
-- Índices para tabela `event_has_transport`
--
ALTER TABLE `event_has_transport`
  ADD PRIMARY KEY (`IDehtr`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IDu`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `event`
--
ALTER TABLE `event`
  MODIFY `IDe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `event_has_description`
--
ALTER TABLE `event_has_description`
  MODIFY `IDehd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `event_has_guests`
--
ALTER TABLE `event_has_guests`
  MODIFY `IDehg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `event_has_location`
--
ALTER TABLE `event_has_location`
  MODIFY `IDehl` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `event_has_time`
--
ALTER TABLE `event_has_time`
  MODIFY `IDeht` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `event_has_transport`
--
ALTER TABLE `event_has_transport`
  MODIFY `IDehtr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `IDu` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
