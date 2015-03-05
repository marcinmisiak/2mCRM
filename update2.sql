SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS `mjkr`.`klient` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'KLIENT (FIRMA)' /* comment truncated */ /*- Pełna nazwa
- Adres rejestracji (Ulica i numer, Kod, Miasto, Kraj)
- NIP
- Regon
- Nr KRS lub ewidencji
- Adres www
- e-mail (ogólny)
- Status (prospekt / klient)
- Notatki o kliencie
- Opiekun klienta (account)
- Usługi zamówione
- Dokumenty (oferty, specyfikacje, umowy, …)
- Lista zadań związanych z klientem
- Rozmowa kończąca*/,
  `nazwa` VARCHAR(200) NOT NULL COMMENT 'nazwa firmy',
  `adrrej_adres` VARCHAR(200) NULL DEFAULT NULL,
  `adrrej_kod` VARCHAR(6) NULL DEFAULT NULL,
  `adrrej_miasto` VARCHAR(50) NULL DEFAULT NULL,
  `adrrej_kraj` VARCHAR(45) NULL DEFAULT NULL,
  `nip` VARCHAR(20) NULL DEFAULT NULL,
  `regon` VARCHAR(20) NULL DEFAULT NULL,
  `krs` VARCHAR(20) NULL DEFAULT NULL,
  `www` VARCHAR(250) NULL DEFAULT NULL,
  `email` VARCHAR(250) NULL DEFAULT NULL,
  `notatka` TEXT NULL DEFAULT NULL,
  `rozmowa_konczaca` TINYINT(1) NULL DEFAULT 0,
  `status_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_klient_status1_idx` (`status_id` ASC),
  CONSTRAINT `fk_klient_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `mjkr`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`osoba` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'osoba od klienta',
  `imie` VARCHAR(24) NULL DEFAULT NULL,
  `nazwisko` VARCHAR(30) NULL DEFAULT NULL,
  `telefon` VARCHAR(15) NULL DEFAULT NULL,
  `telefon_kom` VARCHAR(15) NULL DEFAULT NULL,
  `email` VARCHAR(200) NULL DEFAULT NULL,
  `email_pryw` VARCHAR(200) NULL DEFAULT NULL,
  `email_sl` VARCHAR(200) NULL DEFAULT NULL,
  `aktywny` TINYINT(1) NULL DEFAULT 1 COMMENT 'nie odbiera telefonow nie aktywny',
  PRIMARY KEY (`id`),
  INDEX `indexNazwEmail` (`nazwisko` ASC, `email` ASC),
  INDEX `aktywny` (`aktywny` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`klient_has_osoba` (
  `klient_id` INT(11) NOT NULL,
  `osoba_id` INT(11) NOT NULL,
  PRIMARY KEY (`klient_id`, `osoba_id`),
  INDEX `fk_klient_has_osoba_osoba1_idx` (`osoba_id` ASC),
  INDEX `fk_klient_has_osoba_klient1_idx` (`klient_id` ASC),
  CONSTRAINT `fk_klient_has_osoba_klient1`
    FOREIGN KEY (`klient_id`)
    REFERENCES `mjkr`.`klient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_klient_has_osoba_osoba1`
    FOREIGN KEY (`osoba_id`)
    REFERENCES `mjkr`.`osoba` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa` VARCHAR(45) NULL DEFAULT NULL COMMENT 'status klient/prospekt',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`kontakt_historia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dataczas` DATETIME NOT NULL COMMENT 'Zapisywanie informacji o kontaktach z klientem/prospektem',
  `opis` TEXT NULL DEFAULT NULL,
  `dalsze_dzialanie` VARCHAR(100) NULL DEFAULT NULL,
  `kontakt_sposob_id` INT(11) NOT NULL,
  `kontakt_status_id` INT(11) NOT NULL,
  `osoba_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_kontakt_historia_kontakt_sposob1_idx` (`kontakt_sposob_id` ASC),
  INDEX `fk_kontakt_historia_kontakt_status1_idx` (`kontakt_status_id` ASC),
  INDEX `fk_kontakt_historia_osoba1_idx` (`osoba_id` ASC),
  CONSTRAINT `fk_kontakt_historia_kontakt_sposob1`
    FOREIGN KEY (`kontakt_sposob_id`)
    REFERENCES `mjkr`.`kontakt_sposob` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kontakt_historia_kontakt_status1`
    FOREIGN KEY (`kontakt_status_id`)
    REFERENCES `mjkr`.`kontakt_status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kontakt_historia_osoba1`
    FOREIGN KEY (`osoba_id`)
    REFERENCES `mjkr`.`osoba` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`kontakt_sposob` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa` VARCHAR(45) NULL DEFAULT NULL COMMENT '(telefoniczne, mailowe)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`kontakt_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa` VARCHAR(45) NULL DEFAULT NULL COMMENT ' rodzaj statusu kontaktu (próby połaczeń, zły numer, odmowa, zainteresowany, klient)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`uslugi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa` VARCHAR(45) NULL DEFAULT NULL,
  `opis` TEXT NULL DEFAULT NULL,
  `tuslugi_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_uslugi_tuslugi1_idx` (`tuslugi_id` ASC),
  CONSTRAINT `fk_uslugi_tuslugi1`
    FOREIGN KEY (`tuslugi_id`)
    REFERENCES `mjkr`.`tuslugi` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`klient_has_domains` (
  `klient_id` INT(11) NOT NULL,
  `domains_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`klient_id`, `domains_id`),
  INDEX `fk_klient_has_domains_domains1_idx` (`domains_id` ASC),
  INDEX `fk_klient_has_domains_klient1_idx` (`klient_id` ASC),
  CONSTRAINT `fk_klient_has_domains_klient1`
    FOREIGN KEY (`klient_id`)
    REFERENCES `mjkr`.`klient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_klient_has_domains_domains1`
    FOREIGN KEY (`domains_id`)
    REFERENCES `mjkr`.`domains` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`klient_has_uslugi` (
  `klient_id` INT(11) NOT NULL,
  `uslugi_id` INT(11) NOT NULL,
  `data_od` DATE NULL DEFAULT NULL COMMENT 'dane finansowe (zamówione usługi z datami, prognozy przedłużeń usług abonamentowych z datami',
  `data_do` DATE NULL DEFAULT NULL,
  `kwota` DECIMAL NULL DEFAULT NULL,
  `zaplacone` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`klient_id`, `uslugi_id`),
  INDEX `fk_klient_has_uslugi_uslugi1_idx` (`uslugi_id` ASC),
  INDEX `fk_klient_has_uslugi_klient1_idx` (`klient_id` ASC),
  CONSTRAINT `fk_klient_has_uslugi_klient1`
    FOREIGN KEY (`klient_id`)
    REFERENCES `mjkr`.`klient` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_klient_has_uslugi_uslugi1`
    FOREIGN KEY (`uslugi_id`)
    REFERENCES `mjkr`.`uslugi` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`przypomnienia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa` VARCHAR(45) NULL DEFAULT NULL,
  `data` DATE NULL DEFAULT NULL,
  `aktualne` TINYINT(1) NULL DEFAULT 1,
  `users_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_przypomnienia_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_przypomnienia_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mjkr`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mjkr`.`tuslugi` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT ' podział na usługi (jednorazowe, abonamentowe – miesięczne, kwartalne, roczne)',
  `nazwa` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

DROP TABLE IF EXISTS `mjkr`.`uzytkownik` ;

DROP TABLE IF EXISTS `mjkr`.`funkcja` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
