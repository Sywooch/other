<?php
/**
 * @package    Diafan.CMS
 * Admin bootstrap
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

$brandtext = array(


'<a href="http://cms.diafan.ru" target="_blank">diafan.CMS</a> версия '.VERSION_CMS.'<br><br>
&copy; 2003-'.date("Y").' <a href="http://cms.diafan.ru/" target="_blank">cms.diafan.ru</a>'


,


'<img src="'.BASE_PATH.'adm/img/diafan.gif" align="left" width="36" height="46">'


,


'&copy; 2003-'.date("Y").' <a href="http://cms.diafan.ru/" target="_blank">cms.diafan.ru</a><br>
<a href="http://cms.diafan.ru" target="_blank">diafan.CMS</a> версия '.VERSION_CMS,
    
    '<div class="auth_copyright">
				    
					&copy; 2003-'.date("Y").' <a href="http://cms.diafan.ru/" target="_blank">cms.diafan.ru</a>
				</div>				
				<div class="auth_version">
					Версия '.VERSION_CMS.'
				</div>',
    
   


);
