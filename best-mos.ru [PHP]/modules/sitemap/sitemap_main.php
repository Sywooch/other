<?php
#
#        ������ - ���������� ������ �����
#        �����: /sitemap/
#
#  Modified         :
#  Version          : 1.0
#



class main_sitemap extends AbstractClass {


        # global lib
        var $std;

        # global
        var $modules                      = array();
        var $used_template                = '';

        # vars in this module
        var $depth_count                  = 1;
        var $depth_id                     = 0;
        var $last_level                   = 0;

        /*---------------------------------------------------------------------------------------------------*/
        // ������� ������� ���������� �� ��������� ������(����������� ��� �� ��������)
        /*---------------------------------------------------------------------------------------------------*/

        function SITEMAPClass(        $sub_alias /*������������� �������� ����������� � ������*/        )
        {


                $this->AbstractClass(
                                                                $sub_alias,         // ���� ����������� � ������
                                                                'se_static',        // �������� ������� � ������� ����� ��������
                                                                'sitemap'           // �������� ������ (�� ��� ������ ���������� � ������� modules)
                                                        );

                // ��������, ����� �� ��������� ������������� ����������
                // ��������� ��������� �� ������ ������ ������


                global
                        $template,               // ��� �������������
                        $title,                  // ���������
                        $h1,                     // ������� �������
                        $body,                   // ���� �������
                        $sitemap,                // ����� �����
                        $_sitemap_depth_guide,   // ������� �����������
                        $count_pages         ,   // ���-�� ���������� �������
                        $description,            // �������� ��������
                        $keywords;               // �������� �����

                $this->depth_guide = $_sitemap_depth_guide;

                if (isset($this->current_url_array[0]) && $this->current_url_array[0] == $this->module_name) // ���� ���������� ����� �����
                {
                        if (count($this->current_url_array) == 1)
                        {

                                //������������ ������ ���������� �� �� ��� ������������ ������ ��������
                                $this->std->db->do_query( "SELECT * FROM se_static WHERE alias='sitemap' AND `pid`='-1'");

                                if ($this->std->db->getNumRows())// ���� � ��������� ����������� ������� ������ ������ "����� �����", �� ������� �� ��� � ���� ������� ��������
                                {
                                        $rows = $this->std->db->fetch_row();
                                        $title               = $rows['title'];
                                        $h1                  = $rows['h1'];
                                        $body                = $rows['body'];
                                        $this->depth_id      = $this->std->settings['sitemap_depth_count'];
                                        // ������� keywords � ���� ������� ����������
                                        $keywords    = $this->std->build_meta_tags( $rows['keywords'], 'keywords' );
                                        $description = $this->std->build_meta_tags( $rows['description'], 'description');

                                        // ���������, �� ����� �� �����-�� ��������� ������
                                        //$template         = 'sitemap';
                                        $template         = 'static';

                                        $body = $this->getSiteMap();
                                        $count_pages    = ($this->depth_count - 1);

                                }
                                else
                                {
                                        $template        = 'error';
                                }
                        }
                        else
                        {
                                $template        = 'error';
                                $this->ModulError("Error {SiteMapClass:init} ��������� �� ��������� ������.");
                        }
                }

        }

        /*---------------------------------------------------------------------------------------------------*/
        // ������� ������ ����� �����
        /*---------------------------------------------------------------------------------------------------*/

        function getSiteMap( )
        {
                $tree         = '';

                // �������� �� ������� ���� ������� ���� ���������
                $render_tree = array();
                $tree        = '';
                                if(count($this->std->menu_array)!=0)
                {
                     foreach( $this->std->menu_array['root'] as $_mid => $data )
                     {
                             if( $data['inc_in_sitemap'] )
                             {
                                     $render_tree[ $_mid ] = $_mid;
                             }
                     }
                }

                // �������� ���� ���� ����� ������ �� ������
                foreach( $render_tree as $_mid => $_ids )
                {
                        $tree .= $this->render_recur( $_ids  );
                }

                return $tree;
        }

        /*---------------------------------------------------------------------------------------------------*/
        // P���������� ������� ��������� ����� �����
        /*---------------------------------------------------------------------------------------------------*/

        function render_recur( $root_id, $jump_string = '', $depth_guide="", $depth_id = 0)
        {
                global $_sitemap, $_sitemap_bullet, $_sitemap_space;

                $init_begin_sitemap_html = 0;
                // ���� ���������� ���� �� ��������� ��� � ���� ��� �� ���������� ���������
                $template_num = $depth_id+1;



                if( isset($_sitemap['tree'][$template_num]) and $template_num > 0 and is_array($_sitemap['tree']))
                {
                        $begin    = $_sitemap['begin'][$template_num];
                        $template = $_sitemap['tree'][$template_num];
                        $end      = $_sitemap['end'][$template_num];
                        $this->last_level = $template_num;
                }
                elseif( $this->last_level )
                {
                        $begin    = $_sitemap['begin'][ $this->last_level ];
                        $template = $_sitemap['tree'][ $this->last_level ];
                        $end      = $_sitemap['end'][ $this->last_level ];
                }
                else
                {
                        $begin    = $_sitemap['begin'];
                        $template = $_sitemap['tree'];
                        $end      = $_sitemap['end'];
                }

                if( @is_array( $this->std->menu_array[ $root_id ] ) )
                {
                        // ����������� �� ����� ���������
                        foreach( $this->std->menu_array[ $root_id ] as $menu_data )
                        {
                                // ���������� �� ��������� ���� ������� �������� �����������
                                if( ($depth_id+1) > $this->depth_id and $this->depth_id > 0)
                                {
                                        continue;
                                }

                                // ���������� �� ��������� ���� ������ �������� �������������(������������)
                                if( strstr( $menu_data['alias'], 'sitemap' ) )
                                {
                                        if( $this->std->menu_by_id[ $menu_data['pid'] ]['pid'] == 'root' )
                                        {
                                                continue;
                                        }
                                }
                                elseif( strstr( $menu_data['alias'], 'end' ) )
                                {
                                        continue;
                                }
                                elseif( strstr( $menu_data['alias'], 'delimiter' ) )
                                {
                                        continue;
                                }
                                elseif( strstr( $menu_data['alias'], 'begin' ) )
                                {
                                        continue;
                                }

                                // ������������ ���������� �������� �������
                                $this->depth_count++;

                                // ��� ������� �������� ������������ �����
                                if( $menu_data['alias'] == '/index/' )
                                {
                                        $menu_data['alias'] = '/';
                                }
                                elseif( $menu_data['alias'] == 'index' )
                                {
                                        $menu_data['alias'] = '/';
                                }

                                // �������� ������ ������ ���� ��� ��� �����
                                if( !$init_begin_sitemap_html )
                                {
                                        $jump_string .= $begin;
                                        $init_begin_sitemap_html = 1;
                                }

                                // �������� ������
                                $jump_string  .= str_replace( array( '{PREFIX}', '{ALIAS}', "{TITLE}" ), array($depth_guide.$_sitemap_bullet, $menu_data['alias'], $menu_data['title']), $template);

                                $jump_string = $this->render_recur( $menu_data['id'], $jump_string, $depth_guide . $this->depth_guide, ($depth_id+1) );
                        }

                        // ��������� �����
                        $jump_string .= $end;
                }

                // ���������� ��������� ��� ������������� ����� ���������
                return $jump_string;
        }
}
?>