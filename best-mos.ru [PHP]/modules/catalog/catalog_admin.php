<?
#
#  ���� ������� � ������� �����
#  ������� ����������� �������
#
#  Modified         :
#  Version          : 1.0
#  Programmer       : Kormishin Vladimir
#

# �������:
# 0 - �������
# 1 - �������
# 2 - �������


class mod_catalog
{

        var $output = '';
        var $global_ids = array();
        var $is_father_enable = true;
        var $modulename  = 'catalog';
        var $statuses = array('1' => '�������', '2' => '�������', '0' => '��������');

        function process_module()
        {
                // ������ c ����������������� �������
                require_once(TEMPLATES_PATH.'/catalog_t_config.php');

                // ������� ��������� �� ������
                $this->output        = '<br><table><tr><td width="50"></td><td>';

                $this->output        .= '</td>';
                $id = -1;

                if( isset($this->std->input['alias'])  and $this->std->input['alias']!='')
                {
                        $this->std->input['alias'] = strtolower($this->std->input['alias']);
                }

                if (isset($this->std->input['id']))
                {
                        $id = $this->std->input['id'];
                }

                
                $this->output        .= "<td><a href='?action=catalog&id={$id}'>������</a> </td>";
                //$this->output        .= "<td>| <a href='?action=catalog_add&id=".$id."'>����� �����</a> </td>";
                
                
                
                # �� ������� ����
        		if ($id != '-1')
                {
                        $sql = "select pid, is_active from `se_catalog` where id='".$id."'";
                        $this->std->db->do_query($sql);

                        if ( $rows = $this->std->db->fetch_row() )
                        {
                                if( !$rows['is_active'] )
                                {
                                        $this->is_father_enable = false;
                                }

                                $this->output        .= "<td>| <a href='?action=catalog&id=".$rows['pid']."'>�� ������� ����</a></td>";
                        }
                }
                
                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_add'><<< ��������� ������� >>></a>";
                //$this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_update'>!!! �������� ��������� ������� !!!</a> ";
                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_insert_update'>>>> ��������/�������� ������� <<<</a> </td>";
                
                
                
                
				/*if ($this->std->settings['catalog_categories_enable'])
				{
                		$this->output        .= "<td> | <a href='?action=catalog_cats'>���������</a> </td>";
				}
				if ($this->std->settings['catalog_properties_enable'])
				{
		                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog_props'>��������</a> </td>";
        		        $this->output        .= "<td>| <a href='?action=catalog_sets'>������ �������</a> </td>";
				}*/
                

                

                $this->output        .= '</tr></table>';

                switch($this->std->input['go'])
                {
                		case 'price_add':
                			$this->catalog_price_add();    
                			break;            			            			
//                		case 'price_update':
//                			$this->catalog_price_update();
//                			break; 
                		case 'price_insert_update':
                			$this->catalog_price_Insert_Update();
                			break; 	
                			
                			
                		case 'index_add':
                			$this->catalog_index_add();                			            			
                			break; 

                		case 'active':
                                $itemid = $this->std->input['itemid'];
                                $this->catalog_active($itemid);
                                $this->catalog_content( );
                                break;	
                			
                        default:
                                $this->catalog_content();
                                break;
                }
        }

        /**
         * �������� �������� �� �������� ��������� - XML
         *
         */
        function catalog_price_add()
        {    	
        		
        	if (!isset($_FILES["xml_goods"]))
	        {
	        		$this->output .= '<center>
	        			<h1>�������� �������� �������</h1>
	        			<form method=post enctype=multipart/form-data>
	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
	        			<input type="submit" value="���������">
	        			</form></center>';
	        }
	        else
	        {
		        	$this->output .= '<center>������� ��������</center>';
		        	
		        	# ������ xml ���� � ���������� � ����
		        	$this->parse_price($_FILES["xml_goods"]["tmp_name"]);
	        }
	        
	        
        	
        	
        }
        
         
        /**
         * �������� ������� � ���
         * ������� ��������� XML - ������ � ����
         *
         * @return unknown
         */
        function parse_price($file)
        {
            
        		#-------------------------------------------------------
				# ���������������� �����
				#-------------------------------------------------------				
				$this->std->xmlfileInit($file, $xml);
				if (!$xml) 
				{
					return "���� ���������� ��� ����";
				}
				
				
        		# ���� �� �����-�� �������� ������� ����, �� ����� �� ���� ��������
				if (count($xml->xml_array['dataroot']['TTovar']) == 0)
				{
					$this->output .= '<center>������� ����, ��������� ������������ XML</center>';
					return;
				}
				
				
				# �������� ��������� ������� (���� ��� ����)
				$sql = "DROP TABLE IF EXISTS `se_catalog_tmp`";
				$this->std->db->do_query($sql);
				
				# �������� ����� ��������� �������
				$sql = "CREATE TABLE `se_catalog_tmp` (
						  `id` varchar(15) NOT NULL default '',
						  `pid` varchar(15) NOT NULL default '',
						  `timestamp` int(11) default NULL,
						  `lastmodified` int(11) default NULL,
						  `alias` varchar(60) NOT NULL default '',
						  `title` varchar(255) NOT NULL default '',
						  `h1` varchar(255) default NULL,
						  `sbody` text,
						  `body` text NOT NULL,
						  `author` varchar(255) NOT NULL default '',
						  `description` varchar(255) default NULL,
						  `keywords` varchar(255) default NULL,
						  `item_order` int(3) NOT NULL default '0',
						  `is_active` smallint(1) NOT NULL default '0',
						  `template` varchar(255) NOT NULL default '',
						  `menu` varchar(255) NOT NULL default '',
						  `owner` varchar(255) NOT NULL default '',
						  `is_redirect` tinyint(1) NOT NULL default '0',
						  `price` decimal(10,2) NOT NULL default '0.00',
						  `img` varchar(100) NOT NULL default '',
						  `is_hot` tinyint(1) NOT NULL default '0',
						  `set_id` int(11) NOT NULL default '0',
						  `is_sheet` smallint(1) NOT NULL default '0',
						  `catalog_id` int(11) default '0',
						  PRIMARY KEY  (`id`),
						  KEY `pid` (`pid`),
						  KEY `item_order` (`item_order`),
						  KEY `is_sheet` (`is_sheet`)
						) ENGINE=MyISAM DEFAULT CHARSET=cp1251";
				$this->std->db->do_query($sql);
				//print_r($xml->xml_array);
				//exit;
				
				
				
				
				# ������������ �������� ������� � �������
				foreach ($xml->xml_array['dataroot']['TTovar'] as $item)
				{
						$pms = array();
						$pms['id'] = $item['LotID']["VALUE"];
						$pms['pid'] = ($item['UselID']["VALUE"] == 'root') ? '-1' : $item['UselID']["VALUE"];
						$pms['catalog_id'] = $item['KodKat']["VALUE"];
						$pms['timestamp'] = time();
						$pms['is_sheet'] = $item['is_sheet']["VALUE"];
						
						$tmp = $item['LotName']["VALUE"]; 
						$value = iconv("utf-8", "cp1251", $tmp);
						$pms['title'] = $value;
						$pms['h1'] = $value;
						$pms['menu'] = $value;
						
						$pms['alias'] = $item['LotID']["VALUE"];
						$pms['price'] = $item['KatPrice']["VALUE"];
						$pms['item_order'] = $item['npp']["VALUE"];
						
						$pms['is_active'] = $item['is_active']["VALUE"];
						
						
						$tmp = $item['Description']["VALUE"];
						$value = iconv("utf-8", "cp1251", $tmp);
						$pms['body'] = $value;
						
						# �������������� ����������
						$dop_description = array();
						if (isset($item['Description1']))
						{
							$tmp = $item['Description1']["VALUE"];							
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description1'] = $value;
							}							
						}
						if (isset($item['Description2']))
						{
							$tmp = $item['Description2']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description2'] = $value;
							}						
						}
						if (isset($item['Description3']))
						{
							$tmp = $item['Description3']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description3'] = $value;
							}						
						}
						if (isset($item['Description4']))
						{
							$tmp = $item['Description4']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description4'] = $value;
							}						
						}
						$pms['sbody'] = '';		
									
						if (count($dop_description) > 0)
						{
							$pms['sbody'] = serialize($dop_description);
						}
						
						
						
						$this->std->db->do_insert("catalog_tmp", $pms);
				}
				
				
				# �������� ������� �������
				$sql = "DROP TABLE IF EXISTS `se_catalog`";
				$this->std->db->do_query($sql);
				
				# �������������� ��������� ������� � ����������
				$sql = 'ALTER TABLE `se_catalog_tmp` RENAME `se_catalog`';
				$this->std->db->do_query($sql);
                                
                                



                                # ����������� � ��������� �������� ���� �����, ���������� ������ ���������� �������
                                # 6 �������� - ������ �� �����!!!
                                for ($i = 1; $i < 6; $i++)
                                {
                                    # gjkextybt ����
                                    $sql = "SELECT A.id
                                            FROM se_catalog AS A
                                            WHERE A.is_active = 1 AND A.is_sheet = 0 AND ((SELECT COUNT(B.id)
                                            FROM se_catalog AS B
                                            WHERE (B.pid = A.id) AND (B.is_active = 1)) = 0)";
                                    if ($this->std->db->query($sql, $rows) > 0)
                                    {
                                        $in = array();
                                        foreach ($rows as $row)
                                        {
                                            $in[] = $row['id'];
                                        }

                                        if (count($in) > 0)
                                        {
                                            $sql = "UPDATE se_catalog SET is_active = 0 WHERE id IN ('".  implode("','", $in)."')";
                                            $this->std->db->do_query($sql);
                                        }
                                    }
                                }
        }
        
        
        
        
        
//        
//
//        /**
//         * �������� �������� �� �������� ��������� - XML
//         *
//         */
//        function catalog_price_update()
//        {    	
//        		
//        	if (!isset($_FILES["xml_goods"]))
//	        {
//	        		$this->output .= '<center>
//	        			<h1>����������� �������� �������</h1>
//	        			<form method=post enctype=multipart/form-data>
//	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
//	        			<input type="submit" value="���������">
//	        			</form></center>';
//	        }
//	        else
//	        {
//		        	$this->output .= '<center>������� ��������, ������� ���������</center>';
//		        	
//		        	# ������ xml ���� � ���������� � ����
//		        	$this->parse_priceupdate($_FILES["xml_goods"]["tmp_name"]);
//	        }	        
//        }
//        
//         
//        /**
//         * �������� ������� � ���
//         * ������� ��������� XML - ������ � ����
//         *
//         * @return unknown
//         */
//        function parse_priceupdate($file)
//        {
//        		#-------------------------------------------------------
//				# ���������������� �����
//				#-------------------------------------------------------				
//				$this->std->xmlfileInit($file, $xml);
//				if (!$xml) 
//				{
//					return "���� ���������� ��� ����";
//				}
//				
//				
//        		# ���� �� �����-�� �������� ������� ����, �� ����� �� ���� ��������
//				if (count($xml->xml_array['dataroot']['TUpdate']) == 0)
//				{
//					$this->output .= '<center>������� ����, ��������� ������������ XML</center>';
//					return;
//				}
//				
//				if (!isset($xml->xml_array['dataroot']['TUpdate'][0]))
//				{
//					$tmp = array();
//					$tmp = $xml->xml_array['dataroot']['TUpdate'];
//					$xml->xml_array['dataroot']['TUpdate'] = array();
//					$xml->xml_array['dataroot']['TUpdate'][0] = $tmp;
//				}
//				
//				
//				# ������������ �������� ����������� ������ �������
//				foreach ($xml->xml_array['dataroot']['TUpdate'] as $item)
//				{
//				
//						$pms = array();
//						$pms['id'] = $item["LotID"]["VALUE"];
//						$pms['pid'] = ($item['UselID']["VALUE"] == 'root') ? '-1' : $item['UselID']["VALUE"];
//						$pms['catalog_id'] = $item['KodKat']["VALUE"];
//						$pms['timestamp'] = time();
//						$pms['is_sheet'] = $item['is_sheet']["VALUE"];
//						
//						$tmp = $item['LotName']["VALUE"]; 
//						$value = iconv("utf-8", "cp1251", $tmp);
//						$pms['title'] = $value;
//						$pms['h1'] = $value;
//						$pms['menu'] = $value;
//						
//						$pms['alias'] = $item['LotID']["VALUE"];
//						$pms['price'] = $item['KatPrice']["VALUE"];
//						$pms['item_order'] = $item['npp']["VALUE"];
//						
//						$pms['is_active'] = $item['is_active']["VALUE"];
//						
//						
//						$tmp = $item['Description']["VALUE"];
//						$value = iconv("utf-8", "cp1251", $tmp);
//						$pms['body'] = $value;
//						
//						# �������������� ����������
//						$dop_description = array();
//						if (isset($item['Description1']))
//						{
//							$tmp = $item['Description1']["VALUE"];							
//							$value = iconv("utf-8", "cp1251", $tmp);
//							if ($value != '')
//							{							
//								$dop_description['Description1'] = $value;
//							}							
//						}
//						if (isset($item['Description2']))
//						{
//							$tmp = $item['Description2']["VALUE"];
//							$value = iconv("utf-8", "cp1251", $tmp);
//							if ($value != '')
//							{							
//								$dop_description['Description2'] = $value;
//							}						
//						}
//						if (isset($item['Description3']))
//						{
//							$tmp = $item['Description3']["VALUE"];
//							$value = iconv("utf-8", "cp1251", $tmp);
//							if ($value != '')
//							{							
//								$dop_description['Description3'] = $value;
//							}						
//						}
//						if (isset($item['Description4']))
//						{
//							$tmp = $item['Description4']["VALUE"];
//							$value = iconv("utf-8", "cp1251", $tmp);
//							if ($value != '')
//							{							
//								$dop_description['Description4'] = $value;
//							}						
//						}
//						$pms['sbody'] = '';		
//									
//						if (count($dop_description) > 0)
//						{
//							$pms['sbody'] = serialize($dop_description);
//						}
//						
//						
//						
//						$this->std->db->do_update("catalog", $pms, "id = '".$pms['id']."'");
//				}
//
//
//
//
//
//                                 # ����������� � ��������� �������� ���� �����, ���������� ������ ���������� �������
//                                # 6 �������� - ������ �� �����!!!
//                                for ($i = 1; $i < 6; $i++)
//                                {
//                                    # gjkextybt ����
//                                    $sql = "SELECT A.id
//                                            FROM se_catalog AS A
//                                            WHERE A.is_active = 1 AND A.is_sheet = 0 AND ((SELECT COUNT(B.id)
//                                            FROM se_catalog AS B
//                                            WHERE (B.pid = A.id) AND (B.is_active = 1)) = 0)";
//                                    if ($this->std->db->query($sql, $rows) > 0)
//                                    {
//                                        $in = array();
//                                        foreach ($rows as $row)
//                                        {
//                                            $in[] = $row['id'];
//                                        }
//
//                                        if (count($in) > 0)
//                                        {
//                                            $sql = "UPDATE se_catalog SET is_active = 0 WHERE id IN ('".  implode("','", $in)."')";
//                                            $this->std->db->do_query($sql);
//                                        }
//                                    }
//                                }
//				
//        }        
//        
//        
        
        
        
        
        

        /**
         * �������� �������� �� �������� ��������� - XML
         *
         */
        function catalog_price_Insert_Update()
        {    	
        		
        	if (!isset($_FILES["xml_goods"]))
	        {
	        		$this->output .= '<center>
	        			<h1>���������� ������� � �������</h1>
	        			<form method=post enctype=multipart/form-data>
	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
	        			<input type="submit" value="���������">
	        			</form></center>';
	        }
	        else
	        {
		        	$this->output .= '<center>������� ���������</center>';
		        	
		        	# ������ xml ���� � ���������� � ����
		        	$this->parse_priceInsertUpdate($_FILES["xml_goods"]["tmp_name"]);
	        }	        
        }
        
         
        /**
         * �������� ������� � ���
         * ������� ��������� XML - ������ � ����
         *
         * @return unknown
         */
        function parse_priceInsertUpdate($file)
        {
        		#-------------------------------------------------------
				# ���������������� �����
				#-------------------------------------------------------				
				$this->std->xmlfileInit($file, $xml);
				if (!$xml) 
				{
					return "���� ���������� ��� ����";
				}
				
				
        		# ���� �� �����-�� �������� ������� ����, �� ����� �� ���� ��������
				if (count($xml->xml_array['dataroot']['TTovar']) == 0)
				{
					$this->output .= '<center>������� ����, ��������� ������������ XML</center>';
					return;
				}
				
				if (!isset($xml->xml_array['dataroot']['TTovar'][0]))
				{
					$tmp = array();
					$tmp = $xml->xml_array['dataroot']['TTovar'];
					$xml->xml_array['dataroot']['TTovar'] = array();
					$xml->xml_array['dataroot']['TTovar'][0] = $tmp;
				}
				
				
				// ���������� �������� ������ ���� ��������������� � ��������
				$catalog_ids = array();
				$sql = "SELECT id FROM se_catalog";
				if ($this->std->db->query($sql, $rows) > 0)
				{
					foreach ($rows as $row){
						$catalog_ids[] = $row['id'];
					}
				}
				
				
				
				
				# ������������ �������� ����������� ������ �������
				foreach ($xml->xml_array['dataroot']['TTovar'] as $item)
				{
				
						$pms = array();
						$pms['id'] = $item["LotID"]["VALUE"];
						$pms['pid'] = ($item['UselID']["VALUE"] == 'root') ? '-1' : $item['UselID']["VALUE"];
						$pms['catalog_id'] = $item['KodKat']["VALUE"];
						$pms['timestamp'] = time();
						$pms['is_sheet'] = $item['is_sheet']["VALUE"];
						
						$tmp = $item['LotName']["VALUE"]; 
						$value = iconv("utf-8", "cp1251", $tmp);
						$pms['title'] = $value;
						$pms['h1'] = $value;
						$pms['menu'] = $value;
						
						$pms['alias'] = $item['LotID']["VALUE"];
						$pms['price'] = $item['KatPrice']["VALUE"];
						$pms['item_order'] = $item['npp']["VALUE"];
						
						$pms['is_active'] = $item['is_active']["VALUE"];
						
						
						$tmp = $item['Description']["VALUE"];
						$value = iconv("utf-8", "cp1251", $tmp);
						$pms['body'] = $value;
						
						# �������������� ����������
						$dop_description = array();
						if (isset($item['Description1']))
						{
							$tmp = $item['Description1']["VALUE"];							
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description1'] = $value;
							}							
						}
						if (isset($item['Description2']))
						{
							$tmp = $item['Description2']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description2'] = $value;
							}						
						}
						if (isset($item['Description3']))
						{
							$tmp = $item['Description3']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description3'] = $value;
							}						
						}
						if (isset($item['Description4']))
						{
							$tmp = $item['Description4']["VALUE"];
							$value = iconv("utf-8", "cp1251", $tmp);
							if ($value != '')
							{							
								$dop_description['Description4'] = $value;
							}						
						}
						$pms['sbody'] = '';		
									
						if (count($dop_description) > 0)
						{
							$pms['sbody'] = serialize($dop_description);
						}
						
						
						if (in_array($pms['id'], $catalog_ids)){
							// ����������
							$this->std->db->do_update("catalog", $pms, "id = '".$pms['id']."'");
						}else{
							// �������
							$this->std->db->do_insert("catalog", $pms);
						}
						
						
				}





                                 # ����������� � ��������� �������� ���� �����, ���������� ������ ���������� �������
                                # 6 �������� - ������ �� �����!!!
                                for ($i = 1; $i < 6; $i++)
                                {
                                    # gjkextybt ����
                                    $sql = "SELECT A.id
                                            FROM se_catalog AS A
                                            WHERE A.is_active = 1 AND A.is_sheet = 0 AND ((SELECT COUNT(B.id)
                                            FROM se_catalog AS B
                                            WHERE (B.pid = A.id) AND (B.is_active = 1)) = 0)";
                                    if ($this->std->db->query($sql, $rows) > 0)
                                    {
                                        $in = array();
                                        foreach ($rows as $row)
                                        {
                                            $in[] = $row['id'];
                                        }

                                        if (count($in) > 0)
                                        {
                                            $sql = "UPDATE se_catalog SET is_active = 0 WHERE id IN ('".  implode("','", $in)."')";
                                            $this->std->db->do_query($sql);
                                        }
                                    }
                                }
				
        }           
        
        


         
		/**
		 * ����� ������������ ������������ ������
		 *
		 */
        function catalog_content( )
        {
                
                // ����������� �������������� ��������
                $id  = isset($this->std->input['id']) ? $this->std->input['id'] : -1;  // �������� ��������

                $alias_arr        = array();

                /***************************************************************************
                        ������������ �������� ������� ��������
                ****************************************************************************/
                $this->output        .= "<center>";

                $sql = "select modulename from se_modules";
                $this->std->db->do_query($sql);
                $modulename  = array();
                while ($row = $this->std->db->fetch_row())
                {
                        $modulename[] = $row['modulename'];
                }

                // ����������� ������
                $sql         = "select c1.*, count(c2.id) as childs from `se_catalog` c1
                                                left join `se_catalog` c2 on (c2.pid=c1.id)
                                    where c1.pid='".$id."'
                                    group by c1.id order by c1.item_order";
                $this->std->db->do_query($sql);
                $row_count = $this->std->db->getNumRows();

                if ($row_count > 0)
                {

                        
                        $this->output        .= '<table border="1">';
                        $this->output        .= '<tr><td colspan=2>&nbsp;</td><td align=left>��������</td><td align="right">�e�a, �.</td><td align="right">�������</td></tr>';


                        $i = 0;
                        while ($row = $this->std->db->fetch_row())
                        {
                                // ����������� ���������� ������� ����
                                 $item_active        = '';
                                 $title                        = '������������';
                                 if ($row['is_active'] == 1){
                                         $item_active        = ' checked ';
                                         $title                        = '��������������';
                                 }


                                if ($item_active != ''){
                                         $this->output .= '<tr style="background:#CCFFCC;">';
                                }else{
                                        $this->output .= '<tr style="background:#FFDDDD;">';
                                }
                                 
                                 if ($row['childs'] > 0){
                                         $this->output   .= '<td width=30 align=center><a href="/admin/?action=catalog&id='.$row['id'].'"  title="����������� �����������"><img src="/'.ADMIN_FOLDER.'/image/catalog.gif"></a></td>';
                                 }else{
                                         $this->output   .= '<td width=30 align=center>-</td>';
                                 }

                                 if( !$this->is_father_enable )
                                 {
                                         $this->output        .= '<td align=center><input name="'.$row['id'].'_item_active" type="checkbox" disabled></td>';
                                 }
                                 else
                                 {
                                         $this->output        .= '<td align=center><input name="'.$row['id'].'_item_active" type="checkbox" '.$item_active.' title="'.$title.'"
                                                                        OnClick="document.location.href =\'/admin/?action=catalog&go=active&id='.$id.'&itemid='.$row['id'].'\'"></td>';
                                 }

                                 /****�����: ����������� ���������� ������� ����*************************************/


                                 

                                $this->output        .= '<td width=70%>'.$row['title'].'</td>                                                        
                                                        <td align="right" width=90>'.round($row['price']).'</td>
                                                        ';


                                // ������ ��������������
                                $this->output .= '<td align="right">'.$row['item_order'].'</td>';


                                
                                $this->output.= '</tr>';
                                $i++;
                        }
                        
                }else{
                        $this->output        .= '������� ����';
                }
                $this->output        .= '</center>';
        }        
        
        
        

        /**
         * ������� ������ ������� ���� �������� ���� ������������ �
         *
         */
        function catalog_active($id)
        {
                // ���� � �������������� �������
                $sql   = "select is_active from `se_catalog` where id='".$id."'";
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // ������ ������ ��������������� ��������, ������ ��� �������� ���� ����������
                        $this->catalog_active_recurs($id, ($rows['is_active'] ? 0 : 1));
                }
        }
        

        /**
         * ������������ ��������� �������� ���������� � ����� ����������� ������
         *
         * @param unknown_type $id
         */
        function catalog_active_recurs($id, $is_active)
        {
                $sql          = "select * from se_catalog where pid='".$id."'";
                $this->std->db->do_query($sql);

                if ($this->std->db->getNumRows())
                {
                        while($rows = $this->std->db->fetch_row())
                        {
                                $r[] = $rows;
                        }


                        foreach($r as $_id => $row)
                        {
                                $this->catalog_active_recurs($row['id'], $is_active);  // ��������� ������������ �����
                        }
                }

                // ���� � �������������� �������
                $sql        = "select is_active from `se_catalog` where id='".$id."'";
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // ������ ������ ��������������� ��������, ������ ��� �������� ���� ����������
                        $this->std->db->do_update( 'catalog', array( 'is_active' => $is_active), "id='".$id."'" );
                }

        }
        
         /***************************************************************************************************
                ������ ������ � ����
        ***************************************************************************************************/



        /**
         * ���������� ������ ������������ ��� �������� ���������� � ����
         *
         * @param unknown_type $pid                       - ��������
         * @param unknown_type $tab                       - ������� (��������� �������)
         * @param unknown_type $form                      - ����� ������
         * @param unknown_type $alias                     - ���� (��������� � ������ ����)
         * @param unknown_type $alias_arr                 -
         * @param unknown_type $id                        - ������ ������������ ID (����������� � ������)
         */
        function setcatalogTree($pid, $tab, &$form, $alias, $alias_arr)
        {
                $sql        = "select * from se_catalog where is_active = 1 and pid = '".$pid."' ORDER BY pid, item_order";  // ��������� � ����������� ���������
                $this->std->db->do_query($sql);

                $alias = str_replace("//", '/', $alias);

                // ���� ����������� �������� ��� ���� � �������
                if ( $this->std->db->getNumRows() )
                {
                        while ($rows = $this->std->db->fetch_row())
                        {  // �� ��� �������� ���������
                              $data[] = $rows;
                        }

                        foreach($data as $id => $row)
                        {
                                $cheched        = '';
                                if (in_array($alias.$row['alias']."/",$alias_arr))
                                {
                                        $cheched = 'checked';
                                }

                                // ������ ���������� ���, ���� �� ������� ������ �� ������
                                $alias = preg_replace("#^catalog#is", "", $alias);

                                $form .= @$nbsp."<table><tr><td width=".($tab*10)."></td><td align=left>
                                                                        - <input type='checkbox' name='".$row['id']."_checkbox' $cheched>&nbsp;".$row['menu']."
                                                                          <input type='hidden' name='".$row['id']."_url' value='".$alias.$row['alias']."/'>
                                                                          <input type='hidden' name='".$row['id']."_name' value='".$row['menu']."'>
                                                                </td></tr></table>";
                                $this->global_ids[] = $row['id'];

                                $this->setcatalogTree($row['id'], $tab+3, $form, $alias.$row['alias']."/", $alias_arr);
                        }
                }
        }



        // ������������ ����, ����������� ������ ������
        // ��� ����������� ����, ���������� ������ ������ �� ��������. ��� �������� ��������� ������� ���������� ������.
        // ������ ������� ���������� �� "admin_menu.php" �� ������� "menu_content"
        function catalog_menu($alias_arr)
        {

                $cheched = '';
                if (in_array("/catalog/",$alias_arr))
                {
                        $cheched = 'checked';
                }

                $form = @$nbsp."<table><tr><td width='0'></td><td align=left>
                                                                                        - <input type='checkbox' name='-1_checkbox' $cheched>&nbsp;���������� ������ - catalog version
                                                                                          <input type='hidden' name='-1_url' value='/catalog/'>
                                                                                          <input type='hidden' name='-1_name' value='������� �������� ������'>
                                                                                </td></tr></table>";

                $sql        = "select alias from se_catalog where is_active = 1 and pid = -1 ORDER BY pid, item_order, id";  // ������ �������� ������, � ��� ��� ���������
                $this->std->db->do_query($sql);
                $this->global_ids[]    = -1;  // ������ ����� ��������� ������ � �������� ����������
                // ���� ����������� �������� ��� ���� � �������

                if ($row = $this->std->db->fetch_row())
                {
                       $this->setcatalogTree(-1, 3, $form, "/catalog/", $alias_arr, @$id);
                }

                $form = "<input type='hidden' name='module_list_id' value='".implode(' ', $this->global_ids)."'>
                                         <input type='hidden' name='module_tablename' value='catalog'>
                                         <table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='�������� ����'>";
                return $form;
        }


        
		/**
		 * ������� ����������� ������ ������ ������ �� ���������� ��������������,  
		 * �������� ����� �� ������ �� ����� � �������� ���������� ������ �����
		 *
		 * @param unknown_type $id
		 * @param unknown_type $alias
		 */
        function getPagePathById($id, &$alias)
        {
                $this->std->_getPagePathById($id, &$alias, 'catalog');
        }


		/**
		 * ����������� ���������� ������� ���� � ������������ �� ���������� ������� catalog_TABLE 
		 * ���������� �� ������� catalog_MoveToMenu
		 *
		 * @param unknown_type $id
		 * @param unknown_type $pid
		 */
        function setRecurscatalog($id   /*������������� ������� � �������*/ , $pid   /*������������� ���� � ������� ����*/ )
        {
                $this->std->_MoveToMenuRecurc($id, $pid, 'catalog');
        }



        /**
         * ������� ��� �������� ��������� ������ � ��������� ����, ������� � ��������� �������
         *
         * @param unknown_type $id
         * @param unknown_type $pid
         */
        function catalog_MoveToMenu($id   /*������������� ������� � �������*/ , $pid   /*������������� ���� � ������� ����*/ )
        {
                $this->std->_MoveToMenu($id, $pid, 'catalog');
        }


        /**
         * ������� ��� ������������ ���������� ������������ ������ � ����
         *
         */
        function catalog_addTreeToMenu()
        {
                $this->std->_addTreeToMenu('catalog');
        }

}


?>