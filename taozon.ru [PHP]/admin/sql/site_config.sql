CREATE TABLE IF NOT EXISTS `site_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) DEFAULT NULL,
  `value` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_unique_key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
