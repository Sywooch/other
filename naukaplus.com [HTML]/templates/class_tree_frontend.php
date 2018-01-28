<?php
require_once 'class_tree.php';  // предок всех каталогов


/**
 * Пользовательская часть - кабота с каталожной структурой
 *
 */
class class_tree_frontend extends class_tree
{

	/**  идентификатор вершины  */
	public $curid = NULL;
	
	
	/**  массив наследников вершины  */
	public $childs = array();
	
	
	/** массив с полным перечнем данных одной страницы */
	public $node = array();
	
	/** массив с перечнем идентификаторов вершин, которые являются родителями текущей, показываемой вершины */
	public $show_id = array();
	

	/**
	 * Центральная функция класса - вызывает все необходимые обработчики, определяет логику модуля
	 * ПЕРЕОПРЕДЕЛЕНИЕ
	 */
	public function main()
	{
		parent::main();
		
	

		# инициализируем переменные, которые должны быть, независимо
		# от последующего запуска основного комплекса модуля
		# ВЫЗОВ БУДЕТ ТУТ

		
		
		# Формирование списка последних добавленных пунктов
		$this->setPul($this->mod_name.'_last', $this->createNodesLastBlock());
		
		
		# Формирование списка последних добавленных пунктов
		$this->setPul($this->mod_name.'_best', $this->createNodesBestBlock());
		
		# Формирование списка двевовидного меню по модулю
		$this->setPul($this->mod_name.'_menu', $this->createModMenu());
			

		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[0] != $this->mod_name)
		{
			# если вызывает другой модуль, то выход
			return;
		}
		
			
		
		#------------------------------------------------------------------------
		# ПРОВЕРКА НАЛИЧИЯ КЕША СТРАНИЦЫ
		#------------------------------------------------------------------------
		
		$filename_cache = implode('_', explode('/',substr($this->std->uri,1,strlen($this->std->uri)-2))).'.dat'; // название кеш-файла страницы
		if (($this->std->settings[$this->mod_name.'_cache'] == '1') && (file_exists($this->filepath.'/cache/'.$filename_cache)) && ($this->std->member['user_access'] != '1'))
		{
				# получаем все сохранённые данные из файла и используем их для вывода на страницы модуля
				$date = unserialize(file_get_contents($this->filepath.'/cache/'.$filename_cache));
				
				$this->template = $date['template'];
				foreach ($date as $key => $value)
				{
					$this->updatePul($key, $value);
				}
				
				unset($date);
		}
		else
		{
				# КЕШа нет, нужно формировать данные с нуля
			
				
			
							
				
				# нумерация страниц, учитываем её и убираем её из строки адреса
				$this->curpage = 0;		
				if ( strstr( $this->std->alias[count($this->std->alias)-1], "page" ) )
				{
					$this->curpage = str_replace( "page", "", $this->std->alias[count($this->std->alias)-1])-1;
					unset( $this->std->alias[count($this->std->alias)-1]);
					
					global $uri;
					$uri = '/'.implode('/', $this->std->alias).'/';
				}
				
				
				# нужно понять какую страницу сейчас мы показываем				
				$this->curid = $this->getIdPage();
				
				
				# формируем данные о показываемой странице		
				$this->getNodeData();
				
				
				if (($this->node['is_sheet'] == '0') || ($this->curid == -1))
				{
						# получаем всех наследников вершины
						$this->childs = $this->getChilds($this->curid);
						
						
						# вызывается каталог
						$this->template = $this->mod_name;
						
						
						# меню с детьми и без детей
						$this->updatePul('nodes', $this->getMenuWithChild());
						$this->updatePul('sheets', $this->getMenuWithoutChild());					
				}
				else
				{	
					
					# вызов функций и обработчиков, готовящих данные для страницы-лиска модуля
					$this->workItemPage();
					
					
					# вызывается конечная страница
					if ($this->template == '')
					{
						$this->template = $this->mod_name.'_item';
					}
				}
				
				
				# Формирование списка двевовидного меню по модулю
				$this->setPul($this->mod_name.'_path', $this->createModPath());
				
				
				# создаём новый файл с кешем, если в настройках разрешено кеширование модуля
				if ($this->std->settings[$this->mod_name.'_cache'] == '1')
				{
					# создаём новый файл с кешем						
					$date = $this->std->getPulArray($this->mod_name);
					$date['template'] = $this->template;			
					$this->creatCache($date, $filename_cache);
					unset($date);
				}
		}
		
		
		
		
		
		
		# формирование блока истории просмотра страниц модуля ()
		$this->updatePul($this->mod_name.'_history', $this->getHistory());			
					
				
		# удаление служебных данных
		$this->__destruct();
	}
	
	

	/**
	 * деструктор
	 *
	 */
	function __destruct()
	{
		parent::__destruct();
		unset($this->childs);
		unset($this->node);
	}
	
	
	
	/**
	 * вызов функций и обработчиков, готовящих данные для страницы-лиска модуля
	 *
	 */
	public function workItemPage()
	{
		# формирование блока истории просмотра страниц модуля ()
		$this->updatePul($this->mod_name.'_attend', $this->getAttend());
		
		# формирование блока аналогичных пунктов
		$this->updatePul($this->mod_name.'_analog', $this->getAnalog());
	}
	
	
	
	/**
	 * сохранение сериализованного массива в кеш-файле
	 *
	 */
	public function creatCache($date, $filename)
	{
		if (!isset($this->std->member['user_access']) || (isset($this->std->member['user_access']) && ($this->std->member['user_access'] != 1)))
		{
			$tmpfilename = $this->filepath.'/'.time().$filename;
			file_put_contents($tmpfilename, serialize($date));
			$this->std->moveFile($tmpfilename, $filename,  $this->filepath.'/cache', 1, $error);
		}
	}
	
	
	
	
	
	
	/**
	 * Формирование списка сопутствующих товаров
	 *
	 */
	public function getAttend()
	{
		$res = '';
		
		# если это торговый каталог
		if ($this->std->settings[$this->mod_name.'_type'] == '2')
		{
			
			if (isset($this->std->settings['shop_modrecipient']))
			{
				# если установлен модуль-кагазин
				# тогда подключаем его, передаём данные ЛИСТА и получаем информацию о сопуствующих товарах
				include_once($this->std->config['path_modules']."/shop/shop_main.php");

				$class = 'main_shop';
				if (class_exists($class))
				{
					$module_run = new  $class('shop', &$this->std);
					$module_run->catalog = &$this;
					
					$res = $module_run->getAttend($this->node['id']);
					$module_run->__destruct();
				}
			}
		}
		
		
		return $res;
	}

	
	
	
	/**
	 * Формирование списка сопутствующих товаров
	 *
	 */
	public function getAnalog()
	{
		$res = '';
		
		# если это торговый каталог
		if (($this->std->settings[$this->mod_name.'_analog'] > 0))
		{
			$res = $this->getNodesAnalog($this->skin['analog'], $this->std->settings[$this->mod_name.'_analog']);
		}
		
		
		return $res;
	}	
	
	
	

	/**
	 * Формирование списка последних добавленных пунктов
	 *
	 * @param unknown_type $template - шаблон оформления
	 * @param unknown_type $count	- количество выводимых пунктов
	 * @param unknown_type $is_update	- принудительно обновить кеш
	 * @return unknown
	 */	
	public function getNodesAnalog($template, $count = 5)
	{
		# нужно проверить, есть ли файл с кешем блока
		$res = '';
		
		
		# запсро списка аналогичных	
		$sql = "SELECT c.* FROM {$this->table}_analog a 
				INNER JOIN {$this->table} c ON (c.id = a.id_with)
				WHERE a.id = '".$this->curid."' AND c.is_active = 1
				LIMIT $count";
		if ($this->db->query($sql, $rows) > 0)
		{			
			# если структура пуста, то уходим
			foreach ($rows as $node)
			{	
				$node = $this->formatFreeData($node);					
								
				$res .= $this->strtr_mod($template, $node);					
			}
		}		
		
		return $res;
	}
	
	
	
	
	/**
	 * формирование списка последних просмотренных страниц/листов модуля
	 * возвращает блок с оформленными ссылками на страницы
	 *
	 */
	public function getHistory()
	{
			$res = '';
		
			# сохраняем историю просмотра листов модуля, но только есть дано разрешение на это						
			if (($this->std->settings[$this->mod_name.'_history'] != '0'))
			{
				
				# нет нужны определять данные вершины, если мы смотрим просто подкаталоги
				if ($this->template == $this->mod_name.'_item')
				{
					// если страница не была определена заранее, то сделаем это сейчас
					if (count($this->node) == 0)
					{
						# нужно понять какую страницу сейчас мы показываем
						$this->curid = $this->getIdPage();
												
						
						# формируем данные о показываемой странице		
						$this->getNodeData();
					}
				}
				
				
				
				# хранение истории просмотров разрешено
				$cache = $this->std->getValueSession($this->mod_name);	// получение данных сессии пользователя

				$history = $cache['history'];		// получаем всю, что у нас уже хранится по истории
				$history_show = $history;
				if (!is_array($history)) $history = array();
				$new_history = array();

				
				# нет нужны что-то заново сохранять, если мы смотрим просто подкаталоги
				if ($this->template == $this->mod_name.'_item')
				{
					# не нужно показывать одинаковые просмотренные подряд страницы 
					
					$history[] = $this->node;	// добавление в очередь новой вершины
	
					$i = 0;
					while (count($history) > $this->std->settings[$this->mod_name.'_history']) 
					{
						unset($history[$i]);		// удаляем самый первый - самый старый
						$i++;
					}
					
					foreach ($history as $item)
					{
						$new_history[] = $item;		// создаём новый массив
					}
					
					# сохраняем новую историю
					$cache['history'] = $new_history;
					
					$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cache));					
					
				}
				
				if (count($history) == 0) return $res;	// если истории нет, то выход
				
				
				#-------------------------------------------------
				# формирование блока со список ссылок на страницы
				#-------------------------------------------------
								
				$max = count($history_show)-1;
				for ($i = $max; $i >= 0; $i--)
				{				
					$this->node = $history_show[$i];
										 
					$res .= $this->strtr_mod($this->skin['history'], $this->node);						
				}
				
				
			}
			
			return $res;
	}
	
	
	
	/**
	 * Формирование списка последних добавленных пунктов
	 *
	 */
	public function createNodesLastBlock()
	{
		$res = '';
		
		if (($this->std->settings[$this->mod_name.'_last_type'] != '0'))
		{
			# в настройках указано, что пункты нужно выводить!

			# теперь нужно определить, где можно выводить эти пункты:
			if (
				($this->std->settings[$this->mod_name.'_last_type'] == '1') ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '2') && (count($this->std->alias) == 0)) ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '3') && (count($this->std->alias) == 1) && ($this->std->alias[0] == $this->mod_name)) ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '4') && (count($this->std->alias) > 1) && ($this->std->alias[0] == $this->mod_name))
			)
			{
				$res = $this->getNodesLast($this->skin['last'], $this->std->settings[$this->mod_name.'_last_count']);				
			}
		}
		
		return $res;
	}
	
	
	/**
	 * Формирование списка лучших пунктов
	 *
	 */
	public function createNodesBestBlock()
	{
		$res = '';
		
		if ($this->std->settings[$this->mod_name.'_best_type'] != '0')
		{
			# в настройках указано, что пункты нужно выводить!

			# теперь нужно определить, где можно выводить эти пункты:
			if (
				($this->std->settings[$this->mod_name.'_best_type'] == '1') ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '2') && (count($this->std->alias) == 0)) ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '3') && (count($this->std->alias) == 1) && ($this->std->alias[0] == $this->mod_name)) ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '4') && (count($this->std->alias) > 1) && ($this->std->alias[0] == $this->mod_name))
			)
			{
				$res = $this->getNodesBest($this->skin['best'], $this->std->settings[$this->mod_name.'_best_count']);				
			}
		}
		
		return $res;
		
		
		
		/*if ((($this->std->settings[$this->mod_name.'_best_onlymain'] != 1) || (count($this->std->alias) == 0)) && ($this->std->settings[$this->mod_name.'_best_count_on_mainpage'] > 0))
		{
			$best = $this->getNodesBest($this->skin['node_best_onmain'], $this->std->settings[$this->mod_name.'_best_count_on_mainpage']);
			$this->updatePul($this->mod_name.'_best', $best);
		}*/
	}
	
	
	
	/**
	 * Формирование меню с пунктами, у которых есть дети
	 *
	 * @return unknown
	 */
	public function getMenuWithChild()
	{
		$res = '';
		$nodes = array();
		
			
		if (count($this->childs) > 0)
		foreach ($this->childs as $node)
		{			
			if ($node['is_sheet'] == '0')
			{
				# дети есть
				$tmp = $this->skin['menu_withchilds']['item'];
				$node = $this->formatFreeData($node);				
				$nodes[] = $this->strtr_mod($tmp, $node);				
			}
			
		}
		
		if (count($nodes) > 0)
		{		
			$res .= $this->skin['menu_withchilds']['begin'];
			$res .= implode($this->skin['menu_withchilds']['delimiter'], $nodes);
			$res .= $this->skin['menu_withchilds']['end'];
		}
		
		
		return $res;
	}
	
	
	/**
	 * Формирование меню с пунктами, у которых НЕТ детей
	 *
	 * @return unknown
	 */
	public function getMenuWithoutChild()
	{
		$res = '';
		$nodes = array();
		
				
			
		#-----------------------------------------
		# КОНЕЦ: нумерация страниц
		#-----------------------------------------
		
		
		$start = $this->std->settings[$this->mod_name.'_count_onpage']*$this->curpage;
		$end = $start + $this->std->settings[$this->mod_name.'_count_onpage'];
		$i = 0;	

		if (count($this->childs) > 0)
		foreach ($this->childs as $node)
		{
			
			if ( ($node['is_sheet'] == '1') && ($i >= $start) && ($i < $end))
			{
				# нет детей есть
				$tmp = $this->skin['menu_withoutchilds']['item'];
				$node = $this->formatFreeData($node);				
				$nodes[] = $this->strtr_mod($tmp, $node);				
			}
			$i++;
		}
		
		if (count($nodes) > 0)
		{		
			$res .= $this->skin['menu_withoutchilds']['begin'];
			$res .= implode($this->skin['menu_withoutchilds']['delimiter'], $nodes);
			$res .= $this->skin['menu_withoutchilds']['end'];
			
			
			#-----------------------------------------
			# нумерация страниц
			#-----------------------------------------
				
			$this->setPul($this->mod_name.'_arrows',  $this->std->build_pagelinks( array( 'TOTAL_POSS'   => count($this->childs),
	                                                          'PER_PAGE'     => $this->std->settings[$this->mod_name.'_count_onpage'],	// пунктов на странице
	                                                          'CUR_ST_VAL'   => $this->curpage+1,
	                                                          'L_SINGLE'     => "",
	                                                          'L_MULTI'      => "Страницы: ",
	                                                          'BASE_URL'     => '/'.implode('/', $this->std->alias).'/',
	                                                          'leave_out'    => $this->std->settings['arrows_around'], // сколько рядом показываем страниц
	                                                          'IGNORE_REVERT'=> 0,
	                                                      ) ));	
		}
		
		
		return $res;
	}

	
	/**
	 * получение идентификатора вызываемой страницы/вершины
	 * Идентификатор определяется на основании текущего URI
	 *
	 */
	public function getIdPage()
	{
		//$id = $this->std->MixedToInt($this->std->alias[count($this->std->alias)-1], true);
		$id = -1;
		$id = $this->std->alias[count($this->std->alias)-1];
		$id = $id == $this->mod_name ? -1 : $id;
		
		
		if (!$this->initTreeWithoutSheet('id, pid, alias, is_redirect'))
		{
			return $id; // если каталог пустой, то выходим
		}
		
		
		while ((isset($this->nosheet_id[$id])) && ($this->nosheet_id[$id]['is_redirect'] == 1))
		{
			if (isset($this->nosheet_pid[$id]))
			{
				$keys = array_keys($this->nosheet_pid[$id]);
				$id = $this->nosheet_id[$keys[0]]['id'];
			}
			else
			{
				$sql = "SELECT id FROM {$this->table} WHERE is_active=1 AND pid = {$id} ORDER BY item_order";
				if ($this->db->query($sql, $rows) > 0)
				{
					$id = $rows[0]['id'];
					return $id;
				}
			}
			
			
		}
		
		
		return $id;
		
		
		# если у вершины назначен редирект на потомка, то нужно определить идентификатор этого потомка
		/**/
		
		
		
		
	}
	
	
	/**
	 * инициализация всех свойств страницы
	 *
	 */
	public function getNodeData()
	{
		if ($this->curid == -1)
		{	
			# главная страница модуля - берём информацию из модуля "Статические страницы"
			$sql = "SELECT * FROM se_static WHERE pid = '-1' AND alias = '{$this->mod_name}' LIMIT 1";
			if ($this->db->query($sql, $rows) > 0)
			{
				$this->node = $rows[0];
				$this->formatData();
				
				
				
				foreach ($this->node as $key => $value)
				{
					$this->updatePul($key, $value);
				}
			}	
		}
		elseif ($this->node = $this->getNodeById($this->curid))
		{
			# внутренняя страница модуля
			$this->formatData();
			
			
			foreach ($this->node as $key => $value)
			{
				$this->updatePul($key, $value);
			}
		}
		else
		{
			return false;
		}
	}
	
	
	/**
	 * Приведение данных к определённому виду согласно заданым шаблонам отображения
	 *
	 */
	public function formatData()
	{		
		$this->node['timestamp']		= $this->std->getSystemTime($this->node['timestamp'], $this->skin['timestamp']);
		$this->node['description']		= $this->std->build_meta_tags($this->node['description'], 'description');
		$this->node['keywords']			= $this->std->build_meta_tags($this->node['keywords'], 'keywords');		
		$this->node['basket_add']		= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_MenuWithoutChild'], $this->node) : '';
		$this->node['to_shop']			= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_GoodPage'], $this->node) : '';
		
		$this->node['alias'] 			= $this->getAliasByPid($this->node);
		$this->node['parent_alias']		= substr($this->node['alias'], 0, strlen($this->node['alias']) - strlen($this->node['id'].'/'));
		$this->node['parent_title']		= $this->nosheet_id[$this->node['pid']]['title'];
		
		
		
		# фото
		if ($this->node['img'] != '')
		{
			$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/source/'.$this->node['img'].'/'.$this->node['id'].'.jpg';						
			$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/th/'.$this->node['img'].'/'.$this->node['id'].'_th.jpg';
			$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/img/'.$this->node['img'].'/'.$this->node['id'].'_img.jpg';
			
		}
		else
		{
			$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			
		}		
		
		
		unset($this->node['template']);
	}
	
	
	public function formatFreeData($node)
	{
		$tmp = $this->node;
		$this->node = $node;
		$this->formatData();
		$node = $this->node;
		$this->node = $tmp;
		
		return $node;
	}
	

	/**
	 * Формирование списка последних добавленных пунктов
	 *
	 * @param unknown_type $template - шаблон оформления
	 * @param unknown_type $count	- количество выводимых пунктов
	 * @param unknown_type $is_update	- принудительно обновить кеш
	 * @return unknown
	 */	
	public function getNodesLast($template, $count = 5, $is_update = false)
	{
		# нужно проверить, есть ли файл с кешем блока
		$res = '';
		
		# удалить файл с кешем
		if ($is_update)
		{
			unlink($this->filepath.'/last.dat');
		}
		
		
		if (file_exists($this->filepath.'/cache/last.dat') && ($this->std->settings[$this->mod_name.'_cache'] == '1')  &&  ($this->std->member['user_access'] != '1'))
		{
			# кеш есть, нужно его просто взять и вывести
			$res = file_get_contents($this->filepath.'/cache/last.dat');
		}
		else
		{
			# кеша нет, нужно сформировать его заново
			
			$sql = "SELECT * FROM {$this->table}				
					WHERE is_active = 1 AND is_sheet = 1
					ORDER BY timestamp DESC
					LIMIT {$count}";
			if ($this->db->query($sql, $rows) > 0)
			{			
				# если структура пуста, то уходим
				foreach ($rows as $node)
				{					
					$node = $this->formatFreeData($node);					
										
					$res .= $this->strtr_mod($template, $node);					
				}
			}
			
			# создаём новый файл с кешем, если в настройках разрешено кеширование модуля
			if ($this->std->settings[$this->mod_name.'_cache'] == '1')
			{
				# создаём новый файл с кешем
				file_put_contents($this->filepath.'/last.dat', $res);
				$this->std->moveFile($this->filepath.'/last.dat', 'last.dat',  $this->filepath.'/cache', 1, $error);
			}
		}
		
		
		return $res;
	}
	
	
	
	

	/**
	 * Формирование списка помеченных/лучших пунктов для вывода на глувную страницу (или на любую другую)
	 * @param unknown_type $template - шаблон оформления
	 * @param unknown_type $count	- количество выводимых пунктов
	 * @param unknown_type $is_update	- принудительно обновить кеш
	 * @return unknown
	 */	
	public function getNodesBest($template, $count = 5, $is_update = false)
	{		
		# нужно проверить, есть ли файл с кешем блока
		$res = '';
		
		# удалить файл с кешем
		if ($is_update)
		{
			unlink($this->filepath.'/best.dat');
		}
		
		
		if (file_exists($this->filepath.'/cache/best.dat') && ($this->std->settings[$this->mod_name.'_cache'] == '1')  &&  ($this->std->member['user_access'] != '1'))
		{
			# кеш есть, нужно его просто взять и вывести
			$res = file_get_contents($this->filepath.'/cache/best.dat');
		}
		else
		{
			# кеша нет, нужно сформировать его заново
			
			$sql = "SELECT * FROM {$this->table}				
					WHERE is_active = 1 AND is_best = 1  AND is_sheet = 1
					ORDER BY timestamp DESC
					LIMIT {$count}";
			if ($this->db->query($sql, $rows) > 0)
			{			
				# если структура пуста, то уходим
				foreach ($rows as $node)
				{					
					$node = $this->formatFreeData($node);															
					$res .= $this->strtr_mod($template, $node);					
				}
			}
			
			
			# создаём новый файл с кешем, если в настройках разрешено кеширование модуля
			if ($this->std->settings[$this->mod_name.'_cache'] == '1')
			{				
				file_put_contents($this->filepath.'/best.dat', $res);
				$this->std->moveFile($this->filepath.'/best.dat', 'best.dat',  $this->filepath.'/cache', 1, $error);
			}
		}
		
		
		return $res;
	}
	
	


	/**
	 * формирование древовидного меню по модулю
	 *
	 */
	public function createModMenu()
	{
		$res = '';
		
		# проверяем, нужно ли вообще формировать меню по модулю
		if ($this->std->settings[$this->mod_name.'_menu'] == '0')
		{
			return $res;
		}

		
		
		if (!$this->initTreeWithoutSheet())
		{
			return $res; // если каталог пустой, то выходим
		}
		
	
		#----------------------------------------------------------------------------
		# определяем список вершин, которые входят в "путь" сейчас открытой страницы
		#----------------------------------------------------------------------------
		if ($this->std->alias['0'] == $this->mod_name)		
		for ($i = 1; $i < count($this->std->alias); $i++ )
		{
			$this->show_id[] = $this->std->alias[$i];
		}
		
		
		# вызываем реккурсивную функцию построения меню
		$res = $this->CreatModMenuNodes('-1', 1 );
	
		
		
		
		return $res;
	}
	
		
	
	

	/**
	 * обработка и итерации при постоении меню по модулю
	 */
	function CreatModMenuNodes($pid, $level)
	{		
		$res = '';
	
		
		if (is_array($this->nosheet_pid[$pid]))
		{
			$res = $this->skin['menuexpanded']['begin'][$level];
			
			foreach ($this->nosheet_pid[$pid] as $item)
			{
				$tmp = $this->skin['menuexpanded']['inactive'][$level];
				if (!in_array($item['id'], $this->show_id))
				{
					$tmp = str_replace("{class}", 'class="closed"', $tmp);
					
				}
				else
				{
					$tmp = str_replace("{class}", '', $tmp);
					
					
				}
				$tmp = str_replace("{title}", $item['menu'], $tmp);
				$res .= str_replace("{alias}", $this->getAliasByPid($item), $tmp);				
				
				$res .= $this->CreatModMenuNodes($item['id'], $level+1);
				
				$res .= $this->skin['menuexpanded']['inactive_end'][$level];
			}
			$res .= $this->skin['menuexpanded']['end'][$level];
		}
		
		return $res;
	}
	
	
	
	

	/**
	 * формирование пути по модулю
	 *
	 */
	public function createModPath()
	{
		$res = array();

		foreach ($this->std->alias as $item)
		{
			if ($item == $this->mod_name)
			{
				$node['alias'] = '/'.$this->mod_name.'/';
				$node['title'] = $this->std->modules_all[$this->mod_name]['title'];
			}
			else
			{
				$node = $this->nosheet_id[$item];
				$node = $this->formatFreeData($node);
			}
			
						
			
			$res[] = $this->strtr_mod($this->skin['path_item'], $node);			 
		} 

		# последний пункт ПУТИ	
		$res[count($res)-1] = $this->strtr_mod($this->skin['path_curitem'], $this->node);	
		
		$res = implode($this->skin['path_delimiter'], $res);
		return $res;
	}
	
	
	
	
}






?>