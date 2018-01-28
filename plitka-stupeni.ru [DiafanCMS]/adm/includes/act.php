<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Act_admin
 *
 * Публикация/скрытие элемента
 */
class Act_admin extends Diafan
{
	/**
	 * Публикует/скрывает элемент
	 *
	 * @return void
	 */
	public function act()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (!$this->diafan->_user->checked)
		{
			echo "{error: 'HASH'}";
			return;
		}

		//проверка прав пользователя на активацию/блокирование
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo "{error: 'ERROR'}";
			return;
		}

		//учитывается языковая версия, если это необходимо
		$lang = $this->diafan->variable_multilang("act") ? _LANG : '';
		$ids = array ();
		$redirect = URL;

		if (!empty( $_POST["id"] ))
		{
			if ($this->diafan->config("parent"))
			{
				$ids = $this->diafan->get_children($_POST["id"], $this->diafan->table, array (), false);
				$parent_id = DB::query_result("SELECT parent_id FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $_POST["id"]);
				if($parent_id && $this->diafan->parent != $parent_id)
				{
					$redirect = str_replace('parent'.$this->diafan->parent.'/', '', $redirect).'parent'.$parent_id.'/';
				}
			}
			$ids[] = intval($_POST["id"]);
		}
		else {
			if (!empty( $_POST['ids'] ))
			{
				foreach ($_POST["ids"] as $id)
				{
					$id = intval($id);
					if (!in_array($id, $ids))
					{
						if ($this->diafan->config("parent"))
						{
							$array = $this->diafan->get_children($id, $this->diafan->table, array (), false);
							$ids = array_merge($ids, $array);
						}
						$ids[] = $id;
					}
				}
			}
		}
		if (!empty( $ids ))
		{
		//$text="UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $ids).")";
			DB::query("UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $ids).")");
			$result_query = DB::query("SELECT rel_element_id FROM {".$this->diafan->table."_rel} WHERE element_id IN (".implode(',', $ids).")");
			$array_ids = array();
			while($row = DB::fetch_array($result_query))
			{
				array_push($array_ids,$row['rel_element_id']);
			}
			DB::query("UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids).")");
		}
		if ($this->diafan->config('category'))
		{
		
		if($_POST["action"] == "unblock"){
			//$text="Зашел -- UPDATE {".str_replace('_category', '', $this->diafan->table)."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE cat_id IN (".implode(',', $ids).")";
			DB::query("UPDATE {".str_replace('_category', '', $this->diafan->table)."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE cat_id IN (".implode(',', $ids).")");
			}
			$result_query = DB::query("SELECT id FROM diafan_shop_category WHERE parent_id IN (".implode(',', $ids).")");
			$array_ids_group = array();	while($row = DB::fetch_array($result_query)){array_push($array_ids_group,$row['id']);}
			//$text=implode(',', $array_ids_group);
			
			if(count($array_ids_group)>0){
				
				if($_POST["action"] == "unblock"){
				
					DB::query("UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids_group).")");
					//$text="UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids_group).")";
					DB::query("UPDATE diafan_shop SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE cat_id IN (".implode(',', $array_ids_group).")");
					$result_query2 = DB::query("SELECT rel_element_id FROM diafan_shop_rel WHERE element_id IN (SELECT id FROM diafan_shop WHERE  cat_id IN (".implode(',', $array_ids_group)."))");
					$array_ids_group2 = array(); while($row2 = DB::fetch_array($result_query2)){array_push($array_ids_group2,$row2['rel_element_id']);}
					//$text="SELECT rel_element_id FROM diafan_shop_rel WHERE element_id IN (SELECT id FROM diafan_shop WHERE  cat_id IN (".implode(',', $array_ids_group)."))";
					DB::query("UPDATE diafan_shop SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids_group2).")");
				}
			
			}else{
				if($_POST["action"] == "unblock"){
				
					DB::query("UPDATE {".$this->diafan->table."} SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids_group).")");
				
					DB::query("UPDATE diafan_shop SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE cat_id IN (".implode(',', $ids).")");
					
					$result_query2 = DB::query("SELECT rel_element_id FROM diafan_shop_rel WHERE element_id IN (SELECT id FROM diafan_shop WHERE  cat_id IN (".implode(',', $ids)."))");
					$array_ids_group2 = array(); while($row2 = DB::fetch_array($result_query2)){array_push($array_ids_group2,$row2['rel_element_id']);}
					//$text="SELECT rel_element_id FROM diafan_shop_rel WHERE element_id IN (SELECT id FROM diafan_shop WHERE  cat_id IN (".implode(',', $ids)."))";
					DB::query("UPDATE diafan_shop SET act".$lang."='".( $_POST["action"] == "block" ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $array_ids_group2).")");
				}
			}
			
			//$text=$_POST["action"];
		
		}
		if (! $dirr = opendir(ABSOLUTE_PATH.'modules'))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH.'modules не существует.');
		}
		while (( $module = readdir($dirr) ) !== false)
		{
			if (file_exists(ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin.inc.php'))
			{
				Customization::inc('modules/'.$module.'/admin/'.$module.'.admin.inc.php');
				$class = ucfirst($module).'_admin_inc';
				if (method_exists($class, 'act'))
				{
					$class_admin_act = new $class($this->diafan);
					$class_admin_act->act($this->diafan->table, $ids, ( $_POST["action"] == "block" ? 1 : 0 ));
				}
			}
		}
		$this->diafan->_cache->delete("", $this->diafan->module);
		include_once ABSOLUTE_PATH.'plugins/json.php';
		//$result["redirect"] = $text;
		$result["redirect"] = $redirect;
		echo to_json($result);
	}
}