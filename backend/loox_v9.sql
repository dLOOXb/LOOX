-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 14, 2017 at 05:30 PM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `LOOX_v4`
--

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
  `skapadeDen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bokadetider`
--
ALTER TABLE `bokadetider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bokadetider`
--
ALTER TABLE `bokadetider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;