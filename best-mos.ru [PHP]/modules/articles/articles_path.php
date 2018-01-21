<?php
#
#  для работы с путем от статей
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer       : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#

class articles_path
{
        var $std;
        var $path;
        var $articles_title = 'Статьи';

        // метод для разбора урла статей и перевода его в путь
        function get_path( $page_alias = array(), $cur_url_array = array() )
        {
                global
                                $_path_item_unactive,
                                $_path_item_active,
                                $_path_delimiter,
                                $host;

                $nav_array = array();
                $tmp_array = $cur_url_array;
                foreach( $tmp_array as $id => $al )
                {
                        if( preg_match( "#/page\d+/#is",  $al ) )
                        {
                                unset($tmp_array[ $id ]);
                        }
                }

                $cur_url_array = array();

                foreach( $tmp_array as $page )
                {
                        $cur_url_array[] = $page;
                }

                // смотрим путь конкретной статьи
                if( count( $cur_url_array ) == 5 )
                {
                        foreach( $this->std->menu_by_id as $id => $data )
                        {
                                if( $data['alias'] == '/articles/' )
                                {
                                        $articles_title = $data['title'];
                                        break;
                                }
                        }
                        $find        = array('{TITLE}'     , '{ALIAS}');
                        $replace     = array($articles_title ? $articles_title : $this->articles_title, "http://".$host."/articles/");
                        $nav_array[] = str_replace($find, $replace, $_path_item_active);  // пункт

                        foreach( $cur_url_array as $id => $al )
                        {
                                $cur_url_array[ $id ] = str_replace("/", "", $al);
                        }

                        // привязка в дате публикации
                        $condition = "AND date_format(from_unixtime(n.timestamp),'%Y')='".intval($cur_url_array[1])."' ";

                        $cur_url_array[2] = intval($cur_url_array[2]);
                        if( strlen( $cur_url_array[2] ) < 2 )
                        {
                                $cur_url_array[2] = "0".$cur_url_array[2];
                        }

                        $condition .= "AND date_format(from_unixtime(n.timestamp),'%m')='".$cur_url_array[2]."' ";


                        $cur_url_array[3] = intval($cur_url_array[3]);
                        if( strlen( $cur_url_array[3] ) < 2 )
                        {
                                $cur_url_array[3] = "0".$cur_url_array[3];
                        }
                        $condition .= "AND date_format(from_unixtime(n.timestamp),'%d')='".$cur_url_array[3]."' ";


                        $sql = "SELECT n.*
                                         FROM se_articles n
                                         WHERE n.alias='".$cur_url_array[4]."' $condition AND n.is_active=1";
                        $this->std->db->do_query($sql);

                        $articles = $this->std->db->fetch_row();

                        $find        = array('{TITLE}');
                        $replace     = array($cur_url_array[1]);
                        $nav_array[] = str_replace($find, $replace, $_path_item_unactive);  // пункт

                        $replace     = array($cur_url_array[2]);
                        $nav_array[] = str_replace($find, $replace, $_path_item_unactive);  // пункт

                        $replace     = array($cur_url_array[3]);
                        $nav_array[] = str_replace($find, $replace, $_path_item_unactive);  // пункт

                        if( $this->std->settings['path_print_cur_page'] )
                        {
                                $find        = array('{TITLE}');
                                $replace     = array($articles['title']);
                                $nav_array[] = str_replace($find, $replace, $_path_item_unactive);  // пункт
                        }
                }
                elseif( $this->std->settings['path_print_cur_page'] )
                {
                        foreach( $this->std->menu_by_id as $id => $data )
                        {
                                if( $data['alias'] == '/articles/' )
                                {
                                        $articles_title = $data['title'];
                                        break;
                                }
                        }

                        $find        = array('{TITLE}');
                        $replace     = array($articles_title ? $articles_title : $this->articles_title, "http://".$host."/articles/");
                        $nav_array[] = str_replace($find, $replace, $_path_item_unactive);  // пункт
                }

                $find      = array('{TITLE}', '{ALIAS}');
                $replace   = array("Главная", "http://".$host);
                $tmp_nav   = str_replace($find, $replace, $_path_item_active);  // пункт

                if( !count($nav_array) or !is_array($nav_array))
                {
                        $nav_array = array();
                }

                array_unshift($nav_array, $tmp_nav);

                if( !$this->std->settings['path_print_cur_page'] )
                {
                        $delimeter_end = $_path_delimiter;
                }
                else
                {
                        $delimeter_end = "";
                }

                return implode( $_path_delimiter, $nav_array).$delimeter_end;
        }

}

?>
