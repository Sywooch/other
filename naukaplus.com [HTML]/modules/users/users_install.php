<?php
#
# Установка модуля
#



$mod_name = 'actions';
$mod_title = "Акции";







/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES ('".$mod_name."', 1, '".$mod_title."', 1, 0, 0, '', 1, 1000);";



/* создание таблицы */
$SQL[] = "CREATE TABLE `se_".$mod_name."` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `is_active` smallint(1) NOT NULL default '0',
  `timestamp` int(11) default NULL,
  `lastmodified` int(11) default NULL,
  `alias` varchar(60) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `h1` varchar(255) default NULL,
  `menu` varchar(255) NOT NULL default '',
  `sbody` text,
  `body` longtext NOT NULL,
  `author` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  `template` varchar(255) NOT NULL default '',
  `owner` varchar(255) NOT NULL default '',
  `is_redirect` tinyint(1) NOT NULL default '0',
  `item_order` int(3) NOT NULL default '0',
  `img` varchar(255) NOT NULL default '',
  `is_best` tinyint(1) default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `is_active` (`is_active`),
  KEY `is_best` (`is_best`)
) ENGINE=MyISAM;";








$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => '',
                                   'config_group_title' => $mod_title,
                                   'config_group'       => $mod_title,
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


$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество пунктов на странице модуля',
                                      'config_description' => 'Максимальное количество пунктов при выводе пользовательской части. Если пунктов больше, появляется постраничный вывод',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_count_onpage',
                                      'config_value'       => '',
                                      'config_default'     => '15',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество уровней в иерархии',
                                      'config_description' => 'Один уровень - лента: новости, анонсы, объявления, сотрудники компании... Два уровня: простой каталог, задачи разбитые по отраслям... Три уровня и более: сложные товарные каталоги... 0 - ограничение нет, каталог любой величины',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_levels',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
$SQL['settings']['sett'][] = array( 'config_title'       => 'Способ формирование списков',
                                      'config_description' => 'Значение "0" - новые пункты добавляются в конец списка (предполагаемые акции, события) Значение "1" - новые пункты добавляются в начало списка (новости, вакансии)',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_typeadd',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество последних добавленных выводимых пунктов',
                                      'config_description' => 'Максимально допустимое количество пунктов при выводе списка последних добавленных пунктов модуля',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_count_on_mainpage',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 4,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
$SQL['settings']['sett'][] = array( 'config_title'       => 'Показывать список последний пунктов только на главной странице сайта',
                                      'config_description' => 'Если список нигде больше не демонстрируется, кроме главной страницы сайта, то нужно поставить 1. Экономятся SQL-запросы.',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_onlymain',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 5,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество отмеченных/лучших пунктов не на страницах модуля',
                                      'config_description' => 'Максимально допустимое количество пунктов при выводе списка отмеченных/лучших пунктов модуля',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_best_count_on_mainpage',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 6,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );
$SQL['settings']['sett'][] = array( 'config_title'       => 'Показывать список отмеченных/лучших пунктов только на главной странице сайта',
                                      'config_description' => 'Если список нигде больше не демонстрируется, кроме страницы страницы сайта, то нужно поставить 1. Экономятся SQL-запросы.',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_best_onlymain',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 7,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





$SQL['settings']['sett'][] = array( 'config_title'       => 'Хранить исходное изображение',
                                      'config_description' => 'Иногда необходимо дать возможность просмотреть исходные большие фото. Но это не всегда необходимо, поэтому можно отключить.',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_save_imgsource',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 8,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Главное фото - тип ресайза',
                                      'config_description' => 'Большое фото для отображения на странице товара',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_img_typeresize',
                                      'config_value'       => '',
                                      'config_default'     => '2',
                                      'config_extra'       => '1=Ресайз по большей стороне
2=Ресайз по ширине
3=Ресайз по высоте
4=Приведение к квадрату
0=Не ресайзить',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 9,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Главное фото - длинна выбранной стороны',
                                      'config_description' => 'Указывать длину в пикселях',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_img_size',
                                      'config_value'       => '',
                                      'config_default'     => '300',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 10,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Главное фото - коэффициент качества',
                                      'config_description' => '100 - лучшее качество, 0 - худшее',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_img_quality',
                                      'config_value'       => '',
                                      'config_default'     => '90',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 11,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Привью - тип ресайза',
                                      'config_description' => 'Уменьшенное фото для демонстрации в списках и в навигации',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_th_typeresize',
                                      'config_value'       => '',
                                      'config_default'     => '4',
                                      'config_extra'       => '1=Ресайз по большей стороне
2=Ресайз по ширине
3=Ресайз по высоте
4=Приведение к квадрату
0=Не ресайзить',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 12,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Привью - длина стороны',
                                      'config_description' => 'Указывать длину в пикселях',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_th_size',
                                      'config_value'       => '',
                                      'config_default'     => '72',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 13,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Привью - коэффициент качества',
                                      'config_description' => '100 - лучшее качество, 0 - худшее',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_th_quality',
                                      'config_value'       => '',
                                      'config_default'     => '80',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 14,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );




// название страницы в разделе статических страниц
$SQL['menuname'] = $mod_title;

// требуется динамическое формирование
$SQL['menurebuild'] = 0;

# записываем таблицы, которые необходимо удалить при удалении модуля
# записывать без префиксов и через запятую
# таблица с названием модуля удаляется автоматически
$del_tables =  array();

?>