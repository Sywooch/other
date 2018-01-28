<?php

#
# пользовательская часть
#


require_once 'class_tree.php';

class main_search extends class_tree
{


	var $modules			= array();
	var $session			= array();	// хранимые в сессии данные
	var $word				= 0;        // поисковая фраза
	var $fields				= array('title', 'body');		// поисковые поля в таблицах
	var $curpage			= 1;        // показываемая страница галереи	


	var $module				= null;
	
	function main( )
	{
		 
		
		#-----------------------------------------------------------------------
		# всегда доступная пользователю часть модуля
		#-----------------------------------------------------------------------
		$this->getForm();
		
		
		
		
		
		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[0] != $this->mod_name)
		{
			# если вызывает другой модуль, то выход
			return;
		}
		
		
		

		// адрес для поиска не должен превышать длину 2
		if (count($this->std->alias) <= 2)
		{
				$this->setPul('title', 'Результаты поиска');
				$this->setPul('h1', 'Результаты поиска');

				if (count($this->std->alias) == 2)
				{
					# номер страницы
					$this->curpage = preg_replace( "#page(\d+)#is", "\\1", $this->std->alias[1] );
				}
				

				//----------------------------
				// пришла форма с целью поиска
				//----------------------------
				if ($this->std->input['request_method'] == 'post')
				{	
					$this->word = $this->std->input['word'];
					$this->session['word'] = $this->word;
						
					
					$this->session = array();
					$this->session['word'] = $this->word;
					$this->std->updateSession( $this->std->member['session_id'], 'update', array($this->mod_name => $this->session) );

					//---------------------------------
					// Формирует данные о модулях,
					// в которых возможен поиск,
					// а так же формирует список идентификаторов
					// вершин модулей, в которых обранужена
					// поисковая фраза
					//---------------------------------
					$this->searchData();
					
					
					# переподготовка формы
					$this->getForm();
				}


				// в сессии хранятся данные о результатах поиска: поисковая фраза и массив модулей с id вершин, в которых было что-то найдено
				// глобальный поиск осуществляется один раз, потом при просмотре страниц результатов данные берутся уже из сессии и
				// запрашиваются лишь вполне определённые вершины
				// из данных, полученных из модулей

				
								
				if ($this->word and is_array($this->session['objects']) )
				{	
										
					$body = $this->getSearchResultBlock();
					
					

					if ($this->session['count'] == 0 or !$this->session['count'])
					{
						$body       = str_replace( "{word}", $this->word, $this->skin['noresult']);						
					}
					else
					{
						$arrows = $this->getArrows();
						
						$find    = array( '{word}', '{count}', '{result}', '{arrows}' );						
						$replace = array( $this->word, $this->session['count'], $body, $arrows );

						$body    = str_replace( $find, $replace, $this->skin['result']);
					}
					
					
					$this->setPul('body', $body);
					$this->template = 'static';
				}
				else
				{					
					$this->log('Ошибка. В сессии нет данных о результатах поиска.');
					$this->template = 'error';
				}
			

		}
		else
		{
			$this->template = 'error';
			$this->log('Обращение по ошибочной ссылке');
		}
		
		
		
		
		

	}
	
	
	/**
	 * формирование формы поиска
	 *
	 */
	public function getForm()
	{
		$this->word = 'поиск...';
		$this->session = $this->std->getValueSession($this->mod_name);
		
		if (isset($this->session['word']) && ($this->session['word'] != ''))
		{
			$this->word = $this->session['word'];
		}
		

		# форма поиска
		$this->skin['form'] = str_replace('{word}', $this->word, $this->skin['form']);
		$this->updatePul($this->mod_name.'_form', $this->skin['form'] );
		
		# поисковая фраза
		$this->updatePul($this->mod_name.'_word', $this->word );
	}






	/**
	 * формирует блок с результатами поиска, определённую страницу
	 */
	function getSearchResultBlock()
	{
		$body		= '';
		$num_to      = $this->curpage * $this->std->settings[$this->mod_name.'_count_on_page'];  // до какого номера выводим, включительно
		$num_from    = $num_to - $this->std->settings[$this->mod_name.'_count_on_page'];                // от какого номера, включительно
		

		$body = '';
		$curnum = 0;

		// цикл по модулям, которые были отобраны ранее при поиске
		foreach ($this->session['objects'] as $obj)
		{
			// уже выводилось, не обрабатывать
			if ($curnum+$obj['rows_count'] < $num_from)
			{
				$curnum += $obj['rows_count'];// увеличиваем текущий счётчик
			}
			elseif($curnum <= $num_to)
			{

				// цикл по отобранным ранее ID
				foreach ($obj['rows'] as $id)
				{

					if (($curnum < $num_from)){
						$curnum++;
					}
					else
					{

						// если счётчик текущий не достик края вывода (если ещё можно на страницу поместить результат)
						if  (($curnum < $num_to) && ($curnum >= $num_from))
						{
							$body .= $this->getItem($obj['name'], $id['id'], $curnum+1);  // получаем результат
						}
						elseif ($curnum > $num_to) // если вышли за край
						{
							break; // выход из цикла
						}
						$curnum++;


					}
				}

			}
			else
			{
				break;
			}

		}

		return $body;
	}

	/**
	 * Создаём один пункт результата
	 *
	 * @param unknown_type $module        - название модуля
	 * @param unknown_type $id            - идентификатор вершины
	 * @param unknown_type $num           - текущий номер выводимомого пункта результата
	 * @return unknown                    - один оформленный пункт
	 */
	function getItem($module, $id, $num)
	{
		$res        = '';

		

		$sql = "SELECT id, pid, alias,  ".implode(', ', $this->fields)." FROM se_{$module} WHERE id ='".$id."' LIMIT 1";

		if ($this->db->query($sql, $rows) > 0)
		{
			$row = $rows[0];
			$row['num'] = $num;

			
			# очистка текстов от тегов для вывода на экран
			$row['body']        = preg_replace('#\n#is', '', strip_tags($row['body']));
			$this->word  = strtolower($this->word);

			
			
			#-------------------------------------------------
			# получение алиаса на страницу с поисковой фразой
			#-------------------------------------------------
			if($module == 'static')
			{
				if (is_null($this->module) || ($this->module->module_name != $module))
				{
					$this->module = null;
					include_once($this->std->config['path_modules']."/".$module."/".$module."_main.php");
					global $modules_list;
					$tmp = new main_static($this->std->alias, $modules_list);
					$tmp->module_name = $module;
					$tmp->std = &$this->std;
					$alias = '/';
					$tmp->db_table  = "se_".$module;
					$tmp->getStructureModule($tmp->db_table);
					$this->module = &$tmp;
				}
				
				$row['alias'] = $this->module->getAliasById($id);
				
			}
			else
			{				
				# новое поколение модулей
				
				if (is_null($this->module) || ($this->module->mod_name != $module))
				{
					include_once($this->std->config['path_modules']."/{$module}/{$module}_main.php");
	
					$class = 'main_'.$module;
					$module_run = new  $class($module, &$this->std);
					$this->module = &$module_run;
				}				
								
				$row['alias'] = $this->module->getAliasByPid($row);				
			}

			$body = $row['body'];
			
			if( !preg_match( "#$this->word#", $body) )
			{
				if( strlen( $body ) > ($this->std->settings[$this->mod_name.'__cut_count'] * 2))
				{
					$res = @substr( $body, 0, ($this->std->settings[$this->mod_name.'_cut_count']*2));
					$res .= '...';
				}
			}
			else
			{
				$first_pos = @strpos( strtolower($body), strtolower($this->word));
				$right_pos = $first_pos + strlen($this->word)-1;
				$start     = '...';
				$end       = '...';

				
				
				// найденое значение ближе к началу
				if( strlen( substr( $body, 0, $first_pos) )  < $this->std->settings[$this->mod_name.'_cut_count'] )
				{
					$right_pos = ($right_pos + $this->std->settings[$this->mod_name.'_cut_count']) > (strlen( $body ) - 1) ?
					(strlen( $body ) - 1) :
					($right_pos + $this->std->settings[$this->mod_name.'_cut_count']);
					$first_pos = 0;
					$start     = '';
				}

				// если найденое значение ближе к концу
				if( strlen( substr( $body, $right_pos, strlen($body)-1) )  < $this->std->settings[$this->mod_name.'_cut_count'] )
				{
					$right_pos = strlen( $body );
					$first_pos = ($first_pos-$this->std->settings[$this->mod_name.'_cut_count']) > 0 ? ($first_pos-$this->std->settings[$this->mod_name.'_cut_count']) : 0;
					$end       = "";
				}

				if( $end and $start)
				{
					if( ($first_pos-$this->std->settings[$this->mod_name.'_cut_count']) > 0 )
					{
						$first_pos = $first_pos-$this->std->settings[$this->mod_name.'_cut_count'];
					}
					else
					{
						$first_pos = 0;
						$start     = '';
					}

					if( ($right_pos + $this->std->settings[$this->mod_name.'_cut_count']) > (strlen( $body ) - 1) )
					{
						$right_pos = (strlen( $body ) - 1);
						$end = '';
					}
					else
					{
						$right_pos += $this->std->settings[$this->mod_name.'_cut_count'];
					}
				}

				$res      = substr( $body, $first_pos, ($right_pos-$first_pos));
				$body     = $start.$res.$end;
				
			}

			// фиксим баг с index - алиасом
			$alias = trim($row['alias']);
			$alias = preg_replace('#/index/$#is', '', $alias);


			$row['title']       = preg_replace("#$this->word#","<b>$this->word</b>", $row['title']);
			$row['body']        = preg_replace("#$this->word#","<b>$this->word</b>",$body);
			$row['host']		= $this->std->host;
			
			
			$res        = $this->strtr_mod($this->skin['item'], $row);  // пункт

			
		}

		return $res;
	}

	/**
	 * Формирует данные о модулях, в которых возможен поиск, а так же формирует список идентификаторов вершин модулей,
	 * в которых обранужена поисковая фраза
	 *
	 * @param unknown_type $searchword
	 */
	function searchData()
	{

		$objects    	= array(); // информация об объектах поиска
		$total_count	= 0; // общее количество результатов
		

		// определяем список установленных активных модулей, в которых и будем искать		
		$need_search = array();
		$sql = "SELECT * FROM se_modules
				WHERE is_active = 1 AND is_default_in_system = 0 AND need_search = 1";
		if ($this->db->query($sql, $modules))
		foreach ($modules as $mod)
		{
			$need_search[] = $mod;
		}		
		

		# сбор информации о объектах, в которых будем вести поиск
		if (count($need_search) > 0)
		{
			#--------------------------------------------------------------------
			# указанные в настройках поисковые поля представляем в виде условий
			#--------------------------------------------------------------------
			$where = array(); 
			foreach ($this->fields as $fields)
			{
				$where[] = $fields." LIKE '%".$this->word."%'"; 
			}
			
			$where = implode(' OR ', $where);
			
			
			
			
			#--------------------------------------------------------------------
			# поиск по таблицам модулей
			#--------------------------------------------------------------------
			foreach ($need_search as $mod)
			{
				// поиск по контексту модулей
				$sql = "SELECT id FROM ".$this->db->dbobj['sql_tbl_prefix'].$mod['modulename']." WHERE is_active = 1 AND ({$where})  ORDER BY timestamp DESC";

				
				$count = $this->db->query($sql, $rows);
				if ($count > 0)
				{
					// в каждой итерации формируем очередной элемент-модуль, в котором возможен поиск по body и в котором есть результаты поиска
					// модули, в которых невозможен поиск, или в которых нет результата поиска - отбрасываем
					
					$objects[ $mod['modulename'] ]                      = array();            // модуль и информация о результатах поиска
					$objects[ $mod['modulename'] ]['rows_count']        = $count;        // информация о количестве результатов
					$objects[ $mod['modulename'] ]['name']        		= $mod['modulename'];        // название модуля
					$objects[ $mod['modulename'] ]['rows']              = $rows;            // результаты. Остаются только id вершин, но по ним потом можно получить данные о вершие и путь

					$total_count += $count;
				}
			}
		}

		
		
		// вставляем данные в сессию пользователя
		$this->session['objects'] = $objects;
		$this->session['count'] = $total_count;

		$this->std->updateSession( $this->std->member['session_id'], 'update', array($this->mod_name => $this->session));
		

		unset($objects, $total_count, $need_search, $mod);
	}


	/**
	 * нумерация результатов поиска
	 *
	 *
	 * @param unknown_type $limit               - количество выводимых строк с результатом на одну страницу
	 * @param unknown_type $arrows_limit        - сколько номерков страниц выводить слева и справа от текущего номера
	 *                                      (это чтобы не показывать весь ряд имеющихся номеров страниц, а из могут быть десятки)
	 * @return unknown                          - возвращает готовую строку нумерации страниц
	 */

	function getArrows()
	{
		return $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $this->session['count'],
                                                          'PER_PAGE'     => $this->std->settings['search_count_on_page'],
                                                          'CUR_ST_VAL'   => $this->curpage,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "Страницы: ",
                                                          'BASE_URL'     => '/search',
                                                          'leave_out'    => $this->std->settings['arrows_around'],
                                                          'IGNORE_REVERT'=> 1,
		) );
	}


}
?>