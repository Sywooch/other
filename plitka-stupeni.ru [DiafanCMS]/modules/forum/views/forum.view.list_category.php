<?php
/**
 * Список категорий
 *
 * Шаблон списка категорий форума
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

echo '<script type="text/javascript" src="'.BASE_PATH.'modules/forum/forum.js"></script>';

echo ($result["access_add"] ? '<div class="forum_add"><a href="'.BASE_PATH_HREF.$result["link_add"].'">'.$this->diafan->_('Добавить тему').'</a></div>' : '').'

<table class="forum_list">
	<tr><th>'.$this->diafan->_('Темы').'</th><th>'.$this->diafan->_('Ответы').'</th><th>'.$this->diafan->_('Автор').'</th><th colspan="2">'.$this->diafan->_('Последний ответ').'</th></tr>';
foreach ($result["rows"] as $row)
{
	$result["row"] = $row;
	echo '<tr id="forum_category_'.$row["id"].'" class="forum_category">'.$this->get('list_id_category', 'forum', $result).'</tr>';
}
echo '
</table>
'.(!empty($result["paginator"]) ? $result["paginator"] : '');

// форма поиска по темам и сообщениям
$this->get('form_search', 'forum', array("action" => $result["action"]));
