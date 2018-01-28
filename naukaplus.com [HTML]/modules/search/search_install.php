<?php
#
#  самоустановка модул€
#



$mod_name = 'search';
$mod_title = "ѕоиск по сайту";



/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES (
	'".$mod_name."', 	/* название модуль */
	1, 			/* активность модул€ */
	'".$mod_title."', 	/* название модул€ в кирилице */
	0, 			/* использовать структуру модул€ дл€ формировани€ меню */
	0, 			/* открыть сразу при входе в админку */
	0, 			/* модуль €вл€етс€ частью €дра */
	'', 			/* иснтрукции дл€ операций в админке (необходимо дл€ модулей €дра) */
	0, 			/* разрешить поиск по контенту модул€ */
	1000			/* позици€ в списке модулей (встать в конец списка) */
);";



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


$SQL['settings']['sett'][] = array( 'config_title'       => ' оличество номерков в строке нумерации страниц',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_leave_out',
                                      'config_value'       => '',
                                      'config_default'     => '5',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => ' оличество пунктов результатов поиска на странице',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      //'config_group'       => '',
                                      'config_type'        => 'input',
                                      'config_key'         => 'search_count_on_page',
                                      'config_value'       => '',
                                      'config_default'     => '15',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => ' оличество симвлов обрезаемых с каждой из сторон выдержки',
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

// название страницы в разделе статических страниц
$SQL['menuname'] = '';

// требуетс€ динамическое формирование
$SQL['menurebuild'] = 0;

# записываем таблицы, которые необходимо удалить при удалении модул€
# записывать без префиксов и через зап€тую
# таблица с названием модул€ удал€етс€ автоматически
$del_tables =  array();


?>