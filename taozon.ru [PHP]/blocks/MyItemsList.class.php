<?php

class MyItemsList extends GenerateBlock {

    protected $_template = 'myitemlist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct() {
        parent::__construct(true);
    }

    private function clearUrl(){
        unset($_GET['cost'], $_GET['count'], $_GET['clear'], $_GET['script_name']);
    }

    private function checkClear(){
        if (!isset($_GET['clear'])) return ;

        $url = $_SERVER['REQUEST_URI'];
        $currentQuery = $_SERVER['QUERY_STRING'];
        $this->clearUrl();
        $newQuery = http_build_query($_GET);
        header('Location: ' . str_replace($currentQuery, $newQuery, $url));
    }

    public static function getArrayValueByKeys($array, $keys){
        $tmp = $array;
        foreach($keys->request as $k){
            $tmp = $tmp[(string)$k];
        }
        return $tmp;
    }

    public static function getXmlParameter($requestType, $requestKeys, $xmlKey, &$xmlElement){
        switch($requestType){
            case 'get':
                $value = @self::getArrayValueByKeys($_GET, $requestKeys);
                if($value)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($value));
                break;
            case 'post_or_get':
                $valuePost = @self::getArrayValueByKeys($_POST, $requestKeys);
                $valueGet = @self::getArrayValueByKeys($_GET, $requestKeys);
                if($valuePost)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($valuePost));
                elseif($valueGet)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($valueGet));
                break;
        }
    }

    public static function prepareFiltersXml(&$xmlElement){
        if (isset($_GET['filters'])) {
            $configuratorsXml = $xmlElement->addChild('Configurators');
            foreach ($_GET['filters'] as $pid => $vid) {
                if ($vid && $pid!='StuffStatus'){
                    $el = $configuratorsXml->addChild('Configurator');
                    $el->addAttribute('Pid', $pid);
                    $el->addAttribute('Vid', $vid);
                }
                elseif($pid=='StuffStatus' && $vid){
                    $xmlElement->addChild('StuffStatus', $vid);
                }
            }
        }
    }

    private function searchParams(){
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');

        $xmlSearchConfig = simplexml_load_file(CFG_APP_ROOT.'/config/request2xml.search.xml');
        foreach($xmlSearchConfig->predefined_paramters->parameter as $c)
            $xmlParams->addChild((string)$c['name'], (string)$c[0]);

        foreach($xmlSearchConfig->parameter as $c)
            self::getXmlParameter((string)$c['request_type'],$c->children(),(string)$c['name'],$xmlParams);

        self::prepareFiltersXml($xmlParams);

        return $xmlParams->asXML();
    }

    private function post2get(&$url, $key){
        if(!isset($_POST[$key])) return ;
        $url = str_replace('&'.$key.'=' . $_GET[$key], '', $url);
        $url .= '&'.$key.'=' . $_POST[$key];
        $_GET[$key] = $_POST[$key];
    }

    public function checkGetRequestForSorting(){
        $mcid = @$_GET['mcid'];
        $from = isset($_GET['from']) ? $_GET['from'] : 0;
		$perpage = (isset($_SESSION['perpage']) && !empty($_SESSION['perpage'])) ? $_SESSION['perpage'] : 16;
		if (isset($_GET['per_page'])) $perpage = $_GET['per_page'];
		if (isset($_POST['per_page'])) $perpage = $_POST['per_page'];
		$_SESSION['perpage'] = $perpage;

        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('&from=' . $from, '', $url);
        $url = str_replace('&new_prod=', '', $url);
        $GLOBALS['url'] = $url;
		if (!isset($_GET['sort_by'])){
			if (isset($_SESSION['sort_by']) && !empty($_SESSION['sort_by']))
				$_GET['sort_by'] = $_SESSION['sort_by'];
		}
		else
			$_SESSION['sort_by'] = $_GET['sort_by'];

        $this->post2get($url, 'sort_by');
        $this->post2get($url, 'per_page');

        if (!empty($_POST)){
            header('Location: ' . $url);
            return array(0,0,0);
        }
        $this->tpl->assign('mcid', $mcid);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('perpage', $perpage);
        return array($from, $perpage);
    }

    private function prepareItemList($goods){
		$count = count($goods);
        $this->tpl->assign('itemlist', $goods);
        $this->tpl->assign('totalcount', $count);
        $this->tpl->assign('count', $count > 10000 ? 10000 : $count);
    }

	private function _getCurrency()
	{
        global $otapilib;
		if(!file_exists(CFG_APP_ROOT.'/cache/GetCurrency.dat') ||
            filemtime(CFG_APP_ROOT.'/cache/GetCurrency.dat')+600<time()){
            $currency = $otapilib->GetCurrency();
            file_put_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat', serialize($currency));
        }
        else{
            $currency = unserialize(file_get_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat'));
        }
        return $currency;
	}

	private function preparePageUrl($from){
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('&from=' . $from, '', $url);
        $this->tpl->assign('pageurl', $url);
    }

    protected function setVars() {

        $this->checkClear();
        list($from, $perpage) = $this->checkGetRequestForSorting();
        if (!$from && !$perpage) return;

		$cms = new CMS();
		$status = $cms->Check();

		$cms->checkTable('my_goods');
		$cms->checkTable('my_categories');

		$mcid = (int) @$_GET['mcid'];
		$my_cat = $cms->GetCategoryById($mcid);

		if ($my_cat) {
			$this->tpl->assign('category', $my_cat[0]);
			$GLOBALS['my_category_name'] = $my_cat[0]['name'];
			$goods = $cms->GetGoodsByCatId($mcid);
		}

		$cur_list = $this->_getCurrency();
		$this->tpl->assign('currency', $cur_list['sign']);
        $this->prepareItemList($goods);
        $this->preparePageUrl($from);
    }

}

