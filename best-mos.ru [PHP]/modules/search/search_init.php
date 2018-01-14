<?php
#
#  Инициализация класса FAQClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Web Otdel» Ltd
#




require('search_main.php');                // модуль вывода FAQ
require(TEMPLATES_PATH.'/search_t_config.php');          // файл шаблонов


$searchword         = '';        // поисковая фраза
//$arrows                        = '';        // нумерация страниц результатов поиска
$search_count        = 0;        // общее количество результатов поиска
//$doby        - список результатов поиска


?>
