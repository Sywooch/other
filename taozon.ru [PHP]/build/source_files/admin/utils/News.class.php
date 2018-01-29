<?php

class News {
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
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
						$news = $cms->GetAllNews();
            if ($news === -1) $news = $cms->GetAllNews();
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'news.php');
    }
    
    public function editAction()
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
            $id = $_GET['id'];
            settype($id, 'int');
            $news = $cms->GetNewsByID($id);
            
            $webui = $otapilib->GetWebUISettings($sid);
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'cms/editnews.php');
    }

    private function setActiveLang(){
        if(@$_GET['lang'])
            $_SESSION['menu_lang'] = @$_GET['lang'];
        if(!@$_SESSION['menu_lang']){
            $_SESSION['menu_lang'] = 'en';
        }
        return $_SESSION['menu_lang'];
    }
    
    public function addAction()
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
            $id = 'new';
            $news = array('id' => 'new');
            
            $webui = $otapilib->GetWebUISettings($sid);
        
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'cms/editnews.php');
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
            $id = $_GET['id'];
            settype($id, 'int');
            $cms->DeleteNewsByID($id);
            header('Location: ?cmd=news');
        }
        header('Location: ?cmd=news');
    }

    public function editsaveAction()
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
            $id = $_POST['id'];
            if ($id === 'new')
            {
                if (empty($_POST['title']))
                {
                    header('Location: ?cmd=news');
                    die;
                }
                $cms->CreateNews($_POST);
            } else {
                settype($id, 'int');
                $cms->UpdateNewsByID($id, $_POST);
            }
            header('Location: ?cmd=news');
            die;
        }
        header('Location: ?cmd=news');
    }
    
    public function blocksaveAction()
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
            $id = $_POST['id'];
            settype($id, 'int');
            $cms->UpdateNewsText($id, $_POST['text']);
            
            if(@$_POST['id'])
                header('Location: ../?p=news&id='.$_POST['id']);
            else
                header('Location: ../?p=allnews');
            
            die;
        }
        if(@$_POST['pid'])
            header('Location: ../?p='.@$_POST['back'].'&pid='.$_POST['pid']);
        else
            header('Location: ../?p='.@$_POST['back']);
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
