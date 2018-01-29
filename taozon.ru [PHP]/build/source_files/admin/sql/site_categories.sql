CREATE TABLE IF NOT EXISTS `site_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `lang_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
