<?php
#
#  Библиотека модуля авторизации
#
#  Modified         :
#  Version          : 1.0
#  Author           : SAT
#  Programmer       : Alexey Perchenok
#  Copyright        : (c) «Web Otdel» Ltd
#


class auth_lib
{
        var $std;


        /*--------------------------------------------------------------------*/
        // Конструктор
        //
        // Входной параметр $class
        //                  тип:      OBJ
        //                  описание: ссылка на классс
        // Входной параметр $session_array
        //                  тип:      array
        //                  описание: массив для обновления и вставки в сессию
        /*--------------------------------------------------------------------*/

        function auth_lib( $class, &$session_array )
        {

                $this->std = &$class;

                // если информация о пользователе присуствует в куке то регистрируем пользователя в системе
                $mid  = $this->std->my_getcookie('member_id');
                $auth = $this->std->my_getcookie('auth');

                if( $mid === false )
                {
                        $mid = 0;
                }
                else
                {
                        $mid = intval($mid);
                }

                if( $pass === false)
                {
                        $pass = '';
                }

                $sql = "SELECT user_id,user_pass,user_email,user_name,user_access,user_cache,module_access,KodRec,ClientName
                               FROM `".TABLE_USER."`
                             WHERE user_is_active > 0 AND user_id='{$mid}'
                             LIMIT 0,1";

                $this->std->db->do_query($sql);

                if ($rows = $this->std->db->fetch_row())
                {
                        if( $auth == 'ok')
                        {
                                $session_array['session_member_id'] = $rows['user_id'];
                                $this->std->member = $rows;
                                $this->std->member['user_cache'] = unserialize($this->std->member['user_cache']);
                        		$temp = explode(",", $this->std->member['module_access']);
								$this->std->member['module_access'] = array();
								if (is_array($temp))
									foreach ($temp as $acc)
									{
										$this->std->member['module_access'][$acc] = '1';
									}                                
                        }
                }

        }
}

?>