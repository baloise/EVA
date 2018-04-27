-- Überflüssige Tabelle löschen
DROP TABLE `tb_deadline_group`;

-- Datentyp von Datum ändern zu Varchar
ALTER TABLE `tb_deadline` CHANGE `date` `date` VARCHAR(255) NULL DEFAULT NULL;

-- TERMINE
--Neue Termine IT einfügen
INSERT INTO `tb_deadline` (`ID`, `title_de`, `title_fr`, `title_it`, `description_de`, `description_fr`, `description_it`, `date`, `tb_semester_ID`) VALUES
-- Semester 1
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '25'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '25'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. September', '25'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Oktober', '25'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. November', '25'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Dezember', '25'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Januar', '25'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '31. Januar', '25'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Formular zur Vereinbarung über das Thema / den Zeitplan zum Fachvortrag per E-Mail an PVA senden.', '', '', '31. Januar', '25'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail an PVA senden.', '', '', '31. Januar', '25'),
-- Semester 2 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Februar', '26'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Februar', '26'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. März', '26'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. April', '26'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Mai', '26'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Juni', '26'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen.', '', '', '30. Juni', '26'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '30. Juni', '26'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail als PDF an PVA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '30. Juni', '26'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Juli', '26'),
-- Semester 3 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '27'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '27'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. September', '27'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Oktober', '27'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. November', '27'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Dezember', '27'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Januar', '27'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '31. Januar', '27'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Formular zur Vereinbarung über das Thema / den Zeitplan zum Fachvortrag per E-Mail an PVA senden.', '', '', '31. Januar', '27'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail an PVA senden.', '', '', '31. Januar', '27'),
-- Semester 4 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Februar', '28'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Februar', '28'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. März', '28'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. April', '28'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Mai', '28'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Juni', '28'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen.', '', '', '30. Juni', '28'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '30. Juni', '28'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail als PDF an PVA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '30. Juni', '28'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Juli', '28'),
-- Semester 5 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '29'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '29'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. September', '29'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Oktober', '29'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. November', '29'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Dezember', '29'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Januar', '29'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '31. Januar', '29'),
(NULL, 'Fachvortrag Vereinbarung', '', '', 'Formular zur Vereinbarung über das Thema / den Zeitplan zum Fachvortrag per E-Mail an PVA senden.', '', '', '31. Januar', '29'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail an PVA senden.', '', '', '31. Januar', '29'),
-- Semester 6 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Februar', '30'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Februar', '30'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. März', '30'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. April', '30'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Mai', '30'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Juni', '30'),
(NULL, 'Fachvortrag Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen.', '', '', '30. Juni', '30'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '30. Juni', '30'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail als PDF an PVA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '30. Juni', '30'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Juli', '30'),
-- Semester 7 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '31'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. August', '31'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. September', '31'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Oktober', '31'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. November', '31'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Dezember', '31'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Januar', '31'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '31. Januar', '31'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail an PVA senden.', '', '', '31. Januar', '31'),
-- Semester 8 IT
(NULL, 'Verhaltensziele Vereinbarung', '', '', 'Vereinbarung der Verhaltenszielen für die kommende Stage an PVA gesendet. Dies muss vor jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht. (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Februar', '32'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Februar', '32'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. März', '32'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. April', '32'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Mai', '32'),
(NULL, 'Zeiterfassung & Noten', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch). Aktuelle Noten im Tool nachtragen.', '', '', '10. Juni', '32'),
(NULL, 'Verhaltensziele Bewertung', '', '', 'Abgeschlossene Bewertung im Tool eingetragen. Dies muss nach jeder Stage erledigt werden, auch wenn nur ein Termin pro Semester besteht.', '', '', '30. Juni', '32'),
(NULL, 'Semesterbericht', '', '', 'Semesterbericht über das vergangene Semester erstellen und per E-Mail als PDF an PVA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '30. Juni', '32'),
(NULL, 'Zeiterfassung', '', '', 'Monatsjournal der Zeiterfassung in Zeus generieren lassen, als PDF speichern und per E-Mail an PVA und PA senden (Gruppenmailbox NWE: ch_hr_lehrlingswesen@baloise.ch).', '', '', '10. Juli', '32');
-- TERMINE IT ENDE

-- Übersetzung anpassen
UPDATE `tb_translation` SET `de` = 'Alle Termine in diesem Semester' WHERE `tb_translation`.`ID` = 78;
UPDATE `tb_translation` SET `it` = '' WHERE `tb_translation`.`ID` = 78;
UPDATE `tb_translation` SET `fr` = '' WHERE `tb_translation`.`ID` = 78;
-- Appinfo überflüssige Spalte entfernen
ALTER TABLE `tb_appinfo` DROP `db_version`;
