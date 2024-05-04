-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: May 03, 2024 at 09:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `battle`
--

CREATE TABLE `battle` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `player1` varchar(50) NOT NULL,
  `player2` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `battle`
--

INSERT INTO `battle` (`id`, `name`, `player1`, `player2`, `description`) VALUES
(0, 'royale rumble', 'Hasindu Niran', 'Yenura Karunanayaka', 'WWE heavy weight champion');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `age` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `villege` varchar(150) NOT NULL,
  `votenumber` int(11) NOT NULL,
  `perfomance` varchar(150) NOT NULL,
  `photo` longblob NOT NULL,
  `voted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `age`, `dob`, `villege`, `votenumber`, `perfomance`, `photo`, `voted`) VALUES
(25, 'Yenura Karunanayaka', 20, '2024-05-01', 'Embilipitiya kl', 5, 'singer', 0x75706c6f6164732f363633353262373834356230655f6267312e6a7067, 0),
(26, 'Hasindu Niran', 77, '2024-05-01', 'Embilipitiya kl', 8, 'Dancer', 0x75706c6f6164732f363633353262633737356132645f343236323433322e706e67, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  `dob` date DEFAULT NULL,
  `photo` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `phone`, `password`, `dob`, `photo`) VALUES
(9, 'Hasindu', 'Niran', 'hasindu612@gmail.com', '0712356456', '123', '2024-05-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(50) NOT NULL,
  `voter` varchar(500) NOT NULL,
  `votedate` date DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `city` varchar(150) NOT NULL,
  `candidate` varchar(50) NOT NULL,
  `vote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `voter`, `votedate`, `telephone`, `comment`, `city`, `candidate`, `vote`) VALUES
(60, 'jhb', '2024-05-03', '0252257482', 'jh ', 'hbj', '1', 1),
(61, 'n', '2024-05-04', '0712356456', 'j', 'Embilipitiya kl', '1', 1),
(62, 'n', '2024-05-04', '0712356456', 'j', 'Embilipitiya kl', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
