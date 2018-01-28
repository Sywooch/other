<?php


require_once 'class_tree_frontend.php';

class main_catalog extends class_tree_frontend
{
	
	
	
	/**
	 * Приведение данных к определённому виду согласно заданым шаблонам отображения
	 *
	 */
	public function formatData()
	{
                // определяем что вывести в поле ЦЕНА
                if (($this->node['price'] == 0) || ($this->node['price_show'] == 0))
                {
                    $this->node['price'] = 'уточняйте у<br>менеджеров';
                }


		$this->node['timestamp']		= $this->std->getSystemTime($this->node['timestamp'], $this->skin['timestamp']);
		$this->node['description']		= $this->std->build_meta_tags($this->node['description'], 'description');
		$this->node['keywords']			= $this->std->build_meta_tags($this->node['keywords'], 'keywords');		
		$this->node['basket_add']		= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_MenuWithoutChild'], $this->node) : '';
		$this->node['to_shop']			= ($this->node['is_sheet'] == '1') ? $this->strtr_mod($this->skin['basket_add_for_GoodPage'], $this->node) : '';
		
		$this->node['alias'] 			= $this->getAliasByPid($this->node);		
		$this->node['parent_alias']		= substr($this->node['alias'], 0, strlen($this->node['alias']) - strlen($this->node['id'].'/'));
		$this->node['parent_title']		= $this->nosheet_id[$this->node['pid']]['title'];
		$this->node['parent_titles']	= $this->getParentTitles($this->node['pid']);
		
		# фото
		$is_img = false;
		if ($this->node['img'] != '')
		{	
			# фото есть, нужно проверить есть ли его "ресайз" версия
			$insource = $this->std->config['folder_files'].'/'.$this->mod_name.'/source/'.$this->node['img'];

if ($this->node['id'] == '30006') echo '=./'.str_replace('/source/', '/img/', $insource);
			if (!file_exists('./'.str_replace('/source/', '/img/', $insource)))
			{
				# файла нет. Нужно взять исходник и ресайзить его				
				if ($this->resize($insource) == '')
				{					
					$is_img = true;
				}
			}
			else
			{
				$is_img = true;
			}
		}

		if (!$is_img)
		{
				$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
				$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
				if ($this->node['id'] < 999)
				{
						// no image for catalog page
						$this->node['img'] = '';
				}
				else
				{
						// default image for catalog item page
						$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/default.jpg';
				}
		}
		else
		{
				$this->node['img_big'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/source/'.$this->node['img'];						
				$this->node['img_th'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/th/'.$this->node['img'];
				$this->node['img'] = '/'.$this->std->config['folder_files'].'/'.$this->mod_name.'/img/'.$this->node['img'];
		}
		
		unset($this->node['template']);
	}
	
	
	/**
	 * Предок товара
	 *
	 * @param unknown_type $pid
	 * @return unknown
	 */	
	private function getParentTitles($pid)
	{
		$res = $this->nosheet_id[$pid]['menu'];
		$pid = $this->nosheet_id[$pid]['pid'];
		
		# первый предок
		if (isset($this->nosheet_id[$pid]))
		{	
			$res = $this->nosheet_id[$pid]['menu'].' / '.$res;		
			$pid = $this->nosheet_id[$pid]['pid'];
			
			
			# второй предок
			if (isset($this->nosheet_id[$pid]))
			{					
				$res = $this->nosheet_id[$pid]['menu'].' / '.$res;
				$pid = $this->nosheet_id[$pid]['pid'];
				
				# третий предок
				if (isset($this->nosheet_id[$pid]))
				{
					$res = $this->nosheet_id[$pid]['menu'].' / '.$res;
				}
			}
		}
		
		return $res;
	}
	
	
	
	
	/**
	 * полуный путь к исходному файлу
	 *
	 * @param unknown_type $insource - полный путь к исходному файлу
	 */
	function resize($insource)
	{
			$error = '';
			
			
			
			if (!file_exists('./'.$insource))
			{
				$error .= 'Файл недоступен для ресайза<br>';
			}
		
			# инициализация класса для ресайза фото
			$error .= $this->std->initImage($this->mod_name);
			
			# папка - дата, в которой будут сохраняться загруженные фотографии
			$folder == '';
						
			if ($error == '')
			{
				try 
				{ 
										
					# ресайз основного фото												
					$outsource = str_replace('/source/', '/img/', $insource); // название файла						
					$this->std->image->resize_img($insource, $outsource);
					
					# ресайз привью													
					$outsource = str_replace('/source/', '/th/', $insource); // название файла						
					$this->std->image->resize_th($insource, $outsource);
					
					
					
				}catch (Exception $e) 
				{
					$error .= 'Возникла ошибка при изменении размеров фото: '.$e->getMessage().'<br>'; 
					$this->log('Bзменении размеров фото: '.$e->getMessage());
				}								
			}
			
			return $error;
	}
	
	
	
	/**
	 * вызов функций и обработчиков, готовящих данные для страницы-лиска модуля
	 *
	 */
	public function workItemPage()
	{
		/*# формирование блока истории просмотра страниц модуля ()
		$this->updatePul($this->mod_name.'_attend', $this->getAttend());
		
		# формирование блока аналогичных пунктов
		$this->updatePul($this->mod_name.'_analog', $this->getAnalog());*/
		
		parent::workItemPage();
		
		
		# формирование блока перелинковки
		$this->updatePul($this->mod_name.'_overlinks', $this->getOverLinks());
	}
	
	
	/**
	 * Перелинковка товаров
	 *
	 * @return unknown
	 */
	private function getOverLinks()
	{		
		$res = array();
		
		
		# запсро списка аналогичных	
		$sql = "SELECT * FROM {$this->table}
				WHERE pid = '".$this->curpid."' AND is_active = 1";
		if ($this->db->query($sql, $rows) > 0)
		{
			if (count($rows) > $this->std->settings[$this->mod_name.'_overlinks_count'])
			{
				$count = count($rows)-1;
				
				for($i == 0; $i < $this->std->settings[$this->mod_name.'_overlinks_count']; $i++)
				{
					
					$rand = rand(0, $count);
					if (isset($rows[$rand]))
					{
						$row = $this->formatFreeData($rows[$rand]);
						unset($rows[$rand]);					
									
						$res[] = $this->strtr_mod($this->skin['overlink']['item'], $row);
					}
					else
					{
						$i--;
					}
					
				}
			}
			else
			{
				foreach ($rows as $row)
				{
					$row = $this->formatFreeData($row);					
								
					$res[] = $this->strtr_mod($this->skin['overlink']['item'], $row);	
				}
					
			}
			
		}

		if (count($res) > 0)
		{
			$res = implode($this->skin['overlink']['delimiter'], $res);
		}
		else
		{
			$res = '';
		}
		
		
		return $res;
	}
	
	
	

	/**
	 * Формирование списка последних добавленных пунктов
	 *
	 * @param unknown_type $template - шаблон оформления
	 * @param unknown_type $count	- количество выводимых пунктов
	 * @param unknown_type $is_update	- принудительно обновить кеш
	 * @return unknown
	 */	
	public function getNodesLast($template, $count = 5, $is_update = false)
	{
		# нужно проверить, есть ли файл с кешем блока
		$res = '';
		
		# удалить файл с кешем
		if ($is_update)
		{
			unlink($this->filepath.'/last.dat');
		}
		
		
		if (file_exists($this->filepath.'/cache/last.dat') && ($this->std->settings[$this->mod_name.'_cache'] == '1')  &&  ($this->std->member['user_access'] != '1'))
		{
			# кеш есть, нужно его просто взять и вывести
			$res = file_get_contents($this->filepath.'/cache/last.dat');
		}
		else
		{
			# кеша нет, нужно сформировать его заново
			
			$sql = "SELECT * FROM {$this->table}				
					WHERE is_active = 1 AND is_sheet = 1 AND is_last = 1
					ORDER BY id DESC
					LIMIT {$count}";
			if ($this->db->query($sql, $rows) > 0)
			{			
				# если структура пуста, то уходим
				foreach ($rows as $node)
				{					
					$node = $this->formatFreeData($node);					
										
					$res .= $this->strtr_mod($template, $node);					
				}
			}
			
			# создаём новый файл с кешем, если в настройках разрешено кеширование модуля
			if ($this->std->settings[$this->mod_name.'_cache'] == '1')
			{
				# создаём новый файл с кешем
				file_put_contents($this->filepath.'/last.dat', $res);
				$this->std->moveFile($this->filepath.'/last.dat', 'last.dat',  $this->filepath.'/cache', 1, $error);
			}
		}
		
		
		return $res;
	}
	
}


?>