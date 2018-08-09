--Beschreibung: Dieser Import fügt eine Gewichtungs-Spalte für einzelne Fächer ein.

ALTER TABLE `tb_user_subject` ADD `weight` DOUBLE NULL DEFAULT NULL AFTER `school`;
