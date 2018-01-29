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

    private function _getSession(){
        if(@$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'])
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else{
            $cookieName = str_replace(array(' ',',',';','='),'',CFG_SITE_NAME).'Auth';
            $cookieName = str_replace('.','_',$cookieName);
            $sid = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : session_id();
        }
        return $sid;
    }

    private function _setMenu(){
        $cms = new CMS();

        $menu = false;
        if($cms->Check()){
            $menu = $cms->getBlock('top_menu_'.$_SESSION['active_lang']);
            if($menu){
                $menu_full = json_decode($menu);
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
		global $otapilib;
		
        $this->_fetchSearch();
        $sid = $this->_getSession();
		//Проверям есть ли кэш
		$cache_usr = New Cache_my($sid, 'BatchGetUserData');  // Проверять на GetAccountInfo нет смысла, если BatchGetUserData устарел то и аккаунт тоже
        $data = $cache_usr->GetData();
		// если кэш не устарел
		$this->_life_time = 21600;
        if ((($data) && ($data['time'] + $this->_life_time > time())) or (isset($GLOBALS['userdata_ajax'])) or (SCRIPT_NAME!='index')) {
        	/* run cache */
        	$otapilib->CacheSetTrue($sid);
        	/* */
			if (!isset($_GET['print'])||$_GET['print']!='Y')
				$fullHeader = $otapilib->BatchGetUserData($sid,'Basket,Note,UserStatus,BasketSummary,NoteSummary');
			else
				$fullHeader = $otapilib->BatchGetUserData($sid,'UserStatus');
			if($fullHeader === false){
				show_error();
				$this->_cache = false;
			}
			$user = $fullHeader['Status']['Info'];
			$_SESSION[CFG_SITE_NAME.'loginUserData']['username'] = (string)$user;
			$_SESSION[CFG_SITE_NAME.'loginUserData']['sid'] = $sid;
			$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'] = (bool)$user;

			$this->tpl->assign('IsAuthenticated', (bool)$user);

			$GLOBALS['NoteSummary'] = $fullHeader['NoteSummary'];
			$this->tpl->assign('favourites', $fullHeader['NoteSummary']['TotalCount']);
        	$GLOBALS['BasketSummary'] = $fullHeader['BasketSummary'];
			$this->tpl->assign('basket', $fullHeader['BasketSummary']['TotalCount']);

			if ($fullHeader['NoteSummary']['TotalCount'] > 0 || $fullHeader['BasketSummary']['TotalCount'] > 0) $this->_cache = false;

			if((bool)$user)
			{
            	$otapilib->CacheSetTrue($sid);
            	$accountinfo = $otapilib->GetAccountInfo($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']);
				$GLOBALS['accountinfo'] = $accountinfo;
				$this->tpl->assign('deposit', (string)$accountinfo['availableamount'].' '.$accountinfo['currencysign']);
				$_SESSION[CFG_SITE_NAME.'loginUserData']['currencysign'] = (string)$accountinfo['currencysign'];
				$_SESSION[CFG_SITE_NAME.'loginUserData']['currencycode'] = (string)$accountinfo['CurrencyCode'];
			}
			if (isset($GLOBALS['userdata_ajax'])) {
				print json_encode(array('IsAuthenticated'=>$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'],'username'=>$_SESSION[CFG_SITE_NAME.'loginUserData']['username'],'favourites'=>$fullHeader['NoteSummary']['totalcount'],'basket'=>$fullHeader['BasketSummary']['totalcount']));
				//,'favourites'=>$fullHeader['NoteSummary']['TotalCount'],'basket'=>$fullHeader['BasketSummary']['TotalCount']
				die();
			}


		} else {
			//Подгружаем данные через аякс
			$this->tpl->assign('userdata_ajax', '1');
		}
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