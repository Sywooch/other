<?php

class Post extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'postnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
		
        parent::__construct(true);
    }
    
    protected function setVars()
    {
		
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $alias = SCRIPT_NAME;
            
						
            if(@$_GET['p'] == 'post' && RequestWrapper::getValueSafe('id')){
                $post = $cms->GetPostById((int)RequestWrapper::getValueSafe('id'));
				//Мелкая модернизация для вывода все х катеогрий в самом посте
				$allCats = $cms->GetAllDigestCategories();				
				//echo $post['content'];
            }
            
			$GLOBALS['pagetitle'] = Lang::get('post') . ' - ' . $post['title'];
            $this->tpl->assign('post', $post);
			//Мелкая модернизация для вывода все х катеогрий в самом посте
			$this->tpl->assign('digestCats', $allCats);
            
            $ssid = @$_SESSION['sid'];
            if ($ssid != '')
            {
                global $otapilib;
                $webui = $otapilib->GetWebUISettings($ssid);
                if ($otapilib->error_message !== 'SessionExpired')
                {
                    $this->tpl->assign('admin', true);
                    $admin = true;
                    if (isset($_GET['edit'])) $this->tpl->assign('show_editor', true);
                } else {
                    $this->tpl->assign('admin', false);
                    $admin = false;
                }
            }
            
            
        } else {
            //
		   
        }
        $this->tpl->assign('status', $status);
    }
}

?>
