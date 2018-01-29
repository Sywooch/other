<?php

class MenuShortNew extends GenerateBlock
{
    protected $_cache = true;
    protected $_life_time = 3600;
    protected $_template = 'menushortnew';
    protected $_template_path = '/menu/';
    protected $_hash = '';
	private $categories =array();

    public function __construct()
    {
        $this->_hash = $_SESSION['active_lang'];
        parent::__construct(true);
    }

    protected function setVars()
    {	
		if (($this->tpl->isCached()) or (isset($GLOBALS['menu_ajax']))){		
        	global $otapilib;
        	$otapilib->curl_timeout = 20;
			if (defined('MY_GOODS_SYSTEM')) {
				$cms = new CMS();
				$status = $cms->Check();

				$cms->checkTable('my_categories');
				$category = $cms->GetCategoryById();
				$this->_getCategories($category);
				$my_cats = $this->categories;
			}

        	$rootcats = $otapilib->GetTwoLevelRootCategoryInfoList();
        	if(!$rootcats)
            	$this->tpl->_caching = false;
	
        	if ($rootcats === false) $this->_cache = false;

        	if(in_array('Seo2', General::$enabledFeatures)){
            	$cms = new SafedCMS();
            	if(is_array($rootcats))
            	foreach($rootcats as &$c){
                	$c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
            	}
        	}

			$this->tpl->assign('my_cats', isset($my_cats) ? $my_cats : array());
        	$this->tpl->assign('rootcats', $rootcats);
    	} else {
			//Не закэшированно и прогружаем через аякс
			$this->_cache = false;
			$this->tpl->assign('menu_ajax', '1');	
		}
	}
	private function _getCategories($data)
	{
        foreach ($data as $row) {
            $this->categories[$row['parent_id']][] = $row;
        }
	}
}

?>
