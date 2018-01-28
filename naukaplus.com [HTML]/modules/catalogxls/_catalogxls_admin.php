<?php

/**
 * админка
 *
 */



require_once 'class_tree.php';

class mod_catalogxls extends class_tree 
{
	public function main()
	{	
		$this->table = 'se_catalog';
		
		
		# модуль имеет админку, значит нужно вывести пункт
		$this->std->setPul('admin', 'menu_addmod', '<li><a class=menu href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/">'.$this->std->modules_all[$this->mod_name]['title'].'</a></li>');
		
		parent::main();
		
		
		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[1] != $this->mod_name)
		{
			# если вызывает другой модуль, то выход
			return;
		}	
		
		
		# заголовок
        $this->std->setPul('admin', 'h1', $this->std->modules_all[$this->mod_name]['title']);
        # содержание
        $this->setPul('body', $this->getImportForm());
		
		
        
        # загружаем новый прайс
		if ($this->std->input['request_method'] == "post") 
		{	
			$out = '';
			$i = 1;
			
			$this->initTree();
			

			foreach ($_FILES["excelfile"]['name'] as $id => $file_name)
			{
				if (($_FILES["excelfile"]['name'][$id] != '') && ($_FILES["excelfile"]["size"][$id] > 0)) 
				{
					
					# удаление всех вложенных вершин выбранного каталога
					$ids_del = $this->getNodeChildsId($id);
					unset($ids_del[0]);
					
					if (count($ids_del) > 0)
					{
						# удаляем
						$sql = "DELETE FROM $this->table WHERE id IN (".implode(',', $ids_del).")";						
						$this->db->do_query($sql);
					}
					
					
					$out .= "Файл №{$i}  загружен-----------------------------------------------<br>".
							$this->loadCatalog($_FILES["excelfile"]['tmp_name'][$id], $id);
					$this->db->do_query("UPDATE {$this->table} SET is_sheet = 0 WHERE id={$id}");
				} else {
					$out .= "Файл №{$i}  не загружен--------------------------------------------<br><br>";
				}
					
				
				$i++;

				//print_r($_FILES["excelfile"]);
			}
			
			$this->std->rm_dir($this->std->config['path_files'].'/catalog/cache');
			
			$this->setPul('body', $out);
		}
        
		
	}
	
	
	
	
	/**
	 * Форма загрузки XLS файла
	 *
	 * @return unknown
	 */
	private function getImportForm() 
	{
		
		# необходимо получить список главных разделов каталога
		# именно в них отдельно будут загружаться файлы со структуров каталога
		$sql = "SELECT * FROM $this->table WHERE pid = -1 ORDER BY item_order";
		if ($this->db->query($sql, $rows))
		{
			$block = '';
			$i = 1;
			
			foreach ($rows as $row)
			{
				$block .= 'Загрузить XLS файл №'.$i.': <input name="excelfile['.$row['id'].']" type="file"> в раздел "'.$row['title'].'", <br><br>';
				$i++;
			}
			
			
			$ret = '<div>Для любого каталога загрузите файл и нажмите "Загрузить"</div><br><br>
			<form method="POST" enctype="multipart/form-data">
			'.$block.'
			<i>Будьте внимательны к правильности составления XLS файла!</i><br>
			<input type="submit" value="Загрузить">
			</form>';
		}
			
		
		return $ret;
	}
	
	
	
	/**
	 * загрузка каталога(ов)
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
				$out .= "Импорт данных прошел успешно<br><br>";
			}
			else 
			{
				$out .= "При импорте возникли ошибки: <br>".$excel->getErrors().'<br><br>';
			}
			unset($excel);
			return $out;
	}
	
	
	
}


?>