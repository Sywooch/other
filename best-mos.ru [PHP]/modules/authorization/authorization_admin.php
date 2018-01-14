<?php
#
# для данного сайта админка не нужна
# присутствует только бло формирования пункта в меню
#

class mod_authorization{


        var $std;
        var $output = '';
        var $members_on_page = 20;


        // первая исполняемая функция
        function process_module()
        {
        		
        	
				// выводим навигацию по модулю
                $this->output        = '<br><center><b>Поиск пользователей</b></center><br>';
        	
        	
                switch($this->std->input['do'])
                {
                		case 'userinfo':
                              $this->userinfo();
                              break;
                        case 'authorization':
                              
                              break;
                        case 'ban':
                              $this->members_ban( );
                              break;
                              
                        case 'download_new': $this->download_new( ); break;
                        case 'download_update': $this->download_update( ); break;
                        case 'download_all': $this->download_all( ); break;
                              
                              
                              
                              
                        case 'authorization_auto':
                              $this->members_autorisation( );
                              break;
                        case 'authorization_add':
                              $this->form_members( 'add' );
                              break;
                        case 'authorization_edit':
                              $this->form_members( 'edit' );
                              break;
                        case 'rights_edit':
                              $this->form_rights();
                              break;
                        case 'rights_do_edit':
                              $this->do_rights();
                              break;
                        case 'authorization_do_add':
                              $this->do_members( 'add' );
                              break;
                        case 'authorization_do_edit':
                              $this->do_members( 'edit' );
                              break;
                        case 'authorization_editaccess':
                        	  $this->edit_access( );
                        	  break;
                        case 'authorization_del':
                              $this->do_del( );
                              break;
                              
                        default: $this->list_members( );
                }


        }

        
        
        /**
         * Выгрузка новых пользователей
         *
         */
        function download_new()
        {        	
        	$sql = "SELECT se_users.*, se_subscribe.user_mail FROM se_users
        			LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email 
        			WHERE se_users.user_is_active = 1 AND se_users.user_access = 2 
        			ORDER BY se_users.user_name";
        	
        	$this->createXMLList($sql, 'new');
        }
        
        /**
         * Выгрузка пользователей, изменивщих профиль
         *
         */
		function download_update()
        {
        	$sql = "SELECT se_users.*, se_subscribe.user_mail FROM se_users
        			LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email 
        			WHERE se_users.user_is_active = 2 AND se_users.user_access = 2 
        			ORDER BY se_users.user_name";
        	
        	$this->createXMLList($sql, 'update');        	
        }
        
        /**
         * Выгрузка всех пользователей
         *
         */
		function download_all()
        {        	
        	$sql = "SELECT se_users.*, se_subscribe.user_mail FROM se_users
        			LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email 
        			WHERE se_users.user_access = 2
        			ORDER BY se_users.user_name";
        	
        	
        	
        	$this->createXMLList($sql, 'all');
        }
        
        /**
         * Фомрирование XML-файла и выгрузка
         *
         * @param unknown_type $sql
         */
		function createXMLList($sql, $type)
        {
        		require(TEMPLATES_PATH.'/authorization_t_config.php');        // файл шаблонов
        	
        		//global $_auth_xml;
        		$res = '';
        			 
        		$user_ids = array();
        		
        		
	        	if ($this->std->db->query($sql, $rows) > 0)
	        	{
		        		foreach ($rows as $row)
		        		{		
								$user_ids[] = $row['user_id'];
		        			
		        			
		        				$item = $_auth_xml['item'];
		        				
		        				# заменяем основные данные
		        				foreach ($row as $key => $value)
        						{
        							if ($key == 'user_rectime')
        							{
        								$value = $this->std->get_time($value, 'd.m.Y H:i:s');
        								
        							}

								$tmp = iconv('CP1251', 'UTF-8', $value);
        							$item = str_replace('{'.$key.'}', $tmp, $item);
        							//$item = str_replace('{'.$key.'}', $value, $item);
        						}
        						
        						# данные из кеша пользователя
        						$row['user_cache'] = unserialize($row['user_cache']); 
		        				foreach ($row['user_cache'] as $key => $value)
        						{
        							$tmp = iconv('CP1251', 'UTF-8', $value);
        							$item = str_replace('{'.$key.'}', $tmp, $item);
        						}
        						
        						# подписка на новости
        						$item = str_replace('{subscribe}', ($row['user_mail'] == '' ? '0' : '1'), $item);
        						
        						
        						$res .= $item;
		        		}
		        		
		        		
		        		if (count($user_ids) > 0)
		        		{
		        			$sql = "UPDATE se_users SET is_xml_download = 1 WHERE user_id IN (".implode(',', $user_ids).")";
		        			$this->std->db->do_query($sql);
		        		}
		        		
	        	}
	        	$res = $_auth_xml['begin'].$res.$_auth_xml['end'];
	        	
	        	
	        	header("Content-Type: xml");
				header("Content-Disposition: attachment; filename=".$type."_clients_".$this->std->get_time(time(), 'd.m.Y_H-i-s').".xml");
	        	 
	        	echo $res;
	        	exit;
        }
        
        
        
        
        // удаление пользователя
        function do_del()
        {
                //  считываем инфу о пользователе
                $do_id = intval( $this->std->input['id'] );

                $this->std->db->do_query("select * from se_users WHERE user_id={$do_id}");

                $rows = $this->std->db->fetch_row();

                if( $rows['user_id'] == $this->member['user_id'] )
                {
                        $this->list_members();
                        return;
                }

                // обновляем запись о блокировании
                $this->std->db->do_query("DELETE FROM se_users WHERE user_id={$do_id}");

                $this->list_members();
        }

        function form_rights()
        {
            $sql = "SELECT * FROM `".TABLE_USER."` WHERE user_id=".intval($this->std->input['id']);
            $this->std->db->do_query($sql);
            $admin_info = $this->std->db->fetch_row();

            $title_page = 'Редактирование прав пользователя';
            $button     = 'Редактривать';
        	
			$this->output .= "<table border=0 cellspacing=0 cellpadding=0 width=100%>
								<tr valign=top>
									<td width=4%><table cellpadding=0 cellspacing=0 border=0 width=30><td></td></table></td>
									<td width=92%>
								        <table border=0 cellspacing=5 cellpadding=0 width=100%>
                							<tr><td></td><td class=h2>{$title_page}<br><br></td></tr>
                							<tr><td></td><td class=h2>{$error}<br><br></td></tr>
							<form method=post action='/admin/?action=authorization&do=rights_do_edit&id=".$this->std->input['id']."'>";        
                 // делаем так что бы пользователь не смог сам себя перевести в другу группу
                 if( $admin_info['user_id'] !=  $me['user_id'] and $admin_info['user_id'] != 1)
                 {
                         $this->output .="<tr>
                                           <td align=right valign=top>
                                            Доступ:
                                            </td>
                                            <td>";
                         foreach ($this->std->access_titles as $id => $title)
                         {
                         		if ($id == ACCESS_GUEST) continue;
                         		$slt = "";
                        		if ($id == $admin_info['user_access']) $slt = "checked";
			                     $this->output .= "<input type='radio' ".$slt." name='access_value' value='".$id."'>&nbsp;".$title."<br />";
                         }
	                     
                }
                 $this->output .= "<tr><td align=right width=25%>Запрещенные модули:</td>
									<td width=75%>
								<input type=text name=module_access value='{$admin_info['module_access']}' style='width:60%;' class=f3 maxlength=100>
								</td></tr>";

			$this->output .= "<tr><td></td><td><input type=submit value=\"{$button}\" class=f2></td></tr></table></form>";
        }
                
        function do_rights()
        {
			$edit_user = array();
			$save_data = array();
			// проверяем есть ли такой пользователь в базе данных
            $sql = "SELECT * FROM se_users WHERE user_id='{$this->std->input['id']}'";
            $this->std->db->do_query($sql);

            $edit_user = $this->std->db->fetch_row();
        	if ($edit_user['user_id']) 
        	{
	            if( isset( $this->std->input['access_value'] ) 
	            		and ($edit_user['id'] !== $this->std->input['id'] and $edit_user['id'] != 1))
	                {
	                	$save_data['user_access'] = $this->std->input['access_value'];
	                }
				//$save_data['module_access'] = serialize(explode(',',$this->std->input['module_access']));
				$save_data['module_access'] = str_replace(' ', '', $this->std->input['module_access']);
				
	        	if( count( $save_data ) > 0 )
				{
					$this->std->db->do_update('users', $save_data, 'user_id='.intval($this->std->input['id']));
				}
	
				$user_id = $this->std->input['id'];
				$this->std->ucache->updateMemberCache( $user_id, 'update', $cache_update );
        	}
            $this->list_members();
			return;      	
        }

        // процесс добавления или редактирования пользователя
        function do_members( $type = 'add' )
        {
                $edit_user = array();
                $save_data = array();

                $this->std->input['id'] = intval($this->std->input['id']);

                // выбираем из базы пользователя которого мы хотим отредактировать
                if( $type == 'edit' )
                {
                        // проверяем есть ли такой пользователь в базе данных
                        $sql = "SELECT * FROM se_users WHERE user_id='{$this->std->input['id']}'";
                        $this->std->db->do_query($sql);

                        $edit_user = $this->std->db->fetch_row();
                }

                // убираем лишние пробелы и переводы каретки
                $this->std->input['user_name'] = trim($this->std->input['user_name']);

                if( $edit_user['user_id'] != 1 and ($type != 'edit' or ( $type == 'edit' and ( $edit_user['user_name'] != $this->std->input['user_name'] ) )))
                {

                        if( strlen($this->std->input['user_name']) < 3 )
                        {
                                $this->msg = 'Имя пользователя должно содержать более 3-х символов.';
                                $this->form_members( $type );
                                return;
                        }

                        // проверяем есть ли такой пользователь в базе данных
                        $sql = "SELECT * FROM se_users WHERE user_name='{$this->std->input['user_name']}'";
                        $this->std->db->do_query($sql);
                        if( $this->std->db->getNumRows() > 0)
                        {
                                $this->msg = 'Такое имя пользователя уже сущетвует.';
                                $this->form_members( $type );
                                return;
                        }

                        // сохраняем имя пользователя в результирующий массив
                        $save_data['user_name'] = $this->std->input['user_name'];
                }


                $this->std->input['uname'] = trim($this->std->input['uname']);
                if( !$this->std->input['uname'] )
                {
                        $this->msg = 'Не заполнено поле имени.';
                }


                $this->std->input['ufam'] = trim($this->std->input['ufam']);
                if( !$this->std->input['ufam'] )
                {
                        $this->msg = 'Не заполнено поле фамилии.';
                }

                // работа с паролем
                $user_pass = trim($this->std->input['user_pass']);
                if( $this->std->input['user_pass'] != '')
                {
                        // генерируем соль
                        // base64_encode = только для того что бы было легко совместимо с MSSQL и с C#
                        $salt = base64_encode($this->std->gen_pass_salt());

                        // генерируем пароль примешивая к нему соль
                        $save_data['user_pass'] = md5(md5($user_pass).md5($salt));
                        $save_data['user_salt'] = $salt;

                }
                elseif( $type == 'add' )
                {
                        $this->msg = 'Введите пароль.';
                        $this->form_members( $type );
                        return;
                }


                // работаем с аксесом пользователя
                if( isset( $this->std->input['access_value'] ) and ( $type == 'edit' and
                                                                    $edit_user['id'] !== $this->std->input['id'] and
                                                                    $edit_user['id'] != 1) )
                {
                		$save_data['user_access'] = $this->std->input['access_value'];
                }

                if( $type == 'add' )
                {
                        $save_data['user_access'] = $this->std->input['access_value'];
                }

                $this->std->input['user_email'] = $this->std->email_validate( $this->std->input['user_email'] );

                if( !$this->std->input['user_email'] )
                {
                        $this->msg = 'Некорректно введен Email';
                        $this->form_members( $type );
                        return;
                }

                if( $type != 'edit' or ( $type == 'edit' and ( $edit_user['user_email'] != $this->std->input['user_email'] ) ))
                {
                        $sql = "SELECT * FROM se_users WHERE user_email='{$this->std->input['user_email']}'";

                        $this->std->db->do_query($sql);
                        if( $this->std->db->getNumRows() > 0)
                        {
                                $this->msg = 'Такой Email уже присутствует в системе.';
                                $this->form_members( $type );
                                return;
                        }
                        // still here? yahhhhooooo!!!! email is ok!
                        else
                        {
                                $save_data['user_email'] = $this->std->input['user_email'];
                        }
                }

                $cache_update['user_ufam']  = $this->std->input['user_ufam'];
                $cache_update['user_uname'] = $this->std->input['user_uname'];

                if( $type == 'add' )
                {
                        $this->std->db->do_insert('users', $save_data);

                        $user_id = $this->std->db->get_insert_id();
                }
                else
                {
                        if( count( $save_data ) > 0 )
                        {
                                $this->std->db->do_update('users', $save_data, 'user_id='.intval($this->std->input['id']));
                        }

                        $user_id = $this->std->input['id'];
                }

                $this->std->ucache->updateMemberCache( $user_id, 'update', $cache_update );

                $this->list_members();
                return;

        }


        // форма добавления или редактирования пользователя
        function form_members( $type = 'add' )
        {
                $error = '';

                if( $this->msg )
                {
                        $error = "<table border=0 cellspacing=5 cellpadding=0 width=100%>
                                           <tr>
                                            <td></td>
                                             <td><font color=red>{$this->msg}</font><br><br></td>
                                        </tr></table>";
                }

                // выбираем ID самого себя
                $me['user_id'] = $this->std->member['user_id'];

                $mod_array    = array();
                $access_array = array();

                $admin_info = array( 'user_name' => '',
                                     'user_pass' => '',
                                     'user_email'=> '',
                                     'user_access' => ACCESS_USER,);

                if( $type == 'add' )
                {
                        $title_page = 'Добавление пользователя';
                        $button = 'Добавить';
                }
                else
                {
                        $sql = "SELECT * FROM `".TABLE_USER."` WHERE user_id=".intval($this->std->input['id']);
                        $this->std->db->do_query($sql);
                        $admin_info = $this->std->db->fetch_row();

                        $title_page = 'Редактирование пользователя';
                        $button     = 'Редактривать';
                }

                $admin_info['user_name']  = isset($this->std->input['user_name'])  ? $this->std->input['user_name']  :  $admin_info['user_name'];
                $admin_info['user_pass']  = isset($this->std->input['user_pass'])  ? $this->std->input['user_pass']  :  $admin_info['user_pass'];
                $admin_info['user_email'] = isset($this->std->input['user_email']) ? $this->std->input['user_email'] :  $admin_info['user_email'];
                $admin_info['user_uname'] = isset($this->std->input['user_uname']) ? $this->std->input['user_uname'] :  $this->std->ucache->getValueMemCacheById($admin_info['user_id'], 'user_uname');
                $admin_info['user_ufam']  = isset($this->std->input['user_ufam'])  ? $this->std->input['user_ufam']  :  $this->std->ucache->getValueMemCacheById($admin_info['user_id'], 'user_ufam');



                $this->output .= "<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr valign=top>
<td width=4%><table cellpadding=0 cellspacing=0 border=0 width=30><td></td></table></td>
<td width=92%>

        <table border=0 cellspacing=5 cellpadding=0 width=100%>
                <tr>
                        <td></td>
                        <td class=h2>{$title_page}<br><br>
                        </td>
                </tr>
                <tr>
                        <td></td>
                        <td class=h2>{$error}<br><br>
                        </td>
                </tr>


<form method=post action='/admin/?action=authorization_do_{$type}&id=".$this->std->input['id']."'>";

                  if( $admin_info['user_id'] != 1 )
                  {
                          $this->output .= "<tr><td align=right width=25%>
<font color=red>*</font> Логин:
</td>
<td width=75%>
<input type=text name=user_name value='{$admin_info['user_name']}' style='width:60%;' class=f3 maxlength=100>
</td>
</tr>";

                 }

                 $this->output .= "<tr><td align=right width=25%>
<font color=red>*</font> Имя:
</td>
<td width=75%>
<input type=text name=user_uname value='{$admin_info['user_uname']}' style='width:60%;' class=f3 maxlength=100>
</td>
</tr>";

                 $this->output .= "<tr><td align=right width=25%>
<font color=red>*</font> Фамилия:
</td>
<td width=75%>
<input type=text name=user_ufam value='{$admin_info['user_ufam']}' style='width:60%;' class=f3 maxlength=100>
</td>
</tr>";

                 $this->output .= "<tr><td align=right>";

                 if( $type == 'add' )
                 {
                         $this->output .= "<font color=red>*</font> ";
                 }

                 $this->output .= "Пароль:
                                   </td>
                                   <td>
                                   <input type=text name=user_pass value='' style='width:60%;' class=f3 maxlength=100>";

                 if( $type == 'edit')
                 {
                         $this->output .= "<br /><font color=red>Если вы не желаете менять пароль, то оставьте поле пустым</font>";
                 }

                 $this->output .= "</td>
</tr>
</tr>
<tr>
<td align=right>
<font color=red>*</font> E-mail:
</td>
<td>
<input type=text name=user_email value='{$admin_info['user_email']}' style='width:60%;' class=f3 maxlength=100>
</td>
</tr>";

                 // делаем так что бы пользователь не смог сам себя перевести в другу группу
                 if( $admin_info['user_id'] !=  $me['user_id'] and $admin_info['user_id'] != 1)
                 {
                         $this->output .="<tr>
                                           <td align=right valign=top>
                                            Доступ:
                                            </td>
                                            <td>";
                         foreach ($this->std->access_titles as $id => $title)
                         {
                         		if ($id == ACCESS_GUEST) continue;
                         		$slt = "";
                         		if ($type == 'add')
                         		{
		                         		if ($id == ACCESS_USER) $slt = "checked";
                         		}
                         		if ($type == 'edit')
                         		{
		                         		if ($id == $admin_info['user_access']) $slt = "checked";
                         		}
			                     $this->output .= "<input type='radio' ".$slt." name='access_value' value='".$id."'>&nbsp;".$title."<br />";
                         }
	                     
                }


                $this->output .= "
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            <input type=submit value=\"{$button}\" class=f2>
                                        </td>
                                    </tr>
                                    </table>
                                    </form>";
        }

        // авторизуем пользователя если ему не пришло мыло
        function members_autorisation()
        {
                $do_id = intval( $this->std->input['id'] );

                // обновляем запись о блокировании
                $this->std->db->do_update("users", array( 'user_is_validate' => '' ), "user_id={$do_id}");

                $this->list_members();
        }

        // баним пользователя
        function members_ban()
        {
                //  считываем инфу о пользователе
                $do_id = intval( $this->std->input['id'] );

                $this->std->db->do_query("select * from se_users WHERE user_id={$do_id}");

                $rows = $this->std->db->fetch_row();

                // обновляем запись о блокировании
                $this->std->db->do_update("users", array( 'user_is_active' => $rows['user_is_active'] ? 0 : 2 ), "user_id={$do_id}");

                $this->output .= '<center>Операция выполнена</center>';
                $this->list_members();
        }

        // выводим пользователей на сайте
        function list_members()
        {
				$this->output .= '<script type="text/javascript" src="/templates/jquery.js"></script>
								<script type="text/javascript">
									function search()
									{
										var url = "";
										var id = $("#id").val();
										var login = $("#login").val();
										if ((id != "") && (id != "по идентификатору"))
										{
											url = "/admin/?action=authorization&do=userinfo&id="+id;
										}
										else if((login != "") && (login != "по логину"))
										{
											url = "/admin/?action=authorization&do=userinfo&user_login="+login;
										}
										else
										{
											$("#content").html("<h2>Вы ничего не ввели</h2>");
										}	
										
										
										if (url != "")
										{
											$.get(url,
												function (data)
												{
													$("#content").html(data);													
												} 
											)
										}
									}
								</script>
								<center>
								
								<table border=0>
								<tr>
								<td valign=middle>
									Поиск по:
								</td>
								<td>							
									<input type="text" id="id" value="по идентификатору" onClick="$(\'#id\').val(\'\');"><br>
									<input type="text" id="login" value="по логину" onClick="$(\'#login\').val(\'\');">
								</td>
								<td valign=middle>
									<input type="button" value=">>>" onClick="search()">
								</td>
								</tr>
								</table>
								<br>
								<div id="content" />
								</center>';
                
        }
        
        
        function userinfo()
        {
        	$ret = '';
        	
        	if (isset($this->std->input['id']))
        	{
        		$sql = "SELECT se_users.*, se_subscribe.user_mail FROM se_users
        				LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email
        				WHERE se_users.user_id = '".$this->std->input['id']."'";        		
        	}
        	
        	if (isset($this->std->input['user_login']))
        	{
        		$sql = "SELECT se_users.*, se_subscribe.user_mail  FROM se_users
        				LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email
        				WHERE se_users.user_name = '".$this->std->input['user_login']."'";
        	}
        	
        	# оформление вывода
        	
        	if ($this->std->db->query($sql, $rows) > 0)
        	{
        		$row = $rows[0];
        		$row = array_merge($row, unserialize($row['user_cache']));
        		$ret .= '<h2>Карточка клиента</h2>';
        		
        		if ($row['user_is_active'] == '0')
        		{
        			 $ret .= "<a target=new href='/admin/?action=authorization&do=ban&id={$row['user_id']}'>Разблокировать?</a>";                       
        		}
        		else
        		{
        			$ret .= "<a target=new href='/admin/?action=authorization&do=ban&id={$row['user_id']}'>Блокировать?</a>";
        		}
        		$ret .= "<a target=new href='/admin/?action=authorization&do=rights_edit&id={$row['user_id']}'>Права доступа</a>";
        		
        		
        		
        		
        		$ret .= '<table border=1';
        		
        		
        		
        		$ret .= "<tr><td>Статус: </td><td>".($row['user_is_active'] == '0' ? 'блокирован' : 'активен')."</td></tr>";
        		$ret .= "<tr><td>Идентификатор: </td><td>".$row['user_id']."</td></tr>";
        		$ret .= "<tr><td>email: </td><td>".$row['user_email']."</td></tr>";
        		$ret .= "<tr><td>Почтовый индекс</td><td>".$row['index']."</td></tr>";
        		$ret .= "<tr><td>Адрес доставки:</td><td>".$row['adress']."</td></tr>";
        		$ret .= "<tr><td>Фамилия:</td><td>".$row['f']."</td></tr>";
        		$ret .= "<tr><td>Имя:</td><td>".$row['i']."</td></tr>";
        		$ret .= "<tr><td>Отвество:</td><td>".$row['o']."</td></tr>";
        		$ret .= "<tr><td>Контактный телефон:</td><td>".$row['phone']."</td></tr>";
        		$ret .= "<tr><td>Подписка на новости:</td><td>".($row['user_mail'] == '' ? 'не подписан' : 'подписан')."</td></tr>";
        		
        		
        		
        		$ret .= '</table';
        	
        		$ret .= '<h2>заказы</h2>';
        		
        		
        		
        		
        		
        		$ret .= $this->getOrdersInfo($row['user_id']);
        	
        		echo $ret;
        		exit;
        	}
        	
        	echo '<h2>пользователь не найден</h2>';
        	exit;
        }

        
		function getOrdersInfo($user_id)
        {
        		require_once TEMPLATES_PATH."/shop_t_config.php";
        	
        	
        	  
        	      	
        $ret = $_shop_ordersinfo['begin'];
        	    
        	$sql = "SELECT * FROM se_orders WHERE  status > 0 AND user_id  = '".$user_id."' ORDER BY order_time DESC";
        	if ($this->std->db->query($sql, $orders) > 0)
        	{
        		foreach ($orders as $order)
        		{
        			$ret .= $_shop_ordersinfo['item'];
        			$ret = str_replace('{order_id}', $order['order_id'], $ret);
        			$ret = str_replace('{order_time}', $this->std->get_time($order['order_time'], 'd.m.Y'), $ret);
        			$ret = str_replace('{total}', $order['total'], $ret);
        			$ret = str_replace('{predoplata_fact}', $order['predoplata_fact'], $ret);
        			$ret = str_replace('{predoplata}', $order['predoplata_sum'], $ret);
        			
        			
        			$skidka = 0;
        			$komplekt = 0;
        			$total = 0;
        			$table = '';
        			$sql = "SELECT * FROM se_orders_item WHERE  id_order  = '".$order['order_id']."' ORDER BY catalog_id, title";
        			if ($this->std->db->query($sql, $items) > 0)
		        	{
		        		foreach ($items as $item)
		        		{
		        			if ($item['zakaz_status'] == 'новый')
		        			{
		        				$table .= $_shop_ordersinfo['good_new'];
		        			}
		        			else
		        			{		        				
		        				$table .= $_shop_ordersinfo['good'];
		        			}
		        			

		        			
		        			$pms['{lot_id}'] = $item['lot_id'];
		        			$pms['{title}'] = $item['title'];
		        			$pms['{lot_count}'] = $item['lot_count'];
		        			$pms['{kat_price}'] = $item['kat_price'];
		        			$pms['{total}'] = number_format(($item['lot_count'] * $item['kat_price']), 2, '.', ' ');
		        			$pms['{skidka_sum}'] = $item['skidka_sum'];
		        			
		        			$pms['{zakaz_status}'] = $item['zakaz_status'];
		        			$pms['{compl_sum}'] = $item['compl_sum'];
		        			$pms['{z_sum}'] = $item['z_sum'];
							$table = strtr($table, $pms);
							
							
							$skidka += ($item['skidka_sum'] * 1);
		        			$komplekt += ($item['compl_sum'] * 1);
		        			$total += ($item['z_sum'] * 1);
		        		}
		        		
		        	}
		        	
		        	
		        	$ret = str_replace('{skidka}', $skidka, $ret);
		        	$ret = str_replace('{komplekt}', $komplekt, $ret);
		        	$ret = str_replace('{z_sum}', ceil($total), $ret);
		        	$ret = str_replace('{items}', $table, $ret);
		        
        		}
        	}
        	else
        	{
        		$ret .= $_shop_ordersinfo['empty'];
        	}
        	
        	
        	
        	
        	return $ret;
        }
        
        function edit_access( )
        {
        		if (isset($this->std->input['save']))
        		{
        				$rights = array();
        				if (count($this->std->input['access']) > 0)
        				{
		        				foreach ($this->std->input['access'] as $id => $t)
		        				{
		        						$rights[] = $id;
		        				}
        				}        				
        				
        				$this->std->db->do_update('users', array('module_access' => serialize($rights)), "`user_id` = '".$this->std->input['id']."'");
        			
        				header("Location: /admin/?action=authorization_editaccess&id=".$this->std->input['id']);
        				exit;
        		}
        	
        	
        		$sql = "select * from se_modules";
        		$this->std->db->do_query($sql);
        		$mod_titles = array();
        		
        		#подключаем доступы всех модулей
        		while ($row = $this->std->db->fetch_row())
        		{
        				if (file_exists(MODULES_PATH."/".$row['modulename']."/".$row['modulename']."_access.php"))
        				{
        						require(MODULES_PATH."/".$row['modulename']."/".$row['modulename']."_access.php");
        						$mod_titles[$row['modulename']] = $row['title'];
        				}
        		}
        		
        		$this->output .= '<center><form method="post" action="">';
        		
        		# достаем доступы пользователя
        		$sql = "select * from se_users where `user_id` = '".$this->std->input['id']."'";
        		$this->std->db->do_query($sql);
        		
        		$user = $this->std->db->fetch_row();
        		
        		$rights = unserialize($user['module_access']);
        		
        		if (!is_array($rights)) $rights = array();

        		if (count($module_access) > 0)
        		{
		        		foreach ($module_access as $modname => $access)
		        		{
				                $this->output .= $mod_titles[$modname]."<table border=1 width=30%>";
		
				                $this->output .= "<tr><td colspan=2><b>Зоны сайта</b></td></tr>";
				                
				                foreach ($access['site'] as $acc => $acc_title)
				                {
				                	$slt = in_array($acc, $rights) ? "checked" : "";
				                	$this->output .= '
				                				  <tr>
		                                              <td width="95%">'.$acc_title.'</td>
		                                              <td width="5%"><input '.$slt.' type="checkbox" name="access['.$acc.']"></td>
		                                          </tr>';
				                }
		
				                $this->output .= "<tr><td colspan=2><b>Зоны админки</b></td></tr>";
				                
				                foreach ($access['admin'] as $acc => $acc_title)
				                {
				                	$slt = in_array($acc, $rights) ? "checked" : "";
				                	$this->output .= '
				                				  <tr>
		                                              <td width="95%">'.$acc_title.'</td>
		                                              <td width="5%"><input '.$slt.' type="checkbox" name="access['.$acc.']"></td>
		                                          </tr>';
				                }
				                
		        		}
        		}
        		
        		$this->output .= "<tr><td colspan=2><input type='submit' name='save' value='Сохранить' class='f2'></td></tr></table>";
        		
        		$this->output .= "</form></center>";
        }

        function noaccess($msg)
        {
        		$this->output .= '<center>'.$msg.'</center>';
        }
        
}

?>
