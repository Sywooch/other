<?php
/**
 * Форма поиска
 *
 * Шаблон формы поиска по темам и сообщениям
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

echo '
<div class="forum_search">
	<form action="'.BASE_PATH_HREF.$result["action"].'" method="GET">
		<input type="text" name="searchword" value="'.(!empty($result["value"]) ? $result["value"] : '').'" size="20" class="inptext">
		<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Поиск', false).'" class="button"></span>
	</form>
</div>';