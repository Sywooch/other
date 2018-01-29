<?php

class Vendor extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct() {
        $this->_hash = $_GET['id'];
        parent::__construct(true);
    }

    private function xmlParams(){
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');
        if (@$_GET['search'])
            $xmlParams->addChild('ItemTitle', @$_GET['search']);
        if (@$_GET['cid'])
            $xmlParams->addChild('CategoryId', @$_GET['cid']);
        $xmlParams->addChild('VendorId', $_GET['id']);
        $xmlParams->addChild('LanguageOfQuery', 'ru');
        if (@$_GET['cost']['from'])
            $xmlParams->addChild('MinPrice', @$_GET['cost']['from']);
        if (@$_GET['cost']['to'])
            $xmlParams->addChild('MaxPrice', @$_GET['cost']['to']);
        if (@$_GET['count']['from'])
            $xmlParams->addChild('MinQuantity', @$_GET['count']['from']);
        if (@$_GET['count']['to'])
            $xmlParams->addChild('MaxQuantity', @$_GET['count']['to']);
        if (@$_GET['rating']['from'])
            $xmlParams->addChild('MinVendorRating', @$_GET['rating']['from']);
        if (@$_GET['rating']['to'])
            $xmlParams->addChild('MaxVendorRating', @$_GET['rating']['to']);
        if (@$_GET['brand'])
            $xmlParams->addChild('BrandPropertyValueId', @$_GET['brand']);
        $xmlParams->addChild('OrderBy', @$_POST['sort_by']?$_POST['sort_by']:'popularity:desc');
        if (@$_GET['IsOriginal'])
            $xmlParams->addChild('IsOriginal', @$_GET['IsOriginal']);
        if (@$_GET['istmall'])
            $xmlParams->addChild('IsTmall', @$_GET['istmall']);
        $searchParams = str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
        return $searchParams;
    }
    
    protected function setVars() {
        // Запрашиваем информацию о товарах в категории и передаем её в шаблон
        if (isset($_GET['clear'])) {
            unset($_SESSION['filter']);
            header('Location: ' . str_replace('&clear', '', $_SERVER['REQUEST_URI']));
            die;
        }

        if (isset($_POST['sort_by']))
            $_SESSION['filter']['sort_by'] = $_POST['sort_by'];

        if (!empty($_POST))
            header('Location: ' . $_SERVER['REQUEST_URI']);

        if (isset($_SESSION['filter']['sort_by']))
            $_POST['sort_by'] = $_SESSION['filter']['sort_by'];


        // Постараничный вывод
        $from = isset($_GET['from']) ? $_GET['from'] : 0;
        if (isset($_POST['per_page']))
            $_SESSION['per_page'] = $_POST['per_page'];
        $perpage = 16;
        if (isset($_SESSION['per_page']))
            $perpage = $_SESSION['per_page'];
        global $otapilib;

        $searchParams = $this->xmlParams();
        $found = $otapilib->SearchItemsFrame($searchParams, $from, $perpage);
        $itemlist = $found['Items'];
        $categorylist = $found['Categories'];

        $url = $_SERVER['REQUEST_URI'];
        $from = isset($_GET['from']) ? $_GET['from'] : 0;
        $url = str_replace('&from=' . $from, '', $url);

        if (isset($_POST['sort_by'])) {
            $url = str_replace('&sort_by=' . @$_GET['sort_by'], '', $url);
            $url .= '&sort_by=' . $_POST['sort_by'];
        }
        if (isset($_POST['per_page'])) {
            $url = str_replace('&per_page=' . @$_GET['per_page'], '', $url);
            $url .= '&per_page=' . $_POST['per_page'];
        }

        $GLOBALS['url'] = $url
                . '&cost[from]=' . @$_GET['cost']['from']
                . '&cost[to]=' . @$_GET['cost']['to']
                . '&count[from]=' . @$_GET['count']['from']
                . '&count[to]=' . @$_GET['count']['to']
                . '&rating[from]=' . @$_GET['rating']['from']
                . '&rating[to]=' . @$_GET['rating']['to']
        ;
        $GLOBALS['cats'] = @$categorylist;

        if ($found === false)
            show_error($otapilib->error_message);

        $vid = $_GET['id'];
        $this->tpl->assign('itemlist', $itemlist['data']);
        $this->tpl->assign('count', $itemlist['totalcount'] > 10000 ? 10000 : $itemlist['totalcount']);
        $this->tpl->assign('cid', $vid);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('perpage', $perpage);
        $this->tpl->assign('pageurl', '?p=' . SCRIPT_NAME . '&id=' . $vid);
    }

}

?>