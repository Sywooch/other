<?php
#
# XMLSiteMap - пользовательская часть
#


class main_xmlsitemap extends AbstractClass {



        
        # Функция которая запустится по умолчанию первой(конструктор нам не подходит)
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
                # запрос информации о составе xmlsitemap и времени последнего обновления
				$sql = "select * from `se_xmlsitemap`";
                $this->std->db->do_query($sql);
                $xmlsitemap = $this->std->db->fetch_row();

                # проверка времени
                if ( (time() - $xmlsitemap["lastmodified"]) > ($this->std->settings["xmlsitemap_pause"] * 3600) )
                {
                		# новое точка времени
                		$xmlsitemap["lastmodified"] = time();

                		# пересоздание карты сайта для Google
                		$this->createXMLSiteMap( unserialize( $xmlsitemap["menu_names"] ) );

                		# обновление даты последнего обновления в таблице модуля
                        $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");
                }
		}



		/**
		 * Формирование sitemap.xml
		 *
		 * @$menu_names - список меню, по которым нужно строить карту сайта
		 */
		function createXMLSiteMap( $menu_names )
		{
				$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

              // print_r($this->std->menu_array);
				# по списку доступных для модуля меню
         		foreach ( $this->std->menu_array["root"] as $menu )
         		{
						# если меню входит в список, то по нему нужно строить XML карту
						if ( in_array($menu["alias"], $menu_names) )
						{
								# передаем
								$xml .= $this->getWidth( $menu["id"] );
						}
         		}

                $xml .= '</urlset>';


				//----------------------------------------------------------
				// сохранение карты сайта в файле
				//----------------------------------------------------------

				$handle = fopen( "./sitemap.xml", "w" );
				fwrite( $handle, $xml );
				fclose( $handle );

		}

        /**
         * Обход дерева в ширину
         */
        function getWidth( $id )
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
								$temp = $item["alias"];
								if ($temp == "/index/") $temp = "/";
		                 		$xml .= "<url>";
		                 		$xml .= "<loc>http://".$host.$temp."</loc>";
		                 		$xml .= "<lastmod>".date("Y-m-d", $item["timestamp"])."</lastmod>";
		                 		$xml .= "</url>";
		                 		$childs[$i] = $item["id"];
		                 		$i++;
						}

						# вызов поочереди всех детей
						for ( $i = 0; $i < count($childs); $i++ )
						{
								$xml .= $this->getWidth( $childs[$i] );
						}

						return $xml;
				}
        }

}
?>