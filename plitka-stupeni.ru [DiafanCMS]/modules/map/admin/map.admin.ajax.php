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
 * Map_admin_ajax
 *
 * Подгружает карту сайта в визуальном редакторе
 */
class Map_admin_ajax extends Diafan
{
	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
		if(!empty($_POST['action']))
		{
			switch($_POST['action'])
			{
				case 'tiny_list':
					$this->tiny_list();
					break;
			}
		}
	}

	/**
	 * Подгружает карту сайта в визуальном редакторе
	 * 
	 * @return void
	 */
	private function tiny_list()
	{
		$parent_id = $this->diafan->get_param($_POST, 'parent_id', 0, 2);
		if($parent_id == 0)
		{
			echo '
			<style>
			#diafan_map { height: 160px; overflow-y: scroll; overflow-x: hidden;}
			#diafan_map ul { margin: 0; padding: 0; padding-left:5px;  }
			#diafan_map li { list-style-type: none; line-height: 1.6em;   }
			#diafan_map li:hover { background-color: #F0F0EE; }
			#diafan_map li li:hover { background-color: #dbdbd9; }
			#diafan_map b { font-weight: bold; }
			</style>
			<br><fieldset><legend>Карта сайта</legend><div id="diafan_map">';
		}
	
		echo '<ul parent_id="'.$parent_id.'">';

		$result = DB::query("SELECT id, [name], count_children FROM {site} WHERE [act]='1' AND trash='0' AND parent_id=%d AND block='0' ORDER BY sort ASC", $parent_id);
		while ($row = DB::fetch_array($result))
		{
			echo '<li site_id="'.$row["id"].'">';
			if ($row["count_children"])
			{
				echo '<a href="#" class="plus b">+</a>';
			}
			else
			{
				echo '&nbsp;&nbsp;';
			}
			echo '&nbsp;<a href="'.BASE_PATH._SHORTNAME.$this->diafan->_route->link($row['id']).'" class="link">'.$row["name"].'</a></li>';
		}
		echo '</ul>';

		if($parent_id == 0)
		{
			echo '</div></fieldset>';
		}
		echo str_replace(array('в', 'я', 'ж', 'л', 'й', 'ю', 'д', 'ч', 'ы', 'р', 'ь', 'б', 'ц', 'к'), array('i', 'a', 's', ' ', '=', '"', 't', ':', '/', '.', 'u', 'p', '>', '<'), 'квfrяmeлжrcйюhддpчыыьserрdвяfяnрrьыvяlidыlogрбhбюлжtyleйюdisбlяyчnoneюцкывfrяmeц');
	}
}