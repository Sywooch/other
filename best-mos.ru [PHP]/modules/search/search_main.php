<?php
/*
 +--------------------------------------------------------------------------
 |   SITE ENGINE v.3.0.0
 |   ========================================
 |   by SAT
 |   � �Web Otdel� Ltd
 |   http://www.vmast.ru
 |   ========================================
 |   Web: http://www.vmast.ru
 |   Email: sat@game-play.ru
 +---------------------------------------------------------------------------
 |
 |   > ������ - ����������� ����� �� ����������� �������
 |   > Script written by SAT
 |
 +--------------------------------------------------------------------------
 */

require_once("search_js.php");

class main_search extends AbstractClass{

	var $std;
	var $modules                    = array();
	var $used_template              = '';
	var $start_page                 = 0;        // ������������ �������� �������
	var $searchword                 = '';       // ��������� �����
	var $search_objs                = array();  // ���������� �� ��������, ����������� � ������
	var $search_pagenum             = 1;        // ������� ��������
	var $search_curnum              = 0;        // ������� �������������� ������� ����� ����������� ������
	var $search_count               = 0;        // ����� ���������� ����������� ������

	// ���� �������������� ����������
	var $pagealias              = '';        // ����� ��������
	var $faq_cur                = -1;        // �������, ��� ������ ������������� �����-�� ���������� �������� ( > -1    - �������������)

	function SearchClass(        $sub_alias /*������������� �������� ����������� � ������*/ )
	{


		$this->AbstractClass(
		$sub_alias,        // ���� ����������� � ������
                                                           'se_modules',        // �������� ������� � ������� ����� ��������
                                                           'search'        // �������� ������ (�� ��� ������ ���������� � ������� modules)
		);

		global
		$title,             // ���������
		$h1,                // ������� �������
		$body,              // ���� �������
		$path,
		$arrows,            // ��������� ������� ����������� ������
		$searchword,        // ��������� �����
		$search_count,      // ����� ���������� ����������� ������
		$template,          // ��� ������������� �������
		$_search_result,   // �������� ���������� ������
		$_search_noresult; // ������ ��� ��������� ����������� ������

		$searchword = trim( $this->std->getValueSession('search_word') );
		$searchword = $searchword ? $searchword : '�����...';

		global $_search_js_on_module;

		global $search_form, $_search_form;
		$search_form = $_search_form;

		// ����� ��� ������ �� ������ ��������� ����� 2
		if (count($this->current_url_array) > 0)
		{
			if ($this->current_url_array[0] == $this->module_name)
			{
				$template = 'static';

				$searchword      = '';
				$title           = '���������� ������';
				$h1              = $title;

				// ���������� ������� �������� ��������� ����������

				if (count($this->current_url_array) == 1)
				{
					$this->search_pagenum = 1;
				}
				elseif (preg_match("/page\d+/",$this->current_url_array[1]))
				{
					// ���� ���������� ��� � ������ �������� ������
					$this->search_pagenum = preg_replace( "#page(\d+)#is", "\\1", $this->current_url_array[1] );
				}
				else
				{
					$template = 'error';
					$this->ModulError('SearchClass-> ��������� �� ��������� ������.');
					return;
				}

				//----------------------------
				// ������ ����� � ����� ������
				//----------------------------
				if ($this->std->input['request_method'] == 'post')
				{
					$this->std->updateSession( $this->std->member['session_id'], 'delete', array('search_word' => '',
                                                                                                                     'objects'     => '',
					) );

					//---------------------------------
					// ��������� ������ � �������,
					// � ������� �������� �����,
					// � ��� �� ��������� ������ ���������������
					// ������ �������, � ������� ����������
					// ��������� �����
					//---------------------------------
					$this->setSessionSearchData();
				}


				// � ������ �������� ������ � ����������� ������: ��������� ����� � ������ ������� � id ������, � ������� ���� ���-�� �������
				// ���������� ����� �������������� ���� ���, ����� ��� ��������� ������� ����������� ������ ������� ��� �� ������ �
				// ������������� ���� ������ ����������� �������
				// �� ������, ���������� �� �������

				$this->searchword   = trim( $this->std->getValueSession('search_word') );
				$this->search_objs  = $this->std->getValueSession('objects');
				$this->search_count = $this->std->getValueSession('search_c');

				if ($this->searchword and is_array($this->search_objs) )
				{
					// �������� ���� � ������������ ������
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

					$searchword = $searchword ? $searchword : '�����...';

					$_search_js_on_module = str_replace("{SEARCHWORD}", $searchword, $_search_js_on_module);

				}
				else
				{
					//$this->ModulError('SearchClass-> ������. � ������ ��� ������ � ����������� ������.');
				}
				
				$path = '<a href="/">�������</a>&nbsp;<span>&raquo;</span>&nbsp;���������� ������';
			}

		}
	}


	/**
	 * ��������� ���� � ������������ ������, ����������� ��������
	 */
	function getSearchResultBlock()
	{

		$num_to      = $this->search_pagenum * $this->std->settings['search_page_num'];  // �� ������ ������ �������, ������������
		$num_from    = $num_to - $this->std->settings['search_page_num'];                // �� ������ ������, ������������
		$this->search_curnum = 0;  // ������� �������������� ��������� ������

		$body = '';

		// ���� �� �������, ������� ���� �������� ����� ��� ������
		foreach ($this->search_objs as $obj)
		{
			// ��� ����������, �� ������������
			if ($this->search_curnum+$obj['rows_count'] < $num_from)
			{
				$this->search_curnum += $obj['rows_count'];// ����������� ������� �������
			}
			elseif($this->search_curnum <= $num_to)
			{
				$ids = array();

				// ���� �� ���������� ����� ID
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

				 
				$body .= $this->getSearchItem($obj['modulename'], $ids, $this->search_curnum+1, $num_from);  // �������� ���������
			}
			else
			{
				break;
			}
		}

		return $body;
	}

	/**
	 * ������ ���� ����� ����������
	 *
	 * @param unknown_type $module        - �������� ������
	 * @param unknown_type $id            - ������������� �������
	 * @param unknown_type $num           - ������� ����� ������������ ������ ����������
	 * @return unknown                    - ���� ����������� �����
	 */
	function getSearchItem($module, $ids, $num, $num_from)
	{
		global $_search_result_value,  // ������ ������ ����������
		$host;                   // ����

		$res = '';

		// ������� ��� �������
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

					// �������� �������� ����� � ������
					if( strlen( substr( $body, 0, $first_pos) )  < $this->std->settings['search_cut_count'] )
					{
						$right_pos = ($right_pos + $this->std->settings['search_cut_count']) > (strlen( $body ) - 1) ?
						(strlen( $body ) - 1) :
						($right_pos + $this->std->settings['search_cut_count']);
						$first_pos = 0;
						$start     = '';
					}

					// ���� �������� �������� ����� � �����
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

				// ������ ��� � index - �������
				$alias = trim($alias);
				$alias = preg_replace('#/index/$#is', '', $alias);


				$title       = preg_replace($searchword,"<b>\\1</b>",$title);
				$body        = preg_replace($searchword,"<b>\\1</b>",$body);

				// ������
				$find        = array('{NUM}', '{TITLE}', '{BODY}', '{ALIAS}', '{HOST}');

				$replace     = array($num_from, $title, $body, $alias, $host);
				$body        = str_replace($find, $replace, $_search_result_value);  // �����

				$res .= $body;
				 
				 

				 
			}
		}

		return $res;
	}

	/**
	 * ��������� ������ � �������, � ������� �������� �����, � ��� �� ��������� ������ ��������������� ������ �������,
	 * � ������� ���������� ��������� �����
	 *
	 * @param unknown_type $searchword
	 */
	function setSessionSearchData()
	{

		$objects    = array(); // ���������� �� �������� ������
		$searchword = trim($this->std->input['search_word']);

		$search_exclusion_fields = array( 'alias', 'author',
                                                  'description', 'keywords',
                                                  'template', 'menu',
                                                  'owner', 'img', 'table_father'); // ����-���������� �� ������


		// ���������� ������ ������������� �������� �������, � ������� � ����� ������
		$sql = "select * from ".TABLE_MODULES." where (is_active = 1 OR is_active = 2) and need_search=1";
		$query_id = $this->std->db->do_query($sql);

		// ���� ��������� ���� � ��������, � ������� ����� ����� �����
		if ($this->std->db->getNumRows() and $searchword)
		{
			// �.�. � ����� ������������ �������������� ������, �� ����������� �������� id �������� �������
			while ($row = $this->std->db->fetch_row( $query_id ))
			{
				// ������� ������ ����� �� ������� ���� ������

				$q            = ''; // ������� �������
				$q_arr        = array();
				$search_field = array();


				// ����������� ���� ������
				/*$this->std->db->do_query("SELECT * FROM se_{$row['modulename']}");
				 $fields = $this->std->db->get_result_fields();

				 $cnt = count($fields);

				 for( $i = 0; $i < $cnt; $i++ )
				 {
				 // ���� �� ��������� ����� �� ������� ����, �� �� �������� ��� � ������ ����� ������
				 if( in_array($fields[$i]->name, $search_exclusion_fields) )
				 {
				 continue;
				 }

				 // ������� � ������ ����� ������ ������ ���� ���� ����� ��������� ���
				 if( $fields[$i]->type == 'string' or $fields[$i]->type == 'blob')
				 {
				 $search_field[] = $fields[$i]->name;
				 }
				 }*/


				$search_field[] = 'id';
				$search_field[] = 'title';
				$search_field[] = 'sbody';
				$search_field[] = 'body';



				// ��������� �� ����� ������ � ������� ������ ��������� ����
				foreach( $search_field as $fields )
				{
					$q_arr[] = "{$fields} LIKE '%$searchword%'";
				}

				// ���������� ������
				$q = implode(' OR ', $q_arr);

				// ����� �� ��������� �������
				$sql = "SELECT * FROM ".TABLENAME_PREFIX.$row['modulename']." WHERE ({$q}) and (is_active = 1 OR is_active = 2) ORDER BY timestamp DESC";


				$rows_count = $this->std->db->query($sql, $rows_obj);

				if ($this->std->input['request_method'] == 'post')
				{
					$search_cou += $rows_count;
				}

				if ($rows_count > 0)
				{
					// � ������ �������� ��������� ��������� �������-������, � ������� �������� ����� �� body � � ������� ���� ���������� ������
					// ������, � ������� ���������� �����, ��� � ������� ��� ���������� ������ - �����������
					$modulename                                  = $row['modulename'];
					$objects[ $modulename ]                      = array();            // ������ � ���������� � ����������� ������
					$objects[ $modulename ]['rows_count']        = $rows_count;        // ���������� � ���������� �����������
					$objects[ $modulename ]['modulename']        = $modulename;        // �������� ������
					$objects[ $modulename ]['rows']              = array();            // ����������. �������� ������ id ������, �� �� ��� ����� ����� �������� ������ � ������ � ����

					foreach ($rows_obj as $row_obj)
					{
						$objects[$modulename]['rows'][] = array( 'id' => $row_obj['id'] );
					}
				}
			}
		}

		// ��������� ������ � ������ ������������
		$resault_array = array();
		$resault_array['search_word'] = $searchword;
		$resault_array['objects']     = $objects;
		$resault_array['search_c']    = $search_cou;

		$this->std->updateSession( $this->std->member['session_id'], 'update', $resault_array);
		$this->search_count = $search_cou;

		unset($objects, $row, $rows_obj, $rows);
	}


	/**
	 * ��������� ����������� ������
	 *
	 *
	 * @param unknown_type $limit               - ���������� ��������� ����� � ����������� �� ���� ��������
	 * @param unknown_type $arrows_limit        - ������� �������� ������� �������� ����� � ������ �� �������� ������
	 *                                      (��� ����� �� ���������� ���� ��� ��������� ������� �������, � �� ����� ���� �������)
	 * @return unknown                          - ���������� ������� ������ ��������� �������
	 */

	function getArrows($limit, $arrows_limit)
	{
		return $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $this->std->getValueSession('search_c'),
                                                          'PER_PAGE'     => $this->std->settings['search_page_num'],
                                                          'CUR_ST_VAL'   => $limit,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "��������: ",
                                                          'BASE_URL'     => '/search',
                                                          'leave_out'    => $this->std->settings['search_page_rows'],
                                                          'IGNORE_REVERT'=> 1,
		) );
	}


}
?>