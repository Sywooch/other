<?php

class Referral extends GenerateBlock {

	protected $_cache = false; //- кэшируем или нет.
	protected $_life_time = 3600; //- время на которое будем кешировать
	protected $_template = 'index'; //- шаблон, на основе которого будем собирать блок
	protected $_template_path = '/referral/';
    /**
     * @var CMS
     */
    private $cms;

	public function __construct() {
		parent::__construct(true);
        $this->cms = new CMS();
	}

	protected function setVars() {
        global $otapilib;
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData']))
            header('Location: index.php');

		$user_login = $_SESSION[CFG_SITE_NAME.'loginUserData']['username'];
		$cms = new CMS();
		$status = $cms->Check();
		$statuses = array(
			'-'
			, 'Участник'
			, 'Лидер'
			, 'Босс'
			, 'Президент'
		);


		$cms->checkTable('site_referrals');
		$user = $cms->GetUserByLogin($user_login);

		$this->tpl->assign('user', $user);
        $this->tpl->assign('statuses', $statuses);
        $this->tpl->assign('messages', $this->getMessages());
	}

    public function getMessages(){
        $this->cms->Check();
        $this->cms->checkTable('site_referrals_messages');
        $q = mysql_query('SELECT * FROM site_referrals_messages WHERE direction = "out" AND login = "'.$_SESSION[CFG_SITE_NAME.'loginUserData']['username'].'"
        ORDER BY added DESC');
        $result = array();
        while($result[] = mysql_fetch_assoc($q)){}
        return $result;
    }
}
