<?php
class EmployeesController extends CMS_Controller
{	

	

	
	public function actionAdd()
	{	
		//if ($this->has_otdels) 
		$this->model('employees')->initValues(array('otdels'));
		parent::actionAdd();
		
		
	}
    
    public function actionModify()
	
    {	
	
		
	    parent::actionModify();
    }
    
	
	public function actionShow()
	{	
		
		parent::actionShow();
	}
	
    public function actionList()
    {	

        parent::actionList();
    }
	
	public function actionList_employees_otdels()
	{
		$this->listCond['group'][] = 'employees_otdels.id';
		$this->listCond['order']['employees_otdels.id'] = 'asc';
		parent::actionList('employees_otdels');
	}
	public function actionAdd_otdel()
    {
        return $this->actionModify_otdel();
    }
    
    public function actionModify_otdel()
    {
        return parent::actionModify('employees_otdels');
    }
	
	
	public function actionDelete_image()
	{
		parent::actionDelete_file('employees');
	}
	public function actionDelete_otdel()
    {
        return parent::actionDelete('employees_otdels');
    }
}