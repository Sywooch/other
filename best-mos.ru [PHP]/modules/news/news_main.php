<?php
#
#        Объект - работа с новостями
#
#  Programmer       : Kormishin Vladimir
#
#
#        Вызов
#        /news/all/2006/11/14/new23/
#        /news/13/2006/11/14/new23/
#        /news/page3/
#        /news/13/page3/

#        0 - имя модуля
#        1 - все категории или какая-то конкретно категория или номер страницы навигации
#        2 - год написания новости или  номер страницы навигации
#        3 - месяц
#        4 - число месяца
#        5 - alias новости




/*
 доделать:
 функцию вывода новостей, в ней 3 ключевых момента:
 1 вывод новостей в соответствии с запросом (учитывающим год, дату, категорию) (запросы готовы, вырабатываются в init_vars и generate_actions)
 2 вывод в соответствии со страницей (например page2)
 3 вывод навигации новостей
 +
 4 вывод интерфейса (+вмонтировать в шаблон переменные года, даты, категории(сделано, доделать категории + дата/год))
 5 сделать инсталл-файл

 */

class main_news extends AbstractClass{

	var $start_page     = 1;        // страница, которую выводим (её номер)

	
	var $page = 1;
	var $year			= '';
	var $month			= '';
	var $day			= '';
	var $category		= '';
	var $where_time		= '';
	var $where_time_cat	= '';
	var $sql_category	= '';
	var $alias_current	= '';
	var $output = '';
	var $sql = ''; // массив sql запроса. array("where" => '...', "limit" => '...'). Формируется в функции generate_actions()
	var $items_count; // количество всех выводимых новостей (согласно фильтру, во всех страницах)

	function NewsClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        )
	{

		$this->std->settings['news_count_on_main_page'] = intval($this->std->settings['news_count_on_main_page']) < 0 ? 5 : intval($this->std->settings['news_count_on_main_page']);

		$this->AbstractClass(
		$sub_alias,   	// путь разложенный в массив
                                                           'news',    		// название таблицы с которой будем работать
                                                           'news'        	// название модуля (то как модуль называется в таблице modules)
		);


		// проверка, нужно ли запускать инициализацию переменных
		// ПРОВЕРЯЕМ вызывется ли имеено данный модуль

		global
		$template,						// имя используемого шаблона
		$title,							// заголовок
		$h1,							// главная надпись
		$body,							// тело новости
		$last_news,						// список последних новостей
		$news,
		$arrows_news,					// нумерация
		$keywords,
		$description,
		$tpl,
		$news_categories_menu,
		$news_years_menu,
		$body, // текст статичной новостной страницы
		$modules_list;
	

		if ((count($this->std->alias[0]) != 0) && ($this->std->alias[0] != 'news'))
		{
			return ;
		}
		
		
		
		if (isset($this->current_url_array[0]) && $this->current_url_array[0] == $this->module_name) $this->tpl = 'main';
		else $this->tpl = 'last';

		
				
		if ($this->tpl == 'main')
		{
			$this->std->db->do_query( "SELECT * FROM se_static WHERE alias='news' AND pid=-1 ORDER BY id DESC LIMIT 0, 1" );
			$row = $this->std->db->fetch_row();

			// выводим keywords и если таковые присутвуют
			$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
			$description = $this->std->build_meta_tags( $row['description'], 'description');


			$title   = $row['title'] ? $row['title'] : 'Новости';
			$h1      = $row['h1'] ? $row['h1'] : 'Новости';
			$body = $row['body'];
		}

		$this->init_vars();
		$this->generate_actions();

		/*if ($this->std->settings['news_gen_calendar'])
		{
			global $news_calendar;
			$news_calendar = $this->GetCalendar();
		}*/

		global $arrows_news;
			
		$prepage = '';
		if (is_array($this->current_url_array))
		foreach ($this->current_url_array as $t)
		{
			if (!preg_match("/page\d+/",$t)) $prepage .= $t."/";
		}
			

		$arrows_news = $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $this->items_count,
		                                                             'PER_PAGE'    => $this->std->settings['news_count_on_main_page'],
		                                                             'CUR_ST_VAL'  => $this->page,
		                                                             'L_SINGLE'    => "",
		                                                             'L_MULTI'     => "Страницы: ",
		                                                             'BASE_URL'    => "/".$prepage,
		                                                             'leave_out'   => $this->std->settings['news_count_near_select_page'],
		) );
		 
		global $news_last;
		$news_last = $this->output;
		

		if ($this->std->settings['news_gen_cat'])
		{
			# формируем меню категорий
			//$news_categories_menu = $this->getCatsMenu();
		}

		# формируем меню годов
		//$news_years_menu = $this->getYearsMenu();
		
		
		# для главной
		if (count($this->std->alias) == 0)
		{
			global $news_last_onmain;
			$this->std->settings['news_on_non_news_page'] = intval( $this->std->settings['news_on_non_news_page'] ) < 0 ? 3 : intval($this->std->settings['news_on_non_news_page']);
			$news_last_onmain = $this->getLastNews($this->std->settings['news_on_non_news_page'], 'last');  // вывод списка новостей на неновостную страницу
		}
		
	}

	/**
	 * возвращает html текст меню категорий
	 *
	 */
	function getCatsMenu( )
	{
		global $_news_categories_menu;

		$sql = "SELECT * FROM ".TABLE_NEWS_CATEGORIES." ORDER BY `item_order`";
		$this->std->db->do_query($sql);

		$rtn = $_news_categories_menu['begin'];

		$prepage = '';
		if (is_array($this->current_url_array))
		foreach ($this->current_url_array as $t)
		{
			if (!preg_match("/page\d+/",$t) && !preg_match("/cat\d+/",$t) && $t!=$this->module_name) $prepage .= $t."/";
		}
			
		$href = "/".$this->module_name."/".$prepage;
		if (!$this->category)
		$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $_news_categories_menu['allcats'] ), $_news_categories_menu['active']);
		else
		$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $_news_categories_menu['allcats'] ), $_news_categories_menu['inactive']);
			
		while ($row = $this->std->db->fetch_row())
		{
			$href = "/".$this->module_name."/".$prepage."cat".$row['id'];
			if ($this->category == $row['id'])
			{
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $row['title'] ), $_news_categories_menu['active']);
			} else {
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $row['title'] ), $_news_categories_menu['inactive']);
			}
			$rtn .= $_news_categories_menu['delimiter'];
		}
		$rtn .= $_news_categories_menu['end'];

		return $rtn;
	}

	/**
	 * возвращает html текст меню категорий
	 *
	 */
	function getYearsMenu( )
	{
		global $_news_years_menu;

		$sql = "SELECT * FROM se_news WHERE `is_active`=1 order by `timestamp` desc";
		$this->std->db->do_query($sql);

		$rtn = $_news_years_menu['begin'];

		$cat = $this->category ? "cat".$this->category."/" : "";

		# если год выбран - все года активно
		if ($this->year)
		{
			$temp = $_news_years_menu['inactive'];
			$temp = str_replace('{YEAR}',$_news_years_menu['allyears'],$temp);
			$temp = str_replace('{ALIAS}', "/".$this->module_name."/".$cat,$temp);
			$rtn .= $temp;
		}
		# если год не выбран - все года неактивно
		else
		{
			$temp = $_news_years_menu['active'];
			$temp = str_replace('{YEAR}',$_news_years_menu['allyears'],$temp);
			$temp = str_replace('{ALIAS}', "/".$this->module_name."/".$cat,$temp);
			$rtn .= $temp;
		}


		$mas = array();
		while ($row = $this->std->db->fetch_row())
		{
			$y = date("Y", $row['timestamp']);
			if (!in_array($y, $mas))
			{
				$mas[] = $y;
					
				$cat = $this->category ? "cat".$this->category."/" : "";
				$href = "/".$this->module_name."/".$y."/".$cat;
				if ($this->year == $y)
				{
					$rtn .= str_replace(array( '{ALIAS}','{YEAR}'), array( $href, $y ), $_news_years_menu['active']);
				} else {
					$rtn .= str_replace(array( '{ALIAS}','{YEAR}'), array( $href, $y ), $_news_years_menu['inactive']);
				}
				$rtn .= $_news_years_menu['delimiter'];
			}
		}
		$rtn .= $_news_years_menu['end'];

		return $rtn;
	}

	/**
	 * возращает календарь
	 *
	 */
	function GetCalendar()
	{
		$ret = '';

		global $news_calendar_css;
		$t_path = substr(TEMPLATES_PATH,1);

		$ret .= '
<div id="calendar-container" style="float: right; margin-left: 1em; margin-bottom: 1em;" >

<style type="text/css">@import url('.$t_path.'/calendar/calendar.css);</style>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar.js"></script>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar-en.js"></script>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar-setup.js"></script>

<script type="text/javascript">
';

		$sql = "SELECT * FROM se_news WHERE `is_active`=1";
		$this->std->db->do_query($sql);
		$days = array();
		while ($row = $this->std->db->fetch_row())
		{
			$y = date("Y",$row['timestamp']);
			$m = intval(date("n",$row['timestamp']))-1;
			$days[$y][$m][] = date("j",$row['timestamp']);
		}

		$months2 = array();

		foreach ($days as $year => $months)
		{
			$ret .= '
  var NEWS_CAL_MONTHS_'.$year.' = 
  {
';
			foreach ($months as $month => $ds)
			{
				if (is_array($ds))
				{
					$str = implode(", ", $ds);
						
					$ret .= '
	    '.$month.' : [ '.$str.' ],';
				}
					
			}
				
			$ret = substr($ret,0,strlen($ret)-1);

			$ret .= '
  };
  					';		

		}

		$ret .= '
  var NEWS_CAL_YEARS = 
  {
  		';

		foreach ($days as $year => $months)
		{
			$ret .= '
			'.$year.' : [NEWS_CAL_MONTHS_'.$year.'],';
		}

		$ret = substr($ret,0,strlen($ret)-1);
			
		$time = time();
		$dt = ($this->year && $this->month && $this->day)? $this->year.','.($this->month-1).','.$this->day : '';//date("Y", $time).','.(date("n", $time)-1).','.date("j", $time);

		$cat = $this->category ? "cat".$this->category."/" : "";

		$ret .= '
  };
  
  function dateIsSpecial(year, month, day) 
  {
	var y = NEWS_CAL_YEARS[year];
    if (!y) return false;
    var m = y[0][month];
    if (!m) return false;
    for (var i in m) if (m[i] == day) return true;
    return false;
  };

  function dateChanged(calendar) 
  {
     if (calendar.dateClicked) 
     {
      var y = calendar.date.getFullYear();
      var m = calendar.date.getMonth();     // integer, 0..11
      var d = calendar.date.getDate();      // integer, 1..31
      if (dateIsSpecial(y,m,d))
      {
      	  m++;
	      window.location = "/news/" + y + "/" + ((m < 10)? "0" : "") + m + "/" + ((d < 10)? "0" : "") + d + "/'.$cat.'";
      }
    }
  };

  function ourDateStatusFunc(date, y, m, d) 
  {
    if (dateIsSpecial(y, m, d))
    {
      	return false;
    }
    else
    {
    	return true;
    }
  };
  
  var dt = new Date('.$dt.');

  Calendar.setup(
    {
      flat		: "calendar-container", 	// ID of the parent element
      flatCallback	: dateChanged,          	// our callback function
      dateStatusFunc	: ourDateStatusFunc,
      date		: dt
    }
  );
</script>

</div>
        				';

		return $ret;
	}





	/**
	 * генерируем список новостей
	 *
	 *
	 * @param string $tpl        - темплейт
	 * @return unknown           - возвращает готовую строку, список новостей
	 */





	#
	#	Блок 1
	#

	function init_vars()
	{

		$ispage = 0;
		$i=1;
		while ($i<=count($this->current_url_array))
		{
				
			# если часть урл'а состоит из 2х или 4х цифр, категория и страница ещё не определены - принимаем её за год
			if (((isset($this->current_url_array[$i]) && strlen($this->current_url_array[$i])==2) or(isset($this->current_url_array[$i]) && strlen($this->current_url_array[$i])==4)) and is_numeric($this->current_url_array[$i]) and(empty($this->yearpage)) and(empty($this->yearcategory)) and(empty($this->year)))
			{
				$this->year = $this->current_url_array[$i];
			}




			# если  часть урл'а содержит "page" , после "page" стоит цифра - она является страницей
			if (@preg_match("/\bpage/i",$this->current_url_array[$i]))
			{
					
				$page_url_is_num = is_numeric(substr ($this->current_url_array[$i],4));
				if ($page_url_is_num)
				{
					$this->page = substr ($this->current_url_array[$i],4);
					$ispage = 1;
				}

			}
				
			# если $page ещё не определена, часть урл'а содержит "cat" и после "cat" стоит цифра - она является страницей
			if (@preg_match("/\bcat/i",$this->current_url_array[$i]) and(!$ispage))
			{

				$category_url = is_numeric(substr ($this->current_url_array[$i],3));
				if ($category_url)
				{
					$this->category = intval(substr ($this->current_url_array[$i],3));
				}

			}

			$i++;
		}

		if (isset($this->year) and (@strlen($this->current_url_array[2])==2) and @is_string($this->current_url_array[2]))
		{
			$this->month = $this->current_url_array[2];
		}


		if ($this->month and (strlen($this->current_url_array[3])==2) and is_string($this->current_url_array[3]))
		{
			$this->day = $this->current_url_array[3];
		}


		 



		if ($this->year and  $this->month and $this->day and !$this->category and !$ispage)
		{
			$template                 = 'news_current';
			$this->alias_current 	= $this->current_url_array[4];

		}

		 



	}

	function generate_actions()
	{
		global $template;
		$wheres = array();
			
		if 	($this->category)
		{
			$sql = "SELECT * FROM se_news_relations_cats WHERE `id_cats` = '".$this->category."'";
			$this->std->db->do_query($sql);
			$ids = array();
			while ($row = $this->std->db->fetch_row())
			{
				$ids[] = $row['id_news'];
			}
			if (count($ids) > 0)
			{
				$wheres[] = "(`id` = ".implode(" or `id` = ", $ids).")";
			} else $wheres[] = "0";
		}
		if ($this->year)
		{
			if ($this->month && $this->day)
			{
				if ($this->alias_current)
				{
					// вывод определенной новости
					$template = 'news_current';
					$this->output = $this->getCurentNews();
					return;
				} else {
					// вывод новостей этого дня
					$time1 = mktime(0,0,0,$this->month,$this->day,$this->year);
					$time2 = mktime(23,59,59,$this->month,$this->day,$this->year);
					$wheres[] = "(`timestamp` >= ".$time1." AND `timestamp` <= ".$time2.")";
				}
			} else {
				// вывод новостей этого года
				$time1 = mktime(1,1,1,1,1,$this->year);				
				$time2 = mktime(23,59,59,12,31,$this->year);
				$wheres[] = "(`timestamp` >= ".$time1." AND `timestamp` <= ".$time2.")";
			}
		} else {
			// вывод всех новостей
			// wheres не заполняем просто
		}
			
		# обрабатываем страницу
		$sql_limit = "limit ".(($this->page - 1) * $this->std->settings['news_count_on_main_page']).", ".$this->std->settings['news_count_on_main_page'];
			
		$sql = implode(" AND ", $wheres);
			
		$this->sql = array("where" => ($sql != "")? "WHERE ".$sql : "", "limit" => $sql_limit);

		$this->output = $this->generate_news();
	}
	 
	 
	 
	function generate_news()
	{
		$output = '';
		$this->current_url_array = array();

		foreach( explode( '/', $this->current_url) as $_url_array => $url_data )
		{
			if( $url_data != '' )
			{
				$this->current_url_array[] = $url_data;
			}
		}

		if (isset($this->current_url_array[0]) && $this->current_url_array[0] == $this->module_name)
		{

			if ($this->sql['where'])
			{
				$this->sql['where'].=" AND `is_active`=1";
			}
			else
			{
				$this->sql['where'].="WHERE `is_active`=1";
			}

			$sql = "SELECT COUNT(*) as cnt FROM se_news ".$this->sql['where'];

			$this->std->db->do_query($sql);
			$row = $this->std->db->fetch_row();
			$this->items_count = $row['cnt'];

			$sql = "SELECT * FROM se_news ".$this->sql['where']." ORDER BY `timestamp` DESC ".$this->sql['limit'];
			//$this->std->db->do_query($sql);

			global $_news;

			$this->std->db->query($sql,$rows2);

			$items = array();
			foreach ($rows2 as $row2)
			{
				$items[] = $this->GetNewsItem($row2);
			}

		}

		if (count($items) > 0)
		{
			return $_news[$this->tpl]['begin'].implode($_news[$this->tpl]['separator'], $items).$_news[$this->tpl]['end'];
		} else return '';
	}

	function GetNewsItem($row, $tpl = '')
	/**
	 * $row - new info from db
	 */
	{
		global
		$template,
		$_news,
		$category,
		$_news_categories_current,                   // шаблон списка новостей
		$date_format,
		$_news_time;
		$body = '';

		if ($tpl == '') $tpl = $this->tpl;
		$templ = $_news[ $tpl ];

		$news_date = $this->std->get_time($row['timestamp'], $date_format);

		$news_href = "/news/".date('Y',$row['timestamp']).'/'.date('m',$row['timestamp']).'/'.date('d',$row['timestamp']).'/'.$row['alias']."/";
		
		$pms = array();
		$pms["{DATE}"] = $news_date;
		$pms["{ALIAS}"] = $news_href;
		$pms["{TITLE}"] = $row['title'];
		$pms["{SBODY}"] = $row['sbody'];
		$pms["{BODY}"] = $row['body'];
		$pms["{AUTHOR}"] = $row['author'];
		
		//$tempstr = str_replace("{DATE}",$news_date, $templ);
		//$tempstr=str_replace('{ALIAS}',$news_href, $tempstr);
		//$tempstr=str_replace('{TITLE}',$row['title'], $tempstr);
		//$tempstr=str_replace('{SBODY}',$row['sbody'], $tempstr);
		//$tempstr=str_replace('{BODY}',$row['body'], $tempstr);
		//$tempstr=str_replace('{AUTHOR}',$row['author'], $tempstr);




		 
		$category = '';
		# если включены категории - выводим их

		if ($this->std->settings["news_gen_cat"])
		{
			 
			$sql = "SELECT `id_cats` FROM `se_news_relations_cats` WHERE `id_news`='".$row['id']."'";

			$ion = 0;


			//$result	=	$this->std->db->do_query($sql);

			$this->std->db->query($sql, $rows);
			foreach ($rows as $row3)
			{
					
				$cat_id	=	$row3['id_cats'];
				$sql = "SELECT `title`,`id` FROM `se_news_cats` WHERE `id`='".$cat_id."' AND is_active=1";
				$result2	=	$this->std->db->do_query($sql);
				$title	=	mysql_fetch_array($result2);
				if ($ion!=0)
				{
					$category .= $_news_categories_current['delimiter'];
				}
				$alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cat_id.'/';
				$category .= str_replace('{TITLE}', $title[0], $_news_categories_current['title']);
				$category = str_replace('{ALIAS}', $alias_cat, $category);
				$ion++;
			}
			/*
			 while ($cat=mysql_fetch_array($result))
			 {
			 $cat_id	=	$cat[0];
			 $sql = "SELECT `title`,`id` FROM `se_news_cats` WHERE `id`='".$cat_id."' AND is_active=1";
			 $result2	=	$this->std->db->do_query($sql);
			 $title	=	mysql_fetch_array($result2);
			 if ($ion!=0)
			 {
			 $category .= $_news_categories_current['delimiter'];
			 }
			 $alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cat_id.'/';
			 $category .= str_replace('{TITLE}', $title[0], $_news_categories_current['title']);
			 $category = str_replace('{ALIAS}', $alias_cat, $category);
			 $ion++;
			 }
			 */
			 
		}


		$pms["{CAT}"] = $category;
		//$tempstr=str_replace('{CAT}',$category, $tempstr);

		# -----------------------------------------------------------------------
		# вывод картинок
		# -----------------------------------------------------------------------
		global $_news_image;
		if ($row['img'] != "")
		{
			$img_av = "/".FILES_FOLDER."/".$this->module_name."/".$row['id']."_av".$row['img'];	// сама картинка
			list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);		// ширина и высота
			$img_av_size = $this->std->getFileSize($img_av);		// размер файла в Kb
			
			$img_temp = $_news_image;
		}
		else
		{
			$img_av 			= "/".FILES_FOLDER."/".$this->module_name."/default.jpg";
			$img_av_width		= 0;
			$img_av_height		= 0;
			$img_av_size		= 0;
			
			$img_temp = '';
		}

		// что ищем в шаблонах
		$search = array("{IMG_AV}","{IMG_AV_WIDTH}","{IMG_AV_HEIGHT}","{IMG_AV_SIZE}");
		// на что будем заменять
		$replace = array($img_av, $img_av_width, $img_av_height, $img_av_size);
		// замена
		$img = str_replace($search, $replace, $img_temp);
		
		$pms["{NEWS_IMAGE}"] = $img;
//		$tempstr = str_replace("{NEWS_IMAGE}", $img, $tempstr);

		return strtr($templ['item'], $pms);
	}


	/**
	 * формируем список новостей для  новостной страницы
	 *
	 *
	 * @param unknown_type $news_limit        - количество выводимых новостей на одну страницу
	 * @return unknown                        - возвращает готовую строку, список новостей
	 */

	function getLastNews($news_limit, $tpl)
	{
		global
		$template,
		$_news,                   // шаблон списка новостей
		$_news_delimiter,
		$_news_time;
		$body = '';

		if ($tpl == '') $tpl = $this->tpl;
		$this->std->settings['news_delimiter'] = $_news_delimiter[ $tpl ];

		$templ = $_news[ $tpl ];

		// если не запрашивается конкретная новость
		if (!isset($this->current_url_array[4]) || 1)
		{

			if (@preg_match("/page\d+/",$this->current_url_array[1]))
			{
				if ($this->current_url_array[0] == $this->module_name)
				{
					$this->start_page = preg_replace( "#page(\d+)#is", "\\1", $this->current_url_array[1] );
					if($this->std->settings['global_revert_navigation'])
					{
						$this->start_page = intval($this->start_page);
					}
					else
					$this->start_page = ($this->start_page-1)*$this->std->settings['news_count_on_main_page']; ;
				}
				else
				{
					$this->start_page = 0;
				}
			}


			if($this->std->settings['global_revert_navigation'])
			{
				$this->max_flag   = (!$this->start_page) ? 1 : 0;
			}

			// если просматриваются новости без указания страницы, то по умолчанию ставим максимально возможную
			$this->start_page = ($this->start_page < 0) ? 0 : $this->start_page;

			if( $tpl != 'main' )
			{
				$this->start_page = 0;
			}

			if($this->std->settings['global_revert_navigation'] and $tpl == 'main')
			{

				$sql         = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1";

				$this->std->db->do_query($sql);
				$news_count_array = $this->std->db->fetch_row();

				$pages = ceil($news_count_array['count']/$this->std->settings['news_count_on_main_page']);


				for( $i = $pages; $i > 0; $i-- )
				{
					$pages_array[] = $i;
				}

				$this->start_page = ($this->start_page) ? $this->start_page : $pages;

				$this->start_page = $pages_array[ $this->start_page-1 ] - 1;
				$this->start_page = ($this->start_page < 0) ? 0 : $this->start_page;
				$this->start_page = $this->start_page*$this->std->settings['news_count_on_main_page'];

			}

			# формирование кусочка sql запроса, ограничевающего выводимые новости
			# необходимо для навигации: много новостей выводить на нескольких страницах
			$limit_sql = " LIMIT ".$this->start_page.", ".$news_limit;

			// запрос определённого количества новостей начиная с определённого номера
			$sql = "SELECT * FROM ".$this->db_table." WHERE is_active=1 ORDER BY `timestamp` DESC $limit_sql";

			if ($this->current_url_array[0] == 'news')
			{

					#2008 если в алиасе присутствует год - запрос к БД новостей этого года
					if ( @is_numeric($this->current_url_array[1]) )
					{
						$sql = "SELECT * FROM ".$this->db_table." WHERE timestamp > ".mktime(0, 0, 0, 1, 1, $this->current_url_array[1])." AND timestamp < ".mktime(0, 0, 0, 12, 32, $this->current_url_array[1])." ORDER BY `timestamp` DESC $limit_sql";
					}
		
					$items = array();
					$this->std->db->query($sql,$rows);
					foreach ($rows as $row)
					{
						# -----------------------------------------------------------------------
						# вывод данных новости из результата запроса к БД
						# -----------------------------------------------------------------------
						$items[] = $this->GetNewsItem($row,$tpl);
					}
					if (count($items) > 0)
					{
							$body = $templ['begin'].implode($templ['separator'], $items).$templ['end'];
					}
			}
			else
			{
					# вывод последних новостей
					$items = array();
					$this->std->db->query($sql,$rows);
					foreach ($rows as $row)
					{
						# -----------------------------------------------------------------------
						# вывод данных новости из результата запроса к БД
						# -----------------------------------------------------------------------
						$items[] = $this->GetNewsItem($row,$tpl);
					}
					if (count($items) > 0)
					{
							$body = $templ['begin'].implode($templ['separator'], $items).$templ['end'];
					}
			}
			
			
			//echo $body; exit;
			if(!$body)
			{
				$this->ModulError( "getLastNews-> таблица новостей пуста sql: $sql");
			}
		}

		return $body;
	}



	/**
	 * нумерация новостей в обратном порядке
	 *
	 *
	 * @param unknown_type $news_limit                - количество выводимых новостей на одну страницу
	 * @param unknown_type $arrows_limit        - сколько номерков страниц выводить слева и справа от текущего номера
	 *                                                                                   (это чтобы не показывать весь ряд имеющихся номеров страниц, а из могут быть десятки)
	 * @return unknown                                                 - возвращает готовую строку нумерации страниц
	 */
	function getNewsArrows($news_limit /*количество новостей выводимых на страницу*/, $arrows_limit /*количество номерков в строке нумерации*/)
	{
		global
		$host,
		$_news_page_active,        // указатель на страницу новостей, активный
		$_news_page_unactive,      // указатель на страницу новостей, не активный
		$template;                 // глобальна переменная темплейта, для вывода ошибочной страницы

		$arrows_news        = '';
		$sql         = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1";
		#2008 если введен год в алиасе - считаем число новостей определенного года
		if ( is_numeric($this->current_url_array[1]) )
		{
			$sql = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1 AND timestamp > ".mktime(0, 0, 0, 1, 1, $this->current_url_array[1])." AND timestamp < ".mktime(0, 0, 0, 12, 32, $this->current_url_array[1])."";
		}
		$this->std->db->do_query($sql);

		$page_count = 0;
		// количество новостей в базе
		$news_count_array = $this->std->db->fetch_row();
		$news_count = $news_count_array['count'];
		if ($news_count == 0)
		{
			$this->ModulError( "getNewsArrows-> таблица новостей пуста sql: $sql");
		}

		// фиксим ошибочную страницу для навигации
		$total_pages = ceil($news_count/$this->std->settings['news_count_on_main_page']);

		if (preg_match("/page\d+/",$this->current_url_array[1]))
		{
			if ($this->current_url_array[0] == $this->module_name)
			{
				$this_page = preg_replace( "#page(\d+)#is", "\\1", $this->current_url_array[1] );
			}
			else
			{
				$this_page = 1;
			}
		}

		if( $this_page == 0 and isset($this_page))
		{
			$template = 'static';
			global $body, $h1, $title;
			$body = $this->std->settings["site_error"];
			$h1 = $title = 'Ошибка 404';
			return;
		}

		if( $total_pages < $this_page )
		{
			$template = 'static';
			$body = $this->std->settings["site_error"];
			$h1 = $title = 'Ошибка 404';
			return;
		}

		if( $total_pages == $this_page and $this->std->settings['global_revert_navigation'])
		{
			$template = 'static';
			$body = $this->std->settings["site_error"];
			$h1 = $title = 'Ошибка 404';
			return;
		}

		if( $this_page == 1 and !$this->std->settings['global_revert_navigation'] )
		{
			$template = 'static';
			$body = $this->std->settings["site_error"];
			$h1 = $title = 'Ошибка 404';
			return;
		}

		if( !$this_page and $this->std->settings['global_revert_navigation'] )
		{
			$this_page = $total_pages;
			$this_page = ($this_page-1)*$this->std->settings['news_count_on_main_page'];
		}
		else
		{
			$this_page = $this->start_page;
		}


		#2008 если после news стоит цифра (год) - делаем ссылки с годом вида /news/год/page
		$year_base_url = '';
		if ( is_numeric($this->current_url_array[1]) )
		{
			$year_base_url = '/'.$this->current_url_array[1];
		}


		return $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $news_count,
                                                             'PER_PAGE'    => $news_limit,
                                                             'CUR_ST_VAL'  => ceil(($this_page+$this->std->settings['news_count_on_main_page'])/
		$this->std->settings['news_count_on_main_page']),
                                                             'L_SINGLE'    => "",
                                                             'L_MULTI'     => "Страницы: ",
                                                             'BASE_URL'    => "/news$year_base_url",
                                                             'leave_out'   => $arrows_limit,
		) );

	}


	// выдача определённой новости
	function getCurentNews()
	{
		global
		$template,
		$_month_rp,                           // список месяцев в родительном падеже
		$date,                                // дата создания новости
		$body,                                // тело новости
		$title,                               // название новости
		$alias,                               // алиас
		$h1,                                  // большая надпись
		$sbody,                               // анонс
		$author,                              // автор
		$keywords,                            // keywords
		$description,                         // description
		$_news_time,                          // временной формат
		$_news_img,
		$img,
		$_news_cat,
		$_news_cat_delimeter,
		$category,
		$_news_categories_current,
		$_date_format_cur,
		$date;



		# получаем определённую новость из базы
		$sql = "SELECT * FROM ".$this->db_table." WHERE alias='".$this->current_url_array[4]."'  AND is_active=1";

		if ($this->std->db->query($sql, $rows) > 0)
		{
			foreach ($rows as $row)
			{
				$body	= $row['body'];
				$sbody	= $row['sbody'];
				$h1	= $row['title'];
				$title	= $row['title'];
				$date = $this->std->get_time($row['timestamp'], $_date_format_cur['main']) ;
				//$month = date('m',$row['timestamp']);
				//$month = intval($month);
				// выводим keywords и если таковые присутвуют
				if(!$keywords)
				$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
				if(!$description)
				$description = $this->std->build_meta_tags( $row['description'], 'description');

				$alias  = $row['alias'];
				$author = $row['author'];


				# если включены категории - выводим их
				if ($this->std->settings["news_gen_cat"])
				{
					$sql = "SELECT `id_cats` FROM `se_news_relations_cats` WHERE `id_news`='".$row['id']."'";
					$i  = 0;
					$ion = 0;

					if ($this->std->db->query($sql, $cat) > 0)
					{
						$category = '';
						while ($cat[$i]['id_cats'])
						{
							$sql = "SELECT `title`,`id` FROM `se_news_cats` WHERE `id`='".$cat[$i]['id_cats']."' AND is_active=1";
							$this->std->db->query($sql, $cats);
								
							if ($cats[0]['title'])
							{
								if ($ion!=0)
								{
									$category .= $_news_categories_current['delimiter'];
								}

								$alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cats[0]['id'].'/';

								$category .= str_replace('{TITLE}', $cats[0]['title'], $_news_categories_current['title']);
								$category = str_replace('{ALIAS}', $alias_cat, $category);
								$ion++;
							}

							$i++;
						}
					}

				}

				/*-----------------------------------------------------------------------------------------------*/
				// вывод картинок и или шаблонов заменителей, если картинок нет
				/*-----------------------------------------------------------------------------------------------*/
				if ($row['img'] != "")
				{
					/*----------------------------------------*/
					// картинка - оригинал
					/*----------------------------------------*/
					$img_big = $this->ModuleFilesPath.$row['id']."_big".$row['img'];	// сама картинка
					list($img_big_width, $img_big_height) = $this->std->getWithHeightImage($img_big);	// ширина и высота
					$img_big_size = $this->std->getFileSize($img_big);		// размер файла в Kb


					/*----------------------------------------*/
					// картинка - основная
					/*----------------------------------------*/
					$img = $this->ModuleFilesPath.$row['id'].$row['img'];	// сама картинка
					list($img_width, $img_height) = $this->std->getWithHeightImage($img);		// ширина и высота
					$img_size = $this->std->getFileSize($img);		// размер файла в Kb


					/*----------------------------------------*/
					// картинка - аватар
					/*----------------------------------------*/
					$img_av = $this->ModuleFilesPath.$row['id']."_av".$row['img'];	// сама картинка
					list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);		// ширина и высота
					$img_av_size = $this->std->getFileSize($img_av);		// размер файла в Kb


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
					$img = str_replace($search, $replace, $_news_img);			// основная
				}
				else
				{		// картинки нет, пусто
					$img	= "";
				}



			}
		}
		else
		{
			$template = 'static';
			$body = $this->std->settings["site_error"];
			$h1 = $title = 'Ошибка 404';
			$this->ModulError( "getCurentNews-> Нет новости с таким аллиасом sql: $sql");
		}

	}

	/**
	 * функция составления полной строки адреса по пришедшему идентификатору,
	 * проходит вверх по дереву до корня и получает правильный полный адрес
	 *
	 * @param unknown_type $id                - идентификатор вершины
	 * @param unknown_type $alias        - начало пути
	 */
	function getAliasById($id)
	{
		// запрос информции о новости
		$sql        = "select * from se_news where is_active = 1 and id = '".$id."' limit 1";

		if ($this->std->db->query($sql, $rows) > 0)// выполняем запрос и проверяем колическо полученных строк
		{
			return "/".date('Y',$rows[0]['timestamp']).'/'.date('m',$rows[0]['timestamp']).'/'.date('d',$rows[0]['timestamp']).'/'.$rows[0]['alias']."/";
		}
	}







}

?>