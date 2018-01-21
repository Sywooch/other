<?php

#
#        ������ - ���������� ������ �����
#        �����: /sitemap/
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#

class main_authorization extends AbstractClass {

    var $modules = array();
    var $used_template = '';
    var $std;
    var $db_table = 'users';
    var $error_msg = '';
    // mail
    var $message = '';
    var $fullname = '';
    var $from = '';
    var $subject = '';
    var $mail_headers = '';
    var $to = '';



    function AUTHORIZATIONClass($sub_alias /* ������������� �������� ����������� � ������ */) {


        $this->AbstractClass(
                $sub_alias, // ���� ����������� � ������
                'users', // �������� ������� � ������� ����� ��������
                'authorization'     // �������� ������ (�� ��� ������ ���������� � ������� modules)
        );

        // ��������, ����� �� ��������� ������������� ����������
        // ��������� ��������� �� ������ ������ ������


        global
        $template, // ��� �������������
        $title, // ���������
        $h1, // ������� �������
        //$body,                 // ���� �������
        $template, // ��� ������������� �������
        $login_panel;            // ������ ������

        $this->mail_company = $this->std->settings['authorization_title'];
        $this->mail_from = $this->std->settings['authorization_mail'];
        $this->std->auth = &$this;

        // ���� ��� ����� �� ID ������������ �� ������ ������������
        global $auth_panel_guest, $auth_panel_user;

        if ($this->std->member['user_id']) {
            if (!empty($this->std->member['KodRec'])) {
               $login_panel = str_replace("{f}",$this->std->member['ClientName'], $auth_panel_user);
               $login_panel = str_replace("{i}", '', $login_panel);  
               $login_panel.= '<script type="text/javascript">';
               $login_panel.= '$(function(){$(\'#edit_url\').attr(\'href\',\'/shop/ordersinfo/#tabs-2\');});';
               $login_panel.= '</script>';            
            }
            else {
                $login_panel = str_replace("{f}", $this->std->member['user_cache']['f'], $auth_panel_user);
                $login_panel = str_replace("{i}", $this->std->member['user_cache']['i'], $login_panel);
                $login_panel = str_replace("{MEMBERNAME}", $this->std->member['user_name'], $login_panel);
                $login_panel.= '<script type="text/javascript">';
                $login_panel.= '$(function(){$(\'#edit_url\').attr(\'href\',\'/authorization/edit\');});';
                $login_panel.= '</script>';                
            }
        } else {
            $login_panel = $auth_panel_guest;
        }

        require_once( BASE_PATH . "include/lib/captcha_lib.php" );
        $this->captcha_lib = new captcha_lib();
        $this->captcha_lib->std = &$this->std;

        if ($this->current_url_array[0] == $this->module_name) { // ���� ���������� ����� �����
            if (count($this->current_url_array) > 1) {

                switch ($this->current_url_array[1]) {
                    case 'auth':
                        $this->auth_form();
                        break;
                    case 'out':
                        $this->member_out();
                        break;
                    case 'login':       
                        $this->member_in();
                        break;
                    case 'reg':
                        $this->reg_form();
                        break;
                    case 'doreg':
     //                   echo $this->current_url_array[1];
//exit;
                        $this->do_reg();
                        break;
                    case 'remember':
                        $this->remember();
                        break;
                    case 'doremember':
                        $this->do_remember();
                        break;
                    case 'edit':
                        $this->edit_form();
                        break;
                    case 'doedit':
                        $this->do_edit();
                        break;
                    case 'approve':
                        $this->do_approve();
                        break;
                    case 'captcha':
                        $this->show_reg_img();
                        break;
                    default:
                        $template = 'error';
                        $this->ModulError("Error {AUTHORIZATIONClass:init} ��������� �� ��������� ������.");
                        break;
                }
            } else {
                $template = 'error';
                $this->ModulError("Error {AUTHORIZATIONClass:init} ��������� �� ��������� ������.");
            }
        }

        // ������ ������ � ������ �� � ���������������� ����
        if ($this->std->getValueSession('error_in')) {
            $this->login_error(0);
            $this->error_msg = '������ �����������.';
        }

        // �������� ������������ ������ � ����� ������
        $login_panel = str_replace("{ERROR}", $this->error_msg, $login_panel);
    }

    /**
     * �����������
     *
     */
    function auth_form() {
        global $body, $auth_panel_guest2, $template;
        global $h1, $title;
        $template = 'authorization_login';
        $h1 = $title = '����������� ������������';

        $body = $auth_panel_guest2;
        $body = str_replace("{REFERER}", $_SERVER["HTTP_REFERER"], $body);
    }

    /**
     * �������� ������������ �� ���������� ������
     * ���� ������������ ������������ � ����, �� ������������� �����, ����� �������������
     * ����
     *
     * @param unknown_type $data - ������, ���������� �� ������������
     * @param unknown_type $do - ��������: 1 - ��������� � ��������/�������� � �����������, 2 - ��������� � ���� ���������������, �� �����������
     * @return unknown
     */
    function user_isset($data, $do, &$message, &$user) {
        global $auth_shopauth_nopass, $auth_shopreg_do, $auth_shopreg_isset_user, $_auth;
        $user = array();
        $ok = true;
        $message = '';


        $data['index'] = $this->std->clean_value($data['index']);


        $sql = "SELECT * FROM se_users WHERE user_name = '" . $data['user_name'] . "'";
        if ($this->std->db->query($sql, $rows) > 0) {
            if ($data['user_pass'] == $rows[0]['user_pass']) {
                if ($do == 1) {
                    # ������ �������, ����������� �� �����
                    $message = $auth_shopreg_isset_user;
                } else {
                    # ������ �������, ����� ��������� �����
                    $message = $auth_shopreg_do;
                }

                $user = $data;
            } else {
                # ������������ ���� � ����, �� ������ �� �������
                $message = $auth_shopauth_nopass;
            }
        } else {
            # ������ ������������ ��� ���, ������ ����� �������

            $pms = array(
                'user_name' => $data['user_name'],
                'user_pass' => $data['user_pass'],
                'user_email' => $data['email'],
                'user_access' => '2', // ������������
                'user_cache' => serialize($data),
                'user_is_active' => 1,
                'user_rectime ' => time()
            );
            $this->std->db->do_insert('users', $pms);

            
            $user = $data;
            $user['user_id'] = $this->std->db->get_insert_id();
            $message = $_auth['reg_done'];

            // ����� ��������� � ����������� � ������
        }

        return $ok;
    }

    /* -------------------------------------------------------------------- */

    // ����� ����������� �����
    /* -------------------------------------------------------------------- */
    function show_reg_img() {
        $this->captcha_lib->path_background = BASE_PATH . 'modules/authorization/backgrounds';

        return $this->captcha_lib->captcha_show();
    }

    // ��������� �����������������
    function do_edit() {
        global $error_auth, // ������ �����������
        $title, // ��������� ��������
        $body, // ���� ���.
        $auth_edit_done,
        $host,
        $mail_auth_template,
        $auth_edit_form;
        ;
        if (!$this->std->member['user_id']) {
            header("Location: /");
            exit();
        }

        $sql = "SELECT se_users.*, se_subscribe.user_mail FROM se_users
                		LEFT JOIN se_subscribe ON se_subscribe.user_mail = se_users.user_email
                		WHERE se_users.user_id='" . $this->std->member['user_id'] . "' LIMIT 1";



        if ($this->std->db->query($sql, $users) > 0) {
            $user = $users[0];

            # �������� ��������� email
            # ���� ���������� �� ��������, ����� �������� "���� �� ����� �� � ����"
            # ���� ����, ����� ������ ������ ������
            /* $email = $this->std->input['email'];
              $sql = "SELECT * FROM se_users WHERE user_name = '$email' AND user_id <> '".$this->std->member['user_id']."'";
              if ($this->std->db->query($sql, $rows) > 0)
              {
              # ���� ���-�� �������, ������ ������ ������ ����, ����������
              $error_str = '<font color="red">�������� ���� "email" ��� ������������ ������ ������������� �������.<br>�������� ������ � ��������� �������</font>';
              } */


            if (!$error_str) {
                $title = "���� ������ ������ ��������";
                $body = $auth_edit_done;


                # �� ������� ���������� ����� ����� (�� �� ����� ���� ��������!)
                $index = $this->std->input['index'];
                $adress = '';
                $sql = "SELECT postind, oblast, rayon, gorod FROM se_post WHERE postind = '$index' OR IndOld = '$index' LIMIT 1";
                if ($this->std->db->query($sql, $rows) > 0) {
                    $row = $rows[0];
                    $adress = $row["postind"] . ', ' . $row['oblast'] . ', ' . $row['rayon'] . ', ' . $row['gorod'];
                }




                $save = array();
                $save['user_name'] = $this->std->member['user_name'];
                $save['user_email'] = $this->std->input['email'];
                $save['user_pass'] = $this->std->input['user_pass'];
                if ($save['user_pass'] == '')
                    unset($save['user_pass']);
                $save['user_is_active'] = 2;
                $save['user_cache'] = serialize(array('index' => $this->std->input['index'],
                            'adress_deliver' => $this->std->input['adress_deliver'],
                            'adress' => $adress,
                            'f' => $this->std->input['f'],
                            'i' => $this->std->input['i'],
                            'o' => $this->std->input['o'],
                            'email' => $this->std->input['email'],
                            'phone' => $this->std->input['phone'],
                            'user_name' => $save['user_name']));

                $this->std->db->do_update('users', $save, 'user_id=' . $this->std->member['user_id']);


                # �������� �� �������
                if (isset($this->std->input['subscribe'])) {
                    if ($user['user_mail'] != $this->std->input['email']) {
                        $sql = "SELECT * FROM se_subscribe WHERE user_mail = '{$this->std->input['email']}'";
                        if ($this->std->db->query($sql, $rows) == 0) {
                            $save = array();
                            $save['news_id'] = -1;
                            $save['user_mail'] = $this->std->input['email'];
                            $save['active'] = 1;
                            $this->std->db->do_insert('subscribe', $save);
                        }
                    }
                } else {
                    $sql = "DELETE FROM se_subscribe WHERE user_mail = '" . $this->std->input['email'] . "'";
                    $this->std->db->do_query($sql);
                }
            } else {
                $title = "������ ������ ������������ " . $this->std->member['user_name'];
                $this->edit_form();
                $body = $error_str . $body;
            }
        }
    }

    // ����� �����������
    function edit_form() {
        global $error_auth, // ������ �����������r
        $title, // ��������� ��������
        $body, // ���� ���.
        $auth_edit_form,
        $host;

        $title = "������ ������ ������������ " . $this->std->member['user_name'];
        $error_auth = "";

        $body = $auth_edit_form;

        if (!$this->std->member['user_id']) {
            header("Location: http://{$host}");
            exit();
        }

        foreach ($this->std->member as $k => $v) {
            if ($k == 'user_pass' or $k == 'user_salt') {
                continue;
            }

            $body = str_replace("{" . $k . "}", $v, $body);
        }

        foreach ($this->std->member['user_cache'] as $k => $v) {
            if ($k == 'user_pass' or $k == 'user_salt') {
                continue;
            }

            $body = str_replace("{" . $k . "}", $v, $body);
        }


        # �������� �� �������
        $sql = "SELECT user_mail FROM  se_subscribe WHERE user_mail='" . $this->std->member['user_email'] . "'";
        if ($this->std->db->query($sql, $rows) > 0) {
            $body = str_replace("{CHECKED}", 'CHECKED', $body);
        } else {
            $body = str_replace("{CHECKED}", '', $body);
        }


        $body = str_replace("{ufam}", $this->std->ucache->getValueMemCache('user_ufam'), $body);
        $body = str_replace("{uname}", $this->std->ucache->getValueMemCache('user_uname'), $body);
    }

    // ������� ���������
    function do_approve() {
        global $error_auth, // ������ �����������
        $title, // ��������� ��������
        $body, // ���� ���.
        $auth_activate_done,
        $host,
        $mail_auth_template,
        $auth_activate_error;

        $this->current_url_array[2] = preg_match("/^([0-9A-Za-z]){32}$/", $this->current_url_array[2]) ? $this->current_url_array[2] : '';

        // ���� ����� ��������� �� ����������� � ���������� ��������� �������� �������� �� ����� � ����
        if (!$this->current_url_array[2]) {
            $this->current_url_array[2] = md5(microtime());
        }

        $sql = "SELECT * FROM " . TABLE_USER . " WHERE user_is_validate='" . $this->current_url_array[2] . "' LIMIT 1";

        $this->std->db->do_query($sql);

        if ($this->std->db->getNumRows()) {
            $m = $this->std->db->fetch_row();

            $title = "��������� ������ ������������";
            $body = $auth_activate_done;

            $pass = $this->std->ucache->getValueMemCacheById($m['user_id'], 'tmp_pass');
            $this->std->ucache->updateMemberCache($m['user_id'], 'delete', $this->std->member['user_cache']);

            // ��������� ������
            $this->fullname = $this->mail_company . ' ';
            $this->from = $this->mail_from;
            $this->subject = $mail_auth_template['subject_1'];
            $this->message = $mail_auth_template['body_1'];
            $this->to = $m['user_email'];

            $this->message = str_replace(array('{LOGIN}', '{PASS}', '{MAIL}'),
                            array($m['user_name'], $pass, $m['user_email']),
                            $this->message);


            // ���������� ������
            $this->send_mail();


            $this->std->db->do_update('users', array('user_is_validate' => '',), 'user_id=' . $m['user_id']);
        } else {
            $title = "��������� ���������";
            $body = $auth_activate_error;
        }
    }

    // ������� ������������
    function do_reg() {
        global $error_auth, // ������ �����������
        $title, // ��������� ��������
        $body, // ���� ���.
        $_auth,
        $host,
        $mail_auth_template
        ;

        $errors = array();

        $h1 = $title = "����������� ������������";
        $body = $_auth['reg_done'];

        if ($this->std->member['user_id']) {
            header("Location: http://{$host}");
            exit();
        }

        #-----------------------------------------------------------------
        # ��������� ������
        #-----------------------------------------------------------------
        $dataform = array();

        $dataform['index'] = substr($this->std->input['gorod'], 0, strpos($this->std->input['gorod'], ','));
        $dataform['index'] = $this->std->input['myindex'];
        $dataform['adress_deliver'] = $this->std->input['adress_deliver'];
        $dataform['adress'] = $this->std->input['gorod'];


        $dataform['f'] = $this->std->input['f'];
        $dataform['i'] = $this->std->input['i'];
        $dataform['o'] = $this->std->input['o'];
        $dataform['email'] = $this->std->input['email'];
        $dataform['phone'] = $this->std->input['phone'];
        $dataform['user_pass'] = $this->std->input['passwd'];
        $dataform['user_name'] = $this->std->input['user_name'];

        //$add['PostIndex'] = $this->std->input['myindex'];
        //$add['Oblast'] = $this->std->input['region'];
        //$add['Rayon'] = $this->std->input['rayon'];
        //$add['Town'] = substr($this->std->input['gorod'],0,strpos($this->std->input['gorod'], '(')-1);
        //$add['ShippingAddress'] = $this->std->input['adress_deliver'];
        //$add['ClientName'] = $this->std->input['f'] . ' ' . $this->std->input['i'] . ' ' . $this->std->input['o'];
        //$add['phone'] = $this->std->input['phone'];

        //$this->std->db->do_insert( 'users', $add );

        $user = array();
        $this->user_isset($dataform, 1, &$body, $user);


        if ($error == '') {
            # ������������ ��������� ����������������� ��� �� ��� ������ �������
        }

        if (count($user) > 0) {
            require_once( INCLUDE_PATH . "/lib/class_mailer.php");
            $mailer = new ClassMailer();
            $mailer->is_html = 1;
            $mailer->fullname = $this->mail_company . ' ';
            $mailer->from = $this->mail_from;
            $mailer->subject = '����������� � �����������';
            $mailer->to = $user['email'];
            $mailer->message = $this->std->settings['user_register_mail'];
            $mailer->message = str_replace(array('{LOGIN}', '{F}', '{I}', '{EMAIL}'),
                            array($user['user_name'], $user['f'], $user['i'], $user['email']),
                            $mailer->message);
            $mailer->message = str_replace("{INFO_BLOCK}", $this->std->settings['user_registerinfo_mail'], $mailer->message);

            // ���������� ������
            $mailer->send_mail();
            unset($mailer);

            $title = '����� ������������ ���������������';


			error_log(strftime("%d.%m.%Y %H:%M:%S")." ��������������� ������������ � ID[".$user['user_id']."].\n", 3, LOG_PATH."/order.log");
            
            
            $this->std->input['username'] = $dataform['user_name'];
            $this->std->input['userpass'] = $dataform['user_pass'];
            $this->std->input['referer'] = '/shop/login/';
            $this->member_in();
        }       
        

        /*

          if( $error_auth == '' )
          {
          $save['user_name']        = $user_name;
          $save['user_email']       = $this->std->input['email'];

          // ������� ���������� ����
          $save['user_is_validate'] = md5(microtime());

          // ������� �������� ����
          $pass              = $this->std->input['UserPass'];
          $save['user_salt'] = base64_encode($this->std->gen_pass_salt());

          // ���������� ��� ������
          $save['user_pass'] = md5(md5($pass).md5($save['user_salt']));

          $save['user_access'] = ACCESS_USER;


          // ��������� ������
          $this->fullname = $this->mail_company.' ';
          $this->from     = $this->mail_from;
          $this->subject  = $mail_auth_template['subject_6'];
          $this->message  = $mail_auth_template['body_6'];
          $this->to       = $m['user_email'];
          $this->message  = str_replace( "{REGKEY}",
          $save['user_is_validate'],
          $this->message );

          // ���������� ������
          $this->send_mail();

          $save['user_cache'] = serialize( array( 'tmp_pass'   => $pass,
          'user_ufam'  => $this->std->input['ufam'],
          'user_uname' => $this->std->input['uname']) );

          // ��������� ������ � ���� ������
          $this->std->db->do_insert( 'users', $save );

          $title = '����� ������������ ���������������';
          $body = $auth_reg_done;
          } */
    }

    // ����� �����������
    function reg_form() {
        if ($this->std->member['user_id']) {
            header("Location: http://{$host}");
            exit();
        }


        global $body, $_auth, $title, $h1;
        $h1 = $title = '�����������/����������� ������������';


        include_once MODULES_PATH . "/shop/shop_init.php";
        $shop = new main_shop(); // ����� ���������
        $shop->ModulesList = $this->modules; // ������ ������������� � ������� �������
        $shop->std = &$this->std;   // ����������� ����� �������


        $body = $_shop_order['body_first_buy'];
        $body = str_replace('{ADDING_TEXT}', '���� �� ������� �� ����� �����, �� ������ ��� ������������������:', $body);
        $body = str_replace('{regions}', $shop->getRegions(), $body);

        $body = substr($body, 0, strpos($body, '{docs}')) . $_auth['reg_form'];
    }

    // ���������� ������ (��������)
    function do_remember() {
        global $error_auth, // ������ �����������
        $title, // ��������� ��������
        $body, // ���� ���.
        $auth_remember,
        $_auth_remember_mail,
        $auth_remember_done,
        $auth_remember_error;

        $title = "������ ���� ������?";


        $body = $auth_remember;


        if ($this->std->member['user_id']) {
            header("Location: /");
            exit();
        }

        $user_name = $this->std->input['user_name'];
        $user_email = $this->std->input['email'];

        // ����������� ����������� �� ������
        $sql = "SELECT user_id,user_name,user_pass,user_email,user_cache
                                                          FROM " . TABLE_USER . "
                                                  WHERE LOWER(user_name)='" . strtolower($user_name) . "' AND
                                                  		LOWER(user_email)='" . strtolower($user_email) . "'
                                                  LIMIT 1";

        $this->std->db->do_query($sql);

        // ���� ������ � ����� ����� ���� �� ���������� ������
        if ($this->std->db->getNumRows()) {
            $row = $this->std->db->fetch_row();
            $row['user_cache'] = unserialize($row['user_cache']);
            $row['user_cache']['user_pass'] = $row['user_pass'];

            foreach ($row['user_cache'] as $key => $value) {
                $_auth_remember_mail = str_replace("{" . $key . "}", $value, $_auth_remember_mail);
            }


            # �������� ������
            require_once( INCLUDE_PATH . "/lib/class_mailer.php");
            $mailer = new ClassMailer();
            $mailer->is_html = 1;
            $mailer->from = $this->std->settings['site_email'];
            $mailer->subject = $this->std->settings['site_title'];
            $mailer->to = $row['user_email'];
            $mailer->message = $_auth_remember_mail;
            $mailer->message = str_replace("{INFO_BLOCK}", $this->std->settings['user_registerinfo_mail'], $mailer->message);
            $mailer->send_mail();

            unset($mailer);

            $title = '��� ������ ������';
            $body = $auth_remember_done;
        } else {
            $body = $auth_remember_error;
        }
    }

    // ���������� ������ (�����)
    function remember() {
        global $error_auth, // ������ �����������
        $title, // ��������� ��������
        $body, // ���� ���.
        $auth_remember,
        $host;

        $title = "������ ���� ������?"; # �� � ��� � ����


        $body = $auth_remember;


        if ($this->std->member['user_id']) {
            header("Location: http://{$host}");
            exit();
        }
    }

    //���� ������������
    function member_in() {
        global $login_panel;
        //��������� ��������� ������

        $user_name = trim($this->std->input['username']);
        $user_pass = trim($this->std->input['userpass']);
        $referer = $this->std->input['referer'];




        // ���� �� ���� ���
        if ($user_name == '') {
            // ���������� � ��� ������ ��� ������
            $this->login_error(1);
        }

        // ����������� ����������� �� ������
        $sql = "SELECT user_id,KodRec,user_name,user_pass,user_email,user_access,user_is_validate
                                                          FROM `" . TABLE_USER . "`
                                                  WHERE LOWER(user_name)='" . strtolower($user_name) . "'
                                                  LIMIT 0,1";

        $this->std->db->do_query($sql);
        // ���� ������ � ����� ����� ���� �� ���������� ������
        if ($this->std->db->getNumRows()) {
            $m = $this->std->db->fetch_row();

            // ���� ������ �����
            if ($m['user_pass'] == $user_pass) {
                // ���������� � ���� ID ������������ � ������ � MD5

                $this->std->my_setcookie('member_id', $m['user_id']);
                $this->std->my_setcookie('auth', 'ok');

                // ��������� � ������� ������ ID ������������
                $this->std->db->do_update('session', array('session_member_id' => $m['user_id']), "session_id='{$this->std->session_id}'");

                // ���������� ������� ������ � ������ ������������
                $this->std->member = array_merge($this->std->member, $m);
            } else {
                $this->login_error(1);
            }
        } else {
            $this->login_error(1);
        }
        
        error_log(strftime("%d.%m.%Y %H:%M:%S")." ����������� ������������ � ID[".$this->std->member['user_id']."].\n", 3, LOG_PATH."/order.log");
        
        
        // ������������ �� �������� � ������� ������� ����
        if (!$referer)
            $referer = $_SERVER['HTTP_REFERER'];
        if ($referer && (strpos($referer, $_SERVER['HTTP_HOST']))) {
            header("Location: " . $referer);
            exit();
        }
        

        header("Location: ".$referer);
        exit();
    }

    // ����� ������������
    function member_out() {
    	
    	// ���� ����������: ������� ������������� ����� �� �������� /shop/login/  � ������� ��� ������ �� �����        		
        error_log(strftime("%d.%m.%Y %H:%M:%S")." ������������ � ID[".$this->std->member['user_id']."] ����� �� �������.\n", 3, LOG_PATH."/order.log");
    	
        // �������� �������� 0 ��� ���� ��� �� ����� �� ����� ���� ��������
        $this->std->log_out(0);

        header("Location: /");
        exit();
    }

    // ���������� ���� ������
    function login_error($error_no = '1') {
        // ����� �� �������� ��� ������
        $this->std->updateSession($this->std->session_id, 'update', $error_no);
        header("Location: /authorization/reg/");
        exit();
    }

}

?>