<?php

class Users
{

    public $error = '';

    static function sendEmailChangeStatus ($status1, $status2, $user_id, $order_id, $taobao_item_id = '', $email = '') {
        global $otapilib;
        $sid = $_SESSION['sid'];
        
        if (empty($email))
        {
            $user = $otapilib->GetUserInfoForOperator($sid, $user_id);
            if (!$user) $error = $otapilib->error_message;
        } else {
            $user['email'] = $email;
        }
        if ($user['email']) {
            $to = $user['email'];
            if ($taobao_item_id) {
                $subject  = LangAdmin::get('change_status_line').' '.$taobao_item_id;
                $subject .= ' (' . LangAdmin::get('order'). ': '.$order_id . ')';
                $message  = $subject . '<br/>';
            } else {
                $subject  = LangAdmin::get('change_status').' '.$order_id;
                $message  = LangAdmin::get('change_status').' '.$order_id.'<br/>';
            }
            $message .= $status1 . ' ---> '. $status2.'<br/>';
            $message .= LangAdmin::get('get_more_info').' ';
            $message .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?p=privateoffice">'.LangAdmin::get('link1').'</a>';
            
            $template = false;
            if (file_exists('../templatescustom/notify/order_status.html'))
            {
                $message = file_get_contents('../templatescustom/notify/order_status.html');
                $template = true;
            }
            if (file_exists('templatescustom/notify/order_status.html'))
            {
                $message = file_get_contents('templatescustom/notify/order_status.html');
                $template = true;
            }
            if ($template)
            {
                $message = str_replace(array('<<ORDER_ID>>', '<<OLD_STATUS>>', '<<NEW_STATUS>>'), array($order_id, $status1, $status2), $message);
            }
            
            $params['email'] = $user['email'];
            $params['subject'] = $subject;
            $params['message'] = $message;

            if (defined('SEND_BY_GMAIL')) {
                $params = array(
                    'mess'      => $message,
                    'email'     => $to,
                    'subject'   => $subject,
                    'login'     => NOTIFICATION_LOGIN,
                    'password'  => NOTIFICATION_PASS,
                    'domain'    => $_SERVER['SERVER_NAME'],
                );
                self::sendEmail($params);
            } else {
                self::sendEmail2($params);
            }
        }
    }
    
    static function sendEmailCreatePackage ($user_id, $order_id, $package_id, $email = '') {
        global $otapilib;
        $sid = $_SESSION['sid'];
        
        if (empty($email))
        {
            $user = $otapilib->GetUserInfoForOperator($sid, $user_id);
            if (!$user) $error = $otapilib->error_message;
        } else {
            $user['email'] = $email;
        }
        
        if ($user['email']) {
            $message  = LangAdmin::get('create_package').' '.$package_id.' ';
            $message .= LangAdmin::get('in_order').' '.$order_id.'<br/>';
            $message .= LangAdmin::get('get_more_info').' ';
            $message .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?p=privateoffice">'.LangAdmin::get('link1').'</a>';
            
            $template = false;
            if (file_exists('../templatescustom/notify/order_status.html'))
            {
                $message = file_get_contents('../templatescustom/notify/order_status.html');
                $template = true;
            }
            if (file_exists('templatescustom/notify/order_status.html'))
            {
                $message = file_get_contents('templatescustom/notify/order_status.html');
                $template = true;
            }
            if ($template)
            {
                $message = str_replace(array('<<ORDER_ID>>', '<<PACKAGE_ID>>'), array($order_id, $package_id), $message);
            }
            
            $params['email'] = $user['email'];
            $params['subject'] = LangAdmin::get('create_package').' '.$package_id;
            $params['message'] = $message;
            self::sendEmail2($params);
            
            if (/*defined('NOTIFICATION_LOGIN') && defined('NOTIFICATION_PASS')*/0) {
                $params = array(
                    'mess'      => $message,
                    'email'     => $to,
                    'subject'   => $subject,
                    'login'     => NOTIFICATION_LOGIN,
                    'password'  => NOTIFICATION_PASS,
                    'domain'    => $_SERVER['SERVER_NAME'],
                );
                self::sendEmail($params);
            }
        }
    }
    
    
    static function sendEmail ($params) {
        $curl = new Curl('http://tools.opentao.net/smtp_sender/send_to_user.php', 60, false, 10, false, true, false);
        $curl->setPost(http_build_query($params));
        $curl->connect();
        $info = $curl->getInfo();
    }
    
    static function sendEmail2($params) {
        try {
            require_once CFG_APP_ROOT.'/lib/phpmailer/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->Subject = $params['subject'];
            $from = str_replace(':8080', '', 'noreply@'.preg_replace('/^www\./','',$_SERVER['HTTP_HOST']));
            $mail->From = $from;
            $mail->FromName = CFG_SITE_NAME;
            $mail->IsHTML(true);
            $mail->CharSet = 'utf-8';

            $mail->Body = $params['message'];

            $mail->AddAddress($params['email']);
            $mail->Send();
        }
        catch(phpmailerException $e){
            //print $e->getMessage();
        }
    }
    
    
    function defaultAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            //$result = $otapilib->GetWebUISettings($sid);
            
            $filters = str_replace('<?xml version="1.0"?>', '', $this->_generateFilters());

            $perpage = isset($_GET['ps']) ? $_GET['ps'] : 10;
            $a_page = isset($_SESSION['admin_user_page']) ? $_SESSION['admin_user_page'] : 1;
            $from = isset($_GET['p']) ? $_GET['p'] : $a_page;
            $from = ($from > 1) ? ($from-1) * $perpage : 0;
            

            $users = $otapilib->FindBaseUserInfoListFrame($sid, $filters, $from, $perpage);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }
            $pageurl = $this->_getPageURL();

            include(TPL_DIR . 'users/users.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }

    function userinfoAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            $userid = @$_GET['id'];
            $error = '';
            //$result = $otapilib->GetWebUISettings($sid);

            if (CFG_MULTI_CURL)
            {
                // Инициализируем
                $otapilib->InitMulti();
                $user = $otapilib->GetUserInfoForOperator($sid, $userid);
                $user_account = $otapilib->GetAccountInfoForOperator($sid, $userid);
                $all_orders = $otapilib->GetSalesOrdersListForOperator($sid, '');
                $moneyhistory = $otapilib->GetStatementForOperator($sid, $userid, '', '');
                // Делаем запросы
                $otapilib->MultiDo();
                $user = $otapilib->GetUserInfoForOperator($sid, $userid);
                if ($otapilib->error_message == 'SessionExpired') {
                    header('Location: index.php?expired');
                    die;
                }
                if (!$user) $error = $otapilib->error_message;
                $user_account = $otapilib->GetAccountInfoForOperator($sid, $userid);
                if (!$user_account) $error .= $otapilib->error_message;
                // Получение заказов пользователя.
                $all_orders = $otapilib->GetSalesOrdersListForOperator($sid, '');
                if (!$all_orders) $error .= $otapilib->error_message;
                $moneyhistory = $otapilib->GetStatementForOperator($sid, $userid, '', '');
                // Сбрасываем
                $otapilib->StopMulti();
            } else {
                $user = $otapilib->GetUserInfoForOperator($sid, $userid);
                if ($otapilib->error_message == 'SessionExpired') {
                    header('Location: index.php?expired');
                    die;
                }
                if (!$user) $error = $otapilib->error_message;
                $user_account = $otapilib->GetAccountInfoForOperator($sid, $userid);
                if (!$user_account) $error .= $otapilib->error_message;
                // Получение заказов пользователя.
                $all_orders = $otapilib->GetSalesOrdersListForOperator($sid, '');
                if (!$all_orders) $error .= $otapilib->error_message;
                $moneyhistory = $otapilib->GetStatementForOperator($sid, $userid, '', '');
            }
            
            $user_orders = array();
            foreach ($all_orders as $order) {
                if($order['custid'] == (int)$user['id']) {
                    $user_orders[] = $order;
                }
            }

            include(TPL_DIR . 'users/userinfo.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }
	public function savePasswordAction()
	{
		global $otapilib;
		$sid = @$_SESSION['sid'];
		if ($otapilib->error_message == 'SessionExpired' || $sid == '')
		{
			header('Location: index.php?expired');
			die;
		}
		$cms = new CMS();
		$status = $cms->Check();
		if ($status)
		{
			$_POST['Password'] = trim($_POST['Password']);
			if (!isset ($_POST['Password']) || strlen(trim($_POST['Password']))<6){
				echo LangAdmin::get('password_min_length_6');
				die();
			}
//			$otapilib->setErrorsAsExceptionsOn();
			try {
				$user = $otapilib->GetUserInfoForOperator($sid, intval($_POST['Id']));
				foreach ($user as $key=>$field){
					$_POST[$key] = $field;
				}
				$fields = str_replace('<?xml version="1.0"?>', '', $this->_generateUserFields());
				$result = $otapilib->EditUser($sid, $fields);
				if ($result){
					$newPass = $_POST['Password'];
					if (file_exists(TPLCUSTOM_DIR.'users/recovery_email.php'))
						include(TPLCUSTOM_ABSOLUTE_PATH.'users/recovery_email.php');
					else
						include(TPL_ABSOLUTE_PATH.'users/recovery_email.php');
					$params['message'] = $message;
					$params['email'] = $user['Email'];
					$params['subject'] = LangAdmin::get('pass_recovery');
					$this->sendEmail2($params);
				}
			} catch (Exception $e) {
				echo LangAdmin::get('savePassError');
				die();
			}

			echo 'Ok';
		}
		die;
	}

	function authAction()
    {
        global $otapilib;
        $sid = $_SESSION['sid'];
        $login = @$_GET['login'];
        @define('NO_DEBUG', true);

        $auth = $otapilib->AuthenticateAsUser($sid, $login);
        
        if ($otapilib->error_message == 'SessionExpired') {
            print 'RELOGIN';
            die;
        }
        if (!$auth) {
            print $otapilib->error_message;
        } else {
            $_SESSION[CFG_SITE_NAME.'loginUserData'] = array(
                'sid' => $auth,
                'username' => $login,
                'IsAuthenticated' => true
            );
            print 'Ok';
        }
    }

    function usercreateAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            $userid = @$_GET['id'];

            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }

            include(TPL_DIR . 'users/usercreate.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }

    function usereditAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            $userid = @$_GET['id'];

            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }

            $user = $otapilib->GetUserInfoForOperator($sid, $userid);
            //var_dump($user);die;
            if (!$user) $error = $otapilib->error_message;

            include(TPL_DIR . 'users/useredit.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }

    /**
     * @param RequestWrapper $request
     */
    function saveuserAction($request)
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];

            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }

            $fields = str_replace('<?xml version="1.0"?>', '', $this->_generateUserFields());
            //echo '$fields='.$fields;


            if (isset($_POST['Id'])) {
                $result = $otapilib->EditUser($sid, $fields);
                if($result !== false)
                    Plugins::invokeEvent('onEditUser', array('user' => $_POST));
            } else {
                $result = $otapilib->AddUser($sid, $fields);
                if($result !== false){
					CMS::SetSubscribe($_POST['Login'],$_POST['Email']);
                    Plugins::invokeEvent('onAddUser', array('user' => $_POST, 'newUserId' => $result));
				}
            }
            if (!$result) $error = $otapilib->error_message;
            $message = ($error != '') ? '&error=' . $error : '';
            header('Location:index.php?sid=&cmd=users&do=useredit&id='.$request->getValue('Id') . $message);

        } else {
            include(TPL_DIR . 'login.php');
        }
    }

    function deleteAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $userid = $_GET['id'];

        $r = $otapilib->DeleteUser($sid, $userid);

        if (!$r) print $otapilib->error_message;
        else print 'Ok';

        die;
    }

    function userlockAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $userid = $_GET['id'];

        $r = $otapilib->SetUserBan($sid, $userid, 'true');
//        var_dump($r); die;
        if (!$r) {
            print $otapilib->error_message;
        }
        else print 'Ok';

        die;
    }

    function userunlockAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $userid = $_GET['id'];

        $r = $otapilib->SetUserBan($sid, $userid, 'false');
        if (!$r) {
            print $otapilib->error_message;
        }
        else print 'Ok';

        die;
    }
    
    function accountinfoAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            $userid = @$_GET['id'];
            $error = '';
            
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }

            $user = $otapilib->GetUserInfoForOperator($sid, $userid);
            if (!$user) $error = $otapilib->error_message;
            
            $user_account = $otapilib->GetAccountInfoForOperator($sid, $userid);
            if (!$user_account) $error .= $otapilib->error_message;

            include(TPL_DIR . 'users/accountinfo.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }
    
    function accountactionAction()
    {
        if (Login::auth()) {
            global $otapilib;
            $sid = $_SESSION['sid'];
            $userid = @$_GET['id'];
            $error = '';
            
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired') {
                header('Location: index.php?expired');
                die;
            }
            
            $r = $otapilib->PostTransaction($sid, $userid, $_POST['summa'], $_POST['comment'], $_POST['isdebit'], date('Y-m-d h-i-s'));
            if (!$r) $error = $otapilib->error_message;

            $user = $otapilib->GetUserInfoForOperator($sid, $userid);
            if (!$user) $error .= $otapilib->error_message;
            
            $user_account = $otapilib->GetAccountInfoForOperator($sid, $userid);
            if (!$user_account) $error .= $otapilib->error_message;

            include(TPL_DIR . 'users/accountinfo.php');
        } else {
            include(TPL_DIR . 'login.php');
        }
    }

    private function _generateFilters()
    {
        $xmlParams = new SimpleXMLElement('<UserFilterParameters></UserFilterParameters>');
        if (@$_GET['login']) $xmlParams->addChild('Login', @htmlspecialchars($_GET['login']));
        if (@$_GET['email']) $xmlParams->addChild('Email', $_GET['email']);
        if (@$_GET['isactive']) $xmlParams->addChild('IsActive', @$_GET['isactive']);

        if (@$_POST['sort_by'])
            $xmlParams->addChild('OrderBy', @$_POST['sort_by']);
        elseif (@$_GET['sort_by'])
            $xmlParams->addChild('OrderBy', @$_GET['sort_by']);

        return str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
    }

    private function _generateUserFields()
    {
        //var_dump(@$_POST);
        $xmlParams = new SimpleXMLElement('<UserUpdateData></UserUpdateData>');
        if (@$_POST['Id']) $xmlParams->addChild('Id', @htmlspecialchars(@$_POST['Id']));
        if (@$_POST['Email']) $xmlParams->addChild('Email', @$_POST['Email']);
        if (@$_POST['Login']) $xmlParams->addChild('Login', @$_POST['Login']);
		if (@$_POST['Password']) $xmlParams->addChild('Password', @$_POST['Password']);

		if (@$_POST['IsActive']) $xmlParams->addChild('IsActive', 'true');
        else $xmlParams->addChild('IsActive', 'false');

        if (@$_POST['FirstName']) $xmlParams->addChild('FirstName', @$_POST['FirstName']);
        if (@$_POST['LastName']) $xmlParams->addChild('LastName', @$_POST['LastName']);
        if (@$_POST['MiddleName']) $xmlParams->addChild('MiddleName', @$_POST['MiddleName']);
        if (@$_POST['Sex']) $xmlParams->addChild('Sex', @$_POST['Sex']);

        if (@$_POST['Country']) $xmlParams->addChild('Country', htmlspecialchars(@$_POST['Country']));
        if (@$_POST['City']) $xmlParams->addChild('City', htmlspecialchars(@$_POST['City']));
        if (@$_POST['Address']) $xmlParams->addChild('Address', htmlspecialchars(@$_POST['Address']));
        if (@$_POST['Phone']) $xmlParams->addChild('Phone', @$_POST['Phone']);
        if (@$_POST['PostalCode']) $xmlParams->addChild('PostalCode', @$_POST['PostalCode']);
        if (@$_POST['Region']) $xmlParams->addChild('Region', @$_POST['Region']);

        if (@$_POST['RecipientFirstName']) $xmlParams->addChild('RecipientFirstName', @$_POST['RecipientFirstName']);
        if (@$_POST['RecipientLastName']) $xmlParams->addChild('RecipientLastName', @$_POST['RecipientLastName']);
        if (@$_POST['RecipientMiddleName']) $xmlParams->addChild('RecipientMiddleName', @$_POST['RecipientMiddleName']);

        return str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
    }

    private function _getPageURL()
    {
        $pageurl = 'index.php?';

        $params = explode('&', $_SERVER['QUERY_STRING']);

        foreach ($params as $param) {
            @list($key, $value) = explode('=', $param);
            if (in_array($key, array('error', 'success', 'do', 'id'))) continue;

            $pageurl .= "&$key=$value";
        }

        return $pageurl;
    }

	function recoverpasswordAction()
	{
		if (Login::auth()) {
			global $otapilib;
			$sid = $_SESSION['sid'];
			$result = $otapilib->GetWebUISettings($sid);
			if ($otapilib->error_message == 'SessionExpired') {
				header('Location: index.php?expired');
				die;
			}
			$uid = intval($_GET['id']);
			$user = $otapilib->GetUserInfoForOperator($sid, $uid);
			$res = $this->recover($user['login']);
			if($res[0]){
				if (CFG_BUYINCHINA){
					$newPass = $otapilib->ConfirmPasswordRecovery($res[1]);
				} else {
					$code = $_SERVER['HTTP_HOST'].'/index.php?p=login&code='.$res[1];
				}
				if (file_exists(TPLCUSTOM_DIR.'users/recovery_email.php'))
					include(TPLCUSTOM_ABSOLUTE_PATH.'users/recovery_email.php');
				else
					include(TPL_ABSOLUTE_PATH.'users/recovery_email.php');
				$params['message'] = isset($message) ? $message : '';
				$params['email'] = $res[2];
				$params['subject'] = LangAdmin::get('pass_recovery');
				$this->sendEmail2($params);
			}

			header('Location: index.php?cmd=users&do=userinfo&id='.$uid);
			echo '<script>document.location.href="index.php?cmd=users&do=userinfo&id='.$uid.'";</script>';
			exit;
		} else {
			include(TPL_DIR . 'login.php');
		}
	}
	private function recover($userid){
		global $otapilib;
		$res = $otapilib->RequestPasswordRecovery($userid);
		if(!$res)
			return array(false, Lang::get('user_not_exist'));
		return array(true, $res['ConfirmationCode'], $res['Email']);
	}

}