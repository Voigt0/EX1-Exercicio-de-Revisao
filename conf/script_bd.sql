-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `biblioteca` ;

-- -----------------------------------------------------
-- Table `biblioteca`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`endereco` (
  `END_ID` INT NOT NULL AUTO_INCREMENT,
  `END_ESTADO` VARCHAR(45) NULL,
  `END_CIDADE` VARCHAR(45) NULL,
  `END_RUA` VARCHAR(45) NULL,
  `END_NUMERO` INT NULL,
  PRIMARY KEY (`END_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`cliente` (
  `CLI_ID` INT NOT NULL AUTO_INCREMENT,
  ` CLI_NOME` VARCHAR(45) NULL,
  `CLI_SOBRENOME` VARCHAR(45) NULL,
  `CLI_NASCIMENTO` DATE NULL,
  `CLI_TELEFONE` VARCHAR(45) NULL,
  `CLI_CPF` VARCHAR(45) NULL,
  `CLI_EMAIL` VARCHAR(45) NULL,
  `END_ID` INT NOT NULL,
  PRIMARY KEY (`CLI_ID`),
  CONSTRAINT `fk_cliente_endereco`
    FOREIGN KEY (`END_ID`)
    REFERENCES `biblioteca`.`endereco` (`END_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `EDI_ID` INT NOT NULL AUTO_INCREMENT,
  `EDI_NOME` VARCHAR(45) NULL,
  `EDI_FUNDACAO` YEAR(4) NULL,
  `EDI_FUNDADOR` VARCHAR(45) NULL,
  `EDI_SEDE` VARCHAR(45) NULL,
  PRIMARY KEY (`EDI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`titulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`titulo` (
  `TIT_ID` INT NOT NULL AUTO_INCREMENT,
  `TIT_NOME` VARCHAR(45) NULL,
  `TIT_AUTOR` VARCHAR(45) NULL,
  `TIT_NUMEROPAG` INT NULL,
  `TIT_IDIOMA` VARCHAR(45) NULL,
  `TIT_LANCAMENTO` YEAR(4) NULL,
  `EDI_ID` INT NOT NULL,
  PRIMARY KEY (`TIT_ID`),
  CONSTRAINT `fk_titulo_editora1`
    FOREIGN KEY (`EDI_ID`)
    REFERENCES `biblioteca`.`editora` (`EDI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`exemplar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`exemplar` (
  `EXE_ID` INT NOT NULL,
  `TIT_ID` INT NOT NULL,
  PRIMARY KEY (`EXE_ID`),
  CONSTRAINT `fk_exemplar_titulo1`
    FOREIGN KEY (`TIT_ID`)
    REFERENCES `biblioteca`.`titulo` (`TIT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`emprestimo` (
  `EMP_ID` INT NOT NULL AUTO_INCREMENT,
  `EMP_ENTRADA` DATE NULL,
  `EMP_SAIDA` DATE NULL,
  `CLI_ID` INT NOT NULL,
  `EXE_ID` INT NOT NULL,
  PRIMARY KEY (`EMP_ID`),
  CONSTRAINT `fk_emprestimo_cliente1`
    FOREIGN KEY (`CLI_ID`)
    REFERENCES `biblioteca`.`cliente` (`CLI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_exemplar1`
    FOREIGN KEY (`EXE_ID`)
    REFERENCES `biblioteca`.`exemplar` (`EXE_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`genero`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`genero` (
  `GEN_ID` INT NOT NULL AUTO_INCREMENT,
  `GEN_NOME` VARCHAR(45) NULL,
  PRIMARY KEY (`GEN_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`tit_gen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`tit_gen` (
  `titulo_TIT_ID` INT NOT NULL,
  `genero_GEN_ID` INT NOT NULL,
  PRIMARY KEY (`titulo_TIT_ID`, `genero_GEN_ID`),
  CONSTRAINT `fk_titulo_has_genero_titulo1`
    FOREIGN KEY (`titulo_TIT_ID`)
    REFERENCES `biblioteca`.`titulo` (`TIT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_titulo_has_genero_genero1`
    FOREIGN KEY (`genero_GEN_ID`)
    REFERENCES `biblioteca`.`genero` (`GEN_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
