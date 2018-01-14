<?php
#
#        ������ - ������ � ���������
#
#  Programmer       : Kormishin Vladimir
#
#
#        �����
#        /articles/all/2006/11/14/new23/
#        /articles/13/2006/11/14/new23/
#        /articles/page3/
#        /articles/13/page3/

#        0 - ��� ������
#        1 - ��� ��������� ��� �����-�� ��������� ��������� ��� ����� �������� ���������
#        2 - ��� ��������� ������ ���  ����� �������� ���������
#        3 - �����
#        4 - ����� ������
#        5 - alias ������



/*
 ��������:
 ������� ������ ������, � ��� 3 �������� �������:
 1 ����� ������ � ������������ � �������� (����������� ���, ����, ���������) (������� ������, �������������� � init_vars � generate_actions)
 2 ����� � ������������ �� ��������� (�������� page2)
 3 ����� ��������� ������
 +
 4 ����� ���������� (+������������ � ������ ���������� ����, ����, ���������(�������, �������� ��������� + ����/���))
 5 ������� �������-����

 */

class main_articles extends AbstractClass{

	var $start_page     = 1;        // ��������, ������� ������� (� �����)

	
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
	var $sql = ''; // ������ sql �������. array("where" => '...', "limit" => '...'). ����������� � ������� generate_actions()
	var $items_count; // ���������� ���� ��������� ������ (�������� �������, �� ���� ���������)

	function ArticlesClass(        $sub_alias /*������������� �������� ����������� � ������*/        )
	{

		$this->std->settings['articles_count_on_main_page'] = intval($this->std->settings['articles_count_on_main_page']) < 0 ? 5 : intval($this->std->settings['articles_count_on_main_page']);

		$this->AbstractClass(
		$sub_alias,   	// ���� ����������� � ������
                                                           'articles',    		// �������� ������� � ������� ����� ��������
                                                           'articles'        	// �������� ������ (�� ��� ������ ���������� � ������� modules)
		);


		// ��������, ����� �� ��������� ������������� ����������
		// ��������� ��������� �� ������ ������ ������

		global
		$template,						// ��� ������������� �������
		$title,							// ���������
		$h1,							// ������� �������
		$body,							// ���� ������
		$last_articles,						// ������ ��������� ������
		$articles,
		$arrows_articles,					// ���������
		$keywords,
		$description,
		$tpl,
		$articles_categories_menu,
		$articles_years_menu,
		$body, // ����� ��������� ��������� ��������
		$modules_list;
	
		

		if ((count($this->std->alias[0]) != 0) && ($this->std->alias[0] != 'articles'))
		{
			return ;
		}
		
		
		
		
		if (isset($this->current_url_array[0]) && $this->current_url_array[0] == $this->module_name) $this->tpl = 'main';
		else $this->tpl = 'last';

		
				
		if ($this->tpl == 'main')
		{
			$this->std->db->do_query( "SELECT * FROM se_static WHERE alias='articles' AND pid=-1 ORDER BY id DESC LIMIT 0, 1" );
			$row = $this->std->db->fetch_row();

			// ������� keywords � ���� ������� ����������
			$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
			$description = $this->std->build_meta_tags( $row['description'], 'description');


			$title   = $row['title'] ? $row['title'] : '������';
			$h1      = $row['h1'] ? $row['h1'] : '������';
			$body = $row['body'];
		}

		$this->init_vars();
		$this->generate_actions();
		

		/*if ($this->std->settings['articles_gen_calendar'])
		{
			global $articles_calendar;
			$articles_calendar = $this->GetCalendar();
		}*/

		global $arrows_news;
			
		$prepage = '';
		if (is_array($this->current_url_array))
		foreach ($this->current_url_array as $t)
		{
			if (!preg_match("/page\d+/",$t)) 
			{
				$prepage .= $t."/"; 
			}
			else
			{
				unset($this->std->alias[count($this->std->alias)-1]);
			}
			
		}
			

		$arrows_news = $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $this->items_count,
		                                                             'PER_PAGE'    => $this->std->settings['articles_count_on_main_page'],
		                                                             'CUR_ST_VAL'  => $this->page,
		                                                             'L_SINGLE'    => "",
		                                                             'L_MULTI'     => "��������: ",
		                                                             'BASE_URL'    => "/".$prepage,
		                                                             'leave_out'   => $this->std->settings['articles_count_near_select_page'],
		) );
		
		
		 
		global $news_last, $article_last;
		
		if (count($this->std->alias)==0)
		{
			$article_last = $this->output;
		}
		else
		{
			$news_last = $this->output;
			
			if (count($this->std->alias)>1)
			{
				$template = 'news_current';
			}
			else
			{
				$template = 'news';
			}
		}
		
		

		if ($this->std->settings['articles_gen_cat'])
		{
			# ��������� ���� ���������
			//$articles_categories_menu = $this->getCatsMenu();
		}

		# ��������� ���� �����
		//$articles_years_menu = $this->getYearsMenu();
		
		
		# ��� �������
		if (count($this->std->alias) == 0)
		{
			global $articles_last_onmain;
			$this->std->settings['articles_on_non_articles_page'] = intval( $this->std->settings['articles_on_non_articles_page'] ) < 0 ? 3 : intval($this->std->settings['articles_on_non_articles_page']);
			$articles_last_onmain = $this->getLastArticles($this->std->settings['articles_on_non_articles_page'], 'last');  // ����� ������ ������ �� ����������� ��������
		}
		
	}

	/**
	 * ���������� html ����� ���� ���������
	 *
	 */
	function getCatsMenu( )
	{
		global $_articles_categories_menu;

		$sql = "SELECT * FROM ".TABLE_NEWS_CATEGORIES." ORDER BY `item_order`";
		$this->std->db->do_query($sql);

		$rtn = $_articles_categories_menu['begin'];

		$prepage = '';
		if (is_array($this->current_url_array))
		foreach ($this->current_url_array as $t)
		{
			if (!preg_match("/page\d+/",$t) && !preg_match("/cat\d+/",$t) && $t!=$this->module_name) $prepage .= $t."/";
		}
			
		$href = "/".$this->module_name."/".$prepage;
		if (!$this->category)
		$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $_articles_categories_menu['allcats'] ), $_articles_categories_menu['active']);
		else
		$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $_articles_categories_menu['allcats'] ), $_articles_categories_menu['inactive']);
			
		while ($row = $this->std->db->fetch_row())
		{
			$href = "/".$this->module_name."/".$prepage."cat".$row['id'];
			if ($this->category == $row['id'])
			{
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $row['title'] ), $_articles_categories_menu['active']);
			} else {
				$rtn .= str_replace(array( '{ALIAS}','{TITLE}'), array( $href, $row['title'] ), $_articles_categories_menu['inactive']);
			}
			$rtn .= $_articles_categories_menu['delimiter'];
		}
		$rtn .= $_articles_categories_menu['end'];

		return $rtn;
	}

	/**
	 * ���������� html ����� ���� ���������
	 *
	 */
	function getYearsMenu( )
	{
		global $_articles_years_menu;

		$sql = "SELECT * FROM se_articles WHERE `is_active`=1 order by `timestamp` desc";
		$this->std->db->do_query($sql);

		$rtn = $_articles_years_menu['begin'];

		$cat = $this->category ? "cat".$this->category."/" : "";

		# ���� ��� ������ - ��� ���� �������
		if ($this->year)
		{
			$temp = $_articles_years_menu['inactive'];
			$temp = str_replace('{YEAR}',$_articles_years_menu['allyears'],$temp);
			$temp = str_replace('{ALIAS}', "/".$this->module_name."/".$cat,$temp);
			$rtn .= $temp;
		}
		# ���� ��� �� ������ - ��� ���� ���������
		else
		{
			$temp = $_articles_years_menu['active'];
			$temp = str_replace('{YEAR}',$_articles_years_menu['allyears'],$temp);
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
					$rtn .= str_replace(array( '{ALIAS}','{YEAR}'), array( $href, $y ), $_articles_years_menu['active']);
				} else {
					$rtn .= str_replace(array( '{ALIAS}','{YEAR}'), array( $href, $y ), $_articles_years_menu['inactive']);
				}
				$rtn .= $_articles_years_menu['delimiter'];
			}
		}
		$rtn .= $_articles_years_menu['end'];

		return $rtn;
	}

	/**
	 * ��������� ���������
	 *
	 */
	function GetCalendar()
	{
		$ret = '';

		global $articles_calendar_css;
		$t_path = substr(TEMPLATES_PATH,1);

		$ret .= '
<div id="calendar-container" style="float: right; margin-left: 1em; margin-bottom: 1em;" >

<style type="text/css">@import url('.$t_path.'/calendar/calendar.css);</style>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar.js"></script>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar-en.js"></script>
<script type="text/javascript" src="'.$t_path.'/calendar/calendar-setup.js"></script>

<script type="text/javascript">
';

		$sql = "SELECT * FROM se_articles WHERE `is_active`=1";
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
	      window.location = "/articles/" + y + "/" + ((m < 10)? "0" : "") + m + "/" + ((d < 10)? "0" : "") + d + "/'.$cat.'";
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
	 * ���������� ������ ������
	 *
	 *
	 * @param string $tpl        - ��������
	 * @return unknown           - ���������� ������� ������, ������ ������
	 */





	#
	#	���� 1
	#

	function init_vars()
	{

		$ispage = 0;
		$i=1;
		while ($i<=count($this->current_url_array))
		{
				
			# ���� ����� ���'� ������� �� 2� ��� 4� ����, ��������� � �������� ��� �� ���������� - ��������� � �� ���
			if (((isset($this->current_url_array[$i]) && strlen($this->current_url_array[$i])==2) or(isset($this->current_url_array[$i]) && strlen($this->current_url_array[$i])==4)) and is_numeric($this->current_url_array[$i]) and(empty($this->yearpage)) and(empty($this->yearcategory)) and(empty($this->year)))
			{
				$this->year = $this->current_url_array[$i];
			}




			# ����  ����� ���'� �������� "page" , ����� "page" ����� ����� - ��� �������� ���������
			if (@preg_match("/\bpage/i",$this->current_url_array[$i]))
			{
					
				$page_url_is_num = is_numeric(substr ($this->current_url_array[$i],4));
				if ($page_url_is_num)
				{
					$this->page = substr ($this->current_url_array[$i],4);
					$ispage = 1;
				}

			}
				
			# ���� $page ��� �� ����������, ����� ���'� �������� "cat" � ����� "cat" ����� ����� - ��� �������� ���������
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
			//$template                 = 'articles_current';
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
			$sql = "SELECT * FROM se_articles_relations_cats WHERE `id_cats` = '".$this->category."'";
			$this->std->db->do_query($sql);
			$ids = array();
			while ($row = $this->std->db->fetch_row())
			{
				$ids[] = $row['id_articles'];
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
					// ����� ������������ ������
					//$template = 'articles_current';
					$template	= 'news_current';
					$this->output = $this->getCurentArticles();
					return;
				} else {
					// ����� ������ ����� ���
					$time1 = mktime(0,0,0,$this->month,$this->day,$this->year);
					$time2 = mktime(23,59,59,$this->month,$this->day,$this->year);
					$wheres[] = "(`timestamp` >= ".$time1." AND `timestamp` <= ".$time2.")";
				}
			} else {
				// ����� ������ ����� ����
				$time1 = mktime(1,1,1,1,1,$this->year);				
				$time2 = mktime(23,59,59,12,31,$this->year);
				$wheres[] = "(`timestamp` >= ".$time1." AND `timestamp` <= ".$time2.")";
			}
		} else {
			// ����� ���� ������
			// wheres �� ��������� ������
		}
			
		# ������������ ��������
		$sql_limit = "limit ".(($this->page - 1) * $this->std->settings['articles_count_on_main_page']).", ".$this->std->settings['articles_count_on_main_page'];
		$sql = implode(" AND ", $wheres);
			
		$this->sql = array("where" => ($sql != "")? "WHERE ".$sql : "", "limit" => $sql_limit);

		$this->output = $this->generate_articles();
	}
	 
	 
	 
	function generate_articles()
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

			$sql = "SELECT COUNT(*) as cnt FROM se_articles ".$this->sql['where'];

			$this->std->db->do_query($sql);
			$row = $this->std->db->fetch_row();
			$this->items_count = $row['cnt'];

			$sql = "SELECT * FROM se_articles ".$this->sql['where']." ORDER BY `timestamp` DESC ".$this->sql['limit'];
			
			//$this->std->db->do_query($sql);

			global $_articles;

			$this->std->db->query($sql,$rows2);

			$items = array();
			foreach ($rows2 as $row2)
			{
				$items[] = $this->GetArticlesItem($row2);
			}

		}

		if (count($items) > 0)
		{
			return $_articles[$this->tpl]['begin'].implode($_articles[$this->tpl]['separator'], $items).$_articles[$this->tpl]['end'];
		} else return '';
	}

	function GetArticlesItem($row, $tpl = '')
	/**
	 * $row - new info from db
	 */
	{
		global
		$template,
		$_articles,
		$category,
		$_articles_categories_current,                   // ������ ������ ������
		$date_format,
		$_articles_time;
		$body = '';

		if ($tpl == '') $tpl = $this->tpl;
		$templ = $_articles[ $tpl ];

		$articles_date = $this->std->get_time($row['timestamp'], $date_format);

		$articles_href = "/articles/".date('Y',$row['timestamp']).'/'.date('m',$row['timestamp']).'/'.date('d',$row['timestamp']).'/'.$row['alias']."/";
		
		$pms = array();
		$pms["{DATE}"] = $articles_date;
		$pms["{ALIAS}"] = $articles_href;
		$pms["{TITLE}"] = $row['title'];
		$pms["{SBODY}"] = $row['sbody'];
		$pms["{BODY}"] = $row['body'];
		$pms["{AUTHOR}"] = $row['author'];
		
		//$tempstr = str_replace("{DATE}",$articles_date, $templ);
		//$tempstr=str_replace('{ALIAS}',$articles_href, $tempstr);
		//$tempstr=str_replace('{TITLE}',$row['title'], $tempstr);
		//$tempstr=str_replace('{SBODY}',$row['sbody'], $tempstr);
		//$tempstr=str_replace('{BODY}',$row['body'], $tempstr);
		//$tempstr=str_replace('{AUTHOR}',$row['author'], $tempstr);




		 
		$category = '';
		# ���� �������� ��������� - ������� ��

		if ($this->std->settings["articles_gen_cat"])
		{
			 
			$sql = "SELECT `id_cats` FROM `se_articles_relations_cats` WHERE `id_articles`='".$row['id']."'";

			$ion = 0;


			//$result	=	$this->std->db->do_query($sql);

			$this->std->db->query($sql, $rows);
			foreach ($rows as $row3)
			{
					
				$cat_id	=	$row3['id_cats'];
				$sql = "SELECT `title`,`id` FROM `se_articles_cats` WHERE `id`='".$cat_id."' AND is_active=1";
				$result2	=	$this->std->db->do_query($sql);
				$title	=	mysql_fetch_array($result2);
				if ($ion!=0)
				{
					$category .= $_articles_categories_current['delimiter'];
				}
				$alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cat_id.'/';
				$category .= str_replace('{TITLE}', $title[0], $_articles_categories_current['title']);
				$category = str_replace('{ALIAS}', $alias_cat, $category);
				$ion++;
			}
			/*
			 while ($cat=mysql_fetch_array($result))
			 {
			 $cat_id	=	$cat[0];
			 $sql = "SELECT `title`,`id` FROM `se_articles_cats` WHERE `id`='".$cat_id."' AND is_active=1";
			 $result2	=	$this->std->db->do_query($sql);
			 $title	=	mysql_fetch_array($result2);
			 if ($ion!=0)
			 {
			 $category .= $_articles_categories_current['delimiter'];
			 }
			 $alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cat_id.'/';
			 $category .= str_replace('{TITLE}', $title[0], $_articles_categories_current['title']);
			 $category = str_replace('{ALIAS}', $alias_cat, $category);
			 $ion++;
			 }
			 */
			 
		}


		$pms["{CAT}"] = $category;
		//$tempstr=str_replace('{CAT}',$category, $tempstr);

		# -----------------------------------------------------------------------
		# ����� ��������
		# -----------------------------------------------------------------------
		global $_articles_image;
		if ($row['img'] != "")
		{
			$img_av = "/".FILES_FOLDER."/".$this->module_name."/".$row['id']."_av".$row['img'];	// ���� ��������
			list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);		// ������ � ������
			$img_av_size = $this->std->getFileSize($img_av);		// ������ ����� � Kb

			$img_temp = $_articles_image;
		}
		else
		{
			$img_av 			= "/".FILES_FOLDER."/".$this->module_name."/default.jpg";
			$img_av_width		= 0;
			$img_av_height		= 0;
			$img_av_size		= 0;
			
			$img_temp = '';
		}

		// ��� ���� � ��������
		$search = array("{ALIAS}","{IMG_AV}","{IMG_AV_WIDTH}","{IMG_AV_HEIGHT}","{IMG_AV_SIZE}");
		// �� ��� ����� ��������
		$replace = array($articles_href, $img_av, $img_av_width, $img_av_height, $img_av_size);
		// ������
		$img = str_replace($search, $replace, $img_temp);
		
		$pms["{ARTICLES_IMAGE}"] = $img;
//		$tempstr = str_replace("{NEWS_IMAGE}", $img, $tempstr);

		return strtr($templ['item'], $pms);
	}


	/**
	 * ��������� ������ ������ ���  ��������� ��������
	 *
	 *
	 * @param unknown_type $articles_limit        - ���������� ��������� ������ �� ���� ��������
	 * @return unknown                        - ���������� ������� ������, ������ ������
	 */

	function getLastArticles($articles_limit, $tpl)
	{
		global
		$template,
		$_articles,                   // ������ ������ ������
		$_articles_delimiter,
		$_articles_time;
		$body = '';

		if ($tpl == '') $tpl = $this->tpl;
		$this->std->settings['articles_delimiter'] = $_articles_delimiter[ $tpl ];

		$templ = $_articles[ $tpl ];

		// ���� �� ������������� ���������� ������
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
					$this->start_page = ($this->start_page-1)*$this->std->settings['articles_count_on_main_page']; ;
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

			// ���� ��������������� ������ ��� �������� ��������, �� �� ��������� ������ ����������� ���������
			$this->start_page = ($this->start_page < 0) ? 0 : $this->start_page;

			if( $tpl != 'main' )
			{
				$this->start_page = 0;
			}

			if($this->std->settings['global_revert_navigation'] and $tpl == 'main')
			{

				$sql         = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1";

				$this->std->db->do_query($sql);
				$articles_count_array = $this->std->db->fetch_row();

				$pages = ceil($articles_count_array['count']/$this->std->settings['articles_count_on_main_page']);


				for( $i = $pages; $i > 0; $i-- )
				{
					$pages_array[] = $i;
				}

				$this->start_page = ($this->start_page) ? $this->start_page : $pages;

				$this->start_page = $pages_array[ $this->start_page-1 ] - 1;
				$this->start_page = ($this->start_page < 0) ? 0 : $this->start_page;
				$this->start_page = $this->start_page*$this->std->settings['articles_count_on_main_page'];

			}

			# ������������ ������� sql �������, ��������������� ��������� ������
			# ���������� ��� ���������: ����� ������ �������� �� ���������� ���������
			$limit_sql = " LIMIT ".$this->start_page.", ".$articles_limit;

			// ������ ������������ ���������� ������ ������� � ������������ ������
			$sql = "SELECT * FROM ".$this->db_table." WHERE is_active=1 ORDER BY `timestamp` DESC $limit_sql";

			if ($this->current_url_array[0] == 'articles')
			{

					#2008 ���� � ������ ������������ ��� - ������ � �� ������ ����� ����
					if ( @is_numeric($this->current_url_array[1]) )
					{
						$sql = "SELECT * FROM ".$this->db_table." WHERE timestamp > ".mktime(0, 0, 0, 1, 1, $this->current_url_array[1])." AND timestamp < ".mktime(0, 0, 0, 12, 32, $this->current_url_array[1])." ORDER BY `timestamp` DESC $limit_sql";
					}
		
					$items = array();
					$this->std->db->query($sql,$rows);
					foreach ($rows as $row)
					{
						# -----------------------------------------------------------------------
						# ����� ������ ������ �� ���������� ������� � ��
						# -----------------------------------------------------------------------
						$items[] = $this->GetArticlesItem($row,$tpl);
					}
					if (count($items) > 0)
					{
							$body = $templ['begin'].implode($templ['separator'], $items).$templ['end'];
					}
			}
			else
			{
					# ����� ��������� ������
					$items = array();
					$this->std->db->query($sql,$rows);
					foreach ($rows as $row)
					{
						# -----------------------------------------------------------------------
						# ����� ������ ������ �� ���������� ������� � ��
						# -----------------------------------------------------------------------
						$items[] = $this->GetArticlesItem($row,$tpl);
					}
					if (count($items) > 0)
					{
							$body = $templ['begin'].implode($templ['separator'], $items).$templ['end'];
					}
			}
			
			
			//echo $body; exit;
			if(!$body)
			{
				$this->ModulError( "getLastArticles-> ������� ������ ����� sql: $sql");
			}
		}

		return $body;
	}



	/**
	 * ��������� ������ � �������� �������
	 *
	 *
	 * @param unknown_type $articles_limit                - ���������� ��������� ������ �� ���� ��������
	 * @param unknown_type $arrows_limit        - ������� �������� ������� �������� ����� � ������ �� �������� ������
	 *                                                                                   (��� ����� �� ���������� ���� ��� ��������� ������� �������, � �� ����� ���� �������)
	 * @return unknown                                                 - ���������� ������� ������ ��������� �������
	 */
	function getArticlesArrows($articles_limit /*���������� ������ ��������� �� ��������*/, $arrows_limit /*���������� �������� � ������ ���������*/)
	{
		global
		$host,
		$_articles_page_active,        // ��������� �� �������� ������, ��������
		$_articles_page_unactive,      // ��������� �� �������� ������, �� ��������
		$template;                 // ��������� ���������� ���������, ��� ������ ��������� ��������

		$arrows_articles        = '';
		$sql         = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1";
		#2008 ���� ������ ��� � ������ - ������� ����� ������ ������������� ����
		if ( is_numeric($this->current_url_array[1]) )
		{
			$sql = "SELECT count(*) as count FROM ".$this->db_table." WHERE is_active = 1 AND timestamp > ".mktime(0, 0, 0, 1, 1, $this->current_url_array[1])." AND timestamp < ".mktime(0, 0, 0, 12, 32, $this->current_url_array[1])."";
		}
		$this->std->db->do_query($sql);

		$page_count = 0;
		// ���������� ������ � ����
		$articles_count_array = $this->std->db->fetch_row();
		$articles_count = $articles_count_array['count'];
		if ($articles_count == 0)
		{
			$this->ModulError( "getArticlesArrows-> ������� ������ ����� sql: $sql");
		}

		// ������ ��������� �������� ��� ���������
		$total_pages = ceil($articles_count/$this->std->settings['articles_count_on_main_page']);

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
			return;
		}

		if( $total_pages < $this_page )
		{
			$template = 'static';
			return;
		}

		if( $total_pages == $this_page and $this->std->settings['global_revert_navigation'])
		{
			$template = 'static';
			return;
		}

		if( $this_page == 1 and !$this->std->settings['global_revert_navigation'] )
		{
			$template = 'static';
			return;
		}

		if( !$this_page and $this->std->settings['global_revert_navigation'] )
		{
			$this_page = $total_pages;
			$this_page = ($this_page-1)*$this->std->settings['articles_count_on_main_page'];
		}
		else
		{
			$this_page = $this->start_page;
		}


		#2008 ���� ����� articles ����� ����� (���) - ������ ������ � ����� ���� /articles/���/page
		$year_base_url = '';
		if ( is_numeric($this->current_url_array[1]) )
		{
			$year_base_url = '/'.$this->current_url_array[1];
		}


		return $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $articles_count,
                                                             'PER_PAGE'    => $articles_limit,
                                                             'CUR_ST_VAL'  => ceil(($this_page+$this->std->settings['articles_count_on_main_page'])/
		$this->std->settings['articles_count_on_main_page']),
                                                             'L_SINGLE'    => "",
                                                             'L_MULTI'     => "��������: ",
                                                             'BASE_URL'    => "/articles$year_base_url",
                                                             'leave_out'   => $arrows_limit,
		) );

	}


	// ������ ����������� ������
	function getCurentArticles()
	{
		global
		$template,
		$_month_rp,                           // ������ ������� � ����������� ������
		$date,                                // ���� �������� ������
		$body,                                // ���� ������
		$title,                               // �������� ������
		$alias,                               // �����
		$h1,                                  // ������� �������
		$sbody,                               // �����
		$author,                              // �����
		$keywords,                            // keywords
		$description,                         // description
		$_articles_time,                          // ��������� ������
		$_articles_img,
		$img,
		$_articles_cat,
		$_articles_cat_delimeter,
		$category,
		$_articles_categories_current,
		$_date_format_cur,
		$date;



		# �������� ����������� ������ �� ����
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
				// ������� keywords � ���� ������� ����������
				if(!$keywords)
				$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
				if(!$description)
				$description = $this->std->build_meta_tags( $row['description'], 'description');

				$alias  = $row['alias'];
				$author = $row['author'];


				# ���� �������� ��������� - ������� ��
				if ($this->std->settings["articles_gen_cat"])
				{
					$sql = "SELECT `id_cats` FROM `se_articles_relations_cats` WHERE `id_articles`='".$row['id']."'";
					$i  = 0;
					$ion = 0;

					if ($this->std->db->query($sql, $cat) > 0)
					{
						$category = '';
						while ($cat[$i]['id_cats'])
						{
							$sql = "SELECT `title`,`id` FROM `se_articles_cats` WHERE `id`='".$cat[$i]['id_cats']."' AND is_active=1";
							$this->std->db->query($sql, $cats);
								
							if ($cats[0]['title'])
							{
								if ($ion!=0)
								{
									$category .= $_articles_categories_current['delimiter'];
								}

								$alias_cat = 'http://'.$_SERVER['HTTP_HOST'].'/'.$this->module_name.'/cat'.$cats[0]['id'].'/';

								$category .= str_replace('{TITLE}', $cats[0]['title'], $_articles_categories_current['title']);
								$category = str_replace('{ALIAS}', $alias_cat, $category);
								$ion++;
							}

							$i++;
						}
					}

				}

				/*-----------------------------------------------------------------------------------------------*/
				// ����� �������� � ��� �������� �����������, ���� �������� ���
				/*-----------------------------------------------------------------------------------------------*/
				if ($row['img'] != "")
				{
					/*----------------------------------------*/
					// �������� - ��������
					/*----------------------------------------*/
					$img_big = $this->ModuleFilesPath.$row['id']."_big".$row['img'];	// ���� ��������
					list($img_big_width, $img_big_height) = $this->std->getWithHeightImage($img_big);	// ������ � ������
					$img_big_size = $this->std->getFileSize($img_big);		// ������ ����� � Kb


					/*----------------------------------------*/
					// �������� - ��������
					/*----------------------------------------*/
					$img = $this->ModuleFilesPath.$row['id'].$row['img'];	// ���� ��������
					list($img_width, $img_height) = $this->std->getWithHeightImage($img);		// ������ � ������
					$img_size = $this->std->getFileSize($img);		// ������ ����� � Kb


					/*----------------------------------------*/
					// �������� - ������
					/*----------------------------------------*/
					$img_av = $this->ModuleFilesPath.$row['id']."_av".$row['img'];	// ���� ��������
					list($img_av_width, $img_av_height) = $this->std->getWithHeightImage($img_av);		// ������ � ������
					$img_av_size = $this->std->getFileSize($img_av);		// ������ ����� � Kb


					/*----------------------------------------*/
					// ��� ���� � ��������
					/*----------------------------------------*/
					$search = array("{IMG_BIG}","{IMG_BIG_WIDTH}","{IMG_BIG_HEIGHT}","{FILE_BIG_SIZE}",
					        							"{IMG}","{IMG_WIDTH}","{IMG_HEIGHT}","{FILE_SIZE}",
					        							"{IMG_AV}","{IMG_AV_WIDTH}","{IMG_AV_HEIGHT}","{FILE_AV_SIZE}");

					/*----------------------------------------*/
					// �� ��� ����� ��������
					/*----------------------------------------*/
					$replace = array($img_big, $img_big_width, $img_big_height, $img_big_size,
					$img, $img_width, $img_height, $img_size ,
					$img_av, $img_av_width, $img_av_height, $img_av_size);
					// ������
					$img = str_replace($search, $replace, $_articles_img);			// ��������
				}
				else
				{		// �������� ���, �����
					$img	= "";
				}



			}
		}
		else
		{
			$template = 'static';
			$body = $this->std->settings["site_error"];
			$h1 = $title = '������ 404';
			$this->ModulError( "getCurentArticles-> ��� ������ � ����� �������� sql: $sql");
		}

	}

	/**
	 * ������� ����������� ������ ������ ������ �� ���������� ��������������,
	 * �������� ����� �� ������ �� ����� � �������� ���������� ������ �����
	 *
	 * @param unknown_type $id                - ������������� �������
	 * @param unknown_type $alias        - ������ ����
	 */
	function getAliasById($id)
	{
		// ������ ��������� � ������
		$sql        = "select * from se_articles where is_active = 1 and id = '".$id."' limit 1";

		if ($this->std->db->query($sql, $rows) > 0)// ��������� ������ � ��������� ��������� ���������� �����
		{
			return "/".date('Y',$rows[0]['timestamp']).'/'.date('m',$rows[0]['timestamp']).'/'.date('d',$rows[0]['timestamp']).'/'.$rows[0]['alias']."/";
		}
	}







}

?>