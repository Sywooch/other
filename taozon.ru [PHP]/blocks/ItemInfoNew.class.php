<?php

class ItemInfoNew extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'iteminfonew';
    protected $_template_path = '/main/';
    private $baseUrl;

    const DEFAULT_CONFIGURATION = 1;


    /**
     * @var UserData
     */
    protected $userData;

    public function __construct()
    {
        parent::__construct(true);

        $this->baseUrl = new UrlWrapper();
        $this->baseUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->userData = new UserData();
    }

    protected function setVars()
    {
        if(defined('CFG_LOAD_ITEM_VIA_AJAX') && CFG_LOAD_ITEM_VIA_AJAX && !@$_GET['getItemInfo']){
            $this->_template = 'iteminfonew_ajax';
            return ;
        }

        global $opentaoCMS;

        if($_POST){
            if(!Session::getUserData()){
                Users::Logout();
                header('Location: index.php?p=login');
                return;
            }
            $name = Session::getUserData('username');
            $review = $this->request->getValue('review');
            $data['text'] = $review['text'];
            $data['item_id'] = $review['item_id'];
            if ($this->cms->IsFeatureEnabled('ProductComments')) {
                $repo = new ItemInfoRepository($this->cms);
                $r = $repo->saveComment($review['text'], $review['item_cid'], $name, RequestWrapper::getValueSafe('id'));
                if ($r) {
                    Notifier::generalNotification('new_review', Lang::get('new_review'),$data, General::getConfigValue('site_admin_email'));
                }
            }
            $url = $_SERVER['REQUEST_URI'];
            if (RequestWrapper::getParamExists('reviewtab') === false) {
                $url .= '&reviewtab';
            }
            header('Location: ' . $url);
            die;
        }

        $id = RequestWrapper::getValueSafe('id');
        $quantity = isset($_POST['quantity'])?$_POST['quantity']:1;
        if (isset($_POST['add']))
        {
            // удалить файл кеша корзины и избранного
            $this->fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:'.Session::getUserOrGuestSession());

            Basket::addToBasket($this->otapilib, $id, $quantity);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }

        $vendorID = RequestWrapper::getValueSafe('vendorId');
        if (isset ($_GET['vendorId'])) {
            $cachID='vedors:'.$vendorID;
        } else {
            $cachID='items:'.$id;
        }

        if ($this->dbCache->CheckCacheEl($cachID)) {
            //Есть кэш и живой
            $blockList = 'DeliveryCosts,Promotions,RootPath';
            $db_caching = false;
        } else {
            //Нету и надо создать новый
            $blockList = 'DeliveryCosts,Promotions,Vendor,RootPath,MostPopularVendorItems16';
            $db_caching = true;

        }
        if (General::getConfigValue('not_use_vendor_cache')) {
            $db_caching = true;
        }
        //------------------------------------------------------------
        //------------------------------------------------------------
        $this->tpl->assign('show_review', RequestWrapper::getParamExists('reviewtab'));

        $this->otapilib->setErrorsAsExceptionsOn();
        try {
            $fulliteminfo = $this->otapilib->BatchGetItemFullInfo('', $id, $blockList);
        } catch (ServiceException $e) {
            $this->_template = 'iteminfoempty';
            if ($e->getErrorCode()=='NotFound') {
                $this->tpl->assign('ItemNotFound', true);
                return ;
            }
            $this->tpl->assign('ItemNotExists', true);
            throw $e;
        }
        $this->otapilib->setErrorsAsExceptionsOff();

        $iteminfo = $fulliteminfo['Item'];
        if ((General::getConfigValue('hide_item_for_restrictions')) &&
                ($iteminfo['IsSellAllowed'] === 'false') &&
                ($iteminfo['SellDisallowReason'] === 'IsFiltered')) {
            $this->onDenyItemShowRedirect($fulliteminfo);
        }

        $GLOBALS['pagetitle'] = $iteminfo['title'];

        //------------------Получаем Кэш или записываем его---------------------
        //---------------------------------------------------------------------
        if (! $db_caching) {
            //Получаем список фильтров из кэша
            //echo "Get From DB<br>";
            $VendorCache = unserialize($this->dbCache->GetCacheEl($cachID));
            $vendorInfo = $VendorCache['info'];
            $vendorItems = $VendorCache['items'];
        } else {

            //Создаем кэш
            //echo "Put To DB<br>";
            $VendorCache = array();
            $vendorInfo = $fulliteminfo['Vendor'];
            $vendorItems = array_filter(
                (array)$fulliteminfo['VendorItems']['data'],
                create_function('$a', 'return $a["id"] != "' . $iteminfo['id'] . '";')
            );
            $vendorItems = array_slice((array)$vendorItems, 0, 6);

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

            if (! General::getConfigValue('not_use_vendor_cache')) {
                $VendorCache['info'] = $vendorInfo;
                $VendorCache['items'] = $vendorItems;
                $this->dbCache->AddCacheEl($cachID,21600,serialize($VendorCache));
            }
        }
        
        $sid = Session::getUserOrGuestSession();
        $vendors = $this->otapilib->GetFavoriteVendors($sid);
        if (is_array($vendors['elements']) && count($vendors['elements']) > 0) {
            foreach ($vendors['elements'] as $vendor) {
                if ($vendor['itemid'] == $vendorInfo['id']) {
                    $vendorInfo['favoriteItemId'] = $vendor['id'];
                }
            }
        }

        $GLOBALS['itempath'] = array_reverse($fulliteminfo['RootPath']);
        $cid = '';
        if (is_array($GLOBALS['itempath'])) {
            $cid = end($GLOBALS['itempath']);
            $cid = $cid['Id'];
        } 
        
        $GLOBALS['taoBaoCategoryId'] = $iteminfo['categoryid'];
        if (count($iteminfo['pictures'])>4) $iteminfo['pictures'] = array_slice($iteminfo['pictures'], 0, 4);

        $userData = $this->userData->assignBatchGetUserData();

        $basket = $userData['Basket'];
        $note = $userData['Note'];

        $inNote = array();
        $inCart = array();
        if (isset($basket['Elements'])) {
            foreach($basket['Elements'] as $row){
                if ($row['ItemId'] == $iteminfo['id']) {
                    $mas = array();
                    $mas['configurationid'] = $row['ConfigurationId'];
                    $mas['id'] = $row['Id'];
                    $inCart[] = $mas;
                }
            }
        }
        if (isset($note['Elements'])) {
            foreach($note['Elements'] as $row)  {
                if ($row['ItemId'] == $iteminfo['id']) {
                    $mas = array();
                    $mas['configurationid'] = $row['ConfigurationId'];
                    $mas['id'] = $row['Id'];
                    $inNote[] = $mas;
                }
            }
        }
        $iteminfo = $this->checkHierarchicalConfigurators($iteminfo);
        $iteminfo = $this->removeDublicatesFromProperties($iteminfo);

        //------------------

        $this->isFromExtendedSearch();

        $this->tpl->assign('isWarehouseProduct', ProductsHelper::isWarehouseProduct($iteminfo));

        $this->tpl->assign('inCart', $inCart);
        $this->tpl->assign('inNote', $inNote);

        $this->tpl->assign('ItemNotExists', false);
        $this->tpl->assign('iteminfo', $iteminfo);
        $this->tpl->assign('cid', $cid);
        
        $this->tpl->assign('vendorInfo', $vendorInfo);
        $this->tpl->assign('vendorItems', $vendorItems);
        
        
    }

    public function checkHierarchicalConfigurators ($iteminfo) {
        if (! isset($iteminfo['HasHierarchicalConfigurators'])) {
            return $iteminfo;
        }
        if ($iteminfo['HasHierarchicalConfigurators'] == 'false') {
            return $iteminfo;
        }
        $existingConfigs = array();
        $newConfigs = array(
            "id"    =>  self::DEFAULT_CONFIGURATION,
            'name'  =>  Lang::get('configuration'),
            'values'=>  array()    
        );
        $i = 0;
        /* Перебор всех сущеcтвующих конфигураций товара */
        foreach ($iteminfo['item_with_config'] as $id => &$item) {
            $existingConfigs[$id] = $item['config'];
            $configValues = array();
            $newConfigs['values'][$i] = array(
                'id'    => $i+1,
                'name'  =>  array(),
                'alias'  =>  array(),
                'name_cny'  => array(),
                'imageurl'  => '',
                'miniimageurl'  => ''
            );

            foreach ($item['config'] as $configId => $configValue) {
                                    
                foreach ($iteminfo['configurations'][$configId]['values'] as $value) {
                    
                    if ($value['id'] == $configValue) {
                        $newConfigs['values'][$i]['name'][] =  $value['name'];
                        $newConfigs['values'][$i]['name_cny'][] =  $value['name_cny'];
                        
                        if (strlen(trim($value['alias']))) {
                            $newConfigs['values'][$i]['alias'][] =   $value['alias'];
                        } else {
                            $newConfigs['values'][$i]['alias'][] =   $value['name'];
                        }

                        if (strlen(trim($value['alias_cny']))) {
                            $newConfigs['values'][$i]['alias_cny'][] =   $value['alias_cny'];
                        } else {
                            $newConfigs['values'][$i]['alias_cny'][] =   $value['name'];
                        }

                        if (strlen($value['imageurl'])) {
                            $newConfigs['values'][$i]['imageurl'] =  $value['imageurl'];
                        }
                        if (strlen($value['miniimageurl'])) {
                            $newConfigs['values'][$i]['miniimageurl'] =  $value['miniimageurl'];
                        }
                    }
                }                  
            }
            $newConfigs['values'][$i]['alias'] = implode(', ', $newConfigs['values'][$i]['alias']);
            $newConfigs['values'][$i]['alias_cny'] = implode(', ', $newConfigs['values'][$i]['alias_cny']);

            $newConfigs['values'][$i]['name'] = implode(', ', $newConfigs['values'][$i]['name']);
            $newConfigs['values'][$i]['name_cny'] = implode(', ', $newConfigs['values'][$i]['name_cny']);

            $item['config'] = array ();
            $item['config'][self::DEFAULT_CONFIGURATION] = $i+1;
            $i++;
        }

        $iteminfo['configurations'] = array(self::DEFAULT_CONFIGURATION => $newConfigs);

        return $iteminfo;
    }
    
    
    public function removeDublicatesFromProperties ($iteminfo) {
        if ( (! isset($iteminfo['properties'])) || (! is_array($iteminfo['properties'])) ) {
            return $iteminfo;
        }
        $newProperties = array();
        foreach ($iteminfo['properties'] as $propertyArr) {
            foreach ($propertyArr as $property) { 
                if (($property['id'] != '21541') || (! General::getConfigValue('hide_item_property_price_range'))) { 
                    $newProperties[md5($property['name'])]['name'] = $property['name'];
                    if (empty($newProperties[md5($property['name'])]['value'])) {
                        $newProperties[md5($property['name'])]['value'] = $property['value'] . ';';
                    } else {
                        $newProperties[md5($property['name'])]['value'] .= $property['value'] . ';';                
                    }
                }
            }
        }
        foreach ($newProperties as &$property) {
            $parts = explode(";", $property['value']);
            $parts = array_unique($parts);
            $property['value'] = implode("; ", $parts);
        }
        $iteminfo['propertiesEdited'] = $newProperties;
        return $iteminfo;
    }
    

    private function onDenyItemShowRedirect($fulliteminfo)
    {
        $urlRedirect = '';
        $iteminfo = $fulliteminfo['Item'];

        if (!empty($iteminfo['CategoryId'])) {
            $urlRedirect = General::generateUrl('category', array(
                'Id' => $iteminfo['CategoryId'],
                'Name' => $fulliteminfo['RootPath'][0]['Name']
            ));
        } elseif (!empty($iteminfo['VendorId'])) {
            $urlRedirect = General::generateUrl('vendor', $iteminfo['VendorId']);
        } else {
            $this->baseUrl->Set("http://$_SERVER[HTTP_HOST]");
            $urlRedirect = $this->baseUrl->Get();
        }
        $this->request->LocationRedirect($urlRedirect);
    }

    /**
     * @param RequestWrapper $request
     */
    public function GetTotalPriceAction($request){
        $price = $this->otapilib->GetItemTotalCost($request->getValue('count'),
            $request->getValue('id'),
            $request->getValue('promoid', 0),
            $request->getValue('confid', 0));

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
    }

    private function isFromExtendedSearch(){
        $url = new UrlWrapper();
        $url->Set($this->request->env('HTTP_REFERER', ''));
        $this->tpl->assign('isFromExtendedSearch', $url->GetKey('SearchMethod') == 'Extended' && $url->GetKey('Provider') == 'Taobao');
    }

}
