<?php
#
# shop - �������
#

class mod_shop{


        var $std;
        var $output = '';

        // ������ ����������� �������
		function process_module()
        {
                
                

                // ������� ��������� �� ������
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
                
                
                // ������� ��������� �� ������
                $this->output        .= '<br><table><tr><td width="50"></td>';
                $this->output        .= "<td><font size=4>������� - ��������:</font>&nbsp;</td>";
                $this->output        .= "<td><a href=\"javascript:doConfirm('�� ������������� ��������� ���� ��������?','/admin/?action=shop&do=client_valid')\">�������� ���� �������� ��� \"�����������\"</a> </td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_new'>��������� �����</a></td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_update'>��������� ���������</a></td>";
                $this->output        .= "<td>| <a href='?action=authorization&do=download_all'>��������� ����</a></td>";                                
                $this->output        .= '</tr></table>';
                
                $this->output        .= '<table><tr><td width="50"></td>';
                $this->output        .= "<td><font size=4>������ - ��������:</font>&nbsp;</td>";
                $this->output        .= "<td><a href=\"javascript:doConfirm('�� �������, ��� ������ ����� �������?','/admin/?action=shop&do=update_to_old')\">�������� ��� ������ ��� \"��������\"</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=zakazout'>ZakazOUT.xml</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=zakazpozout'>ZakazPozOUT.xml</a></td>";                                                
                $this->output        .= '</tr></table>';
                
                $this->output        .= "<table border=0><tr><td width=50></td>";
                $this->output        .= "<td><font size=4>������ - ��������:</font>&nbsp;</td>";
                $this->output        .= "<td><form enctype='multipart/form-data' id=form_zakazin method=post action='/admin/?action=shop&do=zakazin'><input type=file name=zakazin id=zakazin value=''><input type=button value='��������� ZakazIN' onClick=\"submitFileForm('form_zakazin', 'zakazin')\"></form></td>";
				$this->output        .= "<td width=20></td><td><form enctype='multipart/form-data' id=form_zakazpozin method=post action='/admin/?action=shop&do=zakazpozin'><input type=file name=zakazpozin id=zakazpozin value=''><input type=button value='��������� ZakazPozIN' onClick=\"submitFileForm('form_zakazpozin', 'zakazpozin')\"></form></td>";                                                                
                $this->output        .= '</tr></table><br>';
                
                $this->output        .= '<table><tr><td width="50"></td>';
                $this->output        .= "<td><a href='/admin/?action=shop'>����� ������</a></td>";
                $this->output        .= "<td>| <a href='/admin/?action=shop&do=old'>�������� ������</a></td>";                                                                
                $this->output        .= '</tr></table><br>';

                
                if (($this->std->input['do'] != 'client_valid') && ($this->std->input['do'] != 'zakazin') && ($this->std->input['do'] != 'zakazpozin'))
                if (($this->std->input['do'] != 'old') && ($this->std->input['do'] != 'update_to_old'))
                {
                	$this->output .= '<center><b>����� ������</b></center>';
                }
                else
                {
                	$this->output .= '<center><b>�������� ������</b></center>';
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
         * ������ �������
         *
         * @param unknown_type $is_old - ���� 1, ������ ����� ������� ��������
         */
        function shop_content($is_old = 0)
        {
        	// ������ c ����������������� �������                
            require_once(TEMPLATES_PATH.'/shop_t_config.php');
        	
        	# ������� ����� �������
        	$sql = "SELECT count(order_id) as count_id FROM se_orders WHERE status = 1 OR status = 2";
        	if ($is_old)
        	{
        		# ������� �������� �������
        		$sql = "SELECT count(order_id) as count_id FROM se_orders WHERE status = 3";
        	}
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		$count = $rows[0]["count_id"];
        	} 
        	
        	$ipp = 30; // ������� �� ��������
        	
			$cur_page = intval( $_GET['st'] ) ? intval( $_GET['st'] ) : 0; // ������� ��������
				
		
	
			# ���������� �� ������ �� ������ ������ �������� �� ������ ��������
			$item_begin = $cur_page;
		
			$arrows = $this->std->build_pagelinks( array( 'TOTAL_POSS'  => $count,
	                                                             'PER_PAGE'    => $ipp,
	                                                             'CUR_ST_VAL'  => $cur_page,
	                                                             'L_SINGLE'    => "",
	                                                             'L_MULTI'     => "��������: ",
	                                                             'BASE_URL'    => "/admin/?action=shop".($this->std->input['do'] ? "&do=".$this->std->input['do'] : ''),
	                                                             'leave_out'   => 5,
																'LINK_DISABLE_CHPU' => '1'));
        	        	
        	
        	$this->output .= "<center><table border=0 width=90%><tr><td>$arrows</td></tr></table></center>";
        	
        	
        	# ����� ����� �������
        	$sql = "SELECT * FROM se_orders WHERE status = 1 OR status = 2 ORDER BY order_id DESC LIMIT $item_begin, $ipp";
        	if ($is_old)
        	{
        		# ����� ������� �������
        		$sql = "SELECT * FROM se_orders WHERE status = 3 ORDER BY order_id DESC LIMIT $item_begin, $ipp";
        	}
        	
        	
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		$this->output .= "<center><table border=1 width=90%>";
        		$this->output .= "<th>�����</th><th>���� ������</th><th align=right>����� ������</th><th align=right>����������</th><th>�����������</th>";
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
         * �������� XML � ��������, ���������, �������
         * � ����� �������� ���������� �� �������
         *
         */
        function loadZakazIN()
        {
        		#-------------------------------------------------------
				# ���������������� �����
				#-------------------------------------------------------				
				$this->std->xmlfileInit($_FILES["zakazin"]["tmp_name"], $xml);
				if (!$xml) 
				{
					return "���� ���������� ��� ����";
				}
				
				
				
				
        		# ���� �� �����-�� �������� XML ����, �� ����� �� ���� ��������
				if (count($xml->xml_array['dataroot']['ZakazIN']) == 0)
				{
					$this->output .= '<center>XML ����. ������� ���</center>';
					return;
				}
				
				// ���� ������ ������ ���� ����� ���������, �� ��-�� ������������ ������ ������� ����� ���-��� �������������
				if (count($xml->xml_array['dataroot']) == 2)
				{
					$tmp = $xml->xml_array['dataroot']['ZakazIN'];
					$xml->xml_array['dataroot']['ZakazIN'] = array();
					$xml->xml_array['dataroot']['ZakazIN'][] = $tmp; 
				}
				
				# ������������ �������� ������� � �������
				foreach ($xml->xml_array['dataroot']['ZakazIN'] as $item)
				{
						$pms = array();					
						$pms['predoplata_fact'] = $item['PSum']["VALUE"];
						$pms['predoplata_sum'] = $item['predoplata_sum']["VALUE"];
						$pms['total'] = $item['KatSum']["VALUE"];
						
						$this->std->db->do_update("orders", $pms, "order_id = '".$item['ZakazID']["VALUE"]."'");
				}
				
				$this->output .= '<center>���������� �� ���������� ������� ���������</center>';				
        }
        
        
		/**
         * �������� XML � ��������� �������, ���������, �������
         * � ����� �������� ���������� �� �������� �������
         *
         */
        function loadZakazPozIN()
        {
        		#-------------------------------------------------------
				# ���������������� �����
				#-------------------------------------------------------				
				$this->std->xmlfileInit($_FILES["zakazpozin"]["tmp_name"], $xml);
				if (!$xml) 
				{
					return "���� ���������� ��� ����";
				}
				
				
				
				
        		# ���� �� �����-�� �������� XML ����, �� ����� �� ���� ��������
				if (count($xml->xml_array['dataroot']['ZakazPosIN']) == 0)
				{
					$this->output .= '<center>XML ����. ������� ���</center>';
					return;
				}
				
				
        // ���� ������ ������ ���� ����� ���������, �� ��-�� ������������ ������ ������� ����� ���-��� �������������
				if (count($xml->xml_array['dataroot']) == 2)
				{
					$tmp = $xml->xml_array['dataroot']['ZakazPosIN'];
					$xml->xml_array['dataroot']['ZakazPosIN'] = array();
					$xml->xml_array['dataroot']['ZakazPosIN'][] = $tmp; 
				}
				
				# ������������ �������� ������� � �������				
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
				
				$this->output .= '<center>������� ������� ���������</center>';
        }
        
        
        /**
         * ���� ����������� �������� ��������� � ��������� �����������
         *
         */
        function ClientValid()
        {
        	$sql = "UPDATE se_users SET user_is_active = 3 WHERE user_is_active = 2 OR user_is_active = 1";
        	$this->std->db->do_query($sql);
        	
        	$this->output .= "<center><b>���������!!!</b></center>";
        }
 
        
        /**
         * �������� ������� �� ����� ���������
         *
         * @param unknown_type $is_ZakazPozOUT - ������� ����� ����� ���? (0 - ������, 1 - �������)
         */
        function sendOrders($is_ZakazPozOUT = 0)
        {
        		// ������ c ����������������� �������                
            	require_once(TEMPLATES_PATH.'/shop_t_config.php');
            	
            	     	        		      		
        		$ZakazOUT		= '';	// ������
        		$ZakazPozOUT	= '';	// �������
        		
        		# ������ ��������� �������������� �������
        		$sql = "SELECT se_orders.*, se_users.user_is_active FROM se_orders
        				INNER JOIN se_users ON (se_orders.user_id = se_users.user_id)
        				WHERE se_orders.status = 1 OR se_orders.status = 2
        				GROUP BY  se_orders.order_id
        				ORDER BY se_orders.order_id"; 
        		if ($this->std->db->query($sql, $rows) > 0)
        		{
        				# ������������ ��� ������
        				foreach($rows as $row)
        				{
        						$order = $_shop_xml_ZakazOUT['item'];
        						$tmp = iconv('CP1251', 'UTF-8', $row['comment']);
        						$row['comment'] = $tmp;
        						
        						if ($row['user_is_active'] == 2)
        						{
        							# ������������ ������� ���� ������
        							$row['user_is_active'] = -1;
        						}
        						else
        						{
        							# ������������ �� �������� �������� ������
        							$row['user_is_active'] = 0;
        						}
        						
        						
        						# ��������� ���� ��� ����� �������
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
				        				# ������������ ��� ������
				        				foreach($rows1 as $row1)
				        				{
				        					# ��������� ���� ��� ����� ������� �������
				        					$item = $_shop_xml_ZakazPozOUT['item'];
			        						# ��������� ���� ��� ����� �������
			        						foreach ($row1 as $key => $value)
			        						{
			        							$item = str_replace('{'.$key.'}', iconv('CP1251', 'UTF-8', $value), $item);
			        						}
			        						$ZakazPozOUT .= $item;	
				        				}
				        		}
        				}
        		}






                        # ������� �� �������� "������ ������"
                        $sql = "SELECT se_orders_item.* FROM se_orders_item
                        		INNER JOIN se_orders ON (se_orders.order_id = se_orders_item.id_order) 
                        		WHERE se_orders.status > 0 AND  se_orders_item.zakaz_status = '������ ������'";
                        if ($this->std->db->query($sql, $rows1) > 0)
                        {
                                        # ������������ ��� ������
                                        foreach($rows1 as $row1)
                                        {
                                                # ��������� ���� ��� ����� ������� �������
                                                $item = $_shop_xml_ZakazPozOUT['item'];
                                                # ��������� ���� ��� ����� �������
                                                foreach ($row1 as $key => $value)
                                                {
                                                        $item = str_replace('{'.$key.'}', iconv('CP1251', 'UTF-8', $value), $item);
                                                }
                                                $ZakazPozOUT .= $item;
                                        }
                        }

        		       		
        		$ZakazOUT		= $_shop_xml['begin'].$ZakazOUT.$_shop_xml['end'];
        		$ZakazPozOUT	= $_shop_xml['begin'].$ZakazPozOUT.$_shop_xml['end'];
        						
				
				#  ��� ������������ ������ ��� �� ����������� � ��������� "������������"
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
         * ������� ����� ������� � ������ ��������
         *
         */
        function UpdateToOld()
        {
        	$sql = 'UPDATE se_orders SET status = 3 WHERE status = 2';
        	$this->std->db->do_query($sql);        	
        }
}
?>
