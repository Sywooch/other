<?php
/**
 * Список статей
 * 
 * Шаблон вывода списка статей в том случае, если в настройках модуля отключен параметр «Использовать категории»
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
?>
	<div class="text">
		<div class="text_zag">Статьи</div>
		<?
			if(!empty($result["rows"])){
				foreach($result["rows"] as $val)
				{
					echo '<div class="text_t">';
					echo '<div class="sub_name">'.$val['name'].'<div class="sub_time">'.$val['date'].'</div></div>';
					$this->htmleditor($val['anons']);
					if(!empty($val["link"])) echo '... <a href="'.BASE_PATH_HREF.$val["link"].'" class="sub_read_more">Читать дальше</a>';
					echo '</div>';
				}
			}
			//постраничная навигация
			if (! empty($result["paginator"]))
			{
				$result["paginator"] = substr($result["paginator"],0,strrpos($result["paginator"],'<a')).'</div>';
				echo $result["paginator"];
			}
		?>
	</div>