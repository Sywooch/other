CREATE TABLE `subscription` (
  `subscription` VARCHAR(50) NOT NULL,
  `email` VARCHAR(200) NOT NULL,
  `name` VARCHAR(100) NOT NULL DEFAULT '',
  `date` DATE NOT NULL,
  `user_id` varchar(100) NOT NULL DEFAULT '',
  `send` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subscription`, `email`),
  KEY `IX_reviews_item_id` (`user_id`),
  KEY `IX_subscription_send` (`subscription`, `send`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;