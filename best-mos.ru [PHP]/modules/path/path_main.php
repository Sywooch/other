<?php
#
#        ������ - ����� ����
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) ����������� �����������
#



class main_path extends AbstractClass {

        var $std;
        var $modules                        = array();
        var $used_template                = '';


        function PathClass(        $sub_alias /*������������� �������� ����������� � ������*/        ){


                $this->AbstractClass(
                                                                $sub_alias,                // ���� ����������� � ������
                                                                   'se_mitems',        // �������� ������� � ������� ����� ��������
                                                                   'path'                        // �������� ������ (�� ��� ������ ���������� � ������� modules)
                                                        );
                global $path;
                $path = $this->getSitePath();
        }


        /**
         * ������������ ������ ���� (������� ������)
         *
         * @return unknown - ���������� ������ - ����
         */
		
        function getSitePath(){
                global
                                $_path_item_unactive,
                                $_path_item_active,
                                $_path_delimiter,
                                $_path_main,
                                $host,
                                $modules_list;

                $path = "";
 //print_r($this->std->settings['print_index']);
                if( count( $this->current_url_array ) < 1 or !is_array($this->current_url_array))
                {
                        $this->current_url_array = array();
                        $tmp_url_array = explode( "/", $this->current_url);

                        foreach( $tmp_url_array as $path_uri )
                        {
                                if( $path_uri )
                                {
                                        $path_uri = "/{$path_uri}/";
                                        $this->current_url_array[] = $path_uri;
                                }
                        }
                }

                // ��������� URL �� ��������� ������� ���� ������ � �������
                $page_alias = array();
                foreach( $this->current_url_array as $id => $alias )
                {
                        $alias = str_replace("/", "", $alias);
                        $tmp_alias_ = '';

                        foreach( $page_alias as $id => $_dat )
                        {
                                $tmp_alias_ = $_dat;
                        }


                        $page_alias[] = ($tmp_alias_ != '') ? $tmp_alias_.$alias."/" : "/".$alias."/";
                }

                // �������������� ���������� � ����
                if( isset($this->current_url_array[0] ))
                {
                        $module_name = str_replace("/", "", $this->current_url_array[0]);

                        if( in_array( $module_name, $modules_list ) )
                        {
                               if( file_exists( MODULES_PATH."/{$module_name}/{$module_name}_path.php" ) )
                               {
                                       // ���� ����� � ��� ���� ��� �������� ������������� ���� �� ������������ ���
                                       require_once(MODULES_PATH."/{$module_name}/{$module_name}_path.php");

                                       $module_init_str_class = $module_name."_path";

                                       if( class_exists( $module_init_str_class ) )
                                       {
                                               $module_init      = new $module_init_str_class( );
                                               $module_init->std = &$this->std;
                                               return $module_init->get_path( $page_alias, $this->current_url_array );
                                       }
                               }
                        }
                }

                // ���������� ����� ��� ����� ����
                foreach( $page_alias as $_id => $_data )
                {
                        foreach( $this->std->menu_by_id as $id => $data )
                        {
                                if( $this->std->menu_by_id[$id]['alias'] == $_data )
                                {
                                        if( $this->current_url == $_data )
                                        {
                                                $nav_array[] = str_replace('{TITLE}', $this->std->menu_by_id[$id]['title'], $_path_item_unactive);
                                        }
                                        else
                                        {
                                                $find           = array('{TITLE}', '{ALIAS}');
                                                $replace        = array($this->std->menu_by_id[$id]['title'], "http://".$host.$this->std->menu_by_id[$id]['alias']);
                                                $nav_array[]    = str_replace($find, $replace, $_path_item_active);  // �����
                                        }
                                        break;
                                }
                        }
                }


                $find      = array('{TITLE}', '{ALIAS}');
				if ($this->std->settings['print_index']) $replace   = array("�������", "http://".$host);
				else $replace="";
                $tmp_nav   = str_replace($find, $replace, $_path_item_active);  // �����

                if(	isset($nav_array) )
                {
                        if( !$this->std->settings['path_print_cur_page'] )
                        {
                                $nav_array = array_reverse($nav_array);
                                unset($nav_array[0]);
                                $nav_array = array_reverse($nav_array);
                                $delimeter_end = $_path_delimiter;
                        }
                        else
                        {
                                $delimeter_end = "";
                        }
                        array_unshift($nav_array, $tmp_nav);

                        return implode( $_path_delimiter, $nav_array).$delimeter_end;
                }
                else
                {
                        $find      = array('{TITLE}');
                        $replace   = array("�������");
						if ($this->std->settings['print_index']) $replace   = array("�������");
						else $replace=array("");
                        $tmp_nav   = str_replace($find, $replace, $_path_item_unactive);  // �����
                        return $tmp_nav;
                }
        }

}
?>