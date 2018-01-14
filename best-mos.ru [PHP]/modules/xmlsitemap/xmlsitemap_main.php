<?php
#
# XMLSiteMap - ���������������� �����
#


class main_xmlsitemap extends AbstractClass {



        
        # ������� ������� ���������� �� ��������� ������(����������� ��� �� ��������)
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
                # ������ ���������� � ������� xmlsitemap � ������� ���������� ����������
				$sql = "select * from `se_xmlsitemap`";
                $this->std->db->do_query($sql);
                $xmlsitemap = $this->std->db->fetch_row();

                # �������� �������
                if ( (time() - $xmlsitemap["lastmodified"]) > ($this->std->settings["xmlsitemap_pause"] * 3600) )
                {
                		# ����� ����� �������
                		$xmlsitemap["lastmodified"] = time();

                		# ������������ ����� ����� ��� Google
                		$this->createXMLSiteMap( unserialize( $xmlsitemap["menu_names"] ) );

                		# ���������� ���� ���������� ���������� � ������� ������
                        $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");
                }
		}



		/**
		 * ������������ sitemap.xml
		 *
		 * @$menu_names - ������ ����, �� ������� ����� ������� ����� �����
		 */
		function createXMLSiteMap( $menu_names )
		{
				$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

              // print_r($this->std->menu_array);
				# �� ������ ��������� ��� ������ ����
         		foreach ( $this->std->menu_array["root"] as $menu )
         		{
						# ���� ���� ������ � ������, �� �� ���� ����� ������� XML �����
						if ( in_array($menu["alias"], $menu_names) )
						{
								# ��������
								$xml .= $this->getWidth( $menu["id"] );
						}
         		}

                $xml .= '</urlset>';


				//----------------------------------------------------------
				// ���������� ����� ����� � �����
				//----------------------------------------------------------

				$handle = fopen( "./sitemap.xml", "w" );
				fwrite( $handle, $xml );
				fclose( $handle );

		}

        /**
         * ����� ������ � ������
         */
        function getWidth( $id )
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
								$temp = $item["alias"];
								if ($temp == "/index/") $temp = "/";
		                 		$xml .= "<url>";
		                 		$xml .= "<loc>http://".$host.$temp."</loc>";
		                 		$xml .= "<lastmod>".date("Y-m-d", $item["timestamp"])."</lastmod>";
		                 		$xml .= "</url>";
		                 		$childs[$i] = $item["id"];
		                 		$i++;
						}

						# ����� ��������� ���� �����
						for ( $i = 0; $i < count($childs); $i++ )
						{
								$xml .= $this->getWidth( $childs[$i] );
						}

						return $xml;
				}
        }

}
?>