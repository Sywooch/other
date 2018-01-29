<?php
class Quittance extends GeneralUtil{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'quittance';
    protected $_template_path = 'site_config/';

    public function __construct(){
		parent::__construct();
    }

    public function defaultAction(){
		if(!$this->checkAuth()||$_SESSION['active_lang_admin']!=='ru'||!$this->cmsStatus){
			header('Location: index.php?cmd=siteConfiguration');
			return false;
		}

		$this->tpl->assign('siteConfig', $this->cms->getSiteConfig());

        print $this->fetchTemplate();
    }

    public function saveQuittanceAction(){
        if(!$this->checkAuth()) return false;
        if(!$this->cmsStatus)
            return $this->setErrorAndRedirect(LangAdmin::get('error_connecting_to_database'),
                'index.php?cmd=quittance');

        $this->cms->saveSiteConfig($_POST);
        header('Location: index.php?cmd=quittance');
    }
}
