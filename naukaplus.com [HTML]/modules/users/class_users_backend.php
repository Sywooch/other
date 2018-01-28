<?php

#
# ����� ������������ ����� ����������� �������
#


require_once 'class_abstract.php';  // ����������� �����

class class_users_backend extends class_abstract 
{
	
	/**
	 * ����������� ������, �������������
	 *
	 * @param unknown_type $mod_name	- �������� ������
	 * @param unknown_type $std			- ������ �� ����� ����� �������
	 * @return class_parent
	 */
	function __construct( $mod_name, $std )
	{		
		$this->mod_name		= $mod_name;
		$this->std			= $std;
		$this->db			= &$std->db;
		$this->table		= $this->db->dbobj['sql_tbl_prefix'].$mod_name;
		$this->filepath	= $this->std->config['path_files'].'/'.$this->mod_name;
		
		$this->curid = -1;
		if (isset($this->std->alias[3]))
		{
			$this->curid = $this->std->StringToInt($this->std->alias[3]);			
		}
	}

	/**
	 * ����������
	 *
	 */
	function __destruct()
	{
		
	}



	/**
	 * ����������� ������� ������ - �������� ��� ����������� �����������, ���������� ������ ������
	 *
	 */
	public function main()
	{
		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[1] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}
		
		
		
		# ����������� ����� � ��������� ���������� ������
		if (file_exists( $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php' ))
		{
			require_once $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php';
			$this->skin = &$skin;
		}
		
		
		
		# ������������� ����������, ������� ����� �������������� � ������ ���� ������������
		# �� ������ ������ ��������� �����
		$this->beforeProcess();
		
		
		# ������������ ���� ������
		$this->setModMenu();
		
		# ����� ����������� ������������� ��������
		$this->selectAction();
		
		
		# ����� ���� �����
		$this->afterProcess();
	}
	
	

	

	

	/**
	 * ����� ����������� ������������� ��������
	 *
	 */
	public function selectAction()
	{
		# ������ ����� �������, ����� ������� �������������
		if (isset($this->std->alias[2]))
		{
			switch ($this->std->alias[2])
			{
				case 'list':
					$this->getNodesList();
					break;
				case 'add':
					$this->add_do();					
					break;
				case 'edit':
					$this->edit_do();
					break;
				case 'del':
					if ($this->del_do()) $this->getNodesList();
					break;
				case 'active':
					if ($this->active_do()) $this->getNodesList();
					break;
				

				default:
					$this->log('���������� ������ "'.$this->std->alias[2].'". ��� ������� �� �������� ����������');
					$this->getNodesList();
			}
		}
		else
		{
			# ������� �������� ������ � �������
			$this->getNodesList();
		}
	}	
	
	
	

	/**
	 * ������������ ���� ������
	 *
	 */
	public function setModMenu()
	{
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/"><b>'.$this->std->modules_all[$this->mod_name]['title'].'</b></a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/add/"><b>��������</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/noactive/">����������</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/ban/">���</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/novalid/">���������������</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/modif/">�����������������</a>&nbsp;&nbsp;');		
				
	}
	
	
	
	
	
	#---------------------------------------------------
	# ����� : ����� ������ �������������
	#---------------------------------------------------
	

	/**
	 * ������������ ������ ������ ������ ������
	 *
	 */
	public function getNodesList()
	{
		$res = '';

		
		# ����� ���� ������ ������ ��� ��������� �������������
		$where = '1';
		$type = 'all';
		if (isset($this->std->alias[3]))
		{
			$type = $this->std->alias[3];
			switch ($this->std->alias[3])
			{				
				case 'noactive':
					$where = 'user_is_active = 0';
					break;
				case 'ban':
					$where = 'user_is_ban = 1';
					break;
				case 'novalid':
					$where = 'user_is_valid = 0';
					break;
				case 'modif':
					$where = 'user_is_modif = 1';
					break;
				
				default:
					$where = '1';
					break;
			}
		}
		
		
		
		# ��������� �������
		$page_start = 0;
		if ( isset($this->std->alias[4]) )
        {
			if ( strstr( $this->std->alias[4], "page" ) )
			{
				$page_start = str_replace( "page", "", $this->std->alias[4])-1;
				unset( $this->std->alias[4]);
			}
        }
		
		
		$sql = "SELECT count(*) as count_items FROM {$this->table} WHERE {$where}";
		$this->db->query($sql, $rows);
		$count = $rows[0]['count_items'];		
		$arrows =  $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $count,
                                                          'PER_PAGE'     => $this->std->settings['arrows_items_on_page'],	// ������� �� ��������
                                                          'CUR_ST_VAL'   => $page_start+1,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "��������: ",
                                                          'BASE_URL'     => '/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$type.'/',
                                                          'leave_out'    => $this->std->settings['arrows_around'], // ������� ����� ���������� �������
                                                          'IGNORE_REVERT'=> 0,
                                                      ) );		
			
		$limit = " LIMIT ".($this->std->settings['arrows_items_on_page']*$page_start).", ".$this->std->settings['arrows_items_on_page'];
		
		
		
		
		# ������ ������ ������ ������ ������
		$sql = "SELECT * FROM {$this->table} WHERE {$where} ORDER BY user_access {$limit}";
		if ($this->db->query($sql, $rows) > 0)
		{
			$res .= $this->getNodesListBegin();
			$row_count = count($rows);
			$i = 0;
			foreach ($rows as $row)
			{
				$res .= $this->getNodesListItem($row, $row_count, $i);
				$i++;
			}
			$res .= $this->getNodesListEnd();
		}
		else
		{
			$res .= '<h2>������� �� �������</h2>';
		}
			
		$this->updatePul('body', $res.$arrows);
	}
	
	
	/**
	 * ������ ������� �� ������� �������������
	 *
	 * @return unknown
	 */
	function getNodesListBegin()
	{
		return '<form method="post">
				<table class="work_tab" width=90%>
				<tr>						
					<th colspan="2" width="20%"></th>
					<th align="left">�����</th>
					<th align="left">E-mail</th>
					<th align="left">������</th>						
					<th></th>						
				</tr>';
	}
	
	/**
	 * ��������� ������� �� ������� �������������
	 *
	 * @return unknown
	 */
	function getNodesListEnd()
	{
		return '</table>
				</form>';
	}
	

	/**
	 * ������
	 *
	 * @return unknown
	 */
	public function getNodesListItem($replace, $row_count, $i)
	{
		$replace['color'] = $replace['user_is_active'] == 1 ? 'CCFFCC' : 'dedede';
		$replace['is_active_src'] = $replace['user_is_active'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/play.png' : '/'.$this->std->config['folder_admin'].'/image/stop.png';
		$replace['is_active_title'] = $replace['user_is_active'] == 1 ? '��������������' : '������������';				
		$replace['user_access'] = $this->std->config['access'][$replace['user_access']];
		$replace['is_active_disabled'] = (($replace['parent_active'] == 0) && (!is_null($replace['parent_active']))) ? 'disabled' : '';
		$replace['order_button'] = $this->std->order_button($row_count, $i, $replace['id'], $replace, $this->mod_name);


			
		
	
		$item = '<tr style="background:#{color};">
					<td align=center width="5%"><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{user_id}/" title="�������������"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a></td>					
					<td align=center width="5%"><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/active/{user_id}/"><img src="{is_active_src}" title="{is_active_title}"></a></td>					
					<td>{user_name}</td>
					<td>{user_email}</td>
					<td>{user_access}</td>
					<td align=center><a href="javascript:doConfirm(\'������� ������������?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{user_id}/\')" title="�������"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return $this->strtr_mod($item, $replace);
	}


	

	/**
	 * ������������ ������ �������
	 *
	 * @param unknown_type $id  - ������������� �������
	 * @return unknown
	 */
	protected function getNodeById($id)
	{
		# ������ ������ � �������
		$sql = "SELECT * FROM {$this->table} WHERE user_id='{$id}'";
		if ($this->db->query($sql, $rows) > 0)
		{
			if ($rows[0]['user_cache'] != '')
			{
				$rows[0] = array_merge($rows[0], unserialize($rows[0]['user_cache']));
			}
			return $rows[0];
		}
		
		return false;
	}
	
	
	#---------------------------------------------------
	# ����� : ����� ������ �������������
	#---------------------------------------------------
	

	
	
	#---------------------------------------------------
	# ��������� � ��������
	#---------------------------------------------------
	


	/**
	 * ����������� �������� ������� � ���� � ��������
	 *
	 * @param unknown_type $id                - ������������� �������
	 * @param unknown_type $delnode        - ������� �� ���� �������? 1 - ���
	 */
	public function del_do()
	{
		# �������� ������ � �������, ������� ���������/������������
		if ($node = $this->getNodeById($this->curid))
		{	
			# ��������� �������� ����� ��������� ������������
			$this->preDel($node);
			
			
			$sql = "DELETE FROM {$this->table} WHERE user_id='{$node['user_id']}'";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">������������ �� ������</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">��������� � ������</a>');
		}
			

		return false;
	}
	
	
	/**
	 * ��������� �������� ����� ��������� ������������
	 *
	 * @param unknown_type $node
	 */
	function preDel($node)
	{
		# ����� ����������� � �������
	}


	/**
	 * ����������� ���������/����������� ������
	 *
	 */
	protected function active_do()
	{
		# �������� ������ � �������, ������� ���������/������������
		if ($node = $this->getNodeById($this->curid))
		{
			$sql = "UPDATE {$this->table} SET user_is_active = (user_is_active XOR 1) WHERE user_id='{$node['user_id']}'";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">������������ �� ������</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}
			

		return false;
	}
	
	
	#---------------------------------------------------
	# ����� : ��������� � ��������
	#---------------------------------------------------
	
	
	
	
	
	
	#---------------------------------------------------
	# ���������� � �������������� �������������
	#---------------------------------------------------
	
	
	
	/**
	 * ���������� ����� ������� � ��������
	 *
	 */
	public function add_do()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			# ������ ����� - ����� ���������

			# ��� ������ ����� ��� ������ � ������� �� ������������ ����������
			$error = $this->validInput();
			

			
			# ���������, �� ��������������� �� ��� ������������ � ����� �������		
			$sql = "SELECT * FROM {$this->table} WHERE user_name = '{$this->input['user_name']}'";
			if ($this->db->query($sql, $rows) > 0)
			{
				$error .=  '������������ � ������� "'.$this->input['user_name'].'" ��� ���������������<br>';
			}
			
					
			# ���������, �� ��������������� �� ��� ������������ � ����� email-��
			$sql = "SELECT * FROM {$this->table} WHERE user_email = '{$this->input['user_email']}'";			
			if ($this->db->query($sql, $rows) > 0)
			{
				$error .=  '������������ � �������� ������� "'.$this->std->input['user_email'].'" ��� ���������������<br>';
			}
			
			$this->std->setPul('admin', 'error', $error);
			

			if ($error != '')
			{
				# ���� ������, ������� ����� ��������� ����� � ���������� ��� �����������

				# �� ������ �����
				$this->input['user_is_active'] = $this->input['user_is_active'] == 1 ? 'checked' : '';				
				$this->input['user_rectime'] = $this->std->getSystemTime($this->input['user_rectime']);
			

				# ����� �����
				$this->setPul('error', $error);
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				
				# ��������������� ������ ����� ��������� � ��������������� ������
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$this->input['user_cache'] = serialize($cache);
				
				
				#----------------------------------------------
				# ������ ���������, ����� ���������
				#----------------------------------------------				
				$this->db->do_insert($this->mod_name, $this->input);
				
				
				
				# �������� ���� ����� ������
				$this->curid = $this->db->get_insert_id();
				
				
				# �������� ����������� ��������� �������������� ��������, �������� ����������
				$this->add_doAfterSave($this->input);

				$this->std->setPul('admin', 'info', '<b>��������� ���������</b><br>
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curid.'/">�������������</a>&nbsp;&nbsp;
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">��������� � ������</a>');
			}
		}
		else
		{
			# ������� �����
			# ������� ��������� �������� ������ ��� �����
			$pms['user_rectime'] = $this->std->getSystemTime();		
			$pms['user_is_active'] = 'checked'; 
			
			
				
			# ����� ����� ���������� ������������
			$this->add_form($pms);
			$this->add_doPreRender($pms);
			$this->replacePul('body', $pms);		
			$this->updatePul('body', $this->endRender($this->getPul('body')));
			$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}
	}
	
	
	/**
	 * ���������� ������ � ������ ����� ������� ����� ����������� ����� �������
	 *
	 * @param unknown_type $pms
	 */
	public function add_doPreRender(&$pms)
	{
		
	}

	/**
	 * ��������� ������ ����� �����������
	 *
	 * @param unknown_type $pms
	 */
	public function add_doAfterSave(&$node)
	{			
		# ��������� ����������� � �������
	}

	
	/**
	 * �������������� �������
	 *
	 */
	public function edit_do()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			# ������ ����� - ����� ���������

			# ��� ������ ����� ��� ������ � ������� �� ������������ ����������
			$error = $this->validInput();
			$this->std->setPul('admin', 'error', $error);

			if ($error != '')			
			{
				# ���� ������, ������� ����� ��������� ����� � ���������� ��� �����������

				# �� ������ �����
				$this->input['user_is_active'] = $this->input['user_is_active'] == 1 ? 'checked' : '';
				$this->input['user_rectime'] = $this->std->getSystemTime($this->input['user_rectime'], 'd.m.Y');


				# ����� ����� ���������� �������				
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				
				#----------------------------------------------
				# ������ ���������, ����� ���������
				#----------------------------------------------
				$this->edit_doPreSave($node);
				
				# ��������������� ������ ����� ��������� � ��������������� ������
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$this->input['user_cache'] = serialize($cache);
				
				$this->db->do_update($this->mod_name, $this->input, "user_id = '{$this->curid}'");



				$this->saveDone();
			}
		}
		else
		{
			# ������ ������ � ������������� ��������
	
			if ($node = $this->getNodeById($this->curid))
			{
				
				$node['user_is_active'] = $node['user_is_active'] == 1 ? 'checked' : '';				
				$node['user_rectime'] = $this->std->getSystemTime($node['user_rectime']);
	
	
				# ����� ����� ���������� �������
				$this->add_form($node);
				$this->edit_doPreRender($node);
				$this->replacePul('body', $node);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
				$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
			}
		}
	}
	
	public function saveDone()
	{
		$this->std->setPul('admin', 'info', '<b>��������� ���������</b><br>
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curid.'/">�������������</a>&nbsp;&nbsp;
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">��������� � ������</a>');
	}
	
	
	/**
	 * ���������� ������ � ������ ����� ������� ����� �������������� �������
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreRender(&$node)
	{
		# ����������� � �������
		
	}
	
	
	/**
	 * ��������� ������ ����� �����������
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreSave(&$node)
	{
		# ����������� � �������
		
	}
	
	
	
	/**
	 * �������������� ���������� �� ����� ������
	 *
	 */
	public function validInput()
	{	
		$this->input['user_is_active'] 		= isset($this->std->input['user_is_active']) ? 1 : 0;
		$this->input['user_name'] 			= $this->std->input['user_name'];
		$this->input['user_pass'] 			= $this->std->input['user_pass'];
		$this->input['user_access']			= $this->std->input['user_access'];
		$this->input['user_email'] 			= $this->std->input['user_email'];		
			
		$this->input['user_rectime'] 		= $this->std->getTimeStamp($this->std->input['user_rectime']);
		$this->input['user_lastmod'] 		= $this->std->getTimeStamp($this->std->input['user_lastmod']);		
		
		$this->input['user_about'] 			= $_POST['user_about'];	

		#-----------------------------------
		# �������� ������
		#-----------------------------------
		
		/*if ($this->input['user_name'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">�� ��������� ���� "�����"</font>');
		}
		
		if ($this->std->email_validate($this->input['user_email']) == '')
		{
			$this->std->setPul('admin', 'error', '<br><font color="red">������� ��������� ���� E-mail</font>');
		}*/
		
		
		
		
		if ($this->input['user_name'] == '')
		{
			$res .= '�� �� ��������� ���� "�����"<br>';
		}
		
		if ($this->input['user_email'] == '')
		{
			$res .= '�� �� ��������� ���� "E-mail"<br>';
		}
		elseif ($this->std->email_validate( $this->input['user_email']) == '')
		{
			$res .= '�� ������� ��������� ���� "E-mail"<br>';
		}
		
		
		
		
		# �������� ������������� ����������� �����
		$cache = array();
		foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
		{
			if (isset($this->std->input[$key]) && ($this->skin['reg_form_extend_necessary'][$key] != ''))
			{				
				$res .= $this->std->input[$key] == '' ? $value : '';
			}
			
			$cache[$key] = $this->std->input[$key];
		}
		
		
		
		
		
		
		
		return $res;
	}
	
	
	

	/**
	 * ������������ ����� ���������� ����� ������� � ��������
	 *
	 */
	public function add_form(&$node)
	{		
		$form = '		
					<form method=post enctype=multipart/form-data>
					<table border=0 width=90%>

                        <tr>
                        <td align=right>������������ �����:</td>
                        <td width=80%><input type="checkbox" name="user_is_active" {user_is_active}></td>
                        </tr>
                        
                                               
                        <tr title="����������� �� ����������">
                        <td align=right><font color=red>*</font> �����:</td>
                        <td><input type=text name="user_name" value="{user_name}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                               
                        <tr title="����������� �� ����������">
                        <td align=right><font color=red>*</font> ������:</td>
                        <td><input type=text name="user_pass" value="{user_pass}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                                
                        <tr title="����������� �� ����������">
                        <td align=right><font color=red>*</font> E-mail:</td>
                        <td><input type=text name="user_email" value="{user_email}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                               
                        <tr title="����������� �� ����������">
                        <td align=right ><font color=red>*</font> ��� �������:</td>
                        <td>
                        	<select name="user_access">
                        		'.$this->getUserAccess($node['user_access']).'
                        	</select>
                        
                        </td>
                        </tr>
                        
                        
                       
                                              
                        
                        <!-- ����� ��� ����� �������, ������� ����� ��������� � �������� -->
                		{extend}
                        
                        
                		
                		
                		<!-- ����� � ��������������� ���������� -->
                		<tr onClick="$(\'#disp\').slideToggle(\'slow\');">
                        <td align=right valign=top></td>
                        <td><a style="cursor:hand; cursor:pointer; text-color:red;">������������� >>></a></td>                        
                        </tr>                        
                        
                	</table>	
                		
                		
                    <div id="disp" style="display:none;">    
                	<table border=0 width=90%>
                	
                		<!-- ����� ��� ����� �������, ������� ����� ��������� � �������� -->
                		{extend_hide}
                	
                	
                        <tr>
						<td align=right valign=top>��������� �������� ������������</td>
						<script type="text/javascript" src="/'.$this->std->config['folder_admin'].'/editor/fckeditor.js"></script>
						<script type="text/javascript">
                        	window.onload = function() 
                        	{
                        		var oFCKeditor = new FCKeditor( \'user_about\', \'100%\', \'100%\' );
                        		oFCKeditor.BasePath = "/'.$this->std->config['folder_admin'].'/editor/" ;
                        		oFCKeditor.ReplaceTextarea() ;
							}
                        </script>
                        <td width=80% height=200><textarea rows=37 cols=80 name=user_about >{user_about}</textarea></td>
                		</tr>
                		
                		    
                        <tr>
                        <td align=right>���� �������� ������:</td>
                        <td><input type="text" name=user_rectime value="{user_rectime}"> (��.��.���� ��:��)</td>
                        </tr>
                        
                        <tr>
                        <td align=right>���� ��������� ��������:</td>
						<td><input type=text name=user_lastmod value="'.$this->std->getSystemTime().'" disabled></td>
                        </tr>

                                               
                        <tr>
                        <td align=right>������ � ������� � �������:</td>
						<td>-----------</td>
                        </tr>
                        
                        
                        <tr>
                        <td align=right>������ � ������� � ���������������� �����:</td>
						<td>-----------</td>
                        </tr>
                        
			            
					</table>
					</div>
					
					
					<input type=submit value="���������" class=f2>
					</form>	
                ';
		
		
		$form = str_replace('{extend}', $this->skin['reg_form_extend'], $form);
		$this->setPul('body', $form);
	}
	
	
	/**
	 * ��� ����� �������������� ������� ��������� ������ �������� �������
	 *
	 * @param unknown_type $id
	 */
	function getUserAccess($access)
	{
		$res = '';
		
		foreach ($this->std->config['access'] as $key => $value)
		{
			if ($access == $key)
			{
				$res .= '<option value="'.$key.'" selected>'.$value;
			}
			else
			{
				$res .= '<option value="'.$key.'">'.$value;
			}
			
		}
		
		
		return $res;
	}
	
	
	#---------------------------------------------------
	# ����� : ���������� � �������������� �������������
	#---------------------------------------------------
	
	
	
	
	
	

}


?>