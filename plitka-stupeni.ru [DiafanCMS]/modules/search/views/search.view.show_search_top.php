<?php
/**
 * Форма поиска по сайту, шаблон top
 *
 * Шаблон
 * шаблонного тега <insert name="show_search" module="search" template="top"
 * [button="надпись на кнопке"]>:
 * форма поиска по сайту
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

echo '<script type="text/javascript" src="'.BASE_PATH.'modules/search/search.js"></script>

	<form class="search_form" action="'.$result["action"].'" method="get">
	<input type="text" name="searchword" value="'.($result["value"] ? $result["value"] : $this->diafan->_('Поиск по каталогу', false)).'" class="input_search search_form" >
	<input type="submit" value="'.$result["button"].'" class="submit_search">
	</form>
';