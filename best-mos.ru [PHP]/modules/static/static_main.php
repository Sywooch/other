<?php
#
#        ������ - ������ �� ������������ ����������                                                                                                                                                                                                *
#

class main_static extends AbstractClass{

	# ������ ��������� ��������
	var $ContentCurPage = null;

	function StaticClass(
	$sub_alias,
	$modules_list # ������ ������������� �������
	)
	{
		$this->AbstractClass(
		$sub_alias,  # ���� ����������� � ������ ��������������� ���������� ���������� ������
                                       'static',    # �������� ������� � ������� ����� ��������
                                       'static'     # �������� ������ (�� ��� ������ ���������� � ������� modules)
		);


		# ��������� ��� �� ������, ������ � ������� 0
		if (count($this->current_url_array) == 0)
		{
			$this->current_url_array = array(0 => 'index');
		}
		elseif ($this->current_url_array[0] == 'farumcms')
		{
			global $template, $h1, $title;
			$h1 = $title = '�������� ������������';
			$template = 'farumcms';
			return;
		}

		# ������ ������������� �������
		$this->modules = $modules_list;


		# ����� �������� ������ � ����.
		# �������� �������� ����, ���� �� ��������� �� ��������, ���� ���� ������ - ���������� ������
		# ������� ������
		$this->getAlias();
	}



	/**
	 * ��������� ������ ��������, ������� ���� ��������
	 *
	 */
	function getAlias(){
		global         $template, $body, $h1, $title;
		

		if ($this->current_url_array[0] != 'index')
		{ # ���� �� ������� ��������
			if (in_array($this->current_url_array[0], $this->modules))
			{
				# ���� ����� ���� � ������ �������
				$this->template = $this->current_url_array[0];         # � �������� ����� ����������� ������ ���� ���
				$template = $this->template;
			}
			else
			{
				# ���� ������ � ������ ���, ������ ���������� ����������� �������� � ���� ����� ���������
				# ����� � ������� ���� - ��� � ����� ��� ������ ���������� ���������
				 
				# �������� ��������� ������
				$this->getStructureModule($this->db_table);

				/******************************************************************************/

				# ���� ������ �� ����, �� ���� ������ ����������� ��������
				if ($this->getIdByAlias()){ 
					$this->template	= $this->current_url_array[count($this->current_url_array)-1];        # � �������� ����� ����������� ������ ���� ���
					$template		= 'static';   # ������ �������� �����


					# ������ ������� ������� ����������� ��������
					$sql = "select * FROM ".$this->db_table." WHERE id='".$this->IdCurPage."'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						# ��� ���������� � ��������
						$this->ContentCurPage = $rows[0];
						if ($rows[0]['template'] != ''){  # ���� ������ �����, �� ������ ��� � ����� ��������
							$template = $rows[0]['template'];
						}
					}

					# ����� ������
					$this->getStaticVars();

				}
				else
				{
					$template = 'static';                                # ������ �������� �����					
					$body = $this->std->settings["site_error"];
					$h1 = $title = '������ 404';					
					$this->ModulError("Error {StaticClass:getAlias} ��������� �� ��������� ������ ��� ������ ������ � ��: url >>> [".$this->current_url."]");
				}

			}
		}
		else
		{
			# �� � ���� �� ���� �������� ������� ��������, �� � � ����� ��������
			$template = 'index';              # ������ �������� �����


			# ������ ������� ������� ����������� ��������
			$sql = "select * FROM ".$this->db_table." WHERE pid = -1 AND alias='index'";
			if ($this->std->db->query($sql, $rows) > 0)
			{
				# ��� ���������� � ��������
				$this->ContentCurPage = $rows[0];
				if ($rows[0]['template'] != '')
				{
					# ���� ������ �����, �� ������ ��� � ����� ��������
					$template = $rows[0]['template'];
				}
			}

			# ����� ������
			$this->getStaticVars();
		}

	}


	# ������������� ������ (��������� �� �� ��)
	# �������������� ���� ������, ������ ��� �������� �� ������������ ���������
	function getStaticVars()
	{
		require_once(MODULES_PATH."/static/static_date.php");
		# ��������� ���������� �������� ����������� � �� ���� ������ ������� ������������
		global $title,
		$sbody,
		$body,
		$sbody,
		$author,
		$h1,
		$date,
		$keywords,
		$description;

		# ���� ���� ������
		if (count($this->ContentCurPage) > 0)
		{
				# ���������� ������
				$row = $this->ContentCurPage;
	
				# �������� ������������� ��������� �� ������� ����������� �������
				if ($row['is_redirect'] == '1')
				{	
						# ��, �������� �����
						$alias	= "";
						
						# ���� ������� ��������
						$childs = $this->StructureModule_pid[$this->IdCurPage];
						 
						if (count($childs) > 0)
						{
								foreach ($childs as $child)
								{
										# �������� ����� �������� �� id										
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
					# �����: �������� ������������� ��������� �� ������� ����������� �������
		
		
					# �������������
					$this->title                   = $row['title'];
					$this->body                    = $row['body'];
					$this->h1                      = $row['h1'];
					$this->sbody                   = $row['sbody'];
					$this->timeinsert              = $row['timestamp'];
					$this->timelastmodifed         = $this->std->getNormalTime($row['lastmodified']);
					$this->author                  = $row['author'];
		
					# ������� keywords � ���� ������� ����������
					$keywords    = $this->std->build_meta_tags( $row['keywords'], 'keywords' );
					$description = $this->std->build_meta_tags( $row['description'], 'description');
		
					$title                         = $this->title;
					$sbody                         = $this->sbody;
					$body                          = $this->body;
					$sbody                         = $this->sbody;
					$author                        = $this->author;
					$h1                            = $this->h1;
	
			}else{
					# ������������� ����������� �������� � ���� ����������� ��� ���������������, �.�. ���������� ������
					global $template, $body;
					
					$template = 'static';
					$body = $this->std->settings["site_error"];
					$h1 = $title = '������ 404';
					$this->ModulError( "getStaticVars->  ��� ����� ������ � �������  sql: $sql");
			}
	}
}
?>