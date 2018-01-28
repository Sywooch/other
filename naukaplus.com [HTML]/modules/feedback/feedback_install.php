<?php
#
# Установка модуля
#



$mod_name = 'feedback';
$mod_title = "Форма обратной связи";



/* вставка информации о модуле в таблицу модулей */
$SQL[] = "INSERT INTO `se_modules` VALUES ('".$mod_name."', 1, '".$mod_title."', 1, 0, 0, '', 0, 1000);";



$SQL['settings']['group'] = array( 'config_title'       => '',
                                   'config_description' => 'адрес, шаблон и заголовок письма',
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


$SQL['settings']['sett'][] = array( 'config_title'       => 'Электронный адрес получателя',
                                      'config_description' => 'Если пусто, то адрес будет взят из "Главных настроек сайта".',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_email',
                                      'config_value'       => '',
                                      'config_default'     => '',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 1,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );


$SQL['settings']['sett'][] = array( 'config_title'       => 'Заголовок письма',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'input',
                                      'config_key'         => $mod_name.'_title',
                                      'config_value'       => '',
                                      'config_default'     => 'Обращение через форму обратной связи',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 2,
                                      'config_start_group' => '',
                                      'config_end_group'   => 0, );

$SQL['settings']['sett'][] = array( 'config_title'       => 'Шаблон отправляемого сообщения',
                                      'config_description' => '',
                                      'config_group_title' => '',
                                      'config_type'        => 'editor',
                                      'config_key'         => $mod_name.'_template',
                                      'config_value'       => '',
                                      'config_default'     => '<p>Сообщение было сформировано <b>{date}</b></p>
<p>&nbsp;</p>
<p>ФИО: {name}<br />
E-mail: {email}</p>
<p>Текст сообщения:<br />
{text}</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>--<br />
С уважением, <a href="http://{host}">{host}</a></p>',
                                      'config_extra'       => '',
                                      'config_evalphp'     => '',
                                      'config_protected'   => 1,
                                      'config_position'    => 3,
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