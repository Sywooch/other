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
 * Shop_admin_view
 * 
 * Шаблон вывода магазина в административной части
 */
class Shop_admin_view extends Diafan
{
	/**
	 * Выводит товары, к которым прикреплена скидка
	 *
	 * @param integer $element_id номер скидки
	 * @return string
	 */
	public function discount_goods($element_id)
	{
		$text = ' ';
		$result = DB::query("SELECT s.id, s.[name], s.cat_id, s.site_id FROM {shop} AS s"
		                    ." INNER JOIN {shop_discount_object} AS r ON s.id=r.good_id AND r.discount_id=%d"
		                    ." WHERE s.trash='0' GROUP BY s.id",
		                    $element_id
		                   );
		while ($row = DB::fetch_array($result))
		{
			$link = $this->diafan->_route->link($row["site_id"], 'shop', $row["cat_id"], $row["id"]);
			$img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='shop' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"]);
			$text .= '
			<div class="rel_element" good_id="'.$row["id"].'">
				<div class="rel_element_actions">
					<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_rel_element"><img src="'.BASE_PATH.'adm/img/delete.png" width="15" height="15" alt="'.$this->diafan->_('Удалить').'"></a>
					<a href="'.BASE_PATH.$link.'" target="_blank"><img src="'.BASE_PATH.'adm/img/view.png" width="21" height="13" alt="'.$this->diafan->_('Посмотреть на сайте').'"></a>
				</div>'
			    .($img ? '<img src="'.BASE_PATH.USERFILES.'/small/'.$img.'"><br>' : '').$row["name"]
				.'
				<div class="clear"></div>
			</div>';
		}
		return $text;
	}
}