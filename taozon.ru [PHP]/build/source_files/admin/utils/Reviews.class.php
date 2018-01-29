<?php

class Reviews {
    /**
     * Public
     */
    public function defaultAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
		$from=0;
		$perpage=32;
		$count=0;
		if (isset($_GET['from']))
			$from = intval($_GET['from']);
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
			$comments = $cms->getNotAcceptedComments($from,$perpage);
			$count=$cms->getNumberOfComments();
		} else {
            include(TPL_DIR . 'cms.php');
            die;
        }
		$pageurl='/admin/index.php?cmd=reviews';
        include(TPL_DIR . 'reviews.php');
    }
    
    public function delAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $id = intval($_GET['id']);
            $cms->deleteComment($id);
            header('Location: ?cmd=reviews');
        }
        header('Location: ?cmd=reviews');
    }
	public function acceptAction()
	{
		global $otapilib;
		$sid = @$_SESSION['sid'];
		$webui = $otapilib->GetWebUISettings($sid);
		if ($otapilib->error_message == 'SessionExpired' || $sid == '')
		{
			header('Location: index.php?expired');
			die;
		}
		$cms = new CMS();
		$status = $cms->Check();
		if ($status)
		{
			$id = intval($_GET['id']);
			$cms->acceptComment($id);
			header('Location: ?cmd=reviews');
		}
		header('Location: ?cmd=reviews');
	}

    public function menuAction(){
        if (!Login::auth()){
            include(TPL_DIR.'login.php');
            return false;
        } 
        
        $cms = new CMS();
        if (!$cms->Check()){
            include(TPL_DIR . 'db_connection_fail.php');
            die;
        }
        
        $cms->checkTable('site_langs');
        $cms->checkTable('site_translations');
        $cms->checkTable('site_translation_keys');
        $langs = $cms->getLanguages();
        $current_lang = $this->setActiveLang();
        
        $all_docs = $cms->GetPagesByLang($current_lang);
        
        $cms->checkTable('site_blocks');
        $top_menu_json = $cms->getBlock('top_menu_'.$current_lang);
        
        $top_menu = array();
        if($top_menu_json){
            $top_menu = json_decode($top_menu_json);
        }
        
        include(TPL_DIR . 'menu/index.php');
    }
}

?>
