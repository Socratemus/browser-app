--
-- Table structure for table `browser_types_brt`
--

DROP TABLE IF EXISTS `browser_types_brt`;
CREATE TABLE IF NOT EXISTS `browser_types_brt` (
  `id_brt` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `acronym_brt` varchar(5) NOT NULL,
  `name_brt` varchar(50) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  PRIMARY KEY (`id_brt`),
  UNIQUE KEY `acronym_brt` (`acronym_brt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `browser_types_brt`
--

INSERT INTO `browser_types_brt` (`id_brt`, `acronym_brt`, `name_brt`, `keyword`) VALUES
(1, 'FF', 'Firefox', 'Firefox'),
(2, 'IE', 'Internet Explorer', 'MSIE');

-- --------------------------------------------------------

--
-- Table structure for table `portals_prt`
--

DROP TABLE IF EXISTS `portals_prt`;
CREATE TABLE IF NOT EXISTS `portals_prt` (
  `id_prt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_prt` varchar(50) NOT NULL,
  `url_prt` varchar(150) NOT NULL,
  PRIMARY KEY (`id_prt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `portals_prt`
--

INSERT INTO `portals_prt` (`id_prt`, `name_prt`, `url_prt`) VALUES
(1, 'Softpedia', 'http://www.softpedia.com/'),
(2, 'Kappa', 'http://www.kappa.ro'),
(3, 'Download.com', 'http://www.download.com');

-- --------------------------------------------------------
