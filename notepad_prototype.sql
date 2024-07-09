-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 02:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notepad_prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_archived` enum('true','false') NOT NULL DEFAULT 'false',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `title`, `content`, `is_archived`, `timestamp`) VALUES
(1, 1, 'My First Note', 'Eggplants : true | Lemon: true | Apple: false', 'false', '2024-07-08 16:19:05'),
(2, 1, 'Random Title 1', 'Apple: true | Banana: true | Cherry: true | Date: false | Elderberry: false;', 'false', '2024-07-08 22:35:01'),
(3, 1, 'THIS IS A NEW TITLE GIVE 10 SECONDS TO SAVE', 'Honeydew: false | Kiwi: true | Lemon: false | Mango: true | Nectarine: false | Orange: true | Peach: false | Quince: true | : false', 'false', '2024-07-08 22:35:01'),
(4, 1, 'Random Title 3', 'Raspberry: true | Strawberry: false | Tangerine: true', 'false', '2024-07-08 22:35:01'),
(5, 1, 'Random Title 4', 'Watermelon: false | Zucchini: true | Apple: false | Banana: true | Cherry: false | Date: true | Elderberry: false', 'true', '2024-07-08 22:35:01'),
(6, 1, 'Random Title 5', 'Fig: true | Grape: false | Honeydew: true | Kiwi: false | Lemon: true', 'false', '2024-07-08 22:35:01'),
(7, 1, 'undefined', '', 'false', '2024-07-08 23:39:31'),
(8, 1, 'NEW NOTE FOR TESTING', 'New item: false | hahahahah: true | anona: false', 'false', '2024-07-08 23:40:04'),
(9, 1, 'New Title', 'New Item Here: true', 'false', '2024-07-08 23:43:27'),
(10, 3, 'Test', 'Hotdog: true | carbonara: false | cheesecake: true', 'false', '2024-07-09 00:19:41'),
(11, 3, '', '', 'false', '2024-07-09 00:20:56'),
(12, 3, '', '', 'false', '2024-07-09 00:20:57'),
(13, 3, '', '', 'false', '2024-07-09 00:20:57'),
(14, 3, '', '', 'false', '2024-07-09 00:20:58'),
(15, 3, '', '', 'false', '2024-07-09 00:20:59'),
(16, 3, '', '', 'false', '2024-07-09 00:20:59'),
(17, 3, '', '', 'false', '2024-07-09 00:20:59'),
(18, 3, '', '', 'false', '2024-07-09 00:20:59'),
(19, 3, '', '', 'false', '2024-07-09 00:21:00'),
(20, 3, '', '', 'false', '2024-07-09 00:21:00'),
(21, 3, '', '', 'false', '2024-07-09 00:21:01'),
(22, 3, '', '', 'false', '2024-07-09 00:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `image_name`, `bio`) VALUES
(1, 'neytism000', 'Nate Florendo', 'admin000', '1_dp.png', 'This is my Bio, and i am updating it. Changing'),
(2, 'admin000', 'Admin Arlert', 'admin000', 'add-image.png', 'This is bio.'),
(3, 'newuser000', 'Nate Justine Monsod Florendo', 'admin000', '3_dp.png', 'This is a new account.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
