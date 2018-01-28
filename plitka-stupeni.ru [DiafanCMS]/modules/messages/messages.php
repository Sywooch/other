<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Messages extends Controller
{

    public function init()
    {
		if(! $this->diafan->_user->id)
		{
			include_once ABSOLUTE_PATH.'includes/404.php';
			return false;
		}

		$this->rewrite_variable_names = array('page', 'show');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;

		$model = new Messages_model($this->diafan);

		if ($this->diafan->show)
		{
			$this->result = $model->id();
		}
		else
		{
			$this->result = $model->list_();
		}

		$this->get_global_variables();
    }

    public function show_module()
    {
		if ($this->diafan->show)
		{
			$this->diafan->_tpl->get('id', $this->diafan->module, $this->result);
		}
		else
		{
			$this->diafan->_tpl->get('list', $this->diafan->module, $this->result);
		}
		return true;
    }

}