<?php
/**
 * ���������������� �����
 *
 */



require_once 'class_tree_frontend.php';

class main_news extends class_tree_frontend 
{


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
				ORDER BY pid, timestamp DESC";
		
		# ���� ��� �����, �� ���������� ��� �������, � ������� ����
		if ($this->issetUser())
		{
			# ���� �������������, �� ���������� ��!
			if ($this->std->member['user_access'] == 1)
			{
				$sql = "SELECT * FROM {$this->table} 
				WHERE pid='$id' 
				ORDER BY pid, timestamp DESC";
			}
		}
			 
		
		
				
		if ($this->db->query($sql, $rows) > 0)
		{
			return $rows;
		}	
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
		
		
		if ((count($this->std->alias) == 1))
		{
			return -1;
		}
		
		
		
		
		
//		while ((isset($this->nosheet_id[$id])) && ($this->nosheet_id[$id]['is_redirect'] == 1))
//		{
//			if (isset($this->nosheet_pid[$id]))
//			{
//				$keys = array_keys($this->nosheet_pid[$id]);
//				$id = $this->nosheet_id[$keys[0]]['id'];
//			}
//			else
//			{
//				$sql = "SELECT id FROM {$this->table} WHERE is_active=1 AND pid = {$id} ORDER BY item_order";
//				if ($this->db->query($sql, $rows) > 0)
//				{
//					$id = $rows[0]['id'];
//					return $id;
//				}
//			}
//			
//			
//		}

		
		
	
		
		
		
		# ����� 
		$len = count($this->std->alias);
		$id = -1;
		$error = false;
		
		for ($i = 1; $i < $len; $i ++)
		{
				
				
				$alias = $this->std->alias[$i];
				$alias_is_find = false;
				
				// ���� ����� ����� ������� � alias �������� �������� ����
				if (isset($this->nosheet_pid[$id]))
				{					
					$child_count = count($this->nosheet_pid[$id]);
					foreach ($this->nosheet_pid[$id] as $item)
					{
						if ($item['alias'] == $alias)
						{
							$id = $item['id']; // ��������� ������� � ����
							$this->id_for_alias[$id] = $id; // ID � ������, ���������� ��� ������������ ����
							$this->for_path[] = array('alias' => $alias, 'title' => $item['menu']); // ���������� ��� ������������ ����
							$alias_is_find = true;
							
						}
					}
					
					if (!$alias_is_find)
					{
						$error = true;
						continue;
					}
				}
				else
				{
					if ($i == $len-1)
					{
						// �� � ������� ����� �� �����, ������ ����� ���������� ��� �������������
						$sql = "SELECT id, alias, menu FROM ".$this->table." WHERE pid = {$id} AND alias = '{$alias}'";
						if ($this->std->db->query($sql, $rows) > 0)
						{
							$id = $rows[0]['id'];
							$this->id_for_alias[$id] = $id; // ID � ������, ���������� ��� ������������ ����
							$this->for_path[] = array('alias' => $rows[0]['alias'], 'title' => $rows[0]['menu']); // ���������� ��� ������������ ����							
						}
						else
						{
							$error = true;
						}
					}
					else
					{
						$error = true;
						continue;
					}
				}
				
		}

		if (!$error)
		{
			$this->IdCurPage = $id;
			return $this->IdCurPage;
		}
		
		
		return false;
		
		
		
	}
}


?>