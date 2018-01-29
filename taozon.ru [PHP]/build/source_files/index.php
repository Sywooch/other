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

session_cache_expire(60*24);

if(!defined('CFG_CACHED')){
    define('CFG_CACHED', false);
}

//подключаем базу данных
global $opentaoCMS;
$opentaoCMS = new SafedCMS();

if(file_exists(dirname(__FILE__).'/custom/custom.php')){
    require dirname(__FILE__).'/custom/custom.php';
}

if(@General::$siteConf['site_temporary_unavailable'] && SCRIPT_NAME!='robo_request' && SCRIPT_NAME!='onpay_request'){
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
            $_SESSION['currency'] = $_GET['c'];
            $_SESSION['ManualVAL'] = "1";
            if(@$_SERVER['HTTP_REFERER'])
                header('Location: '.@$_SERVER['HTTP_REFERER']);
            die();
            break;
        case 'getpromotions':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');

            $itemid = $_GET['itemid'];

            $promo = $otapilib->GetItemPromotionsWithAttempts($itemid, 10);
            if ($promo === false){
                $promo = $otapilib->error_code;
                print json_encode($promo);
            }
            else{
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
            die();
            break;
        case 'webcron':
            $cron = new WebCron();
            $cron->Process();
            die;
            break;
        case 'get_delivery':
            global $otapilib;
            $models = $otapilib->GetDeliveryModesWithPrice($_GET['code'], $_GET['weight']);
            foreach($models as &$m){
                foreach($m['FullPrice']['ConvertedPriceList']['DisplayedMoneys'] as $i=>$d){
                    $price = $d;
                    $price->price = (float)$d;
                    $m['FullPrice']['ConvertedPriceList']['DisplayedMoneys'][$i] = $price;
                }
            }
            print json_encode(array('success' => (bool)$models, 'data' => $models));
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
            if(@$_GET['mode'] == 'new'){
                $HSTemplate->assignGlobal('support_title', Lang::get('new_message'));
            }
            elseif(@$_GET['mode'] == 'view' || !@$_GET['mode']){
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
            if (isset($_GET['print'])&&$_GET['print']=='Y')
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
            $id = $_GET['id'];
            $sid = @$_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
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
            $itemid = $_GET['itemid'];
            $orderid = $_GET['orderid'];
            $sid = @$_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $res = $otapilib->CancelLineSalesOrder($sid, $orderid, $itemid);
            if($res){
                echo 'Ok';
            } else {
                echo 'Error';
            }
            die();
            break;

        case 'confirmnewpriceorderitem':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $itemid = $_GET['itemid'];
            $orderid = $_GET['orderid'];
            $sid = @$_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $res = $otapilib->ConfirmPriceLineSalesOrder($sid, $orderid, $itemid);
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
            $sid = @$_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $res = PrivateOffice::createTicket($otapilib, $_POST);
            if($res){
                if(isset($_GET['gettickets'])){
                    define('CFG_PAGE_TEMPLATE', 'ticketlist');
                    $ticketlist = $otapilib->GetTicketInfoList($sid, 'Out');
                    $HSTemplate->assignGlobal('ticketlist', $ticketlist);
                } else echo 'Ok';
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
            if ((isset($_GET['root']) && substr($_GET['cid'],0,3) == 'CID') || isset($_GET['virt']))
            {
                // Показ подкатегорий без товаров, в рутовых категориях с ручным переводом нет товаров
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'SubCategoryNew');
                define('CFG_PAGE_TEMPLATE', 'subcategorynew');
            } else {
                // Показ подкатегорий c товарами и фильтром
                $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ItemListNew');
                define('CFG_PAGE_TEMPLATE', 'subcategory2new');
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
            $itemId = $_GET['itemid'];
            $itemdescription = $otapilib->GetItemOriginalDescription($itemId);
            $HSTemplate->assignGlobal('itemdescription', $itemdescription);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'itemdescriptiontranslated':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemdescription');
            $itemId = $_GET['itemid'];
            $itemdescription = $otapilib->GetItemDescription($itemId);
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
            $id = $_GET['id'];
            $quantity = $_GET['num'];
            SupportListNew::editItemQuantity($otapilib, $id, $quantity);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editnoteitemcomment':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = $_GET['id'];
            $comment = $_GET['comment'];
            SupportListNew::editItemComment($otapilib, $id, $comment);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editbasketitemcomment':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = $_GET['id'];
            $comment = $_GET['comment'];
            BasketNew::editItemComment($otapilib, $id, $comment);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'editbasketitemquantity':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = $_GET['id'];
            $quantity = $_GET['num'];
            BasketNew::editItemQuantity($otapilib, $id, $quantity);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'getprice':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');

            $itemid = $_POST['id'];
            $promoid = $_POST['promoid'];
            $confid = $_POST['confid'];
            $quantity = $_POST['count'];

            $price = $otapilib->GetItemTotalCost($quantity, $itemid, $promoid, $confid);

            $c = $price['ConvertedPriceList']['DisplayedMoneys'];

            $returnArr = array('prices'=>array(), 'dels'=>array());
            if(@is_array(@$price['ConvertedPriceList']['DisplayedMoneys'])){
                foreach($price['ConvertedPriceList']['DisplayedMoneys'] as $p){
                    $returnArr['prices'][(string)$p['Sign']] = floatval((string)$p[0]);
                }
            }

            $newReturnArr = Plugins::invokeEvent('onGetItemPrice', array('pricesArr' => $returnArr['prices']));
            if(is_array($newReturnArr)){
                $returnArr['prices'] = $newReturnArr;
            }

            if(@(string)$price['IsDeliverable'] != 'false'){
                $pr = $price['DeliveryPrice'];
                if(@$pr['ConvertedPriceList']['DisplayedMoneys'])
                    foreach($pr['ConvertedPriceList']['DisplayedMoneys'] as $p){
                        $returnArr['dels'][(string)$p['Sign']] = floatval((string)$p[0]);

                        if(defined('CFG_NO_DELIVERY_IN_PRICE') && CFG_NO_DELIVERY_IN_PRICE){
                            $returnArr['prices'][(string)$p['Sign']] =
                                $returnArr['prices'][(string)$p['Sign']]
                                    - $returnArr['dels'][(string)$p['Sign']];
                        }
                    }
            }

            print json_encode($returnArr);
            die();
            break;
		
		case 'get_item_config':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', '');
            $id = $_GET['itemid'];            
			$fulliteminfo = $otapilib->BatchGetItemFullInfo('', $id, 'DeliveryCosts,Promotions');			
            print json_encode($fulliteminfo);
            die();
            break;
		
		
        case 'itemtitle':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemtitle');
            $itemId = $_GET['itemid'];
            if(!(int)$itemId) die();
            $itemInfo = $otapilib->GetItemInfo($itemId);
            $HSTemplate->assignGlobal('itemtitle', $itemInfo['title']);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'itemtraderateinfo':
            $CFG_CREATE_BLOCKS = array ();
            define('CFG_PAGE_TEMPLATE', 'itemtraderateinfo');
            $itemId = $_GET['itemid'];
            $itemdescription = $otapilib->GetTradeRateInfoListFrame($itemId);

            $HSTemplate->assignGlobal('itemdescription', $itemdescription);
            @define('NO_DEBUG_STRONG', true);
            break;

        case 'vendor':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'VendorNew');
            define('CFG_PAGE_TEMPLATE', 'vendorinfonew');
            $vendorId = $_GET['id'];
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
            $res = SupportListNew::AddItemToNote($otapilib, $_GET['id'], 1);

            if($res){
                if(isset($_SESSION[CFG_SITE_NAME.'loginUserData']))
                    $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
                elseif(isset($_COOKIE['NoteSid']) )
                    $sid = $_COOKIE['NoteSid'];
                else
                    $sid = session_id();
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
            SupportListNew::moveToBasket($_GET['id']);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();
            break;

        case 'supportlistremove':
            $CFG_CREATE_BLOCKS = array ();

            if(isset($_SESSION[CFG_SITE_NAME.'loginUserData']))
                $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            elseif(isset($_COOKIE['NoteSid']) )
                $sid = $_COOKIE['NoteSid'];
            else
                $sid = session_id();
				
			// удалить файл кеша корзины и избранного
			Cache_my::DelCacheBatchGetUserData($sid);
			
            $res = $otapilib->RemoveItemFromNote($sid, $_GET['id']);

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
            if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            else $sid = session_id();
			// удалить файл кеша корзины и избранного
			Cache_my::DelCacheBatchGetUserData($sid);
            $isdeleted = $otapilib->RemoveItemFromBasket($sid, $_GET['addedToCartId']);
            if($isdeleted)
            {
                $items = $otapilib->GetBasket($sid);
                echo json_encode(array('Success'=>'Ok', 'Count' => count($items), 'itemId' => ''));
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
            $id = $_GET['id'];
            $weight = str_replace(',', '.', $_GET['w']);
            @define('NO_DEBUG_STRONG', true);
            BasketNew::editItemWeight($otapilib, $id, $weight);
            break;

        case 'getbasketcount':
            if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            else $sid = session_id();
            $basket = $otapilib->GetBasket($sid);
            print $basket !== false ? count($basket) : 1;
            die();
            break;

        case 'itemcomments':
            $CFG_CREATE_BLOCKS = array();
            define('CFG_PAGE_TEMPLATE', 'itemcomments');
            $itemId = $_GET['itemid'];
            $itemCID = $_GET['itemcid'];
            $itemUrl = $_GET['itemurl'];
            $HSTemplate->assignGlobal('itemid', $itemId);
            $HSTemplate->assignGlobal('itemcid', $itemCID);
            $HSTemplate->assignGlobal('itemurl', $itemUrl);

            $reviews = $opentaoCMS->callCMSMethod('getItemComments', array('itemid' => $_GET['itemid']));
            $HSTemplate->assignGlobal('reviews', $reviews);

            @define('NO_DEBUG_STRONG', true);
            break;

        case 'digest':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Digest');
            define('CFG_PAGE_TEMPLATE', 'digestnew');
            break;
        case 'post':
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'Post');
            define('CFG_PAGE_TEMPLATE', 'postnew');
            break;
        //Облегчаем шапку
        case 'menushortajax':
            $GLOBALS['menu_ajax'] = $_GET['menu_ajax'];
            $M = new MenuShortNew();
            echo $M->Generate();
            die();
            break;
        case 'search_ajax':
            $GLOBALS['searchcats_ajax'] = $_GET['searchcats_ajax'];
            $M = new SearchCategories();
            echo $M->Generate();
            die();
            break;
        case 'users_ajax':
            $GLOBALS['userdata_ajax'] = $_GET['userdata_ajax'];
            $M = new HeaderNew();
            echo $M->Generate();
            die();
            break;

        default:
            $page = $opentaoCMS->GetPageByAlias(SCRIPT_NAME);
            if(!$page){
                header('HTTP/1.0 404 Not Found');
                print 'Not found';
                die();
            }

            General::$isContent = true;
            $CFG_CREATE_BLOCKS = array ('CrumbsNew', 'HeaderNew', 'FooterNew', 'ContentData');
            define('CFG_PAGE_TEMPLATE', 'cms');
            break;
    }
}

//Обработка проверки на рассыоку ====================
if(CMS::IsFeatureEnabled('Newsletter')) {
    //Решил здесь не исползовать класс CMS чтобы не кофликтовать с OpenTAo CMS
    $res_letter = mysql_query('SELECT * FROM `site_config` WHERE `key`="send_time"');
    if ($res_letter && mysql_num_rows ($res_letter )>0) {
        $row_letter = mysql_fetch_array($res_letter);
        $old_t=$row_letter['value'];
        $cur_t=time();
        if ((($cur_t-$old_t)/60)>10) {
            //echo "Пора<br>";
            require_once('send_newsletters.php');
        } else {
            //echo "Не пора<br>";
        }
        //$new_t=(($cur_t-$old_t)/60);
        //echo "прошло ".$new_t." минут";

    }
    elseif($res_letter && mysql_num_rows ($res_letter )==0){
        require_once('send_newsletters.php');
    }

}

//===================================================
global $HSTemplate;
$HSTemplate->assignGlobal('script_name', SCRIPT_NAME);

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
                catch(Exception $e){
                    show_error($e->getMessage());
                }
                $this->tpl->assign($class, $data);
            }
        }
    }

    public function Show()
    {
        print parent::Generate();
    }
}


// Отображаем страницу
$show = new ShowPage();
$show->Show();

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

function send_contact_email($name, $message, $itemid = null, $itemurl = null)
{
    $title = 'Отзыв с сайта ' . CFG_SITE_NAME;
    $to = @General::$siteConf['site_admin_email'];
    $from = $name . '<' . @General::$siteConf['site_email'] . '>';

    if (!empty($itemid)) {
        $message = 'Отзыв о товаре: ' . $itemurl . '.' . PHP_EOL . $message;
    }

    mail_utf8($to, $title, $message, 'From:' . $from);
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
    print '
    <script>
    function get_error_message(){
       return "'.substr(htmlspecialchars(mysql_real_escape_string($GLOBALS['error_text_hidden'])),0,500).'";
    }

    function get_error_code(){
        return "'.$GLOBALS['error_code'].'";
    }

    function get_otapi_url(){
       return "'.rtrim(CFG_SERVICE_URL,'/').'?op='.$GLOBALS['error_method'].'";
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
<link rel="stylesheet" href="admin/css/jquery.treeview.css" />
<script src="admin/js/jquery.cookie.js" type="text/javascript"></script>
<script src="admin/js/jquery.treeview.js" type="text/javascript"></script>
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
            print '    '.str_replace(array("\n", '\\'),array('<br>', ''),$line).'<br>';
            $other -= $time;
        }
    }
    $other = round($other, 5);
    print "    прочее — $other сек.<br>";

    if (isset($GLOBALS['trace']))  $logs = General::GetArreyLogs($GLOBALS['trace']);
    $toecho='';
    //$toecho+="<br><br><br>--------------------------Проверка массива---------------------------------<br>";
    for ($i = 1; $i <= count($logs); $i++) {
        $toecho.="<br>".$i.". - {$logs[$i]['method']} - Время - {$logs[$i]['time']}<br>";

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
	//Если лимит превышен то сохраняем
	if ($runtime>10) {
		$fp = fopen('CacheDebug.txt', 'a+');		
		$test = fwrite($fp, $cachedebug); // Запись в файл		
		fclose($fp);
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
