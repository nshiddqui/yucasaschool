-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 11:25 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edurama_superadmin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_testimonial` varchar(1000) NOT NULL,
  `img_url` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `school_name`, `client_name`, `client_testimonial`, `img_url`, `status`) VALUES
(2, 'APS Fatehgarh', 'APS Fatehgarh', '                                    <p>Managing School Activity is a time consuming task .It is designed to help you quickly provide accurate estimates to customers. This cost estimating software is great for the Schools & university</p>                                ', 'client2.jpg', 1),
(4, 'cvcxzvcx', 'cxvxcvcxv', '<p>cvcxvxcvcxv</p>', 'Desert.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `id` int(11) NOT NULL,
  `home_video` varchar(50) NOT NULL,
  `backdrop_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_banner`
--

INSERT INTO `home_banner` (`id`, `home_video`, `backdrop_image`) VALUES
(1, 'newvirro.mp4', 'blog-blogging-blur-248533.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `package_title` varchar(200) NOT NULL,
  `package_price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_name`, `package_title`, `package_price`) VALUES
(1, 'Basic Package', 'Perfect For Small School', 600),
(2, 'Intermediate Package', 'Perfect For medium School', 800),
(3, 'Advance Package', 'Perfect For Large School', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `id` int(11) NOT NULL,
  `feature_title` varchar(50) NOT NULL,
  `feature_icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`id`, `feature_title`, `feature_icon`) VALUES
(1, 'Student and Admission Management', 'library.png'),
(3, 'Payroll Management and many others', 'library.png'),
(10, 'Teacher and Admission Management', 'INFIRMARY.png'),
(11, 'Payroll Management and many others', 'INFIRMARY.png'),
(13, 'Teacher Detial', 'INFIRMARY.png'),
(14, 'Teacher and Admission Management', 'library.png');

-- --------------------------------------------------------

--
-- Table structure for table `package_feature_relation`
--

CREATE TABLE `package_feature_relation` (
  `id` int(11) NOT NULL,
  `package_id` int(1) NOT NULL,
  `feature_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_feature_relation`
--

INSERT INTO `package_feature_relation` (`id`, `package_id`, `feature_id`) VALUES
(28, 1, 1),
(30, 1, 11),
(31, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `img_url` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'draft',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `author`, `content`, `img_url`, `status`, `publish_date`) VALUES
(50, 'Demo Post Nine', 'Edurama Admin', '                                                                                                                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum optio, distinctio illo possimus nostrum, est dolorem obcaecati facilis, minima non quis illum aliquid itaque ut incidunt delectus nam velit fugit vero corrupti commodi? Architecto quod dolor exercitationem modi illo enim, totam, praesentium ullam ad soluta earum odit voluptatum dolore quisquam?</p><p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum optio, distinctio illo possimus nostrum, est dolorem obcaecati facilis, minima non quis illum aliquid itaque ut incidunt delectus nam velit fugit vero corrupti commodi? Architecto quod dolor exercitationem modi illo enim, totam, praesentium ullam ad soluta earum odit voluptatum dolore quisquam?</p><p>???????Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum optio, distinctio illo possimus nostrum, est dolorem obcaecati facilis, minima non quis illum aliquid itaque ut incidunt delectus nam velit fugit vero corrupti commodi? Architecto quod dolor exercitationem modi illo enim, totam, praesentium ullam ad soluta earum odit voluptatum dolore quisquam?</p>                                                                                                                                ', 'Picture2.png', 'publish', '2019-03-06 08:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `user_phone` varchar(55) NOT NULL,
  `user_email` varchar(55) NOT NULL,
  `user_password` varchar(55) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT '2',
  `user_status` int(11) NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_name`, `user_phone`, `user_email`, `user_password`, `user_role`, `user_status`, `create_date`) VALUES
(1, 'Ankit Yadav', '1234567890000', 'ankit.y.arch@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2019-03-19 11:58:36'),
(3, 'Alok Tiwari', '3221321321321', 'kamal@cyberworx.in', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 2, 2, '2019-04-08 08:32:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_feature_relation`
--
ALTER TABLE `package_feature_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `package_feature_relation`
--
ALTER TABLE `package_feature_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
