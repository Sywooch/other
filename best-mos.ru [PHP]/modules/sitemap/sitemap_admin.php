<?php
#
# ��� ������� ����� ������� �� �����
# ������������ ������ ��� ������������ ������ � ����
#

class mod_sitemap{


        var $std;
        var $output = '';

        // ������ ����������� �������
        function process_module()
        {

                switch($this->std->input['action'])
                {
                        case 'sitemap':
                              $this->sitemap_content( );
                              break;
                        case 'sitemap_update':
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
                $this->output        .= "<tr><td align=center>��������</td><td align=center>�������� � ������</td><td align=left>�����</td></tr>";

                $sql         = "select * from ".TABLE_MITEMS." where item_dynamic=0 and  pid='-1' and is_active=1 order by item_order";
                $this->std->db->do_query($sql);

                while ($row = $this->std->db->fetch_row())
                {
                         $this->output .= "<tr style='background:#CCFFCC;'>";
                         $alias_arr[]        =  $row['alias'];

                         // ������� �� ��������� � ����� �����
                         $item_simple        = '';

                         if ($row['inc_in_sitemap'] == 1)
                         {
                                 $item_simple        = ' checked ';
                         }

                         $this->output        .= '<td align=center><input name="'.$row['id'].'_item_simple" type="checkbox" '.$item_simple.'  OnClick="document.location.href =\'/admin/?action=sitemap_update&itemid='.$row['id'].'\'"></td>';

                         /****�����: ����������� �������� ������ ����: ������� ����� ��� �������*****/

                         $this->output        .= '<td width=300>'.$row['title'].'</td><td width=300>'.$row['alias'].'</td>';

                         $this->output .= "</tr>";
                }

                $this->output         .= '</tr></table>';

                //------------------------------------------------------------

                $this->output        .= "<hr><center><h4>��������� �������� ����� �����</h4>";

                if( $this->std->input['request_method'] != 'post' )
                {

                        $this->std->db->do_query( "SELECT * FROM se_static WHERE alias='sitemap' AND pid='-1' ORDER BY id DESC LIMIT 0, 1" );
                        $row = $this->std->db->fetch_row();

                        $title       = $row['title'];
                        $menu        = $row['menu'];
                        $description = $row['description'];
                        $keywords    = $row['keywords'];
                        //$depth_count = $row['depth_count'];
                        $h1          = $row['h1'];
                        $body        = $row['body'];
                        // checkbox - ����������
                        if (!$row['is_active'])
                        {
                                $active   = '';
                        }
                        else
                        {
                                $active  = 'checked';
                        }
                }
                else
                {
                        extract( $this->std->input );
                        $title = trim( $title );

                        if( $title )
                        {
                                $this->std->db->do_update( 'static', array(  'title'       => $title,
                                                                             'menu'        => $menu ? $menu : $title,
                                                                             'description' => $description,
                                                                             'keywords'    => $keywords,
                                                                             'h1'          => $h1 ? $h1 : $title,
                                                                             'is_active'   => @$active ? 1 : 0,
                                                                             'body'        => $_POST['body'],
                                                                             ), "alias='sitemap' AND pid = '-1'" );
                                // ��������� ������ � ������ ����
                                // ����� ���� ���������
                                $this->std->db->do_query( "SELECT id FROM se_mitems WHERE pid=-1" );
                                $father_ids = array();
                                while( $father = $this->std->db->fetch_row() )
                                {
                                        $father_ids[] = $father['id'];
                                }

                                if( count($father_ids) < 1 )
                                {
                                        $father_ids[] = 0;
                                }


                                $this->std->db->do_query( "SELECT id FROM se_mitems WHERE alias='/sitemap/' AND pid IN(".implode(',', $father_ids).")" );
                                if( $this->std->db->getNumRows() )
                                {
                                        while($menu_array = $this->std->db->fetch_row())
                                        {
                                                $r[] = $menu_array;
                                        }

                                        foreach( $r as $smap_id => $smap_data )
                                        {
                                                if( isset($active ))
                                                {
                                                        $this->std->db->do_update( 'mitems', array( 'title'     => trim($menu) ? $menu : $title,
                                                                                                    'is_active' => 1,
                                                                                             ), 'id='.$smap_data['id'] );

                                                }
                                                else
                                                {
                                                        $this->std->db->do_update('mitems', array( 'is_active' => 0,),'id='.$smap_data['id'] );
                                                }
                                        }
                                }
                                
                                
                                /*----------------------------------------------------------*/
		                        // � ������� ����� �������� ���� ��������, ��� � �� ���������.
		                        // �����/�������
		                        /*----------------------------------------------------------*/		                        
		                        {
                        				$this->std->db->do_update( 'modules', 
                        									array( 'is_active' => @$active ? 1 : 0), 
                        									"modulename='sitemap'" );
		                        }

                                // ������� �� ������, �� ������� �������� ������� ������
                                header('Location: /admin/?action=sitemap');
                                exit();
                        }
                        else
                        {
                                // checkbox - ����������
                                if (empty($active))
                                {
                                        $active           = '';
                                }
                                else
                                {
                                        $active           = 'checked';
                                }

                                $this->output .= "<br><center><font color=red><li>��������� ���������� � ����������</li></font></center><br>";
                        }

                }


                $this->output .= '<center><form method=post enctype=multipart/form-data>
                        <table border=0 width=90%>
                        <tr>
                        <td align=right>������������ �������� ������ ����� �����:</td>
                        <td>
                        <input type=checkbox name=active '.$active.'>
                        </td>
                        </tr>
                        <tr>
                        <tr>
                        <td align=right><font color=red>*</font> �������� (title):
                        </td>
                        <td width=75%>
                        <input type=text name=title value="'.$title.'">
                        </td>
                        </tr>

                        <tr>
                        <td align=right><font color=red></font> �������� � ����:
                        </td>
                        <td width=75%>
                        <input type=text name=menu value="'.$menu.'">
                        </td>
                        </tr>

                        <tr>
                        <td align=right>��������� (h1):
                        </td>
                        <td width=75%>
                        <input type=text name=h1 value="'.$h1.'">
                        </td>
                        </tr>

                       <script type="text/javascript" src="/'.ADMIN_FOLDER.'/editor/fckeditor.js"></script>

                        <script type="text/javascript">
                          window.onload = function() {
                            var oFCKeditor = new FCKeditor( \'body\', \'100%\', \'100%\' ) ;
                            oFCKeditor.BasePath = "/'.ADMIN_FOLDER.'/editor/" ;
                            oFCKeditor.ReplaceTextarea() ;
                          }
                        </script>


                        <tr>
                        <td align=right valign=top>
                        </font> ���������� ��������<br>(HTML-���)</td>
                        <td width=80% height=600>
                        <textarea name=body rows=37 cols=80>'.$body.'</textarea>
                        </td>
                        </tr>



                        <tr>
                            <td align=right>��������:</td>
                            <td><input type=text name=description value="'.$description.'" style="width:60%;" class=f3 maxlength=255></td>
                        </tr>

                        <tr>
                            <td align=right>�������� �����:</td>
                            <td><input type=text name=keywords value="'.$keywords.'" style="width:60%;" class=f3 maxlength=255> <nobr></nobr></td>
                        </tr>

                        <td>
                        </td>
                        <td>
                        <input type=submit value="���������" class=f2>
                        </td>
                        </tr>
                        </table>
                        </form></center>';

        }

        function sitemap_update()
        {

                $this->std->input['itemid'] = intval($this->std->input['itemid']);

                $this->std->db->do_query("select inc_in_sitemap from ".TABLE_MITEMS." where id=".$this->std->input['itemid']);

                $row = $this->std->db->fetch_row();

                $this->std->db->do_update( 'mitems', array( 'inc_in_sitemap' => $row['inc_in_sitemap'] ? 0 : 1 ), "id=".$this->std->input['itemid']  );

                // ������� �� ������, �� ������� �������� ������� ������
                header('Location: /admin/?action=sitemap');
                exit();
        }

        // ������������ ����, ����������� ������ ������
        // ��� ����������� ����, ���������� ������ ������ �� ��������. ��� �������� ��������� ������� ���������� ������.
        // ������ ������� ���������� �� "admin_menu.php" �� ������� "menu_content"
        function sitemap_menu($alias_arr)
        {

                $cheched = '';
                if (in_array("/sitemap/",$alias_arr))
                {
                        $cheched = 'checked';
                }
                $form = @$nbsp."<table><tr><td width='0'></td><td align=left>
                                                                                        - <input type='checkbox' name='-1_checkbox' $cheched>&nbsp;������ ������ ����� �����
                                                                                          <input type='hidden' name='-1_url' value='/sitemap/'>
                                                                                          <input type='hidden' name='-1_name' value='����� �����'>
                                                                                </td></tr></table>";

                $form = "<input type='hidden' name='module_list_id' value='-1'>
                                         <input type='hidden' name='module_tablename' value='-1'>
                                         <table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='�������� ����'>";
                return $form;
        }
}

?>
