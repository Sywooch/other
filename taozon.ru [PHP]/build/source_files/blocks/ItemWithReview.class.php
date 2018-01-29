<?php

class ItemWithReview extends GenerateBlock {

	protected $_cache = false; //- кэшируем или нет.
	protected $_life_time = 3600; //- время на которое будем кешировать
	protected $_template = 'reviews'; //- шаблон, на основе которого будем собирать блок
	protected $_template_path = '/main/';

	public function __construct() {
		
		parent::__construct(true);
	}

	private function clearUrl(){
		unset($_GET['rating']);
		unset($_GET['cost']);
		unset($_GET['count']);
		unset($_GET['filters']);
		unset($_GET['clear']);
		unset($_GET['script_name']);
		unset($_GET['ignorefilters']);
	}

	private function checkClear(){
		if (isset($_GET['clear'])) {
			if(in_array('Seo2', General::$enabledFeatures)){
				$url = $_SERVER['REQUEST_URI'];
				header('Location: ' . current(explode('?', $url)));
				die;
			}

			$url = $_SERVER['REQUEST_URI'];
			$currentQuery = $_SERVER['QUERY_STRING'];
			$this->clearUrl();
			$newQuery = http_build_query($_GET);
			header('Location: ' . str_replace($currentQuery, $newQuery, $url));
			die;
		}
	}

	protected function setVars() {
		
		$this->checkClear();

		$cid=false;
		
		if (isset($_GET['cid']))
			$cid = RequestWrapper::getValueSafe('cid');
		$from = isset($_GET['from']) ? $_GET['from'] : 0;
		$tmall = '';// (isset($_GET['tmall']) && ($_GET['tmall'] == 'true')) ? $_GET['tmall'] : '';

		$url = $_SERVER['REQUEST_URI'];
		$url = str_replace('&from=' . $from, '', $url);
		$url = str_replace('&tmall=' . $tmall, '', $url);
		$url = str_replace('&new_prod=', '', $url);


		if (isset($_POST['sort_by'])) {
			$url = str_replace('&sort_by=' . $_GET['sort_by'], '', $url);
			$url .= '&sort_by=' . $_POST['sort_by'];
			$_GET['sort_by'] = $_POST['sort_by'];
		}
		if (isset($_POST['per_page'])) {
			$url = str_replace('&per_page=' . $_GET['per_page'], '', $url);
			$url .= '&per_page=' . $_POST['per_page'];
			$_GET['per_page'] = $_POST['per_page'];
		}
		if (!empty($_POST))
			header('Location: ' . $url);

		// Постараничный вывод
		$perpage = (isset($_SESSION['perpage']) && !empty($_SESSION['perpage'])) ? $_SESSION['perpage'] : 16;
		if (isset($_GET['per_page']))
			$perpage = $_GET['per_page'];
		$_SESSION['perpage'] = $perpage;
		$from = 0;
		if (isset($_GET['from']))
			$from = $_GET['from'];

		global $otapilib;
		$cms = new CMS();
		$cms->Check();
		$itemlist = array('data'=>array(),'totalcount'=>0);
		$subcats=array();
		if ($cms->checkTable('reviews') && CMS::IsFeatureEnabled('ProductComments')){
			$res = mysql_query('SELECT t1.category_id as ID, COUNT(t1.item_id) as ItemCount from (select distinct category_id, item_id from `reviews` group by item_id) as t1 group by t1.category_id');
			$tempList = array();
			$itemCount = array();
			while($row = mysql_fetch_assoc($res)){
				$tempList[] = $row['ID'];
				$itemCount[$row['ID']] = $row['ItemCount'];
			}
			$subcats = $otapilib->GetCategoryInfoList(implode(',',$tempList));
			foreach ($subcats as $key=>$cat){
				if (isset($itemCount[$cat['id']]))
					$subcats[$key]['name'].= ' ('.$itemCount[$cat['id']].')';
				else
					$subcats[$key]['name'].= ' ('.$itemCount[$cat['externalid']].')';
			}
			$res=false;

			$where = '';
			$tempList = array();
			if ($cid)
				$where = 'where category_id="'.$cid.'"';
			$cms->Check();
			$res = mysql_query('SELECT item_id as ID from `reviews` '.$where.' group by item_id limit '.$from.','.($from+$perpage));
//			if (is_resource($res))
			while($row = mysql_fetch_assoc($res))
				$tempList[] = $row['ID'];

            if($tempList)
                $itemlist['data'] = $otapilib->GetItemInfoList(implode(';',$tempList));
            else
                $itemlist['data'] = array();
			$cms->Check();
			$res = mysql_query('SELECT distinct count(t1.item_id) as TotalCount from (select distinct item_id from `reviews` '.$where.' group by item_id) as t1');
//			if (is_resource($res))
			$row = mysql_fetch_assoc($res);
			$itemlist['totalcount'] = $row['TotalCount'];
		}
		if (count($subcats)>0) $GLOBALS['no_search_props'] = true;


		$GLOBALS['rootpath'] = array();

		$this->tpl->assign('subcats', $subcats);
		$this->tpl->assign('itemlist', $itemlist['data']);
		$this->tpl->assign('totalcount', $itemlist['totalcount']);
		$this->tpl->assign('count', $itemlist['totalcount'] > 10000 ? 10000 : $itemlist['totalcount']);
		$this->tpl->assign('from', $from);
		$this->tpl->assign('cid', $cid);
		$this->tpl->assign('perpage', $perpage);
		$url = $_SERVER['REQUEST_URI'];
		$url = str_replace('&from=' . $from, '', $url);
		$url = str_replace('&tmall=' . $tmall, '', $url);
		$this->tpl->assign('pageurl', $url);
	}

}

?>