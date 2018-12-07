-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2018 at 10:44 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 5.6.34-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tinklu_proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `Darbo_laikas`
--

CREATE TABLE `Darbo_laikas` (
  `Pradzia` time NOT NULL,
  `Pabaiga` time NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Darbo_laikas`
--

INSERT INTO `Darbo_laikas` (`Pradzia`, `Pabaiga`, `id`) VALUES
('08:00:00', '08:30:00', 1),
('08:30:00', '09:00:00', 2),
('09:00:00', '09:30:00', 3),
('09:30:00', '10:00:00', 4),
('10:00:00', '10:30:00', 5),
('10:30:00', '11:00:00', 6),
('11:00:00', '11:30:00', 7),
('11:30:00', '12:00:00', 8),
('12:00:00', '12:30:00', 9),
('12:30:00', '13:00:00', 10),
('13:00:00', '13:30:00', 11),
('13:30:00', '14:00:00', 12),
('14:00:00', '14:30:00', 13),
('14:30:00', '15:00:00', 14),
('15:00:00', '15:30:00', 15),
('15:30:00', '16:00:00', 16),
('16:00:00', '16:30:00', 17),
('16:30:00', '17:00:00', 18),
('17:00:00', '17:30:00', 19),
('17:30:00', '18:00:00', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Kontora`
--

CREATE TABLE `Kontora` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Adresas` varchar(255) NOT NULL,
  `Telefono_nr` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Kontora`
--

INSERT INTO `Kontora` (`Pavadinimas`, `Adresas`, `Telefono_nr`, `id`) VALUES
('Kontora1', 'Kontoros g. 1', '8612313213', 1),
('Kontora2', 'Kontoros g. 2', '8612313213', 2),
('Kontora3', 'Kontoros g. 3', '8612313215', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Paslauga`
--

CREATE TABLE `Paslauga` (
  `Pavadinimas` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Paslauga`
--

INSERT INTO `Paslauga` (`Pavadinimas`, `id`) VALUES
('Konsultacija', 1),
('Skyrybos', 2),
('Skolos isieskojimas', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Registracija`
--

CREATE TABLE `Registracija` (
  `Vizito_laikas` date NOT NULL,
  `id` int(11) NOT NULL,
  `id_Paslauga` int(11) NOT NULL,
  `id_Specialistas` varchar(32) NOT NULL,
  `id_Vartotojas` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Registracija`
--

INSERT INTO `Registracija` (`Vizito_laikas`, `id`, `id_Paslauga`, `id_Specialistas`, `id_Vartotojas`) VALUES
('2018-12-05', 6, 1, '6df71962a88430ee7c918e49ee9fc77c', 'ace8c655fd37a4f2c19afb3aefecd1ec');

-- --------------------------------------------------------

--
-- Table structure for table `Specialistas`
--

CREATE TABLE `Specialistas` (
  `Vardas` varchar(255) NOT NULL,
  `Pavarde` varchar(255) NOT NULL,
  `Telefono_nr` varchar(255) NOT NULL,
  `e_pastas` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `userlevel` int(3) NOT NULL,
  `id` varchar(32) NOT NULL,
  `id_Kontora` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Specialistas`
--

INSERT INTO `Specialistas` (`Vardas`, `Pavarde`, `Telefono_nr`, `e_pastas`, `Login`, `Password`, `userlevel`, `id`, `id_Kontora`) VALUES
('Jonas', 'Jonas', '8612313212', 'Jonas@gmail.com', 'jonas', '15f271a91f875a2cad35cb8196b79e72', 5, '6df71962a88430ee7c918e49ee9fc77c', 3),
('Rokas', 'Arbaciauskas', '86123151', 'Rokas@gmail.com', 'rokas', 'aa5ab69751b1dba24d2d9ed1192a8a3d', 5, 'ace8c655fd37a4f2c19afb3aefecd1ec', 2),
('Simas', 'Paskauskas', '862496390', 'admin@gmail.com', 'admin', '6e5b5410415bde908bd4dee15dfb167a', 9, 'b80215826d66de41638136b4a7c5d3a0', 1),
('Petras', 'Petras', '8624123132', 'petras@gmail.com', 'petras', 'db5c34a252f7c1a1206a594da810584c', 4, 'fb13c1373d9f0c1efa09d1cd832aba50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Specialistu_laikas`
--

CREATE TABLE `Specialistu_laikas` (
  `id` int(11) NOT NULL,
  `Diena` date NOT NULL,
  `id_Darbo_laikas` int(11) NOT NULL,
  `id_Specialistas` varchar(32) NOT NULL,
  `id_Vartotojas` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Specialistu_laikas`
--

INSERT INTO `Specialistu_laikas` (`id`, `Diena`, `id_Darbo_laikas`, `id_Specialistas`, `id_Vartotojas`) VALUES
(3, '2018-12-01', 7, 'b80215826d66de41638136b4a7c5d3a0', 'fb13c1373d9f0c1efa09d1cd832aba50'),
(6, '2018-12-01', 6, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(7, '2018-12-01', 5, 'b80215826d66de41638136b4a7c5d3a0', 'b80215826d66de41638136b4a7c5d3a0'),
(8, '2018-12-05', 7, 'b80215826d66de41638136b4a7c5d3a0', 'fb13c1373d9f0c1efa09d1cd832aba50'),
(9, '2018-12-05', 6, 'b80215826d66de41638136b4a7c5d3a0', 'b80215826d66de41638136b4a7c5d3a0'),
(10, '2018-12-05', 5, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(11, '2018-12-05', 4, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(12, '2018-12-05', 8, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(13, '2018-12-05', 9, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(14, '2018-12-05', 10, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(15, '2018-12-07', 4, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(17, '2018-12-07', 6, 'b80215826d66de41638136b4a7c5d3a0', 'b80215826d66de41638136b4a7c5d3a0'),
(18, '2018-12-07', 7, 'b80215826d66de41638136b4a7c5d3a0', 'b80215826d66de41638136b4a7c5d3a0'),
(19, '2018-12-07', 8, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(20, '2018-12-07', 9, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(21, '2018-12-07', 10, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(22, '2018-12-07', 3, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(23, '2018-12-05', 3, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(26, '2018-12-05', 11, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(27, '2018-12-05', 12, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(28, '2018-12-05', 13, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(29, '2018-12-05', 14, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(30, '2018-12-07', 11, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(31, '2018-12-07', 12, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(32, '2018-12-07', 13, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(33, '2018-12-07', 14, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(35, '2018-12-09', 3, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(36, '2018-12-09', 4, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(37, '2018-12-09', 5, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(38, '2018-12-09', 6, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(39, '2018-12-09', 7, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(40, '2018-12-09', 8, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(41, '2018-12-09', 9, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(42, '2018-12-09', 10, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(43, '2018-12-09', 11, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(44, '2018-12-09', 12, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(45, '2018-12-09', 13, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(46, '2018-12-09', 14, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(47, '2018-12-10', 10, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(50, '2018-12-05', 15, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(51, '2018-12-05', 16, 'b80215826d66de41638136b4a7c5d3a0', NULL),
(52, '2018-12-01', 8, 'b80215826d66de41638136b4a7c5d3a0', 'fb13c1373d9f0c1efa09d1cd832aba50'),
(53, '2018-12-07', 5, 'b80215826d66de41638136b4a7c5d3a0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Specialistu_paslaugos`
--

CREATE TABLE `Specialistu_paslaugos` (
  `id` int(11) NOT NULL,
  `id_Specialistas` varchar(32) NOT NULL,
  `id_Paslauga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Specialistu_paslaugos`
--

INSERT INTO `Specialistu_paslaugos` (`id`, `id_Specialistas`, `id_Paslauga`) VALUES
(1, '6df71962a88430ee7c918e49ee9fc77c', 1),
(2, 'ace8c655fd37a4f2c19afb3aefecd1ec', 2),
(4, 'ace8c655fd37a4f2c19afb3aefecd1ec', 3),
(6, 'fb13c1373d9f0c1efa09d1cd832aba50', 1),
(11, 'b80215826d66de41638136b4a7c5d3a0', 2),
(12, 'b80215826d66de41638136b4a7c5d3a0', 1),
(13, 'b80215826d66de41638136b4a7c5d3a0', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Darbo_laikas`
--
ALTER TABLE `Darbo_laikas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Kontora`
--
ALTER TABLE `Kontora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Paslauga`
--
ALTER TABLE `Paslauga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Registracija`
--
ALTER TABLE `Registracija`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_Paslauga` (`id_Paslauga`),
  ADD UNIQUE KEY `id_Specialistas` (`id_Specialistas`),
  ADD UNIQUE KEY `id_Vartotojas` (`id_Vartotojas`);

--
-- Indexes for table `Specialistas`
--
ALTER TABLE `Specialistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Kontora` (`id_Kontora`);

--
-- Indexes for table `Specialistu_laikas`
--
ALTER TABLE `Specialistu_laikas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Darbo_laikas` (`id_Darbo_laikas`),
  ADD KEY `id_Specialistas` (`id_Specialistas`),
  ADD KEY `vartoja` (`id_Vartotojas`);

--
-- Indexes for table `Specialistu_paslaugos`
--
ALTER TABLE `Specialistu_paslaugos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_Specialistas` (`id_Specialistas`),
  ADD KEY `id_Paslauga` (`id_Paslauga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Darbo_laikas`
--
ALTER TABLE `Darbo_laikas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Kontora`
--
ALTER TABLE `Kontora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Paslauga`
--
ALTER TABLE `Paslauga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Registracija`
--
ALTER TABLE `Registracija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `Specialistu_laikas`
--
ALTER TABLE `Specialistu_laikas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `Specialistu_paslaugos`
--
ALTER TABLE `Specialistu_paslaugos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Registracija`
--
ALTER TABLE `Registracija`
  ADD CONSTRAINT `Registracija_ibfk_1` FOREIGN KEY (`id_Paslauga`) REFERENCES `Paslauga` (`id`),
  ADD CONSTRAINT `Registracija_ibfk_2` FOREIGN KEY (`id_Specialistas`) REFERENCES `Specialistas` (`id`),
  ADD CONSTRAINT `Registracija_ibfk_3` FOREIGN KEY (`id_Vartotojas`) REFERENCES `Specialistas` (`id`);

--
-- Constraints for table `Specialistas`
--
ALTER TABLE `Specialistas`
  ADD CONSTRAINT `Specialistas_ibfk_1` FOREIGN KEY (`id_Kontora`) REFERENCES `Kontora` (`id`);

--
-- Constraints for table `Specialistu_laikas`
--
ALTER TABLE `Specialistu_laikas`
  ADD CONSTRAINT `Specialistu_laikas_ibfk_1` FOREIGN KEY (`id_Darbo_laikas`) REFERENCES `Darbo_laikas` (`id`),
  ADD CONSTRAINT `Specialistu_laikas_ibfk_2` FOREIGN KEY (`id_Specialistas`) REFERENCES `Specialistas` (`id`),
  ADD CONSTRAINT `Specialistu_laikas_ibfk_3` FOREIGN KEY (`id_Vartotojas`) REFERENCES `Specialistas` (`id`);

--
-- Constraints for table `Specialistu_paslaugos`
--
ALTER TABLE `Specialistu_paslaugos`
  ADD CONSTRAINT `Specialistu_paslaugos_ibfk_1` FOREIGN KEY (`id_Specialistas`) REFERENCES `Specialistas` (`id`),
  ADD CONSTRAINT `Specialistu_paslaugos_ibfk_2` FOREIGN KEY (`id_Paslauga`) REFERENCES `Paslauga` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
