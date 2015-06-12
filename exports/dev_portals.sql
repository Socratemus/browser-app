-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Gazda: 127.0.0.1
-- Timp de generare: 12 Iun 2015 la 07:36
-- Versiune server: 5.5.43-0ubuntu0.14.04.1
-- Versiune PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Bază de date: `dev_portals`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `browser_portal`
--

CREATE TABLE IF NOT EXISTS `browser_portal` (
  `id_brt` int(10) unsigned NOT NULL,
  `id_prt` int(10) unsigned NOT NULL,
  `rate` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_brt`,`id_prt`),
  UNIQUE KEY `id_brt` (`id_brt`,`id_prt`),
  KEY `IdPortalFK` (`id_prt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Salvarea datelor din tabel `browser_portal`
--

INSERT INTO `browser_portal` (`id_brt`, `id_prt`, `rate`) VALUES
(2, 1, 12),
(2, 2, 15),
(2, 3, 12),
(2, 31, 15),
(3, 1, 33),
(3, 2, 25),
(3, 3, 20),
(3, 31, 15),
(44, 1, 13),
(44, 2, 12),
(44, 3, 12),
(44, 31, 15);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `browser_types_brt`
--

CREATE TABLE IF NOT EXISTS `browser_types_brt` (
  `id_brt` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acronym_brt` varchar(5) NOT NULL,
  `name_brt` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  PRIMARY KEY (`id_brt`),
  UNIQUE KEY `acronym_brt` (`acronym_brt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `browser_types_brt`
--

INSERT INTO `browser_types_brt` (`id_brt`, `acronym_brt`, `name_brt`, `keyword`) VALUES
(2, 'IE', 'Internet Explorer', 'MSIE'),
(3, 'GC', 'Google Chrome', 'Chrome'),
(44, 'FF', 'Firefox', 'Firefox');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `portals_prt`
--

CREATE TABLE IF NOT EXISTS `portals_prt` (
  `id_prt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_prt` varchar(50) NOT NULL,
  `url_prt` varchar(150) NOT NULL,
  PRIMARY KEY (`id_prt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Salvarea datelor din tabel `portals_prt`
--

INSERT INTO `portals_prt` (`id_prt`, `name_prt`, `url_prt`) VALUES
(1, 'Softpedia', 'http://www.softpedia.com/'),
(2, 'Kappaz', 'http://www.kappa.ro'),
(3, 'Download.com', 'http://www.download.com'),
(31, 'Twitter', 'http://www.twitter.com');

--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `browser_portal`
--
ALTER TABLE `browser_portal`
  ADD CONSTRAINT `IdPortalFK` FOREIGN KEY (`id_prt`) REFERENCES `portals_prt` (`id_prt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IdBrowserFK` FOREIGN KEY (`id_brt`) REFERENCES `browser_types_brt` (`id_brt`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
