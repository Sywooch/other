<?php
#
#        Объект - вывод пути



class main_free extends AbstractClass {

        var $std;
        var $modules                        = array();
        var $used_template                = '';


        function FreeClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        ){


                $this->AbstractClass(
                                                                $sub_alias,                // путь разложенный в массив
                                                                   '',        // название таблицы с которой будем работать
                                                                   'docs'                        // название модуля (то как модуль называется в таблице modules)
                                                        );
                                                        
				if ($sub_alias[0] == 'free')
				{		                                
		              global $template, $body, $h1, $title;
		              //$template = 'static'; 
		              $h1 = $title = 'Заказ бесплатных каталогов';
		              $template = 'free';
		              
		              $body = $this->selectAction();
				}
        }



        /**
         * Выбор операции, выполнение, возврат результата
         *
         */
        function selectAction()
        {
        	# подключаем модуль каталога
        							
			$shop    = new main_shop();	// новый экземпляр                        
			$shop->ModulesList = $this->modules;	// список установленных в системе модулей
			$shop->std = &$this->std;			// сказательно класс функций                        
			
        	
        	
        	
        	global $_shop_order, $free_form;
        	$res = $_shop_order['body_first_buy'];
        	$res = str_replace('{regions}', $shop->getRegions(), $res);
        	
        	$res = substr($res, 0, strpos($res, '{docs}')).$free_form['form_fields'];
        	$res = str_replace('{catalog_list}', $this->getCatalogList(), $res);
        	
        	
        	if ($this->std->input['request_method'] == 'post')
        	{
        		# пришла форма, отправить заявку на высылку каталога        		
        		$res = $this->sendOrder();
        		
        		global $template;
        		$template = 'static';
        		
        	}
        	
        	$res = preg_replace('#{.*}#', '', $res);
        	return $res;
        }
        
        
        
        
        /**
         * Формирование списка каталогов, по которым возможна оплата и заказ
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
         * Формирование платёжки
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
		
			# отправка письма
        	require_once( INCLUDE_PATH."/lib/class_mailer.php");				
			$mailer = new ClassMailer();				
			$mailer->is_html = 1;
			
			$mailer->from = $this->std->settings['site_email'];
			$mailer->subject = 'Заказ бесплатного каталога на '.$this->std->host;
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