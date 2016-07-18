<?php
class EmployeesController extends Site_Content_Controller
{
	public function actionDefault()
	{
		if ($this->app->request->id) {
			$this->page->employee = $this->model('employees')->GetByCond('employees', 'employees', array('where' => array('hidden' => 'no', 'id' => $this->app->request->id)));
			$this->page->content = $this->renderView('show');
			$this->loadView('main', null);
		} else {
			$this->page->employees = $this->model('employees')->getList('employees', 'employees', array('where' => array('hidden' => 'no'), 'order' => array('pos' => 'asc')));
			$this->page->content = $this->renderView('list');
			$this->loadView('main', null);
		}
	}
}