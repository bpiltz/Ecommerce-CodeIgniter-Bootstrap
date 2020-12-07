-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netzwerk`
--

-- --------------------------------------------------------

--
-- Table structure for table `vendor_profile_translations`
--

CREATE TABLE `vendor_profile_translations` (
  `id` int NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `vendor_profile_translations`
--
ALTER TABLE `vendor_profile_translations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendor_profile_translations`
--
ALTER TABLE `vendor_profile_translations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

-- --------------------------------------------------------


ALTER TABLE `vendors` 
ADD `street` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `password`, 
ADD `number` VARCHAR(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `street`, 
ADD `city` VARCHAR(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `number`, 
ADD `post_code` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `city`, 
ADD `country` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `post_code`, 
ADD `phone` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `country`, 
ADD `mobile` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `phone`, 
ADD `website` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `mobile`, 
ADD `telegram` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `website`, 
ADD `profile_image` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `telegram`, 
ADD `surname` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `name`, 
ADD `gender` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `profile_image`, 
ADD `birthday` DATE NOT NULL AFTER `gender`;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





