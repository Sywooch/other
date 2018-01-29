<?php
class UserData {
    /**
     * @var OTAPIlib
     */
    protected $otapilib;

    /**
     * @var FileAndMysqlMemoryCache
     */
    protected $fileMysqlMemoryCache;

    public function __construct()
    {
        $this->otapilib = new OTAPIlib();
        $this->otapilib->setErrorsAsExceptionsOn();

        $cms = new CMS();
        $cms->Check();
        $this->fileMysqlMemoryCache = new FileAndMysqlMemoryCache($cms);
    }

    public function getUserData()
    {
        $userFullInfo = array();
		$userFullInfo['UserData'] = $this->assignBatchGetUserData();        
		$userFullInfo['AccountData'] = $this->assignGetAccountInfo($userFullInfo['UserData']['Status']);
		return $userFullInfo;
    }

    public function BatchGetUserDataDecorator()
    {
        $blocks = 'UserStatus,BasketSummary,NoteSummary';        
        $sessionId = Session::getUserOrGuestSession();
        return $this->otapilib->BatchGetUserData($sessionId, $blocks);
    }
	
	public function assignBatchGetUserData()
    {
        $sessionId = Session::getUserOrGuestSession();		
        if($this->fileMysqlMemoryCache->Exists('BatchGetUserData:'.$sessionId)) {
            $userDataXMLRow = $this->fileMysqlMemoryCache->GetCacheEl('BatchGetUserData:'.$sessionId);
        } else{
            $this->otapilib->setResultInXMLOn();
            $userData = $this->BatchGetUserDataDecorator();
            $userDataXMLRow = $userData->asXML();
            $this->otapilib->setResultInXMLOff();
            $lifeTime = defined('CFG_OTAPI_CACHE_LIFETIME') ? CFG_OTAPI_CACHE_LIFETIME : 600;
            $this->fileMysqlMemoryCache->AddCacheEl('BatchGetUserData:'.$sessionId, $lifeTime, $userDataXMLRow);
        }
		return $this->otapilib->BatchGetUserData('', '', $userDataXMLRow);
    }
    
    public function getUserStatus()
    {        
        $isAccount = true;
        $this->otapilib->setErrorsAsExceptionsOn();
        try {
            $userStatus = $this->GetUserStatusInfoDecorator();            
        } catch(ServiceException $e){
            if ($e->getErrorCode() == 'SessionExpired') {                
                Session::clearUserData();
                $isAccount = false;
            }
        } catch(Exception $e){
            if ($e->getCode() ==  -1) {
                $isAccount = false;
            }
        }
        if ($isAccount) {
            Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);
        }
        return array(
            'isAccount' => $isAccount,
            'userStatus' => isset($userStatus) ? $userStatus : ''
        );
    }

    private function assignGetAccountInfo($userStatus)
    {
        if ($userStatus['IsSessionExpired'] == 'false') {
            Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);
            $keyCache = 'AccountInfo:' . $userStatus['Info'];        
            if ($this->fileMysqlMemoryCache->Exists($keyCache)) {
                $accountDataXMLRow = $this->fileMysqlMemoryCache->GetCacheEl($keyCache);               
            } else {
                $this->otapilib->setResultInXMLOn();
                $accountData = $this->GetAccountInfoDecorator();
                $accountDataXMLRow = $accountData->asXML();
                $lifeTime = defined('CFG_OTAPI_CACHE_LIFETIME') ? CFG_OTAPI_CACHE_LIFETIME : 60 * 5; // 5 минут
                $this->fileMysqlMemoryCache->AddCacheEl($keyCache, $lifeTime, $accountDataXMLRow);                
                $this->otapilib->setResultInXMLOff();
            }
            return array(
                'accountInfo' => $this->otapilib->GetAccountInfo('', $accountDataXMLRow),
                'userStatus' => $userStatus
            );
        } else {
            Session::clear(Session::getHttpHost() . 'isMayAuthenticated');
            return '';
        }
    }
    
    private function GetUserStatusInfoDecorator()
    {
        $sessionId = Session::getUserOrGuestSession();        
        return $this->otapilib->GetUserStatusInfo($sessionId);
    }
    
    private function GetAccountInfoDecorator()
    {
        $sessionId = Session::getUserOrGuestSession();
        return $this->otapilib->GetAccountInfo($sessionId);        
    }

    public function ClearUserDataCache()
    {
        $sessionId = Session::getUserOrGuestSession();
        $this->fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:'.$sessionId);
    }

    public function ClearAccountInfoCache()
    {
        $userStatus = $this->getUserStatus();
        if ($userStatus['isAccount']) {            
            $keyCache = 'AccountInfo:' . $userStatus['userStatus']['id'];
            $this->fileMysqlMemoryCache->DelCacheEl($keyCache);
        }
    }

    public function ClearAccountInfoCacheById($id)
    {
        $keyCache = 'AccountInfo:' . $id;
        $this->fileMysqlMemoryCache->DelCacheEl($keyCache);
    }
}