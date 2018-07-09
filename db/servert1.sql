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
-- Database: `servert1`
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

--
-- Dump dei dati per la tabella `easyservice`
--

INSERT INTO `easyservice` (`id`, `ip`, `sessionid`, `idcalled`, `datetime`) VALUES
(1, '::1', '9ckobgtao6o5v71i76s291pua7', 2, '2018-07-06 03:10:20'),
(2, '::1', '9ckobgtao6o5v71i76s291pua7', 0, '2018-07-06 03:23:53'),
(3, '::1', 'u0ekkbq2gob39jascvuha46i02', 1, '2018-07-08 23:56:29');

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
(1, '::1', 0, '2018-07-09 00:24:49'),
(2, '::1', 0, '2018-07-09 00:24:50'),
(3, '::1', 0, '2018-07-09 00:24:51'),
(4, '::1', 5, '2018-07-09 00:25:01'),
(5, '::1', 0, '2018-07-09 00:25:02'),
(6, '::1', 0, '2018-07-09 00:25:03'),
(7, '::1', 0, '2018-07-09 00:25:07'),
(8, '::1', 0, '2018-07-09 00:25:08'),
(9, '::1', 0, '2018-07-09 00:25:48'),
(10, '::1', 0, '2018-07-09 00:25:52'),
(11, '::1', 0, '2018-07-09 00:25:56'),
(12, '::1', 0, '2018-07-09 00:25:58'),
(13, '::1', 15, '2018-07-09 00:36:49'),
(14, '::1', 26, '2018-07-09 00:37:21'),
(15, '::1', 6, '2018-07-09 00:37:28'),
(16, '::1', 13, '2018-07-09 00:37:48'),
(17, '::1', 4, '2018-07-09 00:37:50'),
(18, '::1', 5, '2018-07-09 00:37:53'),
(19, '::1', 0, '2018-07-09 00:38:03'),
(20, '::1', 6, '2018-07-09 00:38:07'),
(21, '::1', 8, '2018-07-09 00:38:22'),
(22, '::1', 8, '2018-07-09 00:40:36'),
(23, '::1', 13, '2018-07-09 00:42:18'),
(24, '::1', 10, '2018-07-09 00:42:24'),
(25, '::1', 2, '2018-07-09 00:42:31'),
(26, '::1', 4, '2018-07-09 00:42:33'),
(27, '::1', 13, '2018-07-09 00:42:51'),
(28, '::1', 3, '2018-07-09 00:43:59'),
(29, '::1', 11, '2018-07-09 00:44:03'),
(30, '::1', 10, '2018-07-09 00:44:08'),
(31, '::1', 16, '2018-07-09 00:46:26'),
(32, '::1', 20, '2018-07-09 00:46:29'),
(33, '::1', 9, '2018-07-09 00:46:38'),
(34, '::1', 15, '2018-07-09 00:47:05'),
(35, '::1', 11, '2018-07-09 00:48:54'),
(36, '::1', 28, '2018-07-09 00:48:57');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `health`
--
ALTER TABLE `health`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
