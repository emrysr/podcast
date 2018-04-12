-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Host: 213.171.200.88
-- Generation Time: Apr 12, 2018 at 09:29 PM
-- Server version: 5.6.39-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `podcasts`
--

-- --------------------------------------------------------

--
-- Table structure for table `pod_list`
--

CREATE TABLE IF NOT EXISTS `pod_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `date` date NOT NULL,
  `duration` time NOT NULL,
  `mixcloud_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pod_list`
--

INSERT INTO `pod_list` (`id`, `title`, `description`, `date`, `duration`, `mixcloud_url`) VALUES
(1, 'Raveon&#39;s Show #001', 'Hello fellow music lovers, it&#39;s been a long time waiting, but I&#39;m back. After the birth of my daugter DJing had to be to put on hold to make sure our daughter had the best start in life. She is now close to 5 years old, and the Rave is back on!<br><br>\r\nI will start with a monthly show, and if it does prove to be popular and I have time, it will be more frequent podcast.<br><br>\r\nIn this very first episode I will take you through some of the stuff I was playing back in 2013 and I might drop some new stuff in...so sit back, turn on your speakrs and enjoy!', '2018-04-05', '01:00:00', ''),
(2, 'Raveon&#39;s Show #002', 'Testing', '2018-04-10', '01:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `podcasts_tracks`
--

CREATE TABLE IF NOT EXISTS `podcasts_tracks` (
  `tracks_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_artist` varchar(255) NOT NULL,
  `track_title` varchar(255) NOT NULL,
  `podcast_id` int(11) NOT NULL,
  PRIMARY KEY (`tracks_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `podcasts_tracks`
--

INSERT INTO `podcasts_tracks` (`tracks_id`, `track_artist`, `track_title`, `podcast_id`) VALUES
(1, 'artist 1', 'track 1', 1),
(2, 'artist 2', 'track 2', 1),
(3, 'new', 'new', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'arfon', 'd821cac4e4cf06c221b6a415a0fbd674');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
