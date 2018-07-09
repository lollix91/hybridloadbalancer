-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Lug 09, 2018 alle 02:49
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servert2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `easyservice`
--

CREATE TABLE `easyservice` (
  `id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `sessionid` varchar(200) NOT NULL,
  `idcalled` int(11) NOT NULL COMMENT 'is the id of the related microservice url',
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `health`
--

CREATE TABLE `health` (
  `id` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `serverload` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `health`
--

INSERT INTO `health` (`id`, `ip`, `serverload`, `datetime`) VALUES
(1, '::1', 4, '2018-07-09 00:43:59'),
(2, '::1', 11, '2018-07-09 00:44:03'),
(3, '::1', 10, '2018-07-09 00:44:08'),
(4, '::1', 2, '2018-07-09 00:47:09'),
(5, '::1', 31, '2018-07-09 00:48:46'),
(6, '::1', 9, '2018-07-09 00:48:49');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `easyservice`
--
ALTER TABLE `easyservice`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `health`
--
ALTER TABLE `health`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `easyservice`
--
ALTER TABLE `easyservice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `health`
--
ALTER TABLE `health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
