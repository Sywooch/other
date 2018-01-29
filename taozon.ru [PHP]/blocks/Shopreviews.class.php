<?php

class Shopreviews extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'shopreviewsfullnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
	
	private $ShopReviews;

    public function __construct() {
        parent::__construct(true);
		$this->ShopReviews = new ShopReviewsRepository(new CMS());
    }

    protected function setVars()
    {
		global $otapilib;
		Session::checkErrors();        
        if (Session::getUserData()) {            
			$sid = Session::getUserSession();
       		$userData = $otapilib->GetUserInfo($sid);
			$this->tpl->assign('userinfo', $userData); 
        }  
		 
		if(! empty($_POST)){
		    if ($this->ShopReviews->AddReview($_POST)) {
				header('Location: index.php?p=shopreviews&add=1');
			} else {
				header('Location: index.php?p=shopreviews&add=error');
			}
			die();
		}
		if (RequestWrapper::getValueSafe('calc')) {
			try {
				$this->ShopReviews->SetRatingReview(RequestWrapper::getValueSafe('calc'),RequestWrapper::getValueSafe('to'));
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DBError');                
        	}
			header('Location: index.php?p=shopreviews');				
			die();
		}
			
		$allPosts = array();
        $GLOBALS['pagetitle'] = Lang::get('shopreviews');
		
	    $from = 0;
		$perpage = General::getConfigValue('shop_reviews_perpage', 8);			
		if (RequestWrapper::getValueSafe('from')) {
			$from = intval(RequestWrapper::getValueSafe('from'));
		}
				
		try {	
			$allPosts = $this->ShopReviews->GetReviews($from, $perpage);
			$allCount = $this->ShopReviews->GetModeratedCount();				
		} catch (DBException $e) {
       		Session::setError($e->getMessage(), 'DBError');                
        }
								
        $this->tpl->assign('shopreviews', $allPosts);
		$this->tpl->assign('count', $allCount);
		$this->tpl->assign('from', $from);
		$this->tpl->assign('perpage', $perpage);
		$this->tpl->assign('add', RequestWrapper::getValueSafe('add'));
		$this->tpl->assign('pageurl', 'index.php?p=shopreviews');
      
    }
}