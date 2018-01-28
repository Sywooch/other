<?php
/**
 * Форма редактирование подписки на новости
 *
 * Шаблон формы редактирования подписки на новости
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

if(! empty($result["act"]))
{
	echo '<p>'.$this->diafan->_('Вы подписаны на рассылку.').'</p>';
}
else
{
	echo '<p>'.$this->diafan->_('Вы не подписаны на рассылку.').'</p>';
}
if(! empty($result['cats']) || empty($result["act"]))
{
	if(! empty($result['cats']))
	{
		echo '<h2>'.$this->diafan->_('Категории рассылки').'</h2>';
	}
	echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax subscribtion_form">
	<input type="hidden" name="module" value="subscribtion">
	<input type="hidden" name="action" value="edit">
	<input type="hidden" name="code" value="'.$result['code'].'">
	<input type="hidden" name="mail" value="'.$result['mail'].'">
	<input type="hidden" name="ajax" value="0">';
	if(! empty($result['cats']))
	{
		foreach($result['cats'] as $cat)
		{
			echo str_repeat('&nbsp;', 4*$cat["level"]).'<input type="checkbox" name="cat_ids[]" value="'.$cat["id"].'"'.(! in_array($cat["id"], $result["cats_unrel"]) ? ' checked' : '').'> '.$cat["name"].'</br>';
		}
	}
	echo '<span class="button_wrap">
	<input type="submit" class="button" value="'.$this->diafan->_('Подписаться', false).'">
	</span>
	<div class="errors error" style="display:none"></div>
	</form>';
}
if(! empty($result["act"]))
{
	echo '<p>'.$this->diafan->_('Чтобы отписаться пройдите по ссылке').' <a href="'.$result['link'].'">'.$result['link'].'</a></p>';
}
