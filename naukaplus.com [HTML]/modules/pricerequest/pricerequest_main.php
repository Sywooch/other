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
				// ��������� ����� � ������ ������
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
		// ������ ���������� � ������
		//----------------------------------

		 

		// ������ ���������
		$mailbody = $this->std->settings[$this->mod_name.'_template'];

		# ����������� � ������ ��������
		$search['date'] = $this->std->getSystemTime();
		$search['host'] = $this->std->host;
		$search['email'] = $this->std->input['email'];
		$mailbody = $this->strtr_mod($mailbody, $search);
		 
		 
		//----------------------------------
		// ���������� ���������
		//----------------------------------

		 
		$this->std->initMail();
		 
		$this->std->mail->setHtml();
		 
		$this->std->mail->fullname = '���������� ����� '.$this->std->host;;
		$this->std->mail->from     = $this->std->input['email'];
		$this->std->mail->subject  = '������ �����-����� ��������';
		$this->std->mail->message  = $mailbody;
		$this->std->mail->to       = $this->std->settings['site_email'];

		//----------------------------------
		// ���������� ������
		//----------------------------------
		$this->std->mail->send_mail();
		 
		 
		


		return true;

	}

}


?>