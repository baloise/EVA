-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jan 2018 um 16:13
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
-- Tabellenstruktur für Tabelle `tb_behaviorgrade`
--

CREATE TABLE `tb_behaviorgrade` (
  `ID` int(11) NOT NULL,
  `tb_userLL_ID` int(11) NOT NULL,
  `tb_userPA_ID` int(11) NOT NULL,
  `stageName` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_behaviorgrade`
--

INSERT INTO `tb_behaviorgrade` (`ID`, `tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`, `creationDate`) VALUES
(11, 8, 7, 'ITCH', 65, '2018-01-08 13:26:04'),
(12, 8, 7, 'ITBE', 66, '2018-01-08 13:26:15'),
(13, 8, 7, 'Helpdesk', 65, '2018-01-08 13:26:27'),
(14, 8, 7, 'Blabla', 12, '2018-01-08 14:30:56');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline`
--

CREATE TABLE `tb_deadline` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline_check`
--

CREATE TABLE `tb_deadline_check` (
  `tb_deadline_ID` int(11) NOT NULL,
  `tb_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline_group`
--

CREATE TABLE `tb_deadline_group` (
  `tb_deadline_ID` int(11) NOT NULL,
  `tb_group_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_group`
--

CREATE TABLE `tb_group` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prefix` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_group`
--

INSERT INTO `tb_group` (`ID`, `name`, `prefix`) VALUES
(1, 'Nachwuchsentwicklung', 'NW'),
(2, 'Praxisausbildner', 'PA'),
(3, 'Lehrling Informatik', 'LIT'),
(4, 'Lehrling KV', 'LKV'),
(5, 'Superuser', 'SU');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_ind_nav`
--

CREATE TABLE `tb_ind_nav` (
  `ID` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `tb_user_ID` int(11) NOT NULL,
  `tb_modul_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_ind_nav`
--

INSERT INTO `tb_ind_nav` (`ID`, `position`, `tb_user_ID`, `tb_modul_ID`) VALUES
(2, 4, 8, 12),
(4, 2, 8, 3),
(8, 1, 9, 9),
(51, NULL, 6, 2),
(52, NULL, 6, 3),
(54, NULL, 6, 5),
(55, NULL, 6, 12);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_llit_semester`
--

CREATE TABLE `tb_llit_semester` (
  `ID` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_malus`
--

CREATE TABLE `tb_malus` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `tb_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul`
--

CREATE TABLE `tb_modul` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_modul`
--

INSERT INTO `tb_modul` (`ID`, `name`, `description`, `file_path`, `title`) VALUES
(1, 'ALS', 'ALS-Modul', 'modul/als.php', 'ALS'),
(2, 'Benutzerverwaltung', 'Benutzerverwaltung für Nachwuchsentwicklung', 'modul/benutzerverwaltung.php', 'Benutzerverwaltung'),
(3, 'Dashboard', 'Dashboard mit allen Modulen', 'modul/dashboard.php', 'Dashboard'),
(4, 'Fachvortrag', 'Modul zur Sammlung der Fachvortrag Bewertungen.', 'modul/fachvortrag.php', 'Fachvortrag'),
(5, 'Leistungslohn', 'Modul zur berechnung des Leistungslohnes und der generierung eines CSV', 'modul/leistungslohn.php', 'Leistungslohn'),
(6, 'Malus', 'Modul zur Sammlung von Malus-Werten', 'modul/malus.php', 'Malus'),
(7, 'Noten', 'Modul zur Sammlung von Fächern und Noten', 'modul/noten.php', 'Noten'),
(8, 'PE', 'Modul zur Sammlung von PE bewertungen.', 'modul/pe.php', 'PE'),
(9, 'STAO', 'Modul zur Sammlung von STAO Bewertungen', 'modul/stao.php', 'STAO'),
(10, 'Stundenplan', 'Modul zur speicherung eines GIBM Stundenplans.', 'modul/stundenplan.php', 'Stundenplan'),
(11, 'Terminmanagement', 'Modul zur betreuung von Terminen', 'modul/terminmanagement.php', 'Terminmanagement'),
(12, 'Verhaltensziele', 'Modul zur Sammlung der Bewertung der Verhaltensziele', 'modul/verhaltensziele.php', 'Verhaltensziele'),
(13, 'Falscher Pfad', 'Beschreibt Verhalten bei falscher Pfadangabe', 'modul/jksdafasdf.php', 'FalscherPfad');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul_group`
--

CREATE TABLE `tb_modul_group` (
  `ID` int(11) NOT NULL,
  `tb_group_ID` int(11) NOT NULL,
  `tb_modul_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_modul_group`
--

INSERT INTO `tb_modul_group` (`ID`, `tb_group_ID`, `tb_modul_ID`) VALUES
(34, 1, 1),
(35, 1, 2),
(36, 1, 3),
(37, 1, 4),
(38, 1, 5),
(39, 1, 6),
(40, 1, 7),
(41, 1, 8),
(42, 1, 9),
(43, 1, 10),
(44, 1, 11),
(45, 1, 12),
(46, 3, 3),
(47, 3, 4),
(48, 3, 5),
(49, 3, 7),
(50, 3, 10),
(51, 3, 11),
(52, 3, 12);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_presentation`
--

CREATE TABLE `tb_presentation` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  `tb_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_subject_grade`
--

CREATE TABLE `tb_subject_grade` (
  `ID` int(11) NOT NULL,
  `grade` double DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  `writtenDate` date DEFAULT NULL,
  `weighting` double DEFAULT NULL,
  `notes` text,
  `tb_user_subject_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_user`
--

CREATE TABLE `tb_user` (
  `ID` int(11) NOT NULL,
  `bKey` varchar(7) NOT NULL,
  `timetable` varchar(255) DEFAULT NULL,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `tb_group_ID` int(11) NOT NULL,
  `tb_ind_backgroundcolor` varchar(6) DEFAULT NULL,
  `tb_ind_akzentcolor` varchar(6) DEFAULT NULL,
  `tb_ind_linkcolor` varchar(6) DEFAULT NULL,
  `tb_ind_textcolor` varchar(6) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `timetable`, `lastLogin`, `tb_group_ID`, `tb_ind_backgroundcolor`, `tb_ind_akzentcolor`, `tb_ind_linkcolor`, `tb_ind_textcolor`, `firstname`, `lastname`, `deleted`) VALUES
(6, 'b000001', NULL, NULL, 1, NULL, NULL, NULL, NULL, 'Lara', 'Muster', NULL),
(7, 'b000002', NULL, NULL, 2, NULL, NULL, NULL, NULL, 'Matthias', 'Cullmann', NULL),
(8, 'b000003', NULL, NULL, 3, NULL, NULL, NULL, NULL, 'Elia', 'Reutlinger', NULL),
(9, 'b000004', NULL, NULL, 4, NULL, NULL, NULL, NULL, 'Tim', 'Labbl', NULL),
(10, 'b000005', NULL, NULL, 5, NULL, NULL, NULL, NULL, 'Super', 'User', NULL),
(103, 'b123123', NULL, NULL, 1, NULL, NULL, NULL, NULL, '', '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_user_subject`
--

CREATE TABLE `tb_user_subject` (
  `ID` int(11) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  `tb_user_ID` int(11) NOT NULL,
  `tb_llit_semester_ID` int(11) NOT NULL,
  `correctedGrade` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  ADD PRIMARY KEY (`ID`,`tb_userLL_ID`,`tb_userPA_ID`),
  ADD KEY `fk_tb_behaviorgrade_tb_user1_idx` (`tb_userLL_ID`),
  ADD KEY `fk_tb_behaviorgrade_tb_user2_idx` (`tb_userPA_ID`);

--
-- Indizes für die Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_deadline_check`
--
ALTER TABLE `tb_deadline_check`
  ADD PRIMARY KEY (`tb_deadline_ID`,`tb_user_ID`),
  ADD KEY `fk_tb_deadline_has_tb_user_tb_user1_idx` (`tb_user_ID`),
  ADD KEY `fk_tb_deadline_has_tb_user_tb_deadline1_idx` (`tb_deadline_ID`);

--
-- Indizes für die Tabelle `tb_deadline_group`
--
ALTER TABLE `tb_deadline_group`
  ADD PRIMARY KEY (`tb_deadline_ID`,`tb_group_ID`),
  ADD KEY `fk_tb_deadline_has_tb_group_tb_group1_idx` (`tb_group_ID`),
  ADD KEY `fk_tb_deadline_has_tb_group_tb_deadline1_idx` (`tb_deadline_ID`);

--
-- Indizes für die Tabelle `tb_group`
--
ALTER TABLE `tb_group`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_modul_ID`),
  ADD KEY `fk_tb_ind_nav_tb_user1_idx` (`tb_user_ID`),
  ADD KEY `fk_tb_ind_nav_tb_modul1_idx` (`tb_modul_ID`);

--
-- Indizes für die Tabelle `tb_llit_semester`
--
ALTER TABLE `tb_llit_semester`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`),
  ADD KEY `fk_tb_malus_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_modul`
--
ALTER TABLE `tb_modul`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  ADD PRIMARY KEY (`ID`,`tb_group_ID`,`tb_modul_ID`),
  ADD KEY `fk_tb_modul_group_tb_group1_idx` (`tb_group_ID`),
  ADD KEY `fk_tb_modul_group_tb_modul1_idx` (`tb_modul_ID`);

--
-- Indizes für die Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`),
  ADD KEY `fk_tb_presentation_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  ADD PRIMARY KEY (`ID`,`tb_user_subject_ID`),
  ADD KEY `fk_tb_subject_grade_tb_user_subject1_idx` (`tb_user_subject_ID`);

--
-- Indizes für die Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`ID`,`tb_group_ID`),
  ADD KEY `fk_tb_user_tb_group_idx` (`tb_group_ID`);

--
-- Indizes für die Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_llit_semester_ID`),
  ADD KEY `fk_tb_user_subject_tb_user1_idx` (`tb_user_ID`),
  ADD KEY `fk_tb_user_subject_tb_llit_semester1_idx` (`tb_llit_semester_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT für Tabelle `tb_llit_semester`
--
ALTER TABLE `tb_llit_semester`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_modul`
--
ALTER TABLE `tb_modul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT für Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT für Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  ADD CONSTRAINT `fk_tb_behaviorgrade_tb_user1` FOREIGN KEY (`tb_userLL_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_behaviorgrade_tb_user2` FOREIGN KEY (`tb_userPA_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_deadline_check`
--
ALTER TABLE `tb_deadline_check`
  ADD CONSTRAINT `fk_tb_deadline_has_tb_user_tb_deadline1` FOREIGN KEY (`tb_deadline_ID`) REFERENCES `tb_deadline` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_deadline_has_tb_user_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_deadline_group`
--
ALTER TABLE `tb_deadline_group`
  ADD CONSTRAINT `fk_tb_deadline_has_tb_group_tb_deadline1` FOREIGN KEY (`tb_deadline_ID`) REFERENCES `tb_deadline` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_deadline_has_tb_group_tb_group1` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
  ADD CONSTRAINT `fk_tb_ind_nav_tb_modul1` FOREIGN KEY (`tb_modul_ID`) REFERENCES `tb_modul` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_ind_nav_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  ADD CONSTRAINT `fk_tb_malus_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  ADD CONSTRAINT `fk_tb_modul_group_tb_group1` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_modul_group_tb_modul1` FOREIGN KEY (`tb_modul_ID`) REFERENCES `tb_modul` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  ADD CONSTRAINT `fk_tb_presentation_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  ADD CONSTRAINT `fk_tb_subject_grade_tb_user_subject1` FOREIGN KEY (`tb_user_subject_ID`) REFERENCES `tb_user_subject` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `fk_tb_user_tb_group` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  ADD CONSTRAINT `fk_tb_user_subject_tb_llit_semester1` FOREIGN KEY (`tb_llit_semester_ID`) REFERENCES `tb_llit_semester` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_user_subject_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
