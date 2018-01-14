<?php

#
#	�������� �������� - �������� ���������������� �����
#


class main_subscribe extends AbstractClass {


	function subscribeClass( $sub_alias /*������������� �������� ����������� � ������*/	)
	{
			
		$this->AbstractClass(
							$sub_alias,   // ���� ����������� � ������
							'subscribe',    // �������� ������� � ������� ����� ��������
							'subscribe'        // �������� ������ (�� ��� ������ ���������� � ������� modules)
		);
			

		# ��������/������� � ����� ������ ��� ����� ��������� ������ �� ��������		
		$this->process();

		# �������� ������� ��������� �������� � �������� (���� ������ �����)
		//$this->sending();

	}

	//----------------------------------------------------------------

	/**
	 * �������� �����
	 * ����������� ������ ��������� ������ �������
	 *
	 */
	function subscribe_send()
	{


		global $_subscribe_news, $_subscribe_subject, $_subscribe_mail;
		$mail = "";

		//-----------------------------------------------------------
		// ������������ ���� ������ ��������
		//-----------------------------------------------------------

		//-----------������������ ����� �������
				
		# ������� id �������� ��������, ������� ��� � ������� ��������
		
		# ������� ��� id �� ������� ��������
		$sql = "SELECT news_id FROM `se_subscribe` WHERE news_id > 0"; 
		$this->std->db->query($sql, $rows);
		$news_id = '-1';
		foreach($rows as $row)
		{
			$news_id	.=	',';
			$news_id	.=	$row['news_id'];
		}
		
		
		
				
		$sql = "SELECT * FROM `se_news` WHERE is_active>0 AND id NOT IN ($news_id)";
		$this->std->db->query($sql, $rows);
		

		foreach ($rows as $row)
		{
			

			// ������
        	$alias = "http://".$this->std->host."/news";
        	$alias .= $news->getAliasById($row["id"]);
       	
			$title	= $row["title"];
			$date	= $this->std->get_time($row['timestamp'], "d F Y" );
			$sbody 	= $row["sbody"];

			$search = array("{ALIAS}","{TITLE}","{SBODY}","{DOCUMENTDATE}");
			$replace = array( $alias, $title, $sbody, $date );

			$mail .= str_replace( $search, $replace, $_subscribe_news );


			// ���������� ��������� ������� ������� "����������"
			$this->std->db->do_insert("subscribe", array("news_id" => $row["id"], "active" => '1'));
		}
				
				
				
				
				
		//-----------������������ ����� �������
					
					
					
		


		// ����� ��������, ���� ���� ��� ���������
		if ($mail != "")
		{
			//-----------------------------------------------------------
			// �������� ������
			//-----------------------------------------------------------
			// ����������� ������
			$sql = "SELECT user_mail FROM `se_subscribe` WHERE not (user_mail is NULL) AND active=1";

			if ( $this->std->db->query($sql, $rows) > 0 )
			{

				$del_alias = "http://{$this->std->host}/".$this->module_name."/del/{user_mail}/{pass}";

				$message = str_replace( "{MAIL}", $mail, $_subscribe_mail );
				$message = str_replace( "{DEL_ALIAS}", $del_alias, $message );

				// ����������� ���������� �������� �����
				require_once( INCLUDE_PATH."/lib/class_mailer.php");


				foreach ( $rows as $row )
				{
					$mailer = new ClassMailer();
					
					$pass = md5($row["user_mail"]."se3");
					$message = str_replace("{pass}",$pass,$message);
					$message = str_replace("{user_mail}",$row["user_mail"],$message);
					$mailer->message = $message;

					$mailer->from = $this->std->settings['site_email'];
					$mailer->subject = $_subscribe_subject;

					$mailer->to = $row["user_mail"];
					
					$mailer->send_mail();

					unset($mailer);
				}
			}
		}
	}

	//----------------------------------------------------------------






	/**
	 * �������� ���� ��������� ��������
	 * ���� �������� ��������, �� �������� ���� �������������
	 *
	 */
	function sending()
	{
		# ������ ���� �� �������� ��������� ��������
		$filename = FILES_PATH."/".$this->module_name."/subscribe";
		@$handle = fopen($filename, "r");
		@$last_modify = fread($handle, filesize($filename));
		@fclose($handle);
		#print $last_modify;
		# �������� �������
		if (!$last_modify)
		{
					//file_put_contents($filename, time());
					@unlink ($filename);
					$fh = fopen($filename, "a+");
					$success = fwrite($fh, time());
					fclose($fh); 
		}
		elseif ( (time() - $last_modify) > ($this->std->settings["subscribe_interval"] * 3600) )
		{
			# ����� ����� �������
			$last_modify = time();
			$handle = fopen($filename, "w");
			fwrite($handle, time());
			fclose($handle);

			$this->subscribe_send();

			# ���������� ���� ��������q ��������

		}
	}


	/**
	 * �������� ������������ �� ��������
	 *
	 */
	function process()
	{
		global $subscribe, $_subscribe_form, $body, $_subscribe_mail_info;
		if (isset($this->current_url_array['0']) && $this->current_url_array['0']=='subscribe')
		{
			$body	=	'';
			# ���� ������������ ������� �� ������ ��������� �����
			if ($this->current_url_array['1']=='activation')
			{ 
				if ($this->current_url_array['2'])
				{
					$sql ="SELECT *  FROM `se_subscribe` WHERE `user_mail`='".$this->current_url_array['2']."'";
					$this->std->db->do_query($sql);
					$row_count = $this->std->db->getNumRows();
					if($row_count)
					{
						if ($this->current_url_array['3']==md5($this->current_url_array['2'].'se3'))
						{
							# ���� ����� �����
							$body	.=	'�������� ����� �������� � ������ ��������.';
							$sql ="UPDATE `se_subscribe` set `active`='1' WHERE `user_mail`='".$this->current_url_array['2']."'";
							$this->std->db->do_query($sql);
						}
						else
						{
							# ������ �� ���������
							$body	.=	'������������ ������ ���������.';
						}
					}
					else
					{
						# ��� ������ ������
						$body	=	'������������ ������ ����������.';
					}
						
				}

			}
			# ���� ������������ ������� �� ������ �������� ��������
			if ($this->current_url_array['1']=='del')
			{
				if ($this->current_url_array['2'])
				{
					$sql ="SELECT *  FROM `se_subscribe` WHERE `user_mail`='".$this->current_url_array['2']."'";
					$this->std->db->do_query($sql);
					$row_count = $this->std->db->getNumRows();
					if($row_count)
					{

						if ($this->current_url_array['3']==md5($this->current_url_array['2'].'se3'))
						{
							# ���� ����� �����
							$body	.=	'�������� ����� ������ �� ������ ��������.';
							$sql ="DELETE FROM `se_subscribe` WHERE `user_mail`='".$this->current_url_array['2']."'";
							$this->std->db->do_query($sql);
						}
						else
						{
							# ������ �� ���������
							$body	.=	'������������ ������ �������� ������.';
						}
					}
					else
					{
						# ��� ������ ������
						$body	=	'������������ ������ �������� ������.';
					}						
				}
			}
			
			
			global $template, $path;
			//$template = $this->module_name;
			$template = 'static';
			$path = '<a href="/">�������</a>&nbsp;<span>&raquo;</span>&nbsp;�������� �� ��������</div>';
		}


		$subscribe = str_replace("{RESULT}", "", $_subscribe_form);



		# ���� ���������� �� ����� ����� ��� �������� - ���������� ������ � ����� �������������
		if ( $this->std->input["request_method"] == "post" )
		{
			// ������ �� ������ ������ �����?
			if ( isset($this->std->input["subscribe"]) )
			{
				// �������� ���������� ��������� �����
				if ( $this->std->email_validate( $this->std->input["subscribe"] ))
				{
					$sql = "SELECT * FROM `se_subscribe` WHERE user_mail = '{$this->std->input["subscribe"]}'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
							$subscribe = str_replace("{RESULT}", "�� ��� ��������� �� ��������", $_subscribe_form);
					}
					else
					{
							$sql = "INSERT IGNORE INTO `se_subscribe` (`news_id`, `active`, `user_mail`)
									VALUES ('-1', '0', '".$this->std->input["subscribe"]."')";
							if ( $this->std->db->do_query($sql) );
							{
		
								$subscribe = str_replace("{RESULT}", "�� ��������� ����� ���������� ������ � �������� �������������.", $_subscribe_form);
								# ���������� �� ��������� ����� ������ � ������� ������������� ��������
								
								$pass = md5($this->std->input["subscribe"]."se3");
								require_once( INCLUDE_PATH."/lib/class_mailer.php");
								$mailer = new ClassMailer();
								$mailer->is_html = 1;
								
								$fullname_mail = '';
								$mailer->fullname = $this->std->settings['site_title'];	// �������� �����
								$mailer->from     = $this->std->settings['site_email'];	// email �����
								$mailer->subject  = '������������� �������� �� ����� '.$this->std->host;
								$alias				= "http://{$this->std->host}/".$this->module_name."/activation/{$this->std->input["subscribe"]}/{$pass}/";
								$mailer->message  = str_replace('{ALIAS}', $alias, $_subscribe_mail_info);
								$mailer->message  = str_replace('{COMPANY}', $this->std->settings['site_title'], $mailer->message);
								$mailer->to       = $this->std->input["subscribe"];
								
								$mailer->send_mail();		
							}
					}
				}
				else
				{
					$subscribe = str_replace("{RESULT}", "�� ����� ������������ email.", $_subscribe_form);
				}
			}
		}
	}
}
?>