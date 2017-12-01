-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Dez 2017 um 15:48
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `snobbr`
--
CREATE DATABASE IF NOT EXISTS `snobbr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `snobbr`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_group`
--

CREATE TABLE `tb_group` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prefix` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_group`
--

INSERT INTO `tb_group` (`ID`, `name`, `prefix`) VALUES
(1, 'Nachwuchsentwicklung', 'NW'),
(2, 'Praxisausbildner', 'PA'),
(3, 'Informatik Lehrling', 'ITL'),
(4, 'KV Lehrling', 'KVL'),
(5, 'Superuser', 'SU');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul`
--

CREATE TABLE `tb_modul` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_modul`
--

INSERT INTO `tb_modul` (`ID`, `name`, `description`, `file_path`, `title`) VALUES
(1, 'dashboard', 'Für alle sichtbar', 'modul/dashboard.php', 'Dashboard'),
(11, 'ALS', 'Punkte des ALS eintragen', 'modul/als.php', 'ALS'),
(12, 'Fachvortrag', 'Punkte des Fachvortrages eintragen', 'modul/fachvortrag.php', 'Fachvortrag'),
(13, 'Leistungslohn', 'Seite zur bestimmung des endgültigen Lohnes und erstellung der csv', 'modul/leistungslohn.php', 'Leistungslohn'),
(14, 'Malus', 'Seite zum eintragen eines Malus für einen Lehrling', 'modul/malus.php', 'Malus'),
(15, 'Noten', 'Noten/Fächer verwalten', 'modul/noten.php', 'Noten'),
(16, 'PE', 'PE Punktzahl eintragen', 'modul/pe.php', 'PE'),
(17, 'STAO', 'STAO Punktzahl eintragen', 'modul/stao.php', 'STAO'),
(18, 'Stundenplan', 'Stundenplan der Schule festlegen', 'modul/stundenplan.php', 'Stundenplan'),
(19, 'Terminmanagement', 'Termine eintragen/bearbeiten, bestätigen...', 'modul/terminmanagement.php', 'Terminmanagement'),
(20, 'verhaltensziele', 'Verhaltensziele Punktzahl eintragen', 'modul/verhaltensziele.php', 'Verhaltensziele');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul_group`
--

CREATE TABLE `tb_modul_group` (
  `ID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `modulID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_modul_group`
--

INSERT INTO `tb_modul_group` (`ID`, `groupID`, `modulID`) VALUES
(29, 3, 1),
(30, 3, 18),
(31, 4, 1),
(32, 4, 11),
(33, 3, 12),
(34, 3, 13),
(35, 3, 14),
(36, 3, 15),
(37, 3, 19),
(38, 3, 20);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_user`
--

CREATE TABLE `tb_user` (
  `ID` int(11) NOT NULL,
  `bKey` varchar(7) NOT NULL,
  `userGroup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `userGroup`) VALUES
(1, 'b037160', 3),
(2, 'b028178', 2),
(3, 'b999999', 5),
(4, 'b000000', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tb_group`
--
ALTER TABLE `tb_group`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_modul`
--
ALTER TABLE `tb_modul`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `groupID` (`groupID`),
  ADD KEY `modulID` (`modulID`);

--
-- Indizes für die Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userGroup` (`userGroup`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tb_modul`
--
ALTER TABLE `tb_modul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT für Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  ADD CONSTRAINT `tb_modul_group_ibfk_1` FOREIGN KEY (`groupID`) REFERENCES `tb_group` (`ID`),
  ADD CONSTRAINT `tb_modul_group_ibfk_2` FOREIGN KEY (`modulID`) REFERENCES `tb_modul` (`ID`);

--
-- Constraints der Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`userGroup`) REFERENCES `tb_group` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
