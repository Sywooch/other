<?php
class ReferalUser{
    private $login = '';     //Логин пользователя (чтобы не дергать из сервисов или сессий постоянно)
    private $userId = 0;     //Id пользователя 
    private $balance = 0.0;  //Бонусный счет
    private $category = 0;   //Статус пользователя в реферальной программе
	 	
		
    public function GetLogin() {	   
	   return $this->login;
	}			
    
	public function SetLogin($login) {
		$this->login = $login;
	}
	
	
 
    public function GetId() {
		return $this->userId;		
	}
    
	public function SetId($id) {
		$this->userId = $id;
	}
 
 
    public function GetBalance() {
		return $this->balance;	
	}
    
	public function SetBalance($balance) {
		$this->balance = $balance;
	}
		 
    public function GetCategory() {		
		return $this->category;		
	}
	
	//передаетсЯ id
    public function SetCategory($category) {
		$CatData = new ReferralCategoryManager(new CMS());
		$CatData->GetById($category);
		$this->category = $CatData->GetGroupName();
	}
	
	
}
?>
