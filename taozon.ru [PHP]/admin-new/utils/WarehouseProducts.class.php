<?php

function exception_error_handler($errorNumber, $errorStr, $errorFile, $errorLine ) {
    if(strstr($errorFile, 'otapilib.php') === false)
        throw new Exception("$errorStr \n File: $errorFile \n Line: $errorLine", $errorNumber);
}

OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');
OTBase::import('system.uploader.php.UploadHandler');

class WarehouseProducts extends GeneralUtil
{
    protected $_template = 'index';
    protected $_template_path = 'warehouse/products/';

    /**
     * @var WarehouseProvider
     */
    protected $warehouseProvider;

    public function __construct()
    {
        parent::__construct();
        $this->warehouseProvider = new WarehouseProvider($this->getOtapilib());
    }

    public function generateFilter($request)
    {
        $filter = array();
        $filter['categoryId'] = $request->getValue('category_id') ? $request->getValue('category_id') : false;
        $filter['categoryName'] = $request->getValue('category_name') ? $request->getValue('category_name') : 0;
        $filter['productUrl'] = $request->getValue('product_url','');
        $url = $request->getValue('product_url','');
        if (strlen($url) == 0) {
            return $filter;
        }

        $invalidUrl = true;
        //http://release.opentao.net/item?id=wh-24&vendorId=wh-14
        if (preg_match("/[?&]id=([^&#]*)/i", $url, $matches) > 0) {
            $idValue = $matches[1];
            if (preg_match("/wh-([^&#]*)/i", $idValue, $matches) > 0) {
                $id = $matches[1];
                if (is_numeric($id)) {
                    $filter['Id'] = $id;
                    $invalidUrl = false;
                }
            }
        }

        if (preg_match("/[?&]vendorId=([^&#]*)/i", $url, $matches) > 0) {
            $idValue = $matches[1];
            if (preg_match("/wh-([^&#]*)/i", $idValue, $matches) > 0) {
                $vendorId = $matches[1];
                if (is_numeric($vendorId)) {
                    $filter['vendorId'] = $vendorId;
                    $invalidUrl = false;
                }
            }
        }

        if ($invalidUrl) {
            $filter['Id'] = 0;
        }

        return $filter;
    }

    public function getCategories($parentId)
    {
        try{
            $xml = $this->warehouseProvider->SearchWarehouseCategoriesXML($parentId);
            $categories = $this->warehouseProvider->SearchWarehouseCategories(Session::get('sid'), $xml);
            if (is_array($categories) && array_key_exists('Content', $categories)) {
                $categories = $categories['Content'];
                if (is_array($categories)) {
                    foreach ($categories as $key => &$category) {
                        if ($category['IsParent'] == true ){
                            $parentId = $category['Id'];
                            $subCategories = $this->getCategories($parentId);
                            if (is_array($subCategories)) {
                                if (is_array($subCategories)) {
                                    $category['children'] = $subCategories;
                                }
                            }
                        }
                    }
                    return  $categories;
                }
            }
            else {
                return array();
            }
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
            return array();
        }
        return array();
    }

    /**
     * @param RequestWrapper $request
     */
    public function defaultAction($request)
    {
        $filter = $this->generateFilter($request);
        try{
            $this->getCategoryPath($request->getValue('category'));
        }
        catch(ServiceException $e){
            $this->errorHandler->registerError($e);
        }

        $count = 0;
        $itemsPrepared = array();
        try{
            $page = $this->getPageDisplayParams($request);

            $perPage = $page['limit'];
            $page = $page['number'];
            $categories = $this->getCategories(0);
            $this->checkEmptyCategoryAndDefaultFill($request, $categories);

            $categoryId = $request->getValue('category_id') ? $request->getValue('category_id') : false;
            $vendorId = array_key_exists('vendorId', $filter) ? $filter['vendorId'] : false;
            $id = array_key_exists('Id', $filter) ? $filter['Id'] : false;

            $itemsPrepared = array();
            $count = 0;
            if ($id !== false) {
                if ($id > 0) {
                    $item = $this->warehouseProvider->GetWarehouseItemInfo(Session::get('sid'), $id);
                    if (! $item) {
                        throw new ServiceException(__METHOD__, '', 'Could not load item info', 'NotFound');
                    }
                    if ($categoryId && $item['categoryid'] != $categoryId) {
                        throw new ServiceException(__METHOD__, '', 'Could not load item info', 'NotFound');
                    }
                    if ($vendorId && $item['vendor']['id'] != $vendorId) {
                        throw new ServiceException(__METHOD__, '', 'Could not load item info', 'NotFound');
                    }
                    $itemsPrepared[] = $item;
                    $count = 1;
                }
            } else {
                $xml = $this->warehouseProvider->SearchWarehouseItemsXML($categoryId, $vendorId, false);
                $items = $this->warehouseProvider->SearchWarehouseItems(Session::get('sid'), $xml, ($page)*$perPage, $perPage);
                $itemsPrepared = $items['Content'];
                $count = $items['TotalCount'];
            }
            foreach ($itemsPrepared as &$item) {
                $item['MainImageUrl'] = ProductsHelper::getImage($item, 100, false);
            }

            $info = $this->warehouseProvider->GetProviderInfo('Warehouse');
            $currency = $info['currencycode'];
            $this->tpl->assign('currency', $currency);
        }
        catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }

        $this->tpl->assign('items', $itemsPrepared);
        $this->tpl->assign('paginator', new Paginator($count, $page, $perPage));
        $this->tpl->assign('filter', $filter);
        $this->tpl->assign('categories', $categories);
        $this->tpl->assign('count', $count);


        print $this->fetchTemplate();
    }

    private function getCategoryPath($startCategoryId)
    {
        if(!$startCategoryId)
            return ;

        $categoryInfo = $this->warehouseProvider->GetWarehouseCategoryInfo(Session::get('sid'), $startCategoryId);
        $this->tpl->assign('currentItem', array(
            'type' => $categoryInfo['IsParent'] == 'true' ? 'folder' : 'item',
            'data' => $categoryInfo
        ));

        $categoryPath = array();
        if($categoryInfo['ParentId'] > 0){
            $categoryId = $categoryInfo['ParentId'];
            do{
                $categoryInfo = $this->warehouseProvider->GetWarehouseCategoryInfo(Session::get('sid'), $categoryId);
                $categoryPath[] = $categoryInfo;
                $categoryId = $categoryInfo['ParentId'];
            }
            while($categoryInfo['ParentId'] > 0);
            $this->tpl->assign('categoryPath', $categoryPath);
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function getCategoriesAction($request)
    {
        try{
            $parentData = $request->getValue('parent') ? $request->getValue('parent') : 0;
            $parentId = $parentData ? $parentData['additionalParameters']['Id'] : 0;
            $xml = $this->warehouseProvider->SearchWarehouseCategoriesXML($parentId);
            $categories = $this->warehouseProvider->SearchWarehouseCategories(Session::get('sid'), $xml);

            $result = array();
            foreach($categories['Content'] as $c){
                $result[] = array(
                    'name' => $this->escape($c['Name']) . ' (wh-'.$c['Id'].')',
                    'type' => $c['IsParent'] == 'true' ? 'folder' : 'item',
                    'additionalParameters' => $c
                );
            }
            $this->sendAjaxResponse($result);
        }
        catch(ServiceException $e){
            $this->respondAjaxError($e->getMessage());
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function addProductAction($request)
    {
        $this->_template = 'product_form';

        $categoryId = $request->getValue('category');
        $this->getCategoryPath($categoryId);
        $this->tpl->assign('request', $request);
        $categories = $this->getCategories(0);
        $this->checkEmptyCategoryAndDefaultFill($request, $categories);

        $category = false;
        try {
            if ($categoryId > 0) {
                $category = $this->warehouseProvider->GetWarehouseCategoryInfo(Session::get('sid'), $categoryId);
            }

            $info = $this->warehouseProvider->GetProviderInfo('Warehouse');
            $currency = $info['currencycode'];
            $this->tpl->assign('currency', $currency);
        }
        catch(ServiceException $e){
            $this->errorHandler->registerError($e);
        }
        $this->tpl->assign('category', $category);
        $this->tpl->assign('categories', $categories);

        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function editProductAction($request)
    {
        $this->_template = 'product_form';

        $this->getCategoryPath($request->getValue('category'));
        $this->tpl->assign('request', $request);
        $categories = $this->getCategories(0);
        $this->checkEmptyCategoryAndDefaultFill($request, $categories);

        $category = false;
        try{
            $category = $this->warehouseProvider->GetWarehouseCategoryInfo(Session::get('sid'), $request->getValue('category'));
            $data = $this->otapilib->GetWarehouseItemInfo(Session::get('sid'), $request->getValue('id'));
            $this->tpl->assign('predefinedFormData', $data);

            $info = $this->warehouseProvider->GetProviderInfo('Warehouse');
            $currency = $info['currencycode'];
            $this->tpl->assign('currency', $currency);
        }
        catch(ServiceException $e){
            $this->errorHandler->registerError($e);
        }
        $this->tpl->assign('category', $category);
        $this->tpl->assign('categories', $categories);

        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveProductAction($request)
    {
        set_error_handler("exception_error_handler");

        $imageUrl = '';

        try {
            $validator = new Validator(array(
                'Id'            => $request->getValue('Id'),
                'Name'          => trim($request->getValue('Name')),
                'Description'   => trim($request->getValue('Description')),
                'Price'         => $request->getValue('Price'),
                'Quantity'      => $request->getValue('Quantity'),
                'Weight'        => $request->getValue('Weight'),
                'CategoryId'    => $request->getValue('CategoryId'),
                'Vendor'        => trim($request->getValue('Vendor')),
            ));
            $validator->addRule(new NotEmptyNumber(1),     'Id',          'ID cannot be empty', false);
            $validator->addRule(new NotEmptyString(),      'Name',        LangAdmin::get('Title_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(),      'Vendor',      LangAdmin::get('Vendor_cannot_be_empty'));
            $validator->addRule(new NotEmptyNumber(0),     'Price',       LangAdmin::get('Price_must_be_positive'));
            $validator->addRule(new NotEmpty(),            'Quantity',    LangAdmin::get('Quantity_must_be_positive'));
            $validator->addRule(new Int(),                 'Quantity',    LangAdmin::get('Incorrect_quantity'));
            $validator->addRule(new Range(0, PHP_INT_MAX), 'Quantity',    LangAdmin::get('Incorrect_quantity'));
            if (! $request->getValue('WeightReset')) {
                $validator->addRule(new NotEmpty(),            'Weight',      LangAdmin::get('Weight_must_be_positive'));
                $validator->addRule(new Float(),               'Weight',      LangAdmin::get('Incorrect_Weight'));
            }
            $validator->addRule(new NotEmptyNumber(1),     'CategoryId',  LangAdmin::get('Category_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(),      'Description', LangAdmin::get('Description_cannot_be_empty'));

            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            $data = $validator->getData();

            if (! ($request->getValue('ExistingMainImageUrl') || !empty($_FILES['MainImageUrl']['tmp_name']))) {
                $this->respondAjaxError(LangAdmin::get('Image_cannot_be_empty'));
            }

            $uploadResult = json_decode($this->uploadImage());
            $imageUrl = isset($uploadResult->MainImageUrl[0]->url) ?
            $uploadResult->MainImageUrl[0]->url :
            $request->getValue('ExistingMainImageUrl');

            $xml = $this->warehouseProvider->CreateWarehouseItemXML(
                $data['Name'],
                $data['Description'],
                $imageUrl,
                $data['Price'],
                $data['Quantity'],
                $data['CategoryId'],
                $data['Vendor'],
                $data['Weight'],
                $request->getValue('WeightReset') ? true : false
            );

            if (empty($data['Id'])) {
                $this->warehouseProvider->CreateWarehouseItem(Session::get('sid'), $xml);
            } else {
                $this->warehouseProvider->UpdateWarehouseItem(Session::get('sid'), $data['Id'], $xml);
            }
            Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');

            Session::clear('ItemFormRequest');

            $Url = new UrlWrapper();
            $Url->Set('http://'.$_SERVER['HTTP_HOST'].'/admin-new/index.php');
            $Url->Add('cmd', 'WarehouseProducts')
            ->Add('category', $data['CategoryId']);

            $this->sendAjaxResponse(array(
                'redirect' => $Url->Get()
            ), true);
        }
        catch (Exception $e) {
            Session::set('ItemFormRequest', array_merge($request->getAll(), array('MainImageUrl' => $imageUrl)));
            $this->respondAjaxError($e->getMessage());
        }
    }

    // TODO: Убрать дублирование с Pristroy::uploadImage
    private function uploadImage()
    {
        ob_start();
        new UploadHandler(array(
            'param_name' => 'MainImageUrl',
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
            )
        ), true, null, '/uploaded/warehouse/');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveInlineAction($request)
    {
        try{
            $id = $request->getValue('pk');
            $param = $request->getValue('name');
            $value = $request->getValue('value');
            if (($param == 'Price') or ($param == 'Quantity')) { 
                $validator = new Validator(array(
                    $param => $value
                ));
                $validator->addRule(new NotEmptyNumber(), $param, '');            
                if (! $validator->validate()) {
                    throw new ValidationException(LangAdmin::get('Value_must_be_numeric'));
                }
            }            
            $this->otapilib->UpdateWarehouseItem(Session::get('sid'), $id,
                "<ItemData><$param>".$request->getValue('value')."</$param></ItemData>");
        } catch(ValidationException $e){
            $this->respondAjaxError($e->getMessage());
        } catch(Exception $e){
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteAction($request)
    {
        $ajax = $request->getValue('ajax',false);
        try{
            $id = $request->getValue('id');
            if (is_array($id)) {
                foreach ($id as $key => $itemId) {
                    $this->otapilib->DeleteWarehouseItem(Session::get('sid'), $itemId);
                }
            }
            else {
                $this->otapilib->DeleteWarehouseItem(Session::get('sid'), $id);
            }
        }
        catch(Exception $e){
            if ($ajax) {
                $this->respondAjaxError($e->getMessage());
            }
            else {
                Session::setError($e->getMessage());
            }
        }
        if ($ajax) {
            $this->sendAjaxResponse();
        }
        else {
            $request->RedirectToReferrer();
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function getItemDataAction($request)
    {
        set_error_handler("exception_error_handler");

        try{
            $U = new UrlWrapper();
            $U->Set($request->getValue('value'));
            $itemId = $U->GetKey('id');
            if (! $itemId)
                throw new ValidationException(LangAdmin::get('Url_is_invalid'));
            $itemUrlData = explode('#', $U->Get());
            $itemConfigId = strstr($U->Get(), '#') !== false ? end($itemUrlData) : false;

            $this->otapilib->setResultInXMLOn();
            $result = $this->otapilib->GetItemFullInfo($itemId);
            $this->otapilib->setResultInXMLOff();

            $itemData = array(
                'Id' => $itemId,
                'Vendor' => (string)$result->OtapiItemFullInfo->VendorId,
                'Name' => (string)$result->OtapiItemFullInfo->Title,
                'Price' => $this->getItemPrice($result, $itemConfigId),
                'Config' => $this->getItemConfig($result, $itemConfigId),
                'Quantity' => $this->getItemQuantity($result, $itemConfigId),
                'Weight' => (float)$result->OtapiItemFullInfo->PhysicalParameters->Weight,
                'MainImageUrl' => (string)$result->OtapiItemFullInfo->MainPictureUrl,
                'MainImageUrlThumb' => (string)$result->OtapiItemFullInfo->MainPictureUrl.'_100x100.jpg',
            );
            $this->sendAjaxResponse($itemData);
        }
        catch(ValidationException $e){
            $this->respondAjaxError($e->getMessage());
        }
        catch(Exception $e){
            $this->respondAjaxError($e->getMessage());
        }
    }
    
    private function getItemQuantity($xml, $itemConfigId)
    {
        $ItemConfigIdXML = $xml->xpath('//*[text()="'.$itemConfigId.'"]');
        if(!count($ItemConfigIdXML) || !$itemConfigId)
            return (string)$xml->OtapiItemFullInfo->MasterQuantity;

        $temp = $ItemConfigIdXML[0];
        $temp = $temp->xpath("parent::*");
        $quantity = (string)$temp[0]->Quantity;
        return $quantity != "0" ? $quantity : (string)$xml->OtapiItemFullInfo->MasterQuantity;
    }

    private function getItemPrice($xml, $itemConfigId)
    {
        $ItemConfigIdXML = $xml->xpath('//*[text()="'.$itemConfigId.'"]');
        if(!count($ItemConfigIdXML) || !$itemConfigId)
            return (string)$xml->OtapiItemFullInfo->Price->ConvertedPriceList->Internal;

        $temp = $ItemConfigIdXML[0];
        $temp = $temp->xpath("parent::*");
        $price = (string)$temp[0]->Price->ConvertedPriceList->Internal;
        return $price != "0" ? $price : (string)$xml->OtapiItemFullInfo->Price->ConvertedPriceList->Internal;
    }

    private function getItemConfig($xml, $itemConfigId)
    {
        $config = array();

        $ItemConfigIdXML = $xml->xpath('//*[text()="'.$itemConfigId.'"]');
        if(!count($ItemConfigIdXML) || !$itemConfigId)
            return $config;

        $temp = $ItemConfigIdXML[0];
        $temp = $temp->xpath("parent::*");
        $ItemConfigXML = $temp[0]->Configurators;
        foreach($ItemConfigXML->children() as $configurator){
            $configAttrXML = $xml->xpath('//*[@Pid="'.$configurator['Pid'].'" and @Vid="'.$configurator['Vid'].'"]');
            if(!count($configAttrXML))
                continue;
            $configAttr = $configAttrXML[0];
            $config[] = array(
                'Name' => (string)$configAttr->PropertyName,
                'Value' => (string)$configAttr->ValueAlias,
                'ImageUrl' => (string)$configAttr->ImageUrl,
                'ImageUrlThumb' => (string)$configAttr->ImageUrl.'_100x100.jpg',
            );
        }

        return $config;
    }

    private function checkEmptyCategoryAndDefaultFill($request, $categories)
    {
        if (empty($categories)) {
            $this->createDefaultCategory();
            $request->RedirectToReferrer();
        }
    }

    private function createDefaultCategory()
    {
        $name = LangAdmin::get('Default_Warehouse_category_name');
        $parentId = 0;
        $position = 0;
        $newId = $this->warehouseProvider->CreateWarehouseCategoryData(Session::get('sid'), $name, $parentId, $position);
        if (! is_numeric($newId)) {
            throw new ServiceException(__METHOD__, '', 'Could not create new category', 1);
        }
    }
}