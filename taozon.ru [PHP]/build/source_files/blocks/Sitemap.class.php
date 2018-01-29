<?php
class Sitemap extends GenerateBlock {	
    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'sitemap'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct() {
        parent::__construct(true);
    }

    private function getPages(){
        $cms = new CMS();
        $menu = Array();
        if($cms->Check()){
		
            $top_menu = $cms->getBlock('top_menu_'.$_SESSION['active_lang']);
            if($top_menu){
                $top_menu_full = json_decode($top_menu);
				
                $menu = array();
                foreach($top_menu_full as $m){
                    $isContentPage = is_numeric($m);
                    $page = $isContentPage ? $cms->GetPageByID($m) : array('alias'=>$m,'title'=>Lang::get($m));
                    if($page)
                        $menu[] = $page;
                }
            }
			
			$left_menu = $cms->getBlock('left_menu_'.$_SESSION['active_lang']);
			if($left_menu){
                $left_menu_full = json_decode($left_menu);
				
				if(!is_array($menu)) 
					$menu = array();
					
                foreach($left_menu_full as $m){
                    $isContentPage = is_numeric($m);
                    $page = $isContentPage ? $cms->GetPageByID($m) : array('alias'=>$m,'title'=>Lang::get($m));
                    if($page)
                        $menu[] = $page;
                }
            }
			
        }

        foreach($menu as $key=>$m){
            $menu[$key]['subpages'] = false;
            if(isset($m['id'])){
                $menu[$key]['subpages'] = $this->getChildrenPages($m['id']);
            }
        }

        $this->tpl->assign('pages', $menu);
    }

	public function getChildrenPages($id){
			$cms = new CMS();
			$cms->Check();
			$cms->checkTable('site_pages_parents');
			$q = mysql_query("SELECT * FROM `site_pages_parents` WHERE `parent_id`=$id");
			
			if(!$q) return false;	
			
			$children = array();
			while($row = mysql_fetch_assoc($q)){
				$children[] = $cms->GetPageByID($row['page_id']);
			}
			return $children;
	}

    protected function setVars() {
        // Запрашивается список брен
        global $otapilib;

        $otapilib->curl_timeout = 600;
        $cats = $otapilib->GetTwoLevelRootCategoryInfoList();
        if(in_array('Seo2', General::$enabledFeatures)){
            $cms = new SafedCMS();
            if(is_array($cats))
            foreach($cats as &$c){
                $c['alias'] = $cms->getCategoryAlias($c['Id'], true, $c['Name']);
            }
        }
        
        $treeCats = array();
        if ($cats) foreach($cats as $c){
            if(!$c['ParentId']){
                $treeCats[$c['Id']] = array_merge($c, array('children' => array()));
            }
            else{
                $treeCats[$c['ParentId']]['children'][] = $c;
            }
        }
		
		// Страницы добавленные пользователями
		$this->getPages();
		
		//Каталог в карту сайта
        $this->tpl->assign('treeCats', $treeCats);
		
    }

}
?>