-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 10:50 AM
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
-- Database: `product_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `type`, `image`, `created_at`) VALUES
(1, 'Samsung Galaxy S21', 'Latest Samsung flagship smartphone', 8990000.00, 'Smartphone', 'images/samsung_galaxy_s21.jpg', '2024-07-10 11:35:45'),
(2, 'Samsung Galaxy S21+', 'Samsung flagship smartphone with a larger screen', 7990000.00, 'Smartphone', 'images/samsung_galaxy_s21_plus.jpg', '2024-07-10 11:35:45'),
(3, 'Samsung Galaxy S21 Ultra', 'High-end Samsung flagship smartphone', 9990000.00, 'Smartphone', 'images/samsung_galaxy_s21_ultra.jpg', '2024-07-10 11:35:45'),
(4, 'Samsung Galaxy Note 20', 'Samsung smartphone with S Pen', 5990000.00, 'Smartphone', 'images/samsung_galaxy_note_20.jpg', '2024-07-10 11:35:45'),
(5, 'Samsung Galaxy Note 20 Ultra', 'High-end Samsung smartphone with S Pen', 6990000.00, 'Smartphone', 'images/samsung_galaxy_note_20_ultra.jpg', '2024-07-10 11:35:45'),
(6, 'Samsung Galaxy A72', 'Mid-range Samsung smartphone', 8990000.00, 'Smartphone', 'images/samsung_galaxy_a72.jpg', '2024-07-10 11:35:45'),
(7, 'Samsung Galaxy A52', 'Affordable Samsung smartphone', 8490000.00, 'Smartphone', 'images/samsung_galaxy_a52.jpg', '2024-07-10 11:35:45'),
(8, 'Samsung Galaxy A32', 'Entry-level Samsung smartphone', 6490000.00, 'Smartphone', 'images/samsung_galaxy_a32.jpg', '2024-07-10 11:35:45'),
(9, 'Samsung Galaxy Z Fold 2', 'Samsung foldable smartphone', 9990000.00, 'Smartphone', 'images/samsung_galaxy_z_fold_2.jpg', '2024-07-10 11:35:45'),
(10, 'Samsung Galaxy A14', 'Samsung foldable flip phone', 7990000.00, 'Smartphone', 'images/samsung_galaxy_a14.jpg.jpg', '2024-07-10 11:35:45'),
(11, 'Samsung Galaxy M51', 'Samsung smartphone with large battery', 9490000.00, 'Smartphone', 'images/samsung_galaxy_m51.jpg', '2024-07-10 11:35:45'),
(12, 'Samsung Galaxy M31', 'Budget Samsung smartphone with good battery life', 5990000.00, 'Smartphone', 'images/samsung_galaxy_m31.jpg', '2024-07-10 11:35:45'),
(13, 'Samsung Galaxy S20 FE', 'Fan Edition of Samsung S20 series', 15490000.00, 'Smartphone', 'images/samsung_galaxy_s20_fe.jpg', '2024-07-10 11:35:45'),
(14, 'Samsung Galaxy A12', 'Affordable Samsung smartphone', 4290000.00, 'Smartphone', 'images/samsung_galaxy_a12.jpg', '2024-07-10 11:35:45'),
(15, 'Samsung Galaxy A02', 'Entry-level Samsung smartphone', 2990000.00, 'Smartphone', 'images/samsung_galaxy_a02.jpg', '2024-07-10 11:35:45'),
(16, 'Samsung Galaxy Tab S7 Plus', 'Samsung tablet with S Pen', 18990000.00, 'Tablet', 'images/samsung_galaxy_tab_s7_plus.jpg', '2024-07-10 11:35:45'),
(17, 'Samsung Galaxy Tab S6', 'Samsung tablet with good performance', 15990000.00, 'Tablet', 'images/samsung_galaxy_tab_s6.jpg', '2024-07-10 11:35:45'),
(18, 'Samsung Galaxy Watch 3', 'Samsung smartwatch with advanced health monitoring', 8490000.00, 'Smartwatch', 'images/samsung_galaxy_watch_3.jpg', '2024-07-10 11:35:45'),
(19, 'Samsung Galaxy Buds Pro', 'Samsung wireless earbuds', 4990000.00, 'Accessories', 'images/samsung_galaxy_buds_pro.png', '2024-07-10 11:35:45'),
(20, 'Samsung Galaxy Fit 2', 'Samsung fitness tracker', 1190000.00, 'Accessories', 'images/samsung_galaxy_fit_2.jpg', '2024-07-10 11:35:45'),
(21, 'Samsung Galaxy Watch4', 'Smartwatch with a 1.4-inch AMOLED screen, GPS support and various health features.', 1200000.00, 'Smartwatch', 'images/image11.jpg', '2024-07-10 11:41:36'),
(22, 'Samsung Galaxy Watch Active2', 'Smartwatch with a 1.2-inch AMOLED screen, GPS support and health tracking.', 5500000.00, 'Smartwatch', 'images/image12.jpg', '2024-07-10 11:41:36'),
(23, 'Samsung Galaxy Watch5', 'Smartwatch with a 1.4-inch AMOLED screen, GPS support and various health features.', 9000000.00, 'Smartwatch', 'images/image13.jpg', '2024-07-10 11:41:36'),
(24, 'Samsung Galaxy Fit', 'Smartwatch with a PMOLED screen, activity and sleep tracking.', 1000000.00, 'Smartwatch', 'images/image14.jpg', '2024-07-10 11:41:36'),
(25, 'Samsung Gear Sport', 'Smartwatch with a 1.2-inch AMOLED screen, water-resistant and activity tracking.', 7000000.00, 'Smartwatch', 'images/image15.jpg', '2024-07-10 11:41:36'),
(26, 'Samsung Smart TV 32 inch', 'Smart TV with an LED screen, HD resolution.', 8000000.00, 'Smart TV', 'images/image16.jpg', '2024-07-10 11:41:36'),
(27, 'Samsung Smart TV 40 inch', 'Smart TV with an LED screen, Full HD resolution.', 9000000.00, 'Smart TV', 'images/image17.jpg', '2024-07-10 11:41:36'),
(28, 'Samsung Smart TV 43 inch', 'Smart TV with an LED screen, 4K resolution.', 9500000.00, 'Smart TV', 'images/image18.jpg', '2024-07-10 11:41:36'),
(29, 'Samsung Smart TV 50 inch', 'Smart TV with an LED screen, 4K resolution.', 10000000.00, 'Smart TV', 'images/image19.jpg', '2024-07-10 11:41:36'),
(30, 'Samsung Smart TV 55 inch', 'Smart TV with an LED screen, 4K resolution.', 9990000.00, 'Smart TV', 'images/image20.jpg', '2024-07-10 11:41:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user1', 'password1'),
(2, 'user2', 'pass'),
(3, 'user3', '123'),
(4, 'user4', '1233');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
