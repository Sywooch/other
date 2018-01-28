<?php
/**
 * Языки сайта
 *
 * Шаблон
 * шаблонного тега <insert name="show_block" module="languages" id="номер_страницы" [template="шаблон"]>:
 * выводит блок ссылок на альтернативные языковые версии сайта
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
	return false;
}

echo '<div class="top_lang">
<div class="top_lang_left"></div>
<div class="top_lang_right"></div>';
foreach ($result as $row)
{
	if($row["current"])
	{
		echo $row["name"];
	}
	else
	{
		echo '<a href="'.$row["link"].'">'.$row["name"].'</a>';
	}
	echo ' ';
}
echo '</div>';