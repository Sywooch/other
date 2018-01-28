<?php

/**
 * �������
 *
 */



require_once 'class_tree_backend.php';

class mod_catalog extends class_tree_backend 
{
	
	
	
	
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
		
		$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="�������������"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a>';
		
		
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
					<td align=center>{id}</td>					
					<td>{title} (<a href="{alias}" target="_new">��������</a>)</td>					
					<td align=center><input type="text" name="item_order[{id}]" value="{item_order}" size="3"></td>
					<td align=center><a href="javascript:doConfirm(\'������� ���������?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{pid}/{id}/\')" title="�������"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return strtr($item, $pms);
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
                        <td align=right><font color=red>*</font> ���:</td>
                        <td><input type=text name=id value="{id}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right>Alias (����� ����):</td>
                        <td><input type=text name=alias value="{alias}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red>*</font> �������� (title):</td>
                        <td><input type=text name=title value="{title}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                         
		                                      
                        <tr>
                        <td align=right>������������ ��������:</td>
                        <td>
                        <select name=pid style="width:70%;">'.$this->getParentTree(-1, '&nbsp;&nbsp;&nbsp;&nbsp;', 0).'</select>
                        </td>
                        </tr>
                        
                        <!-- ����� ��� ����� �������, ������� ����� ��������� � �������� -->
                		{extend_prebody}';
                		
		if (($this->std->settings[$this->mod_name.'_type'] != '0'))
		{
			
			

			if ($this->std->settings[$this->mod_name.'_type'] == '2')
			{
				$form .= '<tr>
                        <td align=right>����:</td>
                        <td>
                        <input type=text name="price" value="{price}" style="width:12%;" maxlength="255">
                        </td>
                        </tr>
                        ';
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
			/*foreach ($ids as $id)
			{
				$id = str_replace("'", '', $id);
				
				if ($this->id[$id]['img'] != '')
				{
					$this->photodel_do($id, $this->id[$id]['img']);
				}				
			}*/

			
			
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
								<!-- option value="active">�����/�������
								<option value="best">��������
								<option value="del">�������  -->
							</select>
							<input type="submit" value="��">
						</th>
						<th>���</th>
						<th>��������</th>
						<th width="10%">�������</th>						
						<th width="5%">&nbsp;</th>
						
					</tr>
				<form action="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/order/'.$this->curpid.'/" method="post">
				';
	}
	
	
	

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
				$this->add_form($this->input);
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
				//$this->curid = $this->db->get_insert_id();
				# �.�. �� �� ��� ��� ���������� ���� alias, �� ����� ��� ���������
				//$this->db->do_update($this->mod_name, array('alias' => $this->curid), 'id='.$this->curid);
				
				# � �������� ����������� ��������� �������������� ��������, �������� ����������
				//$this->input['id'] = $this->curid;
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
	 * �������������� ���������� �� ����� ������
	 *
	 */
	public function validInput()
	{
		$this->input['id'] 				= $this->std->input['id'];
		$this->input['alias'] 			= $this->std->input['alias'] == '' ? $this->std->trensliterator($this->std->input['title']) : $this->std->trensliterator($this->std->input['alias']);
		
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
		
		
		# �������� ������
		if ($this->input['id'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">�� ��������� ���� "���"</font>');
		}
	}
	
	
	/**
	 * ��������� ������ ����� �����������
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreSave(&$node)
	{
		parent::edit_doPreSave($node);
		
		
		$sql = "UPDATE se_catalog SET pid = {$node['id']} WHERE pid = {$this->curid}";
		$this->db->do_query($sql); 
	}
	
	
	
	
}


?>