CREATE TABLE IF NOT EXISTS `site_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(255) DEFAULT NULL,
  `added` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
