CREATE TABLE IF NOT EXISTS `site_pages_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX idx_page_id (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;