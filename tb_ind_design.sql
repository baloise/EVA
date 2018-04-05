-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 05. Apr 2018 um 13:22
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_eva`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_ind_design`
--

CREATE TABLE `tb_ind_design` (
  `ID` int(11) NOT NULL,
  `akzentfarbe` varchar(7) DEFAULT NULL,
  `hintergrund` varchar(7) DEFAULT NULL,
  `link` varchar(7) DEFAULT NULL,
  `schrift` varchar(7) DEFAULT NULL,
  `tb_user_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_ind_design`
--

INSERT INTO `tb_ind_design` (`ID`, `akzentfarbe`, `hintergrund`, `link`, `schrift`, `tb_user_ID`) VALUES
(1, '#dfe9ff', '#ffbdbd', '#1c4e9c', '#333333', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tb_user_ID` (`tb_user_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  ADD CONSTRAINT `tb_ind_design_ibfk_1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
