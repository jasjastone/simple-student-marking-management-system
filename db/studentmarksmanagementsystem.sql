-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2023 at 06:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentmarksmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved`
--

CREATE TABLE `approved` (
  `id` int(11) NOT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  `admission_officer_name` varchar(255) DEFAULT NULL,
  `admission_officer_signature` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `hod_department_name` varchar(255) DEFAULT NULL,
  `admission_officer_stamp` varchar(255) DEFAULT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `department_id`) VALUES
(1, 'Computer Science', 1),
(2, 'Electrical Engeeniring', 4),
(3, 'Laboratory And Science Technology', 4),
(4, 'Eletrical And Automotive', 4),
(5, 'Civil Engeneering', 3),
(6, 'Civil Irrigation', 3),
(7, 'Civil and Highway', 3),
(8, 'Mechanical Engineering', 3),
(9, 'Information Technology', 1),
(10, 'Telecommunication', 4);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'ICT'),
(2, 'Mechanical'),
(3, 'Civil'),
(4, 'Electrical');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) NOT NULL,
  `level` varchar(255) NOT NULL,
  `minimumca` int(11) NOT NULL,
  `minimumgpa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `minimumca`, `minimumgpa`) VALUES
(1, '1', 20, 4),
(2, '2', 20, 4),
(3, '3', 20, 4),
(4, '4', 20, 4),
(5, '5', 20, 4),
(6, '6', 20, 5),
(7, '7-1', 16, 5),
(8, '7-2', 16, 5),
(9, '8', 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `assaignment1` float DEFAULT NULL,
  `assaignment2` float DEFAULT NULL,
  `test1` float DEFAULT NULL,
  `test2` float DEFAULT NULL,
  `semister` int(11) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `final_exam` float DEFAULT NULL,
  `sup_exam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `assaignment1`, `assaignment2`, `test1`, `test2`, `semister`, `student_id`, `teacher_id`, `module_id`, `department_id`, `final_exam`, `sup_exam`) VALUES
(1, 9, 8, 8, 2, 1, 7, 4, 1, 1, 45, NULL),
(2, 15, 5, 5, 14, 1, 7, 5, 2, 1, 29, 58),
(3, 10, 5, 7, 10, 1, 7, 5, 3, 1, 58, NULL),
(4, 6, 5, 8, 10, 1, 7, 5, 4, 1, 48, NULL),
(5, 6, 5, 8, 5, 2, 7, 5, 4, 1, 48, NULL),
(6, 12, 12, 3, 4, 1, 9, 4, 1, 1, 50, NULL),
(7, 10, 14, 11, 1, 1, 13, 4, 1, 1, 34, NULL),
(8, 9, 8, 8, 2, 1, 13, 5, 2, 1, 45, NULL),
(9, 20, 5, 5, 5, 1, 13, 5, 3, 1, 35, NULL),
(10, 16, 14, 11, 1, 1, 13, 5, 4, 1, 34, NULL),
(11, 7, 8, 10, 9, 1, 13, 4, 1, 1, 30, NULL),
(12, 7, 10, 10, 9, 1, 13, 4, 1, 1, 30, NULL),
(13, 10, 14, 11, 1, 1, 13, 4, 4, 1, 34, NULL),
(14, 4, 5, 8, 10, 1, 30, 4, 1, 1, 47, NULL),
(15, 20, 5, 1, 4, 1, 30, 4, 1, 1, 23, NULL),
(16, 20, 5, 4, 4, 1, 30, 4, 2, 1, 6, NULL),
(17, 5, 5, 9, 9, 1, 30, 4, 3, 1, 56, NULL),
(18, 4, 5, 8, 10, 1, 30, 4, 4, 1, 47, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `modulename` varchar(255) NOT NULL,
  `modulecode` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `modulename`, `modulecode`, `course_id`, `credit`) VALUES
(1, 'Computer Maintaince', 'ITT 071888', 1, 12),
(2, 'Computer Networking and Troubleshooting', 'ITT 076667', 1, 8),
(3, 'Advance Web', 'ITT 07144', 1, 10),
(4, 'Development Perspective', 'ITT 076667', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `sickness` tinyint(1) NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `other_reason` tinyint(1) NOT NULL,
  `paid_all` tinyint(1) NOT NULL,
  `paid_half` tinyint(1) NOT NULL,
  `not_paid_at_all` tinyint(1) NOT NULL,
  `sickness_file` varchar(255) DEFAULT NULL,
  `other_reason_text` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `student_id` bigint(20) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `paid_tution_fee_amount` float DEFAULT NULL,
  `paid_tution_fee_receipts` varchar(255) DEFAULT NULL,
  `paid_half_fee_amount` float DEFAULT NULL,
  `paid_half_fee_receipt` varchar(255) DEFAULT NULL,
  `resume_expected` text DEFAULT NULL,
  `account_officer_signature` varchar(255) DEFAULT NULL,
  `account_officer_stamp` varchar(255) DEFAULT NULL,
  `account_officer_date` varchar(255) DEFAULT NULL,
  `account_id` int(20) DEFAULT NULL,
  `has_paid` tinyint(1) DEFAULT NULL,
  `left_balance` int(11) DEFAULT NULL,
  `hod_id` bigint(20) DEFAULT NULL,
  `rector_id` bigint(20) DEFAULT NULL,
  `deputy_rector_id` bigint(20) DEFAULT NULL,
  `registar_id` bigint(20) DEFAULT NULL,
  `registar_rejected` tinyint(1) DEFAULT NULL,
  `registar_date` varchar(255) DEFAULT NULL,
  `deputy_rector_rejected` tinyint(1) DEFAULT NULL,
  `rector_rejected` tinyint(1) DEFAULT NULL,
  `hod_rejected` tinyint(1) DEFAULT NULL,
  `hod_date` varchar(255) DEFAULT NULL,
  `rector_date` varchar(255) DEFAULT NULL,
  `deputy_rector_date` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rector_stamp` varchar(255) DEFAULT NULL,
  `deputy_rector_stamp` varchar(255) DEFAULT NULL,
  `hod_stamp` varchar(255) DEFAULT NULL,
  `registar_stamp` varchar(255) DEFAULT NULL,
  `hod_rejected_reason` text DEFAULT NULL,
  `rector_rejected_reason` text DEFAULT NULL,
  `registar_rejected_reason` text DEFAULT NULL,
  `deputy_rector_rejected_reason` text DEFAULT NULL,
  `approvedrequest` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`sickness`, `payment`, `other_reason`, `paid_all`, `paid_half`, `not_paid_at_all`, `sickness_file`, `other_reason_text`, `id`, `student_id`, `date`, `paid_tution_fee_amount`, `paid_tution_fee_receipts`, `paid_half_fee_amount`, `paid_half_fee_receipt`, `resume_expected`, `account_officer_signature`, `account_officer_stamp`, `account_officer_date`, `account_id`, `has_paid`, `left_balance`, `hod_id`, `rector_id`, `deputy_rector_id`, `registar_id`, `registar_rejected`, `registar_date`, `deputy_rector_rejected`, `rector_rejected`, `hod_rejected`, `hod_date`, `rector_date`, `deputy_rector_date`, `status`, `rector_stamp`, `deputy_rector_stamp`, `hod_stamp`, `registar_stamp`, `hod_rejected_reason`, `rector_rejected_reason`, `registar_rejected_reason`, `deputy_rector_rejected_reason`, `approvedrequest`) VALUES
(0, 0, 0, 1, 0, 0, 'NULL', 'I will resume on the next semister', 50, 7, '2022-07-12', NULL, 'NULL', NULL, 'NULL', 'alskdjalksjdlkasd', NULL, NULL, '2022-07-21', 6, 1, NULL, 4, 2, 3, 5, 0, '2022-07-15', 0, 0, 0, '2022-07-13', '2022-07-21', '2022-07-13', 'pending', NULL, NULL, NULL, NULL, '', '', '', '', 0),
(0, 0, 1, 1, 0, 0, 'NULL', 'i attened seminar i uk', 51, 27, '2022-07-19', 4500000, '1658231136MFUMO WA MAOMBI YA KAZI ZA UKARANI NA USIMAMIZI WA SENSA _ Fomu Na. 1 ya maombi ya kazi za Sensa 2022.pdf', NULL, 'NULL', 'Next semister', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, NULL, 0, 0, NULL, NULL, '', '', 'pending', NULL, NULL, NULL, NULL, NULL, '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'rector'),
(3, 'deputy-rector'),
(4, 'admission-officer'),
(5, 'hod'),
(6, 'accountant'),
(7, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_id` bigint(20) DEFAULT NULL,
  `admission_number` varchar(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  `level_id` bigint(20) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `semister` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `department_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `email`, `password`, `course_id`, `admission_number`, `phone_number`, `academic_year`, `level_id`, `profile_image`, `semister`, `role_id`, `department_id`) VALUES
(3, 'Sienna', 'MabelleCon', ' nerO', 'deputyrector@gmail.com', '123', NULL, '', 9090, '', NULL, '1655901799.Screenshot_20220610-185339.jpg', NULL, 3, 1),
(4, 'Anabelle', 'Hyman ', 'Mayer', 'hod@gmail.com', '$2y$10$xSmIpAtmQSoIRJ4LlcnDtOsYurN9dPmL8VA50Nz2xeYgvG51KSCPy', NULL, NULL, 192, NULL, NULL, '1655901898.index.jpeg', NULL, 5, NULL),
(5, 'Junius', 'Richie', 'Kub', 'admin@gmail.com', '$2y$10$7fdADyUMWZYFjeNtVSz5yu7HxWaYDocPaJEZSRNMD5b8MzLN.ayfW', NULL, NULL, 503, NULL, NULL, '1656025724.skcoin.jpg', NULL, 4, NULL),
(6, 'Adrianna', 'Frankie ', 'Stehr', 'account@gmail.com', '$2y$10$LNsOuaTy5X0UNNR.8KE2UOrS0mcaQJx0s3hv.Ig.Y4/zWPAyOYV3G', NULL, NULL, 178, NULL, NULL, '1656028755.default_avata.jpg', NULL, 6, NULL),
(7, 'Hood', 'Yost', 'Philip', 'hood@gmail.com', '$2y$10$1y9bIBuu2QujTTSkl1X5Su5FejJMdVtTVbB92dIihTd.YWHxxPwUq', 1, '19050512029', 76767676, '2022/2023', 6, '1656379903.index.jpeg', 2, 7, 1),
(9, 'Nissim', 'Moses ', 'Bush', 'student@gmail.com', '$2y$10$M67XgZCS3FifPMtjCgCZYOiSijIIxL1f1NrQU5f97z7hP86xET/uy', 5, '396', 864, '2017/2018', 8, '1656456048.undraw_No_data_re_kwbl.png', 2, 7, 1),
(13, 'Palmer', 'Lysandra', 'Hopkins', 'palmer@mailinator.com', '$2y$10$cNx4/V2/G.K6szD8ZAqL3.P9l5TZpjrUCFBCFVxtb5uU7p3yeGW4G', 1, '378', 478, '2019/2020', 2, '1656847845.', 1, 7, 1),
(14, 'Tatum', 'Uriel ', 'Heath', 'tatum@mailinator.com', '$2y$10$VnDjSJIgcanibFwxBrgw4.i5WnK8kiu8TmuJ0wOZvA/UAnVf.yUBW', 4, '296', 339, '2020/2021', 9, '1656848954.', 2, 1, NULL),
(15, 'Juvenal', 'Cortney ', 'Otis ', 'juvenal@gmail.com', '$2y$10$aI2x0vECZsyexFWvKehoduiyFy3tEHo3.pfG0.UCE05nzbZ5A6vly', 10, '172', 513, '2022/2023', 3, '1657811545.skcoin.jpg', 1, 7, 2),
(17, 'Damon', 'Mona', 'Alaina ', 'damon@gmail.com', '$2y$10$mBdc3KXKrjAxRWsecvUqHOZg4eZOD/0bFBQr4/6pFRPc.f2wmw2aK', 4, '507', 192, '2023/2024', 4, '1657896867.background.jpg', 2, 7, 3),
(27, 'jules', 'jasper', 'said', 'jules@gmail.com', '$2y$10$6BAafeexa7w55K/ZLp2EBubRXSoW3fWlMTwMmEhcYmqb41QUWFfzy', 10, '18050512020', 765643299, '2022/2023', 6, '1658229819.Screenshot_20220617-012915.jpg', 2, 7, 3),
(28, 'Robyn', 'Magdalen Labadie', 'Zola Considine', 'C1N@gmail.com', '$2y$10$GEST/Bixp0SnNUWRmaqR/eI5jSAE4wc8g2v03xOR0LPNpLD0bXrhK', 9, '46', 150, '2022/2023', 6, '1686352124.icons8-macos-close-90.png', 2, 7, 4),
(29, 'Maude', 'Bennett Herman', 'Jannie Rohan', 'NKq@gmail.com', '$2y$10$0e6K5.yl5Xk6ZFC255UsOuhaO3JldgSLkSUUuv8wTZRun2c0WdPci', 3, '628', 257, 'Culpa at ut eius sunt amet est temporibus.', 5, '1686352283.Screenshot_20230605-205211.png', 2, 7, 1),
(30, 'Audreanne', 'Ali Altenwerth', 'Layla Leuschke', 'xAp@gmail.com', '$2y$10$bXFc8o5Fe3JHv/huhujfbu81A56NHMkuN0ykBfVBOZXnuq4qb3/KK', 1, '372', 372, '2022/2023', 7, '1686361707.bronze.png', 2, 7, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved`
--
ALTER TABLE `approved`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
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
-- AUTO_INCREMENT for table `approved`
--
ALTER TABLE `approved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
