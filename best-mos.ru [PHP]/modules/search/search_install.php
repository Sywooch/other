<?php
#
#  самоустановка модуля
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Web Otdel» Ltd
#


$SQL[] = "INSERT INTO `se_modules` VALUES ('search', 1, 'Поиск по сайту', 0, 0, 0, '', 0, 0);";


$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Настройки поиска.',
                                   'config_group_title' => 'Поиск',
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


$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество номерков в строке нумерации страниц',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_page_rows',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => 'Поиск',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество выводимых результатов поиска на страницу',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_page_num',
                                      'config_value'       => '',
                                      'config_default'     => '5',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество симвлов обрезаемых с каждой из сторон выдержки',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_cut_count',
                                      'config_value'       => '',
                                      'config_default'     => '100',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


?>