-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 02, 2017 at 02:13 PM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `loox_v2`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behandligar`
--
ALTER TABLE `behandligar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `behandligar`
--
ALTER TABLE `behandligar`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;