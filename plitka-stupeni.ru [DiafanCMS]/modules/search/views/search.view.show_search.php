<?php
/**
 * Форма поиска по сайту
 *
 * Шаблон
 * шаблонного тега <insert name="show_search" module="search"
 * [button="надпись на кнопке"] [template="шаблон"]>:
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

echo '
<div class="search">
	<form action="'.$result["action"].'" method="get">
	<input type="text" name="searchword" value="'.($result["value"] ? $result["value"] : $this->diafan->_('Поиск по каталогу', false)).'" class="input_search">
	<input type="submit" value="'.$result["button"].'" class="submit_search">
	</form>
</div>';