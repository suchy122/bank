-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lut 2021, 14:56
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bank`
--
CREATE DATABASE IF NOT EXISTS `bank` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bank`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id`, `login`, `haslo`) VALUES
(1, 'admin', '$2y$10$3XEpfDpEptwT84SwZI60ievpkb1nQGzs4VmdDfRl6qJkiAyvyp8WG');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `message` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `contact`
--

INSERT INTO `contact` (`id`, `imie`, `nazwisko`, `email`, `message`) VALUES
(1, 'Test', 'Test', 'test@test.com', 'Testowa wiadomość o pomoc');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `konto_z` varchar(26) COLLATE utf8_polish_ci NOT NULL,
  `nazwa_odbiorcy` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `konto_do` varchar(26) COLLATE utf8_polish_ci NOT NULL,
  `kwota` float NOT NULL,
  `tytul` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `PESEL` varchar(11) COLLATE utf8_polish_ci NOT NULL,
  `Nr_konta` varchar(26) COLLATE utf8_polish_ci NOT NULL,
  `Stan_konta` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `imie`, `nazwisko`, `email`, `PESEL`, `Nr_konta`, `Stan_konta`) VALUES
(1, 'test', '$2y$10$QvcmSr0BGhac9lCe9JJmS.2iiMj0rOJAJKzBPI83NEGffCZyK8lhy', 'Jan', 'Kowalski', 'test@test.com', '11223312345', '95720693603747540519212518', '10000');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `konto_z` (`konto_z`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Nr_konta` (`Nr_konta`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`konto_z`) REFERENCES `users` (`Nr_konta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
