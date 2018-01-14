<?php
#
# XMLSiteMap - �������
#

class mod_xmlsitemap{


        var $std;
        var $output = '';

        // ������ ����������� �������
        function process_module()
        {


                switch($this->std->input['action'])
                {
                        case 'xmlsitemap':
                              $this->sitemap_content( );
                              break;
                        case 'xmlsitemap_update':
                              $this->sitemap_update( );
                              break;
                }


        }


        // �������� ��� ������ ���� ������� ����� ���������� � ����� �����
        function sitemap_content()
        {

                /***************************************************************************
                        ������������ �������� ������� ����
                ****************************************************************************/
                $this->output        .= "<hr><center><h4>������ ����</h4>";

                $this->output        .= "<table border='1'>";
                $this->output        .= "<tr><td align=center>��������</td><td align=center>�������� � ������</td></tr>";


				# ������ ���������� � ������� xmlsitemap
				$sql = "select * from `se_xmlsitemap`";
                $this->std->db->do_query($sql);
                $xmlsitemap = $this->std->db->fetch_row();
                $xmlsitemap["menu_names"] = unserialize( $xmlsitemap["menu_names"] );	// ������ ����� ����


                $sql = "select * from `se_mitems` where item_dynamic=0 and  pid='-1' and is_active=1 order by item_order";
                $this->std->db->do_query($sql);

                while ($row = $this->std->db->fetch_row())
                {
                         $this->output .= "<tr style='background:#CCFFCC;'>";
                         $alias_arr[]        =  $row['alias'];

                         // ������� �� ��������� � ����� �����
                         $item_simple        = '';

                         if ( in_array( $row['alias'], $xmlsitemap["menu_names"] ) )
                         {
                                 $item_simple        = ' checked ';
                         }

                         $this->output        .= '<td align=center><input name="'.$row['id'].'_item_simple" type="checkbox" '.$item_simple.'  OnClick="document.location.href =\'/admin/?action=xmlsitemap_update&menuname='.$row['alias'].'\'"></td>';

                         /****�����: ����������� �������� ������ ����: ������� ����� ��� �������*****/

                         $this->output        .= '<td width=300>'.$row['title'].'</td>';

                         $this->output .= "</tr>";
                }

                $this->output         .= '</tr></table>';

                //------------------------------------------------------------



        }



		/**
		 * ����������/�������� ���� � xmlsitemap
		 */
        function sitemap_update()
        {

                if ( isset($this->std->input['menuname']) )
                {
                		# ������ ���������� � ������� xmlsitemap
						$sql = "select * from `se_xmlsitemap`";
		                $this->std->db->do_query($sql);
		                $xmlsitemap = $this->std->db->fetch_row();
		                $xmlsitemap["menu_names"] = unserialize( $xmlsitemap["menu_names"] );	// ������ ����� ����

		                if ( in_array($this->std->input['menuname'], $xmlsitemap["menu_names"] ) )
		                {                         		# ���� ������ � ������ xmlsitemap
                         		# ����� �������� � �� ������

                         		unset( $xmlsitemap["menu_names"][$this->std->input['menuname']] );
		                }
		                else
		                {                                # ���� �� ������ � ������ xmlsitemap
                         		# ����� ������ � � ������

                         		$xmlsitemap["menu_names"][$this->std->input['menuname']] = $this->std->input['menuname'];
		                }


						//------------------------------------------------------
						// ����� ������ ��������� ������ �����
						// ��������������� ������ ������ � sitemap.xml
						//------------------------------------------------------

						$this->updateXMLSiteMap( $xmlsitemap["menu_names"] );


                        # ���������� �������� ��������� ������ ����
                        $xmlsitemap["menu_names"] = serialize( $xmlsitemap["menu_names"] );
                		$xmlsitemap["lastmodified"] = time();  // ������� �����
		                $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");

		                # ������� �� ������, �� ������� �������� ������� ������
		                header('Location: /admin/?action=xmlsitemap');
		                exit();
                }

        }


		/**
		 * ���������� ������ ������ � sitemap.xml
		 */
        function updateXMLSiteMap( $menu_names )
        {
         		require_once( "xmlsitemap_init.php" );
				$module = new main_xmlsitemap();
				$module->std = $this->std;
				$module->createXMLSiteMap( $menu_names );
        }
}
?>
