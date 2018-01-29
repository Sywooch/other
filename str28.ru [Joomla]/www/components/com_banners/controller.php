<?php
/**
 * @package		Retina.Site
 * @subpackage	com_banners
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.controller');

/**
 * Banners Controller
 *
 * @package		Retina.Site
 * @subpackage	com_banners
 * @since		1.5
 */
class BannersController extends JController
{
	function click()
	{
		$id = JRequest::getInt('id', 0);

		if ($id) {
			$model = $this->getModel('Banner', 'BannersModel', array('ignore_request'=>true));
			$model->setState('banner.id', $id);
			$model->click();
			$this->setRedirect($model->getUrl());
		}
	}
}
