-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2026 at 12:13 PM
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

--
-- Dumping data for table `druzyna`
--

INSERT INTO `druzyna` (`id`, `nazwa`) VALUES
(1, 'Orły Warszawa'),
(2, 'Tygrysy Kraków'),
(3, 'Wilki Gdańsk'),
(4, 'Lwy Poznań'),
(5, 'Sokoły Wrocław'),
(6, 'Pantery Łódź'),
(7, 'Jastrzębie Lublin'),
(8, 'Rekiny Szczecin'),
(9, 'Borsuki Białystok'),
(10, 'Smoki Katowice'),
(11, 'Pumy Rzeszów'),
(12, 'Lamparty Toruń'),
(13, 'Mustangi Kielce'),
(14, 'Bawoly Olsztyn'),
(15, 'Krokodyle Opole'),
(16, 'Husaria Radom'),
(17, 'Rycerze Tarnów'),
(18, 'Spartanie Koszalin'),
(19, 'Wikingowie Sopot'),
(20, 'Gladiatorzy Elbląg');

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

--
-- Dumping data for table `sedzia`
--

INSERT INTO `sedzia` (`id`, `imie`, `nazwisko`) VALUES
(1, 'Jan', 'Kowalski'),
(2, 'Piotr', 'Nowak'),
(3, 'Adam', 'Wiśniewski'),
(4, 'Tomasz', 'Wójcik'),
(5, 'Paweł', 'Kowalczyk'),
(6, 'Marek', 'Kamiński'),
(7, 'Krzysztof', 'Lewandowski'),
(8, 'Andrzej', 'Zieliński'),
(9, 'Michał', 'Szymański'),
(10, 'Grzegorz', 'Woźniak'),
(11, 'Łukasz', 'Dąbrowski'),
(12, 'Mateusz', 'Kozłowski'),
(13, 'Sebastian', 'Jankowski'),
(14, 'Rafał', 'Mazur'),
(15, 'Damian', 'Krawczyk'),
(16, 'Karol', 'Piotrowski'),
(17, 'Patryk', 'Grabowski'),
(18, 'Norbert', 'Pawlak'),
(19, 'Artur', 'Michalski'),
(20, 'Dariusz', 'Król'),
(21, 'Robert', 'Wieczorek'),
(22, 'Szymon', 'Wróbel'),
(23, 'Daniel', 'Stępień'),
(24, 'Igor', 'Baran'),
(25, 'Filip', 'Czarnecki');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mecz`
--
ALTER TABLE `mecz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sedzia`
--
ALTER TABLE `sedzia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
