-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 26, 2024 alle 18:32
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Agora`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comment`
--

CREATE TABLE `comment` (
  `idComment` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `creation_time` datetime NOT NULL,
  `removed` tinyint(1) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `idImage` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `types` varchar(255) NOT NULL,
  `imageData` longblob NOT NULL,
  `idPost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `image`
--

INSERT INTO `image` (`idImage`, `name`, `size`, `types`, `imageData`, `idPost`) VALUES
(1, 'default', 0, 'image/png', 0x64656661756c74, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `likes`
--

CREATE TABLE `likes` (
  `idLike` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `moderator`
--

CREATE TABLE `moderator` (
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `moderator`
--

INSERT INTO `moderator` (`idUser`) VALUES
(1);

-- --------------------------------------------------------

--
-- Struttura della tabella `person`
--

CREATE TABLE `person` (
  `idUser` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `discr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `person`
--

INSERT INTO `person` (`idUser`, `name`, `surname`, `year`, `email`, `password`, `username`, `discr`) VALUES
(1, 'admin', 'admin', 18, 'admin@admin', '$2y$10$peb8Brv.9OIX6XBeBDElE.DmBZ9kWGSrbKAWBdc94A5QM0BAzEJ8a', 'admin', 'moderator');

-- --------------------------------------------------------

--
-- Struttura della tabella `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `category` varchar(255) NOT NULL,
  `creation_time` datetime NOT NULL,
  `removed` tinyint(1) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `report`
--

CREATE TABLE `report` (
  `idReport` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPost` int(11) DEFAULT NULL,
  `idComment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `ban` tinyint(1) NOT NULL,
  `vip` tinyint(1) NOT NULL,
  `biography` longtext DEFAULT NULL,
  `working` varchar(255) DEFAULT NULL,
  `studiedAt` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `idImage` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `userfollow`
--

CREATE TABLE `userfollow` (
  `id` int(11) NOT NULL,
  `idFollower` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `IDX_9474526CFE6E88D7` (`idUser`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`),
  ADD KEY `IDX_C53D045F29773213` (`idPost`);

--
-- Indici per le tabelle `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`idLike`);

--
-- Indici per le tabelle `moderator`
--
ALTER TABLE `moderator`
  ADD PRIMARY KEY (`idUser`);

--
-- Indici per le tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `UNIQ_34DCD176E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_34DCD176F85E0677` (`username`);

--
-- Indici per le tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `IDX_5A8A6C8DFE6E88D7` (`idUser`);

--
-- Indici per le tabelle `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`idReport`),
  ADD KEY `IDX_C42F778429773213` (`idPost`),
  ADD KEY `IDX_C42F778484CD399E` (`idComment`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Indici per le tabelle `userfollow`
--
ALTER TABLE `userfollow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comment`
--
ALTER TABLE `comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `likes`
--
ALTER TABLE `likes`
  MODIFY `idLike` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `person`
--
ALTER TABLE `person`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `report`
--
ALTER TABLE `report`
  MODIFY `idReport` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `userfollow`
--
ALTER TABLE `userfollow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Limiti per la tabella `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F29773213` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`);

--
-- Limiti per la tabella `moderator`
--
ALTER TABLE `moderator`
  ADD CONSTRAINT `FK_6A30B268FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `person` (`idUser`) ON DELETE CASCADE;

--
-- Limiti per la tabella `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8DFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Limiti per la tabella `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK_C42F778429773213` FOREIGN KEY (`idPost`) REFERENCES `post` (`idPost`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C42F778484CD399E` FOREIGN KEY (`idComment`) REFERENCES `comment` (`idComment`) ON DELETE CASCADE;

--
-- Limiti per la tabella `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `person` (`idUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
