<?php

/************************************************************************
        ������ common_menu �������� ����� ������� ��� ������������ �
        ������ ���� ��������� �����

        menu - ������������ � ����� ���� �����. ����� ������ �� ���������
                        ���� �������� ������������ �� ���������
                        ��. ���.: $alias_menu  - ����� ����, ��������� ��������
                                                ���������� ����. ������������ � ����������-
                                                ������� ����� CSM
**************************************************************************/

// ��� ���� ������ ���������� ���������������
$menu_work        = -1;   // ��������� �������, ������� ����������� � ������������ ����


function menu($alias_menu = '')// ������ � ��������
{
        global $_menu, $std;  // ������� ������� ����

        if ($alias_menu == '') return;	// ���� �� ������� ����, �� �������
        
        $return_array = $std->count_ids_by_menu( $alias_menu );

        if ($return_array['count'] > 0)
        {
                // ����� ����������� ��� ����� �������� ����, ������������� �� $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 0 , $_menu[$alias_menu] );
        }
}


/*********************************************************************************
        ����� ������� ������ ����
**********************************************************************************/
function menuAdjacent( $alias_menu = '' )
{
        global $std;

        $menu = $std->adjacentMenu( $alias_menu );

        return $menu;
}


/*********************************************************************************
        ����� ������� ������ ����
**********************************************************************************/
function menuChild( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu );      
}

/*********************************************************************************
        ����� ������� ������ ����(c ������)
**********************************************************************************/
function childMenu_with_childs( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu, 1 );
}

/*********************************************************************************
        ����� ������� ������ ����(��� �����)
**********************************************************************************/
function childMenu_without_childs( $alias_menu = '' )
{
        global $std;

        return $std->childMenu( $alias_menu, 2 );
}


/*********************************************************************************
        ���������� ���� � ����� ������� ��������� �������
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
                // ����� ����������� ��� ����� �������� ����, ������������� �� $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 1 , $_template );
        }

}


/*********************************************************************************
        ���������� ���� �� ����� ���������� ��������
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
                // ����� ����������� ��� ����� �������� ����, ������������� �� $flag_view
                return $std->menu_select( $return_array['manudata']['id'], 2 , $_template );
        }

}



/************************************************************************************************************
          �������� ������ ���� ������ ������
*************************************************************************************************************/
        // ������� ������� ��� ���������� ������� � ����� � ������� (������������ ���������)
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
                                        menu_recurs_del($row['id']);  // ��������� ������������ �����
                                }
                        }
                }

                // ������� ���� ������� ��� ������� ������ � ����������

                if ($delnode != 1)
                {
                        $sql = "delete from ".TABLE_MITEMS." where id=".$id;
                        $result = mysql_query($sql);
                }
        }

        function menu_item_del($id, $delnode = 0  /* �������, ������� ���� ������� ��� ������� ������ � ���������� */){

                menu_recurs_del($id, $delnode);
        }

?>