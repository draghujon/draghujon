-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2020 at 12:46 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `UserIdFK` int(20) NOT NULL,
  `ServiceIdFK` int(20) NOT NULL,
  `Comments` varchar(200) NOT NULL,
  `Created_At` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `UserIdFK`, `ServiceIdFK`, `Comments`, `Created_At`) VALUES
(1, 1, 1, '!Great service! Set up my computer and everything works very well! Thank you CF Computing!', '2020-03-27 20:45:11'),
(3, 1, 1, 'hello1', '2020-03-28 00:39:42'),
(4, 1, 0, 'THIS IS my comment!', '2020-03-27 22:29:25'),
(5, 1, 0, 'I am creating a comment! :):)', '2020-03-27 22:29:32'),
(6, 1, 0, 'This is my comment?', '2020-03-27 22:29:37'),
(15, 0, 0, 'sss', '2020-03-27 23:50:08'),
(16, 0, 0, 'guest', '2020-03-27 23:52:12'),
(17, 12, 0, 'This is from new user with id 17', '2020-03-28 00:40:51'),
(18, 12, 0, 'sssss 18', '2020-03-28 00:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(1, 'image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(1, 'Computer set-up and Repair', 'Setup and personalization of a computer, either new or used.', 54.99),
(2, 'System tune ups', 'Operating system updates  Tweaking/Repairing registry  Optimize start up', 24.99),
(3, 'Basic Diagnostic', 'Will look at and inspect your computer to determine what&#39;s wrong.', 29.99),
(4, 'Recover lost Windows Passwords', 'Reset or recover Windows log on passwords.(Up to 3)', 39.99),
(5, 'Cleaning and Maintenance', 'Physical internal and external cleaning of a computer.', 19.99),
(6, 'Hard drive wipe', 'Erase a hard disk so that the information is not recoverable. Useful if you want to sell your computer without risk of personal information being accessed.', 19.99),
(7, 'Software installations', 'Installation of a single software title you purchase and bring to me.', 9.99),
(8, 'Component and Peripheral installations', 'Installation and set up of a single piece of hardware(video card for example).', 19.99),
(9, 'Recovery media creation', 'Create Recovery discs of your operating system.', 19.99),
(10, 'Data transfer', 'Transferring data between any two devices.', 39.99),
(11, 'Virus removal', 'Virus, malware, and adware/spyware removal.', 49.99),
(12, 'Diagnostic & Repair with Data Transfer', 'Complete hardware and software diagnostic of a single system.  Virus removal, OS reinstallation, driver reinstallation, hardware installations, whatever is required.', 119.99),
(16, 'Web Dev', 'I will develop interactive web pages for you.', 100.99);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `streetaddy` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `admin`, `username`, `password`, `firstname`, `lastname`, `streetaddy`, `city`, `province`, `email`, `phone`) VALUES
(1, 1, 'cfeasby', 'mypass123', 'Chris', 'Feasby', '25 Lansdowne Ave', 'Winnipeg', 'Manitoba', 'cfeasby@academic.rrc.ca', '12049979918'),
(12, 0, 'new', 'new', 'new', 'new', 'new', 'new', 'British Columbia', 'cfeasby204@gmail.com', '2049979918'),
(13, 0, 'whatever', 'mypass123', 'what', 'ever', '2222', 'Calgary', 'Alberta', 'cfeasby204@gmail.com', '2049875598');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
