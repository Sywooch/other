<?php
class EmployeesController2 extends Site_Content_Controller
{
	public function actionDefault()
	{
		if ($this->app->request->id) {
			$this->page->employee2 = $this->model('employees2')->GetByCond('employees2', 'employees2', array('where' => array('hidden' => 'no', 'id' => $this->app->request->id)));
			$this->page->content = $this->renderView('show');
			$this->loadView('main', null);
		} else {
			$this->page->employees2 = $this->model('employees2')->getList('employees2', 'employees2', array('where' => array('hidden' => 'no'), 'order' => array('pos' => 'asc')));
			$this->page->content = $this->renderView('list');
			$this->loadView('main', null);
		}
	}
}