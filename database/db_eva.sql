-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Feb 2018 um 07:08
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.1

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
CREATE DATABASE IF NOT EXISTS `db_eva` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_eva`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_als`
--

CREATE TABLE `tb_als` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL,
  `performance` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_als`
--

INSERT INTO `tb_als` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`, `performance`) VALUES
(35, 'Test', 44, '2018-02-19 10:58:36', 9, 35, 1),
(36, 'Hallo', 50, '2018-02-19 10:59:07', 9, 34, NULL),
(37, 'Leistung test', 50, '2018-02-19 11:05:58', 107, 43, NULL),
(38, 'test', 45, '2018-02-19 13:46:56', 107, 43, NULL),
(39, 'Test 2', 50, '2018-02-20 06:40:17', 9, 36, 1),
(40, 'Test 2', 50, '2018-02-20 06:40:17', 9, 36, 1),
(41, 'Test 2', 50, '2018-02-20 06:40:17', 9, 36, NULL);

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
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_behaviorgrade`
--

INSERT INTO `tb_behaviorgrade` (`ID`, `tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`, `creationDate`, `tb_semester_ID`) VALUES
(1, 108, 7, 'ITIL', 65, '2018-02-15 10:18:01', 27),
(2, 108, 7, 'HR Applications', 63, '2018-02-15 10:18:23', 28),
(7, 108, 7, 'Helpdesk', 59, '2018-02-15 10:19:49', 29),
(8, 108, 7, 'Software Engineering 1 (Zwischen-Feedback)', 60, '2018-02-15 10:22:34', 29),
(9, 8, 7, 'IST', 123, '2018-02-19 08:51:08', 25),
(10, 8, 7, 'asdf', 111, '2018-02-19 08:54:42', 28),
(11, 8, 7, 'Test', 60, '2018-02-20 13:50:50', 26);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline`
--

CREATE TABLE `tb_deadline` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `date` date DEFAULT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_deadline`
--

INSERT INTO `tb_deadline` (`ID`, `title`, `description`, `date`, `tb_semester_ID`) VALUES
(1, 'Verhaltensziele Vereinbarungs', 'Vereinbarung zu den Verhaltenszielen bei HR eingetroffen.', '2018-02-16', 28),
(2, 'Verhaltensziele Bewertung', 'Bewertung der Verhaltensziele bei HR eingetroffen.Vereinbarung zu den Verhaltenszielen bei HR eingetroffen.', '2018-02-12', 25),
(3, 'Fachvortrag Vereinbarungsd', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2018-02-12', 25),
(4, 'Semesterbericht eingetroffen', 'Lorem ipsum dolor sist amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2018-02-12', 35),
(5, 'Zeiterfassung elektronisch an PVL', 'Lorem ipsum dolor sit samet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '2018-02-28', 25),
(8, 'Testtermin', 'asdf', '2018-02-15', 25),
(11, 'zrdzsd', 'rtrsfdsd', '2018-02-22', 36);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline_check`
--

CREATE TABLE `tb_deadline_check` (
  `tb_deadline_ID` int(11) NOT NULL,
  `tb_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_deadline_check`
--

INSERT INTO `tb_deadline_check` (`tb_deadline_ID`, `tb_user_ID`) VALUES
(1, 108),
(2, 8),
(2, 108),
(3, 8),
(3, 108),
(5, 108),
(8, 8),
(8, 108);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline_group`
--

CREATE TABLE `tb_deadline_group` (
  `tb_deadline_ID` int(11) NOT NULL,
  `tb_group_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_group`
--

CREATE TABLE `tb_group` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prefix` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_group`
--

INSERT INTO `tb_group` (`ID`, `name`, `prefix`) VALUES
(1, 'Nachwuchsentwicklung', 'NW'),
(2, 'Praxisausbildner', 'PA'),
(3, 'Lernende Informatik', 'LIT'),
(4, 'Lernende KV Versicherung', 'LKV'),
(5, 'Lernende KV Bank', 'LKB');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_ind_nav`
--

CREATE TABLE `tb_ind_nav` (
  `ID` int(11) NOT NULL,
  `position` int(11) DEFAULT NULL,
  `tb_user_ID` int(11) NOT NULL,
  `tb_modul_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_ind_nav`
--

INSERT INTO `tb_ind_nav` (`ID`, `position`, `tb_user_ID`, `tb_modul_ID`) VALUES
(8, 1, 9, 9),
(89, NULL, 8, 3),
(90, NULL, 103, 14),
(138, NULL, 6, 7),
(139, NULL, 6, 4),
(140, NULL, 6, 7),
(141, NULL, 6, 14),
(150, NULL, 107, 1),
(151, NULL, 108, 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_malus`
--

CREATE TABLE `tb_malus` (
  `ID` int(11) NOT NULL,
  `description` text,
  `weight` int(11) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_malus`
--

INSERT INTO `tb_malus` (`ID`, `description`, `weight`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(12, 'Test', 100, '2018-02-14 06:51:21', 8, 30),
(13, 'Test 2', 50, '2018-02-14 06:56:31', 9, 34),
(14, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 5, '2018-02-16 12:40:23', 108, 25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul`
--

CREATE TABLE `tb_modul` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_modul`
--

INSERT INTO `tb_modul` (`ID`, `name`, `description`, `file_path`, `title`, `icon`) VALUES
(1, 'ALS', 'ALS-Modul', 'modul/als/als.php', 'ALS', 'img/dashico/telephone-operator.svg'),
(2, 'Benutzerverwaltung', 'Benutzerverwaltung für Nachwuchsentwicklung', 'modul/benutzerverwaltung/benutzerverwaltung.php', 'Benutzerverwaltung', 'img/dashico/002-person.svg'),
(3, 'Dashboard', 'Dashboard mit allen Modulen', 'modul/dashboard/dashboard.php', 'Dashboard', NULL),
(4, 'Fachvortrag', 'Modul zur Sammlung der Fachvortrag Bewertungen.', 'modul/fachvortrag/fachvortrag.php', 'Fachvortrag', 'img/dashico/001-pie-chart.svg'),
(5, 'Leistungslohn', 'Modul zur berechnung des Leistungslohnes und der generierung eines CSV', 'modul/leistungslohn/leistungslohn.php', 'Leistungslohn', 'img/dashico/003-coins.svg'),
(6, 'Malus', 'Modul zur Sammlung von Malus-Werten', 'modul/malus/malus.php', 'Malus', 'img/dashico/001-exclamation.svg'),
(7, 'Noten', 'Modul zur Sammlung von Fächern und Noten', 'modul/noten/noten.php', 'Noten', 'img/dashico/003-file.svg'),
(8, 'PE', 'Modul zur Sammlung von PE bewertungen.', 'modul/pe/pe.php', 'PE', 'img/dashico/workflow.svg'),
(9, 'STAO', 'Modul zur Sammlung von STAO Bewertungen', 'modul/stao/stao.php', 'STAO', 'img/dashico/test.svg'),
(10, 'Stundenplan', 'Modul zur speicherung eines GIBM Stundenplans.', 'modul/stundenplan/stundenplan.php', 'Stundenplan', 'img/dashico/002-people.svg'),
(11, 'Terminmanagement', 'Modul zur betreuung von Terminen', 'modul/terminmanagement/terminmanagement.php', 'Terminmanagement', 'img/dashico/001-clock.svg'),
(12, 'Verhaltensziele', 'Modul zur Sammlung der Bewertung der Verhaltensziele', 'modul/verhaltensziele/verhaltensziele.php', 'Verhaltensziele', 'img/dashico/002-man.svg'),
(14, 'ÜK-KN CYP', 'Überbetriebliche Kurse LKB', 'modul/uek/uek.php', 'ÜK-KN CYP', 'img/dashico/school.svg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_modul_group`
--

CREATE TABLE `tb_modul_group` (
  `ID` int(11) NOT NULL,
  `tb_group_ID` int(11) NOT NULL,
  `tb_modul_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_modul_group`
--

INSERT INTO `tb_modul_group` (`ID`, `tb_group_ID`, `tb_modul_ID`) VALUES
(66, 5, 7),
(67, 5, 5),
(68, 5, 11),
(69, 5, 1),
(70, 5, 14),
(78, 4, 7),
(79, 4, 5),
(80, 4, 11),
(81, 4, 1),
(82, 4, 8),
(83, 4, 9),
(84, 3, 7),
(85, 3, 10),
(86, 3, 5),
(87, 3, 12),
(88, 3, 11),
(89, 3, 4),
(90, 1, 7),
(91, 1, 10),
(92, 1, 5),
(93, 1, 12),
(94, 1, 11),
(95, 1, 4),
(96, 1, 1),
(97, 1, 8),
(98, 1, 14),
(99, 1, 9),
(100, 1, 6),
(101, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_pe`
--

CREATE TABLE `tb_pe` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_pe`
--

INSERT INTO `tb_pe` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(24, 'Test 2', 65, '2018-02-19 11:59:31', 9, 36),
(25, 'Test 2', 65, '2018-02-19 11:59:31', 8, 36),
(26, 'asdf', 60, '2018-02-20 12:29:28', 9, 37);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_presentation`
--

CREATE TABLE `tb_presentation` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_presentation`
--

INSERT INTO `tb_presentation` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(7, 'Test2', 524, '2018-02-13 11:02:31', 8, 28),
(8, 'Kanban - Nutzen, Verwendung und Vorteile', 66, '2018-02-15 10:28:44', 108, 28),
(13, 'Testvortrag', 70, '2018-02-16 10:18:26', 108, 28),
(15, '1234', 1234, '2018-02-19 08:48:11', 8, 25),
(16, 'dsaf', 123, '2018-02-19 08:49:15', 8, 27),
(17, '123', 213, '2018-02-19 08:49:22', 8, 26),
(18, 'asd', 123, '2018-02-19 08:50:11', 8, 27),
(20, 'hallio', 231, '2018-02-19 08:50:48', 8, 26),
(21, 'hallio', 231, '2018-02-19 08:50:48', 8, 26),
(22, '123', 123, '2018-02-19 10:37:59', 9, 33);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_semester`
--

CREATE TABLE `tb_semester` (
  `ID` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `info` varchar(255) DEFAULT NULL,
  `tb_group_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_semester`
--

INSERT INTO `tb_semester` (`ID`, `semester`, `info`, `tb_group_ID`) VALUES
(25, 1, NULL, 3),
(26, 2, NULL, 3),
(27, 3, NULL, 3),
(28, 4, NULL, 3),
(29, 5, NULL, 3),
(30, 6, NULL, 3),
(31, 7, NULL, 3),
(32, 8, NULL, 3),
(33, 1, NULL, 4),
(34, 2, NULL, 4),
(35, 3, NULL, 4),
(36, 4, NULL, 4),
(37, 5, NULL, 4),
(38, 6, NULL, 4),
(39, 1, NULL, 5),
(40, 2, NULL, 5),
(41, 3, NULL, 5),
(42, 4, NULL, 5),
(43, 5, NULL, 5),
(44, 6, NULL, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_stao`
--

CREATE TABLE `tb_stao` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_stao`
--

INSERT INTO `tb_stao` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(44, 'Tschau', 46, '2018-02-19 11:22:59', 9, 35),
(45, 'Tschau', 88, '2018-02-19 11:22:59', 9, 35),
(46, 'asd', 90, '2018-02-19 11:24:17', 9, 36),
(47, 'asd', 70, '2018-02-19 11:24:31', 9, 35),
(49, 'Test', 80, '2018-02-19 11:39:16', 9, 36);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_subject_grade`
--

CREATE TABLE `tb_subject_grade` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `grade` double DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `weighting` double DEFAULT NULL,
  `notes` text,
  `tb_user_subject_ID` int(11) NOT NULL,
  `reasoning` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_subject_grade`
--

INSERT INTO `tb_subject_grade` (`ID`, `title`, `grade`, `creationDate`, `weighting`, `notes`, `tb_user_subject_ID`, `reasoning`) VALUES
(46, 'test', 1, '2018-02-09 12:23:45', 500, NULL, 11, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'),
(47, 'test2', 6, '2018-02-09 12:24:20', 500, NULL, 11, NULL),
(48, 'Test1', 5, '2018-02-09 12:29:15', 100, NULL, 12, NULL),
(49, 'Test2', 5.2, '2018-02-09 12:30:58', 200, NULL, 12, NULL),
(50, 'sdf', 12, '2018-02-09 12:59:39', 314, NULL, 11, NULL),
(54, 'Test', 5.5, '2018-02-09 13:39:32', 30, NULL, 27, NULL),
(55, 'Projektarbeit', 6, '2018-02-09 13:39:42', 70, NULL, 27, NULL),
(56, 'Test 1', 4.5, '2018-02-09 13:45:50', 100, NULL, 28, NULL),
(57, 'Test 2', 4.6, '2018-02-09 13:45:59', 100, NULL, 28, NULL),
(58, 'Test 3', 3, '2018-02-09 13:46:12', 100, NULL, 28, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.'),
(66, 'Okcool', 4, '2018-02-12 05:33:40', 40, NULL, 27, NULL),
(75, 'Test1', 5, '2018-02-13 15:06:55', 100, NULL, 31, ''),
(76, 'Test2', 6, '2018-02-13 15:07:07', 100, NULL, 31, ''),
(77, 'Test 1', 5, '2018-02-14 07:09:41', 100, NULL, 32, ''),
(78, 'Test 2', 3, '2018-02-14 07:10:05', 100, NULL, 32, 'Hallo'),
(79, 'Zeugnis', 5.5, '2018-02-15 09:12:08', 100, NULL, 33, ''),
(80, 'Test 1', 5, '2018-02-15 09:14:36', 100, NULL, 35, ''),
(81, 'Test 2', 4.6, '2018-02-15 09:14:51', 100, NULL, 35, ''),
(82, 'Test 3', 3.9, '2018-02-15 09:15:44', 100, NULL, 35, 'Zu viel Lernstoff, zu kompliziertes Thema, unverständlich erklärt (Lehrer: R.Zaugg)'),
(83, 'Zeugnis', 5.5, '2018-02-15 09:17:10', 100, NULL, 36, ''),
(84, 'Zeugnis', 5.5, '2018-02-15 09:17:49', 100, NULL, 37, ''),
(85, 'Zeugnis', 5.5, '2018-02-15 09:18:37', 100, NULL, 38, ''),
(86, 'Zeugnis', 5.5, '2018-02-15 09:19:15', 100, NULL, 39, ''),
(87, 'Test 1', 4.1, '2018-02-15 09:20:06', 100, NULL, 40, ''),
(88, 'Test 2', 4.1, '2018-02-15 09:20:13', 100, NULL, 40, ''),
(89, 'Test 3', 3.9, '2018-02-15 09:20:46', 100, NULL, 40, 'Allgemein schweres Thema (Klassenschnitt 4.0)'),
(90, 'Zeugnis', 5.5, '2018-02-15 09:23:08', 100, NULL, 48, ''),
(91, 'Zeugnis', 5.5, '2018-02-15 09:23:28', 100, NULL, 47, ''),
(92, 'Zeugnis', 5.5, '2018-02-15 09:23:39', 100, NULL, 46, ''),
(93, 'Zeugnis', 6, '2018-02-15 09:24:01', 100, NULL, 45, ''),
(94, 'Zeugnis', 6, '2018-02-15 09:24:37', 100, NULL, 44, ''),
(95, 'Zeugnis', 5.5, '2018-02-15 09:24:56', 100, NULL, 43, ''),
(96, 'Zeugnis', 6, '2018-02-15 09:25:35', 100, NULL, 42, ''),
(97, 'Zeugnis', 5.5, '2018-02-15 09:25:45', 100, NULL, 41, ''),
(98, 'Zeugnis', 6, '2018-02-15 10:11:41', 100, NULL, 55, ''),
(99, 'Zeugnis', 5, '2018-02-15 10:11:55', 100, NULL, 54, ''),
(100, 'Zeugnis', 5.5, '2018-02-15 10:12:10', 100, NULL, 53, ''),
(101, 'Zeugnis', 5.5, '2018-02-15 10:12:26', 100, NULL, 52, ''),
(102, 'Zeugnis', 4.5, '2018-02-15 10:12:40', 100, NULL, 51, ''),
(103, 'Zeugnis', 5, '2018-02-15 10:13:13', 100, NULL, 50, ''),
(104, 'Gesellschaft', 5.5, '2018-02-15 10:13:51', 100, NULL, 49, ''),
(105, 'Sprache und Kommunikation', 6, '2018-02-15 10:14:05', 100, NULL, 49, ''),
(106, 'Erfahrungsnote LAP ABU', 5.5, '2018-02-15 10:14:29', 100, NULL, 49, ''),
(107, 'Zeugnis', 5.5, '2018-02-15 10:44:02', 100, NULL, 56, ''),
(108, 'Zeugnis', 5.5, '2018-02-15 10:47:22', 100, NULL, 60, ''),
(109, 'Zeugnis', 4.5, '2018-02-15 10:47:33', 100, NULL, 59, ''),
(110, 'Zeugnis', 5.5, '2018-02-15 10:47:53', 100, NULL, 58, ''),
(111, 'Zeugnis', 5.5, '2018-02-15 10:48:10', 100, NULL, 57, ''),
(112, 'Zeugnis', 5, '2018-02-15 10:49:27', 100, NULL, 64, ''),
(113, 'Zeugnis', 5.5, '2018-02-15 10:49:38', 100, NULL, 63, ''),
(114, 'Zeugnis', 6, '2018-02-15 10:49:57', 100, NULL, 62, ''),
(115, 'Zeugnis', 5, '2018-02-15 10:50:27', 100, NULL, 61, ''),
(117, 'adsf', 4, '2018-02-19 08:38:43', 100, NULL, 70, 'Ohje'),
(120, 'Test', 5, '2018-02-20 06:26:58', 100, NULL, 75, ''),
(121, 'Test', 4.5, '2018-02-20 06:27:09', 100, NULL, 74, ''),
(122, 'Test', 4, '2018-02-20 06:27:29', 100, NULL, 73, 'Testbegründung'),
(123, 'Test', 3.5, '2018-02-20 06:27:40', 100, NULL, 72, 'Testbegründung 2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_translation`
--

CREATE TABLE `tb_translation` (
  `ID` int(11) NOT NULL,
  `de` text CHARACTER SET utf8 COLLATE utf8_german2_ci,
  `it` text,
  `fr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_translation`
--

INSERT INTO `tb_translation` (`ID`, `de`, `it`, `fr`) VALUES
(1, 'Willkommen', 'This isch Italian', 'This isch French'),
(2, 'Noten', 'This isch Italian', 'This isch French'),
(3, 'ALS', 'This isch Italian', 'This isch French'),
(4, 'Benutzerverwaltung', 'This isch Italian', 'This isch French'),
(5, 'Dashboard', 'This isch Italian', 'This isch French'),
(6, 'Fachvortrag', 'This isch Italian', 'This isch French'),
(7, 'Leistungslohn', 'This isch Italian', 'This isch French'),
(8, 'Malus', 'This isch Italian', 'This isch French'),
(9, 'PE', 'This isch Italian', 'This isch French'),
(10, 'STAO', 'This isch Italian', 'This isch French'),
(11, 'Stundenplan', 'This isch Italian', 'This isch French'),
(12, 'Terminmanagement', 'This isch Italian', 'This isch French'),
(13, 'Verhaltensziele', 'This isch Italian', 'This isch French'),
(14, 'ÜK-KN CYP', 'This isch Italian', 'This isch French'),
(15, 'Navigation bearbeiten', 'This isch Italian', 'This isch French'),
(16, 'Einstellungen', 'This isch Italian', 'This isch French'),
(17, 'Einträge anzeigen', 'This isch Italian', 'This isch French'),
(18, 'ALS-Titel', 'This isch Italian', 'This isch French'),
(19, 'Punktzahl', 'This isch Italian', 'This isch French'),
(20, 'Lernende/r', 'This isch Italian', 'This isch French'),
(21, 'Typ', 'This isch Italian', 'This isch French'),
(22, 'Erstellungsdatum', 'This isch Italian', 'This isch French'),
(23, 'bis', 'This isch Italian', 'This isch French'),
(24, 'von', 'This isch Italian', 'This isch French'),
(25, 'Einträgen', 'This isch Italian', 'This isch French'),
(26, 'Zurück', 'This isch Italian', 'This isch French'),
(27, 'Nächste', 'This isch Italian', 'This isch French'),
(28, 'Suchen', 'This isch Italian', 'This isch French'),
(29, 'Eintrag beanstanden', 'This isch Italian', 'This isch French'),
(30, 'Begründung', 'This isch Italian', 'This isch French'),
(31, 'Abschicken', 'This isch Italian', 'This isch French'),
(32, 'Abschicken & Eintrag löschen', 'This isch Italian', 'This isch French'),
(33, 'Abbrechen', 'This isch Italian', 'This isch French'),
(34, 'Beim Abschicken werden die verantwortlichen Personen per E-Mail benachrichtigt, um den Eintrag zu überprüfen', 'This isch Italian', 'This isch French'),
(35, 'Diese Punktzahlen sind Leistungslohnrelevant. Bitte achte auf die Korrektheit deiner Einträge, es können Stichproben durchgeführt werden', 'This isch Italian', 'This isch French'),
(36, 'ALS-Leistungsziele', 'This isch Italian', 'This isch French'),
(37, 'ALS-Verhaltensziele', 'This isch Italian', 'This isch French'),
(38, 'Semester', 'This isch Italian', 'This isch French'),
(39, 'Eintrag hinzufügen', 'This isch Italian', 'This isch French'),
(40, 'Benutzerverwaltung', 'This isch Italian', 'This isch French'),
(41, 'Gruppe', 'This isch Italian', 'This isch French'),
(42, 'Vorname', 'This isch Italian', 'This isch French'),
(43, 'Nachname', 'This isch Italian', 'This isch French'),
(44, 'Benutzer hinzufügen', 'This isch Italian', 'This isch French'),
(45, 'Hinzufügen', 'This isch Italian', 'This isch French'),
(46, 'Fachvortrag-Titel', 'This isch Italian', 'This isch French'),
(47, 'Lernende', 'This isch Italian', 'This isch French'),
(48, 'Lohn', 'This isch Italian', 'This isch French'),
(49, 'Lohnzyklus', 'This isch Italian', 'This isch French'),
(50, 'Jahr', 'This isch Italian', 'This isch French'),
(51, 'Export', 'This isch Italian', 'This isch French'),
(52, 'Informatik', 'This isch Italian', 'This isch French'),
(53, 'Versicherung', 'This isch Italian', 'This isch French'),
(54, 'Bank', 'This isch Italian', 'This isch French'),
(55, 'Gewichtung', 'This isch Italian', 'This isch French'),
(56, 'Abschicken', 'This isch Italian', 'This isch French'),
(57, 'Definierte Werte', 'This isch Italian', 'This isch French'),
(58, 'Neuen Malus eintragen', 'This isch Italian', 'This isch French'),
(59, 'Notenschnitt', 'This isch Italian', 'This isch French'),
(60, 'Ungenügende Noten', 'This isch Italian', 'This isch French'),
(61, 'Fächer/Module', 'This isch Italian', 'This isch French'),
(62, 'Titel', 'This isch Italian', 'This isch French'),
(63, 'Note', 'This isch Italian', 'This isch French'),
(64, 'Datum', 'This isch Italian', 'This isch French'),
(65, 'Fach löschen', 'This isch Italian', 'This isch French'),
(66, 'Schulfach', 'This isch Italian', 'This isch French'),
(67, 'Informatik-Modul', 'This isch Italian', 'This isch French'),
(68, 'Noch keine Noten vorhanden', 'This isch Italian', 'This isch French'),
(69, 'Note Eintragen', 'This isch Italian', 'This isch French'),
(70, 'Fach', 'This isch Italian', 'This isch French'),
(71, 'Neues Fach hinzufügen', 'This isch Italian', 'This isch French'),
(72, 'PE-Titel', 'This isch Italian', 'This isch French'),
(73, 'Prozesseinheit', 'This isch Italian', 'This isch French'),
(74, 'Sprache', 'This isch Italian', 'This isch French'),
(75, 'STAO-Titel', 'This isch Italian', 'This isch French'),
(76, 'Punkte', 'This isch Italian', 'This isch French'),
(77, 'in Prozent', 'This isch Italian', 'This isch French'),
(78, 'Prozentrechner', 'This isch Italian', 'This isch French'),
(79, 'Erreichte Punktzahl', 'This isch Italian', 'This isch French'),
(80, 'Maximale Punktzahl', 'This isch Italian', 'This isch French'),
(81, 'Berechnen', 'This isch Italian', 'This isch French'),
(82, 'Standortbestimmung', 'This isch Italian', 'This isch French'),
(83, 'Stundenpläne der IT-Lernenden', 'This isch Italian', 'This isch French'),
(84, 'Stundenpläne', 'This isch Italian', 'This isch French'),
(85, 'Vorherige Woche', 'This isch Italian', 'This isch French'),
(86, 'Nächste Woche', 'This isch Italian', 'This isch French'),
(87, 'Kalenderwoche', 'This isch Italian', 'This isch French'),
(88, 'Keine Daten', 'This isch Italian', 'This isch French'),
(89, 'Ferien', 'This isch Italian', 'This isch French'),
(90, 'Klassenauswahl', 'This isch Italian', 'This isch French'),
(91, 'Stundenplan', 'This isch Italian', 'This isch French'),
(92, 'Klasse speichern', 'This isch Italian', 'This isch French'),
(93, 'Bevorstehende Termine', 'This isch Italian', 'This isch French'),
(94, 'Vergangene Termine', 'This isch Italian', 'This isch French'),
(95, 'Ablaufdatum', 'This isch Italian', 'This isch French'),
(96, 'Termine bearbeiten', 'This isch Italian', 'This isch French'),
(97, 'Beschreibung', 'This isch Italian', 'This isch French'),
(98, 'Deadline', 'This isch Italian', 'This isch French'),
(99, 'Neu', 'This isch Italian', 'This isch French'),
(100, 'Stage', 'This isch Italian', 'This isch French'),
(101, 'PA', 'This isch Italian', 'This isch French'),
(102, 'Keine Daten in der Tabelle vorhanden', 'This isch Italian', 'This isch French'),
(103, 'Keine Einträge vorhanden', 'This isch Italian', 'This isch French'),
(104, 'Erste', 'This isch Italian', 'This isch French'),
(105, 'Letzte', 'This isch Italian', 'This isch French'),
(106, 'Leistungsziele', 'This isch Italian', 'This isch French'),
(107, 'Keine Semester vorhanden', 'This isch Italian', 'This isch French'),
(108, 'Es können Stichproben durchgeführt werden', 'This isch Italian', 'This isch French'),
(109, 'Sind alle Angaben korrekt? Du kannst den Eintrag nach dem Bestätigen nicht mehr bearbeiten', 'This isch Italian', 'This isch French'),
(110, 'Ihr Account wurde keiner Gruppe zugewiesen, oder Ihnen fehlen Rechte', 'This isch Italian', 'This isch French'),
(111, 'Fehler', 'This isch Italian', 'This isch French'),
(112, 'Eintrag löschen', 'This isch Italian', 'This isch French'),
(113, 'Benutzer löschen', 'This isch Italian', 'This isch French'),
(114, 'Bitte bestätigen Sie ihre auswahl', 'This isch Italian', 'This isch French'),
(115, 'Bestätigen', 'This isch Italian', 'This isch French'),
(116, 'Keine Daten gefunden', 'This isch Italian', 'This isch French'),
(117, 'Änderungen wurden gespeichert', 'This isch Italian', 'This isch French'),
(118, 'Benutzer wurde hinzugefügt', 'This isch Italian', 'This isch French'),
(119, 'Eintrag wurde hinzugefügt', 'This isch Italian', 'This isch French'),
(120, 'Lernende Informatik', 'This isch Italian', 'This isch French'),
(121, 'Lernende KV Versicherung', 'This isch Italian', 'This isch French'),
(122, 'Lernende KV Bank', 'This isch Italian', 'This isch French'),
(123, 'Keine Lernende im System', 'This isch Italian', 'This isch French'),
(124, 'Noch keine Einträge', 'This isch Italian', 'This isch French'),
(125, 'CSV-Export', 'This isch Italian', 'This isch French'),
(126, 'Keine Noten gefunden', 'This isch Italian', 'This isch French'),
(127, 'Keine Fächer gefunden', 'This isch Italian', 'This isch French'),
(128, 'in %', 'This isch Italian', 'This isch French'),
(129, 'Begründung für Note unter 4.0', 'This isch Italian', 'This isch French'),
(130, 'Noch keine Noten vorhanden', 'This isch Italian', 'This isch French'),
(131, 'Noch keine Fächer vorhanden', 'This isch Italian', 'This isch French'),
(132, 'Zählt in Semester', 'This isch Italian', 'This isch French'),
(133, 'Fach/Modul', 'This isch Italian', 'This isch French'),
(134, 'ungenügende', 'This isch Italian', 'This isch French'),
(135, 'Korrektur', 'This isch Italian', 'This isch French'),
(136, 'IT-Modul', 'This isch Italian', 'This isch French'),
(137, 'Menüpunkt wurde hinzugefügt', 'This isch Italian', 'This isch French'),
(138, 'Zeit', 'This isch Italian', 'This isch French'),
(139, 'Raum', 'This isch Italian', 'This isch French'),
(140, 'Lehrer', 'This isch Italian', 'This isch French'),
(141, 'Termin löschen', 'This isch Italian', 'This isch French'),
(142, 'Keine Einträge', 'This isch Italian', 'This isch French'),
(143, 'Überbetriebliche-Kurse', 'This isch Italian', 'This isch French'),
(144, 'ÜK-Titel', 'This isch Italian', 'This isch French'),
(145, 'Leistung Informatik', 'This isch Italian', 'This isch French'),
(146, 'Notenschnitt Informatik-Module und ÜKs', 'This isch Italian', 'This isch French'),
(147, 'Fachvorträge', 'This isch Italian', 'This isch French'),
(148, 'Leistung Schule', 'This isch Italian', 'This isch French'),
(149, 'Notenschnitt Schulfächer', 'This isch Italian', 'This isch French'),
(150, 'Verhalten Betrieb', 'This isch Italian', 'This isch French'),
(151, 'Leistungslohn anhand aktueller Werte', 'This isch Italian', 'This isch French'),
(152, 'Daten Semester', 'This isch Italian', 'This isch French'),
(153, 'ALS - Leistungsziele', 'This isch Italian', 'This isch French'),
(154, 'Leistung Betrieb', 'This isch Italian', 'This isch French'),
(155, 'Keine Benutzer-ID vorhanden', 'This isch Italian', 'This isch French'),
(156, 'Sie haben keinen Zugriff auf diese Funktionen', 'This isch Italian', 'This isch French'),
(157, 'Bis', 'This isch Italian', 'This isch French'),
(158, 'Sprache wurde angepasst', 'This isch Italian', 'This isch French'),
(159, 'Sprache anpassen', 'Regola la lingua', 'Ajuster la langue'),
(160, 'Deutsch', 'German', 'Allemand'),
(161, 'Italienisch', 'Italiano', 'Italien'),
(162, 'Französisch', 'Francese', 'Français'),
(163, 'Ändern', 'cambiamento', 'changement'),
(164, 'Neuer Termin', 'This isch Italian', 'This isch French');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_uek`
--

CREATE TABLE `tb_uek` (
  `ID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `grade` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_uek`
--

INSERT INTO `tb_uek` (`ID`, `title`, `grade`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(125, 'Test', 5, '2018-02-19 14:05:57', 107, 39),
(126, 'Test', 5, '2018-02-19 14:05:57', 107, 39),
(127, 'Test 2', 4, '2018-02-19 14:06:10', 107, 39);

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
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `timetable`, `lastLogin`, `tb_group_ID`, `firstname`, `lastname`, `deleted`, `language`) VALUES
(6, 'b000001', NULL, NULL, 1, 'Bill', 'Gates', NULL, 'de'),
(7, 'b000002', NULL, NULL, 2, 'Mark', 'Zuckerberg', NULL, NULL),
(8, 'b000003', '2679040', NULL, 3, 'Leonardo', 'Di Caprio', NULL, NULL),
(9, 'b000004', NULL, NULL, 4, 'Elon', 'Musk', NULL, NULL),
(103, 'b123123', NULL, NULL, 3, '', '', 1, NULL),
(105, 'b111111', '2679040', NULL, 3, 'Muster', 'Lehrling', 1, NULL),
(107, 'b000005', NULL, NULL, 5, 'Steve', 'Jobs', NULL, NULL),
(108, 'b037160', '2679040', NULL, 3, 'Elia', 'Reutlinger', NULL, 'it');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_user_subject`
--

CREATE TABLE `tb_user_subject` (
  `ID` int(11) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL,
  `correctedGrade` double DEFAULT NULL,
  `school` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_user_subject`
--

INSERT INTO `tb_user_subject` (`ID`, `subjectName`, `creationDate`, `tb_user_ID`, `tb_semester_ID`, `correctedGrade`, `school`) VALUES
(11, 'Mathe', '2018-02-09 09:57:01', 8, 25, 4, 1),
(12, 'Deutsch', '2018-02-09 10:46:43', 8, 25, 5, 1),
(27, 'M151', '2018-02-09 13:38:01', 8, 29, 5, 0),
(28, 'BWL', '2018-02-09 13:40:04', 8, 29, 5, 1),
(31, 'Test', '2018-02-13 15:06:46', 103, 42, NULL, 1),
(32, 'Testfach', '2018-02-14 07:09:07', 107, 40, 5, 1),
(33, 'M104', '2018-02-15 09:10:17', 108, 27, NULL, 0),
(35, 'M226a', '2018-02-15 09:13:53', 108, 27, NULL, 0),
(36, 'ABU', '2018-02-15 09:16:53', 108, 27, NULL, 1),
(37, 'Physik 3', '2018-02-15 09:17:30', 108, 27, NULL, 1),
(38, 'Englisch 3', '2018-02-15 09:18:19', 108, 27, NULL, 1),
(39, 'M214', '2018-02-15 09:18:54', 108, 27, NULL, 0),
(40, 'M129', '2018-02-15 09:19:32', 108, 27, NULL, 0),
(41, 'ABU', '2018-02-15 09:21:26', 108, 28, NULL, 1),
(42, 'M120', '2018-02-15 09:21:35', 108, 28, NULL, 0),
(43, 'Englisch 4', '2018-02-15 09:21:50', 108, 28, NULL, 1),
(44, 'M105', '2018-02-15 09:22:15', 108, 28, NULL, 0),
(45, 'Mathe 4', '2018-02-15 09:22:24', 108, 28, NULL, 1),
(46, 'M122', '2018-02-15 09:22:32', 108, 28, NULL, 0),
(47, 'Physik 4', '2018-02-15 09:22:43', 108, 28, NULL, 1),
(48, 'M226b', '2018-02-15 09:22:52', 108, 28, NULL, 0),
(49, 'ABU', '2018-02-15 10:10:22', 108, 29, NULL, 1),
(50, 'M133', '2018-02-15 10:10:32', 108, 29, NULL, 0),
(51, 'BWL 1', '2018-02-15 10:10:43', 108, 29, NULL, 1),
(52, 'Englisch V', '2018-02-15 10:10:52', 108, 29, NULL, 1),
(53, 'Mathe V', '2018-02-15 10:11:02', 108, 29, NULL, 1),
(54, 'M306', '2018-02-15 10:11:20', 108, 29, NULL, 0),
(55, 'M151', '2018-02-15 10:11:30', 108, 29, NULL, 0),
(56, 'M100', '2018-02-15 10:36:27', 108, 25, 5, 0),
(57, 'M101', '2018-02-15 10:44:15', 108, 25, NULL, 0),
(58, 'M104', '2018-02-15 10:46:08', 108, 25, NULL, 0),
(59, 'M114', '2018-02-15 10:46:22', 108, 25, NULL, 0),
(60, 'M121', '2018-02-15 10:46:30', 108, 25, NULL, 0),
(61, 'M301', '2018-02-15 10:46:38', 108, 26, NULL, 0),
(62, 'M403', '2018-02-15 10:46:49', 108, 26, NULL, 0),
(63, 'M404', '2018-02-15 10:46:58', 108, 26, NULL, 0),
(64, 'M431', '2018-02-15 10:47:06', 108, 26, NULL, 0),
(65, 'M123', '2018-02-16 08:57:38', 8, 29, NULL, 0),
(66, 'asdf', '2018-02-16 08:58:52', 8, 30, NULL, 1),
(67, 'asdf', '2018-02-16 08:59:04', 8, 25, NULL, 1),
(68, 'asdfsaf', '2018-02-16 09:05:38', 8, 30, NULL, 1),
(69, 'M123123', '2018-02-16 09:06:52', 8, 30, NULL, 0),
(70, 'Mathe', '2018-02-16 09:07:04', 8, 30, NULL, 1),
(72, 'Test 1', '2018-02-20 06:25:35', 9, 33, NULL, 1),
(73, 'Test 2', '2018-02-20 06:25:44', 9, 34, NULL, 1),
(74, 'Test 3', '2018-02-20 06:25:52', 9, 35, NULL, 1),
(75, 'Test 4', '2018-02-20 06:26:02', 9, 36, NULL, 1),
(78, 'Test', '2018-02-20 07:36:28', 9, 37, NULL, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tb_als`
--
ALTER TABLE `tb_als`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_als_tb_semester_idx` (`tb_semester_ID`),
  ADD KEY `fk_tb_als_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  ADD PRIMARY KEY (`ID`,`tb_userLL_ID`,`tb_userPA_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_behaviorgrade_tb_user1_idx` (`tb_userLL_ID`),
  ADD KEY `fk_tb_behaviorgrade_tb_user2_idx` (`tb_userPA_ID`),
  ADD KEY `tb_semester_ID` (`tb_semester_ID`);

--
-- Indizes für die Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  ADD PRIMARY KEY (`ID`,`tb_semester_ID`),
  ADD KEY `tb_semester_ID` (`tb_semester_ID`);

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
-- Indizes für die Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_malus_tb_user1_idx` (`tb_user_ID`),
  ADD KEY `tb_semester_ID` (`tb_semester_ID`);

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
-- Indizes für die Tabelle `tb_pe`
--
ALTER TABLE `tb_pe`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_pe_tb_semester_idx` (`tb_semester_ID`),
  ADD KEY `fk_tb_pe_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_presentation_tb_semester_idx` (`tb_semester_ID`),
  ADD KEY `fk_tb_presentation_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`ID`,`tb_group_ID`),
  ADD KEY `tb_group_ID` (`tb_group_ID`),
  ADD KEY `ID_2` (`ID`);

--
-- Indizes für die Tabelle `tb_stao`
--
ALTER TABLE `tb_stao`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_stao_tb_semester_idx` (`tb_semester_ID`),
  ADD KEY `fk_tb_stao_tb_user1_idx` (`tb_user_ID`);

--
-- Indizes für die Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  ADD PRIMARY KEY (`ID`,`tb_user_subject_ID`),
  ADD KEY `fk_tb_subject_grade_tb_user_subject1_idx` (`tb_user_subject_ID`);

--
-- Indizes für die Tabelle `tb_translation`
--
ALTER TABLE `tb_translation`
  ADD PRIMARY KEY (`ID`);

--
-- Indizes für die Tabelle `tb_uek`
--
ALTER TABLE `tb_uek`
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_uek_tb_semester_idx` (`tb_semester_ID`),
  ADD KEY `fk_tb_uek_tb_user1_idx` (`tb_user_ID`);

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
  ADD PRIMARY KEY (`ID`,`tb_user_ID`,`tb_semester_ID`),
  ADD KEY `fk_tb_user_subject_tb_user1_idx` (`tb_user_ID`),
  ADD KEY `fk_tb_user_subject_tb_llit_semester1_idx` (`tb_semester_ID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tb_als`
--
ALTER TABLE `tb_als`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT für Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `tb_group`
--
ALTER TABLE `tb_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT für Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `tb_modul`
--
ALTER TABLE `tb_modul`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT für Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT für Tabelle `tb_pe`
--
ALTER TABLE `tb_pe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `tb_stao`
--
ALTER TABLE `tb_stao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT für Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT für Tabelle `tb_translation`
--
ALTER TABLE `tb_translation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT für Tabelle `tb_uek`
--
ALTER TABLE `tb_uek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT für Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT für Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tb_als`
--
ALTER TABLE `tb_als`
  ADD CONSTRAINT `fk_tb_als_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_als_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  ADD CONSTRAINT `fk_tb_behaviorgrade_tb_user1` FOREIGN KEY (`tb_userLL_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_behaviorgrade_tb_user2` FOREIGN KEY (`tb_userPA_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_behaviorgrade_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  ADD CONSTRAINT `tb_deadline_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

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
  ADD CONSTRAINT `fk_tb_malus_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_malus_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  ADD CONSTRAINT `fk_tb_modul_group_tb_group1` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_modul_group_tb_modul1` FOREIGN KEY (`tb_modul_ID`) REFERENCES `tb_modul` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_pe`
--
ALTER TABLE `tb_pe`
  ADD CONSTRAINT `fk_tb_pe_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_pe_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  ADD CONSTRAINT `fk_tb_presentation_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_presentation_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD CONSTRAINT `tb_semester_ibfk_1` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`);

--
-- Constraints der Tabelle `tb_stao`
--
ALTER TABLE `tb_stao`
  ADD CONSTRAINT `fk_tb_stao_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_stao_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  ADD CONSTRAINT `fk_tb_subject_grade_tb_user_subject1` FOREIGN KEY (`tb_user_subject_ID`) REFERENCES `tb_user_subject` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_uek`
--
ALTER TABLE `tb_uek`
  ADD CONSTRAINT `fk_tb_uek_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_uek_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `fk_tb_user_tb_group` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  ADD CONSTRAINT `fk_tb_user_subject_tb_llit_semester1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_user_subject_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
