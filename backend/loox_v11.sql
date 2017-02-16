-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 16, 2017 at 09:21 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `LOOX_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `behandlare`
--

CREATE TABLE `behandlare` (
  `id` int(11) NOT NULL,
  `fornamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `efternamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `salongnamn` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL,
  `alias` varchar(60) COLLATE utf8_swedish_ci DEFAULT NULL,
  `titel` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `foto` varchar(2083) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'http://3.bp.blogspot.com/-FYJf-5nWvU8/UXQKqGjkt4I/AAAAAAAAMrk/hbdjl0FXlmw/s1600/1roxette.jpg',
  `info` varchar(550) COLLATE utf8_swedish_ci DEFAULT NULL,
  `instagram` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `facebook` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `twitter` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `pintrest` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `behandligar`
--

CREATE TABLE `behandligar` (
  `id` int(8) NOT NULL,
  `namn` varchar(100) NOT NULL,
  `pris` int(10) UNSIGNED NOT NULL,
  `tid_minuter` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `behandligar`
--

INSERT INTO `behandligar` (`id`, `namn`, `pris`, `tid_minuter`) VALUES
(1, 'klipp', 500, 30),
(2, 'naglar', 350, 30),
(3, 'färg', 1000, 70),
(4, 'massage', 500, 60);

-- --------------------------------------------------------

--
-- Table structure for table `bokadetider`
--

CREATE TABLE `bokadetider` (
  `id` int(11) NOT NULL,
  `namn` varchar(65) NOT NULL,
  `detaljer` varchar(255) NOT NULL,
  `tid` varchar(22) NOT NULL,
  `behandlareID` int(11) NOT NULL,
  `skapadeDen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bokadetider`
--

INSERT INTO `bokadetider` (`id`, `namn`, `detaljer`, `tid`, `behandlareID`, `skapadeDen`) VALUES
(1, 'Dummy Name', '', '2017-02-22 13.00-14.00', 0, '2017-02-14 19:15:27'),
(2, 'Dummy Name', '', '2017-02-23 11.00-12.00', 0, '2017-02-14 19:15:38'),
(3, 'Dummy Name', '', '2017-02-23 12.00-13.00', 0, '2017-02-15 06:52:46'),
(4, 'Dummy Name', '', '2017-02-16 15.00-16.00', 0, '2017-02-15 19:34:56'),
(5, 'Dummy Name', '', '2017-02-16 15.00-16.00', 0, '2017-02-15 19:36:16'),
(6, 'Dummy Name', '', '2017-02-16 15.00-16.00', 0, '2017-02-15 19:36:30'),
(7, 'Dummy Name', '', '2017-02-16 15.00-16.00', 0, '2017-02-15 19:36:52'),
(8, 'Dummy Name', '', '2017-02-16 13.00-14.00', 0, '2017-02-16 08:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `inlogg`
--

CREATE TABLE `inlogg` (
  `id` int(11) NOT NULL,
  `anvandarnamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `salongnamn` varchar(200) COLLATE utf8_swedish_ci DEFAULT NULL,
  `fornamn` varchar(60) COLLATE utf8_swedish_ci DEFAULT NULL,
  `efternamn` varchar(60) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `lossenord` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `klass` enum('kund','frisor','agare','admin') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `karta`
--

CREATE TABLE `karta` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `address` varchar(80) COLLATE utf8_swedish_ci NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `karta`
--

INSERT INTO `karta` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'Medieinstitutet', 'Kruthusgatan 17, 411 04, Göteborg', 57.7123, 11.9839, 'skola');

-- --------------------------------------------------------

--
-- Table structure for table `salong`
--

CREATE TABLE `salong` (
  `id` int(11) NOT NULL,
  `salongnamn` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `bild` varchar(8032) COLLATE utf8_swedish_ci DEFAULT NULL,
  `info` varchar(550) COLLATE utf8_swedish_ci DEFAULT NULL,
  `url` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `gata` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `postnummer` varchar(10) COLLATE utf8_swedish_ci NOT NULL,
  `ort` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `instagram` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `facebook` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `twitter` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL,
  `pintrest` varchar(2083) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `salong`
--

INSERT INTO `salong` (`id`, `salongnamn`, `bild`, `info`, `url`, `email`, `tel`, `gata`, `postnummer`, `ort`, `instagram`, `facebook`, `twitter`, `pintrest`) VALUES
(1, 'Den testande salongen', NULL, NULL, NULL, 'hello@test.se', '035036047', 'Testgatan 3', '000 00', 'Ort', 'insta', 'fb.fb', 'bird', 'hej'),
(3, 'Salong PostNord', NULL, 'Vi klipper, stylar, gör hårförlängningar och mycket mer. Vi säljer även smycken. Välkommen in för att titta mer.', 'www.postnord.se/salong', 'salong.postnord@comhem.se', '072929229', 'Kruthusgatan', '41459', 'Göteborg', 'insta.se', 'FB.se', 'twitter.se', 'pin.se');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behandlare`
--
ALTER TABLE `behandlare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `behandligar`
--
ALTER TABLE `behandligar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bokadetider`
--
ALTER TABLE `bokadetider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inlogg`
--
ALTER TABLE `inlogg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anvandarnamn` (`anvandarnamn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `karta`
--
ALTER TABLE `karta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salong`
--
ALTER TABLE `salong`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `behandlare`
--
ALTER TABLE `behandlare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `behandligar`
--
ALTER TABLE `behandligar`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bokadetider`
--
ALTER TABLE `bokadetider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `inlogg`
--
ALTER TABLE `inlogg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `karta`
--
ALTER TABLE `karta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `salong`
--
ALTER TABLE `salong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;