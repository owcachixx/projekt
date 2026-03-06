CREATE TABLE IF NOT EXISTS `Druzyna` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`nazwa` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Mecz` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`druzyna_1` int NOT NULL,
	`druzyna_2` int,
	`wynik_druzyna_1` int NOT NULL DEFAULT '0',
	`wynik_druzyna_2` int NOT NULL DEFAULT '0',
	`sedzia` int NOT NULL,
	`sedzia_asystent_1` int NOT NULL,
	`sedzia_asystent_2` int NOT NULL,
	`turniej_id` int NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Turniej` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`data` date NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Sedzia` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`imie` varchar(255) NOT NULL,
	`nazwisko` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `Udzial` (
	`id` int AUTO_INCREMENT NOT NULL UNIQUE,
	`id_druzyna` int NOT NULL,
	`id_turniej` int NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk1` FOREIGN KEY (`druzyna_1`) REFERENCES `Druzyna`(`id`);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk2` FOREIGN KEY (`druzyna_2`) REFERENCES `Druzyna`(`id`);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk5` FOREIGN KEY (`sedzia`) REFERENCES `Sedzia`(`id`);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk6` FOREIGN KEY (`sedzia_asystent_1`) REFERENCES `Sedzia`(`id`);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk7` FOREIGN KEY (`sedzia_asystent_2`) REFERENCES `Sedzia`(`id`);

ALTER TABLE `Mecz` ADD CONSTRAINT `Mecz_fk8` FOREIGN KEY (`turniej_id`) REFERENCES `Turniej`(`id`);

ALTER TABLE `Udzial` ADD CONSTRAINT `Udzial_fk1` FOREIGN KEY (`id_turniej`) REFERENCES `Turniej`(`id`);

ALTER TABLE `Udzial` ADD CONSTRAINT `Udzial_fk2` FOREIGN KEY (`id_druzyna`) REFERENCES `Druzyna`(`id`);