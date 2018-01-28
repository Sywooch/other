<?php

/**
 * Каталог
 *
 */



require_once 'class_tree_backend.php';

class mod_catalog extends class_tree_backend 
{
	
	
	
	
	/**
	 * пункты
	 *
	 * @return unknown
	 */
	public function getNodesListItem($replace, $row_count, $i)
	{
		$replace['color'] = $replace['is_active'] == 1 ? 'CCFFCC' : 'dedede';
		$replace['alias'] = $this->getAliasByPid($replace);
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
		
		$edit = '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{pid}/{id}/" title="Редактировать"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a>';
		
		
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
					<td align=center>{id}</td>					
					<td>{title} (<a href="{alias}" target="_new">смотреть</a>)</td>					
					<td align=center><input type="text" name="item_order[{id}]" value="{item_order}" size="3"></td>
					<td align=center><a href="javascript:doConfirm(\'Удалить подраздел?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{pid}/{id}/\')" title="Удалить"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return strtr($item, $pms);
	}
	
	
	
	

	/**
	 * формирование формы добавление новой вершины в иерархию
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
                        <td align=right>Активировать сразу:</td>
                        <td><input type=checkbox name=is_active {is_active} {is_active_disabled}></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red>*</font> КОД:</td>
                        <td><input type=text name=id value="{id}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right>Alias (часть пути):</td>
                        <td><input type=text name=alias value="{alias}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red>*</font> Название (title):</td>
                        <td><input type=text name=title value="{title}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                         
		                                      
                        <tr>
                        <td align=right>Родительская страница:</td>
                        <td>
                        <select name=pid style="width:70%;">'.$this->getParentTree(-1, '&nbsp;&nbsp;&nbsp;&nbsp;', 0).'</select>
                        </td>
                        </tr>
                        
                        <!-- Место для новых свойств, которые могут появиться в потомках -->
                		{extend_prebody}';
                		
		if (($this->std->settings[$this->mod_name.'_type'] != '0'))
		{
			
			

			if ($this->std->settings[$this->mod_name.'_type'] == '2')
			{
				$form .= '<tr>
                        <td align=right>Цена:</td>
                        <td>
                        <input type=text name="price" value="{price}" style="width:12%;" maxlength="255">
                        </td>
                        </tr>
                        ';
			}                		
		}
                        
		$form .= '		<tr>
						<td align=right valign=top> Содержимое страницы<br>(HTML-код)</td>
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
                		
                		
                		<!-- Место для новых свойств, которые могут появиться в потомках -->
                		{extend_afterbody}
                		
                		
                		
                		<!-- СЛАЙД С ДОПОЛНИТЕЛЬНЫМИ СВОЙСТВАМИ -->
                		<tr onClick="$(\'#disp\').slideToggle(\'slow\');">
                        <td align=right valign=top></td>
                        <td><a style="cursor:hand; cursor:pointer; text-color:red;">ДОПОЛНИТЕЛЬНО >>></a></td>                        
                        </tr>                        
                        
                	</table>	
                		
                		
                    <div id="disp" style="display:none;">    
                	<table border=0 width=90%>
                	
                		<!-- Место для новых свойств, которые могут появиться в потомках -->
                		{extend_hide}
                	
                		<tr>
                        <td align=right>Автопереход на первую подчинённую страницу:</td>
                        <td><input type=checkbox name=is_redirect {is_redirect}></td>
                        </tr>
                	
                		<tr>
                        <td align=right valign=top>Анонс страницы<br>(HTML-код)</td>
                        <td width=80%><textarea name=sbody style="width:100%;">{sbody}</textarea></td>                        
                        </tr>
                		
                		<tr>
                        <td align=right>Заголовок (h1):</td>
                        <td><input type=text name=h1 value="{h1}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right><font color=red></font> Название в меню:</td>
                        <td><input type=text name=menu value="{menu}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        <tr>
                        <td align=right>Дата формирования:</td>
                        <td><input type="text" name=timestamp value="{timestamp}"> (дд.мм.гггг чч:мм)</td>
                        </tr>

                        <tr>
                        <td align=right>Дата последней редакции:</td>
						<td><input type=text name=lastmodified value="'.$this->std->getSystemTime().'" disabled></td>
                        </tr>
                        
                        <tr>
		                 <td align=right>Автор (подпись):</td>
		                 <td><input type=text name=author value="{author}"  style="width:70%;" maxlength="255"> (а-Яa-Z_0-9 -!)</td>
		                </tr>
		             
		                <tr>
		                 <td align=right>Последний редактор:</td>
		                 <td><b>Будет: '.$this->std->member['user_name'].'</b><input type=hidden name=owner value="'.$this->std->member['user_name'].'"></td>
		                </tr>
                		
                	 	<tr>
		                <td align=right>Описание:</td>
		                <td><input type=text name=description value="{description}" style="width:100%;" maxlength="255"></td>
		                </tr>

		                <tr>
		                 <td align=right>Ключевые слова:</td>
		                 <td><input type=text name=keywords value="{keywords}" style="width:100%;" maxlength="255"> <nobr></nobr></td>
		                </tr>
			            
					</table>
					</div>
					
					
					<input type=submit value="Сохранить" class=f2>
					</form>	
                ';
		
		
		
		$this->setPul('body', $form);
	}
	
	
	

	/**
	 * рекурсивное удаление вершины и всех её потомков
	 *
	 * @param unknown_type $id                - идентификатор вершины
	 * @param unknown_type $delnode        - удалять ли саму вершину? 1 - нет
	 */
	public function del_do()
	{
		# получаем данные о вершине, которую удаляют
		if ($node = $this->getNodeById($this->curid))
		{
			#---------------------------------------
			# находим все подчинённые узлы и листья
			#---------------------------------------
			$this->emptyTree();
			if (!$this->initTree('id, pid, img'))
			{
				return ''; // выход если данных нет
			}
			$ids = $this->getNodeChildsId($this->curid);
			
			
			#---------------------------------------
			# удаляем привязанные фото, если есть
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
			# помечаем узел как ЛИСТ, если наследников больше не осталось
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
			$this->std->setPul('admin', 'info', '<font color="red">Указанной вершины нет в иерархии</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
		}

		# упорядочиваем
		$this->order_do();

		return false;
	}
	
	
	
	/**
	 * заголовок для таблицы списка вершин
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
								<option value="order">Действия
								<!-- option value="active">Актив/деактив
								<option value="best">Отметить
								<option value="del">Удалить  -->
							</select>
							<input type="submit" value="Ок">
						</th>
						<th>Код</th>
						<th>Название</th>
						<th width="10%">Порядок</th>						
						<th width="5%">&nbsp;</th>
						
					</tr>
				<form action="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/order/'.$this->curpid.'/" method="post">
				';
	}
	
	
	

	/**
	 * добавление новой вершины в иерархию
	 *
	 */
	public function add_do()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			# пришла форма - нужно сохранить

			# для начала возмём все данные и провеим на правильность заполнения
			$this->validInput();


			if ($this->std->getPul('admin', 'error') != '')
			{
				# есть ошибка, поэтому нужно заполнить форму и отобразить для исправления

				# но сперва нужно
				$this->input['is_active'] = $this->input['is_active'] == 1 ? 'checked' : '';
				$this->input['is_redirect'] = $this->input['is_redirect'] == 1 ? 'checked' : '';
					

				# вывод формы добавление вершины
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				# определяем порядковый номер создаваемой вершины
				$this->initTree();
				$count_childs = count($this->pid[$this->curpid]);
				++$count_childs;
				$this->input['item_order'] = $this->std->settings[$this->mod_name.'_typeadd'] == 1 ? 0 : 100000;  // учитываем промой/обратный порядок добавления


				#----------------------------------------------
				# данные проверены, можно сохранять
				#----------------------------------------------				
				$this->db->do_insert($this->mod_name, $this->input);
				
				
				
				# получаем ключ новой записи
				//$this->curid = $this->db->get_insert_id();
				# т.к. мы до сих пор используем поле alias, то нужно его заполнить
				//$this->db->do_update($this->mod_name, array('alias' => $this->curid), 'id='.$this->curid);
				
				# в потомках понадобится выполнить дополнительные операции, вызываем обработчик
				//$this->input['id'] = $this->curid;
				$this->add_doAfterSave($this->input);
				


				# учитываем прямой/обратный порядок добавления				
				$this->order_do();
				$this->addTreeToMenu();

				$this->std->setPul('admin', 'info', '<b>Изменения сохранены</b><br>
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curpid.'/'.$this->curid.'/">Редактировать</a>&nbsp;&nbsp;
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
				
				return true;
			}
		}
		else
		{
			# ВЫВОДИМ ФОРМУ
			# готовим некоторые исходные данные для формы
			
			
	
			# если предок неактивен, то нельзя давать возможность пользователя менять статус редактируемой вершины
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
	
	
			# вывод формы добавление вершины
			$this->add_form($pms);
			$this->add_doPreRender($pms);
			$this->replacePul('body', $pms);		
			$this->updatePul('body', $this->endRender($this->getPul('body')));
			$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
		}
		
		return false;
	}

	
	
	
	/**
	 * Преобразование приходящих от формы данных
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
			
			
		# проверка ошибок
		if ($this->input['title'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">На заполнено поле "Название"</font>');
		}
		
		
		# проверка ошибок
		if ($this->input['id'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">На заполнено поле "КОД"</font>');
		}
	}
	
	
	/**
	 * обработка данных перед сохранением
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