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
  `logo_path_de` varchar(50) DEFAULT NULL,
  `logo_path_it` varchar(50) DEFAULT NULL,
  `logo_path_fr` varchar(50) DEFAULT NULL,
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

INSERT INTO `tb_appinfo` (`id`, `title`, `title_short`, `description`, `db_version`, `logo_path_de`, `logo_path_it`, `logo_path_fr`, `logo_width`, `hintergrund`, `akzentfarbe`, `schrift`, `link`, `mail_support`, `mail_hr`) VALUES
(1, 'Evaluation-Tool', 'Eva', 'Evaluation-Tool for trainees', 1, 'img/logo/eva/eva_logo.svg', 'img/logo/eva/eva_logo.svg', 'img/logo/eva/eva_logo.svg', 80, '#ffffff', '#BBF2A0', '#333333', '#64A943', 'bill.gates@foo.com', 'bill.gates@foo.com');

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
(15, 'Glossar', 'Glossar verschiedener Begriffe', 'modul/glossar/glossar.php', '256', 'img/dashico/question.svg'),
(16, 'Dashboard', 'Dashboard mit allen Modulen', 'modul/dashboard/dashboard.php', '5', NULL);

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

INSERT INTO `tb_modul_group` (`tb_group_ID`, `tb_modul_ID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(2, 4),
(2, 6),
(2, 11),
(2, 12),
(2, 15),
(3, 1),
(3, 2),
(3, 4),
(3, 6),
(3, 10),
(3, 11),
(3, 12),
(3, 15),
(4, 1),
(4, 2),
(4, 3),
(4, 5),
(4, 8),
(4, 10),
(4, 12),
(4, 15),
(5, 1),
(5, 2),
(5, 3),
(5, 7),
(5, 10),
(5, 12),
(5, 15);

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
  `tb_group_ID` int(11),
  `de` text,
  `it` text,
  `fr` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tb_text`
--

INSERT INTO `tb_text` (`ID`, `type`, `tb_group_ID`, `de`, `it`, `fr`) VALUES
(1, 'reglement', 3, 'modul/reglement/upload/demo.pdf', 'modul/reglement/upload/demo.pdf', 'modul/reglement/upload/demo.pdf'),
(2, 'reglement', 4, 'modul/reglement/upload/demo.pdf', 'modul/reglement/upload/demo.pdf', 'modul/reglement/upload/demo.pdf'),
(3, 'glossar', NULL, NULL, NULL, NULL);

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
(4, 'Benutzer', 'Utenti', 'Utilisateurs'),
(5, 'Dashboard', 'Dashboard', 'Tableau de bord'),
(6, 'Fachvortrag', 'Presentazione tecnica del ramo', 'Exposé de branche'),
(7, 'Leistungslohn', 'Salario alla performance', 'Salaire à la performance'),
(8, 'Malus', 'Malus', 'Malus'),
(9, 'PE', 'UP', 'UF'),
(10, 'Stao', 'Punto della situazione', 'Point de situation'),
(11, 'Stundenplan', 'Tabella orario', 'Plan horaire'),
(12, 'Termine', 'Eventi', 'Événements'),
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
(254, 'Speichern', '', ''),
(255, 'E-Mail', '', ''),
(256, 'Glossar', '', ''),
(257, 'Der B-Key muss aus 7 Zeichen bestehen', '', ''),
(258, 'Bitte Gruppe auswählen', '', ''),
(259, 'User wurde bereits mehrmal in Datenbank eingetragen', '', ''),
(260, 'Unbekannter Befehl übergeben', '', ''),
(261, 'Bearbeiten', '', ''),
(262, 'Neues Dokument hochladen (PDF):', '', ''),
(263, 'Kontakt', '', ''),
(264, 'Nachricht', '', ''),
(265, 'Allgemeine Anfrage (Nachwuchsentwicklung)', '', ''),
(266, 'Allgemeine Anfrage (Technik)', '', ''),
(267, 'Verbesserungsvorschläge', '', ''),
(268, 'Feedback / Kritik', '', ''),
(269, 'Produkt Support', '', ''),
(270, 'Problem / Fehler', '', ''),
(271, 'Thema', '', ''),
(272, 'Deine Nachricht wurde verschickt!', '', '');

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
(1, 'b000001', NULL, NULL, 1, 'Bill', 'Gates', 'bill.gates@foo.com', NULL, NULL, NULL, '2018-03-19 07:04:14');

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
  ADD UNIQUE KEY `tb_user_ID_2` (`tb_user_ID`),
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tb_translation`
--
ALTER TABLE `tb_translation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

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
