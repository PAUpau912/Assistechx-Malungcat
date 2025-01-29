-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 06:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assistechx`
--

-- --------------------------------------------------------

--
-- Table structure for table `archived_tickets`
--

CREATE TABLE `archived_tickets` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `requester` int(11) DEFAULT NULL,
  `team` int(11) DEFAULT NULL,
  `team_member` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `priority` varchar(50) DEFAULT NULL,
  `rating` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archived_tickets`
--

INSERT INTO `archived_tickets` (`id`, `title`, `body`, `requester`, `team`, `team_member`, `status`, `priority`, `rating`, `created_at`) VALUES
(11, 'demo subject', 'demo comment', 46, 1, 4, 'solved', 'medium', '0', '2025-01-20 01:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `team_member` int(11) NOT NULL,
  `private` int(11) NOT NULL DEFAULT 0,
  `body` varchar(256) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ticket`, `team_member`, `private`, `body`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'comment', 'flag.svg', '2019-05-31 13:54:56', '2019-05-31 13:54:56'),
(2, 2, 2, 0, 'comment on ticket', '', '2019-05-31 13:57:19', '2019-05-31 13:57:19'),
(3, 3, 3, 0, 'test comment', '', '2019-06-03 16:59:16', '2019-06-03 16:59:16'),
(4, 4, 4, 0, 'test ticket comment', '', '2019-06-03 16:59:43', '2019-06-03 16:59:43'),
(5, 5, 1, 0, 'ddmo', '', '2023-03-20 07:01:34', '2023-03-20 07:01:34'),
(6, 6, 6, 0, 'comment', '', '2019-05-31 05:54:56', '2019-05-31 05:54:56'),
(7, 7, 1, 0, 'comment on ticket', '', '2019-05-31 05:57:19', '2019-05-31 05:57:19'),
(8, 8, 4, 0, 'test comment', '', '2019-06-03 08:59:16', '2019-06-03 08:59:16'),
(9, 9, 4, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(10, 10, 4, 0, 'ddmo', '', '2023-03-19 23:01:34', '2023-03-19 23:01:34'),
(11, 11, 1, 0, 'This is an urgent issue. Please address it as soon as possible.', '', '2025-01-30 01:00:00', '2025-01-30 01:00:00'),
(12, 12, 2, 0, 'I have completed the task and resolved the issue. Let me know if further action is needed.', '', '2025-01-30 01:10:00', '2025-01-30 01:10:00'),
(13, 13, 3, 0, 'I need more details from the requester to proceed with the solution.', '', '2025-01-30 01:20:00', '2025-01-30 01:20:00'),
(14, 14, 4, 0, 'Waiting for approval from the team before proceeding with the solution.', '', '2025-01-30 01:30:00', '2025-01-30 01:30:00'),
(15, 15, 2, 0, 'Can someone assist me with this? I am unsure how to proceed.', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(16, 16, 3, 0, 'I have attached the logs for the issue. Please review them and let me know the next steps.', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(17, 17, 4, 0, 'This issue is taking longer than expected. Any updates from the team?', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(18, 18, 5, 0, 'I have fixed the issue and tested it. Please verify from your end and close the ticket.', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(19, 19, 6, 0, 'tThis is an urgent issue. Please address it as soon as possible.', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(20, 20, 7, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(21, 21, 8, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(22, 22, 9, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(23, 23, 1, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(24, 24, 2, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(25, 25, 3, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(26, 26, 4, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(27, 24, 5, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(28, 25, 6, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(29, 26, 7, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43'),
(30, 28, 8, 0, 'test ticket comment', '', '2019-06-03 08:59:43', '2019-06-03 08:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `ticket_id`, `content`, `created_at`, `user_id`) VALUES
(1, 1, 'FIXED', '2025-01-29 15:21:59', 20),
(2, 22, 'FIXED', '2025-01-29 15:25:05', 4);

-- --------------------------------------------------------

--
-- Table structure for table `requester`
--

CREATE TABLE `requester` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requester`
--

INSERT INTO `requester` (`id`, `user_id`, `name`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 1, 'John Doe', 'johndoe@helpdesk.com', '09123456789', '2025-01-29 03:27:50', '2025-01-17 14:33:53'),
(2, 2, 'Alex', 'kangkan@email.com\r\n', '9999999', '2025-01-29 03:27:50', '2025-01-17 14:34:49'),
(3, 1, 'John Doe', 'johndeo@helpdesk.com', '09123456789', '2025-01-29 03:27:50', '2025-01-17 14:35:37'),
(4, 4, 'Angel Piamonte', 'angel@helpdesk.com', '09123456789', '2025-01-29 03:27:50', '2025-01-19 19:50:00'),
(5, 2, 'inamjul', 'inamjul@email.com', '9876543210', '2025-01-29 03:32:58', '2019-05-19 13:24:08'),
(6, 3, 'Alex', 'kangkan@email.com', '9876543210', '2025-01-29 03:32:58', '2019-05-19 13:45:22'),
(7, 3, 'Alex', 'kangkan@email.com', '9876543210', '2025-01-29 03:32:58', '2019-05-19 13:46:01'),
(8, 2, 'inamjul', 'inamjul@email.com', '9876543210', '2025-01-29 03:32:58', '2019-05-19 13:46:27'),
(9, 2, 'inamjul', 'inamjul@email.com', '9876543210', '2025-01-29 03:32:59', '2019-05-19 13:47:51'),
(10, 3, 'Alex', 'kangkan@email.com', '9876543210', '2025-01-29 03:32:59', '2019-05-19 13:48:31'),
(11, 4, 'Angeline Piamonte', 'angelinepiamonte@helpdesk.com', '9876543210', '2025-01-29 03:32:59', '2019-05-19 13:48:37'),
(12, 4, 'Angeline Piamonte', 'angelinepiamonte@helpdesk.com', '9876543210', '2025-01-29 03:32:59', '2019-05-19 13:51:05'),
(13, 2, 'injamul ', 'injamul@email.com', '8822677188', '2025-01-29 03:32:59', '2019-05-23 17:18:25'),
(14, 2, 'injamul ', 'injamul@email.com', '8822677188', '2025-01-29 03:32:59', '2019-05-30 13:55:17'),
(15, 2, 'test', 'kangkan@email.com', '1234567898', '2025-01-29 03:27:50', '2019-06-07 02:07:43'),
(16, 1, 'John Doe', 'johndoe@helpdesk.com', '1234567898', '2025-01-29 03:27:50', '2019-06-07 02:11:23'),
(17, 2, 'Alex', 'kangkan@email.com', '1234567898', '2025-01-29 03:27:50', '2019-06-07 06:51:33'),
(18, 1, 'John Doe', 'johndoe@helpdesk.com', '1234567898', '2025-01-29 03:27:50', '2019-06-07 06:52:04'),
(19, 2, 'Alex', 'kangkan@email.com', '1234567899', '2025-01-29 03:27:50', '2023-03-20 06:57:25'),
(20, 4, 'Angel Piamonte', 'angelpiamonte@helpdesk.com', '1234567899', '2025-01-29 03:27:50', '2023-03-20 11:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `department` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `availability` varchar(50) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `department`, `created_at`, `updated_at`, `availability`) VALUES
(1, 'Liam Perez', 'Marketing', '2025-01-20 07:05:34', '2025-01-19 21:11:46', 'Unavailable'),
(2, 'Olivia Martinez', 'Finance', '2024-07-08 10:43:34', '2025-01-19 21:11:46', 'Unavailable'),
(3, 'Ethan Garcia', 'Operations', '2024-05-15 05:05:34', '2025-01-19 21:11:46', 'Available'),
(4, 'Ava Robinson', 'Human Resource', '2021-01-14 02:05:12', '2025-01-19 21:11:46', 'Available'),
(5, 'Isabella Hernandez', 'Information Technology Support', '2019-05-17 01:15:44', '2025-01-19 21:11:46', 'Unavailable'),
(6, 'Mason Walker', 'Sales', '2020-03-11 23:55:14', '2025-01-19 21:11:46', 'Available'),
(7, 'Lucas Young', 'Customer Service', '2019-03-08 03:35:54', '2025-01-19 21:11:46', 'Unavailable'),
(8, 'Mia Scott', 'Research and Development', '2018-06-05 06:35:01', '2025-01-19 21:11:46', 'Available'),
(9, 'Noah Lewis', 'Procurement', '2024-05-23 02:35:41', '2025-01-19 21:11:46', 'Unavailable'),
(10, 'Charlotte King', 'Legal', '2022-07-27 11:15:55', '2025-01-19 21:11:46', 'Available'),
(13, 'John Rivera', 'Software Development', '2016-01-05 20:58:37', '2025-01-19 21:04:47', 'Unavailable'),
(14, 'Maria Santos', 'IT', '2019-06-11 20:58:37', '2025-01-19 21:04:47', 'Available'),
(15, 'Michael Cruz', 'Finance', '2017-12-12 20:58:37', '2025-01-19 21:04:47', 'Unavailable'),
(16, 'Anna Lopez', 'Security', '2020-03-02 20:58:37', '2025-01-19 21:04:47', 'Available'),
(17, 'David Garcia', 'Technical Support', '2020-04-08 04:58:37', '2025-01-19 21:04:47', 'Available'),
(18, 'Sophia Reyes', 'Web Development', '2018-10-07 20:58:37', '2025-01-19 21:04:47', 'Available'),
(19, 'James Mendoza', 'Cloud Computing', '2025-01-19 21:04:47', '2025-01-19 21:04:47', 'Available'),
(20, 'Emily Flores', 'Project Management', '2022-08-26 05:28:45', '2025-01-19 21:04:47', 'Available'),
(21, 'Robert Torres', 'Data Analysis', '2021-10-11 04:32:37', '2025-01-19 21:04:47', 'Unavailable'),
(22, 'Grace Aquino', 'Administration', '2022-11-22 08:44:21', '2025-01-19 21:04:47', 'Available'),
(23, 'Paulo Reyes', 'Operations', '2025-01-20 02:28:35', '2025-01-20 02:28:35', 'Available'),
(24, 'Christine Cosico', 'Security', '2025-01-20 02:34:15', '2025-01-20 02:34:15', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

CREATE TABLE `team_member` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `team_member`
--

INSERT INTO `team_member` (`id`, `user`, `team`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-05-19 15:08:37', '2019-05-19 15:08:37'),
(2, 2, 2, '2025-01-17 16:30:06', '2025-01-17 16:30:06'),
(3, 3, 3, '2025-01-17 16:30:06', '2025-01-17 16:30:06'),
(4, 4, 2, '2019-05-30 11:45:10', '2019-05-30 11:45:10'),
(5, 4, 4, '2019-05-30 11:46:15', '2019-05-30 11:46:15'),
(6, 4, 3, '2019-05-30 11:47:53', '2019-05-30 11:47:53'),
(7, 2, 3, '2019-05-30 11:51:38', '2019-05-30 11:51:38'),
(8, 8, 6, '2025-01-17 16:30:27', '2025-01-17 16:30:27'),
(9, 4, 1, '2019-05-31 07:35:45', '2019-05-31 07:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `requester` int(11) NOT NULL,
  `team` int(11) DEFAULT NULL,
  `team_member` varchar(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'open',
  `priority` varchar(20) NOT NULL DEFAULT 'low',
  `department` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` varchar(50) DEFAULT NULL,
  `reported` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `title`, `body`, `requester`, `team`, `team_member`, `status`, `priority`, `department`, `created_at`, `deleted_at`, `reported`) VALUES
(1, 'subject', 'this', 20, 2, '1', 'closed', 'low', 'Finance', '2019-05-19 13:48:31', NULL, 1),
(2, 'subject', 'this ', 2, 2, '2', 'solved', 'low', 'Marketing', '2019-05-19 13:48:37', NULL, 0),
(3, 'test', 'this is a comment', 9, 2, '4', 'open', 'low', 'Sales', '2019-05-23 17:18:25', NULL, 1),
(4, 'test', 'comment', 15, 1, '3', 'pending', 'high', 'Web Development', '2019-05-30 13:55:17', NULL, 0),
(5, 'abcd', 'no comment', 6, 3, '7', 'open', 'low', 'Security', '2019-06-07 02:07:43', NULL, 0),
(6, 'abcd', 'abcd', 7, 1, '9', 'open', 'low', 'Technical Support', '2019-06-07 06:51:33', NULL, 1),
(7, 'no subject', 'abcd', 10, 1, '5', 'open', 'high', 'Legal', '2019-06-07 06:52:04', NULL, 0),
(8, 'demo subject', 'system debugging', 8, 2, '9', 'closed', 'low', 'Software Development', '2023-03-20 06:57:25', NULL, 1),
(9, 'demo subject', 'demo comment', 17, 1, '8', 'solved', 'medium', 'Procurement', '2023-03-20 11:11:23', NULL, 0),
(10, 'computer', '<p>computer is broken</p>', 8, 3, '2', 'open', 'low', 'Human Resource', '2025-01-17 09:29:34', NULL, 1),
(11, 'computer', 'lkjhuyty', 4, 1, '5', 'open', 'low', 'Customer Service', '2025-01-17 11:19:23', NULL, 0),
(12, 'test', 'this is a comment', 18, 2, '6', 'open', 'low', 'Cloud Computing', '2025-01-17 14:19:29', NULL, 0),
(13, 'test', 'this is a comment', 12, 2, '1', 'open', 'low', 'Finance', '2025-01-17 14:19:34', NULL, 0),
(14, 'test', 'this is a comment', 16, 2, '4', 'open', 'low', 'Finance', '2025-01-17 14:20:10', NULL, 0),
(15, 'test', 'this is a comment', 15, 2, '4', 'open', 'low', 'Sales', '2025-01-17 14:33:35', NULL, 0),
(16, 'test', 'this is a comment', 12, 2, '4', 'open', 'low', 'Legal', '2025-01-17 14:33:47', NULL, 0),
(17, 'test', 'this is a comment', 6, 2, '4', 'open', 'low', 'Customer Service', '2025-01-17 15:40:46', NULL, 0),
(18, 'test', 'this is a comment', 3, 2, '4', 'open', 'low', 'Marketing', '2025-01-17 15:42:41', NULL, 0),
(19, 'computer', 'COMPUTER', 4, 8, '5', 'open', 'low', 'Operations', '2025-01-17 16:27:38', NULL, 0),
(20, 'computer', 'COMPUTER', 4, 8, '8', 'open', 'low', 'Human Resource', '2025-01-17 18:43:17', NULL, 0),
(21, 'computer', 'system issues', 4, 8, '4', 'open', 'low', 'IT', '2025-01-18 03:16:55', NULL, 0),
(22, 'computer', 'network issues', 4, 8, '3', 'closed', 'low', 'Procurement', '2025-01-19 16:43:54', NULL, 1),
(25, 'computer', 'computer issues', 5, 17, '5', 'open', 'low', 'Legal', '2025-01-21 07:53:16', NULL, 0),
(26, 'printer issue', '<p>no blue ink</p>', 5, 12, '5', 'open', 'low', 'Technical Support', '2025-01-21 09:08:03', NULL, 0),
(27, 'printer issue', '<p>inless</p>\r\n<p>&nbsp;</p>', 5, 3, '9', 'open', 'low', 'Software Development', '2025-01-21 09:12:06', NULL, 0),
(28, 'network down', '<p>no network</p>', 5, 4, '2', 'open', 'low', 'Finance', '2025-01-28 14:29:49', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_event`
--

CREATE TABLE `ticket_event` (
  `id` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `body` varchar(256) NOT NULL,
  `department` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticket_event`
--

INSERT INTO `ticket_event` (`id`, `ticket`, `user`, `body`, `department`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Ticket created', '', '2019-05-23 17:18:25', '2019-05-23 17:18:25'),
(2, 5, 1, 'Ticket created', '', '2019-05-30 13:55:17', '2019-05-30 13:55:17'),
(3, 6, 1, 'Ticket created', '', '2019-06-07 02:07:43', '2019-06-07 02:07:43'),
(4, 7, 1, 'Ticket created', '', '2019-06-07 02:11:23', '2019-06-07 02:11:23'),
(5, 8, 4, 'Ticket created', '', '2019-06-07 06:51:33', '2019-06-07 06:51:33'),
(6, 9, 4, 'Ticket created', '', '2019-06-07 06:52:04', '2019-06-07 06:52:04'),
(7, 10, 1, 'Ticket created', '', '2023-03-20 06:57:25', '2023-03-20 06:57:25'),
(8, 11, 1, 'Ticket created', '', '2023-03-20 11:11:23', '2023-03-20 11:11:23'),
(9, 12, 1, 'Ticket created', '', '2025-01-17 09:29:34', '2025-01-17 09:29:34'),
(10, 13, 4, 'Ticket created', '', '2025-01-17 11:19:23', '2025-01-17 11:19:23'),
(11, 21, 4, 'Ticket created', '', '2025-01-17 16:27:38', '2025-01-17 16:27:38'),
(12, 25, 5, 'Ticket created', '', '2025-01-21 07:53:16', '2025-01-21 07:53:16'),
(13, 26, 5, 'Ticket created', '', '2025-01-21 09:08:03', '2025-01-21 09:08:03'),
(14, 27, 5, 'Ticket created', '', '2025-01-21 09:12:06', '2025-01-21 09:12:06'),
(15, 28, 5, 'Ticket created', '', '2025-01-28 14:29:49', '2025-01-28 14:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'member',
  `reset_token` varchar(150) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `last_password` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `reset_token`, `last_password`, `created_at`, `updated_at`, `reset_token_expires`) VALUES
(1, 'John Doe', 'johndoe@helpdesk.com', '8888888888', '$2y$10$PHXjdcPjksokkGryfqK.WePBgiQB30Gw.ytYBHdmGtqtoGtVHtAm.', 'admin', '', '$2y$10$PHXjdcPjksokkGryfqK.WePBgiQB30Gw.ytYBHdmGtqtoGtVHtAm.', '2023-03-20 07:16:20', '2019-05-19 09:01:34', NULL),
(2, 'injamul ', 'inamjul@email.com', '1234567899', '$2y$10$6N4gbdypYQvRkU2ke9Q1f.Gm4fcGY/PEpv2rSB77wiSLZaOy8kq5i', 'user', '', '$2y$10$6N4gbdypYQvRkU2ke9Q1f.Gm4fcGY/PEpv2rSB77wiSLZaOy8kq5i', '2025-01-29 03:29:11', '2019-05-24 07:58:53', NULL),
(3, 'Alex', 'kangkan@email.com', '9999999999', '$2y$10$Q0rxoFO4fSrcdp58CO0RNOSDP7znVc9eGY6Z4xjQ8MTLHYhx0TF.6', 'staff', '', '$2y$10$Q0rxoFO4fSrcdp58CO0RNOSDP7znVc9eGY6Z4xjQ8MTLHYhx0TF.6', '2025-01-17 17:05:20', '2019-05-30 08:49:22', NULL),
(4, 'Angeline Piamonte', 'angelpiamonte@helpdesk.com', '', '$2y$10$FjfHZYLhgWsLM1cAXvDI3up3C6iQVRJDRltajP4XFnnQitUZSpKhC', 'user', '6839bc969a6866b19ef1625b87434d25', '', '2025-01-28 14:34:02', '2025-01-21 05:57:40', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `requester`
--
ALTER TABLE `requester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_event`
--
ALTER TABLE `ticket_event`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requester`
--
ALTER TABLE `requester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ticket_event`
--
ALTER TABLE `ticket_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requester`
--
ALTER TABLE `requester`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
