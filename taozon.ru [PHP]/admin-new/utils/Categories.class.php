<?php

OTBase::import('system.lib.Cache');
OTBase::import('system.lib.cache.Key');
OTBase::import('system.lib.cache.adapter.*');
OTBase::import('system.uploader.php.UploadHandler');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class Categories extends GeneralUtil
{
    protected $_template = 'categories';
    protected $_template_path = 'categories/';

    protected $categoriesProvider;
    protected $categoriesNewProvider;
    protected $cacher;

    public function __construct()
    {
        parent::__construct();

        $this->categoriesProvider = new CategoriesProvider($this->cms, $this->getOtapilib());
        $this->categoriesNewProvider = new CategoriesNewProvider();
        $this->cacher = new Cache('CategoriesUISettings');

    }
    
    private function generateFilter($request) 
    {
        $settings = $this->cacher->get('CategoriesUISettings');
        $settings = $settings ? $settings : array();

        $showHidden = array_key_exists('show_hidden_categories', $settings) ? $settings['show_hidden_categories'] : 1;
        $showEmpty = array_key_exists('show_empty_categories', $settings) ? $settings['show_empty_categories'] : 1;
        $showWoChild = array_key_exists('show_categories_wochild', $settings) ? $settings['show_categories_wochild'] : 1;
        
        $filter = array();
        $filter['show_hidden_categories'] = $request::post('show_hidden_categories', $showHidden);
        $filter['show_empty_categories'] = $request::post('show_empty_categories', $showEmpty) ;
        $filter['show_categories_wochild'] = $request::post('show_categories_wochild', $showWoChild);
        
        $settings['show_hidden_categories'] = $filter['show_hidden_categories'];
        $settings['show_empty_categories'] = $filter['show_empty_categories'];
        $settings['show_categories_wochild'] = $filter['show_categories_wochild'];
        $this->cacher->set($settings, 'CategoriesUISettings');
        
        return $filter;
    }
    
    function defaultAction($request)
    {
        $filter = $this->generateFilter($request);
        $this->tpl->assign('filter', $filter);
        $sid = Session::get('sid');
        
        $isSeoActive = 'false';        
        if(in_array('Seo2', General::$enabledFeatures)){
            $isSeoActive = 'true';
        }
        try {
            $categories = $this->categoriesProvider->GetEditableCategorySubcategories($sid, 0, 'true');            
            $providerInfoList = $this->categoriesProvider->GetProviderInfoList();                    
            if (! is_array($categories)) {
                throw new ServiceException(__METHOD__, '', 'Could not load categories list', 1);
            }
            if (! is_array($providerInfoList)) {
                throw new ServiceException(__METHOD__, '', 'Could not load providers list', 1);
            }
            $categories = $this->applyFilters($categories);
            $categories = $this->bindPredifenedParams($categories);
            if (is_array($categories)) {
                foreach ($categories as $k => &$category) {
                    $category['alias'] = $this->categoriesProvider->getCategoryAlias($category['Id']);;
                    $category['seo'] = $this->categoriesProvider->getCategorySEO($category['Id']);
                    $category['seo_pagetitle'] = $category['seo']['pagetitle'];
                    $category['seo_keywords'] = $category['seo']['seo_keywords'];
                    $category['seo_description'] = $category['seo']['seo_description'];
                    $category['seo_title'] = $category['seo']['seo_title'];
                }
            }
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
            $categories = array();
            $providerInfoList = array();
        }    

        $this->_template = 'categories';
        $this->tpl->assign('categories', $categories);
        $this->tpl->assign('providerInfoList', $providerInfoList);
        $this->tpl->assign('isSeoActive', $isSeoActive);        
        print $this->fetchTemplate();
    }
    
    private function applyFilters($categories)
    {
        $settings = $this->cacher->get('CategoriesUISettings');
        
        $showHidden = array_key_exists('show_hidden_categories', $settings) ? $settings['show_hidden_categories'] : 1;
        $showEmpty = array_key_exists('show_empty_categories', $settings) ? $settings['show_empty_categories'] : 1;
        $showWoChild = array_key_exists('show_categories_wochild', $settings) ? $settings['show_categories_wochild'] : 1;
        
        $filteredCategories = array();
        $i = 0;
        foreach ($categories as $key => &$category) {
            $skip = false;
            
            if (($category['IsHidden'] == 'true' || $category['ishidden'] == 'true') && $showHidden == 0) {
                $skip = true;
            } elseif (($category['IsHidden'] == 'true' || $category['ishidden'] == 'true') && $showHidden == 1) {
                $category['IsHiddenUI'] = 'true';
            } 
            
            if (($category['deletestatus'] == 'ParentOfHiddenDeleted') && ($showEmpty == 0) ) {
                $skip = true;
            } elseif (($category['deletestatus'] == 'ParentOfHiddenDeleted') && ($showEmpty == 1) ) {
                $category['DeleteStatusUI'] = 'true';
            } 
            
            if (($category['deletestatus'] == 'ParentOfHiddenDeleted') && ($category['IsParent'] == 'false') && ($showWoChild == 0)) {
                $skip = true;
            }

            if (($category['IsVirtual'] == 'true' && $category['IsParent'] == 'false') && ($showWoChild == 0)) {
                $skip = true;
            }

            if (! $skip) {
                $category['i'] = $i;
                $i++;
                $filteredCategories[] = $category;
            }
        }
        
        return $filteredCategories;
    }

    /**
     * @param RequestWrapper $request
     */
    public function getCategoriesAction($request)
    {
        $sid = Session::get('sid');
        try {
            $parentId = $request->getValue('parentId');
            $categories = $this->categoriesProvider->GetEditableCategorySubcategories($sid, $parentId, 'true');
            if (! is_array($categories)) {
                throw new ServiceException(__METHOD__, '', 'Could not load categories list', 1);
            }
            // apply filter
            $categories = $this->applyFilters($categories);
            $categories = $this->bindPredifenedParams($categories);
            if (is_array($categories)) {
                foreach ($categories as $k => &$category) {
                    $category['alias'] = $this->categoriesProvider->getCategoryAlias($category['Id']);;
                    $category['seo'] = $this->categoriesProvider->getCategorySEO($category['Id']);
                    $category['seo_pagetitle'] = $category['seo']['pagetitle']; 
                    $category['seo_keywords'] = $category['seo']['seo_keywords'];
                    $category['seo_description'] = $category['seo']['seo_description'];
                    $category['seo_title'] = $category['seo']['seo_title'];
                }
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
            $categories = array();
        }
        
        $this->sendAjaxResponse(array(
            'categories' => $categories
        ));
    }

    /**
     * @param RequestWrapper $request
     */
    public function createCategoryAction($request)
    {
        $sid = Session::get('sid');
        try {
            $log = new KLogger(CFG_APP_ROOT . '/log/categoriesAdmin', KLogger::DEBUG);
            $log->logDebug('createCategoryAction - Start');
            $log->logDebug('createCategoryActionParams', $request);
            
            $name = $request->getValue('name');            
            $alias = $request->getValue('alias', '');
            $seoText = $request->getValue('seoText', '');
            
            $alias = str_replace("\\", "-", $alias );
            $alias = str_replace("\/", "-", $alias );
            
            $metaPagetitle = $request->getValue('meta_pagetitle', '');
            $metaTitle = $request->getValue('meta_title', '');
            $metaKeywords = $request->getValue('meta_keywords', '');
            $metaDescription = $request->getValue('meta_description', '');
            
            $predefinedParams = $request->getValue('predefinedParams'); 
            $validator = new Validator(array(
                'name' => trim($name),
                'alias' => $alias,
                'provider' => isset($predefinedParams['provider']) ? $predefinedParams['provider'] : ''
            ));
            
            $validator->addRule(new NotEmptyString(), 'name', LangAdmin::get('Name_cannot_be_empty'));
            if (in_array('Seo2', General::$enabledFeatures) && $alias != '') {
                $validator->addRule(new Regexp('/^[a-z0-9-_]+$/i'), 'alias', LangAdmin::get('Category_alias_is_invalid'));
            }
            if ($predefinedParams['preDefineMode'] != 'virtual') {
                $validator->addRule(new NotEmptyString(), 'provider', 'Не выбран провайдер');
            }
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            $xml = $this->generateCategoryXML($request);
            $this->categoriesNewProvider->initAddCategoryInfo(Session::getActiveLang(), Session::getActiveLang(), $xml);
            $this->categoriesNewProvider->doRequests();
            $createdData = array(
                'newId' => $this->categoriesNewProvider->getAnswerAddCategoryInfo()->GetOtapiCategory()->GetId(),
                'isParent' => $this->categoriesNewProvider->getAnswerAddCategoryInfo()->GetOtapiCategory()->IsParent()
            );        
             
            $log->logDebug('createCategoryActionAnswer - newId: '.$createdData['newId']);
            
            if ($seoText) {
                $this->categoriesProvider->setSeoText($createdData['newId'], $seoText);
            }
            $aliasToSave = '';
            if (in_array('Seo2', General::$enabledFeatures)) {
                $aliasToSave = $alias != '' ? $alias : TextHelper::translitСonverter(trim($name));                
                $this->categoriesProvider->setCategoryAlias($createdData['newId'], $aliasToSave);
                $data = array(
                    'cid' => $createdData['newId'],
                    'seo_title' => $metaTitle,
                    'meta_keywords' => $metaKeywords,
                    'meta_description' => $metaDescription,
                    'meta_title'=> $metaPagetitle
                );
                $this->categoriesProvider->setCategorySEO($data);
                Cacher::rRmDir(CFG_APP_ROOT . '/cache/menushortnew');
            }
            
        } catch (ServiceException $e) {
            $log->logDebug('createCategoryActionError',$e);
            $this->respondAjaxError($e->getMessage());
        }

        $this->sendAjaxResponse(array(
            'newId' => $createdData['newId'],
            'isParent' => $createdData['isParent'],
            'aliasToSave' => $aliasToSave
        ));
    }

    public function updateCategoryAction($request)
    {
        try {
            $log = new KLogger(CFG_APP_ROOT . '/log/categoriesAdmin', KLogger::DEBUG);
            $log->logDebug('updateCategoryAction - Start');            
            $log->logDebug('updateCategoryActionParams', $request);
            $sid = Session::get('sid');
            
            $newName = (string)$request->getValue('newName');
            $categoryId =  $request->getValue('categoryId');
            
            $alias = $request->getValue('alias','');
            $seoText = $request->getValue('seoText','');
            
            $alias = str_replace("\\", "-", $alias );
            $alias = str_replace("\/", "-", $alias );
            
            $metaPagetitle = $request->getValue('meta_pagetitle', '');
            $metaTitle = $request->getValue('meta_title', '');
            $metaKeywords = $request->getValue('meta_keywords', '');
            $metaDescription = $request->getValue('meta_description', '');
            
            
            $predefinedParams = $request->getValue('predefinedParams'); 
            $validator = new Validator(array(
                'name' => trim($newName),
                'categoryId' => $categoryId,
                'alias' => $alias,
                'provider' => isset($predefinedParams['provider']) ? $predefinedParams['provider'] : ''
            ));
            $validator->addRule(new NotEmptyString(), 'name', LangAdmin::get('Name_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'categoryId', LangAdmin::get('Category_id_cannot_be_empty'));
            if ($predefinedParams['preDefineMode'] != 'virtual') {
                $validator->addRule(new NotEmptyString(), 'provider', 'Не выбран провайдер');
            }
            if (in_array('Seo2', General::$enabledFeatures) && $alias != '') {
                $validator->addRule(new Regexp('/^[a-z0-9-_]+$/i'), 'alias', LangAdmin::get('Category_alias_is_invalid'));
            }    
                
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            
            //update category name            
            $xml = $this->generateCategoryXML($request);
            $this->categoriesNewProvider->initEditCategoryInfo(Session::getActiveLang(), $categoryId, $xml);
            $this->categoriesNewProvider->doRequests();            
            $result = $this->categoriesNewProvider->getAnswerEditCategoryInfo()->GetOtapiCategory()->GetId();            
            $log->logDebug('updateCategoryActionAnswer - result: '.$result);
            
            //update category text
            if (!$seoText) {
                $seoText = '';
            }
            $this->categoriesProvider->setSeoText($categoryId, $seoText);
            
            if (in_array('Seo2', General::$enabledFeatures)) {
                $aliasToSave = $alias != '' ? $alias : TextHelper::translitСonverter(trim($newName));                
                $this->categoriesProvider->setCategoryAlias($categoryId, $aliasToSave);
                
                $data = array(
                   'cid' => $categoryId,
                    'seo_title' => $metaTitle,
                    'meta_keywords' => $metaKeywords,
                    'meta_description' => $metaDescription,
                    'meta_title'=> $metaPagetitle
                    );
                
                $this->categoriesProvider->setCategorySEO($data);
                Cacher::rRmDir(CFG_APP_ROOT . '/cache/menushortnew');
            }
            
        } catch (ServiceException $e) {
            $log->logDebug('updateCategoryActionError',$e);
            $this->respondAjaxError($e->getMessage());
        }
        catch (DBException  $e) {
            $message = $e->getMessage();
            if (strstr($message, 'Duplicate entry')) {
                $this->respondAjaxError(LangAdmin::get('Duplicate_category_alias'));
            } else {
                $this->respondAjaxError($e->getMessage());
            }
        }
        
        $this->sendAjaxResponse();
    }
    
    private function generateCategoryXML($request) 
    {
        $xml = new SimpleXMLElement('<EditableCategoryInfo></EditableCategoryInfo>');
        
        $xml->addChild('CategoryName', trim($request->valueExists('newName') ? $request->getValue('newName') : $request->getValue('name')));
        if (($request->valueExists('parentId')) && ($request->getValue('parentId') != '')) {
            $xml->addChild('ParentId', $request->getValue('parentId'));
        }
        if (($request->valueExists('approxweight')) && ($request->getValue('approxweight') != '')) {
            $xml->addChild('ApproxWeight', $request->getValue('approxweight'));
        }
        $predefinedParams = $request->getValue('predefinedParams'); 
        if ($predefinedParams['preDefineMode'] == 'category') {
            $xml->addChild('ExternalId', $predefinedParams['category']['id']);
        }
        if ($predefinedParams['preDefineMode'] == 'search') {
            if (! empty($predefinedParams['searchUrl'])) {
                $child = $xml->addChild('SearchUrl');
                $child->value = $predefinedParams['searchUrl'];
            }
            $el = $xml->addChild('SearchParameters');        
            $el->addChild('Provider', $predefinedParams['provider']);
            if (! empty($predefinedParams['searchMethod'])) {
                $el->addChild('SearchMethod', $predefinedParams['searchMethod']);
            }
            if (! empty($predefinedParams['category'])) {
                $el->addChild('CategoryId', $predefinedParams['category']['id']);
            }
            if (! empty($predefinedParams['vendor'])) {
                $el->addChild('VendorName', $predefinedParams['vendor']);
            }
            if (! empty($predefinedParams['region'])) {
                $el->addChild('VendorAreaId', $predefinedParams['region']['RegionId']);
            }
            if (! empty($predefinedParams['searchWord'])) {
                $el->addChild('ItemTitle', $predefinedParams['searchWord']);
            }
            if (! empty($predefinedParams['minPrice'])) {
                $el->addChild('MinPrice', $predefinedParams['minPrice']);
            }
            if (! empty($predefinedParams['maxPrice'])) {
                $el->addChild('MaxPrice', $predefinedParams['maxPrice']);
            }
            if (! empty($predefinedParams['brand'])) {
                $el->addChild('BrandId', $predefinedParams['brand']);
            }
            if (! empty($predefinedParams['stuffStatus'])) {
                $el->addChild('StuffStatus', $predefinedParams['stuffStatus']);
            }
            if (! empty($predefinedParams['Configurators'])) {
                $configs = $el->addChild('Configurators');
                foreach($predefinedParams['Configurators'] as $item) {
                    $configOne = $configs->addChild('Configurator');
                    $configOne->addAttribute('Pid', $item['pid']);
                    $configOne->addAttribute('Vid', $item['vid']);
                }
            }     
            if ((! empty($predefinedParams['featureDiscount'])) || (! empty($predefinedParams['featureAuction']))) {
                $features = $el->addChild('Features');
                if (! empty($predefinedParams['featureDiscount'])) {
                    $el = $features->addChild('Feature', $predefinedParams['featureDiscount']);
                    $el->addAttribute('Name', 'Discount');
                }
                if (! empty($predefinedParams['featureAuction'])) {
                    $el = $features->addChild('Feature', $predefinedParams['featureAuction']);
                    $el->addAttribute('Name', 'Auction');
                }
            }
        }
        return $xml->asXML();
    }
    
        
    /**
     * @param RequestWrapper $request
     */
    public function removeCategoryAction($request)
    {
        try {
            $id = $request->getValue('id');
            $this->categoriesProvider->RemoveCategory(Session::get('sid'), $id);
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }

        $this->sendAjaxResponse();
    }

    public function visibleCategoryAction($request)
    {
        try {
            $categoryId = $request->getValue('categoryId');
            $sessionId = Session::get('sid');
            if ($request->getValue('visible') == 'false') {
                $categorySettings = $categoryId . '-0';
            } else {
                $categorySettings = $categoryId . '-1';
            }
            $data = $this->categoriesProvider->EditCategoriesVisible($categorySettings, $sessionId);
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        
        $this->sendAjaxResponse();
    }
    
    public function orderCategoryAction($request)
    {
        try {
            $categoryId = $request->getValue('categoryId');
            $sessionId = Session::get('sid');
            $i = $request->getValue('i');
            
            $data = $this->categoriesProvider->EditOrderOfCategory($i, $categoryId, $sessionId);
            
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }
    
    /**
     * @param RequestWrapper $request
     */
    public function moveCategoryAction($request)
    {
        try {
            $sid = Session::get('sid');
            $id = $request->getValue('id');
            $parentId = $request->getValue('parentId');
            $newParentId = $request->getValue('newParentId');
            
            $validator = new Validator(array(
                'id' => trim($id),
                'parentId' => trim($parentId),
                'newParentId' => trim($newParentId),
            ));
            $validator->addRule(new NotEmptyString(), 'id', LangAdmin::get('Id_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'parentId', LangAdmin::get('Category_id_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'newParentId', LangAdmin::get('Category_id_cannot_be_empty'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            
            $this->categoriesProvider->EditCategoryParent($sid, $id, $newParentId);
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }
    
    public function exportTxtAction($request)
    {
        try {
            //2014_02_12
            $date = new DateTime();
            $filename = 'categories_'.$date->format('Y_m_d').'.txt';
            $sessionId = Session::get('sid');
            $data = $this->categoriesProvider->ExportStructureByLanguage($sessionId);
            if ($data) {
                header('Content-Type: text/plain; charset:utf-8;');
                header('Content-Disposition: attachment; filename="'.$filename.'"');
                echo base64_decode($data);
                echo "\r\n";
            }            
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
    }

    public function exportXmlAction($request)
    {
        try {
            $date = new DateTime();
            $filename = 'categories_'.$date->format('Y_m_d').'.xml';
            $sessionId = Session::get('sid');
            $data = $this->categoriesProvider->ExportCatalog($sessionId);
            if ($data) {
                header('Content-type: text/xml; charset=utf8');
                header('Content-Disposition: attachment; filename="'.$filename.'"');
                $content = $data->Content->asXML();
                $content = str_replace('Content', 'CatalogPackage', $content);
                echo $content;
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
    }
    
    public function importAction($request)
    {
        try {
            $uploadResult = json_decode($this->uploadFile());
            if ($uploadResult && $uploadResult->uploaded_file[0]->size > 0) {
                $sessionId = Session::get('sid');
                
                $content = file_get_contents($uploadResult->uploaded_file[0]->url);
                if ($uploadResult->uploaded_file[0]->type == 'text/plain' ) {
                    $sorce = base64_encode($content);
                    $data = $this->categoriesProvider->ImportStructureByLanguage($sessionId, $sorce);
                } elseif ($uploadResult->uploaded_file[0]->type == 'text/xml') {
                    $data = $this->categoriesProvider->ImportCatalog($sessionId, $content);
                }
            } else {
                Session::setError(
                    LangAdmin::get('Could_not_load_file_categories') . '. ' . $uploadResult->uploaded_file[0]->error
                );
            }
        } catch (ServiceException $e) {
            Session::setError($e->getErrorMessage());
            ErrorHandler::registerError($e);
        }
        header('Location: index.php?cmd=categories');
    }
    
    private function uploadFile()
    {
        ob_start();
        new UploadHandler(array(
            'param_name' => 'uploaded_file',
            'accept_file_types' => '/\.(txt|xml)$/i'
        ), true, null, '/uploaded/categories/');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
    
    public function getCategoryDataAction($request)
    {
        $seoText = '';
        try {
            $sessionId = Session::get('sid');
            $categoryId = $request->getValue('categoryId');
            $externalId = $request->getValue('externalId');
            $regionId = $request->getValue('regionId');
            if (! empty($externalId)) {
                $externalCategory = $this->categoriesProvider->GetProviderCategory($externalId);
            } else {
                $externalCategory = false;
            }
            if (! empty($regionId)) {
                $regionName = $this->categoriesProvider->GetRegionName($regionId);
            } else {
                $regionName = false;
            }
            $seoText = $this->categoriesProvider->getSeoText($categoryId);
            if ($externalCategory && ($externalCategory['ProviderType'] != 'Warehouse')) {
                $searchprops = $this->categoriesProvider->GetCategorySearchProperties($categoryId);
            } else {
                $searchprops = array();
            }
            $searchFilters = $this->generateSearchFilterEditor($searchprops);
            
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array(
            'seoText' => $seoText,
            'filters' => $searchFilters,
            'externalCategory' => $externalCategory,
            'regionName' => $regionName,
            'Configurators' => $searchprops
        ));
    }
    
    private function generateSearchFilterEditor($searchprops) 
    {
        $this->_template = 'searchFilters';

        $this->tpl->assign('searchprops', $searchprops);
        return $this->fetchTemplateWithoutHeaderAndFooter(false);
    } 

    public function saveFilterAction($request) 
    {
        try {
            $sessionId = Session::get('sid');
            $langId = Session::getActiveLang();
            $categoryId = $request->get('categoryId');
            $filterId = $request->get('filterId');
            $name = $request->getValue('name');
            $value = $request->getValue('value');
            
            $this->categoriesProvider->updateSearchFilter($categoryId, $filterId, $name, $value, $sessionId, $langId);
            
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    
    public function getHintAction($request)
    {
        try {
            $sessionId = Session::get('sid');
            $name = $request->getValue('name');

            $categories = $this->categoriesProvider->FindHintCategoryInfoList($name);
            $hints = array();
            
            foreach ($categories as $category) {
                $path = '';
                if (isset($category['path'])) {
                    $paths = array();
                    foreach ($category['path'] as $pitem) {
                        $paths[] = $pitem['name'];
                    }
                    $path = implode(' > ', $paths); 
                }
                else {
                    $path = $category['name'];
                    
                }
                
                $hint = array();
                $hint['id'] = $category['id'];
                $hint['label'] = $path;
                
                $hints[] = $hint;
            }
            $this->sendAjaxResponse($hints);
        } catch (ServiceException $e) {
            ErrorHandler::registerError($e);
        }
    }
    
    private function copyCategories($parentId, $targetId) 
    {
        try {
            $sessionId = Session::get('sid');
            $categories = $this->categoriesProvider->GetEditableCategorySubcategories($sessionId, $parentId, 'true');
            if (is_array($categories)) {
                foreach ($categories as $key => &$category) {
                    try {
                        $newId = null;
                        $newId = $this->categoriesProvider->AddCategoryByLanguage($sessionId, $category['name'], $targetId, $category['externalid']);
                    } catch (ServiceException $e) {
                    }
                    if ($newId && $category['IsParent'] == 'true') {                
                        $parentId = $category['Id'];
                        $this->copyCategories($category['id'], $newId);
                    }
                }
            }
        } catch (ServiceException $e) {
            $this->errorHandler->registerError($e);
        }
    }
    
    public function copyPasteAction($request){
        try {
            $sessionId = Session::get('sid');
            $copiedId = $request->getValue('copiedId');
            $targetId = $request->getValue('targetId');
            $copiedName = $request->getValue('copiedName');
            $copiedExternalId = $request->getValue('copiedExternalId');

            if ($copiedName) {
                $newId = $this->categoriesProvider->AddCategoryByLanguage($sessionId, $copiedName, $targetId, $copiedExternalId);
                if ($newId) {                
                    $this->copyCategories($copiedId, $newId);
                }
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }
    
    public function getSearchParamsFormAction($request){
        try {
            $sessionId = Session::get('sid');
            $searchProvider = $request->getValue('searchProvider');            
            $this->categoriesNewProvider->initGetProviderSearchMethodInfoList(Session::getActiveAdminLang());
            $this->categoriesNewProvider->doRequests();            
            $searchMethods = $this->categoriesNewProvider->getProviderSearchMethodInfoList()->GetResult()->GetContent();
            
            $selectedSearchMethods = array();
            $selectedSearchMethodsName = array();
            foreach($searchMethods->GetItem() as $method) {
                if ($method->GetProvider() == $searchProvider) {
                    $selectedSearchMethods[] = $method;

                    $providerMethod = $method->GetProvider() . '_' . $method->GetSearchMethod();
                    $providerMethod = $this->getSearchType($providerMethod);
                    $methodName = $method->GetDisplayName();
                    // если есть перевод названия поиска - берем перевод, иначе название берется с сервисов
                    if (Lang::get($providerMethod.'_Flag') != $providerMethod.'_Flag') {
                        $methodName = Lang::get($providerMethod.'_Flag');
                    }
                    $selectedSearchMethodsName[$method->GetSearchMethod()] = $methodName;
                }
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->_template = 'searchParamsForm';
        $this->tpl->assign('selectedSearchMethods', $selectedSearchMethods);
        $this->tpl->assign('selectedSearchMethodsName', $selectedSearchMethodsName);
        $this->sendAjaxResponse(array(
            'form' => $this->fetchTemplateWithoutHeaderAndFooter(),
            'searchMethods' => $this->prepareJSONSearchMethods($selectedSearchMethods)
        ));
    }

    private function getSearchType($searchType) {
        $searchType = str_replace('Taobao_Extended', 'China_Other', $searchType);
        $searchType =  str_replace('Taobao', 'China', $searchType);
        return $searchType;
    }

    public function getCategoriesByProviderAction($request){
        try { 
            $categoryRoot = $request->getValue('categoryRoot');
            $canSearchRootCategory = $request->getValue('canSearchRootCategory');
            $categories = $this->categoriesProvider->GetProviderCategorySubcategories($categoryRoot);                                    
            if ($canSearchRootCategory == 'true') {
                $tmp = array();
                $tmp[0] = array(
                    'Id' => $categoryRoot,
                    'id' => $categoryRoot,                    
                    'Name' => 'Все категории (root)',
                    'name' => 'Все категории (root)',                    
                    'ApproxWeight' => '',
                    'approxweight' => ''
                );
                $categories = array_merge($tmp, $categories);
            }
        } catch (ServiceException $e) {
            $categories = array();
            $this->respondAjaxError($e->getMessage());            
        }
        $this->sendAjaxResponse(array(
            'categories' => $categories
        ));
    }
    
    public function getCategoryFiltersDataAction($request)
    {
        try {
            $sessionId = Session::get('sid');
            $categoryId = $request->getValue('categoryId');            
            $searchprops = $this->categoriesProvider->GetCategorySearchProperties($categoryId);
            $searchFilters = $this->generateSearchFilterEditorByChecks($searchprops);
            
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('filters' => $searchFilters));
    }
        
    private function prepareJSONSearchMethods($searchMethods){
        $result = array();
        foreach ($searchMethods as $method) {
            $tmp = array(
                'method'            => $method->GetSearchMethod(),
                'Vendor'            => $method->Vendor(),
                'VendorLocation'    => $method->VendorLocation(),
                'Brand'             => $method->Brand(),
                'Configurators'     => $method->Configurators(),
                'PriceRange'        => $method->PriceRange(),
                'VendorRatingRange' => $method->VendorRatingRange(),
                'VolumeRange'       => $method->VolumeRange(),
                'StuffStatus'       => $method->StuffStatus()
            );            
            foreach ($method->GetFeatures()->GetFeature() as $feature) {
                $tmp['Feature' . $feature->GetName()] = true;
            }
            $result[] = $tmp;
        }
        return json_encode($result);
    }
    
    private function generateSearchFilterEditorByChecks($searchprops) 
    {
        $this->_template = 'searchFiltersByChecks';

        $this->tpl->assign('searchprops', $searchprops);
        return $this->fetchTemplateWithoutHeaderAndFooter(false);
    }
    
    private function bindPredifenedParams($categories)
    {
        $newCategories = array();
        foreach ($categories as $key => $category) { 
            $predifenedParams = array();
            if ($category['IsVirtual'] == 'true') {
                $predifenedParams['preDefineMode'] = 'virtual';
            } else if (empty($category['SearchParameters']['Provider'])) {
                $predifenedParams['preDefineMode'] = 'category';
                $predifenedParams['provider'] = $category['ProviderType'];
                $predifenedParams['category'] = array(
                    'name' => '',
                    'id' => $category['ExternalId']
                );
            } else {
                $predifenedParams['preDefineMode'] = 'search';
                $predifenedParams['provider'] = $category['SearchParameters']['Provider'];
                $predifenedParams['searchWord'] = $category['SearchParameters']['ItemTitle'];
                $predifenedParams['searchMethod'] = $category['SearchParameters']['SearchMethod'];
                $predifenedParams['vendor'] = $category['SearchParameters']['VendorName'];
                $predifenedParams['minPrice'] = $category['SearchParameters']['MinPrice'];
                $predifenedParams['maxPrice'] = $category['SearchParameters']['MaxPrice'];
                $predifenedParams['brand'] = $category['SearchParameters']['BrandId'];
                $predifenedParams['stuffStatus'] = $category['SearchParameters']['StuffStatus'];
                $predifenedParams['featureDiscount'] = isset($category['SearchParameters']['Features']['Discount']) ? $category['SearchParameters']['Features']['Discount'] : '';
                $predifenedParams['featureAuction'] = isset($category['SearchParameters']['Features']['Auction']) ? $category['SearchParameters']['Features']['Auction'] : '';                
                if (! empty($category['SearchParameters']['Configurators'])) {
                    foreach ($category['SearchParameters']['Configurators'] as $conf) {
                        $predifenedParams['Configurators'][] = array(
                            'pid' => (string)$conf['Pid'],
                            'vid' => (string)$conf['Vid'],
                            'name' => '',
                            'valueName' => ''
                        );
                    }
                }
                if (! empty($category['SearchParameters']['VendorAreaId'])) {
                    $predifenedParams['region'] = array(
                        'RegionId' => $category['SearchParameters']['VendorAreaId'],
                        'name' => ''
                    );
                }
                if (! empty($category['SearchParameters']['CategoryId'])) {
                    $predifenedParams['category'] = array(
                        'name' => '',
                        'id' => $category['SearchParameters']['CategoryId']
                    );
                }
            }
            $newCategories[] = array_merge($category, array('predifenedParams' => json_encode($predifenedParams)));
        }
        return $newCategories;
    }
}
