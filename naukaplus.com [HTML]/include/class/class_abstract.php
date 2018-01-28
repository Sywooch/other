<?php



class class_abstract
{

	/** ссылка на класс - библиотеку функций  */
	protected $std			= null;

	/** ссылка на класс - работа с базой данных  */
	protected $db			= null;

	/** название модуля  */
	public $mod_name		= 'empty';

	/** имя используемой таблицы БД  */
	protected $table		= 'empty';

	/**  путь к папке с загружаемыми файлами модуля */
	protected $filepath		= '';

	/** вся структура модуля взятая из базы разложенная в вид PID->ID->Данные  */
	public $pid				= null;

	/** вся структура модуля взятая из базы разложенная в вид ID->(PID->ID->Данные)  */
	public $id				= null;
	
	/** вся структура без листьев модуля взятая из базы разложенная в вид PID->ID->Данные  */
	public $nosheet_pid				= null;

	/** вся структура модуля взятая из базы разложенная в вид ID->(PID->ID->Данные)  */
	public $nosheet_id				= null;
	/** вся структура модуля взятая из базы разложенная в вид ID->(PID->Alias->Данные)  */
	public $nosheet_alias				= null;	
	/** перечень вершин, формирующих путь к странице  */
	public $id_for_alias				= array();
	public $for_path				= array();	

	/**  идентификатор уровня иерархии (предок)  */
	public $curpid = -1;

	/**  идентификатор вершины  */
	public $curid = NULL;
	
	/** шаблоны оформления модуля */
	public $skin = array();
	
	/** шаблон, который должен быть использован при выводе страницы  */
	public $template = '';

	
	
	
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
		
		# подключение файла с шаблонами оформления данных
		
		if (file_exists( $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php' ))
		{
			include $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php';
			$this->skin = &$skin;			
		}
	}

	/**
	 * деструктор
	 *
	 */
	function __destruct()
	{
		unset($this->id);
		unset($this->pid);
		unset($this->nosheet_id);
		unset($this->nosheet_pid);
		unset($this->std->modules[$this->mod_name]);
	}
	
	
	
	/**
	 * Центральная функция класса - вызывает все необходимые обработчики, определяет логику модуля
	 *
	 */
	public function main()
	{	
		# Всё будет реализовано в наследниках
		
	}
	
	
	
	/**
	 * Вывод сообщения в лог
	 */
	protected function log($text)
	{
		error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$this->mod_name." ".$text."\n", 3, $this->std->config['errorlog']);
	}
	
	
	
	/**
	 * удаление всех служебных вставок перед выводом пользователю на экран
	 *
	 * @param unknown_type $text
	 * @return unknown
	 */
	public function endRender($text)
	{
		$text = preg_replace('#{.*}#', '', $text);

		return $text;
	}
	
	
	

	/**
	 * подстановка значений в блок вместо служебных вставок перед выводом пользователю
	 *
	 * @param unknown_type $text  - текстовый блок
	 * @param unknown_type $replace  - массив: ключи и знаения
	 * @return unknown	- 
	 */
	public function strtr_mod($text, $replace)
	{
		$pms = array();
		if (is_array($replace))
		{				
			foreach ($replace as $key => $value)
			{
				$pms['{'.$key.'}'] = $value;
			}
			
			
			$text = strtr($text, $pms);
		}	

		return $text;
	}
	
	
	
	
	/**
	 * перечень операция до начала основного блока
	 * 
	 */
	public function beforeProcess()
	{
		# назначается потомком
	}

	/**
	 * перечень операция после окончания основного блока
	 * 
	 */
	public function afterProcess()
	{
		# назначается потомком
	}
	
	
	
	
	
	#------------------------------------------------------------------------------
	# Работа с ПУЛом данных
	#------------------------------------------------------------------------------




	/**
	 * Получение значение пула
	 *
	 * @param unknown_type $pul_name	- название блока
	 */
	public function getPul($pul_name)
	{
		return $this->std->getPul($this->mod_name, $pul_name);
	}

	/**
	 * Добавление в пул вывода данных
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function setPul($pul_name, $data = '')
	{
		$this->std->setPul($this->mod_name, $pul_name, $data);
		return;
	}


	/**
	 * Замена в пуле некоторых данных
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 * @param unknown_type $key			- ключ замены
	 */
	public function replacePul($pul_name, $replace)
	{
		$this->std->replacePul($this->mod_name, $pul_name, $replace);
		return;
	}


	/**
	 * одновление значение пула
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function updatePul($pul_name, $data = '')
	{
		$this->std->updatePul($this->mod_name, $pul_name, $data);
		return;
	}

	/**
	 * Очистка пула по названию
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function delPul($pul_name)
	{
		$this->std->delPul($this->mod_name, $pul_name);
		return;
	}

	/**
	 * Очистка всего пула
	 *
	 * @param unknown_type $pul_name	- название блока
	 * @param unknown_type $data		- контент
	 */
	public function emptyPul()
	{
		$this->std->emptyPul($this->mod_name);
		return;
	}

	#------------------------------------------------------------------------------
	# КОНЕЦ: Работа с ПУЛом данных
	#------------------------------------------------------------------------------
	
	
	
	
	#------------------------------------------------------------------------------
	# вспомогательные функции
	#------------------------------------------------------------------------------
	
	
	/**
	 * проверка статуса авторизации пользователя
	 * ответ: true - авторизован, false - не авторизован
	 *
	 */
	public function issetUser()
	{
		if (isset($this->std->member['user_id']))
		{
			return true;
		}
		
		return false;
	}
	
	
}
?>