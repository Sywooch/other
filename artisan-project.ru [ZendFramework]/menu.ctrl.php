<?php
class MenuController extends CMS_Controller
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
    	misc::empty_dir('.zf_cache/menu/');
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
	
	public function actionList_top_menu()
	{
		//$this->listCond['order'] = array('text1' => 'asc','text2' => 'asc');
		$this->listCond['group'][] = 'top_menu.id';
		$this->listCond['order']['top_menu.id'] = 'asc';
		parent::actionList('top_menu');
	}
 	public function actionList_bottom_menu()
	{
		//$this->listCond['order'] = array('text1' => 'asc','text2' => 'asc');
		$this->listCond['group'][] = 'bottom_menu.id';
		$this->listCond['order']['bottom_menu.id'] = 'asc';
		parent::actionList('bottom_menu');
	}   
	
    public function actionAdd(){
        misc::empty_dir('.zf_cache/menu/');
        $this->model()->initValues(array('pid'));
        $pid = ($this->app->request->pid) ? $this->app->request->pid : 0;
        parent::actionAdd(null, null, array('pid' => $pid));
    }
    public function actionAdd_top_menu(){
        misc::empty_dir('.zf_cache/menu/');
        //$this->model()->initValues(array('pid'));
        //$pid = ($this->app->request->pid) ? $this->app->request->pid : 0;
        //parent::actionAdd(null, null, array('pid' => $pid));
    	return $this->actionModify_top_menu();
	}
    public function actionAdd_bottom_menu(){
        misc::empty_dir('.zf_cache/menu/');
        //$this->model()->initValues(array('pid'));
        //$pid = ($this->app->request->pid) ? $this->app->request->pid : 0;
        //parent::actionAdd(null, null, array('pid' => $pid));
    	return $this->actionModify_bottom_menu();
	}
    
    public function actionModify(){
        misc::empty_dir('.zf_cache/menu/');
        $this->model()->initValues(array('pid'));
        parent::actionModify();
    }
    public function actionModify_top_menu(){
        misc::empty_dir('.zf_cache/menu/');
         
		$this->model('menu', 'menu')->initValues(array('top_menu'));
		
		unset($this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['am']['values']);
		
		
		$this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['am']['values'][0]="Корень";
		
		$ad=zf::$db->query("SELECT * FROM ad_top_menu WHERE parent='0' ORDER BY id");
		$enum="enum(";
		$cnt=0;
		foreach($ad as $v){
			if($cnt==0){
				$enum=$enum."'".$v['id']."'";	
			}else{
				$enum=$enum.",'".$v['id']."'";
			}
			$cnt++;		
			$this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['am']['values'][$v['id']]=$v['text'];
		}
		$enum=$enum.");";
		$this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['type']=$enum;
		
		//echo $this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['type'];
		
		
		//$this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']['am']['values'][1]="Каталог";
		
		
		//echo "<pre>";
		//print_r($this->app->ctrl->models['menu']->conf['tables']['top_menu']['fields']['parent']);
		//echo "</pre>";
		
		return parent::actionModify('top_menu');
       
		//$this->model()->initValues(array('pid'));
		//parent::actionModify();
    }
    public function actionModify_bottom_menu(){
        misc::empty_dir('.zf_cache/menu/');
        //$this->model()->initValues(array('pid'));
        
		$this->model('menu', 'menu')->initValues(array('bottom_menu'));
		return parent::actionModify('bottom_menu');
        
		//parent::actionModify();
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
        misc::empty_dir('.zf_cache/menu/');
        return parent::actionDelete();
    }
    public function actionDelete_top_menu(){
        misc::empty_dir('.zf_cache/menu/');
        return parent::actionDelete('top_menu');
		//return parent::actionDelete();
    }
    public function actionDelete_bottom_menu(){
        misc::empty_dir('.zf_cache/menu/');
        return parent::actionDelete('bottom_menu');
		//return parent::actionDelete();
    }

}
?>
