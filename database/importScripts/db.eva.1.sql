-- Überflüssige Tabelle löschen
DROP TABLE `tb_deadline_group`;

-- Datentyp von Datum ändern zu Varchar
ALTER TABLE `tb_deadline` CHANGE `date` `date` VARCHAR(255) NULL DEFAULT NULL;

--Neue Termine einfügen
INSERT INTO `tb_deadline` (`ID`, `title_de`, `title_fr`, `title_it`, `description_de`, `description_fr`, `description_it`, `date`, `tb_semester_ID`) VALUES
-- Semester 1
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet.', '', '', '31. August', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. August', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. September', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Oktober', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. November', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Dezember', '25'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Januar', '25'),
-- Semester 2 IT
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '10. Februar', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Februar', '26'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '10. Februar', '26'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Vereinbarung bei PVL eingetroffen.', '', '', '28. Februar', '26'),
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet..', '', '', '28. Februar', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. März', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. April', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Mai', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juni', '26'),
(NULL, 'Fachvortrag', '', '', 'Fachvortrag absolviert.', '', '', '29. Juni', '26'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '29. Juni', '26'),
(NULL, 'Noten', '', '', 'Schul-/Modulnoten im Tool eingetragen.', '', '', '29. Juni', '26'),
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '31. Juni', '26'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '31. Juni', '26'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juli', '26'),
-- Semester 3 IT
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet.', '', '', '31. August', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. August', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. September', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Oktober', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. November', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Dezember', '27'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Januar', '27'),
-- Semester 4 IT
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '10. Februar', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Februar', '28'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '10. Februar', '28'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Vereinbarung bei PVL eingetroffen.', '', '', '28. Februar', '28'),
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet..', '', '', '28. Februar', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. März', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. April', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Mai', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juni', '28'),
(NULL, 'Fachvortrag', '', '', 'Fachvortrag absolviert.', '', '', '29. Juni', '28'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '29. Juni', '28'),
(NULL, 'Noten', '', '', 'Schul-/Modulnoten im Tool eingetragen.', '', '', '29. Juni', '28'),
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '31. Juni', '28'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '31. Juni', '28'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juli', '28'),
-- Semester 5 IT
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet.', '', '', '31. August', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. August', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. September', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Oktober', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. November', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Dezember', '29'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Januar', '29'),
-- Semester 6 IT
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '10. Februar', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Februar', '30'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '10. Februar', '30'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Vereinbarung bei PVL eingetroffen.', '', '', '28. Februar', '30'),
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet..', '', '', '28. Februar', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. März', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. April', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Mai', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juni', '30'),
(NULL, 'Fachvortrag', '', '', 'Fachvortrag absolviert.', '', '', '29. Juni', '30'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '29. Juni', '30'),
(NULL, 'Noten', '', '', 'Schul-/Modulnoten im Tool eingetragen.', '', '', '29. Juni', '30'),
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '31. Juni', '30'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '31. Juni', '30'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juli', '30'),
-- Semester 7 IT
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet.', '', '', '31. August', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. August', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. September', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Oktober', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. November', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Dezember', '31'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Januar', '31'),
-- Semester 8 IT
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '10. Februar', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Februar', '32'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '10. Februar', '32'),
(NULL, 'Planung Semester', '', '', 'Informationen über Semesterablauf an PVL gesendet..', '', '', '28. Februar', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. März', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. April', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Mai', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juni', '32'),
(NULL, 'Noten', '', '', 'Schul-/Modulnoten im Tool eingetragen.', '', '', '29. Juni', '32'),
(NULL, 'Verhaltensziele', '', '', 'Bewertung bei PVL eingetroffen.', '', '', '31. Juni', '32'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht bei PVL eingetroffen.', '', '', '31. Juni', '32'),
(NULL, 'Zeiterfassung', '', '', 'Elektronisch als PDF an PVL und PA gesendet.', '', '', '10. Juli', '32');
--Übersetzung anpassen
UPDATE `tb_translation` SET `de` = 'Alle Termine in diesem Semester' WHERE `tb_translation`.`ID` = 78;
UPDATE `tb_translation` SET `it` = '' WHERE `tb_translation`.`ID` = 78;
UPDATE `tb_translation` SET `fr` = '' WHERE `tb_translation`.`ID` = 78;
