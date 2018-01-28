<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Map_model
 *
 * Модель модуля "Карта сайта"
 */
class Inair_model extends Model
{

	public function show_list()
	{
		$arr=array();
		$this->diafan->_tpl->get('page', 'inair', $arr);
	}

}