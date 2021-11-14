-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2021 at 06:08 AM
-- Server version: 10.6.4-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuckbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuckbook_profiles`
--

CREATE TABLE `fuckbook_profiles` (
  `school` varchar(255) DEFAULT NULL,
  `sex` int(8) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `hometown` text DEFAULT NULL,
  `highschool` varchar(255) DEFAULT NULL,
  `screenname` varchar(255) DEFAULT NULL,
  `mobile` int(8) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fuckbook_users`
--

CREATE TABLE `fuckbook_users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(8) NOT NULL,
  `id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuckbook_profiles`
--
ALTER TABLE `fuckbook_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuckbook_users`
--
ALTER TABLE `fuckbook_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuckbook_users`
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
