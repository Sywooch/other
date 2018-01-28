<?
#
# Отправка почты
#

define('MAIL_LOW_PRIORITY', 4);
define('MAIL_NORMAL_PRIORITY', 3);
define('MAIL_HIGH_PRIORITY', 2); 

class ClassMailer {

        var $message                      = '';
        var $fullname                     = '';
        var $from                         = '';
        var $subject                      = '';
        var $mail_headers                 = '';
        var $to                           = '';
        var $is_html	                 = 0;
		var $m_mailPriority = MAIL_NORMAL_PRIORITY;
		var $m_userHeaders 					= array();
		var $mime_boundary					= '';
		
		var $files = array();

        /*-------------------------------------------------------------------------*/
        // инициализация класса
        /*-------------------------------------------------------------------------*/

        function setHtml($html = 1)
        {
                $this->is_html = $html;
        }

        /*-------------------------------------------------------------------------*/
        // Формирование заголовков
        /*-------------------------------------------------------------------------*/
		function mime_header_encode($str, $data_charset="cp1251", $send_charset="cp1251") 
		{
				if($data_charset != $send_charset) 
				{
						$str = iconv($data_charset, $send_charset, $str);
				}
				return '=?windows-1251?B?' . base64_encode($str) . '?=';
		}
		
		function attach_file($path, $name)
		{
				# вычленяяем расширение файла
				$ps = strrpos($name, '.');
				if ($ps === false) 
				{ 
						$ext = '';
				} else {
						$ext = substr($name, $ps + 1);
				}
				
				# читаем файл
				$file = fopen($path.$name,'rb');
				$data = fread($file, filesize($path.$name));				
				fclose($file);
				
				# Кодируем Base64 содержимое файла
				$data = chunk_split(base64_encode($data));
				
				switch ($ext)
				{
					case 'jpg' : case 'jpeg' :
							$type = 'image/jpeg';
							break;
					default: $type = 'application/octet-stream'; 
				}				
				
				$this->files[] = array('data' => $data, 'name' => $this->mime_header_encode($name), 'type' => $type);
		}
		
        function build_headers()
        {
			   	$headers = array();
		
				if ($this->fullname)
				{
							$headers[] = "From: ".$this->mime_header_encode($this->fullname)."<".$this->from.">";
				} else {
						$headers[] = "From: " . $this->from;
				}				
			
				
				$uniq_id = md5(uniqid(time()));
				$headers[] = 'Return-Path: <'.$this->from.'>';
				$headers[] = 'Sender: <' . $this->from . '>';
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Message-ID: <' . md5(uniqid(time())) . '@' .  $_SERVER['HTTP_HOST'] . '>';
				$headers[] = 'Date: ' . date('r', time());
				
				if (count($this->files) == 0) // аттачей нет
				{ 
						$headers[] = 'Content-Type: text/'.($this->is_html ? 'html' : 'plain').'; charset="windows-1251"'; // format=flowed
						$headers[] = 'Content-Transfer-Encoding: base64'; // 7bit
				} else {
						$semi_rand = md5(time());
						$this->mime_boundary = "==Multipart_Boundary_x".$semi_rand."x";
					
						$headers[] = 'Content-Type: multipart/mixed; boundary="'.$this->mime_boundary.'"';
				}				
		
				$headers[] = 'X-Priority: ' . $this->m_mailPriority;
				$headers[] = 'X-MSMail-Priority: ' . (($this->m_mailPriority == MAIL_LOW_PRIORITY) ? 'Low' : (($this->m_mailPriority == MAIL_NORMAL_PRIORITY) ? 'Normal' : 'High'));
				$headers[] = 'X-Mailer: MyMailer Version 1.0';
				$headers[] = 'X-MimeOLE: my mailer';
		
				if (sizeof($this->m_userHeaders))
				{
					$headers[] = implode("\n", $this->m_userHeaders);
				}
				
				$this->mail_headers = implode("\n", $headers);
		}
		
		function build_message()
		{
				$this->message = base64_encode($this->message);
				if (count($this->files) > 0)
				{
						# есть аттачи, формируем текст письма: разделитель, заголовки текста, {разделитель, данные файла,} разделитель
						$msg = array();
						
						$msg[] = "--".$this->mime_boundary;
						$msg[] = 'Content-Type: text/'.($this->is_html ? 'html' : 'plain').'; charset="windows-1251"';
						$msg[] = 'Content-Transfer-Encoding: base64';
						$msg[] = '';
						$msg[] = $this->message; // добавляем изначальный текст
						$msg[] = '';
						
						# добавляем все файлы
						foreach ($this->files as $file)
						{
								$msg[] = "--".$this->mime_boundary;
								$msg[] = 'Content-Type: '.$file['type'].'; name="'.$file['name'].'";';
								$msg[] = 'Content-Disposition: attachment; filename="'.$file['name'].'"';
								$msg[] = 'Content-Transfer-Encoding: base64';
								$msg[] = '';
								$msg[] = $file['data'];
								$msg[] = '';
						}
						
						//$msg[] = "--".$this->mime_boundary;
						
						$this->message = implode("\n", $msg);
				}
		}

        /*-------------------------------------------------------------------------*/
        // Физическая отправка сообщений
        /*-------------------------------------------------------------------------*/
        function send_mail()
        {
        		$res = false;
        		
                # Удаляем всё лишнее из строк адресов
                $this->to   = preg_replace( "/[ \t]+/" , ""  , $this->to   );
                $this->from = preg_replace( "/[ \t]+/" , ""  , $this->from );

                $this->to   = preg_replace( "/,,/"     , ","  , $this->to );
                $this->from = preg_replace( "/,,/"     , ","  , $this->from );

                $this->to     = preg_replace( "#\#\[\]'\"\(\):;/\$!Ј%\^&\*\{\}#" , "", $this->to  );
                $this->from   = preg_replace( "#\#\[\]'\"\(\):;/\$!Ј%\^&\*\{\}#" , "", $this->from);

                # Формируем заголовки
                $this->build_headers();
                
                # формируем сообщение
                $this->build_message();

                # Если указан обратный адрес и есть тема сообщения, то отправляем письмо
                if ( ($this->from) and ($this->subject) )
                {                	
					$res = mail( $this->to, $this->mime_header_encode($this->subject), $this->message, $this->mail_headers );
                }
                return $res;
        }

}
?>