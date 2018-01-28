<?php
/**
 * Комментарии
 *
 * Шаблон вывода комментариев
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

$text = '<script type="text/javascript" src="'.BASE_PATH.'modules/comments/comments.js"></script>';
$text .= '<div class="comments"'.(empty($result["rows"]) ? ' style="display:none"' : '').'>';
$text .= '<div class="block_header">'.$this->diafan->_('Комментарии').'</div>';
if (! empty($result["rows"]))
{
	$text .= $this->get('list', 'comments', $result["rows"]);
}
$text .= '</div>';

if($result["form"])
{
	$text .= $this->get('form', 'comments', $result["form"]);
}
if($result["register_to_comment"])
{
	$text .= $this->diafan->_('Чтобы комментировать, зарегистрируйтесь или авторизуйтесь');
}
return $text;
