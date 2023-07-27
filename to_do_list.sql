-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 03:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE `tb_categories` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`id`, `photo`, `name`) VALUES
(0, 'Category=default.png', 'default'),
(1, 'Category=Study.png', 'study'),
(2, 'Category=Sport.png', 'sport'),
(3, 'Category=Meeting.png', 'meeting'),
(4, 'Category=Medic.png', 'medic');

-- --------------------------------------------------------

--
-- Table structure for table `tb_collaborators`
--

CREATE TABLE `tb_collaborators` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `collab_id` int(11) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_collaborators`
--

INSERT INTO `tb_collaborators` (`id`, `task_id`, `collab_id`, `added_by`) VALUES
(4, 88, 2, 1),
(6, 95, 2, 1),
(7, 97, 2, 1),
(8, 98, 2, 1),
(9, 99, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pets`
--

CREATE TABLE `tb_pets` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pets`
--

INSERT INTO `tb_pets` (`id`, `photo`, `name`) VALUES
(1, 'Pet1=Level1.png', 'Rocky'),
(2, 'Pet2=Level1.png', 'Bella');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pet_phases`
--

CREATE TABLE `tb_pet_phases` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `min_xp` int(11) NOT NULL,
  `max_xp` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pet_phases`
--

INSERT INTO `tb_pet_phases` (`id`, `pet_id`, `min_xp`, `max_xp`, `photo`, `name`, `level`) VALUES
(1, 1, 0, 50, 'Pet1=Level1.png', 'Egg Rocky', 1),
(2, 1, 51, 100, 'Pet1=Level2.png', 'Baby Rocky', 2),
(3, 1, 101, 150, 'Pet1=Level3.png', 'Lil Rocky', 3),
(4, 1, 151, 10000, 'Pet1=Level4.png', 'Big Rocky', 4),
(5, 2, 0, 50, 'Pet2=Level1.png', 'Kitten Bella', 1),
(6, 2, 51, 100, 'Pet2=Level2.png', 'Small Bella', 2),
(7, 2, 101, 150, 'Pet2=Level3.png', 'Teen Bella', 3),
(8, 2, 151, 10000, 'Pet2=Level4.png', 'Big Bella', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_priorities`
--

CREATE TABLE `tb_priorities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_priorities`
--

INSERT INTO `tb_priorities` (`id`, `title`, `score`) VALUES
(0, 'No Priorities', 0),
(1, 'Low', 1),
(2, 'Medium', 2),
(3, 'High', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reminders`
--

CREATE TABLE `tb_reminders` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `reminder_time` time NOT NULL,
  `reminder_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_reminders`
--

INSERT INTO `tb_reminders` (`id`, `task_id`, `reminder_time`, `reminder_date`) VALUES
(19, 92, '07:59:00', '2023-07-25'),
(22, 95, '08:20:00', '2023-07-25'),
(23, 96, '08:25:00', '2023-07-25'),
(24, 97, '08:28:00', '2023-07-25'),
(25, 98, '08:45:00', '2023-07-25'),
(26, 99, '08:47:00', '2023-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` enum('active','done','expired') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_status`
--

INSERT INTO `tb_status` (`id`, `status`) VALUES
(1, 'active'),
(2, 'done'),
(3, 'expired');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tasks`
--

CREATE TABLE `tb_tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_date` date DEFAULT NULL,
  `task_time` time DEFAULT NULL,
  `task_desc` varchar(255) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_tasks`
--

INSERT INTO `tb_tasks` (`id`, `task_name`, `task_date`, `task_time`, `task_desc`, `priority_id`, `user_id`, `category_id`, `status_id`) VALUES
(64, '1', '2023-07-20', '00:00:00', 'No Desc', 0, 1, 0, 2),
(65, 'tes', '2023-07-20', '00:00:00', 'No Desc', 0, 1, 0, 2),
(66, 'Halo', '2023-07-20', '00:00:00', 'No Desc', 0, 1, 0, 1),
(68, 'makan makan', '2023-07-20', '09:33:00', 'No Desc', 0, 1, 3, 2),
(69, 'makan', '2023-07-20', '09:35:00', 'No Desc', 0, 1, 0, 2),
(70, 'makan', '2023-07-20', '09:43:00', 'No Desc', 0, 1, 0, 2),
(71, 'halo', '2023-07-22', '00:00:00', 'No Desc', 0, 1, 0, 1),
(72, 'hadeh', '2023-07-31', '00:00:00', 'No Desc', 0, 1, 0, 1),
(73, 'cek', '2023-07-25', '00:00:00', 'No Desc', 0, 1, 0, 1),
(74, '1111', '2023-07-20', '00:00:00', 'No Desc', 0, 1, 0, 2),
(75, 'wendy wendy', '2023-07-20', '00:00:00', 'No Desc', 0, 1, 0, 2),
(76, 'wendyyy', '2023-07-20', '11:21:00', 'No Desc', 0, 1, 0, 2),
(77, 'test reminder', '2023-07-20', '11:25:00', 'No Desc', 0, 1, 0, 2),
(79, 'halo della', '2023-07-21', '00:00:00', 'No Desc', 0, 1, 0, 1),
(81, 'halo lagi lagi lagi della', '2023-07-21', '00:00:00', 'No Desc', 0, 1, 0, 1),
(88, 'coba collab', '2023-07-24', '00:00:00', 'No Desc', 0, 1, 0, 2),
(90, 'coba reminder', '2023-07-25', '07:34:00', 'No Desc', 0, 1, 1, 1),
(92, 'tes reminder title', '2023-07-25', '08:00:00', 'No Desc', 0, 1, 0, 1),
(95, 'tes reminder collab lagi', '2023-07-25', '08:21:00', 'No Desc', 0, 1, 0, 1),
(96, 'tes remind', '2023-07-25', '08:26:00', 'No Desc', 0, 1, 0, 1),
(97, 'coba remind 2', '2023-07-25', '08:29:00', 'No Desc', 0, 1, 0, 1),
(98, 'cek cek cekkk', '2023-07-25', '08:42:00', 'No Desc', 0, 1, 0, 1),
(99, 'tes reminder collab', '2023-07-25', '08:48:00', 'No Desc', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `xp` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `pet_phases` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `photo`, `username`, `fullname`, `email`, `password`, `xp`, `status`, `pet_phases`, `pet_id`) VALUES
(1, 'd78a10f4a52f6dbc6606ac84e51f246e_23-07-25.jpg', 'calvin', 'Calvin Tai', 'calvin.tai@itbss.ac.id', '202cb962ac59075b964b07152d234b70', 100, 0, 6, 2),
(2, 'profil_login.png', 'clvndth', 'Calvin Tai', 'calvinthai85@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tb_pets`
--
ALTER TABLE `tb_pets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`) USING BTREE;

--
-- Indexes for table `tb_priorities`
--
ALTER TABLE `tb_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`) USING BTREE;

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `FK_tb_users_pet_phases` (`pet_phases`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pets`
--
ALTER TABLE `tb_pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_priorities`
--
ALTER TABLE `tb_priorities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_collaborators`
--
ALTER TABLE `tb_collaborators`
  ADD CONSTRAINT `tb_collaborators_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_tasks` (`id`);

--
-- Constraints for table `tb_pet_phases`
--
ALTER TABLE `tb_pet_phases`
  ADD CONSTRAINT `FK_PetPhases` FOREIGN KEY (`pet_id`) REFERENCES `tb_pets` (`id`);

--
-- Constraints for table `tb_reminders`
--
ALTER TABLE `tb_reminders`
  ADD CONSTRAINT `tb_reminders_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tb_tasks` (`id`),
  ADD CONSTRAINT `tb_reminders_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tb_tasks` (`id`);

--
-- Constraints for table `tb_tasks`
--
ALTER TABLE `tb_tasks`
  ADD CONSTRAINT `tb_tasks_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `tb_priorities` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tb_categories` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_tasks_ibfk_6` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);

--
-- Constraints for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `FK_tb_users_pet_phases` FOREIGN KEY (`pet_phases`) REFERENCES `tb_pet_phases` (`id`),
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
