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
 * Forum_admin_role
 *
 * Права пользователя для пользовательской части  модуля "Форум"
 */
class Forum_admin_role
{
	/**
	 * Возвращает права
	 * @return array
	 */
    public function get_rules()
	{
	    $rules = array('moderator' => 'Модератор');
	    return $rules;
	}
}