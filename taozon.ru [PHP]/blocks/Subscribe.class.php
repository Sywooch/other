<?php

OTBase::import('system.model.data_mappers.SubscriberMapper');
OTBase::import('system.model.entities.SubscriberEntity');

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
        $this->dataMapper = new SubscriberMapper(new CMS());
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
		$sid = Session::getUserSession();
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
        $found = $this->dataMapper->findByEmail($email);
		return count($found);
	}

	public static function SetSubscribe (){

        /**
         * @var OtapiUserInfoAnswer $user
         */
        OTAPILib2::GetUserInfo(Session::getUserSession(), $user);
        OTAPILib2::makeRequests();

        $userInfo = $user->GetUserInfo();

        $S = new SubscriberEntity();
        $S->setLogin($userInfo->GetLogin());
        $S->setOtapiId($userInfo->GetId()->asString());
        $S->setRegistered($userInfo->GetRegistrationDate());
        $S->setSex($userInfo->GetSex() == 'Male' ? SubscriberEntity::MALE : SubscriberEntity::FEMALE);
        $S->setEmail($userInfo->GetEmail());
        $S->setSkype($userInfo->GetSkype());
        $S->setName($userInfo->GetFirstName() ? $userInfo->GetFirstName() : $userInfo->GetRecipientFirstName());
        $S->setSurname($userInfo->GetLastName() ? $userInfo->GetLastName() : $userInfo->GetRecipientLastName());
        $S->setMiddleName($userInfo->GetMiddleName() ? $userInfo->GetMiddleName() : $userInfo->GetRecipientMiddleName());

        $dataMapper = new SubscriberMapper(new CMS());
        $dataMapper->save($S);

        header('Location: ' . UrlGenerator::generatePrivateOfficeUrl());
	}
	private function UnsetSubscribe (){
        $found = $this->dataMapper->findByLogin(Session::getUserDataByKey('username'));
        if ($found) {
            /**
             * @var SubscriberEntity $user
             */
            $user = $found[0];
            $this->dataMapper->remove($user->getId());
        }
        header('Location: ' . UrlGenerator::generatePrivateOfficeUrl());
	}
}
