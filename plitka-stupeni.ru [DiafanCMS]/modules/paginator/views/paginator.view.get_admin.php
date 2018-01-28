<?php
/**
 * Постраничная навигация
 *
 * Шаблон постраничной навигации для пользовательской части
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

if(isset($_GET['view']) && $_GET['view']=='all')
{
	$all=true;
}

function check_page($array,$page_name)
{
	foreach ($array as $l)
	{
		if($l['name']==$page_name)
			return true;
	}
	return false;
}
$text = '';
$next = '';
$prev = '';
if ($result)
{
	$text .= '<div class="paginator">';
	foreach ($result as $l)
	{
		switch($l["type"])
		{
			case "first":
				if(!check_page($result,'1'))
					$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'">Первая</a> ';
				break;

			case "current":
				if($all)
				{
					$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'">'.$l["name"].'</a> ';
				}
				else
				{
					$text .= '<span>'.$l["name"].'</span> ';
				}
				break;

			case "previous":
				//$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На предыдущую страницу', false).'">...</a> ';
				//if(!check_page($result,'1'))
					$prev = BASE_PATH_HREF.$l["link"];
				//else
				//	$prev = false;
				break;

			case "next":
				//$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'" title="'.$this->diafan->_('На следующую страницу', false).' '.$this->diafan->_('Всего %d', false, $l["nen"]).'">...</a> ';
				//if(!check_page($result,$l['nen']))
					$next = BASE_PATH_HREF.$l["link"];
				//else
					//$next = false;
				break;

			case "last":
				if(!check_page($result,$l['nen']))
					$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'">Последняя('.$l['nen'].')</a> ';
			break;

			default:
				$text .= '<a href="'.BASE_PATH_HREF.$l["link"].'">'.$l["name"].'</a> ';
				break;
		}
	}
	if(isset($all))
	{
		$text .= '<span>Показать все</span></div>';
	}
	else
	{
		$text .= '<a href="'.BASE_PATH_HREF .substr($_SERVER['REQUEST_URI'],1,strlen($_SERVER['REQUEST_URI'])-1).$sort_param.'?view=all'.'">Показать все</a>';
	}
$text .= '<div class="next-prev-buttons">';
if($prev)
	$text .= '<a href="'.$prev.'">< предыдущая</a>';
if($next)
	$text .= '<a href="'.$next.'">следующая ></a>';
$text .= '</div>'.($prev ? '':'<style>.next-prev-buttons{left:597px}</style>');
$text .= '<div class="next-prev-buttons-2">';
if($prev)
	$text .= '<a href="'.$prev.'">< предыдущая</a>';
if($next)
	$text .= '<a href="'.$next.'">следующая ></a>';
$text .= '</div>'.($prev ? '':'<style>.next-prev-buttons{left:597px}</style>');
}
return $text;