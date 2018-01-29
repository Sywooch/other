<?php

// Задаем заголовки
header("Cache-control: no-cache, must-revalidate, no-store");
header("Pragma: no-cache");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

if( ! ini_get('date.timezone') )
    date_default_timezone_set('GMT');

// Задаем пути

define('CFG_APP_ROOT', str_replace(array('/config', '\config'), '', dirname(__FILE__)));
define('CFG_LIB_ROOT', CFG_APP_ROOT.'/lib');
define('CFG_TPL_ROOT', CFG_APP_ROOT.'/templatescustom');
define('CFG_BASE_TPL_ROOT', CFG_APP_ROOT.'/templates');
define('CFG_ARCA_ROOT', CFG_LIB_ROOT.'/arca');

define('CFG_BANNERS_SETTINGS',CFG_APP_ROOT.'/userdata/banner.txt');

define('HOST_NAME',isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
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
// Подключаем почтовый скрипт
require_once(CFG_APP_ROOT . '/lib/SwiftMailer/swift_required.php');

$alias = '';
if (isset($_GET['q'])) $alias = rtrim($_GET['q'], '/');
if($alias){
    $cms = new CMS();

    $alias = explode('/', $alias);
    $_GET['script_name'] = $alias[0];
    $_GET['p'] = $alias[0];
    switch($_GET['script_name']){
        case 'category':
        case 'subcategory':
            $cms->Check();
            $_GET['cid'] = (isset($alias[1])) ? $cms->getCategoryIdByAlias($alias[1]) : $_GET['cid'];
            break;
        case 'post':
            $cms->Check();
            if (count($alias) > 1 && ! array_key_exists('id', $_GET)) {
                $id = $cms->getBlogPostIdByAlias($alias[1]);
                if ( !empty($id)) {
                    $_GET['id'] = $id; 
                } else {
                    header('Location: /digest');
                    
                }
            }
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
global $otapilib;
$otapilib = new OTAPIlib();
if (defined('CFG_SERVICE_URL')) $otapilib->_server = CFG_SERVICE_URL;

if (OTBase::isTest()) {
    $cfg_version = time();
} else {
    $path = 'updates/version.xml';
    if (file_exists($path)) {
       $v = simplexml_load_file($path);
       $cfg_version = $v->Version[0]->Number;
    } else {
       $cfg_version = date('y-m-d');
    }
}
if (!defined('CFG_SITE_VERSION')) define('CFG_SITE_VERSION', $cfg_version);

General::init();
@define('CFG_SITE_NAME', General::getConfigValue('site_name'));

define('REFERER_KEY', 'refId'); // Ключ в гет-параметрах, который идентифицирует реферера

define('CFG_REVIEWS_LOG_ANALYZE_URL', 'http://support.opentao.net/log_analyzer/on_error/reviews');

OTBase::import('system.otapilib2.lib.*');
OTBase::import('system.otapilib2.types.*');
OTBase::import('system.otapilib2.UnboundedElementsIterator');
OTBase::import('system.otapilib2.OTAPILib2');
OTBase::import('system.otapilib2.AbstractOTAPILib2');
OTAPILib2::init();

