<?
//if (file_exists('install/index.php') && !file_exists('userdata/finish')) header('Location: install/');
header('Content-Type: text/html; charset=utf-8');

// Запоминаем время начала генерации страницы
$GLOBALS['script_start_time'] = microtime(true);
$GLOBALS['trace'] = array();

// Подключаем файл с паролями от сервиса
require_once('../config.php');

// Подключаем конфигурационный файл
require_once('../config/config.php');
Users::AutoLogin();

session_cache_expire(60*24);

if(!defined('CFG_CACHED')){
    define('CFG_CACHED', false);
}

// Проверим, нет ли реферальной ссылки, и если есть - запомним
if (RequestWrapper::get(REFERER_KEY)) {
    Cookie::set(REFERER_KEY, RequestWrapper::get(REFERER_KEY), time()+60*60*24*30, '/', '.' . TS_HOST_NAME);
    Session::set(REFERER_KEY, RequestWrapper::get(REFERER_KEY));
}

Plugins::invokeEvent('onPageStartLoad');

//подключаем базу данных
global $opentaoCMS;
$opentaoCMS = new SafedCMS();


$CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'Calculator');
define('CFG_PAGE_TEMPLATE', 'calculator');

class ShowPage extends GenerateBlock
{
    protected $_cache           = false; //- кэшируем или нет.
    protected $_life_time       = 30; //- время на которое будем кешировать.
    public    $_template        = 'index'; //- шаблон, на основе которого будем собирать блок.
    public    $_template_path   = '/';

    public function __construct()
    {
        parent::__construct();
    }

    protected function setVars()
    {
        // Шаблон страницы
        if (defined('CFG_PAGE_TEMPLATE'))
        {
            $this->_template = CFG_PAGE_TEMPLATE;
        }
        // Генерируем блоки
        if ((isset($GLOBALS['CFG_CREATE_BLOCKS'])) && (is_array($GLOBALS['CFG_CREATE_BLOCKS'])))
        {
            foreach ($GLOBALS['CFG_CREATE_BLOCKS'] as $class)
            {
                $block = new $class();
                $data = '';
                try{
                    $data = $block->Generate();
                }
                catch(ServiceException $e){
                    show_error($e->getErrorCode().': '.$e->getErrorMessage());
                }
                catch(Exception $e){
                    show_error($e->getMessage());
                }
                $this->tpl->assign($class, $data);
            }
        }
        if (defined('CFG_PAGE_TEMPLATE_PATH'))
        {
            $this->_template_path = CFG_PAGE_TEMPLATE_PATH;
        }
    }

    public function Show()
    {        
        $page = parent::Generate();
        echo $page;
        
        SilentActions::updateMainPageCache();
        SilentActions::backupMainPage($page);
    }
}

try {

    global $HSTemplate;
    $HSTemplate->assignGlobal('script_name', SCRIPT_NAME);
    $show = new ShowPage();
    $show->Show();

    Cache_my::DelOldCache(dirname(__FILE__).'/cache/');
    if (CMS::IsFeatureEnabled('ProductComments')) {
        SilentActions::clearOldReviews();
    }
    SilentActions::sendTHSNotification();

    if(CMS::IsFeatureEnabled('Newsletter'))
        SilentActions::sendNewsletters();
}
catch (DBException $e) {
    OTBase::import('system.lib.startup_scripts.MainPage');
    echo MainPage::getBackup();
    echo 'Database connection error';
}

Plugins::invokeEvent('onPageCompleteLoad');
?>