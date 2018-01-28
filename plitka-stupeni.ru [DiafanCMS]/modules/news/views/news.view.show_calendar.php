<?php
/**
 * Календарь архива новостей
 * 
 * Шаблон
 * шаблонного тега <insert name="show_calendar" module="news"
 * [cat_id="категория_новостей"] [site_id="страница_с_прикрепленным_модулем"]
 * [only_news="только_на_странице_модуля"] [detail="детализация:month|year"]
 * [template="шаблон"]>:
 * календарь архива новостей
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

echo '<div class="news_block">';
echo '<div class="block_header">'.$this->diafan->_('Архив').'</div>';

foreach ($result["rows"] as $key => $values)
{
	if ($result["year"] == $key && ! $result["month"])
	{
		echo '<div class="news_year_current">'.$values["year"]["name"].'</div>';
	}
	else
	{
		echo '<div class="news_year"><a href="'.BASE_PATH_HREF.$values["year"]["link"].'">'.$values["year"]["name"].'</a></div>';
	}
	if (($result["year"] == $key || ! $result["year"] && date("Y") == $key) && ! empty($values["months"]))
	{
		foreach ($values["months"] as $keym => $month)
		{
			if ($result["month"] == $keym && ! $result["day"])
			{
				echo '<div class="news_month_current">'.$month["name"].'</div>';
			}
			elseif (! $month["link"])
			{
				echo '<div class="news_month">'.$month["name"].'</div>';
			}
			else
			{
				echo '<div class="news_month"><a href="'.BASE_PATH_HREF.$month["link"].'">'.$month["name"].'</a></div>';
			}
		}
	}
}
echo '</div>';