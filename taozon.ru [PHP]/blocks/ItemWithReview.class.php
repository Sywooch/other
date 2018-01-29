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
		
		if (isset($_GET['cid'])) {
			$cid = RequestWrapper::getValueSafe('cid');
		}

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
		if (!empty($_POST)) {
			header('Location: ' . $url);
		}

		// Постараничный вывод
		$perpage = General::getNumConfigValue('comments_catalog_perpage', 16);
		if (isset($_GET['per_page'])) {
			$perpage = $_GET['per_page'];
		}

		$from = 0;
		if (isset($_GET['from'])) {
			$from = $_GET['from'];
		}

		global $otapilib;		
		$itemlist = array('data' => array(),'totalcount' => 0);
		$subcats = array();
		if (CMS::IsFeatureEnabled('ProductComments')) {	
		
			$reviewsRepository = new ReviewsRepository(new CMS());
			try {
				$data = $reviewsRepository->GetCatsList();
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DB_REVIEWS_GetCatsList_ERROR');                
        	}
			
			$subcats = $otapilib->GetCategoryInfoList(implode(',',$data['tempList']));
			try {
				$itemCount = $reviewsRepository->GetCatItemCount();
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DB_REVIEWS_GetCatItemCount_ERROR'); 				
        	}
			
			foreach ($subcats as $key=>$cat){
				if (isset($itemCount[$cat['id']]))
					$subcats[$key]['name'].= ' ('.$itemCount[$cat['id']].')';
				elseif (isset($itemCount[$cat['externalid']]))
					$subcats[$key]['name'].= ' ('.$itemCount[$cat['externalid']].')';
			}
			$res = false;

			$where = '';			
			if ($cid) {
				$where = 'where category_id="'.$cid.'"';
			}

			try {	
				$dataItems = $reviewsRepository->GetItemList($where,$from,$perpage);				
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DB_REVIEWS_GetItemList_ERROR');                
        	}
            if ($dataItems) {
                $itemlist['data'] = $otapilib->GetItemInfoList(implode(';',$dataItems));
            } else {
                $itemlist['data'] = array();
            }

            $deleteItems = array();
            foreach ($itemlist['data'] as $k => $item) {
                if((string)$item['ErrorCode'] == 'NotFound') {
                    $deleteItems[] = $item['Id'];
                    unset($itemlist['data'][$k]);
                } elseif((string)$item['ErrorCode'] != 'Ok') {
                    unset($itemlist['data'][$k]);
                }
            }

            try{
                $reviewsRepository->DeleteReviews($deleteItems);
			} catch (Exception $e) {
                Session::setError($e->getMessage());
            }

			try {
				$itemlist['totalcount'] = $reviewsRepository->GetTotalCount($where);
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DB_REVIEWS_GetTotalCount_ERROR');                
        	}
		}
		if (count($subcats)>0) {
			$GLOBALS['no_search_props'] = true;
		}

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