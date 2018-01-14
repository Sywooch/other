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


$SQL[] = "INSERT INTO `se_modules` VALUES ('path', 1, 'Путь (хлебные крошки)', 0, 0, 0, '', 0, 1000);";


$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Путь (Хлебные крошки).',
                                   'config_group_title' => 'Управление модулем пути по сайту',
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


$SQL['settings']['sett'][] = array(   'config_title'       => 'Выводить в пути текущую страницу?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => 'path_print_cur_page',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );
									  
									  
$SQL['settings']['sett'][] = array(   'config_title'       => 'Выводить ли в пути главную страницу?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => 'print_index',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );


?>
