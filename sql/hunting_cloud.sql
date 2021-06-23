-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 23. maj 2021 ob 17.08
-- Različica strežnika: 10.4.18-MariaDB
-- Različica PHP: 8.0.3

DROP DATABASE IF EXISTS hunting_cloud;
CREATE DATABASE hunting_cloud;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `hunting_cloud`
--

-- --------------------------------------------------------

--
-- Struktura tabele `families`
--

CREATE TABLE `families` (
  `familyID` int(11) NOT NULL,
  `familyName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `families`
--

INSERT INTO `families` (`familyID`, `familyName`) VALUES
(1, 'LD Trnovo'),
(2, 'Guest'),
(3, 'LD Zemon'),
(4, 'LD Bukovica');

-- --------------------------------------------------------

--
-- Struktura tabele `history`
--

CREATE TABLE `history` (
  `userID` int(255) NOT NULL,
  `familyID` int(11) NOT NULL,
  `lokacija` varchar(255) NOT NULL,
  `datum` varchar(25) NOT NULL,
  `ura` varchar(25) NOT NULL,
  `historyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `history`
--

INSERT INTO `history` (`userID`, `familyID`, `lokacija`, `datum`, `ura`, `historyID`) VALUES
(0, 4, 'Kozlek', '21-05-2021', '22:22', 7),
(0, 4, 'Črne njive', '21-05-2021', '22:20', 8),
(0, 4, 'Črne njive', '21-05-2021', '22:22', 9),
(0, 4, 'Kozlek', '23-05-2021', '16:00', 10),
(11, 4, 'Črne njive', '23-05-2021', '17:00', 11);

-- --------------------------------------------------------

--
-- Struktura tabele `locations`
--

CREATE TABLE `locations` (
  `locationID` int(11) NOT NULL,
  `locationName` varchar(25) NOT NULL,
  `rezervirano` varchar(2) DEFAULT 'Ne',
  `rezervacijaID` int(2) DEFAULT NULL,
  `familyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `locations`
--

INSERT INTO `locations` (`locationID`, `locationName`, `rezervirano`, `rezervacijaID`, `familyID`) VALUES
(1, 'Mala Brda', 'Ne', NULL, 1),
(2, 'Kozlek', 'Ne', NULL, 4),
(3, 'Črne njive', 'Da', 39, 4),
(4, 'Novokracine', 'Ne', NULL, 3),
(5, 'Jelsane', 'Ne', NULL, 3),
(6, 'Velika Brda', 'Ne', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabele `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `familyID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `context` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `messages`
--

INSERT INTO `messages` (`ID`, `familyID`, `title`, `context`, `created`) VALUES
(8, 4, 'Lovski posvet', 'Pozdravljeni!\r\nV nedeljo  30.5.2021 bo pred lovsko kočo, posvet.\r\nLep pozdrav\r\nGospodar', '2021-05-23 15:05:32');

-- --------------------------------------------------------

--
-- Struktura tabele `rezervacija`
--

CREATE TABLE `rezervacija` (
  `rezervacijaID` int(2) NOT NULL,
  `lokacijaID` int(2) NOT NULL,
  `userID` int(2) NOT NULL,
  `familyID` int(11) NOT NULL,
  `ura` varchar(10) DEFAULT NULL,
  `datum` varchar(35) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `rezervacija`
--

INSERT INTO `rezervacija` (`rezervacijaID`, `lokacijaID`, `userID`, `familyID`, `ura`, `datum`, `created`) VALUES
(39, 3, 11, 0, '17:00', '23-05-2021', '2021-05-23 16:20:16');

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `userSurname` varchar(25) NOT NULL,
  `loginName` varchar(25) NOT NULL,
  `userPassw` varchar(25) NOT NULL,
  `familyID` int(11) NOT NULL,
  `moderator` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`userID`, `userName`, `userSurname`, `loginName`, `userPassw`, `familyID`, `moderator`) VALUES
(0, 'test', 'test', 'test', 'testtest', 4, 0),
(1, 'Marcel', 'Ujčič', 'marcel', 'marcelmarcel', 1, 0),
(2, 'janez', 'novak', 'janez', 'janez123', 1, 0),
(3, 'Matej', 'Mankoč', 'Mmatej', 'Marcel123', 1, 0),
(4, 'Guest', 'Guest', 'guest', 'guest', 2, 0),
(5, 'LD Bukovica admin', 'LD Bukovica admin', 'admin', 'adminadmin', 4, 1),
(11, 'Marcel', 'Ujčič', 'marcel13', 'marcel123', 4, 0);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`familyID`);

--
-- Indeksi tabele `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `familyID` (`familyID`);

--
-- Indeksi tabele `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationID`),
  ADD UNIQUE KEY `rezervacijaID_2` (`rezervacijaID`),
  ADD KEY `rezervacijaID` (`rezervacijaID`),
  ADD KEY `familyID` (`familyID`),
  ADD KEY `rezervacijaID_3` (`rezervacijaID`);

--
-- Indeksi tabele `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `familyID` (`familyID`);

--
-- Indeksi tabele `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD PRIMARY KEY (`rezervacijaID`),
  ADD KEY `lokacijaID` (`lokacijaID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `familyID` (`familyID`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `loginName` (`loginName`),
  ADD KEY `familyID` (`familyID`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `families`
--
ALTER TABLE `families`
  MODIFY `familyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT tabele `history`
--
ALTER TABLE `history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT tabele `locations`
--
ALTER TABLE `locations`
  MODIFY `locationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT tabele `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT tabele `rezervacija`
--
ALTER TABLE `rezervacija`
  MODIFY `rezervacijaID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`familyID`) REFERENCES `families` (`familyID`) ON UPDATE NO ACTION;

--
-- Omejitve za tabelo `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`rezervacijaID`) REFERENCES `rezervacija` (`rezervacijaID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`familyID`) REFERENCES `families` (`familyID`) ON UPDATE CASCADE;

--
-- Omejitve za tabelo `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`familyID`) REFERENCES `families` (`familyID`) ON UPDATE NO ACTION;

--
-- Omejitve za tabelo `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `rezervacija_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `locations` (`locationID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rezervacija_ibfk_2` FOREIGN KEY (`rezervacijaID`) REFERENCES `locations` (`locationID`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rezervacija_ibfk_3` FOREIGN KEY (`familyID`) REFERENCES `families` (`familyID`) ON UPDATE NO ACTION;

--
-- Omejitve za tabelo `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`familyID`) REFERENCES `families` (`familyID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
