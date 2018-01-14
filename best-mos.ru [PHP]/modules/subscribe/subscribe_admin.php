<?
#
#  ���� - �������
#


class mod_subscribe
{

        var $output = '';
        var $global_ids = array();
        var $is_father_enable = true;
        var $modulename  = 'subscribe';

        function process_module()
        {

                // ������� ��������� �� ������ "�������� ��������"
                $this->output        = '<br><table><tr><td width="50"></td><td>';
                $this->output        .= '</td>';

                $this->output        .= "<td><a href='?action=subscribe'>������ ��������</a> </td>";
                $this->output        .= "<td>| <a href='?action=subscribe_users'>Email-� �������������</a> </td>";
                $this->output        .= '</tr></table>';

                switch($this->std->input['action'])
                {
                        case 'subscribe_send':
                                $this->subscribe_send( );
                                $this->subscribe( );
                                break;
                        case 'subscribe_users':
                                $this->subscribe_users( );
                                break;
                        case 'subscribe_userdel':
                                $this->subscribe_userdel( );
                                $this->subscribe_users( );
                                break;
                        default:
                                $this->subscribe( );
                                break;
                }
                
        }


		/**
		 * �������� ������������� �� ��������
		 */
		function  subscribe_userdel( )
		{
    			$mail = $this->std->input["mail"];

    			$sql = "DELETE FROM `se_subscribe` WHERE user_mail = '{$mail}' AND not( user_mail is NULL)";
    			$this->std->db->do_query( $sql );
		}

		/**
         * ������ ��������, ������� � ��������
         */
        function subscribe()
        {
        		global $modules_list;

          		$this->output        .= "<script language=javascript>
                                                function doConfirm(message, url) {
                                                        if(confirm(message)) location.href = url;
                                                }
                                        </script>";

                $this->output        .= "<center>";

                if (isset( $modules_list["news"] ))
                {
		                // ����������� ������
		                $sql         = "SELECT n.*, s.active as is_send FROM `se_news` n
		                				LEFT JOIN se_subscribe s ON (s.news_id = n.id)		                				
		                				GROUP BY n.id
		                				ORDER BY n.timestamp DESC";

		                if ( $this->std->db->query($sql, $rows) > 0 )
		                {

		                        $this->output        .= "<form method='post' action='/admin/?action=subscribe_send'>";
		                        $this->output        .= '<table border="1">';
		                        $this->output        .= '<tr><td align=center>&nbsp;</td><td align=left>��������</td><td align=left>���� ������������</td></tr>';


		                        foreach ($rows as $row)
		                        {
		                        	if (is_null($row["is_send"]))
		                        	{
		                                $this->output 		.= '<tr style="background:#CCFFCC;">';

		                                $this->output		.= '<td width=30 align=center><a href="/admin/?action=news_add&id='.@$id."&itemid=".$row['id'].'"  title="�������������"><img src="/'.ADMIN_FOLDER.'/image/img_edit.png"></a></td>';

		                                $row['timestamp']	= $this->std->getNormalTime($row['timestamp']);

		                                $this->output		.= '<td width=200>'.$row['title'].'</td>
		                                                        <td width=200>'.$row['timestamp'].'</td>';

		                                $this->output		.= '<td align=center><input type="checkbox" name="subscribe_'.$row['id'].'"></td>';

		                                $this->output		.= "<tr>";
		                        	}
		                        }
		                        $this->output	.= '<tr><td colspan=3><input type="submit" value="���������"></td></tr> </table>';
		                        $this->output	.= ' </form>';
		                }else{
		                        $this->output	.= '��������, ������� � ��������, ���.';
		                }
                }
                else
                {
                		$this->output	.= '������ "�������" - �� ����������. �������� ����������.';
                }

                $this->output	.= '</center>';
        }


        /**
         * ������ �������� ������, ����������� �� ��������
         */
        function subscribe_users()
        {
        		$this->output        .= "<center>";

                // ����������� ������
                $sql         = "SELECT distinct user_mail, active FROM `se_subscribe` WHERE not (user_mail is NULL) ORDER BY user_mail";

                if ( $this->std->db->query($sql, $rows) > 0 )
                {
                        $this->output        .= '<table border="1">';
                        $this->output        .= '<tr><td align=center>������ �������� �������</td><td align=center>�������</td></tr>';

                        foreach ($rows as $row)
                        {
                        		if ($row["active"] == 1){
                                         $this->output .= '<tr style="background:#CCFFCC;">';
                                }else{
                                        $this->output .= '<tr style="background:#FFDDDD;">';
                                }
                        	
                               

                                $this->output		.= '<td>'.$row["user_mail"].'</td>';

                                // ��������
								$this->output        .= "<td align=center><a href=";
                                $this->output        .= "\"javascript:doConfirm('������� ������������ �� ��������?','/admin/?action=subscribe_userdel&mail=".$row["user_mail"]."')\"";
                                $this->output        .=        'title="�������"><img src="/'.ADMIN_FOLDER.'/image/img_del.png"></a></td>';


                                $this->output		.= "<tr>";
                        }
                        $this->output	.= ' </table>';

                }else{
                        $this->output	.= '������������� �� �������� ���.';
                }



                $this->output	.= '</center>';
        }


        /**
         * �������� �����
         * ����������� ������ ��������� ������ �������
         *
         */
        function subscribe_send()
        {
        		global $host;
        		$mail = "";

        		// ������ ������� ���������
        		require_once(TEMPLATES_PATH.'/subscribe_t_config.php');

        		# ����������� ������������� ������
				require_once(LIB_PATH."/class_parent.php");

        		// ����������� ������ ��������
                require_once(MODULES_PATH."/news/news_init.php");
                $news = new main_news();
                $news->std = $this->std;






                //-----------------------------------------------------------
                // ������������ ���� ������ ��������
                //-----------------------------------------------------------
        		foreach ($this->std->input as $key => $value)
        		{
        				if (!(strpos($key, "subscribe_") === false))
        				{
        						$key = str_replace("subscribe_", "", $key);


        						//-----------------------------------------------------------
        						// ����� ������������� �������, ������� ����� ��������
        						//-----------------------------------------------------------

        						// ���������� � �������
        						$sql = "SELECT * FROM `se_news` WHERE id=".$key;
        						if ($this->std->db->query($sql, $rows) > 0)
        						{ 
        								$row = $rows[0];

        								// ������
        								$alias = "http://".$this->std->host."/news";
        								$alias .= $news->getAliasById($row["id"]);

        								$title	= $row["title"];
        								$date	= $this->std->get_time($row['timestamp'], "d F Y" );
        								$sbody 	= $row["sbody"];

        								$search = array("{ALIAS}","{TITLE}","{SBODY}","{DOCUMENTDATE}");
        								$replace = array( $alias, $title, $sbody, $date );

        								$mail .= str_replace( $search, $replace, $_subscribe_news );


        								// ���������� ��������� ������� ������� "����������"
		                				$this->std->db->do_insert("subscribe", array("news_id" => $row["id"]));

        						}
        				}
        		}

        		// ������ ��������, ���� ���� ��� ���������
        		if ($mail != "")
        		{
		        		//-----------------------------------------------------------
		                // �������� ������
		                //-----------------------------------------------------------
		                 // ����������� email-� �������������
		                $sql = "SELECT user_mail FROM `se_subscribe` WHERE not (user_mail is NULL) AND active=1 ORDER BY user_mail";

		                if ( $this->std->db->query($sql, $rows) > 0 )
		                {
		                		
		                		
		                		$del_alias = "http://{$this->std->host}/".$this->modulename."/del/{user_mail}/{pass}/";
		                		
		                		$message = str_replace( "{MAIL}", $mail, $_subscribe_mail );
		                		$message = str_replace( "{DEL_ALIAS}", $del_alias, $message );

		                		// ����������� ���������� �������� �����
				                require_once( INCLUDE_PATH."/lib/class_mailer.php");
								$mailer = new ClassMailer();
								$mailer->is_html = 1;

		                		foreach ( $rows as $row )
		                		{
		                				
						                $pass = md5($row["user_mail"]."se3");
		                				$message = str_replace("{pass}",$pass,$message);
						                $message = str_replace("{user_mail}",$row["user_mail"],$message);
						                $mailer->message = $message;
						                $mailer->message  = str_replace('{COMPANY}', $this->std->settings['site_title'], $mailer->message);
						                $mailer->message  = str_replace('{HOST}', 'http://'.$this->std->host.'/', $mailer->message);
						                
						                $mailer->from = $this->std->settings['site_email'];	// email �����
				                		$mailer->subject = '�������� �� ����� '.$this->std->host;

		                				$mailer->to = $row["user_mail"];
		                				$mailer->send_mail();
		                				
		                		}
		                		unset($mailer);
		                }
        		}
        }


}


?>