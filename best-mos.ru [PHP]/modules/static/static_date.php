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
        global $std, $static;

        if( !$format ) return '';

        if( $static->timeinsert )
        {
                return $std->get_time($static->timeinsert, $format );
        }
        else
        {
                return '';
        }
}

?>