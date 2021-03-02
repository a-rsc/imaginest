<?php

try{

    $bbdd = CONFIG['BBDD_NAME'];

    $bbdd_script = "
    -- MySQL Workbench Forward Engineering

    SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
    SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
    SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

    -- -----------------------------------------------------
    -- Schema imaginest
    -- -----------------------------------------------------
    -- La BDs haurà de ser compatible amb MySQL/MariaDB
    -- La BDs s’anomenarà “imaginest” i usarà per defecte codificació UTF-8 case sensitive
    DROP SCHEMA IF EXISTS `imaginest` ;

    -- -----------------------------------------------------
    -- Schema imaginest
    --
    -- La BDs haurà de ser compatible amb MySQL/MariaDB
    -- La BDs s’anomenarà “imaginest” i usarà per defecte codificació UTF-8 case sensitive
    -- -----------------------------------------------------
    CREATE SCHEMA IF NOT EXISTS `imaginest` DEFAULT CHARACTER SET utf8 ;
    USE `imaginest` ;

    -- -----------------------------------------------------
    -- Table `imaginest`.`users`
    -- -----------------------------------------------------
    DROP TABLE IF EXISTS `imaginest`.`users` ;

    CREATE TABLE IF NOT EXISTS `imaginest`.`users` (
      `iduser` INT NOT NULL AUTO_INCREMENT,
      `username` VARCHAR(60) NOT NULL,
      `email` VARCHAR(60) NOT NULL,
      `password` CHAR(60) NOT NULL,
      `firstname` VARCHAR(60) NULL,
      `lastname` VARCHAR(120) NULL,
      `openSession` TINYINT NOT NULL DEFAULT 0,
      `lastLogin` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      `active` TINYINT NOT NULL DEFAULT 0,
      `activationDate` DATETIME NULL,
      `activationCode` CHAR(64) NULL,
      `resetPassword` TINYINT NOT NULL DEFAULT 0,
      `resetPasswordExpiry` DATETIME NULL,
      `resetPasswordCode` VARCHAR(64) NULL,
      `datetimezone` VARCHAR(100) NOT NULL DEFAULT 'Europe/London',
      `removedOn` DATETIME NULL,
      `changedOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      `createdOn` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`iduser`),
      UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
      UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
    ENGINE = InnoDB;


    -- -----------------------------------------------------
    -- Table `imaginest`.`images`
    -- -----------------------------------------------------
    DROP TABLE IF EXISTS `imaginest`.`images` ;

    CREATE TABLE IF NOT EXISTS `imaginest`.`images` (
      `idimages` INT NOT NULL AUTO_INCREMENT,
      `users_iduser` INT NOT NULL,
      `description` VARCHAR(255) NULL,
      `publicationDate` DATETIME NULL,
      `likes` INT NOT NULL DEFAULT 0,
      `dislikes` INT NOT NULL DEFAULT 0,
      `average` DECIMAL NOT NULL DEFAULT 0,
      `name` CHAR(64) NOT NULL,
      PRIMARY KEY (`idimages`),
      INDEX `fk_images_users_idx` (`users_iduser` ASC) ,
      CONSTRAINT `fk_images_users`
        FOREIGN KEY (`users_iduser`)
        REFERENCES `imaginest`.`users` (`iduser`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB;


    SET SQL_MODE=@OLD_SQL_MODE;
    SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
    SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
    ";

    $bbdd_script = $db->query($bbdd_script);
    $bbdd_script->fetchAll(PDO::FETCH_ASSOC);
    $bbdd_script->closeCursor();

}catch(PDOException $e){
    echo 'Error amb la BDs: ' . $e->getMessage();
    exit();
}
