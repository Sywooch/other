<?php

/**
 * админка
 *
 */



require_once 'class_tree_backend.php';

class mod_news extends class_tree_backend 
{


	/**
	 * Формирование списка вершин одного уровня
	 *
	 */
	public function getNodesListByPid()
	{
		$res = '';

		# запрос списка вершин одного уровня
		$sql = "SELECT t1.*, t2.is_active AS parent_active FROM {$this->table} t1
				LEFT JOIN {$this->table} t2 ON (t1.pid = t2.id)
				WHERE t1.pid='{$this->curpid}' ORDER BY t1.timestamp DESC";
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
			# пусто
			$this->std->setPul('admin', 'info', '<b>Раздел пуст</b> (<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/add/'.$this->curpid.'/">Добавить раздел</a>)');

		}
			
		$this->updatePul('body', $res);
		
		
		
		
		# если показываем не главный раздел, то можно и пакетную заливку делать
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
			# шаблон формы берём из собственного t_config
			$form = strtr($this->skin['photomultiupload_form'], $pms);
			
			$this->std->setPul('admin', 'info', $form);
		}		
		
	}
	
	
	
	
	/**
	 * пункты
	 *
	 * @return unknown
	 */
	public function getNodesListItem($replace, $row_count, $i)
	{
		$replace['color'] = $replace['is_active'] == 1 ? 'CCFFCC' : 'dedede';
		$replace['alias'] = $this->getAliasByPid($replace);
		$replace['timestamp'] = $this->std->getSystemTime($replace['timestamp']);
		$replace['is_active_src'] = $replace['is_active'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/play.png' : '/'.$this->std->config['folder_admin'].'/image/stop.png';
		$replace['is_active_title'] = $replace['is_active'] == 1 ? 'Деактивировать' : 'Активировать';
		$replace['is_best_src'] = $replace['is_best'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/best_active.png' : '/'.$this->std->config['folder_admin'].'/image/best_inactive.png';
		$replace['is_best_title'] = $replace['is_best'] == 1 ? 'Убрать из списка отмеченных' : 'Пометить в список отмеченных';		
		$replace['is_active_disabled'] = (($replace['parent_active'] == 0) && (!is_null($replace['parent_active']))) ? 'disabled' : '';
		$replace['order_button'] = $this->std->order_button($row_count, $i, $replace['id'], $replace, $this->mod_name);


		$pms = array();
		foreach ($replace as $key => $value)
		{
			$pms['{'.$key.'}'] = $value;
		}
		
		# демонстрация фото
		if ($replace['img'] == '')
		{
			$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="Редактировать"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a>';
		}
		else
		{
			$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="Редактировать"><img src="/'.$this->std->config['path_files'].'/'.$this->mod_name.'/th/'.$replace['img'].'/'.$replace['id'].'_th.jpg"></a>';
		}
		
		
		# ссылка на структуру сложенных страниц
		$tree = '-';
		if ($this->std->settings[$this->mod_name.'_levels'] != 1)
		{			
			# если показываем УЗЕЛ, тогда показываем и картинку каталога
			if ($replace['is_sheet'] == '0')
			{
				$tree = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/{id}/" title="Список подкаталогов"><img src="/'.$this->std->config['path_admin'].'/image/catalog.png"></a>';
			}
		}
		
		
		 
		

		$item = '<tr style="background:#{color};">
					<td align=center><input name="action[{id}]" type="checkbox" title="Выбрать"></td>
					<td align=center>'.$edit.'</td>
					<td align=center>'.$tree.'</td>
					<td align=center><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/best/{pid}/{id}/"><img src="{is_best_src}" title="{is_best_title}"></a></td>					
					<td align=center><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/active/{pid}/{id}/"><img src="{is_active_src}" title="{is_active_title}"></a></td>					
					<td>{title} (<a href="{alias}" target="_new">смотреть</a>)</td>					
					<td align=center>{timestamp}</td>
					<td align=center><a href="javascript:doConfirm(\'Удалить подраздел?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{pid}/{id}/\')" title="Удалить"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return strtr($item, $pms);
	}
	
}


?>