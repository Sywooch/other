<?php

OTBase::import('system.uploader.php.UploadHandler');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');
OTBase::import('system.lib.DBCache');
OTBase::import('system.lib.startup_scripts.MainPage');


class Sets extends GeneralUtil
{
    protected $_template = 'brands';
    protected $_template_path = 'sets/';

    protected $setsProvider;
    protected $cacher;

    public function __construct()
    {
        parent::__construct();
        $this->setsProvider = new SetsProvider($this->cms, $this->getOtapilib());
        $this->cacher = new FileAndMysqlMemoryCache($this->cms);
    }

    public function defaultAction($request)
    {
        try {
            $language = $this->getActiveLang();
            $brandsList = $this->setsProvider->GetBrandRatingList('Best', 100, 0, $language);
            $brands = array();
            foreach ($brandsList as $i => $brand) {
                $brands[$brand['id']] = $brand;
            }

            $allBrands = $this->setsProvider->GetBrandInfoList();

            $this->tpl->assign('brands', $brands);
            $this->tpl->assign('allBrands', $allBrands);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $this->getActiveLang());
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        print $this->fetchTemplate();
    }

    // save order of items by ids and types
    private function saveOrder($ids, $contentType, $type = 'Best', $cid = 0)
    {
        $sid = Session::get('sid');
        $result = $this->setsProvider->RemoveAllElementsRatingList($sid, $type, $contentType, $cid);
        if ($result) {
            $result = $this->setsProvider->AddElementsSetToRatingList($sid, $type, $contentType, $cid, $ids);
        }
    }

    public function saveItemsOrderAction($request) 
    {
        try {
            $contentType = $request->getValue('contentType', 'Item');
            $type = $request->getValue('type', 'Best');
            $ids = $request->getValue('ids');
            $cid = $request->getValue('cid', 0);
            $this->saveOrder($ids, $contentType, $type, $cid);
            
            $this->clearCache($contentType, $type, $cid);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function sellersAction($request)
    {
        $this->_template = 'sellers';

        try {
            $language = $this->getActiveLang(); 
            $sellers = $this->setsProvider->GetVendorRatingList('Best', 200, 0, $language);
            foreach ($sellers as $i => &$seller) {
                $seller['DisplayData'] = $this->setsProvider->getSetSellerInfo($seller['id'], $language);
            }
            $this->tpl->assign('sellers', $sellers);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $language);
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $sid = Session::get('sid');
        print $this->fetchTemplate();
    }

    public function recommendedAction($request)
    {
        $this->_template = 'recommended';

        try {
            $items = $this->setsProvider->GetItemRatingList('Best', 200, 0, $this->getActiveLang());            
            $this->tpl->assign('items', $items);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $this->getActiveLang());
        }
        catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $sid = Session::get('sid');
        print $this->fetchTemplate();
    }
    
    public function getItemInfoAction($request)
    {
        $data = array();
        try {
            $id = $request->getValue('id'); 
            
            $itemInfo = $this->setsProvider->GetItemFullInfo($id, $request->getValue('language'));
            $data['title'] = $itemInfo['Title'];
        
            $itemDescription = $this->setsProvider->GetItemDescription($id, $request->getValue('language'));
            $data['description'] = (string)$itemDescription;
                
            $data['result'] = 'ok';    
        }
        catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse($data);     
    }

    public function popularAction($request)
    {
        $this->_template = 'popular';

        try {
            $items = $this->setsProvider->GetItemRatingList('Popular', 200, 0, $this->getActiveLang());                        
            $this->tpl->assign('items', $items);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $this->getActiveLang());
            
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $sid = Session::get('sid');
        print $this->fetchTemplate();
    }

    public function lastAction($request)
    {
        $this->_template = 'last-viewed';

        try {
            $items = $this->setsProvider->GetItemRatingList('Last', 200, 0, $this->getActiveLang());
            $this->tpl->assign('items', $items);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $this->getActiveLang());
        }
        catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $sid = Session::get('sid');
        print $this->fetchTemplate();
    }

    public function addSetsBrandAction($request) 
    {
        $brands = array();
        try {
            $ids = array();
            $sid = Session::get('sid');
            $urlId = $request->getValue('urlId');
            $language = $this->getActiveLang();
            
            $ids = $this->parseItemListOrUrl($urlId, 'brand');
            
            $resultIds = array();
            foreach ($ids as $i => $id) {
                $result = $this->setsProvider->AddElementsSetToRatingList($sid, 'Best', 'Brand', 0, $id);
                if ($result) {
                    $resultIds[$id] = true;
                }
            }
            $brandsList = $this->setsProvider->GetBrandRatingList('Best', 100, 0, $language);
            foreach ($brandsList as $i => $brand) {
                if (array_key_exists($brand['id'], $resultIds)) {
                    $brands[] = $brand;
                }
            }
            
            $this->clearCache('Brand');
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok', 'brands' => $brands));
    }

    private function getVendorId($VendorData)
    {
        if (strpos(trim($VendorData), 'http://') === 0) {
            $urlComponents = parse_url(trim($VendorData));
            parse_str($urlComponents['query'], $queryArray);
            $data = isset($queryArray['id']) ? $queryArray['id'] : false;

        } else {
            $data = $VendorData;
        }
        return $data;
    }


    public function addSetsSellerAction($request)
    {
        $sellers = array();
        try {
            $sid = Session::get('sid');
            $language = $request->getValue('language');            
            $sellerId = $request->getValue('sellerId');
            $displayName = $request->getValue('displayName');            
            $validator = new Validator(array(
                'sellerId' => trim($sellerId),
            ));

            $validator->addRule(new NotEmptyString(), 'sellerId', LangAdmin::get('Vendor_Id_cannot_be_empty'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            $vendorId = $this->getVendorId($sellerId);
            $vendorExists = $this->setsProvider->GetVendorInfo($vendorId);

            if ($vendorExists === false ) {
                throw new ServiceException(__METHOD__, '', LangAdmin::get('Vendor_not_found'), 1);
            }

            $addResult = $this->setsProvider->AddElementsSetToRatingList($sid, 'Best', 'Vendor', 0, $vendorId);
            if ($addResult === false) {
                throw new ServiceException(__METHOD__, '', LangAdmin::get('Internal_error'), 1);
            }

            $imageUrl = '';
            $uploadResult = json_decode($this->uploadImage('seller_image'));
            if (isset($uploadResult->seller_image[0]->url)) {
                $imageUrl = $uploadResult->seller_image[0]->url;
            }

            $this->setsProvider->saveSetSellerInfo($vendorId, $displayName, $imageUrl, $language);

            $sellersList = $this->setsProvider->GetVendorRatingList('Best', 200, 0, $language);
            foreach ($sellersList as $i => &$seller) {
                if ($seller['id'] == $vendorId) {
                    if ($imageUrl) {
                        $seller['pictureurl'] = $imageUrl;
                        $seller['PictureUrl'] = $imageUrl;
                        $seller['displayName'] = $displayName ? $displayName : $seller['name'];
                    }
                    $sellers[] = $seller;
                }
            }
            
            $this->clearCache('Vendor');
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getErrorMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok', 'sellers' => $sellers));
    }

    public function updateSetsSellerAction($request) 
    {
        try {
            $language = $request->getValue('language');
            $sid = Session::get('sid');
            $sellerId = $request->getValue('sellerId');
            $displayName = $request->getValue('displayName');
            $existingImage = $request->getValue('existingImage');

            $validator = new Validator(array(
                'sellerId' => trim($sellerId),
            ));

            $validator->addRule(new NotEmptyString(), 'sellerId', LangAdmin::get('Vendor_Id_cannot_be_empty'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            $vendor = $this->setsProvider->GetVendorInfo($sellerId);

            if ($vendor === false ) {
                throw new ServiceException(__METHOD__, '', LangAdmin::get('Vendor_not_found'), 1);
            }

            $newImage = '';
            $uploadResult = json_decode($this->uploadImage('newImage'));
            if (isset($uploadResult->newImage[0]->url)) {
                $newImage = $uploadResult->newImage[0]->url;
            }

            $info = $this->setsProvider->getSetSellerInfo($sellerId, $language);
            if ($info) {
                $this->setsProvider->updateSetSellerInfo($sellerId, $displayName, $newImage ? $newImage : $existingImage, $language);
            } else {
                $this->setsProvider->saveSetSellerInfo($sellerId, $displayName, $newImage ? $newImage : $existingImage, $language);
            }

            if ($newImage || $existingImage) {
                $vendor['PictureUrl'] = $newImage ? $newImage : $existingImage;
                $vendor['pictureurl'] = $newImage ? $newImage : $existingImage;
            }
            $vendor['displayName'] = $displayName ? $displayName : $vendor['name'];

            $this->clearCache('Vendor');
            
            $this->sendAjaxResponse(array(
                'result' => 'ok', 'seller' => $vendor
            ));
        } catch (Exception $e) {
            $this->errorHandler->registerError($e->getMessage());
        }
        header('Location: index.php?cmd=sets&do=sellers');
    }


    private function uploadImage($param_name)
    {
        ob_start();
        new UploadHandler(array(
            'param_name' => $param_name,
            'image_versions' => array(
                'thumbnail_100_100' => array(
                    'max_width' => 100,
                    'max_height' => 100,
                    'jpeg_quality' => 90
                ),
                'thumbnail_160_160' => array(
                    'max_width' => 160,
                    'max_height' => 160,
                    'jpeg_quality' => 90
                ),
                'thumbnail_310_310' => array(
                    'max_width' => 310,
                    'max_height' => 310,
                    'jpeg_quality' => 90
                ),
            ),
        ), true, null, '/uploaded/sets/');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    private function uploadData()
    {
        ob_start();
        new UploadHandler(array(
            'param_name' => 'itemsFile',
            'accept_file_types' => '/\.(txt)$/i'
        ), true, null, '/uploaded/sets/');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    // parse item url or list like: id;id;id
    private function parseItemListOrUrl($urlId, $itemName) 
    {
        $ids = array();
        if (preg_match( '/(http)/i', $urlId )) {
            $url = parse_url($urlId);
            $params = array();
            parse_str($url['query'], $params);
            if (isset($params['id'])) {
                $ids[] = trim($params['id'], '_');
            } elseif (isset($params[$itemName])) {
                $ids[] = $params[$itemName];
            }
        }
        else {
            $ids = explode(';', $urlId);
        }
        return $ids;
    }

    // add item by id and type
    private function addSetsItem($ids, $contentType, $cid = 0 )
    {
        $sid = Session::get('sid');
        $result = array();
        if ( !is_array($ids)) {
            $ids = array($ids);
        }
        foreach ($ids as $i => $id) {
            $res = $this->setsProvider->AddElementsSetToRatingList($sid, 'Best', $contentType, $cid, $id);
            if ($res) {
                $result[$id] = true;
            }
        }

        return $result;
    }

    // add sets item by id and type
    public function addSetsItemAction($request)
    {
        $items = array();
        try {
            $sid = Session::get('sid');
            $urlId = $request->getValue('urlId');
            $type = ucfirst(strtolower($request->getValue('type', 'best')));
            $contentType = strtolower($request->getValue('contentType', 'Item'));
            $ContentType = ucfirst($contentType);
            $ids = $this->parseItemListOrUrl($urlId, strtolower($contentType));
            $cid = $request->getValue('cid', 0);

            $resultIds = $this->addSetsItem($ids, $ContentType, $cid);

            $method = "Get{$ContentType}RatingList";
            $itemsList = $this->setsProvider->$method($type, 2000, $cid, $this->getActiveLang());

            foreach ($itemsList as $i => $item) {
                if (array_key_exists($item['id'], $resultIds)) {
                    $items[] = $item;
                }
            }
            
            $this->clearCache($contentType, $type);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok', 'items' => $items));
    }

    public function addSetsItemsFileAction($request)
    {
        $items = array();
        try {
            $cid = $request->getValue('cid', 0);
            $uploadResult = json_decode($this->uploadData());
            if (isset($uploadResult->itemsFile[0]->url)) {
                $itemsFile = $uploadResult->itemsFile[0]->url;
                $content = file_get_contents($itemsFile);
                $addedItems = array();
                if ($uploadResult->itemsFile[0]->type == 'text/plain' ) {
                    $rows = explode("\n", $content);
    
                    foreach ($rows as $key => $item) {
                        // parse item url
                        $ids = $this->parseItemListOrUrl($item, 'item');
                        // add item to radting
                        $result = $this->addSetsItem($ids, 'Item', $cid);
                        // add result
                        foreach ($result as $aid => $b) {
                            $addedItems[$aid] = true;
                        }
                    }
                    
                    $method = "GetItemRatingList";
                    $itemsList = $this->setsProvider->$method('Best', 2000, 0, $this->getActiveLang());                
                    
                    foreach ($itemsList as $i => $item) {
                        if (array_key_exists($item['id'], $addedItems)) {
                            $items[] = $item;
                        }
                    }
                }
                
                $this->clearCache('Item', 'Best');
            } else {
                $this->respondAjaxError(LangAdmin::get('Select_text_file_with_product_links'));
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok', 'items' => $items /*, 'addedItems' => $addedItems, 'itemsList' => $itemsList*/ ));
    }

    // delete item by type and id
    public function deleteItemAction($request)
    {
        try {
            $sid = Session::get('sid');            
            $itemList = $request->getValue('id');
            $type = ucfirst(strtolower($request->getValue('type', 'Best')));
            $cid = $request->getValue('cid', 0);
            $contentType = strtolower($request->getValue('contentType', 'Item'));
            $ContentType = ucfirst($contentType);

            $result = $this->setsProvider->RemoveElementsSetRatingList($sid, $type, $ContentType, $cid, $itemList);
            
            $this->clearCache($contentType, $type);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function updateSetsItemAction($request)
    {
        try {
            $sid = Session::get('sid');
            $id = $request->getValue('itemId');
            $title = $request->getValue('displayName');
            $description = $request->getValue('description');
            $type = $request->getValue('type', 'Best'); 
        
            $key = "taobao:Item:Title";
            $result = $this->setsProvider->EditTranslateByKey($sid, $request->getValue('language'), $title, $key, $id);
        
            $key = "taobao:Item:Description";
            $result = $this->setsProvider->EditTranslateByKey($sid, $request->getValue('language'), $description, $key, $id);
            
            $this->clearCache('Item', $type);
        } catch(ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'));     
    }

    private function clearCachePart($contentType, $params) 
    {
        $cacheId = MainPage::getCacheKey('Get' . $contentType . 'RatingList', $params);
        $this->cacher->DelCacheEl($cacheId);
    }
    
    private function clearCache($contentType, $type = 'Best', $cid = 0)
    {
        $contentType = ucfirst(strtolower($contentType));
        if($contentType == 'Brand') {
            $params = MainPage::getBrandsItemsParams();
            $this->clearCachePart($contentType, $params);
        } else if ($contentType == 'Vendor') {
            $params = MainPage::getVendorsItemsParams();
            $this->clearCachePart($contentType, $params);
            
        } else if ($contentType == 'Item') {
            if ($type == 'Best' && $cid == 'Warehouse') {
                $warehouseParams = MainPage::getWarehouseItemsParams();
                $this->clearCachePart($contentType, $warehouseParams);
            } else if ($type == 'Best' && $cid == 0) {
                $bestParams = MainPage::getBestItemsParams();
                $this->clearCachePart($contentType, $bestParams);
            } else if ($type == 'Last') {
                $lastParams = MainPage::getLastItemsParams();
                $this->clearCachePart($contentType, $lastParams);
            } else if ($type == 'Popular') {
                $popularParams = MainPage::getPopularItemsParams();    
                $this->clearCachePart($contentType, $popularParams);
            } else if ($type == 'Last') {
                $lastParams = MainPage::getLastItemsParams();
                $this->clearCachePart($contentType, $lastParams);
            }
        }        
    }
    
    private function getActiveLang() 
    {
        if (RequestWrapper::getValueSafe('language')) {
            return RequestWrapper::getValueSafe('language');
        } else {            
            return key($this->languagesProvider->GetActiveLanguages());
        }
    }
    
    public function warehouseAction($request)
    {
        $this->_template = 'warehouse';
        
        try {
            $items = $this->setsProvider->GetItemRatingList('Best', 200, 'Warehouse', $this->getActiveLang());
            $this->tpl->assign('items', $items);
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('currentLang', $this->getActiveLang());
        }
        catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }
    
        $sid = Session::get('sid');
        print $this->fetchTemplate();
    }
    
}
