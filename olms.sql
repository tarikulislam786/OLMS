-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2018 at 07:24 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olms`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `created_at`, `updated_at`) VALUES
(1, 'Amorto Sen', '2017-02-06 22:27:30', '2018-05-19 10:45:27'),
(2, 'J.K Rowling', '2017-02-07 08:40:44', '2017-02-07 08:45:20'),
(4, 'Joseph Glioterao', '2017-02-07 08:45:56', '2017-02-07 08:46:08'),
(5, 'E.Balaguruswamy', '2017-02-07 08:53:32', '2017-02-07 08:53:32'),
(6, 'Herbert Schildt', '2017-02-07 08:53:55', '2017-02-07 08:53:55'),
(10, 'Pierre Richardson', '2017-02-07 15:30:04', '2017-02-07 15:30:04'),
(11, 'Jenelina', '2017-02-07 19:58:10', '2017-02-07 19:58:10'),
(13, 'Azarenka', '2017-02-08 09:33:02', '2017-04-14 14:50:25'),
(14, 'Henry', '2017-02-08 09:41:21', '2017-02-08 09:41:21'),
(15, 'Charles Darwin', '2017-02-13 00:24:24', '2017-02-13 00:24:24'),
(16, 'Fardin', '2017-02-13 00:36:05', '2018-05-20 14:28:01'),
(19, 'Steve Jones', '2017-02-13 10:36:03', '2017-02-13 10:36:03'),
(22, 'Harun or rashid', '2017-08-04 22:35:43', '2017-08-04 22:35:43'),
(25, 'Viernier', '2017-08-05 16:04:26', '2017-08-05 16:04:26'),
(33, 'Tarikul Islam', '2018-05-19 12:22:25', '2018-05-19 12:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `isbn_number` int(11) NOT NULL,
  `price` double NOT NULL,
  `piece_of_books` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `category_id`, `isbn_number`, `price`, `piece_of_books`, `created_at`, `updated_at`) VALUES
(1, 'Java Programming', 19, 999, 1000, 10, '2018-05-19 12:19:36', '2018-05-20 00:47:56'),
(2, 'Objective C', 24, 777, 550, 4, '2018-05-19 12:22:25', '2018-05-19 12:22:25'),
(4, 'Arts and Practice II', 17, 666, 490, 11, '2018-05-19 13:04:28', '2018-05-19 13:04:28'),
(5, 'Python Programming', 19, 555, 500, 26, '2018-05-20 14:07:50', '2018-05-20 14:07:50'),
(6, 'Artificial Intelligence', 24, 222, 650, 48, '2018-05-20 14:08:31', '2018-05-20 14:08:31'),
(7, 'Computer Networks And Securities', 19, 444, 700, 28, '2018-05-20 14:09:32', '2018-05-20 14:09:32'),
(8, 'Arabian Prehistory', 17, 611, 800, 18, '2018-05-20 14:10:44', '2018-05-20 14:10:44'),
(9, 'The Endless Rose', 23, 211, 740, 10, '2018-05-20 14:11:32', '2018-05-20 14:11:32'),
(10, 'The King of the Forest', 22, 311, 510, 18, '2018-05-20 14:12:06', '2018-05-20 14:12:06'),
(12, 'The King of the Forest', 22, 3111, 510, 18, '2018-05-20 14:13:23', '2018-05-20 14:13:23'),
(13, 'The Lottery Man', 23, 411, 400, 13, '2018-05-20 14:13:57', '2018-05-20 14:13:57'),
(14, 'Railroad Perfection', 23, 511, 360, 16, '2018-05-20 14:14:44', '2018-05-20 14:14:44'),
(15, 'The Origin of Species', 24, 111, 350, 17, '2018-05-20 14:15:37', '2018-05-20 14:15:37'),
(16, 'The Language of the Genes', 17, 333, 400, 19, '2018-05-20 14:16:32', '2018-05-20 14:16:32'),
(17, 'Cherish The Fairy', 22, 811, 245, 20, '2018-05-20 14:17:40', '2018-05-20 14:17:40'),
(18, 'Life Of Flora And Fauna', 24, 911, 450, 24, '2018-05-20 14:18:37', '2018-05-20 14:18:37'),
(19, 'Machine Learning', 19, 1111, 520, 15, '2018-05-20 14:19:30', '2018-05-20 14:19:30'),
(20, 'Cyber crime II', 17, 1112, 340, 26, '2018-05-20 14:20:25', '2018-05-20 14:20:25'),
(21, 'Angry birds', 22, 2111, 1200, 27, '2018-05-20 14:21:10', '2018-05-20 14:21:10'),
(22, 'ss', 22, 4322, 444, 2, '2018-05-29 09:25:22', '2018-05-29 09:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `books_author`
--

CREATE TABLE IF NOT EXISTS `books_author` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books_author`
--

INSERT INTO `books_author` (`book_id`, `author_id`) VALUES
(1, 5),
(2, 33),
(4, 1),
(5, 10),
(6, 4),
(7, 14),
(8, 15),
(9, 2),
(12, 13),
(13, 11),
(14, 11),
(15, 15),
(16, 4),
(17, 2),
(18, 19),
(19, 14),
(20, 10),
(21, 2),
(22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE IF NOT EXISTS `book_issues` (
  `id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `issue_details` varchar(10000) NOT NULL,
  `submitted_date` date NOT NULL,
  `late_charge` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `issue_date`, `student_id`, `user_id`, `name`, `issue_details`, `submitted_date`, `late_charge`, `created_at`, `updated_at`) VALUES
(1, '2018-05-13', 2147483645, 61, 'tarikul islam', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTEzIjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDUiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjEzOiJ0YXJpa3VsIGlzbGFtIjtzOjY6InVzZXJpZCI7czoyOiI2MSI7czoxMDoiaXNibm51bWJlciI7YTozOntpOjA7czozOiI3NzciO2k6MTtzOjM6IjYxMSI7aToyO3M6MzoiMTExIjt9czo4OiJib29rbmFtZSI7YTozOntpOjA7czoxMToiT2JqZWN0aXZlIEMiO2k6MTtzOjE4OiJBcmFiaWFuIFByZWhpc3RvcnkiO2k6MjtzOjIxOiJUaGUgT3JpZ2luIG9mIFNwZWNpZXMiO31zOjE2OiJib29rbmFtZV9ib29rX2lkIjthOjM6e2k6MDtzOjE6IjIiO2k6MTtzOjE6IjgiO2k6MjtzOjI6IjE1Ijt9czoxNToiYm9va19pc3N1ZV9kYXRlIjthOjM6e2k6MDtzOjEwOiIyMDE4LTA1LTEzIjtpOjE7czoxMDoiMjAxOC0wNS0xNCI7aToyO3M6MTA6IjIwMTgtMDUtMTUiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-13 14:38:40', '2018-05-13 14:38:40'),
(2, '2018-05-13', 201752589, 23, 'Aaron Mayers', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTEzIjtzOjQ6InN0aWQiO3M6OToiMjAxNzUyNTg5IjtzOjExOiJzdHVkZW50bmFtZSI7czoxMjoiQWFyb24gTWF5ZXJzIjtzOjY6InVzZXJpZCI7czoyOiIyMyI7czoxMDoiaXNibm51bWJlciI7YTo0OntpOjA7czozOiIzMzMiO2k6MTtzOjM6IjU1NSI7aToyO3M6MDoiIjtpOjM7czozOiI4MTEiO31zOjg6ImJvb2tuYW1lIjthOjQ6e2k6MDtzOjI1OiJUaGUgTGFuZ3VhZ2Ugb2YgdGhlIEdlbmVzIjtpOjE7czoxODoiUHl0aG9uIFByb2dyYW1taW5nIjtpOjI7czowOiIiO2k6MztzOjE3OiJDaGVyaXNoIFRoZSBGYWlyeSI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6NDp7aTowO3M6MjoiMTYiO2k6MTtzOjE6IjUiO2k6MjtzOjA6IiI7aTozO3M6MjoiMTciO31zOjE1OiJib29rX2lzc3VlX2RhdGUiO2E6Mzp7aTowO3M6MTA6IjIwMTgtMDUtMTMiO2k6MTtzOjEwOiIyMDE4LTA1LTE0IjtpOjI7czoxMDoiMjAxOC0wNS0xNSI7fXM6Njoic3VibWl0IjtzOjA6IiI7fQ==', '0000-00-00', 0, '2018-05-13 14:39:47', '2018-05-13 14:39:47'),
(3, '2018-05-13', 96325874, 54, 'John Doe', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTEzIjtzOjQ6InN0aWQiO3M6ODoiOTYzMjU4NzQiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjg6IkpvaG4gRG9lIjtzOjY6InVzZXJpZCI7czoyOiI1NCI7czoxMDoiaXNibm51bWJlciI7YTo0OntpOjA7czozOiI1NTUiO2k6MTtzOjM6IjIxMSI7aToyO3M6MDoiIjtpOjM7czozOiI0NDQiO31zOjg6ImJvb2tuYW1lIjthOjQ6e2k6MDtzOjE4OiJQeXRob24gUHJvZ3JhbW1pbmciO2k6MTtzOjE2OiJUaGUgRW5kbGVzcyBSb3NlIjtpOjI7czowOiIiO2k6MztzOjMyOiJDb21wdXRlciBOZXR3b3JrcyBBbmQgU2VjdXJpdGllcyI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6NDp7aTowO3M6MToiNSI7aToxO3M6MToiOSI7aToyO3M6MDoiIjtpOjM7czoxOiI3Ijt9czoxNToiYm9va19pc3N1ZV9kYXRlIjthOjM6e2k6MDtzOjEwOiIyMDE4LTA1LTEzIjtpOjE7czoxMDoiMjAxOC0wNS0xNCI7aToyO3M6MTA6IjIwMTgtMDUtMTUiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-13 14:40:16', '2018-05-13 14:40:16'),
(4, '2018-05-15', 20154742, 15, 'jahid rahman', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE1IjtzOjQ6InN0aWQiO3M6ODoiMjAxNTQ3NDIiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjEyOiJqYWhpZCByYWhtYW4iO3M6NjoidXNlcmlkIjtzOjI6IjE1IjtzOjEwOiJpc2JubnVtYmVyIjthOjQ6e2k6MDtzOjM6IjgxMSI7aToxO3M6MzoiNTU1IjtpOjI7czowOiIiO2k6MztzOjM6IjQ0NCI7fXM6ODoiYm9va25hbWUiO2E6NDp7aTowO3M6MTc6IkNoZXJpc2ggVGhlIEZhaXJ5IjtpOjE7czoxODoiUHl0aG9uIFByb2dyYW1taW5nIjtpOjI7czowOiIiO2k6MztzOjMyOiJDb21wdXRlciBOZXR3b3JrcyBBbmQgU2VjdXJpdGllcyI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6NDp7aTowO3M6MjoiMTciO2k6MTtzOjE6IjUiO2k6MjtzOjA6IiI7aTozO3M6MToiNyI7fXM6MTU6ImJvb2tfaXNzdWVfZGF0ZSI7YTozOntpOjA7czoxMDoiMjAxOC0wNS0xNSI7aToxO3M6MTA6IjIwMTgtMDUtMTYiO2k6MjtzOjEwOiIyMDE4LTA1LTE3Ijt9czo2OiJzdWJtaXQiO3M6MDoiIjt9', '0000-00-00', 0, '2018-05-15 14:46:25', '2018-05-15 14:46:25'),
(5, '2018-05-15', 201624569, 24, 'Rick Flayer', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE1IjtzOjQ6InN0aWQiO3M6OToiMjAxNjI0NTY5IjtzOjExOiJzdHVkZW50bmFtZSI7czoxMToiUmljayBGbGF5ZXIiO3M6NjoidXNlcmlkIjtzOjI6IjI0IjtzOjEwOiJpc2JubnVtYmVyIjthOjQ6e2k6MDtzOjM6IjUxMSI7aToxO3M6MzoiMTExIjtpOjI7czowOiIiO2k6MztzOjM6IjU1NSI7fXM6ODoiYm9va25hbWUiO2E6NDp7aTowO3M6MTk6IlJhaWxyb2FkIFBlcmZlY3Rpb24iO2k6MTtzOjIxOiJUaGUgT3JpZ2luIG9mIFNwZWNpZXMiO2k6MjtzOjA6IiI7aTozO3M6MTg6IlB5dGhvbiBQcm9ncmFtbWluZyI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6NDp7aTowO3M6MjoiMTQiO2k6MTtzOjI6IjE1IjtpOjI7czowOiIiO2k6MztzOjE6IjUiO31zOjE1OiJib29rX2lzc3VlX2RhdGUiO2E6Mzp7aTowO3M6MTA6IjIwMTgtMDUtMTUiO2k6MTtzOjEwOiIyMDE4LTA1LTE2IjtpOjI7czoxMDoiMjAxOC0wNS0xNyI7fXM6Njoic3VibWl0IjtzOjA6IiI7fQ==', '0000-00-00', 0, '2018-05-15 14:46:57', '2018-05-15 14:46:57'),
(6, '2018-05-15', 2016895623, 25, 'Enjo Mooray', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE1IjtzOjQ6InN0aWQiO3M6MTA6IjIwMTY4OTU2MjMiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjExOiJFbmpvIE1vb3JheSI7czo2OiJ1c2VyaWQiO3M6MjoiMjUiO3M6MTA6ImlzYm5udW1iZXIiO2E6NDp7aTowO3M6MzoiNzc3IjtpOjE7czozOiI4MTEiO2k6MjtzOjA6IiI7aTozO3M6NDoiMTExMSI7fXM6ODoiYm9va25hbWUiO2E6NDp7aTowO3M6MTE6Ik9iamVjdGl2ZSBDIjtpOjE7czoxNzoiQ2hlcmlzaCBUaGUgRmFpcnkiO2k6MjtzOjA6IiI7aTozO3M6MTY6Ik1hY2hpbmUgTGVhcm5pbmciO31zOjE2OiJib29rbmFtZV9ib29rX2lkIjthOjQ6e2k6MDtzOjE6IjIiO2k6MTtzOjI6IjE3IjtpOjI7czowOiIiO2k6MztzOjI6IjE5Ijt9czoxNToiYm9va19pc3N1ZV9kYXRlIjthOjM6e2k6MDtzOjEwOiIyMDE4LTA1LTE1IjtpOjE7czoxMDoiMjAxOC0wNS0xNiI7aToyO3M6MTA6IjIwMTgtMDUtMTciO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-15 14:47:23', '2018-05-15 14:47:23'),
(9, '2018-05-17', 2147483641, 17, 'sanjana rahid', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE3IjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDEiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjEzOiJzYW5qYW5hIHJhaGlkIjtzOjY6InVzZXJpZCI7czoyOiIxNyI7czoxMDoiaXNibm51bWJlciI7YTozOntpOjA7czozOiI0NDQiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9czo4OiJib29rbmFtZSI7YTozOntpOjA7czozMjoiQ29tcHV0ZXIgTmV0d29ya3MgQW5kIFNlY3VyaXRpZXMiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9czoxNjoiYm9va25hbWVfYm9va19pZCI7YTozOntpOjA7czoxOiI3IjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fXM6MTU6ImJvb2tfaXNzdWVfZGF0ZSI7YToxOntpOjA7czoxMDoiMjAxOC0wNS0xNyI7fXM6Njoic3VibWl0IjtzOjA6IiI7fQ==', '0000-00-00', 0, '2018-05-17 15:04:27', '2018-05-17 15:04:27'),
(10, '2018-05-18', 2147483644, 11, 'sanwarul hossain', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE4IjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDQiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjE2OiJzYW53YXJ1bCBob3NzYWluIjtzOjY6InVzZXJpZCI7czoyOiIxMSI7czoxMDoiaXNibm51bWJlciI7YTozOntpOjA7czozOiI2MTEiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9czo4OiJib29rbmFtZSI7YTozOntpOjA7czoxODoiQXJhYmlhbiBQcmVoaXN0b3J5IjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6Mzp7aTowO3M6MToiOCI7aToxO3M6MDoiIjtpOjI7czowOiIiO31zOjE1OiJib29rX2lzc3VlX2RhdGUiO2E6MTp7aTowO3M6MTA6IjIwMTgtMDUtMTgiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-18 15:09:25', '2018-05-18 15:09:25'),
(11, '2018-05-19', 2147483646, 13, 'aminul islam', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE5IjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDYiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjEyOiJhbWludWwgaXNsYW0iO3M6NjoidXNlcmlkIjtzOjI6IjEzIjtzOjEwOiJpc2JubnVtYmVyIjthOjQ6e2k6MDtzOjM6IjIyMiI7aToxO3M6MzoiNzc3IjtpOjI7czowOiIiO2k6MztzOjM6IjkxMSI7fXM6ODoiYm9va25hbWUiO2E6NDp7aTowO3M6MjM6IkFydGlmaWNpYWwgSW50ZWxsaWdlbmNlIjtpOjE7czoxMToiT2JqZWN0aXZlIEMiO2k6MjtzOjA6IiI7aTozO3M6MjM6IkxpZmUgT2YgRmxvcmEgQW5kIEZhdW5hIjt9czoxNjoiYm9va25hbWVfYm9va19pZCI7YTo0OntpOjA7czoxOiI2IjtpOjE7czoxOiIyIjtpOjI7czowOiIiO2k6MztzOjI6IjE4Ijt9czoxNToiYm9va19pc3N1ZV9kYXRlIjthOjM6e2k6MDtzOjEwOiIyMDE4LTA1LTE5IjtpOjE7czoxMDoiMjAxOC0wNS0xMiI7aToyO3M6MTA6IjIwMTgtMDUtMTYiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-19 15:11:31', '2018-05-19 15:11:31'),
(12, '2018-05-20', 2147483647, 14, 'shahin islam', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTIwIjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDciO3M6MTE6InN0dWRlbnRuYW1lIjtzOjEyOiJzaGFoaW4gaXNsYW0iO3M6NjoidXNlcmlkIjtzOjI6IjE0IjtzOjEwOiJpc2JubnVtYmVyIjthOjM6e2k6MDtzOjM6IjExMSI7aToxO3M6MDoiIjtpOjI7czowOiIiO31zOjg6ImJvb2tuYW1lIjthOjM6e2k6MDtzOjIxOiJUaGUgT3JpZ2luIG9mIFNwZWNpZXMiO2k6MTtzOjA6IiI7aToyO3M6MDoiIjt9czoxNjoiYm9va25hbWVfYm9va19pZCI7YTozOntpOjA7czoyOiIxNSI7aToxO3M6MDoiIjtpOjI7czowOiIiO31zOjE1OiJib29rX2lzc3VlX2RhdGUiO2E6MTp7aTowO3M6MTA6IjIwMTgtMDUtMjAiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-20 15:11:57', '2018-05-20 15:11:57'),
(17, '2018-05-17', 20167689, 22, 'Farhana Yesmin', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTE3IjtzOjQ6InN0aWQiO3M6ODoiMjAxNjc2ODkiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjE0OiJGYXJoYW5hIFllc21pbiI7czo2OiJ1c2VyaWQiO3M6MjoiMjIiO3M6MTA6ImlzYm5udW1iZXIiO2E6Mzp7aTowO3M6MzoiNzc3IjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fXM6ODoiYm9va25hbWUiO2E6Mzp7aTowO3M6MTE6Ik9iamVjdGl2ZSBDIjtpOjE7czowOiIiO2k6MjtzOjA6IiI7fXM6MTY6ImJvb2tuYW1lX2Jvb2tfaWQiO2E6Mzp7aTowO3M6MToiMiI7aToxO3M6MDoiIjtpOjI7czowOiIiO31zOjE1OiJib29rX2lzc3VlX2RhdGUiO2E6MTp7aTowO3M6MTA6IjIwMTgtMDUtMTciO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-17 15:40:29', '2018-05-17 15:40:29'),
(18, '2018-05-29', 2147483640, 16, 'sobhan hussain', 'YTo5OntzOjEwOiJpc3N1ZV9kYXRlIjtzOjEwOiIyMDE4LTA1LTI5IjtzOjQ6InN0aWQiO3M6MTA6IjIxNDc0ODM2NDAiO3M6MTE6InN0dWRlbnRuYW1lIjtzOjE0OiJzb2JoYW4gaHVzc2FpbiI7czo2OiJ1c2VyaWQiO3M6MjoiMTYiO3M6MTA6ImlzYm5udW1iZXIiO2E6Mzp7aTowO3M6MzoiMzMzIjtpOjE7czo0OiIxMTExIjtpOjI7czowOiIiO31zOjg6ImJvb2tuYW1lIjthOjM6e2k6MDtzOjI1OiJUaGUgTGFuZ3VhZ2Ugb2YgdGhlIEdlbmVzIjtpOjE7czoxNjoiTWFjaGluZSBMZWFybmluZyI7aToyO3M6MDoiIjt9czoxNjoiYm9va25hbWVfYm9va19pZCI7YTozOntpOjA7czoyOiIxNiI7aToxO3M6MjoiMTkiO2k6MjtzOjA6IiI7fXM6MTU6ImJvb2tfaXNzdWVfZGF0ZSI7YToyOntpOjA7czoxMDoiMjAxOC0wNS0yOSI7aToxO3M6MTA6IjIwMTgtMDUtMjkiO31zOjY6InN1Ym1pdCI7czowOiIiO30=', '0000-00-00', 0, '2018-05-29 09:35:52', '2018-05-29 09:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `parent` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent`, `status`) VALUES
(17, 'Arts', 'Management', 1),
(19, 'Engineering Books', 'Arts', 1),
(22, 'Fictions', 'Fictions', 1),
(23, 'Non-Fictions', 'Arts', 1),
(24, 'Science', 'Management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(11, 'Electronics and Communication ', 'ECE', '2016-11-27 21:24:59', '2016-11-27 21:24:59'),
(12, 'Mathematics Discipline', 'Math', '2016-11-27 21:25:24', '2016-11-27 21:25:24'),
(13, 'Architecture', 'Arch', '2016-11-27 21:25:46', '2016-11-27 21:25:46'),
(14, 'Urban and Rural Planning', 'URP', '2016-11-27 21:26:02', '2017-02-06 16:01:44'),
(15, 'Chemistry', 'Chem', '2016-11-27 21:26:17', '2016-11-27 21:26:17'),
(16, 'Physics2', 'Phy', '2016-11-27 21:26:38', '2016-11-27 21:26:38'),
(17, 'Statistics', 'Stat', '2016-11-27 21:26:53', '2016-11-27 21:26:53'),
(18, 'Forestry and Wood Technology', 'FWT', '2016-11-27 21:27:09', '2016-11-27 21:27:09'),
(19, 'Fisheries and Marine Resource ', 'FMRT', '2016-11-27 21:27:28', '2016-11-27 21:27:28'),
(20, 'Biotechnology and Genetic Engi', 'BioTech', '2016-11-27 21:27:45', '2016-11-27 21:27:45'),
(21, 'Agrotechnology', 'AT', '2016-11-27 21:28:05', '2016-11-27 21:28:05'),
(22, 'Environmental Science', 'ES', '2016-11-27 21:28:28', '2017-08-03 23:09:39'),
(23, 'Pharmacy', 'Phar', '2016-11-27 21:28:43', '2016-11-27 21:28:43'),
(24, 'Soil Science', 'Soil', '2016-11-27 21:29:02', '2016-11-27 21:29:02'),
(25, 'Business Administration', 'BAD', '2016-11-27 21:29:24', '2016-11-27 21:29:24'),
(26, 'English', 'English', '2016-11-27 21:29:42', '2016-11-27 21:29:42'),
(27, 'Bengali Language and Literatur', 'Bengali', '2016-11-27 21:29:52', '2016-11-27 21:29:52'),
(28, 'Archirr', 'Archi', '2018-05-29 09:28:34', '2018-05-29 09:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE IF NOT EXISTS `librarians` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 55, '2017-04-12 15:16:23', '2017-04-12 15:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL,
  `session_name` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_name`, `created_at`, `updated_at`) VALUES
(1, '2011-2012', '2016-11-27 08:43:25', '2016-11-27 21:31:06'),
(13, '2012-2013', '2016-11-27 21:31:14', '2016-11-27 21:31:14'),
(14, '2013-2014', '2016-11-27 21:31:22', '2016-11-27 21:31:22'),
(15, '2014-2015', '2016-11-27 21:31:30', '2016-11-27 21:31:30'),
(16, '2015-2016', '2016-11-27 21:31:37', '2016-11-27 21:31:37'),
(17, '2016-2017', '2016-11-27 21:31:48', '2016-11-27 21:31:48'),
(18, '2017-2018', '2017-02-27 19:20:20', '2017-02-27 19:20:20'),
(19, '2018-2019', '2017-02-27 19:20:31', '2017-02-27 19:20:31'),
(20, '2019-2020', '2017-02-27 19:20:44', '2017-02-27 19:20:44'),
(21, '2020-2021', '2017-02-27 19:20:58', '2017-02-27 19:20:58'),
(23, '2021-2022', '2017-08-04 20:32:04', '2017-08-04 20:32:04'),
(24, '2022-2023', '2017-08-04 20:32:18', '2017-08-04 21:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `discipline_id`, `session_id`, `roll_no`, `created_at`, `updated_at`) VALUES
(5, 11, 26, 13, 2147483644, '2016-11-28 19:51:22', '2016-11-28 19:51:22'),
(7, 13, 23, 19, 2147483646, '2016-11-28 19:56:24', '2016-11-28 19:56:24'),
(8, 14, 18, 14, 2147483647, '2016-11-28 20:11:40', '2016-11-28 20:11:40'),
(9, 15, 23, 16, 20154742, '2016-11-28 20:37:47', '2016-11-28 20:37:47'),
(10, 16, 14, 13, 2147483640, '2016-11-28 21:02:42', '2016-11-28 21:02:42'),
(11, 17, 14, 13, 2147483641, '2016-11-28 21:10:32', '2016-11-28 21:10:32'),
(14, 22, 19, 16, 20167689, '2017-02-13 00:09:53', '2017-02-13 00:09:53'),
(15, 23, 23, 17, 201752589, '2017-02-15 13:39:19', '2017-02-15 13:39:19'),
(16, 24, 21, 16, 201624569, '2017-02-15 13:41:09', '2017-02-15 13:41:09'),
(17, 25, 19, 16, 2016895623, '2017-02-15 13:42:31', '2017-02-15 13:42:31'),
(25, 54, 20, 19, 96325874, '2017-04-12 15:12:22', '2017-04-12 15:12:22'),
(30, 60, 12, 13, 666666, '2017-07-27 15:54:37', '2017-07-27 15:54:37'),
(31, 61, 16, 14, 2147483645, '2017-08-03 13:43:25', '2017-08-03 13:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `discipline_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `designation`, `discipline_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Other', 19, 18, '2016-11-28 22:22:22', '2016-11-28 22:22:22'),
(2, 'Professor', 19, 19, '2016-11-28 23:40:02', '2016-11-28 23:40:02'),
(5, 'Lecturer', 15, 53, '2017-04-12 15:11:02', '2017-04-12 15:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `confirmation_code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `status`, `image`, `confirmation_code`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '', 0, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'sanwarul', 'hossain', 'sanwar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '12121212', 0, '', '', '2016-11-28 19:51:22', '2016-11-28 19:51:22'),
(13, 'aminul', 'islam', 'aminul.islam815@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '01926228731', 0, '', '', '2016-11-28 19:56:24', '2016-11-28 19:56:24'),
(14, 'shahin', 'islam', 'shahin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '880155874512', 0, '', '', '2016-11-28 20:11:40', '2016-11-28 20:11:40'),
(15, 'jahid', 'rahman', 'jahid@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '321654165', 0, '', '', '2016-11-28 20:37:47', '2016-11-28 20:37:47'),
(16, 'sobhan', 'hussain', 'sobhan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '8801558745124', 0, '', '', '2016-11-28 21:02:42', '2016-11-28 21:02:42'),
(17, 'sanjana', 'rahid', 'tarikulislam2.cse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '019262287315', 0, '', '', '2016-11-28 21:10:32', '2016-11-28 21:10:32'),
(18, 'Anisur', 'Rahman', 'anisur@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '01926228700', 0, '', '', '2016-11-28 22:22:22', '2016-11-28 22:22:22'),
(19, 'Hashem', 'Sheikh', 'hashem@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '01554556', 0, '', '', '2016-11-28 23:40:02', '2016-11-28 23:40:02'),
(20, 'Charles', 'Stuart', 'charles-stuart@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '8801672851326', 0, '', '', '2017-02-12 12:38:13', '2017-02-12 12:38:13'),
(22, 'Farhana', 'Yesmin', 'farzana@yahoomail.com', '123456', 2, '0214574', 0, '', '', '2017-02-13 00:09:53', '2017-02-13 00:09:53'),
(23, 'Aaron', 'Mayers', 'aaronmayers@yahoomail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '8801936587412', 0, '', '', '2017-02-15 13:39:19', '2017-02-15 13:39:19'),
(24, 'Rick', 'Flayer', 'rickflayer@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '880174185292', 0, '', '', '2017-02-15 13:41:09', '2017-02-15 13:41:09'),
(25, 'Enjo', 'Mooray', 'enjo_mooray@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '880165821478', 0, '', '', '2017-02-15 13:42:30', '2017-02-15 13:42:30'),
(53, 'teacher1', '', 'teacher@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '88525852', 0, '', '', '2017-04-12 15:11:01', '2017-04-12 15:11:01'),
(54, 'John', 'Doe', 'student1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '8874521478', 0, '', '', '2017-04-12 15:12:22', '2017-04-12 15:12:22'),
(55, 'librarian', 'wome', 'jason-euler@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 4, '6256485', 0, '', '', '2017-04-12 15:16:23', '2017-04-12 15:16:23'),
(60, 'arjun', 'rai', 'hoggpeter388@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '5555555', 0, '', '', '2017-07-27 15:54:37', '2017-07-27 15:54:37'),
(61, 'tarikul', 'islam', 'tarikulislam.cse@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '880155874588', 0, '', '', '2017-08-03 13:43:25', '2017-08-03 13:43:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `isbn_number` (`isbn_number`);

--
-- Indexes for table `books_author`
--
ALTER TABLE `books_author`
  ADD KEY `book_id` (`book_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `book_issues`
--
ALTER TABLE `book_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books_author`
--
ALTER TABLE `books_author`
  ADD CONSTRAINT `books_author_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `books_author_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`);

--
-- Constraints for table `book_issues`
--
ALTER TABLE `book_issues`
  ADD CONSTRAINT `book_issues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
