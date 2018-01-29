<?php

// Задаем заголовки
header("Cache-control: no-cache, must-revalidate, no-store");
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

// Задаем пути
define('CFG_APP_ROOT', str_replace(array('/config', '\config'), '', dirname(__FILE__)));
define('CFG_LIB_ROOT', CFG_APP_ROOT.'/lib');
define('CFG_TPL_ROOT', CFG_APP_ROOT.'/templatescustom');
define('CFG_BASE_TPL_ROOT', CFG_APP_ROOT.'/templates');
define('CFG_ARCA_ROOT', CFG_LIB_ROOT.'/arca');

define('CFG_BANNERS_SETTINGS',CFG_APP_ROOT.'/userdata/banner.txt');

if (!defined('TS_HOST_NAME'))
    define('TS_HOST_NAME', preg_replace( '~:[0-9]+$~', '', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '' ));

date_default_timezone_set('Europe/Moscow');

session_start();

if (isset($_SESSION['list_counter']))
{
    $_SESSION['list_counter']++;
} else {
    $_SESSION['list_counter']=1;
}

// Подключаем функцию автоматической загрузки запрашиваемых классов
require_once(CFG_APP_ROOT.'/config/autoload.config.php');

$alias = '';
if (isset($_GET['q'])) $alias = rtrim($_GET['q'], '/');
if($alias){
    $cms = new SafedCMS();

    $alias = explode('/', $alias);
    $_GET['script_name'] = $alias[0];
    $_GET['p'] = $alias[0];
    switch($_GET['script_name']){
        case 'category':
        case 'subcategory':
            $_GET['cid'] = $cms->callCMSMethod('getCategoryIdByAlias', array('alias' => $alias[1]));
            break;
    }
}

if (preg_match('/admin/i', $_SERVER['SCRIPT_NAME'])) $_GET['p'] = 'admin';

define ('SCRIPT_NAME', ((isset($_GET['p'])) && ($_GET['p'] != '')) ? $_GET['p'] : 'index');

// HSTemplate initialization
$HSTemplate_options = array(
                'template_path' => CFG_TPL_ROOT,
                'cache_path'    => CFG_APP_ROOT . '/cache',
                'debug'         => false,
                );
if(defined('CFG_CUSTOM_CACHE_DIR')) $HSTemplate_options['cache_path'] = CFG_APP_ROOT . '/' . CFG_CUSTOM_CACHE_DIR;
$HSTemplate = new HSTemplate($HSTemplate_options);

if (!defined('CFG_SERVICE_APPKEY')) @define('CFG_SERVICE_APPKEY', '');
if (!defined('CFG_SERVICE_APPPASSWORD')) @define('CFG_SERVICE_APPPASSWORD', '');

// OTAPIlib
$otapilib = new OTAPIlib();
if (defined('CFG_SERVICE_URL')) $otapilib->_server = CFG_SERVICE_URL;

General::init();
@define('CFG_SITE_NAME', General::getSiteConfig('site_name'));

?>