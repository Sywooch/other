<?php

/**
 * ������������
 *
 */



require_once 'class_users_backend.php';

class mod_users extends class_users_backend 
{
	public function main()
	{
		# ������ ����� �������, ������ ����� ������� �����
		$this->std->setPul('admin', 'menu', '<li><a class=menu href="/'.$this->std->config['folder_admin'].'/'.$this->mod_name.'/">'.$this->std->modules_all[$this->mod_name]['title'].'</a></li>');
		
		parent::main();
		
		
		# ������������� ������ �������, ������ ���������, ����� �� ��������� �������� �������� ������
		if ($this->std->alias[1] != $this->mod_name)
		{
			# ���� �������� ������ ������, �� �����
			return;
		}	
		
		
		# ���������
        $this->std->setPul('admin', 'h1', $this->std->modules_all[$this->mod_name]['title']);
	}
	
	
	
	
	
}


?>