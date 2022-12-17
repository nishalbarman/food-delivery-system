-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 05:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `phone`, `name`, `password`) VALUES
(8, 'nishalbarman@gmail.com', '9101114906', 'NISHAL BARMAN', '@NishalBoss21');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `title`, `image`, `value`) VALUES
(1, 'Burger', 'burger.jpg', '[value-4]'),
(2, 'Roti', 'roti.webp', '[value-4]'),
(3, 'Fried Chicken', 'chicken.jpeg', 'chicken'),
(4, 'Momos', 'momos.jpeg', 'momos');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `foodid` bigint(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `likes` bigint(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fooditems`
--

CREATE TABLE `fooditems` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `stocks` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `reviews` int(255) NOT NULL,
  `total-feedbacks` int(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fooditems`
--

INSERT INTO `fooditems` (`id`, `title`, `subtitle`, `stocks`, `amount`, `reviews`, `total-feedbacks`, `image`) VALUES
(1, 'Burger', 'Best burger of our locality we are proud', '10', 100, 0, 0, 'burger.jpg'),
(2, 'Roti', 'Best roti of our locality we are proud', '10', 100, 0, 0, 'roti.webp'),
(3, 'Fried Chicken', 'Best fried chicken of our locality we are proud', '10', 100, 0, 0, 'chicken.jpeg'),
(4, 'Momos', 'Best Momos of the decade you will love it', '10', 100, 0, 0, 'momos.jpeg'),
(5, 'Chicken Tandoori', 'Best of 2022 you will love it', '100', 500, 0, 0, 'chickentandori.jpg'),
(6, 'Veg Pulao', 'Pulao that is awsome and will kill you.', '100', 100, 5, 100, 'vegpulao.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `foodtitle` varchar(255) NOT NULL,
  `foodsubtitle` varchar(255) NOT NULL,
  `foodimage` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `amount` bigint(255) NOT NULL,
  `transactionid` varchar(255) NOT NULL,
  `ordertype` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `phone`, `fname`, `foodtitle`, `foodsubtitle`, `foodimage`, `address`, `amount`, `transactionid`, `ordertype`, `status`, `location`, `date`, `email`) VALUES
(181, '9101114906', 'Nishal', 'Fried Chicken', 'Best fried chicken of our locality we are proud', 'chicken.jpeg', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', 100, '8845750d827f0f39d217', 'Prepaid', 'Pending', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', '15/12/2022 10:52:59 am', 'nishalbarman@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone`, `fname`, `lname`, `address`, `password`, `email`) VALUES
(1, '9101114906', 'Nishal', 'Barman', 'Vill./P.O. - Balikaria, Nalbari, Nalbari - Kaithalkuchi Road', '@NishalBoss21', 'nishalbarman@gmail.com'),
(7, '8473825675', 'NISHAL', 'BARMAN', 'Vill./P.O. - Balikaria, Nalbari, Nalbari - Kaithalkuchi Road', '@NishalBoss21', 'nishalbarman1@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fooditems`
--
ALTER TABLE `fooditems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fooditems`
--
ALTER TABLE `fooditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
