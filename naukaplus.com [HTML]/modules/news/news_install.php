<?php
#
# Установка модуля
#



$mod_name = 'news';
$mod_title = "Новости";







/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES (
	'".$mod_name."', 	/* название модуль */
	1, 			/* активность модуля */
	'".$mod_title."', 	/* название модуля в кирилице */
	1, 			/* использовать структуру модуля для формирования меню */
	0, 			/* открыть сразу при входе в админку */
	0, 			/* модуль является частью ядра */
	'', 			/* иснтрукции для операций в админке (необходимо для модулей ядра) */
	1, 			/* разрешить поиск по контенту модуля */
	1000			/* позиция в списке модулей (встать в конец списка) */
);";



/* создание таблицы */
$SQL[] = "CREATE TABLE `se_".$mod_name."` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `is_active` smallint(1) NOT NULL default '0',
  `is_best` tinyint(1) default '0',
  `is_sheet` tinyint(1) default '1',
  `is_redirect` tinyint(1) NOT NULL default '0',
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
  `item_order` int(3) NOT NULL default '0',
  `img` varchar(255) NOT NULL default '',  
  `price` decimal(10,2) default '0',  
  `item_count` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`),
  KEY `is_active` (`is_active`),
  KEY `is_best` (`is_best`),
  KEY `is_sheet` (`is_sheet`)
) ENGINE=MyISAM;";








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



$SQL['settings']['sett'][] = array( 'config_title'       => 'Тип каталога',
                                      'config_description' => 'Определяет назначение модуля',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_type',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '0=Без цены и фотографии
1=С фото, но без цены
2=С фотографией и ценой',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 0,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => 'Использовать кеширование',
                                      'config_description' => 'Если да, то в папке загруженных файлов модуля, в подпапке /cache/ хранятся HTML представления выводимых модулем блоков',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_cache',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
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
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Количество уровней в иерархии',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_levels',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '0=Ограничений нет (большой каталог)
1=Один уровень в иерархии (новости, события, статьи)
2=Два уровня (простой каталог)',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Способ формирование списков',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_typeadd',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '0=Добавлять пункты в конец списка (каталог)
1=Добавлять пункты в начало списка (новости)',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 4,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );



$SQL['settings']['sett'][] = array( 'config_title'       => 'Последние добавленные пункты - где выводить?',
                                      'config_description' => 'Правильная настройка поможет оптимизировать количество SQL запросов',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_last_type',
                                      'config_value'       => '',
                                      'config_default'     => '2',
                                      'config_extra'       => '0=Не выводить нигде
1=Выводить на всех страницах сайта
2=Выводить только на главной странице сайта
3=Выводить только на главной странице модуля
4=Выводить на страницах модуля',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 5,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );	

$SQL['settings']['sett'][] = array( 'config_title'       => 'Последние добавленные пункты - сколько выводить?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_last_count',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 6,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );




$SQL['settings']['sett'][] = array( 'config_title'       => 'Лучшые пункты - где выводить?',
                                      'config_description' => 'Правильная настройка поможет оптимизировать количество SQL запросов',
                                      'config_group_title' => '',
                                      'config_type'        => 'dropdown',
                                      'config_key'         => $mod_name.'_best_type',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '0=Не выводить нигде
1=Выводить на всех страницах сайта
2=Выводить только на главной странице сайта
3=Выводить только на главной странице модуля
4=Выводить только на всех страницах модуля',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 7,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Лучшие пункты - сколько выводить?',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_best_count',
                                      'config_value'       => '',
                                      'config_default'     => '3',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 8,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





$SQL['settings']['sett'][] = array( 'config_title'       => 'Хранить исходное изображение',
                                      'config_description' => 'Иногда необходимо дать возможность просмотреть исходные большие фото. Но это не всегда необходимо, поэтому можно отключить.',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_save_imgsource',
                                      'config_value'       => '',
                                      'config_default'     => '1',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 9,
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
                                      'config_position'    => 10,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Главное фото - длинна выбранной стороны',
                                      'config_description' => 'Указывать длину в пикселях',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_img_size',
                                      'config_value'       => '',
                                      'config_default'     => '500',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 11,
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
                                      'config_position'    => 12,
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
                                      'config_position'    => 13,
                                      'config_start_group' => ' ',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Привью - длина стороны',
                                      'config_description' => 'Указывать длину в пикселях',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_th_size',
                                      'config_value'       => '',
                                      'config_default'     => '96',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 14,
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
                                      'config_position'    => 15,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'История просмотра - сколько выводить?',
                                      'config_description' => 'Необходимо указать количество показываемых пунктов. Выводятся пункты только на страницах модуля и более нигде. Указав "0", вы отключите "историю просмотров".',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_history',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 16,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Формировать меню по структуре модуля',
                                      'config_description' => 'Применяется для сложных больших каталог',
                                      'config_group_title' => '',
                                      'config_type'        => 'yes_no',
                                      'config_key'         => $mod_name.'_menu',
                                      'config_value'       => '',
                                      'config_default'     => '0',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 17,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );





// название страницы в разделе статических страниц
$SQL['menuname'] = $mod_title;

// требуется динамическое формирование
$SQL['menurebuild'] = 1;

# записываем таблицы, которые необходимо удалить при удалении модуля
# записывать без префиксов и через запятую
# таблица с названием модуля удаляется автоматически
$del_tables =  array();

?>