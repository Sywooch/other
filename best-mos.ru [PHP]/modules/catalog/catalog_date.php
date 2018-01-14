<?php
#
#        Инициализация класса NewsClass
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#



function DOCUMENTDATE( $format = "" )
{
        global $std, $timestamp;

        if( !$format ) return '';

        if( $timestamp )
        {
                return $std->get_time($timestamp, $format );
        }
        else
        {
                return '';
        }
}

?>