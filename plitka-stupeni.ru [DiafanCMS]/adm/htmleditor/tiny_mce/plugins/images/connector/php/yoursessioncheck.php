<?php
/**
 * Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.1
 * @license http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2012 OOO "Диафан". (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))))).'/includes/404.php';
}

define('IS_ADMIN', 1);

include_once ABSOLUTE_PATH.'includes/customization.php';
Customization::inc('includes/developer.php');
require_once ABSOLUTE_PATH.'includes/core.php';
require_once ABSOLUTE_PATH.'includes/database.php';
DB::connect();
require_once ABSOLUTE_PATH.'includes/diafan.php';

Customization::inc('adm/includes/init.php');

global $diafan;
$diafan = new Init_admin();

Customization::inc('includes/session.php');

Customization::inc('includes/user.php');
$diafan->_user = new User();

Session::init();

if (! $diafan->_user->id || ! $diafan->_user->htmleditor)
{
    echo 'Доступ запрешен';
    exit;
}
