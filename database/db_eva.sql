-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Feb 2018 um 19:13
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
(66, 'Ohje', 33, '2018-02-21 07:10:33', 9, 33, 1),
(67, 'Ohje', 33, '2018-02-21 07:10:33', 9, 33, 1),
(68, 'Ohje', 33, '2018-02-21 07:10:33', 9, 33, 1),
(69, 'asd', 12, '2018-02-21 08:36:35', 9, 35, 1),
(71, 'test', 34, '2018-02-21 08:38:13', 9, 33, NULL),
(72, 'okcool', 123, '2018-02-22 17:05:08', 9, 36, 1),
(73, 'okcool', 123, '2018-02-22 17:05:44', 9, 36, 1),
(74, 'okcool', 123, '2018-02-22 17:05:44', 9, 36, 1),
(75, 'asd', 123, '2018-02-22 17:05:54', 9, 35, 1),
(76, 'asdf', 21, '2018-02-22 17:07:32', 9, 36, NULL),
(77, 'adsf', 123, '2018-02-22 17:08:41', 9, 36, NULL),
(78, 'asdf', 121, '2018-02-22 17:10:12', 9, 36, NULL),
(79, 'asdf', 121, '2018-02-22 17:11:58', 9, 36, NULL),
(80, 'asdf', 121, '2018-02-22 17:11:58', 9, 36, NULL),
(84, 'Schaisse', 12, '2018-02-23 06:12:47', 9, 34, 1),
(85, 'Fucl', 33, '2018-02-23 06:13:11', 9, 37, NULL),
(86, 'asdf', 123, '2018-02-23 06:40:07', 9, 36, NULL),
(87, 'Achman', 111, '2018-02-23 08:45:18', 9, 35, 1),
(88, 'ALS Verhalten MANN', 333, '2018-02-23 08:45:34', 9, 36, NULL),
(89, 'ALS 1', 44, '2018-02-23 13:31:05', 112, 33, 1),
(90, 'ALS 2', 42, '2018-02-23 13:31:17', 112, 34, 1),
(91, 'ALS 3', 49, '2018-02-23 13:31:30', 112, 35, 1),
(92, 'ALS 4', 44, '2018-02-23 13:31:41', 112, 36, 1),
(93, 'ALS 1', 51, '2018-02-23 13:32:04', 112, 33, NULL),
(94, 'ALS 2', 47, '2018-02-23 13:32:14', 112, 34, NULL),
(95, 'ALS 3', 48, '2018-02-23 13:32:27', 112, 35, NULL),
(96, 'ALS 4', 48, '2018-02-23 13:32:40', 112, 36, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_appinfo`
--

CREATE TABLE `tb_appinfo` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `title_short` varchar(20) NOT NULL,
  `description` varchar(30) NOT NULL,
  `logo_path` varchar(50) DEFAULT NULL,
  `logo_width` double NOT NULL,
  `hintergrund` varchar(7) NOT NULL,
  `akzentfarbe` varchar(7) NOT NULL,
  `schrift` varchar(7) NOT NULL,
  `link` varchar(7) NOT NULL,
  `mail_support` varchar(255) DEFAULT NULL,
  `mail_hr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_appinfo`
--

INSERT INTO `tb_appinfo` (`id`, `title`, `title_short`, `description`, `logo_path`, `logo_width`, `hintergrund`, `akzentfarbe`, `schrift`, `link`, `mail_support`, `mail_hr`) VALUES
(2, 'Cash Calculator', 'cashcalculator', 'Evaluation-Tool for trainees', 'img/basler_logo.svg', 150, '#ffffff', '#F1F4FB', '#333333', '#1C4E9C', 'mail@eliareutlinger.ch', 'mail@eliareutlinger.ch');

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
(9, 8, 7, 'IST', 123, '2018-02-19 08:51:08', 25),
(10, 8, 7, 'asdf', 111, '2018-02-19 08:54:42', 28),
(11, 8, 7, 'Test', 60, '2018-02-20 13:50:50', 26),
(47, 8, 7, 'TestTest', 99, '2018-02-22 12:23:36', 29),
(51, 108, 7, 'Helpdesk', 59, '2018-02-22 14:16:55', 29),
(52, 108, 7, 'Software-Engineering 1 (Zwischen-Feedback)', 60, '2018-02-22 14:17:25', 29),
(54, 8, 7, 'Okgeil', 123, '2018-02-23 06:08:36', 28),
(56, 8, 7, 'Achnei', 50, '2018-02-23 08:44:22', 25),
(57, 8, 7, 'sadf', 12, '2018-02-23 12:39:12', 27);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline`
--

CREATE TABLE `tb_deadline` (
  `ID` int(11) NOT NULL,
  `title_de` text,
  `title_fr` text NOT NULL,
  `title_it` text NOT NULL,
  `description_de` text,
  `description_fr` text NOT NULL,
  `description_it` text NOT NULL,
  `date` date DEFAULT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_deadline_check`
--

CREATE TABLE `tb_deadline_check` (
  `tb_deadline_ID` int(11) NOT NULL,
  `tb_user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` varchar(255) NOT NULL,
  `prefix` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_group`
--

INSERT INTO `tb_group` (`ID`, `name`, `description`, `prefix`) VALUES
(1, '194', 'Nachwuchsentwicklung', 'NW'),
(2, '193', 'Praxisausbildner', 'PA'),
(3, '190', 'Lernende Informatik', 'LIT'),
(4, '191', 'Lernende KV Versicherung', 'LKV'),
(5, '192', 'Lernende KV Bank', 'LKB');

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
(21, '#ffffff', '#ffffff', '#00ff14', '#000000', 112);

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
(139, NULL, 6, 4),
(151, NULL, 108, 7),
(152, NULL, 9, 9),
(153, NULL, 9, 8),
(158, NULL, 6, 11),
(159, NULL, 6, 7),
(160, NULL, 8, 12),
(162, NULL, 6, 1),
(163, NULL, 8, 7),
(164, NULL, 8, 5),
(165, NULL, 8, 7);

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
(13, 'Test 2', 50, '2018-02-14 06:56:31', 9, 34),
(15, 'Test', 34, '2018-02-21 08:51:00', 9, 36),
(16, 'asd', 12, '2018-02-21 08:51:50', 8, 25),
(17, 'Sali', 50, '2018-02-22 09:03:34', 8, 25),
(18, 'Sali', 50, '2018-02-22 09:04:10', 8, 25),
(19, 'Sali', 50, '2018-02-22 09:04:18', 8, 25),
(20, 'Sali', 50, '2018-02-22 09:04:31', 8, 25),
(21, 'asdasdf', 12, '2018-02-22 09:04:52', 8, 25),
(22, 'test', 123, '2018-02-22 09:05:13', 8, 25),
(23, 'test', 123, '2018-02-22 09:05:21', 8, 25),
(24, 'test', 123, '2018-02-22 09:06:12', 8, 25),
(25, 'test', 123, '2018-02-22 09:06:23', 8, 25),
(26, 'ysdfafds', 12, '2018-02-22 09:07:05', 8, 25),
(67, 'Tescht', 213, '2018-02-23 06:24:37', 9, 33),
(69, 'Tescht', 12, '2018-02-23 07:07:23', 8, 25),
(70, 'Tescht', 12, '2018-02-23 07:08:21', 8, 25),
(71, 'sdfasafdfdsaasfdadsf', 1, '2018-02-23 07:14:50', 9, 33),
(72, 'Test', 123, '2018-02-23 07:17:51', 8, 25);

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
(1, 'ALS', 'ALS-Modul', 'modul/als/als.php', '3', 'img/dashico/telephone-operator.svg'),
(2, 'Benutzerverwaltung', 'Benutzerverwaltung für Nachwuchsentwicklung', 'modul/benutzerverwaltung/benutzerverwaltung.php', '4', 'img/dashico/002-person.svg'),
(3, 'Dashboard', 'Dashboard mit allen Modulen', 'modul/dashboard/dashboard.php', '5', NULL),
(4, 'Fachvortrag', 'Modul zur Sammlung der Fachvortrag Bewertungen.', 'modul/fachvortrag/fachvortrag.php', '6', 'img/dashico/001-pie-chart.svg'),
(5, 'Leistungslohn', 'Modul zur berechnung des Leistungslohnes und der generierung eines CSV', 'modul/leistungslohn/leistungslohn.php', '7', 'img/dashico/003-coins.svg'),
(6, 'Malus', 'Modul zur Sammlung von Malus-Werten', 'modul/malus/malus.php', '8', 'img/dashico/001-exclamation.svg'),
(7, 'Noten', 'Modul zur Sammlung von Fächern und Noten', 'modul/noten/noten.php', '2', 'img/dashico/003-file.svg'),
(8, 'PE', 'Modul zur Sammlung von PE bewertungen.', 'modul/pe/pe.php', '9', 'img/dashico/workflow.svg'),
(9, 'STAO', 'Modul zur Sammlung von STAO Bewertungen', 'modul/stao/stao.php', '10', 'img/dashico/test.svg'),
(10, 'Stundenplan', 'Modul zur speicherung eines GIBM Stundenplans.', 'modul/stundenplan/stundenplan.php', '11', 'img/dashico/002-people.svg'),
(11, 'Terminmanagement', 'Modul zur betreuung von Terminen', 'modul/terminmanagement/terminmanagement.php', '12', 'img/dashico/001-clock.svg'),
(12, 'Verhaltensziele', 'Modul zur Sammlung der Bewertung der Verhaltensziele', 'modul/verhaltensziele/verhaltensziele.php', '13', 'img/dashico/002-man.svg'),
(14, 'ÜK-KN CYP', 'Überbetriebliche Kurse LKB', 'modul/uek/uek.php', '14', 'img/dashico/school.svg');

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
(25, 'Test 2', 65, '2018-02-19 11:59:31', 8, 36),
(28, 'HEINEIMANN ääüüöö', 100, '2018-02-23 08:46:18', 9, 36),
(29, 'Lehrbetrieb Jahr 1', 26, '2018-02-23 13:33:54', 112, 33),
(30, 'Lehrbetrieb Jahr 2', 35, '2018-02-23 13:34:12', 112, 35),
(31, 'Prüfungsex. Jahr 1', 32, '2018-02-23 13:34:31', 112, 33),
(32, 'Prüfungsex. Jahr 2', 34, '2018-02-23 13:34:47', 112, 35);

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
(15, '1234', 1234, '2018-02-19 08:48:11', 8, 25),
(16, 'dsaf', 123, '2018-02-19 08:49:15', 8, 27),
(17, '123', 213, '2018-02-19 08:49:22', 8, 26),
(18, 'asd', 123, '2018-02-19 08:50:11', 8, 27),
(20, 'hallio', 231, '2018-02-19 08:50:48', 8, 26),
(21, 'hallio', 231, '2018-02-19 08:50:48', 8, 26),
(25, 'Ohjeohnei', 50, '2018-02-23 08:44:44', 8, 27);

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
(45, 'Tschau', 88, '2018-02-19 11:22:59', 9, 35),
(53, 'ächt jetzt alte', 99, '2018-02-23 08:46:41', 9, 37),
(54, 'Stao 1', 78, '2018-02-23 13:45:20', 112, 34),
(55, 'Stao 2', 57, '2018-02-23 13:45:32', 112, 36);

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
(5, 'Tescht', 3, '2018-02-23 06:11:59', 120, NULL, 3, 'Aldeeee'),
(6, 'OK', 5, '2018-02-23 06:33:52', 100, NULL, 2, ''),
(7, 'Ohjeohnei', 4, '2018-02-23 08:43:37', 100, NULL, 2, 'Isch halt scheisse gloffe odr\n\nShizzlin dizzle tellivizzle for sure sure augue shut the shizzle up accumsan. You son of a bizzle izzle est. Vivamus mauris funky fresh, viverra vitae, dang izzle, ultrices izzle, brizzle. Vestibulizzle bow wow wow things get down get down izzle check out this orci luctus nizzle ultricizzle posuere black We gonna chung; Donec dolor. Bling bling faucibizzle. Fo shizzle pharetra boofron bow wow wow. Vivamizzle my shizz go to hizzle orci. Sed for sure. Maurizzle sizzle fizzle, get down get down shiznit, things yippiyo, blandizzle ass, magna.'),
(8, 'Fuuuuuu', 3, '2018-02-23 08:43:49', 100, NULL, 1, 'Shizzlin dizzle tellivizzle for sure sure augue shut the shizzle up accumsan. You son of a bizzle izzle est. Vivamus mauris funky fresh, viverra vitae, dang izzle, ultrices izzle, brizzle. Vestibulizzle bow wow wow things get down get down izzle check out this orci luctus nizzle ultricizzle posuere black We gonna chung; Donec dolor. Bling bling faucibizzle. Fo shizzle pharetra boofron bow wow wow. Vivamizzle my shizz go to hizzle orci. Sed for sure. Maurizzle sizzle fizzle, get down get down shiznit, things yippiyo, blandizzle ass, magna.'),
(11, 'TESCHTNOTE', 2, '2018-02-23 09:02:50', 25, NULL, 4, 'Shizzlin dizzle tellivizzle for sure sure augue shut the shizzle up accumsan. You son of a bizzle izzle est. Vivamus mauris funky fresh, viverra vitae, dang izzle, ultrices izzle, brizzle. Vestibulizzle bow wow wow things get down get down izzle check out this orci luctus nizzle ultricizzle posuere black We gonna chung; Donec dolor. Bling bling faucibizzle. Fo shizzle pharetra boofron bow wow wow. Vivamizzle my shizz go to hizzle orci. Sed for sure. Maurizzle sizzle fizzle, get down get down shiznit, things yippiyo, blandizzle ass, magna.'),
(12, 'Zeugnis', 5.1, '2018-02-23 13:27:14', 100, NULL, 5, ''),
(13, 'Zeugnis', 5.2, '2018-02-23 13:28:02', 100, NULL, 6, ''),
(14, '5.2', 5.3, '2018-02-23 13:28:40', 100, NULL, 7, ''),
(15, 'Test 1', 5.2, '2018-02-23 13:29:34', 100, NULL, 9, ''),
(16, 'Test 2', 5.2, '2018-02-23 13:29:47', 100, NULL, 9, ''),
(17, 'Test 1', 5.4, '2018-02-23 13:30:00', 100, NULL, 8, ''),
(18, 'Test 2', 5.4, '2018-02-23 13:30:10', 100, NULL, 8, '');

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
(1, 'Willkommen', 'Benvenuto', 'Bienvenue'),
(2, 'Noten', 'Valutazioni', 'Notes'),
(3, 'ALS', 'SAL', 'STA'),
(4, 'Benutzerverwaltung', 'Accessi utilizzatori', 'Service accès utilisateurs'),
(5, 'Dashboard', 'Dashboard', 'Tableau de bord'),
(6, 'Fachvortrag', 'Presentazione tecnica del ramo', 'Exposé de branche'),
(7, 'Leistungslohn', 'Salario alla performance', 'Salaire à la performance'),
(8, 'Malus', 'Malus', 'Malus'),
(9, 'PE', 'UP', 'UF'),
(10, 'STAO', 'Punto della situazione', 'Point de situation'),
(11, 'Stundenplan', 'Tabella orario', 'Plan horaire'),
(12, 'Terminmanagement', 'Gestione dei colloqui', 'Gestion des rendez-vous'),
(13, 'Verhaltensziele', 'Obiettivi di comportamento', 'Objectif de comportement'),
(14, 'ÜK-KN CYP', '', ''),
(15, 'Navigation bearbeiten', 'Modifica di navigazione', 'Modification de navigazion'),
(16, 'Einstellungen', 'Parametri', 'Paramètres'),
(17, 'Einträge anzeigen', 'Mostrare iscrizioni', 'Afficher inscriptions'),
(18, 'ALS-Titel', 'Titolo SAL', 'Titre STA'),
(19, 'Punktzahl', 'Punteggio', 'Nombre de points'),
(20, 'Lernende/r', 'Apprendista', 'Apprenti/e'),
(21, 'Typ', 'Tipo', 'Type'),
(22, 'Erstellungsdatum', 'Data di elaborazione', 'Date d\'établissement'),
(23, 'bis', 'Fino', 'jusqu\'au'),
(24, 'von', 'Dal', 'du'),
(25, 'Einträgen', 'Iscrizioni', 'Inscriptions'),
(26, 'Zurück', 'Indietro', 'Retour'),
(27, 'Nächste', 'Prossimo', 'Prochain'),
(28, 'Suchen', 'Cercare', 'Chercher'),
(29, 'Eintrag beanstanden', 'Entrata contestata', 'Entrée contestée'),
(30, 'Begründung', 'Giustificazione', 'Justification'),
(31, 'Abschicken', 'Inviare', 'Envoyer'),
(32, 'Abschicken & Eintrag löschen', 'Inviare e cancellare l\'iscrizione', 'Envoyer et effacer inscription'),
(33, 'Abbrechen', 'Interrompere', 'Interrompre'),
(34, 'Beim Abschicken werden die verantwortlichen Personen per E-Mail benachrichtigt, um den Eintrag zu überprüfen', 'Con l\'invio, i responsabili saranno informati per e-mail per la verifica dell\'iscrizione', 'Lors de l\'envoi, les personnes responsables seront informées par e-mail afin de vérifier l\'inscription'),
(35, 'Diese Punktzahlen sind Leistungslohnrelevant. Bitte achte auf die Korrektheit deiner Einträge, es können Stichproben durchgeführt werden', 'Il punteggio influenza il salario alla performance. Verifichi l\'esattezza delle iscrizioni dei sondaggi possono essere realizzati', 'Le nombre de points influence le salaire à la performance. Vérifiez l\'exactitude de vos inscriptions des sondages peuvent être réalisés'),
(36, 'ALS-Leistungsziele', 'Obiettivi di performance SAL', 'Objectifs de performance STA'),
(37, 'ALS-Verhaltensziele', 'Obiettivi di comportamento SAL', 'Objectifs de comportement STA'),
(38, 'Semester', 'Semestre', 'Semestre'),
(39, 'Eintrag hinzufügen', 'Inserire un\'iscrizione', 'Insérer une inscription'),
(40, 'Gruppe', 'Gruppo', 'Groupe'),
(41, 'Vorname', 'Nome', 'Prénom'),
(42, 'Nachname', 'Cognome', 'Nom '),
(43, 'Benutzer hinzufügen', 'Aggiungere un utente', 'Ajouter un utilisateur'),
(44, 'Hinzufügen', 'Aggiungere', 'Ajouter  '),
(45, 'Fachvortrag-Titel', 'Titolo della presentazione', 'Titre de l\'exposé'),
(46, 'Lernende', 'Apprendista', 'Apprenti/e'),
(47, 'Lohnzyklus', 'Ciclo del salario', 'Cycle de salaire'),
(48, 'Jahr', 'Anno', 'Année'),
(49, 'Gewichtung', 'Ponderazione', 'Pondération'),
(50, 'Definierte Werte', 'Valore definito', 'Valeur définie'),
(51, 'Neuen Malus eintragen', 'Aggiungere un nuovo Malus', 'Ajouter un nouveau Malus'),
(52, 'Notenschnitt', 'Media dei voti scolastici', 'Moyenne des notes'),
(53, 'Ungenügende Noten', 'Voti insufficienti', 'Notes insuffisantes'),
(54, 'Fächer/Module', 'Ramo/Modulo', 'Branche/Module'),
(55, 'Titel', 'Titolo', 'Titre  '),
(56, 'Note', 'Voto scolastico', 'Note'),
(57, 'Datum', 'Data', 'Date   '),
(58, 'Fach löschen', 'Cancellare ramo', 'Effacer branche'),
(59, 'Schulfach', 'Materia', 'Branche scolaire'),
(60, 'Informatik-Modul', 'Modulo informatico', 'Module informatique'),
(61, 'Noch keine Noten vorhanden', 'Nessun voto disponibile', 'Aucune note disponible'),
(62, 'Fach', 'Ramo', 'Branche'),
(63, 'Neues Fach hinzufügen', 'Aggiungere un nuovo ramo', 'Ajouter une nouvelle branche'),
(64, 'PE-Titel', 'Titolo UP', 'Titre UF'),
(65, 'Prozesseinheit', 'Unità procedurale', 'Unité de formation'),
(66, 'STAO-Titel', 'Titolo punto di situazione', 'Titre point de situation'),
(67, 'Punkte', 'Punteggio', 'Points'),
(68, 'Prozentrechner', 'Calcolatore della percentuale', 'Calculateur de pourcents'),
(69, 'Erreichte Punktzahl', 'Punteggio raggiunto', 'Nombre de points atteint'),
(70, 'Maximale Punktzahl', 'Punteggio massimo', 'Nombre de points maximal'),
(71, 'Berechnen', 'Calcolare', 'Calculer '),
(72, 'Stundenpläne', 'Orari', 'Plan horaire'),
(73, 'Vorherige Woche', 'Settimana precedente', 'Semaine précédente'),
(74, 'Nächste Woche', 'Settimana seguente', 'Semaine suivante'),
(75, 'Kalenderwoche', 'Calendario settimanale', 'Semaine de calendrier'),
(76, 'Klassenauswahl', 'Scelta della classe', 'Choix de la classe'),
(77, 'Klasse speichern', 'Registrare classe', 'Sauvegarder classe'),
(78, 'Bevorstehende Termine', 'Prossimo colloquio', 'Prochain rendez-vous'),
(79, 'Vergangene Termine', 'Colloquio precedente', 'Rendez-vous précédent'),
(80, 'Ablaufdatum', 'Data di scadenza', 'Date d\'expiration'),
(81, 'Termine bearbeiten', 'Modificare colloquio', 'Modifier les rendez-vous'),
(82, 'Beschreibung', 'Descrizione', 'Description'),
(83, 'Deadline', 'Scadenza', 'Date butoir'),
(84, 'Stage', 'Stage', 'Stage'),
(85, 'PA', 'Maestro di pratica', 'Formateur pratique'),
(86, 'Keine Daten in der Tabelle vorhanden', 'Nessun dato disponibile nella tabella', 'Aucune donnée disponible dans le tableau'),
(87, 'Keine Einträge vorhanden', 'Nessuna iscrizione disponibile', 'Aucune inscription disponible'),
(88, 'Erste', 'Primo', 'Premier'),
(89, 'Letzte', 'Ultimo', 'Dernier'),
(90, 'Leistungsziele', 'Obiettivi di performance', 'Objectifs de performance'),
(91, 'Keine Semester vorhanden', 'Nessun semestre disponibile', 'Aucun semestre disponible'),
(92, 'Es können Stichproben durchgeführt werden', 'Degli sondaggi possono essere effettuati', 'Des sondages peuvent être effectués'),
(93, 'Sind alle Angaben korrekt? Du kannst den Eintrag nach dem Bestätigen nicht mehr bearbeiten', 'Tutti i dati sono corretti? Dopo la conferma, non sarà più possibile modificare', 'Toutes les données sont correctes ? Après confirmation, il ne sera plus possible effectuer de modifications.'),
(94, 'Ihr Account wurde keiner Gruppe zugewiesen, oder Ihnen fehlen Rechte', 'Il conto non può essere attribuito ad un gruppo, o mancano le autorizzazioni d\'accesso', 'Votre compte n\'a pas pu être attribué à un groupe, ou les autorisations d\'accès manquent'),
(95, 'Fehler', 'Errore', 'Erreur'),
(96, 'Eintrag löschen', 'Cancellare iscrizione', 'Effacer inscription'),
(97, 'Benutzer löschen', 'Cancellare utente', 'Effacer utilisateur'),
(98, 'Bitte bestätigen Sie ihre auswahl', 'Pregasi confermare scelta', 'Veuillez confirmer votre choix'),
(99, 'Bestätigen', 'Confermare', 'Confirmer'),
(100, 'Keine Daten gefunden', 'Nessun dato disponibile', 'Aucune donnée disponible  '),
(101, 'Änderungen wurden gespeichert', 'Le modifiche sono state registrate', 'Les modifications ont été sauvegardées'),
(102, 'Benutzer wurde hinzugefügt', 'Un utente è stato aggiunto', 'Un utilisateur a été ajouté'),
(103, 'Eintrag wurde hinzugefügt', 'Un\'iscrizione è stata aggiunta', 'Une inscription a été ajoutée'),
(104, 'Keine Lernende im System', 'Nessun apprendista nel sistema', 'Aucun apprenti dans le système'),
(105, 'Noch keine Einträge', 'Nessuna iscrizione', 'Pas encore d\'inscription'),
(106, 'CSV-Export', 'CSV-Export', 'CSV-Export'),
(107, 'Keine Noten gefunden', 'Nessun voto trovato', 'Aucune note trouvée'),
(108, 'Keine Fächer gefunden', 'Nessun ramo trovato', 'Aucune branche trouvée'),
(109, 'in %', 'in %', 'en %'),
(110, 'Begründung für Note unter 4.0', 'Giustificazione per un voto sotto 4.0', 'Justification pour note en-dessous de 4.0'),
(112, 'Noch keine Fächer vorhanden', 'Nessun ramo ancora disponibile', 'Encore aucune branche disponible'),
(113, 'Zählt in Semester', 'Conteggio nel semestre', 'Compte dans le semestre'),
(114, 'Fach/Modul', 'Ramo/Modulo', 'Branche/Module'),
(115, 'ungenügende', 'Insufficiente', 'Insuffisant'),
(116, 'Korrektur', 'Correzione', 'Correction'),
(117, 'IT-Modul', 'Modulo IT', 'Module-IT'),
(118, 'Menüpunkt wurde hinzugefügt', 'L\'indice è stato aggiunto', 'Index du menu a été ajouté'),
(119, 'Zeit', 'Tempo', 'Temps'),
(120, 'Raum', 'Sala', 'Salle'),
(121, 'Lehrer', 'Insegnante', 'Enseignant-e'),
(122, 'Termin löschen', 'Cancellare colloquio', 'Effacer rendez-vous'),
(123, 'Keine Einträge', 'Nessuna iscrizione', 'Aucune inscription  '),
(124, 'Überbetriebliche-Kurse', 'Corsi interaziendali', 'Cours interentreprises'),
(125, 'ÜK-Titel', 'Titolo dei corsi interaziendali', 'Titre des cours interentreprises'),
(126, 'Leistung Informatik', 'Prestazioni informatiche', 'Prestations informatique'),
(127, 'Notenschnitt Informatik-Module und ÜKs', 'Media dei voti dei moduli informatici e corsi interaziendali', 'Moyenne des notes Module Informatique et CIE'),
(128, 'Fachvorträge', 'Rami presentati', 'Branches exposées'),
(129, 'Leistung Schule', 'Prestazione scuola', 'Prestations école'),
(130, 'Notenschnitt Schulfächer', 'Media dei voti rami scolastici', 'Moyenne des notes branches scolaires'),
(131, 'Verhalten Betrieb', 'Comportamento in azienda', 'Comportement en entreprise'),
(132, 'Leistungslohn anhand aktueller Werte', 'Salario alla performance secondo i valori attuali', 'Salaire à la performance selon les valeurs actuelles'),
(133, 'Daten Semester', 'Voti del semestre', 'Notes du semestre'),
(135, 'Leistung Betrieb', 'Performance in azienda', 'Performance en entreprise'),
(136, 'Keine Benutzer-ID vorhanden', 'Nessun utente-ID disponibile', 'Aucun utilisateur-ID disponible'),
(137, 'Sie haben keinen Zugriff auf diese Funktionen', 'Nessun accesso alle funzioni', 'Aucun accès à ces fonctions'),
(138, 'Sprache wurde angepasst', 'La lingua è stata adattata', 'La langue a été adaptée'),
(139, 'Sprache anpassen', 'Adattare lingua', 'Adapter langue'),
(140, 'Deutsch', 'Tedesco', 'Allemand'),
(141, 'Italienisch', 'Italiano', 'Italien'),
(142, 'Französisch', 'Francese', 'Français'),
(143, 'Ändern', 'Modificare', 'Modifier  '),
(144, 'Neuer Termin', 'Nuovo colloquio', 'Nouveau rendez-vous'),
(145, 'Sie haben keine Berechtigungen zu diesem Modul', 'Nessuna autorizzazione per questo modulo', 'Aucune autorisation pour ce module'),
(146, 'Bitte eine Begründung angeben', 'Pregasi aggiungere giustificazione', 'Veuillez ajouter une justification'),
(147, 'Beanstandung abgeschickt', 'Reclamazione inviata', 'Réclamation envoyée'),
(148, 'Löschen bestätigen', 'Confermare la cancellazione', 'Confirmer la suppression'),
(149, 'Beanstandung abgeschickt & Eintrag gelöscht', 'Reclamazione inviata & Iscrizione cancellata', 'Réclamation envoyée & Inscription supprimée'),
(150, 'Bitte ein Semester angeben', 'Pregasi indicare il semestre', 'Prière d\'indiquer un semestre'),
(151, 'Bitte einen ALS-Titel angeben', 'Pregasi indicare il titolo della SAL', 'Prière d\'indiquer un Titre-STA'),
(152, 'Bitte eine Punktzahl angeben', 'Pregasi indicare il punteggio', 'Prière d\'indiquer le nombre de points'),
(153, 'Der B-Key muss aus 7 Zeichen bestehen', 'Il B-Key deve comprendere 7 caratteri', 'Le B-Key doit comprendre 7 caractères'),
(154, 'Bitte Gruppe auswählen', 'Pregasi scegliere un gruppo', 'Veuillez choisir un groupe'),
(155, 'Seite enthält keinen gültigen Pfad', 'La pagina non contiene nessun accesso valido', 'La page ne contient aucun chemin d\'accès valide'),
(156, 'Seite wurde noch nicht verlinkt', 'Un legame verso la pagina non\'è stato ancora creato', 'Un lien vers la page n\'a pas encore été créé'),
(157, 'Fehler: Keine/Leere Antwort erhalten', 'Errore : nessuna risposta/risposta vuota', 'Erreur: Aucune réponse/réponse vide'),
(158, 'Fehler: Semester konnten nicht gefunden werden', 'Errore : il semestre non è stato trovato', 'Erreur:le semestre n\'a pas pu être trouvé'),
(159, 'Bitte einen Malus-Titel angeben', 'Pregasi indicare un titolo di Malus', 'Prière d\'indiquer un titre de Malus'),
(160, 'Bitte eine Gewichtung angeben', 'Pregasi indicare un valore di ponderazione', 'Prière d\'indiquer une valeur de pondération'),
(161, 'Kein Eintrag angegeben', 'Nessuna iscrizione', 'Aucune inscription'),
(162, 'Bist du dir sicher? Dabei werden alle Noten gelöscht', 'Sicuro? Tutti i dati verranno cancellati', 'Sûr ? Toutes les notes seront effacées'),
(163, 'Kein Fach angegeben', 'Nessun ramo indicato', 'Aucune branche indiquée'),
(164, 'Klasse speichern', 'Registrare classe', 'Sauvegarder classe'),
(165, 'Klasse gespeichert', 'Classe registrata', 'Classe sauvegardée'),
(166, 'Keine Klasse ausgewählt', 'Nessuna classe selezionata', 'Aucune classe sélectionnée'),
(167, 'Keine Daten aus dieser Kalenderwoche: Ferien', 'Nessun dato del calendario settimanale : vacanze', 'Aucune donnée dans cette semaine de calendrier : vacances'),
(168, 'Bitte einen ÜK-Titel angeben', 'Pregasi indicare un titolo al corso interaziendale', 'Prière d\'indiquer un titre CIE'),
(169, 'Bitte einen Verhaltensziele-Titel angeben', 'Pregasi indicare un titolo d\'obiettivo di comportamento', 'Prière d\'indiquer un titre d\'objectif de comportement'),
(170, 'Bitte einen PA angeben', 'Pregasi indicare un maestro di pratica', 'Prière d\'indiquer un formateur pratique'),
(171, 'Bitte Note angeben', 'Pregasi indicare un voto scolastico', 'Prière d\'indiquer une note'),
(172, 'Bitte Titel angeben', 'Pregasi indicare un titolo', 'Prière d\'indiquer un titre'),
(173, 'Bitte Gewichtung angeben', 'Pregasi indicare un valore di ponderazione', 'Prière d\'indiquer une valeur de pondération'),
(174, 'Bitte Begründung für Note unter 4.0 angeben', 'Pregasi indicare una giustificazione per i voti sotto 4.0', 'Prière d\'indiquer une justification pour les notes en-dessous de 4.0'),
(175, 'Fach wurde hinzugefügt', 'Un ramo è stato iscritto', 'Une branche a été inscrite'),
(176, 'Bitte einen Fachvortrag-Titel angeben', 'Pregasi indicare un titolo alla presentazione del ramo', 'Prière d\'indiquer un titre d\'exposé de branche'),
(177, 'Bitte einen PE-Titel angeben', 'Pregasi indicare un titolo alla UP', 'Prière d\'indiquer un titre à l\'UF'),
(178, 'Bitte einen STAO-Titel angeben', 'Pregasi indicare un titolo al punto di situazione', 'Prière d\'indiquer un titre au point de situation'),
(179, 'Bitte Deadline angeben', '', ''),
(180, 'Design anpassen', '', ''),
(181, 'Hintergrund', '', ''),
(182, 'Schrift', '', ''),
(183, 'Links', '', ''),
(184, 'Beste Grüsse', '', ''),
(185, 'Hallo Anwender', '', ''),
(186, 'Hallo', '', ''),
(187, 'Du hast bisher nichts eingetragen', '', ''),
(188, 'PS: Du kannst direkt auf diese E-Mail antworten um mit dem betroffenen Mitarbeiter/Absender in Kontakt zu treten.', '', ''),
(189, 'Zurücksetzen', '', ''),
(190, 'Lernende Informatik', 'Apprendista informatica', 'Apprenti Informatique'),
(191, 'Lernende KV Versicherung', 'Apprendista impiegato di commercio - assicurazioni private', 'Apprenti employé de commerce - assurances privées'),
(192, 'Lernende KV Bank', 'Apprendista impiegato di commercio - banca', 'Apprenti employé de commerce - banque'),
(193, 'Praxisausbildner', 'Maestro di pratica', 'Formateur pratique'),
(194, 'Nachwuchsentwicklung', 'Sviluppo giovani leve', 'Développement de la relève'),
(195, 'Bitte Fach-Typ angeben', '', ''),
(196, 'Bitte Fach angeben', '', ''),
(197, 'Bitte Semester angeben', '', ''),
(198, 'Neuer Malus hinzugefügt', '', ''),
(199, 'Du hast einen Malus erhalten! Dieser wird ab in der Lohnberechnung berücksichtigt und ist für dich unter Leistungslohn ersichtlich.<br/><br/>Malus-Gewichtung: <b>{weigth}</b> %<br/>Begründung:<br/>{reason}<br/>', '', ''),
(200, 'Malus gelöscht', '', ''),
(201, 'Ein Malus wurde aus deinem Profil entfernt und entsprechend in der Lohnberechnung angepasst.', '', ''),
(202, '{firstname} {lastname} hat eine ungenügende Note', '', ''),
(203, 'Der benutzer {firstname} {lastname} ({bkey}) hat soeben eine ungenügende Note mit dem Titel {gradeTitle} eingetragen.<br/><br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', '', ''),
(204, 'Notenschnitt wurde angepasst', '', ''),
(205, 'Dein Notenschnitt für das Fach {subjectName} wurde gerade durch das HR angepasst. Dein neuer Notenschnitt für dieses Fach ist {newGrade}', '', ''),
(206, '{firstname} {lastname} hat eine ungenügende Note gelöscht', '', ''),
(207, 'Der benutzer {firstname} {lastname} ({bkey}) hat soeben eine ungenügende Note gelöscht<br/><br/>Titel: {gradeTitle}<br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', '', ''),
(208, 'Verhaltensziele - Eintrag gelöscht', '', ''),
(209, 'Der Eintrag zu {title} in den Verhaltenszielen wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(210, 'Verhaltensziele - Eintrag beanstandet', '', ''),
(211, 'Der Eintrag zu {title} in den Verhaltenszielen wurde gerade Beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(212, 'Verhaltensziele - Neuer Eintrag', '', ''),
(213, 'In den Verhaltenszielen wurde soeben ein neuer Eintrag von {firstname} {lastname} erfasst:<br/><br/>Stage: {stageName}<br/>Punktzahl: {stagePoints}<br/>', '', ''),
(214, 'Fachvortrag - Eintrag gelöscht', '', ''),
(215, 'Der Eintrag zum Fachvortrag {title} wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(216, 'Fachvortrag - Eintrag beanstandet', '', ''),
(217, 'Der Eintrag zum Fachvortrag {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(218, 'Fachvortrag - Neuer Eintrag', '', ''),
(219, 'In den Fachvorträgen wurde soeben ein neuer Eintrag von {firstname} {lastname} erfasst:<br/><br/>Fachvortrag-Titel: {title}<br/>Punktzahl: {points}<br/>', '', ''),
(220, 'ALS - Eintrag gelöscht', '', ''),
(221, 'Der Eintrag zur ALS {title} wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(222, 'ALS - Eintrag beanstandet', '', ''),
(223, 'Der Eintrag zur ALS {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(224, 'ALS - Neuer Eintrag', '', ''),
(225, 'Es wurde soeben ein neuer ALS Eintrag von {firstname} {lastname} erfasst:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', '', ''),
(226, 'PE - Eintrag gelöscht', '', ''),
(227, 'Der Eintrag zur PE {title} wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(228, 'PE - Eintrag beanstandet', '', ''),
(229, 'Der Eintrag zur PE {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(230, 'PE - Neuer Eintrag', '', ''),
(231, 'Es wurde soeben ein neuer PE Eintrag von {firstname} {lastname} erfasst:<br/><br/>PE-Titel: {title}<br/>Punktzahl: {points}<br/>', '', ''),
(232, 'ÜK - Eintrag gelöscht', '', ''),
(233, 'Der Eintrag zum ÜK {title} wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(234, 'ÜK - Eintrag beanstandet', '', ''),
(235, 'Der Eintrag zum ÜK {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(236, 'ÜK - Neuer Eintrag', '', ''),
(237, 'Es wurde soeben ein neuer ÜK Eintrag von {firstname} {lastname} erfasst:<br/><br/>ÜK-Titel: {title}<br/>Note: {points}<br/>', '', ''),
(238, 'STAO - Eintrag gelöscht', '', ''),
(239, 'Der Eintrag zur STAO {title} wurde gerade vom HR entfernt.<br/><br/>Begründung:<br/>{reason}', '', ''),
(240, 'STAO - Eintrag beanstandet', '', ''),
(241, 'Der Eintrag zur STAO {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', '', ''),
(242, 'STAO - Neuer Eintrag', '', ''),
(243, 'Es wurde soeben ein neuer STAO Eintrag von {firstname} {lastname} erfasst:<br/><br/>STAO-Titel: {title}<br/>Punktzahl (in Prozent): {points} %<br/>', '', '');

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
(126, 'Test', 5, '2018-02-19 14:05:57', 107, 39),
(129, 'Ok', 5, '2018-02-23 06:18:11', 107, 41),
(130, 'asd', 21, '2018-02-23 06:46:08', 107, 42),
(131, 'HeiNeiHei', 4, '2018-02-23 08:47:21', 107, 40);

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
  `mail` varchar(255) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  `language` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `timetable`, `lastLogin`, `tb_group_ID`, `firstname`, `lastname`, `mail`, `deleted`, `language`) VALUES
(6, 'b000001', NULL, NULL, 1, 'Bill', 'Gates', 'mail@eliareutlinger.ch', NULL, 'de'),
(7, 'b000002', NULL, NULL, 2, 'Mark', 'Zuckerberg', 'mail@eliareutlinger.ch', NULL, NULL),
(8, 'b000003', '2679040', NULL, 3, 'Leonardo', 'Di Caprio', 'mail@eliareutlinger.ch', NULL, 'de'),
(9, 'b000004', NULL, NULL, 4, 'Elon', 'Musk', 'mail@eliareutlinger.ch', NULL, 'de'),
(103, 'b123123', NULL, NULL, 3, '', '', NULL, 1, NULL),
(105, 'b111111', '2679040', NULL, 3, 'Muster', 'Lehrling', NULL, 1, NULL),
(107, 'b000005', NULL, NULL, 5, 'Steve', 'Jobs', 'mail@eliareutlinger.ch', NULL, 'de'),
(108, 'b037160', '2679040', NULL, 3, 'Elia', 'Reutlinger', 'mail@eliareutlinger.ch', 1, 'de'),
(109, 'b928312', NULL, NULL, 3, 'Test', 'User', NULL, 1, NULL),
(110, 'b829131', NULL, NULL, 4, 'Test', 'User', NULL, 1, NULL),
(111, 'b293812', NULL, NULL, 4, '', '', NULL, 1, NULL),
(112, 'b121212', NULL, NULL, 4, 'Giovanni', 'Mozarella', NULL, NULL, NULL),
(113, 'b556677', NULL, NULL, 4, 'Sandra', 'Schneider', NULL, NULL, NULL),
(114, 'b998877', NULL, NULL, 5, 'Axel', 'Schweiss', NULL, NULL, NULL);

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
(1, 'Test', '2018-02-23 06:03:47', 8, 25, 5, 1),
(2, 'Test 2', '2018-02-23 06:03:57', 8, 25, 3, 0),
(3, 'Tescht', '2018-02-23 06:11:09', 9, 35, 4, 1),
(4, 'Testfach', '2018-02-23 08:59:38', 107, 40, NULL, 1),
(5, 'Fach Semester 1', '2018-02-23 13:23:59', 112, 33, NULL, 1),
(6, 'Fach Semester 2', '2018-02-23 13:27:50', 112, 34, NULL, 1),
(7, 'Fach Semester 3', '2018-02-23 13:28:12', 112, 35, NULL, 1),
(8, 'Fach 1 Semester 4', '2018-02-23 13:29:02', 112, 36, NULL, 1),
(9, 'Fach 2 Semester 4', '2018-02-23 13:29:11', 112, 36, NULL, 1);

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
-- Indizes für die Tabelle `tb_appinfo`
--
ALTER TABLE `tb_appinfo`
  ADD PRIMARY KEY (`id`);

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
-- Indizes für die Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tb_user_ID` (`tb_user_ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT für Tabelle `tb_appinfo`
--
ALTER TABLE `tb_appinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
-- AUTO_INCREMENT für Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT für Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT für Tabelle `tb_malus`
--
ALTER TABLE `tb_malus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `tb_stao`
--
ALTER TABLE `tb_stao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT für Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `tb_translation`
--
ALTER TABLE `tb_translation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT für Tabelle `tb_uek`
--
ALTER TABLE `tb_uek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT für Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT für Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- Constraints der Tabelle `tb_ind_design`
--
ALTER TABLE `tb_ind_design`
  ADD CONSTRAINT `tb_ind_design_ibfk_1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`);

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
