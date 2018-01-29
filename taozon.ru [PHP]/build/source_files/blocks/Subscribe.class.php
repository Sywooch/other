<?php

class Subscribe extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 600;
    protected $_template = 'subscribe';
    protected $_template_path = '/privateoffice/';
    protected $_hash = '';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        $cms = new CMS();
        $status = $cms->Check();
        if($status)
            $cms->checkTable ('subscription');
		if (isset ($_GET['subscribe'])){
			if ($_GET['subscribe'])
				$this->SetSubscribe();
			else
				$this->UnsetSubscribe();
		}
		global $otapilib;
		$sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        if (isset($GLOBALS['$otapilib->GetUserInfo']))
        {
            $userData = $GLOBALS['$otapilib->GetUserInfo'];
        } else {
            $userData = $otapilib->GetUserInfo($sid);
            $GLOBALS['$otapilib->GetUserInfo'] = $userData;
        }
		$this->tpl->assign('subscribed', $this->GetUserSubscribe($userData['Email']));
    }
	private function GetUserSubscribe($email){
        $cms = new CMS();
        $cms->Check();
		$res = mysql_query('SELECT `subscription` FROM `subscription` WHERE `email`="'.$email.'"');
		if(is_resource($res) && $row = mysql_fetch_assoc($res)){
			return true;
		}
		return false;
	}
	private function SetSubscribe ($subscribe='news'){
		global $otapilib;
		$userInfo = $otapilib->GetUserInfo($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']);
        $cms = new CMS();
        $cms->Check();
		$res = mysql_query('INSERT INTO `subscription`(subscription,email,name,date,user_id)'.
			' VALUES("'.$subscribe.'","'.$userInfo['email'].'","'.
			$userInfo['LastName'].' '.$userInfo['FirstName'].' '.$userInfo['MiddleName'].'","'.
			date('Y.m.d').'","'.$_SESSION[CFG_SITE_NAME.'loginUserData']['username'].'") ON DUPLICATE KEY UPDATE'.
			' name="'.$userInfo['LastName'].' '.$userInfo['FirstName'].' '.$userInfo['MiddleName'].'",user_id="'.$_SESSION[CFG_SITE_NAME.'loginUserData']['username'].'"');
		return $res;
	}
	private function UnsetSubscribe ($subscribe='news'){
        $cms = new CMS();
        $cms->Check();
		$res = mysql_query('DELETE FROM `subscription` WHERE `subscription`="'.$subscribe.'" AND user_id="'.$_SESSION[CFG_SITE_NAME.'loginUserData']['username'].'"');
		return $res;
	}
}

?>