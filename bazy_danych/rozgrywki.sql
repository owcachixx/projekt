-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2026 at 11:44 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rozgrywki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyna`
--

CREATE TABLE `druzyna` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mecz`
--

CREATE TABLE `mecz` (
  `id` int(11) NOT NULL,
  `druzyna_1` int(11) NOT NULL,
  `druzyna_2` int(11) DEFAULT NULL,
  `wynik_druzyna_1` int(11) NOT NULL DEFAULT 0,
  `wynik_druzyna_2` int(11) NOT NULL DEFAULT 0,
  `sedzia` int(11) NOT NULL,
  `sedzia_asystent_1` int(11) NOT NULL,
  `sedzia_asystent_2` int(11) NOT NULL,
  `turniej_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sedzia`
--

CREATE TABLE `sedzia` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `turniej`
--

CREATE TABLE `turniej` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `nazwa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `udzial`
--

CREATE TABLE `udzial` (
  `id` int(11) NOT NULL,
  `id_druzyna` int(11) NOT NULL,
  `id_turniej` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `druzyna`
--
ALTER TABLE `druzyna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `mecz`
--
ALTER TABLE `mecz`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `Mecz_fk1` (`druzyna_1`),
  ADD KEY `Mecz_fk2` (`druzyna_2`),
  ADD KEY `Mecz_fk5` (`sedzia`),
  ADD KEY `Mecz_fk6` (`sedzia_asystent_1`),
  ADD KEY `Mecz_fk7` (`sedzia_asystent_2`),
  ADD KEY `Mecz_fk8` (`turniej_id`);

--
-- Indeksy dla tabeli `sedzia`
--
ALTER TABLE `sedzia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `turniej`
--
ALTER TABLE `turniej`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `udzial`
--
ALTER TABLE `udzial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `Udzial_fk1` (`id_turniej`),
  ADD KEY `Udzial_fk2` (`id_druzyna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `druzyna`
--
ALTER TABLE `druzyna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mecz`
--
ALTER TABLE `mecz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sedzia`
--
ALTER TABLE `sedzia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `turniej`
--
ALTER TABLE `turniej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `udzial`
--
ALTER TABLE `udzial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mecz`
--
ALTER TABLE `mecz`
  ADD CONSTRAINT `Mecz_fk1` FOREIGN KEY (`druzyna_1`) REFERENCES `druzyna` (`id`),
  ADD CONSTRAINT `Mecz_fk2` FOREIGN KEY (`druzyna_2`) REFERENCES `druzyna` (`id`),
  ADD CONSTRAINT `Mecz_fk5` FOREIGN KEY (`sedzia`) REFERENCES `sedzia` (`id`),
  ADD CONSTRAINT `Mecz_fk6` FOREIGN KEY (`sedzia_asystent_1`) REFERENCES `sedzia` (`id`),
  ADD CONSTRAINT `Mecz_fk7` FOREIGN KEY (`sedzia_asystent_2`) REFERENCES `sedzia` (`id`),
  ADD CONSTRAINT `Mecz_fk8` FOREIGN KEY (`turniej_id`) REFERENCES `turniej` (`id`);

--
-- Constraints for table `udzial`
--
ALTER TABLE `udzial`
  ADD CONSTRAINT `Udzial_fk1` FOREIGN KEY (`id_turniej`) REFERENCES `turniej` (`id`),
  ADD CONSTRAINT `Udzial_fk2` FOREIGN KEY (`id_druzyna`) REFERENCES `druzyna` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
