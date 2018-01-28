<?php
/**
 * Страница фотографии
 *
 * Шаблон страницы с отдельной фотографии
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

if(empty($result["ajax"]))
{
	echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/photo/photo.js"></script>';
	echo '<div class="photo_id">';
}

//рейтинг фотографии
if (! empty($result["rating"]))
{
	echo $result["rating"];
}

//изображение и ссылка на следующее фото
if (! empty($result["img"]))
{
	echo '<div class="photo_img">';
	echo (!empty($result["next"])?'<a href="'.BASE_PATH_HREF.$result["next"]["link"].'">':'');
	echo '<img src="'.$result["img"]["src"].'" width="'.$result["img"]["width"].'" height="'.$result["img"]["height"].'"	alt="'.$result["img"]["alt"].'" title="'.$result["img"]["title"].'">';
	echo (!empty($result["next"])?'</a>':'');
	echo '</div>';
}

//краткое описание фотографии
if ($result["anons"])
{
	echo '<div class="photo_anons">';
	$this->htmleditor($result['anons']);
	echo '</div>';
}

//полное описание фотографии
echo '<div class="photo_text">';
$this->htmleditor($result['text']);
echo '</div>';

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="photo_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги фотографии
if (! empty($result["tags"]))
{
	echo $result["tags"];
}		

//ссылки на предыдущую и последующую фотографии
if (! empty($result["previous"]) || ! empty($result["next"]))
{
	echo '<div class="previous_next_links">';
	if (! empty($result["previous"]))
	{
		echo '<div class="previous_link"><a href="'.BASE_PATH_HREF.$result["previous"]["link"].'">&larr; '.$result["previous"]["text"].'</a></div>';
	}
	if (! empty($result["next"]))
	{
		echo '<div class="next_link"><a href="'.BASE_PATH_HREF.$result["next"]["link"].'">'.$result["next"]["text"].' &rarr;</a></div>';
	}
	echo '</div>';
}

//комментарии к фотографии
if (! empty($result["comments"]))
{
	echo $result["comments"];
}

if(empty($result["ajax"]))
{
	echo '</div>';
}