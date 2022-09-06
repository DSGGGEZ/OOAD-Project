-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 06:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `devcompany`
--

CREATE TABLE `devcompany` (
  `iddevcompany` int(11) NOT NULL,
  `devcompanyname` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `devcompany`
--

INSERT INTO `devcompany` (`iddevcompany`, `devcompanyname`) VALUES
(0, 'Valve Corporation'),
(1, 'Nintendo'),
(2, 'SEGA'),
(3, 'Sony Corporation'),
(4, 'CAPCOM'),
(5, 'BANDAI NAMCO'),
(6, 'EA');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `idgame` int(11) NOT NULL,
  `gid` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `idgametype` int(11) NOT NULL,
  `idPlatform` int(11) NOT NULL,
  `idDevCompany` int(11) NOT NULL,
  `gamename` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`idgame`, `gid`, `idgametype`, `idPlatform`, `idDevCompany`, `gamename`, `picture`, `price`) VALUES
(1, 'MRO001', 1, 8, 1, 'MarioKart 8', 'g0001.jpg', 1690),
(4, 'BLOB001', 4, 5, 3, 'BloodBorne', 'g0004.jpg', 740),
(5, 'NFS001', 1, 7, 6, 'Need for Speed heat', 'g0003.jpg', 1250),
(6, 'DKS001', 4, 5, 1, 'DARK SOULS ', 'g0005.jpg', 732),
(7, 'DKS002', 4, 5, 5, 'DARK SOULS II', 'g0006.jpg', 296),
(8, 'DKS003', 4, 5, 5, 'DARK SOULS III', 'g0007.jpg', 529),
(9, 'EDR001', 4, 5, 5, 'Elden Ring', 'g0008.jpg', 1490);

-- --------------------------------------------------------

--
-- Table structure for table `gametype`
--

CREATE TABLE `gametype` (
  `idgametype` int(11) NOT NULL,
  `gametype` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gametype`
--

INSERT INTO `gametype` (`idgametype`, `gametype`) VALUES
(0, 'Creative'),
(1, 'Racing'),
(2, 'Fighting'),
(3, 'FPS'),
(4, 'Action Role-Play'),
(5, 'Sport'),
(6, 'MMORPG');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idmember` int(11) NOT NULL,
  `mid` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpassword` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idmember`, `mid`, `mpassword`, `mname`, `address`, `balance`) VALUES
(1, 'M64F001', '14022514', 'Chonasit Umpawan', 'ทำเนียบรัฐบาล', 1),
(2, 'M64F002', '12345678', 'Nanthapong Kongyut', '223/157', 0);

-- --------------------------------------------------------

--
-- Table structure for table `member_has_game`
--

CREATE TABLE `member_has_game` (
  `mid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `idgame` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `member_has_game`
--

INSERT INTO `member_has_game` (`mid`, `idgame`) VALUES
('0', 1),
('M64F001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `idplatform` int(11) NOT NULL,
  `platformname` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`idplatform`, `platformname`) VALUES
(0, 'Nintendo 3DS'),
(1, 'PC'),
(2, 'Playstation 1'),
(3, 'Playstation 2'),
(4, 'Playstation 3'),
(5, 'Playstation 4'),
(6, 'Playstation 5'),
(7, 'XBOX'),
(8, 'Nintendo Switch');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devcompany`
--
ALTER TABLE `devcompany`
  ADD PRIMARY KEY (`iddevcompany`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`idgame`,`gid`),
  ADD KEY `idgametype` (`idgametype`),
  ADD KEY `Game_FKIndex1` (`idDevCompany`),
  ADD KEY `Game_FKIndex3` (`idPlatform`);

--
-- Indexes for table `gametype`
--
ALTER TABLE `gametype`
  ADD PRIMARY KEY (`idgametype`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `member_has_game`
--
ALTER TABLE `member_has_game`
  ADD PRIMARY KEY (`mid`,`idgame`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`idplatform`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `idgame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`idDevCompany`) REFERENCES `devcompany` (`iddevcompany`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`idgametype`) REFERENCES `gametype` (`idgametype`),
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`idPlatform`) REFERENCES `platform` (`idplatform`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
