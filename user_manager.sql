-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 01:40 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(36) NOT NULL,
  `visible` tinyint(4) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `visible`, `date_created`) VALUES
(1, 'English', 1, '2017-04-05 16:48:12'),
(2, 'Afrikaans', 1, '2017-04-05 16:48:12'),
(3, 'isiXhosa', 1, '2017-04-05 16:48:31'),
(4, 'isiZulu', 1, '2017-04-05 16:48:31'),
(5, 'isiNdebele', 1, '2017-04-07 11:02:49'),
(6, 'Sepedi', 1, '2017-04-07 11:02:49'),
(7, 'Sesotho', 1, '2017-04-07 11:02:49'),
(8, 'Setswana', 1, '2017-04-07 11:02:49'),
(9, 'Siswati', 1, '2017-04-07 11:02:49'),
(10, 'Tshivenda', 1, '2017-04-07 11:02:49'),
(11, 'Xitsonga', 1, '2017-04-07 11:02:49'),
(12, 'Other', 1, '2017-04-07 11:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `language_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `mobile`, `email`, `language_id`, `dob`, `deleted`, `modified_by`, `date_modified`, `date_created`) VALUES
(9, 'Test', 'User', '27831231234', 'test@user.com', 1, '1988-03-20', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(10, 'Fred', 'Williams', '27821156943', 'fred@williams.com', 3, '1954-02-13', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(11, 'Sally', 'Roberts', '27835556598', 'sally@work.co.za', 6, '1973-07-29', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(12, 'Richard', 'Pierce', '27829105472', 'richard@iafrica.com', 8, '1984-03-13', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(13, 'Linda', 'De Villiers', '28482048204', 'linda@gmail.com', 11, '1976-05-11', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(14, 'Andrew', 'Hunt', '27739289432', 'andrew@office.co.za', 1, '1977-08-19', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(15, 'Jennifer', 'Waters', '27718943765', 'jenny@yahoo.com', 2, '1949-05-01', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(16, 'Oscar', 'Watson', '27830027482', 'oscar@live.com', 3, '1988-07-15', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(17, 'Michael', 'Smith', '27819302837', 'michael@website.org', 4, '1989-06-22', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(18, 'Harry', 'Samson', '27848293042', 'harry@shop.com', 8, '1983-01-29', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(19, 'Melinda', 'Matthews', '27845638992', 'melinda@yahoo.co.uk', 10, '1969-07-23', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42'),
(20, 'Patricia', 'Smit', '27867380495', 'patty@office.com', 8, '1984-07-26', 0, 1, '2017-04-07 11:25:42', '2017-04-07 11:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(1, 'Admin', '$2a$08$DR/XH746Ol9KJpwswBuxvu.YMK5fu7GiUsarCKinkMHV9V7QuNduW', 'admin@usermanager.local', 1, 0, NULL, NULL, NULL, NULL, '235ee7ab74ed57c29732870ae5753c1b', '127.0.0.1', '2017-04-07 12:56:12', '2017-04-07 12:40:44', '2017-04-07 10:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_autologin`
--
ALTER TABLE `user_autologin`
  ADD PRIMARY KEY (`key_id`,`user_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
