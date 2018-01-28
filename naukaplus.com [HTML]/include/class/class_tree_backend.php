<?php
require_once 'class_tree.php';


/**
 * ������� - ������ � ���������� ����������
 *
 */
class class_tree_backend extends class_tree
{
	/** ������ ����� ��� ����������  */
	public $input = array();
	
	public $menu_ids = array();

	/**
	 * ����������� ������� ������ - �������� ��� ����������� �����������, ���������� ������ ������
	 * ���������������
	 */
	public function main()
	{
		# ������ ����� �������, ������ ����� ������� �����
		$this->std->setPul('admin', 'menu_addmod', '<li><a class=menu href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/">'.$this->std->modules_all[$this->mod_name]['title'].'</a></li>');
		
		
		parent::main();
		
		

		# �������������� ����������, ������� ������ ����, ����������
		# �� ������������ ������� ��������� ���������� ������
		# ����� ����� ���



		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[1] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}
		
		
		# ���������
        $this->std->setPul('admin', 'h1', $this->std->modules_all[$this->mod_name]['title']);
		


		# ����������� ������������� ��������������
		if (!isset($this->std->alias[3]))
		{
			# ���� �������� ���: /admin/������/
			# ������ ����� ������� ������� ������� ������ �����������
			$this->curpid = -1;
		}
		else
		{
			//$this->curpid = $this->std->MixedToInt($this->std->alias[3]);
			$this->curpid = $this->std->alias[3];
			$this->curpid = $this->curpid == '' ? -1 : $this->curpid;
		}

		# ����������� �������������� �������
		if (isset($this->std->alias[4]))
		{
			# ���� �������� ���: /admin/������/
			# ������ ����� ������� ������� ������� ������ �����������
			//$this->curid = $this->std->MixedToInt($this->std->alias[4]);
			$this->curid = $this->std->alias[4];
			$this->curid = $this->curid == '' ? NULL : $this->curid;
		}
		

		#------------------------------------------------------------------------------------------------------
		#------------------------------------------------------------------------------------------------------
		
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
					$this->getNodesListByPid();
					break;
				case 'add':
					
					if ($this->add_do()) {						 
						$this->clearCache();
						$this->addTreeToMenu();
					}					
					break;
				case 'edit':					
					if ($this->edit_do()) {						 
						$this->clearCache();
						$this->addTreeToMenu();
					}
					break;
				case 'del':
					if ($this->del_do()) {
						$this->delAnalog();
						$this->clearCache();
						$this->addTreeToMenu();
						$this->getNodesListByPid();						
					}
					break;
				case 'active':
					if ($this->active_do()) { 
						$this->clearCache();
						$this->addTreeToMenu();
						$this->getNodesListByPid();
					}
					break;
				case 'best':
					if ($this->best_do()) {
						$this->clearCache();
						$this->addTreeToMenu();
						$this->getNodesListByPid();
					}					
					break;				
				case 'multi_action':
					$this->multi_action();
					break;
				case 'photodel':
					$this->photodel_do();
					$this->saveDone($this->curpid);
					break;
				case 'photomultiupload':
					if ($this->photomultiupload_do()) $this->getNodesListByPid();
					$this->addTreeToMenu();
					break;
				case 'analog':
					echo $this->getAnalogFormListItem($this->std->alias[3]);
					exit;
					break;
				case 'analog_del':
					echo $this->delAnalog($this->std->alias[5]);
					$this->saveDone($this->curpid);
					break;

				default:
					$this->log('���������� ������ "'.$this->std->alias[2].'". ��� ������� �� �������� ����������');
					$this->getNodesListByPid();
			}
		}
		else
		{
			# ������� �������� ������ � �������
			$this->getNodesListByPid();
		}
	}


	/**
	 * ������������ ���� ������
	 *
	 */
	public function setModMenu()
	{
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/">'.$this->std->modules_all[$this->mod_name]['title'].'</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/add/'.$this->curpid.'/">��������</a>&nbsp;&nbsp;');

		if ($this->curpid != -1)
		{
			if ($node = $this->getNodeById($this->curpid))
			{
				$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$node['pid'].'/">����</a>&nbsp;&nbsp;');
			}
		}
	}
	
	
	
	/**
	 * �������� �������� ��� �������� ��������
	 *
	 */
	public function multi_action()
	{
		if (isset($this->std->input['action']))
		{
			switch ($this->std->input['action'])
			{
				case 'order':
					$this->order_do();
					$this->getNodesListByPid();
					$this->addTreeToMenu();
					$this->clearCache();
					break;
				case 'active':
					if ($this->active_do()) {
						$this->getNodesListByPid();
						$this->addTreeToMenu();
						$this->clearCache();
					}					
					break;
				case 'best':
					if ($this->best_do()){ 
						$this->getNodesListByPid();
						$this->addTreeToMenu();
						$this->clearCache();
					}					
					break;
				case 'del':
					if ($this->del_do()) {
						$this->getNodesListByPid();
						$this->addTreeToMenu();
						$this->clearCache();
					}						
					break;
					
				default:
					$this->getNodesListByPid();
			}
		}
	}



	#-----------------------------------------------------------------------
	# ����� ������ ������ ������ ������
	#-----------------------------------------------------------------------

	/**
	 * ��������� ��� ������� ������ ������
	 *
	 * @return unknown
	 */
	public function getNodesListTitles()
	{
		return '
				<table class="work_tab" width=90%>
					<tr>
						<form action="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/multi_action/'.$this->curpid.'/" method="post">
						<th colspan="5" width="20%" align="left">
							<select name="action">
								<option value="order">��������
								<option value="active">�����/�������
								<option value="best">��������
								<option value="del">�������
							</select>
							<input type="submit" value="��">
						</th>
						<th>��������</th>
						<th width="10%">�������</th>						
						<th width="5%">&nbsp;</th>
						
					</tr>
				<form action="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/order/'.$this->curpid.'/" method="post">
				';
	}

	/**
	 * ��������� ��� ������� ������ ������
	 *
	 * @return unknown
	 */
	public function getNodesListFooter()
	{
		return '</table>
				<table border=0 width=90%>
					<tr><td align="right"><input type="submit" value="��������� �������"></td></tr>
				</table>
				</form>';
	}


	
	
	
	
	/**
	 * ������
	 *
	 * @return unknown
	 */
	public function getNodesListItem($replace, $row_count, $i)
	{
		$replace['color'] = $replace['is_active'] == 1 ? 'CCFFCC' : 'dedede';
		$replace['alias'] = $this->getAliasByPid($replace);
		$replace['is_active_src'] = $replace['is_active'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/play.png' : '/'.$this->std->config['folder_admin'].'/image/stop.png';
		$replace['is_active_title'] = $replace['is_active'] == 1 ? '��������������' : '������������';
		$replace['is_best_src'] = $replace['is_best'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/best_active.png' : '/'.$this->std->config['folder_admin'].'/image/best_inactive.png';
		$replace['is_best_title'] = $replace['is_best'] == 1 ? '������ �� ������ ����������' : '�������� � ������ ����������';		
		$replace['is_active_disabled'] = (($replace['parent_active'] == 0) && (!is_null($replace['parent_active']))) ? 'disabled' : '';
		$replace['order_button'] = $this->std->order_button($row_count, $i, $replace['id'], $replace, $this->mod_name);


		$pms = array();
		foreach ($replace as $key => $value)
		{
			$pms['{'.$key.'}'] = $value;
		}
		
		# ������������ ����
		if ($replace['img'] == '')
		{
			$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="�������������"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a>';
		}
		else
		{
			$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="�������������"><img src="/'.$this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$replace['img'].'/'.$replace['id'].'_th.jpg"></a>';
		}
		
		
		# ������ �� ��������� ��������� �������
		$tree = '-';
		if ($this->std->settings[$this->mod_name.'_levels'] != 1)
		{			
			# ���� ���������� ����, ����� ���������� � �������� ��������
			if ($replace['is_sheet'] == '0')
			{
				$tree = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/{id}/" title="������ ������������"><img src="/'.$this->std->config['path_admin'].'/image/catalog.png"></a>';
			}
		}
		
		
		 
		

		$item = '<tr style="background:#{color};">
					<td align=center><input name="action[{id}]" type="checkbox" title="�������"></td>
					<td align=center>'.$edit.'</td>
					<td align=center>'.$tree.'</td>
					<td align=center><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/best/{pid}/{id}/"><img src="{is_best_src}" title="{is_best_title}"></a></td>					
					<td align=center><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/active/{pid}/{id}/"><img src="{is_active_src}" title="{is_active_title}"></a></td>					
					<td>{title} (<a href="{alias}" target="_new">��������</a>)</td>					
					<td align=center><input type="text" name="item_order[{id}]" value="{item_order}" size="3"></td>
					<td align=center><a href="javascript:doConfirm(\'������� ���������?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{pid}/{id}/\')" title="�������"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return strtr($item, $pms);
	}
	
	
	
	
	
	

	/**
	 * ������������ ������ ������ ������ ������
	 *
	 */
	public function getNodesListByPid()
	{
		$res = '';

		# ������ ������ ������ ������ ������
		$sql = "SELECT t1.*, t2.is_active AS parent_active FROM {$this->table} t1
				LEFT JOIN {$this->table} t2 ON (t1.pid = t2.id)
				WHERE t1.pid='{$this->curpid}' ORDER BY t1.item_order";
		if ($this->db->query($sql, $rows) > 0)
		{
			$res .= $this->getNodesListTitles();
			$row_count = count($rows);
			$i = 0;
			foreach ($rows as $row)
			{
				$res .= $this->getNodesListItem($row, $row_count, $i);
				$i++;
			}
			$res .= $this->getNodesListFooter();
		}
		else
		{
			# �����
			$this->std->setPul('admin', 'info', '<b>������ ����</b> (<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/add/'.$this->curpid.'/">�������� ������</a>)');

		}
			
		$this->updatePul('body', $res);
		
		
		
		
		# ���� ���������� �� ������� ������, �� ����� � �������� ������� ������
		if ($this->curpid != -1)
		{
			$pms = array(
						'{mod_name}' => $this->mod_name,
						'{mod_name}' => $this->mod_name,
						'{file_size}' => $this->std->settings['file_size'],
						'{file_size_mb}' => $this->std->settings['file_size'] / 1000000,
						'{folder_admin}' => $this->std->config['folder_admin'],
						'{curpid}' => $this->curpid,
						'{folder_templates}' => $this->std->config['folder_templates']
			
						);
			# ������ ����� ���� �� ������������ t_config
			$form = strtr($this->skin['photomultiupload_form'], $pms);
			
			$this->std->setPul('admin', 'info', $form);
		}		
		
	}








	#-----------------------------------------------------------------------
	# �����: ����� ������ ������ ������ ������
	#-----------------------------------------------------------------------


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
			$this->validInput();


			if ($this->std->getPul('admin', 'error') != '')
			{
				# ���� ������, ������� ����� ��������� ����� � ���������� ��� �����������

				# �� ������ �����
				$this->input['is_active'] = $this->input['is_active'] == 1 ? 'checked' : '';
				$this->input['is_redirect'] = $this->input['is_redirect'] == 1 ? 'checked' : '';
					

				# ����� ����� ���������� �������
				$this->add_form();
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				# ���������� ���������� ����� ����������� �������
				$this->initTree();
				$count_childs = count($this->pid[$this->curpid]);
				++$count_childs;
				$this->input['item_order'] = $this->std->settings[$this->mod_name.'_typeadd'] == 1 ? 0 : 100000;  // ��������� ������/�������� ������� ����������


				#----------------------------------------------
				# ������ ���������, ����� ���������
				#----------------------------------------------				
				$this->db->do_insert($this->mod_name, $this->input);
				
				
				
				# �������� ���� ����� ������
				$this->curid = $this->db->get_insert_id();
				# �.�. �� �� ��� ��� ���������� ���� alias, �� ����� ��� ���������
				$this->db->do_update($this->mod_name, array('alias' => $this->curid), 'id='.$this->curid);
				
				# � �������� ����������� ��������� �������������� ��������, �������� ����������
				$this->input['id'] = $this->curid;
				$this->add_doAfterSave($this->input);
				


				# ��������� ������/�������� ������� ����������				
				$this->order_do();
				$this->addTreeToMenu();

				$this->std->setPul('admin', 'info', '<b>��������� ���������</b><br>
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curpid.'/'.$this->curid.'/">�������������</a>&nbsp;&nbsp;
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
				
				return true;
			}
		}
		else
		{
			# ������� �����
			# ������� ��������� �������� ������ ��� �����
			
			
	
			# ���� ������ ���������, �� ������ ������ ����������� ������������ ������ ������ ������������� �������
			$pms = array();
			$pms['is_active_disabled'] = '';
			$pms['is_active'] = 'checked';
			if (($this->curpid != -1) && ($parent = $this->getNodeById($this->curpid)))
			{
				if ($parent['is_active'] == 0)
				{
					$pms['is_active_disabled'] = $parent['is_active'] == 0 ? 'disabled' : '';
					$pms['is_active'] = '';
				}
			}
			$pms['timestamp'] = $this->std->getSystemTime();
	
	
			# ����� ����� ���������� �������
			$this->add_form($pms);
			$this->add_doPreRender($pms);
			$this->replacePul('body', $pms);		
			$this->updatePul('body', $this->endRender($this->getPul('body')));
			$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}
		
		return false;
	}
	
	
	/**
	 * ���������� ������ � ������ ����� ������� ����� ����������� ����� �������
	 *
	 * @param unknown_type $pms
	 */
	public function add_doPreRender(&$node)
	{
		# ����������� ���������
		
		$node['extend_prebody'] .= '';
		$node['analog'] = '';	// ��� ����� ������� ���������� ���������� "����������� ������" 	
		
	}
	
	
	/**
	 * ������������ ����� ������������ ������ ��� ����� ��������������
	 *
	 * @param unknown_type $node
	 * @return unknown
	 */
	
	protected function getAnalogFormBlock(&$node)
	{
		# ������ �� �������� ����� �������������� ������ ����������� �������
		$res = '';
		if ($this->std->settings[$this->mod_name.'_analog'] > 0)
		{			
			# ���� ���������� ����, ����� ���������� � �������� ��������
			if ($node['is_sheet'] == '1')
			{
				$res = '
                        <tr >
	                        <td></td>
	                        <td><a style="cursor:hand; cursor:pointer; text-color:red;" onClick="$(\'#analog\').slideToggle(\'slow\');"><b>������������� ������ ����������� ������� >>></b></a>                        
	                        
	                        
	                        <table width="100%"  id="analog" style="display:none;">
	                        <tr>
	                        <td>'.$this->getAnalogForm($node).'</td>	                        
	                        </tr>
	                        </table>
	                        </td>
                        </tr>';
			}
		}
		
		return $res;
	}
	
	

	/**
	 * ��������� ������ ����� �����������
	 *
	 * @param unknown_type $pms
	 */
	public function add_doAfterSave(&$node)
	{			
		# ��������� ����������� � �������
		
		
		
		# ������� �������, ������� �������, ���� ��� ���������
		$this->setAnalog();
		
		
		# �������� �������� ��� is_sheet = 0, �.�. �������� ���������� �����
		$sql = "UPDATE {$this->table} SET is_sheet = 0 WHERE id = '{$node['pid']}'";
		$this->db->do_query($sql);
		
		# ������� �������, ������ ����� ��������� ����, ���� ��� ����
		$this->loadPhoto();
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
			$this->validInput();



			if ($this->std->getPul('admin', 'error') != '')
			{
				# ���� ������, ������� ����� ��������� ����� � ���������� ��� �����������

				# �� ������ �����
				$this->input['is_active'] = $this->input['is_active'] == 1 ? 'checked' : '';



				# ����� ����� ���������� �������
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				# ���� ����� �������/��������� ���������, �� ���������� ������ ������ � ���� ���������� ������
				if ($parent = $this->getNodeById($this->curid))
				{
					if ($parent['is_active'] != $this->input['is_active'])
					{
						$this->active_do();
					}
				}



				#----------------------------------------------
				# ������ ���������, ����� ���������
				#----------------------------------------------
				$this->edit_doPreSave($this->input);
				$this->db->do_update($this->mod_name, $this->input, "id = '{$this->curid}'");
				$this->addTreeToMenu();


				$this->saveDone($this->curpid);
				return true;
			}
		}
		else
		{
			# ������ ������ � ������������� ��������
	
			if ($node = $this->getNodeById($this->curid))
			{
				# ���� ������ ���������, �� ������ ������ ����������� ������������ ������ ������ ������������� �������
				if ($parent = $this->getNodeById($this->curpid))
				{
					if ($parent['is_active'] == 0)
					{
						$node['is_active_disabled'] = $parent['is_active'] == 0 ? 'disabled' : '';
					}
				}
				$node['is_active'] = $node['is_active'] == 1 ? 'checked' : '';
				$node['is_redirect'] = $node['is_redirect'] == 1 ? 'checked' : '';
				$node['timestamp'] = $this->std->getSystemTime($node['timestamp']);
	
	
				# ����� ����� ���������� �������
				$this->add_form($node);
				$this->edit_doPreRender($node);
				$this->replacePul('body', $node);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
				$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
			}
		}
		return false;
	}
	
	public function saveDone($pid)
	{
		$this->std->setPul('admin', 'info', '<b>��������� ���������</b><br>
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curpid.'/'.$this->curid.'/">�������������</a>&nbsp;&nbsp;
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		//header("Location: /admin/catalog/list/".$pid.'/');
	}
	
	
	/**
	 * ���������� ������ � ������ ����� ������� ����� �������������� �������
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreRender(&$node)
	{
		# ����������� � �������
		$node['analog'] = $this->getAnalogFormBlock($node);
		# ����� ���� ��� �����
		
	}
	
	
	/**
	 * ��������� ������ ����� �����������
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreSave(&$node)
	{
		# ����������� � �������
		
	
		# �������� ���� ��� ����, ���� ���������� ������� ���������� � ����������� ������ �� ��������
		$sql = "SELECT pid FROM {$this->table} WHERE id = '{$this->curid}'"; 
		if ($this->db->query($sql, $rows) > 0)
		{
			$sql = "SELECT id FROM {$this->table} WHERE pid = '{$rows[0]['pid']}'";
			if ($this->db->query($sql, $rows1) == 1)
			{
				# ���� � �������� �������� ���������� ����������� = 1, � ����� ������� ������ = 0, ������ �������� ��� is_sheet = 1
				$sql = "UPDATE {$this->table} SET is_sheet = 1 WHERE id = '{$rows[0]['pid']}'";
				$this->db->do_query($sql);
			}
			
		}
	
	
		# �������� �������� ��� is_sheet = 0, �.�. �������� ���������� �����
		$sql = "UPDATE {$this->table} SET is_sheet = 0 WHERE id = '{$node['pid']}'";
		$this->db->do_query($sql);
		
		# ������� �������, ������ ����� ��������� ����, ���� ��� ����
		$this->loadPhoto();

		
		# ������� �������, ������� �������, ���� ��� ���������
		$this->setAnalog();	
		
		
		# ������� ��������� ���
		$this->std->rm_dir($this->filepath.'/cache');
	}
	
	
	
	/**
	 * �������������� ���������� �� ����� ������
	 *
	 */
	public function validInput()
	{
		$this->input['is_redirect'] 	= isset($this->std->input['is_redirect']) ? 1 : 0;
		$this->input['is_active'] 		= isset($this->std->input['is_active']) ? 1 : 0;
		$this->input['title'] 			= $this->std->input['title'];
		$this->input['pid'] 			= $this->std->input['pid'];
		$this->input['price'] 			= $this->std->StringToFloat($this->std->input['price']);
		$this->input['item_count'] 		= $this->std->StringToFloat($this->std->input['item_count']);
		$this->input['body'] 			= $_POST['body'];
		$this->input['sbody'] 			= $this->std->input['sbody'];
		$this->input['h1'] 				= $this->std->input['h1'] == '' ? $this->std->input['title'] : $this->std->input['h1'];
		$this->input['menu'] 			= $this->std->input['menu'] == '' ? $this->std->input['title'] : $this->std->input['menu'];
		$this->input['timestamp'] 		= $this->std->getTimestamp($this->std->input['timestamp']);
		$this->input['lastmodified'] 	= $this->std->getTimestamp($this->std->input['lastmodified']);
		$this->input['author'] 			= $this->std->input['author'];
		$this->input['owner'] 			= $this->std->input['owner'];
		$this->input['description'] 	= $this->std->input['description'];
		$this->input['keywords'] 		= $this->std->input['keywords'];
			
			
		# �������� ������
		if ($this->input['title'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">�� ��������� ���� "��������"</font>');
		}
	}



	/**
	 * ��������� ������ ������������
	 *
	 * @param unknown_type $id
	 * @param unknown_type $tab
	 * @return unknown
	 */
	function getParentTree( $id, $tab = '&nbsp;&nbsp;&nbsp;&nbsp;', $level )
	{


		if ($this->curid == $id)
		{
			return '';
		}

		$res = '';

		if ($id == -1)
		{
			$res .= '<option value="'.$id.'">'.$this->std->modules_all[$this->mod_name]['title'].'</option>';
		}
		else
		{
			if ($this->curpid == $id)
			{
				$res .= '<option selected value="'.$id.'">'.$tab.'|-'.$this->id[$id]['title'].'</option>';
			}
			else
			{
				if ($this->curid != $id)
				{
					$res .= '<option value="'.$id.'">'.$tab.'|-'.$this->id[$id]['title'].'</option>';
				}
			}
		}

		# ���������� ������� ����������� (��������� ������, ������ ���������)
		if (($level == $this->std->settings[$this->mod_name.'_levels']) && ($this->std->settings[$this->mod_name.'_levels'] != 0))
		{
			return;
		}

		if (isset($this->pid[$id]))
		foreach ($this->pid[$id] as $node)
		{
			$res .= $this->getParentTree( $node['id'], $tab.'&nbsp;&nbsp;&nbsp;&nbsp;', $level+1 );
		}

		return $res;
	}





	/**
	 * ����������� �������� ������� � ���� � ��������
	 *
	 * @param unknown_type $id                - ������������� �������
	 * @param unknown_type $delnode        - ������� �� ���� �������? 1 - ���
	 */
	public function del_do()
	{
		# �������� ������ � �������, ������� �������
		if ($node = $this->getNodeById($this->curid))
		{
			#---------------------------------------
			# ������� ��� ���������� ���� � ������
			#---------------------------------------
			$this->emptyTree();
			if (!$this->initTree('id, pid, img'))
			{
				return ''; // ����� ���� ������ ���
			}
			$ids = $this->getNodeChildsId($this->curid);
			
			
			#---------------------------------------
			# ������� ����������� ����, ���� ����
			#---------------------------------------
			foreach ($ids as $id)
			{
				$id = str_replace("'", '', $id);
				
				if ($this->id[$id]['img'] != '')
				{
					$this->photodel_do($id, $this->id[$id]['img']);
				}				
			}

			
			
			$sql = "DELETE FROM {$this->table} WHERE id IN (".implode(',', $ids).")";
			$this->db->do_query($sql);
			
			
			
			
			#--------------------------------------------------------------
			# �������� ���� ��� ����, ���� ����������� ������ �� ��������
			#--------------------------------------------------------------
			$sql = "SELECT id FROM {$this->table} WHERE pid = '{$node['pid']}'";
			if ($this->db->query($sql, $rows) == 0)
			{
				$sql = "UPDATE {$this->table} SET is_sheet = 1 WHERE id = '{$node['pid']}'";
				$this->db->do_query($sql);
			}
			

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">��������� ������� ��� � ��������</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}

		# �������������
		$this->order_do();

		return false;
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
			# �������� ������ ��� ������, ������� ���������� �������
			$this->emptyTree();
			if (!$this->initTree('id, pid'))
			{
				return ''; // ����� ���� ������ ���
			}
			$ids = $this->getNodeChildsId($this->curid);


			$sql = "UPDATE {$this->table} SET is_active = (is_active XOR 1) WHERE id IN (".implode(',', $ids).")";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">��������� ������� ��� � ��������</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}
			

		return false;
	}
	

	/**
	 * ���������� ������ �������
	 *
	 */
	protected function best_do()
	{
		# �������� ������ � �������, ������� ���������/������������
		if ($node = $this->getNodeById($this->curid))
		{
			$sql = "UPDATE {$this->table} SET is_best = (is_best XOR 1) WHERE id = '{$this->curid}' ";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">��������� ������� ��� � ��������</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a>');
		}
			

		return false;
	}



	/**
	 * �������������� ������ �� ������� ������������ � ��� ���������� ������
	 */
	protected function order_do()
	{
		# ���� ������ �����, ������������� ������
		if (is_array($this->std->input['item_order']) && (count($this->std->input['item_order']) > 0))		
		foreach ($this->std->input['item_order'] as $key => $value)
		{
			$value = $value;
			$this->db->do_update($this->mod_name, array('item_order' => $value), "id='{$key}'");
		}

		# �� ��������� ���������� ����������������� �������
		# ������ ����� ������������ ������� ���������� � ����� 5
		$this->static_order_do();
	}

	/**
	 * �������������� ������ ������ ������
	 *
	 */
	protected function static_order_do()
	{
		# ��������� ���������, ���������� ��� ������������ ��������������
		$this->emptyTree();
		# � ������ �������������� ������
		$this->initTree('id, pid, title');

		$i = 1;
		if (isset($this->pid[$this->curpid]) && (is_array($this->pid[$this->curpid])))
		foreach ($this->pid[$this->curpid] as $node)
		{
			$this->db->do_update($this->mod_name, array('item_order' => $i), "id='{$node['id']}'");
			$i = $i == 1 ? 5 : ($i + 5);
		}
	}



	/**
	 * ������������ ����� ���������� ����� ������� � ��������
	 *
	 */
	public function add_form($node)
	{
		$this->initTree('id, pid, title');
			
		$form = '<form method=post enctype=multipart/form-data>
					<table border="1" width="90%">											
						{analog}						
						{pre_active}						
					
                        <tr>
                        <td align=right>������������ �����:</td>
                        <td><input type=checkbox name=is_active {is_active} {is_active_disabled}></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red>*</font> �������� (title):</td>
                        <td><input type=text name=title value="{title}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                         
		                                      
                        <tr>
                        <td align=right>������������ ��������:</td>
                        <td>
                        <select name=pid>'.$this->getParentTree(-1, '&nbsp;&nbsp;&nbsp;&nbsp;', 0).'</select>
                        </td>
                        </tr>
                        
                        <!-- ����� ��� ����� �������, ������� ����� ��������� � �������� -->
                		{extend_prebody}';
                		
		if (($this->std->settings[$this->mod_name.'_type'] != '0'))
		{
			# ����� �������� ����
			if (($this->std->settings[$this->mod_name.'_type'] == '1') || ($this->std->settings[$this->mod_name.'_type'] == '2'))
			{
				
				if ($node['img'] != '')
				{
					$form .= '<tr><td align=right>����:<br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/photodel/'.$this->curpid.'/'.$this->curid.'/">������� ����</a></td><td><input type=hidden name=img value="'.$node['img'].'"><img src="/'.$this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$node['img'].'/'.$node['id'].'_th.jpg"></td></tr>';
				}
				else
				{
					$form .= '<tr><td align=right>����:</td><td><input type=file name=img style="width:70%;"></td></tr>';
				}
			}
			

			if ($this->std->settings[$this->mod_name.'_type'] == '2')
			{
				$form .= '<tr>
                        <td align=right>����:</td>
                        <td>
                        <input type=text name="price" value="{price}" style="width:12%;" maxlength="255">
                        </td>
                        </tr>
                        
                        
                        <tr>
                        <td align=right>����������:</td>
                        <td>
                        <input type=text name="item_count" value="{item_count}" style="width:12%;" maxlength="255">
                        </td>
                        </tr>';
			}                		
		}
                        
		$form .= '		<tr>
						<td align=right valign=top> ���������� ��������<br>(HTML-���)</td>
						<script type="text/javascript" src="/'.$this->std->config['folder_admin'].'/editor/fckeditor.js"></script>
						<script type="text/javascript">
                        	window.onload = function() 
                        	{
                        		var oFCKeditor = new FCKeditor( \'body\', \'100%\', \'100%\' );
                        		oFCKeditor.BasePath = "/'.$this->std->config['folder_admin'].'/editor/" ;
                        		oFCKeditor.ReplaceTextarea() ;
							}
                        </script>
                        <td width=80% height=400><textarea rows=37 cols=80 name=body >{body}</textarea></td>
                		</tr>
                		
                		
                		<!-- ����� ��� ����� �������, ������� ����� ��������� � �������� -->
                		{extend_afterbody}
                		
                		
                		
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
                        <td align=right>����������� �� ������ ���������� ��������:</td>
                        <td><input type=checkbox name=is_redirect {is_redirect}></td>
                        </tr>
                	
                		<tr>
                        <td align=right valign=top>����� ��������<br>(HTML-���)</td>
                        <td width=80%><textarea name=sbody style="width:100%;">{sbody}</textarea></td>                        
                        </tr>
                		
                		<tr>
                        <td align=right>��������� (h1):</td>
                        <td><input type=text name=h1 value="{h1}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red></font> �������� � ����:</td>
                        <td><input type=text name=menu value="{menu}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right>���� ������������:</td>
                        <td><input type="text" name=timestamp value="{timestamp}"> (��.��.���� ��:��)</td>
                        </tr>

                        <tr>
                        <td align=right>���� ��������� ��������:</td>
						<td><input type=text name=lastmodified value="'.$this->std->getSystemTime().'" disabled></td>
                        </tr>
                        
                        <tr>
		                 <td align=right>����� (�������):</td>
		                 <td><input type=text name=author value="{author}"  style="width:70%;" maxlength="255"> (�-�a-Z_0-9 -!)</td>
		                </tr>
		             
		                <tr>
		                 <td align=right>��������� ��������:</td>
		                 <td><b>�����: '.$this->std->member['user_name'].'</b><input type=hidden name=owner value="'.$this->std->member['user_name'].'"></td>
		                </tr>
                		
                	 	<tr>
		                <td align=right>��������:</td>
		                <td><input type=text name=description value="{description}" style="width:100%;" maxlength="255"></td>
		                </tr>

		                <tr>
		                 <td align=right>�������� �����:</td>
		                 <td><input type=text name=keywords value="{keywords}" style="width:100%;" maxlength="255"> <nobr></nobr></td>
		                </tr>
			            
					</table>
					</div>
					
					
					<input type=submit value="���������" class=f2>
					</form>	
                ';
		
		
		
		$this->setPul('body', $form);
	}
	
	
	
	
	/**
	 * ����� �������������� ������� ����������� ������� (�������)
	 *
	 */
	public function getAnalogForm(&$node)
	{
		$res = '';
		
		#---------------------------------------
		# ��������� ������ ��� ��������� �������
		#---------------------------------------
		$sql = "SELECT * FROM {$this->table}_analog WHERE id = '".$node['id']."'";
		if ($this->db->query($sql, $rows) > 0)
		{
			$res = '<table border="0">
					';
			$item = '<tr><td><a href="{alias}">{title}</a></td><td width="20"></td><td>
				<a href="javascript:doConfirm(\'������� �����?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/analog_del/'.$this->curpid.'/'.$this->curid.'/{id}/\')" title="�������"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a>
				</td></tr>';
			
			foreach ($rows as $row)
			{
				$pms = array();
				$pms['id'] = $row['id_with'];
				$pms['pid'] = $row['pid_with'];
				$pms['title'] = $row['title_with'];
				$pms['alias'] = $row['alias_with'];
				$pms['alias'] = $this->getAliasByPid($pms);
				
				$res .= $this->strtr_mod($item, $pms);
			}
			
			
			
			$res .= '
					</table><br><br>';
		}
		
		
		
		#---------------------------------------
		# ������������ ����� 
		#---------------------------------------
		$res .= '<b>����� ������:</b><br>				
				<script>
					// ������ ���������� ����� ��� ����� ������ ����������� ������
					function getAnalogForm(pid, mod_name, cdiv)
					{					
						$.post(\'/admin/\'+mod_name+\'/analog/\'+pid+\'/\', {		
							pid: pid
							},
							function (data)
							{
								$(\'#\'+cdiv+\'\').html(data);				
							} 
						)
					}
				</script>
				
				'.$this->getAnalogFormListItem('-1').'
				<div id="div-1"></div>';
		
				
		return $res;
	}
	
	
	/**
	 * ������������ ���������� ������� � ���������� ��� ������ ������� � ������� ��� �������� ������
	 *
	 */
	public function getAnalogFormListItem($pid)
	{
		$res = '';
		
		$sql = "SELECT id, title, is_sheet FROM {$this->table} WHERE pid = '{$pid}'";
		if ($this->db->query($sql, $rows) > 0)
		{			
			
			$item_select = '<option value="{id}">{title}';
			$item_checkbox = '<input type="checkbox" name="analog[{id}]" value="{id}" /> {title}<br>';
			
			foreach ($rows as $row)
			{	
				if ($row['is_sheet'] == '1')
				{
					$checkbox .= $this->strtr_mod($item_checkbox, $row);
				}
				else
				{
					$select .= $this->strtr_mod($item_select, $row);
				}
				
			}
			
			if ($select != '')
			{
				$res .= '<select id="sel'.$pid.'" onChange="getAnalogForm($(\'#sel'.$pid.'\').val(), \''.$this->mod_name.'\', \'div'.$pid.'\')">';
				$res .= '<option value="0">�������';
				$res .= $select;
				$res .= '</select><div id="div'.$pid.'"></div><br>';
			}
			if ($checkbox != '')
			{
				$res .= $checkbox; //.'<br><input type="submit" value="������� �������">';
			}
			
			
		}
		
		return $res;
	}
	
	
	/**
	 * �������� ����� ������� � ���������
	 *
	 */
	public function delAnalog($id = '-1')
	{
		if ($this->std->settings[$this->mod_name.'_analog'] > 0)
		{
			if ($id == '-1')
			{
				# ������� ��� ����� � �������� $this->curid
				$sql = "DELETE FROM {$this->table}_analog WHERE id = '{$this->curid}' OR id_with = '{$this->curid}'";
			}
			else
			{
				$sql = "DELETE FROM {$this->table}_analog 
						WHERE (id = '{$this->curid}' AND id_with = '$id') OR
								(id_with = '{$this->curid}' AND id = '$id')";
			}
			
			$this->db->do_query($sql);
		}
	}
	
	
	
	
	/**
	 * ���������� ����������� ������ (�������)
	 *
	 */
	public function setAnalog()
	{
		if ($this->std->settings[$this->mod_name.'_analog'] > 0)
		{
			if (isset($this->std->input['analog']))
			{
				# ������ ������ ��� ��������� � ������� ��������
				$isset_id = array();
				$sql = "SELECT * FROM {$this->table}_analog WHERE id = '".$this->curid."'";
				if ($this->db->query($sql, $rows) > 0)
				{					
					foreach ($rows as $row)
					{
						$isset_id[] = $row['id_with'];						
					}				
				}
				
				
				foreach ($this->std->input['analog'] as $id)
				{
					if (!in_array($id, $isset_id))
					{
						$sql = "SELECT title, pid, id, alias FROM {$this->table} WHERE id = '".$id."'";
						if ($this->db->query($sql, $rows) > 0)
						{
							$row = $rows[0];
							
							
							# c ����� �������� ����������� �������
							$pms = array();
							$pms['id'] = $this->curid;
							$pms['id_with'] = $row['id'];
							$pms['pid_with'] = $row['pid'];
							$pms['alias_with'] = $row['alias'];
							$pms['title_with'] = $row['title'];
							$this->db->do_insert($this->mod_name.'_analog', $pms);
							
							
							# ��� �� � ��������� ���� ������ ����� ������������� ��� � �� ������
							$pms = array();
							$pms['id'] = $row['id'];
							$pms['id_with'] = $this->curid;
							$pms['pid_with'] = $this->curpid;
							$pms['alias_with'] = $this->curid;
							$pms['title_with'] = $this->std->input['title'];
							$this->db->do_insert($this->mod_name.'_analog', $pms);
							
							
							
							
						}
					}
				}
			}
		}
	}
	
	
	
	/**
	 * �������� � ������ ����
	 *
	 */
	function loadPhoto()
	{
		# ������� �������, ������ ����� ��������� ����, ���� ��� ����
		if (isset($_FILES['img']) && ($_FILES['img']['name'] != ''))
		{
			# ��������� �������� ���������� ����� (����� ���� ����� �����)
			$file_tmpname = str_replace(' ', '', microtime());
			
			# �������� ��������� ���������� ����� � ������� �����
			$ext = $this->std->uploadFile($_FILES['img'], $file_tmpname, $this->mod_name, &$error);
			$error .= (strtolower($ext) != 'jpg') ? '��������� ����� ������ ����� "jpg".<br>' : ''; 
			$file_tmpname = $file_tmpname.'.'.$ext;
			
			 					
								
			
			# ������������� ������ ��� ������� ����
			$error .= $this->std->initImage($this->mod_name);
			
			# ����� - ����, � ������� ����� ����������� ����������� ����������
			$folder == '';
			
			# ������� ���� � ��������� �����
			$insource = $this->std->config['path_files'].'/'.$this->mod_name.'/'.$file_tmpname;
			
			if ($error == '')
			{
				try 
				{ 
					# ����� ��� ������
					$folder = $this->std->getSystemTime(time(), 'Y_m');
					
					
					# ������ ��������� ����												
					$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/img/'.$folder.'/'.$this->curid.'_img.jpg'; // �������� �����						
					$this->std->image->resize_img($insource, $outsource);
					
					# ������ ������													
					$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$folder.'/'.$this->curid.'_th.jpg'; // �������� �����						
					$this->std->image->resize_th($insource, $outsource);
					
					# ���������� ��������� ����													
					$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/source/'.$folder.'/'.$this->curid.'.jpg'; // �������� �����						
					$this->std->image->resize_source($insource, $outsource);
				}catch (Exception $e) 
				{
					$err_msg .= '�������� ������ ��� ��������� �������� ����: '.$e->getMessage().'<br>'; 
					$this->log('B�������� �������� ����: '.$e->getMessage());
				}								
			}
			
			if (file_exists($insource))
			{
				# ������� ��������� ����
				unlink($insource);
			}
			
			
			
			if ($error != '') 
			{
				$this->log($error);
				$this->std->setPul('admin', 'error', $error);	// ������� ��������� �� ������
			}
			else
			{					
				# ���� ���������
				# ��������� ���������� � ��������
				$this->db->do_update($this->mod_name, array('img' => $folder), 'id='.$this->curid);
			}
		}
	}
	
	
	
	
	/**
	 * �������� ����
	 *
	 */
	public function photodel_do($id = '', $img = '')
	{
		if (($img == '') && ($node = $this->getNodeById($this->curid)))
		{
						
				# ������� ������� ����
				$file_source = $this->std->config['path_files'].'/'.$this->mod_name.'/source/'.$node['img'].'/'.$this->curid.'.jpg';
				if (file_exists($file_source)) unlink($file_source);
				
				# ������� �������� ����
				$file_img = $this->std->config['path_files'].'/'.$this->mod_name.'/img/'.$node['img'].'/'.$this->curid.'_img.jpg';
				if (file_exists($file_img)) unlink($file_img);
				
				# ������� ������
				$file_th = $this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$node['img'].'/'.$this->curid.'_th.jpg';
				if (file_exists($file_th)) unlink($file_th);
				
				# �������� ������ �������
				$this->db->do_update($this->mod_name, array('img' => ''), "id='{$this->curid}'");
		}
		elseif ($img != '')
		{
				# ������� ������� ����
				$file_source = $this->std->config['path_files'].'/'.$this->mod_name.'/source/'.$img.'/'.$id.'.jpg';
				if (file_exists($file_source)) unlink($file_source);
				
				# ������� �������� ����
				$file_img = $this->std->config['path_files'].'/'.$this->mod_name.'/img/'.$img.'/'.$id.'_img.jpg';
				if (file_exists($file_img)) unlink($file_img);
				
				# ������� ������
				$file_th = $this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$img.'/'.$id.'_th.jpg';
				if (file_exists($file_th)) unlink($file_th);
		}
		
		
		
		
	}
	
	
	
	
	
	
	
	/**
	 * ������������� �������� ���� � �������������� �������� ������ ��� ���
	 *
	 */
	public function  photomultiupload_do()
	{
		$res = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">��������� � ������</a><br><br>';
		
		
		if (($this->std->input['request_method'] == 'post') && (isset($_FILES['fileToUpload'])))
		{	
			
			
			
			
			$i = 0;
			foreach ($_FILES['fileToUpload']['name'] as $filename)
			{
				if ($_FILES['fileToUpload']['error'][$i] == 0)
				{
									
					$pms = array();
					$pms['is_active'] = 1;
					$pms['pid'] = $this->curpid;
					$pms['timestamp'] = time();
					$pms['lastmodified'] = time();
					$pms['owner'] = $this->std->member['user_name'];
					$pms['item_order'] = $i;
					
					
					
					
					
					
					#----------------------------------------------
					# ������ ���������, ����� ���������
					#----------------------------------------------				
					$this->db->do_insert($this->mod_name, $pms);
					
					
					
					
					
					# �������� ���� ����� ������
					$this->curid = $this->db->get_insert_id();
					
					
					#--------------------------------------
					# �������� ��������� � ��������� ����
					#--------------------------------------
					
					# ���������� ������ ��� ��������
					$source = array('name' 		=> $_FILES['fileToUpload']['name'][$i],
									'type' 		=> $_FILES['fileToUpload']['type'][$i],
									'tmp_name' 	=> $_FILES['fileToUpload']['tmp_name'][$i],
									'error' 	=> $_FILES['fileToUpload']['error'][$i],
									'size' 		=> $_FILES['fileToUpload']['size'][$i]
									);
								
					# ��������� �������� ���������� ����� (����� ���� ����� �����)
					$file_tmpname = str_replace(' ', '', microtime());
					
					# �������� ��������� ���������� ����� � ������� �����
					$ext = $this->std->uploadFile($source, $file_tmpname, $this->mod_name, &$err_msg);
					$file_tmpname = $file_tmpname.'.'.$ext;
					
					 					
										
					
					# ������������� ������ ��� ������� ����
					$error = $this->std->initImage($this->mod_name);
					
					# ����� - ����, � ������� ����� ����������� ����������� ����������
					$folder == '';
					
					# ������� ���� � ��������� �����
					$insource = $this->std->config['path_files'].'/'.$this->mod_name.'/'.$file_tmpname;
					
					if ($error == '')
					{
						try 
						{ 														
							# ����� ��� ������
							$folder = $this->std->getSystemTime(time(), 'Y_m');
							
							
							# ������ ��������� ����												
							$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/img/'.$folder.'/'.$this->curid.'_img.jpg'; // �������� �����						
							$this->std->image->resize_img($insource, $outsource);
							
							# ������ ������													
							$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$folder.'/'.$this->curid.'_th.jpg'; // �������� �����						
							$this->std->image->resize_th($insource, $outsource);
							
							# ���������� ��������� ����													
							$outsource = $this->std->config['path_files'].'/'.$this->mod_name.'/source/'.$folder.'/'.$this->curid.'.jpg'; // �������� �����						
							$this->std->image->resize_source($insource, $outsource);
						}catch (Exception $e) 
						{
							$err_msg .= '�������� ������ ��� ��������� �������� ����: '.$e->getMessage().'<br>'; 
							$this->log('B�������� �������� ����: '.$e->getMessage());
						}
						
					}
					else
					{
						$err_msg .= $error;
					}
					
					
					if (file_exists($insource))
					{
						# ������� ��������� ����
						unlink($insource);
					}
					
					
					if ($err_msg == '')
					{					
						# ��������� �������� ��������� �����
						$pms = array();
						$pms['alias'] = $this->curid;
						$pms['title'] = '���� '.$this->curid;
						$pms['menu'] = '���� '.$this->curid;
						$pms['h1'] = '���� '.$this->curid;
						$pms['img'] = $folder;
						$pms['item_order'] = $this->std->settings[$this->mod_name.'_typeadd'] == 1 ? 0 : (1000000 + $i);  // ��������� ������/�������� ������� ����������
						$this->db->do_update($this->mod_name, $pms, 'id='.$this->curid);
						
						$res .= "��������: ".$filename.'<br>'; 
					}
					else
					{
						$res .= "�� ��������: ".$filename.'<br>';
						$sql = 'DELETE FROM '.$this->table.' WHERE id = '.$this->curid;
						$this->db->do_query($sql);
					}
									
					
				}
				else
				{
					if ($filename != '') $res .= "�� ��������: ".$filename.'<br>';
				}
				
				$i++;
			}
			
			
			# �������������					
			$this->order_do();
			$this->addTreeToMenu();
			
			if ($i > 0)
			{
				# �������� �������� ��� is_sheet = 0, �.�. �������� ���������� �����
				$sql = "UPDATE {$this->table} SET is_sheet = 0 WHERE id = '{$this->curpid}'";
				$this->db->do_query($sql);
			}
		}
		
		
		echo $res;
		exit;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	#--------------------------------------------------------------
	#--------------------------------------------------------------
	#--------------------------------------------------------------
	#--------------------------------------------------------------
	# ������ � ����
	#--------------------------------------------------------------
	#--------------------------------------------------------------
	#--------------------------------------------------------------
	#--------------------------------------------------------------





	/**
	 * ���������� ������ ������������ ��� �������� ���������� � ����
	 *
	 * @param unknown_type $pid                       - ��������
	 * @param unknown_type $tab                       - ������� (��������� �������)
	 * @param unknown_type $form                      - ����� ������
	 * @param unknown_type $alias                     - ���� (��������� � ������ ����)
	 * @param unknown_type $alias_arr                 -
	 * @param unknown_type $id                        - ������ ������������ ID (����������� � ������)
	 */
	function setitemMenuTree($pid, $tab, &$form, $alias, $alias_arr)
	{
		$sql        = "select * from {$this->table} where is_active = 1 and pid = ".$pid." ORDER BY pid, item_order";  // ��������� � ����������� ���������
		$this->std->db->do_query($sql);

		$alias = str_replace("//", '/', $alias);

		// ���� ����������� �������� ��� ���� � �������
		if ( $this->std->db->getNumRows() )
		{
			while ($rows = $this->std->db->fetch_row())
			{  // �� ��� �������� ���������
				$data[] = $rows;
			}

			foreach($data as $id => $row)
			{
				$cheched        = '';
				if (in_array($alias.$row['alias']."/",$alias_arr))
				{
					$cheched = 'checked';
				}

				// ������ ���������� ���, ���� �� ������� ������ �� ������
				$alias = preg_replace("#^{$this->mod_name}#is", "", $alias);

				$form .= @$nbsp."<table><tr><td width=".($tab*10)."></td><td align=left>
                                                                        - <input type='checkbox' name='".$row['id']."_checkbox' $cheched>&nbsp;".$row['menu']."
                                                                          <input type='hidden' name='".$row['id']."_url' value='".$alias.$row['alias']."/'>
                                                                          <input type='hidden' name='".$row['id']."_name' value='".$row['menu']."'>
                                                                </td></tr></table>";
				$this->menu_ids[] = $row['id'];

				$this->setitemMenuTree($row['id'], $tab+3, $form, $alias.$row['alias']."/", $alias_arr);
			}
		}
	}



	/**
	 * ������������ ����, ����������� ������ ������
	 * ��� ����������� ����, ���������� ������ ������ �� ��������. ��� �������� ��������� ������� ���������� ������.
	 * ������ ������� ���������� �� "admin_menu.php" �� ������� "menu_content"
	 *
	 * @param unknown_type $alias_arr
	 * @return unknown
	 */
	function createMenu($alias_arr)
	{

		$checked = '';
		if (in_array('/'.$this->mod_name.'/', $alias_arr))
		{
			$checked = 'checked';
		}

		$form = $nbsp."<table><tr><td width='0'></td><td align=left>
		- <input type='checkbox' name='-1_checkbox' $checked>&nbsp;{$this->std->modules_all[$this->mod_name]['title']}
		<input type='hidden' name='-1_url' value='/{$this->mod_name}/'>
		<input type='hidden' name='-1_name' value='{$this->std->modules_all[$this->mod_name]['title']}'>
		</td></tr></table>";

		$sql = "select alias from {$this->table} where is_active = 1 and pid = -1 ORDER BY pid, item_order, id";  // ������ �������� ������, � ��� ��� ���������
		$this->std->db->do_query($sql);
		
		$this->menu_ids[]    = -1;  // ������ ����� ��������� ������ � �������� ����������
		// ���� ����������� �������� ��� ���� � �������

		if ($row = $this->std->db->fetch_row())
		{
			$this->setitemMenuTree(-1, 3, $form, "/{$this->mod_name}/", $alias_arr, @$id);
		}

		$form = "<input type='hidden' name='module_list_id' value='".implode(' ', $this->menu_ids)."'>
		<input type='hidden' name='module_tablename' value='{$this->mod_name}'>
		<table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='�������� ����'>";
		return $form;
	}



	/**
	 * ������� ����������� ������ ������ ������ �� ���������� ��������������,
	 * �������� ����� �� ������ �� ����� � �������� ���������� ������ �����
	 *
	 * @param unknown_type $id
	 * @param unknown_type $alias
	 */
	function getPagePathById($id, &$alias)
	{
		$this->std->_getPagePathById($id, &$alias, $this->mod_name);
	}


	
	/**
	 * ������� ��� �������� ��������� ������ � ��������� ����, ������� � ��������� �������
	 *
	 * @param unknown_type $id
	 * @param unknown_type $pid
	 */
	function MoveToMenu($id  /* ������������� ������� � ������� */, $pid  /* ������������� ���� � ������� ����*/)
	{
		$this->std->_MoveToMenu($id, $pid, $this->mod_name);
	}

	
	
	/**
	 * ������� ��� ������������ ���������� ������������ ������ � ����
	 *
	 */
	function addTreeToMenu()
	{
		$this->std->_addTreeToMenu($this->mod_name);
	}

}






?>