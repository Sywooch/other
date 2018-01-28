<?php

#
# ����� ������������ ����� ����������� �������
#


require_once 'class_abstract.php';  // ����������� �����

class class_tree extends class_abstract 
{
	
	public $curpage = 0;
	





	/**
	 * ����������� ������� ������ - �������� ��� ����������� �����������, ���������� ������ ������
	 *
	 */
	public function main()
	{			
		# �� ����� ����������� � �����������	 
	}
	

	/**
	 * ������� �������� �� ���������� �������� 
	 *
	 */
	public function emptyTree()
	{
		unset($this->id);
		unset($this->pid);
		$this->id	= NULL;
		$this->pid	= NULL;
		$this->nosheet_id	= NULL;
		$this->nosheet_pid	= NULL;		
	}


	/**
	 * ��������� ��������� ������.
	 * ��� �������� ������������� ������������� ��������� �� pid, item_order, id
	 *
	 * @param unknown_type $table_name - ��� �������, � ������� ����������
	 * @param unknown_type $params - �������� �������� ����������
	 * @return unknown
	 */
	public function initTree( $params = 'id, pid, title, alias')
	{
		if(!is_null($this->id))
		{
			return true; // ���� ��� ������
		}
		 
		
		# ��� ���������������� �����
		$sql = "SELECT  {$params}
		FROM {$this->table}
		WHERE is_active = 1
		ORDER BY pid, item_order, id";
		
		
		# ���� ��� �����, �� ���������� ��� �������, � ������� ����
		if ($this->issetUser())
		{
			# ���� �������������, �� ���������� ��!
			if ($this->std->member['user_access'] == 1)
			{
				# ��� ������� �� ������ ���� �����
				$sql = "SELECT  {$params}
				FROM {$this->table}			
				ORDER BY pid, item_order, id";
			}
		}
		

		if ($this->db->query($sql, $rows) > 0)
		{
			// ������������ �������� - ������� ��� ������ � ��������
			foreach ($rows as $row)
			{
				$this->pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->id[ $row['id'] ] = &$this->pid[$row['pid'] ][ $row['id'] ];
			}
			return true;
		}

		return false; // ��� ������, �����
	}
	
	
	

	/**
	 * ��������� ��������� ������.
	 * ��� �������� ������������� ������������� ��������� �� pid, item_order, id
	 *
	 * @param unknown_type $table_name - ��� �������, � ������� ����������
	 * @param unknown_type $params - �������� �������� ����������
	 * @return unknown
	 */
	public function initTreeWithoutSheet( $params = 'id, pid, title, alias, menu')
	{
		if(!is_null($this->nosheet_id))
		{
			return true; // ���� ��� ������
		}
		 
		
		# ��� ���������������� �����
		$sql = "SELECT  {$params}
		FROM {$this->table}
		WHERE is_active = 1 AND is_sheet = 0
		ORDER BY pid, item_order, id";
		
		
		# ���� ��� �����, �� ���������� ��� �������, � ������� ����
		if ($this->issetUser())
		{
			# ���� �������������, �� ���������� ��!
			if ($this->std->member['user_access'] == 1)
			{
				# ��� ������� �� ������ ���� �����
				$sql = "SELECT  {$params}
				FROM {$this->table}	
				WHERE is_sheet = 0		
				ORDER BY pid, item_order, id";
			}
		}
		

		if ($this->db->query($sql, $rows) > 0)
		{
			// ������������ �������� - ������� ��� ������ � ��������
			foreach ($rows as $row)
			{
				$this->nosheet_pid[ $row['pid'] ][ $row['id'] ] = $row;
				$this->nosheet_id[ $row['id'] ] = &$this->nosheet_pid[$row['pid'] ][ $row['id'] ];
				$this->nosheet_alias[ $row['alias'] ] = &$this->nosheet_pid[$row['pid'] ][ $row['id'] ];				
			}
			return true;
		}

		return false; // ��� ������, �����
	}	


	/**
	 * ��������� �������������� ������� �� ������ ��������
	 *
	 * @return int  - ������������� ������� ��� false, ���� ��������� ������
	 */
	function getIdByAlias()
	{
			
		# ���� ��������� �����, �� ������
		if (!$this->initTree())
		{
			return false;
		}


		$statr = 0; // �������� � ������� ��������, ���� ��� ����������� ��������
		if ($this->mod_name == $this->std->alias[0])
		{
			$statr = 1;	// �������� �� ������� ��������, ���� ���������� �� ����������� ��������
		}

		# ��������
		$pid = '-1';
			
		# �����
		$len = count($this->std->alias);
		for ($i = $statr; $i < $len; $i ++)
		{
			# ������� ����� ������
			$is_find = false;

			foreach ($this->pid[$pid] as $item)
			{
				if ($item['alias'] == $this->std->alias[$i])
				{
					$pid = $item['id'];
					$is_find = true;
					break;
				}
			}

			# ���� ���������� ���, �� ��� ������
			if (!$is_find)
			{
				return FALSE;
			}
		}


		# ���� �� ������ �������, �� ���������� �������������
		if ($is_find)
		{
			return $this->id[$pid]['id'];
		}

		return FALSE;
	}

	/**
	 * ��������� ������ �������� �� ��������������  �������
	 *
	 *  return string  - ����� ��������
	 */
	function getAliasByPid($cur_node)
	{
		$res = '/'.$this->mod_name.'/';
		$pid = $cur_node['pid'];
		
		# ���� ��������� �����, �� ������		
		if (!$this->initTreeWithoutSheet())
		{
			return $res.$cur_node['id'].'/';
		}
		
		# ���� �� � ������� � ������� ����������, ����� ����� ���-�� �����������
		if ($this->nosheet_id[$pid])
		{
			$node = $this->nosheet_id[$pid];
			$uri = $node['alias'].'/';
			while ($node['pid'] != -1)
			{				
				$node = $this->nosheet_id[$node['pid']];
				$uri = $node['alias'].'/'.$uri;
			}
		}
		$res .= $uri.$cur_node['alias'].'/';
		unset($cur_node);
		return $res;
	}
	
	

	/**
	 * ��������� ������ �������� �� �������������� �������
	 *
	 *  return string  - ����� ��������
	 */
	function getAliasById($id)
	{
		$res = '/'.$this->mod_name.'/';
		
		# ���� ��������� �����, �� ������		
		if (!$this->initTree())
		{
			return false;
		}
		
		# ���� �� � ������� � ������� ����������, ����� ����� ���-�� �����������
		if ($this->id[$id])
		{
			$node = $this->id[$id];
			$uri = $node['alias'].'/';
			while ($node['pid'] != -1)
			{				
				$node = $this->id[$node['pid']];
				$uri = $node['alias'].'/'.$uri;
			}
		}
		$res .= $uri;
		return $res;
	}	

	
	/**
	 * ������������ ������ �������
	 *
	 * @param unknown_type $id  - ������������� �������
	 * @return unknown
	 */
	protected function getNodeById($id)
	{
		# ������ ������ � ������� ��� �������� ������������ �������
		$sql = "SELECT * FROM {$this->table} WHERE is_active = 1 AND id='{$id}'";
		
		# ���� ��� �����, �� ���������� ��� �������, � ������� ����
		if ($this->issetUser())
		{
			# ���� �������������, �� ���������� ��!
			if ($this->std->member['user_access'] == 1)
			{
				# ������ ������ � ������� ��� �������������� �������
				$sql = "SELECT * FROM {$this->table} WHERE id='{$id}'";
			}
		}
		
		
		if ($this->db->query($sql, $rows) > 0)
		{	
			if ($this->std->alias[0] != 'admin')
			{
				$this->curpid = $rows[0]['pid'];
			}
			return $rows[0];
		}
		else
		{
			$this->template = 'error';			
		}
		
		return false;
	}
	
	
	/**
	 * ��������� ������ ��������������� ���� ����� ����� �������, ������� ���� �������
	 *
	 * @param unknown_type $id
	 */
	protected function getNodeChildsId($id)
	{
		$ids = array();
		if (isset($this->pid[$id]))
		{
			foreach ($this->pid[$id] as $node)
			{				
				$ids = array_merge($ids, $this->getNodeChildsId($node['id']));
			}
		}
		return array_merge(array("'".$id."'"), $ids);	
	}


	/**
	 * ��������� ����������� �������
	 *
	 * @param unknown_type $id
	 */
	protected function getChilds($id)
	{
		# ������ �����������
		$sql = "SELECT * FROM {$this->table} 
				WHERE is_active = 1 AND pid='$id'				 
				ORDER BY pid, item_order, id";
		
		# ���� ��� �����, �� ���������� ��� �������, � ������� ����
		if ($this->issetUser())
		{
			# ���� �������������, �� ���������� ��!
			if ($this->std->member['user_access'] == 1)
			{
				$sql = "SELECT * FROM {$this->table} 
				WHERE pid='$id' 
				ORDER BY pid, item_order, id";
			}
		}
			 
		
		
				
		if ($this->db->query($sql, $rows) > 0)
		{
			return $rows;
		}	
	}
	
	
	

	/**
	 * �������� ���� ������
	 *
	 */
	public function clearCache()
	{
		# ������� ��������� ���
		$this->std->rm_dir($this->filepath.'/cache');
	}
	
	
	

	/**
	 * �������� ���� ������
	 *
	 */
	public function clearCacheByNode($node)
	{
		$alias = $this->getAliasByPid($node);
		$filename_cache = implode('_', explode('/',substr($alias,1,strlen($alias)-2))).'.dat'; // �������� ���-����� ��������
		$filename_cache = $this->filepath.'/cache/'.$filename_cache;
		
		if (file_exists($filename_cache))
		{
			# ������� ��������� ���
			@unlink($filename_cache);
		}
		
	}	

}


?>