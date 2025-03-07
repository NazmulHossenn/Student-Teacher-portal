-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 10:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-12-23 13:02:18'),
(2, 'admin2', '123456', '2020-06-11 12:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `attendtance`
--

CREATE TABLE `attendtance` (
  `att_id` int(20) NOT NULL,
  `class_id` int(20) NOT NULL,
  `student_id` int(20) NOT NULL,
  `subject_id` int(20) NOT NULL,
  `student_status_at` varchar(250) NOT NULL,
  `att_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendtance`
--

INSERT INTO `attendtance` (`att_id`, `class_id`, `student_id`, `subject_id`, `student_status_at`, `att_date`) VALUES
(130, 1, 3, 2, 'present', '2013-01-09'),
(131, 1, 4, 2, 'present', '2013-01-09'),
(132, 1, 6, 2, 'present', '2013-01-09'),
(133, 1, 1, 1, 'present', '2013-01-09'),
(134, 1, 3, 1, 'present', '2013-01-09'),
(135, 1, 4, 1, 'absent', '2013-01-09'),
(136, 1, 6, 1, 'present', '2013-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `result_sheet`
--

CREATE TABLE `result_sheet` (
  `res_id` int(20) NOT NULL,
  `res_year` int(20) NOT NULL,
  `res_class_id` int(20) NOT NULL,
  `res_sub` int(20) NOT NULL,
  `res_student_id` int(20) NOT NULL,
  `res_student_roll` int(20) NOT NULL,
  `res_mark` int(20) NOT NULL,
  `res_class_parsent` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) NOT NULL,
  `Section` varchar(5) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(1, 'one', 1, 'a', '2022-12-14 06:44:41', '0000-00-00 00:00:00'),
(2, 'two', 2, 'a', '2022-12-14 15:47:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(5, 1, 1, 1, 100, '2022-12-22 13:33:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) NOT NULL,
  `RollId` varchar(100) NOT NULL,
  `StudentEmail` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `pass`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(1, 'hf', '1', 'nhf@gmail.com', 'Male', '2013-01-02', '110825', 1, '2022-12-14 06:46:00', '2022-12-24 18:36:02', 1),
(3, 'b', '122', 'as@gmail.com', 'Male', '2022-12-06', '110825', 1, '2022-12-18 16:04:47', '2022-12-24 19:32:36', 1),
(4, 'mr alex', '110824', 'alex@gmail.com', 'Male', '2007-01-14', '110825', 1, '2022-12-21 21:33:46', '2022-12-24 18:36:23', 1),
(5, 'john doe', '12', 'john@gmail.com', 'Male', '2013-01-02', '110825', 2, '2022-12-23 11:31:31', '2022-12-24 19:32:40', 1),
(6, 'mr john doe', '456', 'john@gmail.com', 'Male', '2009-01-25', '110825', 1, '2022-12-24 18:35:51', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `idd` int(11) NOT NULL,
  `ClassId` int(11) NOT NULL,
  `SubjectId` int(11) NOT NULL,
  `t_id` int(20) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`idd`, `ClassId`, `SubjectId`, `t_id`, `status`, `CreationDate`, `Updationdate`) VALUES
(17, 1, 1, 3, 1, '2022-12-21 21:24:51', '2022-12-21 21:24:51'),
(18, 1, 2, 2, 1, '2022-12-21 21:25:01', '2022-12-21 21:25:01'),
(19, 1, 2, 3, 1, '2022-12-21 21:25:06', '2022-12-21 21:25:06'),
(20, 1, 3, 3, 1, '2022-12-21 21:25:21', '2022-12-21 21:25:21'),
(21, 2, 3, 4, 1, '2022-12-23 11:34:11', '2022-12-23 11:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `s_id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) NOT NULL,
  `Creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`s_id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'bangla', '1', '2022-12-14 06:45:02', '0000-00-00 00:00:00'),
(2, 'english', '2', '2022-12-14 06:45:10', '0000-00-00 00:00:00'),
(3, 'math', '3', '2022-12-14 06:45:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `tname` text NOT NULL,
  `email` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `UserName`, `tname`, `email`, `Password`) VALUES
(1, 'rakib', 'Rakib', 'rakib@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_add`
--

CREATE TABLE `teacher_add` (
  `teacher_id` int(20) NOT NULL,
  `teacher_name` varchar(250) NOT NULL,
  `teacher_email` varchar(250) NOT NULL,
  `Gender` varchar(250) NOT NULL,
  `teacher_password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_add`
--

INSERT INTO `teacher_add` (`teacher_id`, `teacher_name`, `teacher_email`, `Gender`, `teacher_password`) VALUES
(1, 'ads', 'asd@gmail.com', 'Male', 'asd'),
(2, 'asd', 'asd2@gmail.com', 'Male', 'asdasd'),
(3, 'mr khan', 'mr@gmail.com', 'Male', '123456'),
(4, 'alex', 'alex@gmail.com', 'Male', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendtance`
--
ALTER TABLE `attendtance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `result_sheet`
--
ALTER TABLE `result_sheet`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`idd`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_add`
--
ALTER TABLE `teacher_add`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendtance`
--
ALTER TABLE `attendtance`
  MODIFY `att_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `result_sheet`
--
ALTER TABLE `result_sheet`
  MODIFY `res_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_add`
--
ALTER TABLE `teacher_add`
  MODIFY `teacher_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
