-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2016 at 12:41 PM
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
(27, 1, 'Scientific Research Methodology', 1, '', 'CSE 5000', '1.5', 'Nature of the research process, types of research, ethics of research: voluntary participation, anonymity and confidentiality, deceiving subjects, analysis and reporting; research proposal, planning, purposes of research: exploration, description, explanation, â€˜hard-dataâ€™ focus, â€˜soft-dataâ€™ focus, conceptualization; some practical considerations: time, venue, instrument to be used etc, research team, interviewers, willingness of respondents to participate; data collection: four levels of evaluation, levels of data collection/unit of analysis; research methods and tools: interviews, group techniques, observation, questionnaires, company records/archive/information, self generated measures; sampling; data analysis and interpretation: quantitative analysis, qualitative analysis; report writing: academic writing, technical writing; feedback sessions', 'course_content/15.jpg', '', '2016-01-20 20:44:28', '2016-01-20 22:01:57'),
(28, 1, 'Seminar', 1, '', 'CSE 5001', '1.5', 'Participants will work individually to prepare reviews of papers/topics assigned by course teacher and present before audience.', 'course_content/14.jpg', '', '2016-01-20 21:40:09', '2016-01-20 22:01:29'),
(29, 1, 'Advanced Algorithms', 1, '', 'CSE 5101', '3.0', 'Randomized Algorithms: Las Vegas and Monte Carlo Algorithms; Randomized Data Structures: Skip Lists; Amortized Analysis: Different methods, Applications in Fibonacci Heaps; Lower Bounds: Decision Trees, Information Theoretic Lower Bounds, Adversary Arguments; Approximation Algorithms: Approximation Schemes, Hardness of Approximation; Fixed Parameter Tractability: Parameterized Complexity, Techniques of designing Fixed Parameter Algorithms, Examples; Online Algorithms: Competitive Analysis, Online Paging Problem, k-server Problem; External Memory Algorithms; Advanced Data Structures: Linear and Non-linear Methods', 'course_content/10.jpg', '', '2016-01-20 21:43:05', '2016-01-20 22:01:37'),
(30, 1, 'Combinatorial Optimization', 1, '', 'CSE 5102', '3.0', 'Introduction to Optimization; Linear Programming: Different forms, Simplex Method, Primal-Dual theory; Max-Flow: The Max-Flow-Min-Cut Theorem, Ford-Fulkerson Labeling Algorithm, Dijkstra''s Algorithm, The Floyd-Warshall Algorithm; Some Network Flow Algorithms: The Minimum Cost Network Flow Method, Transportation Problem; Capacitated Transportation Problem, Assignment Problem; Integer Linear Programming; Relaxation; Cutting-Plane Algorithm; Branch and Bound Technique; Dynamic Programming; NP-Completeness; TSP and Heuristics; Approximation.', 'course_content/101.jpg', '', '2016-01-20 21:45:33', '2016-01-20 22:23:42'),
(31, 12, 'Graph Theory', 1, '', 'CSE 5103', '3.0', 'Introduction, Fundamental concepts, Trees, Spanning trees in graphs, Distance in graphs, Eulerian graphs, Digraphs, Matching and factors, Cuts and connectivity, k-connected graphs, Network flow problems, Graph coloring: vertex coloring and edge coloring, Line graphs, Hamiltonian cycles, Planar graphs, Perfect graphs.', 'course_content/100.jpg', '', '2016-01-20 21:46:08', '2016-01-20 22:23:49'),
(32, 1, 'Computational Geometry', 1, '', 'CSE 5104', '3.0', 'Searching and Geometric Data Structures: Balanced binary search trees, Priority-search trees, Range searching, Interval trees, Segment trees, Algorithms and complexity of fundamental geometric objects: Polygon triangulation and art gallery theorem, Polygon partitioning, Convex-hulls in 2-dimension and 3-dimension, Dynamic convex-hulls; Geometric intersection: Line segment intersection and the plane-sweep algorithm, Intersection of polygons; Proximity: Voronoi diagrams, Delunay triangulations, closest and furthest pair; Visualization: Hidden surface removal and binary space partition (BSP) trees; Graph Drawings: Drawings of rooted trees (Layering, Radial drawings, HV-Drawings, Recursive winding), Drawings of planar graphs (Straight-line drawings, Orthogonal drawings, Visibility drawings); Survey of recent developments in computational geometry.', 'course_content/104.jpg', '', '2016-01-20 21:46:40', '2016-01-20 22:23:58'),
(33, 12, 'Bioinformatics Algorithms', 1, '', 'CSE 5105', '3.0', 'Introduction; Molecular biology basics: DNA, RNA, genes, and proteins; Restriction mapping algorithm; Motif in DNA sequences, motif finding algorithms; Genome rearrangements, sorting by reversals and breakpoints; DNA sequence alignments; Gene prediction; Space-efficient sequence alignments, sub-quadratic alignment; DNA sequencing, genome sequencing, protein sequencing, spectrum graphs; Combinatorial pattern matching: Exact pattern matching, heuristic similarity search algorithms, approximate string matching, BLAST, FASTA; Clustering: Microarrays, hierarchical clustering, K-means clustering, corrupted cliques problem, CAST clustering algorithm; Evolutionary trees.', 'course_content/107.jpg', '', '2016-01-20 21:47:18', '2016-01-20 22:24:07'),
(34, 16, 'Industrial Management and Law', 1, '', 'BA 3251', '0.75', 'Section A: Industrial Management: Administration, Management and Organization, Authority and Responsibility. Scientific Management, Organization Structure, Organization chart, Span of Control: Selection and Recruitment of employees, Training and its types, Promotion, Wage System and Incentives, Job Evaluation and Merit Rating, Plant Layout, Layout of Physical Facilities, Transportation and Storage, Material Handling, Maintenance, Maintenance Policy, Production Control in intermittent and Continuous Manufacturing Industry, Functions of Production Control, Purchasing Procedures: Inventory need and Methods of Control, Factors affecting Inventory building up, Economic Lot Size and Recorder Point.\r\nSection B: Law: Law of Contract, Elements of a valid Contract, Consideration, Parties component to contract, Sale of Goods, Hire and Purchase, Negotiable Instrument Act, Patent Right and Validity, Industrial Laws in Bangladesh: Factories Act, Industrial Relations Ordinance, Workmen''s Compensation Act.', 'course_content/7.jpg', '', '2016-01-20 21:49:09', '2016-01-20 22:07:51'),
(35, 6, 'Chemistry', 1, '', 'Chem 1151', '3.0', '', 'course_content/14.jpg', '', '2016-01-20 21:49:37', '2016-01-20 22:09:00'),
(36, 16, 'Government and Sociology', 1, '', 'HSS 1253', '2.0', '', 'course_content/8.jpg', '', '2016-01-20 21:51:34', '2016-01-20 22:24:23'),
(37, 16, 'Psychology', 1, '', 'HSS 2251', '3.0', '', 'course_content/11.jpg', '', '2016-01-20 21:52:13', '2016-01-20 22:01:46'),
(38, 3, 'Geometry and Differential Equations', 1, '', 'Math 1253', '3.0', '', 'course_content/2.jpg', '', '2016-01-20 21:52:44', '2016-01-20 22:01:08'),
(39, 3, 'Vector Analysis and Matrix', 1, '', 'Math 2153', '3.0', '', 'course_content/7.jpg', '', '2016-01-20 21:53:07', '2016-01-20 22:24:34'),
(40, 7, 'Physics II', 1, '', 'Phy 1253', '3.0', '', 'course_content/13.jpg', '', '2016-01-20 22:00:49', '2016-01-20 22:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` int(10) UNSIGNED NOT NULL,
  `sl` int(11) NOT NULL,
  `lecture_no` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `sl`, `lecture_no`, `topic`, `comment`, `course_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(18, 1, 'Lecture 1', 'aaaa', 'aaaaaaaaaaaaaa', 27, 24, '2016-01-21 00:33:54', '2016-01-21 11:32:28'),
(19, 2, 'Lecture 2', 'gfhfgh', '', 27, 24, '2016-01-21 00:34:31', '2016-01-21 11:32:22'),
(20, 3, 'Lecture 3', 'dfsdfdsf', '', 27, 24, '2016-01-21 00:35:43', '2016-01-21 11:32:41'),
(23, 4, '', 'Class test', '', 27, 24, '2016-01-21 11:38:08', '2016-01-21 11:38:08');

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
(1, 'Computer Science Engineering', 'CSE', '2016-01-07 10:34:58', '2016-01-20 21:11:24'),
(2, 'Electronics and Communication Discipline', 'ECE', '2016-01-20 13:22:11', '2016-01-20 13:22:11'),
(3, 'Mathematics Discipline', 'Math', '2016-01-20 13:22:29', '2016-01-20 13:22:29'),
(4, 'Architecture', 'Arch', '2016-01-20 21:11:37', '2016-01-20 21:11:37'),
(5, 'Urban and Rural Planning', 'URP', '2016-01-20 21:12:32', '2016-01-20 21:12:32'),
(6, 'Chemistry', 'Chem', '2016-01-20 21:14:24', '2016-01-20 21:14:24'),
(7, 'Physics', 'Phy', '2016-01-20 21:14:54', '2016-01-20 21:14:54'),
(8, 'Statistics', 'Stat', '2016-01-20 21:15:17', '2016-01-20 21:15:17'),
(9, 'Forestry and Wood Technology', 'FWT', '2016-01-20 21:18:13', '2016-01-20 21:18:13'),
(10, 'Fisheries and Marine Resource Technology', 'FMRT', '2016-01-20 21:18:24', '2016-01-20 21:18:24'),
(11, 'Biotechnology and Genetic Engineering', 'BioTech', '2016-01-20 21:18:45', '2016-01-20 21:18:45'),
(12, 'Agrotechnology', 'AT', '2016-01-20 21:18:56', '2016-01-20 21:18:56'),
(13, 'Environmental Science', 'ES', '2016-01-20 21:19:08', '2016-01-20 21:19:08'),
(14, 'Pharmacy', 'Phar', '2016-01-20 21:19:24', '2016-01-20 21:19:24'),
(15, 'Soil Science', 'Soil ', '2016-01-20 21:19:35', '2016-01-20 21:19:35'),
(16, 'Business Administration', 'BAD', '2016-01-20 21:19:56', '2016-01-20 21:20:19'),
(17, 'English', 'English', '2016-01-20 21:20:30', '2016-01-20 21:20:30'),
(18, 'Bengali Language and Literature', 'Bengali', '2016-01-20 21:20:43', '2016-01-20 21:20:43'),
(19, 'Economics', 'Econ', '2016-01-20 21:20:57', '2016-01-20 21:20:57'),
(20, 'Sociology', 'Sociology', '2016-01-20 21:21:05', '2016-01-20 21:21:05'),
(21, 'Development Studies', 'DS', '2016-01-20 21:21:15', '2016-01-20 21:21:15');

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
(56, '', 19, 0, 'An IoT Big Data Streams Processing Framework in Data Centre Clouds.pdf', '2016-01-21 11:32:22', '2016-01-21 11:32:22'),
(57, '', 18, 0, 'An IoT Big Data Streams Processing Framework in Data Centre Clouds.pdf', '2016-01-21 11:32:28', '2016-01-21 11:32:28'),
(58, '', 18, 0, 'ag.png', '2016-01-21 11:32:28', '2016-01-21 11:32:28'),
(59, '', 18, 0, 'broadcasting.sql', '2016-01-21 11:32:28', '2016-01-21 11:32:28'),
(60, '', 18, 0, 'An IoT Big Data Streams Processing Framework in Data Centre Clouds.pdf', '2016-01-21 11:32:28', '2016-01-21 11:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hira_ku2003@yahoo.com', '88404fab76b16cffb6a82c7069eabaf37ce4ee0059d871c56f85d6201ee88eee', '2016-01-20 19:30:54');

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
(27, 27, '', '', '', '', '', '2016-01-20 20:44:28', '2016-01-20 20:44:28'),
(28, 28, '', '', '', '', '', '2016-01-20 21:40:09', '2016-01-20 21:40:09'),
(29, 29, '', '', '', '', '', '2016-01-20 21:43:05', '2016-01-20 21:43:05'),
(30, 30, '', '', '', '', '', '2016-01-20 21:45:33', '2016-01-20 21:45:33'),
(31, 31, '', '', '', '', '', '2016-01-20 21:46:08', '2016-01-20 21:46:08'),
(32, 32, '', '', '', '', '', '2016-01-20 21:46:40', '2016-01-20 21:46:40'),
(33, 33, '', '', '', '', '', '2016-01-20 21:47:18', '2016-01-20 21:47:18'),
(34, 34, 'Herold Koontz, Management. 5th Edition.', 'W. H. Newman, Administrative Action.', 'Terry & Frankin, Principle of Management. 8th Edition.', '', '', '2016-01-20 21:49:09', '2016-01-20 21:49:09'),
(35, 35, '', '', '', '', '', '2016-01-20 21:49:37', '2016-01-20 21:49:37'),
(36, 36, '', '', '', '', '', '2016-01-20 21:51:34', '2016-01-20 21:51:34'),
(37, 37, '', '', '', '', '', '2016-01-20 21:52:13', '2016-01-20 21:52:13'),
(38, 38, '', '', '', '', '', '2016-01-20 21:52:44', '2016-01-20 21:52:44'),
(39, 39, '', '', '', '', '', '2016-01-20 21:53:07', '2016-01-20 21:53:07'),
(40, 40, '', '', '', '', '', '2016-01-20 22:00:49', '2016-01-20 22:00:49');

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
(4, 150201, 1, 26, '2016-01-20 20:15:20', '2016-01-20 20:15:20'),
(5, 150202, 1, 27, '2016-01-20 20:16:29', '2016-01-20 20:16:29');

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
(23, -1, 26, 28, '2016-01-20 22:52:26', '2016-01-20 23:34:41'),
(24, 1, 26, 27, '2016-01-20 23:35:37', '2016-01-20 23:35:37'),
(25, 1, 26, 35, '2016-01-20 23:35:38', '2016-01-20 23:35:38'),
(26, 1, 26, 29, '2016-01-20 23:35:40', '2016-01-20 23:35:40'),
(27, 1, 27, 35, '2016-01-21 11:39:57', '2016-01-21 11:39:57');

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
(11, 'Assistant Professor', 1, 24, '2016-01-20 20:12:25', '2016-01-20 20:12:25'),
(12, 'Professor', 3, 25, '2016-01-20 20:14:06', '2016-01-20 20:14:06');

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
(26, 12, 38, 1, '2016-01-20 22:48:43', '2016-01-20 22:48:43'),
(27, 12, 39, 1, '2016-01-20 22:48:55', '2016-01-20 22:48:55'),
(28, 11, 27, 1, '2016-01-20 22:49:09', '2016-01-20 22:49:09'),
(29, 11, 28, 1, '2016-01-20 22:49:14', '2016-01-20 22:49:14'),
(30, 11, 29, 1, '2016-01-20 22:49:16', '2016-01-20 22:49:16'),
(31, 11, 35, 1, '2016-01-20 22:49:21', '2016-01-20 22:49:21'),
(32, 12, 35, 1, '2016-01-20 22:49:24', '2016-01-20 22:49:24'),
(33, 11, 36, 1, '2016-01-20 22:49:34', '2016-01-20 22:49:34'),
(34, 12, 36, 1, '2016-01-20 22:49:37', '2016-01-20 22:49:37');

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
(23, 'admin@amreenit.com', '$2y$10$8cgd3UeGodZhq2JFbL0DaeixuIYYgXwfK5iz/p1939afw//mSxKm2', '3', 'Mr', 'Admin', '', '1453320159a0.jpg', '', 0, NULL, 'F7xLqhPzVfH7DLK2Qop20xkLvouyJSGMGuLmWSgmz0vS11YQfmylPrGc2TnR', '2016-01-20 19:35:40', '2016-01-21 11:40:57'),
(24, 'aitldev1@gmail.com', '$2y$10$BXChC8nvDUM4xL/voBq4L.ji49xxIA2Qw4qVYnEtL1Psr730F1CuS', '1', 'SK Alamgir', 'Hossain', '', '1453320745photo.jpg', '8801711144146', 0, NULL, 'ovtXlq6Q91Ykq8bKGSAVfuooXyw43VnTKXC4WCzGxqNpZBYvDpS2QzFpb38O', '2016-01-20 20:12:25', '2016-01-21 11:39:32'),
(25, 'aitldev3@gmail.com', '$2y$10$w05ii/hPhUmrEJ10JK2HSuz/P5Kaip8wbuI/o1B1RtFmsPx6RdtiC', '1', 'Mr ', 'Teacher', '', '1453320845b7.jpg', '8801711144147', 0, NULL, NULL, '2016-01-20 20:14:05', '2016-01-20 20:25:10'),
(26, 'aitldev4@gmail.com', '$2y$10$BpBVAtEtT0fjbZlXBLhAredxHiIfdYyD2/w4HnNTWE1NAymt7sVBq', '2', 'David', 'Newton', '', '1453320920b14.jpg', '8801711144148', 0, NULL, 'WFxrkMBvUODLKIZmfQpt27Ns9bmDRvYeMOCQxlskEdC3cguiamBAjgWVqfgD', '2016-01-20 20:15:20', '2016-01-21 11:39:45'),
(27, 'aitldev5@gmail.com', '$2y$10$IrDS8inWV76fBOgj8VbtHObExwn0at1HW03C8IkGbXm0DUFrx9oUK', '2', 'Rakib', 'Hasan', '', '1453320988b16.jpg', '8801711144149', 0, NULL, 'Eh75gcjc7Y18NuFrRq7bm85jjqsBp0US080Lz7jTcqp7XCXLYITS04W0ynyI', '2016-01-20 20:16:28', '2016-01-21 11:40:00');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `multimedia_contents`
--
ALTER TABLE `multimedia_contents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
