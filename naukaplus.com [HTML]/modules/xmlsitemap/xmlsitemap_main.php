<?php
#
#        Объект - построение дерева сайта
#        Вызов: /sitemap/
#

include_once './include/lib/class_parent.php';

class main_xmlsitemap extends AbstractClass {



        /*---------------------------------------------------------------------------------------------------*/
        // Функция которая запустится по умолчанию первой(конструктор нам не подходит)
        /*---------------------------------------------------------------------------------------------------*/

        function xmlsitemapClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        )
        {


                $this->AbstractClass(
                                       $sub_alias,         // путь разложенный в массив
                                       'xmlsitemap',        // название таблицы с которой будем работать
                                       'xmlsitemap'           // название модуля (то как модуль называется в таблице modules)
                					);


                $this->process();
        }


		/**
		 * Проверка времени последнего обновления карты сайта
		 */
		function process()
		{
                # определение время последнего редактирования файла
                $file_rectime = 0;
                if (file_exists("./sitemap.xml"))
                {
	                $file_rectime = filectime("./sitemap.xml");
	                if (!$file_rectime) $file_rectime = 0;	                
                }
                

                # проверка времени: если время последней записи уже меньше чем пауза между обновлениями, то перезапись               
                if ( (time() - $file_rectime) > ($this->std->settings["xmlsitemap_pause"] * 3600) )
                {
                		# запрос информации о составе xmlsitemap и времени последнего обновления
						$sql = "select * from `se_xmlsitemap`";
		                $this->std->db->do_query($sql);
		                $xmlsitemap = $this->std->db->fetch_row();
                	
                		# новае точка времени
                		$xmlsitemap["lastmodified"] = time();

                		# пересоздание карты сайта для Google и Яндекс
                		$this->createXMLSiteMap( unserialize( $xmlsitemap["menu_names"] ) );
                		

                		# обновление даты последнего обновления в таблице модуля
                        $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");
                }
		}


		
		/**
		 * формирование карты сайта
		 *
		 */
		private function createXMLSiteMap( $menu_names )
		{
			$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			
			
			# 1. список статических страниц
			# по списку доступных для модуля меню
         	foreach ( $this->std->menu_array["root"] as $menu )
         	{
					# если меню входит в список, то по нему нужно строить XML карту
					if ( in_array($menu["alias"], $menu_names) )
					{
							# передаем
							$xml .= $this->getMenuMap( $menu["id"] );
					}
         	}
			
			
			# 2. список страниц каталога
			$xml .= $this->getCatalogMap();
			
			
			
			//----------------------------------------------------------
			// сохранение карты сайта в файле
			//----------------------------------------------------------
			$xml .= '</urlset>';
            if (file_exists("./sitemap.xml")) @unlink("./sitemap.xml");
                
			$handle = fopen( "./sitemap.xml", "w" );
			fwrite( $handle, $xml );
			fclose( $handle );
			@chmod("./sitemap.xml", 0776);		}
		


        /**
         * Обход дерева в ширину
         */
        function getMenuMap( $id )
        {
        		if ( isset($this->std->menu_array[$id]) )
        		{
		        		global $host;

						$childs = array();
		        		$xml = "";
		        		$i = 0;
						# вывод всех вершин в XML
						foreach ( $this->std->menu_array[$id] as $item )
						{
		                 		$xml .= "<url>";
		                 		$xml .= "<loc>http://".$host.$item["alias"]."</loc>";
		                 		$xml .= "<lastmod>".date("Y-m-d", $item["timestamp"])."</lastmod>";
		                 		$xml .= "</url>";
		                 		$childs[$i] = $item["id"];
		                 		$i++;
						}

						# вызов поочереди всех детей
						$count = count($childs);
						for ( $i = 0; $i < $count; $i++ )
						{
								$xml .= $this->getMenuMap( $childs[$i] );
						}

						return $xml;
				}
        }
        
        
        private function getCatalogMap()
        {
        	global $host;
        	$xml = '';
        	require_once './modules/catalog/catalog_main.php';
        	
        	
        	$catalog = new main_catalog('catalog', $this->std);
        	
	        if (!$catalog->initTreeWithoutSheet('id, pid, alias, is_redirect'))
			{
				return $xml; // если каталог пустой, то выходим
			}
        	
        	$sql = "SELECT id, pid, timestamp, alias FROM se_catalog";
        	if ($this->std->db->query($sql, $rows))
        	{
        		foreach ($rows as $row)
        		{
        			$row['alias'] = $catalog->getAliasByPid($row);
        			
        			$xml .= "<url><loc>http://".$host.$row['alias']."</loc><lastmod>".date("Y-m-d", $row['timestamp'])."</lastmod></url>";
        		}
        	}
        	
        	
        	return $xml;
        	
        }
        

}
?>