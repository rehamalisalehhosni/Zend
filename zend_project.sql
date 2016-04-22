-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2016 at 07:28 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zend_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(225) NOT NULL,
  `category_state` varchar(200) NOT NULL,
  `category_parent` int(11) NOT NULL DEFAULT '0',
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category_id`, `category_name`, `category_state`, `category_parent`, `category_description`) VALUES
(1, 'sports', '1', 0, 'wellloc'),
(2, 'Football', '0', 1, 'wellloc'),
(3, 'volleyball', '1', 1, 'foooo'),
(4, 'magazine', '1', 0, 'mmm'),
(5, 'technology', '1', 4, 'technology'),
(6, 'art', '1', 4, 'art data');

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `message` text NOT NULL,
  `subject` text NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ReplyThread`
--

CREATE TABLE IF NOT EXISTS `ReplyThread` (
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `reply_body` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ReplyThread`
--

INSERT INTO `ReplyThread` (`reply_id`, `owner_id`, `thread_id`, `reply_body`, `date`, `views`) VALUES
(1, 2, 1, 'hiiiiiiiiiii', '2016-04-20 20:34:19', 1),
(2, 1, 1, 'welllcome', '2016-04-20 20:34:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `statue` enum('open','closed') NOT NULL DEFAULT 'open',
  `message` text NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Thread`
--

CREATE TABLE IF NOT EXISTS `Thread` (
  `thread_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `thread_state_id` int(11) NOT NULL,
  `thread_body` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thread_title` varchar(255) NOT NULL,
  `thread_sticky` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`thread_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `Thread`
--

INSERT INTO `Thread` (`thread_id`, `category_id`, `thread_state_id`, `thread_body`, `owner_id`, `date`, `thread_title`, `thread_sticky`, `views`) VALUES
(1, 2, 1, 'first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  first post  first post   first post  first post   first post  first post   first post  first post  ', 1, '2016-04-22 13:34:28', 'mypost', 0, 1),
(2, 3, 1, 'toooo', 2, '2016-04-20 21:33:12', 'gggggg', 0, 1),
(3, 2, 1, 'gggggg', 1, '2016-04-20 21:33:12', 'gggggg', 0, 1),
(5, 2, 1, ' new Post  new Post  new Post  new Post   new Post  new Post  new Post  new Post  new Post  new Post   new Post  new Post  new Post  new Post  new Post  new Post   new Post  new Post  new Post  new Post  new Post  new Post   new Post  new Post ', 1, '2016-04-21 22:00:00', 'new Post', 0, 1),
(6, 2, 1, ' new new  new new  new new  new new  new new  new new  new new  new new  new new', 1, '2016-04-21 22:00:00', 'new', 0, 1),
(7, 2, 1, 'my post  my post  my post  my post  my post  my post my post  my post \r\nmy post  my post  my post  my post  my post  my post my post  my post \r\nmy post  my post  my post  my post  my post  my post my post  my post \r\nmy post  my post  my post  my post  my post  my post my post  my post ', 2, '2016-04-22 13:47:27', 'my post', 1, 1),
(9, 2, 1, 'new', 2, '2016-04-21 22:00:00', 'new', 0, 1),
(10, 2, 1, 'new', 2, '2016-04-21 22:00:00', 'new', 0, 1),
(13, 3, 1, 'new', 2, '2016-04-21 22:00:00', 'new', 0, 1),
(14, 0, 1, 'sssssssssssssss', 2, '2016-04-22 15:35:33', 'new', 0, 1),
(17, 2, 1, 'llllllllllllllllllllllll', 2, '2016-04-21 22:00:00', 'new', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `thread_state`
--

CREATE TABLE IF NOT EXISTS `thread_state` (
  `thread_state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(225) NOT NULL,
  PRIMARY KEY (`thread_state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(225) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_password` varchar(225) NOT NULL,
  `registration_date` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `country` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `last_login_date` date NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `ban` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_name`, `user_email`, `user_password`, `registration_date`, `gender`, `country`, `image`, `last_login_date`, `user_type`, `ban`) VALUES
(1, 'admin', 'admin@gmail.com', '8ca6342915ac81dd2d3eec49e2098db9', '2016-04-15', 'female', '1', 'YOUNGS~1.GIF', '0000-00-00', 'admin', 0),
(2, 'bassem a', 'b@b.com', '8ca6342915ac81dd2d3eec49e2098db9', '2016-04-17', 'male', 'egypt', 'WILEY800 (2).JPG', '2016-04-17', 'user', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
