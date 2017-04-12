-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2017 at 01:26 
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'zahidin', '$2y$10$iWl6iPxgnbY0u0rKOEx0Qe3FWbHWOvzAmmPbOFXnW8eogES7iNI6S', 1),
(2, 'udin', '$2y$10$gByO8uZ8wAPid6kDE2M8A.hUN/bIRRiXU6Z1ogdCqOI5oWIzft3ZG', 0),
(25, 'jarwo', '$2y$10$K2QehfMRZWb4Q1rqMmmlC.GkIYMemLiqn7dMSl.mB6rmKsKFLp8mm', 0),
(26, 'zibran', '$2y$10$Y9qnJ7qAORqmOUTD0pKGh.wju0pu.5FEvtUr7mQrJ6FL8H8jr22SC', 0),
(29, 'arig', '$2y$10$4J/Gy.JntSvXmUZLAAw3yeZfA9gLCecBFvHlxVT/1DC0NbXra8C1.', 0),
(33, 'husni', '$2y$10$bOX6F.bHffW2g6LAIai/QOJZ5DIvM135./Hv37CPbFubeuktQxDxi', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
