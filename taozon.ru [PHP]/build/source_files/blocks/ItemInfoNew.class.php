<?php

class ItemInfoNew extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'iteminfonew';
    protected $_template_path = '/main/';

    public function __construct()
    {
		
        parent::__construct(true);
    }

    protected function setVars()
    {
		
        if(defined('CFG_LOAD_ITEM_VIA_AJAX') && CFG_LOAD_ITEM_VIA_AJAX && !@$_GET['getItemInfo']){
            $this->_template = 'iteminfonew_ajax';
            return ;
        }

        global $otapilib;
        global $opentaoCMS;
		
		if($_POST){
			$name = @$_SESSION[CFG_SITE_NAME.'loginUserData']['username'];
            $opentaoCMS->callCMSMethod('saveComment', array('data'=>$_POST, 'name' => $name, 'id'=>RequestWrapper::getValueSafe('id')));
            send_contact_email($name, $_POST['review']['text'], RequestWrapper::getValueSafe('id'), $_SERVER['REQUEST_URI']);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }

        $id = RequestWrapper::getValueSafe('id');
        $quantity = isset($_POST['quantity'])?$_POST['quantity']:1;
        if (isset($_POST['add']))
        {
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData(Session::getUserOrGuestSession());

            Basket::addToBasket($otapilib, $id, $quantity);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        //------------------------Кэширование здесь ------------------------------------
		//------------------------------------------------------------
		//------------------------------------------------------------
		$DBCacheVendor = new DBCache();
		
		$vendorID = RequestWrapper::getValueSafe('vendorId');
		if (isset ($_GET['vendorId'])) {
			$cachID='vedors:'.$vendorID;			
		} else {	
			$cachID='items:'.$id;				
		}
		
		if ($DBCacheVendor->CheckCacheEl($cachID)) {
			//Есть кэш и живой
			$blockList = 'DeliveryCosts,Promotions,RootPath';
			$db_caching = false;			
		} else {
			//Нету и надо создать новый
			$blockList = 'DeliveryCosts,Promotions,Vendor,RootPath,MostPopularVendorItems16';
			$db_caching = true;
					
		}
		//------------------------------------------------------------
		//------------------------------------------------------------
		
        $fulliteminfo = $otapilib->BatchGetItemFullInfo('', $id, $blockList);
        
        if ($fulliteminfo === false){
            $this->_template = 'iteminfoempty';
            $this->tpl->assign('ItemNotExists', true);
            return ;
        }
        
        
        $iteminfo = $fulliteminfo['Item'];
        $GLOBALS['pagetitle'] = $iteminfo['title'];
        
		//------------------Получаем Кэш или записываем его---------------------
		//---------------------------------------------------------------------			
		if (!$db_caching) {
			//Получаем список фильтров из кэша			
			//echo "Get From DB<br>";	
			$VendorCache = unserialize($DBCacheVendor->GetCacheEl($cachID));										
			$vendorInfo = $VendorCache['info'];
			$vendorItems = $VendorCache['items'];					
		} else {
			//Создаем кэш	
			//echo "Put To DB<br>";
			$VendorCache = array();		
			$vendorInfo = $fulliteminfo['Vendor'];        
        	$vendorItems = array_slice($fulliteminfo['VendorItems']['data'], 0, 6);
			
			//Переделываем массив чтоб был доступен дя сериализации								
			$vendorInfo['Sex'] = (string)$vendorInfo['Sex'];
			$vendorInfo['sex'] = @$vendorInfo['Sex'];	
					
			$vendorInfo['Credit']['Level'] = (string)$vendorInfo['Credit']['Level'];
			$vendorInfo['Credit']['level'] = @$vendorInfo['Credit']['Level'];		
			
			$vendorInfo['Credit']['Score'] = (string)$vendorInfo['Credit']['Score'];
			$vendorInfo['Credit']['score'] = @$vendorInfo['Credit']['Score'];
			
			$vendorInfo['Credit']['TotalFeedbacks'] = (string)$vendorInfo['Credit']['TotalFeedbacks'];
			$vendorInfo['Credit']['totalfeedbacks'] = @$vendorInfo['Credit']['TotalFeedbacks'];			
			
			$vendorInfo['Credit']['PositiveFeedbacks'] = (string)$vendorInfo['Credit']['PositiveFeedbacks'];
			$vendorInfo['Credit']['positivefeedbacks'] = @$vendorInfo['Credit']['PositiveFeedbacks'];
			$vendorInfo['credit'] = @$vendorInfo['Credit'];
						
			foreach($vendorInfo['Features'] as $value2){				
				$data0['Features'][] = (string)$value2;
			}
			$vendorInfo['Features'] =  @$data0['Features'];
			$vendorInfo['features'] = @$vendorInfo['Features'];		
			//=====================================================
			
										
			$VendorCache['info'] = $vendorInfo;
			$VendorCache['items'] = $vendorItems;	
			$DBCacheVendor->AddCacheEl($cachID,21600,serialize($VendorCache));			
					
		}		
		//------------------------------------------------------------
		//------------------------------------------------------------
		
        
		
		
		$GLOBALS['itempath'] = array_reverse($fulliteminfo['RootPath']);
        $GLOBALS['taoBaoCategoryId'] = $iteminfo['categoryid'];
        if (count($iteminfo['pictures'])>4) $iteminfo['pictures'] = array_slice($iteminfo['pictures'], 0, 4);
		//------------
		
		if(@$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'])
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else{
            $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'Auth';
            $cookieName = str_replace('.','_',$cookieName);
            $sid = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : session_id();
        }
        $otapilib->CacheSetTrue($sid);
		$fullHeader = $otapilib->BatchGetUserData($sid,'Basket,Note,UserStatus,BasketSummary,NoteSummary');
		       
       
       $inNote = array();
       $inCart = array();
	   ///configurationid
	   
       foreach($fullHeader['Basket']['Elements'] as $row){
            if ($row['ItemId'] == $iteminfo['id']) {
				$mas['configurationid'] = $row['configurationid'];
				$mas['id'] = $row['id'];                 
				$inCart[] = $mas;
            }
        }
        foreach($fullHeader['Note']['Elements'] as $row)  {
            if ($row['ItemId'] == $iteminfo['id']) {
				$mas['configurationid'] = $row['configurationid'];
				$mas['id'] = $row['id'];
                $inNote[] = $mas;
            }
        }    
               
        //------------------		
		
        $this->tpl->assign('inCart', $inCart);
        $this->tpl->assign('inNote', $inNote);
        
        $this->tpl->assign('ItemNotExists', false);
        $this->tpl->assign('iteminfo', $iteminfo);
        
        $this->tpl->assign('vendorInfo', $vendorInfo);
        $this->tpl->assign('vendorItems', $vendorItems);
    }    
    
}

?>