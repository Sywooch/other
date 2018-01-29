<?php

class ContentData extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'content'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
	
	/**
     * @var cms
     */
    protected $cms;
	
    public function __construct()
    {
        parent::__construct(true);
		$this->cms = new CMS();	
    }

    protected function setVars()
    {        
        $this->cms->checkSiteUnavailablePageExists();
        if ($this->cms->Check()) {
			try {
            	$alias = @General::$siteConf['site_temporary_unavailable'] ? 'site_unavailable' : SCRIPT_NAME;
            	if($this->request->valueExists('pid')) {
                	$page = $this->cms->GetFullPageById((int)$this->request->getValue('pid'));
            	} else {
                	$page = $this->cms->GetPageByAlias($alias);
                    if (! $page) {
                        $page = $this->cms->GetPageByAlias('404'); 
                    }
            	}
            	$this->tpl->assign('page', $page);
            	$ssid = @$_SESSION['sid'];
            	if ($ssid != '')
            	{
                	global $otapilib;
					$otapilib->setErrorsAsExceptionsOn();
                	$webui = $otapilib->GetWebUISettings($ssid);
                	if ($otapilib->error_message !== 'SessionExpired')
                	{
                    	$this->tpl->assign('admin', true);
                    	$admin = true;
                    	if ($this->request->valueExists('edit')) $this->tpl->assign('show_editor', true);
                	} else {
                    	$this->tpl->assign('admin', false);
                    	$admin = false;
                	}
            	}           

            	$text = $page['text'];
            	$this->tpl->assign('text', $text);
				
			} catch (DBException $e) {
                Session::setError($e->getMessage(), 'DBError');                
            }
			catch(ServiceException $e){
            	Session::setError($e->getMessage(), $e->getErrorCode());
        	}        	
        } 
        $this->tpl->assign('status', $this->cms->Check());
    }    

}

?>