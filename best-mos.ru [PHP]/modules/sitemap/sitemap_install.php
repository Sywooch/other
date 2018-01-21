<?php
#
# Самоустановка модуля
#
#  Modified         :
#  Version          : 1.0
#


$SQL[] = "INSERT INTO `se_modules` VALUES ('sitemap', 1, 'Карта сайта', 1, 0, 0, 'a:2:{i:0;s:7:\"sitemap\";i:1;s:14:\"sitemap_update\";}', 0, 1000);";

/*
$SQL[] = "CREATE TABLE `se_sitemap` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '-1',
  `alias` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `sbody` text NOT NULL,
  `body` text NOT NULL,
  `is_active` tinyint(1) NOT NULL default '0',
  `item_order` int(11) NOT NULL default '1',
  `menu` varchar(255) NOT NULL default '',
  `timestamp` int(11) NOT NULL default '0',
  `author` varchar(255) NOT NULL default '',
  `depth_count` int(10) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `h1` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
);";

$SQL[] = "INSERT INTO `se_sitemap` VALUES (1, -1, 'sitemap', 'Карта Сайта', '', '', 1, 1, 'Карта Сайта', 0, '', 0, '', '', '');";
*/

$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Управление модулем карты сайта',
                                   'config_group_title' => 'Карта Сайта.',
                                   'config_group'       => '',
                                   'config_type'        => '',
                                   'config_key'         => '',
                                   'config_value'       => '',
                                   'config_default'     => '',
                                   'config_extra'       => '',
                                   'config_evalphp'     => '',
                                   'config_protected'   => 1,
                                   'config_position'    => 0,
                                   'config_start_group' => '',
                                   'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array(   'config_title'       => 'Количество вложеных страниц выводимых в карте сайта?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'sitemap_depth_count',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => 'Глубина вложенности',
                                      'config_end_group'   => 1, );

$SQL['menuname'] = "Карта сайта";

?>
