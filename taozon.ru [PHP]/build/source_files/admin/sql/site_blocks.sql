CREATE TABLE IF NOT EXISTS `site_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `properties` text,
  PRIMARY KEY (`id`),
  KEY `fk_site_blocks_site_blocks_sets` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
