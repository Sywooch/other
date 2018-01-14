<?php
#
#        Инициализация класса ArticlesClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#


function DOCUMENTDATE( $format = "" )
{
        global $std;

        if( !$format ) return '';

        $patch_array = explode("/", $_SERVER['REQUEST_URI']);

        foreach($patch_array as $id => $data)
        {
                if($data)
                {
                        $current_url_array[] = $data;
                }
        }

        // привязка в дате публикации
        $condition = '';
        if (!preg_match("/page[0-9]/",$current_url_array[1]))
        {
                $condition .= "AND date_format(from_unixtime(timestamp),'%Y')='".$current_url_array[1]."' ";
        }
        if (!preg_match("/page[0-9]/",$current_url_array[2]))
        {
                $condition .= "AND date_format(from_unixtime(timestamp),'%m')='".$current_url_array[2]."' ";
        }
        if (!preg_match("/page[0-9]/",$current_url_array[3]))
        {
                $condition .= "AND date_format(from_unixtime(timestamp),'%d')='".$current_url_array[3]."' ";
        }

        if( $condition )
        {
                // получаем определённую статья из базы
                $sql = "SELECT * FROM se_articles WHERE alias='".$current_url_array[4]."' $condition AND is_active=1";

                $std->db->do_query($sql);
                $row = $std->db->fetch_row();

                return $std->get_time($row['timestamp'], $format );
        }
        else
        {
                return '';
        }
}

?>