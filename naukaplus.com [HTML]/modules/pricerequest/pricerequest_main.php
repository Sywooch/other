<?php


require_once 'class_abstract.php';

class main_pricerequest extends class_abstract
{

	function main()
	{
		parent::main();
		 
		 
		 
		if ($this->std->alias[0] == $this->mod_name)
		{

			if ($this->std->input['request_method'] == "post")
			{
				// заполнили форму и нажали кнопку
				if ($this->sendForm())
				{
					$sql = "SELECT * FROM se_static WHERE alias='{$this->mod_name}'";
					if ($this->std->db->query($sql, $rows) > 0)
					{
						$row = $rows[0];
						$this->template = 'static';
						$this->setPul('title', $row['title']);
						$this->setPul('h1', $row['h1']);
						$this->setPul('body', $row['body']);
					}
				}

			}
			else
			{
				header("Location: /");
				exit;
			}


			
		}
	}


	function sendForm()
	{
		$search      = array();
				 
		
		//----------------------------------
		// замена параметров в письме
		//----------------------------------

		 

		// шаблон сообщения
		$mailbody = $this->std->settings[$this->mod_name.'_template'];

		# подстановка в письмо значений
		$search['date'] = $this->std->getSystemTime();
		$search['host'] = $this->std->host;
		$search['email'] = $this->std->input['email'];
		$mailbody = $this->strtr_mod($mailbody, $search);
		 
		 
		//----------------------------------
		// отправляем результат
		//----------------------------------

		 
		$this->std->initMail();
		 
		$this->std->mail->setHtml();
		 
		$this->std->mail->fullname = 'Посетитель сайта '.$this->std->host;;
		$this->std->mail->from     = $this->std->input['email'];
		$this->std->mail->subject  = 'Запрос прайс-листа компании';
		$this->std->mail->message  = $mailbody;
		$this->std->mail->to       = $this->std->settings['site_email'];

		//----------------------------------
		// отправляем письмо
		//----------------------------------
		$this->std->mail->send_mail();
		 
		 
		


		return true;

	}

}


?>