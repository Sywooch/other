<?php

/**
 * Каталог с одной картинкой для каждой категории и товара
 *
 * доступны следующие переменные для вывода на HTML страницу
 * $img, $img_width, $img_height, $img_size,                                        - все данные большой картинки
 * $img_big, $img_big_width, $img_big_height, $img_big_size,        - все данные основной картинки
 * $img_av, $img_av_width, $img_av_height, $img_av_size,                - все данные аватарной картинки
 * $price                                                                                                                - цена
 * $catalog_list                                                                                                - список горячих товаров
 *
 *
 */
class main_catalog extends AbstractClass {

	var $cur_page = 1; // текущая страница нумерации
	var $cur_cat = -1; // текущая категория
	var $pagination = ''; // html постраничной нумерации
	var $item_begin;  // от какого до какого товара выводить на странице
	var $item_end;    //
	var $fsm_pid = array(); // список разделов по pid
	var $fsm_id = array();	// список разделов по id
	var $show_id = array(); // список страниц, участвующий в ПИТИ к текущей странице


	function catalogClass(
							$sub_alias /*запрашиваемая страница разложенная в массив*/
	)
	{
		global
		$template,                // имя используемого шаблона
		$title,                   // заголовок
		$h1,                      // главная надпись
		$body,                    // тело новости
		$keywords,                                  // ключевые слова
		$catalog_categories_menu,               // меню категорий
		$description,							// описание страницы
		$hotcatalog_list;
		
		global $catalog_path;
		$catalog_path = '';
		
		global $catalog_vars; // Глобальные данные модуля
		
		$catalog_vars = array();

		// вызов конструктора
		$this->AbstractClass(
		$sub_alias,          // путь разложенный в массив переприсваиваем внутренней переменной класса
                                       'catalog',    // название таблицы с которой будем работать
                                       'catalog'     // название модуля (то как модуль называется в таблице modules)
		);


		// если происходит работа с корзиной через АЯКС, тогда не нужно модулю вообще отрабатывать
		if (isset($this->std->alias[2]) && ($this->std->alias[2] == 'ajax'))
		{
			return ; 
		}
		
		$this->std->catalog = &$this;
		
		
		# если пользователь не просматривает каталог, тогда и информация ему на экране не вся нужна
		# оптимизируем расходы ресурсов
		if (isset($this->std->alias[0]) && ($this->std->alias[0] != 'catalog'))
		{
			$this->StructureModule = $this->getAllStructureModule('id, pid, title, alias');
			
			# формирование списка случайных товаров из каталога
			$hotcatalog_list = $this->getHotsList();
			
			# формирование древообразного меню по каталогу
			global $catalog_tree, $catalog_tree_archive;
			$catalog_tree = $this->createCatalogMenuMain();
			$catalog_tree_archive = $this->createCatalogMenuArchive();
			
			
			return;
		}
		
		
		
		# данные для всех страниц сайта		
		$this->StructureModule = $this->getAllStructureModule();
		
		# формирование списка случайных товаров из каталога
		$hotcatalog_list = $this->getHotsList();
				
		# формирование древообразного меню по каталогу
		global $catalog_tree, $catalog_tree_archive;
		$catalog_tree = $this->createCatalogMenuMain();
		$catalog_tree_archive = $this->createCatalogMenuArchive();
		
		
		
		

		
		
		
		// каталоги для главной страницы
		$this->IdCurPage = 'root';
		if (count($this->std->alias) == 0)
		{
			global $catalog_childmenu_with_childs;		
			//$catalog_childmenu_with_childs = $this->childMenu(1);
			$catalog_childmenu_with_childs = $this->getMainCatalogList();
			return;
		}
		
		
		#############################################################
		# работаем дальше только если смотрят именно каталог
		
		
		
		$this->IdCurPage = -1;		

		# формирование пути по каталогу
		if (count($this->current_url_array) > 0) $catalog_path = $this->createCatalogPath();
		
		
		

		// получение идентификатора страницы модуля, если -1, то такой страницы нет и модуль не должен отработать		
		if ($this->getIdByAlias($sub_alias) != -1)
		{			
			// получаем все данные выводимой страницы
			$this->getcatalogVars();

			// переприсваиваем из глобальным переменным и формируем шаблонные блоки для вывода на страницу			
			$this->main();
			
			if ($this->VarsCurPage['is_sheet'] == '0')
			{
				// Формирует два возможных вида меню для данного модуля
				$this->createModuleMenu();
			}
		}

		# если сейчас открыта категория, то шаблон соответствующий
		if ($this->cur_cat >= 0 && $this->IdCurPage < 0) $template = "catalog_cat";
	}
	
	
	
	/**
	 * формирование списка главных неархивных каталогов для главной страницы сайта
	 *
	 */
	function getMainCatalogList()
	{
		global $_catalog_child_menu_with_childs;
		$res = '';
		
		$sql = "SELECT * FROM se_catalog WHERE pid = -1 AND is_active = 1 ORDER BY pid, id, title";
		//$sql = "SELECT * FROM se_catalog WHERE pid = -1 AND is_active = 1 ORDER BY pid, id";
		if ($this->std->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				$res .= $this->createNode($row, $_catalog_child_menu_with_childs, &$res);
			}
			
			$res = $_catalog_child_menu_with_childs['begin'].$res.$_catalog_child_menu_with_childs['end'];
		}
		
		return $res;
	}
	

	/**
	 * формирование пути по каталогу
	 *
	 */
	function createCatalogPath()
	{
		global $_catalog_path_item_active, $_catalog_path_item_unactive;
		$res = '';
		$alias = '/catalog/';
		
		$res .= $_catalog_path_item_active;
		$res = str_replace("{TITLE}", "Главная", $res);
		$res = str_replace("{ALIAS}", "/", $res);		
		
		$res .= $_catalog_path_item_active;
		$res = str_replace("{TITLE}", "Каталог", $res);
		$res = str_replace("{ALIAS}", $alias, $res);
		
		if (count($this->current_url_array) < 2) return;
		
		for ($i = 1; $i < count($this->current_url_array)-1; $i++ )
		{
			$alias .= $this->StructureModule_id[$this->current_url_array[$i]]['id']."/";
			
			
			$res .= $_catalog_path_item_active;
			$res = str_replace("{TITLE}", $this->StructureModule_id[$this->current_url_array[$i]]['title'], $res);
			$res = str_replace("{ALIAS}", $alias, $res);			
		}
		$i = count($this->current_url_array)-1;
		if (isset($this->StructureModule_id[$this->current_url_array[$i]]))
		{
			$res .= $_catalog_path_item_active;
			$alias .= $this->StructureModule_id[$this->current_url_array[$i]]['id']."/";
			$res = str_replace("{TITLE}", $this->StructureModule_id[$this->current_url_array[$i]]['title'], $res);
			$res = str_replace("{ALIAS}", $alias, $res);	
		}
		
		return $res;
	}

	/**
	 * формирование древообразного меню по каталогу
	 *
	 */
	function createCatalogMenuMain()
	{	
		$this->fsm_pid = array();
		$this->fsm_id = array();	
		
		#--------------------------------------------
		# берём всё структуру каталогов, без товаров
		#--------------------------------------------
		//$sql = 'SELECT id, pid, title FROM se_catalog WHERE is_active = 1 AND is_sheet=0 ORDER BY pid, id, title';
		$sql = 'SELECT id, pid, title FROM se_catalog WHERE is_active = 1 AND is_sheet=0 ORDER BY pid, id';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				if( $row['pid'] == -1 )
				{
					$row['pid'] = 'root';
				}

				$this->fsm_pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->fsm_id[ $row['id'] ] = &$this->fsm_pid[$row['pid'] ][ $row['id'] ];
			}
		}
		
		
		#----------------------------------------------------------------------------
		# определяем список вершин, которые входят в "путь" сейчас открытой страницы
		#----------------------------------------------------------------------------		
		for ($i = 1; $i < count($this->current_url_array); $i++ )
		{
			$this->show_id[] = $this->current_url_array[$i];
		}
		
		
		# вызываем реккурсивную функцию построения меню
		return $this->CreatNodes('root', 1 );

	}
	

	
	function CreatNodes($pid, $level)
	{
		global $_catalog_menuexpanded;
		$res = '';
		
		
		if (is_array($this->fsm_pid[$pid]))
		{
			$res = $_catalog_menuexpanded['begin'][$level];
			
			foreach ($this->fsm_pid[$pid] as $item)
			{
				$tmp = $_catalog_menuexpanded['inactive'][$level];
				if (!in_array($item['id'], $this->show_id))
				{
					
					// блок для настройки уровней открытости
//					if ($level >= 2)
//					{
//						$tmp = str_replace("{class}", 'class="closed"', $tmp);
//					}
//					else
//					{
//						$tmp = str_replace("{class}", '', $tmp);
//					}

					$tmp = str_replace("{class}", 'class="closed"', $tmp);
				}
				else
				{
					$tmp = str_replace("{class}", '', $tmp);
				}
				$tmp = str_replace("{TITLE}", $item['title'], $tmp);
				$res .= str_replace("{ALIAS}", $this->getMenuAliasById($item['id']), $tmp);				
				
				$res .= $this->CreatNodes($item['id'], $level+1);
				
				//$res .= $_catalog_menuexpanded['inactive_end'][$level];
			}
			$res .= $_catalog_menuexpanded['end'][$level];
		}
		return $res;
	}
	
	
	
	
	
	
	/**
	 * формирование древообразного меню по каталогу
	 *
	 */
	function createCatalogMenuArchive()
	{		
		$this->fsm_pid = array();
		$this->fsm_id = array();
			
		#--------------------------------------------
		# берём всё структуру архивных каталогов, без товаров
		#--------------------------------------------
		$sql = 'SELECT id, pid, title FROM se_catalog WHERE is_active = 2 AND is_sheet=0 ORDER BY pid, id, title';
		if ($this->std->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				if( $row['pid'] == -1 )
				{
					$row['pid'] = 'root';
				}

				$this->fsm_pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->fsm_id[ $row['id'] ] = &$this->fsm_pid[$row['pid'] ][ $row['id'] ];
			}
		}
		
		
		#----------------------------------------------------------------------------
		# определяем список вершин, которые входят в "путь" сейчас открытой страницы
		#----------------------------------------------------------------------------		
		for ($i = 1; $i < count($this->current_url_array); $i++ )
		{
			$this->show_id[] = $this->current_url_array[$i];
		}
		
		
		# вызываем реккурсивную функцию построения меню
		return $this->CreatArchiveNodes('root', 1 );

	}		
	
	
	
	function CreatArchiveNodes($pid, $level)
	{
		global $_catalog_menuexpanded_archive;
		$res = '';
		
		
		if (is_array($this->fsm_pid[$pid]))
		{
			$res = $_catalog_menuexpanded_archive['begin'][$level];
			
			foreach ($this->fsm_pid[$pid] as $item)
			{
				$tmp = $_catalog_menuexpanded_archive['inactive'][$level];
				if (!in_array($item['id'], $this->show_id))
				{
					
					// блок для настройки уровней открытости
//					if ($level >= 2)
//					{
//						$tmp = str_replace("{class}", 'class="closed"', $tmp);
//					}
//					else
//					{
//						$tmp = str_replace("{class}", '', $tmp);
//					}

					$tmp = str_replace("{class}", 'class="closed"', $tmp);
				}
				else
				{
					$tmp = str_replace("{class}", '', $tmp);
				}
				$tmp = str_replace("{TITLE}", $item['title'], $tmp);
				$res .= str_replace("{ALIAS}", $this->getMenuAliasById($item['id']), $tmp);				
				
				$res .= $this->CreatArchiveNodes($item['id'], $level+1);
				
				//$res .= $_catalog_menuexpanded['inactive_end'][$level];
			}
			$res .= $_catalog_menuexpanded_archive['end'][$level];
		}

		return $res;
	}

		/** 
		 * Получение алиаса страницы по идентификатору вершины
		 * 
		 *  return string  - алиас страницы
         */
		function getMenuAliasById($id)
		{	
				# если дошли не до корня, то реккурсия, иначе вывод результата 
				if ($this->fsm_id[$id]['pid'] != 'root')
				{
						# реккурсивный вызов себя же
						$res = $this->getAliasById($this->fsm_id[$id]['pid']);						
				}
				else
				{			
						$res = "catalog/";						
				}
							
				return $res.$this->fsm_id[$id]['id']."/";	
		}
		

	
	
	
	/**
	 * возвращает массив товаров, которым присвоена категория `cat_id`
	 *
	 */
	function getChildsByCat()
	{
		$sql = "SELECT * FROM se_catalog_2cats WHERE `cat_id` = '".$this->cur_cat."'";
		$this->std->db->do_query($sql);

		$mas = array();
		$ids = array();
		while ($row = $this->std->db->fetch_row())
		{
			$ids[] = $row['child_id'];
		}

		$ids_str = "";
		foreach ($ids as $id)
		$ids_str .= "`id` = '".$id."' or ";

		if ($ids_str != "")
		{
			$ids_str .= "0 ";
			$sql = "SELECT * FROM se_catalog WHERE ".$ids_str;
			$this->std->db->do_query($sql);
			while ($row = $this->std->db->fetch_row())
			{
				$mas[$row['id']] = $row;
			}
		}

		return $mas;
	}

	/**
	 * возвращает html текст меню категорий
	 *
	 */
	function getCatsMenu( )
	{
		if (!$this->std->settings['catalog_categories_enable']) return '';
		global $_catalog_categories_menu;

		if (isset($this->current_url_array[0]) && $this->current_url_array[0] != 'catalog') return;

		$sql = "SELECT * FROM ".TABLE_CATALOG_CATEGORIES." ORDER BY `item_order`";
		$this->std->db->do_query($sql);

		# вытаскиваем из алиаса номер категории
		$j = -1;
		foreach ($this->current_url_array as $_id => $str)
		{
			if (preg_match("/cat\d+/",$str))
			{
				$this->cur_cat = preg_replace("#cat(\d+)#is", "\\1", $str);
				$j = $_id;
			}
		}

		# убираем из массива url элемент cat
		$temp = array();
		if ($j >= 0) unset($this->current_url_array[$j]);
		foreach ($this->current_url_array as $t)
		$temp[] = $t;

		$this->current_url_array = $temp;

		$rtn = $_catalog_categories_menu['begin'];
		while ($row = $this->std->db->fetch_row())
		{
			if ($this->cur_cat == $row['id'])
			{
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( '/catalog/cat'.$row['id'].'/', $row['title'] ), $_catalog_categories_menu['active']);
			} else {
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( '/catalog/cat'.$row['id'].'/', $row['title'] ), $_catalog_categories_menu['inactive']);
			}
			$rtn .= $_catalog_categories_menu['delimiter'];
		}
		$rtn .= $_catalog_categories_menu['end'];

		return $rtn;
	}

	

	
	
	/**
	 * нумерация
	 *
	 *
	 * $item_limit                - количество выводимых товаров на одну страницу
	 * $arrows_limit        - сколько номерков страниц выводить слева и справа от текущего номера
	 *                                                                                   (это чтобы не показывать весь ряд имеющихся номеров страниц, а из могут быть десятки)
	 * @return unknown                                                 - возвращает готовую строку нумерации страниц
	 */
	function getPages($item_limit /*количество товаров выводимых на страницу*/, $arrows_limit /*количество номерков в строке нумерации*/)
	{
		global $arrows;
		$arrows        = '';

		$childs = array();

		# если это страница категории то childs - товары данной категории, иначе childs - товары текущего раздела
		if (isset($this->StructureModule_pid[$this->IdCurPage]))
		{
			if ($this->cur_cat >= 0 && ($this->IdCurPage < 0 || $this->IdCurPage == "root")) $childs = $this->getChildsByCat();
			else $childs = $this->StructureModule_pid[$this->IdCurPage];
		}
		$count = 0;

		if (count($childs) > 0)
		{
			# считаем кол-во товаров, которые не являются узлами
			foreach ($childs as $child) 
			{
				if (isset($this->StructureModule_id[$child['id']]) && count($this->StructureModule_pid[$child['id']]) == 0) 
				{
					$count++;
				}
			}
		}

		# кол-во товаров на страницу
		global $_catalog_page_limit;
		$ipp = $this->std->settings['catalog_items_per_page'];

		$this->items_count = $count;

		# определяем кол-во страниц
		$this->pages_count = 0;
		if ($this->items_count > $ipp)
		{
			@$this->pages_count = ceil($this->items_count / $ipp);
		}

		# определяем от какого до какого товара выводить на данной странице
		$this->item_begin = ( $this->cur_page - 1 ) * $ipp;
		$this->item_end = $this->item_begin + $ipp - 1;

		# формируем строку алиаса, после которой будет добавляться pageN
		$prepage = '';
		for ($i=0; $i < count($this->current_url_array); $i++) $prepage .= '/'.$this->current_url_array[$i];

		if ($this->cur_cat >= 0 && ($this->IdCurPage < 0 || $this->IdCurPage == "root"))
		{
			$prepage .= "/cat".$this->cur_cat;
		}

		$this->pagination = $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $this->items_count,
                                                             'PER_PAGE'    => $ipp,
                                                             'CUR_ST_VAL'  => $this->cur_page,
                                                             'L_SINGLE'    => "",
                                                             'L_MULTI'     => "Страницы: ",
                                                             'BASE_URL'    => $prepage,
                                                             'leave_out'   => $arrows_limit,
		) );
		
		$arrows = $this->pagination;
	}



	/**
	 * Главная функция модуля, тут можно что-то вызывать, формировать и выводить
	 *
	 */
	function main()
	{
		global $template;        // шалон стрницы


		// вывод доплнительных полей таблицы, особенных мненно для данного модуля
		global  $img; // картинка со всеми возможными вариантами вывода

		global  $price;                        // цена

		global  $_catalog_img;
		
		global $_catalog_putincart, $catalog_vars;
		
		if ($this->VarsCurPage['id'] > 0)
		{				
				$catalog_vars = $this->VarsCurPage;
				$catalog_vars['putincart'] = str_replace("{good_id}", $this->VarsCurPage['id'], $_catalog_putincart);
				$catalog_vars['putincart'] = str_replace("{good_price}", $this->VarsCurPage['price'], $catalog_vars['putincart']);
				$catalog_vars['putincart'] = str_replace("{good_title}", $this->std->clean_value($this->VarsCurPage['title']), $catalog_vars['putincart']);
				$catalog_vars['putincart'] = str_replace("{good_catalog_id}", $this->VarsCurPage['catalog_id'], $catalog_vars['putincart']);
		}

		// цена
		$price = number_format($this->VarsCurPage['price'], 2, ',', ' ');

		/*-----------------------------------------------------------------------------------------------*/
		// вывод картинок и или шаблонов заменителей, если картинок нет
		/*-----------------------------------------------------------------------------------------------*/
		
		if (file_exists("./".FILES_FOLDER."/".$this->module_name."/bimg/".$this->VarsCurPage['id'].".jpg"))
		{
			/*----------------------------------------*/
			// картинка - оригинал
			/*----------------------------------------*/
			//$img_big = $this->ModuleFilesPath.$this->VarsCurPage['id']."_big".$this->VarsCurPage['img'];        // сама картинка
			//list($img_big_width, $img_big_height) = $this->std->getWithHeightImage($img_big);        // ширина и высота
			//$img_big_size = $this->std->getFileSize($img_big);                // размер файла в Kb

			/*----------------------------------------*/
			// картинка - основная
			/*----------------------------------------*/
			$img = "/".FILES_FOLDER."/".$this->module_name."/bimg/".$this->VarsCurPage['id'].".jpg";        // сама картинка
			list($img_width, $img_height) = $this->std->getWithHeightImage($img);                // ширина и высота
			$img_size = $this->std->getFileSize($img);                // размер файла в Kb


			/*----------------------------------------*/
			// картинка - аватар
			/*----------------------------------------*/
			//$img_av = $this->ModuleFilesPath.$this->VarsCurPage['id']."_av".$this->VarsCurPage['img'];        // сама картинка
			//list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);                // ширина и высота
			//$img_av_size = $this->std->getFileSize($img_av);                // размер файла в Kb


			/*----------------------------------------*/
			// что ищем в шаблонах
			/*----------------------------------------*/
			$search = array("{IMG_BIG}","{IMG_BIG_WIDTH}","{IMG_BIG_HEIGHT}","{FILE_BIG_SIZE}",
                                                                        "{IMG}","{IMG_WIDTH}","{IMG_HEIGHT}","{FILE_SIZE}",
                                                                        "{IMG_AV}","{IMG_AV_WIDTH}","{IMG_AV_HEIGHT}","{FILE_AV_SIZE}");

			/*----------------------------------------*/
			// на что будем заменять
			/*----------------------------------------*/
			$replace = array($img_big, $img_big_width, $img_big_height, $img_big_size,
			$img, $img_width, $img_height, $img_size ,
			$img_av, $img_av_width, $img_av_height, $img_av_size);
			// замена
			$img = str_replace($search, $replace, $_catalog_img);                        // основная
		}
		else
		{
			// картинки нет, пусто
			$img        = "";
		}


		
		#----------------------------------------------------
		# формирование списка фоток, прикреплённых к товару
		#----------------------------------------------------
		global $catalog_gallery;
		$catalog_gallery = '';
		if ($this->VarsCurPage['is_sheet'] == '1')
		{
			$catalog_gallery = $this->getGalleryItem($this->VarsCurPage['id']);
		}
		


		// если есть наследники, то это категория, иначе товар
		if (!@is_array($this->StructureModule_pid[$this->VarsCurPage['id']]))
		{
			$template = "catalog_item";
			
			if (file_exists(MODULES_PATH."/shop/shop_init.php"))
			{
					require_once(MODULES_PATH."/shop/shop_main.php");
					$class_name = 'main_shop';
					$shop = new $class_name($this->current_url_array);
					$shop->std = &$this->std;
					$alias = "/shop/";
					$shop->module_name = "shop";
					$shop->catalog = &$this;
		
					global $shop_attend;
					$shop_attend = $shop->getAttend($this->VarsCurPage['id']);					       		
			}
		}

		

		/*----------------------------------------------------------------*/
		// вывод стандартного набора данных о странице
		/*----------------------------------------------------------------*/
		$this->showStandartVars();

		/*----------------------------------------------------------------*/
		// вывод свойств товара
		/*----------------------------------------------------------------*/
		//$this->showProperties();

	}

	
	/**
	 * формирование галереи для вывода на страницу товара
	 *
	 */	
	function getGalleryItem($id)
	{
		global $_catalog_gallery;
		$ret = '';
		$imgs = array();
		$count = 0;
		
		
		//Указываем рабочую папку
		$url = FILES_FOLDER.'/catalog/add/'.$id;
		//Проверяем, является ли директорией
		if (is_dir($url)) {
			//Проверяем, была ли открыта директория
			if ($dir = opendir($url)) {
				//Сканируем директорию
				while (false !== ($file = readdir($dir))){
					//Убираем лишние элементы
					if ($file != "." && $file != "..") {
						// формируем список
						$file = '/files/catalog/add/'.$id.'/'.$file;
						$tmp = $_catalog_gallery['item'];
						$tmp = str_replace('{alias}', $file, $tmp);
						$count++;
						$tmp = str_replace('{title}', 'Фото №'.$count, $tmp);

						$imgs[] = $tmp;
					}
				}
				//Закрываем директорию
				closedir($dir);
			}
		}
		
		
		
		if ($count > 0)
		{
			$_catalog_gallery['begin'] = str_replace("{count}", count($imgs), $_catalog_gallery['begin']);
			$ret = $_catalog_gallery['begin'].implode(',', $imgs).$_catalog_gallery['end'];
		}
		
		return $ret;
	}
	
	
	/**
	 * Достает set_id для корневых товаров
	 *
	 */
	function getRootSet()
	{
		$sql = "SELECT * FROM se_settings WHERE `config_key` = 'catalog_default_set'";
		$this->std->db->do_query($sql);
		$row = $this->std->db->fetch_row();
		return $row['config_value'];
	}

	/**
	 * Выводит свойства товара
	 *
	 */
	function showProperties()
	{
		global $catalog_properties, $_catalog_child_properties;

		if (!($this->IdCurPage >= 0)) return;

		# если это не лист, то свойства не нужны
		if (@is_array($this->StructureModule_pid[$this->VarsCurPage['id']])) return;

		if ($this->VarsCurPage['pid'] > 0)
		{
			# читаем id набора в родителе
			$sql = "SELECT `set_id` FROM se_catalog WHERE `id` = '".$this->VarsCurPage['pid']."'";
			$this->std->db->do_query($sql);
			$row = $this->std->db->fetch_row();
			$set_id = $row['set_id'];
		} else {
			$set_id = $this->getRootSet();
		}

		# читаем id свойств, входящих в набор свойств этого товара
		$sql = "SELECT * FROM se_catalog_property_set WHERE `id` = '".$set_id."'";
		$this->std->db->do_query($sql);
		$row = $this->std->db->fetch_row();
		$prop_ids = unserialize($row['properties']);

		# читаем все свойства
		$sql = "SELECT * FROM se_catalog_properties";
		$this->std->db->do_query($sql);
		$ptitles = array();
		while ($row = $this->std->db->fetch_row())
		{
			$ptitles[$row['id']] = $row['title'];
		}

		$str = "";
		# читаем данные свойств
		$sql = "SELECT * FROM se_catalog_property_values WHERE `c_id` = '".$this->VarsCurPage['id']."'";
		$this->std->db->do_query($sql);
		while ($row = $this->std->db->fetch_row())
		{
			if (!@in_array($row['p_id'],$prop_ids)) continue; // свойство не входит в набор свойств
				
			$tmp = $_catalog_child_properties['property'];
			$tmp = str_replace('{TITLE}', $ptitles[$row['p_id']], $tmp);
			$tmp = str_replace('{VALUE}', $row['value'], $tmp);

			$str .= $tmp.$_catalog_child_properties['delimiter'];
		}

		$catalog_properties = $_catalog_child_properties['begin'];
		$catalog_properties .= $str;
		$catalog_properties .= $_catalog_child_properties['end'];
	}



	
	

	/**
	 * формирует список горячих товаров
	 *
	 */
	function getHotsList()
	{		
		$res = "";
		

		global $_catalog_hotlist;
		//$sql = "SELECT * FROM se_catalog WHERE is_active = 1 AND is_hot = 1 ORDER BY RAND()";
		
		
		# случайный номер, от которого отплясывать будем
		$num_from = rand(0, 600);
		
		
		if ($this->current_url_array[0] == '')
		{
			// если  главная, то не отрабатываем, выходим
			return '';
			$_catalog_hotlist = $_catalog_hotlist[0];
			$sql = "SELECT * FROM se_catalog WHERE is_active = 1 AND is_sheet=1 LIMIT $num_from, 6";
		}
		else
		{
			$_catalog_hotlist = $_catalog_hotlist[1];
			$sql = "SELECT * FROM se_catalog WHERE is_active = 1 AND is_sheet=1 LIMIT $num_from, 2";
		}
		
		if ($this->std->db->query( $sql, $rows) > 0)
		{
			$items = array();
			foreach ($rows as $row)
			{				

				$tmp = $_catalog_hotlist['item'];
				// картинка - аватар				
				if (file_exists("./".FILES_FOLDER."/".$this->module_name."/limg/".$row['id'].".jpg"))
				{
					$img_av = "/".FILES_FOLDER."/".$this->module_name."/limg/".$row['id'].".jpg";        // сама картинка
					list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);                // ширина и высота
					$img_av_size = $this->std->getFileSize($img_av);                // размер файла в Kb
				}
				else
				{
					$img_av          = "/".FILES_FOLDER."/".$this->module_name."/default.jpg";
					$img_av_width    = 0;
					$img_av_height   = 0;
					$img_av_size     = 0;
				}


				// дата создания документа
				$date       = $this->std->get_time($row['timestamp'], $this->std->get_date_format( $tmp ) );
				$tmp        = preg_replace("#\{DOCUMENTDATE\(.+?\)\}#is",$date, $tmp);


				// что ищем в шаблонах
				$search = array("{IMG_AV}","{IMG_AV_WIDTH}","{IMG_AV_HEIGHT}","{IMG_AV_SIZE}");

				// на что будем заменять
				$replace = array($img_av, $img_av_width, $img_av_height, $img_av_size);

				// замена
				$tmp = str_replace($search, $replace, $tmp);

				//---------------------------------------
				// подготовка остальных данных
				//---------------------------------------
				$row["price"] = number_format($row["price"], 2, ',', ' ');

				$alias = "/".$this->module_name."/";

				$alias = '/'.$this->getAliasById($row["id"]);
				$row["alias"] = $alias;

				$tmp = str_replace( "{ID}", $row['id'], $tmp );

				foreach( $row as $k => $v )
				{
					$tmp = str_replace( "{".strtoupper($k)."}", $v, $tmp);
				}

				$items[] = $tmp;
			}
		}
		
		if (count($items) > 0) $res = $_catalog_hotlist['begin'].implode($_catalog_hotlist['separator'], $items).$_catalog_hotlist['end'];
		else $res = '';

		return $res;
	}




	/**
	 * Формирует три возможных вида меню для данного модуля
	 *
	 */
	function createModuleMenu()
	{
		# формируем страницы
		$this->getPages($this->std->settings['catalog_items_per_page'],$this->std->settings['catalog_count_near_select_page']);
		global $arrows;
		$arrows = $this->pagination;

		global $catalog_cat_childmenu;
		if ($this->cur_cat >= 0 && ($this->IdCurPage < 0 || $this->IdCurPage == "root"))
		{
			// формирование childsmenu без детей (категория)
			$catalog_cat_childmenu = $this->childMenu(3);
		}

		// формирование menuchilds
		global $catalog_childmenu;
		//$catalog_childmenu = $this->childMenu();


		// формирование childsmenu c детьми
		global $catalog_childmenu_with_childs;
		$catalog_childmenu_with_childs = $this->childMenu(1);


		// формирование childsmenu без детей
		global $catalog_childmenu_without_childs;
		$catalog_childmenu_without_childs = $this->childMenu(2);

	}


	/**
	 * вывод стандартного набора данных о странице
	 *
	 */
	function showStandartVars()
	{
		// вывод стандартного набора данных о странице
		global $title,
		$body,
		$sbody,
		$author,
		$h1,
		$date,
		$keywords,
		$description,
		$template,
		$timestamp,
		$catalog_id;

		// выводим keywords и если таковые присутвуют
		$keywords    = $this->std->build_meta_tags( $this->VarsCurPage['keywords'], 'keywords' );
		$description = $this->std->build_meta_tags( $this->VarsCurPage['description'], 'description');

		$title                         = $this->VarsCurPage['title'];
		$sbody                         = $this->VarsCurPage['sbody'];
		$body                          = $this->VarsCurPage['body'];
		$author                        = $this->VarsCurPage['author'];
		$h1                            = $this->VarsCurPage['h1'];
		$timestamp                     = $this->VarsCurPage['timestamp'];
		$catalog_id                    = $this->VarsCurPage['id'];

		
		global $description1, $description2, $description3, $description4;
		$description1 = isset($this->VarsCurPage['Description1']) ? $this->VarsCurPage['Description1'] : '';
		$description2 = isset($this->VarsCurPage['Description2']) ? $this->VarsCurPage['Description2'] : '';
		$description3 = isset($this->VarsCurPage['Description3']) ? $this->VarsCurPage['Description3'] : '';
		$description4 = isset($this->VarsCurPage['Description4']) ? $this->VarsCurPage['Description4'] : '';
		

		if ($this->VarsCurPage["template"] != "")
		{
			$template = $this->VarsCurPage["template"];
		}
		
		if (($this->VarsCurPage["is_active"] == 2) && ($this->VarsCurPage["is_sheet"] == 1))
		{
			$template = 'catalog_item_archive';
		}
	}



	/**
	 * получение идентификатора страницы модуля, если -1, то такой страницы нет и модуль не должен отработать
	 *
	 * @param unknown_type $sub_alias        - путь разложенный в массив
	 * @return - или -1 или идентификатор выводимой вершины
	 */
	function getIdByAlias($sub_alias)
	{
		// модуль не может работать, если выводится главная страница "/"
		if (count($this->current_url_array) > 0)
		{
			// запускаем выполнение модуля, только если первый элемент текущего УРЛА совпадает с названием модуля			
			if ($this->current_url_array[0] == $this->module_name)
			{				
				// фукнция формирования даты				
				//require_once(MODULES_PATH."/catalog/catalog_date.php");
				

				$ispage = 0;
				$j_page = -1;
				$j_cat = -1;
				
				// читаем текущую страницу, если она задана в адресе
				foreach ($this->current_url_array as $_id => $str)
				{
					if (preg_match("/page\d+/",$str))
					{
						$this->cur_page = preg_replace("#page(\d+)#is", "\\1", $str);
						$ispage = 1;
						$j_page = $_id;
					}
					if (preg_match("/cat\d+/",$str))
					{
						$this->cur_cat = preg_replace("#cat(\d+)#is", "\\1", $str);
						$j_cat = $_id;
					}
				}

				
				
				$temp = array();
				if ($j_page >= 0) unset($this->current_url_array[$j_page]);
				if ($j_cat >= 0) unset($this->current_url_array[$j_cat]);
				
				
				 
/*
 * 
 *
				foreach ($this->current_url_array as $t)
				{
						$temp[] = $t;
				}

				$this->current_url_array = $temp;
*/
				if (count($this->current_url_array) > 1)
				{
					// ошибка
					$error = "";

					// запрашваем всю структуру модуля из БД
					//$this->StructureModule = $this->getAllStructureModule();

					// название шаблона
					$template = $this->module_name;

					// продолжаем работу, если структура модуля не пуста и из неё можно что-то извлечь
					
					if (is_array($this->StructureModule))
					{
						// в структуре модуля ищем все участвующие в формировании URL вершины, если всё найдено, то путь верен
						
						$i = 1;
						$pid = "-1";        // начинаем поиск с корня
						$alias = "";

						/*foreach ($this->StructureModule as $row)
						{
							if (($row["alias"] == $this->current_url_array[$i]) && ($pid == $row["pid"]))
							{
								$i++;
								$alias        = $row["alias"];
								$pid        = $row["id"];

								if (($i) == count($this->current_url_array))
								{
									$this->IdCurPage = $row["id"];
									break;
								}
							}
						}*/
						
						if (isset($this->current_url_array[count($this->current_url_array)-1]))
						{
							$this->IdCurPage = $this->current_url_array[count($this->current_url_array)-1];
						}
						else
						{
							$error = "Обращение по ошибочной ссылке или ошибка работы с БД";
						}
						
						
					}
					else
					{
						$error = "Обращение по ошибочной ссылке или ошибка работы с БД";
					}


					if ($error != "")
					{
						global $template;
						$template = 'error';                                // шаблон вызываем такой
						$this->ModulError("Error {catalogClass:getIdByAlias} {$error}: url >>> [".$this->current_url."]");
					}
				}
				else
				{
					header('Location: /');
					exit;
				}
			}
		}

		return $this->IdCurPage;
	}



	/**
	 * Извлечение все структуры модуля из БД
	 */
	function getAllStructureModule($params = '*')
	{
		$sql = "SELECT  $params
		FROM {$this->db_table}
		WHERE is_active = 1 OR is_active = 2
		ORDER BY pid, item_order, title";


		
		if ($this->std->db->query($sql, $rows) > 0)
		{
			// формирование структур - удобных для поиска и подсчёта
			foreach ($rows as $row)
			{
				if( $row['pid'] < 1 )
				{
					$row['pid'] = 'root';
				}

				$this->StructureModule_pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->StructureModule_id[ $row['id'] ] = &$this->StructureModule_pid[$row['pid'] ][ $row['id'] ];
			}

			return $rows;        // если модуль не пуст, то возвращаем всё его содержимое
		}

		return null;        // если пуст, то и возвращаем пустоту
	}



	/**
	 * Получение данных из БД
	 *
	 */
	function getcatalogVars()
	{
		$res = array();        // результат

		// если есть записи
		if (isset($this->StructureModule_id[$this->IdCurPage]))
		{	
			// все данные вершины сохраняем в вструктуре класса для дальнейшего использования
			$this->VarsCurPage = $this->StructureModule_id[$this->IdCurPage];
			
			if ($this->VarsCurPage['sbody'] != '')
			{
				$this->VarsCurPage['sbody'] = unserialize($this->VarsCurPage['sbody']);
				foreach ($this->VarsCurPage['sbody'] as $key => $value)
				{
					$this->VarsCurPage[$key] = $value;
				}
				
			}
			// конец: проверка необходимости редиректа на первого подчинённого потомка

		}
		else
		{
			// запрашиваемая статическая страница в базе отсутствует или деактивированна, т.е. показываем ошибку
			global $template;
			$template = 'error';
			$this->ModulError( "Error {{$this->module_name}Class:getcatalogVars}:  нет такой записи в таблице. ID=".$this->IdCurPage);
		}


	}


	/*-----------------------------------------------------------------------------------------------------------*/
	//
	//         набор фукнций для построения меню
	//        1. меню детей
	//        2. меню детей с детьми
	//        3. меню детей без детей
	//
	/*-----------------------------------------------------------------------------------------------------------*/




	/**
	 * вывод смежных вершин меню
	 *
	 * @param unknown_type $alias_menu
	 * @param unknown_type $type
	 * @return unknown
	 */
	function childMenu( $type = 0  )
	{
		global $uri;
		global $_catalog_child_menu, $_catalog_child_menu_with_childs, $_catalog_child_menu_without_childs, $_catalog_category_child_menu, $_catalog_child_menu_without_childs_archive;


		/*-------------------------------------------------------------------------*/
		// определение используемого шаблона
		/*-------------------------------------------------------------------------*/
		if( $type == 0 )
		{
			if( count( $_catalog_child_menu ) )
			{
				$_template = $_catalog_child_menu;
			}
		}
		elseif( $type == 1 )
		{
			if( count( $_catalog_child_menu_with_childs ) )
			{
				$_template = $_catalog_child_menu_with_childs;				
			}
		}
		elseif( $type == 2 )
		{
			if( count( $_catalog_child_menu_without_childs ) )
			{
				$_template = $_catalog_child_menu_without_childs;
			}
		}
		else
		{
			if( count( $_catalog_category_child_menu ) )
			{
				$_template = $_catalog_category_child_menu;
			}
		}
		/*--------------------------------------------------------------------------*/

		$menu = '';


		$childs = array();
		switch ($type)
		{
			case 3: $childs = $this->getChildsByCat(); break;
			default: $childs = @$this->StructureModule_pid[$this->IdCurPage];
		}

		$this->std->count_menu = count($childs);
		if ($this->std->count_menu == 0)
		{
			return "";
		}

		if( isset($_template['megadelimiter'] ))
		{
			$this->std->parcer_magadelimeter( $_template['megadelimiter'] );
		}

		$count = 1;
		$i = -1;

		foreach ($childs as $child) // по всем пунктам меню
		{
			if ($child['alias'] != $uri)
			{
				if (isset($this->StructureModule_pid[$child['id']])) 
				$count_childs = count($this->StructureModule_pid[$child['id']]);
				else $count_childs = 0 ;
				// запрос статических страниц, отец у которых равен $pid
				if(!$type)
				{
					$menu .= $this->createNode($child, $_template, &$menu);
				}
				// выводим детей с подчиненными
				elseif( $type == 1 )
				{
					if( $count_childs > 0 )
					{
						$menu .= $this->createNode($child, $_template, &$menu);
					}
				}
				// выводим детей без подчиненных
				elseif( $type == 2 || $type == 3 )
				{
					if( $count_childs < 1 )
					{
						$i++;
						if ($i >= $this->item_begin && $i <= $this->item_end)
						{
							global $catalog_child_count;
							$catalog_child_count = count($childs);
							if ($child['is_active'] == 2)
							{
								$menu .= $this->createNode($child, $_catalog_child_menu_without_childs_archive, &$menu);
							}
							else
							{
								$menu .= $this->createNode($child, $_template, &$menu);
							}
							
						}
					}
				}

				if( isset($this->parse_delimeter[ $count ] ))
				{
					$menu .= $this->std->parse_delimeter[ $count ];
				}
				$count++;

				// new change
				$menu = str_replace('{COUNTCHILDS}', $count_childs, $menu);
			}
		}

		if( is_array($_template['begin']) )
		{
			$delimeter = $_template['delimiter'][1];
			$begin     = $_template['begin'][1];
			$end       = $_template['end'][1];
		}
		else
		{
			$delimeter = $_template['delimiter'];
			$begin     = $_template['begin'];
			$end       = $_template['end'];
		}

		$delimeter = $this->std->CleanPCRE( $delimeter);
		$replace = "#{$delimeter}$#is";
		$menu = $begin.preg_replace( $replace, "",  $menu).$end;
		$menu = $this->std->UnCleanPCRE($menu);
		$this->std->parse_delimeter = array();
		return  $menu;
	}




	/*********************************************************************
	 функция формирования пункта меню, учитывает оформление
	 **********************************************************************/
	function createNode($child, $_template, $d = 1, $delim_on= 1)
	{
		global $uri, $alias;        // URL как есть
		$node = '';

		if( $_template['inactive'][ $d ] and $d > 0 and is_array($_template['inactive']) )
		{
			$temp_now       = $_template['now'][ $d ];
			$temp_active    = $_template['active'][ $d ];
			$temp_inactive  = $_template['inactive'][ $d ];
			$temp_delimiter = $_template['delimiter'][ $d ];
		}
		else
		{
			$temp_now       = @$_template['now'];
			$temp_active    = @$_template['active'];
			$temp_inactive  = @$_template['inactive'];
			$temp_delimiter = @$_template['delimiter'];
			$temp_timeformat = @$_template['time'];
		}

		// создаем формат времени
		$time_now       = $this->std->get_date_format($temp_now);
		$time_active    = $this->std->get_date_format($temp_active);
		$time_inactive  = $this->std->get_date_format($temp_inactive);


		// делаем при необходимости замену, это нужно для того что главная ссылка всегла ссылалась на хост, бед добавок в виде /index/
		if (($child['alias'] == '/index/'))
		{
			$child['alias'] = '/';
		}

		// фиксим что бы не учитывалась постраничная нафигация на урл

		if( $alias[0] == 'news' or $alias[0] == 'gallery' or $alias[0] == 'catalog')
		{
			$tmp_uri = preg_replace("#page\d+/$#is", "", $uri);
		}
		else
		{
			$tmp_uri = $uri;
		}

		# формируем адрес в зависимости от того, категория ли сейчас или каталог
		$path_str = "";
		if ($this->cur_cat >= 0 && ($this->IdCurPage < 0 || $this->IdCurPage == "root"))
		{
			$path = $this->getChildPath($child['pid']);
			if ($path)
			{
				for ($i=count($path)-1; $i >=0; $i--)
				$path_str .= $path[$i]."/";
			}
		}
		if ($alias[0] == '')
		{
			$path_str = 'catalog/';
		}
		
		$tmp_uri = "http://".$_SERVER['HTTP_HOST'].$tmp_uri.$path_str; // формируем абсолютный адрес

		if((isset($this->father['alias']) && $child['alias'] == $this->father['alias']) or (isset($this->father['alias']) && $child['alias'] == "/".$this->father['alias']."/"))
		{
			$node        .= str_replace('{TITLE}', $this->std->clean_value($this->father['title']), str_replace('{ALIAS}', $tmp_uri.$this->father['alias']."/",$temp_now));  // данный пункт меню сейчас выбран, делаем его ненажимаемым
			$temp_timeformat = $time_now;
		}
		elseif (($child['alias'] == $tmp_uri) || (($child['alias'] == '/index/') && ($uri == '/'))) // вторая часть условия делает ссылку на главную чтраницу активной, когда это нужно
		{
			$node        .= str_replace('{TITLE}', $this->std->clean_value($child['title']), str_replace('{ALIAS}', $tmp_uri.$child['alias']."/",$temp_active));  // данный пункт меню сейчас выбран, делаем его ненажимаемым
			$temp_timeformat  = $time_active;
		}
		else
		{
			$node        .= str_replace('{TITLE}', $this->std->clean_value($child['title']), str_replace('{ALIAS}', $tmp_uri.$child['alias']."/",$temp_inactive));  // данный пункт меню сейчас не выбран, делаем его нажимаемым
			$temp_timeformat = $time_inactive;
		}
		
		# для формы отправки в корзину
		$node = str_replace("{good_id}", $child['id'], $node);

		// ссылку на картинку формируем тут
		
		if (file_exists("./".FILES_FOLDER."/".$this->module_name."/limg/".$child['id'].".jpg"))
		{
			$type = $child["img"];

			/*----------------------------------------*/
			// картинка - оригинал
			/*----------------------------------------*/
			/*$child["img_big"] = $this->ModuleFilesPath.$child["id"]."_big".$type;        // сама картинка
			list( $child["img_big_width"], $child["img_big_height"] ) = $this->std->getWithHeightImage($child["img_big"]);                // ширина и высота
			$child["file_big_size"] = $this->std->getFileSize($child["img_big"]);*/                // размер файла в Kb

			/*----------------------------------------*/
			// картинка - основная
			/*----------------------------------------*/
			/*$child["img"] = $this->ModuleFilesPath.$child["id"].$type;        // сама картинка
			list( $child["img_width"], $child["img_height"] ) = $this->std->getWithHeightImage($child["img"]);                // ширина и высота
			$child["file_size"] = $this->std->getFileSize($child["img"]);*/                // размер файла в Kb


			/*----------------------------------------*/
			// картинка - аватар
			/*----------------------------------------*/
			$child["img_av"] = "/".FILES_FOLDER."/".$this->module_name."/limg/".$child['id'].".jpg";        // сама картинка
			list( $child["img_av_width"], $child["img_av_height"] ) = $this->std->getWithHeightImage($child["img_av"]);                // ширина и высота
			$child["file_av_size"] = $this->std->getFileSize($child["img_av"]);                // размер файла в Kb
		}
		else
		{
			$type = ".jpg";

			
			// картинка - оригинал
			
			/*$child["img_big"] = "/".FILES_FOLDER."/".$this->module_name."/default".$type;        // сама картинка
			list( $child["img_big_width"], $child["img_big_height"] ) = $this->std->getWithHeightImage($child["img_big"]);                // ширина и высота
			$child["file_big_size"] = $this->std->getFileSize($child["img_big"]);                // размер файла в Kb
			 
			
			// картинка - основная
			
			$child["img"] = "/".FILES_FOLDER."/".$this->module_name."/default".$type;        // сама картинка
			list( $child["img_width"], $child["img_height"] ) = $this->std->getWithHeightImage($child["img"]);                // ширина и высота
			$child["file_size"] = $this->std->getFileSize($child["img"]); */               // размер файла в Kb

			
			// картинка - аватар
			
			$child["img_av"] = "/".FILES_FOLDER."/".$this->module_name."/default".$type;        // сама картинка
			list( $child["img_av_width"], $child["img_av_height"] ) = $this->std->getWithHeightImage($child["img_av"]);                // ширина и высота
			$child["file_av_size"] = $this->std->getFileSize($child["img_av"]);                // размер файла в Kb
		}




		foreach( $child as $k => $v )
		{ 
			$node = str_replace( "{".strtoupper($k)."}", $v, $node);
		}

		if( $child['timestamp'] )
		{
			$out_time = $this->std->get_time($child['timestamp'], $temp_timeformat);
			$node = preg_replace("#\{DOCUMENTDATE\(.+?\)\}#is",$out_time, $node);
		}

		// ID заменяем
		$node = str_replace( "{ID}", $child['id'], $node);

		global $menu_work;
		$menu_work = $child['id'];

		if( $delim_on )
		{
			return $node.$temp_delimiter;
		}
		else
		{
			return $node;
		}
	}

	 
	/**
	 * возвращает массив алиасов родителей - путь
	 *
	 */
	function getChildPath($cid)
	{
		$sql = "SELECT `pid`, `alias` FROM se_catalog WHERE `id` = '".$cid."'";
		$this->std->db->do_query($sql);
		if ($this->std->db->getNumRows() == 0) return 0;

		$row = $this->std->db->fetch_row();
		$temp = $this->getChildPath($row['pid']);
		$path[] = $row['alias'];
		if ($temp) $path = array_merge($path,$temp);

		return $path;
	}

	
	
	

        /**
         * Формирует навигацию по текущей галерее - по картинкам

КУЙМИРУЕТ! говно она формирует, а не навигацию. я пля ее переписывал ТРИЖДЫ, так нет пля - опять приходят тупые программисты, поднимают свой пересраный бекап, и куячат с него очередное говно!

         */
       /* function getNavigator()
        {
         		$res = "";
				$url = "/";
				$return ="";
        		global
					$_gallery_count_adjacent, $NavigatorLinks, $NavigatorImages, $NavigatorPhotoData, $NavigatorBorder;
					
					for ($i=0; $i<count($this->current_url_array)-1; $i++)
					{
						$url .= $this->current_url_array[$i]."/";
					}
 start Вывод предыдущей (левой) картинки 
						$return .= $NavigatorBorder['top']['left'];
								 Почему, нет, ну почему тут сортировка DESC, когда ДОЛЖНА БЫТЬ ASC? Какому гомосексуалисту пришло в голову что вторая картинка идет ПЕРЕД первой?  
						$sql = "SELECT * FROM `se_catalog` where `pid` = '".$this->VarsCurPage['pid']."' AND `id`<'".$this->VarsCurPage['id']."' ORDER BY `id` DESC LIMIT 0, 2";
						$this->std->db->do_query($sql);
						$count = $this->std->db->getNumRows();
						if ($count>0)
						{
								while($row = $this->std->db->fetch_row())
								{
										$result[]=$row;
								}
					
						$search = array('{ALIAS}','{TITLE}','{ID}', '{PRICE}');
						$replace = array ($url.$result['0']['alias'],
											$result['0']['title'],
											$result['0']['id'],
											$result['0']['price']);
						$return .= str_replace($search, $replace, $NavigatorLinks['left']['active']);
						for ($i=(count($result) - 1); $i >= 0; $i--)
						{							
								$img_av_nav = $this->ModuleFilesPath.$result[$i]['id']."_av".$result[$i]['img'];
								$img_nav = $this->ModuleFilesPath.$this->$result[$i]['id']."".$result[$i]['img'];
								list($img_width_av, $img_height_av) = $this->std->getWithHeightImage($img_av_nav);
								list($img_width, $img_height) = $this->std->getWithHeightImage($img_nav);
								$img_size = $this->std->getFileSize($img_nav);
								$img_size_av = $this->std->getFileSize($img_av_nav);
								$price = number_format($result[$i]['price'], 2, ',', ' ');
		
								$search = array('{ALIAS}', 
												'{TITLE}', 
												'{ID}', 
												'{IMG}', 
												'{IMG_AV}', 
												'{IMG_WIDTH}',
												'{IMG_HEIGHT}',
												'{IMG_SIZE}',
												'{IMG_AV_WIDTH}',
												'{IMG_AV_HEIGHT}',
												'{IMG_AV_SIZE}', 
												'{PRICE}');
								$replace = array($url.$result[$i]['alias']."/", 
										$result[$i]['title'],
										$result[$i]['id'],
										$img_nav,
										$img_av_nav,
										$img_width, 
										$img_height,
										$img_size,
										$img_width_av, 
										$img_height_av,
										$img_size_av,
										$price										
										);
										
								$return .= str_replace($search, $replace, $NavigatorImages['left']);
						}
						
						
						}
						else
						{
								$return .= $NavigatorLinks['left']['inactive'];
						}
						$return .= $NavigatorBorder['bottom']['left'];
 end Вывод предыдущей (левой) картинки 

 start Вывод текущей (центральной) картинки 
						$return .= $NavigatorBorder['top']['center'];
						$img_av_nav = $this->ModuleFilesPath.$this->VarsCurPage['id']."_av".$this->VarsCurPage['img'];
						$img_nav = $this->ModuleFilesPath.$this->VarsCurPage['id']."".$this->VarsCurPage['img'];
						list($img_width_av, $img_height_av) = $this->std->getWithHeightImage($img_av_nav);
						list($img_width, $img_height) = $this->std->getWithHeightImage($img_nav);
						$img_size = $this->std->getFileSize($img_nav);
						$img_size_av = $this->std->getFileSize($img_av_nav);
						$price = number_format($result[$i]['price'], 2, ',', ' ');

						$search = array('{ALIAS}', 
										'{TITLE}', 
										'{ID}', 
										'{IMG}', 
										'{IMG_AV}', 
										'{IMG_WIDTH}',
										'{IMG_HEIGHT}',
										'{IMG_SIZE}',
										'{IMG_AV_WIDTH}',
										'{IMG_AV_HEIGHT}',
										'{IMG_AV_SIZE}',
										'{PRICE}');
						$replace = array($url.$this->VarsCurPage['alias']."/", 
										$this->VarsCurPage['title'],
										$this->VarsCurPage['id'],
										$img_nav,
										$img_av_nav,
										$img_width, 
										$img_height,
										$img_size,
										$img_width_av, 
										$img_height_av,
										$img_size_av,
										$price										
										);
						
						$return .= str_replace($search, $replace, $NavigatorPhotoData);
						$return .= $NavigatorBorder['bottom']['center'];
 end Вывод текущей (центральной) картинки 

 start Вывод следующей (правой) картинки 
						unset ($result); // эту куйню я тож не понимаю пля
						$return .= $NavigatorBorder['top']['right'];
						$sql = "SELECT * FROM `se_catalog` where `pid` = '".$this->VarsCurPage['pid']."' AND `id`>'".$this->VarsCurPage['id']."'  ORDER BY `id` ASC LIMIT 0, 2";
						$this->std->db->do_query($sql);
						$count = $this->std->db->getNumRows();
						if ($count > 0)
						{
								while($row = $this->std->db->fetch_row())
								{
										$result[]=$row;
								}
						
								if (!isset($this->StructureModule_pid[$result[0]['id']]))
								{
										$return .= $NavigatorLinks['right']['active'];
								}
								else
								{
										$return .= $NavigatorLinks['right']['inactive'];
								}
								for ($i=0; $i<count($result); $i++)
								{
										if (!isset($this->StructureModule_pid[$result[$i]['id']]))
										{

												//$return .= "<a href=\"".$url.$result[$i]['alias']."/\"><img src=\"/files/gallery/".$result[$i]['id']."_av".$result[$i]['img']."\"></a><br /><br />";
												$img_av_nav = $this->ModuleFilesPath.$result[$i]['id']."_av".$result[$i]['img'];
												$img_nav = $this->ModuleFilesPath.$this->$result[$i]['id']."".$result[$i]['img'];
												list($img_width_av, $img_height_av) = $this->std->getWithHeightImage($img_av_nav);
												list($img_width, $img_height) = $this->std->getWithHeightImage($img_nav);
												$img_size = $this->std->getFileSize($img_nav);
												$img_size_av = $this->std->getFileSize($img_av_nav);
												number_format($result[$i]['price'], 2, ',', ' ');

												$search = array('{ALIAS}', 
																'{TITLE}', 
																'{ID}', 
																'{IMG}', 
																'{IMG_AV}', 
																'{IMG_WIDTH}',
																'{IMG_HEIGHT}',
																'{IMG_SIZE}',
																'{IMG_AV_WIDTH}',
																'{IMG_AV_HEIGHT}',
																'{IMG_AV_SIZE}',
																'{PRICE}');
												$replace = array($url.$result[$i]['alias']."/", 
																$result[$i]['title'],
																$result[$i]['id'],
																$img_nav,
																$img_av_nav,
																$img_width, 
																$img_height,
																$img_size,
																$img_width_av, 
																$img_height_av,
																$img_size_av,
																$price										
																);
																
															$return .= str_replace($search, $replace, $NavigatorImages['right']);
										}
							
								}
						
						}
						else
						{
								$return .= $NavigatorLinks['right']['inactive'];
						}
						$return .= $NavigatorBorder['bottom']['right'];
 end Вывод предыдущей (левой) картинки 
	
					///////////////////////////////////////////////////////////
                return $return;
  
        }*/

}


?>