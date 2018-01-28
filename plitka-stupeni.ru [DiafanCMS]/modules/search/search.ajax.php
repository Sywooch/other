<?

class Search_ajax extends Ajax
{

	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if(!empty($_POST['query']) && mb_strlen($_POST['query']) >= 3)
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			
			$search_key = htmlspecialchars(strip_tags($_POST['query']));
			$serach_key = trim($search_key);
			$search_key = strtoupper($search_key); // почему то маленькая d не восспринимаеться =/
			$this->result['key'] = $search_key;
			$this->result['data'] = array();
			
			unset($i); $i = 0;
			$res = DB::query('SELECT * FROM {shop} WHERE cat_id != "8" AND act1 = "1" AND trash = "0" AND CONVERT(`name1` USING utf8) LIKE "%'.$search_key.'%" LIMIT 0, 10');
			while($row = DB::fetch_array($res))
			{
				$this->result['data'][] = array(
										'name'	=> $row['name1'],
										'url'	=> '/'.$this->diafan->_route->link(29, 'shop', 0, $row['id']),
										'category'	=> 'Коллекция'
							);
				$i++;
			}

			if($i != 0) $this->result['data'][] = array('name' => '', 'url' => '', 'category' => 'explode');
			
			unset($i); $i = 0;
			$res = DB::query('SELECT * FROM {shop} WHERE cat_id = "8" AND act1 = "1" AND trash = "0" AND name1 LIKE \'%'.$search_key.'%\' LIMIT 0, 10');
			while($row = DB::fetch_array($res))
			{
				$this->result['data'][] = array(
										'name'	=> $row['name1'],
										'url'	=> '/'.$this->diafan->_route->link(29, 'shop', 0, $row['id']),
										'category'	=> 'Плитка'
							);
				$i++;
			}

			if($i != 0) $this->result['data'][] = array('name' => '', 'url' => '', 'category' => 'explode');

			$res = DB::query('SELECT * FROM {shop_category} WHERE parent_id != 0 AND act1 = "1" AND trash = "0" AND CONVERT(`name1` USING utf8) LIKE "%'.$search_key.'%" LIMIT 0, 10');
			while($row = DB::fetch_array($res))
			{
				$this->result['data'][] = array(
										'name'	=> $row['name1'],
										'url'	=> '/'.$this->diafan->_route->link(29, 'shop', $row['id'], 0),
										'category'	=> 'Фабрика'
							);
			}
			
			echo to_json($this->result);

			return true;
		} else {
			return false;
		}
	}
}

?>