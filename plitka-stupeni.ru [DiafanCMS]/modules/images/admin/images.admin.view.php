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
 * Images_admin_view
 * 
 * Шаблон вывода изображений в административной части
 */
class Images_admin_view extends Diafan
{
	/**
	 * Выводит изображения, прикрепленные к элементу модуля
	 *
	 * @param integer $element_id номер элемента
	 * @param integer $param_id номер параметра для конструктора
	 * @return string
	 */
	public function show($element_id, $param_id = 0)
	{
		$text = ' ';
		$k = 1;
		$tmpcode = (! empty($_REQUEST["tmpcode"]) ? $_REQUEST["tmpcode"] : '');
		
		$result = DB::query("SELECT id, name, [alt], [title] FROM {images} WHERE module_name='%s' AND element_id=%d AND param_id=%d AND tmpcode='%s' ORDER BY sort ASC", str_replace("_category", "", $this->diafan->table).($this->diafan->config('category') ? "cat" : ""), $element_id, $param_id, $tmpcode);
		$count = DB::num_rows($result);
		while ($row = DB::fetch_array($result))
		{
			if (! file_exists(ABSOLUTE_PATH.USERFILES."/small/".$row["name"]))
			{
				DB::query("DELETE FROM {images} WHERE id=%d", $row["id"]);
				continue;
			}

			$text .= '
			<div class="images_actions'.($k == 1 ? ' first' :'').'" element_id="'.$element_id.'" image_id="'.$row["id"].'">'
			       .'<img src="'.BASE_PATH.USERFILES."/small/".$row["name"].'?'.rand(0, 9999).'"'
			       .($k == 1 ? ' alt="'.$this->diafan->_('Главное изображение').'" title="'.$this->diafan->_('Главное изображение').'"' : '').' class="image">'
				.'<div>'
					.($row["alt"] ? 'alt: '.$row["alt"].' ' : '')
					.($row["title"] ? ($row["alt"] ? '<br>' : '').'title: '.$row["title"] : '&nbsp;')
				.'</div>
				<div class="images_button">
					<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить изображение?').'" action="delete"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
					<a href="javascript:void(0)" action="edit"><img src="'.BASE_PATH.'adm/img/edit.gif" width="12" height="14" alt="'.$this->diafan->_('Редактировать').'"></a>
					'.($k != 1 ? '
					<a href="javascript:void(0)" action="up"><img src="'.BASE_PATH.'adm/img/up.gif" width="14" height="16" alt="'.$this->diafan->_('Выше').'"></a>' : '').'
					'.($k != $count ? '
					<a href="javascript:void(0)" action="down"><img src="'.BASE_PATH.'adm/img/down.gif" width="14" height="16" alt="'.$this->diafan->_('Ниже').'"></a> ' : '').'
				</div>
				<div class="clear"></div>
			</div>';
			$k++;
		}
		return $text;
	}

	/**
	 * Выводит изображение для выделения области
	 *
	 * @return string
	 */
	public function selectarea($result)
	{
		$text = '
		<input type="hidden" name="x1" value="">
		<input type="hidden" name="y1" value="">
		<input type="hidden" name="x2" value="">
		<input type="hidden" name="y2" value="">
		<input type="hidden" name="image_id" value="'.$result["id"].'">
		<input type="hidden" name="variation_id" value="'.$result["variant_id"].'">
		<div class="images_selectarea_info">'.$this->diafan->_('Выделите область').'</div>
		<p><img src="'.$result["path"].'" class="images_selectarea" select_width="'.$result["width"].'" select_height="'.$result["height"].'"></p>
		<input type="button" class="button images_selectarea_button" value="'.$this->diafan->_('Сохранить').'">';
		return $text;
	}

	/**
	 * Форма редактирования атрибутов alt и title для изображения
	 *
	 * @param array $row данные о изображении
	 * @return string
	 */
	public function edit_attribute($row)
	{
		$text = '<img src="'.BASE_PATH.USERFILES."/small/".$row["name"].'?'.rand(0, 9999).'" class="image">'
		.'<div>
		<p>alt:   <input name="alt"  type="text" value="'.$row["alt"].'"></p>
		<p>title: <input name="title" type="text" value="'.$row["title"].'"></p>
		<input type="button" value="'.$this->diafan->_('Сохранить').'" class="button ajax_save_image">
		</div>
		<div class="clear"></div>';
		return $text;
	}
}