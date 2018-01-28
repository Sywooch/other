<?php
#
# Установка модуля
#



$mod_name = 'shop';
$mod_title = "Магазин";







/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES (
	'".$mod_name."', 	/* название модуль */
	1, 			/* активность модуля */
	'".$mod_title."', 	/* название модуля в кирилице */
	0, 			/* использовать структуру модуля для формирования меню */
	0, 			/* открыть сразу при входе в админку */
	0, 			/* модуль является частью ядра */
	'', 			/* иснтрукции для операций в админке (необходимо для модулей ядра) */
	0, 			/* разрешить поиск по контенту модуля */
	1000			/* позиция в списке модулей (встать в конец списка) */
);";





$SQL[] = "CREATE TABLE `se_{$mod_name}` (
  `id` int(11) NOT NULL auto_increment,
  `status` tinyint(1) NOT NULL default '0',
  `rectime` int(11) default NULL,
  `total` decimal(10,2) NOT NULL default '0.00',
  `goods` text NOT NULL,
  `hesh` varchar(32) default NULL,
  `user` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;";


$SQL[] = "CREATE TABLE `se_{$mod_name}_attend` (
  `good_id1` int(11) default NULL,
  `good_id2` int(11) default NULL,
  `count` int(11) default NULL
)";





$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => '',
                                   'config_group_title' => $mod_title,
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


$SQL['settings']['sett'][] = array( 'config_title'       => 'Название модуля-каталога',
                                      'config_description' => 'К указанному модулю будет обращаться магазин для извлечения данных. Если не уверены, не меняйте указанные настройки!',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_modrecipient',
                                      'config_value'       => 'catalog',
                                      'config_default'     => 'catalog',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





// название страницы в разделе статических страниц
$SQL['menuname'] = "";

// требуется динамическое формирование
$SQL['menurebuild'] = 0;

# записываем таблицы, которые необходимо удалить при удалении модуля
# записывать без префиксов и через запятую
# таблица с названием модуля удаляется автоматически
$del_tables =  array("se_".$mod_name."_attend");

?>