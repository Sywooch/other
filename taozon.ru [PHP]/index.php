<?
//if (file_exists('install/index.php') && !file_exists('userdata/finish')) header('Location: install/');
header('Content-Type: text/html; charset=utf-8');

// Запоминаем время начала генерации страницы
$GLOBALS['script_start_time'] = microtime(true);
$GLOBALS['trace'] = array();

// Подключаем файл с паролями от сервиса
require_once('config.php');

// Подключаем конфигурационный файл
require_once('config/config.php');
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

if(file_exists(dirname(__FILE__).'/custom/custom.php')){
    require dirname(__FILE__).'/custom/custom.php';
}

if(@General::$siteConf['site_temporary_unavailable'] && SCRIPT_NAME!='robo_request' && SCRIPT_NAME!='onpay_request' && SCRIPT_NAME!='get_user_data_summary'
    && SCRIPT_NAME!='menushortajax' && SCRIPT_NAME!='search_ajax' && !@$_SESSION['sid']) {
    General::$isContent = true;
    $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ContentData');
    define('CFG_PAGE_TEMPLATE', 'cms');
}
else{
// В зависимости от страницы подгружаем необходимые блоки и задаем шаблон страницы
    switch(SCRIPT_NAME)
    {
        case 'test_furl':
            die('OK');
            break;
        case 'style':
            define('NO_DEBUG_STRONG', 1);
            break;
        case Plugins::onAddScriptProcessorCheck(SCRIPT_NAME, ''):
            $CFG_CREATE_BLOCKS = Plugins::onAddScriptProcessor(SCRIPT_NAME, '');
            break;
        case Plugins::onAddScriptProcessorCheck(SCRIPT_NAME, '_custom'):
            $CFG_CREATE_BLOCKS = Plugins::onAddScriptProcessor(SCRIPT_NAME, '_custom');
            break;
        case 'calculator':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'Calculator');
            define('CFG_PAGE_TEMPLATE', 'calculator');
            break;
        case 'referral':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Menu', 'Referral');
            define('CFG_PAGE_TEMPLATE', 'referral');
            break;
        case 'outputofmoney':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Menu', 'OutputOfMoney');
            define('CFG_PAGE_TEMPLATE', 'outputofmoney');
            break;
        case 'set_currency':
            $_SESSION['currency'] = RequestWrapper::get('c');
            $_SESSION['ManualVAL'] = "1";
            if(@$_SERVER['HTTP_REFERER'])
                header('Location: '.@$_SERVER['HTTP_REFERER']);
            die();
            break;
        case 'getpromotions':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');

            $itemid = RequestWrapper::get('itemid');

            $promo = $otapilib->GetItemPromotionsWithAttempts($itemid, 10);
            if ($promo === false){
                $promo = $otapilib->error_code;
                print json_encode($promo);
            }
            else{
                if (! empty($promo[0]) && ! empty($promo[0]['ConfiguredItems'])) {
                    foreach($promo[0]['ConfiguredItems'] as &$val){
                        $newConvertedPriceList = array();
                        foreach($val['Price']['PriceWithoutDelivery']['ConvertedPriceList']['DisplayedMoneys'] as $displayedPrice){
                            $displayedPrice['Val'] = (float)$displayedPrice;
                            $newConvertedPriceList[] = array(
                                'Sign' => (string)$displayedPrice['Sign'],
                                'Val' => (string)$displayedPrice['Val'],
                            );
                        }
                        $val['Price']['PriceWithoutDelivery']['ConvertedPriceList'] = $newConvertedPriceList;
                    }
                    $promo[0]['ConfiguredItems']['PromoId'] = $promo[0]['Id'];
                    print json_encode($promo[0]['ConfiguredItems']);
                }
                elseif(! empty($promo[0])){
                    print json_encode(array(
                        'PromoId' => $promo[0]['Id']
                    ));
                }
                else {
                    print json_encode(array());
                }
            }
            die();
            break;
        case 'webcron':
            $cron = new WebCron();
            $cron->Process();
            die;
            break;
        case 'get_delivery':
            global $otapilib;
            $modes = $otapilib->GetDeliveryModesWithPrice(RequestWrapper::get('code'), RequestWrapper::get('weight'));
            if ($modes && is_array($modes)) {
                foreach ($modes as &$m) {
                    foreach($m['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] as $i=>$d){
                        $price = $d;
                        $price->price = (float)$d;
                        $m['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][$i] = $price;
                    }
                }
            }
            print json_encode(array('success' => (bool)$modes, 'data' => $modes));
            die();
            break;
        case 'robo_request':
            $R = new Robokassa();
            $R->handleRequest();
            die();
            break;
        case 'onpay_request':
            $R = new Onpay();
            $R->handleRequest();
            die();
            break;
        case 'setlang':
            $CFG_CREATE_BLOCKS = array ();
            @$_SESSION['active_lang'] = @$_POST['lang'];

            header('Location: '.$_POST['from']);
            break;
        case 'support':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Menu', 'Support', 'Banners');
            if(RequestWrapper::get('mode') == 'new'){
                $HSTemplate->assignGlobal('support_title', Lang::get('new_message'));
            }
            elseif(RequestWrapper::get('mode') == 'view' || !RequestWrapper::get('mode')){
                $HSTemplate->assignGlobal('support_title', Lang::get('messages_list'));
            }
            define('CFG_PAGE_TEMPLATE', 'support');
            break;

        case 'content':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'Menu', 'Content');
            define('CFG_PAGE_TEMPLATE', 'content');
            break;

        case 'register':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Register');
            define('CFG_PAGE_TEMPLATE', 'register');
            break;

        case 'profile':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Menu', 'Profile');
            define('CFG_PAGE_TEMPLATE', 'profile');
            break;

        case 'privateoffice':
            if (RequestWrapper::get('print')=='Y')
                $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'PrivateOffice');
            elseif(CMS::IsFeatureEnabled('Newsletter'))
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'PrivateOffice', 'Menu', 'Subscribe');
            else
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'PrivateOffice', 'Menu');
            define('CFG_PAGE_TEMPLATE', 'privateoffice');
            break;

        case 'cancelorder':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::get('id');
            $sid = Session::getUserDataSid();
            $res = $otapilib->CancelSalesOrder($sid, $id);
            if($res){
                echo 'Ok';
            } else {
                echo 'Error';
            }
            die();
            break;

        case 'cancelorderitem':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $itemid = RequestWrapper::get('itemid');
            $orderid = RequestWrapper::get('orderid');
            $sid = Session::getUserDataSid();
            $res = $otapilib->CancelLineSalesOrder($sid, $orderid, $itemid);
            if($res){
                echo 'Ok';
            } else {
                echo 'Error';
            }
            die();
            break;

        case 'createticket':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $sid = Session::getUserDataSid();
            $res = PrivateOffice::createTicket($otapilib, $_POST);
            if($res){
                echo 'Ok';
            } else {
                echo 'Error';
            }
            die();
            break;

        case 'login':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Login');
            define('CFG_PAGE_TEMPLATE', 'login');
            break;

        case 'recovery':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Recovery');
            define('CFG_PAGE_TEMPLATE', 'recovery');
            break;

        case 'logout':
            $CFG_CREATE_BLOCKS = array ('Logout');
            define('CFG_PAGE_TEMPLATE', '');
            break;

        case 'brands':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'BrandsNew', 'CrumbsNew');
            define('CFG_PAGE_TEMPLATE', 'brandsnew');
            break;

        case 'all_vendors':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'AllVendors', 'CrumbsNew');
            define('CFG_PAGE_TEMPLATE', 'all_vendors');
            break;

        case 'my_category':
            $CFG_CREATE_BLOCKS = array ('MyItemsList', 'CrumbsNew', 'HeaderNew', 'FooterNew');
            define('CFG_PAGE_TEMPLATE', 'my_category');
            break;

        case 'subcategory':
            if ((RequestWrapper::get('root') && substr(RequestWrapper::get('cid'),0,3) == 'CID') || RequestWrapper::getParamExists('virt'))
            {
                // Показ подкатегорий без товаров, в рутовых категориях с ручным переводом нет товаров
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'SubCategoryNew');
                define('CFG_PAGE_TEMPLATE', 'subcategorynew');
            } else {
                // Показ подкатегорий c товарами и фильтром
                $CFG_CREATE_BLOCKS = array ('ItemListNew', 'CrumbsNew', 'HeaderNew', 'FooterNew');
                define('CFG_PAGE_TEMPLATE', 'categorynew');
            }
            break;
        case 'reviews':
            // Показ товаров с отзывами
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ItemWithReview');
            define('CFG_PAGE_TEMPLATE', 'reviews');
            break;

        case 'item':
            $CFG_CREATE_BLOCKS = array ('ItemInfoNew', 'HeaderNew', 'FooterNew', 'CrumbsNew');
            define('CFG_PAGE_TEMPLATE', 'iteminfonew');
            break;

        case 'pristroy':
            if (CMS::IsFeatureEnabled('FleaMarket')) {
                $CFG_CREATE_BLOCKS = array ('Pristroy', 'HeaderNew', 'FooterNew', 'CrumbsNew');
                define('CFG_PAGE_TEMPLATE', 'pristroy');
            }
            break;

        case 'myitem':
            $CFG_CREATE_BLOCKS = array ('MyItemInfo', 'HeaderNew', 'FooterNew', 'CrumbsNew');
            define('CFG_PAGE_TEMPLATE', 'myiteminfo');
            break;

        case 'itemajax':
            $CFG_CREATE_BLOCKS = array ('ItemInfoNew');
            define('CFG_PAGE_TEMPLATE', 'iteminfonew_ajax');
            break;

        case 'item_list_ajax':
            @define('NO_DEBUG_STRONG', 1);
            $CFG_CREATE_BLOCKS = array ('ItemListNew');
            define('CFG_PAGE_TEMPLATE', 'itemlistnew_ajax');
            break;

        case 'itemdescription':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemdescription');
            $itemId = RequestWrapper::get('itemid');
            $itemdescription = $otapilib->GetItemOriginalDescription($itemId);
            $itemdescription = str_replace('href=', 'rel="nofollow" href=', $itemdescription);
            $HSTemplate->assignGlobal('itemdescription', $itemdescription);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'itemdescriptiontranslated':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemdescription');
            $itemId = RequestWrapper::get('itemid');
            $itemdescription = $otapilib->GetItemDescription($itemId, Session::getActiveLang());
            $HSTemplate->assignGlobal('itemdescription', $itemdescription);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'addnotetobasket':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = $_POST['id'];
            $itemId = $_POST['itemId'];
            $quantity = $_POST['quantity'];
            $item = $otapilib->GetItemInfo($itemId);
            $_POST['currencyName'] = $item['currencyname'];
            if(BasketNew::addToBasket($otapilib, $itemId, $quantity)){
                echo 'Ok';
            } else {
                echo 'Error';
            }
            die();
            break;

        case 'editnoteitemquantity':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::get('id');
            $quantity = RequestWrapper::get('num');
            SupportListNew::editItemQuantity($otapilib, $id, $quantity);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editnoteitemcomment':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::post('id');
            $comment = RequestWrapper::post('comment');
            SupportListNew::editItemComment($otapilib, $id, $comment);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editbasketitemcomment':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::post('id');
            $comment = RequestWrapper::post('comment');
            BasketNew::editItemComment($otapilib, $id, $comment);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editbasketitemquantity':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::get('id');
            $quantity = RequestWrapper::get('num');
            BasketNew::editItemQuantity($otapilib, $id, $quantity);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'get_item_config':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::get('itemid');
            $fulliteminfo = $otapilib->BatchGetItemFullInfo('', $id, 'DeliveryCosts,Promotions');
            $itemBlock = new ItemInfoNew();
            $fulliteminfo['Item'] = $itemBlock->checkHierarchicalConfigurators($fulliteminfo['Item']);
            print json_encode($fulliteminfo);
            die();
            break;


        case 'itemtitle':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemtitle');
            $itemId = RequestWrapper::get('itemid');
            if (is_numeric($itemId)) {
                $itemInfo = $otapilib->GetItemInfo($itemId);
                $HSTemplate->assignGlobal('itemtitle', $itemInfo['title']);
            }
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'itemtraderateinfo':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemtraderateinfo');
            $itemId = RequestWrapper::get('itemid');
            try {
                $itemdescription = $otapilib->GetTradeRateInfoListFrame($itemId);
            } catch (ServiceException $e) {
                $methodCallInfo = array(
                    'errorMessage' => $e->getMessage(),
                    'methodname' => 'OTAPIlib::GetTradeRateInfoListFrame',
                    'time' => microtime(1) - $GLOBALS['script_start_time'],
                );
                $log = new Log();
                $log->AddMethod($methodCallInfo);
                $log->Write();
                $log->setNotificationUrl(CFG_REVIEWS_LOG_ANALYZE_URL);
                $log->Release();
            }

            $HSTemplate->assignGlobal('itemdescription', $itemdescription);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'vendor':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ItemListNew');
            define('CFG_PAGE_TEMPLATE', 'vendorinfonew');
            $vendorId = RequestWrapper::get('id');
            $vendorInfo = $otapilib->GetVendorInfo($vendorId);
            $HSTemplate->assignGlobal('vendorInfo', $vendorInfo);
            break;

        case 'download':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'CrumbsNew');
            define('CFG_PAGE_TEMPLATE', 'download');
            break;

        case 'docs':
            $CFG_CREATE_BLOCKS = array ('Header', 'Footer');
            define('CFG_PAGE_TEMPLATE', 'docs');
            break;

        case 'supportlist':
            $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew', 'SupportListNew');
            define('CFG_PAGE_TEMPLATE', 'supportlistnew');
            break;

        case 'supportlistadd':
            $CFG_CREATE_BLOCKS = array ();
            $res = SupportListNew::AddItemToNote($otapilib, RequestWrapper::get('id'), 1);

            if($res){
                $sid = Session::getUserDataSid();
                if (! $sid) {
                    $sid = isset($_COOKIE['NoteSid']) ? $_COOKIE['NoteSid'] : session_id();
                }
                setcookie("NoteSid", $sid, time()+3600*24*365);

                $items = $otapilib->GetNote($sid);
                echo json_encode(array('Success'=>'Ok', 'Count' => count($items), 'ItemId' => $res));
            }
            else{
                echo json_encode(array('Success'=>0));
            }
            define('CFG_PAGE_TEMPLATE', '');
            die();
            break;

        case 'MoveItemFromNoteToBasket':
            SupportListNew::moveToBasket(RequestWrapper::get('id'));
            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();
            break;

        case 'supportlistremove':
            $CFG_CREATE_BLOCKS = array ();

            $sid = Session::getUserDataSid();
            if (! $sid) {
                $sid = isset($_COOKIE['NoteSid']) ? $_COOKIE['NoteSid'] : session_id();
            }

            // удалить файл кеша корзины и избранного
            $fileMysqlMemoryCache = new FileAndMysqlMemoryCache(new CMS());
            $fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:' . Session::getUserOrGuestSession());

            $res = $otapilib->RemoveItemFromNote($sid, RequestWrapper::get('id'));

            if($res){
                $items = $otapilib->GetNote($sid);
                echo json_encode(array('Success'=>'Ok', 'Count' => count($items)));
            }
            else{
                echo json_encode(array('Success'=>0));
            }

            @define('CFG_PAGE_TEMPLATE', '');
            die();
            break;

        case 'basketremove':
            $CFG_CREATE_BLOCKS = array ();
            $sid = Session::getUserOrGuestSession();
            // удалить файл кеша корзины и избранного
            $fileMysqlMemoryCache = new FileAndMysqlMemoryCache(new CMS());
            $fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:' . Session::getUserOrGuestSession());
            $isdeleted = $otapilib->RemoveItemFromBasket($sid, RequestWrapper::get('addedToCartId'));
            if($isdeleted)
            {
                $items = $otapilib->GetBasket($sid);
                $count = 0;
                if (isset($items['Elements']) && is_array($items['Elements'])) {
                    $count = count($items['Elements']);
                }
                echo json_encode(array('Success'=>'Ok', 'Count' => $count, 'itemId' => ''));
            } else {
                echo json_encode(array('Success'=>0));
            }
            @define('CFG_PAGE_TEMPLATE', '');
            die();
            break;

        case 'basket':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'BasketNew');
            define('CFG_PAGE_TEMPLATE', 'basketnew');
            break;

        case 'userorder':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'UserZakazNew');
            define('CFG_PAGE_TEMPLATE', 'userzakaznew');
            break;

        case 'createorderajax':
            print json_encode(UserZakazNew::createOrder());
            die();
            break;

        case 'admin':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            break;

        case 'sendemail':
            $CFG_CREATE_BLOCKS = array ();
            send_email($_POST['m'], $_POST['f'], $_POST['o'], $_POST['e']);
            define('CFG_PAGE_TEMPLATE', '');
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editorderweight':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = RequestWrapper::get('id');
            $weight = str_replace(',', '.', RequestWrapper::get('w'));
            @define('NO_DEBUG_STRONG', true);
            BasketNew::editItemWeight($otapilib, $id, $weight);
            break;

        case 'getbasketcount':
            $sid = Session::getUserOrGuestSession();
            $basket = $otapilib->GetBasket($sid);
            print $basket !== false ? count($basket) : 1;
            die();
            break;

        case 'itemcomments':
            $CFG_CREATE_BLOCKS = array();
            define('CFG_PAGE_TEMPLATE', 'itemcomments');
            $itemId = RequestWrapper::get('itemid');
            $itemCID = RequestWrapper::get('itemcid');
            $itemUrl = RequestWrapper::get('itemurl');
            $HSTemplate->assignGlobal('itemid', $itemId);
            $HSTemplate->assignGlobal('itemcid', $itemCID);
            $HSTemplate->assignGlobal('itemurl', $itemUrl);

            $cms = new CMS();
            $cms->Check();

            try {
                $repo = new ItemInfoRepository($cms);
                $reviews = $repo->getItemComments($itemId, $itemCID);
                $HSTemplate->assignGlobal('reviews', $reviews);
            } catch (DBException $e) {
                Session::setError($e->getMessage(), 'DBError');
                $HSTemplate->assignGlobal('reviews', false);
            }

            @define('NO_DEBUG_STRONG', true);
            break;

        case 'digest':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ContentMenu', 'Digest');
            define('CFG_PAGE_TEMPLATE', 'digestnew');
            break;
        case 'post':
            $CFG_CREATE_BLOCKS = array ('Post','CrumbsNew', 'HeaderNew', 'FooterNew');
            define('CFG_PAGE_TEMPLATE', 'postnew');
            break;
        //Облегчаем шапку
        case 'menushortajax':
            $GLOBALS['menu_ajax'] = RequestWrapper::get('menu_ajax');
            $M = new MenuShortNew();
            echo $M->Generate();
            die();
            break;
        case 'search_ajax':
            $GLOBALS['searchcats_ajax'] = RequestWrapper::get('searchcats_ajax');
            $M = new SearchCategories();
            echo $M->Generate();
            die();
            break;
        case 'users_ajax':
            $GLOBALS['userdata_ajax'] = RequestWrapper::get('userdata_ajax');
            $M = new HeaderNew();
            echo $M->Generate();
            die();
            break;

        default:
            $page = $opentaoCMS->GetPageByAlias(SCRIPT_NAME);
            if(! $page) {
                header('HTTP/1.0 404 Not Found');

                if(file_exists(CFG_APP_ROOT . '/404.html')) {
                    echo file_get_contents(CFG_APP_ROOT . '/404.html');
                    die;
                } else {
                    $CFG_CREATE_BLOCKS = array ('HeaderNew', 'FooterNew','ContentData');
                }
            } else {
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew','ContentMenu', 'ContentData');
            }

            General::$isContent = true;
            define('CFG_PAGE_TEMPLATE', 'cms');
            break;
    }
}

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
                catch(ServiceException $e) {
                    $message = $e->getErrorMessage();
                    if (OTBase::isTest() && Session::get('sid')) {
                        $message = $e->getErrorCode().': '.$message;
                    }
                    show_error($message);
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
    if (OTBase::isTest()) {
        echo '<pre><h2>' . $e->getMessage() . "</h2>\n\n" . $e->getTraceAsString() . '</pre>';
    } else {
        OTBase::import('system.lib.startup_scripts.MainPage');
        echo MainPage::getBackup();
        echo 'Database connection error';
    }
}

Plugins::invokeEvent('onPageCompleteLoad');

function show_error($msg='', $file='')
{
    global $otapilib;
    $msg = $msg ? $msg : $otapilib->error_message;
    @$GLOBALS['error_text'] .= $msg;
    @$GLOBALS['error_text_hidden'] .= $otapilib->error_message;
    $GLOBALS['file_with_error'] = $_SERVER["HTTP_HOST"].$_SERVER['SCRIPT_NAME'].'?'.$_SERVER['QUERY_STRING'];
    $GLOBALS['show_error'] = true;
    $GLOBALS['error_code'] = (string)$otapilib->error_code;
    $GLOBALS['error_method'] = $otapilib->call_method;
}

function process_error_message ($msg) {
    if (strpos($msg, 'RKdevException') !== false) {
        return Lang::get('error_business_logic');
    } elseif (strpos($msg, 'SessionExpired') !== false) {
        return Lang::get('error_session_expired');
    } elseif (strpos($msg, 'InternalError') !== false) {
        return Lang::get('error_internal');
    } elseif (strpos($msg, 'ContractViolation') !== false) {
        return Lang::get('error_contract_violation');
    }
    return Lang::get('error_internal');
}

function mail_utf8($to, $subject = '(No subject)', $message = '', $header = '')
{
    $header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n";
    mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $header_ . $header);
}

function send_email($message, $file, $otapi, $errorCode)
{
    global $server;

    $mess  = " Сервер: ".$server;
    $mess .= " <br /><br /> URL: <a href='http://$file'>http://".$file."</a>";
    $mess .= " <br /><br /> Время: ".  date("F j, Y, g:i a");
    $mess .= " <br /><br /> Инстанс: ".  CFG_SERVICE_INSTANCEKEY;
    $mess .= " <br /><br /> OtapiUrl: <a href='$otapi' target='_blank'>".  $otapi . "</a>";
    $mess .= " <br /><br /> Код ошибки: ".  $errorCode;
    $mess .= " <br /><br /> Ошибка: ".  $message;

    $curl = new Curl('http://tools.opentao.ru/smtp_sender/send.php', 60, false, 10, false, true, false);
    $params = array(
        'mess' => $mess,
        'server' => $server
    );
    $curl->setPost(http_build_query($params));
    $curl->connect();
    $info = $curl->getInfo();

    echo 'Спасибо! Ваше письмо отправлено.';
}

if (defined('CFG_NEED_CUSTOM_CONFIG') && !defined('NO_DEBUG'))
{
    $GLOBALS['show_error'] = true;
    $GLOBALS['error_text'] = 'Не задана пользовательская конфигурация (файл <b>configcustom.php</b>)<br>Вы можете создать его на основе <b>configcustom_template.php</b><br><br>';
}

if (@$GLOBALS['show_error'])
{
    // Выводим ошибку
    ?>

    <?
    if (strripos($GLOBALS['error_text'], 'There is no delivery to country with code') !== false) {
        $GLOBALS['error_text'] = Lang::get('no_deliver_error');
    }
    ?>
<script type="text/javascript">
    $(function(){
        $('#error-dialog').dialog({
            title: '<?=Lang::get('otapi_request_error')?>',
            buttons:{
                "<?=Lang::get('report_to_email')?>": function(){
                    var e_message = get_error_message();
                    var e_file = get_file_with_error();
                    var e_otapi = get_otapi_url();
                    var e_code = get_error_code();
                    $.post(
                            'index.php?p=sendemail',
                            {m: e_message, f: e_file, o: e_otapi, e: e_code},
                            function(data) {
                                $('#error-dialog').dialog('close');
                            }
                    );
                }
            }
        });
        $('#error-dialog').html('<?=htmlspecialchars(mysql_real_escape_string($GLOBALS['error_text']))?>').dialog('open');
    });
</script>
<?
    $cfg_service_url = (defined('CFG_SERVICE_URL')) ? CFG_SERVICE_URL : '';
    print '
    <script>
    function get_error_message(){
       return "'.substr(htmlspecialchars(mysql_real_escape_string($GLOBALS['error_text_hidden'])),0,500).'";
    }

    function get_error_code(){
        return "'.$GLOBALS['error_code'].'";
    }

    function get_otapi_url(){
       return "'.rtrim($cfg_service_url,'/').'?op='.$GLOBALS['error_method'].'";
    }

    function get_file_with_error(){
       return "'.mysql_real_escape_string($GLOBALS['file_with_error']).'";
    }
    </script>';
}

if ((!defined('NO_DEBUG') || @General::$siteConf['show_debug']) && !defined('NO_DEBUG_STRONG'))
{
    // Выводим отладочную информацию
    $runtime = round(microtime(true) - $GLOBALS['script_start_time'], 5);

    ?>
<link rel="stylesheet" href="admin/css/jquery.treeview.css?<?=CFG_SITE_VERSION;?>" />
<script src="admin/js/jquery.cookie.js?<?=CFG_SITE_VERSION;?>" type="text/javascript"></script>
<script src="admin/js/jquery.treeview.js?<?=CFG_SITE_VERSION;?>" type="text/javascript"></script>
<style>
    #browser .closed {
        background-color: white;
        border: none;
        height: auto;
        overflow: auto;
    }
    span.time{
        display: inline-block;
        width: 120px;
    }
    span.method{
        display: inline-block;
        min-width: 200px;
    }
    #logs{
        display: block;
        width: 970px;
        margin: 20px auto 100px auto;
    }
</style>
<script>
    $(function(){
        $("#browser").treeview();
    });
</script>
<?

    function show_tree($xml){
        $t = 0;
        foreach($xml->Record as $record){ $t1=0; $t += (float)$record['Time']; $r = rand(0, 1500000); ?>
        <li class="closed">
            <span><span class="time"><?=number_format((float)$record['Time'], 2, '.', '')?> (<span id="r<?=$r?>"></span>)</span> <span class="method"><?=$record['Name']?></span> <span class="method"><?=$record['Message']?></span> Count: <?=$record['Count']?></span>
            <? if($record->InnerInfo){
            print '<ul>';
            $t1 = show_tree($record->InnerInfo);
            print '</ul>';
        } ?>
            <script>
                $('#r<?=$r?>').text('<?=number_format((float)$record['Time']-$t1, 2, '.', '')?>');
            </script>
        </li>
        <? }

        return number_format($t, 2, '.', '');
    }

    function print_params($params){
        if(@count($params)>0){
            print ' Параметры: ';
            foreach($params as $k=>$p){
                if($k != 'instanceKey')
                    print htmlspecialchars ("$k => $p; ");
            }
        }
    }



    print '<!-- {{ отладочная информация --><hr>';
    print "<a onclick=\"$('.debug_info').toggle()\">Время основной сборки страницы: $runtime сек</a><br>";
    print '<div align="left" style="display:none" class="debug_info"><pre>';
    if(defined('CFG_TOGGLE_DEBUG')){
        ?>
    <script>
        $(function(){
            $('.debug_info').toggle();
        });
    </script>
    <?
    }
    $other = $runtime;
    if (isset($GLOBALS['trace']))
    {
        krsort($GLOBALS['trace']);
        foreach($GLOBALS['trace'] as $time=>$line)
        {
            print str_replace(array("\n", '\\'),array('<br>', ''),$line).'<br>';
            $other -= $time;
        }
    }
    $other = round($other, 5);
    print "прочее — $other сек.<br>";

    if (isset($GLOBALS['trace']))  $logs = General::GetArrayLogs($GLOBALS['trace']);
    $toecho='';
    //$toecho+="<br><br><br>--------------------------Проверка массива---------------------------------<br>";
    for ($i = 1; $i <= count($logs); $i++) {
        $toecho.="<br>Время - {$logs[$i]['time']} - ".$i.". - {$logs[$i]['method']}<br>";

        for ($j = 1; $j < count($logs[$i])-1; $j++) {
            $toecho.="  -->>   {$logs[$i][$j]['method']} - Время : {$logs[$i][$j]['time']} - Время(overhead) : {$logs[$i][$j]['overtime']}<br>";
        }

    }
    print $toecho;

    print "</pre>";
    print "<br><br>";

    $cachedebug="\r\n";
    $cachedebug.= "===================".date("H:i:s d.m.y")."====================";
    $cachedebug.="\r\n";
    if (isset($GLOBALS['DBcache_debug'])) {
        //выводим данные по кэшу в базе
        print "====================DBcache_debug===========================<br>";
        foreach($GLOBALS['DBcache_debug'] as $field){
              print round($field['time'], 4)."ms - Врямя - ".$field['name'].".  <br>";
              $cachedebug.= round($field['time'], 4)."ms - Врямя - ".$field['name'].".  \r\n";
        }
    }
    if (isset($GLOBALS['FILEcache_debug'])) {
        //выводим данные по кэшу в базе
        print "====================FILEcache_debug=========================<br>";
        foreach($GLOBALS['FILEcache_debug'] as $field){
              print round($field['time'], 4)."ms - Врямя - ".$field['name'].".  <br>";
              $cachedebug.= round($field['time'], 4)."ms - Врямя - ".$field['name'].".  \r\n";

        }

    }

    print "</div><!-- отладочная информация }} -->";
}
?>
<? if(@General::$siteConf['show_debug'] && !defined('NO_DEBUG_STRONG') && isset($_SESSION['sid']) && $_SESSION['sid'] && SCRIPT_NAME != 'send_debug_info'){ ?>
<?
    $C = new Cache_my($_SESSION['sid'], 'DebugInfo');
    $C->AddData(serialize($logs));
    ?>
<div id="top-service-block">
    <div class="userform">
        <div class="enter">
            <form action="index.php?p=send_debug_info" method="POST">
                <input type="submit" class="btn_office" value="<?=Lang::get('speed_test')?>" style="background-position: 0 -144px;width: 184px;">
            </form>
        </div>
        <div id="close-top-service-block" onclick="$('#top-service-block').hide();">
            x
        </div>
    </div>
</div>
<?
}
?>
