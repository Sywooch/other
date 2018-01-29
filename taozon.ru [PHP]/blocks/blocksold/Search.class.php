<?php

class Search extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        $this->_hash = md5($this->generateSearchParameters());
        parent::__construct(true);
    }
    
    private function generateSearchParameters(){
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');
        if(@$_GET['search']) $xmlParams->addChild('ItemTitle', @htmlspecialchars ($_GET['search']));
        if(@$_GET['cid']) $xmlParams->addChild('CategoryId', $_GET['cid']);
        if(@$_GET['vid']) $xmlParams->addChild('VendorId', @$_GET['vid']);
        $xmlParams->addChild('LanguageOfQuery', 'ru');
        if(@$_GET['cost']['from']) $xmlParams->addChild('MinPrice', @$_GET['cost']['from']);
        if(@$_GET['cost']['to']) $xmlParams->addChild('MaxPrice', @$_GET['cost']['to']);
        if(@$_GET['count']['from']) $xmlParams->addChild('MinQuantity', @$_GET['count']['from']);
        if(@$_GET['count']['to']) $xmlParams->addChild('MaxQuantity', @$_GET['count']['to']);
        if(@$_GET['rating']['from']) $xmlParams->addChild('MinVendorRating', @$_GET['rating']['from']);
        if(@$_GET['rating']['to']) $xmlParams->addChild('MaxVendorRating', @$_GET['rating']['to']);
        if(@$_GET['brand']) $xmlParams->addChild('BrandPropertyValueId', @$_GET['brand']);
        if(@$_GET['IsOriginal']) $xmlParams->addChild('IsOriginal', @$_GET['IsOriginal']);
        if(@$_GET['istmall']) $xmlParams->addChild('IsTmall', @$_GET['istmall']);
        if(@$_GET['tmall'] && $_GET['tmall']=='true') $xmlParams->addChild('IsTmall', @$_GET['tmall']);
        
        if(@$_POST['sort_by'])
            $xmlParams->addChild('OrderBy', @$_POST['sort_by']);
        elseif(@$_GET['sort_by']) 
            $xmlParams->addChild('OrderBy', @$_GET['sort_by']);
        return str_replace('<?xml version="1.0"?>','',$xmlParams->asXML());
    }

    /**
     * Метод для создания базового URL и 
     * @param array $get
     * @param array $post
     */
    private function generateBaseUrl($get, $post){
        
        return array($url, $params);
    }
    
    protected function setVars()
    {
        global $otapilib;
        // Запрашиваем информацию о товарах в категории и передаем её в шаблон
        $search = $_GET['search'];
        
        if (isset($_GET['clear']))
        {
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, '&cost') !== false) $url = substr($url, 0, strpos($url, '&cost'));
            $url = str_replace(array('&clear=', '&clear'), '', $url);
            header('Location: '.$url);
            die;
        }
        $url = $_SERVER['REQUEST_URI'];
        $from = isset($_GET['from']) ? $_GET['from'] : 0;
        $tmall = (isset($_GET['tmall']) && ($_GET['tmall']=='true')) ? $_GET['tmall'] : '';
        $url = str_replace('&from='.$from, '', $url);
        $url = str_replace('&tmall='.$tmall, '', $url);
        
        if (isset($_POST['sort_by']))
        {
            $url = str_replace('&sort_by='.@$_GET['sort_by'], '', $url);
            $url .= '&sort_by='.$_POST['sort_by'];
        }
        
        if (isset($_POST['per_page']))
        {
            $url = str_replace('&per_page='.@$_GET['per_page'], '', $url);
            $url .= '&per_page='.$_POST['per_page'];
        }
        if(isset($_GET['brand']) && !empty($_GET['brand']) && !preg_match('/\&brand/',$url))
            $url .= '&brand='.$_GET['brand'];
        
        $GLOBALS['url'] = $url
            .'&cost[from]='.@$_GET['cost']['from']
            .'&cost[to]='.@$_GET['cost']['to']
            .'&count[from]='.@$_GET['count']['from']
            .'&count[to]='.@$_GET['count']['to']
            .'&rating[from]='.@$_GET['rating']['from']
            .'&rating[to]='.@$_GET['rating']['to']
                ;
        
        // Постараничный вывод
        $perpage = (isset($_SESSION['perpage']) && !empty($_SESSION['perpage'])) ? $_SESSION['perpage'] : 16;
        if (isset($_GET['per_page'])) $perpage = $_GET['per_page'];
        if (isset($_POST['per_page'])) $perpage = $_POST['per_page'];
        $_SESSION['perpage'] = $perpage;
        
        $searchParams = str_replace('<?xml version="1.0"?>','',$this->generateSearchParameters());
        
        $found = $otapilib->SearchItemsFrame($searchParams, $from, $perpage);
        $itemlist = $found['Items'];
        $categorylist = $found['Categories'];
        
        //if ($itemlist === false) show_error(__FILE__.'  (line='.__LINE__.')');
        if ($found === false) show_error($otapilib->error_message);
        
        if (count(@$itemlist['data']) == 1)
        {
            header('Location: index.php?p=item&id='.$itemlist['data'][0]['Id']);
        }
        
        if(count(@$categorylist) > 1)
            $GLOBALS['cats'] = @$categorylist;
        
            
        $bid = isset($_GET['brand']) ? $_GET['brand'] : false;
        if($bid){
            $this->tpl->assign('brand', $GLOBALS['brand']);
        }
        
        $categoriesResult = array();
        if(!isset($_GET['brand']) || empty($_GET['brand']))
            $categoriesResult = $otapilib->FindHintCategoryInfoList($search);
        
        $categories = array();

        if (!is_array($categoriesResult))
            $categoriesResult = array();

        foreach ($categoriesResult as $item) {
            $urlParams = array('p=subcategory', 'cid='.$item['id']);
            if ($item['isvirtual'] === 'true'){
                $urlParams[] = 'virt';
            }
            $link = 'index.php?' . implode('&', $urlParams);
            $categories[$link] = $item['name'];
        }
        
        $this->tpl->assign('hintcats',$categories);
        $this->tpl->assign('itemlist', @$itemlist['data']);
        $this->tpl->assign('count', $itemlist['totalcount']>10000 ? 10000 : $itemlist['totalcount']);
        $this->tpl->assign('search', $search);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('tmall', $tmall);
        $this->tpl->assign('perpage', $perpage);
        $this->tpl->assign('pageurl', $url);
        $this->tpl->assign('emptymessage', 'К сожалению ничего не удалось найти, попробуйте изменить запрос');
        //print_r($itemlist);
    }
}

?>