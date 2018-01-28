<?php

/**
 * �������
 *
 */



require_once 'class_tree.php';

class mod_catalogxls extends class_tree 
{
	public function main()
	{	
		$this->table = 'se_catalog';
		
		
		# ������ ����� �������, ������ ����� ������� �����
		$this->std->setPul('admin', 'menu_addmod', '<li><a class=menu href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/">'.$this->std->modules_all[$this->mod_name]['title'].'</a></li>');
		
		parent::main();
		
		
		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[1] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}	
		
		
		# ���������
        $this->std->setPul('admin', 'h1', $this->std->modules_all[$this->mod_name]['title']);
        # ����������
        $this->setPul('body', $this->getImportForm());
		
		
        
        # ��������� ����� �����
		if ($this->std->input['request_method'] == "post") 
		{	
			$out = '';
			$i = 1;
			
			$this->initTree();
			

			foreach ($_FILES["excelfile"]['name'] as $id => $file_name)
			{
				if (($_FILES["excelfile"]['name'][$id] != '') && ($_FILES["excelfile"]["size"][$id] > 0)) 
				{
					
					# �������� ���� ��������� ������ ���������� ��������
					$ids_del = $this->getNodeChildsId($id);
					unset($ids_del[0]);
					
					if (count($ids_del) > 0)
					{
						# �������
						$sql = "DELETE FROM $this->table WHERE id IN (".implode(',', $ids_del).")";						
						$this->db->do_query($sql);
					}
					
					
					$out .= "���� �{$i}  ��������-----------------------------------------------<br>".
							$this->loadCatalog($_FILES["excelfile"]['tmp_name'][$id], $id);
					$this->db->do_query("UPDATE {$this->table} SET is_sheet = 0 WHERE id={$id}");
				} else {
					$out .= "���� �{$i}  �� ��������--------------------------------------------<br><br>";
				}
					
				
				$i++;

				//print_r($_FILES["excelfile"]);
			}
			
			$this->std->rm_dir($this->std->config['path_files'].'/catalog/cache');
			
			$this->setPul('body', $out);
		}
        
		
	}
	
	
	
	
	/**
	 * ����� �������� XLS �����
	 *
	 * @return unknown
	 */
	private function getImportForm() 
	{
		
		# ���������� �������� ������ ������� �������� ��������
		# ������ � ��� �������� ����� ����������� ����� �� ���������� ��������
		$sql = "SELECT * FROM $this->table WHERE pid = -1 ORDER BY item_order";
		if ($this->db->query($sql, $rows))
		{
			$block = '';
			$i = 1;
			
			foreach ($rows as $row)
			{
				$block .= '��������� XLS ���� �'.$i.': <input name="excelfile['.$row['id'].']" type="file"> � ������ "'.$row['title'].'", <br><br>';
				$i++;
			}
			
			
			$ret = '<div>��� ������ �������� ��������� ���� � ������� "���������"</div><br><br>
			<form method="POST" enctype="multipart/form-data">
			'.$block.'
			<i>������ ����������� � ������������ ����������� XLS �����!</i><br>
			<input type="submit" value="���������">
			</form>';
		}
			
		
		return $ret;
	}
	
	
	
	/**
	 * �������� ��������(��)
	 *
	 * @return unknown
	 */
	private function loadCatalog($file_name, $id)
	{
		
        	require_once "class_excel.php";
        	$excel = new ClassExcel($this->std);
			$ret = $excel->loadCatalog($file_name, $id);
			if ($ret) 
			{
				$out .= "������ ������ ������ �������<br><br>";
			}
			else 
			{
				$out .= "��� ������� �������� ������: <br>".$excel->getErrors().'<br><br>';
			}
			unset($excel);
			return $out;
	}
	
	
	
}


?>