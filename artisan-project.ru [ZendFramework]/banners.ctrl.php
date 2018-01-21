<?php
class BannersController extends CMS_Controller
{
    public function actionDefault()
    {	
		
        return $this->actionList();
    }
    
    public function actionList()
    {	
		
		
		if($_SERVER['REQUEST_URI']=="banners/about_clients/"){
			return $this->actionList_about_clients();
			//return parent::actionList();
		}else{
    		return parent::actionList();
		}
	}
	
	
	public function actionList_about_clients()
	{   
	    
		$this->listCond['group'][] = 'about_clients.id';
		$this->listCond['order']['about_clients.id'] = 'asc';
		parent::actionList('about_clients');
	}
	public function actionList_about_partners()
	{   
	    
		$this->listCond['group'][] = 'about_partners.id';
		$this->listCond['order']['about_partners.id'] = 'asc';
		parent::actionList('about_partners');
	}
	public function actionList_about_sertificates()
	{   
	    
		$this->listCond['group'][] = 'about_sertificates.id';
		$this->listCond['order']['about_sertificates.id'] = 'asc';
		parent::actionList('about_sertificates');
	}
    public function actionList_about_docs()
	{   
	    
		$this->listCond['group'][] = 'about_docs.id';
		$this->listCond['order']['about_docs.id'] = 'asc';
		parent::actionList('about_docs');
	}
    public function actionList_about_fotogallery()
	{   
	    
		$this->listCond['group'][] = 'about_fotogallery.id';
		$this->listCond['order']['about_fotogallery.id'] = 'asc';
		parent::actionList('about_fotogallery');
	}
    public function actionList_main_slider()
	{   
	    
		//$this->listCond['group'][] = 'main_slider.pos';
		//$this->listCond['order']['main_slider.pos'] = 'asc';
		parent::actionList('main_slider');
	}
    
    public function actionAdd()
    {   
        parent::actionAdd();
    }
	
	public function actionAdd_client()
    {
        return $this->actionModify_client();
    }
	public function actionDelete_image_client()
	{
		parent::actionDelete_file('about_clients', $this->model('db', 'db'));
	}	
	public function actionAdd_partner()
    {
        return $this->actionModify_partner();
    }	
	public function actionDelete_image_partner()
	{
		parent::actionDelete_file('about_partners', $this->model('db', 'db'));
	}	
	public function actionAdd_sertificate()
    {
        return $this->actionModify_sertificate();
    }	
	public function actionAdd_main_slider()
    {
        return $this->actionModify_main_slider();
    }	
	public function actionDelete_image_sertificate()
	{
		parent::actionDelete_file('about_sertificates', $this->model('db', 'db'));
	}	
	public function actionAdd_about_doc()
    {
        return $this->actionModify_about_doc();
    }	
	public function actionDelete_image_about_doc()
	{
		parent::actionDelete_file('about_docs', $this->model('db', 'db'));
	}	
    
	public function actionAdd_about_fotogallery()
    {
        return $this->actionModify_about_fotogallery();
    }	
	public function actionDelete_image_about_fotogallery()
	{
		parent::actionDelete_file('about_fotogallery', $this->model('db', 'db'));
	}	
    
	
	
    public function actionModify()
    {
        parent::actionModify();
    }
	
    public function actionModify_client()
    {
        return parent::actionModify('about_clients');
    }
    public function actionModify_partner()
    {
        return parent::actionModify('about_partners');
    }
    public function actionModify_sertificate()
    {
        return parent::actionModify('about_sertificates');
    }
    public function actionModify_about_doc()
    {
        return parent::actionModify('about_docs');
    }
	public function actionModify_about_fotogallery()
    {
        return parent::actionModify('about_fotogallery');
    }
	public function actionModify_main_slider()
    {
        return parent::actionModify('main_slider');
    }
	
    
    public function actionDelete()
    {
        parent::actionDelete();
    }
	
    public function actionDelete_client()
    {
        return parent::actionDelete('about_clients');
    }	
    public function actionDelete_partner()
    {
        return parent::actionDelete('about_partners');
    }	
    public function actionDelete_sertificate()
    {
        return parent::actionDelete('about_sertificates');
    }	
    public function actionDelete_about_doc()
    {
        return parent::actionDelete('about_docs');
    }	
    public function actionDelete_about_fotogallery()
    {
        return parent::actionDelete('about_fotogallery');
    }	
	 public function actionDelete_main_slider()
    {
        return parent::actionDelete('main_slider');
    }   
    public function actionDelete_image()
    {
        $this->model()->deleteFileFromElement('banners', array('id' => $this->app->request->id), 'image'); 
        header("Location: /admin/banners/modify/id/".$this->app->request->id);
    }
}
?>
