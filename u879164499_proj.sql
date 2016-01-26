-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2016, 18:07
-- Wersja serwera: 10.1.9-MariaDB
-- Wersja PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `u879164499_proj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `admin_login` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `admin_haslo` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`admin_login`, `admin_haslo`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `forma_zajec`
--

CREATE TABLE `forma_zajec` (
  `id_forma_zajec` int(11) NOT NULL,
  `forma_zajec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_prowadzacy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `forma_zajec`
--

INSERT INTO `forma_zajec` (`id_forma_zajec`, `forma_zajec`, `id_prowadzacy`) VALUES
(3, 'projekt', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `priorytet`
--

CREATE TABLE `priorytet` (
  `id_priorytet` int(11) NOT NULL,
  `id_projekt` int(11) NOT NULL,
  `id_wniosek` int(11) NOT NULL,
  `priorytet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekt`
--

CREATE TABLE `projekt` (
  `id_projekt` int(11) NOT NULL,
  `wielkosc_grupy` int(11) NOT NULL,
  `temat_projektu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_przedmiot` int(11) NOT NULL,
  `id_forma_zajec` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `projekt`
--

INSERT INTO `projekt` (`id_projekt`, `wielkosc_grupy`, `temat_projektu`, `id_przedmiot`, `id_forma_zajec`) VALUES
(5, 2, 'Zapisy na projekty', 11, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prowadzacy`
--

CREATE TABLE `prowadzacy` (
  `id_prowadzacy` int(11) NOT NULL,
  `prowadzacy_imie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prowadzacy_nazwisko` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prowadzacy_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prowadzacy_haslo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `prowadzacy`
--

INSERT INTO `prowadzacy` (`id_prowadzacy`, `prowadzacy_imie`, `prowadzacy_nazwisko`, `prowadzacy_login`, `prowadzacy_haslo`) VALUES
(5, '', '', '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709'),
(4, 'Tomasz', 'Rak', 'trak', '83f178b94b9c53129d026f7218e754d09e9f029a'),
(6, 'gandzia123', 'gandzia123', 'Rafal', '04c5f03e123bac65012fc7b4a330778c8d201fdc');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `id_przedmiot` int(11) NOT NULL,
  `nazwa_przedmiotu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_prowadzacy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `przedmiot`
--

INSERT INTO `przedmiot` (`id_przedmiot`, `nazwa_przedmiotu`, `id_prowadzacy`) VALUES
(11, 'Aplikacje Internetowe', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `student`
--

CREATE TABLE `student` (
  `id_student` int(11) NOT NULL,
  `student_imie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_nazwisko` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_grupa_laboratoryjna` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_grupa_projektowa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_haslo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `student`
--

INSERT INTO `student` (`id_student`, `student_imie`, `student_nazwisko`, `student_grupa_laboratoryjna`, `student_grupa_projektowa`, `student_login`, `student_haslo`) VALUES
(6, 'seba', 'halo', 'L^', 'P6', 'seba', '5548b9e1beea83fb5d0f2bc81cd5933e8289beab');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wniosek`
--

CREATE TABLE `wniosek` (
  `id_wniosek` int(11) NOT NULL,
  `wniosek_status` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `wniosek_komentarz` longtext COLLATE utf8_unicode_ci NOT NULL,
  `id_student` int(11) NOT NULL,
  `liczba_grupy` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_login`);

--
-- Indexes for table `forma_zajec`
--
ALTER TABLE `forma_zajec`
  ADD PRIMARY KEY (`id_forma_zajec`),
  ADD KEY `idx_forma_zajec__id_prowadzacy` (`id_prowadzacy`);

--
-- Indexes for table `priorytet`
--
ALTER TABLE `priorytet`
  ADD PRIMARY KEY (`id_priorytet`),
  ADD KEY `idx_priorytet__id_projekt` (`id_projekt`),
  ADD KEY `idx_priorytet__id_wniosek` (`id_wniosek`);

--
-- Indexes for table `projekt`
--
ALTER TABLE `projekt`
  ADD PRIMARY KEY (`id_projekt`),
  ADD KEY `idx_projekt__id_forma_zajec` (`id_forma_zajec`),
  ADD KEY `idx_projekt__id_przedmiot` (`id_przedmiot`);

--
-- Indexes for table `prowadzacy`
--
ALTER TABLE `prowadzacy`
  ADD PRIMARY KEY (`id_prowadzacy`);

--
-- Indexes for table `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`id_przedmiot`),
  ADD KEY `idx_przedmiot__id_prowadzacy` (`id_prowadzacy`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`);

--
-- Indexes for table `wniosek`
--
ALTER TABLE `wniosek`
  ADD PRIMARY KEY (`id_wniosek`),
  ADD KEY `idx_wniosek__id_student` (`id_student`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `forma_zajec`
--
ALTER TABLE `forma_zajec`
  MODIFY `id_forma_zajec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `priorytet`
--
ALTER TABLE `priorytet`
  MODIFY `id_priorytet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `projekt`
--
ALTER TABLE `projekt`
  MODIFY `id_projekt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `prowadzacy`
--
ALTER TABLE `prowadzacy`
  MODIFY `id_prowadzacy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `id_przedmiot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `wniosek`
--
ALTER TABLE `wniosek`
  MODIFY `id_wniosek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
