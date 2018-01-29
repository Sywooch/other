<?php

class ItemList extends GenerateBlock
{
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {
        $this->_hash = $_GET['cid'];
        parent::__construct(true);
    }

    protected function setVars()
    {
        // Запрашиваем информацию о товарах в категории и передаем её в шаблон
        $cid = $_GET['cid'];
		if (isset($_GET['clear']))
		{
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, '&cost') !== false) $url = substr($url, 0, strpos($url, '&cost'));
            $url = str_replace('&clear', '', $url);
            header('Location: '.$url);
            die;
		}
        
        $url = $_SERVER['REQUEST_URI'];
        $from = isset($_GET['from']) ? $_GET['from'] : 1;
        $tmall = (isset($_GET['tmall']) && ($_GET['tmall']=='true')) ? $_GET['tmall'] : '';
        $url = str_replace('&from='.$from, '', $url);
        $url = str_replace('&tmall='.$tmall, '', $url);
        
		if (isset($_POST['sort_by']))
        {
            $url = str_replace('&sort_by='.$_GET['sort_by'], '', $url);
            $url .= '&sort_by='.$_POST['sort_by'];
        }
		if (isset($_POST['per_page']))
        {
            $url = str_replace('&per_page='.$_GET['per_page'], '', $url);
            $url .= '&per_page='.$_POST['per_page'];
        }
        if (!empty($_POST)) header('Location: '.$url);
        
		$categoryItemFilter = '<SearchParameters>';
		if (!empty($_GET['cost']['from'])) $categoryItemFilter .= '<MinPrice>'.$_GET['cost']['from'].'</MinPrice>';
		if (!empty($_GET['cost']['to'])) $categoryItemFilter .= '<MaxPrice>'.$_GET['cost']['to'].'</MaxPrice>';
		if (!empty($_GET['count']['from'])) $categoryItemFilter .= '<MinQuantity>'.$_GET['count']['from'].'</MinQuantity>';
		if (!empty($_GET['count']['to'])) $categoryItemFilter .= '<MaxQuantity>'.$_GET['count']['to'].'</MaxQuantity>';
		if (!empty($_GET['rating']['from'])) $categoryItemFilter .= '<MinVendorRating>'.$_GET['rating']['from'].'</MinVendorRating>';
		if (!empty($_GET['rating']['to'])) $categoryItemFilter .= '<MaxVendorRating>'.$_GET['rating']['to'].'</MaxVendorRating>';
                if ($tmall) $categoryItemFilter .= '<IsTmall>true</IsTmall>';
         
        if (isset($_GET['filters']))
        {
            $categoryItemFilter .= '<Configurators>';
            foreach($_GET['filters'] as $pid => $vid)
            {
                if ($vid) $categoryItemFilter .= '<Configurator Pid="'.$pid.'" Vid="'.$vid.'" />';
            }
            $categoryItemFilter .= '</Configurators>';
        }
        if (isset($_GET['sort_by']))
        {
            $categoryItemFilter .= '<OrderBy>'.$_GET['sort_by'].'</OrderBy>';
        }
		$categoryItemFilter .= '</SearchParameters>';
		/*
<SearchParameters>
  <Configurators>
    <Configurator Pid="pid1" Vid="vid1" />
    <Configurator Pid="pid2" Vid="vid2" />
  </Configurators>
  <MinPrice>...</MinPrice>
  <MaxPrice>...</MaxPrice>
  <MinQuantity>...</MinQuantity>
  <MaxQuantity>...</MaxQuantity>
  <OrderBy>...</<OrderBy>
  <MinVendorRating>...</MinVendorRating>
  <MaxVendorRating>...</MaxVendorRating>
  <IsOriginal>true/false</IsOriginal>
  <IsTmall>true/false</IsTmall>
</SearchParameters>
		*/
        // Постараничный вывод
        $perpage = 16;
        if (isset($_GET['per_page'])) $perpage = $_GET['per_page'];
        global $otapilib;
        $itemlist = $otapilib->FindCategoryItemSimpleInfoListFrame($cid, $from, $perpage, $categoryItemFilter);
        //if ($itemlist === false) show_error(__FILE__.'  (line='.__LINE__.')');
        if ($itemlist === false) show_error($otapilib->error_message);
        
        $this->tpl->assign('itemlist', $itemlist['data']);
        $this->tpl->assign('count', $itemlist['totalcount']>10000 ? 10000 : $itemlist['totalcount']);
        $this->tpl->assign('cid', $cid);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('tmall', $tmall);
        $this->tpl->assign('perpage', $perpage);
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('&from='.$from, '', $url);
        $url = str_replace('&tmall='.$tmall, '', $url);
        $this->tpl->assign('pageurl', $url);
        //print_r($itemlist);
    }
}

?>