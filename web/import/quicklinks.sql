-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Jan 2014 um 12:59
-- Server Version: 5.5.34
-- PHP-Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `sb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quicklinks`
--

CREATE TABLE IF NOT EXISTS `quicklinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qlorder` int(11) NOT NULL,
  `qltitle` varchar(60) NOT NULL,
  `qlcssclass` varchar(40) NOT NULL,
  `qlcssid` varchar(40) NOT NULL,
  `qlurl` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `quicklinks`
--

INSERT INTO `quicklinks` (`id`, `qlorder`, `qltitle`, `qlcssclass`, `qlcssid`, `qlurl`, `active`) VALUES
(1, 100, 'Facebook', 'smalllink', 'fb', 'http://www.facebook.com/steenband.de', 1),
(2, 200, 'Youtube', 'smalllink', 'yt', 'http://www.youtube.com/steenband', 1),
(3, 300, 'Twitter', 'smalllink', 'tw', 'http://www.twitter.com/steenband', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
