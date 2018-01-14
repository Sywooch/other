<?php
#
# Самоустановка модуля
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#


$SQL[] = "INSERT INTO `se_modules` VALUES ('authorization', 1, 'Пользователи', 0, 0, 0, 'a:9:{i:0;s:13:\"authorization\";i:1;s:17:\"authorization_ban\";i:2;s:18:\"authorization_auto\";i:3;s:17:\"authorization_add\";i:4;s:18:\"authorization_edit\";i:5;s:20:\"authorization_do_add\";i:6;s:21:\"authorization_do_edit\";i:7;s:17:\"authorization_del\";i:8;s:24:\"authorization_editaccess\";}', 0, 7);";


$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Модуль управления пользогвателями.',
                                   'config_group_title' => 'Пользователи',
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

$SQL['settings']['sett'][] = array(     'config_title'       => 'Название фирмы',
                                      'config_description' => 'Навзание фирмы будет вставлено в тело/заголовок некоторых писем.',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'authorization_title',
                                      'config_value'       => '',
                                      'config_default'     => '«Мастерская Водопьянова»',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => 'Настройки отправки писем',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array(     'config_title'       => 'Email с которого будет отсылаться письмо',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'authorization_mail',
                                      'config_value'       => '',
                                      'config_default'     => 'admin@vmast.ru',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );


?>
