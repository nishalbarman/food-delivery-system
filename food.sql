-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 04:55 AM
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
(8, 'nishalbarman@gmail.com', '9101114906', 'NISHAL BARMAN', 'admin');

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
-- Table structure for table `foodcategory`
--

CREATE TABLE `foodcategory` (
  `id` int(255) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `items` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foodcategory`
--

INSERT INTO `foodcategory` (`id`, `catname`, `items`, `image`) VALUES
(1, 'Veg Items', '7', '1671346856_sharon-pittaway-KUZnfk-2DSQ-unsplash.jpg'),
(4, 'Non-Veg Items', '7', '1671369370_Street-food-non-veg.webp');

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
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fooditems`
--

INSERT INTO `fooditems` (`id`, `title`, `subtitle`, `stocks`, `amount`, `reviews`, `total-feedbacks`, `image`, `category`) VALUES
(1, 'Burger', 'Best burger of our locality we are proud', '101', 1001, 0, 0, 'burger.jpg', 'Non-Veg Items'),
(2, 'Roti', 'Best roti of our locality we are proud', '10', 100, 0, 0, 'roti.webp', 'Veg Items'),
(3, 'Fried Chicken', 'Best fried chicken of our locality we are proud', '10', 100, 0, 0, 'chicken.jpeg', 'Non-Veg Items'),
(4, 'Momos', 'Best Momos of the decade you will love it', '10', 100, 0, 0, 'momos.jpeg', 'Non-Veg Items'),
(5, 'Chicken Tandoori', 'Best of 2022 you will love it', '100', 500, 0, 0, 'chickentandori.jpg', 'Non-Veg Items'),
(6, 'Veg Pulao', 'Pulao that is awsome and will kill you.', '100', 100, 5, 100, 'vegpulao.jpg', 'Non-Veg Items'),
(8, 'Dal Vat', 'It is an assamese tradional food', '13', 154, 0, 0, '1671370105_Dal-Bhat-Tarkari-1.jpg', 'Veg Items'),
(9, 'Chicken Roll', 'This is a Calcutta-style roll in which chicken kathi (skewered) kababs are wrapped in sweet', '213', 75, 0, 0, '1671374481_roll.jpg', 'Non-Veg Items'),
(10, 'Fried Rice', 'Transform leftover rice with peas, eggs, soy sauce, and carrots. Delicious on its own, or alongside', '103', 142, 0, 0, '1671429103_79543-fried-rice-restaurant-style-mfs-51-155e83b4e4444e2292707287a56ddd93.jpg', 'Veg Items'),
(11, 'Chicken Hakka Noodles', 'Indo Chinese Chicken Hakka Noodles is a quite popular street food in India', '211', 132, 0, 0, '1671429184_Chicken-Hakka-Noodles-2-3.jpg', 'Non-Veg Items'),
(12, 'Egg Chowmein', 'This version of chowmein is popular in roadside stalls across Calcutta', '212', 213, 0, 0, '1671429633_maxresdefault.jpg', 'Veg Items'),
(13, 'Paneer Chowmein', 'For a speedy vegetarian delight', '122', 131, 0, 0, '1671429780_paneer-chowmein-copy-440x396.jpg', 'Veg Items'),
(14, 'Chicken Chowmein', 'A super tasty Chicken Chow Mein with succulent pieces of marinated chicken and lots of fresh veggies ...', '123', 132, 0, 0, '1671429833_chicken_chow_mein_recipe_card.jpg', 'Non-Veg Items');

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
(181, '9101114906', 'Nishal', 'Fried Chicken', 'Best fried chicken of our locality we are proud', 'chicken.jpeg', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', 100, '8845750d827f0f39d217', 'Prepaid', 'Delivered', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', '15/12/2022 10:52:59 am', 'nishalbarman@gmail.com'),
(182, '9101114906', 'Nishal', 'Roti', 'Best roti of our locality we are proud', 'roti.webp', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', 100, 'c8448cd92519f7d3679f', 'Prepaid', 'Pending', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', '18/12/2022 10:14:24 am', 'nishalbarman@gmail.com'),
(183, '9101114906', 'Nishal', 'Roti', 'Best roti of our locality we are proud', 'roti.webp', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', 100, '0b73dbef4595d2a8dea8', 'Prepaid', 'Pending', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', '19/12/2022 11:38:43 am', 'nishalbarman@gmail.com'),
(184, '9101114906', 'Nishal', 'Burger', 'Best burger of our locality we are proud', 'burger.jpg', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', 100, '8b002c2e45ea346907d1', 'Prepaid', 'Pending', 'Vill. P.O. - Balikaria  Nalbari  Nalbari - Kaithalkuchi Road', '20/12/2022 09:18:40 am', 'nishalbarman@gmail.com');

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
(9, '9101114906', 'NISHAL BARMAN', '', '2510', 'password', 'nishalbarman@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `veg items`
--

CREATE TABLE `veg items` (
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
-- Dumping data for table `veg items`
--

INSERT INTO `veg items` (`id`, `title`, `subtitle`, `stocks`, `amount`, `reviews`, `total-feedbacks`, `image`) VALUES
(1, 'Burger', 'Best burger of our locality we are proud', '10', 100, 0, 0, 'burger.jpg'),
(2, 'Roti', 'Best roti of our locality we are proud', '10', 100, 0, 0, 'roti.webp'),
(3, 'Fried Chicken', 'Best fried chicken of our locality we are proud', '10', 100, 0, 0, 'chicken.jpeg'),
(4, 'Momos', 'Best Momos of the decade you will love it', '10', 100, 0, 0, 'momos.jpeg'),
(5, 'Chicken Tandoori', 'Best of 2022 you will love it', '100', 500, 0, 0, 'chickentandori.jpg'),
(6, 'Veg Pulao', 'Pulao that is awsome and will kill you.', '100', 100, 5, 100, 'vegpulao.jpg');

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
-- Indexes for table `foodcategory`
--
ALTER TABLE `foodcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `catname` (`catname`);

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
-- AUTO_INCREMENT for table `foodcategory`
--
ALTER TABLE `foodcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fooditems`
--
ALTER TABLE `fooditems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
