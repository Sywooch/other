<?php
/**
 * Продвижение сайта WebEffector
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Presto_admin extends Frame_admin
{
	
	public function show(){
	
	if(isset($_POST['textsa']) && trim(strip_tags($_POST['textsa']))){file_put_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/text.html",$_POST['textsa']);}
	if(isset($_POST['periuds']) && trim(strip_tags($_POST['periuds']))){file_put_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.1",$_POST['periuds']);}
	$xx=0;
	if(isset($_POST['url'])){
		$may_arra=array();
		foreach($_POST['url'] as $index => $val){$may_arra[]=$val;}
		file_put_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.2",serialize($may_arra));
	}
	
	$periuds=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.1");
	$text=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/text.html");
	
	$urls=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.2");
	$mayarr=unserialize($urls);
	//print_r($mayarr);
	foreach($mayarr as $index => $val){$may.='<p class="das'.$index.'"><input type="text" name="url[]" value="'.$val.'" style="width:500px;"><a class="delsas" href="javascript:void(0)" my_del="das'.$index.'" style="color:red;text-decoration:none;">Del</a></p>';}
	$xx=count($mayarr);
	
		echo '<script type="text/javascript" src="/modules/presto/admin/presto.admin.js"></script>';
			echo '<form method="post" action="/psadmin/presto/"><div class="block"><table class="filter">
					<tr><td><b>Период показа окна</b></td></tr>
					<tr><td><select name="periuds">
						<option value="none" '.(($periuds=="")?'selected="selected"':'').'>Выбрать период</option>
						<option value="day" '.(($periuds=="day")?'selected="selected"':'').'>Раз в день</option>
						<option value="wiack" '.(($periuds=="wiack")?'selected="selected"':'').'>Раз в неделю</option>
						<option value="2wiack" '.(($periuds=="2wiack")?'selected="selected"':'').'>Раз в 2 недели</option>
						<option value="monf" '.(($periuds=="monf")?'selected="selected"':'').'>Раз в месяц</option>
					</select></td></tr>
					<tr><td><b>Страница показа</b></td></tr>
					<tr><td>
						<input type="hidden" value="'.$xx.'" class="counts">
						<div class="url_inputs">'.$may.'</div>
						<a href="javascript:void(0);" class="ads_urls" title="Добавить страницу" style="text-decoration:none;color:red">Добавить</a>
					</td></tr>
					<tr><td><b>Текст окна</b></td></tr>
					<tr><td><textarea name="textsa" id="htmleditor_anons" style="width:600px; height:200px" class="htmleditor">'.$text.'</textarea></td></tr>
					<tr><td><input class="button" value="Сохранить" type="submit"></td></tr>
				  </table></div></form>';
		return;

	}
	
}