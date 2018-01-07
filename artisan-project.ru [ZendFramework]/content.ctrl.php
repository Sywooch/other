<?php
class ContentController extends Site_Content_Controller
{
	public function run()
	{
		if ($this->ctrlName == 'content' and $this->app->request->id and empty($this->app->request->parr)) {
			$parents = $this->model('content')->getParents($this->app->request->id);
			$node = $this->model('content')->Get($this->app->request->id, 'content', array('path'));
			header('Location: /'.trim(implode('/', $parents)."/{$node['path']}", '/').'/');
		}
		parent::run();
	}
	
	public function actionNotFound($loadView = 0)
	{
		parent::actionNotFound(0);
		$this->loadView('404', null);
	}
	
	public function actionDefault()
	{
		$path = $this->app->request->parr ? $this->app->request->parr : array('/');
		if ($this->ctrlName != 'content' && empty($this->app->request->parr)) {
			$path[]=$this->ctrlName;
		}
		$page_content = $this->model('content')->getContentByPath($path);

        if ($page_content['path'] == '/') {
            $total = 0;

            //$this->page->main_news = $this->model('news')->getPage('news',
            //    $this->model('news')->getFieldsNames('news', 'listing'),
            //    $total, 0, 4,
            //    array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            //);
			/*$endis = $this->model('db')->getList(
                'factories',
                $this->model('db')->getFieldsNames('factories', 'list_factory'),
                array('where' => array('factories.hidden' => 'no'))
            );*/
			$this->page->country = $this->model('db')->getList(
			'countries',
			$this->model('db')->getFieldsNames('countries', 'show_country')
		);
			//print_r($country);
        }

		if (!empty($page_content['link'])) {
			if(strpos($page_content['link'], '/')) {
				list($ctrl, $action) = explode('/', $page_content['link']);
			} else {
				$ctrl = $page_content['link'];
				$action = '';
			}
			$this->app->ctrl = $this->app->loadCtrl($ctrl, 0);
			$this->page->ctrlName = $this->app->ctrl->ctrlName;
			array_shift($this->app->request->parr);
			$this->app->ctrl->action = $action;
			$this->app->ctrl->method =
			($action && method_exists($this->app->ctrl, 'action'.ucfirst($action)))
			? array($this->app->ctrl, 'action'.ucfirst($action))
			: array($this->app->ctrl, 'actionDefault')
			;
			
			$this->page->page_content_back = $page_content;
			 //$this->page->main_news = $this->model('news')->getPage('news',
             //   $this->model('news')->getFieldsNames('news', 'listing'),
             //   $total, 0, 4,
             //   array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            //);
			debug::add(ucfirst($ctrl).'Controller->'.$this->app->ctrl->method[1].'() started', 'log');
			$this->app->ctrl->run();
			return ;
		}
		//print_r($page_content);
		if (!isset($page_content['content']) or count($page_content['content']) == 0) {
			return $this->actionNotFound();
		}
			//$this->page->main_news = $this->model('news')->getPage('news',
            //    $this->model('news')->getFieldsNames('news', 'listing'),
            //    $total, 0, 4,
            //    array('where' => array('hidden' => 'no'), 'order' => array('date' => 'desc'))
            //);
		$this->page->page_content = $page_content;
		
		$this->loadView('main', null);
	}

    public function actionDelivery()
    {
		if (isset($this->app->request->parr[1]) and $this->app->request->parr[1] == 'get_zones') {
			echo json_encode($this->model('delivery')->getList('delivery_zones', array('id', 'title', 'points', 'color', 'border_color', 'content'), array('where' => array('show_item' => 1))));
			$this->app->request->ajax = 1;
			$this->app->contentType = 'application/json';
		} else {
			zf::addJS('maps.yandex', 'http://api-maps.yandex.ru/1.1/index.xml?key='.$this->app->conf['run_at'][$this->app->run_at]['yandex']['map']);
			zf::addJS('delivery', '/public/site/js/delivery.js');
			$this->page->content = $this->renderView('delivery', null);
			$this->loadView('main', null);
		}
    }
}