<?php
require_once 'class_tree.php';  // ������ ���� ���������


/**
 * ���������������� ����� - ������ � ���������� ����������
 *
 */
class class_tree_frontend extends class_tree
{

	/**  ������������� �������  */
	public $curid = NULL;
	
	
	/**  ������ ����������� �������  */
	public $childs = array();
	
	
	/** ������ � ������ �������� ������ ����� �������� */
	public $node = array();
	
	/** ������ � �������� ��������������� ������, ������� �������� ���������� �������, ������������ ������� */
	public $show_id = array();
	

	/**
	 * ����������� ������� ������ - �������� ��� ����������� �����������, ���������� ������ ������
	 * ���������������
	 */
	public function main()
	{
		parent::main();
		
	

		# �������������� ����������, ������� ������ ����, ����������
		# �� ������������ ������� ��������� ��������� ������
		# ����� ����� ���

		
		
		# ������������ ������ ��������� ����������� �������
		$this->setPul($this->mod_name.'_last', $this->createNodesLastBlock());
		
		
		# ������������ ������ ��������� ����������� �������
		$this->setPul($this->mod_name.'_best', $this->createNodesBestBlock());
		
		# ������������ ������ ������������ ���� �� ������
		$this->setPul($this->mod_name.'_menu', $this->createModMenu());
			

		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[0] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}
		
			
		
		#------------------------------------------------------------------------
		# �������� ������� ���� ��������
		#------------------------------------------------------------------------
		
		$filename_cache = implode('_', explode('/',substr($this->std->uri,1,strlen($this->std->uri)-2))).'.dat'; // �������� ���-����� ��������
		if (($this->std->settings[$this->mod_name.'_cache'] == '1') && (file_exists($this->filepath.'/cache/'.$filename_cache)) && ($this->std->member['user_access'] != '1'))
		{
				# �������� ��� ���������� ������ �� ����� � ���������� �� ��� ������ �� �������� ������
				$date = unserialize(file_get_contents($this->filepath.'/cache/'.$filename_cache));
				
				$this->template = $date['template'];
				foreach ($date as $key => $value)
				{
					$this->updatePul($key, $value);
				}
				
				unset($date);
		}
		else
		{
				# ���� ���, ����� ����������� ������ � ����
			
				
			
							
				
				# ��������� �������, ��������� � � ������� � �� ������ ������
				$this->curpage = 0;		
				if ( strstr( $this->std->alias[count($this->std->alias)-1], "page" ) )
				{
					$this->curpage = str_replace( "page", "", $this->std->alias[count($this->std->alias)-1])-1;
					unset( $this->std->alias[count($this->std->alias)-1]);
					
					global $uri;
					$uri = '/'.implode('/', $this->std->alias).'/';
				}
				
				
				# ����� ������ ����� �������� ������ �� ����������				
				$this->curid = $this->getIdPage();
				
				
				# ��������� ������ � ������������ ��������		
				$this->getNodeData();
				
				
				if (($this->node['is_sheet'] == '0') || ($this->curid == -1))
				{
						# �������� ���� ����������� �������
						$this->childs = $this->getChilds($this->curid);
						
						
						# ���������� �������
						$this->template = $this->mod_name;
						
						
						# ���� � ������ � ��� �����
						$this->updatePul('nodes', $this->getMenuWithChild());
						$this->updatePul('sheets', $this->getMenuWithoutChild());					
				}
				else
				{	
					
					# ����� ������� � ������������, ��������� ������ ��� ��������-����� ������
					$this->workItemPage();
					
					
					# ���������� �������� ��������
					if ($this->template == '')
					{
						$this->template = $this->mod_name.'_item';
					}
				}
				
				
				# ������������ ������ ������������ ���� �� ������
				$this->setPul($this->mod_name.'_path', $this->createModPath());
				
				
				# ������ ����� ���� � �����, ���� � ���������� ��������� ����������� ������
				if ($this->std->settings[$this->mod_name.'_cache'] == '1')
				{
					# ������ ����� ���� � �����						
					$date = $this->std->getPulArray($this->mod_name);
					$date['template'] = $this->template;			
					$this->creatCache($date, $filename_cache);
					unset($date);
				}
		}
		
		
		
		
		
		
		# ������������ ����� ������� ��������� ������� ������ ()
		$this->updatePul($this->mod_name.'_history', $this->getHistory());			
					
				
		# �������� ��������� ������
		$this->__destruct();
	}
	
	

	/**
	 * ����������
	 *
	 */
	function __destruct()
	{
		parent::__destruct();
		unset($this->childs);
		unset($this->node);
	}
	
	
	
	/**
	 * ����� ������� � ������������, ��������� ������ ��� ��������-����� ������
	 *
	 */
	public function workItemPage()
	{
		# ������������ ����� ������� ��������� ������� ������ ()
		$this->updatePul($this->mod_name.'_attend', $this->getAttend());
		
		# ������������ ����� ����������� �������
		$this->updatePul($this->mod_name.'_analog', $this->getAnalog());
	}
	
	
	
	/**
	 * ���������� ���������������� ������� � ���-�����
	 *
	 */
	public function creatCache($date, $filename)
	{
		if (!isset($this->std->member['user_access']) || (isset($this->std->member['user_access']) && ($this->std->member['user_access'] != 1)))
		{
			$tmpfilename = $this->filepath.'/'.time().$filename;
			file_put_contents($tmpfilename, serialize($date));
			$this->std->moveFile($tmpfilename, $filename,  $this->filepath.'/cache', 1, $error);
		}
	}
	
	
	
	
	
	
	/**
	 * ������������ ������ ������������� �������
	 *
	 */
	public function getAttend()
	{
		$res = '';
		
		# ���� ��� �������� �������
		if ($this->std->settings[$this->mod_name.'_type'] == '2')
		{
			
			if (isset($this->std->settings['shop_modrecipient']))
			{
				# ���� ���������� ������-�������
				# ����� ���������� ���, ������� ������ ����� � �������� ���������� � ������������ �������
				include_once($this->std->config['path_modules']."/shop/shop_main.php");

				$class = 'main_shop';
				if (class_exists($class))
				{
					$module_run = new  $class('shop', &$this->std);
					$module_run->catalog = &$this;
					
					$res = $module_run->getAttend($this->node['id']);
					$module_run->__destruct();
				}
			}
		}
		
		
		return $res;
	}

	
	
	
	/**
	 * ������������ ������ ������������� �������
	 *
	 */
	public function getAnalog()
	{
		$res = '';
		
		# ���� ��� �������� �������
		if (($this->std->settings[$this->mod_name.'_analog'] > 0))
		{
			$res = $this->getNodesAnalog($this->skin['analog'], $this->std->settings[$this->mod_name.'_analog']);
		}
		
		
		return $res;
	}	
	
	
	

	/**
	 * ������������ ������ ��������� ����������� �������
	 *
	 * @param unknown_type $template - ������ ����������
	 * @param unknown_type $count	- ���������� ��������� �������
	 * @param unknown_type $is_update	- ������������� �������� ���
	 * @return unknown
	 */	
	public function getNodesAnalog($template, $count = 5)
	{
		# ����� ���������, ���� �� ���� � ����� �����
		$res = '';
		
		
		# ������ ������ �����������	
		$sql = "SELECT c.* FROM {$this->table}_analog a 
				INNER JOIN {$this->table} c ON (c.id = a.id_with)
				WHERE a.id = '".$this->curid."' AND c.is_active = 1
				LIMIT $count";
		if ($this->db->query($sql, $rows) > 0)
		{			
			# ���� ��������� �����, �� ������
			foreach ($rows as $node)
			{	
				$node = $this->formatFreeData($node);					
								
				$res .= $this->strtr_mod($template, $node);					
			}
		}		
		
		return $res;
	}
	
	
	
	
	/**
	 * ������������ ������ ��������� ������������� �������/������ ������
	 * ���������� ���� � ������������ �������� �� ��������
	 *
	 */
	public function getHistory()
	{
			$res = '';
		
			# ��������� ������� ��������� ������ ������, �� ������ ���� ���� ���������� �� ���						
			if (($this->std->settings[$this->mod_name.'_history'] != '0'))
			{
				
				# ��� ����� ���������� ������ �������, ���� �� ������� ������ �����������
				if ($this->template == $this->mod_name.'_item')
				{
					// ���� �������� �� ���� ���������� �������, �� ������� ��� ������
					if (count($this->node) == 0)
					{
						# ����� ������ ����� �������� ������ �� ����������
						$this->curid = $this->getIdPage();
												
						
						# ��������� ������ � ������������ ��������		
						$this->getNodeData();
					}
				}
				
				
				
				# �������� ������� ���������� ���������
				$cache = $this->std->getValueSession($this->mod_name);	// ��������� ������ ������ ������������

				$history = $cache['history'];		// �������� ���, ��� � ��� ��� �������� �� �������
				$history_show = $history;
				if (!is_array($history)) $history = array();
				$new_history = array();

				
				# ��� ����� ���-�� ������ ���������, ���� �� ������� ������ �����������
				if ($this->template == $this->mod_name.'_item')
				{
					# �� ����� ���������� ���������� ������������� ������ �������� 
					
					$history[] = $this->node;	// ���������� � ������� ����� �������
	
					$i = 0;
					while (count($history) > $this->std->settings[$this->mod_name.'_history']) 
					{
						unset($history[$i]);		// ������� ����� ������ - ����� ������
						$i++;
					}
					
					foreach ($history as $item)
					{
						$new_history[] = $item;		// ������ ����� ������
					}
					
					# ��������� ����� �������
					$cache['history'] = $new_history;
					
					$this->std->updateSession($this->std->member['session_id'], 'update', array($this->mod_name => $cache));					
					
				}
				
				if (count($history) == 0) return $res;	// ���� ������� ���, �� �����
				
				
				#-------------------------------------------------
				# ������������ ����� �� ������ ������ �� ��������
				#-------------------------------------------------
								
				$max = count($history_show)-1;
				for ($i = $max; $i >= 0; $i--)
				{				
					$this->node = $history_show[$i];
										 
					$res .= $this->strtr_mod($this->skin['history'], $this->node);						
				}
				
				
			}
			
			return $res;
	}
	
	
	
	/**
	 * ������������ ������ ��������� ����������� �������
	 *
	 */
	public function createNodesLastBlock()
	{
		$res = '';
		
		if (($this->std->settings[$this->mod_name.'_last_type'] != '0'))
		{
			# � ���������� �������, ��� ������ ����� ��������!

			# ������ ����� ����������, ��� ����� �������� ��� ������:
			if (
				($this->std->settings[$this->mod_name.'_last_type'] == '1') ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '2') && (count($this->std->alias) == 0)) ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '3') && (count($this->std->alias) == 1) && ($this->std->alias[0] == $this->mod_name)) ||
				(($this->std->settings[$this->mod_name.'_last_type'] == '4') && (count($this->std->alias) > 1) && ($this->std->alias[0] == $this->mod_name))
			)
			{
				$res = $this->getNodesLast($this->skin['last'], $this->std->settings[$this->mod_name.'_last_count']);				
			}
		}
		
		return $res;
	}
	
	
	/**
	 * ������������ ������ ������ �������
	 *
	 */
	public function createNodesBestBlock()
	{
		$res = '';
		
		if ($this->std->settings[$this->mod_name.'_best_type'] != '0')
		{
			# � ���������� �������, ��� ������ ����� ��������!

			# ������ ����� ����������, ��� ����� �������� ��� ������:
			if (
				($this->std->settings[$this->mod_name.'_best_type'] == '1') ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '2') && (count($this->std->alias) == 0)) ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '3') && (count($this->std->alias) == 1) && ($this->std->alias[0] == $this->mod_name)) ||
				(($this->std->settings[$this->mod_name.'_best_type'] == '4') && (count($this->std->alias) > 1) && ($this->std->alias[0] == $this->mod_name))
			)
			{
				$res = $this->getNodesBest($this->skin['best'], $this->std->settings[$this->mod_name.'_best_count']);				
			}
		}
		
		return $res;
		
		
		
		/*if ((($this->std->settings[$this->mod_name.'_best_onlymain'] != 1) || (count($this->std->alias) == 0)) && ($this->std->settings[$this->mod_name.'_best_count_on_mainpage'] > 0))
		{
			$best = $this->getNodesBest($this->skin['node_best_onmain'], $this->std->settings[$this->mod_name.'_best_count_on_mainpage']);
			$this->updatePul($this->mod_name.'_best', $best);
		}*/
	}
	
	
	
	/**
	 * ������������ ���� � ��������, � ������� ���� ����
	 *
	 * @return unknown
	 */
	public function getMenuWithChild()
	{
		$res = '';
		$nodes = array();
		
			
		if (count($this->childs) > 0)
		foreach ($this->childs as $node)
		{			
			if ($node['is_sheet'] == '0')
			{
				# ���� ����
				$tmp = $this->skin['menu_withchilds']['item'];
				$node = $this->formatFreeData($node);				
				$nodes[] = $this->strtr_mod($tmp, $node);				
			}
			
		}
		
		if (count($nodes) > 0)
		{		
			$res .= $this->skin['menu_withchilds']['begin'];
			$res .= implode($this->skin['menu_withchilds']['delimiter'], $nodes);
			$res .= $this->skin['menu_withchilds']['end'];
		}
		
		
		return $res;
	}
	
	
	/**
	 * ������������ ���� � ��������, � ������� ��� �����
	 *
	 * @return unknown
	 */
	public function getMenuWithoutChild()
	{
		$res = '';
		$nodes = array();
		
				
			
		#-----------------------------------------
		# �����: ��������� �������
		#-----------------------------------------
		
		
		$start = $this->std->settings[$this->mod_name.'_count_onpage']*$this->curpage;
		$end = $start + $this->std->settings[$this->mod_name.'_count_onpage'];
		$i = 0;	

		if (count($this->childs) > 0)
		foreach ($this->childs as $node)
		{
			
			if ( ($node['is_sheet'] == '1') && ($i >= $start) && ($i < $end))
			{
				# ��� ����� ����
				$tmp = $this->skin['menu_withoutchilds']['item'];
				$node = $this->formatFreeData($node);				
				$nodes[] = $this->strtr_mod($tmp, $node);				
			}
			$i++;
		}
		
		if (count($nodes) > 0)
		{		
			$res .= $this->skin['menu_withoutchilds']['begin'];
			$res .= implode($this->skin['menu_withoutchilds']['delimiter'], $nodes);
			$res .= $this->skin['menu_withoutchilds']['end'];
			
			
			#-----------------------------------------
			# ��������� �������
			#-----------------------------------------
				
			$this->setPul($this->mod_name.'_arrows',  $this->std->build_pagelinks( array( 'TOTAL_POSS'   => count($this->childs),
	                                                          'PER_PAGE'     => $this->std->settings[$this->mod_name.'_count_onpage'],	// ������� �� ��������
	                                                          'CUR_ST_VAL'   => $this->curpage+1,
	                                                          'L_SINGLE'     => "",
	                                                          'L_MULTI'      => "��������: ",
	                                                          'BASE_URL'     => '/'.implode('/', $this->std->alias).'/',
	                                                          'leave_out'    => $this->std->settings['arrows_around'], // ������� ����� ���������� �������
	                                                          'IGNORE_REVERT'=> 0,
	                                                      ) ));	
		}
		
		
		return $res;
	}

	
	/**
	 * ��������� �������������� ���������� ��������/�������
	 * ������������� ������������ �� ��������� �������� URI
	 *
	 */
	public function getIdPage()
	{
		//$id = $this->std->MixedToInt($this->std->alias[count($this->std->alias)-1], true);
		$id = -1;
		$id = $this->std->alias[count($this->std->alias)-1];
		$id = $id == $this->mod_name ? -1 : $id;
		
		
		if (!$this->initTreeWithoutSheet('id, pid, alias, is_redirect'))
		{
			return $id; // ���� ������� ������, �� �������
		}
		
		
		while ((isset($this->nosheet_id[$id])) && ($this->nosheet_id[$id]['is_redirect'] == 1))
		{
			if (isset($this->nosheet_pid[$id]))
			{
				$keys = array_keys($this->nosheet_pid[$id]);
				$id = $this->nosheet_id[$keys[0]]['id'];
			}
			else
			{
				$sql = "SELECT id FROM {$this->table} WHERE is_active=1 AND pid = {$id} ORDER BY item_order";
				if ($this->db->query($sql, $rows) > 0)
				{
					$id = $rows[0]['id'];
					return $id;
				}
			}
			
			
		}
		
		
		return $id;
		
		
		# ���� � ������� �������� �������� �� �������, �� ����� ���������� ������������� ����� �������
		/**/
		
		
		
		
	}
	
	
	/**
	 * ������������� ���� ������� ��������
	 *
	 */
	public function getNodeData()
	{
		if ($this->curid == -1)
		{	
			# ������� �������� ������ - ���� ���������� �� ������ "����������� ��������"
			$sql = "SELECT * FROM se_static WHERE pid = '-1' AND alias = '{$this->mod_name}' LIMIT 1";
			if ($this->db->query($sql, $rows) > 0)
			{
				$this->node = $rows[0];
				$this->formatData();
				
				
				
				foreach ($this->node as $key => $value)
				{
					$this->updatePul($key, $value);
				}
			}	
		}
		elseif ($this->node = $this->getNodeById($this->curid))
		{
			# ���������� �������� ������
			$this->formatData();
			
			
			foreach ($this->node as $key => $value)
			{
				$this->updatePul($key, $value);
			}
		}
		else
		{
			return false;
		}
	}
	
	
	/**
	 * ���������� ������ � ������������ ���� �������� ������� �������� �����������
	 *
	 */
	public function formatData()
	{		
		$this->node['timestamp']		= $this->std->getSystemTime($this->node['timestamp'], $this->skin['timestamp']);
		$this->node['description']		= $this->std->build_meta_tags($this->node['description'], 'description');
		$this->node['keywords']			= $this->std->build_meta_tags($this->node['keywords'], 'keywords');		
		$this->node['basket_add']		= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_MenuWithoutChild'], $this->node) : '';
		$this->node['to_shop']			= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_GoodPage'], $this->node) : '';
		
		$this->node['alias'] 			= $this->getAliasByPid($this->node);
		$this->node['parent_alias']		= substr($this->node['alias'], 0, strlen($this->node['alias']) - strlen($this->node['id'].'/'));
		$this->node['parent_title']		= $this->nosheet_id[$this->node['pid']]['title'];
		
		
		
		# ����
		if ($this->node['img'] != '')
		{
			$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/source/'.$this->node['img'].'/'.$this->node['id'].'.jpg';						
			$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/th/'.$this->node['img'].'/'.$this->node['id'].'_th.jpg';
			$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/img/'.$this->node['img'].'/'.$this->node['id'].'_img.jpg';
			
		}
		else
		{
			$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
			
		}		
		
		
		unset($this->node['template']);
	}
	
	
	public function formatFreeData($node)
	{
		$tmp = $this->node;
		$this->node = $node;
		$this->formatData();
		$node = $this->node;
		$this->node = $tmp;
		
		return $node;
	}
	

	/**
	 * ������������ ������ ��������� ����������� �������
	 *
	 * @param unknown_type $template - ������ ����������
	 * @param unknown_type $count	- ���������� ��������� �������
	 * @param unknown_type $is_update	- ������������� �������� ���
	 * @return unknown
	 */	
	public function getNodesLast($template, $count = 5, $is_update = false)
	{
		# ����� ���������, ���� �� ���� � ����� �����
		$res = '';
		
		# ������� ���� � �����
		if ($is_update)
		{
			unlink($this->filepath.'/last.dat');
		}
		
		
		if (file_exists($this->filepath.'/cache/last.dat') && ($this->std->settings[$this->mod_name.'_cache'] == '1')  &&  ($this->std->member['user_access'] != '1'))
		{
			# ��� ����, ����� ��� ������ ����� � �������
			$res = file_get_contents($this->filepath.'/cache/last.dat');
		}
		else
		{
			# ���� ���, ����� ������������ ��� ������
			
			$sql = "SELECT * FROM {$this->table}				
					WHERE is_active = 1 AND is_sheet = 1
					ORDER BY timestamp DESC
					LIMIT {$count}";
			if ($this->db->query($sql, $rows) > 0)
			{			
				# ���� ��������� �����, �� ������
				foreach ($rows as $node)
				{					
					$node = $this->formatFreeData($node);					
										
					$res .= $this->strtr_mod($template, $node);					
				}
			}
			
			# ������ ����� ���� � �����, ���� � ���������� ��������� ����������� ������
			if ($this->std->settings[$this->mod_name.'_cache'] == '1')
			{
				# ������ ����� ���� � �����
				file_put_contents($this->filepath.'/last.dat', $res);
				$this->std->moveFile($this->filepath.'/last.dat', 'last.dat',  $this->filepath.'/cache', 1, $error);
			}
		}
		
		
		return $res;
	}
	
	
	
	

	/**
	 * ������������ ������ ����������/������ ������� ��� ������ �� ������� �������� (��� �� ����� ������)
	 * @param unknown_type $template - ������ ����������
	 * @param unknown_type $count	- ���������� ��������� �������
	 * @param unknown_type $is_update	- ������������� �������� ���
	 * @return unknown
	 */	
	public function getNodesBest($template, $count = 5, $is_update = false)
	{		
		# ����� ���������, ���� �� ���� � ����� �����
		$res = '';
		
		# ������� ���� � �����
		if ($is_update)
		{
			unlink($this->filepath.'/best.dat');
		}
		
		
		if (file_exists($this->filepath.'/cache/best.dat') && ($this->std->settings[$this->mod_name.'_cache'] == '1')  &&  ($this->std->member['user_access'] != '1'))
		{
			# ��� ����, ����� ��� ������ ����� � �������
			$res = file_get_contents($this->filepath.'/cache/best.dat');
		}
		else
		{
			# ���� ���, ����� ������������ ��� ������
			
			$sql = "SELECT * FROM {$this->table}				
					WHERE is_active = 1 AND is_best = 1  AND is_sheet = 1
					ORDER BY timestamp DESC
					LIMIT {$count}";
			if ($this->db->query($sql, $rows) > 0)
			{			
				# ���� ��������� �����, �� ������
				foreach ($rows as $node)
				{					
					$node = $this->formatFreeData($node);															
					$res .= $this->strtr_mod($template, $node);					
				}
			}
			
			
			# ������ ����� ���� � �����, ���� � ���������� ��������� ����������� ������
			if ($this->std->settings[$this->mod_name.'_cache'] == '1')
			{				
				file_put_contents($this->filepath.'/best.dat', $res);
				$this->std->moveFile($this->filepath.'/best.dat', 'best.dat',  $this->filepath.'/cache', 1, $error);
			}
		}
		
		
		return $res;
	}
	
	


	/**
	 * ������������ ������������ ���� �� ������
	 *
	 */
	public function createModMenu()
	{
		$res = '';
		
		# ���������, ����� �� ������ ����������� ���� �� ������
		if ($this->std->settings[$this->mod_name.'_menu'] == '0')
		{
			return $res;
		}

		
		
		if (!$this->initTreeWithoutSheet())
		{
			return $res; // ���� ������� ������, �� �������
		}
		
	
		#----------------------------------------------------------------------------
		# ���������� ������ ������, ������� ������ � "����" ������ �������� ��������
		#----------------------------------------------------------------------------
		if ($this->std->alias['0'] == $this->mod_name)		
		for ($i = 1; $i < count($this->std->alias); $i++ )
		{
			$this->show_id[] = $this->std->alias[$i];
		}
		
		
		# �������� ������������ ������� ���������� ����
		$res = $this->CreatModMenuNodes('-1', 1 );
	
		
		
		
		return $res;
	}
	
		
	
	

	/**
	 * ��������� � �������� ��� ��������� ���� �� ������
	 */
	function CreatModMenuNodes($pid, $level)
	{		
		$res = '';
	
		
		if (is_array($this->nosheet_pid[$pid]))
		{
			$res = $this->skin['menuexpanded']['begin'][$level];
			
			foreach ($this->nosheet_pid[$pid] as $item)
			{
				$tmp = $this->skin['menuexpanded']['inactive'][$level];
				if (!in_array($item['id'], $this->show_id))
				{
					$tmp = str_replace("{class}", 'class="closed"', $tmp);
					
				}
				else
				{
					$tmp = str_replace("{class}", '', $tmp);
					
					
				}
				$tmp = str_replace("{title}", $item['menu'], $tmp);
				$res .= str_replace("{alias}", $this->getAliasByPid($item), $tmp);				
				
				$res .= $this->CreatModMenuNodes($item['id'], $level+1);
				
				$res .= $this->skin['menuexpanded']['inactive_end'][$level];
			}
			$res .= $this->skin['menuexpanded']['end'][$level];
		}
		
		return $res;
	}
	
	
	
	

	/**
	 * ������������ ���� �� ������
	 *
	 */
	public function createModPath()
	{
		$res = array();

		foreach ($this->std->alias as $item)
		{
			if ($item == $this->mod_name)
			{
				$node['alias'] = '/'.$this->mod_name.'/';
				$node['title'] = $this->std->modules_all[$this->mod_name]['title'];
			}
			else
			{
				$node = $this->nosheet_id[$item];
				$node = $this->formatFreeData($node);
			}
			
						
			
			$res[] = $this->strtr_mod($this->skin['path_item'], $node);			 
		} 

		# ��������� ����� ����	
		$res[count($res)-1] = $this->strtr_mod($this->skin['path_curitem'], $this->node);	
		
		$res = implode($this->skin['path_delimiter'], $res);
		return $res;
	}
	
	
	
	
}






?>