-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2018 at 09:50 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edurama_full_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finger_print` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `reset_key` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= Active, 0 = InActive',
  `last_logged_in` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `finger_print`, `unique_id`, `role_id`, `password`, `temp_password`, `email`, `reset_key`, `status`, `last_logged_in`, `created_at`, `modified_at`, `created_by`, `modified_by`) VALUES
(1, 0, '', '', 1, 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2Nw==', 'superadmin@gsms.com', '', 1, '2018-09-26 14:12:25', '2013-11-15 20:33:03', '2018-01-13 10:51:12', 0, 1),
(2, 0, '', '', 5, 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 'sonu@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '2018-09-20 17:02:25', '0000-00-00 00:00:00', 1, 0),
(3, 0, '', '', 3, 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 'sonu2@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '2018-09-20 17:09:45', '0000-00-00 00:00:00', 1, 0),
(4, 0, '', '', 5, 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 'shayam@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '2018-09-20 18:21:28', '0000-00-00 00:00:00', 1, 0),
(74, 0, '', '', 3, '21232f297a57a5a743894a0e4a801fc3', 'YWRtaW4=', 'arun12@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-10 20:32:20', '0000-00-00 00:00:00', 0, 0),
(75, 0, '', '', 3, '21232f297a57a5a743894a0e4a801fc3', 'YWRtaW4=', 'arun2@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-10 21:07:16', '0000-00-00 00:00:00', 0, 0),
(76, 0, '', '', 9, 'e10adc3949ba59abbe56e057f20f883e', 'YWxvaw==', 'alok@cyberwor12x.in', NULL, 1, '0000-00-00 00:00:00', '2018-10-11 16:17:44', '0000-00-00 00:00:00', 0, 0),
(78, 0, '', '', 13, '21232f297a57a5a743894a0e4a801fc3', 'YWRtaW4=', 'kuldeep12@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-17 22:26:12', '0000-00-00 00:00:00', 0, 0),
(100, 1, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'komal@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(101, 2, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'pooja#123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(102, 3, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'sikha123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(103, 4, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'rahul.9419@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(104, 5, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'payal786@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(105, 6, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'rajeshkr.123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(106, 7, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'neelam123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(107, 8, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'gogia123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(108, 9, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'khusboo123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(109, 10, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'neetu123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(110, 11, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'rakhi123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(111, 12, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'pawan123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(112, 13, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'chawla123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(113, 14, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'avinash123@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(114, 15, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'testteacher@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 0),
(115, 16, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'arunyadav@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(116, 17, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'rajan45@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(117, 18, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'gaurav@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(118, 19, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'arun434@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(119, 20, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'gaura34v@cyberworx.in', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(120, 21, '', '', 5, '21232f297a57a5a743894a0e4a801fc3', NULL, 'rajan657657@gmail.com', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(121, 0, '', '', 3, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', 'vishalguardian@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-23 23:58:06', '0000-00-00 00:00:00', 0, 0),
(122, 0, '', '', 3, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', 'vishalguardian1@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-24 00:17:17', '0000-00-00 00:00:00', 0, 0),
(123, 0, '', '', 3, 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', 'vipin34@gmail.com', NULL, 1, '0000-00-00 00:00:00', '2018-10-24 00:26:05', '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
