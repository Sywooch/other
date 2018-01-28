<?php



class class_abstract
{

	/** ������ �� ����� - ���������� �������  */
	protected $std			= null;

	/** ������ �� ����� - ������ � ����� ������  */
	protected $db			= null;

	/** �������� ������  */
	public $mod_name		= 'empty';

	/** ��� ������������ ������� ��  */
	protected $table		= 'empty';

	/**  ���� � ����� � ������������ ������� ������ */
	protected $filepath		= '';

	/** ��� ��������� ������ ������ �� ���� ����������� � ��� PID->ID->������  */
	public $pid				= null;

	/** ��� ��������� ������ ������ �� ���� ����������� � ��� ID->(PID->ID->������)  */
	public $id				= null;
	
	/** ��� ��������� ��� ������� ������ ������ �� ���� ����������� � ��� PID->ID->������  */
	public $nosheet_pid				= null;

	/** ��� ��������� ������ ������ �� ���� ����������� � ��� ID->(PID->ID->������)  */
	public $nosheet_id				= null;
	/** ��� ��������� ������ ������ �� ���� ����������� � ��� ID->(PID->Alias->������)  */
	public $nosheet_alias				= null;	
	/** �������� ������, ����������� ���� � ��������  */
	public $id_for_alias				= array();
	public $for_path				= array();	

	/**  ������������� ������ �������� (������)  */
	public $curpid = -1;

	/**  ������������� �������  */
	public $curid = NULL;
	
	/** ������� ���������� ������ */
	public $skin = array();
	
	/** ������, ������� ������ ���� ����������� ��� ������ ��������  */
	public $template = '';

	
	
	
	/**
	 * ����������� ������, �������������
	 *
	 * @param unknown_type $mod_name	- �������� ������
	 * @param unknown_type $std			- ������ �� ����� ����� �������
	 * @return class_parent
	 */
	function __construct( $mod_name, $std )
	{	
			
		$this->mod_name		= $mod_name;
		$this->std			= $std;
		$this->db			= &$std->db;
		$this->table		= $this->db->dbobj['sql_tbl_prefix'].$mod_name;		
		$this->filepath	= $this->std->config['path_files'].'/'.$this->mod_name;
		
		# ����������� ����� � ��������� ���������� ������
		
		if (file_exists( $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php' ))
		{
			include $this->std->config['path_templates'].'/'.$this->mod_name.'_t_config.php';
			$this->skin = &$skin;			
		}
	}

	/**
	 * ����������
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
	 * ����������� ������� ������ - �������� ��� ����������� �����������, ���������� ������ ������
	 *
	 */
	public function main()
	{	
		# �� ����� ����������� � �����������
		
	}
	
	
	
	/**
	 * ����� ��������� � ���
	 */
	protected function log($text)
	{
		error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$this->mod_name." ".$text."\n", 3, $this->std->config['errorlog']);
	}
	
	
	
	/**
	 * �������� ���� ��������� ������� ����� ������� ������������ �� �����
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
	 * ����������� �������� � ���� ������ ��������� ������� ����� ������� ������������
	 *
	 * @param unknown_type $text  - ��������� ����
	 * @param unknown_type $replace  - ������: ����� � �������
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
	 * �������� �������� �� ������ ��������� �����
	 * 
	 */
	public function beforeProcess()
	{
		# ����������� ��������
	}

	/**
	 * �������� �������� ����� ��������� ��������� �����
	 * 
	 */
	public function afterProcess()
	{
		# ����������� ��������
	}
	
	
	
	
	
	#------------------------------------------------------------------------------
	# ������ � ����� ������
	#------------------------------------------------------------------------------




	/**
	 * ��������� �������� ����
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 */
	public function getPul($pul_name)
	{
		return $this->std->getPul($this->mod_name, $pul_name);
	}

	/**
	 * ���������� � ��� ������ ������
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 */
	public function setPul($pul_name, $data = '')
	{
		$this->std->setPul($this->mod_name, $pul_name, $data);
		return;
	}


	/**
	 * ������ � ���� ��������� ������
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 * @param unknown_type $key			- ���� ������
	 */
	public function replacePul($pul_name, $replace)
	{
		$this->std->replacePul($this->mod_name, $pul_name, $replace);
		return;
	}


	/**
	 * ���������� �������� ����
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 */
	public function updatePul($pul_name, $data = '')
	{
		$this->std->updatePul($this->mod_name, $pul_name, $data);
		return;
	}

	/**
	 * ������� ���� �� ��������
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 */
	public function delPul($pul_name)
	{
		$this->std->delPul($this->mod_name, $pul_name);
		return;
	}

	/**
	 * ������� ����� ����
	 *
	 * @param unknown_type $pul_name	- �������� �����
	 * @param unknown_type $data		- �������
	 */
	public function emptyPul()
	{
		$this->std->emptyPul($this->mod_name);
		return;
	}

	#------------------------------------------------------------------------------
	# �����: ������ � ����� ������
	#------------------------------------------------------------------------------
	
	
	
	
	#------------------------------------------------------------------------------
	# ��������������� �������
	#------------------------------------------------------------------------------
	
	
	/**
	 * �������� ������� ����������� ������������
	 * �����: true - �����������, false - �� �����������
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