<?php
#
# Самоустановка модуля
#


/* создание таблицы */
$SQL[] = "CREATE TABLE `se_subscribe` (
  `news_id` int(11) NOT NULL default '-1',
  `user_mail` varchar(30) default NULL,
  `active` tinyint(1) NOT NULL default '0',
  UNIQUE KEY `user_mail` (`user_mail`)
) ENGINE=MyISAM;";



/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES ('subscribe', 1, 'Рассылка новостей', 0, 0, 0, 'a:4:{i:0;s:9:\"subscribe\";i:1;s:14:\"subscribe_send\";i:2;s:15:\"subscribe_users\";i:3;s:17:\"subscribe_userdel\";}', 0, 1000);";

$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Настройки модуля подписки.',
                                   'config_group_title' => 'Подписка',
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

$SQL['settings']['sett'][] = array(   'config_title'       => 'Период между отправками рассылки в часах',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'subscribe_interval',
                                      'config_value'       => '',
                                      'config_default'     => '24',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

?>