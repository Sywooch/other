<?php
#
#        ������ - ����� ����



class main_free extends AbstractClass {

        var $std;
        var $modules                        = array();
        var $used_template                = '';


        function FreeClass(        $sub_alias /*������������� �������� ����������� � ������*/        ){


                $this->AbstractClass(
                                                                $sub_alias,                // ���� ����������� � ������
                                                                   '',        // �������� ������� � ������� ����� ��������
                                                                   'docs'                        // �������� ������ (�� ��� ������ ���������� � ������� modules)
                                                        );
                                                        
				if ($sub_alias[0] == 'free')
				{		                                
		              global $template, $body, $h1, $title;
		              //$template = 'static'; 
		              $h1 = $title = '����� ���������� ���������';
		              $template = 'free';
		              
		              $body = $this->selectAction();
				}
        }



        /**
         * ����� ��������, ����������, ������� ����������
         *
         */
        function selectAction()
        {
        	# ���������� ������ ��������
        							
			$shop    = new main_shop();	// ����� ���������                        
			$shop->ModulesList = $this->modules;	// ������ ������������� � ������� �������
			$shop->std = &$this->std;			// ����������� ����� �������                        
			
        	
        	
        	
        	global $_shop_order, $free_form;
        	$res = $_shop_order['body_first_buy'];
        	$res = str_replace('{regions}', $shop->getRegions(), $res);
        	
        	$res = substr($res, 0, strpos($res, '{docs}')).$free_form['form_fields'];
        	$res = str_replace('{catalog_list}', $this->getCatalogList(), $res);
        	
        	
        	if ($this->std->input['request_method'] == 'post')
        	{
        		# ������ �����, ��������� ������ �� ������� ��������        		
        		$res = $this->sendOrder();
        		
        		global $template;
        		$template = 'static';
        		
        	}
        	
        	$res = preg_replace('#{.*}#', '', $res);
        	return $res;
        }
        
        
        
        
        /**
         * ������������ ������ ���������, �� ������� �������� ������ � �����
         *
         */
        function getCatalogList()
        {
        	$ret = '';       	
        	
        	$this->std->settings['free_list'] = trim($this->std->settings['free_list']);
        	$list = explode("\n", $this->std->settings['free_list']);
        	foreach ($list as $title)
        	{   
        			$ret .= '<option value="'.$title.'">'.$title.'</option>';
        	}
            
        	return $ret;
        }
        
        
        
        
        /**
         * ������������ �������
         *
         */
        function sendOrder()
        {
        	
			$user = array(
        					"{i}" => $this->std->input['i'],
		        			"{f}" => $this->std->input['f'],
							"{o}" => $this->std->input['o'],
							"{adress}" => $this->std->input['gorod'].', '.$this->std->input['adress_deliver'],							
							"{catalog_title}" => $this->std->input['naznach'],
        					);
        					
			global $_free_mail_message, $free_form;
		
			# �������� ������
        	require_once( INCLUDE_PATH."/lib/class_mailer.php");				
			$mailer = new ClassMailer();				
			$mailer->is_html = 1;
			
			$mailer->from = $this->std->settings['site_email'];
			$mailer->subject = '����� ����������� �������� �� '.$this->std->host;
			$mailer->to = $this->std->settings['site_email'];                        
			$mailer->message = strtr($_free_mail_message, $user);
			$mailer->send_mail();
            
            $mailer->to = 'arclite2005@gmail.com';
            $mailer->send_mail();								

			unset($mailer);
        					
        	return $free_form['send_done'];
        }
}
?>