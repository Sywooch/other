<?php

OTBase::import('system.lib.startup_scripts.MainPage');

class ItemSetsNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemsetsnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    /**
     * @var VendorRepository
     */
    private $vendorRepository;
    /**
     * @var ReviewsRepository
     */
    private $reviewsRepository;

    private $logger;

    public function __construct()
    {
        parent::__construct(true);
        $this->otapilib->setErrorsAsExceptionsOn();

        $this->vendorRepository = new VendorRepository($this->cms);
        $this->reviewsRepository = new ReviewsRepository($this->cms);
        $this->pristroyRepository = new PristroyRepository($this->cms);

        $this->logger = new Logger($this->cms);
    }

    protected function setVars()
    {
        $this->assignRatingListsFromOtapiToTemplate();

        if (CMS::IsFeatureEnabled('FleaMarket')) {
            $this->tpl->assign('pristroy_items', $this->getPristroyItems());
        }
        $this->tpl->assign('items_with_comments', $this->getItemsWithReviews());
    }

    public function assignRatingListsFromOtapiToTemplate()
    {
        $this->tpl->assign('best_items', $this->getBestItems());
        $this->tpl->assign('popular_items', $this->getPopularItems());
        $this->tpl->assign('last_viewed_items', $this->getLastViewedItems());
        $this->tpl->assign('brands_list', $this->getBestBrands());
        $this->tpl->assign('vendors', $this->getBestVendors());
        $this->tpl->assign('warehouse_items', $this->getWarehouseItems());
        $this->tpl->assign('currency', $this->getCurrency());
        $this->tpl->assign('warehouse_title', $this->getWarehouseTitle());

    }

    protected function getWarehouseTitle()
    {
        $result = Lang::get("Warehouse_goods");
        try {
            // Получим название с сервисов, если нет перевода
            if ($result === "Warehouse_goods") {
                $cacheKey = MainPage::getCacheKey('getWarehouseTitle', MainPage::getWarehouseItemsParams());
                if (! $this->fileMysqlMemoryCache->Exists($cacheKey)) {
                    $category = $this->otapilib->GetCategoryInfo('wh-0');
                    if ($category && ! empty($category['name'])) {
                        $result = $category['name'];
                        $this->fileMysqlMemoryCache->AddCacheEl($cacheKey, 600, $result);
                    }
                } else {
                    $result = $this->fileMysqlMemoryCache->GetCacheEl($cacheKey);
                }
            }
        }
        catch (Exception $e) {
            if (OTBase::isTest()) {
                throw $e;
            } else {
                $message = $e instanceof ServiceException ? $e->getErrorMessage() : $e->getMessage();
                $this->logger->log($message, array(__METHOD__), 'SET_ERROR');
            }
        }
        return $result;
    }

    protected function getWarehouseItems()
    {
        $items = array();
        try {
            $items = $this->_getSetFromOtapi('GetItemRatingList', MainPage::getWarehouseItemsParams());
        }
        catch (Exception $e) {
            if (OTBase::isTest()) {
                throw $e;
            } else {
                $message = $e instanceof ServiceException ? $e->getErrorMessage() : $e->getMessage();
                $this->logger->log($message, array(__METHOD__), 'SET_ERROR');
            }
        }
        return $items;
    }

    protected function getPristroyItems()
    {
        $itemsCount = General::getConfigValue('items_with_pristroy', 8);
        $items = $itemsCount ? $this->pristroyRepository->getList(0, $itemsCount) : array();
        return !empty($items['data']) ? $items['data'] : array();
    }

    private function _getSetFromOtapi($otapiMethod, $params)
    {
        $list = array();
        if (empty($params['count'])) {
            return array();
        }

        try {
            $cacheId = MainPage::getCacheKey($otapiMethod, array_values($params));
            if (! $this->fileMysqlMemoryCache->Exists($cacheId)) {
                MainPage::updateCache();
            }
            if ($this->fileMysqlMemoryCache->Exists($cacheId)) {
                $resultXML = $this->fileMysqlMemoryCache->GetCacheEl($cacheId);
                $list = $this->otapilib->$otapiMethod($params['type'], $params['count'], $params['catId'], Session::get('active_lang'), $resultXML);
            } else {
                throw new Exception('Could not update main page info.');
            }
        }
        catch (Exception $e) {
            if (OTBase::isTest()) {
                throw $e;
            } else {
                $this->logger->log($e->getMessage(), array_merge(array($otapiMethod), $params), 'SET_ERROR');
            }
        }
        return ($list !== false) ? $list : array();
    }

    public function getBestItems()
    {
        return $this->_getSetFromOtapi('GetItemRatingList', MainPage::getBestItemsParams());
    }

    public function getPopularItems()
    {
        return $this->_getSetFromOtapi('GetItemRatingList', MainPage::getPopularItemsParams());
    }

    public function getLastViewedItems()
    {
        return $this->_getSetFromOtapi('GetItemRatingList', MainPage::getLastItemsParams());
    }

    public function getBestBrands()
    {
        return $this->_getSetFromOtapi('GetBrandRatingList', MainPage::getBrandsItemsParams());
    }

    public function getBestVendors()
    {
        $vendors = $this->_getSetFromOtapi('GetVendorRatingList', MainPage::getVendorsItemsParams());
        if (isset($vendors[0])) {
            $vendorsWithFullInfo = $this->appendInfoToVendorsFromDB($vendors);
        } else {
            $vendorsWithFullInfo = array();
        }
        return $vendorsWithFullInfo;
    }

    public function getItemsWithReviews()
    {
        $list = array();
        $params = MainPage::getReviewsItemsParams();
        if (! empty($params['count'])) {
            $cacheId = MainPage::getCacheKey('ItemsWithReviews', $params);
            if (! $this->fileMysqlMemoryCache->Exists($cacheId)) {
                MainPage::updateCache();
            }
            if ($this->fileMysqlMemoryCache->Exists($cacheId)) {
                $resultXML = $this->fileMysqlMemoryCache->GetCacheEl($cacheId);
                $list = $this->otapilib->GetItemInfoList('', $resultXML);
            }
        }
        return $list;
    }

    private function appendInfoToVendorsFromDB($vendors)
    {
        if (! is_array($vendors)) {
            return array();
        }
        foreach ($vendors as &$vendor) {
            $info = $this->getVendorInfoFromDB($vendor['Id']);
            $vendor['image_path'] = $info['image_path'];
            $vendor['vendor_name'] = $info['vendor_name'];
        }
        return $vendors;
    }

    private function getVendorInfoFromDB($vendorId)
    {
        $vendorInfoFromDB = $this->vendorRepository->GetVendorInfo($vendorId, Session::getActiveLang());
        return isset($vendorInfoFromDB[0]) ? $vendorInfoFromDB[0] : array('image_path' => '', 'vendor_name' => '');
    }

    private function getCurrency()
    {
        $cacheKey = 'GetCurrency:GetCurrency_General';
        if ($this->fileMysqlMemoryCache->Exists($cacheKey)) {
            $currencyXml = $this->fileMysqlMemoryCache->GetCacheEl($cacheKey);
        } else {
            $this->otapilib->setResultInXMLOn();
            try {
                $currencyXml = $this->otapilib->GetCurrency();
                if ($currencyXml === false) {
                    throw new ServiceException(__METHOD__, 0, 'Set error', 'SetError');
                }
            } catch (ServiceException $e) {
                $this->fileMysqlMemoryCache->updateLifeTime($cacheKey, 120);
                if (OTBase::isTest()) {
                    throw $e;
                } else {
                    $this->logger->log($e->getErrorMessage(), array(__METHOD__), 'SET_ERROR');
                }
                return array();
            }
            $currencyXml = $currencyXml->asXML();
            $this->fileMysqlMemoryCache->AddCacheEl($cacheKey, 600, $currencyXml);
            $this->otapilib->setResultInXMLOff();
        }
        return $this->otapilib->GetCurrency($currencyXml);
    }
}
