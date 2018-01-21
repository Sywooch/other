<?php
#
#        Объект - вывод пути



class main_docs extends AbstractClass {

        var $std;
        var $modules                        = array();
        var $used_template                = '';


        function DocsClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        ){


                $this->AbstractClass(
                                                                $sub_alias,                // путь разложенный в массив
                                                                   '',        // название таблицы с которой будем работать
                                                                   'docs'                        // название модуля (то как модуль называется в таблице modules)
                                                        );
                                                        
				if ($sub_alias[0] == 'docs')
				{		                                
		              global $template, $body, $h1, $title;
		              //$template = 'static'; 
		              $h1 = $title = 'Выписка квитанции для оплаты';
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
			
        	
        	
        	
        	global $_shop_order, $docs_form;
        	$res = $_shop_order['body_first_buy'];
        	$res = str_replace('{regions}', $shop->getRegions(), $res);
        	
        	$res = substr($res, 0, strpos($res, '{docs}')).$docs_form['form_fields'];
        	$res = str_replace('{catalog_list}', $this->getCatalogList(), $res);
        	
        	
        	if ($this->std->input['request_method'] == 'post')
        	{
        		# пришла форма, нужно выгрузить платёжку
        		
        		$this->getDownload();
        		
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
        	
        	$sql = 'SELECT title 
        			FROM se_catalog 
        			WHERE pid = -1 AND id <> 99
        			ORDER BY item_order';
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		foreach ($rows as $row)
        		{
        			$ret .= '<option value="'.$row['title'].'">'.$row['title'].'</option>';
        		}        		
        	}
            
        	return $ret;
        }
        
        
        
        
        /**
         * Формирование платёжки
         *
         */
        function getDownload()
        {
        	# отбрасываем
        	$this->std->input['predoplata'] = $this->std->StringToInt($this->std->input['predoplata']);
        	require_once( INCLUDE_PATH."/lib/class_digitwords.php");				
			$DigitsWords = new CDigitWords;	
			$rub = $DigitsWords->getRubles(round($this->std->input['predoplata']));
			
        	$blanks = array();
        	$company = array(
        					"{company}" => $this->std->settings['company'],
		        			"{kpp}" => $this->std->settings['company_kpp'],
		        			"{inn}" => $this->std->settings['сompany_inn'],
		        			"{okato}" => $this->std->settings['company_okato'],
		        			"{rschot}" => $this->std->settings['company_rschot'],
		        			"{bank}" => $this->std->settings['company_bank'],
		        			"{bik}" => $this->std->settings['company_bik'],
		        			"{kschot}" => $this->std->settings['company_kschot'],
		        			"{kbk}" => $this->std->settings['company_kbk'],
		        			"{company_adress}" => $this->std->settings['company_adress']
        					);
        					
			$user = array(
        					"{i}" => $this->std->input['i'],
		        			"{f}" => $this->std->input['f'],
							"{o}" => $this->std->input['o'],
							"{adress}" => $this->std->input['gorod'].', '.$this->std->input['adress_deliver'],
							"{naznach}" => $this->std->input['naznach'],
							"{predoplata_word}" => $rub['words'],
							"{predoplata}" => $this->std->input['predoplata'],
							"{catalog_title}" => $this->std->input['naznach'],
        					);
        					
			
        					
        	global $_shop_oplata_bank, $_shop_olpata_pochta;
        	
        	
        	if ($this->std->input['type'] == 'pochta')
        	{
        		
        		$blank = $_shop_olpata_pochta;
        		$blank = strtr($blank, $company);
        		$blank = strtr($blank, $user);
        		header('Content-type: application/msword');
				header('Content-Disposition: attachment; filename="Оплата через Почту России.rtf"');
				$blank = iconv('CP1251', 'UTF-8', $blank);
				
				echo $blank;
        	}
        	else
        	{
        		$blank = $_shop_oplata_bank;
        		$blank = strtr($blank, $company);
        		$blank = strtr($blank, $user);
        		header('Content-type: application/msword');
				header('Content-Disposition: attachment; filename="Оплата через банк.rtf"');
				$blank = iconv('CP1251', 'UTF-8', $blank);
				echo $blank;
        	}
        	
			
			
			
			exit;
        }
}
?>