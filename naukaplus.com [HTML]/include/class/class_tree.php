<?php

#
# Общий родительский класс древовидных модулей
#


require_once 'class_abstract.php';  // абстрактный класс

class class_tree extends class_abstract 
{
	
	public $curpage = 0;
	





	/**
	 * Центральная функция класса - вызывает все необходимые обработчики, определяет логику модуля
	 *
	 */
	public function main()
	{			
		# Всё будет реализовано в наследниках	 
	}
	

	/**
	 * Очистка массивов со структурой каталога 
	 *
	 */
	public function emptyTree()
	{
		unset($this->id);
		unset($this->pid);
		$this->id	= NULL;
		$this->pid	= NULL;
		$this->nosheet_id	= NULL;
		$this->nosheet_pid	= NULL;		
	}


	/**
	 * Получение структуры модуля.
	 * Для верности представления упорядочивает результат по pid, item_order, id
	 *
	 * @param unknown_type $table_name - имя таблицы, к которой обращаемся
	 * @param unknown_type $params - перечень ключевых параметров
	 * @return unknown
	 */
	public function initTree( $params = 'id, pid, title, alias')
	{
		if(!is_null($this->id))
		{
			return true; // есть уже данные
		}
		 
		
		# для пользовательской части
		$sql = "SELECT  {$params}
		FROM {$this->table}
		WHERE is_active = 1
		ORDER BY pid, item_order, id";
		
		
		# если это админ, то показываем все разделы, и скрытые тоже
		if ($this->issetUser())
		{
			# если администратор, то показываем всё!
			if ($this->std->member['user_access'] == 1)
			{
				# для админки всё должно быть видно
				$sql = "SELECT  {$params}
				FROM {$this->table}			
				ORDER BY pid, item_order, id";
			}
		}
		

		if ($this->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				$this->pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->id[ $row['id'] ] = &$this->pid[$row['pid'] ][ $row['id'] ];
			}
			return true;
		}

		return false; // нет данных, пусто
	}
	
	
	

	/**
	 * Получение структуры модуля.
	 * Для верности представления упорядочивает результат по pid, item_order, id
	 *
	 * @param unknown_type $table_name - имя таблицы, к которой обращаемся
	 * @param unknown_type $params - перечень ключевых параметров
	 * @return unknown
	 */
	public function initTreeWithoutSheet( $params = 'id, pid, title, alias, menu')
	{
		if(!is_null($this->nosheet_id))
		{
			return true; // есть уже данные
		}
		 
		
		# для пользовательской части
		$sql = "SELECT  {$params}
		FROM {$this->table}
		WHERE is_active = 1 AND is_sheet = 0
		ORDER BY pid, item_order, id";
		
		
		# если это админ, то показываем все разделы, и скрытые тоже
		if ($this->issetUser())
		{
			# если администратор, то показываем всё!
			if ($this->std->member['user_access'] == 1)
			{
				# для админки всё должно быть видно
				$sql = "SELECT  {$params}
				FROM {$this->table}	
				WHERE is_sheet = 0		
				ORDER BY pid, item_order, id";
			}
		}
		

		if ($this->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				$this->nosheet_pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->nosheet_id[ $row['id'] ] = &$this->nosheet_pid[$row['pid'] ][ $row['id'] ];
				$this->nosheet_alias[ $row['alias'] ] = &$this->nosheet_pid[$row['pid'] ][ $row['id'] ];				
			}
			return true;
		}

		return false; // нет данных, пусто
	}	


	/**
	 * Получение идентификатора вершины по алиасу страницы
	 *
	 * @return int  - идентификатор вершины или false, если произошла ошибка
	 */
	function getIdByAlias()
	{
			
		# если структура пуста, то уходим
		if (!$this->initTree())
		{
			return false;
		}


		$statr = 0; // начинаем с первого элемента, если это статические страницы
		if ($this->mod_name == $this->std->alias[0])
		{
			$statr = 1;	// начинаем со второго элемента, если вызывается не статическая страницы
		}

		# родитель
		$pid = '-1';
			
		# длина
		$len = count($this->std->alias);
		for ($i = $statr; $i < $len; $i ++)
		{
			# признак удачи поиска
			$is_find = false;

			foreach ($this->pid[$pid] as $item)
			{
				if ($item['alias'] == $this->std->alias[$i])
				{
					$pid = $item['id'];
					$is_find = true;
					break;
				}
			}

			# если совпадений нет, то это ошибка
			if (!$is_find)
			{
				return FALSE;
			}
		}


		# если всё удачно найдено, то возвращаем идентификатор
		if ($is_find)
		{
			return $this->id[$pid]['id'];
		}

		return FALSE;
	}

	/**
	 * Получение алиаса страницы по идентификатору  вершины
	 *
	 *  return string  - алиас страницы
	 */
	function getAliasByPid($cur_node)
	{
		$res = '/'.$this->mod_name.'/';
		$pid = $cur_node['pid'];
		
		# если структура пуста, то уходим		
		if (!$this->initTreeWithoutSheet())
		{
			return $res.$cur_node['id'].'/';
		}
		
		# если всё в порядке и вершина существует, тогда можем что-то формировать
		if ($this->nosheet_id[$pid])
		{
			$node = $this->nosheet_id[$pid];
			$uri = $node['alias'].'/';
			while ($node['pid'] != -1)
			{				
				$node = $this->nosheet_id[$node['pid']];
				$uri = $node['alias'].'/'.$uri;
			}
		}
		$res .= $uri.$cur_node['alias'].'/';
		unset($cur_node);
		return $res;
	}
	
	

	/**
	 * Получение алиаса страницы по идентификатору вершины
	 *
	 *  return string  - алиас страницы
	 */
	function getAliasById($id)
	{
		$res = '/'.$this->mod_name.'/';
		
		# если структура пуста, то уходим		
		if (!$this->initTree())
		{
			return false;
		}
		
		# если всё в порядке и вершина существует, тогда можем что-то формировать
		if ($this->id[$id])
		{
			$node = $this->id[$id];
			$uri = $node['alias'].'/';
			while ($node['pid'] != -1)
			{				
				$node = $this->id[$node['pid']];
				$uri = $node['alias'].'/'.$uri;
			}
		}
		$res .= $uri;
		return $res;
	}	

	
	/**
	 * Формирование данных вершине
	 *
	 * @param unknown_type $id  - идентификатор вершины
	 * @return unknown
	 */
	protected function getNodeById($id)
	{
		# запрос данных о вершине для простого пользователя системы
		$sql = "SELECT * FROM {$this->table} WHERE is_active = 1 AND id='{$id}'";
		
		# если это админ, то показываем все разделы, и скрытые тоже
		if ($this->issetUser())
		{
			# если администратор, то показываем всё!
			if ($this->std->member['user_access'] == 1)
			{
				# запрос данных о вершине для администратора системы
				$sql = "SELECT * FROM {$this->table} WHERE id='{$id}'";
			}
		}
		
		
		if ($this->db->query($sql, $rows) > 0)
		{	
			if ($this->std->alias[0] != 'admin')
			{
				$this->curpid = $rows[0]['pid'];
			}
			return $rows[0];
		}
		else
		{
			$this->template = 'error';			
		}
		
		return false;
	}
	
	
	/**
	 * получение списка идентификаторов ВСЕХ детей одной вершины, включая саму вершину
	 *
	 * @param unknown_type $id
	 */
	protected function getNodeChildsId($id)
	{
		$ids = array();
		if (isset($this->pid[$id]))
		{
			foreach ($this->pid[$id] as $node)
			{				
				$ids = array_merge($ids, $this->getNodeChildsId($node['id']));
			}
		}
		return array_merge(array("'".$id."'"), $ids);	
	}


	/**
	 * получение наследников вершины
	 *
	 * @param unknown_type $id
	 */
	protected function getChilds($id)
	{
		# список наследников
		$sql = "SELECT * FROM {$this->table} 
				WHERE is_active = 1 AND pid='$id'				 
				ORDER BY pid, item_order, id";
		
		# если это админ, то показываем все разделы, и скрытые тоже
		if ($this->issetUser())
		{
			# если администратор, то показываем всё!
			if ($this->std->member['user_access'] == 1)
			{
				$sql = "SELECT * FROM {$this->table} 
				WHERE pid='$id' 
				ORDER BY pid, item_order, id";
			}
		}
			 
		
		
				
		if ($this->db->query($sql, $rows) > 0)
		{
			return $rows;
		}	
	}
	
	
	

	/**
	 * Удаление кеша модуля
	 *
	 */
	public function clearCache()
	{
		# удаляем имеющийся кеш
		$this->std->rm_dir($this->filepath.'/cache');
	}
	
	
	

	/**
	 * Удаление кеша модуля
	 *
	 */
	public function clearCacheByNode($node)
	{
		$alias = $this->getAliasByPid($node);
		$filename_cache = implode('_', explode('/',substr($alias,1,strlen($alias)-2))).'.dat'; // название кеш-файла страницы
		$filename_cache = $this->filepath.'/cache/'.$filename_cache;
		
		if (file_exists($filename_cache))
		{
			# удаляем имеющийся кеш
			@unlink($filename_cache);
		}
		
	}	

}


?>