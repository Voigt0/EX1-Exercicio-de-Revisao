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
-- Table `biblioteca`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`cliente` (
  `CLI_ID` INT NOT NULL AUTO_INCREMENT,
  `CLI_NOME` VARCHAR(45) NULL,
  `CLI_SOBRENOME` VARCHAR(45) NULL,
  `CLI_NASCIMENTO` DATE NULL,
  `CLI_TELEFONE` VARCHAR(45) NULL,
  `CLI_CPF` VARCHAR(45) NULL,
  `CLI_EMAIL` VARCHAR(45) NULL,
  `CLI_SENHA` VARCHAR(45) NULL,
  PRIMARY KEY (`CLI_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`endereco`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`endereco` (
  `END_ID` INT NOT NULL AUTO_INCREMENT,
  `END_ESTADO` VARCHAR(45) NULL,
  `END_CIDADE` VARCHAR(45) NULL,
  `END_RUA` VARCHAR(45) NULL,
  `END_NUMERO` INT NULL,
  `CLI_ID` INT NOT NULL,
  PRIMARY KEY (`END_ID`),
  CONSTRAINT `fk_endereco_cliente1`
    FOREIGN KEY (`CLI_ID`)
    REFERENCES `biblioteca`.`cliente` (`CLI_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biblioteca`.`editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `EDI_ID` INT NOT NULL AUTO_INCREMENT,
  `EDI_NOME` VARCHAR(45) NULL,
  `EDI_FUNDACAO` DATE NULL,
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
  `TIT_LANCAMENTO` DATE NULL,
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
  `EXE_ID` INT NOT NULL AUTO_INCREMENT,
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
  `TIT_ID` INT NOT NULL,
  `GEN_ID` INT NOT NULL,
  PRIMARY KEY (`TIT_ID`, `GEN_ID`),
  CONSTRAINT `fk_titulo_has_genero_titulo1`
    FOREIGN KEY (`TIT_ID`)
    REFERENCES `biblioteca`.`titulo` (`TIT_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_titulo_has_genero_genero1`
    FOREIGN KEY (`GEN_ID`)
    REFERENCES `biblioteca`.`genero` (`GEN_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`) VALUES ('Rodrigo', 'Voigt Filho', '2005-06-28', '47 991456541', '080.913.333-09', 'voigtrodrigo0@gmail.com');
INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`) VALUES ('Célio', 'Adriel', '2005-05-23', '47 991457432', '080.913.333-09', 'celio@gmail.com');
INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`) VALUES ('Vinicius', 'da Silva', '1999-04-24', '47 991458782', '080.913.333-09', 'vinicius@gmail.com');
INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`) VALUES ('Larissa', 'Schmitz', '2002-03-25', '47 991451233', '080.913.333-09', 'larissa@gmail.com');
INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`) VALUES ('Guilherme', 'Dias', '2000-10-26', '47 991454123', '080.913.333-09', 'guilherme@gmail.com');

INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('Leya', '2001-01-01', 'Roberto', 'Vitória');
INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('Abril', '2001-01-01', 'Ricardo', 'Curitiba');
INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('Pendragon', '2000-01-01', 'Rogério', 'São Paulo');
INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('Saraiva', '1999-01-01', 'Alexandre', 'Rio de Janeiro');
INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('Arqueiro', '1998-01-01', 'Fabricio', 'Rio de Janeiro');

INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('Terror');
INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('Suspense');
INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('Drama');
INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('Comédia');
INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('Ação');

INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('Dom Casmuro', 'Machado de Asis', '245', 'Português', '1998-01-01', '1');
INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('1984', 'George Orwell', '316', 'Inglês', '1996-01-01', '3');
INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('Extraordinário', 'August Pullman', '216', 'Português', '1995-01-01', '4');
INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('Fahrenheit 451', 'Ray Bradbury', '230', 'Português', '1995-01-01', '5');
INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('Daisy Jones and The Six', 'Taylor Jenkins Reid', '200', 'Inglês', '2010-01-01', '2');

INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('1');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('1');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('2');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('3');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('4');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('5');
INSERT INTO `biblioteca`.`exemplar` (`TIT_ID`) VALUES ('4');

INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('Santa Catarina', 'Joinvile', 'Almirante Moacir', '244', '1');
INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('Paraná', 'Curitiba', 'Prefeito Gomes', '867', '2');
INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('Santa Catarina', 'Blumenau', 'Capitão José', '542', '3');
INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('Santa Catarina', 'Rio do Sul', 'Prefeito João', '324', '4');
INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('Rio Grande do Sul', 'Torres', 'Almirante Maria', '931', '5');

INSERT INTO `biblioteca`.`emprestimo` (`EMP_ENTRADA`, `EMP_SAIDA`, `CLI_ID`, `EXE_ID`) VALUES ('2022-03-10', '2022-03-15', '1', '1');
INSERT INTO `biblioteca`.`emprestimo` (`EMP_ENTRADA`, `EMP_SAIDA`, `CLI_ID`, `EXE_ID`) VALUES ('2022-03-06', '2022-03-14', '2', '2');
INSERT INTO `biblioteca`.`emprestimo` (`EMP_ENTRADA`, `EMP_SAIDA`, `CLI_ID`, `EXE_ID`) VALUES ('2022-03-07', '2022-03-13', '3', '3');
INSERT INTO `biblioteca`.`emprestimo` (`EMP_ENTRADA`, `EMP_SAIDA`, `CLI_ID`, `EXE_ID`) VALUES ('2022-03-08', '2022-03-12', '4', '4');
INSERT INTO `biblioteca`.`emprestimo` (`EMP_ENTRADA`, `EMP_SAIDA`, `CLI_ID`, `EXE_ID`) VALUES ('2022-03-09', '2022-03-11', '1', '5');

INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('1', '1');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('1', '2');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('2', '1');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('2', '4');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('3', '3');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('3', '4');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('4', '5');
INSERT INTO `biblioteca`.`tit_gen` (`TIT_ID`, `GEN_ID`) VALUES ('4', '1');

UPDATE `biblioteca`.`cliente` SET `CLI_SENHA` = '123456789' WHERE (`CLI_ID` = '1');
UPDATE `biblioteca`.`cliente` SET `CLI_SENHA` = '123456789' WHERE (`CLI_ID` = '3');
UPDATE `biblioteca`.`cliente` SET `CLI_SENHA` = '123456789' WHERE (`CLI_ID` = '5');
UPDATE `biblioteca`.`cliente` SET `CLI_SENHA` = '987654321' WHERE (`CLI_ID` = '4');
UPDATE `biblioteca`.`cliente` SET `CLI_SENHA` = '987654321' WHERE (`CLI_ID` = '2');
