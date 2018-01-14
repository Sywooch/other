<?php
#
#        Объект - работа со статическими страницами                                                                                                                                                                                                *
#

class main_static extends AbstractClass{

	# данные выводимой страницы
	var $ContentCurPage = null;

	function StaticClass(
	$sub_alias,
	$modules_list # список установленных модулей
	)
	{
		$this->AbstractClass(
		$sub_alias,  # путь разложенный в массив переприсваиваем внутренней переменной класса
                                       'static',    # название таблицы с которой будем работать
                                       'static'     # название модуля (то как модуль называется в таблице modules)
		);


		# разбиваем урл на массив, начало с индекса 0
		if (count($this->current_url_array) == 0)
		{
			$this->current_url_array = array(0 => 'index');
		}
		elseif ($this->current_url_array[0] == 'farumcms')
		{
			global $template, $h1, $title;
			$h1 = $title = 'Страница разработчика';
			$template = 'farumcms';
			return;
		}

		# список установленных модулей
		$this->modules = $modules_list;


		# какую страницу искать в базе.
		# Проводим проверку УРЛА, если всё правильно то работаем, если есть ошибки - показываем ошибку
		# Выводим данные
		$this->getAlias();
	}



	/**
	 * получение алиаса страницы, которую надо показать
	 *
	 */
	function getAlias(){
		global         $template, $body, $h1, $title;
		

		if ($this->current_url_array[0] != 'index')
		{ # если не главная страница
			if (in_array($this->current_url_array[0], $this->modules))
			{
				# если алиас есть в списке модулей
				$this->template = $this->current_url_array[0];         # в качестве имени вызываемого модуля берём это
				$template = $this->template;
			}
			else
			{
				# если алиаса в списке нет, значит вызывается статическая страница и надо взять последнее
				# слово в текущем УРЛЕ - это и будет той нужной вызываемой страницей
				 
				# получаем структуру модуля
				$this->getStructureModule($this->db_table);

				/******************************************************************************/

				# если ошибок не было, то берём шаблон статической страницы
				if ($this->getIdByAlias()){ 
					$this->template	= $this->current_url_array[count($this->current_url_array)-1];        # в качестве имени вызываемого модуля берём это
					$template		= 'static';   # шаблон вызываем такой


					# запрос шаблона текущей статической страницы
					$sql = "select * FROM ".$this->db_table." WHERE id='".$this->IdCurPage."'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						# вся информация о странице
						$this->ContentCurPage = $rows[0];
						if ($rows[0]['template'] != ''){  # если шаблон задан, то именно его и будем вызывать
							$template = $rows[0]['template'];
						}
					}

					# вывод данных
					$this->getStaticVars();

				}
				else
				{
					$template = 'static';                                # шаблон вызываем такой					
					$body = $this->std->settings["site_error"];
					$h1 = $title = 'Ошибка 404';					
					$this->ModulError("Error {StaticClass:getAlias} Обращение по ошибочной ссылке или ошибка работы с БД: url >>> [".$this->current_url."]");
				}

			}
		}
		else
		{
			# ну а если всё таки вызывают главную страницу, то её и будем выводить
			$template = 'index';              # шаблон вызываем такой


			# запрос шаблона текущей статической страницы
			$sql = "select * FROM ".$this->db_table." WHERE pid = -1 AND alias='index'";
			if ($this->std->db->query($sql, $rows) > 0)
			{
				# вся информация о странице
				$this->ContentCurPage = $rows[0];
				if ($rows[0]['template'] != '')
				{
					# если шаблон задан, то именно его и будем вызывать
					$template = $rows[0]['template'];
				}
			}

			# вывод данных
			$this->getStaticVars();
		}

	}


	# инициализация данных (получение их из БД)
	# инициализируем всех данные, потому что работаем со статическоей страницей
	function getStaticVars()
	{
		require_once(MODULES_PATH."/static/static_date.php");
		# следующие переменные являются глобальными и их надо отдать системе заполненными
		global $title,
		$sbody,
		$body,
		$sbody,
		$author,
		$h1,
		$date,
		$keywords,
		$description;

		# если есть записи
		if (count($this->ContentCurPage) > 0)
		{
				# извлечение данных
				$row = $this->ContentCurPage;
	
				# проверка необходимости редиректа на первого подчинённого потомка
				if ($row['is_redirect'] == '1')
				{	
						# да, редирект нужен
						$alias	= "";
						
						# дети текущей страницы
						$childs = $this->StructureModule_pid[$this->IdCurPage];
						 
						if (count($childs) > 0)
						{
								foreach ($childs as $child)
								{
										# получаем алиас страницы по id										
										$alias = $this->getAliasById($child['id']);
											
										if ($alias != "")
										{
												header ('HTTP/1.1 301 OK');
												header("Location: ".$alias);
												exit();
										}
								}
						}
		
					}
					# конец: проверка необходимости редиректа на первого подчинённого потомка
		
		
					# инициализация
					$this->title                   = $row['title'];
					$this->body                    = $row['body'];
					$this->h1                      = $row['h1'];
					$this->sbody                   = $row['sbody'];
					$this->timeinsert              = $row['timestamp'];
					$this->timelastmodifed         = $this->std->getNormalTime($row['lastmodified']);
					$this->author                  = $row['author'];
		
					# выводим keywords и если таковые присутвуют
					$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
					$description = $this->std->build_meta_tags( $row['description'], 'description');
		
					$title                         = $this->title;
					$sbody                         = $this->sbody;
					$body                          = $this->body;
					$sbody                         = $this->sbody;
					$author                        = $this->author;
					$h1                            = $this->h1;
	
			}else{
					# запрашиваемая статическая страница в базе отсутствует или деактивированна, т.е. показываем ошибку
					global $template, $body;
					
					$template = 'static';
					$body = $this->std->settings["site_error"];
					$h1 = $title = 'Ошибка 404';
					$this->ModulError( "getStaticVars->  нет такой записи в таблице  sql: $sql");
			}
	}
}
?>