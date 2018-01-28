<?php
/**
 * Вопросы для голосования
 *
 * Шаблон вопросов для голосования
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

$text = '
	<input type="hidden" name="question" value="'.$result["question_id"].'">
	<input type="hidden" name="ajax" value="0">
	<input type="hidden" name="module" value="votes">
	<input type="hidden" name="result" value="">';
if (! empty($result))
{
	foreach ($result["answers"] as $row)
	{
		$text .= '
		<div class="votes_form_answer">
			<input type="radio" name="answer" value="'.$row["id"].'"'.($row == $result["answers"][0] ? " checked" : '').'>
			'.$row["name"].'
		</div>';
	}
	$text .= !empty($result['userversion']) ? '<div class="votes_form_answer"><input type="radio" name="answer" value="userversion">'.$this->diafan->_('Свой вариант').'
			  <div class="votes_userversion" style="display: none;"><input type="text" name="userversion"></div></div>' : '';
	
	$text .= $result["captcha"].'								
		<span class="button_wrap"><input type="submit" class="button" value="'.$this->diafan->_('Голосовать', false).'"></span>';
	if(! $result["no_result"])
	{
		$text .= '<span class="votes_wrap"><input type="button" class="button votes_result" value="'.$this->diafan->_('Результаты', false).'"></span>';
	}
}
return $text;