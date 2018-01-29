<?php
	
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class Discount extends GeneralUtil
{
    protected $_template = 'discount';
    protected $_template_path = 'pricing/';
    
    /**
     * @var DiscountProvider
     */
    protected $discountProvider;

    public function __construct()
	{
        parent::__construct();

        if (! CMS::IsFeatureEnabled('Discount')) {
            $this->redirect($this->getPageUrl()->generate(array('cmd' => 'pricing', 'do' => 'default')));
        }

        $this->discountProvider = new DiscountProvider($this->getOtapilib());
    }

    public function defaultAction($request)
	{
		try {		    
			$this->tpl->assign('discounts', $this->discountProvider->getDiscountGroupList());
			
		}
        catch (ServiceException $e) {			
            $this->errorHandler->CheckSessionExpired($e, $request);
        }
        print $this->fetchTemplate();
    }
	
	public function editDiscountAction($request)
	{
		$this->_template = 'discount_form';
		$discountGroup = array();
		if ($request->valueExists('groupId')) {
		    try {		    
			    $discounts = $this->discountProvider->getDiscountGroupList();
			    foreach ($discounts as $discount) { 
			        if ($discount['id'] == $request->get('groupId')) {
				       $discountGroup = $discount;
                    }  
			    }			    
		    }
            catch (ServiceException $e) {			   
               $this->errorHandler->CheckSessionExpired($e, $request);
            }
		}
		$this->tpl->assign('discountGroup', $discountGroup);
		$this->tpl->assign('isNew', $request->valueExists('groupId') ? false : true);
        print $this->fetchTemplate();
    }
	
	public function saveDiscountAction($request)
	{		
		try {		
			$params = $this->checkDiscountData($request);
			$this->discountProvider->saveDiscountGroup($params);						    
		}        
		catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
		$this->sendAjaxResponse();
    }
	
	public function groupInfoAction($request)
	{
		$this->_template = 'discount_group_info';
		$perpage = $request->valueExists('perpage') ? $request->get('perpage') : 10;
        $page = $request->valueExists('page') ? $request->get('page') : 1;
        $from = ($page > 1) ? ($page - 1) * $perpage : 0;		
		$discountGroup = array();
		try {		    
			$discountUsers = $this->discountProvider->getUsersOfDiscountGroup($request->get('groupId'), $from, $perpage);
			$discounts = $this->discountProvider->getDiscountGroupList();
			foreach ($discounts as $discount) { 
			    if ($discount['id'] == $request->get('groupId')) {
				   $discountGroup = $discount;
                }
			}
			
		}		
        catch (ServiceException $e) {		    
            $this->errorHandler->CheckSessionExpired($e, $request);
        }	
		
		$this->tpl->assign('discounts', $discounts);
		$this->tpl->assign('discountGroup', $discountGroup);
		$this->tpl->assign('discountUsers', $discountUsers);
		$this->tpl->assign('paginator', new Paginator($discountUsers['TotalCount'], $page, $perpage));
        print $this->fetchTemplate();
    }	
	
	public function deleteOrReplaceUserDiscountAction($request)
	{		   
		try {
			if (! $request->post('newGroupId')) { 
			   $this->discountProvider->removeUserFromDiscount($request->post('groupId'), $request->post('userId'));		
			} else {
			   $this->discountProvider->addUserToDiscount($request->post('newGroupId'), $request->post('userId'));
			}
		}		
        catch (ServiceException $e) {
           $this->respondAjaxError($e->getMessage());
        }
		$this->sendAjaxResponse();
    }
	
	public function deleteGroupAction($request)
	{		   
		try {		    
			$this->discountProvider->removeDiscountGroup($request->post('groupId'));			
		}		
        catch (ServiceException $e) {
           $this->respondAjaxError($e->getMessage());
        }
		$this->sendAjaxResponse();
    }
	
	public function addUserDiscountAction($request)
	{
		try {		    
			$this->discountProvider->addUserToDiscount($request->get('groupId'), $request->post('userId'));			
		}		
        catch (ServiceException $e) {
           $this->respondAjaxError($e->getMessage());
        }
		$this->sendAjaxResponse();
    }	
	
	public function getUsersForDiscountAction($request) 
	{
        try {
            $users = $this->discountProvider->findBaseUserInfoList($request);
            $usersJson = array();
			$fullUsersJson = array();
			foreach ($users['Content'] as $user) {
				$usersJson[] = $user['Login'];
                $fullUsersJson[] = array($user['Login'], $user['id']);
            }           
        }
        catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array(
            'options' => $usersJson, 
            'full' => $fullUsersJson
        ));		
    }

    private function checkDiscountData($request)
	{
        $params = $request->getValue('discountGroup');
        if (! isset($params['Name'])) {
            $params['Name'] = '';	
        } else {
            $params['Name'] = $params['Name'];            
        }
        if (isset($params['Description'])) {
            $params['Description'] = $params['Description'];
        }
        if (! isset($params['Discount'])) {
            $params['Discount'] = '';
        }
		if (! isset($params['DiscountIdentificationParametr'])) {
            $params['DiscountIdentificationParametr'] = '';
        }
        
        $validator = new Validator(array(
            'name'        => $params['Name'],
            'discount'      =>  $params['Discount'],
            'min_price'  => $params['DiscountIdentificationParametr']
        ));
        $validator->addRule(new NotEmpty(), 'name', LangAdmin::get('Discount_name_must_not_be_empty'));
        $validator->addRule(new NotEmpty(), 'discount', LangAdmin::get('Discount_value_must_not_be_empty'));
        $validator->addRule(new NotEmpty(), 'min_price', LangAdmin::get('Discount_start_price_must_not_be_empty'));
        
        $validator->addRule(new Range(0, 99), 'discount', LangAdmin::get('Discount_value_must_not_unprocent'));
        $validator->addRule(new Range(0, PHP_INT_MAX), 'min_price', LangAdmin::get('Minprice_must_be_greater_than_zero'));

        if (! $validator->validate()) {
           $errors = $validator->getLastError();
           throw new Exception((string)$errors);
        }
        return $params;
    }
    
}
