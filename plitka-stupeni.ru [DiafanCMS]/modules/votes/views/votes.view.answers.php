<?php
/**
 * Результаты голосования
 *
 * Шаблон результатов голосования
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
	<input type="hidden" name="result" value="2">';
if (! empty($result))
{
	if(! empty($result['no_result']))
	{
	    $text .= '<div class="votes_no_result">'.$this->diafan->_('Результаты голосования недоступны.').'</div>';
	}
	else
	{
	    foreach ($result["answers"] as $row)
	    {
		$text .= '<div class="votes_answer">'.$row["name"].' - '.$row["persent"].'% ('.$row["count"].')';
		$text .= '<div class="votes_line" style="width: '.$row["persent"].'%"></div>';
		$text .= '</div>';
	    }
	    $text .= '<div class="votes_count">'.$this->diafan->_('Количество проголосовавших').': '.$result["summ"].'</div>';
	}
	
	$text .= (! empty($result["result"]) ? '
	<span class="button_wrap"><input type="submit" class="button" value="'.$this->diafan->_('Голосовать', false).'"></span>' : '');
}
return $text;