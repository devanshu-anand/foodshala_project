-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2019 at 06:04 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_signup`
--

CREATE TABLE `customer_signup` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_food_preference` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_signup`
--

INSERT INTO `customer_signup` (`customer_id`, `customer_name`, `customer_food_preference`, `customer_email`, `customer_address`, `customer_password`, `customer_table_name`) VALUES
(5, 'Devanshu', 'non-veg', 'deva@deva.com', 'paschim puri', '87e8019e53a824ca97900710efdb7f5b731f309237c91479244659c87b62dcff', 'Devanshu');

-- --------------------------------------------------------

--
-- Table structure for table `devanshu_orders`
--

CREATE TABLE `devanshu_orders` (
  `customer_order_id` int(11) NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_price` int(11) NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `devanshu_orders`
--

INSERT INTO `devanshu_orders` (`customer_order_id`, `dish_name`, `restaurant_name`, `dish_price`, `dish_image_dir`, `order_status`) VALUES
(1, 'salad', 'Tikka Junction', 120, 'img_uploads/5c73b23b5984a6.09906704.png', 'send_to_restaurant'),
(2, 'Chicken Kabab', 'Nandos', 230, 'img_uploads/5c73b3354ae776.16444892.png', 'send_to_restaurant'),
(3, 'Afgani Chicken', 'Nandos', 480, 'img_uploads/5c73b3049b0f01.49681254.png', 'send_to_restaurant'),
(4, '5 Season Italian Pizza', 'Nandos', 390, 'img_uploads/5c73b3b068dce9.05722281.png', 'send_to_restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `nandos_delivered_orders`
--

CREATE TABLE `nandos_delivered_orders` (
  `restaurant_delivered_order_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dish_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nandos_delivered_orders`
--

INSERT INTO `nandos_delivered_orders` (`restaurant_delivered_order_id`, `customer_name`, `customer_address`, `dish_name`, `dish_image_dir`, `dish_price`) VALUES
(1, 'Devanshu', 'paschim puri', 'Chicken Kabab', 'img_uploads/5c73b3354ae776.16444892.png', 230);

-- --------------------------------------------------------

--
-- Table structure for table `nandos_restaurant_menu`
--

CREATE TABLE `nandos_restaurant_menu` (
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dish_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_price` float NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nandos_restaurant_menu`
--

INSERT INTO `nandos_restaurant_menu` (`dish_id`, `dish_name`, `dish_type`, `dish_description`, `dish_price`, `dish_image_dir`, `restaurant_id`) VALUES
(1, 'Afgani Chicken', 'Non-Veg', 'Rosted Afgani Chicken', 480, 'img_uploads/5c73b3049b0f01.49681254.png', 13),
(2, 'Chicken Kabab', 'Non-Veg', 'Roasted Chicken Kabab', 230, 'img_uploads/5c73b3354ae776.16444892.png', 13),
(3, 'Lettuce Salad', 'Veg', 'Green Leafy Salad', 130, 'img_uploads/5c73b362180301.41659374.png', 13),
(4, '5 Season Italian Pizza', 'Veg', 'Cheesy Pizza with 5 seasoning toppings !!', 390, 'img_uploads/5c73b3b068dce9.05722281.png', 13);

-- --------------------------------------------------------

--
-- Table structure for table `nandos_restaurant_orders`
--

CREATE TABLE `nandos_restaurant_orders` (
  `restaurant_order_id` int(11) NOT NULL,
  `customer_order_id` int(11) NOT NULL,
  `customer_order_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dish_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nandos_restaurant_orders`
--

INSERT INTO `nandos_restaurant_orders` (`restaurant_order_id`, `customer_order_id`, `customer_order_table_name`, `customer_name`, `customer_address`, `dish_name`, `dish_image_dir`, `dish_price`) VALUES
(2, 5, ' Devanshu_orders ', 'Devanshu', 'paschim puri', 'Afgani Chicken', 'img_uploads/5c73b3049b0f01.49681254.png', 480),
(3, 5, ' Devanshu_orders ', 'Devanshu', 'paschim puri', '5 Season Italian Pizza', 'img_uploads/5c73b3b068dce9.05722281.png', 390);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_signup`
--

CREATE TABLE `restaurant_signup` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `restaurant_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `restaurant_signup`
--

INSERT INTO `restaurant_signup` (`restaurant_id`, `restaurant_name`, `restaurant_email`, `restaurant_address`, `restaurant_password`, `restaurant_table_name`) VALUES
(12, 'Tikka Junction', 'tikka@tikka.com', 'punjabi bagh', '87e8019e53a824ca97900710efdb7f5b731f309237c91479244659c87b62dcff', 'Tikka_Junction'),
(13, 'Nandos', 'nandos@nandos.com', 'punjabi bagh', '87e8019e53a824ca97900710efdb7f5b731f309237c91479244659c87b62dcff', 'Nandos');

-- --------------------------------------------------------

--
-- Table structure for table `tikka_junction_delivered_orders`
--

CREATE TABLE `tikka_junction_delivered_orders` (
  `restaurant_delivered_order_id` int(11) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dish_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tikka_junction_delivered_orders`
--

INSERT INTO `tikka_junction_delivered_orders` (`restaurant_delivered_order_id`, `customer_name`, `customer_address`, `dish_name`, `dish_image_dir`, `dish_price`) VALUES
(1, 'Devanshu', 'paschim puri', 'salad', 'img_uploads/5c73b23b5984a6.09906704.png', 120);

-- --------------------------------------------------------

--
-- Table structure for table `tikka_junction_restaurant_menu`
--

CREATE TABLE `tikka_junction_restaurant_menu` (
  `dish_id` int(11) NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dish_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_price` float NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tikka_junction_restaurant_menu`
--

INSERT INTO `tikka_junction_restaurant_menu` (`dish_id`, `dish_name`, `dish_type`, `dish_description`, `dish_price`, `dish_image_dir`, `restaurant_id`) VALUES
(1, 'Tandoori Chicken', 'Non-Veg', 'Roasted Tandoori chicken', 430, 'img_uploads/5c73b2176b60f2.77946420.png', 12),
(2, 'salad', 'Veg', 'Green Leafy Salad', 120, 'img_uploads/5c73b23b5984a6.09906704.png', 12),
(3, 'Mutton Kabab', 'Non-Veg', 'Roasted Mutton Kabab', 270, 'img_uploads/5c73b274aa2261.80094653.png', 12),
(4, 'Margaretta Pizza', 'Veg', 'Cheesy Margeretta Pizza', 360, 'img_uploads/5c73b2a747eee3.81131284.png', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tikka_junction_restaurant_orders`
--

CREATE TABLE `tikka_junction_restaurant_orders` (
  `restaurant_order_id` int(11) NOT NULL,
  `customer_order_id` int(11) NOT NULL,
  `customer_order_table_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dish_image_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dish_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_signup`
--
ALTER TABLE `customer_signup`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email_index` (`customer_email`);

--
-- Indexes for table `devanshu_orders`
--
ALTER TABLE `devanshu_orders`
  ADD PRIMARY KEY (`customer_order_id`);

--
-- Indexes for table `nandos_delivered_orders`
--
ALTER TABLE `nandos_delivered_orders`
  ADD PRIMARY KEY (`restaurant_delivered_order_id`);

--
-- Indexes for table `nandos_restaurant_menu`
--
ALTER TABLE `nandos_restaurant_menu`
  ADD PRIMARY KEY (`dish_id`);

--
-- Indexes for table `nandos_restaurant_orders`
--
ALTER TABLE `nandos_restaurant_orders`
  ADD PRIMARY KEY (`restaurant_order_id`);

--
-- Indexes for table `restaurant_signup`
--
ALTER TABLE `restaurant_signup`
  ADD PRIMARY KEY (`restaurant_id`),
  ADD UNIQUE KEY `restaurant_email_index` (`restaurant_email`);

--
-- Indexes for table `tikka_junction_delivered_orders`
--
ALTER TABLE `tikka_junction_delivered_orders`
  ADD PRIMARY KEY (`restaurant_delivered_order_id`);

--
-- Indexes for table `tikka_junction_restaurant_menu`
--
ALTER TABLE `tikka_junction_restaurant_menu`
  ADD PRIMARY KEY (`dish_id`);

--
-- Indexes for table `tikka_junction_restaurant_orders`
--
ALTER TABLE `tikka_junction_restaurant_orders`
  ADD PRIMARY KEY (`restaurant_order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_signup`
--
ALTER TABLE `customer_signup`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `devanshu_orders`
--
ALTER TABLE `devanshu_orders`
  MODIFY `customer_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nandos_restaurant_menu`
--
ALTER TABLE `nandos_restaurant_menu`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nandos_restaurant_orders`
--
ALTER TABLE `nandos_restaurant_orders`
  MODIFY `restaurant_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurant_signup`
--
ALTER TABLE `restaurant_signup`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tikka_junction_restaurant_menu`
--
ALTER TABLE `tikka_junction_restaurant_menu`
  MODIFY `dish_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tikka_junction_restaurant_orders`
--
ALTER TABLE `tikka_junction_restaurant_orders`
  MODIFY `restaurant_order_id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table customer_signup
--

--
-- Metadata for table devanshu_orders
--

--
-- Metadata for table nandos_delivered_orders
--

--
-- Metadata for table nandos_restaurant_menu
--

--
-- Metadata for table nandos_restaurant_orders
--

--
-- Metadata for table restaurant_signup
--

--
-- Metadata for table tikka_junction_delivered_orders
--

--
-- Metadata for table tikka_junction_restaurant_menu
--

--
-- Metadata for table tikka_junction_restaurant_orders
--

--
-- Metadata for database db_foodshala
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
