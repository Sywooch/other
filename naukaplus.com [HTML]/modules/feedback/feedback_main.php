<?php
#
# Форма обратной связи                                                                                                                                                                                                *
#

require_once 'class_tree.php';

class main_feedback extends class_tree
{    
	
		/** шаблон, который должен быть использован при выводе страницы  */
		public $template = '';
	

        function main()
        {
        		parent::main();
        	
        	
        	
                if ($this->std->alias[0] == $this->mod_name)
                {
                        global $res_send;
                        $res_send   = "";

                        if ($this->std->input['request_method'] == "post")
                        {
                                // заполнили форму и нажали кнопку
                                if ($this->sendForm())
                                {
                                		$this->skin['body'] = str_replace('{success}', $this->skin['success'], $this->skin['body']);
                                }

                        }

                        
                        # по умолчанию используется шаблон static
                        global $template;
                        $this->template = 'static';
                        $this->setPul($this->mod_name.'_body', $this->endRender($this->skin['body']));
                        $this->setPul('body', $this->endRender($this->skin['body']));
                        
			$title = 'Форма обратной связи';			

			if (isset($this->std->alias[0]))
			if ($this->std->alias[1] == 'q')
			{			
				$title = 'Задайте нам вопрос';
			}
			if ($this->std->alias[1] == 'p')
			{
				$title = 'Запросить полный прайс-лист';
			}


			$this->setPul('h1', $title);
			$this->setPul('title', $title);
                        
                        
                        
                        if( !file_exists($this->std->config['path_templates'].'/static.html') )
                        {
                                $this->template = 'error';
                        }
                }
        }

       /*---------------------------------------------------------------------*/
       // Выводим ошибку
       /*---------------------------------------------------------------------*/

       function showMsgError( $errors = array() )
       {       
				$error = '';
       	
               foreach( $errors  as $key => $msg)
               {
                       $error .= str_replace( "{ERROR}", $msg, $this->skin['error'] );
               }

               $this->skin['body'] = str_replace('{error}', $error, $this->skin['body']);
       }

       /*---------------------------------------------------------------------*/
       // парсинг данны[ и отправка письма
       /*---------------------------------------------------------------------*/

       function sendForm()
       {
               $search      = array();
               $key_ids     = array();
               $error       = array();               
                            
        		
               
               $i = 0;
               #--------------------------------------------------------
               # обходим все переменные которые пришли из формы POST
               #--------------------------------------------------------
               foreach( $this->std->input as $key => $value )
               {
                       //----------------------------------
                       // если ключ содержит comeback_ то это наш случай
                       //----------------------------------
                       if( preg_match( "#^comeback_([0-9a-zA-Z_]+)(_need$|$)#is", $key ) )
                       {
                               $this->std->input[ $key ] = trim( $this->std->input[ $key ] );

                               //----------------------------------
                               // если ключ содержит _need то проверяем на заполненность
                               //----------------------------------
                               if( preg_match( "#^comeback_([0-9a-zA-Z_]+)_need$#is", $key ) )
                               {
                                       $key_ids[ $i ] = preg_replace( "#^comeback_([0-9a-zA-Z_]+)_need$#is", "\\1", $key );

                                       //----------------------------------
                                       // проверяем на пустоту
                                       //----------------------------------
                                       if( $this->std->input[ $key ] )
                                       {
                                       			$search[ $key_ids[ $i ] ] = $this->std->input[ $key ];
                                       			if ($key_ids[ $i ] == 'email')
                                       			{
                                       				$tmp = $this->std->email_validate($this->std->input[ $key ]);
                                       				if ($tmp == '')
                                       				{
                                       					$error[ $key_ids[ $i ] ] = $this->skin[ $key_ids[ $i ].'_error' ];                                       					
                                       				}
                                       			}
                                             
                                       }
                                       else
                                       {
                                       			
                                               $error[ $key_ids[ $i ] ] = $this->skin[ $key_ids[ $i ] ];
                                       }

                               }
                               else
                               {
                                       $key_ids[ $i ] = preg_replace( "#^comeback_([0-9a-zA-Z_]+)$#is", "\\1", $key );
                                       $search[ $key_ids[ $i ] ] = $this->std->input[ $key ];
                               }
                       }
                       $i++;
               }

               //----------------------------------
               // если есть ошибки то сохраняем уже введенные данные
               //----------------------------------
               if( count($error) )
               {
               			$this->skin['body'] = $this->strtr_mod($this->skin['body'], $search);
               	
               	
                     
                       //----------------------------------
                       // выводим ошибку
                       //----------------------------------
                       $this->showMsgError( $error );
                       return;
               }
               //----------------------------------
               // замена параметров в письме
               //----------------------------------

               

               // шаблон сообщения
               $mailbody = $this->std->settings[$this->mod_name.'_template'];

               # подстановка в письмо значений
               $search['date'] = $this->std->getSystemTime();
               $search['host'] = $this->std->host;
               $mailbody = $this->strtr_mod($mailbody, $search);
               
               
               //----------------------------------
               // отправляем результат
               //----------------------------------

               
               $this->std->initMail();
               
               $this->std->mail->setHtml();
               
               $this->std->mail->fullname = $search['name'];
               $this->std->mail->from     = $search['email'];
               $this->std->mail->subject  = $this->std->settings[$this->mod_name.'_title'];
               $this->std->mail->message  = $mailbody;
               $this->std->mail->to       = ($this->std->settings[$this->mod_name.'_email'] == '') ? $this->std->settings['site_email'] : $this->std->settings[$this->mod_name.'_email'];

               //----------------------------------
               // отправляем письмо
               //----------------------------------
               $this->std->mail->send_mail();
               
               
       			$this->skin['body'] = $this->strtr_mod($this->skin['body'], $search);


               return true;

       }
}

?>