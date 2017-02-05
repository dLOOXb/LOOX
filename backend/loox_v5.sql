-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2017 at 11:39 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `LOOX`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bokadeTider`
--
ALTER TABLE `bokadeTider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bokadeTider`
--
ALTER TABLE `bokadeTider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;