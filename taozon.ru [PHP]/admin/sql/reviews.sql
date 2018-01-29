CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `name` text,
  `email` varchar(100),
  `text` text,
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`review_id`),
  KEY `IX_reviews_item_id` (`item_id`(16)),
  KEY `reviews_category_id` (`category_id`(16))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;