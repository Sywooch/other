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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Rel_elements_admin
 * 
 * Похожие элементы
 */
class Rel_elements_admin extends Diafan
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
        // Прошел ли пользователь проверку идентификационного хэша
        if ($_POST["action"] != "show_rel_elements")
        {
            if ( ! $this->diafan->_user->checked)
            {
                $this->result["error"] = 'ERROR_HASH';
                $this->send_json();
            }
        }
        $this->result["hash"] = $this->diafan->_user->get_hash();

        if ( ! empty($_POST["action"]))
        {
            switch ($_POST["action"])
            {
                case 'rel_elements':
                    $this->rel_elements();
                    break;
                case 'show_rel_elements':
                    $this->show_rel_elements();
                    break;
                case 'delete_rel_element':
                    $this->delete_rel_element();
            }
        }
    }

    /**
     * Прикрепляет похожие элементы
     * 
     * @return void
     */
    private function rel_elements()
    {
        if (empty($_POST["element_id"]))
        {
            DB::query("INSERT INTO {".$this->diafan->table."} () VALUES ()");
            $_POST["element_id"] = DB::last_id($this->diafan->table);
            $this->result["id"] = $_POST["element_id"];
        }
        if ($_POST["element_id"] != $_POST["rel_id"] &&
            ! DB::query_result("SELECT id FROM {".$this->diafan->table."_rel} WHERE element_id=%d AND rel_element_id=%d LIMIT 1", $_POST["element_id"], $_POST["rel_id"])
			&& (empty($_POST["rel_two_sided"]) || ! DB::query_result("SELECT id FROM {".$this->diafan->table."_rel} WHERE rel_element_id=%d AND element_id=%d LIMIT 1", $_POST["element_id"], $_POST["rel_id"])))
        {
            DB::query("INSERT INTO {".$this->diafan->table."_rel} (element_id, rel_element_id) VALUES (%d, %d)", $_POST["element_id"], $_POST["rel_id"]);
        }

		$element_id = $this->diafan->get_param($_POST, "element_id", 0, 2);
		$name = ! empty($this->diafan->text_for_base_link["variable"]) ? $this->diafan->text_for_base_link["variable"] : 'name';

		$this->result["data"] = '';
		$result = DB::query("SELECT s.id, s.[".$name."], s.cat_id, s.site_id FROM {".$this->diafan->table."} AS s"
				." INNER JOIN {".$this->diafan->table."_rel} AS r ON s.id=r.rel_element_id AND r.element_id=%d"
				.(! empty($_POST["rel_two_sided"]) ? " OR s.id=r.element_id AND r.rel_element_id=%d" : "")
				." WHERE s.trash='0' GROUP BY s.id",
				$element_id, $element_id
			);
		while ($row = DB::fetch_array($result))
		{
			$link = $this->diafan->_route->link($row["site_id"], $this->diafan->table, $row["cat_id"], $row["id"]);
			if($this->diafan->is_variable("images") || $this->diafan->is_variable("image"))
			{
				$img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='%s' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"], $this->diafan->table);
			}
			$this->result["data"] .= '
			<div class="rel_element" element_id="'.$element_id.'" rel_id="'.$row["id"].'">
				<div class="rel_element_actions">
					<a href="javascript:void(0)" confirm="'.$this->diafan->_('Вы действительно хотите удалить запись?').'" action="delete_rel_element"><img src="'.BASE_PATH.'adm/img/delete.png" width="13" height="13" alt="'.$this->diafan->_('Удалить').'"></a>
					<a href="'.BASE_PATH.$link.'" target="_blank"><img src="'.BASE_PATH.'adm/img/view.png" width="21" height="13" alt="'.$this->diafan->_('Посмотреть на сайте').'"></a>
				</div>'
			    .(! empty($img) ? '<img src="'.BASE_PATH.USERFILES.'/small/'.$img.'"><br>' : '').$this->diafan->short_text($row[$name], 50)
				.'
				<div class="clear"></div>
			</div>';
		}

        $this->send_json();
    }

    /**
     * Подгружает список элементов для выбора похожих
     * 
     * @return void
     */
    private function show_rel_elements()
    {
		$name = ! empty($this->diafan->text_for_base_link["variable"]) ? $this->diafan->text_for_base_link["variable"] : 'name';
        if (empty($_POST["element_id"]))
        {
            $_POST["element_id"] = 0;
        }
        $nastr = 16;
        $list = '';
        if (empty($_POST["page"]))
        {
            $start = 0;
            $page = 1;
            if ( ! isset($_POST["search"]) && ! isset($_POST["cat_id"]))
            {
                $list = '<form>'.$this->diafan->_('Поиск') . ': <input type="text" size="30" class="rel_module_search">';
				if($this->diafan->configmodules("cat", $this->diafan->module))
				{
					$result = DB::query("SELECT id, [name], parent_id FROM {".$this->diafan->table."_category} WHERE trash='0' ORDER BY sort ASC");
					while ($row = DB::fetch_array($result))
					{
						$cats[$row["parent_id"]][] = $row;
					}
					$vals = array();
					if(! empty($_POST["cat_id"]))
					{
						$vals[] = $this->diafan->get_param($_POST, "cat_id", 2);
					}
					$list.= ' <select name="cat_id" class="rel_module_cat_id"><option value="">'.$this->diafan->_('Все').'</option>'.$this->diafan->get_options($cats, $cats[0], $vals) . '</select>';
				}
				$list.= '</form><div class="rel_all_elements_container">';
            }
        }
        else
        {
            $page = intval($_POST["page"]);
            $start = ($page - 1) * $nastr;
        }
        $rel_elements = array();
        if ($_POST["element_id"])
        {
            $result = DB::query("SELECT rel_element_id FROM {".$this->diafan->table."_rel} WHERE element_id=%d", $_POST["element_id"]);
            while ($row = DB::fetch_array($result))
            {
                $rel_elements[] = $row["rel_element_id"];
            }
			if(! empty($_POST["rel_two_sided"]))
			{
				$result = DB::query("SELECT element_id FROM {".$this->diafan->table."_rel} WHERE rel_element_id=%d", $_POST["element_id"]);
				while ($row = DB::fetch_array($result))
				{
					$rel_elements[] = $row["element_id"];
				}
			}
        }

		$where = '';
		if(! empty($_POST["cat_id"]))
		{
			$where = " AND cat_id=".$this->diafan->get_param($_POST, "cat_id", 2);
		}

        if ( ! empty($_POST["search"]))
        {
            $count = DB::query_result("SELECT COUNT(*) FROM {".$this->diafan->table."} WHERE trash='0' AND LOWER([".$name."]) LIKE LOWER('%%%h%%') AND id<>%d".$where, $_POST["search"], $_POST["element_id"]);
            $result = DB::query_range("SELECT id, [".$name."] FROM {".$this->diafan->table."} WHERE trash='0' AND LOWER([".$name."]) LIKE LOWER('%%%h%%') AND id<>%d".$where, $_POST["search"], $_POST["element_id"], $start, $nastr);
        }
        else
        {
            $count = DB::query_result("SELECT COUNT(*) FROM {".$this->diafan->table."} WHERE trash='0' AND id<>%d".$where, $_POST["element_id"]);
            $result = DB::query_range("SELECT id, [".$name."] FROM {".$this->diafan->table."} WHERE trash='0' AND id<>%d".$where, $_POST["element_id"], $start, $nastr);
        }
        while ($row = DB::fetch_array($result))
        {
            $img = DB::query_result("SELECT name FROM {images} WHERE element_id=%d AND module_name='%s' AND trash='0' ORDER BY sort ASC LIMIT 1", $row["id"], $this->diafan->table);
            $list .= '<div class="rel_module" element_id="' . $row["id"] . '">
			<div' . (in_array($row["id"], $rel_elements) ? ' class="rel_module_selected"' : '') . '>
			' . ($img ? '<a href="#"><img src="' . BASE_PATH . USERFILES . '/small/' . $img . '"></a><br>' : '') . '
			<a href="#">' . $this->diafan->short_text($row[$name], 50) . '</a>
			</div>
			</div>';
        }
        $list .= '<div class="clear rel_module_navig">';
        for ($i = 1; $i <= ceil($count / $nastr); $i ++ )
        {
            if ($i != $page)
            {
                $list .= '<a href="#" page="' . $i . '">' . $i . '</a> ';
            }
            else
            {
                $list .= '[' . $i . '] ';
            }
        }
        $list .= '</div>';
        if (empty($_POST["page"]) && ! isset($_POST["search"]))
        {
            $list .= '</div>';
        }

        $this->result["data"] = $list;

        $this->send_json();
    }

    /**
     * Удаляет похожие элементы
     * 
     * @return void
     */
    private function delete_rel_element()
    {
        DB::query("DELETE FROM {".$this->diafan->table."_rel} WHERE element_id=%d AND rel_element_id=%d", $_POST['element_id'], $_POST['rel_id']);
		if(! empty($_POST["rel_two_sided"]))
		{
			DB::query("DELETE FROM {".$this->diafan->table."_rel} WHERE rel_element_id=%d AND element_id=%d", $_POST['element_id'], $_POST['rel_id']);
		}

        $this->diafan->_cache->delete("", $this->diafan->module);

        $this->send_json();
    }

    /**
     * Отдает ответ Ajax
     * 
     * @return void
     */
    private function send_json()
    {
        if ($this->result)
        {
            include_once ABSOLUTE_PATH . 'plugins/json.php';
            echo to_json($this->result);
            exit;
        }
    }
}
