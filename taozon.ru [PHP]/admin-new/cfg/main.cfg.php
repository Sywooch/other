<?php

define('HOST_NAME',isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');

define('ADMIN_ABSOLUTE_PATH', dirname(dirname(__FILE__)));

define('BASE_DIR_CFG', str_replace(realpath(dirname(__FILE__).'/../'), '', dirname(__FILE__)));
define('BASE_DIR', ltrim(str_replace('cfg', '', realpath(BASE_DIR_CFG)), '/'));

define('BASE_ADMIN_PATH', dirname(dirname(__FILE__)).'/');
define('BASE_ADMIN_URL', '/' . basename(BASE_ADMIN_PATH));
define('TPL_PATH', BASE_ADMIN_PATH.'templates/');
define('BASE_PATH', dirname(BASE_ADMIN_PATH).'/');

define('TPL_ABSOLUTE_PATH',ADMIN_ABSOLUTE_PATH.'/templates/');
define('TPLCUSTOM_ABSOLUTE_PATH',ADMIN_ABSOLUTE_PATH.'/templatescustom/');

define('TPL_DIR',BASE_DIR.'templates/');
define('TPLCUSTOM_DIR',BASE_DIR.'templatescustom/');
define('CFG_DIR',BASE_DIR.'cfg/');

$GLOBALS['SESSION_CFG'] = array(
    'session.name'=>'sessid',
);

define('CFG_APP_ROOT', dirname(dirname(dirname(__FILE__))));
define('CFG_LIB_ROOT', CFG_APP_ROOT.'/lib');
define('CFG_BANNERS_SETTINGS',CFG_APP_ROOT.'/userdata/banner.txt');

// Подключение конфига хоста
$customConfigFile = dirname(__FILE__) . '/hosts/' . HOST_NAME . '.config.php';
if (file_exists($customConfigFile)) {
    require_once($customConfigFile);
}

if (defined('DEVELOP') && DEVELOP) {
    define('CFG_ADMIN_VERSION', time());
} else {
    $path = CFG_APP_ROOT . '/updates/version.xml';

    if (file_exists($path)) {
       $v = simplexml_load_file($path);
       $cfg_version = $v->Version[0]->Number;
    } else { 
       $cfg_version = date('y-m-d');
    }
    define('CFG_ADMIN_VERSION', $cfg_version);
}

require CFG_LIB_ROOT . DIRECTORY_SEPARATOR . 'OTBase.class.php';

//Загрузка классов
$GLOBALS['CFG_CLASS_FILE'] = array (
    'OTAPIlib'          => CFG_APP_ROOT.'/otapilib.php',
    'TAOlib'          => CFG_APP_ROOT.'/taolib.php',
    'axapta'            => CFG_APP_ROOT.'/axapta.php',
    'timer'             => CFG_LIB_ROOT.'/timer.php',
);

// Функция для автозагрузки классов
function my_autoloader_new($class_name)
{
    if (OTBase::autoload($class_name)) {
        return;
    }

    if (file_exists(CFG_APP_ROOT.'/admin-new/utilscustom/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/utilscustom/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/admin-new/utils/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/utils/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/admin-new/lib/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/lib/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/admin-new/lib/otapi_providers/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/lib/otapi_providers/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/admin-new/lib/view/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/lib/view/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/admin-new/interfaces/'.$class_name.'.interface.php'))
    {
        include_once(CFG_APP_ROOT.'/admin-new/interfaces/'.$class_name.'.interface.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/interfaces/'.$class_name.'.interface.php'))
    {
        include_once(CFG_LIB_ROOT.'/interfaces/'.$class_name.'.interface.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/otapi_providers/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/otapi_providers/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/helpers/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/helpers/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/repository/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/repository/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/exceptions/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/exceptions/'.$class_name.'.class.php');
    }
    elseif ((isset($GLOBALS['CFG_CLASS_FILE'][$class_name])) && (file_exists($GLOBALS['CFG_CLASS_FILE'][$class_name])))
    {
        include_once($GLOBALS['CFG_CLASS_FILE'][$class_name]);
    }
    else
    {
        die('Невозможно загрузить класс '.$class_name);
    }
}

spl_autoload_register('my_autoloader_new');

Plugins::invokeEvent('onAddAdminNewCustomAutoload');

$otapilib = new OTAPIlib();
if (defined('CFG_SERVICE_URL')) $otapilib->_server = CFG_SERVICE_URL;

date_default_timezone_set('Europe/Moscow');
session_start();

if(!defined('CFG_SITE_NAME'))
    define('CFG_SITE_NAME', General::getConfigValue('site_name'));

OTBase::import('system.otapilib2.lib.*');
OTBase::import('system.otapilib2.types.*');
OTBase::import('system.otapilib2.UnboundedElementsIterator');
OTBase::import('system.otapilib2.OTAPILib2');
OTBase::import('system.otapilib2.AbstractOTAPILib2');
OTAPILib2::init();
