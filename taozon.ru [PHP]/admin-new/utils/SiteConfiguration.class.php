<?php

OTBase::import('system.uploader.php.UploadHandler');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');
OTBase::import('system.admin-new.utils.CacheSettings');

class SiteConfiguration extends GeneralUtil
{
    const MAX_NEWS_COUNT = 300;
    const MAX_VENDORS_COUNT = 20;
    const MAX_BEST_BRANDS_COUNT = 20;
    const MAX_BEST_ITEMS_COUNT = 200;
    const MAX_LAST_ITEMS_COUNT = 30;
    const MAX_ITEMS_REVIEWED_COUNT = 20;
    const MAX_ITEMS_OFICIAL_CATALOG = 200;
    const MAX_ITEMS_EXTENDED_CATALOG = 200;
    const MAX_ITEMS_WAREHOUSE_CATALOG = 200;
    const MAX_ITEMS_COMMENTS_CATALOG = 100;
    const MIN_ITEMS_COUNT = 16;

    const CATALOG_MODE_EXTERNAL = 'External';
    const CATALOG_MODE_INTERNAL = 'InternalLeaf';
    const CATALOG_MODE_PREDEFINED = 'Predefined';
    const CATALOG_MODE_MIXED = 'LeafMixed';

    protected $_template = 'site_construction';
    protected $_template_path = 'site_config/';

    /**
     * @var OrderSettings
     */
    protected $orderSettings;
    /**
     * @var ShipmentProvider
     */
    protected $shipmentProvider;

    /**
     * @var InstanceOptionsInfo
     */
    protected $instanceOptionsInfo;

    protected $webUISettings;

    protected $config;

    /**
     * @var TranslationsRepository
     */
    protected $translationsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->cms->checkTable('site_config');
        $this->cms->checkTable('site_langs');
        $this->orderSettings = new OrderSettings($this->getOtapilib());
        $this->shipmentProvider = new ShipmentProvider($this->getOtapilib());
        $this->translationsRepository = new TranslationsRepository($this->cms);
        $this->instanceOptionsInfo = new InstanceOptionsInfo($this->otapilib);
        $this->webUISettings = new WebUISettings($this->getOtapilib());
        $this->config = new SiteConfigurationRepository($this->cms);
        $this->config->SetActiveLang(Session::get('active_lang_siteconfiguration'));
    }

    public function defaultAction($request)
    {
        $this->assignSearchProvidersConfig();
        $this->assignAvailableSiteThemes();
        $this->assignCategoryStructureTypeSetting();

        $this->tpl->assign('Showcase', $this->shipmentProvider->GetShowCase());
        $this->tpl->assign('config', $this->config);

        print $this->fetchTemplate();
    }

    public function getConfigInJSAction()
    {
        $this->_template_path = 'site_config/';
        $this->_template = 'config_js';
        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    public function ordersAction($request)
    {
        $this->_template_path = 'site_config/orders/';
        $this->_template = 'general';
        try {
            $this->tpl->assign('OrderSettings', $this->orderSettings->Get());
            $this->tpl->assign('Showcase', $this->shipmentProvider->GetShowCase());
        }
        catch (Exception $e) {
            $this->tpl->assign('OrderSettings', false);
            $this->tpl->assign('Showcase', false);
            ErrorHandler::registerError($e);
        }
        $this->langRepository = new LanguageRepository($this->cms);
        $CMSLanguages = $this->langRepository->GetLanguages();
        $langCodes = array();
        foreach ($CMSLanguages as $l) {
            $langCodes[] = $l['lang_code'];
        }
        $this->tpl->assign('langCodes', $langCodes);
        $this->tpl->assign('config', $this->config);
        print $this->fetchTemplate();
    }

    public function bankAction($request)
    {
        $this->_template_path = 'site_config/orders/';
        $this->_template = 'bank';
        $this->tpl->assign('config', $this->config);
        print $this->fetchTemplate();
    }

    public function saveLogoAction($request)
    {
        try {
            if ($request->getValue('delete_logo')) {
                $this->config->Set('logo', '');
                $logoUrl = '/i/logo.png';
            } else {
                if (empty($_FILES['uploaded_logo']['tmp_name'])) {
                    $this->respondAjaxError('No image was selected to upload.');
                }
                $uploadResult = $this->uploadImage();
                if (isset($uploadResult['uploaded_logo'][0])) {
                    if (isset($uploadResult['uploaded_logo'][0]->url)) {
                        $logoUrl = $uploadResult['uploaded_logo'][0]->url;
                        $this->config->Set('logo', $logoUrl);
                    } else if (isset($uploadResult['uploaded_logo'][0]->error)) {
                        $this->respondAjaxError($uploadResult['uploaded_logo'][0]->error);
                    }
                } else {
                    $this->respondAjaxError('Unknown error occured while uploading image. Try again.');
                }
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array(
            'logoUrl' => $logoUrl,
        ));
    }

    public function systemAction()
    {
        $this->_template_path = 'site_config/system/';
        $this->_template = 'general';
        print $this->fetchTemplate();
    }

    private function assignCategoryStructureTypeSetting(){
        $webUi = $this->webUISettings->GetWebUISettings();
        $this->tpl->assign('categoryStructureType', (string)$webUi->Settings->SelectedCategoryStructureType);
    }

    private function getSearchType($searchType) {
        $searchType = str_replace('Taobao_Extended', 'China_Other', $searchType);
        $searchType =  str_replace('Taobao', 'China', $searchType);
        return $searchType;
    }

    private function assignSearchProvidersConfig()
    {
        try {
            $searchMethods = $this->otapilib->GetProviderSearchMethodInfoList();
        } catch (ServiceException $e) {
            $searchMethods = array();
            Session::setError($e->getMessage(), $e->getErrorCode());
        }

        $newSearchMethods = array();
        $searchMethodsList = array();
        foreach ($searchMethods as $method) {
            if ($method['Provider'] == 'Warehouse' && !CMS::IsFeatureEnabled('Warehouse')) {
                 continue;
            }
            $providerMethod = $method['Provider'] . '_' . $method['SearchMethod'];
            $newSearchMethods[] = $providerMethod;
            $providerMethod = $this->getSearchType($providerMethod);
            $searchMethodsList[$providerMethod] = $method;
            // если есть перевод названия поиска - берем перевод, иначе название берется с сервисов
            if (Lang::get($providerMethod.'_Flag') != $providerMethod.'_Flag') {
                $searchMethodsList[$providerMethod]['DisplayName'] = Lang::get($providerMethod.'_Flag');
            }
        }

        $usedSearchSettings = General::getConfigValue('orderSearchMethods') ?
            unserialize(General::getConfigValue('orderSearchMethods')) :
            $newSearchMethods;

        $unUsedSearchSettings = unserialize(General::getConfigValue('orderUnUsedSearchMethods'));
        $unUsedSearchSettings = is_array($unUsedSearchSettings) ? array_unique($unUsedSearchSettings) : array();

        $newSearchSettings = array();
        foreach ($newSearchMethods as $type) {
            if ((! in_array($type, (array)$usedSearchSettings)) && (! in_array($type, (array)$unUsedSearchSettings))) {
                $newSearchSettings[] = $type;
            }
        }
        if (count($newSearchSettings)) {
            $usedSearchSettings = array_merge((array)$usedSearchSettings, ($newSearchSettings));
        }
        $newUsedSearchSettings = array();
        foreach ($usedSearchSettings as &$searchType) {
            if ($searchType == 'Warehouse_Default' && !CMS::IsFeatureEnabled('Warehouse')) {
                continue;
            }
            $searchType = str_replace('Taobao_Extended', 'China_Other', $searchType);
            $searchType =  str_replace('Taobao', 'China', $searchType);
            $newUsedSearchSettings[] = $searchType; 
        }
        $usedSearchSettings = $newUsedSearchSettings;
        
        if (is_array($unUsedSearchSettings)) {
            foreach ($unUsedSearchSettings as &$searchType) {
                $searchType = str_replace('Taobao_Extended', 'China_Other', $searchType);
                $searchType =  str_replace('Taobao', 'China', $searchType);
            }
        }


        $this->tpl->assign('searchMethodsList', $searchMethodsList);
        $this->tpl->assign('usedSearchSettings', $usedSearchSettings);
        $this->tpl->assign('unUsedSearchSettings', $unUsedSearchSettings);
    }

    private function assignAvailableSiteThemes(){
        $themes = array();
        $themesCustom = array();
        $themes[] = array(
            'image' => 'css/theme-default.jpg',
            'image_preview' => 'css/theme-default-preview.jpg',
            'name' => '',
            'title' => 'Стандарт',
        );
        foreach (glob(CFG_APP_ROOT . '/css/theme/*') as $themeDir) {
            if (strripos($themeDir, 'custom-') === false) {
                $themeDirInfo = pathinfo($themeDir);
                $themeTitle = file_exists($themeDir . '/name.txt') ? file_get_contents($themeDir . '/name.txt') : 'Untitled';
                $themes[] = array(
                    'image' => 'css/theme/' . $themeDirInfo['filename'] . '/' . $themeDirInfo['filename'] . '.jpg',
                    'image_preview' => 'css/theme/' . $themeDirInfo['filename'] . '/' . $themeDirInfo['filename'] . '-preview.jpg',
                    'name' => $themeDirInfo['filename'],
                    'title' => $themeTitle,
                );
            } else {
                $themeDirInfo = pathinfo($themeDir);
                $themesCustom[] = array(
                    'image' => 'css/theme/' . $themeDirInfo['filename'] . '/' . $themeDirInfo['filename'] . '.jpg',
                    'image_preview' => 'css/theme/' . $themeDirInfo['filename'] . '/' . $themeDirInfo['filename'] . '-preview.jpg',
                    'name' => $themeDirInfo['filename'],
                    'title' => file_get_contents($themeDir . '/name.txt'),
                );
            }
        }
        $this->tpl->assign('availableSiteThemes', $themes);
        $this->tpl->assign('availableCustomSiteThemes', $themesCustom);
    }

    private function onOficialCatalogPerpageValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_ITEMS_OFICIAL_CATALOG) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_ITEMS_OFICIAL_CATALOG));
            return false;
        }
        if (intval($value) < self::MIN_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => self::MIN_ITEMS_COUNT));
            return false;
        }
        return true;
    }

    private function onExtendedCatalogPerpageValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_ITEMS_EXTENDED_CATALOG) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_ITEMS_EXTENDED_CATALOG));
            return false;
        }
        if (intval($value) < self::MIN_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => self::MIN_ITEMS_COUNT));
            return false;
        }
        return true;
    }

    private function onWarehouseCatalogPerpageValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_ITEMS_WAREHOUSE_CATALOG) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_ITEMS_WAREHOUSE_CATALOG));
            return false;
        }
        if (intval($value) < self::MIN_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => self::MIN_ITEMS_COUNT));
            return false;
        }
        return true;
    }

    private function onCommentsCatalogPerpageValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_ITEMS_COMMENTS_CATALOG) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_ITEMS_COMMENTS_CATALOG));
            return false;
        }
        if (intval($value) < self::MIN_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => self::MIN_ITEMS_COUNT));
            return false;
        }
        return true;
    }

    private function validateValues($request)
    {
        $name = $request->getValue('name');
        $value = $request->getValue('value');
        $name = explode('_', $request->getValue('name'));
        foreach ($name as &$n) {
            $n = ucfirst($n);
        }
        $name = implode('', $name);
        if (method_exists($this, 'on' . $name . 'Validate')) {
            return call_user_func(array($this, 'on' . $name . 'Validate'), $value);
        }

        return true;
    }

    private function onMinOrderCostValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    private function onItemsWithCommentsValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_ITEMS_REVIEWED_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_ITEMS_REVIEWED_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    private function onNewsCountPrintValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_NEWS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_NEWS_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    private function onItemsWithVendorValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }

        if (intval($value) > self::MAX_VENDORS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_VENDORS_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    private function onBrandWithBestValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_BEST_BRANDS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_BEST_BRANDS_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    private function onItemsWithBestValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_BEST_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_BEST_ITEMS_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }


    private function onItemsWithLastValidate($value)
    {
        if (! is_numeric($value)) {
            $this->respondAjaxError(LangAdmin::get("Value_must_be_numeric"));
            return false;
        }
        if (intval($value) > self::MAX_LAST_ITEMS_COUNT) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("High_limit_is_exceeded"), 'newValue' => self::MAX_LAST_ITEMS_COUNT));
            return false;
        }
        if (intval($value) < 0) {
            $this->sendAjaxResponse(array('error' => 1, 'message' => LangAdmin::get("Low_limit_is_exceeded"), 'newValue' => 0));
            return false;
        }
        return true;
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveAction($request)
    {
        if (! $this->validateValues($request)) {
            return false;
        }

        $name = explode('_', $request->getValue('name'));
        foreach ($name as &$n) {
            $n = ucfirst($n);
        }
        $name = implode('', $name);
        if (method_exists($this, 'before' . $name . 'Save')) {
            $result = call_user_func(array($this, 'before' . $name . 'Save'), $request);
            if (isset($result['continue']) && $result['continue'] == false) {
                $this->respondAjaxError($result['message']);
                return false;
            }
        }

        $this->config->Set($request->getValue('name'), $request->getValue('value'));

        if (method_exists($this, 'on' . $name . 'Save')) {
            call_user_func(array($this, 'on' . $name . 'Save'), $request);
        }

        $this->sendAjaxResponse(array(
            'result' => 'ok',
        ));
    }

    public function onLimitItemsByCatalogSave($request)
    {
        $request->set('LimitItemsByCatalog', $request->getValue('value'));
        $this->shipmentProvider->SaveCase($request);
        /**
         * Если выставлен запрет, то необходимо сменить на Internal
        */
        if ($request->getValue('LimitItemsByCatalog') == 1) {
            if ($this->config->Get('search_category_mode') == self::CATALOG_MODE_EXTERNAL) {
                $this->config->Set('search_category_mode', self::CATALOG_MODE_INTERNAL);
            }
        }
    }

    public function beforeSearchCategoryModeSave($request)
    {
        $result = array('continue' => true);
        $showCase = $this->shipmentProvider->GetShowCase();
        if ($showCase->Settings->LimitItemsByCatalog == 'true') {
            if ($request->getValue('value') == self::CATALOG_MODE_EXTERNAL) {
                $result = array(
                    'continue'  => false,
                    'message'   => LangAdmin::get('Select_catalog_limit_error'));
            }
        }

        return $result;
    }

    public function onStructureTypeSave($request)
    {
        $this->webUISettings->SetCategoryMode($request->getValue('value'));
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveOrderSettingsAction($request)
    {
        if (! $this->validateValues($request)) {
            return false;
        }

        $this->orderSettings->Set($request->getValue('name'), $request->getValue('value'));
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveShowcaseAction($request)
    {
        try {
            $request->set($request->getValue('name'), $request->getValue('value'));
            $this->shipmentProvider->SaveCase($request);
        } catch (Exception $e) {
            $this->respondAjaxError($e);
        }
        $this->sendAjaxResponse();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveBankAction($request)
    {
        $bankForm = $request->getValue('bank');
        if (! is_array($bankForm)) {
            $this->respondAjaxError('Invalid form data given.');
        }
        $validator = new Validator(array(
            'name_of_payee'              => $bankForm['name_of_payee'],
            'INN_of_payee'               => $bankForm['INN_of_payee'],
            'account_number_of_payee'    => $bankForm['account_number_of_payee'],
            'bank_name_of_payee'         => $bankForm['bank_name_of_payee'],
            'bank_identification_code'   => $bankForm['bank_identification_code'],
            'correspondent_bank_account' => $bankForm['correspondent_bank_account'],
            'description_of_payment'     => $bankForm['description_of_payment']
        ));
        $validator->addRule(new NotEmptyString(), 'name_of_payee', LangAdmin::get('Field_must_be_filled'));
        $validator->addRule(new NotEmptyString(), 'bank_name_of_payee', LangAdmin::get('Field_must_be_filled'));
        $validator->addRule(new NotEmptyString(), 'description_of_payment', LangAdmin::get('Field_must_be_filled'));
        $validator->addRule(new Regexp('#^(\d{10}|\d{12})$#'), 'INN_of_payee', LangAdmin::get('Inn_must_be_10_12_numbers'));
        $validator->addRule(new Regexp('#^\d{20}$#'), 'account_number_of_payee', LangAdmin::get('Account_payee_must_be_20_numbers'));
        $validator->addRule(new Regexp('#^\d{20}$#'), 'correspondent_bank_account', LangAdmin::get('Correspond_account_must_be_20_numbers'));
        $validator->addRule(new Regexp('#^\d{8,9}$#'), 'bank_identification_code', LangAdmin::get('BIK_must_be_8_9_numbers'));

        if (! $validator->validate()) {
            $this->respondAjaxError($validator->getErrors());
        }
        try {
            foreach ($validator->getData() as $key => $value) {
                $this->config->Set($key, $value);
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e);
        }
        $this->sendAjaxResponse();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveSearchOrderAction($request)
    {

        $usedSearchMethods = $request->getValue('usedSearchs');
        $unUsedSearchMethods = $request->getValue('unUsedSearchs');
        foreach($usedSearchMethods as &$searchType){
            $searchType = str_replace('China_Other', 'Taobao_Extended', $searchType);
            $searchType = str_replace('China', 'Taobao', $searchType);
        }
        if (is_array($unUsedSearchMethods)) {
            foreach($unUsedSearchMethods as &$searchType){
                $searchType = str_replace('China_Other', 'Taobao_Extended', $searchType);
                $searchType = str_replace('China', 'Taobao', $searchType);
            }
        } else {
            $unUsedSearchMethods = array();
        }
        $newParam  = array();
        if (is_array($usedSearchMethods)) {
            $newParam['orderSearchMethods'] = serialize($usedSearchMethods);
        }
        if (is_array($unUsedSearchMethods)) {
            $newParam['orderUnUsedSearchMethods'] = serialize($unUsedSearchMethods);
        }
        $this->cms->saveSiteConfig($newParam);
        $fileMysqlMemoryCache = new FileAndMysqlMemoryCache($this->cms);
        $fileMysqlMemoryCache->DelCacheEl('GetProviderSearchMethodInfoList:id');
        // очищаем весь кэш
        $cacheSettings = new CacheSettings();
        $cacheSettings->cacheCleanAction();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveSearchTitleAction($request)
    {
        $searchProvider = $request->getValue('search_provider');
        $searchTitle = $this->escape($request->getValue('search_title'));

        $validator = new Validator(array(
            'search_provider' => $searchProvider,
            'search_title'    => $searchTitle,
        ));
        $validator->addRule(new NotEmptyString(), 'search_provider', LangAdmin::get('Field_must_be_filled'));
        $validator->addRule(new NotEmptyString(), 'search_title', LangAdmin::get('Field_must_be_filled'));

        if (! $validator->validate()) {
            $this->respondAjaxError($validator->getErrors());
        }
        try {
            $key = $searchProvider . '_Flag';
            if (Session::get('active_lang_siteconfiguration')) {
                $lang = Session::get('active_lang_siteconfiguration');
            } else {
                $lang = Session::getActiveAdminLang();
            }
            $translations = array($lang => $searchTitle);
            $this->translationsRepository->AddTranslation($key, $translations);
        } catch (Exception $e) {
            $this->respondAjaxError($e);
        }
        $this->sendAjaxResponse();
    }

    // TODO: Убрать дублирование с WarehouseProducts::uploadImage
    private function uploadImage()
    {
        $uploader = new UploadHandler(array(
            'param_name' => 'uploaded_logo',
            'image_versions' => array(
                '' => array(
                    'max_width' => 300,
                    'max_height' => 100,
                    'jpeg_quality' => 95
                ),
            ),
        ), false, null, '/uploaded/logo/');
        return $uploader->post(false);
    }

    public function onMenuCountLvl1Save()
    {
        $this->onMenuTypeSave();
    }

    public function onMenuCountLvl2Save()
    {
        $this->onMenuTypeSave();
    }

    public function onMenuTypeSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/menushortnew');
    }

    public function onUseMultiSearchSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');
    }

    public function onSimpleSearchPerpageSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');
    }

    public function onTmallSearchPerpageSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');
    }

    public function onWarehouseSearchPerpageSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');
    }

    public function onCommentsSearchPerpageSave()
    {
        Cacher::rRmDir(CFG_APP_ROOT . '/cache/multi_search');
    }

    public function contentsAction($request)
    {
        $this->_template_path = 'site_config/contents/';
        $this->_template = 'contents';
        print $this->fetchTemplate();    }


    public function usersAction()
    {
        $this->_template_path = 'site_config/users/';
        $this->_template = 'general';

        try {
            $this->tpl->assign('IsEmailConfirmationUsed', $this->instanceOptionsInfo->GetIsEmailConfirmationUsed());
            $this->tpl->assign('commonInstanceOptions', $this->instanceOptionsInfo->GetCommonInstanceOptionsInfo());
        } catch (Exception $e) {
            $this->tpl->assign('IsEmailConfirmationUsed', false);
            $this->tpl->assign('commonInstanceOptions', false);
            ErrorHandler::registerError($e);
        }
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveInstanceOptionsAction($request)
    {
        try {
            $request->set($request->getValue('name'), $request->getValue('value'));
            $this->instanceOptionsInfo->SaveOptions($request);
            $this->getOtapilib()->ResetInstanceCaches();
        } catch (Exception $e) {
            $this->respondAjaxError($e);
        }
        $this->sendAjaxResponse();
    }
}
