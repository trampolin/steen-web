-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Jan 2014 um 12:58
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
-- Tabellenstruktur für Tabelle `kacheln`
--

CREATE TABLE IF NOT EXISTS `kacheln` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kachelorder` int(11) NOT NULL,
  `cssid` varchar(40) NOT NULL,
  `cssclass` varchar(40) NOT NULL,
  `options` varchar(400) DEFAULT NULL,
  `content` text,
  `active` tinyint(1) NOT NULL,
  `kachelname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order` (`kachelorder`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `kacheln`
--

INSERT INTO `kacheln` (`id`, `kachelorder`, `cssid`, `cssclass`, `options`, `content`, `active`, `kachelname`) VALUES
(1, 10, 'KachelFB', 'kachel fb-like-box', 'data-href="http://www.facebook.com/steenband.de" data-width="440" data-height="520" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"', NULL, 1, 'Facebook Wall'),
(2, 100, 'KachelVid', 'kachel kachelhoch', NULL, '<iframe width="440" height="250" src="//www.youtube.com/embed/S-EJNmlUfwQ" frameborder="0" allowfullscreen></iframe>', 1, 'Schritt für Schritt Video'),
(3, 200, 'KachelTW', 'kachel kachelhoch', NULL, '<a class="twitter-timeline" href="https://twitter.com/steenband" data-widget-id="421653567015890945">Tweets von @steenband</a>\r\n				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?''http'':''https'';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>', 0, 'Twitter'),
(4, 300, 'KachelSC', 'kachel kachelhoch', NULL, '<iframe width="100%" height="250" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/11149907&amp;color=ff6600&amp;auto_play=false&amp;show_artwork=true"></iframe>', 1, 'Soundcloud Player');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
