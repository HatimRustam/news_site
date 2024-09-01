-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2024 at 10:16 PM
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
-- Database: `add_modify_delete_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `post`) VALUES
(1, 'India-China relations', 1),
(2, 'Space exploration', 1),
(3, 'Social movements', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `post_date` varchar(100) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(1, 'India-China Relations 2024: Border Tensions, Diplomatic Dialogues, and Strategic Maneuvers in a Chan', 'In 2024, India-China relations remain tense as both nations navigate ongoing border disputes and strategic challenges. The Line of Actual Control (LAC) continues to be a flashpoint, with military standoffs and infrastructure developments heightening tensions. Diplomatic efforts, including high-level talks and back-channel negotiations, aim to de-escalate the situation, but mutual distrust persists. Both countries are also expanding their regional influence, with India strengthening ties with the Quad and China advancing its Belt and Road Initiative. The complex interplay of rivalry and cooperation will define the bilateral relationship in 2024, with significant implications for regional stability.', '1', '01-Sep-2024', 1, '1914b6b7-726b-4e53-bda8-ebaf9a9cb8c1.webp'),
(2, 'India\'s Space Exploration in 2024: Ambitious Missions, Lunar Landings, and Expanding Frontiers in Sp', 'In 2024, India\'s space exploration efforts have reached new heights with ambitious missions aimed at deepening the country’s presence in space. The Indian Space Research Organisation (ISRO) successfully launched several missions, including lunar exploration and satellite deployments, showcasing India\'s growing capabilities in space technology. Key milestones include the Chandrayaan-4 mission, aiming to land on the moon\'s south pole, and the development of advanced satellites for communication and earth observation. Collaborative efforts with global space agencies are also on the rise, positioning India as a significant player in the global space race. The year marks a pivotal moment in India\'s quest to explore the cosmos.', '2', '01-Sep-2024', 1, 'efe77e52-ac6d-465e-8fb0-ba9c440a52f6.webp');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `role`) VALUES
(1, 'Hatim', 'Admin', 'hatim_rustam', '$2y$10$LpKdVub3xfLJxdvUDTJu7.QhwHudlhXFa4LSGfxUWAbIEP2/NcRRW', 2),
(2, 'hatim', 'User', 'hatim_user', '$2y$10$AWRCb6vLudTb1EscRnyICeuMMcKp6yUP679rNfqGIuyruhOuBBgN2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
