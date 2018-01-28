<?php
#
# ����� �������� �����                                                                                                                                                                                                *
#

require_once 'class_tree.php';

class main_feedback extends class_tree
{    
	
		/** ������, ������� ������ ���� ����������� ��� ������ ��������  */
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
                                // ��������� ����� � ������ ������
                                if ($this->sendForm())
                                {
                                		$this->skin['body'] = str_replace('{success}', $this->skin['success'], $this->skin['body']);
                                }

                        }

                        
                        # �� ��������� ������������ ������ static
                        global $template;
                        $this->template = 'static';
                        $this->setPul($this->mod_name.'_body', $this->endRender($this->skin['body']));
                        $this->setPul('body', $this->endRender($this->skin['body']));
                        
			$title = '����� �������� �����';			

			if (isset($this->std->alias[0]))
			if ($this->std->alias[1] == 'q')
			{			
				$title = '������� ��� ������';
			}
			if ($this->std->alias[1] == 'p')
			{
				$title = '��������� ������ �����-����';
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
       // ������� ������
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
       // ������� �����[ � �������� ������
       /*---------------------------------------------------------------------*/

       function sendForm()
       {
               $search      = array();
               $key_ids     = array();
               $error       = array();               
                            
        		
               
               $i = 0;
               #--------------------------------------------------------
               # ������� ��� ���������� ������� ������ �� ����� POST
               #--------------------------------------------------------
               foreach( $this->std->input as $key => $value )
               {
                       //----------------------------------
                       // ���� ���� �������� comeback_ �� ��� ��� ������
                       //----------------------------------
                       if( preg_match( "#^comeback_([0-9a-zA-Z_]+)(_need$|$)#is", $key ) )
                       {
                               $this->std->input[ $key ] = trim( $this->std->input[ $key ] );

                               //----------------------------------
                               // ���� ���� �������� _need �� ��������� �� �������������
                               //----------------------------------
                               if( preg_match( "#^comeback_([0-9a-zA-Z_]+)_need$#is", $key ) )
                               {
                                       $key_ids[ $i ] = preg_replace( "#^comeback_([0-9a-zA-Z_]+)_need$#is", "\\1", $key );

                                       //----------------------------------
                                       // ��������� �� �������
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
               // ���� ���� ������ �� ��������� ��� ��������� ������
               //----------------------------------
               if( count($error) )
               {
               			$this->skin['body'] = $this->strtr_mod($this->skin['body'], $search);
               	
               	
                     
                       //----------------------------------
                       // ������� ������
                       //----------------------------------
                       $this->showMsgError( $error );
                       return;
               }
               //----------------------------------
               // ������ ���������� � ������
               //----------------------------------

               

               // ������ ���������
               $mailbody = $this->std->settings[$this->mod_name.'_template'];

               # ����������� � ������ ��������
               $search['date'] = $this->std->getSystemTime();
               $search['host'] = $this->std->host;
               $mailbody = $this->strtr_mod($mailbody, $search);
               
               
               //----------------------------------
               // ���������� ���������
               //----------------------------------

               
               $this->std->initMail();
               
               $this->std->mail->setHtml();
               
               $this->std->mail->fullname = $search['name'];
               $this->std->mail->from     = $search['email'];
               $this->std->mail->subject  = $this->std->settings[$this->mod_name.'_title'];
               $this->std->mail->message  = $mailbody;
               $this->std->mail->to       = ($this->std->settings[$this->mod_name.'_email'] == '') ? $this->std->settings['site_email'] : $this->std->settings[$this->mod_name.'_email'];

               //----------------------------------
               // ���������� ������
               //----------------------------------
               $this->std->mail->send_mail();
               
               
       			$this->skin['body'] = $this->strtr_mod($this->skin['body'], $search);


               return true;

       }
}

?>