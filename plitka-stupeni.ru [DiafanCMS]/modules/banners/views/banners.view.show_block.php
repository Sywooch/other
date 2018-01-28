<?php
/**
 * Баннеры
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="banners" [count="all|количество"]
 * [cat_id="категория"] [id="номер_баннера"] [template="шаблон"]>:
 * блок баннеров
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

if (empty($result))
{
	return false;
}               

if(! isset($GLOBALS['include_banners_js']))
{
	echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/banners/banners.js"></script>';
	$GLOBALS['include_banners_js'] = true;
	//скрытая форма для отправки статистики по кликам
	echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax banners_form">
	<input type="hidden" name="module" value="banners">
	<input type="hidden" name="banner_id" value="0">
	<input type="hidden" name="ajax" value="0"></form>';
}
echo '<div class="banners_block">';
foreach($result as $row)
{
	if (!empty($row['link']))
	{
		echo '<a href="'.$row['link'].'" class="banners_counter" rel="'.$row['id'].'" '.(!empty($row['target_blank']) ? 'target="_blank"' : '').'>';
	}
	
	//вывод баннера в виде html разметки
	if (!empty($row['html']))
	{
		echo $row['html'];
	}
	
	//вывод баннера в виде изображения
	if (!empty($row['image']))
	{
		echo '<img src="'.BASE_PATH.USERFILES.'/banners/'.$row['image'].'" alt="'.(!empty($row['alt']) ? $row['alt'] : '').'" title="'.(!empty($row['title']) ? $row['title'] : '').'">';
	}
	
	
	//вывод баннера в виде flash
	if (!empty($row['swf']))
	{
			echo '<object type="application/x-shockwave-flash" 
			data="'.BASE_PATH.USERFILES.'/banners/'.$row['swf'].'" 
			width="'.$row['width'].'" height="'.$row['height'].'">
			<param name="movie" value="'.BASE_PATH.USERFILES.'/banners/'.$row['swf'].'" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="play" value="true" />
			<param name="loop" value="true" />
			<param name="wmode" value="opaque">
			<param name="scale" value="showall" />
			<param name="menu" value="true" />
			<param name="devicefont" value="false" />
			<param name="salign" value="" />
	
			<param name="allowScriptAccess" value="sameDomain" />
	
		</object>';
	}
	
	if (!empty($row['link']))
	{
		echo '</a>';
	}
	
}
echo '</div>';