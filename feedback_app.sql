-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 03:29 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_Name` varchar(30) NOT NULL,
  `Admin_ID` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_Name`, `Admin_ID`, `Password`, `branch`) VALUES
('CseAdmin', 'CSE123', 'cseadmin123', 'CSE'),
('EceAdmin', 'ECE123', 'eceadmin', 'ECE'),
('ItAdmin', 'IT123', 'itadmin', 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `comments_table`
--

CREATE TABLE `comments_table` (
  `faculty_name` varchar(40) NOT NULL,
  `year` int(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments_table`
--

INSERT INTO `comments_table` (`faculty_name`, `year`, `branch`, `subject`, `comment`) VALUES
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 'GOOD mohan rao sir'),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 'excellent\r\n'),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 'comments'),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 'mis');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_table`
--

CREATE TABLE `deleted_table` (
  `admin_name` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deleted_table`
--

INSERT INTO `deleted_table` (`admin_name`, `date_time`) VALUES
('CSE123', '2021-07-31 06:12:03'),
('CSE123', '2021-07-31 06:12:19'),
('CSE123', '2021-07-31 06:16:01'),
('CSE123', '2021-08-01 02:01:48'),
('CSE123', '2021-08-01 02:01:55'),
('CSE123', '2021-08-01 02:03:53'),
('CSE123', '2021-08-01 02:04:25'),
('CSE123', '2021-08-01 02:05:46'),
('CSE123', '2021-08-01 02:05:49'),
('CSE123', '2021-08-01 02:06:50'),
('CSE123', '2021-08-01 02:06:57'),
('CSE123', '2021-08-01 02:07:55'),
('CSE123', '2021-08-01 02:08:12'),
('CSE123', '2021-08-01 02:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `demo_feedback_table`
--

CREATE TABLE `demo_feedback_table` (
  `serialno` int(30) NOT NULL,
  `iname` varchar(40) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `qid` int(10) NOT NULL,
  `score` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `demo_questions`
--

CREATE TABLE `demo_questions` (
  `ques_id` int(10) NOT NULL,
  `question` text NOT NULL,
  `isselected` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demo_questions`
--

INSERT INTO `demo_questions` (`ques_id`, `question`, `isselected`) VALUES
(2, 'Question2', 0),
(12, 'Audible or not', 1),
(13, 'subject knowledge', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_table`
--

CREATE TABLE `faculty_table` (
  `facultyid` varchar(40) NOT NULL,
  `faculty_name` varchar(40) NOT NULL,
  `year` int(10) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `subject` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty_table`
--

INSERT INTO `faculty_table` (`facultyid`, `faculty_name`, `year`, `branch`, `subject`) VALUES
('4cse2Distributed_Systems', 'Mrs.G.Bhargavi', 4, 'CSE2', 'Distributed_Systems'),
('4cse2Machine_Learning', 'Mr.T.Krishna Kishore', 4, 'CSE2', 'Machine_Learning'),
('4cse2Management_Science', 'Mrs.K.L.Pavani', 4, 'CSE2', 'Management_Science'),
('4cse2Artificial_Neural_Networks', 'Dr.K.V.Srinivasa Rao', 4, 'CSE2', 'Artificial_Neural_Networks'),
('4itArtificial_Neural_Networks', 'Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks'),
('4itDistributed_Systems', 'Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems'),
('4cse1Artificial_Neural_Networks', 'Dr.K.V.Srinivasa Rao', 4, 'CSE1', 'Artificial_Neural_Networks'),
('4cse1Machine_Learning', 'Mr.T.Krishna Kishore', 4, 'CSE1', 'Machine_Learning'),
('4cse1Distributed_Systems', 'Mrs.G.Bhargavi', 4, 'CSE1', 'Distributed_Systems'),
('4cse1Management_Science', 'Mrs.K.L.Pavani', 4, 'CSE1', 'Management_Science'),
('4itMangament_Information_Science', 'Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science'),
('4itManagement_Science', 'Mr.Bhramaiah', 4, 'IT', 'Management_Science'),
('4MECHUCMP', 'Mr. K.Singaiah', 4, 'MECH', 'UCMP'),
('4MECHPPE', 'Mr. Punna Rao', 4, 'MECH', 'PPE'),
('4MECHAE', 'Mr. S.Chandrasekhar Reddy', 4, 'MECH', 'AE'),
('4MECHNDE', 'Mr. Sreenu Babu', 4, 'MECH', 'NDE'),
('3ECE2Distributed_Systems', 'shyam', 3, 'ECE2', 'Distributed_Systems');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_table`
--

CREATE TABLE `feedback_table` (
  `faculty_name` varchar(40) NOT NULL,
  `year` int(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `qid` int(20) NOT NULL,
  `score` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_table`
--

INSERT INTO `feedback_table` (`faculty_name`, `year`, `branch`, `subject`, `qid`, `score`) VALUES
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 1, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 2, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 3, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 4, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 5, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 6, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 7, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 8, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 9, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 10, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 1, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 2, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 3, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 4, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 5, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 6, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 7, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 8, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 9, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 10, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 1, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 2, 3),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 3, 2),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 4, 4),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 5, 2),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 6, 1),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 7, 3),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 8, 2),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 9, 3),
('Mr.Mohan Rao', 4, 'IT', 'Distributed_Systems', 10, 3),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 1, 3),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 2, 2),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 3, 1),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 4, 4),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 5, 3),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 6, 3),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 7, 3),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 8, 2),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 9, 2),
('Mrs.Manasa', 4, 'IT', 'Mangament_Information_Science', 10, 2),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 1, 4),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 2, 2),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 3, 3),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 4, 3),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 5, 2),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 6, 1),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 7, 1),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 8, 2),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 9, 3),
('Dr.K.V.Srinivasa Rao', 4, 'IT', 'Artificial_Neural_Networks', 10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `manage_interviewees`
--

CREATE TABLE `manage_interviewees` (
  `serialno` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `topic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_interviewees`
--

INSERT INTO `manage_interviewees` (`serialno`, `name`, `branch`, `topic`) VALUES
(1, 'Shyam', 'IT', 'ANN');

-- --------------------------------------------------------

--
-- Table structure for table `questions_table`
--

CREATE TABLE `questions_table` (
  `question_id` int(20) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions_table`
--

INSERT INTO `questions_table` (`question_id`, `question`) VALUES
(1, 'Knowledge base of the teacher (as perceived by you)'),
(2, 'Communication skills (in terms of articulation and comprehensibility )'),
(3, 'Sincerity / Commitment of the teacher ( in terms of preparedness and interest in taking classes)'),
(4, 'Interest generated by the teacher in the class'),
(5, 'Ability to integrate course material with environment / other issues, to provide a broader perspective'),
(6, 'Accessbility and availability of the teacher in the department for academic consultations'),
(7, 'Initiative taken in formulating topics / tests / assignments / examinations / seminars and projects'),
(8, 'Regularity in taking classes'),
(9, 'Completion of the course in a thorough and satisfactory manner'),
(10, 'Fairness in evaluating student performance and awarding grades');

-- --------------------------------------------------------

--
-- Table structure for table `servey`
--

CREATE TABLE `servey` (
  `year` int(10) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servey`
--

INSERT INTO `servey` (`year`, `branch`, `date`) VALUES
(4, 'IT', '2021-08-02 02:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_table`
--

CREATE TABLE `subjects_table` (
  `subject_id` varchar(30) NOT NULL,
  `subject` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects_table`
--

INSERT INTO `subjects_table` (`subject_id`, `subject`) VALUES
('R1642051', 'Distributed_Systems'),
('R1642051mech', 'UCMP'),
('R1642052Mech', 'PPE'),
('R1642053', 'Machine_Learning'),
('R1642053ece', 'co'),
('R164205B', 'Artificial_Neural_Networks'),
('R164205Bmech', 'NDE'),
('R1642121', 'Mangament_Information_Science'),
('R1642121mech', 'AE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demo_questions`
--
ALTER TABLE `demo_questions`
  ADD UNIQUE KEY `ques_id` (`ques_id`);

--
-- Indexes for table `questions_table`
--
ALTER TABLE `questions_table`
  ADD UNIQUE KEY `question_id` (`question_id`);

--
-- Indexes for table `subjects_table`
--
ALTER TABLE `subjects_table`
  ADD UNIQUE KEY `subject_id` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
