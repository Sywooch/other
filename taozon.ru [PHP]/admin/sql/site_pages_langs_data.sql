CREATE TABLE IF NOT EXISTS `site_pages_langs_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagetitle` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `p` varchar(255) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX idx_unique_p (`p`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
