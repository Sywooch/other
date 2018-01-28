<?php

/**
 * Класс для работы с прайсом в xsl-формате. Выполняет разбор прайса и сохранение данных в базу.
 * @author kolka
 *
 */
class ClassExcel {
	
	
	private $std;
	private $errors;
	private $index;
	
	
	
	/** смещение относительно последней ячейки с названием подкаталога */
	public $shift_id	= 1;
	public $shift_pid	= 2;
	public $shift_title	= 3;
	public $shift_price	= 4;
	public $shift_body 	= 5;
	public $shift_photo	= 6;
	public $shift_new	= 7;
	public $shift_description	= 8;
	public $shift_keywords		= 9;
	public $shift_price_show	= 10;
	public $shift_last	= 11;
	
	
	/**
	 * Конструктор. Сохраняет $std объект системы
	 * @param unknown_type $std
	 */
	public function __construct($std) {
		$this->std = $std;
		//$this->loadCatalog("/var/www/fms/price.xls");
	}
	
	/**
	 * Загружает прайс, парсит его, записывая данные во временную таблицу. Если парсинг был успешным, 
	 * заменяет основную таблицу каталога сформированной временной. При сохранении данных создается 
	 * иерархия "группа"->"вид товара"->"товар"
	 * 
	 * @param $filename - путь к файлу прайса
	 * @return boolean - true, если парсинг прошел успешно
	 */
	public function loadCatalog($filename, $parent_id) 
	{		
		try {
			require_once 'excel/excel_reader.php';
			$data = new Spreadsheet_Excel_Reader($filename, false, 'CP1251');
		} catch (Exception $e) {
			$this->addError(0, "Ошибка загрузки xls-файла<br>");
			return false; 
		}
		
		$tree = array();	// структура создаваемого каталога
		$this->index = 1;
		
		
		# вставка записи, которая сразу будет удалена
		# делается для возможности использовать функцию get_insert_id()
		//$this->std->db->do_insert( 'catalog', array());
		//$for_del = $this->std->db->get_insert_id();
		$catalog = array($parent_id => '1');
		
		
		
		
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
			{
				
				# [1] - Идентификатор
				# [2] - Идентификатор каталога
				# [3] - Наименование
				# [4] - Цена
				# [5] - Описание (HTML)
				# [6] - Фото
				# [7] - Новое - признак (0/1)
				# [8] - Описание
				# [9] - Ключевые слова
				
				
				
				$id = $data->sheets[0]['cells'][$i][$this->shift_id];
				$pid = $data->sheets[0]['cells'][$i][$this->shift_pid];
				
				# формирование подкаталогов
				if ($data->sheets[0]['cells'][$i][$this->shift_id] < 999)
				{
					# если значение менее 999 - значит это каталог
					$catalog[$data->sheets[0]['cells'][$i][$this->shift_id]] = '1';
					
					# вставка каталога										
					$values = array(
						"id"		=> $id,
						"pid"		=> $pid,
						"is_sheet"	=> 0,
						"item_order"	=> $i,
						"title" 	=> $data->sheets[0]['cells'][$i][$this->shift_title],
						"price" 	=> $data->sheets[0]['cells'][$i][$this->shift_price],
						"body" 		=> $data->sheets[0]['cells'][$i][$this->shift_body],
						"is_best" 		=> $data->sheets[0]['cells'][$i][$this->shift_new],
						"description"	=> $data->sheets[0]['cells'][$i][$this->shift_description],
						"keywords" 		=> $data->sheets[0]['cells'][$i][$this->shift_keywords],					
						"img" 		=> $data->sheets[0]['cells'][$i][$this->shift_photo],
					);
					
					
					$values = $this->checkValues($values, $catalog);
					if (!$values) return false;

					$this->addNode($values);
					
				}
				else
				{
					# вставка каталога										
					$values = array(
						"id"		=> $id,
						"pid"		=> $pid,
						"is_sheet"	=> 1,
						"item_order"	=> $i,
						"title" 	=> $data->sheets[0]['cells'][$i][$this->shift_title],
						"price" 	=> $data->sheets[0]['cells'][$i][$this->shift_price],
						"body" 		=> $data->sheets[0]['cells'][$i][$this->shift_body],
						"is_best" 		=> $data->sheets[0]['cells'][$i][$this->shift_new],
						"description"	=> $data->sheets[0]['cells'][$i][$this->shift_description],
						"keywords" 		=> $data->sheets[0]['cells'][$i][$this->shift_keywords],					
						"img" 		=> $data->sheets[0]['cells'][$i][$this->shift_photo],
						"price_show"	=> $data->sheets[0]['cells'][$i][$this->shift_price_show],
						"is_last"	=> $data->sheets[0]['cells'][$i][$this->shift_last],
					);
					
										
					
					$values = $this->checkValues($values, $catalog);
					if (!$values) return false;
					
					
					$this->addNode($values);
		
				}
				
				
			
				$this->index++;
			
			}
		
		unset($data);
		
		
		
		
		return true;
	}
	
	
	/**
	 * Создает в базе новую группу товаров.
	 * 
	 * @param int $id - ID создаваемой группы
	 * @param string $title - название группы
	 * @return boolean - true в случае успеха
	 */
	private function addNode($values) 
	{	
		$values['h1'] 			= $values['title'];
		$values['menu'] 		= $values['title'];
		$values['is_active'] 	= 1;
		$values['alias'] 		= $this->std->trensliterator($values['title']); //$values['id'];
		$values['timestamp'] 	= time();
		$values['lastmodified'] = time();
		
		$res = $this->std->db->do_insert( 'catalog', $values);
		if (!$res) 
		{
			$this->addError($this->index, "Ошибка вставки");
		}
		
		return '';
	}

	
	
	/**
	 * Проверяет полученные с прайса данные на валидность, преобразует кодировки 
	 * 
	 * @param array $values - массив проверяемых значений
	 * @return array - исправленный масссив значений
	 */
	private function checkValues($values, &$catalog) 
	{
		$values["price"] = str_replace(',', '.', $values["price"]);
		$values['id']		= $this->std->StringToInt( $values['id'] );
		$values['pid']		= $this->std->StringToInt( $values['pid'] );
 		
		
		if ($values['id'] == '')
		{
			$this->addError($this->index+1, "КОД товара - заполнено неверно");
		}
		
		if ($values['pid'] == '')
		{
			$this->addError($this->index+1, "КОД каталога - заполнено неверно");
		}
		
		if (!isset($catalog[$values['pid']]))
		{
			$this->addError($this->index+1, "Указанный КОД каталога не существует");
		}
		
		if (!$values["title"]) $this->addError($this->index+1, "Наименование товара не может быть пустым");
		 
		if (count($this->errors)) return null; else 
			return $values;
	}	

	
	
	/**
	 * Заносит ошибку парсинга в массив ошибок 
	 * 
	 * @param unknown_type $index
	 * @param unknown_type $error
	 * @return unknown_type
	 */
	private function addError($index, $error) {
		$error = "Ошибка парсинга: строка ".$index." - ".$error;
		$this->errors[] = $error;
	}
	
	/**
	 * Формирует блок сообщений об ошибках парсинга
	 * 
	 * @param boolean $all - если true, выводятся все ошибки, в противном случае только первая
	 * @return string - блок сообщений об ошибках
	 */
	public function getErrors($all=true) {
		$ret = "";
		if (count($this->errors)) {
			if ($all) {
				foreach ($this->errors as $k=>$v) {
					$ret .= $v."<br>";
				}
			} else {
				$ret = $this->errors[0];
			}
		}
		return $ret;
	}
	
	
	
	/**
	 * очистка заголовков от порядковой нумерации
	 * возвращение в результате самого заголовка
	 * в качестве параметров - возвращается заголовок и порядковый номер 
	 *
	 */
	private function getCleanName($title)
	{
		$pms = array();
		
		$first = strpos($title, '.');
		$pms['num'] = substr($title, 0, $first);
		$pms['title'] = substr($title, $first+1, strlen($title)-1);
		
		return $pms;
	}
}
?>