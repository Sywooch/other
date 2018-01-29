<?php

class MoneyInfo extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'moneyinfo'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/privateoffice/';
	
	protected $request;	
	protected $sid;

   
    public function __construct()
    {
        parent::__construct(true);
		$this->request = new RequestWrapper();		
		
    }

    protected function setVars()
    {        
		$this->otapilib->setErrorsAsExceptionsOn();
        if(!Session::getUserData()){
            Users::Logout();
            header('Location: index.php?p=login');
            return ;
        }    
		$this->sid = Session::getUserSession();     
        $result = Plugins::onRenderMoneyInfo($this->sid);
        if($result){
            if(is_array($result))
                foreach($result as $k=>$v){
                    $this->tpl->assign($k, $v);
                }
            return ;
        }
        if (!$this->request->valueExists('fromdate')) {
            $fromdate = date('m/d/Y', time() - 30*24*3600);
        } else {
			$fromdate = $this->request->getValue('fromdate');
		}
        if (!$this->request->valueExists('todate')) {
            $todate = date('m/d/Y', time());
        } else {
			$todate = $this->request->getValue('todate');
		}
        $fromdate = $this->_formateDate($fromdate);
        $todate = $this->_formateDate($todate);

        if (CFG_MULTI_CURL)
        {
            // С мультипотоками
            // Инициализируем
            $this->otapilib->InitMulti();
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $this->otapilib->GetUserInfo($this->sid);
            }
            $accountinfo = $this->otapilib->GetAccountInfo($this->sid);
            $moneyhistory = $this->otapilib->GetStatement($this->sid, $fromdate, $todate);
            // Делаем запросы
            $this->otapilib->MultiDo();
			try{
            	if (isset($GLOBALS['$otapilib->GetUserInfo']))
            	{
                	$userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            	} else {
                	$userinfo = $this->otapilib->GetUserInfo($this->sid);
                	$GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            	}
            	$accountinfo = $this->otapilib->GetAccountInfo($this->sid);
            	$moneyhistory = $this->otapilib->GetStatement($this->sid, $fromdate, $todate);
			}
			catch(ServiceException $e){
				Session::setError($e->getMessage());
			}
            // Сбрасываем
            $this->otapilib->StopMulti();
        } else {
            // По старому
			try{
            	if (isset($GLOBALS['$otapilib->GetUserInfo']))
            	{
                	$userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            	} else {
                	$userinfo = $this->otapilib->GetUserInfo($this->sid);
                	$GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            	}
            	$accountinfo = $this->otapilib->GetAccountInfo($this->sid);
            	$moneyhistory = $this->otapilib->GetStatement($this->sid, $fromdate, $todate);
			}
			catch(ServiceException $e){
				Session::setError($e->getMessage());
			}
        }
        //var_dump($moneyhistory); echo 'error='.$otapilib->error_message;
        $this->tpl->assign('userinfo', $userinfo);
        $this->tpl->assign('accountinfo', $accountinfo);
        $this->tpl->assign('moneyhistory', $moneyhistory);
        
    }	
	
	
    private function _formateDate($date)
    {
        $date_array = explode('/', $date);
        return $date_array[1].'.'.$date_array[0].'.'.$date_array[2];
    }
}

?>