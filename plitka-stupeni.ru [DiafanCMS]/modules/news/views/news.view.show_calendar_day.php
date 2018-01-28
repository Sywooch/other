<?php
/**
 * Календарь архива новостей по дням
 * 
 * Шаблон
 * шаблонного тега <insert name="show_calendar" module="news" detail="day"
 * [cat_id="категория_новостей"] [site_id="страница_с_прикрепленным_модулем"]
 * [only_news="только_на_странице_модуля"] [template="шаблон"]>:
 * календарь архива новостей по дням
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

$text = '<div class="news_block">';
$text .= '<div class="block_header">'.$this->diafan->_('Календарь').'</div>';

$text .= '<script type="text/javascript" src="'.BASE_PATH.'modules/news/news.js"></script>';

$text .= '<form method="POST" enctype="multipart/form-data" action="" class="news_calendar_form">
<input type="hidden" name="module" value="news">
<input type="hidden" name="ajax" value="1">
<input type="hidden" name="action" value="calendar_arrow">
<input type="hidden" name="arrow" value="">
<input type="hidden" name="site_id" value="'.$result["site_id"].'">
<input type="hidden" name="cat_id" value="'.$result["cat_id"].'">
<input type="hidden" name="template" value="'.$result["template"].'">
<input type="hidden" name="year" value="'.$result['year'].'">
<input type="hidden" name="month" value="'.$result['month'].'">
		<a href="#" class="news_calendar_prev">&#171;</a>
		<span>'.$result['month_name'].'&nbsp;'.$result['year'].'</span>
		<a href="#" class="news_calendar_next">&#187;</a>
</form>';

$text .= '<table class="news_calendar">
<thead>
<tr>
	<th>'.$this->diafan->_('Пн').'</th>
	<th>'.$this->diafan->_('Вт').'</th>
	<th>'.$this->diafan->_('Ср').'</th>
	<th>'.$this->diafan->_('Чт').'</th>
	<th>'.$this->diafan->_('Пт').'</th>
	<th>'.$this->diafan->_('Сб').'</th>
	<th>'.$this->diafan->_('Вс').'</th>
</tr>
</thead>
<tbody>';
for($i = 0; $i < count($result['week']); $i++)
{
	$text .= '<tr>';
	for($j = 0; $j < 7; $j++) 
	{
		if(!empty($result['week'][$i][$j]["day"])) 
		{
			$text .= '<td'.($result['week'][$i][$j]["today"] ? ' class="news_day_today'.($result['week'][$i][$j]["day"] == $result["day"] ? ' news_day_current' : '').'"' : ($result['week'][$i][$j]["day"] == $result["day"] ? ' class="news_day_current"' : '')).'>';
			if ($result['week'][$i][$j]["count"] > 0) 
			{
				$text .= '<a href="'.BASE_PATH_HREF.$result['week'][$i][$j]["link"].'" title="'.$this->diafan->_('Новостей:', false).' '.$result['week'][$i][$j]["count"].'">'.$result['week'][$i][$j]["day"].'</a>';
			}
			else
			{
				$text .= $result['week'][$i][$j]["day"];
			}
			$text .='</td>';

		}
		else 
		{
			$text .='<td>&nbsp;</td>';
		}

	}
	$text .= '</tr>';
}
$text .= '</tbody></table>
	
</div>';
	
return $text;