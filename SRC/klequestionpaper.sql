-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2022 at 09:16 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klequestionpaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `mobile`, `email`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paper_questions`
--

CREATE TABLE `paper_questions` (
  `id` int(11) NOT NULL,
  `question_paper_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paper_questions`
--

INSERT INTO `paper_questions` (`id`, `question_paper_id`, `question_id`, `group_id`) VALUES
(1, 1, 9, 1),
(2, 1, 8, 1),
(3, 1, 6, 1),
(4, 1, 7, 2),
(5, 1, 5, 2),
(6, 1, 4, 2),
(7, 2, 7, 1),
(8, 2, 5, 1),
(9, 2, 3, 1),
(10, 2, 9, 2),
(11, 2, 8, 2),
(12, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questionpapers`
--

CREATE TABLE `questionpapers` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `total_time` varchar(255) NOT NULL,
  `total_marks` varchar(255) NOT NULL,
  `group_1` text NOT NULL,
  `group_2` text NOT NULL,
  `group_3` text NOT NULL,
  `group_4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionpapers`
--

INSERT INTO `questionpapers` (`id`, `subject_id`, `title`, `total_time`, `total_marks`, `group_1`, `group_2`, `group_3`, `group_4`) VALUES
(1, 1, 'IA - 1', '2', '20', 'Solve Any 2 ', 'Solve Any 2', '', ''),
(2, 1, 'IA - 2', '30 Min', '20', 'Solve Any 2', 'Solve Any 2', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `question_type` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `opt1` varchar(255) NOT NULL,
  `opt2` varchar(255) NOT NULL,
  `opt3` varchar(255) NOT NULL,
  `opt4` varchar(255) NOT NULL,
  `mark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_id`, `unit_id`, `question_type`, `question`, `opt1`, `opt2`, `opt3`, `opt4`, `mark`) VALUES
(2, 1, 1, 2, 'What is the disadvantage of arrays in C?', 'The amount of memory to be allocated should be known beforehand.', 'Elements of an array can be accessed in constant time.', 'Elements are stored in contiguous memory blocks.', 'Multiple other data structures can be implemented using arrays.', '5'),
(3, 1, 1, 1, 'What do you mean by the Scope of the variable? What is the scope of the variables in C?', '', '', '', '', '5'),
(4, 1, 1, 1, 'What are static variables and functions?', '', '', '', '', '5'),
(5, 1, 1, 2, 'Who is the father of C language?', 'Steve Jobs', 'James Gosling', 'Dennis Ritchie', 'Rasmus Lerdorf', '5'),
(6, 1, 1, 2, 'Which of the following is not a valid C variable name?', 'int number;', 'float rate;', 'int variable_count;', 'int $main;', '5'),
(7, 1, 1, 2, 'All keywords in C are in ____________', 'LowerCase letters', 'UpperCase letters', 'CamelCase letters', 'None of the mentioned', '5'),
(8, 1, 1, 1, 'What are the key features in the C programming language?', '', '', '', '', '5'),
(9, 1, 2, 1, 'What are the basic data types associated with C?', '', '', '', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'C Programming');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`) VALUES
(1, 'Unit 1'),
(2, 'Unit 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_questions`
--
ALTER TABLE `paper_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionpapers`
--
ALTER TABLE `questionpapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paper_questions`
--
ALTER TABLE `paper_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questionpapers`
--
ALTER TABLE `questionpapers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
