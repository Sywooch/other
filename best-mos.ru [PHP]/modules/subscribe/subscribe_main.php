<?php

#
#	Рассылка новостей - заглушка пользовательской части
#


class main_subscribe extends AbstractClass {


	function subscribeClass( $sub_alias /*запрашиваемая страница разложенная в массив*/	)
	{
			
		$this->AbstractClass(
							$sub_alias,   // путь разложенный в массив
							'subscribe',    // название таблицы с которой будем работать
							'subscribe'        // название модуля (то как модуль называется в таблице modules)
		);
			

		# подписка/отписка и вывод строки для ввода почтового адреса на подписку		
		$this->process();

		# проверка времени последней рассылки и рассылка (если пришло время)
		//$this->sending();

	}

	//----------------------------------------------------------------

	/**
	 * Рассылка почты
	 * Рассылаются только отмеченые галкой новости
	 *
	 */
	function subscribe_send()
	{


		global $_subscribe_news, $_subscribe_subject, $_subscribe_mail;
		$mail = "";

		//-----------------------------------------------------------
		// формирование тела письма рассылки
		//-----------------------------------------------------------

		//-----------формирование одной новости
				
		# находим id активный новостей, которых нет в таблице рассылки
		
		# находим все id из таблицы рассылки
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
			

			// ссылка
        	$alias = "http://".$this->std->host."/news";
        	$alias .= $news->getAliasById($row["id"]);
       	
			$title	= $row["title"];
			$date	= $this->std->get_time($row['timestamp'], "d F Y" );
			$sbody 	= $row["sbody"];

			$search = array("{ALIAS}","{TITLE}","{SBODY}","{DOCUMENTDATE}");
			$replace = array( $alias, $title, $sbody, $date );

			$mail .= str_replace( $search, $replace, $_subscribe_news );


			// присвоение очередной новости статуса "отправлено"
			$this->std->db->do_insert("subscribe", array("news_id" => $row["id"], "active" => '1'));
		}
				
				
				
				
				
		//-----------формирование одной новости
					
					
					
		


		// делем рассылку, если есть что рассылать
		if ($mail != "")
		{
			//-----------------------------------------------------------
			// рассылка письма
			//-----------------------------------------------------------
			// запрашиваем пункты
			$sql = "SELECT user_mail FROM `se_subscribe` WHERE not (user_mail is NULL) AND active=1";

			if ( $this->std->db->query($sql, $rows) > 0 )
			{

				$del_alias = "http://{$this->std->host}/".$this->module_name."/del/{user_mail}/{pass}";

				$message = str_replace( "{MAIL}", $mail, $_subscribe_mail );
				$message = str_replace( "{DEL_ALIAS}", $del_alias, $message );

				// подключение библиотеки отправки почты
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
	 * Проверка даты последней рассылки
	 * Если интервал превышен, то рассылка всем подписавшимся
	 *
	 */
	function sending()
	{
		# читаем файл со временем последней рассылки
		$filename = FILES_PATH."/".$this->module_name."/subscribe";
		@$handle = fopen($filename, "r");
		@$last_modify = fread($handle, filesize($filename));
		@fclose($handle);
		#print $last_modify;
		# проверка времени
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
			# новое точка времени
			$last_modify = time();
			$handle = fopen($filename, "w");
			fwrite($handle, time());
			fclose($handle);

			$this->subscribe_send();

			# обновление даты последнеq рассылки

		}
	}


	/**
	 * подписка пользователя на рассылку
	 *
	 */
	function process()
	{
		global $subscribe, $_subscribe_form, $body, $_subscribe_mail_info;
		if (isset($this->current_url_array['0']) && $this->current_url_array['0']=='subscribe')
		{
			$body	=	'';
			# если пользователь перешел по ссылке активации почты
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
							# есть такой адрес
							$body	.=	'Почтовый адрес добавлен в список рассылки.';
							$sql ="UPDATE `se_subscribe` set `active`='1' WHERE `user_mail`='".$this->current_url_array['2']."'";
							$this->std->db->do_query($sql);
						}
						else
						{
							# пароль НЕ совпадает
							$body	.=	'Неправильная ссылка активации.';
						}
					}
					else
					{
						# нет такого адреса
						$body	=	'Неправильная ссылка активациии.';
					}
						
				}

			}
			# если пользователь перешел по ссылке удаления рассылки
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
							# есть такой адрес
							$body	.=	'Почтовый адрес удален из списка рассылки.';
							$sql ="DELETE FROM `se_subscribe` WHERE `user_mail`='".$this->current_url_array['2']."'";
							$this->std->db->do_query($sql);
						}
						else
						{
							# пароль НЕ совпадает
							$body	.=	'Неправильная ссылка удаления адреса.';
						}
					}
					else
					{
						# нет такого адреса
						$body	=	'Неправильная ссылка удаления адреса.';
					}						
				}
			}
			
			
			global $template, $path;
			//$template = $this->module_name;
			$template = 'static';
			$path = '<a href="/">Главная</a>&nbsp;<span>&raquo;</span>&nbsp;Подписка на рассылку</div>';
		}


		$subscribe = str_replace("{RESULT}", "", $_subscribe_form);



		# если отправлена из формы почта для подписки - отправляем письмо с кодом подтверждения
		if ( $this->std->input["request_method"] == "post" )
		{
			// пришла ли именна нужная форма?
			if ( isset($this->std->input["subscribe"]) )
			{
				// проверка валидности почтового ящика
				if ( $this->std->email_validate( $this->std->input["subscribe"] ))
				{
					$sql = "SELECT * FROM `se_subscribe` WHERE user_mail = '{$this->std->input["subscribe"]}'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
							$subscribe = str_replace("{RESULT}", "Вы уже подписаны на рассылку", $_subscribe_form);
					}
					else
					{
							$sql = "INSERT IGNORE INTO `se_subscribe` (`news_id`, `active`, `user_mail`)
									VALUES ('-1', '0', '".$this->std->input["subscribe"]."')";
							if ( $this->std->db->do_query($sql) );
							{
		
								$subscribe = str_replace("{RESULT}", "На указанный адрес отправлено письмо с запросом подтверждения.", $_subscribe_form);
								# отправляем на указанную почту письмо с ссылкой подтверждения подписка
								
								$pass = md5($this->std->input["subscribe"]."se3");
								require_once( INCLUDE_PATH."/lib/class_mailer.php");
								$mailer = new ClassMailer();
								$mailer->is_html = 1;
								
								$fullname_mail = '';
								$mailer->fullname = $this->std->settings['site_title'];	// название сайта
								$mailer->from     = $this->std->settings['site_email'];	// email сайта
								$mailer->subject  = 'Подтверждение подписки на сайте '.$this->std->host;
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
					$subscribe = str_replace("{RESULT}", "Вы ввели некорректный email.", $_subscribe_form);
				}
			}
		}
	}
}
?>