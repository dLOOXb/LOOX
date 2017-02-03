-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2017 at 09:10 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `loox_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `behandlare`
--

CREATE TABLE `behandlare` (
  `id` int(11) NOT NULL,
  `namn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `efternamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `salongnamn` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `alias` varchar(60) COLLATE utf8_swedish_ci DEFAULT NULL,
  `foto` varchar(2083) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'http://3.bp.blogspot.com/-FYJf-5nWvU8/UXQKqGjkt4I/AAAAAAAAMrk/hbdjl0FXlmw/s1600/1roxette.jpg',
  `info` varchar(250) COLLATE utf8_swedish_ci DEFAULT NULL,
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
-- Table structure for table `inlogg`
--

CREATE TABLE `inlogg` (
  `id` int(11) NOT NULL,
  `anvandarnamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `namn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `efternamn` varchar(60) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `lossenord` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `klass` enum('kund','frisor','agare') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `inlogg`
--

INSERT INTO `inlogg` (`id`, `anvandarnamn`, `namn`, `efternamn`, `email`, `lossenord`, `tel`, `klass`) VALUES
(1, 'test', '', '', 'hello@test.se', 'öcqöo4tyerphjpe', '035036047', 'frisor');

-- --------------------------------------------------------

--
-- Table structure for table `salong`
--

CREATE TABLE `salong` (
  `id` int(11) NOT NULL,
  `salongnamn` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `gatuadress` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `postnummer` varchar(6) COLLATE utf8_swedish_ci NOT NULL,
  `ort` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `land` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `kontaktpersonnamn` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
-- Indexes for table `inlogg`
--
ALTER TABLE `inlogg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anvandarnamn` (`anvandarnamn`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `behandligar`
--
ALTER TABLE `behandligar`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `inlogg`
--
ALTER TABLE `inlogg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `salong`
--
ALTER TABLE `salong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;