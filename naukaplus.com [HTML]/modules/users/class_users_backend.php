<?php

#
# Общий родительский класс древовидных модулей
#


require_once 'class_abstract.php';  // абстрактный класс

class class_users_backend extends class_abstract 
{
	
	/**
	 * конструктор класса, инициализация
	 *
	 * @param unknown_type $mod_name	- навзание модуля
	 * @param unknown_type $std			- ссылка на общих класс функций
	 * @return class_parent
	 */
	function __construct( $mod_name, $std )
	{		
		$this->mod_name		= $mod_name;
		$this->std			= $std;
		$this->db			= &$std->db;
		$this->table		= $this->db->dbobj['sql_tbl_prefix'].$mod_name;
		$this->filepath	= $this->std->config['path_files'].'/'.$this->mod_name;
		
		$this->curid = -1;
		if (isset($this->std->alias[3]))
		{
			$this->curid = $this->std->StringToInt($this->std->alias[3]);			
		}
	}

	/**
	 * деструктор
	 *
	 */
	function __destruct()
	{
		
	}



	/**
	 * Центральная функция класса - вызывает все необходимые обработчики, определяет логику модуля
	 *
	 */
	public function main()
	{
		# инициализация прошла успешно, теперь проверяем, нужно ли запустить основной комплекс модуля
		if ($this->std->alias[1] != $this->mod_name)
		{
			# если вызывает другой модуль, то выход
			return;
		}
		
		
		
		# подключение файла с шаблонами оформления данных
		if (file_exists( $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php' ))
		{
			require_once $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php';
			$this->skin = &$skin;
		}
		
		
		
		# инициализация переменных, которые будут использоваться и должны быть подготовлены
		# до начала работы основного блока
		$this->beforeProcess();
		
		
		# Формирование меню модуля
		$this->setModMenu();
		
		# Выбор обработчика запрашиваемой операции
		$this->selectAction();
		
		
		# после всех работ
		$this->afterProcess();
	}
	
	

	

	

	/**
	 * Выбор обработчика запрашиваемой операции
	 *
	 */
	public function selectAction()
	{
		# заданы некие опреции, нужно выбрать запрашиваемую
		if (isset($this->std->alias[2]))
		{
			switch ($this->std->alias[2])
			{
				case 'list':
					$this->getNodesList();
					break;
				case 'add':
					$this->add_do();					
					break;
				case 'edit':
					$this->edit_do();
					break;
				case 'del':
					if ($this->del_do()) $this->getNodesList();
					break;
				case 'active':
					if ($this->active_do()) $this->getNodesList();
					break;
				

				default:
					$this->log('Вызывается раздел "'.$this->std->alias[2].'". Для раздела не назначен обработчик');
					$this->getNodesList();
			}
		}
		else
		{
			# главная странциа модуля в админке
			$this->getNodesList();
		}
	}	
	
	
	

	/**
	 * формирование меню модуля
	 *
	 */
	public function setModMenu()
	{
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/"><b>'.$this->std->modules_all[$this->mod_name]['title'].'</b></a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/add/"><b>Добавить</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/noactive/">Неактивные</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/ban/">Бан</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/novalid/">Неподтверждённые</a>&nbsp;&nbsp;');
		$this->std->setPul('admin', 'mod_menu', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/modif/">Отредактированные</a>&nbsp;&nbsp;');		
				
	}
	
	
	
	
	
	#---------------------------------------------------
	# Конец : вывод списка пользователей
	#---------------------------------------------------
	

	/**
	 * Формирование списка вершин одного уровня
	 *
	 */
	public function getNodesList()
	{
		$res = '';

		
		# может быть указан статус для выводимых пользователей
		$where = '1';
		$type = 'all';
		if (isset($this->std->alias[3]))
		{
			$type = $this->std->alias[3];
			switch ($this->std->alias[3])
			{				
				case 'noactive':
					$where = 'user_is_active = 0';
					break;
				case 'ban':
					$where = 'user_is_ban = 1';
					break;
				case 'novalid':
					$where = 'user_is_valid = 0';
					break;
				case 'modif':
					$where = 'user_is_modif = 1';
					break;
				
				default:
					$where = '1';
					break;
			}
		}
		
		
		
		# нумерация страниц
		$page_start = 0;
		if ( isset($this->std->alias[4]) )
        {
			if ( strstr( $this->std->alias[4], "page" ) )
			{
				$page_start = str_replace( "page", "", $this->std->alias[4])-1;
				unset( $this->std->alias[4]);
			}
        }
		
		
		$sql = "SELECT count(*) as count_items FROM {$this->table} WHERE {$where}";
		$this->db->query($sql, $rows);
		$count = $rows[0]['count_items'];		
		$arrows =  $this->std->build_pagelinks( array( 'TOTAL_POSS'   => $count,
                                                          'PER_PAGE'     => $this->std->settings['arrows_items_on_page'],	// пунктов на странице
                                                          'CUR_ST_VAL'   => $page_start+1,
                                                          'L_SINGLE'     => "",
                                                          'L_MULTI'      => "Страницы: ",
                                                          'BASE_URL'     => '/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$type.'/',
                                                          'leave_out'    => $this->std->settings['arrows_around'], // сколько рядом показываем страниц
                                                          'IGNORE_REVERT'=> 0,
                                                      ) );		
			
		$limit = " LIMIT ".($this->std->settings['arrows_items_on_page']*$page_start).", ".$this->std->settings['arrows_items_on_page'];
		
		
		
		
		# запрос списка вершин одного уровня
		$sql = "SELECT * FROM {$this->table} WHERE {$where} ORDER BY user_access {$limit}";
		if ($this->db->query($sql, $rows) > 0)
		{
			$res .= $this->getNodesListBegin();
			$row_count = count($rows);
			$i = 0;
			foreach ($rows as $row)
			{
				$res .= $this->getNodesListItem($row, $row_count, $i);
				$i++;
			}
			$res .= $this->getNodesListEnd();
		}
		else
		{
			$res .= '<h2>Записей не найдено</h2>';
		}
			
		$this->updatePul('body', $res.$arrows);
	}
	
	
	/**
	 * Начало таблицы со списком пользователей
	 *
	 * @return unknown
	 */
	function getNodesListBegin()
	{
		return '<form method="post">
				<table class="work_tab" width=90%>
				<tr>						
					<th colspan="2" width="20%"></th>
					<th align="left">Логин</th>
					<th align="left">E-mail</th>
					<th align="left">Доступ</th>						
					<th></th>						
				</tr>';
	}
	
	/**
	 * Окончание таблицы со списком пользователей
	 *
	 * @return unknown
	 */
	function getNodesListEnd()
	{
		return '</table>
				</form>';
	}
	

	/**
	 * пункты
	 *
	 * @return unknown
	 */
	public function getNodesListItem($replace, $row_count, $i)
	{
		$replace['color'] = $replace['user_is_active'] == 1 ? 'CCFFCC' : 'dedede';
		$replace['is_active_src'] = $replace['user_is_active'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/play.png' : '/'.$this->std->config['folder_admin'].'/image/stop.png';
		$replace['is_active_title'] = $replace['user_is_active'] == 1 ? 'Декативировать' : 'Активировать';				
		$replace['user_access'] = $this->std->config['access'][$replace['user_access']];
		$replace['is_active_disabled'] = (($replace['parent_active'] == 0) && (!is_null($replace['parent_active']))) ? 'disabled' : '';
		$replace['order_button'] = $this->std->order_button($row_count, $i, $replace['id'], $replace, $this->mod_name);


			
		
	
		$item = '<tr style="background:#{color};">
					<td align=center width="5%"><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/{user_id}/" title="Редактировать"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a></td>					
					<td align=center width="5%"><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/active/{user_id}/"><img src="{is_active_src}" title="{is_active_title}"></a></td>					
					<td>{user_name}</td>
					<td>{user_email}</td>
					<td>{user_access}</td>
					<td align=center><a href="javascript:doConfirm(\'Удалить пользователя?\',\'/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/del/{user_id}/\')" title="Удалить"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>					
				</tr>';

		return $this->strtr_mod($item, $replace);
	}


	

	/**
	 * Формирование данных вершине
	 *
	 * @param unknown_type $id  - идентификатор вершины
	 * @return unknown
	 */
	protected function getNodeById($id)
	{
		# запрос данных о вершине
		$sql = "SELECT * FROM {$this->table} WHERE user_id='{$id}'";
		if ($this->db->query($sql, $rows) > 0)
		{
			if ($rows[0]['user_cache'] != '')
			{
				$rows[0] = array_merge($rows[0], unserialize($rows[0]['user_cache']));
			}
			return $rows[0];
		}
		
		return false;
	}
	
	
	#---------------------------------------------------
	# Конец : вывод списка пользователей
	#---------------------------------------------------
	

	
	
	#---------------------------------------------------
	# активация и удаление
	#---------------------------------------------------
	


	/**
	 * рекурсивное удаление вершины и всех её потомков
	 *
	 * @param unknown_type $id                - идентификатор вершины
	 * @param unknown_type $delnode        - удалять ли саму вершину? 1 - нет
	 */
	public function del_do()
	{
		# получаем данные о вершине, которую активирую/деактивируют
		if ($node = $this->getNodeById($this->curid))
		{	
			# выполнить операции перед удалением пользователя
			$this->preDel($node);
			
			
			$sql = "DELETE FROM {$this->table} WHERE user_id='{$node['user_id']}'";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">Пользователь не найден</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">Вернуться к списку</a>');
		}
			

		return false;
	}
	
	
	/**
	 * выполнить операции перед удалением пользователя
	 *
	 * @param unknown_type $node
	 */
	function preDel($node)
	{
		# будет реализовано в потомке
	}


	/**
	 * Рекурсивная активация/деактивация вершин
	 *
	 */
	protected function active_do()
	{
		# получаем данные о вершине, которую активирую/деактивируют
		if ($node = $this->getNodeById($this->curid))
		{
			$sql = "UPDATE {$this->table} SET user_is_active = (user_is_active XOR 1) WHERE user_id='{$node['user_id']}'";
			$this->std->db->do_query($sql);

			return true;
		}
		else
		{
			$this->std->setPul('admin', 'info', '<font color="red">Пользователь не найден</font><br><a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
		}
			

		return false;
	}
	
	
	#---------------------------------------------------
	# КОНЕЦ : активация и удаление
	#---------------------------------------------------
	
	
	
	
	
	
	#---------------------------------------------------
	# Добавление и редактирование пользователей
	#---------------------------------------------------
	
	
	
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
			$error = $this->validInput();
			

			
			# проверяем, не зарегистрирован ли уже пользователь с таким логином		
			$sql = "SELECT * FROM {$this->table} WHERE user_name = '{$this->input['user_name']}'";
			if ($this->db->query($sql, $rows) > 0)
			{
				$error .=  'Пользователь с логином "'.$this->input['user_name'].'" уже зарегистрирован<br>';
			}
			
					
			# проверяем, не зарегистрирован ли уже пользователь с таким email-ом
			$sql = "SELECT * FROM {$this->table} WHERE user_email = '{$this->input['user_email']}'";			
			if ($this->db->query($sql, $rows) > 0)
			{
				$error .=  'Пользователь с почтовым адресом "'.$this->std->input['user_email'].'" уже зарегистрирован<br>';
			}
			
			$this->std->setPul('admin', 'error', $error);
			

			if ($error != '')
			{
				# есть ошибка, поэтому нужно заполнить форму и отобразить для исправления

				# но сперва нужно
				$this->input['user_is_active'] = $this->input['user_is_active'] == 1 ? 'checked' : '';				
				$this->input['user_rectime'] = $this->std->getSystemTime($this->input['user_rectime']);
			

				# вывод формы
				$this->setPul('error', $error);
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				
				# дополнитиельные данные нужно упаковать в сериализованный массив
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$this->input['user_cache'] = serialize($cache);
				
				
				#----------------------------------------------
				# данные проверены, можно сохранять
				#----------------------------------------------				
				$this->db->do_insert($this->mod_name, $this->input);
				
				
				
				# получаем ключ новой записи
				$this->curid = $this->db->get_insert_id();
				
				
				# вопомках понадобится выполнить дополнительные операции, вызываем обработчик
				$this->add_doAfterSave($this->input);

				$this->std->setPul('admin', 'info', '<b>Изменения сохранены</b><br>
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curid.'/">Редактировать</a>&nbsp;&nbsp;
													<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">Вернуться к списку</a>');
			}
		}
		else
		{
			# ВЫВОДИМ ФОРМУ
			# готовим некоторые исходные данные для формы
			$pms['user_rectime'] = $this->std->getSystemTime();		
			$pms['user_is_active'] = 'checked'; 
			
			
				
			# вывод формы добавления пользователя
			$this->add_form($pms);
			$this->add_doPreRender($pms);
			$this->replacePul('body', $pms);		
			$this->updatePul('body', $this->endRender($this->getPul('body')));
			$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
		}
	}
	
	
	/**
	 * добавление данных в массив перед выводом формы добавлнения новой вершины
	 *
	 * @param unknown_type $pms
	 */
	public function add_doPreRender(&$pms)
	{
		
	}

	/**
	 * обработка данных перед сохранением
	 *
	 * @param unknown_type $pms
	 */
	public function add_doAfterSave(&$node)
	{			
		# остальное назначается в потомке
	}

	
	/**
	 * редактирование вершины
	 *
	 */
	public function edit_do()
	{
		if ($this->std->input['request_method'] == 'post')
		{
			# пришла форма - нужно сохранить

			# для начала возмём все данные и провеим на правильность заполнения
			$error = $this->validInput();
			$this->std->setPul('admin', 'error', $error);

			if ($error != '')			
			{
				# есть ошибка, поэтому нужно заполнить форму и отобразить для исправления

				# но сперва нужно
				$this->input['user_is_active'] = $this->input['user_is_active'] == 1 ? 'checked' : '';
				$this->input['user_rectime'] = $this->std->getSystemTime($this->input['user_rectime'], 'd.m.Y');


				# вывод формы добавление вершины				
				$this->add_form($this->input);
				$this->replacePul('body', $this->input);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
			}
			else
			{
				
				#----------------------------------------------
				# данные проверены, можно сохранять
				#----------------------------------------------
				$this->edit_doPreSave($node);
				
				# дополнитиельные данные нужно упаковать в сериализованный массив
				$cache = array();
				foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
				{
					if (isset($this->std->input[$key]))
					{
						$cache[$key] = $this->std->input[$key];
					}
				}
				$this->input['user_cache'] = serialize($cache);
				
				$this->db->do_update($this->mod_name, $this->input, "user_id = '{$this->curid}'");



				$this->saveDone();
			}
		}
		else
		{
			# запрос данных о редактируемой странице
	
			if ($node = $this->getNodeById($this->curid))
			{
				
				$node['user_is_active'] = $node['user_is_active'] == 1 ? 'checked' : '';				
				$node['user_rectime'] = $this->std->getSystemTime($node['user_rectime']);
	
	
				# вывод формы добавление вершины
				$this->add_form($node);
				$this->edit_doPreRender($node);
				$this->replacePul('body', $node);
				$this->updatePul('body', $this->endRender($this->getPul('body')));
				$this->std->setPul('admin', 'info', '<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/'.$this->curpid.'/">Вернуться к списку</a>');
			}
		}
	}
	
	public function saveDone()
	{
		$this->std->setPul('admin', 'info', '<b>Изменения сохранены</b><br>
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/edit/'.$this->curid.'/">Редактировать</a>&nbsp;&nbsp;
							<a href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/list/">Вернуться к списку</a>');
	}
	
	
	/**
	 * добавление данных в массив перед выводом формы редактирования вершины
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreRender(&$node)
	{
		# назначается в потомке
		
	}
	
	
	/**
	 * обработка данных перед сохранением
	 *
	 * @param unknown_type $pms
	 */
	public function edit_doPreSave(&$node)
	{
		# назначается в потомке
		
	}
	
	
	
	/**
	 * Преобразование приходящих от формы данных
	 *
	 */
	public function validInput()
	{	
		$this->input['user_is_active'] 		= isset($this->std->input['user_is_active']) ? 1 : 0;
		$this->input['user_name'] 			= $this->std->input['user_name'];
		$this->input['user_pass'] 			= $this->std->input['user_pass'];
		$this->input['user_access']			= $this->std->input['user_access'];
		$this->input['user_email'] 			= $this->std->input['user_email'];		
			
		$this->input['user_rectime'] 		= $this->std->getTimeStamp($this->std->input['user_rectime']);
		$this->input['user_lastmod'] 		= $this->std->getTimeStamp($this->std->input['user_lastmod']);		
		
		$this->input['user_about'] 			= $_POST['user_about'];	

		#-----------------------------------
		# проверка ошибок
		#-----------------------------------
		
		/*if ($this->input['user_name'] == '')
		{
			$this->std->setPul('admin', 'error', '<font color="red">На заполнено поле "Логин"</font>');
		}
		
		if ($this->std->email_validate($this->input['user_email']) == '')
		{
			$this->std->setPul('admin', 'error', '<br><font color="red">Неверно заполнено поле E-mail</font>');
		}*/
		
		
		
		
		if ($this->input['user_name'] == '')
		{
			$res .= 'Вы не заполнили поле "Логин"<br>';
		}
		
		if ($this->input['user_email'] == '')
		{
			$res .= 'Вы не заполнили поле "E-mail"<br>';
		}
		elseif ($this->std->email_validate( $this->input['user_email']) == '')
		{
			$res .= 'Вы неверно заполнили поле "E-mail"<br>';
		}
		
		
		
		
		# проверка заполненности необходимых полей
		$cache = array();
		foreach ($this->skin['reg_form_extend_necessary'] as $key => $value)
		{
			if (isset($this->std->input[$key]) && ($this->skin['reg_form_extend_necessary'][$key] != ''))
			{				
				$res .= $this->std->input[$key] == '' ? $value : '';
			}
			
			$cache[$key] = $this->std->input[$key];
		}
		
		
		
		
		
		
		
		return $res;
	}
	
	
	

	/**
	 * формирование формы добавление новой вершины в иерархию
	 *
	 */
	public function add_form(&$node)
	{		
		$form = '		
					<form method=post enctype=multipart/form-data>
					<table border=0 width=90%>

                        <tr>
                        <td align=right>Активировать сразу:</td>
                        <td width=80%><input type="checkbox" name="user_is_active" {user_is_active}></td>
                        </tr>
                        
                                               
                        <tr title="Обязательно за заполнения">
                        <td align=right><font color=red>*</font> Логин:</td>
                        <td><input type=text name="user_name" value="{user_name}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                               
                        <tr title="Обязательно за заполнения">
                        <td align=right><font color=red>*</font> Пароль:</td>
                        <td><input type=text name="user_pass" value="{user_pass}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                                
                        <tr title="Обязательно за заполнения">
                        <td align=right><font color=red>*</font> E-mail:</td>
                        <td><input type=text name="user_email" value="{user_email}" style="width:70%;" maxlength="255"></td>
                        </tr>
                        
                        
                                               
                        <tr title="Обязательно за заполнения">
                        <td align=right ><font color=red>*</font> Тип доступа:</td>
                        <td>
                        	<select name="user_access">
                        		'.$this->getUserAccess($node['user_access']).'
                        	</select>
                        
                        </td>
                        </tr>
                        
                        
                       
                                              
                        
                        <!-- Место для новых свойств, которые могут появиться в потомках -->
                		{extend}
                        
                        
                		
                		
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
						<td align=right valign=top>Подробное описание пользователя</td>
						<script type="text/javascript" src="/'.$this->std->config['folder_admin'].'/editor/fckeditor.js"></script>
						<script type="text/javascript">
                        	window.onload = function() 
                        	{
                        		var oFCKeditor = new FCKeditor( \'user_about\', \'100%\', \'100%\' );
                        		oFCKeditor.BasePath = "/'.$this->std->config['folder_admin'].'/editor/" ;
                        		oFCKeditor.ReplaceTextarea() ;
							}
                        </script>
                        <td width=80% height=200><textarea rows=37 cols=80 name=user_about >{user_about}</textarea></td>
                		</tr>
                		
                		    
                        <tr>
                        <td align=right>Дата создания анкеты:</td>
                        <td><input type="text" name=user_rectime value="{user_rectime}"> (дд.мм.гггг чч:мм)</td>
                        </tr>
                        
                        <tr>
                        <td align=right>Дата последней редакции:</td>
						<td><input type=text name=user_lastmod value="'.$this->std->getSystemTime().'" disabled></td>
                        </tr>

                                               
                        <tr>
                        <td align=right>Доступ к модулям в админке:</td>
						<td>-----------</td>
                        </tr>
                        
                        
                        <tr>
                        <td align=right>Доступ к модулям в пользовательской части:</td>
						<td>-----------</td>
                        </tr>
                        
			            
					</table>
					</div>
					
					
					<input type=submit value="Сохранить" class=f2>
					</form>	
                ';
		
		
		$form = str_replace('{extend}', $this->skin['reg_form_extend'], $form);
		$this->setPul('body', $form);
	}
	
	
	/**
	 * Для формы редактирования профиля формирует список уровеней доступа
	 *
	 * @param unknown_type $id
	 */
	function getUserAccess($access)
	{
		$res = '';
		
		foreach ($this->std->config['access'] as $key => $value)
		{
			if ($access == $key)
			{
				$res .= '<option value="'.$key.'" selected>'.$value;
			}
			else
			{
				$res .= '<option value="'.$key.'">'.$value;
			}
			
		}
		
		
		return $res;
	}
	
	
	#---------------------------------------------------
	# КОНЕЦ : Добавление и редактирование пользователей
	#---------------------------------------------------
	
	
	
	
	
	

}


?>