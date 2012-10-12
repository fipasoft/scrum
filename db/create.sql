SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`stask`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`stask` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`sproject`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sproject` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`project`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`project` (
  `id` INT NOT NULL ,
  `sproject_id` INT NOT NULL ,
  `key` VARCHAR(12) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `starts` DATE NULL ,
  `ends` DATE NULL ,
  `saved_at` DATETIME NOT NULL ,
  `modified_in` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_project_sproject1` (`sproject_id` ASC) ,
  CONSTRAINT `fk_project_sproject1`
    FOREIGN KEY (`sproject_id` )
    REFERENCES `mydb`.`sproject` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`size`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`size` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(3) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`sstory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sstory` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`cstory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`cstory` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`story`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`story` (
  `id` INT NOT NULL ,
  `size_id` INT NOT NULL ,
  `sstory_id` INT NOT NULL ,
  `cstory_id` INT NOT NULL ,
  `numer` INT NOT NULL ,
  `description` VARCHAR(768) NOT NULL ,
  `weight` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  `modified_in` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_history_size1` (`size_id` ASC) ,
  INDEX `fk_story_sstory1` (`sstory_id` ASC) ,
  INDEX `fk_story_cstory1` (`cstory_id` ASC) ,
  CONSTRAINT `fk_history_size1`
    FOREIGN KEY (`size_id` )
    REFERENCES `mydb`.`size` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_story_sstory1`
    FOREIGN KEY (`sstory_id` )
    REFERENCES `mydb`.`sstory` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_story_cstory1`
    FOREIGN KEY (`cstory_id` )
    REFERENCES `mydb`.`cstory` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`pbacklog`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`pbacklog` (
  `id` INT NOT NULL ,
  `project_id` INT NOT NULL ,
  `story_id` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pbacklog_project1` (`project_id` ASC) ,
  INDEX `fk_pbacklog_story1` (`story_id` ASC) ,
  CONSTRAINT `fk_pbacklog_project1`
    FOREIGN KEY (`project_id` )
    REFERENCES `mydb`.`project` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pbacklog_story1`
    FOREIGN KEY (`story_id` )
    REFERENCES `mydb`.`story` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`ttask`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ttask` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`task`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`task` (
  `id` INT NOT NULL ,
  `stask_id` INT NOT NULL ,
  `story_id` INT NOT NULL ,
  `ttask_id` INT NOT NULL ,
  `summary` VARCHAR(256) NOT NULL ,
  `description` TEXT NULL ,
  `estimated` INT NULL ,
  `starts` DATETIME NULL ,
  `ends` DATETIME NULL ,
  `saved_at` DATETIME NOT NULL ,
  `modified_in` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_task_stask1` (`stask_id` ASC) ,
  INDEX `fk_task_story1` (`story_id` ASC) ,
  INDEX `fk_task_ttask1` (`ttask_id` ASC) ,
  CONSTRAINT `fk_task_stask1`
    FOREIGN KEY (`stask_id` )
    REFERENCES `mydb`.`stask` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_task_story1`
    FOREIGN KEY (`story_id` )
    REFERENCES `mydb`.`story` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_task_ttask1`
    FOREIGN KEY (`ttask_id` )
    REFERENCES `mydb`.`ttask` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`ssprint`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ssprint` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`sprint`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sprint` (
  `id` INT NOT NULL ,
  `ssprint_id` INT NOT NULL ,
  `project_id` INT NOT NULL ,
  `number` INT NOT NULL ,
  `starts` DATE NOT NULL ,
  `ends` DATE NOT NULL ,
  `dworked` INT NULL ,
  `hdayworked` INT NULL ,
  `saved_at` DATETIME NOT NULL ,
  `modified_in` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sprint_ssprint1` (`ssprint_id` ASC) ,
  INDEX `fk_sprint_project1` (`project_id` ASC) ,
  CONSTRAINT `fk_sprint_ssprint1`
    FOREIGN KEY (`ssprint_id` )
    REFERENCES `mydb`.`ssprint` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_sprint_project1`
    FOREIGN KEY (`project_id` )
    REFERENCES `mydb`.`project` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`sbacklog`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sbacklog` (
  `id` INT NOT NULL ,
  `sprint_id` INT NOT NULL ,
  `story_id` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_sbacklog_sprint1` (`sprint_id` ASC) ,
  INDEX `fk_sbacklog_story1` (`story_id` ASC) ,
  CONSTRAINT `fk_sbacklog_sprint1`
    FOREIGN KEY (`sprint_id` )
    REFERENCES `mydb`.`sprint` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_sbacklog_story1`
    FOREIGN KEY (`story_id` )
    REFERENCES `mydb`.`story` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`user` (
  `id` INT NOT NULL ,
  `login` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  `name` VARCHAR(50) NULL ,
  `lastName` VARCHAR(50) NULL ,
  `email` VARCHAR(100) NULL ,
  `saved_at` DATETIME NOT NULL ,
  `modified_in` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`role` (
  `id` INT NOT NULL ,
  `key` VARCHAR(3) NOT NULL ,
  `name` VARCHAR(32) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`team`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`team` (
  `id` INT NOT NULL ,
  `project_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `role_id` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_project` (`project_id` ASC) ,
  INDEX `fk_team_user1` (`user_id` ASC) ,
  INDEX `fk_team_role1` (`role_id` ASC) ,
  CONSTRAINT `fk_team_project`
    FOREIGN KEY (`project_id` )
    REFERENCES `mydb`.`project` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_team_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`user` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_team_role1`
    FOREIGN KEY (`role_id` )
    REFERENCES `mydb`.`role` (`id` )
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`historical`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`historical` (
  `id` INT NOT NULL ,
  `user` VARCHAR(20) NOT NULL ,
  `description` VARCHAR(768) NOT NULL ,
  `controller` VARCHAR(32) NOT NULL ,
  `action` VARCHAR(32) NOT NULL ,
  `model` VARCHAR(32) NOT NULL ,
  `record` VARCHAR(32) NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`assigned`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`assigned` (
  `id` INT NOT NULL ,
  `task_id` INT NOT NULL ,
  `team_id` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_assigned_task1` (`task_id` ASC) ,
  INDEX `fk_assigned_team1` (`team_id` ASC) ,
  CONSTRAINT `fk_assigned_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `mydb`.`task` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_assigned_team1`
    FOREIGN KEY (`team_id` )
    REFERENCES `mydb`.`team` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mydb`.`tbacklog`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tbacklog` (
  `id` INT NOT NULL ,
  `sbacklog_id` INT NOT NULL ,
  `task_id` INT NOT NULL ,
  `saved_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbacklog_sbacklog1` (`sbacklog_id` ASC) ,
  INDEX `fk_tbacklog_task1` (`task_id` ASC) ,
  CONSTRAINT `fk_tbacklog_sbacklog1`
    FOREIGN KEY (`sbacklog_id` )
    REFERENCES `mydb`.`sbacklog` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_tbacklog_task1`
    FOREIGN KEY (`task_id` )
    REFERENCES `mydb`.`task` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
