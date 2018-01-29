CREATE TABLE IF NOT EXISTS `site_categories_seo_texts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `lang_code` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_category_id` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;