<?php

class SearchCategories extends GenerateBlock
{
    protected $_cache = true; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'searchcategories'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

	public function __construct()
    {
        parent::__construct(true);
        $this->tpl->_caching_id = Session::get('active_lang');
    }
	
    protected function setVars()
    {
		if (($this->tpl->isCached()) or (isset($GLOBALS['searchcats_ajax']))){
        	global $otapilib;

			$fullHeader = $otapilib->GetSearchCategoryInfoList();
			if($fullHeader === false){
				//show_error();
				$this->_cache = false;
			}
        	$searchcats = $fullHeader;
			if(!is_array($searchcats)) $searchcats = array();
			$this->tpl->assign('searchcats', $searchcats);
		} else {
			//Не закэшированно и прогружаем через аякс
			$this->_cache = false;
			$this->tpl->assign('searchcats_ajax', '1');
		}
    }
}

?>