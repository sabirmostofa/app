-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2011 at 11:56 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chinky_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE IF NOT EXISTS `apps` (
  `ID` bigint(12) unsigned NOT NULL AUTO_INCREMENT,
  `post_title` text NOT NULL,
  `post_content` longtext NOT NULL,
  `app_price` varchar(32) NOT NULL DEFAULT 'Free',
  `app_image` text NOT NULL,
  `app_artist` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `post_title` (`post_title`(10))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `apps`
--


-- --------------------------------------------------------

--
-- Table structure for table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `feedtype` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `feeds`
--


-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `genres`
--


-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `feed_id` smallint(5) unsigned NOT NULL,
  `genre_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `app_id` smallint(5) unsigned NOT NULL,
  `ranks` longtext NOT NULL,
  `current_rank` smallint(5) NOT NULL DEFAULT '-1',
  `update_timestamp` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `feed_id` (`feed_id`),
  KEY `genre_id` (`genre_id`),
  KEY `app_id` (`app_id`),
  KEY `update_timestamp` (`update_timestamp`),
  KEY `current_rank` (`current_rank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ranks`
--

