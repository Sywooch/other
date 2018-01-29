<?php
ini_set('memory_limit', '1024M');

class ItemListNew extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $multiSearchCache = true;

    /**
     * @var SearchPropNew
     */
    private $searchProp;

    /**
     * @var UrlWrapper
     */
    private $baseUrl;
    /**
     * @var UrlWrapper
     */
    private $urlWithoutSearch;
    /**
     * @var UrlWrapper
     */
    private $urlWithoutCategoryId;
    
    /**
     * @var VendorRepository
     */
    private $vendorRepository;

    const PER_PAGE_COUNT_0  = 0;
    const PER_PAGE_COUNT_4  = 4;
    const PER_PAGE_COUNT_8  = 8;
    const PER_PAGE_COUNT_16 = 16;
    const PER_PAGE_COUNT_20 = 20;
    const PER_PAGE_COUNT_40 = 40;
    const PER_PAGE_COUNT_50 = 50;
    const PER_PAGE_COUNT_100 = 100;
    const PER_PAGE_COUNT_200 = 200;


    public function __construct() {
        parent::__construct(true);
        $this->otapilib->setErrorsAsExceptionsOn();

        $this->baseUrl = new UrlWrapper();
        $this->baseUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->clearUrl = new UrlWrapper();
        $this->clearUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->urlWithoutSearch = new UrlWrapper();
        $this->urlWithoutSearch->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->urlWithoutCategoryId = new UrlWrapper();
        $this->urlWithoutCategoryId->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->searchProp = new SearchPropNew();
        
        $this->vendorRepository = new VendorRepository($this->cms);
    }

    /**
     * @return bool
     */
    public function isSearchMulti()
    {
        return !(RequestWrapper::get('Provider', false) && RequestWrapper::get('SearchMethod', false));
    }

    private function checkCacheAndGetBlockList($useProperties = 'true')
    {
        $cacheId = SearchPropNew::getCacheId();
        $blockList = 'SubCategories,Vendor,RootPath';
        if (($useProperties == 'true') &&
            ($cacheId == "" ||
                ! $this->dbCache->CheckCacheEl('catsearchprop:'.$cacheId) ||
                General::getConfigValue('not_use_cat_cache')
            )
        ) {
            $blockList .= ',SearchProperties';
        }

        if (RequestWrapper::getValueSafe('brand')) {
            $blockList .= ',Brand';
        }

        return $blockList;
    }

    protected function setVars()
    {
        Session::clearError();
        $this->resetParamsIfNeed();

        if ($this->needAjaxTemplate()) {
            return $this->setTemplate('itemlistnew_ajax');
        }
        if (RequestWrapper::getParamExists('isAjax')) {
            return $this->getCountOfItemsByFilter();
        }

        $this->assignCategoryId();
        $сategoryInfo = $this->prepareBaseUrl();
        $categoryItemFilter = $this->searchParams();
        $categoryItemFilter = $this->searchParamsAddited($categoryItemFilter);
        $categoryItemFilter = $this->searchParamsAddProvider($categoryItemFilter, $сategoryInfo);

        $newCategoryFilter = Plugins::invokeEvent('newCategoryFilterXML', array('xml' =>$categoryItemFilter));
        if ($newCategoryFilter)
            $categoryItemFilter = $newCategoryFilter;

        $perPage = $this->getAndAssignPerPageItemCount($categoryItemFilter);
        $from = $this->getAndAssignSearchOffset();
        $this->getAndAssignPerPageList();

        $SearchTypes = $this->getSearchMethods();
        $this->getCurrentSearchType($сategoryInfo);

        $this->getIsProviderActive($сategoryInfo);
        
        $isVendor = RequestWrapper::getParamExists('id') || RequestWrapper::getParamExists('vid');
        $this->tpl->assign('isVendor', $isVendor);        
        if ($isVendor) {
            $vid = RequestWrapper::getParamExists('id') ? RequestWrapper::getValueSafe('id') : RequestWrapper::getValueSafe('vid');
            $vendorInfoFromDB = $this->vendorRepository->GetVendorInfo($vid, Session::getActiveLang());
            $vendorInfoFromDB = isset($vendorInfoFromDB[0]) ? $vendorInfoFromDB[0] : array('image_path' => '', 'vendor_name' => '');                        
            $this->tpl->assign('vendorInfoFromDB', $vendorInfoFromDB);
        }        
       
        $isSearching = $this->CheckSearch();
        if ($isSearching['search']) {
            $searchXml = simplexml_load_string($categoryItemFilter);
            $searchParameters = array(
                'ItemTitle' => (string)$searchXml->ItemTitle,
                'CategoryId' => (string)$searchXml->CategoryId,
                'CategoryMode' => (string)$searchXml->CategoryMode,
                'OrderBy' => isset($searchXml->OrderBy) ? (string)$searchXml->OrderBy : false,
                'BrandPropertyValueId' => isset($searchXml->BrandPropertyValueId) ? (string)$searchXml->BrandPropertyValueId : false,
                'Configurators' => isset($searchXml->Configurators) ? (string)$searchXml->Configurators->asXML() : false
            );
            $searchParametersHash = md5(json_encode($searchParameters));
            if ($this->CheckMultiSearch($сategoryInfo)) {
                if($this->fileMysqlMemoryCache->Exists('multi_search:'.$searchParametersHash)){
                    $foundAllMulti = json_decode($this->fileMysqlMemoryCache->GetCacheEl('multi_search:'.$searchParametersHash), true);
                }
                else{
                    $foundAllMulti = $this->getMultiSearchItems($categoryItemFilter,$SearchTypes['SearchTypes']);
                    if($this->multiSearchCache)
                        $this->fileMysqlMemoryCache->AddCacheEl('multi_search:'.$searchParametersHash, 600, json_encode($foundAllMulti));
                }
            } else {
                $foundAll = $this->getSimpleItems($categoryItemFilter,$from,$perPage,$SearchTypes['SearchTypes']);
            }
            $this->getAndAssignSearchTypesInfo($searchParametersHash);
        } else {
            $this->tpl->assign('no_search_request', true);
            $this->tpl->assign('no_search_request_reason', $isSearching['reason']);
        }


        if (isset($foundAll)) {
            $this->setSimpleSearch($foundAll);
        }
        if (isset($foundAllMulti) && !(isset($foundAll) && $foundAll === false)) {
            $searchResults = 0;
            foreach($foundAllMulti as $providerSearchResult){
                $searchResults += is_array($providerSearchResult) ? count($providerSearchResult) : 0;
            }
            if($searchResults)
                $this->setMultiSearch($foundAllMulti);
        }

        $this->prepareHintCats();
        $this->tpl->assign('checkMultiSearch', $this->CheckMultiSearch($сategoryInfo));
        return true;
    }

    private function getSimpleItems($categoryItemFilter,$from,$perPage,$SearchTypes){
        $this->otapilib->setErrorsAsExceptionsOn();
        $foundAll = false;
        $searchData = array();
        $N_search = new SimpleXMLElement($categoryItemFilter);
        foreach ($SearchTypes as $type) {
            if (($type['Provider']==$N_search->Provider) && ($type['SearchMethod']==$N_search->SearchMethod)){
                $searchData = $type;
                break;
            }
        }
        try {
            if (! isset($searchData['Configurators'])) {
                $searchData['Configurators'] = false;
            }
            $foundAll = $this->otapilib->BatchSearchItemsFrame(session_id(), $categoryItemFilter, $from, $perPage,$this->checkCacheAndGetBlockList($searchData['Configurators']));
            $foundAll['searchData'] = $searchData;
        }
        catch (ServiceException $e) {
            if ((string)$e->getErrorCode() != 'NotFound') {
                Session::setError($e->getErrorMessage(), $e->getErrorCode());
            }
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }
        return $foundAll;

    }

    private function getMultiSearchItems($categoryItemFilter,$SearchTypes)
    {
        $foundAll = array();
        $isItems = false;
        $errorStorage = array();
        try {
            if (CFG_MULTI_CURL)  {
                $useBatch = true;
                $this->otapilib->InitMulti();
                foreach ($SearchTypes as $type) {
                    if ($type['FeatureForEnable'] == 'false') {
                        continue;
                    }
                    if ($type['Provider'].'_'.$type['SearchMethod'] != 'ProductComments_Default') {
                        $categoryItemFilterTmp = $this->searchParamsAddMulti($categoryItemFilter,$type['Provider'],$type['SearchMethod']);
                        if ($useBatch) {
                            $this->otapilib->BatchSearchItemsFrame(session_id(), $categoryItemFilterTmp, 0, $this->getPerPageMulti($type['Provider'].'_'.$type['SearchMethod']), $this->checkCacheAndGetBlockList());
                            $useBatch = false;
                        } else {
                            $this->otapilib->SearchItemsFrame($categoryItemFilterTmp, 0, $this->getPerPageMulti($type['Provider'].'_'.$type['SearchMethod']));
                        }
                    }
                }
                $this->otapilib->MultiDo();
            }
            $batchData = null;
            $this->otapilib->setErrorsAsExceptionsOn();
            foreach ($SearchTypes as $type) {
                if ($type['FeatureForEnable'] == 'false') {
                    continue;
                }
                $categoryItemFilterTmp = $this->searchParamsAddMulti($categoryItemFilter,$type['Provider'],$type['SearchMethod']);
                $ProviderNew = $type['Provider']=='Taobao' ? 'China' : $type['Provider'];
                if (strpos($type['SearchMethod'], 'Extended') !== false) {
                    $SearchMethodNew = str_replace('Extended', 'Other', $type['SearchMethod']);
                } else {
                    $SearchMethodNew = $type['SearchMethod'];
                }
                try {
                    if (! $batchData) {
                        $batchData = $this->otapilib->BatchSearchItemsFrame(session_id(), $categoryItemFilterTmp, 0, $this->getPerPageMulti($type['Provider'].'_'.$type['SearchMethod']), $this->checkCacheAndGetBlockList());
                        $foundAll[$ProviderNew.'_'.$SearchMethodNew] = $batchData;
                    } else {
                        $foundAll[$ProviderNew.'_'.$SearchMethodNew] = $batchData;
                        $foundAll[$ProviderNew.'_'.$SearchMethodNew]['Items'] = $this->otapilib->SearchItemsFrame($categoryItemFilterTmp, 0, $this->getPerPageMulti($type['Provider'].'_'.$type['SearchMethod']));
                    }
                    $isItems = true;
                } catch (ServiceException $e) {
                    if((string)$e->getErrorCode() != 'NotFound') {
                        $foundAll[$ProviderNew.'_'.$SearchMethodNew] = false;
                        throw new ServiceException('SearchItemsFrame[' . $ProviderNew.'_'.$SearchMethodNew . ']', array(), $e->getMessage(), $e->getErrorCode(), null, $e->getSubErrorCode());
                    }
                }
            }
            $this->otapilib->setErrorsAsExceptionsOff();
            if (CFG_MULTI_CURL)  {
                $this->otapilib->StopMulti();
            }
        }
        catch (ServiceException $e) {
            if ((string)$e->getErrorCode() != 'NotFound') {
                $this->multiSearchCache = false;
                $errorStorage[] = $e;
            }
        }
        catch (Exception $e) {
            Session::setError($e->getMessage(), $e->getCode());
        }
        if (! $isItems) {
            foreach($errorStorage as $e) {
                Session::setError($e->getErrorMessage(), $e->getErrorCode());
            }
        }
        return $foundAll;
    }

    private function setSimpleSearch($foundAll){
        if($this->searchProp->isSearchPropertiesCached())
           $foundAll['SearchProperties'] = $this->searchProp->getSearchPropertiesFromCache();
        else
           $this->searchProp->saveSearchPropertiesToCache(isset($foundAll['SearchProperties']) ? $foundAll['SearchProperties'] : array());
        $this->assignGlobals($foundAll);
        $this->prepareSubCategories($foundAll);
        $this->prepareItemList($foundAll);
        $this->prepareSearchProp($foundAll);
    }

    private function setMultiSearch($foundAllMulti) {
        $this->checkManyProviders($foundAllMulti);
        $this->assignGlobalsMulti($foundAllMulti);
        $this->prepareSubCategoriesMulti($foundAllMulti);
        $this->prepareItemListMulti($foundAllMulti);
        $this->prepareSearchPropMulti($foundAllMulti);
    }

    private function resetParamsIfNeed(){
        if (!$this->request->valueExists('clear')) return ;

        $this->baseUrl->DeleteKey('rating')
            ->DeleteKey('cost')
            ->DeleteKey('filters')
            ->DeleteKey('script_name')
            ->DeleteKey('clear')
            ->DeleteKey('ignorefilters');

        $this->request->LocationRedirect($this->baseUrl->Get());
    }



    private function needAjaxTemplate(){
        return $this->request->get('p') != 'item_list_ajax' && defined('CFG_AJAX_ITEM_LIST');
    }

    private function getAndAssignPerPageItemCount($categoryItemFilter){
        $default_perpage = self::PER_PAGE_COUNT_0;

        $searchXml = simplexml_load_string($categoryItemFilter);

        $key = (string)$searchXml->Provider . '_' . (string)$searchXml->SearchMethod;
        switch ($key) {
            case 'Taobao_Official':
                $default_perpage = $this->getCookiePerPage($key . '_perPage', General::getNumConfigValue('oficial_catalog_perpage', self::PER_PAGE_COUNT_4));
                break;
            case 'Taobao_Extended':
                $default_perpage = $this->getCookiePerPage($key . '_perPage', General::getNumConfigValue('extended_catalog_perpage', self::PER_PAGE_COUNT_8));
                break;
            case 'Taobao_ExtendedNew':
                $default_perpage = $this->getCookiePerPage($key . '_perPage', General::getNumConfigValue('extendedNew_catalog_perpage', self::PER_PAGE_COUNT_8));
                break;
            case 'Warehouse_Default':
                $default_perpage = $this->getCookiePerPage($key . '_perPage', General::getNumConfigValue('warehouse_catalog_perpage', self::PER_PAGE_COUNT_8));
                break;
            case 'ProductComments_Default':
                $default_perpage = $this->getCookiePerPage($key . '_perPage', General::getNumConfigValue('comments_catalog_perpage', self::PER_PAGE_COUNT_8));
                break;
            default:
                $default_perpage = $this->getCookiePerPage($key . '_perPage', self::PER_PAGE_COUNT_20);
                break;
        }
        if ($this->request->getValue('per_page')) {
            $this->setCookiePerPage($key . '_perPage', $this->request->getValue('per_page'));
            $perpage = $this->request->getValue('per_page');
        } else {
            $perpage = $default_perpage;
        }
        $this->tpl->assign('perpage', $perpage);
        return $perpage;
    }

    private function getAndAssignSearchOffset(){
        $from = intval($this->request->get('from'));
        $this->tpl->assign('from', $from);
        return $from;
    }

    private function getAndAssignPerPageList () {
        $perPage = array(20, 40, 100);
        if (General::getNumConfigValue('extended_catalog_perpage')) {
            $itemCount = General::getNumConfigValue('extended_catalog_perpage');
            if (! in_array($itemCount, $perPage)) {
                $perPage[] = $itemCount;
            }
            asort($perPage);
        }
        $this->tpl->assign('pp', $perPage);
        return $perPage;
    }


    private function assignCategoryId(){
        $this->tpl->assign('cid', $this->request->getValueSafe('cid'));
    }

    private function getPerPageMulti($key){
        switch ($key) {
            case 'Taobao_Official': // Официальный поиск - Tmall
                $perPage = General::getNumConfigValue('tmall_search_perpage', self::PER_PAGE_COUNT_4);
                break;
            case 'Taobao_Extended': // Товары из Китая
                $perPage = General::getNumConfigValue('simple_search_perpage', self::PER_PAGE_COUNT_8);
                break;
            case 'Taobao_ExtendedNew': // Товары из Китая
                $perPage = General::getNumConfigValue('simple_searchNew_perpage', self::PER_PAGE_COUNT_8);
                break;
            case 'Warehouse_Default': // Товары со склада
                $perPage = General::getNumConfigValue('warehouse_search_perpage', self::PER_PAGE_COUNT_4);
                break;
            case 'Taobao_Promoted': // Рекомендации таобао
                $perPage = General::getNumConfigValue('promoted_search_perpage', self::PER_PAGE_COUNT_4);
                break;
            case 'ProductComments_Default':
                $perPage = General::getNumConfigValue('comments_search_perpage', self::PER_PAGE_COUNT_8);
                break;
            default:
                $perPage = self::PER_PAGE_COUNT_20;
                break;
        }
        return $perPage;
    }



    private function prepareBaseUrl()
    {
        $this->urlWithoutCategoryId->DeleteKey('cid');
        $url = parse_url($this->urlWithoutCategoryId->Get());
        $query = array();
        if (! empty($url['query'])) {
            parse_str($url['query'], $query);
        }

        $prevCategoryLink = null;
        $cid = RequestWrapper::get('cid', $this->baseUrl->GetKey('cid'));
        try {
            $categoryInfo = array();
            $catpath = ! empty($GLOBALS['rootpath']) ? $GLOBALS['rootpath'] :
                ($cid ? $this->otapilib->GetCategoryRootPath($cid) : null);
            if (is_array($catpath)) {
                $categoryInfo = array_pop($catpath);
            }
        } catch(ServiceException $e){
            Session::setError($e->getErrorMessage(), $e->getErrorCode());
        }
        if (! empty($catpath) && is_array($catpath)) {
            array_pop($catpath);
            $prevCrumb = array_pop($catpath);
            if (! empty($prevCrumb)) {
                if (isset($query['p'])) {
                    unset($query['p']);
                }
                if (isset($prevCrumb['IsVirtual'])) {
                    unset($query['search']);
                    unset($query['cost']);
                    unset($query['filters']);
                }
                if ($prevCrumb['isparent'] == 'false') {
                    $prevCategoryLink = General::generateUrl('category', array_merge($query, $prevCrumb));
                } else {
                    $prevCategoryLink = General::generateUrl('subcategory', array_merge($query, $prevCrumb, array('root' => count($catpath) == 1)));
                }
                if (! empty($query)) {
                    $prevCategoryLink .= (strpos($prevCategoryLink, '?') !== false ? '&' : '?') . http_build_query($query);
                }
                $url2 = parse_url($prevCategoryLink);
            }
        }

        $this->baseUrl->DeleteKey('tmall')->DeleteKey('new_prod')->DeleteKey('Discount');
        $this->clearUrl->DeleteKey('from')
            ->DeleteKey('tmall')
            ->DeleteKey('cost')
            ->DeleteKey('filters')
            ->DeleteKey('new_prod');

        if($this->request->get('p_ajax'))
            $this->baseUrl->DeleteKey('p')->DeleteKey('p_ajax')->Add('p', $this->request->get('p_ajax'));

        if($this->request->post('sort_by'))
            $this->baseUrl->DeleteKey('sort_by')->Add('sort_by', $this->request->post('sort_by'));
        if($this->request->post('per_page'))
            $this->baseUrl->DeleteKey('per_page')->Add('per_page', $this->request->post('per_page'));
        if($this->request->post('search'))
            $this->baseUrl->DeleteKey('search')->Add('search', $this->request->post('search'));
        if($this->request->post('cid'))
            $this->baseUrl->DeleteKey('cid')->Add('cid', $this->request->post('cid'));
        if($this->request->get('tmall'))
            $this->baseUrl->Add('tmall', 'true');
        if($this->request->get('Discount'))
            $this->baseUrl->Add('Discount', 'true');
        if($this->request->post('Provider'))
            $this->baseUrl->DeleteKey('Provider')->Add('Provider', $this->request->post('Provider'));
        if($this->request->post('SearchMethod'))
            $this->baseUrl->DeleteKey('SearchMethod')->Add('SearchMethod', $this->request->post('SearchMethod'));

        if ($this->request->getMethod() == 'POST') {

            $this->request->LocationRedirect($this->baseUrl->Get());
        }

        $this->baseUrl->DeleteKey('from');
        $this->urlWithoutSearch->DeleteKey('search');

        $this->tpl->assign('urlWithoutCategoryId', $this->urlWithoutCategoryId->Get());
        $this->tpl->assign('urlWithoutSearch', $this->urlWithoutSearch->Get());
        $this->tpl->assign('baseUrl', $this->baseUrl);
        $this->tpl->assign('clearUrl', $this->clearUrl->Get());
        $this->tpl->assign('prevCategoryLink', $prevCategoryLink);
        return $categoryInfo;
    }

    private function searchParams()
    {
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');

        $xmlSearchConfig = simplexml_load_file(CFG_APP_ROOT.'/config/request2xml.search.xml');
        foreach($xmlSearchConfig->predefined_paramters->parameter as $c)
            $xmlParams->addChild((string)$c['name'], (string)$c[0]);

        foreach($xmlSearchConfig->parameter as $c)
            $this->appendXmlParameter($c->children(),(string)$c['name'],$xmlParams);

        if (defined('CFG_SEARCH_LANG')) {
            $xmlParams->addChild('LanguageOfQuery', CFG_SEARCH_LANG);
        }

        self::prepareFiltersXml($xmlParams);
        self::prepareFeaturesXml($xmlParams);
        $this->addPredefinedCategoryModeToSearchXML($xmlParams);
        return $xmlParams->asXML();
    }

    public static function prepareFeaturesXml(&$xmlElement){
        if (isset($_GET['Discount'])) {
            $xmlElement->addChild('IsTmall','true');
            $configuratorsXml = $xmlElement->addChild('Features');
            $el =$configuratorsXml->addChild('Feature', 'true');
            $el->addAttribute('Name', 'Discount');
        }
    }


    public function checkManyProviders($foundAllMulti){
        $countProviders = array();
        foreach ($foundAllMulti as $key=>$list) {
            if (!isset($list['Items']['Items']['totalcount']))
                continue;
            if ($list['Items']['Items']['totalcount']>0)
                $countProviders[] = explode("_", $key);
        }
        if (count($countProviders)==1 && !RequestWrapper::get('SearchMethod', false)) {
            $this->request->LocationRedirect($this->baseUrl->Add('Provider', $countProviders[0][0])->Add('SearchMethod', $countProviders[0][1])->Get());
        }
    }


    public static function prepareFiltersXml(&$xmlElement){
        if (isset($_GET['filters'])) {
            $configuratorsXml = $xmlElement->addChild('Configurators');
            foreach ($_GET['filters'] as $pid => $vid) {
                if ($vid && $pid!='StuffStatus'){
                    if (is_array($vid)) {
                        foreach ($vid as $key => $p) {
                            $el = $configuratorsXml->addChild('Configurator');
                            $el->addAttribute('Pid', $pid);
                            $el->addAttribute('Vid', $key);
                        }
                    } else {
                        $el = $configuratorsXml->addChild('Configurator');
                        $el->addAttribute('Pid', $pid);
                        $el->addAttribute('Vid', $vid);
                    }
                }
                elseif($pid=='StuffStatus' && $vid){
                    $xmlElement->addChild('StuffStatus', $vid);
                }
            }
        }
    }

    private function appendXmlParameter($requestKeys, $xmlKey, &$xmlElement){
        $value = $this->getArrayValueByKeys($this->request->getAll(), $requestKeys);
        if($value)
            $xmlElement->addChild($xmlKey, $this->request->escapeValue($value));
    }

    private function getArrayValueByKeys($array, $keys){
        $tmp = $array;
        foreach($keys->request as $k){
            $tmp = @$tmp[(string)$k];
        }
        return $tmp;
    }

    private function addPredefinedCategoryModeToSearchXML($xml){
        $search_category_mode = General::getConfigValue('search_category_mode') ?
            General::getConfigValue('search_category_mode') : 'External';
        $xml->CategoryMode = (string)$search_category_mode;
    }

    private function searchParamsAddited($oldxml){
        $N_search = new SimpleXMLElement($oldxml);

        if (General::getConfigValue('min_cost_goods')) {
            if ($N_search->MinPrice<General::getConfigValue('min_cost_goods')) {
                $N_search->MinPrice = General::getConfigValue('min_cost_goods');
            }
            if ((isset($N_search->MaxPrice)) and ($N_search->MaxPrice<General::getConfigValue('min_cost_goods'))) {
                $N_search->MaxPrice = General::getConfigValue('min_cost_goods');
            }
        }
        if (General::getConfigValue('hide_bu_goods')) {
            $N_search->StuffStatus = 'New';
        }
        return $N_search->asXML();
    }

    private function searchParamsAddProvider($oldxml, $сategoryInfo = array()){
        $N_search = new SimpleXMLElement($oldxml);
        if(isset($N_search->VendorId) && !empty($N_search->VendorId)){
            return $N_search->asXML();
        }

        $searchTypes = $SearchTypes = $this->getProviderSearchMethodInfoList();
        if (! empty($сategoryInfo['SearchMethod'])) {
            $provider = $сategoryInfo['ProviderType'];
            $searchMethod = $сategoryInfo['SearchMethod'];
        } else {
            $provider = RequestWrapper::getValueSafe('Provider') ? RequestWrapper::getValueSafe('Provider') : $searchTypes[0]['Provider'];
            $searchMethod = RequestWrapper::getValueSafe('SearchMethod') ? RequestWrapper::getValueSafe('SearchMethod') : $searchTypes[0]['SearchMethod'];
        }
        if ($provider) {
            if (($provider=='China') && (strpos($searchMethod, 'Other') !== false)) {
                $N_search->Provider = 'Taobao';
                $N_search->SearchMethod = str_replace('Other', 'Extended', $searchMethod);
            } elseif ($provider=='China') {
                $N_search->Provider = 'Taobao';
                $N_search->SearchMethod = $searchMethod;
            } else {
                $N_search->Provider = $provider;
                $N_search->SearchMethod = $searchMethod;
            }
        }

        return $N_search->asXML();
    }

    private function searchParamsAddMulti($oldxml,$Provider,$SearchMethod){
        $N_search = new SimpleXMLElement($oldxml);
        if (! isset($N_search->VendorId)) {
            $N_search->Provider = $Provider;
            $N_search->SearchMethod = $SearchMethod;
        }
        return $N_search->asXML();
    }

    private function assignGlobals($foundAll){
        $GLOBALS['rootpath'] = isset($foundAll['RootPath']) && is_array($foundAll['RootPath']) ? array_reverse($foundAll['RootPath']) : array();
        $GLOBALS['categoryInfo'] = end($GLOBALS['rootpath']);
        if (@$foundAll['Items']['TranslatedItemTitle'])
            $GLOBALS['TranslatedItemTitle'] = $foundAll['Items']['TranslatedItemTitle'];

        if(RequestWrapper::getValueSafe('brand'))
            $GLOBALS['brandinfo'] = $foundAll['Brand'];
    }

    private function getIsProviderActive($сategoryInfo) {
        $IsProvider = '' ;
        if ((RequestWrapper::getValueSafe('Provider')) || (RequestWrapper::getValueSafe('id')) || (!General::getConfigValue('use_multi_search')) || (! empty($сategoryInfo['SearchMethod'])))   {
            $IsProvider = 'active';
        }
        $this->tpl->assign('IsProvider', $IsProvider);
    }

    private function assignGlobalsMulti($foundAll){
        foreach($foundAll as $found){
            if($found){
                $firstSearch = $found;
                break;
            }
        }
        $GLOBALS['rootpath'] = isset($firstSearch['RootPath']) && is_array($firstSearch['RootPath']) ? array_reverse($firstSearch['RootPath']) : array();
        if(!isset($GLOBALS['categoryInfo']))
            $GLOBALS['categoryInfo'] = end($GLOBALS['rootpath']);
        foreach ($foundAll as $one) {
            if (@$one['Items']['TranslatedItemTitle'])
                $GLOBALS['TranslatedItemTitle'] = $one['Items']['TranslatedItemTitle'];
            if(RequestWrapper::getValueSafe('brand') && @$one['Brand'])
                $GLOBALS['brandinfo'] = @$one['Brand'];
        }
    }

    private function prepareSubCategories($foundAll){
        if ($this->request->get('p') == 'subcategory')
            $subCategories = $foundAll['SubCategories'];
        else
            $subCategories = isset($foundAll['Items']['Categories']) ? $foundAll['Items']['Categories'] : array();

        if($this->cms->IsFeatureEnabled('Seo2') && is_array($subCategories)){
            try {
                $SeoCatsRepository = new SeoCategoryRepository(new CMS());
                foreach($subCategories as &$c){
                    $c['alias'] = $SeoCatsRepository->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                }
            } catch (DBException $e) {
                Session::setError($e->getMessage(), 'DBError');
            }

        }
        $this->tpl->assign('subCategories', $subCategories);
    }

    private function getProviderSearchMethodInfoList()
    {
        $this->otapilib->setErrorsAsExceptionsOn();
        try{
            $cacheExists = $this->fileMysqlMemoryCache->Exists('GetProviderSearchMethodInfoList:id' . Session::getActiveLang());
            if($cacheExists){
                $SearchTypesXML = $this->fileMysqlMemoryCache->GetCacheEl('GetProviderSearchMethodInfoList:id' . Session::getActiveLang());
            }
            else{
                $this->otapilib->setResultInXMLOn();
                $SearchTypesXML = $this->otapilib->GetProviderSearchMethodInfoList();
                $this->otapilib->setResultInXMLOff();
                $SearchTypesXML = $SearchTypesXML->asXML();
                $this->fileMysqlMemoryCache->AddCacheEl('GetProviderSearchMethodInfoList:id' . Session::getActiveLang(), 3600, $SearchTypesXML);
            }

            $searchTypes =  $this->otapilib->GetProviderSearchMethodInfoList($SearchTypesXML);
            $searchTypes = $this->getOrderedSearchTypes($searchTypes);
            return $searchTypes;

        }
        catch(ServiceException $e){
            if((string)$e->getErrorCode() != 'NotFound')
                Session::setError($e->getMessage(), $e->getErrorCode());
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }
    }

    private function getOrderedSearchTypes($searchTypes)
    {
        $fullSearchTypes = $searchTypes;
        if (General::getConfigValue('orderSearchMethods')) {
            $fullSearchTypes = array();
            $newSearchTypes = array();

            $orderedUsedSearchTypes = unserialize(General::getConfigValue('orderSearchMethods'));
            $orderedUnUsedSearchTypes = unserialize(General::getConfigValue('orderUnUsedSearchMethods'));

            foreach ($searchTypes as $type) {
                if ((! in_array($type['Provider'].'_'.$type['SearchMethod'], $orderedUsedSearchTypes))
                    and (! in_array($type['Provider'].'_'.$type['SearchMethod'], (array)$orderedUnUsedSearchTypes))) {
                        $newSearchTypes[] = $type['Provider'].'_'.$type['SearchMethod'];
                }
            }
            if (isset($newSearchTypes[0]))
                $orderedSearchTypes = array_merge((array)$orderedUsedSearchTypes, (array)$newSearchTypes);

            foreach ($orderedUsedSearchTypes as $orderedType) {
                foreach ($searchTypes as $type) {
                    if ($orderedType == $type['Provider'].'_'.$type['SearchMethod'])
                        $fullSearchTypes[] = $type;
                }
            }
        }

        return $fullSearchTypes;
    }

    private function getSearchMethods()
    {
        $SearchTypes = $this->getProviderSearchMethodInfoList();
        //подменяем типы
        $SearchTypesEdited = $SearchTypes;
        $allFeatures = array();
        foreach($SearchTypesEdited as &$SearchType){
            if (strpos($SearchType['SearchMethod'], 'Extended') !== false) {
                $SearchType['SearchMethod'] = str_replace('Extended', 'Other', $SearchType['SearchMethod']);
            }
            if ($SearchType['Provider'] == 'Taobao') {
                $SearchType['Provider'] = 'China';
            }
            foreach($SearchType['Features'] as $feature) {
                $allFeatures[] = $feature['Name'];
            }
        }
        $this->tpl->assign('SearchTypes', $SearchTypesEdited);
        $this->tpl->assign('allFeatures', $allFeatures);
        return  array('SearchTypes' => $SearchTypes, 'SearchTypesEdited' => $SearchTypesEdited);
    }

    private function getCurrentSearchType($сategoryInfo)
    {
        $CurrentSearchType = false;

        if ($this->request->get('Provider') && $this->request->get('SearchMethod')) {
            $CurrentSearchType = $this->request->get('Provider').'_'.$this->request->get('SearchMethod');
        }
        if (! empty($сategoryInfo['SearchMethod'])) {
            $CurrentSearchType = str_replace('Taobao', 'China', $сategoryInfo['ProviderType']).'_'.str_replace('Extended', 'Other', $сategoryInfo['SearchMethod']);
        }
        $this->tpl->assign('сategoryInfo', $сategoryInfo);
        $this->tpl->assign('CurrentSearchType', $CurrentSearchType);
    }

    private function prepareSubCategoriesMulti($foundAll){
        $subCategories = array();
        foreach ($foundAll as $one) {
            if ($this->request->get('p') == 'subcategory')
                $subCategories = array_merge((array)$subCategories, isset($one['SubCategories']) ? (array)$one['SubCategories'] : array());
            else
                $subCategories = array_merge((array)$subCategories, (array)$one['Items']['Categories']);
        }

        if($this->cms->IsFeatureEnabled('Seo2') && is_array($subCategories)){
            try {
                $SeoCatsRepository = new SeoCategoryRepository(new CMS());
                foreach($subCategories as &$c){
                    $c['alias'] = $SeoCatsRepository->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                }
            } catch (DBException $e) {
                Session::setError($e->getMessage(), 'DBError');
            }

        }
        $this->tpl->assign('subCategories', array_unique($subCategories,SORT_REGULAR));
    }

    private function prepareItemList($foundAll){
        $itemList = isset($foundAll['Items']['Items']) ? $foundAll['Items']['Items'] : array('data'=>array(), 'totalcount' => 0);
        /*if (count($itemList['data']) == 1 && $this->getAndAssignSearchOffset() == 0) {
            header('Location: /' . UrlGenerator::generateItemUrl($itemList['data'][0]['id']));
        }*/
        $count = $itemList['totalcount'];

        $searchTypes =  $this->getSearchMethods();
        $maxCountPagination = $itemList['totalcount'];
        foreach ($searchTypes['SearchTypesEdited'] as $type) {
            if (($type['Provider'] == RequestWrapper::getValueSafe('Provider')) and ($type['SearchMethod'] == RequestWrapper::getValueSafe('SearchMethod')) and ($itemList['totalcount'] >= $type['MaximumItemsCount'])) {
                $maxCountPagination = $type['MaximumItemsCount'];
                break;
            }
        }
        $items = $itemList['data'];
        $this->tpl->assign('itemlist', $items);
        $this->tpl->assign('totalcount', $itemList['totalcount']);
        $this->tpl->assign('count', $count);
        $this->tpl->assign('maxCountPagination', $maxCountPagination);
        $this->tpl->assign('availableSorts', isset($foundAll['searchData']['AvailableSorts']) ?
            $foundAll['searchData']['AvailableSorts'] : array());
    }

    private function prepareItemListMulti($foundAll)
    {
        $preData = $this->prePrepareItemListMulti($foundAll);
        $this->tpl->assign('itemlistMulti', $preData['itemList']);
        $lastSearchResult = end($preData['itemList']);
        $searchTypes = array_keys($preData['foundAll']);
        $lastSearchType = end($searchTypes);
        if($lastSearchResult && $lastSearchResult['totalcount'] >= 20 && count($lastSearchResult['Items']) >= 20){
            $this->tpl->assign('pagination', new Paginator($lastSearchResult['totalcount'], $page = (int)$this->request->get('page', 1), $this->getPerPageMulti($lastSearchType)));
        }
        if($this->isSearchMulti()){
            $this->tpl->assign('lastSearchProvider', isset($preData['lastSearchProvider']) ? $preData['lastSearchProvider'] : array());
        }
    }

    private function prePrepareItemListMulti($foundAll){
        $inFirst = array();
        $lastSearchProvider = array();
        $itemList = array();
        foreach ($foundAll as $key=>&$one) {
                $itemListTmp = array();
                $itemListTmp['Items'] = isset($one['Items']['Items']['data']) ? $one['Items']['Items']['data'] : array();
                $itemListTmp['totalcount'] = isset($one['Items']['Items']['totalcount']) ?  $one['Items']['Items']['totalcount'] : 0;
                if ($itemListTmp['totalcount'] > 0)
                    $itemList[$key] = $itemListTmp;

                $lastSearchProvider['key'] = $key;
                $lastSearchProvider['totalCount'] = isset($one['Items']['Items']['totalcount']) ?  $one['Items']['Items']['totalcount'] : 0;
        }
        $firstSearchResults = current($itemList);

        if ($firstSearchResults && $inFirst ) {
            $firstItemId = isset($firstSearchResults['Items'][0]['id']) ? $firstSearchResults['Items'][0]['id'] : $inFirst[0]['Id'];
            /*if (count($itemList) == 1 && $firstSearchResults['totalcount'] == 1) {
                header('Location: /' . UrlGenerator::generateItemUrl($firstItemId));
                die();
            }*/
        }
        return array(
            'itemList'           => $itemList,
            'lastSearchProvider' => $lastSearchProvider,
            'foundAll'           => $foundAll
        );
    }

    private function prepareSearchProp($foundAll){
        $searchProperties = isset($foundAll['SearchProperties']) ? $foundAll['SearchProperties'] : array();
        $this->searchProp->setSearchProperties($searchProperties, $foundAll['searchData']);
        $this->searchProp->setBaseUrl($this->clearUrl->Get());
        $this->tpl->assign('SearchProp', $this->searchProp->Generate());
    }

     private function prepareSearchPropMulti($foundAll){
        $propIds = array();
        $searchProperties = array();
        foreach ($foundAll as $one) {
            if(!isset($one['SearchProperties']))
                continue;
            foreach((array)$one['SearchProperties'] as $prop){
                if(!in_array($prop['Id'], $propIds)){
                    $propIds[] = $prop['Id'];
                    $searchProperties[] = $prop;
                }
            }
        }
        $this->searchProp->setSearchProperties($searchProperties, array());
        $this->searchProp->setBaseUrl($this->clearUrl->Get());
        $this->tpl->assign('SearchProp', $this->searchProp->Generate());
     }

    private function prepareHintCats() {
        $this->otapilib->setErrorsAsExceptionsOff();

        if (!RequestWrapper::getValueSafe('search')) {
            $this->tpl->assign('hintcats', array());
        } else {
            $categoriesResult = $this->otapilib->FindHintCategoryInfoList(RequestWrapper::getValueSafe('search'));
            if (!is_array($categoriesResult))
                $categoriesResult = array();

            if(in_array('Seo2', General::$enabledFeatures)){
                try {
                    $SeoCatsRepository = new SeoCategoryRepository(new CMS());
                    if(is_array($categoriesResult))
                    foreach($categoriesResult as &$c){
                        $c['alias'] = $SeoCatsRepository->getCategoryAlias($c['Id'], true, $c['Name']);
                    }
                } catch (DBException $e) {
                    Session::setError($e->getMessage(), 'DBError');
                }

            }

            $this->tpl->assign('hintcats', $categoriesResult);
        }
    }

    private function CheckSearch(){
        if ( ($this->request->get('search')!='') && ($this->request->get('cid')=='') && General::getConfigValue('restriction_of_search') ) {
            return array('search' => false, 'reason' => 'category_not_selected');
        }

        if (($this->request->get('cid')=='') && ($this->request->get('search')=='') && ($this->request->get('brand')=='') && ($this->request->get('id')=='') && ($this->request->get('vid')=='')) {
            return array('search' => false, 'reason' => SCRIPT_NAME);
        } else {
            return array('search' => true, 'reason' => 'no');
        }
    }

    private function CheckMultiSearch($сategoryInfo){
        if (isset($сategoryInfo['SearchMethod'])) {
            $isCategorySearchMethod = $сategoryInfo['SearchMethod'] == '' ? false : true;
        } else {
            $isCategorySearchMethod = false;
        }
        if ($this->request->get('id')=='' && ($this->request->get('Provider')=='') && (General::getConfigValue('use_multi_search')) && (! $isCategorySearchMethod)) {
            return true;
        } else {
            return false;
        }
    }

    private function isChina(){
        $alowedIps = json_decode(General::getConfigValue('ip_access_to_search', json_encode(array())), true);
        if (in_array($_SERVER['SERVER_ADDR'], $alowedIps)) {
            return false;
        }
        if(!$this->cms->tableExists('ip2c')){
            chdir(CFG_APP_ROOT . '/lib/ip2country/');
            require_once 'import.php';
            chdir(CFG_APP_ROOT);
        }

        chdir(CFG_APP_ROOT . '/lib/ip2country/');
        require_once 'ip2country.php5.php';

        $ip2c=new ip2country();
        $ip2c->mysql_host=DB_HOST;
        $ip2c->db_user=DB_USER;
        $ip2c->db_pass=DB_PASS;
        $ip2c->db_name=DB_BASE;
        $ip2c->table_name='ip2c';
        chdir(CFG_APP_ROOT);

        return $ip2c->get_country_code() == 'CN';
    }

    private function getAndAssignSearchTypesInfo($searchParametersHash)
    {
        if ($this->fileMysqlMemoryCache->Exists('multi_search:'.$searchParametersHash)) {
            $cachedSearchTypesInfo = json_decode($this->fileMysqlMemoryCache->GetCacheEl('multi_search:'.$searchParametersHash), true);
            $preData = $this->prePrepareItemListMulti($cachedSearchTypesInfo);
            $this->tpl->assign('cachedSearchTypesInfo', $preData['itemList']);
        }
    }

    private function getCookiePerPage($searchType, $default)
    {
        return Cookie::get($searchType . '_perPageValue', $default);
    }

    private function setCookiePerPage($searchType, $value)
    {
        Cookie::set($searchType . '_perPageValue', $value, time()+86400*30, '/');
    }

    private function getCountOfItemsByFilter()
    {
        $categoryItemFilter = $this->searchParams();
        $categoryItemFilter = $this->searchParamsAddited($categoryItemFilter);
        $categoryItemFilter = $this->searchParamsAddProvider($categoryItemFilter);
        $newCategoryFilter = Plugins::invokeEvent('newCategoryFilterXML', array('xml' =>$categoryItemFilter));
        if ($newCategoryFilter)
            $categoryItemFilter = $newCategoryFilter;
        $searchXml = simplexml_load_string($categoryItemFilter);
        $SearchTypes = $this->getSearchMethods();
        $foundAll = $this->getCountOfSimpleItems($categoryItemFilter, $SearchTypes['SearchTypes']);
        if (($foundAll) && (! empty($foundAll['Items']['Items']['totalcount']))) {
            print json_encode(array('Success'=>'Ok', 'Count' => $foundAll['Items']['Items']['totalcount']));
        } else {
            print json_encode(array('Success'=>'Ok', 'Count' => ' - '));
        }
        die;
    }

    private function getCountOfSimpleItems($categoryItemFilter, $SearchTypes){
        $this->otapilib->setErrorsAsExceptionsOn();
        $foundAll = false;
        $N_search = new SimpleXMLElement($categoryItemFilter);
        $N_search->OutputMode = 'TotalCount';

        $searchData = array();
        foreach ($SearchTypes as $type) {
            if (($type['Provider']==$N_search->Provider) && ($type['SearchMethod']==$N_search->SearchMethod)){
                $searchData = $type;
                break;
            }
        }
        try {
            if (! isset($searchData['Configurators'])) {
                $searchData['Configurators'] = false;
            }
            $foundAll = $this->otapilib->BatchSearchItemsFrame(session_id(), $N_search->asXML(), 0, 1, $this->checkCacheAndGetBlockList($searchData['Configurators']));
        }
        catch (ServiceException $e) {
            if ((string)$e->getErrorCode() != 'NotFound') {
                print json_encode(array('Success'=>'', 'message' => $e->getErrorMessage()));
                return false;
            }
        }
        catch(Exception $e){
            print json_encode(array('Success'=>'', 'message' => $e->getMessage()));
            return false;
        }
        return $foundAll;
    }

}
