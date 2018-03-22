-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Mrz 2018 um 08:06
-- Server-Version: 10.1.30-MariaDB
-- PHP-Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Datenbank: `db_eva`
--

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_appinfo`
--

CREATE TABLE `tb_appinfo` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `title_short` varchar(20) NOT NULL,
  `description` varchar(30) NOT NULL,
  `db_version` int(11) NOT NULL,
  `logo_path` varchar(50) DEFAULT NULL,
  `logo_width` double NOT NULL,
  `hintergrund` varchar(7) NOT NULL,
  `akzentfarbe` varchar(7) NOT NULL,
  `schrift` varchar(7) NOT NULL,
  `link` varchar(7) NOT NULL,
  `mail_support` varchar(255) DEFAULT NULL,
  `mail_hr` varchar(255) NOT NULL,
  `db_vers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_appinfo`
--

INSERT INTO `tb_appinfo` (`id`, `title`, `title_short`, `description`, `db_version`, `logo_path`, `logo_width`, `hintergrund`, `akzentfarbe`, `schrift`, `link`, `mail_support`, `mail_hr`) VALUES
(2, 'Cash Calculator', 'cashcalculator', 'Evaluation-Tool for trainees', 1, 'img/basler_logo.svg', 150, '#ffffff', '#F1F4FB', '#333333', '#1C4E9C', 'mail@eliareutlinger.ch', 'mail@eliareutlinger.ch');

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
-- Tabellenstruktur für Tabelle `tb_dontcountsem`
--

CREATE TABLE `tb_dontcountsem` (
  `ID` int(11) NOT NULL,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
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
(1, 'Terminmanagement', 'Modul zur betreuung von Terminen', 'modul/terminmanagement/terminmanagement.php', '12', 'img/dashico/001-clock.svg'),
(2, 'Noten', 'Modul zur Sammlung von FÃ¤chern und Noten', 'modul/noten/noten.php', '2', 'img/dashico/003-file.svg'),
(3, 'ALS', 'ALS-Modul', 'modul/als/als.php', '3', 'img/dashico/telephone-operator.svg'),
(4, 'Verhaltensziele', 'Modul zur Sammlung der Bewertung der Verhaltensziele', 'modul/verhaltensziele/verhaltensziele.php', '13', 'img/dashico/002-man.svg'),
(5, 'PE', 'Modul zur Sammlung von PE bewertungen.', 'modul/pe/pe.php', '9', 'img/dashico/workflow.svg'),
(6, 'Fachvortrag', 'Modul zur Sammlung der Fachvortrag Bewertungen.', 'modul/fachvortrag/fachvortrag.php', '6', 'img/dashico/001-pie-chart.svg'),
(7, 'ÜK-KN CYP', 'Ãœberbetriebliche Kurse LKB', 'modul/uek/uek.php', '14', 'img/dashico/school.svg'),
(8, 'STAO', 'Modul zur Sammlung von STAO Bewertungen', 'modul/stao/stao.php', '10', 'img/dashico/test.svg'),
(9, 'Malus', 'Modul zur Sammlung von Malus-Werten', 'modul/malus/malus.php', '8', 'img/dashico/001-exclamation.svg'),
(10, 'Leistungslohn', 'Modul zur berechnung des Leistungslohnes und der generierung eines CSV', 'modul/leistungslohn/leistungslohn.php', '7', 'img/dashico/003-coins.svg'),
(11, 'Stundenplan', 'Modul zur speicherung eines GIBM Stundenplans.', 'modul/stundenplan/stundenplan.php', '11', 'img/dashico/002-people.svg'),
(12, 'Reglement', 'Seite mit Reglement der Baloise', 'modul/reglement/reglement.php', '253', 'img/dashico/open-magazine.svg'),
(13, 'Benutzerverwaltung', 'Benutzerverwaltung für Nachwuchsentwicklung', 'modul/benutzerverwaltung/benutzerverwaltung.php', '4', 'img/dashico/002-person.svg'),
(14, 'Übersetzungen', 'Zur bearbeitung der Übersetzungen', 'modul/uebersetzung/uebersetzung.php', '250', 'img/dashico/user.svg'),
(15, 'Dashboard', 'Dashboard mit allen Modulen', 'modul/dashboard/dashboard.php', '5', NULL);

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
(90, 1, 1),
(91, 1, 2),
(92, 1, 3),
(93, 1, 4),
(94, 1, 5),
(95, 1, 6),
(96, 1, 7),
(97, 1, 8),
(98, 1, 9),
(99, 1, 10),
(100, 1, 11),
(101, 1, 12),
(102, 1, 13),
(103, 1, 14),
(104, 2, 15);

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
  `points` double NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tb_user_ID` int(11) NOT NULL,
  `tb_semester_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_text`
--

CREATE TABLE `tb_text` (
  `ID` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tb_group_ID` int(11) NOT NULL,
  `de` text,
  `it` text,
  `fr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_text`
--

INSERT INTO `tb_text` (`ID`, `type`, `tb_group_ID`, `de`, `it`, `fr`) VALUES
(1, 'reglement', 3, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\n	<tbody>\n		<tr>\n			<td>\n			<p style=\"margin-left:40px; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904906\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Allgemeine Erl&auml;uterungen</span></a><a href=\"#_Toc274904906\"><span style=\"color:#000000\"><span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">4</span></span></span></a></span></span></p>\n\n			<ul>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904907\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Zweck<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">4</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904908\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Philosophie<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">4</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904909\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Bewertungskriterien<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">4</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904910\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Malus f&uuml;r nicht toleriertes Verhalten<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">5</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904911\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Massgebendes Resultat <span style=\"display:none\"><span style=\"text-decoration:none\">5</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904912\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Dateneingabe<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">5</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904913\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Bekanntgabe der Resultate<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">6</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904914\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Leistungslohn im 3. und 4. Lehrjahr <span style=\"display:none\"><span style=\"text-decoration:none\">6</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904915\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Lohnb&auml;nder <span style=\"display:none\"><span style=\"text-decoration:none\">6</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904916\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Lohnzahlung<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">7</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904917\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Korrektur der Resultate / Rekurs</span></a></span></span></li>\n			</ul>\n			</td>\n			<td>\n			<p style=\"margin-left:34pt; margin-right:0cm\"><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904918\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Detailerl&auml;uterungen zum Lehrlingsbeurteilungstool <span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></p>\n\n			<ul>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904919\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Eckwerte<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904920\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Ergebnisse nach 4. Sem. <span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904921\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Ergebnisse nach 6. Sem. <span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904922\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Ergebnisse nach 7. Sem. <span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904923\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Informatik-Module<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904924\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Fachvortr&auml;ge<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">8</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904925\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Schulnoten<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">9</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904926\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Verhalten Betrieb<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">9</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904927\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Termine<span style=\"display:none\"><span style=\"text-decoration:none\">. </span></span><span style=\"display:none\"><span style=\"text-decoration:none\">9</span></span></span></a></span></span></li>\n				<li><span style=\"font-size:11pt\"><span style=\"font-family:Arial,sans-serif\"><a href=\"#_Toc274904928\" style=\"color:blue; text-decoration:underline\"><span style=\"color:#000000\">Daten Malus Verhalten</span></a></span></span></li>\n			</ul>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"margin-left:34pt; margin-right:0cm\"><br />\n&nbsp;</p>\n\n<hr />\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\n\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:14pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"font-weight:normal\"><a name=\"_Toc274904906\"></a><a name=\"_Toc234916226\"></a><a name=\"_Toc154234533\"></a><strong><a name=\"_Toc154234232\">Allgemeine Erl&auml;uterungen</a></strong></span></span></span></h2>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904907\"></a><a name=\"_Toc234916227\"></a><a name=\"_Toc154234534\"></a><a name=\"_Toc154234233\">Zweck</a></span></span></strong></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Das Lehrlingsbeurteilungstool dient den Basler Versicherungen und der Baloise Bank SoBa in mehrfacher Hinsicht:</span></span></span></span></p>\n\n<ul>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>Gesamtsicht &uuml;ber die Leistungen aller Lernenden der B&acirc;loise f&uuml;r die Personalverantwortlichen Lernende der Regionen sowie die Leitung Nachwuchsentwicklung Schweiz</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>Gradmesser und transparente &Uuml;bersicht f&uuml;r die Lernenden selbst</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>Grundlage zur Berechnung des variablen Lohns im letzten Lehrjahr</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>Eine zentrale Grundlage f&uuml;r den Entscheid &uuml;ber die Weiterbesch&auml;ftigung</span></span></span></span></span></li>\n</ul>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904908\"></a><a name=\"_Toc234916228\"></a><a name=\"_Toc154234535\"></a><strong><a name=\"_Toc154234234\">Philosophie</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Das Lehrlingsbeurteilungstool orientiert sich an bereits vorhandenen Daten, so dass seitens der Lernenden und der Praxisausbilder kein zus&auml;tzlicher Aufwand entsteht. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904909\"></a><a name=\"_Toc234916229\"></a><a name=\"_Toc154234536\"></a><strong><a name=\"_Toc154234235\">Bewertungskriterien</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Es werden drei Bewertungskategorien unterschieden: Leistung Informatik, Leistung Schule und Verhalten Betrieb. Die Resultate dieser drei Kategorien werden je zu einem Drittel gewichtet. Innerhalb dieser Kategorien gibt es weitere Unterteilungen gem&auml;ss dem nachfolgenden Bewertungsschema.</span></span><span style=\"font-size:10.0pt\"><span> Das massgebende Resultat ist allerdings erst dasjenige, das sich nach Abzug eines allf&auml;lligen Malus ergibt. </span></span></span></span></p>\n\n<table border=\"1\" cellspacing=\"0\" class=\"Table\" style=\"border-collapse:collapse; border:solid windowtext 1.0pt\">\n	<tbody>\n		<tr>\n			<td style=\"background-color:#99ccff; width:108.3pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Kategorie</span></span></strong></span></span></p>\n			</td>\n			<td colspan=\"2\" style=\"background-color:#99ccff; width:94.7pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>in %</span></span></strong></span></span></p>\n			</td>\n			<td style=\"background-color:#99ccff; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Bewertungskriterium</span></span></strong></span></span></p>\n			</td>\n			<td style=\"background-color:#99ccff; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Anzahl Bewertungen pro Jahr</span></span></strong></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td rowspan=\"2\" style=\"background-color:#ffff99; height:28.8pt; width:108.3pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Leistung Informatik</span></span></span></span></p>\n			</td>\n			<td rowspan=\"2\" style=\"background-color:#ffff99; height:28.8pt; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>33%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffff99; height:28.8pt; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>22%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffff99; height:28.8pt; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Notendurchschnitt der Informatik-Module in &uuml;berbetrieblichen Kursen (&uuml;K) und in der Schule</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffff99; height:28.8pt; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>2 </span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background-color:#ffff99; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>11%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffff99; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Fachvortr&auml;ge im Betrieb</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffff99; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>1*</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background-color:#ffcc99; width:108.3pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Leistung Schule</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffcc99; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>33%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffcc99; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>33%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffcc99; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Notendurchschnitt</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ffcc99; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>2</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td rowspan=\"2\" style=\"background-color:#ff99cc; height:26.0pt; width:108.3pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Verhalten Betrieb</span></span></span></span></p>\n			</td>\n			<td rowspan=\"2\" style=\"background-color:#ff99cc; height:26.0pt; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>33%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ff99cc; height:26.0pt; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>22%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ff99cc; height:26.0pt; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Verhaltensziele </span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ff99cc; height:26.0pt; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>2 </span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background-color:#ff99cc; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>11%</span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ff99cc; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Terminmanagement </span></span></span></span></p>\n			</td>\n			<td style=\"background-color:#ff99cc; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>2</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"background-color:#ccffcc; width:108.3pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Resultat (vor Malus)</span></span></strong></span></span></p>\n			</td>\n			<td style=\"background-color:#ccffcc; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>100%</span></span></strong></span></span></p>\n			</td>\n			<td style=\"background-color:#ccffcc; width:47.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>100%</span></span></strong></span></span></p>\n			</td>\n			<td style=\"background-color:#ccffcc; width:222.95pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\n			</td>\n			<td style=\"background-color:#ccffcc; width:70.35pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\">&nbsp;</p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>*im 4. Lehrjahr findet kein Fachvortrag statt</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Die Einzelheiten der Bewertung sind im Teil &quot;Detailerl&auml;uterungen zum Lehrlingsbeurteilungstool&quot; geregelt.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc154234537\"></a><a name=\"_Toc154234236\"></a><strong><a name=\"_Toc274904910\"></a><a name=\"_Toc234916230\">Malus f&uuml;r nicht toleriertes Verhalten</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Es gibt Verhaltensweisen, welche die Basler Versicherungen und die Baloise Bank SoBa nicht tolerieren. Kommt es dennoch zu einem solchen Verhalten seitens eines Lernenden, wird dieses mit einem Malus geahndet. Dabei handelt es sich um einen prozentualen Abzug, der in demjenigen Semester wirksam wird, in dem das Verhalten aufgetreten ist. Kommt es in einem Semester zu mehreren unerw&uuml;nschten Verhaltensweisen, werden diese zusammengez&auml;hlt.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Malus gibt es aufgrund folgender Vorkommnisse:</span></span></span></span></p>\n\n<ul>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>Aktennotiz im Betrieb =&gt; 10%</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>schriftliche Verwarnung im Betrieb =&gt; 20%</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>schriftliche Verwarnung in der Schule =&gt; 20%</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span><span style=\"font-size:10.0pt\"><span>unentschuldigte Absenzen in der Schule =&gt; 20%</span></span></span></span></span></li>\n</ul>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904911\"></a><strong><a name=\"_Toc234916231\">Massgebendes Resultat</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Zieht man vom Resultat vor Malus (Summe von Leistung Betrieb, Leistung Schule und Verhalten) den allf&auml;lligen Malus ab, erh&auml;lt man das massgebende Resultat. Dieses ist das Endergebnis, das z&auml;hlt. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Folgendes Beispiel veranschaulicht das System: </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Bei den Bewertungskategorien Leistung Informatik, Leistung Schule und Verhalten handelt es sich um den jeweiligen Durchschnittswert der absolvierten Semester (z.B. 1.-4. Semester). Auch beim Malus wird der Durchschnitt der absolvierten Semester gewertet (bei drei Semestern z.B. 1/4 eines 20%-igen Malus wegen unentschuldigter Absenzen in der Schule im 2.&nbsp;Semester).</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904912\"></a><a name=\"_Toc234916232\"></a><strong><a name=\"_Toc158548093\">Dateneingabe</a> </strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>S&auml;mtliche Werte werden nicht gerundet und in Prozenten angegeben bzw. in Prozentwerte umgerechnet. Die Dateneingabe seitens der Personalverantwortlichen Lernende erfolgt bis zu folgenden Terminen:</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>1. und 3. Lehrjahr: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; bis 20. August Dateneingabe abgeschlossen. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>4. Lehrjahr: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; bis 20. Februar Dateneingabe abgeschlossen.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904913\"></a><a name=\"_Toc234916233\"></a><a name=\"_Toc154234539\"></a><strong><a name=\"_Toc154234238\">Bekanntgabe der Resultate</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Das Lehrlingsbeurteilungstool wird den Lernenden zur Verf&uuml;gung gestellt (leere Excel-Datei ohne Daten), so dass sie ihre Resultate jederzeit selbst eingeben k&ouml;nnen und deren Auswertung automatisch erhalten. So wissen sie jederzeit, wo sie stehen.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Den Lernenden wird innert 14 Tagen ihr Resultat per Brief nach Hause geschickt. Sie erhalten zudem eine anonymisierte &Uuml;bersicht der massgebenden Resultate aller B&acirc;loise-Lernenden (d.h. nicht nur Informatik-Lernende), die ihnen zeigt, wo sie stehen. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Die Information der Praxisausbilder am Arbeitsplatz liegt im Ermessen der Lernenden. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904914\"></a><a name=\"_Toc234916234\"></a><a name=\"_Toc154234540\"></a><strong><a name=\"_Toc154234239\">Leistungslohn im 3. und 4. Lehrjahr</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Im 3. und 4. Lehrjahr ist das massgebende Resultat des Lehrlingsbeurteilungstools (Wert nach Abzug eines allf&auml;lligen Malus) die Basis f&uuml;r die Berechnung des variablen Lohns. F&uuml;r das 3. Lehrjahr sowie f&uuml;r jedes der beiden Semester im 4. Lehrjahr wird der Lohn neu berechnet. Der 13. Monatslohn basiert auf der ausbezahlten Lohnsumme.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Lohn im 3. Lehrjahr</span></span></strong></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Diese Periode umfasst das ganze 3. Lehrjahr. Die Berechnung des Lohns basiert auf dem Durchschnitt der ersten zwei Lehrjahre. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Lohn im 7. Semester </span></span></strong></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Diese Periode umfasst die Monate August bis Januar. F&uuml;r die Berechnung des Lohns z&auml;hlen die ersten zwei Lehrjahre zu einem Drittel, das dritte Lehrjahr z&auml;hlt zu zwei Dritteln.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Lohn im 8. Semester </span></span></strong></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Diese Periode umfasst die Monate Februar bis Juli. F&uuml;r die Berechnung des Lohns z&auml;hlt das dritte Lehrjahr zu einem Drittel, das siebte&nbsp;Semester z&auml;hlt zu zwei Dritteln. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Falls in einem Bereich aus dem siebten Semester keine Daten vorhanden sind, z&auml;hlen die Werte des dritten Lehrjahres zu 100%.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904915\"></a><a name=\"_Toc234916235\"></a><a name=\"_Toc154234541\"></a><a name=\"_Toc154234240\">Lohnb&auml;nder</a> </span></span></strong></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>F&uuml;r die Berechnung des Lohns ist der Prozentwert massgebend, die Note dient einzig der Erl&auml;uterung. Die Prozentwerte werden nicht gerundet. Es gelten folgende Lohnb&auml;nder: </span></span></span></span></p>\n\n<table border=\"1\" cellspacing=\"0\" class=\"Table\" style=\"border-collapse:collapse; border:solid windowtext 1.0pt\">\n	<tbody>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>massgebendes Resultat</span></span></strong></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Note</span></span></strong></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Bruttolohn im<br />\n			3.&nbsp;Lehrjahr</span></span></strong></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><strong><span style=\"font-size:10.0pt\"><span>Bruttolohn im<br />\n			4.&nbsp;Lehrjahr</span></span></strong></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 85%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 5.25 </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1500.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1800.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>82&lt;84.99%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 5.10 </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1450.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1650.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>79&lt;81.99%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 4.95 </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1400.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1600.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>76&lt;78.99%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 4.80 </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1350.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1550.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>73&lt;75.99%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 4.65 </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1300.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1500.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>70&lt;72.99%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>ab 4.50</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1250.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1450.-</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:107.45pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>&lt;70%</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>bis 4.50</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1200.-</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:107.5pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:center\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>CHF 1300.-</span></span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904916\"></a><strong><a name=\"_Toc234916236\">Lohnzahlung</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Die Daten, welche Auswirkungen auf den Lohn haben, werden von der Leitung Nachwuchsentwicklung Schweiz rechtzeitig auf den Lohnlauf an die zust&auml;ndige Stelle weitergeleitet.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Der Lohn des 3.&nbsp;Lehrjahres und des 7. Semesters wird erstmals im September (aber r&uuml;ckwirkend auf 1.&nbsp;August) ausbezahlt, d.h. wer z.B. im 3.&nbsp;Lehrjahr neu CHF 1400.- verdient, erh&auml;lt im August CHF 1200.-, im September einmalig CHF 1600.- und anschliessend jeweils CHF 1400.-. Der Lohn des 8. Semesters wird im M&auml;rz (r&uuml;ckwirkend auf den 1.&nbsp;Februar) ausbezahlt, d.h. im Februar erh&auml;lt der Lernende noch den Lohn des 7.&nbsp;Semesters.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904917\"></a><a name=\"_Toc234916237\"></a><a name=\"_Toc154234542\"></a><strong><a name=\"_Toc154234241\">Korrektur der Resultate / Rekurs</a></strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Wenn auf dem Schulzeugnis unentschuldigte Absenzen ausgewiesen sind, die nicht gerechtfertigt sind oder die der Lernende nicht mehr korrigieren konnte (z.B. Absenz am letzten Schultag), ist es Aufgabe des Lernenden, ein korrigiertes Zeugnis zu besorgen. Damit die Korrektur f&uuml;r die Lohnzahlung ber&uuml;cksichtigt werden kann, muss die Korrektur bis zu folgenden Daten dem Personalverantwortlichen Lernende vorliegen:</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>25. August f&uuml;r das 3.&nbsp;Lehrjahr und das 7. Semester</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>25. Februar f&uuml;r das 8.&nbsp;Semester</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Stellt der Lernende beim offiziell bekannt gegebenen Resultat einen Eingabe-/Berechnungsfehler fest oder hat etwas anderes zu beanstanden, ist dies innert 14 Tagen dem regionalen Personalverantwortlichen Lernende zu melden. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Lehnt es der regionale Personalverantwortliche Lernende ab, die Daten zu &auml;ndern, die vom Lernenden beanstandet wurden, kann der Lernende bis vier Wochen nach Bekanntgabe der Resultate Rekurs einlegen. Ein Rekurs ist schriftlich an den Leiter Nachwuchsentwicklung Schweiz zu richten und muss die Forderungen sowie deren Begr&uuml;ndung enthalten. Auf sp&auml;ter eingehende Rekurse muss nicht mehr eingegangen werden.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h2 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:14pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"font-weight:normal\"><a name=\"_Toc274904918\"></a><a name=\"_Toc234916238\"></a><strong><a name=\"_Toc154234543\"></a><a name=\"_Toc154234242\">Detailerl&auml;uterungen zum Lehrlingsbeurteilungstool</a></strong></span></span></span></h2>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Die nachfolgenden Abschnitte dienen als Erkl&auml;rung der einzelnen Datentabellen im Lehrlingsbeurteilungstool. Sie entsprechen den Tabellen der Excel-Datei und regeln die Bewertung im Einzelnen.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904919\"></a><a name=\"_Toc234916239\"></a><a name=\"_Toc154234544\"></a><strong><a name=\"_Toc154234243\">Eckwerte</a> </strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Hier sind die grundlegenden Informationen enthalten bez&uuml;glich bewerteter Kategorien und ihrer Gewichtung</span></span></span></span><br />\n&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904920\"></a><a name=\"_Toc234916240\"></a><a name=\"_Toc154234545\"></a><strong><a name=\"_Toc154234244\">Ergebnisse nach 4. Sem.</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Dies ist die &Uuml;bersichtstabelle, wie sich die Resultate bis Ende des 4.&nbsp;Semesters pr&auml;sentieren. Die Resultate am Ende des 4.&nbsp;Semesters bilden die Basis f&uuml;r den Lohn im 3.&nbsp;Lehrjahr. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Bei der Eingabe neuer Daten in eine der &quot;Datentabellen&quot;, werden die Werte in dieser &Uuml;bersichtstabelle automatisch aktualisiert. In der obersten Zeile sind ganz rechts die Lohnzahlen als Kommentar hinterlegt (rotes Eckchen). </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Sind in einem Bereich die Daten nicht aus allen Semestern vorhanden, z&auml;hlt das Resultat der vorhandenen Semester voll.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904921\"></a><strong><a name=\"_Toc234916241\"></a><a name=\"_Toc154234546\"></a><a name=\"_Toc154234245\">Ergebnisse nach 6. Sem.</a>&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Dies ist die &Uuml;bersichtstabelle, wie sich die Resultate bis Ende des 3.&nbsp;Lehrjahres pr&auml;sentieren. F&uuml;r den Lohn im 7.&nbsp;Semester z&auml;hlen die Resultate bis zum vierten Semester zu einem Drittel, diejenigen des 3.&nbsp;Lehrjahres zu zwei Dritteln. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Bei der Eingabe neuer Daten in eine der &quot;Datentabellen&quot;, werden die Werte in dieser &Uuml;bersichtstabelle automatisch aktualisiert. In der obersten Zeile sind ganz rechts die Lohnzahlen als Kommentar hinterlegt (rotes Eckchen). </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Sind in einem Bereich keine Daten aus dem 3. Lehrjahr vorhanden, z&auml;hlt das Resultat des 1.-4.&nbsp;Semesters voll.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904922\"></a><strong><a name=\"_Toc234916242\">Ergebnisse nach 7. Sem.</a>&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Dies ist die &Uuml;bersichtstabelle, wie sich die Resultate bis Ende des 7.&nbsp;Semesters pr&auml;sentieren. F&uuml;r den Lohn im 8.&nbsp;Semester z&auml;hlen die Resultate des 3.&nbsp;Lehrjahres zu einem Drittel, diejenigen des 7.&nbsp;Semesters zu zwei Dritteln. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span><span style=\"font-size:10.0pt\"><span>Bei der Eingabe neuer Daten in eine der &quot;Datentabellen&quot;, werden die Werte in dieser &Uuml;bersichtstabelle automatisch aktualisiert. In der obersten Zeile sind ganz rechts die Lohnzahlen als Kommentar hinterlegt (rotes Eckchen). </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904923\"></a><a name=\"_Toc234916243\"></a><a name=\"_Toc154234547\"></a><strong><a name=\"_Toc154234246\">Daten </a>Informatik-Module</strong> </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Es z&auml;hlt jeweils der Notendurchschnitt aller Informatik-Module, die der Lernende in den &uuml;berbetrieblichen Kursen und in der Schule im entsprechenden Semester absolviert hat.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Umrechnung der Noten in Prozentwerte erfolgt nach der Formel (&quot;erreichte Note&quot;-1)*100/5, d.h. die Note&nbsp;6 entspricht&nbsp;100%, die Note&nbsp;1 entspricht&nbsp;0%.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904924\"></a><a name=\"_Toc234916244\"></a><a name=\"_Toc154234548\"></a><strong><a name=\"_Toc154234247\">Daten </a>Fachvortr&auml;ge&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Bewertungen der Fachvortr&auml;ge werden vom Personalverantwortlichen Lernende aufgrund des unterschriebenen Formulars eingegeben.&nbsp;</span></span></span></span><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Resultate werden in Punkten &uuml;bernommen und in Prozente umgerechnet.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc154234550\"></a><a name=\"_Toc154234249\"></a><strong><a name=\"_Toc274904925\"></a><a name=\"_Toc234916245\">Daten Schulnoten</a></strong> </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Es z&auml;hlen die Notendurchschnitte der Semesterzeugnisse, d.h. die Summe der im Zeugnis ausgewiesenen Noten (inkl. AE/SA, aber ohne Informatik-Module) geteilt durch die Anzahl Noten.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Nicht zum Durchschnitt gez&auml;hlt werden: Sport, Freif&auml;cher, LAP-Noten, Sprachdiplome. Der gew&auml;hlte Lehrtyp (mit oder ohne Berufsmatur) hat keinen Einfluss.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Umrechnung der Noten in Prozentwerte erfolgt nach der Formel (&quot;erreichte Note&quot;-1)*100/5, d.h. sie Note&nbsp;6 entspricht&nbsp;100%, die Note&nbsp;1 entspricht&nbsp;0%.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><strong><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><a name=\"_Toc274904926\"></a><a name=\"_Toc234916246\"></a><a name=\"_Toc154234551\"></a><a name=\"_Toc154234250\">Daten Verhalten</a> Betrieb&nbsp; </span></span></strong></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Daten zum Verhalten im Betrieb entsprechen der Bewertung der pro Semester vereinbarten acht Verhaltensziele. Der Katalog der Verhaltensziele sowie deren Bewertung ist identisch mit dem System, das in der kaufm&auml;nnischen Grundbildung angewendet wird.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Die Resultate werden in Punkten &uuml;bernommen und in Prozente umgerechnet.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<h3 style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:Arial,sans-serif\"><strong><a name=\"_Toc274904927\"></a><a name=\"_Toc234916247\"></a><a name=\"_Toc154234552\"></a><a name=\"_Toc154234251\">Daten Termine</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp; </span></span></h3>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">F&uuml;r s&auml;mtliche Termineinhaltungsbeurteilungen gilt: Meldet der Lernende dem Personalverantwortlichen Lernende sobald als m&ouml;glich und mit Angabe des Grundes, dass ein Termin nicht eingehalten werden kann, so wird dies als Einhaltung des Termins gewertet.</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Erl&auml;uterungen zur Bewertung sind als Kommentar in der obersten Zeile der Tabelle hinterlegt. </span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Termineinhaltung Verhaltensziele (Feedbackgespr&auml;ch)</span></span></strong></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Sind folgende Termine eingehalten, z&auml;hlt jeder Termin anteilm&auml;ssig, d.h. bei zwei Terminen je 50%, bei drei Terminen je 33.33%. (Es m&uuml;ssen ja zwei oder mehr Termine eingehalten werden, je nach dem, ob ein Stage stattfindet oder nicht). Bei Nichteinhaltung wird der einzelne Punkt mit 0% gewertet:</span></span></span></span></p>\n\n<ul>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Vereinbarung unaufgefordert und sp&auml;testens eine Woche nach Einsatzbeginn (Stage oder eigener Fachbereich) beim Personalverantwortlichen Lernende eingetroffen </span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Bewertung vollst&auml;ndig und korrekt unterschrieben bis zu folgenden Terminen beim Personalverantwortlichen Lernende eingetroffen: 1./3./5./7.&nbsp;Semester am 10. Februar, 2./4./6.&nbsp;Semester am 31.&nbsp;Juli.</span></span></span></span></span></li>\n</ul>\n\n<p style=\"text-align:justify\">&nbsp;</p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Termineinhaltung Fachvortrag</span></span></strong></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Sind folgende Termine eingehalten, z&auml;hlt jeder Punkt 33.33%. Bei Nichteinhaltung wird der einzelne Punkt mit 0% gewertet:</span></span></span></span></p>\n\n<ul>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Vereinbarung unaufgefordert und sp&auml;testens bis 28. Februar beim Personalverantwortlichen Lernende eingetroffen</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Fachvortrag bis zum vor Beginn der Sommerferien Basel-Stadt absolviert</span></span></span></span></span></li>\n	<li style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:list 21.3pt 36.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Bewertung vollst&auml;ndig und korrekt unterschrieben vor Beginn der Sommerferien Basel-Stadt beim Personalverantwortlichen Lernende eingetroffen.</span></span></span></span></span></li>\n</ul>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:1.0cm 6.0cm\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Termineinhaltung diverse Formulare</span></span></strong></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"tab-stops:1.0cm 6.0cm\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Ber&uuml;cksichtigt wird ausserdem die termingerechte Erf&uuml;llung folgender Auftr&auml;ge:</span></span></span></span></span></p>\n\n<table border=\"1\" cellspacing=\"0\" class=\"Table\" style=\"border-collapse:collapse; border:solid windowtext 1.0pt; margin-left:3.5pt\">\n	<tbody>\n		<tr>\n			<td style=\"vertical-align:top; width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">was</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Termin</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Semesterbericht bei Personalverantwortlichem Lernende (PVL) eingetroffen (elektronisch als pdf)</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">10. Februar / 31. Juli</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Zeiterfassung elektronisch als pdf bei PVL eingetroffen (1x zu sp&auml;t gilt noch als erf&uuml;llt)</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Bis zum 10. des neuen Monats </span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Excel-Tabelle mit Schulnoten elektronisch als pdf bei PVL eingetroffen (1x zu sp&auml;t gilt noch als erf&uuml;llt)</span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Bis zum 10. des neuen Monats (ausser f&uuml;r Juni, Juli und August)</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"vertical-align:top; width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Absolvierung der E-Tests </span></span></span></span></p>\n			</td>\n			<td style=\"vertical-align:top; width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">gem&auml;ss jeweiliger Vorgabe </span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Mutationsformular</span></span></span></span></p>\n			</td>\n			<td style=\"width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">2 Wochen vor Stage</span></span></span></span></p>\n			</td>\n		</tr>\n		<tr>\n			<td style=\"width:315.0pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">Information &uuml;ber Semesterablauf</span></span></span></span></p>\n			</td>\n			<td style=\"width:180.8pt\">\n			<p style=\"margin-left:0cm; margin-right:0cm\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">31. August / 28. Februar</span></span></span></span></p>\n			</td>\n		</tr>\n	</tbody>\n</table>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\">&nbsp;</p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">erf&uuml;llt (100%)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Auftr&auml;ge fristgerecht und unaufgefordert erf&uuml;llt</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"font-size:10.0pt\"><span style=\"font-family:&quot;Arial&quot;,sans-serif\">teilweise erf&uuml;llt (50%)&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ein Auftrag nicht erf&uuml;llt oder ein Dokument fehlt</span></span></span></span></p>\n\n<p style=\"margin-left:0cm; margin-right:0cm; text-align:justify\"><span ', 'OK', 'OHJE');
INSERT INTO `tb_text` (`ID`, `type`, `tb_group_ID`, `de`, `it`, `fr`) VALUES
(2, 'reglement', 4, 'null', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tb_translation`
--

CREATE TABLE `tb_translation` (
  `ID` int(11) NOT NULL,
  `de` text,
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
(10, 'Stao', 'Punto della situazione', 'Point de situation'),
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
(34, 'Beim Abschicken werden die verantwortlichen Personen per E-Mail benachrichtigt, um den Eintrag zu überprüfen.', 'Con l\'invio, i responsabili saranno informati per e-mail per la verifica dell\'iscrizione', 'Lors de l\'envoi, les personnes responsables seront informées par e-mail afin de vérifier l\'inscription'),
(35, 'Diese Punktzahlen sind leistungslohnrelevant. Bitte achte auf die Korrektheit deiner Einträge, es können Stichproben durchgeführt werden.', 'Il punteggio influenza il salario alla performance. Verifichi l\'esattezza delle iscrizioni dei sondaggi possono essere realizzati', 'Le nombre de points influence le salaire à la performance. Vérifiez l\'exactitude de vos inscriptions des sondages peuvent être réalisés'),
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
(66, 'Stao-Titel', 'Titolo punto di situazione', 'Titre point de situation'),
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
(92, 'Es können Stichproben durchgeführt werden.', 'Degli sondaggi possono essere effettuati', 'Des sondages peuvent être effectués'),
(93, 'Sind alle Angaben korrekt? Du kannst den Eintrag nach dem Bestätigen nicht mehr bearbeiten.', 'Tutti i dati sono corretti? Dopo la conferma, non sarà più possibile modificare', 'Toutes les données sont correctes ? Après confirmation, il ne sera plus possible effectuer de modifications.'),
(94, 'Dein Account wurde keiner Gruppe zugewiesen oder dir fehlen Rechte.', 'Il conto non può essere attribuito ad un gruppo, o mancano le autorizzazioni d\'accesso', 'Votre compte n\'a pas pu être attribué à un groupe, ou les autorisations d\'accès manquent'),
(95, 'Fehler', 'Errore', 'Erreur'),
(96, 'Eintrag löschen', 'Cancellare iscrizione', 'Effacer inscription'),
(97, 'Benutzer löschen', 'Cancellare utente', 'Effacer utilisateur'),
(98, 'Bitte bestätige deine Auswahl.', 'Pregasi confermare scelta', 'Veuillez confirmer votre choix'),
(99, 'Bestätigen', 'Confermare', 'Confirmer'),
(100, 'Keine Daten gefunden.', 'Nessun dato disponibile', 'Aucune donnée disponible  '),
(101, 'Änderungen wurden gespeichert', 'Le modifiche sono state registrate', 'Les modifications ont été sauvegardées'),
(102, 'Benutzer wurde hinzugefügt', 'Un utente è stato aggiunto', 'Un utilisateur a été ajouté'),
(103, 'Eintrag wurde hinzugefügt', 'Un\'iscrizione è stata aggiunta', 'Une inscription a été ajoutée'),
(104, 'Keine Lernende im System', 'Nessun apprendista nel sistema', 'Aucun apprenti dans le système'),
(105, 'Noch keine Einträge', 'Nessuna iscrizione', 'Pas encore d\'inscription'),
(106, 'CSV-Export', 'CSV-Export', 'CSV-Export'),
(107, 'Keine Noten gefunden', 'Nessun voto trovato', 'Aucune note trouvée'),
(108, 'Keine Fächer gefunden', 'Nessun ramo trovato', 'Aucune branche trouvée'),
(109, 'in %', 'in %', 'en %'),
(110, 'Begründung für Note kleiner/gleich 4', 'Giustificazione per un voto sotto 4.0', 'Justification pour note en-dessous de 4.0'),
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
(124, 'üK', 'Corsi interaziendali', 'Cours interentreprises'),
(125, 'ÜK-Titel', 'Titolo dei corsi interaziendali', 'Titre des cours interentreprises'),
(126, 'Leistung Informatik', 'Prestazioni informatiche', 'Prestations informatique'),
(127, 'Notenschnitt Informatik-Module und üK', 'Media dei voti dei moduli informatici e corsi interaziendali', 'Moyenne des notes Module Informatique et CIE'),
(128, 'Fachvorträge', 'Rami presentati', 'Branches exposées'),
(129, 'Leistung Schule', 'Prestazione scuola', 'Prestations école'),
(130, 'Notenschnitt Schulfächer', 'Media dei voti rami scolastici', 'Moyenne des notes branches scolaires'),
(131, 'Verhalten Betrieb', 'Comportamento in azienda', 'Comportement en entreprise'),
(132, 'Leistungslohn anhand aktueller Werte', 'Salario alla performance secondo i valori attuali', 'Salaire à la performance selon les valeurs actuelles'),
(133, 'Daten Semester', 'Voti del semestre', 'Notes du semestre'),
(135, 'Leistung Betrieb', 'Performance in azienda', 'Performance en entreprise'),
(136, 'Keine Benutzer-ID vorhanden', 'Nessun utente-ID disponibile', 'Aucun utilisateur-ID disponible'),
(137, 'Du hast keinen Zugriff auf diese Funktionen.', 'Nessun accesso alle funzioni', 'Aucun accès à ces fonctions'),
(138, 'Sprache wurde angepasst', 'La lingua è stata adattata', 'La langue a été adaptée'),
(139, 'Sprache anpassen', 'Adattare lingua', 'Adapter langue'),
(140, 'Deutsch', 'Tedesco', 'Allemand'),
(141, 'Italienisch', 'Italiano', 'Italien'),
(142, 'Französisch', 'Francese', 'Français'),
(143, 'Ändern', 'Modificare', 'Modifier  '),
(144, 'Neuer Termin', 'Nuovo colloquio', 'Nouveau rendez-vous'),
(145, 'Du hast keine Berechtigungen zu diesem Modul.', 'Nessuna autorizzazione per questo modulo', 'Aucune autorisation pour ce module'),
(146, 'Bitte eine Begründung angeben.', 'Pregasi aggiungere giustificazione', 'Veuillez ajouter une justification'),
(147, 'Beanstandung abgeschickt', 'Reclamazione inviata', 'Réclamation envoyée'),
(148, 'Löschen bestätigen', 'Confermare la cancellazione', 'Confirmer la suppression'),
(149, 'Beanstandung abgeschickt & Eintrag gelöscht', 'Reclamazione inviata & Iscrizione cancellata', 'Réclamation envoyée & Inscription supprimée'),
(150, 'Bitte ein Semester angeben.', 'Pregasi indicare il semestre', 'Prière d\'indiquer un semestre'),
(151, 'Bitte einen ALS-Titel angeben.', 'Pregasi indicare il titolo della SAL', 'Prière d\'indiquer un Titre-STA'),
(152, 'Bitte eine Punktzahl angeben.', 'Pregasi indicare il punteggio', 'Prière d\'indiquer le nombre de points'),
(153, 'Der B-Key muss aus 7 Zeichen bestehen.', 'Il B-Key deve comprendere 7 caratteri', 'Le B-Key doit comprendre 7 caractères'),
(154, 'Bitte Gruppe auswählen.', 'Pregasi scegliere un gruppo', 'Veuillez choisir un groupe'),
(155, 'Seite enthält keinen gültigen Pfad', 'La pagina non contiene nessun accesso valido', 'La page ne contient aucun chemin d\'accès valide'),
(156, 'Seite wurde noch nicht verlinkt', 'Un legame verso la pagina non\'è stato ancora creato', 'Un lien vers la page n\'a pas encore été créé'),
(157, 'Fehler: Keine/leere Antwort erhalten', 'Errore : nessuna risposta/risposta vuota', 'Erreur: Aucune réponse/réponse vide'),
(158, 'Fehler: Semester konnten nicht gefunden werden', 'Errore : il semestre non è stato trovato', 'Erreur:le semestre n\'a pas pu être trouvé'),
(159, 'Bitte einen Malus-Titel angeben.', 'Pregasi indicare un titolo di Malus', 'Prière d\'indiquer un titre de Malus'),
(160, 'Bitte eine Gewichtung angeben.', 'Pregasi indicare un valore di ponderazione', 'Prière d\'indiquer une valeur de pondération'),
(161, 'Kein Eintrag angegeben', 'Nessuna iscrizione', 'Aucune inscription'),
(162, 'Bist du dir sicher? Dabei werden alle Noten gelöscht.', 'Sicuro? Tutti i dati verranno cancellati', 'Sûr ? Toutes les notes seront effacées'),
(163, 'Kein Fach angegeben', 'Nessun ramo indicato', 'Aucune branche indiquée'),
(164, 'Klasse speichern', 'Registrare classe', 'Sauvegarder classe'),
(165, 'Klasse gespeichert', 'Classe registrata', 'Classe sauvegardée'),
(166, 'Keine Klasse ausgewählt', 'Nessuna classe selezionata', 'Aucune classe sélectionnée'),
(167, 'Keine Daten aus dieser Kalenderwoche: Ferien', 'Nessun dato del calendario settimanale : vacanze', 'Aucune donnée dans cette semaine de calendrier : vacances'),
(168, 'Bitte einen üK-Titel angeben.', 'Pregasi indicare un titolo al corso interaziendale', 'Prière d\'indiquer un titre CIE'),
(169, 'Bitte einen Verhaltensziele-Titel angeben.', 'Pregasi indicare un titolo d\'obiettivo di comportamento', 'Prière d\'indiquer un titre d\'objectif de comportement'),
(170, 'Bitte einen PA angeben.', 'Pregasi indicare un maestro di pratica', 'Prière d\'indiquer un formateur pratique'),
(171, 'Bitte eine Note angeben.', 'Pregasi indicare un voto scolastico', 'Prière d\'indiquer une note'),
(172, 'Bitte einen Titel angeben.', 'Pregasi indicare un titolo', 'Prière d\'indiquer un titre'),
(173, 'Bitte Gewichtung angeben.', 'Pregasi indicare un valore di ponderazione', 'Prière d\'indiquer une valeur de pondération'),
(174, 'Bitte Begründung für Note kleiner/gleich 4 angeben.', 'Pregasi indicare una giustificazione per i voti sotto 4.0', 'Prière d\'indiquer une justification pour les notes en-dessous de 4.0'),
(175, 'Fach wurde hinzugefügt', 'Un ramo è stato iscritto', 'Une branche a été inscrite'),
(176, 'Bitte einen Fachvortrag-Titel angeben.', 'Pregasi indicare un titolo alla presentazione del ramo', 'Prière d\'indiquer un titre d\'exposé de branche'),
(177, 'Bitte einen PE-Titel angeben.', 'Pregasi indicare un titolo alla UP', 'Prière d\'indiquer un titre à l\'UF'),
(178, 'Bitte einen Stao-Titel angeben.', 'Pregasi indicare un titolo al punto di situazione', 'Prière d\'indiquer un titre au point de situation'),
(179, 'Bitte Deadline angeben.', 'Pregasi indicare data termine', 'Prière d\'indiquer la date limite'),
(180, 'Design anpassen', 'Personnaliser le design', 'Personalizzare il design'),
(181, 'Hintergrund', 'Arrière-plan', 'Sfondo'),
(182, 'Schrift', 'Police de caractère', 'Tipografia'),
(183, 'Links', 'Lien', 'Legame'),
(184, 'Beste Grüsse', 'Meilleures salutations', 'Cordiali saluti'),
(185, 'Hallo Anwender', 'Salut utilisateur', 'Ciao utilizzatore'),
(186, 'Hallo', 'Salut', 'Ciao'),
(187, 'Du hast bisher nichts eingetragen.', 'Vous n\'avez encore rien saisi', 'Non ha ancora inserito niente'),
(188, 'Ps.: Du kannst direkt auf diese E-Mail antworten um mit dem betroffenen Mitarbeitenden/Absender in Kontakt zu treten.', 'PS : Vous pouvez répondre directement à cet e-mail pour entrer en contact avec le collaborateur/expéditeur concerné', 'PS : Può rispondere direttamente a questa mail per entrare in contatto con il collaboratore/mittente interessato'),
(189, 'Zurücksetzen', 'Remise à zéro', 'Reset/azzerare'),
(190, 'Lernende Informatik', 'Apprendista informatica', 'Apprenti Informatique'),
(191, 'Lernende KV Versicherung/D&A', 'Apprendista impiegato di commercio - assicurazioni private', 'Apprenti employé de commerce - assurances privées'),
(192, 'Lernende KV Bank', 'Apprendista impiegato di commercio - banca', 'Apprenti employé de commerce - banque'),
(193, 'Praxisausbildner/in', 'Maestro di pratica', 'Formateur pratique'),
(194, 'Nachwuchsentwicklung', 'Sviluppo giovani leve', 'Développement de la relève'),
(195, 'Bitte Fach-Typ angeben', 'Pregasi d\'indicare il tipo di compartimento', 'Prière d\'indiquer le type de compartiment'),
(196, 'Bitte Fach angeben', 'Pregasi d\'indicare il soggetto', 'Prière d\'indiquer le sujet'),
(197, 'Bitte Semester angeben', 'Pregasi d\'indicare il semestre', 'Prière d\'indiquer le semestre'),
(198, 'Neuer Malus hinzugefügt', 'Nuovo Malus aggiunto', 'Nouveau malus ajouté'),
(199, 'Du hast einen Malus erhalten! Dieser wird in der Lohnberechnung berücksichtigt und ist für dich unter Leistungslohn ersichtlich.<br/><br/>Malus-Gewichtung: <b>{weigth}</b> %<br/>Begründung:<br/>{reason}<br/>', 'Ha ricevuto un malus! Questo viene preso in considerazione nel calcolo del salario ed è visibile per lei  sotto Stipendi Incentive.<br/><br/>Malus-Gewichtung: <b>{weigth}</b> %<br/>Begründung:<br/>{reason}<br/>', 'Vous avez reçu un malus ! Ceci est pris en compte dans le calcul du salaire et est visible pour vous sous Salaire au rendement.<br/><br/>Malus-Gewichtung: <b>{weigth}</b> %<br/>Begründung:<br/>{reason}<br/>'),
(200, 'Malus gelöscht', 'Malus cancellato', 'Malus supprimé'),
(201, 'Ein Malus wurde aus deinem Profil entfernt und entsprechend in der Lohnberechnung angepasst.', 'Un Malus è stato cancellato del suo profilo. Il calcolo dello stipendio è corretto di conseguenza.', 'Un malus a été supprimé de votre profil. Le calcul de votre salaire est corrigé en conséquence.'),
(202, '{firstname} {lastname} hat eine ungenügende Note', '{firstname} {lastname} ha un voto scolastico insufficiente', '{firstname} {lastname}  a une note insatisfaisante'),
(203, 'Der/die Benutzer/in {firstname} {lastname} ({bkey}) hat soeben eine ungenügende Note mit dem Titel {gradeTitle} eingetragen.<br/><br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', 'L\'utilizzatore {firstname} {lastname} ({bkey}) ha inserito un voto scolastico insufficiente con la voce {gradeTitle} <br/><br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', 'L\'utilisateur {firstname} {lastname} ({bkey}) vient de saisir une note insuffisante avec le titre <br/><br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}'),
(204, 'Notenschnitt wurde angepasst', 'La media dei voti scolastici è stata adattata', 'La moyenne des notes scolaires a été adaptée'),
(205, 'Dein Notenschnitt für das Fach {subjectName} wurde gerade durch das NWE angepasst. Dein neuer Notenschnitt für dieses Fach ist {newGrade}.', 'La sua media dei voti scolastici  del ramo {subjectName} è stata adattata dalle Risorse Umane. La sua nuova media per questo ramo è di {newGrade}.', 'Votre moyenne pour la branche {subjectName} a été ajustée par les RH. Votre nouvelle moyenne pour cette branche est de {newGrade}.'),
(206, '{firstname} {lastname} hat eine ungenügende Note gelöscht.', '{firstname} {lastname} ha cancellato un voto scolastico insufficiente.', '{firstname} {lastname} a supprimé une note insuffisante.'),
(207, 'Der/die Benutzer/in {firstname} {lastname} ({bkey}) hat soeben eine ungenügende Note gelöscht<br/><br/>Titel: {gradeTitle}<br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', 'L\'utilizzatore {firstname} {lastname} ({bkey}) ha cancellato un voto scolastico insufficiente<br/><br/>Titel: {gradeTitle}<br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}', 'L\'utilisateur {firstname} {lastname} ({bkey}) vient de supprimer une note insuffisante<br/><br/>Note: {grade} (Gewichtung: {gradeWeight} %)<br/>Begründung/Erklärung: <br/> {gradeReason}'),
(208, 'Verhaltensziele - Eintrag gelöscht', 'Obiettivi comportamentali - entrata cancellata', 'Objectifs comportementaux - entrée supprimée'),
(209, 'Der Eintrag zu {title} in den Verhaltenszielen wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce {title} degli obiettivi comportamentali è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée {title} des objectifs comportementaux a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(210, 'Verhaltensziele - Eintrag beanstandet', 'Obiettivi comportamentali - entrata respinta', 'Objectifs comportementaux - entrée rejetée'),
(211, 'Der Eintrag zu {title} in den Verhaltenszielen wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce {title} degli obiettivi comportamentali è stata respinta.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée {title} des objectifs comportementaux a été rejetée.<br/><br/>Begründung:<br/>{reason}'),
(212, 'Verhaltensziele - neuer Eintrag', 'Obiettivi comportamentali - nuova voce', 'Obiettivi comportamentali - nouvelle entrée'),
(213, 'In den Verhaltenszielen wurde soeben ein neuer Eintrag von {firstname} {lastname} erfasst:<br/><br/>Stage: {stageName}<br/>Punktzahl: {stagePoints}<br/>', 'La nuova voceIn den Verhaltenszielen wurde soeben ein neuer Eintrag von {firstname} {lastname} erfasst:<br/><br/>Stage: {stageName}<br/>Punktzahl: {stagePoints}<br/>', ''),
(214, 'Fachvortrag - Eintrag gelöscht', 'Ramo scolastico - voce cancellata', 'Branche scolaire - entrée supprimée'),
(215, 'Der Eintrag zum Fachvortrag {title} wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce del ramo scolastico {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de la branche scolaire {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(216, 'Fachvortrag - Eintrag beanstandet', 'Ramo scolastico - voce respinta', 'Branche scolaire - entrée rejetée'),
(217, 'Der Eintrag zum Fachvortrag {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce del ramo scolastico {title} è stata respinta.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de la branche scolaire {title} a été rejetée.<br/><br/>Begründung:<br/>{reason}'),
(218, 'Fachvortrag - Neuer Eintrag', 'Ramo scolastico - nuova voce', 'Branche scolaire - nouvelle entrée'),
(219, 'In den Fachvorträgen wurde soeben ein neuer Eintrag von {firstname} {lastname} erfasst:<br/><br/>Fachvortrag-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Una nuova voce dei rami scolastici è stata inserita da parte di {firstname} {lastname}:<br/><br/>Fachvortrag-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Une nouvelle entrée des branches scolaires a été saisies par {firstname} {lastname} erfasst:<br/><br/>Fachvortrag-Titel: {title}<br/>Punktzahl: {points}<br/>'),
(220, 'ALS - Eintrag gelöscht', 'SAL - voce cancellata', 'STA - entrée effacée'),
(221, 'Der Eintrag zur ALS {title} wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce per la SAL {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de la STA {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(222, 'ALS - Eintrag beanstandet', 'SAL - voce respinta', 'STA - entrée rejetée'),
(223, 'Der Eintrag zur ALS {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce della SAL {title} è stata respinta.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de la STA {title} a été rejetée.<br/><br/>Begründung:<br/>{reason}'),
(224, 'ALS - neuer Eintrag', 'SAL - nuova voce', 'SAL - nouvelle entrée'),
(225, 'Es wurde soeben ein neuer ALS Eintrag von {firstname} {lastname} erfasst:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Una nuova SAL è stara registrata da {firstname} {lastname}:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Une nouvelle STA a été enregistrée par {firstname} {lastname} :<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>'),
(226, 'PE - Eintrag gelöscht', 'UP - voce cancellata', 'UF - entrée effacée'),
(227, 'Der Eintrag zur PE {title} wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce per l\'UP {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de l\'UF {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(228, 'PE - Eintrag beanstandet', 'UP - voce respinta', 'UF - entrée rejetée'),
(229, 'Der Eintrag zur PE {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce dell\'UP {title} è stata respinta.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée de l\'UF {title} a été rejetée.<br/><br/>Begründung:<br/>{reason}'),
(230, 'PE - neuer Eintrag', 'UP - nuova voce', 'UF - nouvelle entrée'),
(231, 'Es wurde soeben ein neuer PE Eintrag von {firstname} {lastname} erfasst:<br/><br/>PE-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Una nuova UP è stara registrata da {firstname} {lastname}:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Une nouvelle UF a été enregistrée par {firstname} {lastname} :<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>'),
(232, 'ÜK - Eintrag gelöscht', 'CiA - voce cancellata', 'CiE - entrée effacée'),
(233, 'Der Eintrag zum üK {title} wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce per il CiA {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée du CiE {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(234, 'ÜK - Eintrag beanstandet', 'CiA - voce respinta', 'CiE - entrée rejetée'),
(235, 'Der Eintrag zum üK {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce per il CiA {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée du CiE {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(236, 'ÜK - neuer Eintrag', 'CiA - nuova voce', 'CiE - nouvelle entrée'),
(237, 'Es wurde soeben ein neuer üK Eintrag von {firstname} {lastname} erfasst:<br/><br/>üK-Titel: {title}<br/>Note: {points}<br/>', 'Un nuovo CiA è stato registrato da {firstname} {lastname}:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Un nouveau CiE a été enregistré par {firstname} {lastname} :<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>'),
(238, 'Stao - Eintrag gelöscht', 'Punto di situazione - voce cancellata', 'Point de situation- entrée effacée'),
(239, 'Der Eintrag zur Stao {title} wurde gerade von der NWE entfernt.<br/><br/>Begründung:<br/>{reason}', 'La voce per il punto di situazione {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée du point de situation {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(240, 'Stao - Eintrag beanstandet', 'Punto di situazione - voce respinta', 'Point de situation - entrée rejetée'),
(241, 'Der Eintrag zur Stao {title} wurde gerade beanstandet.<br/><br/>Begründung:<br/> {reason}', 'La voce per il punto di situazione {title} è stata cancellata dalle Risorse Umane.<br/><br/>Begründung:<br/>{reason}', 'L\'entrée du point de situation {title} a été supprimée par les RH.<br/><br/>Begründung:<br/>{reason}'),
(242, 'Stao - neuer Eintrag', 'Punto di situazione - nuova voce', 'Point de situation - nouvelle entrée'),
(243, 'Es wurde soeben ein neuer Stao Eintrag von {firstname} {lastname} erfasst:<br/><br/>Stao-Titel: {title}<br/>Punktzahl (in Prozent): {points} %<br/>', 'Un nuovo punto di situazione è stato registrato da {firstname} {lastname}:<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>', 'Un nouveau point de situation a été enregistré par {firstname} {lastname} :<br/><br/>ALS-Titel: {title}<br/>Punktzahl: {points}<br/>'),
(244, 'Diese Funktion ist nicht mit deinem Browser kompatiebel', '', ''),
(245, 'Lade dir jetzt', '', ''),
(246, 'herunter, um die Funktionen dieser Webseite vollständig zu nutzen.', '', ''),
(247, 'Achtung: Addiere die Punktzahlen von Betrieb und Prüfungsexperte zusammen, um daraus einen Eintrag zu erstellen.', '', ''),
(248, 'Kein Malus vorhanden', '', ''),
(249, 'Deine Statistiken', '', ''),
(250, 'Übersetzungen', '', ''),
(251, 'Inhalt', '', ''),
(252, 'Die Änderungen werden erst beim nächsten Login angewendet!', '', ''),
(253, 'Reglement', '', ''),
(254, 'Speichern', '', '');

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
  `language` varchar(2) DEFAULT NULL,
  `tb_semester_ID` int(11) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `timetable`, `lastLogin`, `tb_group_ID`, `firstname`, `lastname`, `mail`, `deleted`, `language`, `tb_semester_ID`, `creationDate`) VALUES
(1, 'b000001', NULL, NULL, 1, 'Bill', 'Gates', 'mail@eliareutlinger.ch', NULL, NULL, NULL, '2018-03-19 07:04:14'),
(2, 'b037160', NULL, NULL, 1, 'Elia', 'Reutlinger', 'mail@eliareutlinger.ch', NULL, NULL, NULL, '2018-03-19 07:04:14');

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
-- Indizes für die Tabelle `tb_dontcountsem`
--
ALTER TABLE `tb_dontcountsem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tb_user_ID` (`tb_user_ID`),
  ADD KEY `tb_semester_ID` (`tb_semester_ID`);

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
-- Indizes für die Tabelle `tb_text`
--
ALTER TABLE `tb_text`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tb_group_ID` (`tb_group_ID`);

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
  ADD KEY `fk_tb_user_tb_group_idx` (`tb_group_ID`),
  ADD KEY `tb_semester_ID` (`tb_semester_ID`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_appinfo`
--
ALTER TABLE `tb_appinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tb_behaviorgrade`
--
ALTER TABLE `tb_behaviorgrade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_deadline`
--
ALTER TABLE `tb_deadline`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_dontcountsem`
--
ALTER TABLE `tb_dontcountsem`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_ind_nav`
--
ALTER TABLE `tb_ind_nav`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `tb_modul_group`
--
ALTER TABLE `tb_modul_group`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT für Tabelle `tb_pe`
--
ALTER TABLE `tb_pe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_presentation`
--
ALTER TABLE `tb_presentation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT für Tabelle `tb_stao`
--
ALTER TABLE `tb_stao`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_subject_grade`
--
ALTER TABLE `tb_subject_grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_text`
--
ALTER TABLE `tb_text`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tb_translation`
--
ALTER TABLE `tb_translation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT für Tabelle `tb_uek`
--
ALTER TABLE `tb_uek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints der Tabelle `tb_dontcountsem`
--
ALTER TABLE `tb_dontcountsem`
  ADD CONSTRAINT `tb_dontcountsem_ibfk_1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`),
  ADD CONSTRAINT `tb_dontcountsem_ibfk_2` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

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
-- Constraints der Tabelle `tb_text`
--
ALTER TABLE `tb_text`
  ADD CONSTRAINT `tb_text_ibfk_1` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`);

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
  ADD CONSTRAINT `fk_tb_user_tb_group` FOREIGN KEY (`tb_group_ID`) REFERENCES `tb_group` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`);

--
-- Constraints der Tabelle `tb_user_subject`
--
ALTER TABLE `tb_user_subject`
  ADD CONSTRAINT `fk_tb_user_subject_tb_llit_semester1` FOREIGN KEY (`tb_semester_ID`) REFERENCES `tb_semester` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tb_user_subject_tb_user1` FOREIGN KEY (`tb_user_ID`) REFERENCES `tb_user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
