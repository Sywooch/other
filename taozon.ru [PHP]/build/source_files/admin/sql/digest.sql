CREATE TABLE IF NOT EXISTS `digest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
	`title` text NOT NULL,
	`category_id` varchar(50),
	`content` text,
	`image` varchar(255),
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
