<?php

#
#        Класс предок - от него будут наследоваться все остальные классы системы
#        Содержит: конструктои и вывод в лог ошибок при работе класса потомка
#


class AbstractClass {
        var $module_name			= '';                   // текущий путь (URL, всё сто сдледует за хостом в строке адреса)
        var $db_table               = '';                   // имя используемой таблицы        БД
        var $last_error             = '';                   // последняя ошибка, возникшая при работе класса
        var $current_url_array      = array();              // текущий url разложенный в массив
        var $current_url            = '';					// текущий URL в виде строки
        var $std					= null;					// ссылка на класс - библиотеку функций
        var $StructureModule		= null;					// вся структура модуля взятая из базы
        var $StructureModule_pid	= null;					// вся структура модуля взятая из базы разложенная в вид PID->ID->Данные
        var $StructureModule_id		= null;					// вся структура модуля взятая из базы разложенная в вид ID->(PID->ID->Данные)
        var $IdCurPage				= -1;					// идентификатора выводимой страницы
        var $VarsCurPage			= array();				// все поля выводимой страницы
        var $ModuleFilesPath		= "";					// путь к папке с загружаемыми файлами модуля
        var $ModulesList			= array();				// список модулей установленных в системе

        /**
         * конструктор класса, первичная инициализация
         *
         * @param string $sub_alias         - путь разложенный в массив
         * @param string $db_table          - название таблицы с которой будем работать
         * @param string $module_name       - название модуля (то как модуль называется в таблице modules)
         * @return AbstractClass
         */
        function AbstractClass(
									$sub_alias = array(),
                                   	$db_table = '',
                                   	$module_name = ''
                              )
        {
                $this->current_url_array        = $sub_alias;                	// текущий url разложенный в массив
                $this->db_table                 = TABLENAME_PREFIX . $db_table; // имя используемой таблицы        БД
                $this->module_name              = $module_name;                	// название класса
                $this->current_url              = $_SERVER['REQUEST_URI'];						// текущий URL в виде строки
                $this->ModuleFilesPath			= "/files/".$this->module_name."/";		// путь к папке с загружаемыми файлами модуля

        }


        /**
         * Вывод ошибки в лог
         *
         * @param string $localerror  - сообщение об ошибке
         */
        function ModulError($localerror)
        {
                if ($localerror != ''){
                        $this->last_error = $localerror;
                        //   вывод:    (ДатаВремя) ИмяКласса: Ошибка \n
                        error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$this->module_name." ".$localerror."\n", 3, $this->std->config['errorlog']);
                }
        }
        
        /**
         * Получение структуры модуля.
         * Для верности представления упорядочивает результат по pid, item_order, id
         *
         * @param unknown_type $table_name - имя таблицы, к которой обращаемся
         * @param unknown_type $params - перечень ключевых параметров
         * @return unknown
         */
        function getStructureModule($table_name, $params = 'id, pid, alias')
        {
                $sql = "SELECT  {$params}
                                        FROM {$table_name}
                                        WHERE is_active = 1
                                        ORDER BY pid, item_order, id";

                if ($this->std->db->query($sql, $rows) > 0)
                {
                        // формирование структур - удобных для поиска и подсчёта
                        foreach ($rows as $row)
                        {
                                if( $row['pid'] < 1 )
                                {
                                        $row['pid'] = 'root';
                                }

                                $this->StructureModule_pid[ $row['pid'] ][ $row['id'] ] = $row;
                                $this->StructureModule_id[ $row['id'] ] = &$this->StructureModule_pid[$row['pid'] ][ $row['id'] ];
                        }
						
                        $this->StructureModule = &$rows;
                        
                        return $this->StructureModule;        // если модуль не пуст, то возвращаем всё его содержимое
                        
                }

                return null;        // если пуст, то и возвращаем пустоту
        }
        
        
        /**
         * Получение идентификатора вершины по алиасу страницы
         *
         * @return int  - идентификатор вершины или false, если произошла ошибка
         */
		function getIdByAlias()
		{	
				// продолжаем работу, если структура модуля не пуста и из неё можно что-то извлечь
				/*if (is_array($this->StructureModule))
				{					
						// в структуре модуля ищем все участвующие в формировании URL вершины, если всё найдено, то путь верен						
						$i = 0;
						$pid = "-1";        // начинаем поиск с корня
						$alias = "";
						
						foreach ($this->StructureModule as $row)
						{
								if (($row["alias"] == $this->current_url_array[$i]) && ($pid == $row["pid"]))
								{
										$i++;
										$alias        = $row["alias"];
										$pid        = $row["id"];
										
										if (($i) == count($this->current_url_array))
										{
												$this->IdCurPage = $row["id"];
												return $this->IdCurPage;
										}
								}
						}						
				}	*/

			
				# если структура пуста, то ошибка
				if (!is_array($this->StructureModule))
				{
						return false;
				}
				
				
				$statr = 0; // начинаем с первого элемента, если это статические страницы
				if ($this->module_name == $this->current_url_array[0])
				{
					$statr = 1;	// начинаем со второго элемента, если вызывается не статическая страницы
				}
				
				# родитель
				$pid = 'root';
			
				# длина 
				$len = count($this->current_url_array);
				for ($i = $statr; $i < $len; $i ++)
				{
						# признак удачи поиска
						$is_find = false;
						
						if (is_array($this->StructureModule_pid[$pid]))
						foreach ($this->StructureModule_pid[$pid] as $item)
						{
									if ($item['alias'] == $this->current_url_array[$i])
									{
											$pid = $item['id'];
											$is_find = true;
											break;
									}
						}
						
						# если совпадений нет, то это ошибка
						if (!$is_find)
						{
							return FALSE;
						}
				}
				
				
				# если всё удачно найдено, то возвращаем идентификатор
				if ($is_find)
				{
					$this->IdCurPage = $this->StructureModule_id[$pid]['id'];
					return $this->IdCurPage;
				}
				
				return FALSE;				
		}
		
		/** 
		 * Получение алиаса страницы по идентификатору вершины
		 * 
		 *  return string  - алиас страницы
         */
		function getAliasById($id)
		{	
				# если дошли не до корня, то реккурсия, иначе вывод результата 
				if ($this->StructureModule_id[$id]['pid'] > 0)
				{
						# реккурсивный вызов себя же
						$res = $this->getAliasById($this->StructureModule_id[$id]['pid']);						
				}
				else
				{
						$res = "/";
						
						// если редирект на не статическую страницу, то подставляем имя модуля 
						if ($this->module_name != 'static')
						{
								$res = $this->module_name."/";
						}
						else
						{
							if ($this->StructureModule_id[$id]['alias'] == "index" || $this->StructureModule_id[$id]['alias'] == '')
							{
									$this->StructureModule_id[$id]['alias'] = "";
									return $res;
							}
						}
				}
							
				return $res.$this->StructureModule_id[$id]['alias']."/";	
		}
		
}



?>