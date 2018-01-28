<?php
/**
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

/**
 * Tags_admin_view
 * 
 * Шаблон вывода тегов в административной части
 */
class Tags_admin_view extends Diafan
{
	/**
	 * Выводит теги, прикрепленные к элементу модуля
	 *
	 * @param integer $element_id номер элемента
	 * @return string
	 */
	public function show($element_id)
	{
		$text = '';
		$result = DB::query("SELECT n.[name], t.id, n.id AS tags_name_id FROM {tags_name} as n"
							." INNER JOIN {tags} as t ON t.tags_name_id=n.id"
							." WHERE t.module_name='%h' AND t.element_id='%d'"
							." AND n.trash='0' AND t.trash='0'"
							." GROUP BY n.id ORDER BY n.sort ASC",
		                    $this->diafan->rewrite, $element_id);
		while ($row = DB::fetch_array($result))
		{
			$text .= '
			<a href="'.BASE_PATH_HREF.'tags/edit'.$row["tags_name_id"].'/">'.($row["name"] ? $row["name"] : $row["id"]).'</a>
			<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить тег?').'" class="tags_delete" tag_id="'.$row["id"].'">x</a>&nbsp;&nbsp; ';
		}
		return $text;
	}
}