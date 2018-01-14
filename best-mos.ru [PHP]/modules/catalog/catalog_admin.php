<?
#
#  Ядро системы и разделы сайта
#  Админка статических страниц
#
#  Modified         :
#  Version          : 1.0
#  Programmer       : Kormishin Vladimir
#

# Статусы:
# 0 - закрыта
# 1 - открыта
# 2 - срочная


class mod_catalog
{

        var $output = '';
        var $global_ids = array();
        var $is_father_enable = true;
        var $modulename  = 'catalog';
        var $statuses = array('1' => 'Открыта', '2' => 'Срочная', '0' => 'Закрытая');

        function process_module()
        {
                // модуль c конфигурационными данными
                require_once(TEMPLATES_PATH.'/catalog_t_config.php');

                // выводим навигацию по модулю
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

                
                $this->output        .= "<td><a href='?action=catalog&id={$id}'>Товары</a> </td>";
                //$this->output        .= "<td>| <a href='?action=catalog_add&id=".$id."'>Новый товар</a> </td>";
                
                
                
                # на уровень выше
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

                                $this->output        .= "<td>| <a href='?action=catalog&id=".$rows['pid']."'>На уровень выше</a></td>";
                        }
                }
                
                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_add'><<< Загрузить каталог >>></a>";
                //$this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_update'>!!! Обновить некоторые позиции !!!</a> ";
                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog&go=price_insert_update'>>>> Вставить/обновить позиции <<<</a> </td>";
                
                
                
                
				/*if ($this->std->settings['catalog_categories_enable'])
				{
                		$this->output        .= "<td> | <a href='?action=catalog_cats'>Категории</a> </td>";
				}
				if ($this->std->settings['catalog_properties_enable'])
				{
		                $this->output        .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='?action=catalog_props'>Свойства</a> </td>";
        		        $this->output        .= "<td>| <a href='?action=catalog_sets'>Наборы свойств</a> </td>";
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
         * Загрузка каталога из внешнего источника - XML
         *
         */
        function catalog_price_add()
        {    	
        		
        	if (!isset($_FILES["xml_goods"]))
	        {
	        		$this->output .= '<center>
	        			<h1>Загрузка каталога товаров</h1>
	        			<form method=post enctype=multipart/form-data>
	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
	        			<input type="submit" value="Загрузить">
	        			</form></center>';
	        }
	        else
	        {
		        	$this->output .= '<center>Каталог загружен</center>';
		        	
		        	# парсим xml файл и записываем в базу
		        	$this->parse_price($_FILES["xml_goods"]["tmp_name"]);
	        }
	        
	        
        	
        	
        }
        
         
        /**
         * Загрузка товаров и цен
         * парсинг входящего XML - запись в базу
         *
         * @return unknown
         */
        function parse_price($file)
        {
            
        		#-------------------------------------------------------
				# подготовительная часть
				#-------------------------------------------------------				
				$this->std->xmlfileInit($file, $xml);
				if (!$xml) 
				{
					return "Файл недоступен или пуст";
				}
				
				
        		# если по каким-то причинам каталог пуст, то нужно об этом сообщить
				if (count($xml->xml_array['dataroot']['TTovar']) == 0)
				{
					$this->output .= '<center>Каталог пуст, проверьте правильность XML</center>';
					return;
				}
				
				
				# создание временной таблицы (если она есть)
				$sql = "DROP TABLE IF EXISTS `se_catalog_tmp`";
				$this->std->db->do_query($sql);
				
				# создание новой временной таблицы
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
				
				
				
				
				# формирование запросов вставки в таблицу
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
						
						# дополнительная информация
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
				
				
				# удаление текущей таблицы
				$sql = "DROP TABLE IF EXISTS `se_catalog`";
				$this->std->db->do_query($sql);
				
				# переименование временной таблицы в постоянную
				$sql = 'ALTER TABLE `se_catalog_tmp` RENAME `se_catalog`';
				$this->std->db->do_query($sql);
                                
                                



                                # деактивация в полученом каталоге всех узлов, содержащих только неактивные вершины
                                # 6 итераций - хватит за глаза!!!
                                for ($i = 1; $i < 6; $i++)
                                {
                                    # gjkextybt всех
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
//         * Загрузка каталога из внешнего источника - XML
//         *
//         */
//        function catalog_price_update()
//        {    	
//        		
//        	if (!isset($_FILES["xml_goods"]))
//	        {
//	        		$this->output .= '<center>
//	        			<h1>Обноваление каталога товаров</h1>
//	        			<form method=post enctype=multipart/form-data>
//	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
//	        			<input type="submit" value="Загрузить">
//	        			</form></center>';
//	        }
//	        else
//	        {
//		        	$this->output .= '<center>Каталог загружен, позиции обновлены</center>';
//		        	
//		        	# парсим xml файл и записываем в базу
//		        	$this->parse_priceupdate($_FILES["xml_goods"]["tmp_name"]);
//	        }	        
//        }
//        
//         
//        /**
//         * Загрузка товаров и цен
//         * парсинг входящего XML - запись в базу
//         *
//         * @return unknown
//         */
//        function parse_priceupdate($file)
//        {
//        		#-------------------------------------------------------
//				# подготовительная часть
//				#-------------------------------------------------------				
//				$this->std->xmlfileInit($file, $xml);
//				if (!$xml) 
//				{
//					return "Файл недоступен или пуст";
//				}
//				
//				
//        		# если по каким-то причинам каталог пуст, то нужно об этом сообщить
//				if (count($xml->xml_array['dataroot']['TUpdate']) == 0)
//				{
//					$this->output .= '<center>Каталог пуст, проверьте правильность XML</center>';
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
//				# формирование запросов обноваления данных таблицы
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
//						# дополнительная информация
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
//                                 # деактивация в полученом каталоге всех узлов, содержащих только неактивные вершины
//                                # 6 итераций - хватит за глаза!!!
//                                for ($i = 1; $i < 6; $i++)
//                                {
//                                    # gjkextybt всех
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
         * Загрузка каталога из внешнего источника - XML
         *
         */
        function catalog_price_Insert_Update()
        {    	
        		
        	if (!isset($_FILES["xml_goods"]))
	        {
	        		$this->output .= '<center>
	        			<h1>Добавление товаров в каталог</h1>
	        			<form method=post enctype=multipart/form-data>
	        			<input type="file" name="xml_goods">&nbsp;&nbsp;&nbsp;
	        			<input type="submit" value="Загрузить">
	        			</form></center>';
	        }
	        else
	        {
		        	$this->output .= '<center>Позиции добавлены</center>';
		        	
		        	# парсим xml файл и записываем в базу
		        	$this->parse_priceInsertUpdate($_FILES["xml_goods"]["tmp_name"]);
	        }	        
        }
        
         
        /**
         * Загрузка товаров и цен
         * парсинг входящего XML - запись в базу
         *
         * @return unknown
         */
        function parse_priceInsertUpdate($file)
        {
        		#-------------------------------------------------------
				# подготовительная часть
				#-------------------------------------------------------				
				$this->std->xmlfileInit($file, $xml);
				if (!$xml) 
				{
					return "Файл недоступен или пуст";
				}
				
				
        		# если по каким-то причинам каталог пуст, то нужно об этом сообщить
				if (count($xml->xml_array['dataroot']['TTovar']) == 0)
				{
					$this->output .= '<center>Каталог пуст, проверьте правильность XML</center>';
					return;
				}
				
				if (!isset($xml->xml_array['dataroot']['TTovar'][0]))
				{
					$tmp = array();
					$tmp = $xml->xml_array['dataroot']['TTovar'];
					$xml->xml_array['dataroot']['TTovar'] = array();
					$xml->xml_array['dataroot']['TTovar'][0] = $tmp;
				}
				
				
				// необходимо получить список всех идентификаторов в каталоге
				$catalog_ids = array();
				$sql = "SELECT id FROM se_catalog";
				if ($this->std->db->query($sql, $rows) > 0)
				{
					foreach ($rows as $row){
						$catalog_ids[] = $row['id'];
					}
				}
				
				
				
				
				# формирование запросов обноваления данных таблицы
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
						
						# дополнительная информация
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
							// обновление
							$this->std->db->do_update("catalog", $pms, "id = '".$pms['id']."'");
						}else{
							// вставка
							$this->std->db->do_insert("catalog", $pms);
						}
						
						
				}





                                 # деактивация в полученом каталоге всех узлов, содержащих только неактивные вершины
                                # 6 итераций - хватит за глаза!!!
                                for ($i = 1; $i < 6; $i++)
                                {
                                    # gjkextybt всех
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
		 * вывод подкаталогов определённого уровня
		 *
		 */
        function catalog_content( )
        {
                
                // определение идентификатора каталога
                $id  = isset($this->std->input['id']) ? $this->std->input['id'] : -1;  // айдишник родителя

                $alias_arr        = array();

                /***************************************************************************
                        формирование таблички пунктов каталога
                ****************************************************************************/
                $this->output        .= "<center>";

                $sql = "select modulename from se_modules";
                $this->std->db->do_query($sql);
                $modulename  = array();
                while ($row = $this->std->db->fetch_row())
                {
                        $modulename[] = $row['modulename'];
                }

                // запрашиваем пункты
                $sql         = "select c1.*, count(c2.id) as childs from `se_catalog` c1
                                                left join `se_catalog` c2 on (c2.pid=c1.id)
                                    where c1.pid='".$id."'
                                    group by c1.id order by c1.item_order";
                $this->std->db->do_query($sql);
                $row_count = $this->std->db->getNumRows();

                if ($row_count > 0)
                {

                        
                        $this->output        .= '<table border="1">';
                        $this->output        .= '<tr><td colspan=2>&nbsp;</td><td align=left>Название</td><td align="right">Цeнa, р.</td><td align="right">Порядок</td></tr>';


                        $i = 0;
                        while ($row = $this->std->db->fetch_row())
                        {
                                // определение астивности пунктов меню
                                 $item_active        = '';
                                 $title                        = 'активировать';
                                 if ($row['is_active'] == 1){
                                         $item_active        = ' checked ';
                                         $title                        = 'деактивировать';
                                 }


                                if ($item_active != ''){
                                         $this->output .= '<tr style="background:#CCFFCC;">';
                                }else{
                                        $this->output .= '<tr style="background:#FFDDDD;">';
                                }
                                 
                                 if ($row['childs'] > 0){
                                         $this->output   .= '<td width=30 align=center><a href="/admin/?action=catalog&id='.$row['id'].'"  title="Просмотреть подкаталоги"><img src="/'.ADMIN_FOLDER.'/image/catalog.gif"></a></td>';
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

                                 /****конец: определение астивности пунктов меню*************************************/


                                 

                                $this->output        .= '<td width=70%>'.$row['title'].'</td>                                                        
                                                        <td align="right" width=90>'.round($row['price']).'</td>
                                                        ';


                                // кнопки упорядочивания
                                $this->output .= '<td align="right">'.$row['item_order'].'</td>';


                                
                                $this->output.= '</tr>';
                                $i++;
                        }
                        
                }else{
                        $this->output        .= 'Каталог пуст';
                }
                $this->output        .= '</center>';
        }        
        
        
        

        /**
         * функция делает вершину либо активной либо деактивирует её
         *
         */
        function catalog_active($id)
        {
                // инфо о деактивируемой вершины
                $sql   = "select is_active from `se_catalog` where id='".$id."'";
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // меняем данные обрабатываемого каталога, делаем его активным либо неактивным
                        $this->catalog_active_recurs($id, ($rows['is_active'] ? 0 : 1));
                }
        }
        

        /**
         * Реккурсивное изменение статусов активности у всего подчинённого дерева
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
                                $this->catalog_active_recurs($row['id'], $is_active);  // очередной реккурсивный вызов
                        }
                }

                // инфо о деактивируемой вершины
                $sql        = "select is_active from `se_catalog` where id='".$id."'";
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // меняем данные обрабатываемого каталога, делаем его активным либо неактивным
                        $this->std->db->do_update( 'catalog', array( 'is_active' => $is_active), "id='".$id."'" );
                }

        }
        
         /***************************************************************************************************
                РАЗДЕЛ РАБОТЫ С МЕНЮ
        ***************************************************************************************************/



        /**
         * построения девера наследования для переноса информации в меню
         *
         * @param unknown_type $pid                       - родитель
         * @param unknown_type $tab                       - отступы (наведение красоты)
         * @param unknown_type $form                      - форма вывода
         * @param unknown_type $alias                     - путь (заносится в пункты меню)
         * @param unknown_type $alias_arr                 -
         * @param unknown_type $id                        - список используемых ID (участвующих в списке)
         */
        function setcatalogTree($pid, $tab, &$form, $alias, $alias_arr)
        {
                $sql        = "select * from se_catalog where is_active = 1 and pid = '".$pid."' ORDER BY pid, item_order";  // странички с определённым родителем
                $this->std->db->do_query($sql);

                $alias = str_replace("//", '/', $alias);

                // если статические страницы уже есть в системе
                if ( $this->std->db->getNumRows() )
                {
                        while ($rows = $this->std->db->fetch_row())
                        {  // по все найденым страницам
                              $data[] = $rows;
                        }

                        foreach($data as $id => $row)
                        {
                                $cheched        = '';
                                if (in_array($alias.$row['alias']."/",$alias_arr))
                                {
                                        $cheched = 'checked';
                                }

                                // фиксим интересный баг, даже не понимаю откуда он взялся
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



        // формирование меню, составление дерева ссылок
        // Для составления меню, необходимы прямые ссылки на страницы. Все страницы подчинены правилу построения дерева.
        // данная функция вызывается из "admin_menu.php" из функции "menu_content"
        function catalog_menu($alias_arr)
        {

                $cheched = '';
                if (in_array("/catalog/",$alias_arr))
                {
                        $cheched = 'checked';
                }

                $form = @$nbsp."<table><tr><td width='0'></td><td align=left>
                                                                                        - <input type='checkbox' name='-1_checkbox' $cheched>&nbsp;Деревянный модуль - catalog version
                                                                                          <input type='hidden' name='-1_url' value='/catalog/'>
                                                                                          <input type='hidden' name='-1_name' value='Главная страница модуля'>
                                                                                </td></tr></table>";

                $sql        = "select alias from se_catalog where is_active = 1 and pid = -1 ORDER BY pid, item_order, id";  // пункты вурхнего уровня, у них нет родителей
                $this->std->db->do_query($sql);
                $this->global_ids[]    = -1;  // строка будет содержать строку с перечнем айдишников
                // если статические страницы уже есть в системе

                if ($row = $this->std->db->fetch_row())
                {
                       $this->setcatalogTree(-1, 3, $form, "/catalog/", $alias_arr, @$id);
                }

                $form = "<input type='hidden' name='module_list_id' value='".implode(' ', $this->global_ids)."'>
                                         <input type='hidden' name='module_tablename' value='catalog'>
                                         <table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='Обновить меню'>";
                return $form;
        }


        
		/**
		 * функция составления полной строки адреса по пришедшему идентификатору,  
		 * проходит вверх по дереву до корня и получает правильный полный адрес
		 *
		 * @param unknown_type $id
		 * @param unknown_type $alias
		 */
        function getPagePathById($id, &$alias)
        {
                $this->std->_getPagePathById($id, &$alias, 'catalog');
        }


		/**
		 * рекурсивное обновление таблицы меню в соответствии со структурой таблицы catalog_TABLE 
		 * вызывается из функции catalog_MoveToMenu
		 *
		 * @param unknown_type $id
		 * @param unknown_type $pid
		 */
        function setRecurscatalog($id   /*идентификатор вершины в таблице*/ , $pid   /*идентификатор отца в таблице меню*/ )
        {
                $this->std->_MoveToMenuRecurc($id, $pid, 'catalog');
        }



        /**
         * функция для переноса структуры модуля в структуру меню, начиная с указанной вершины
         *
         * @param unknown_type $id
         * @param unknown_type $pid
         */
        function catalog_MoveToMenu($id   /*идентификатор вершины в таблице*/ , $pid   /*идентификатор отца в таблице меню*/ )
        {
                $this->std->_MoveToMenu($id, $pid, 'catalog');
        }


        /**
         * функция для пересоздания подчинённых динамических вершин в меню
         *
         */
        function catalog_addTreeToMenu()
        {
                $this->std->_addTreeToMenu('catalog');
        }

}


?>