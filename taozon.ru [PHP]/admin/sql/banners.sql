CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `lang` varchar(10) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_lang` (`lang`(10))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;