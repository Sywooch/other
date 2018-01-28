<?php

#
# ���������������� �����
#


require_once 'class_tree.php';

class main_search extends class_tree
{


	var $modules			= array();
	var $session			= array();	// �������� � ������ ������
	var $word				= 0;        // ��������� �����
	var $fields				= array('title', 'body');		// ��������� ���� � ��������
	var $curpage			= 1;        // ������������ �������� �������	


	var $module				= null;
	
	function main( )
	{
		 
		
		#-----------------------------------------------------------------------
		# ������ ��������� ������������ ����� ������
		#-----------------------------------------------------------------------
		$this->getForm();
		
		
		
		
		
		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[0] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}
		
		
		

		// ����� ��� ������ �� ������ ��������� ����� 2
		if (count($this->std->alias) <= 2)
		{
				$this->setPul('title', '���������� ������');
				$this->setPul('h1', '���������� ������');

				if (count($this->std->alias) == 2)
				{
					# ����� ��������
					$this->curpage = preg_replace( "#page(\d+)#is", "\\1", $this->std->alias[1] );
				}
				

				//----------------------------
				// ������ ����� � ����� ������
				//----------------------------
				if ($this->std->input['request_method'] == 'post')
				{	
					$this->word = $this->std->input['word'];
					$this->session['word'] = $this->word;
						
					
					$this->session = array();
					$this->session['word'] = $this->word;
					$this->std->updateSession( $this->std->member['session_id'], 'update', array($this->mod_name => $this->session) );

					//---------------------------------
					// ��������� ������ � �������,
					// � ������� �������� �����,
					// � ��� �� ��������� ������ ���������������
					// ������ �������, � ������� ����������
					// ��������� �����
					//---------------------------------
					$this->searchData();
					
					
					# �������������� �����
					$this->getForm();
				}


				// � ������ �������� ������ � ����������� ������: ��������� ����� � ������ ������� � id ������, � ������� ���� ���-�� �������
				// ���������� ����� �������������� ���� ���, ����� ��� ��������� ������� ����������� ������ ������� ��� �� ������ �
				// ������������� ���� ������ ����������� �������
				// �� ������, ���������� �� �������

				
								
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
					$this->log('������. � ������ ��� ������ � ����������� ������.');
					$this->template = 'error';
				}
			

		}
		else
		{
			$this->template = 'error';
			$this->log('��������� �� ��������� ������');
		}
		
		
		
		
		

	}
	
	
	/**
	 * ������������ ����� ������
	 *
	 */
	public function getForm()
	{
		$this->word = '�����...';
		$this->session = $this->std->getValueSession($this->mod_name);
		
		if (isset($this->session['word']) && ($this->session['word'] != ''))
		{
			$this->word = $this->session['word'];
		}
		

		# ����� ������
		$this->skin['form'] = str_replace('{word}', $this->word, $this->skin['form']);
		$this->updatePul($this->mod_name.'_form', $this->skin['form'] );
		
		# ��������� �����
		$this->updatePul($this->mod_name.'_word', $this->word );
	}






	/**
	 * ��������� ���� � ������������ ������, ����������� ��������
	 */
	function getSearchResultBlock()
	{
		$body		= '';
		$num_to      = $this->curpage * $this->std->settings[$this->mod_name.'_count_on_page'];  // �� ������ ������ �������, ������������
		$num_from    = $num_to - $this->std->settings[$this->mod_name.'_count_on_page'];                // �� ������ ������, ������������
		

		$body = '';
		$curnum = 0;

		// ���� �� �������, ������� ���� �������� ����� ��� ������
		foreach ($this->session['objects'] as $obj)
		{
			// ��� ����������, �� ������������
			if ($curnum+$obj['rows_count'] < $num_from)
			{
				$curnum += $obj['rows_count'];// ����������� ������� �������
			}
			elseif($curnum <= $num_to)
			{

				// ���� �� ���������� ����� ID
				foreach ($obj['rows'] as $id)
				{

					if (($curnum < $num_from)){
						$curnum++;
					}
					else
					{

						// ���� ������� ������� �� ������ ���� ������ (���� ��� ����� �� �������� ��������� ���������)
						if  (($curnum < $num_to) && ($curnum >= $num_from))
						{
							$body .= $this->getItem($obj['name'], $id['id'], $curnum+1);  // �������� ���������
						}
						elseif ($curnum > $num_to) // ���� ����� �� ����
						{
							break; // ����� �� �����
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
	 * ������ ���� ����� ����������
	 *
	 * @param unknown_type $module        - �������� ������
	 * @param unknown_type $id            - ������������� �������
	 * @param unknown_type $num           - ������� ����� ������������ ������ ����������
	 * @return unknown                    - ���� ����������� �����
	 */
	function getItem($module, $id, $num)
	{
		$res        = '';

		

		$sql = "SELECT id, pid, alias,  ".implode(', ', $this->fields)." FROM se_{$module} WHERE id ='".$id."' LIMIT 1";

		if ($this->db->query($sql, $rows) > 0)
		{
			$row = $rows[0];
			$row['num'] = $num;

			
			# ������� ������� �� ����� ��� ������ �� �����
			$row['body']        = preg_replace('#\n#is', '', strip_tags($row['body']));
			$this->word  = strtolower($this->word);

			
			
			#-------------------------------------------------
			# ��������� ������ �� �������� � ��������� ������
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
				# ����� ��������� �������
				
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

				
				
				// �������� �������� ����� � ������
				if( strlen( substr( $body, 0, $first_pos) )  < $this->std->settings[$this->mod_name.'_cut_count'] )
				{
					$right_pos = ($right_pos + $this->std->settings[$this->mod_name.'_cut_count']) > (strlen( $body ) - 1) ?
					(strlen( $body ) - 1) :
					($right_pos + $this->std->settings[$this->mod_name.'_cut_count']);
					$first_pos = 0;
					$start     = '';
				}

				// ���� �������� �������� ����� � �����
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

			// ������ ��� � index - �������
			$alias = trim($row['alias']);
			$alias = preg_replace('#/index/$#is', '', $alias);


			$row['title']       = preg_replace("#$this->word#","<b>$this->word</b>", $row['title']);
			$row['body']        = preg_replace("#$this->word#","<b>$this->word</b>",$body);
			$row['host']		= $this->std->host;
			
			
			$res        = $this->strtr_mod($this->skin['item'], $row);  // �����

			
		}

		return $res;
	}

	/**
	 * ��������� ������ � �������, � ������� �������� �����, � ��� �� ��������� ������ ��������������� ������ �������,
	 * � ������� ���������� ��������� �����
	 *
	 * @param unknown_type $searchword
	 */
	function searchData()
	{

		$objects    	= array(); // ���������� �� �������� ������
		$total_count	= 0; // ����� ���������� �����������
		

		// ���������� ������ ������������� �������� �������, � ������� � ����� ������		
		$need_search = array();
		$sql = "SELECT * FROM se_modules
				WHERE is_active = 1 AND is_default_in_system = 0 AND need_search = 1";
		if ($this->db->query($sql, $modules))
		foreach ($modules as $mod)
		{
			$need_search[] = $mod;
		}		
		

		# ���� ���������� � ��������, � ������� ����� ����� �����
		if (count($need_search) > 0)
		{
			#--------------------------------------------------------------------
			# ��������� � ���������� ��������� ���� ������������ � ���� �������
			#--------------------------------------------------------------------
			$where = array(); 
			foreach ($this->fields as $fields)
			{
				$where[] = $fields." LIKE '%".$this->word."%'"; 
			}
			
			$where = implode(' OR ', $where);
			
			
			
			
			#--------------------------------------------------------------------
			# ����� �� �������� �������
			#--------------------------------------------------------------------
			foreach ($need_search as $mod)
			{
				// ����� �� ��������� �������
				$sql = "SELECT id FROM ".$this->db->dbobj['sql_tbl_prefix'].$mod['modulename']." WHERE is_active = 1 AND ({$where})  ORDER BY timestamp DESC";

				
				$count = $this->db->query($sql, $rows);
				if ($count > 0)
				{
					// � ������ �������� ��������� ��������� �������-������, � ������� �������� ����� �� body � � ������� ���� ���������� ������
					// ������, � ������� ���������� �����, ��� � ������� ��� ���������� ������ - �����������
					
					$objects[ $mod['modulename'] ]                      = array();            // ������ � ���������� � ����������� ������
					$objects[ $mod['modulename'] ]['rows_count']        = $count;        // ���������� � ���������� �����������
					$objects[ $mod['modulename'] ]['name']        		= $mod['modulename'];        // �������� ������
					$objects[ $mod['modulename'] ]['rows']              = $rows;            // ����������. �������� ������ id ������, �� �� ��� ����� ����� �������� ������ � ������ � ����

					$total_count += $count;
				}
			}
		}

		
		
		// ��������� ������ � ������ ������������
		$this->session['objects'] = $objects;
		$this->session['count'] = $total_count;

		$this->std->updateSession( $this->std->member['session_id'], 'update', array($this->mod_name => $this->session));
		

		unset($objects, $total_count, $need_search, $mod);
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

	function getArrows()
	{
		return $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $this->session['count'],
                                                          'PER_PAGE'     => $this->std->settings['search_count_on_page'],
                                                          'CUR_ST_VAL'   => $this->curpage,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "��������: ",
                                                          'BASE_URL'     => '/search',
                                                          'leave_out'    => $this->std->settings['arrows_around'],
                                                          'IGNORE_REVERT'=> 1,
		) );
	}


}
?>