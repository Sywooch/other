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


class Useradmin_ajax extends Ajax
{
	public function ajax_request()
	{
		header('Content-Type: text/html; charset=utf-8');
		echo '<div class="useradmin_panel">
		<table width="100%">
			<tr>
				<td class="head_td head_1">
					<div class="logo_diafan">'.$this->diafan->_('Система управления сайтом', false).'
						<div class="logo_url"><a href="http://'.BASE_URL.'/">'.BASE_URL.'</a></div>
					</div>
				</td>
				<td class="head_td head_2">
					<a href="'.BASE_PATH.ADMIN_FOLDER.'/" class="go_site">Администрирование</a> <img src="'.BASE_PATH.'adm/img/admin_top_icon2.png" alt=""> Сайт <span class="go_edit">(<span>режим редактирования</span>)</span>
				</td>';
				$this->show_languages();
				echo '
				<td class="head_td head_4">
					<div class="user_info"><span class="user_name"><a href="'.BASE_PATH.ADMIN_FOLDER.'/users/edit'.$this->diafan->_user->id.'/">'.$this->diafan->_user->fio.'</a></span><span class="exit"><a href="' . BASE_PATH_HREF . 'logout/">'.$this->diafan->_('Выйти', false).'</a></span></div>
				</td>
			</tr>
		</table>
		<div class="useradmin_meta"></div>
		</div>';
		exit;
	}

	/**
	 * Выводит ссылки на альтернативные языковые версии сайта
	 *
	 * @return boolean
	 */
	private function show_languages()
	{
		if (count($this->diafan->languages) < 2)
		{
			return;
		}

		echo '<td class="head_td head_3">';

		foreach ($this->diafan->languages as $language)
		{
			if ($language["id"] != _LANG)
			{

				echo '<a href="' . BASE_PATH  . ( ! $language["base_site"] ? $language["shortname"] . '/' : '' ) . $this->diafan->_route->current_link() . '" class="lang">' . $language["name"] . '</a>';
			}
			else
			{
				echo '<span class="lang_act">' . $language["name"] . '</span>';
			}
		}

		echo '</td>';
		return true;
	}
}