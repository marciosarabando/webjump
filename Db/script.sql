-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema webjump
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema webjump
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `webjump` DEFAULT CHARACTER SET utf8 ;
USE `webjump` ;

-- -----------------------------------------------------
-- Table `webjump`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webjump`.`produto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `sku` VARCHAR(9) NULL,
  `descricao` VARCHAR(255) NULL,
  `quantidade` INT NULL,
  `preco` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webjump`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webjump`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NULL,
  `nome` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `webjump`.`produtocategoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `webjump`.`produtocategoria` (
  `produto_id` INT NOT NULL,
  `categoria_id` INT NOT NULL,
  PRIMARY KEY (`produto_id`, `categoria_id`),
  INDEX `fk_ProdutosCategorias_Categorias1_idx` (`categoria_id` ASC),
  CONSTRAINT `fk_ProdutosCategorias_Produtos`
    FOREIGN KEY (`produto_id`)
    REFERENCES `webjump`.`produto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ProdutosCategorias_Categorias1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `webjump`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
