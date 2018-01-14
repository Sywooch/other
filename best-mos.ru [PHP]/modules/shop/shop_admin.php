<?php
#
# shop - админка
#

class mod_shop{


        var $std;
        var $output = '';

        // первая исполняемая функция
		function process_module()
        {
                
                

                // выводим навигацию по модулю
                $this->output        = '<script type="text/javascript" src="/templates/jquery.js"></script>
                						<script>
                							function submitFileForm(form, file)
                							{
                								if($("#"+file).val() != "")
                								{
                									$("#"+form).submit();
        										}
                							}
                						</script>';
                
                
                // выводим навигацию по модулю
                $this->output        .= '<br><table><tr><td width="50"></td>';
                $this->output        .= "<td><font size=4>Клиенты - выгрузка:</font>&nbsp;</td>";
                $this->output        .= "<td><a href=\"javascript:doConfirm('Вы действительно ПРОВЕРИЛИ всех клиентов?','/admin/?action=shop&do=client_valid')\">Пометить всех клиентов как \"ПРОВЕРЕННЫЕ\"</a> </td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_new'>Выгрузить новых</a></td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_update'>Выгрузить изменённых</a></td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_all'>Выгрузить всех</a></td>";                                
                $this->output        .= '</tr></table>';
                
                $this->output        .= '<table><tr><td width="50"></td>';
                $this->output        .= "<td><font size=4>Заказы - выгрузка:</font>&nbsp;</td>";
                $this->output        .= "<td><a href=\"javascript:doConfirm('Вы уверены, что заказы нужно ПРИНЯТЬ?','/admin/?action=shop&do=update_to_old')\">Пометить все заказы как \"ПРИНЯТЫЕ\"</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=zakazout'>ZakazOUT.xml</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=zakazpozout'>ZakazPozOUT.xml</a></td>";                                                
                $this->output        .= '</tr></table>';
                
                $this->output        .= "<table border=0><tr><td width=50></td>";
                $this->output        .= "<td><font size=4>Заказы - загрузка:</font>&nbsp;</td>";
                $this->output        .= "<td><form enctype='multipart/form-data' id=form_zakazin method=post action='/admin/?action=shop&do=zakazin'><input type=file name=zakazin id=zakazin value=''><input type=button value='Загрузить ZakazIN' onClick=\"submitFileForm('form_zakazin', 'zakazin')\"></form></td>";
				$this->output        .= "<td width=20></td><td><form enctype='multipart/form-data' id=form_zakazpozin method=post action='/admin/?action=shop&do=zakazpozin'><input type=file name=zakazpozin id=zakazpozin value=''><input type=button value='Загрузить ZakazPozIN' onClick=\"submitFileForm('form_zakazpozin', 'zakazpozin')\"></form></td>";                                                                
                $this->output        .= '</tr></table><br>';
                
                $this->output        .= '<table><tr><td width="50"></td>';
                $this->output        .= "<td><a href='/admin/?action=shop'>новые заказы</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=old'>принятые заказы</a></td>";                                                                
                $this->output        .= '</tr></table><br>';

                
                if (($this->std->input['do'] != 'client_valid') && ($this->std->input['do'] != 'zakazin') && ($this->std->input['do'] != 'zakazpozin'))
                if (($this->std->input['do'] != 'old') && ($this->std->input['do'] != 'update_to_old'))
                {
                	$this->output .= '<center><b>Новые заказы</b></center>';
                }
                else
                {
                	$this->output .= '<center><b>Принятые заказы</b></center>';
                }
                
                
                switch($this->std->input['do'])
                {
                	case 'update_to_old':
                		$this->UpdateToOld();
                		$this->shop_content(1);
                		break; 
                	case 'client_valid':
                		$this->ClientValid();                		
                		break;               	
                	case 'old':
                		$this->shop_content(1);
                		break;
                	case 'zakazin':
                		$this->loadZakazIN();
                		break;
                	case 'zakazpozin':
                		$this->loadZakazPozIN();
                		break;
                	case 'zakazout':                		                		
                		header("Content-Type: xml");
						header("Content-Disposition: attachment; filename=zakaz_out_".$this->std->get_time(time(), 'd.m.Y_H-i-s').".xml");
						echo $this->sendOrders(0);
                		exit;
                	case 'zakazpozout':                		
                		header("Content-Type: xml");
						header("Content-Disposition: attachment; filename=zakazpoz_out_".$this->std->get_time(time(), 'd.m.Y_H-i-s').".xml");
						echo $this->sendOrders(1);
                		exit;		
                		
					default:
                    	$this->shop_content();
                        break;
                }
        }
        
        
        
        
        
        /**
         * список заказов
         *
         * @param unknown_type $is_old - если 1, значит нужно вывести принятые
         */
        function shop_content($is_old = 0)
        {
        	// модуль c конфигурационными данными                
            require_once(TEMPLATES_PATH.'/shop_t_config.php');
        	
        	# подсчёт новых заказов
        	$sql = "SELECT count(order_id) as count_id FROM se_orders WHERE status = 1 OR status = 2";
        	if ($is_old)
        	{
        		# подсчёт принятых заказов
        		$sql = "SELECT count(order_id) as count_id FROM se_orders WHERE status = 3";
        	}
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		$count = $rows[0]["count_id"];
        	} 
        	
        	$ipp = 30; // сколько на страницу
        	
			$cur_page = intval( $_GET['st'] ) ? intval( $_GET['st'] ) : 0; // текущая страница
				
		
	
			# определяем от какого до какого товара выводить на данной странице
			$item_begin = $cur_page;
		
			$arrows = $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $count,
	                                                             'PER_PAGE'    => $ipp,
	                                                             'CUR_ST_VAL'  => $cur_page,
	                                                             'L_SINGLE'    => "",
	                                                             'L_MULTI'     => "Страницы: ",
	                                                             'BASE_URL'    => "/admin/?action=shop".($this->std->input['do'] ? "&do=".$this->std->input['do'] : ''),
	                                                             'leave_out'   => 5,
																'LINK_DISABLE_CHPU' => '1'));
        	        	
        	
        	$this->output .= "<center><table border=0 width=90%><tr><td>$arrows</td></tr></table></center>";
        	
        	
        	# вывод новых заказов
        	$sql = "SELECT * FROM se_orders WHERE status = 1 OR status = 2 ORDER BY order_id DESC LIMIT $item_begin, $ipp";
        	if ($is_old)
        	{
        		# вывод прошлых заказов
        		$sql = "SELECT * FROM se_orders WHERE status = 3 ORDER BY order_id DESC LIMIT $item_begin, $ipp";
        	}
        	
        	
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		$this->output .= "<center><table border=1 width=90%>";
        		$this->output .= "<th>Номер</th><th>Дата заказа</th><th align=right>Сумма заказа</th><th align=right>Предоплата</th><th>Комментарий</th>";
        		foreach ($rows as $row)
        		{	       			
        			$this->output .= "<tr>";
        			$this->output .= "<td align=center>".$row["order_id"]."</td>";
        			$this->output .= "<td align=center>".$this->std->get_time($row["order_time"], "d.m.Y")."</td>";
        			$this->output .= "<td align=right>".number_format($row["total"], 0, ',', ' ')."</td>";
        			$this->output .= "<td align=right>".number_format($row["predoplata_sum"], 0, ',', ' ')."</td>";        			
        			$this->output .= "<td>&nbsp;".$row["comment"]."</td>";
        			$this->output .= "</tr>";
        		}
        		$this->output .= "</table></center>";
        	}        	
        }
        
        /**
         * загрузка XML с заказами, статусами, суммами
         * В общем загрузка информации по заказам
         *
         */
        function loadZakazIN()
        {
        		#-------------------------------------------------------
				# подготовительная часть
				#-------------------------------------------------------				
				$this->std->xmlfileInit($_FILES["zakazin"]["tmp_name"], $xml);
				if (!$xml) 
				{
					return "Файл недоступен или пуст";
				}
				
				
				
				
        		# если по каким-то причинам XML пуст, то нужно об этом сообщить
				if (count($xml->xml_array['dataroot']['ZakazIN']) == 0)
				{
					$this->output .= '<center>XML пуст. Заказов нет</center>';
					return;
				}
				
				// если пришёл только один пункт изменений, то из-за особенностей работы парсера нужно кое-что переприсвоить
				if (count($xml->xml_array['dataroot']) == 2)
				{
					$tmp = $xml->xml_array['dataroot']['ZakazIN'];
					$xml->xml_array['dataroot']['ZakazIN'] = array();
					$xml->xml_array['dataroot']['ZakazIN'][] = $tmp; 
				}
				
				# формирование запросов вставки в таблицу
				foreach ($xml->xml_array['dataroot']['ZakazIN'] as $item)
				{
						$pms = array();					
						$pms['predoplata_fact'] = $item['PSum']["VALUE"];
						$pms['predoplata_sum'] = $item['predoplata_sum']["VALUE"];
						$pms['total'] = $item['KatSum']["VALUE"];
						
						$this->std->db->do_update("orders", $pms, "order_id = '".$item['ZakazID']["VALUE"]."'");
				}
				
				$this->output .= '<center>Информация по предоплате заказов загружена</center>';				
        }
        
        
		/**
         * загрузка XML с позициями заказов, статусами, суммами
         * В общем загрузка информации по позициям заказов
         *
         */
        function loadZakazPozIN()
        {
        		#-------------------------------------------------------
				# подготовительная часть
				#-------------------------------------------------------				
				$this->std->xmlfileInit($_FILES["zakazpozin"]["tmp_name"], $xml);
				if (!$xml) 
				{
					return "Файл недоступен или пуст";
				}
				
				
				
				
        		# если по каким-то причинам XML пуст, то нужно об этом сообщить
				if (count($xml->xml_array['dataroot']['ZakazPosIN']) == 0)
				{
					$this->output .= '<center>XML пуст. Позиций нет</center>';
					return;
				}
				
				
        // если пришёл только один пункт изменений, то из-за особенностей работы парсера нужно кое-что переприсвоить
				if (count($xml->xml_array['dataroot']) == 2)
				{
					$tmp = $xml->xml_array['dataroot']['ZakazPosIN'];
					$xml->xml_array['dataroot']['ZakazPosIN'] = array();
					$xml->xml_array['dataroot']['ZakazPosIN'][] = $tmp; 
				}
				
				# формирование запросов вставки в таблицу				
				foreach ($xml->xml_array['dataroot']["ZakazPosIN"] as $item)
				{
						$pms = array();
						$tmp = iconv("UTF-8", "CP1251", $item['ZakazStatus']["VALUE"]);
						$pms['zakaz_status'] = $tmp;
						$pms['kat_price'] = $item['KatPrice']["VALUE"];
						$pms['kat_sum'] = $item['KatSum']["VALUE"];
						$pms['skidka_sum'] = $item['SkidkaSum']["VALUE"];
						$pms['compl_sum'] = $item['ComplSum']["VALUE"];
						$pms['z_sum'] = $item['ZSum']["VALUE"];
						
						$this->std->db->do_update("orders_item", $pms, "id_order = '".$item['ZakazID']["VALUE"]."' AND lot_id = '".$item['LotID']["VALUE"]."'");
						
				}
				
				$this->output .= '<center>Статусы позиций загружены</center>';
        }
        
        
        /**
         * всех проверенных клиентов переводим в состояние ПРОВЕРЕННЫЕ
         *
         */
        function ClientValid()
        {
        	$sql = "UPDATE se_users SET user_is_active = 3 WHERE user_is_active = 2 OR user_is_active = 1";
        	$this->std->db->do_query($sql);
        	
        	$this->output .= "<center><b>Выполнено!!!</b></center>";
        }
 
        
        /**
         * Отправка заказов на почту оператору
         *
         * @param unknown_type $is_ZakazPozOUT - вернуть нужно будет что? (0 - заказы, 1 - позиции)
         */
        function sendOrders($is_ZakazPozOUT = 0)
        {
        		// модуль c конфигурационными данными                
            	require_once(TEMPLATES_PATH.'/shop_t_config.php');
            	
            	     	        		      		
        		$ZakazOUT		= '';	// заказы
        		$ZakazPozOUT	= '';	// позиции
        		
        		# запрос последних необработанных заказов
        		$sql = "SELECT se_orders.*, se_users.user_is_active FROM se_orders
        				INNER JOIN se_users ON (se_orders.user_id = se_users.user_id)
        				WHERE se_orders.status = 1 OR se_orders.status = 2
        				GROUP BY  se_orders.order_id
        				ORDER BY se_orders.order_id"; 
        		if ($this->std->db->query($sql, $rows) > 0)
        		{
        				# обрабатываем все заказы
        				foreach($rows as $row)
        				{
        						$order = $_shop_xml_ZakazOUT['item'];
        						$tmp = iconv('CP1251', 'UTF-8', $row['comment']);
        						$row['comment'] = $tmp;
        						
        						if ($row['user_is_active'] == 2)
        						{
        							# пользователь обновил свою анкету
        							$row['user_is_active'] = -1;
        						}
        						else
        						{
        							# пользователь не обновлял анкетные данные
        							$row['user_is_active'] = 0;
        						}
        						
        						
        						# формируем блок для файла заказов
        						foreach ($row as $key => $value)
        						{
        							if ($key == 'order_time')
        							{
        								$value = $this->std->get_time($value, 'd.m.Y H:i:s');
        								
        							}
        							$order = str_replace('{'.$key.'}', $value, $order);
        						}
        						$ZakazOUT .= $order;
        				
        						$sql = "SELECT * FROM se_orders_item WHERE id_order = {$row['order_id']} ORDER BY catalog_id, title";
				        		if ($this->std->db->query($sql, $rows1) > 0)
				        		{
				        				# обрабатываем все заказы
				        				foreach($rows1 as $row1)
				        				{
				        					# формируем блок для файла позиций заказов
				        					$item = $_shop_xml_ZakazPozOUT['item'];
			        						# формируем блок для файла заказов
			        						foreach ($row1 as $key => $value)
			        						{
			        							$item = str_replace('{'.$key.'}', iconv('CP1251', 'UTF-8', $value), $item);
			        						}
			        						$ZakazPozOUT .= $item;	
				        				}
				        		}
        				}
        		}






                        # позиции со статусом "Запрос отмены"
                        $sql = "SELECT se_orders_item.* FROM se_orders_item
                        		INNER JOIN se_orders ON (se_orders.order_id = se_orders_item.id_order) 
                        		WHERE se_orders.status > 0 AND  se_orders_item.zakaz_status = 'Запрос отмены'";
                        if ($this->std->db->query($sql, $rows1) > 0)
                        {
                                        # обрабатываем все заказы
                                        foreach($rows1 as $row1)
                                        {
                                                # формируем блок для файла позиций заказов
                                                $item = $_shop_xml_ZakazPozOUT['item'];
                                                # формируем блок для файла заказов
                                                foreach ($row1 as $key => $value)
                                                {
                                                        $item = str_replace('{'.$key.'}', iconv('CP1251', 'UTF-8', $value), $item);
                                                }
                                                $ZakazPozOUT .= $item;
                                        }
                        }

        		       		
        		$ZakazOUT		= $_shop_xml['begin'].$ZakazOUT.$_shop_xml['end'];
        		$ZakazPozOUT	= $_shop_xml['begin'].$ZakazPozOUT.$_shop_xml['end'];
        						
				
				#  все отправленные заказы тут же переводятся в состояние "отправленные"
				$sql = 'UPDATE se_orders SET status = 2 WHERE status = 1';
        		$this->std->db->do_query($sql);
        		
        		
        		if ($is_ZakazPozOUT == 0)
        		{
        			return $ZakazOUT;
        		}
        		else
        		{
        			return $ZakazPozOUT;
        		}
        		
        }
        
        
        /**
         * перенос новых заказов в раздел принятых
         *
         */
        function UpdateToOld()
        {
        	$sql = 'UPDATE se_orders SET status = 3 WHERE status = 2';
        	$this->std->db->do_query($sql);        	
        }
}
?>
