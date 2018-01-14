<?php
#
# Самоустановка модуля
#
#  Modified         :
#  Version          : 1.0
#  Programmer       : Kormishin Vladimir
#


/* создание таблицы */
$SQL[] = "CREATE TABLE `se_catalog` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `timestamp` int(11) default NULL,
  `lastmodified` int(11) default NULL,
  `alias` varchar(60) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `h1` varchar(255) default NULL,
  `sbody` text,
  `body` text NOT NULL,
  `author` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  `item_order` int(3) NOT NULL default '0',
  `is_active` smallint(1) NOT NULL default '0',
  `template` varchar(255) NOT NULL default '',
  `menu` varchar(255) NOT NULL default '',
  `owner` varchar(255) NOT NULL default '',
  `is_redirect` tinyint(1) NOT NULL default '0',
  `price` decimal(10,2) NOT NULL default '0.00',
  `img` varchar(100) NOT NULL default '',
  `is_hot` tinyint(1) NOT NULL default '0',
  `set_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
);";



/* вставка информации о модуле в таблицу модулей */
$actions = array("catalog","catalog_add","catalog_del","catalog_active","catalog_hotactive","catalog_order","catalog_cats","catalog_cats_order","catalog_cats_del","catalog_cats_edit","catalog_props","catalog_sets","catalog_setprops");
$SQL[] = "INSERT INTO `se_modules` VALUES ('catalog', 1, 'Каталог', 1, 0, 0, '".serialize($actions)."', 1, 1000);";


/* создание таблицы категорий */
$SQL[] = "CREATE TABLE `se_catalog_categories` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `item_order` int(11) default '0',
  `active` int(1) default '1',
  PRIMARY KEY  (`id`)
);";

/* создание таблицы категорий-каталогов */
$SQL[] = "CREATE TABLE `se_catalog_2cats` (
  `cat_id` int(11) default NULL,
  `child_id` int(11) default NULL
);";

/* создание таблицы свойств */
$SQL[] = "CREATE TABLE `se_catalog_properties` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
);";

/* создание таблицы набора свойств */
$SQL[] = "CREATE TABLE `se_catalog_property_set` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  `properties` text,
  PRIMARY KEY  (`id`)
);";

/* создание таблицы значений свойств */
$SQL[] = "CREATE TABLE `se_catalog_property_values` (
  `p_id` int(11) default NULL,
  `c_id` int(11) default NULL,
  `value` text
);";


$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'Настройки каталога.',
                                   'config_group_title' => 'Каталог',
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

$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество товаров на страницу',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_items_per_page',
                                      'config_value'       => '',
                                      'config_default'     => '15',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => 'BIG',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array(   'config_title'       => 'Количество номеров страниц выводимых рядом с текущей страницей',
                                      'config_description' => '< 6 5 4 > Значение = 1 (текущая = 5)',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_count_near_select_page',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array(   'config_title'       => 'Набор свойств по умолчанию (невидимая опция)',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_group'       => '0',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_default_set',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 0,
                                      'config_position'    => 0,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array(   'config_title'       => 'Включить категории товаров',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '0',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_categories_enable',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=Нет
1=Да",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 0,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array(   'config_title'       => 'Включить расширенные свойства',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '0',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_properties_enable',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=Нет
1=Да",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 0,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
                                      
$SQL['settings']['sett'][] = array( 'config_title'       => 'Ширина большей картинки товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_big_width',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => 'BIG',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Высота большей картинки товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_big_height',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Ресайз большей товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_big_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=Не ресайз
1=Только W пропорционально
2=Только H пропорционально
3=Непропорционально",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Метод',
                                      'config_description' => 'Используется только в том случае если выбран непропорциональный ресайз',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_big_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=Метод 1
2=Метод 2
3=Метод 3",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 4,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Ширина основной картинки товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_th_width',
                                      'config_value'       => '',
                                      'config_default'     => '320',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 5,
                                      'config_start_group' => 'IMG',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Высота основной картинки товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_th_height',
                                      'config_value'       => '',
                                      'config_default'     => '240',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 6,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Ресайз основной товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_th_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=Не ресайз
1=Только W пропорционально
2=Только H пропорционально
3=Непропорционально",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 7,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Метод',
                                      'config_description' => 'Используется только в том случае если выбран непропорциональный ресайз',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_th_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=Метод 1
2=Метод 2
3=Метод 3",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 8,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Ширина аватара товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_av_width',
                                      'config_value'       => '',
                                      'config_default'     => '120',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 9,
                                      'config_start_group' => 'AV',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Высота аватара товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'catalog_av_height',
                                      'config_value'       => '',
                                      'config_default'     => '90',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 10,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Ресайз аватара товара',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_av_resize',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => "0=Не ресайз
1=Только W пропорционально
2=Только H пропорционально
3=Непропорционально",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 11,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Метод',
                                      'config_description' => 'Используется только в том случае если выбран непропорциональный ресайз',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => 'catalog_av_method',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => "1=Метод 1
2=Метод 2
3=Метод 3",
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 12,
                                      'config_start_group' => '',
                                      'config_end_group'   => 1, );


// название страницы в разделе статических страниц
$SQL['menuname'] = "Каталог";

// требуется динамическое формирование
$SQL['menurebuild'] = 1;

# записываем таблицы, которые необходимо удалить при удалении модуля, таблицу с названием модуля удаляет автоматически, записывать без префиксов, через запятую
$del_tables =  array('catalog_categories', 'catalog_properties', 'catalog_property_set', 'catalog_property_values', 'catalog_2cats');

?>