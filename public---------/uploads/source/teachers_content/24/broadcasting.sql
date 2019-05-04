-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2016 at 02:59 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `broadcasting`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `user_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'Hello', '2016-01-10 05:06:05', '2016-01-10 05:06:05'),
(2, 2, 10, 'dfgdfgdfg', '2016-01-10 15:11:25', '2016-01-10 15:11:25'),
(3, 2, 10, 'cvxcxcv', '2016-01-10 15:12:24', '2016-01-10 15:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `answer_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 'Hi', '2016-01-10 05:06:20', '2016-01-10 05:06:20'),
(2, 11, 1, 'Hello Sir, How are you?', '2016-01-10 05:08:26', '2016-01-10 05:08:26'),
(3, 11, 2, 'cxvcxvxcv', '2016-01-10 15:11:57', '2016-01-10 15:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `session_id` int(11) NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `related_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `discipline_id`, `name`, `session_id`, `caption`, `code`, `credit`, `description`, `image`, `related_link`, `created_at`, `updated_at`) VALUES
(1, 1, 'Computer Fundamentals', 1, 'Computer Fundamentals', 'CSE 1101', '3', 'Introduction to Computer: Introduction, types and generations of computers, basic organization and functional units, hardware and software; Number systems and Code: binary, octal, decimal and hexadecimal numbers, conversion between different number systems, binary arithmetic, BCD and ASCII codes, integer and floating point number representation; Input, output and memory devices: Keyboard, mouse, OMR, OCR, MICR, CD-ROM, different types of printers, CRTs, computer microfilm, floppy disks, hard disks, magnetic tapes, touch screen, touch pad, light pen, optical mouse, USB devices, Mobile HDD, Overview about microprocessor and other recent I/O devices, memory devices and recent microprocessors.', 'Hydrangeas.jpg', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 10:54:47', '2016-01-17 13:33:23'),
(2, 0, 'Structured Programming', 1, 'Structured Programming', 'CSE 1103', '3', 'Background of C; Programming Algorithms and flow chart construction; Structured Programming Concepts; Identifiers, variables, constants, operators and expressions; Program control statements; Arrays; String.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:07:49', '2016-01-07 11:07:49'),
(3, 3, 'Structure Programming Laboratory', 1, 'Structure Programming Laboratory', 'Math 1104', '1.5', 'Laboratory works based on CSE 1103.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:09:57', '2016-01-20 13:22:43'),
(4, 1, 'Object Oriented Programming', 1, 'Object Oriented Programming', 'CSE 1201', '3', 'Fundamentals of Object Oriented Programming; Overview of Java Language; Constants, Variables, data types; Operators, expressions, Control statements; Classes, objects, methods; Programs with interactive input; Inheritance, packages and interfaces; Arrays, strings, vectors; Exception handling.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:11:35', '2016-01-07 11:11:35'),
(5, 3, 'Object Oriented Programming Laboratory', 1, 'Object Oriented Programming Laboratory', 'CSE 1202', '1.5', 'Fundamentals of Object Oriented Programming; Overview of Java Language; Constants, Variables, data types; Operators, expressions, Control statements; Classes, objects, methods; Programs with interactive input; Inheritance, packages and interfaces; Arrays, strings, vectors; Exception handling.\r\nLaboratory works based on CSE 1201.\r\n', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:12:52', '2016-01-20 13:22:57'),
(6, 1, 'Discrete Mathematics', 1, 'Discrete Mathematics', 'CSE 1203', '3', 'Mathematical logic: Prepositional calculus, Predicate calculus. Set theory: Sets, Relations, Partial Ordered Sets, Lattices, Functions.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:14:14', '2016-01-07 11:14:14'),
(7, 2, 'Data Structure', 1, 'Data Structure', 'CSE 2101', '3', 'Concepts and examples of elementary data types and objects, concept of data structures, Arrays, Linked lists, Stacks, Recursion, Queues.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:18:38', '2016-01-20 13:22:51'),
(8, 1, 'Data Structure Laboratory', 1, 'Data Structure Laboratory', 'CSE 2102', '1.5', 'Laboratory based on the course CSE 2101.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:20:33', '2016-01-07 11:20:33'),
(9, 1, 'Digital Logic Design', 1, 'Digital Logic Design', 'CSE 2111', '3', 'Number Systems and Codes, Review of Set theory, Boolean Algebra, Boolean Function, Canonical Forms, Minimization of Boolean Functions, Logic Gates and their Truth Tables, Combinational Logic Design, Arithmetic and Data handling logic circuits - Decoders, Encoders, Multiplexer and Demultiplexer. NAND and NOR circuits. Reliable Design and Fault Diagnosis Hazards. Fault Detection in Combinational circuits, Fault Location Experiments, Threshold Logic.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:23:18', '2016-01-07 11:23:18'),
(10, 3, 'Digital Logic Design Laboratory', 1, 'Digital Logic Design Laboratory', 'CSE 2112', '1.5', 'Laboratory based on the course CSE 2111.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:25:48', '2016-01-20 13:23:15'),
(11, 1, 'Software Development Project', 1, 'Software Development Project', 'CSE 2200', '1.5', 'Students will develop structured Programs/Projects with proper documentation in high level language as assigned by teachers and will run on micro/mainframe computers.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:28:34', '2016-01-07 11:28:34'),
(12, 1, 'Algorithms', 1, 'Algorithms', 'CSE 2201', '3', 'Techniques for analysis of algorithms, Methods for design of efficient algorithms, Divide and Conquer, Greedy Method, Dynamics Programming, Backtracking, Branch and Bound.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:32:13', '2016-01-07 11:32:13'),
(13, 1, 'Algorithms Laboratory', 1, 'Algorithms Laboratory', 'CSE 2202', '1.5', 'Techniques for analysis of algorithms, Methods for design of efficient algorithms, Divide and Conquer, Greedy Method, Dynamics Programming, Backtracking, Branch and Bound.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 11:32:23', '2016-01-07 11:32:23'),
(14, 1, 'Computer Fundamentals', 2, 'Computer Fundamentals', 'CSE 1101', '3', 'Introduction to Computer: Introduction, types and generations of computers, basic organization and functional units, hardware and software; Number systems and Code: binary, octal, decimal and hexadecimal numbers, conversion between different number systems, binary arithmetic, BCD and ASCII codes, integer and floating point number representation; Input, output and memory devices: Keyboard, mouse, OMR, OCR, MICR, CD-ROM, different types of printers, CRTs, computer microfilm, floppy disks, hard disks, magnetic tapes, touch screen, touch pad, light pen, optical mouse, USB devices, Mobile HDD, Overview about microprocessor and other recent I/O devices, memory devices and recent microprocessors.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 04:54:47', '2016-01-07 04:54:47'),
(15, 1, 'Structured Programming', 2, 'Structured Programming', 'CSE 1103', '3', 'Background of C; Programming Algorithms and flow chart construction; Structured Programming Concepts; Identifiers, variables, constants, operators and expressions; Program control statements; Arrays; String.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:07:49', '2016-01-07 05:07:49'),
(16, 1, 'Structure Programming Laboratory', 2, 'Structure Programming Laboratory', 'CSE 1104', '1.5', 'Laboratory works based on CSE 1103.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:09:57', '2016-01-07 05:16:14'),
(17, 1, 'Object Oriented Programming', 2, 'Object Oriented Programming', 'CSE 1201', '3', 'Fundamentals of Object Oriented Programming; Overview of Java Language; Constants, Variables, data types; Operators, expressions, Control statements; Classes, objects, methods; Programs with interactive input; Inheritance, packages and interfaces; Arrays, strings, vectors; Exception handling.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:11:35', '2016-01-07 05:11:35'),
(18, 1, 'Object Oriented Programming Laboratory', 2, 'Object Oriented Programming Laboratory', 'CSE 1202', '1.5', 'Fundamentals of Object Oriented Programming; Overview of Java Language; Constants, Variables, data types; Operators, expressions, Control statements; Classes, objects, methods; Programs with interactive input; Inheritance, packages and interfaces; Arrays, strings, vectors; Exception handling.\r\nLaboratory works based on CSE 1201.\r\n', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:12:52', '2016-01-07 05:16:01'),
(19, 1, 'Discrete Mathematics', 2, 'Discrete Mathematics', 'CSE 1203', '3', 'Mathematical logic: Prepositional calculus, Predicate calculus. Set theory: Sets, Relations, Partial Ordered Sets, Lattices, Functions.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:14:14', '2016-01-07 05:14:14'),
(20, 1, 'Data Structure', 2, 'Data Structure', 'CSE 2101', '3', 'Concepts and examples of elementary data types and objects, concept of data structures, Arrays, Linked lists, Stacks, Recursion, Queues.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:18:38', '2016-01-07 05:18:38'),
(21, 1, 'Data Structure Laboratory', 2, 'Data Structure Laboratory', 'CSE 2102', '1.5', 'Laboratory based on the course CSE 2101.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:20:33', '2016-01-07 05:20:33'),
(22, 1, 'Digital Logic Design', 2, 'Digital Logic Design', 'CSE 2111', '3', 'Number Systems and Codes, Review of Set theory, Boolean Algebra, Boolean Function, Canonical Forms, Minimization of Boolean Functions, Logic Gates and their Truth Tables, Combinational Logic Design, Arithmetic and Data handling logic circuits - Decoders, Encoders, Multiplexer and Demultiplexer. NAND and NOR circuits. Reliable Design and Fault Diagnosis Hazards. Fault Detection in Combinational circuits, Fault Location Experiments, Threshold Logic.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:23:18', '2016-01-07 05:23:18'),
(23, 1, 'Digital Logic Design Laboratory', 2, 'Digital Logic Design Laboratory', 'CSE 2112', '1.5', 'Laboratory based on the course CSE 2111.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:25:48', '2016-01-07 05:25:48'),
(24, 1, 'Software Development Project', 2, 'Software Development Project', 'CSE 2200', '1.5', 'Students will develop structured Programs/Projects with proper documentation in high level language as assigned by teachers and will run on micro/mainframe computers.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:28:34', '2016-01-07 05:28:34'),
(25, 1, 'Algorithms', 2, 'Algorithms', 'CSE 2201', '3', 'Techniques for analysis of algorithms, Methods for design of efficient algorithms, Divide and Conquer, Greedy Method, Dynamics Programming, Backtracking, Branch and Bound.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:32:13', '2016-01-07 05:32:13'),
(26, 1, 'Algorithms Laboratory', 2, 'Algorithms Laboratory', 'CSE 2202', '1.5', 'Techniques for analysis of algorithms, Methods for design of efficient algorithms, Divide and Conquer, Greedy Method, Dynamics Programming, Backtracking, Branch and Bound.', '', 'http://www.cseku.ac.bd/undergrad/syllabus', '2016-01-07 05:32:23', '2016-01-07 05:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` int(10) UNSIGNED NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `topic`, `course_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(9, 'aaaaaaaaaa', 6, 16, '2016-01-18 21:39:28', '2016-01-18 21:39:28'),
(10, 'aaaaaaaaaaaaaaa', 6, 16, '2016-01-18 21:39:33', '2016-01-18 21:39:33'),
(11, 'zxczxccvxxcv', 6, 10, '2016-01-18 22:52:29', '2016-01-19 00:46:13'),
(12, 'zxczxc', 6, 10, '2016-01-19 00:46:51', '2016-01-19 00:46:51'),
(13, 'xvxcvx', 6, 10, '2016-01-19 00:54:05', '2016-01-19 00:54:05'),
(14, 'sdfsdf', 6, 10, '2016-01-19 01:15:02', '2016-01-19 01:15:02'),
(15, 'sdfsdf', 6, 10, '2016-01-19 01:15:42', '2016-01-19 01:15:42'),
(16, 'sdfdsfds', 6, 10, '2016-01-19 01:18:52', '2016-01-19 01:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science Eng.', 'CSE', '2016-01-07 10:34:58', '2016-01-07 10:34:58'),
(2, 'Electronics and Communication Discipline', 'ECE', '2016-01-20 13:22:11', '2016-01-20 13:22:11'),
(3, 'Mathematics Discipline', 'Math', '2016-01-20 13:22:29', '2016-01-20 13:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_28_044534_create_students_table', 1),
('2015_12_28_044657_create_teachers_table', 1),
('2015_12_28_044721_create_disciplines_table', 1),
('2015_12_28_062651_create_courses_table', 1),
('2015_12_28_104305_create_course_lectures_table', 1),
('2015_12_28_104326_create_multimedia_contents_table', 1),
('2015_12_28_104352_create_student_courses_table', 1),
('2015_12_31_084831_create_teacher_courses_table', 2),
('2016_01_02_132005_create_course_lectures_table', 3),
('2016_01_02_140651_create_references_table', 4),
('2016_01_04_085118_create_questions_table', 5),
('2016_01_04_085136_create_answers_table', 5),
('2016_01_04_085148_create_comments_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `multimedia_contents`
--

CREATE TABLE `multimedia_contents` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `file_path` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `multimedia_contents`
--

INSERT INTO `multimedia_contents` (`id`, `type`, `lecture_id`, `course_id`, `file_path`, `created_at`, `updated_at`) VALUES
(2, '', 0, 16, 'teachers_content/10/An IoT Big Data Streams Processing Framework in Data Centre Clouds.pdf', '2016-01-19 01:18:52', '2016-01-19 01:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_lecture_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `course_lecture_id`, `question`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 'Blah', '2016-01-10 05:05:33', '2016-01-10 05:05:33'),
(2, 11, 4, 'dfdsfd', '2016-01-10 15:10:42', '2016-01-10 15:10:42'),
(3, 11, 8, 'dfssdf', '2016-01-18 21:22:08', '2016-01-18 21:22:08'),
(4, 11, 1, 'fsdfsf', '2016-01-18 21:23:23', '2016-01-18 21:23:23'),
(5, 11, 1, 'bcbcvb', '2016-01-18 21:23:28', '2016-01-18 21:23:28'),
(6, 11, 9, 'This is my first question', '2016-01-18 21:52:15', '2016-01-18 21:52:15'),
(7, 11, 9, 'This is 2nd question', '2016-01-18 21:53:34', '2016-01-18 21:53:34'),
(8, 11, 9, 'This is 3rd question', '2016-01-18 21:53:45', '2016-01-18 21:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(11) NOT NULL,
  `reference_one` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_three` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_four` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_five` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `references`
--

INSERT INTO `references` (`id`, `course_id`, `reference_one`, `reference_two`, `reference_three`, `reference_four`, `reference_five`, `created_at`, `updated_at`) VALUES
(1, 1, 'V. Rajaraman, Fundamentals of Computers, PHI Learning Private Limited, India, 5th Edition, 2010. ', ' A.K. Gupta and S.K. Sarkar Elements of Computer Science, S. Chand and Company Ltd., India, 1st Edition.', 'P Norton and J. M. Goodman, Peter Norton''s Inside the PC, Pearson Education, 8th Edition, US, 1999.', '', '', '2016-01-07 10:54:47', '2016-01-07 10:54:47'),
(2, 2, 'E. Balaguruswamy, Programming in ANSI C, Tata McGraw-Hill Education, 5th Edition, India, 2011.', 'Herbert Schildt, Turbo C/C++: The Complete Reference, McGraw-Hill Ryerson Limited, 2nd Edition, US, 1992.', 'B. Gottried, Programming with C, The McGraw-Hill Companies Inc., 2nd Edition, US, 1996.', '', '', '2016-01-07 11:07:50', '2016-01-07 11:07:50'),
(3, 3, 'E. Balaguruswamy, Programming in ANSI C, Tata McGraw-Hill Education, 5th Edition, India, 2011.  ', 'Herbert Schildt, Turbo C/C++: The Complete Reference, McGraw-Hill Ryerson Limited, 2nd Edition, US, 1992.', 'B. Gottried, Programming with C, The McGraw-Hill Companies Inc., 2nd Edition, US, 1996.', '', '', '2016-01-07 11:09:57', '2016-01-07 11:09:57'),
(4, 4, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 11:11:35', '2016-01-07 11:11:35'),
(5, 5, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 11:12:52', '2016-01-07 11:12:52'),
(6, 6, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 11:14:14', '2016-01-07 11:14:14'),
(7, 7, 'Seymour Lipschutz, Theory and Problems of Data Structures, TATA McGRAW-HILL Edition.', 'Md. Rafiqul Islam, Ph.D, M.A. Mottalib, Ph.D, Data Structures Fundamentals, IUT. 2nd Edition.', 'Alfred V.Aho, John E. Hopcroft & Jeffrey D. Ullman, Data Structures and Algorithms, Addison-Wesley Professional.', '', '', '2016-01-07 11:18:38', '2016-01-07 11:18:38'),
(8, 8, 'Seymour Lipschutz, Theory and Problems of Data Structures, TATA McGRAW-HILL Edition.', 'Md. Rafiqul Islam, Ph.D, M.A. Mottalib, Ph.D, Data Structures Fundamentals, IUT. 2nd Edition.', 'Alfred V.Aho, John E. Hopcroft & Jeffrey D. Ullman, Data Structures and Algorithms, Addison-Wesley Professional.', '', '', '2016-01-07 11:20:33', '2016-01-07 11:20:33'),
(9, 9, 'Zvi Kohavi, Switching and Finite Automata Theory, Tata McGraw-Hill Publishing Company Limited, 2nd Edition.', 'Ronald J. Tocci, Digital Systems: Principles and Applications, Prentice-Hall of India Private Limited, 8th Edition.', '', '', '', '2016-01-07 11:23:18', '2016-01-07 11:23:18'),
(10, 10, 'Zvi Kohavi, Switching and Finite Automata Theory, Tata McGraw-Hill Publishing Company Limited, 2nd Edition.', 'Ronald J. Tocci, Digital Systems: Principles and Applications, Prentice-Hall of India Private Limited, 8th Edition.', '', '', '', '2016-01-07 11:25:48', '2016-01-07 11:25:48'),
(11, 11, '', '', '', '', '', '2016-01-07 11:28:34', '2016-01-07 11:28:34'),
(12, 12, 'Elias Horowitz, Sartaj Sahni & Sanguthever Rajasekaran, Computer Algorithms. Silicon Press 2nd Edition, US, 2008.', 'C. E. Leiserson, C Stein, T.H. Cormen and R. Rivest. Introduction to Algorithms. MIT Press, 3rd Edition, US, 2009.', '', '', '', '2016-01-07 11:32:13', '2016-01-07 11:32:13'),
(13, 13, 'Elias Horowitz, Sartaj Sahni & Sanguthever Rajasekaran, Computer Algorithms. Silicon Press 2nd Edition, US, 2008.', 'C. E. Leiserson, C Stein, T.H. Cormen and R. Rivest. Introduction to Algorithms. MIT Press, 3rd Edition, US, 2009.', '', '', '', '2016-01-07 11:32:23', '2016-01-07 11:32:23'),
(14, 14, 'V. Rajaraman, Fundamentals of Computers, PHI Learning Private Limited, India, 5th Edition, 2010. ', ' A.K. Gupta and S.K. Sarkar Elements of Computer Science, S. Chand and Company Ltd., India, 1st Edition.', 'P Norton and J. M. Goodman, Peter Norton''s Inside the PC, Pearson Education, 8th Edition, US, 1999.', '', '', '2016-01-07 04:54:47', '2016-01-07 04:54:47'),
(15, 15, 'E. Balaguruswamy, Programming in ANSI C, Tata McGraw-Hill Education, 5th Edition, India, 2011.', 'Herbert Schildt, Turbo C/C++: The Complete Reference, McGraw-Hill Ryerson Limited, 2nd Edition, US, 1992.', 'B. Gottried, Programming with C, The McGraw-Hill Companies Inc., 2nd Edition, US, 1996.', '', '', '2016-01-07 05:07:50', '2016-01-07 05:07:50'),
(16, 16, 'E. Balaguruswamy, Programming in ANSI C, Tata McGraw-Hill Education, 5th Edition, India, 2011.  ', 'Herbert Schildt, Turbo C/C++: The Complete Reference, McGraw-Hill Ryerson Limited, 2nd Edition, US, 1992.', 'B. Gottried, Programming with C, The McGraw-Hill Companies Inc., 2nd Edition, US, 1996.', '', '', '2016-01-07 05:09:57', '2016-01-07 05:09:57'),
(17, 17, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 05:11:35', '2016-01-07 05:11:35'),
(18, 18, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 05:12:52', '2016-01-07 05:12:52'),
(19, 19, 'H. Deitel and P. Deitel. Java: How to program. Prentice Hall, 9th edition, India, 2011.', 'E. Balagurusamy, Programming with Java, A Primer, Tata McGraw-Hill Publishing Company Pvt. Ltd., 4th Edition, India, 2010.', 'H. Schildt, Java The Complete Reference, The McGraw-Hill Companies Inc., 8th Edition, US, 2011.', 'I. Horton. Beginning Java, Java 7 Edition, John Willy and Sons Inc., 7th Edition, US, 2011.', '', '2016-01-07 05:14:14', '2016-01-07 05:14:14'),
(20, 20, 'Seymour Lipschutz, Theory and Problems of Data Structures, TATA McGRAW-HILL Edition.', 'Md. Rafiqul Islam, Ph.D, M.A. Mottalib, Ph.D, Data Structures Fundamentals, IUT. 2nd Edition.', 'Alfred V.Aho, John E. Hopcroft & Jeffrey D. Ullman, Data Structures and Algorithms, Addison-Wesley Professional.', '', '', '2016-01-07 05:18:38', '2016-01-07 05:18:38'),
(21, 21, 'Seymour Lipschutz, Theory and Problems of Data Structures, TATA McGRAW-HILL Edition.', 'Md. Rafiqul Islam, Ph.D, M.A. Mottalib, Ph.D, Data Structures Fundamentals, IUT. 2nd Edition.', 'Alfred V.Aho, John E. Hopcroft & Jeffrey D. Ullman, Data Structures and Algorithms, Addison-Wesley Professional.', '', '', '2016-01-07 05:20:33', '2016-01-07 05:20:33'),
(22, 22, 'Zvi Kohavi, Switching and Finite Automata Theory, Tata McGraw-Hill Publishing Company Limited, 2nd Edition.', 'Ronald J. Tocci, Digital Systems: Principles and Applications, Prentice-Hall of India Private Limited, 8th Edition.', '', '', '', '2016-01-07 05:23:18', '2016-01-07 05:23:18'),
(23, 23, 'Zvi Kohavi, Switching and Finite Automata Theory, Tata McGraw-Hill Publishing Company Limited, 2nd Edition.', 'Ronald J. Tocci, Digital Systems: Principles and Applications, Prentice-Hall of India Private Limited, 8th Edition.', '', '', '', '2016-01-07 05:25:48', '2016-01-07 05:25:48'),
(24, 24, '', '', '', '', '', '2016-01-07 05:28:34', '2016-01-07 05:28:34'),
(25, 25, 'Elias Horowitz, Sartaj Sahni & Sanguthever Rajasekaran, Computer Algorithms. Silicon Press 2nd Edition, US, 2008.', 'C. E. Leiserson, C Stein, T.H. Cormen and R. Rivest. Introduction to Algorithms. MIT Press, 3rd Edition, US, 2009.', '', '', '', '2016-01-07 05:32:13', '2016-01-07 05:32:13'),
(26, 26, 'Elias Horowitz, Sartaj Sahni & Sanguthever Rajasekaran, Computer Algorithms. Silicon Press 2nd Edition, US, 2008.', 'C. E. Leiserson, C Stein, T.H. Cormen and R. Rivest. Introduction to Algorithms. MIT Press, 3rd Edition, US, 2009.', '', '', '', '2016-01-07 05:32:23', '2016-01-07 05:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_session` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session`, `current_session`, `created_at`, `updated_at`) VALUES
(1, '2015-2016', 1, '2016-01-07 10:46:18', '2016-01-20 13:01:08'),
(2, '2014-2015', 0, '2016-01-07 10:59:14', '2016-01-20 13:01:02'),
(3, '2012-2013', 0, '2016-01-17 13:25:29', '2016-01-18 19:25:06'),
(4, '2011-2012', 0, '2016-01-17 13:25:37', '2016-01-18 19:25:11'),
(5, '2013-2014', 0, '2016-01-17 13:25:48', '2016-01-18 19:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `roll_no` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll_no`, `discipline_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 192250, 1, 11, '2016-01-07 12:52:13', '2016-01-07 12:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `status`, `student_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 2, 11, 1, '2016-01-18 07:00:10', '2016-01-18 07:00:19'),
(9, 2, 11, 6, '2016-01-18 20:02:26', '2016-01-18 21:17:56'),
(10, 1, 11, 7, '2016-01-18 20:02:28', '2016-01-18 20:02:28'),
(11, 1, 11, 12, '2016-01-18 20:02:29', '2016-01-18 20:02:29');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `designation`, `discipline_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Lecturer', 1, 10, '2016-01-07 09:32:15', '2016-01-07 09:32:15'),
(3, 'Lecturer', 1, 13, '2016-01-10 13:41:02', '2016-01-10 13:41:02'),
(5, 'Assistant Professor', 1, 15, '2016-01-18 11:04:04', '2016-01-18 11:04:04'),
(6, 'Assistant Professor', 1, 16, '2016-01-18 11:06:41', '2016-01-18 11:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`id`, `teacher_id`, `course_id`, `session_id`, `created_at`, `updated_at`) VALUES
(6, 1, 6, 1, '2016-01-18 08:54:25', '2016-01-18 08:54:25'),
(7, 1, 1, 1, '2016-01-18 09:03:04', '2016-01-18 09:03:04'),
(8, 2, 1, 1, '2016-01-18 09:07:34', '2016-01-18 09:07:34'),
(9, 6, 6, 1, '2016-01-18 11:12:53', '2016-01-18 11:12:53'),
(11, 1, 13, 1, '2016-01-18 19:11:32', '2016-01-18 19:11:32'),
(12, 1, 12, 1, '2016-01-18 19:14:45', '2016-01-18 19:14:45'),
(13, 1, 7, 1, '2016-01-18 19:24:34', '2016-01-18 19:24:34'),
(14, 1, 16, 2, '2016-01-18 19:24:50', '2016-01-18 19:24:50'),
(15, 1, 19, 2, '2016-01-18 19:24:53', '2016-01-18 19:24:53'),
(16, 1, 26, 2, '2016-01-18 19:24:57', '2016-01-18 19:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_of_interest` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `first_name`, `last_name`, `area_of_interest`, `image`, `phone`, `status`, `confirmation_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'alamgir@aitl.com', '$2y$10$BaJRzxYVHvtb5Yis8Qd3iOUvOadTnzLVV33TXRorQRMCZb8LbxAba', '3', 'Almagir', 'Hossain', 'Android', '1453129997a5.jpg', '0', 0, NULL, 'DVGOOquIBImChNC8sCVG2goCgmzu8W5m2B9EdFH1l1qvw9JcH6XO0XcOEYD7', '0000-00-00 00:00:00', '2016-01-20 03:49:17'),
(10, 'aitldev5@gmail.com', '$2y$10$BaJRzxYVHvtb5Yis8Qd3iOUvOadTnzLVV33TXRorQRMCZb8LbxAba', '1', 'Md', 'Foysal', 'Java, C#, C++', '1453129279b14.jpg', '8801858626671', 0, NULL, 'UHuMAu05RHSCgHSkhI1X9BHgvLCPD55fwG1FIk3LWoX85UATOUz2k0j1aW7I', '2016-01-07 09:32:15', '2016-01-20 03:51:18'),
(11, 'skfoysal36@gmail.com', '$2y$10$BaJRzxYVHvtb5Yis8Qd3iOUvOadTnzLVV33TXRorQRMCZb8LbxAba', '2', 'Shakil', 'Ahsan', '', '1452316432a0.jpg', '8801858626672', 0, NULL, 'yOpPdfndhcU25Tmajknf7zr0mpViTQO23oLK23ewGmMqpsmU2cuA6gpwGGfo', '2016-01-07 12:52:13', '2016-01-20 03:52:57'),
(13, 'joy@gmail.com', '$2y$10$BaJRzxYVHvtb5Yis8Qd3iOUvOadTnzLVV33TXRorQRMCZb8LbxAba', '1', 'AAAAAaaaa@@@222', 'Admin', '', '1452433261b0.jpg', '8801926228733', 1, '5fClQJeKEDHzKGNdweOiArfRMg6RfR', NULL, '2016-01-10 13:41:01', '2016-01-10 13:41:01'),
(16, 'aitldev1@gmail.com', '$2y$10$BaJRzxYVHvtb5Yis8Qd3iOUvOadTnzLVV33TXRorQRMCZb8LbxAba', '1', 'Md', 'Karim', 'C#, C++,Java', '1453129567a7.jpg', '8801192919191', 0, NULL, '7oiNDNGQORLEoUL1iBWDpVIKw8B9Zdk3MULZQ7ZjhXWY7HVkUO1uLK39NvCL', '2016-01-18 11:06:41', '2016-01-19 00:01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `multimedia_contents`
--
ALTER TABLE `multimedia_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `multimedia_contents`
--
ALTER TABLE `multimedia_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
