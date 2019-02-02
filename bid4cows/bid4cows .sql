-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2018 at 03:37 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bid4cows`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int(40) NOT NULL,
  `price` int(11) NOT NULL,
  `bidCount` int(11) NOT NULL,
  `viewCount` int(11) NOT NULL,
  `averageIncrement` int(11) NOT NULL,
  `endDate` datetime NOT NULL,
  `description` text NOT NULL,
  `details` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `cowID` int(11) NOT NULL,
  `highestID` int(11) NOT NULL,
  `minimum` int(11) NOT NULL,
  `location` text NOT NULL,
  `type` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `price`, `bidCount`, `viewCount`, `averageIncrement`, `endDate`, `description`, `details`, `ownerID`, `cowID`, `highestID`, `minimum`, `location`, `type`, `active`) VALUES
(23, 3000, 0, 0, 0, '2018-09-09 00:00:00', '', 0, 7, 470, 0, 560, 'Cape Town', 'nguni', 0),
(24, 45000, 2, 0, 0, '2018-12-08 00:00:00', '', 0, 8, 471, 6, 550, 'Mowbray Avenue, 7700', 'nguni', 0),
(25, 54000, 2, 0, 0, '2018-09-13 00:00:00', '', 0, 7, 472, 6, 300, 'Cape Town', 'nguni', 0),
(26, 85000, 2, 0, 0, '2018-09-08 00:00:00', '', 0, 8, 473, 7, 40000, 'Mowbray Avenue, 7700', 'nguni', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `auctionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cattleID` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `endDate` datetime NOT NULL,
  `highestID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `auctionID`, `userID`, `cattleID`, `price`, `endDate`, `highestID`) VALUES
(38, 24, 6, 471, 45000, '2018-12-08 00:00:00', 6),
(39, 26, 6, 473, 44000, '2018-09-08 00:00:00', 7),
(40, 26, 7, 473, 85000, '2018-09-08 00:00:00', 7),
(42, 25, 6, 472, 54000, '2018-09-13 00:00:00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cattle`
--

CREATE TABLE `cattle` (
  `id` int(11) NOT NULL,
  `ownerID` int(11) NOT NULL,
  `name` text NOT NULL,
  `age` int(11) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `image` text NOT NULL,
  `foodType` text NOT NULL,
  `previousOwner` text NOT NULL,
  `uncestors` text NOT NULL,
  `type` text NOT NULL,
  `image1` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cattle`
--

INSERT INTO `cattle` (`id`, `ownerID`, `name`, `age`, `description`, `address`, `image`, `foodType`, `previousOwner`, `uncestors`, `type`, `image1`) VALUES
(468, 7, 'Braaman', 4, 'This cow is fat and fertile and behaves nice', 'Cape Town', 'images/', 'grass', '2', '0', '', 'images/depositphotos_33983119-stock-photo-herd-of-nguni-cattle.jpg'),
(469, 6, 'Django', 12, 'Beautiful cow', 'Free State', 'images/download.jpg', 'grass', '0', '0', 'nguni', 'images/download (1).jpg'),
(470, 7, 'Groomah', 34, 'This is another cow', 'Cape Town', 'images/77images (12).jpeg', 'Grass', '0', '0', 'nguni', 'images/77download (2).jpeg'),
(471, 8, 'Bramani', 30, 'Healthy cow', 'Mowbray Avenue, 7700', 'images/88C847EF93-8AE7-4A31-8D0F-65F28A91258B.jpeg', 'Nguni', '1', '2', 'nguni', 'images/889ED43718-8D21-451A-804D-982C1947369F.jpeg'),
(472, 7, 'Mulisa', 2, 'New nice cow', 'Cape Town', 'images/7Mulisadownload (2).jpeg', 'Grass', '0', '0', 'nguni', 'images/7Mulisaimages (11).jpeg'),
(473, 8, 'Ringi', 33, 'Helthy ', 'Mowbray Avenue, 7700', 'images/8Ringi61E5B179-E369-4082-A59C-F970F4F441D0.jpeg', 'Roots', '7', '8', 'nguni', 'images/8Ringi0CF066C3-56B5-402D-BC8D-C1059D9E0207.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `foodType` text NOT NULL,
  `previousOwner` text NOT NULL,
  `uncestors` text NOT NULL,
  `cowID` int(11) NOT NULL,
  `auctionID` int(11) NOT NULL,
  `image` text NOT NULL,
  `image1` text NOT NULL,
  `end` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`foodType`, `previousOwner`, `uncestors`, `cowID`, `auctionID`, `image`, `image1`, `end`) VALUES
('grass', '2', '0', 468, 0, 'images/', 'images/depositphotos_33983119-stock-photo-herd-of-nguni-cattle.jpg', 0),
('Grass', '0', '0', 470, 0, 'images/77images (12).jpeg', 'images/77download (2).jpeg', 0),
('Nguni', '1', '2', 471, 0, 'images/88C847EF93-8AE7-4A31-8D0F-65F28A91258B.jpeg', 'images/889ED43718-8D21-451A-804D-982C1947369F.jpeg', 0),
('Grass', '0', '0', 472, 0, 'images/7Mulisadownload (2).jpeg', 'images/7Mulisaimages (11).jpeg', 0),
('Roots', '7', '8', 473, 0, 'images/8Ringi61E5B179-E369-4082-A59C-F970F4F441D0.jpeg', 'images/8Ringi0CF066C3-56B5-402D-BC8D-C1059D9E0207.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(11) NOT NULL,
  `auctionID` int(11) NOT NULL,
  `one` int(11) NOT NULL,
  `two` int(11) NOT NULL,
  `three` int(11) NOT NULL,
  `four` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` int(11) NOT NULL,
  `description` text NOT NULL,
  `cattleNo` int(11) NOT NULL,
  `bidsNo` int(11) NOT NULL,
  `auctionNo` int(11) NOT NULL,
  `username` text NOT NULL,
  `address` text NOT NULL,
  `zipcode` int(11) NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `description`, `cattleNo`, `bidsNo`, `auctionNo`, `username`, `address`, `zipcode`, `city`, `country`, `avatar`) VALUES
(6, 'Thembiso Ragimana', 'thembiso40@gmail.com', 12345, '', 0, 3, 1, '', '', 0, '', '', 'images/messi.jpg'),
(7, 'Given Ndou', 'given@gmail.com', 12345, '', 2, 2, 2, '', '', 0, '', '', 'images/IMG_20180822_205426.jpg'),
(8, 'Fhulufhelo mamali', 'mamalefhulufhelo@gmail.com', 1111, '', 2, 0, 2, '', '', 0, '', '', 'images/image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `cattle`
--
ALTER TABLE `cattle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `cattle`
--
ALTER TABLE `cattle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
