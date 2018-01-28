<?php

/************************************************************************
        модуль common_menu содержит набор функций дл€ формировани€ и
        вывода меню различных видов

        menu - формирование и вывод меню сайта.  акое именно из имеющихс€
                        меню выводить определ€етс€ из параменра
                        вх. пар.: $alias_menu  - алиас меню, латинское название
                                                выводимого меню. ќпредел€етс€ в администра-
                                                торской части CSM
**************************************************************************/

// все меню должны выводитьс€ последовательно
$menu_work        = -1;   // последн€€ вершина, котора€ участвовала в формировании меню


function menu($alias_menu = '')// готово и работает
{
        global $_menu, $std;  // шаблоны пунктов меню

        if ($alias_menu == '') return;	// если не указано меню, то возврат
        
        $return_array = $std->count_ids_by_menu( $alias_menu );

        if ($return_array['count'] > 0)
        {
                // сразу определимс€ как будем выводить меню, ориентируемс€ на $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 0 , $_menu[$alias_menu] );
        }
}


/*********************************************************************************
        вывод смежных вершин меню
**********************************************************************************/
function menuAdjacent( $alias_menu = '' )
{
        global $std;

        $menu = $std->adjacentMenu( $alias_menu );

        return $menu;
}


/*********************************************************************************
        вывод смежных вершин меню
**********************************************************************************/
function menuChild( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu );      
}

/*********************************************************************************
        вывод смежных вершин меню(c детьми)
**********************************************************************************/
function childMenu_with_childs( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu, 1 );
}

/*********************************************************************************
        вывод смежных вершин меню(без детей)
**********************************************************************************/
function childMenu_without_childs( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu, 2 );
}


/*********************************************************************************
        древовидно меню с одним текущим раскрытым пунктом
**********************************************************************************/
function menuTree( $alias_menu = '' )
{
        global $_menutree, $std;

        $alias_menu = (!$alias_menu) ? 'static' : $alias_menu;
        if( count( $_menutree[ $alias_menu ] ) )
        {
                $_template = $_menutree[ $alias_menu ];
        }
        else
        {
                if( count($_menutree['static']) )
                {
                        $_template = $_menutree['static'];
                }
                else
                {
                        $_template = $_menutree;
                }
        }

        $return_array = $std->count_ids_by_menu( $alias_menu );

        if ($return_array['count'] > 0)
        {
                // сразу определимс€ как будем выводить меню, ориентируемс€ на $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 1 , $_template );
        }

}


/*********************************************************************************
        древовидно меню со всеми раскрытыми пунктами
**********************************************************************************/
function menuExpanded($alias_menu = '')
{
        global $_menuexpanded, $std;

        $alias_menu = (!$alias_menu) ? 'static' : $alias_menu;
        if( count( $_menuexpanded[ $alias_menu ] ) )
        {
                $_template = $_menuexpanded[ $alias_menu ];
        }
        else
        {
                if( count($_menuexpanded['static']) )
                {
                        $_template = $_menuexpanded['static'];
                }
                else
                {
                        $_template = $_menuexpanded;
                }
        }

        $return_array = $std->count_ids_by_menu( $alias_menu );

        if ($return_array['count'] > 0)
        {
                // сразу определимс€ как будем выводить меню, ориентируемс€ на $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 2 , $_template );
        }

}



/************************************************************************************************************
          удаление пункта меню любого уровн€
*************************************************************************************************************/
        // функци€ удал€ет все подчинЄнные подменю и далее в глубину (используетс€ реккурси€)
        function menu_recurs_del($id, $delnode = 0)
        {
                $sql        = "select id from ".TABLE_MITEMS." where pid=".$id;
                $result        = mysql_query($sql);
                if ($result)
                {
                        if (mysql_num_rows($result) > 0)
                        {
                                while($row = mysql_fetch_array($result))
                                {
                                        menu_recurs_del($row['id']);  // очередной реккурсивный вызов
                                }
                        }
                }

                // удал€ть саму вершину или удалить только еЄ подчинЄнных

                if ($delnode != 1)
                {
                        $sql = "delete from ".TABLE_MITEMS." where id=".$id;
                        $result = mysql_query($sql);
                }
        }

        function menu_item_del($id, $delnode = 0  /* признак, удал€ть саму вершину или удалить только еЄ подчинЄнных */){

                menu_recurs_del($id, $delnode);
        }

?>