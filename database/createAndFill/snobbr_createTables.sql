CREATE TABLE IF NOT EXISTS `snobbr`.`tb_group` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `prefix` VARCHAR(3) NOT NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_user` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `bKey` VARCHAR(7) NOT NULL,
  `timetable` VARCHAR(255) NULL,
  `lastLogin` TIMESTAMP NULL,
  `tb_group_ID` INT NOT NULL,
  `tb_ind_backgroundcolor` VARCHAR(6) NULL,
  `tb_ind_akzentcolor` VARCHAR(6) NULL,
  `tb_ind_linkcolor` VARCHAR(6) NULL,
  `tb_ind_textcolor` VARCHAR(6) NULL,
  PRIMARY KEY (`ID`, `tb_group_ID`),
  INDEX `fk_tb_user_tb_group_idx` (`tb_group_ID` ASC),
  CONSTRAINT `fk_tb_user_tb_group`
    FOREIGN KEY (`tb_group_ID`)
    REFERENCES `snobbr`.`tb_group` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_modul`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_modul` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  `file_path` VARCHAR(255) NULL,
  `title` VARCHAR(255) NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_modul_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_modul_group` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `tb_group_ID` INT NOT NULL,
  `tb_modul_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `tb_group_ID`, `tb_modul_ID`),
  INDEX `fk_tb_modul_group_tb_group1_idx` (`tb_group_ID` ASC),
  INDEX `fk_tb_modul_group_tb_modul1_idx` (`tb_modul_ID` ASC),
  CONSTRAINT `fk_tb_modul_group_tb_group1`
    FOREIGN KEY (`tb_group_ID`)
    REFERENCES `snobbr`.`tb_group` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_modul_group_tb_modul1`
    FOREIGN KEY (`tb_modul_ID`)
    REFERENCES `snobbr`.`tb_modul` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_ind_nav`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_ind_nav` (
  `ID` INT NOT NULL AUTO_INCREMENT AUTO_INCREMENT,
  `tb_user_ID` INT NOT NULL,
  `tb_modul_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `tb_user_ID`, `tb_modul_ID`),
  INDEX `fk_tb_ind_nav_tb_user1_idx` (`tb_user_ID` ASC),
  INDEX `fk_tb_ind_nav_tb_modul1_idx` (`tb_modul_ID` ASC),
  CONSTRAINT `fk_tb_ind_nav_tb_user1`
    FOREIGN KEY (`tb_user_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_ind_nav_tb_modul1`
    FOREIGN KEY (`tb_modul_ID`)
    REFERENCES `snobbr`.`tb_modul` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_llit_semester`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_llit_semester` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `semester` INT NOT NULL,
  `year` INT NOT NULL,
  `info` VARCHAR(255) NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_user_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_user_subject` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `subjectName` VARCHAR(255) NOT NULL,
  `creationDate` TIMESTAMP NULL,
  `tb_user_ID` INT NOT NULL,
  `tb_llit_semester_ID` INT NOT NULL,
  `correctedGrade` DOUBLE NULL,
  PRIMARY KEY (`ID`, `tb_user_ID`, `tb_llit_semester_ID`),
  INDEX `fk_tb_user_subject_tb_user1_idx` (`tb_user_ID` ASC),
  INDEX `fk_tb_user_subject_tb_llit_semester1_idx` (`tb_llit_semester_ID` ASC),
  CONSTRAINT `fk_tb_user_subject_tb_user1`
    FOREIGN KEY (`tb_user_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_user_subject_tb_llit_semester1`
    FOREIGN KEY (`tb_llit_semester_ID`)
    REFERENCES `snobbr`.`tb_llit_semester` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_subject_grade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_subject_grade` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `grade` DOUBLE NULL,
  `creationDate` TIMESTAMP NULL,
  `writtenDate` DATE NULL,
  `weighting` DOUBLE NULL,
  `notes` TEXT NULL,
  `tb_user_subject_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `tb_user_subject_ID`),
  INDEX `fk_tb_subject_grade_tb_user_subject1_idx` (`tb_user_subject_ID` ASC),
  CONSTRAINT `fk_tb_subject_grade_tb_user_subject1`
    FOREIGN KEY (`tb_user_subject_ID`)
    REFERENCES `snobbr`.`tb_user_subject` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_presentation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_presentation` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `points` INT NULL,
  `creationDate` TIMESTAMP NULL,
  `tb_user_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `tb_user_ID`),
  INDEX `fk_tb_presentation_tb_user1_idx` (`tb_user_ID` ASC),
  CONSTRAINT `fk_tb_presentation_tb_user1`
    FOREIGN KEY (`tb_user_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_behaviorgrade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_behaviorgrade` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `tb_userLL_ID` INT NOT NULL,
  `tb_userPA_ID` INT NOT NULL,
  `stageName` VARCHAR(255) NULL,
  `points` INT NULL,
  `creationDate` TIMESTAMP NOT NULL,
  PRIMARY KEY (`ID`, `tb_userLL_ID`, `tb_userPA_ID`),
  INDEX `fk_tb_behaviorgrade_tb_user1_idx` (`tb_userLL_ID` ASC),
  INDEX `fk_tb_behaviorgrade_tb_user2_idx` (`tb_userPA_ID` ASC),
  CONSTRAINT `fk_tb_behaviorgrade_tb_user1`
    FOREIGN KEY (`tb_userLL_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_behaviorgrade_tb_user2`
    FOREIGN KEY (`tb_userPA_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_deadline`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_deadline` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `date` DATE NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_malus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_malus` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `tb_user_ID` INT NOT NULL,
  PRIMARY KEY (`ID`, `tb_user_ID`),
  INDEX `fk_tb_malus_tb_user1_idx` (`tb_user_ID` ASC),
  CONSTRAINT `fk_tb_malus_tb_user1`
    FOREIGN KEY (`tb_user_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_deadline_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_deadline_group` (
  `tb_deadline_ID` INT NOT NULL,
  `tb_group_ID` INT NOT NULL,
  PRIMARY KEY (`tb_deadline_ID`, `tb_group_ID`),
  INDEX `fk_tb_deadline_has_tb_group_tb_group1_idx` (`tb_group_ID` ASC),
  INDEX `fk_tb_deadline_has_tb_group_tb_deadline1_idx` (`tb_deadline_ID` ASC),
  CONSTRAINT `fk_tb_deadline_has_tb_group_tb_deadline1`
    FOREIGN KEY (`tb_deadline_ID`)
    REFERENCES `snobbr`.`tb_deadline` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_deadline_has_tb_group_tb_group1`
    FOREIGN KEY (`tb_group_ID`)
    REFERENCES `snobbr`.`tb_group` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `snobbr`.`tb_deadline_check`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `snobbr`.`tb_deadline_check` (
  `tb_deadline_ID` INT NOT NULL,
  `tb_user_ID` INT NOT NULL,
  PRIMARY KEY (`tb_deadline_ID`, `tb_user_ID`),
  INDEX `fk_tb_deadline_has_tb_user_tb_user1_idx` (`tb_user_ID` ASC),
  INDEX `fk_tb_deadline_has_tb_user_tb_deadline1_idx` (`tb_deadline_ID` ASC),
  CONSTRAINT `fk_tb_deadline_has_tb_user_tb_deadline1`
    FOREIGN KEY (`tb_deadline_ID`)
    REFERENCES `snobbr`.`tb_deadline` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tb_deadline_has_tb_user_tb_user1`
    FOREIGN KEY (`tb_user_ID`)
    REFERENCES `snobbr`.`tb_user` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;