<?php

class ItemSetsNew extends GenerateBlock
{
    protected $_cache = true; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemsetsnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
        $this->tpl->_caching_id = @$_SESSION['currency'].@$_SESSION['active_lang'];
    }

    protected function setVars()
    {
        global $otapilib;
        // получаем количество выводимых пунктов из установок сайта или по умолчанию
        $numberItemBest = (isset(General::$siteConf['items_with_best'])) ? (int)General::$siteConf['items_with_best'] : 8;
        $numberItemPopular = (isset(General::$siteConf['items_with_popular'])) ? (int)General::$siteConf['items_with_popular'] : 8;
        $numberItemLast = (isset(General::$siteConf['items_with_last'])) ? (int)General::$siteConf['items_with_last'] : 8;
        $numbertBrandBest = (isset(General::$siteConf['brand_with_best'])) ? (int)General::$siteConf['brand_with_best'] : 10;
        $numberVendorBest = (isset(General::$siteConf['items_with_vendor'])) ? (int)General::$siteConf['items_with_vendor'] : 10;
        $numberItemReview = (isset(General::$siteConf['items_with_comments'])) ? (int)General::$siteConf['items_with_comments'] : 8;
        $displayAsCarousel = (isset(General::$siteConf['display_as_carousel'])) ? true : false;

        // инициализируем массивы
        $recommend = Array();
        $popular = Array();
        $last = Array();
        $brands = Array();
        $vendors = Array();
        $withReview = array();

        if (CFG_MULTI_CURL)
        {
            // С мультипотоками

            // Инициализируем
            $otapilib->InitMulti();

            // Суём задачи в потоки
            if ($numberItemBest)
                $recommend = $otapilib->GetItemRatingList('Best', $numberItemBest, 0);
            if ($numberItemPopular)
                $popular = $otapilib->GetItemRatingList('Popular', $numberItemPopular, 0);
            if ($numberItemLast)
                $last = $otapilib->GetItemRatingList('Last', $numberItemLast, 0);
            if ($numbertBrandBest)
                $brand_list = $otapilib->GetBrandRatingList('Best', $numbertBrandBest, 0);
            $vendors = $otapilib->GetVendorRatingList('Best', $numberVendorBest, 0);

            // Делаем запросы
            $otapilib->MultiDo();

            // В том же порядке забираем результаты
            if ($numberItemBest)
                $recommend = $otapilib->GetItemRatingList('Best', $numberItemBest, 0);
            if ($numberItemPopular)
                $popular = $otapilib->GetItemRatingList('Popular', $numberItemPopular, 0);
            if ($numberItemLast)
                $last = $otapilib->GetItemRatingList('Last', $numberItemLast, 0);
            if ($numbertBrandBest) {
                $brand_list = $otapilib->GetBrandRatingList('Best', $numbertBrandBest, 0);
                $brands = $brand_list;
            }
            if ($numberVendorBest)
                $vendors = $otapilib->GetVendorRatingList('Best', $numberVendorBest, 0);

            // Сбрасываем
            $otapilib->StopMulti();
        } else {
            // По старому
            if ($numberItemBest)
                $recommend = $otapilib->GetItemRatingList('Best', $numberItemBest, 0);
            if ($numberItemPopular)
                $popular = $otapilib->GetItemRatingList('Popular', $numberItemPopular, 0);
            if ($numberItemLast)
                $last = $otapilib->GetItemRatingList('Last', $numberItemLast, 0);
            if ($numbertBrandBest) {
                $brand_list = $otapilib->GetBrandRatingList('Best', $numbertBrandBest, 0);
                $brands = $brand_list;
            }
            if ($numberVendorBest)
                $vendors = $otapilib->GetVendorRatingList('Best', $numberVendorBest, 0);
        }

        $cms = new CMS();
        if($cms->Check()){
            foreach( $vendors as &$vendor ){
                $q = mysql_query('SELECT * FROM `site_vendors_images`
                WHERE `vendor_id`="'.mysql_real_escape_string($vendor['Id']).'"');
                $row = @mysql_fetch_assoc($q);
                $vendor['image_path'] = $row['image_path'];
                $vendor['vendor_name'] = $row['vendor_name'];
            }
        }

        // получить массив с откомментированными товарами
        if (CMS::IsFeatureEnabled('ProductComments') && $cms->checkTable('reviews') && $numberItemReview) {
            $res = mysql_query('SELECT item_id as ID from `reviews` group by item_id ORDER BY RAND('.rand(0, 1000000).') limit '.$numberItemReview);
            $itemList = array();
            while($row = mysql_fetch_assoc($res))
                $itemList[] = $row['ID'];
            if($itemList)
                $withReview = $otapilib->GetItemInfoList(implode(';',$itemList));
            else
                $withReview = array();
        }

        $this->tpl->assign('displayAsCarousel', $displayAsCarousel);
        $this->tpl->assign('itemlist1', $recommend);
        $this->tpl->assign('itemlist2', $popular);
        $this->tpl->assign('itemlist3', $last);
        $this->tpl->assign('brandlist', $brands);
        $this->tpl->assign('vendors', $vendors);
        $this->tpl->assign('withReview', $withReview);
    }
}

?>