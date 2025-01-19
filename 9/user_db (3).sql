-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2025 at 10:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`) VALUES
(1, 'cse final year'),
(10, 'Test Class');

-- --------------------------------------------------------

--
-- Table structure for table `class_student`
--

CREATE TABLE `class_student` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_student`
--

INSERT INTO `class_student` (`class_id`, `student_id`) VALUES
(1, 1),
(1, 2),
(1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `class_student_users`
--

CREATE TABLE `class_student_users` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_student_users`
--

INSERT INTO `class_student_users` (`class_id`, `student_id`, `username`, `password`, `role`, `class_name`) VALUES
(1, 1, 'ram@gmail.com', '1234', 'student', 'cse final year'),
(1, 2, 'studentUser', 'studentPass', 'student', 'cse final year'),
(1, 6, '12', '12', 'student', 'cse final year');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE `class_subject` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`class_id`, `subject_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_outcomes`
--

CREATE TABLE `course_outcomes` (
  `id` int(11) NOT NULL,
  `co_number` varchar(10) NOT NULL,
  `co_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_outcomes`
--

INSERT INTO `course_outcomes` (`id`, `co_number`, `co_description`, `created_at`, `class_id`) VALUES
(5, 'CO1', 'Test Course Outcome', '2025-01-08 09:19:36', 10),
(6, 'co1 ', 'asnjsb', '2025-01-08 09:20:39', 10),
(7, 'co2', 'qddasd', '2025-01-08 09:34:19', 1),
(8, 'co2', 'qddasd', '2025-01-08 09:34:28', 1),
(9, 'co2', 'qddasd', '2025-01-08 09:34:33', 1),
(10, '1', 'sxswacx', '2025-01-09 04:59:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `co_po`
--

CREATE TABLE `co_po` (
  `id` int(11) NOT NULL,
  `co` varchar(255) NOT NULL,
  `po` varchar(255) NOT NULL,
  `co_number` varchar(50) NOT NULL,
  `po_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `co_po`
--

INSERT INTO `co_po` (`id`, `co`, `po`, `co_number`, `po_number`) VALUES
(48, '', 'yes it is rule', '', '2'),
(49, 'aaaaaaaa', '', '1', ''),
(50, '', 'aaaasaa', '', '22');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `marks_1a` int(11) DEFAULT 0,
  `marks_1b` int(11) DEFAULT 0,
  `marks_2a` int(11) DEFAULT 0,
  `marks_2b` int(11) DEFAULT 0,
  `marks_3a` int(11) DEFAULT 0,
  `marks_3b` int(11) DEFAULT 0,
  `marks_4a` int(11) DEFAULT 0,
  `marks_4b` int(11) DEFAULT 0,
  `co1_marks` int(11) DEFAULT 0,
  `co2_marks` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_name`, `marks_1a`, `marks_1b`, `marks_2a`, `marks_2b`, `marks_3a`, `marks_3b`, `marks_4a`, `marks_4b`, `co1_marks`, `co2_marks`) VALUES
(4, 'JANHAVI DEONATH MULE ', 8, 8, 0, 0, 0, 0, 6, 8, 16, 14),
(5, 'NIKHAT PARVEEN SAYYAD NOOR ', 0, 0, 8, 8, 0, 0, 7, 7, 16, 14),
(6, 'RAJESHWARI SANTOSHRAO MATHIYA ', 5, 6, 0, 0, 0, 0, 5, 6, 11, 11),
(7, 'SANCHITA VILAS GAWATE ', 0, 0, 4, 6, 5, 6, 0, 0, 10, 11),
(8, 'VEDANT IMASALE', 0, 0, 8, 9, 9, 7, 0, 0, 17, 16),
(9, 'ABHISHEK CHANDRASHEKHAR BHAGAT', 8, 8, 0, 0, 7, 4, 0, 0, 16, 11),
(10, 'MORE AJAY V', 0, 0, 7, 8, 0, 0, 7, 4, 15, 11),
(11, 'ALFAIZ KHAN MUSTAQ ', 0, 0, 7, 6, 0, 0, 4, 7, 13, 11),
(12, 'ANIKET PANDHARI DARADE ', 0, 0, 8, 10, 5, 7, 0, 0, 18, 12),
(13, 'AYUSH ROHIDAS RATHOD ', 0, 0, 7, 8, 0, 0, 7, 4, 15, 11),
(14, 'DIPANSHU VILAS AMALE ', 0, 0, 5, 8, 10, 7, 0, 0, 13, 17),
(15, 'GAURAV SANTOSHRAO. GHUGE ', 5, 6, 0, 0, 0, 0, 4, 6, 11, 10),
(16, 'KULDIP SHRIKRUSHNAPPA NAKHATE ', 0, 0, 7, 8, 0, 0, 7, 4, 15, 11),
(17, 'MUSAIB GAZALI SHAHZAD ', 7, 8, 0, 8, 7, 0, 0, 0, 23, 7),
(18, 'OMKAR GATE', 10, 8, 0, 0, 10, 5, 0, 0, 18, 15),
(19, 'BHOSALE PAVAN P. ', 0, 0, 7, 7, 0, 0, 6, 8, 14, 14),
(20, 'PRAJWAL BANDUJI NAKHATE ', 0, 0, 7, 6, 4, 7, 0, 0, 13, 11),
(21, 'PRANAV VINOD GHUSE ', 8, 7, 0, 0, 0, 0, 7, 4, 15, 11),
(22, 'RAHUL PRAKASH PADOLE ', 0, 0, 8, 10, 10, 5, 0, 0, 18, 15),
(23, 'RUDRA NILESH PADOLE ', 0, 0, 8, 5, 5, 5, 0, 0, 13, 10),
(24, 'RUSHIKESH UMESH HAJARE ', 4, 5, 0, 4, 6, 0, 0, 0, 13, 6),
(25, 'SAHIL R. PAIKRAO ', 0, 0, 7, 7, 5, 7, 0, 0, 14, 12),
(26, 'SANCHIT RAVINDRA BHALSHANKAR ', 10, 8, 0, 0, 0, 0, 5, 10, 18, 15),
(27, 'SANKET HIRALAL BOBADE ', 5, 6, 0, 0, 0, 0, 5, 6, 11, 11),
(28, 'SHIVA GANESH MORE ', 0, 0, 4, 6, 5, 6, 0, 0, 10, 11),
(29, 'SHUBHAM PRAKASH NALWADE ', 0, 0, 8, 8, 10, 7, 0, 0, 16, 17),
(30, 'SURAJ BALU BANSOD ', 0, 0, 8, 8, 7, 7, 0, 0, 16, 14),
(31, 'TANMAY KISHORRAO KHELPANDE ', 0, 0, 7, 6, 0, 0, 5, 6, 13, 11),
(32, 'TANMAY MOHAN HUKUM ', 0, 0, 8, 8, 7, 4, 0, 0, 16, 11),
(33, 'TEJAS MOHAN HUKUM ', 0, 0, 8, 10, 10, 5, 0, 0, 18, 15),
(34, 'VIVEK VIJAY PATIL', 8, 7, 0, 0, 0, 0, 7, 4, 15, 11);

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `po_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_outcomes`
--

CREATE TABLE `program_outcomes` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `po_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'dbms'),
(2, 'Math'),
(3, 'Science'),
(4, 'History'),
(5, 'dbms');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL,
  `class` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `class`) VALUES
(1, 'ram@gmail.com', '1234', 'student', NULL),
(2, 'studentUser', 'studentPass', 'student', NULL),
(3, 'teacherUser', 'teacherPass', 'teacher', NULL),
(4, '1', '1', 'admin', NULL),
(5, '2', '2', 'teacher', NULL),
(6, '3', '3', 'student', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_student`
--
ALTER TABLE `class_student`
  ADD PRIMARY KEY (`class_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `class_student_users`
--
ALTER TABLE `class_student_users`
  ADD PRIMARY KEY (`class_id`,`student_id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`class_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_outcomes_classes` (`class_id`);

--
-- Indexes for table `co_po`
--
ALTER TABLE `co_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `program_outcomes`
--
ALTER TABLE `program_outcomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD PRIMARY KEY (`subject_id`,`teacher_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `co_po`
--
ALTER TABLE `co_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_outcomes`
--
ALTER TABLE `program_outcomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_student`
--
ALTER TABLE `class_student`
  ADD CONSTRAINT `class_student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD CONSTRAINT `class_subject_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Constraints for table `course_outcomes`
--
ALTER TABLE `course_outcomes`
  ADD CONSTRAINT `fk_course_outcomes_classes` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD CONSTRAINT `subject_teacher_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `subject_teacher_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
