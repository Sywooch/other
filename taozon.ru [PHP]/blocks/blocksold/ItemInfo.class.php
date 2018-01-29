<?php

class ItemInfo extends GenerateBlock
{
    protected $_cache = CFG_CACHED;
    protected $_life_time = 3600;
    protected $_template = 'iteminfo';
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        $this->_hash = $_GET['id'];
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        $id = $_GET['id'];
        
        $quantity = isset($_POST['quantity'])?$_POST['quantity']:1;
        if (isset($_POST['add']))
        {
            //SupportList::addToCart($otapilib, $id, 1);
            Basket::addToBasket($otapilib, $id, $quantity);
            header('Location: '.$_SERVER['REQUEST_URI']);
        }
        $iteminfo = $otapilib->GetItemFullInfoWithPromotions($id);
        if ($iteminfo === false) show_error($otapilib->error_message);
        
        $GLOBALS['taoBaoCategoryId'] = $iteminfo['categoryid'];
        $this->tpl->assign('iteminfo', $iteminfo);
        $vendorId = $iteminfo['vendorid'];
        $vendorInfo = $otapilib->GetVendorInfo($vendorId);
        $this->tpl->assign('vendorInfo', $vendorInfo);
        
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');
        $xmlParams->addChild('VendorId', $vendorInfo['Id']);
        $xmlParams->addChild('LanguageOfQuery', 'ru');
        $xmlParams->addChild('OrderBy', 'popularity:desc');
        
        if(@$_GET['tmall'] && $_GET['tmall']=='true') $xmlParams->addChild('IsTmall', @$_GET['tmall']);
        $xml = str_replace('<?xml version="1.0"?>','',$xmlParams->asXML());
        
        
        $found = $otapilib->SearchItemsFrame($xml, 0, 4);
        $vendorItems = $found['Items']['data'];
        $this->tpl->assign('vendorItems', $vendorItems);
    }
}

?>