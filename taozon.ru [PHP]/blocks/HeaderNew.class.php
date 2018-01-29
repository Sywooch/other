<?php

class HeaderNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'headernew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $_hash = '';

    public function __construct()
    {

		if (isset($_GET['print'])&&$_GET['print']=='Y') $this->_template='headerprint';
		parent::__construct(true);
    }

    private function _fetchSearch(){
        $search_templates = array('category','subcategory','item','index',
                'login','register','profile','content','supportlist','basket',
                'userorder','support', 'privateoffice');

        if (in_array(SCRIPT_NAME, $search_templates))
        {
            $this->tpl->assign('script_name', 'index');
            $this->tpl->assign('show_search', true);
        }
        if (SCRIPT_NAME == 'search')
        {
            $this->tpl->assign('script_name', 'index');
            $this->tpl->assign('show_search', true);

            $this->tpl->assign('search', RequestWrapper::getValueSafe('search'));
        }
    }
    
    private function _checkTheme()
    {
        $listOfStyles = array();
        $isCustomTheme = strripos(General::getConfigValue('current_site_theme'), 'custom-') === false ? false : true;
        if ($isCustomTheme) {
            foreach (glob(CFG_APP_ROOT . '/css/theme/' . General::getConfigValue('current_site_theme') . '/*.css') as $css) {
                $tmp = pathinfo($css);
                $listOfStyles[] = '/css/theme/' . General::getConfigValue('current_site_theme') . '/' . $tmp['filename']. '.' . $tmp['extension'];
            }
        }
        $this->tpl->assign('isCustomTheme', $isCustomTheme);
        $this->tpl->assign('listOfStyles', $listOfStyles);
    }

    private function _setMenu(){
        $cms = new CMS();

        $menu = false;
        if($cms->Check()){
            $menu = $cms->getBlock('top_menu_'.$_SESSION['active_lang']);
            if($menu){
                $menu_full = json_decode($menu);                
                $menu_full = CMS::removeNotAvailableMenuItems($menu_full);
                $menu = array();
                foreach($menu_full as $m){
                    $isContentPage = is_numeric($m);
                    $menu[] = $isContentPage ? $cms->GetPageByID($m) : array('alias'=>$m,'title'=>Lang::get($m));
                }
            }
        }

        $this->tpl->assign('menu', $menu);
    }    
    

    protected function setVars()
    {
        $this->_fetchSearch();
        $this->_checkTheme();

		if (!isset($GLOBALS['userdata_ajax'])) {
			$SearchCategories = new SearchCategories();
        	$this->tpl->assign('SearchCategories', $SearchCategories->Generate());
        	if(!isset($_SESSION['active_lang'])){
            		$_SESSION['active_lang'] = 'ru';
        	}

			if (!isset($_GET['print'])||$_GET['print']!='Y'){
				$this->_setMenu();

				$this->tpl->assign('langs', $GLOBALS['langs']);
				if(SCRIPT_NAME!='index'){
					$M = new MenuShortNew();
					$this->tpl->assign('MenuShortNew', $M->Generate());
				}
			}
		}
    }
}

?>