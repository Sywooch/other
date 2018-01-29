<?php

OTBase::import('system.lib.FileAndMysqlMemoryCache');
OTBase::import('system.lib.CMS');
OTBase::import('system.lib.General');
OTBase::import('system.lib.Logger');
OTBase::import('system.lib.Session');
OTBase::import('system.otapilib2.OTAPILib2');
OTBase::import('system.otapilib2.types.OtapiAnswer');

class MainPage
{
    private static $cacheDir = 'mainpage';
    private static $cacheFile = 'backup.dat';

    public static function backup($pageHtml = null)
    {
        if (isset($_GET['__backup_main_page_process'])) {
            return;
        }

        $dir = self::getCacheDir();

        try {
            if (! $pageHtml) {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . '/?__backup_main_page_process';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
                $pageHtml = curl_exec($ch);
                if (curl_errno($ch)) {
                    $pageHtml = null;
                }
                curl_close($ch);
            }

            $isPageLoaded =
                (strpos($pageHtml, 'data-info="side-menu-loaded"') !== false) &&
                (strpos($pageHtml, 'data-info="index-sets-loaded"') !== false) &&
                (strpos($pageHtml, 'data-info="index-footer-loaded"') !== false);

            if ($isPageLoaded) {
                file_put_contents($dir . '/' . self::$cacheFile, $pageHtml);
            }

        } catch (Exception $e) {}
    }

    public static function updateCache()
    {
        $cms = new CMS();
        $cache = new FileAndMysqlMemoryCache($cms);
        $logger = new Logger($cms);

        $languge = Session::getActiveLang();
        $needMakeRequests = false;

        $bestItems = null;
        $params = self::getBestItemsParams();
        $bestCacheKey = self::getCacheKey('GetItemRatingList', array_values($params));
        if (! $cache->Exists($bestCacheKey)) {
            OTAPILib2::GetItemRatingList($languge, $params['type'], $params['count'], $params['catId'], $bestItems);
            $needMakeRequests = true;
        }
        
        $warehouseItems = null;
        $params = self::getWarehouseItemsParams();
        $warehouseCacheKey = self::getCacheKey('GetItemRatingList', array_values($params));
        if (! $cache->Exists($warehouseCacheKey)) {
            OTAPILib2::GetItemRatingList($languge, $params['type'], $params['count'], $params['catId'], $warehouseItems);
            $needMakeRequests = true;
        }

        $lastItems = null;
        $params = self::getLastItemsParams();
        $lastCacheKey = self::getCacheKey('GetItemRatingList', array_values($params));
        if (! $cache->Exists($lastCacheKey)) {
            OTAPILib2::GetItemRatingList($languge, $params['type'], $params['count'], $params['catId'], $lastItems);
            $needMakeRequests = true;
        }

        $popularItems = null;
        $params = self::getPopularItemsParams();
        $popularCacheKey = self::getCacheKey('GetItemRatingList', array_values($params));
        if (! $cache->Exists($popularCacheKey)) {
            OTAPILib2::GetItemRatingList($languge, $params['type'], $params['count'], $params['catId'], $popularItems);
            $needMakeRequests = true;
        }

        $brandsItems = null;
        $params = self::getBrandsItemsParams();
        $brandsCacheKey = self::getCacheKey('GetBrandRatingList', array_values($params));
        if (! $cache->Exists($brandsCacheKey)) {
            OTAPILib2::GetBrandRatingList($languge, $params['type'], $params['count'], $params['catId'], $brandsItems);
            $needMakeRequests = true;
        }

        $vendorsItems = null;
        $params = self::getVendorsItemsParams();
        $vendorsCacheKey = self::getCacheKey('GetVendorRatingList', array_values($params));
        if (! $cache->Exists($vendorsCacheKey)) {
            OTAPILib2::GetVendorRatingList($languge, $params['type'], $params['count'], $params['catId'], $vendorsItems);
            $needMakeRequests = true;
        }

        $reviewsItems = null;
        $params = self::getReviewsItemsParams();
        if (! empty($params['count'])) {
            $reviewsCacheKey = self::getCacheKey('ItemsWithReviews', array_values($params));
            if (! $cache->Exists($reviewsCacheKey)) {
                $itemsIds = self::getItemsWithReviewsIdsFromDB($cms, $params['count']);
                if ($itemsIds) {
                    OTAPILib2::GetItemInfoList($languge, implode(';', $itemsIds), $reviewsItems);
                    $needMakeRequests = true;
                }
            }
        }

        $currency = null;
        $currencyCacheKey = 'GetCurrency:GetCurrency_General';
        if (! $cache->Exists($currencyCacheKey)) {
            OTAPILib2::getCurrency($languge, $currency);
            $needMakeRequests = true;
        }

        try {
            if ($needMakeRequests) {
                OTAPILib2::makeRequests();

                if ($bestItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($bestCacheKey, 3600, $bestItems->asXML());
                }
                if ($warehouseItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($warehouseCacheKey, 3600, $warehouseItems->asXML());
                }
                
                if ($popularItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($popularCacheKey, 3600, $popularItems->asXML());
                }
                if ($lastItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($lastCacheKey, 3600, $lastItems->asXML());
                }
                if ($brandsItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($brandsCacheKey, 3600, $brandsItems->asXML());
                }
                if ($vendorsItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($vendorsCacheKey, 3600, $vendorsItems->asXML());
                }
                if ($reviewsItems instanceof OtapiAnswer) {
                    $cache->AddCacheEl($reviewsCacheKey, 3600, $reviewsItems->asXML());
                }
                if ($currency instanceof OtapiAnswer) {
                    $cache->AddCacheEl($currencyCacheKey, 3600, $currency->asXML());
                }
            }
        } catch (Exception $e) {
            if (OTBase::isTest()) {
                throw $e;
            } else {
                $logger->log($e->getMessage(), array($e->getCode()), 'SET_ERROR');
            }
        }
    }

    public static function getCacheKey($method, $params = array())
    {
        return '__' . $method . ':' . md5($method . implode('/', $params) . Session::getActiveLang());
    }

    /**
     * get<Type>Params
     *
     * @return array (
     *      itemRatingTypeId <String>
     *      numberItem <Integer>
     *      categoryId <Integer>
     *  )
     */
    public static function getBestItemsParams()
    {
        return array('type' => 'Best', 'count' => General::getNumConfigValue('items_with_best', 8), 'catId' => 0);
    }
    
    public static function getWarehouseItemsParams()
    {
        return array('type' => 'Best', 'count' => General::getNumConfigValue('warehouse_items', 8), 'catId' => 'Warehouse');
    }

    public static function getPopularItemsParams()
    {
        return array('type' => 'Popular', 'count' => General::getNumConfigValue('items_with_popular', 8), 'catId' => 0);
    }

    public static function getBrandsItemsParams()
    {
        return array('type' => 'Best', 'count' => General::getNumConfigValue('brand_with_best', 10), 'catId' => 0);
    }

    public static function getLastItemsParams()
    {
        return array('type' => 'Last', 'count' => General::getNumConfigValue('items_with_last', 8), 'catId' => 0);
    }

    public static function getVendorsItemsParams()
    {
        return array('type' => 'Best', 'count' => General::getNumConfigValue('items_with_vendor', 8), 'catId' => 0);
    }

    public static function getReviewsItemsParams()
    {
        return array('type' => Session::get('currency'), 'count' => General::getNumConfigValue('items_with_comments', 8));
    }

    public static function getBackup()
    {
        $file = self::getCacheDir() . '/' . self::$cacheFile;
        if (file_exists($file)) {
            return file_get_contents($file);
        }
    }

    private static function getCacheDir()
    {
        $dir = CFG_APP_ROOT . '/cache/' . self::$cacheDir;
        if (! is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return $dir;
    }

    private static function getItemsWithReviewsIdsFromDB($cms, $itemsCount)
    {
        $result = array();
        if ($itemsCount) {
            $reviewsRepository = new ReviewsRepository($cms);
            $result = $reviewsRepository->GetItemsIdsWithReviews($itemsCount);
        }
        return $result;
    }
}
