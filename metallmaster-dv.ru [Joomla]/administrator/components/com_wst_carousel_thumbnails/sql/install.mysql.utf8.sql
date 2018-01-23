DROP TABLE IF EXISTS `#__wst_carousel_thumbnails`;
DROP TABLE IF EXISTS `#__wst_carousel_thumbnails_config`;

CREATE TABLE IF NOT EXISTS `#__wst_carousel_thumbnails` (
	`id` int(10) NOT NULL auto_increment,
	`image_name` text NOT NULL,
	`tooltip` text NOT NULL,
	`description` text NOT NULL,
    `ordering` int(10) NOT NULL,
	`published` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__wst_carousel_thumbnails_images` (
	`id` int(10) NOT NULL auto_increment,
	`image_name` text NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__wst_carousel_thumbnails_config` (
	`id` int(10) NOT NULL auto_increment,
    `width` int(10) NOT NULL,
	`show_tooltip` TINYINT(1) NOT NULL,
	`follow_mouse` TINYINT(1) NOT NULL,
	`tween_duration` text NOT NULL,
    `rotation_speed` int(10) NOT NULL,
	`radius_x` int(10) NOT NULL,
    `radius_y` int(10) NOT NULL,
    `tn_border_size` int(10) NOT NULL,
    `tn_border_color` text NOT NULL,
    `photo_border_size` int(10) NOT NULL,
    `photo_border_color` text NOT NULL,
    `bar_status` int(10) NOT NULL,
    `dragger_x` int(10) NOT NULL,
    `dragger_y` int(10) NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `#__wst_carousel_thumbnails_config` VALUES (1,700,1,0,'0.5',4,150,60,5,'0xFFFFFF',10,'0xFFFFFF',1,0,220);