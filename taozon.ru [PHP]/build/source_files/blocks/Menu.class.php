<?php

class Menu extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 600;
    protected $_template = 'menu';
    protected $_template_path = '/menu/';
    protected $_hash = '';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;

        $isAdmin = isset($_GET['admin']);
		$available_amount = floor(@$GLOBALS['accountinfo']['availableamount']);
		$this->tpl->assign('deposit', $available_amount);
		$ticketsEnabled = false;
        $cms = new CMS();
        $status = $cms->Check();
        if($status) {
            $ticketsEnabled = $cms->checkTable ('site_support');
			if ($ticketsEnabled)
            {
                if (isset($GLOBALS['$otapilib->GetUserInfo']))
                {
                    $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
                } else {
                    if($isAdmin){
                        $userinfo = $otapilib->GetUserInfoForOperator(RequestWrapper::getValueSafe('sid'), RequestWrapper::getValueSafe('userid'));
                    }
                    else{
                        $userinfo = $otapilib->GetUserInfo(Session::getUserSession());
                        $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
                    }
                }
				$user = !$isAdmin ? $userinfo : array();
				if (isset($user['Id']))
					$unreadCount = $cms->getTicketMessagesCount(false, 'Out', 0,$user['Id']);
				else
                    $unreadCount=0;
				$newTicketAnswers = $unreadCount>0&&defined ('ADVANCED_SUPPORT_INTERFACE')?' ('.$unreadCount.')':'';
				$this->tpl->assign('newTicketAnswers', $newTicketAnswers);
			}
		}

        $this->tpl->assign('ticketsEnabled', $ticketsEnabled);

        //$this->tpl->assign('rootcats', $rootcats);
        if (isset($GLOBALS['catpath']))
        {
            $catpath = array_slice($GLOBALS['catpath'], 0, 1);
            //print_r($catpath);
            if (isset($catpath[0]))
            {
                $this->tpl->assign('cid', @$catpath[0]['id']);
            }
        }
    }
}

?>