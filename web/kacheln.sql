-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2014 at 11:17 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `steen-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `kacheln`
--

DROP TABLE IF EXISTS `kacheln`;
CREATE TABLE IF NOT EXISTS `kacheln` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kachelorder` int(11) NOT NULL,
  `cssid` varchar(40) NOT NULL,
  `cssclass` varchar(40) NOT NULL,
  `options` varchar(400) DEFAULT NULL,
  `content` text,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order` (`kachelorder`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kacheln`
--

INSERT INTO `kacheln` (`id`, `kachelorder`, `cssid`, `cssclass`, `options`, `content`, `active`) VALUES
(1, 0, 'KachelFB', 'kachel fb-like-box', 'data-href="http://www.facebook.com/steenband.de" data-width="440" data-height="520" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"', NULL, 1),
(2, 1, 'KachelVid', 'kachel kachelhoch', NULL, '<iframe width="440" height="250" src="//www.youtube.com/embed/S-EJNmlUfwQ" frameborder="0" allowfullscreen></iframe>', 1),
(3, 2, 'KachelTW', 'kachel kachelhoch', NULL, '<a class="twitter-timeline" href="https://twitter.com/steenband" data-widget-id="421653567015890945">Tweets von @steenband</a>\r\n				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?''http'':''https'';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>', 1);
