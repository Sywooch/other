<?php
/**
 * Ссылки на предыдущую и следующую страницы сайта
 *
 * Шаблон
 * шаблонного тега <insert name="show_previous_next" module="site" [template="шаблон"]>:
 * выводит ссылки на предыдующую и следующую страницы
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

if (! $result["previous"] && ! $result["next"])
{
	return;
}
echo '<div class="previous_next_links">';
if ($result["previous"])
{
	echo '<div class="previous_link"><a href="'.BASE_PATH_HREF.$result["previous"]["link"].'">&larr; '.$result["previous"]["name"].'</a></div>';
}
if ($result["next"])
{
	echo '<div class="next_link"><a href="'.BASE_PATH_HREF.$result["next"]["link"].'">'.$result["next"]["name"].' &rarr;</a></div>';
}
echo '</div>';
