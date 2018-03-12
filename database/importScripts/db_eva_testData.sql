START TRANSACTION;

--
-- Daten für Tabelle `tb_user`
--

INSERT INTO `tb_user` (`ID`, `bKey`, `timetable`, `lastLogin`, `tb_group_ID`, `firstname`, `lastname`, `mail`, `deleted`, `language`, `tb_semester_ID`, `creationDate`) VALUES
(115, 'b000002', NULL, NULL, 1, 'Elon', 'Musk', NULL, NULL, NULL, NULL, '2018-02-26 08:37:01'),
(116, 'b000003', NULL, NULL, 2, 'Matthias', 'Schneider', NULL, NULL, NULL, NULL, '2018-02-26 08:37:30'),
(117, 'b000004', NULL, NULL, 2, 'Chantal', 'Müller', NULL, NULL, NULL, NULL, '2018-02-26 08:37:44'),
(118, 'b000005', '2679040', NULL, 3, 'Moritz', 'Keller', NULL, NULL, NULL, NULL, '2018-02-26 08:39:02'),
(119, 'b000006', NULL, NULL, 3, 'Fabio', 'Caprio', NULL, NULL, NULL, NULL, '2018-02-26 08:39:24'),
(120, 'b000007', NULL, NULL, 4, 'Giovanni', 'Mozarella', NULL, NULL, NULL, 36, '2018-02-26 08:40:01'),
(121, 'b000008', NULL, NULL, 4, 'Sandra', 'Schneider', NULL, NULL, NULL, 36, '2018-02-26 08:40:17'),
(122, 'b000009', NULL, NULL, 5, 'Hans', 'Zimmer', NULL, NULL, NULL, 41, '2018-02-26 12:09:23'),
(123, 'b000010', NULL, NULL, 5, 'Dinah', 'Washington', NULL, NULL, NULL, NULL, '2018-02-26 12:10:49');

-- --------------------------------------------------------

INSERT INTO `tb_als` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`, `performance`) VALUES
(97, 'ALS 1', 44, '2018-02-26 08:41:12', 120, 33, 1),
(98, 'ALS 2', 42, '2018-02-26 08:41:22', 120, 34, 1),
(99, 'ALS 3', 49, '2018-02-26 08:41:35', 120, 35, 1),
(100, 'ALS 4', 44, '2018-02-26 08:41:53', 120, 36, 1),
(102, 'ALS 1', 51, '2018-02-26 08:44:29', 120, 33, NULL),
(103, 'ALS 2', 47, '2018-02-26 08:44:44', 120, 34, NULL),
(104, 'ALS 3', 48, '2018-02-26 08:44:57', 120, 35, NULL),
(105, 'ALS 4', 48, '2018-02-26 08:45:15', 120, 36, NULL),
(116, 'ALS 1', 40, '2018-02-26 12:18:27', 121, 33, NULL),
(117, 'ALS 2', 36, '2018-02-26 12:18:38', 121, 34, NULL),
(118, 'ALS 3', 27, '2018-02-26 12:18:49', 121, 35, NULL),
(119, 'ALS 4', 30, '2018-02-26 12:18:59', 121, 36, NULL),
(120, 'ALS 1', 27, '2018-02-26 12:19:15', 121, 33, 1),
(121, 'ALS 2', 35, '2018-02-26 12:19:24', 121, 34, 1),
(122, 'ALS 3', 35, '2018-02-26 12:19:33', 121, 35, 1),
(123, 'ALS 4', 41, '2018-02-26 12:19:43', 121, 36, 1);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_behaviorgrade`
--

INSERT INTO `tb_behaviorgrade` (`ID`, `tb_userLL_ID`, `tb_userPA_ID`, `stageName`, `points`, `creationDate`, `tb_semester_ID`) VALUES
(63, 118, 117, '4. Semester', 63, '2018-02-26 10:13:17', 28),
(64, 118, 116, '3. Semester', 65, '2018-02-26 10:13:31', 27);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_deadline`
--

INSERT INTO `tb_deadline` (`ID`, `title_de`, `title_fr`, `title_it`, `description_de`, `description_fr`, `description_it`, `date`, `tb_semester_ID`) VALUES
(3, 'Testtermin 1', '', '', 'Testtermin 1', '', '', '2018-02-19', 33),
(4, 'Testtermin 2', '', '', 'Testtermin 2', '', '', '2018-02-28', 33),
(5, 'Testtermin 3', '', '', 'Testtermin 3', '', '', '2018-02-21', 33);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_deadline_check`
--

INSERT INTO `tb_deadline_check` (`tb_deadline_ID`, `tb_user_ID`) VALUES
(3, 120),
(4, 120),
(5, 120);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_dontcountsem`
--

INSERT INTO `tb_dontcountsem` (`ID`, `tb_user_ID`, `tb_semester_ID`) VALUES
(2, 121, 33),
(3, 120, 33);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_malus`
--

INSERT INTO `tb_malus` (`ID`, `description`, `weight`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(73, 'Unentschuldigte Absenzen Schule/ÜK', 20, '2018-02-26 12:29:00', 121, 33),
(74, 'Unentschuldigte Absenzen Schule/ÜK', 20, '2018-02-26 12:29:29', 121, 34),
(75, 'Aktennotiz Betrieb', 10, '2018-02-26 12:31:40', 121, 35),
(76, 'schriftliche Verwarnung Betrieb', 20, '2018-02-26 12:32:04', 121, 36),
(77, 'unentschuldigte Absenzen Schule/ÜK', 20, '2018-02-26 12:32:29', 121, 36);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_pe`
--

INSERT INTO `tb_pe` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(39, 'PE 1.Jahr', 58, '2018-02-26 09:15:22', 120, 34),
(40, 'PE 2.Jahr', 69, '2018-02-26 09:15:56', 120, 36),
(43, 'PE 1.Jahr', 39, '2018-02-26 12:20:13', 121, 34),
(44, 'PE 2.Jahr', 29, '2018-02-26 12:20:25', 121, 36);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_presentation`
--

INSERT INTO `tb_presentation` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(27, 'Testvortrag 1', 66, '2018-02-26 10:19:01', 118, 28);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_stao`
--

INSERT INTO `tb_stao` (`ID`, `title`, `points`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(61, 'STAO 1', 78.8, '2018-02-26 09:21:50', 120, 33),
(62, 'STAO 2', 57.8, '2018-02-26 09:22:05', 120, 34),
(64, 'STAO 1', 67.2, '2018-02-26 12:14:40', 121, 33),
(65, 'STAO 2', 53.3, '2018-02-26 12:15:05', 121, 34);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_user_subject`
--

INSERT INTO `tb_user_subject` (`ID`, `subjectName`, `creationDate`, `tb_user_ID`, `tb_semester_ID`, `correctedGrade`, `school`) VALUES
(12, 'Testfach 1', '2018-02-26 09:03:27', 120, 33, NULL, 1),
(13, 'Testfach 2', '2018-02-26 09:03:59', 120, 34, NULL, 1),
(14, 'Testfach 3', '2018-02-26 09:04:31', 120, 35, NULL, 1),
(15, 'Testfach 4', '2018-02-26 09:04:54', 120, 36, NULL, 1),
(16, 'Testfach 1', '2018-02-26 10:17:15', 118, 27, NULL, 1),
(17, 'Testfach 2', '2018-02-26 10:17:38', 118, 28, NULL, 1),
(18, 'Testmodul 1', '2018-02-26 10:20:12', 118, 25, NULL, 0),
(19, 'Testmodul 2', '2018-02-26 10:20:22', 118, 26, NULL, 0),
(20, 'Testmodul 3', '2018-02-26 10:20:32', 118, 27, NULL, 0),
(21, 'Testmodul 4', '2018-02-26 10:20:40', 118, 28, NULL, 0),
(23, 'Fach 1', '2018-02-26 12:15:26', 121, 33, NULL, 1),
(24, 'Fach 2', '2018-02-26 12:15:48', 121, 34, NULL, 1),
(25, 'Fach 3', '2018-02-26 12:16:31', 121, 35, NULL, 1),
(26, 'Fach 4', '2018-02-26 12:16:50', 121, 36, NULL, 1);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_ind_nav`
--

INSERT INTO `tb_ind_nav` (`ID`, `position`, `tb_user_ID`, `tb_modul_ID`) VALUES
(166, NULL, 120, 1),
(167, NULL, 120, 5),
(168, NULL, 6, 7),
(169, NULL, 6, 5),
(170, NULL, 6, 8),
(171, NULL, 115, 11),
(172, NULL, 115, 5),
(173, NULL, 118, 5),
(174, NULL, 118, 12),
(175, NULL, 6, 11),
(176, NULL, 6, 15),
(177, NULL, 6, 16);

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_subject_grade`
--

INSERT INTO `tb_subject_grade` (`ID`, `title`, `grade`, `creationDate`, `weighting`, `notes`, `tb_user_subject_ID`, `reasoning`) VALUES
(33, 'Testnote', 5.1, '2018-02-26 09:03:48', 100, NULL, 12, ''),
(34, 'Testnote', 5.2, '2018-02-26 09:04:14', 100, NULL, 13, ''),
(35, 'Testnote', 5.2, '2018-02-26 09:04:42', 100, NULL, 14, ''),
(36, 'Testnote', 5.3, '2018-02-26 09:05:06', 100, NULL, 15, ''),
(37, 'Testnote', 5.5, '2018-02-26 10:17:25', 100, NULL, 16, ''),
(38, 'Testnote', 5.6, '2018-02-26 10:17:49', 100, NULL, 17, ''),
(39, 'Testnote', 5.6, '2018-02-26 10:20:50', 100, NULL, 21, ''),
(40, 'Testnote', 5, '2018-02-26 10:21:08', 100, NULL, 20, ''),
(41, 'Testnote', 5.4, '2018-02-26 10:21:22', 100, NULL, 19, ''),
(42, 'Testnote', 5.4, '2018-02-26 10:21:35', 100, NULL, 18, ''),
(44, 'Test', 4.1, '2018-02-26 12:15:40', 100, NULL, 23, ''),
(45, 'Test', 3.8, '2018-02-26 12:16:23', 100, NULL, 24, 'Lorizzle yo mamma dolizzle sit nizzle, consectetuer adipiscing stuff. Yo mamma own yo\' velizzle, aliquet volutpat, sure pizzle, brizzle vizzle, fo shizzle. Pellentesque stuff tortor. Sizzle mofo. Hizzle pizzle rizzle dapibizzle sheezy tempus doggy. Crunk my shizz nibh away turpizzle. Ass izzle yo. Break it down eleifend sure nisi. In hac that\'s the shizzle platea i saw beyonces tizzles and my pizzle went crizzle. Donec dapibizzle. Yo tellizzle yo, bling bling eu, mattizzle dizzle, eleifend vitae, pot. Da bomb suscipizzle. Integizzle sempizzle velit sed ass.'),
(46, 'Test', 4.4, '2018-02-26 12:16:41', 100, NULL, 25, ''),
(47, 'Test', 4.1, '2018-02-26 12:16:59', 100, NULL, 26, '');

-- --------------------------------------------------------

--
-- Daten für Tabelle `tb_uek`
--

INSERT INTO `tb_uek` (`ID`, `title`, `grade`, `creationDate`, `tb_user_ID`, `tb_semester_ID`) VALUES
(1, 'Test', 5, '2018-03-08 08:45:39', 122, 39);
