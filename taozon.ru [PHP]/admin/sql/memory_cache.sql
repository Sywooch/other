CREATE TABLE IF NOT EXISTS `memory_cache` (
  `session_id` char(50) NOT NULL,
  `expires` int(11) NOT NULL,
  `cache_entity` varchar(50) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;