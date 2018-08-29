--Beschreibung: Anpassung des Datentyps für alle Punktierungen punkte (Issue #184)

ALTER TABLE `tb_behaviorgrade` CHANGE `points` `points` DOUBLE NULL DEFAULT NULL;
ALTER TABLE `tb_pe` CHANGE `points` `points` DOUBLE NULL DEFAULT NULL;
ALTER TABLE `tb_presentation` CHANGE `points` `points` DOUBLE NULL DEFAULT NULL;
