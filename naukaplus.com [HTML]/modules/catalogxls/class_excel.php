<?php

/**
 * ����� ��� ������ � ������� � xsl-�������. ��������� ������ ������ � ���������� ������ � ����.
 * @author kolka
 *
 */
class ClassExcel {
	
	
	private $std;
	private $errors;
	private $index;
	
	
	
	/** �������� ������������ ��������� ������ � ��������� ����������� */
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
	 * �����������. ��������� $std ������ �������
	 * @param unknown_type $std
	 */
	public function __construct($std) {
		$this->std = $std;
		//$this->loadCatalog("/var/www/fms/price.xls");
	}
	
	/**
	 * ��������� �����, ������ ���, ��������� ������ �� ��������� �������. ���� ������� ��� ��������, 
	 * �������� �������� ������� �������� �������������� ���������. ��� ���������� ������ ��������� 
	 * �������� "������"->"��� ������"->"�����"
	 * 
	 * @param $filename - ���� � ����� ������
	 * @return boolean - true, ���� ������� ������ �������
	 */
	public function loadCatalog($filename, $parent_id) 
	{		
		try {
			require_once 'excel/excel_reader.php';
			$data = new Spreadsheet_Excel_Reader($filename, false, 'CP1251');
		} catch (Exception $e) {
			$this->addError(0, "������ �������� xls-�����<br>");
			return false; 
		}
		
		$tree = array();	// ��������� ������������ ��������
		$this->index = 1;
		
		
		# ������� ������, ������� ����� ����� �������
		# �������� ��� ����������� ������������ ������� get_insert_id()
		//$this->std->db->do_insert( 'catalog', array());
		//$for_del = $this->std->db->get_insert_id();
		$catalog = array($parent_id => '1');
		
		
		
		
			for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
			{
				
				# [1] - �������������
				# [2] - ������������� ��������
				# [3] - ������������
				# [4] - ����
				# [5] - �������� (HTML)
				# [6] - ����
				# [7] - ����� - ������� (0/1)
				# [8] - ��������
				# [9] - �������� �����
				
				
				
				$id = $data->sheets[0]['cells'][$i][$this->shift_id];
				$pid = $data->sheets[0]['cells'][$i][$this->shift_pid];
				
				# ������������ ������������
				if ($data->sheets[0]['cells'][$i][$this->shift_id] < 999)
				{
					# ���� �������� ����� 999 - ������ ��� �������
					$catalog[$data->sheets[0]['cells'][$i][$this->shift_id]] = '1';
					
					# ������� ��������										
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
					# ������� ��������										
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
	 * ������� � ���� ����� ������ �������.
	 * 
	 * @param int $id - ID ����������� ������
	 * @param string $title - �������� ������
	 * @return boolean - true � ������ ������
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
			$this->addError($this->index, "������ �������");
		}
		
		return '';
	}

	
	
	/**
	 * ��������� ���������� � ������ ������ �� ����������, ����������� ��������� 
	 * 
	 * @param array $values - ������ ����������� ��������
	 * @return array - ������������ ������� ��������
	 */
	private function checkValues($values, &$catalog) 
	{
		$values["price"] = str_replace(',', '.', $values["price"]);
		$values['id']		= $this->std->StringToInt( $values['id'] );
		$values['pid']		= $this->std->StringToInt( $values['pid'] );
 		
		
		if ($values['id'] == '')
		{
			$this->addError($this->index+1, "��� ������ - ��������� �������");
		}
		
		if ($values['pid'] == '')
		{
			$this->addError($this->index+1, "��� �������� - ��������� �������");
		}
		
		if (!isset($catalog[$values['pid']]))
		{
			$this->addError($this->index+1, "��������� ��� �������� �� ����������");
		}
		
		if (!$values["title"]) $this->addError($this->index+1, "������������ ������ �� ����� ���� ������");
		 
		if (count($this->errors)) return null; else 
			return $values;
	}	

	
	
	/**
	 * ������� ������ �������� � ������ ������ 
	 * 
	 * @param unknown_type $index
	 * @param unknown_type $error
	 * @return unknown_type
	 */
	private function addError($index, $error) {
		$error = "������ ��������: ������ ".$index." - ".$error;
		$this->errors[] = $error;
	}
	
	/**
	 * ��������� ���� ��������� �� ������� ��������
	 * 
	 * @param boolean $all - ���� true, ��������� ��� ������, � ��������� ������ ������ ������
	 * @return string - ���� ��������� �� �������
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
	 * ������� ���������� �� ���������� ���������
	 * ����������� � ���������� ������ ���������
	 * � �������� ���������� - ������������ ��������� � ���������� ����� 
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