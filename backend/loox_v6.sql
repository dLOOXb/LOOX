-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2017 at 11:53 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `LOOX`
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
-- Table structure for table `bokadeTider`
--

CREATE TABLE `bokadeTider` (
  `id` int(11) NOT NULL,
  `namn` varchar(65) NOT NULL,
  `detaljer` varchar(255) NOT NULL,
  `tid` varchar(10) NOT NULL,
  `behandlareID` int(11) NOT NULL,
  `skapadeDen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Salt` varchar(31) COLLATE utf8_swedish_ci NOT NULL,
  `lossenord` varchar(500) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `klass` enum('kund','frisor','agare','admin') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `inlogg`
--

INSERT INTO `inlogg` (`id`, `anvandarnamn`, `namn`, `efternamn`, `email`, `Salt`, `lossenord`, `tel`, `klass`) VALUES
(1, 'test', 'Maria', 'Hej', 'hello@test.se', '', 'öcqöo4tyerphjpe', '035036047', 'frisor');

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
  `salongnamn` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_swedish_ci NOT NULL,
  `tel` varchar(15) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `salong`
--

INSERT INTO `salong` (`id`, `salongnamn`, `email`, `tel`) VALUES
(1, 'Den testande salongen', 'hello@test.se', '035036047');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `anvandarnamn` varchar(70) COLLATE utf8_swedish_ci NOT NULL,
  `salt` varchar(31) COLLATE utf8_swedish_ci NOT NULL,
  `lossenord` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(542) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `anvandarnamn`, `salt`, `lossenord`, `email`) VALUES
(1, 'hej', '7Shz5u09LpQp9w27dtS7mbVwndccio9', '6e14dfeabbccc9825c1d2328155cf944cf134a0fbcb6b47a13f431b7f1008a661b07bafe8dc34c0a7047b16fc8ce00bc85f57e6bd29c04799ec720e366a60c7f', 'hej@test.se'),
(2, 'Gustav', '0aaeKRzKfuktaeLy8x4zRQdJe3Lz8yn', '9f54b4b069394fdd59894a5cdc3b33c2d6994c76053212092f82798ad6d74b42e70d7a37caab03a2237caa413565dd8c5c9538c1687e29392b34931b5b9f62a5', 'gustav@test.se'),
(3, 'Anna', '77e4cd8bf54f0c1299daaf9498c52c3', 'Q6x6gzLtc9eemQVbbKot9KRu75RVuc6', 'anna@test.se'),
(4, 'user', '7cbb7b06d301f1d7822cac8bc58bd22', '0biKxi6cpnK55a5Lxa93y3fz7dSxgg0', 'user@test.se');

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
-- Indexes for table `bokadeTider`
--
ALTER TABLE `bokadeTider`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
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
-- AUTO_INCREMENT for table `bokadeTider`
--
ALTER TABLE `bokadeTider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inlogg`
--
ALTER TABLE `inlogg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `karta`
--
ALTER TABLE `karta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `salong`
--
ALTER TABLE `salong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;