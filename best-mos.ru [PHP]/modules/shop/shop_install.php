<?php
#
#  самоустановка модуля
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#


$SQL[] = "INSERT INTO `se_modules` VALUES ('shop', 1, 'Интернет-Магазин', 0, 0, 0, '', 0, 0);";

$SQL[] = "
CREATE TABLE `se_shop_attend` (
  `good_id1` int(11) default NULL,
  `good_id2` int(11) default NULL,
  `count` int(11) default NULL
)
";

$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Настройки интернет-магазина.',
                                   'config_group_title' => 'Интернет-магазин',
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


$SQL['settings']['sett'][] = array( 'config_title'       => 'Email для заказов',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'shop_seller_email',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество сопутствующих товаров',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'shop_attend_count',
                                      'config_value'       => '',
                                      'config_default'     => '5',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


# записываем таблицы, которые необходимо удалить при удалении модуля, таблицу с названием модуля удаляет автоматически, записывать без префиксов, через запятую
$del_tables =  array('shop_attend');
?>