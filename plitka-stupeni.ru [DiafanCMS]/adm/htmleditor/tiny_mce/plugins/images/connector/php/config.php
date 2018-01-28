<?php

define('DIAFAN', 1);
define('ABSOLUTE_PATH', dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))).'/');
include_once ABSOLUTE_PATH.'config.php';

ini_set('display_errors', MOD_DEVELOPER ? 'on' : 'off');
error_reporting(MOD_DEVELOPER ? E_ALL : 0);


//Корневая директория сайта
define('DIR_ROOT', ABSOLUTE_PATH.USERFILES);

//Корневая директория сайта
define('DIR_REAL', '/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').USERFILES);

//Директория с изображениями (относительно корневой)
define('DIR_IMAGES', '/images');
//Директория с файлами (относительно корневой)
define('DIR_FILES', '/ufiles');

//Высота и ширина картинки до которой будет сжато исходное изображение и создана ссылка на полную версию
define('WIDTH_TO_LINK', 1200);
define('HEIGHT_TO_LINK', 1200);

//Атрибуты которые будут присвоены ссылке (для скриптов типа lightbox)
define('CLASS_LINK', 'lightview');
define('REL_LINK', 'lightbox');

date_default_timezone_set('Asia/Yekaterinburg');
