<?php
/**
 * Подключение модуля "Перелинковка" к другим модулям для административной части
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

class Keywords_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Подключить перелинковку" для настроек модуля
	 * 
	 * @return void
	 */
	public function edit_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='keywords' LIMIT 1"))
		{
			return;
		}

		if (empty($this->diafan->values["keywords"]))
		{
			$this->diafan->values["keywords"] = $this->diafan->configmodules("keywords");
		}

		echo '
		<tr id="keywords">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>
				<input type="checkbox" name="'.$this->diafan->key.'" value="1"'
				.($this->diafan->value == 1 ? " checked" : '')
				.'>'
				.$this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение настроек модулей
	 * 
	 * @return void
	 */
	public function save_config()
	{
		if(! DB::query_result("SELECT id FROM {modules} WHERE name='keywords' LIMIT 1"))
		{
			return;
		}

		$this->diafan->set_query("keywords='%d'");
		$this->diafan->set_value(! empty($_POST["keywords"]) ? $_POST["keywords"] : '');
	}
}