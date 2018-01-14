<?php
/*
 +--------------------------------------------------------------------------
 |   SITE ENGINE v.3.0.0
 |   ========================================
 |   by SAT
 |   © «Web Otdel» Ltd
 |   http://www.vmast.ru
 |   ========================================
 |   Web: http://www.vmast.ru
 |   Email: sat@game-play.ru
 +---------------------------------------------------------------------------
 |
 |   > Объект - контекстный поиск по компонентам системы
 |   > Script written by SAT
 |
 +--------------------------------------------------------------------------
 */

require_once("search_js.php");

class main_search extends AbstractClass{

	var $std;
	var $modules                    = array();
	var $used_template              = '';
	var $start_page                 = 0;        // показываемая страница галереи
	var $searchword                 = '';       // поисковая фраза
	var $search_objs                = array();  // информация об объектах, участвующих в поиске
	var $search_pagenum             = 1;        // текущая страница
	var $search_curnum              = 0;        // текущая обрабатываемая позиция среди результатов поиска
	var $search_count               = 0;        // общее количество результатов поиска

	// блок экспортируемых переменных
	var $pagealias              = '';        // алиас страницы
	var $faq_cur                = -1;        // признак, что сейчас просматриваем какую-то конкретную картинку ( > -1    - просматриваем)

	function SearchClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/ )
	{


		$this->AbstractClass(
		$sub_alias,        // путь разложенный в массив
                                                           'se_modules',        // название таблицы с которой будем работать
                                                           'search'        // название модуля (то как модуль называется в таблице modules)
		);

		global
		$title,             // заголовок
		$h1,                // главная надпись
		$body,              // тело новости
		$path,
		$arrows,            // нумерация страниц результатов поиска
		$searchword,        // поисковая фраза
		$search_count,      // общее количество результатов поиска
		$template,          // имя используемого шаблона
		$_search_result,   // найденые результаты поиска
		$_search_noresult; // шаблон для отсуствия результатов поиска

		$searchword = trim( $this->std->getValueSession('search_word') );
		$searchword = $searchword ? $searchword : 'Поиск...';

		global $_search_js_on_module;

		global $search_form, $_search_form;
		$search_form = $_search_form;

		// адрес для поиска не должен превышать длину 2
		if (count($this->current_url_array) > 0)
		{
			if ($this->current_url_array[0] == $this->module_name)
			{
				$template = 'static';

				$searchword      = '';
				$title           = 'Результаты поиска';
				$h1              = $title;

				// определяем текущую страницу просмотра результата

				if (count($this->current_url_array) == 1)
				{
					$this->search_pagenum = 1;
				}
				elseif (preg_match("/page\d+/",$this->current_url_array[1]))
				{
					// если параметров два и второй является вислом
					$this->search_pagenum = preg_replace( "#page(\d+)#is", "\\1", $this->current_url_array[1] );
				}
				else
				{
					$template = 'error';
					$this->ModulError('SearchClass-> Обращение по ошибочной ссылке.');
					return;
				}

				//----------------------------
				// пришла форма с целью поиска
				//----------------------------
				if ($this->std->input['request_method'] == 'post')
				{
					$this->std->updateSession( $this->std->member['session_id'], 'delete', array('search_word' => '',
                                                                                                                     'objects'     => '',
					) );

					//---------------------------------
					// Формирует данные о модулях,
					// в которых возможен поиск,
					// а так же формирует список идентификаторов
					// вершин модулей, в которых обранужена
					// поисковая фраза
					//---------------------------------
					$this->setSessionSearchData();
				}


				// в сессии хранятся данные о результатах поиска: поисковая фраза и массив модулей с id вершин, в которых было что-то найдено
				// глобальный поиск осуществляется один раз, потом при просмотре страниц результатов данные берутся уже из сессии и
				// запрашиваются лишь вполне определённые вершины
				// из данных, полученных из модулей

				$this->searchword   = trim( $this->std->getValueSession('search_word') );
				$this->search_objs  = $this->std->getValueSession('objects');
				$this->search_count = $this->std->getValueSession('search_c');

				if ($this->searchword and is_array($this->search_objs) )
				{
					// получаем блок с результатами поиска
					$searchword   = $this->searchword;

					$body         = $this->getSearchResultBlock();

					$arrows       = $this->getArrows($this->search_pagenum, $this->std->settings['search_page_rows']);
					$search_count = $this->search_count;

					if ($search_count == 0 or !$search_count)
					{
						$body       = str_replace( "{SEARCHWORD}", $searchword, $_search_noresult);
						$searchword = '';
					}
					else
					{
						$find    = array( '{SEARCHWORD}', '{COUNTRESULT}', '{RESULT}', '{NAVIGATION}' );
						$replace = array( $searchword, $search_count, $body, $arrows );

						$body    = str_replace( $find, $replace, $_search_result);
					}

					$searchword = $searchword ? $searchword : 'Поиск...';

					$_search_js_on_module = str_replace("{SEARCHWORD}", $searchword, $_search_js_on_module);

				}
				else
				{
					//$this->ModulError('SearchClass-> Ошибка. В сессии нет данных о результатах поиска.');
				}
				
				$path = '<a href="/">Главная</a>&nbsp;<span>&raquo;</span>&nbsp;Результаты поиска';
			}

		}
	}


	/**
	 * формирует блок с результатами поиска, определённую страницу
	 */
	function getSearchResultBlock()
	{

		$num_to      = $this->search_pagenum * $this->std->settings['search_page_num'];  // до какого номера выводим, включительно
		$num_from    = $num_to - $this->std->settings['search_page_num'];                // от какого номера, включительно
		$this->search_curnum = 0;  // текущий обрабатываемый результат поиска

		$body = '';

		// цикл по модулям, которые были отобраны ранее при поиске
		foreach ($this->search_objs as $obj)
		{
			// уже выводилось, не обрабатывать
			if ($this->search_curnum+$obj['rows_count'] < $num_from)
			{
				$this->search_curnum += $obj['rows_count'];// увеличиваем текущий счётчик
			}
			elseif($this->search_curnum <= $num_to)
			{
				$ids = array();

				// цикл по отобранным ранее ID
				foreach ($obj['rows'] as $id)
				{
					 
					 
					if (($this->search_curnum < $num_from)){
						$this->search_curnum++;
					}
					elseif  (($this->search_curnum < $num_to) && ($this->search_curnum >= $num_from))
					{
						$ids[] = $id['id'];
						$this->search_curnum++;
					}
					else
					{
						break;
					}
				}

				 
				$body .= $this->getSearchItem($obj['modulename'], $ids, $this->search_curnum+1, $num_from);  // получаем результат
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
	function getSearchItem($module, $ids, $num, $num_from)
	{
		global $_search_result_value,  // шаблон пункта результата
		$host;                   // хост

		$res = '';

		// создаем имя таблицы
		$tbl = TABLENAME_PREFIX.$module;
		$ids = "id='".implode("' OR id='", $ids)."'";
		$sql = "select id, title, body FROM {$tbl} WHERE $ids";

		if ($this->std->db->query($sql, $rows) > 0)
		{//echo $sql;
			foreach ($rows as $row)
			{
				$num_from++;
				$body        = '';
				 
				$alias       = '';
				$title       = $row['title'];
				$body        = $row['body'];

				$body        = strip_tags($body);
				$searchword  = strtolower($this->searchword);
				$body        = preg_replace('#\n#is', '', $body);
				$searchword  = "#($searchword)#is";

				 

				 

				if( !preg_match( $searchword, $body) )
				{
					if( strlen( $body ) > ($this->std->settings['search_cut_count'] * 2))
					{
						$body = @substr( $body, 0, ($this->std->settings['search_cut_count']*2));
						$body .= '...';
					}
					 
				}
				else
				{
					$first_pos = @strpos( strtolower($body), strtolower($this->searchword));
					$right_pos = $first_pos + strlen($this->searchword)-1;
					$start     = '...';
					$end       = '...';

					// найденое значение ближе к началу
					if( strlen( substr( $body, 0, $first_pos) )  < $this->std->settings['search_cut_count'] )
					{
						$right_pos = ($right_pos + $this->std->settings['search_cut_count']) > (strlen( $body ) - 1) ?
						(strlen( $body ) - 1) :
						($right_pos + $this->std->settings['search_cut_count']);
						$first_pos = 0;
						$start     = '';
					}

					// если найденое значение ближе к концу
					if( strlen( substr( $body, $right_pos, strlen($body)-1) )  < $this->std->settings['search_cut_count'] )
					{
						$right_pos = strlen( $body );
						$first_pos = ($first_pos-$this->std->settings['search_cut_count']) > 0 ? ($first_pos-$this->std->settings['search_cut_count']) : 0;
						$end       = "";
					}

					if( $end and $start)
					{
						if( ($first_pos-$this->std->settings['search_cut_count']) > 0 )
						{
							$first_pos = $first_pos-$this->std->settings['search_cut_count'];
						}
						else
						{
							$first_pos = 0;
							$start     = '';
						}

						if( ($right_pos + $this->std->settings['search_cut_count']) > (strlen( $body ) - 1) )
						{
							$right_pos = (strlen( $body ) - 1);
							$end = '';
						}
						else
						{
							$right_pos += $this->std->settings['search_cut_count'];
						}
					}
				}

				$body      = substr( $body, $first_pos, ($right_pos-$first_pos));
				$body      = $start.$body.$end;

				$alias = '/'.$this->std->catalog->getAliasById($row['id']);

				// фиксим баг с index - алиасом
				$alias = trim($alias);
				$alias = preg_replace('#/index/$#is', '', $alias);


				$title       = preg_replace($searchword,"<b>\\1</b>",$title);
				$body        = preg_replace($searchword,"<b>\\1</b>",$body);

				// замена
				$find        = array('{NUM}', '{TITLE}', '{BODY}', '{ALIAS}', '{HOST}');

				$replace     = array($num_from, $title, $body, $alias, $host);
				$body        = str_replace($find, $replace, $_search_result_value);  // пункт

				$res .= $body;
				 
				 

				 
			}
		}

		return $res;
	}

	/**
	 * Формирует данные о модулях, в которых возможен поиск, а так же формирует список идентификаторов вершин модулей,
	 * в которых обранужена поисковая фраза
	 *
	 * @param unknown_type $searchword
	 */
	function setSessionSearchData()
	{

		$objects    = array(); // информация об объектах поиска
		$searchword = trim($this->std->input['search_word']);

		$search_exclusion_fields = array( 'alias', 'author',
                                                  'description', 'keywords',
                                                  'template', 'menu',
                                                  'owner', 'img', 'table_father'); // Поля-исключения из поиска


		// определяем список установленных активных модулей, в которых и будем искать
		$sql = "select * from ".TABLE_MODULES." where (is_active = 1 OR is_active = 2) and need_search=1";
		$query_id = $this->std->db->do_query($sql);

		// надо составить инфу о объектах, к которых будем вести поиск
		if ($this->std->db->getNumRows() and $searchword)
		{
			// т.к. в цикле используется дополнительный запрос, то обязательно передаем id текущего запроса
			while ($row = $this->std->db->fetch_row( $query_id ))
			{
				// создаем список полей по которым надо искать

				$q            = ''; // условие запроса
				$q_arr        = array();
				$search_field = array();


				// запрашиваем поля поиска
				/*$this->std->db->do_query("SELECT * FROM se_{$row['modulename']}");
				 $fields = $this->std->db->get_result_fields();

				 $cnt = count($fields);

				 for( $i = 0; $i < $cnt; $i++ )
				 {
				 // если не требуется поиск по данному полю, то не включаем его в совтав полей поиска
				 if( in_array($fields[$i]->name, $search_exclusion_fields) )
				 {
				 continue;
				 }

				 // включем в совтав полей поиска только если поле имеет текстовый тип
				 if( $fields[$i]->type == 'string' or $fields[$i]->type == 'blob')
				 {
				 $search_field[] = $fields[$i]->name;
				 }
				 }*/


				$search_field[] = 'id';
				$search_field[] = 'title';
				$search_field[] = 'sbody';
				$search_field[] = 'body';



				// пробегаем по полям поиска и создаем массив поисковых фраз
				foreach( $search_field as $fields )
				{
					$q_arr[] = "{$fields} LIKE '%$searchword%'";
				}

				// составляем запрос
				$q = implode(' OR ', $q_arr);

				// поиск по контексту модулей
				$sql = "SELECT * FROM ".TABLENAME_PREFIX.$row['modulename']." WHERE ({$q}) and (is_active = 1 OR is_active = 2) ORDER BY timestamp DESC";


				$rows_count = $this->std->db->query($sql, $rows_obj);

				if ($this->std->input['request_method'] == 'post')
				{
					$search_cou += $rows_count;
				}

				if ($rows_count > 0)
				{
					// в каждой итерации формируем очередной элемент-модуль, в котором возможен поиск по body и в котором есть результаты поиска
					// модули, в которых невозможен поиск, или в которых нет результата поиска - отбрасываем
					$modulename                                  = $row['modulename'];
					$objects[ $modulename ]                      = array();            // модуль и информация о результатах поиска
					$objects[ $modulename ]['rows_count']        = $rows_count;        // информация о количестве результатов
					$objects[ $modulename ]['modulename']        = $modulename;        // название модуля
					$objects[ $modulename ]['rows']              = array();            // результаты. Остаются только id вершин, но по ним потом можно получить данные о вершие и путь

					foreach ($rows_obj as $row_obj)
					{
						$objects[$modulename]['rows'][] = array( 'id' => $row_obj['id'] );
					}
				}
			}
		}

		// вставляем данные в сессию пользователя
		$resault_array = array();
		$resault_array['search_word'] = $searchword;
		$resault_array['objects']     = $objects;
		$resault_array['search_c']    = $search_cou;

		$this->std->updateSession( $this->std->member['session_id'], 'update', $resault_array);
		$this->search_count = $search_cou;

		unset($objects, $row, $rows_obj, $rows);
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

	function getArrows($limit, $arrows_limit)
	{
		return $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $this->std->getValueSession('search_c'),
                                                          'PER_PAGE'     => $this->std->settings['search_page_num'],
                                                          'CUR_ST_VAL'   => $limit,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "Страницы: ",
                                                          'BASE_URL'     => '/search',
                                                          'leave_out'    => $this->std->settings['search_page_rows'],
                                                          'IGNORE_REVERT'=> 1,
		) );
	}


}
?>