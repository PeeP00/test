-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 25, 2025 alle 12:44
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ferrara`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `automezzo`
--

CREATE TABLE `automezzo` (
  `codice` int(11) NOT NULL,
  `targa` varchar(20) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modello` varchar(100) NOT NULL,
  `filiale_codice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `automezzo`
--

INSERT INTO `automezzo` (`codice`, `targa`, `marca`, `modello`, `filiale_codice`) VALUES
(2, 'BB002BB', 'Fiat', '500', 2),
(3, 'CC003CC', 'Lancia', 'Ypsilon', 3),
(4, 'DD004DD', 'Toyota', 'Yaris', 4),
(5, 'EE005EE', 'Volkswagen', 'Polo', 5),
(6, 'FF006FF', 'Opel', 'Corsa', 1),
(7, 'GG007GG', 'Ford', 'Fiesta', 2),
(8, 'HH008HH', 'Renault', 'Clio', 3),
(9, 'II009II', 'Peugeot', '208', 4),
(10, 'JJ010JJ', 'Citroen', 'C3', 5),
(11, 'KK011KK', 'BMW', 'Serie 3', 1),
(12, 'LL012LL', 'Mercedes', 'Classe C', 2),
(13, 'MM013MM', 'Audi', 'A4', 3),
(14, 'NN014NN', 'Volkswagen', 'Passat', 4),
(15, 'OO015OO', 'Alfa Romeo', 'Giulia', 5),
(16, 'PP016PP', 'Jeep', 'Renegade', 1),
(17, 'QQ017QQ', 'Nissan', 'Qashqai', 2),
(18, 'RR018RR', 'Hyundai', 'Tucson', 3),
(19, 'SS019SS', 'Ford', 'Kuga', 4),
(20, 'TT020TT', 'Toyota', 'RAV4', 5),
(21, 'UU021UU', 'Fiat', 'Ducato', 1),
(22, 'VV022VV', 'Mercedes', 'Sprinter', 2),
(23, 'WW023WW', 'Ford', 'Transit', 3),
(24, 'XX024XX', 'Volkswagen', 'Transporter', 4),
(25, 'YY025YY', 'Iveco', 'Daily', 5),
(26, 'ZZ026ZZ', 'Piaggio', 'Vespa', 1),
(27, 'AA027AA', 'Honda', 'SH 125', 2),
(28, 'BB028BB', 'Yamaha', 'TMax', 3),
(29, 'CC029CC', 'BMW', 'C 400 X', 4),
(30, 'DD030DD', 'Kymco', 'Agility 125', 5),
(32, 'rerewerr', 'Fiat', 'Punto', 6),
(33, 'FDDFDFD', 'Lancia', 'Fiat', 6),
(34, 'eeeeeeee', 'Lancia', 'Fiat', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `filiale`
--

CREATE TABLE `filiale` (
  `codice` int(11) NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `cap` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `filiale`
--

INSERT INTO `filiale` (`codice`, `indirizzo`, `citta`, `cap`) VALUES
(1, 'Via Dante 10', 'Brindisi', '72100'),
(2, 'Corso Umberto 25', 'Francavilla Fontana', '72021'),
(3, 'Via Roma 5', 'Ostuni', '72017'),
(4, 'Piazza della Vittoria 12', 'Taranto', '74123'),
(5, 'Viale Magna Grecia 30', 'Grottaglie', '74023'),
(6, 'dsadadasdad', 'Oria', '720244'),
(7, 'uuuuuuuuuuuuuuuu', 'Oria', '33333');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `automezzo`
--
ALTER TABLE `automezzo`
  ADD PRIMARY KEY (`codice`),
  ADD UNIQUE KEY `targa` (`targa`),
  ADD KEY `filiale_codice` (`filiale_codice`);

--
-- Indici per le tabelle `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`codice`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `automezzo`
--
ALTER TABLE `automezzo`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `filiale`
--
ALTER TABLE `filiale`
  MODIFY `codice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `automezzo`
--
ALTER TABLE `automezzo`
  ADD CONSTRAINT `automezzo_ibfk_1` FOREIGN KEY (`filiale_codice`) REFERENCES `filiale` (`codice`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
