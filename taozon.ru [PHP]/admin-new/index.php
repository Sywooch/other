<?
header('Content-Type: text/html; charset=utf-8');

// Запоминаем время начала генерации страницы
$GLOBALS['script_start_time'] = microtime(true);
$GLOBALS['trace'] = array();

chdir('../');
include('config.php');
chdir('admin-new/');
include('cfg/main.cfg.php');
include('cfg/error.cfg.php');

require_once CFG_APP_ROOT . '/logs/Log.class.php';
OTBase::import('system.logs.AdminNewLog');
OTBase::import('system.admin-new.lib.ErrorHandler');

$request = new RequestWrapper();
$isAjax = $request->isAjax();
if (! $isAjax && $request->getValue('do') != 'getTranslations') {
    $L = new AdminNewLog();
    $L->Start();
}

ob_start();
if (! file_exists(dirname(__FILE__).'/utils/Lang.class.php')) {
    General::init();
}
ob_end_clean();

require BASE_PATH.'lib/LangAdmin.class.php';
LangAdmin::getTranslations(BASE_ADMIN_PATH.'langs/', Session::getActiveAdminLang(), $request->get('section', false));
Lang::getTranslations('', Session::getActiveAdminLang());

if ($request->getValue('debug')) {
    define('MANUAL_DEBUG_MODE', true);
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}

ErrorHandler::init();
try {
    $authenticationListener = new AuthenticationListener();
    Request::handle($request, $authenticationListener);
}
catch (ServiceException  $e) {
    ErrorHandler::registerError($e);
}
catch (Exception  $e) {
    ErrorHandler::registerError($e);
    Session::setError($e->getMessage(), $e->getCode());
}

if (! $isAjax && $request->getValue('do') != 'getTranslations') {
    $L->CompleteClose();
}
