CREATE TABLE `ticketCategory` (
	`categoryId` INT(11) NOT NULL AUTO_INCREMENT,
	`subject` VARCHAR(45) NOT NULL COLLATE 'utf8_unicode_ci',
	`sortkey` SMALLINT(6) NOT NULL,
	`active` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`categoryId`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `ticketSubject` (
	`ticketId` INT(11) NOT NULL AUTO_INCREMENT,
	`ticketCategory_categoryId` INT(11) NULL DEFAULT NULL,
	`usrId` INT(11) NULL DEFAULT NULL,
	`subject` VARCHAR(45) NOT NULL COLLATE 'utf8_unicode_ci',
	`type` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`created` DATETIME NOT NULL,
	`last_edit` DATETIME NOT NULL,
	PRIMARY KEY (`ticketId`),
	INDEX `IDX_B7028AAE55FCDEAA` (`usrId`),
	INDEX `IDX_B7028AAE50E446A1` (`ticketCategory_categoryId`),
	CONSTRAINT `FK_B7028AAE50E446A1` FOREIGN KEY (`ticketCategory_categoryId`) REFERENCES `ticketCategory` (`categoryId`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `ticketEntry` (
	`ticketEntryId` INT(11) NOT NULL AUTO_INCREMENT,
	`ticketSubject_ticketId` INT(11) NULL DEFAULT NULL,
	`usrId` INT(11) NULL DEFAULT NULL,
	`memo` LONGTEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`created` DATETIME NOT NULL,
	PRIMARY KEY (`ticketEntryId`),
	INDEX `IDX_851ED75757FD53C5` (`ticketSubject_ticketId`),
	INDEX `IDX_851ED75755FCDEAA` (`usrId`),
	CONSTRAINT `FK_851ED75757FD53C5` FOREIGN KEY (`ticketSubject_ticketId`) REFERENCES `ticketSubject` (`ticketId`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;
