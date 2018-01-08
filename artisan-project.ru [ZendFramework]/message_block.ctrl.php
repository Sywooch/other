<?php
class MessageBlockController extends CMS_Controller
{
    public function actionDefault()
    {
        return $this->actionList();
    }
    
    public function actionList()
    {
    	return parent::actionList();
    }
    
    public function actionAdd()
    {
        parent::actionAdd();
    }
    
    public function actionModify()
    {
        parent::actionModify();
    }
    
    public function actionDelete()
    {
        parent::actionDelete();
    }
    

}
?>
