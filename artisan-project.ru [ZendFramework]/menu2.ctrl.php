<?php
class MenuController2 extends CMS_Controller
{
    public function run() {
        $this->actionTree();
        $this->page->panel = $this->page->content;
        $this->posCond = array('pid' => $this->app->request->pid ? $this->app->request->pid : 0);
        parent::run();
    }

    /*Действие по умолчанию - список типов меню*/
    public function actionDefault(){
        $this->actionList();
    }
    
    public function actionChange()
    {
    	misc::empty_dir('.zf_cache/menu2/');
    	parent::actionChange();
    }
    
    public function actionList(){
        $pid = ($this->app->request->pid) ? $this->app->request->pid : 0;
        $this->listCond = array('where' => array('pid' => $pid));
        $this->page->items = $this->model()->getList(
            'menu',
            $this->model()->getFieldsNames('menu', 'list'),
            array(
                'where' => array('pid' => $pid),
                'order' => array('pos' => 'asc')));
        parent::actionList();
    }
    
    public function actionAdd(){
        misc::empty_dir('.zf_cache/menu2/');
        $this->model()->initValues(array('pid'));
        $pid = ($this->app->request->pid) ? $this->app->request->pid : 0;
        parent::actionAdd(null, null, array('pid' => $pid));
    }
    
    public function actionModify(){
        misc::empty_dir('.zf_cache/menu2/');
        $this->model()->initValues(array('pid'));
        parent::actionModify();
    }
    
    protected function actionTree(){
        $this->page->vTree     = $this->tree = $this->model('menu')->getTree(0, 0, 0, true);
        $this->page->treeLevel = 0;
        zf::addJS('jquery','/public/zf/js/jquery.js');
        zf::addJS('ui.core','/public/zf/js/jquery/ui.core.js');
        zf::addJS('jquery.cookie','/public/zf/js/jquery/jquery.cookie.js');
        zf::addJS('jquery.simple.tree','/public/cms/js/jquery.simple.tree.js');
        zf::addJS('tree_view','/public/cms/js/tree_view.js');
        zf::addCSS('simpletree', '/public/cms/css/simpletree.css');
        $this->page->content = $this->renderView('tree', 'menu');
    }

    public function actionDelete(){
        misc::empty_dir('.zf_cache/menu2/');
        return parent::actionDelete();
    }
}
?>
