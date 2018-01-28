<?php
#
#        ������ - ���������� ������ �����
#        �����: /sitemap/
#

include_once './include/lib/class_parent.php';

class main_xmlsitemap extends AbstractClass {



        /*---------------------------------------------------------------------------------------------------*/
        // ������� ������� ���������� �� ��������� ������(����������� ��� �� ��������)
        /*---------------------------------------------------------------------------------------------------*/

        function xmlsitemapClass(        $sub_alias /*������������� �������� ����������� � ������*/        )
        {


                $this->AbstractClass(
                                       $sub_alias,         // ���� ����������� � ������
                                       'xmlsitemap',        // �������� ������� � ������� ����� ��������
                                       'xmlsitemap'           // �������� ������ (�� ��� ������ ���������� � ������� modules)
                					);


                $this->process();
        }


		/**
		 * �������� ������� ���������� ���������� ����� �����
		 */
		function process()
		{
                # ����������� ����� ���������� �������������� �����
                $file_rectime = 0;
                if (file_exists("./sitemap.xml"))
                {
	                $file_rectime = filectime("./sitemap.xml");
	                if (!$file_rectime) $file_rectime = 0;	                
                }
                

                # �������� �������: ���� ����� ��������� ������ ��� ������ ��� ����� ����� ������������, �� ����������               
                if ( (time() - $file_rectime) > ($this->std->settings["xmlsitemap_pause"] * 3600) )
                {
                		# ������ ���������� � ������� xmlsitemap � ������� ���������� ����������
						$sql = "select * from `se_xmlsitemap`";
		                $this->std->db->do_query($sql);
		                $xmlsitemap = $this->std->db->fetch_row();
                	
                		# ����� ����� �������
                		$xmlsitemap["lastmodified"] = time();

                		# ������������ ����� ����� ��� Google � ������
                		$this->createXMLSiteMap( unserialize( $xmlsitemap["menu_names"] ) );
                		

                		# ���������� ���� ���������� ���������� � ������� ������
                        $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");
                }
		}


		
		/**
		 * ������������ ����� �����
		 *
		 */
		private function createXMLSiteMap( $menu_names )
		{
			$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			
			
			# 1. ������ ����������� �������
			# �� ������ ��������� ��� ������ ����
         	foreach ( $this->std->menu_array["root"] as $menu )
         	{
					# ���� ���� ������ � ������, �� �� ���� ����� ������� XML �����
					if ( in_array($menu["alias"], $menu_names) )
					{
							# ��������
							$xml .= $this->getMenuMap( $menu["id"] );
					}
         	}
			
			
			# 2. ������ ������� ��������
			$xml .= $this->getCatalogMap();
			
			
			
			//----------------------------------------------------------
			// ���������� ����� ����� � �����
			//----------------------------------------------------------
			$xml .= '</urlset>';
            if (file_exists("./sitemap.xml")) @unlink("./sitemap.xml");
                
			$handle = fopen( "./sitemap.xml", "w" );
			fwrite( $handle, $xml );
			fclose( $handle );
			@chmod("./sitemap.xml", 0776);		}
		


        /**
         * ����� ������ � ������
         */
        function getMenuMap( $id )
        {
        		if ( isset($this->std->menu_array[$id]) )
        		{
		        		global $host;

						$childs = array();
		        		$xml = "";
		        		$i = 0;
						# ����� ���� ������ � XML
						foreach ( $this->std->menu_array[$id] as $item )
						{
		                 		$xml .= "<url>";
		                 		$xml .= "<loc>http://".$host.$item["alias"]."</loc>";
		                 		$xml .= "<lastmod>".date("Y-m-d", $item["timestamp"])."</lastmod>";
		                 		$xml .= "</url>";
		                 		$childs[$i] = $item["id"];
		                 		$i++;
						}

						# ����� ��������� ���� �����
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
				return $xml; // ���� ������� ������, �� �������
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