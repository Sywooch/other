<?php

#
#        ����� ������ - �� ���� ����� ������������� ��� ��������� ������ �������
#        ��������: ����������� � ����� � ��� ������ ��� ������ ������ �������
#


class AbstractClass {
        var $module_name			= '';                   // ������� ���� (URL, �� ��� �������� �� ������ � ������ ������)
        var $db_table               = '';                   // ��� ������������ �������        ��
        var $last_error             = '';                   // ��������� ������, ��������� ��� ������ ������
        var $current_url_array      = array();              // ������� url ����������� � ������
        var $current_url            = '';					// ������� URL � ���� ������
        var $std					= null;					// ������ �� ����� - ���������� �������
        var $StructureModule		= null;					// ��� ��������� ������ ������ �� ����
        var $StructureModule_pid	= null;					// ��� ��������� ������ ������ �� ���� ����������� � ��� PID->ID->������
        var $StructureModule_id		= null;					// ��� ��������� ������ ������ �� ���� ����������� � ��� ID->(PID->ID->������)
        var $IdCurPage				= -1;					// �������������� ��������� ��������
        var $VarsCurPage			= array();				// ��� ���� ��������� ��������
        var $ModuleFilesPath		= "";					// ���� � ����� � ������������ ������� ������
        var $ModulesList			= array();				// ������ ������� ������������� � �������

        /**
         * ����������� ������, ��������� �������������
         *
         * @param string $sub_alias         - ���� ����������� � ������
         * @param string $db_table          - �������� ������� � ������� ����� ��������
         * @param string $module_name       - �������� ������ (�� ��� ������ ���������� � ������� modules)
         * @return AbstractClass
         */
        function AbstractClass(
									$sub_alias = array(),
                                   	$db_table = '',
                                   	$module_name = ''
                              )
        {
                $this->current_url_array        = $sub_alias;                	// ������� url ����������� � ������
                $this->db_table                 = TABLENAME_PREFIX . $db_table; // ��� ������������ �������        ��
                $this->module_name              = $module_name;                	// �������� ������
                $this->current_url              = $_SERVER['REQUEST_URI'];						// ������� URL � ���� ������
                $this->ModuleFilesPath			= "/files/".$this->module_name."/";		// ���� � ����� � ������������ ������� ������

        }


        /**
         * ����� ������ � ���
         *
         * @param string $localerror  - ��������� �� ������
         */
        function ModulError($localerror)
        {
                if ($localerror != ''){
                        $this->last_error = $localerror;
                        //   �����:    (���������) ���������: ������ \n
                        error_log(strftime("%d.%m.%Y %H:%M:%S")." ".$this->module_name." ".$localerror."\n", 3, $this->std->config['errorlog']);
                }
        }
        
        /**
         * ��������� ��������� ������.
         * ��� �������� ������������� ������������� ��������� �� pid, item_order, id
         *
         * @param unknown_type $table_name - ��� �������, � ������� ����������
         * @param unknown_type $params - �������� �������� ����������
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
                        // ������������ �������� - ������� ��� ������ � ��������
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
                        
                        return $this->StructureModule;        // ���� ������ �� ����, �� ���������� �� ��� ����������
                        
                }

                return null;        // ���� ����, �� � ���������� �������
        }
        
        
        /**
         * ��������� �������������� ������� �� ������ ��������
         *
         * @return int  - ������������� ������� ��� false, ���� ��������� ������
         */
		function getIdByAlias()
		{	
				// ���������� ������, ���� ��������� ������ �� ����� � �� �� ����� ���-�� �������
				/*if (is_array($this->StructureModule))
				{					
						// � ��������� ������ ���� ��� ����������� � ������������ URL �������, ���� �� �������, �� ���� �����						
						$i = 0;
						$pid = "-1";        // �������� ����� � �����
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

			
				# ���� ��������� �����, �� ������
				if (!is_array($this->StructureModule))
				{
						return false;
				}
				
				
				$statr = 0; // �������� � ������� ��������, ���� ��� ����������� ��������
				if ($this->module_name == $this->current_url_array[0])
				{
					$statr = 1;	// �������� �� ������� ��������, ���� ���������� �� ����������� ��������
				}
				
				# ��������
				$pid = 'root';
			
				# ����� 
				$len = count($this->current_url_array);
				for ($i = $statr; $i < $len; $i ++)
				{
						# ������� ����� ������
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
						
						# ���� ���������� ���, �� ��� ������
						if (!$is_find)
						{
							return FALSE;
						}
				}
				
				
				# ���� �� ������ �������, �� ���������� �������������
				if ($is_find)
				{
					$this->IdCurPage = $this->StructureModule_id[$pid]['id'];
					return $this->IdCurPage;
				}
				
				return FALSE;				
		}
		
		/** 
		 * ��������� ������ �������� �� �������������� �������
		 * 
		 *  return string  - ����� ��������
         */
		function getAliasById($id)
		{	
				# ���� ����� �� �� �����, �� ���������, ����� ����� ���������� 
				if ($this->StructureModule_id[$id]['pid'] > 0)
				{
						# ������������ ����� ���� ��
						$res = $this->getAliasById($this->StructureModule_id[$id]['pid']);						
				}
				else
				{
						$res = "/";
						
						// ���� �������� �� �� ����������� ��������, �� ����������� ��� ������ 
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