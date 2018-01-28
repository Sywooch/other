<?php
/**
 * Вложнные страницы сайта
 *
 * Шаблон
 * шаблонного тега <insert name="show_links" module="site" [template="шаблон"]>:
 * выводит ссылки на страницы нижнего уровня, принадлежащие текущей странице
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

if (! $result)
{
	return;
}
echo '<ul class="show_links">';
foreach ($result as $row)
{
	echo '<li><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></li>';
}
echo '</ul>';
