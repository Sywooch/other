<?php

class Support extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'newmessage'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';
    private   $isAdmin = false;

    public function __construct()
    {
        parent::__construct(true);
    }

    private function xmlParams($fields){
        $xml = new SimpleXMLElement('<UserUpdateData></UserUpdateData>');
        $xml->addChild('Email', htmlspecialchars($fields['Email']));
        $xml->addChild('FirstName', htmlspecialchars($fields['FirstName']));
        $xml->addChild('LastName', htmlspecialchars($fields['LastName']));
        $xml->addChild('MiddleName', htmlspecialchars($fields['MiddleName']));
        $xml->addChild('Sex', htmlspecialchars($fields['Sex']));
        
        return $xml->asXML();
    }
    
    private function validateFields($fields){
        if(!$fields['Subject'])
            return array(false, Lang::get('put_message_subject'));
        if(!$fields['Text'])
            return array(false, Lang::get('not_entered_message_text'));
        if(!$fields['CategoryId'])
            return array(false, Lang::get('no_category_selected'));
        
        return false;
    }
    
    private function save($fields){
        global $otapilib;
        
        $error = $this->validateFields($fields);
        if($error) return $error;
        
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $user = $otapilib->GetUserInfo($sid);
        if($user === false){
            General::sessionExpiredHandle(false);
            return array(false, $otapilib->error_message, '');
        }
        
        $cms = new CMS();
        if($cms->Check()){
            $reg = $cms->createTicket((int)$user['Id'], $fields['SalesId'], $fields['CategoryId'], $fields['Subject'], $fields['Text']);
            if(!$reg){
                return array(false, Lang::get('ticket_add_error'), '');
            }
            if(!$this->isAdmin) {
                Notifier::notifyAdminOnNewTicket((int)$user['Id'], 0);
            }
        }
        else{
            return array(false, Lang::get('no_database'), '');
        }
        
        return array(true, Lang::get('data_updated_successfully'), (string)$reg);
    }
    
    private function newMessage(){
        global $otapilib;
        
        if(@$_POST['send']){
			//проверяем есть ли уже такой запрос и если что дописываем его
			//addToChat2($fields,$id)
			//id=4
			$id = $this->CheckChat($_POST);
			if ($id) {
				@list($success, $error, $res) = $this->addToChat2($_POST,$id);
			} else {
				@list($success, $error, $res) = $this->save($_POST);
			}            
            if(!$success){
                $this->tpl->assign('error', $error);
            }
            else{
                header('Location: index.php?p=support&mode=view');
                return true;
            }
        }
        $this->_template = 'newmessage';
        $orders = $otapilib->GetSalesOrdersList($_SESSION[CFG_SITE_NAME.'loginUserData']['sid'], 0);
        $this->tpl->assign('orders', $orders);
        
        $categories = $otapilib->GetTicketCatogories();
        $this->tpl->assign('cats', $categories);
    }
    
    private function viewMessages(){
        global $otapilib;
        
        $this->_template = 'viewmessages';
        $cms = new CMS();
        $status = $cms->Check();
		$arFilter=$this->SetFilter();
		if($status){
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $user = $otapilib->GetUserInfo($sid);
            $ticketlist = $cms->getTicketInfoList((int)$user['Id'],$arFilter);
			$categories = $otapilib->GetTicketCatogories();
			$orderList = $this->getOrderNumbers($user['Id']);
			$catNames = array();
			foreach ($categories as $category){
				$catNames[$category['CategoryId']] = $category['Name'];
			}
			$this->tpl->assign('catNames', $catNames);
		}
        else{
            $ticketlist = array();
			$orderList=array();
        }

		$this->tpl->assign('arOrderID', $orderList);
		$this->tpl->assign('ticketlist', $ticketlist);
	}
    
    private function chat(){
        global $otapilib;
        $this->checkChatAdding();
        $this->_template = 'chat';
        $cms = new CMS();
        $status = $cms->Check();
        if($status){
            $id = str_replace('Ticket-', '', $_GET['id']);
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $user = $otapilib->GetUserInfo($sid);
            $chat['TicketInfo'] = $cms->getTicketDetails((int)$user['Id'], $id);
            $chat['TicketMessageList'] = $cms->getTicketMessageList((int)$user['Id'], $id, false);
			if (empty ($user['LastName']))
				$name = $user['RecipientLastName'].' '.$user['RecipientFirstName'];
			else
				$name = $user['LastName'].' '.$user['FirstName'];
			$this->markRead($id, $cms, 'Out');
        }
        else{
            $chat = false;
            $this->tpl->assign('error', Lang::get('no_database'));
        }
        if(@$_SESSION['chat_success']){
            $this->tpl->assign('success', $_SESSION['chat_success']);
            unset($_SESSION['chat_success']);
        }
		$this->tpl->assign('name', $name);
		$this->tpl->assign('chat', $chat);
    }
    
    private function chatAdmin(){
        $setDirection = $this->checkChatAdding();
        $this->_template = 'chat';
        $cms = new CMS();
        $status = $cms->Check();
        if($status){
            global $otapilib;
            $sid = $_GET['sid'];
            $user = $otapilib->GetUserInfoForOperator($sid, $_GET['userid']);

            if($user === false){
                header('Location: admin/index.php?cmd=login');
                die();
            }

			if (empty ($user['LastName']))
				$name = $user['RecipientLastName'].' '.$user['RecipientFirstName'];
			else
				$name = $user['LastName'].' '.$user['FirstName'];
			$id = str_replace('Ticket-', '', $_GET['id']);
            $chat['TicketInfo'] = $cms->getTicketDetails($_GET['userid'], $id);
            $chat['TicketMessageList'] = $cms->getTicketMessageList($_GET['userid'], $id, false);
            $this->markRead($id, $cms, 'In',$setDirection);
        }
        else{
            $chat = false;
            $this->tpl->assign('error', Lang::get('no_database'));
        }
        if(@$_SESSION['chat_success']){
            $this->tpl->assign('success', $_SESSION['chat_success']);
            unset($_SESSION['chat_success']);
        }
		$this->tpl->assign('name', $name);
		$this->tpl->assign('user', $user);
		$this->tpl->assign('chat', $chat);
    }
    
    private function markRead($tid, $cms, $dir,$setDir = false){
		$cms->checkTable('site_support');
		if ($setDir)
			$setDir = ',`direction`="'.$setDir.'"';
		mysql_query('
            UPDATE `site_support` 
            SET `read`=1 '.$setDir.'
            WHERE 
                `direction`="'.$dir.'" 
                AND (`parent`="'.(int)$tid.'"
                OR `id`="'.(int)$tid.'")
            ');
    }
    
    private function checkChatAdding(){
        if(@$_POST['send']){
            list($success, $error) = $this->addToChat($_POST);
            if(!$success){
                $this->tpl->assign('error', $error);
            }
            else{
				$_SESSION['chat_success'] = Lang::get('message_was_added');
                header('Location: '.$_SERVER['REQUEST_URI']);
                die();
            }
			return '';
        }
		return 'Answer';
    }
    
    private function addToChat($fields){
        global $otapilib;

        if(!$fields['Text']) return array(false, Lang::get('was_not_entered_text_answer'), '');
        
        if(!$this->isAdmin) {
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $user = $otapilib->GetUserInfo($sid);
            $userid = (int)$user['Id'];
        }
        else{
            $userid = -100;
        }
        
        $id = str_replace('Ticket-', '', $_GET['id']);
        
        $cms = new CMS();
        $status = $cms->Check();
        if($status)
            $add = $cms->createTicketMessage($userid, $id, $fields['Text'], $this->isAdmin);
        else
            return array(false, Lang::get('no_database'), '');

        if($add){
			$this->markRead($id, $cms, 'Answer','Answered');
            if(!$this->isAdmin) {
                Notifier::notifyAdminOnNewTicket($userid, $id);
            }
			return array(true, Lang::get('data_updated_successfully'));
		}
        else
            return array(false, $add[1], '');
    }
	
	private function addToChat2($fields,$id){
        global $otapilib;

        if(!$fields['Text']) return array(false, Lang::get('was_not_entered_text_answer'), '');
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $user = $otapilib->GetUserInfo($sid);
        $userid = (int)$user['Id'];    
        
        
        $cms = new CMS();
        $status = $cms->Check();
        if($status)
            $add = $cms->createTicketMessage($userid, $id, $fields['Text'], $this->isAdmin);
        else
            return array(false, Lang::get('no_database'), '');

        if($add){
			$this->markRead($id, $cms, 'Answer','Answered');
            
			return array(true, Lang::get('data_updated_successfully'));
		}
        else
            return array(false, $add[1], '');
    }
	
    private function CheckChat($fields){		
		if ($fields['SalesId']=='') {
			return false;
			die();
		}
        $result = mysql_query("SELECT * FROM `site_support` WHERE `parent`=0");
		if (mysql_num_rows($result) == 0) {			
			return false;
		} else {
			while ($row = mysql_fetch_assoc($result)) {
				if (($row["orderid"]==$fields['SalesId']) and ($row["categoryid"]==$fields['CategoryId'])) {
					return $row["id"];					
					die();
				}				        		
    		}			
			return false;  
			
		}
		
	}
	
	
    protected function setVars()
    {
        switch (@$_GET['mode']){
            case 'new':
                General::sessionExpiredHandle(false);
                $orderId = @$_POST['SalesId'] ? $_POST['SalesId'] : @$_GET['SalesId'];
                
                $subject = '';
                if(@$_POST['Subject']){
                    $subject = @$_POST['Subject'];
                }
                elseif(@$_GET['type'] == 'moneyOut'){
                    $subject = Lang::get('cashout');
                }
                
                $categoryId = '';
                if(@$_POST['CategoryId']){
                    $categoryId = @$_POST['CategoryId'];
                }
                elseif(@$_GET['type'] == 'moneyOut'){
                    $categoryId = 'Common';
                }
                
                $this->tpl->assign('categoryId', $categoryId);
                $this->tpl->assign('subject', $subject);
                $this->tpl->assign('orderId', $orderId);
                $this->newMessage();
                break;
            case '':
            case 'view':
                global $otapilib;
                $otapilib->GetCountryInfoList();
                General::sessionExpiredHandle(false);
                $this->viewMessages();
                break;
            case 'chat':
                if($_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'] && !@$_GET['admin']){
                    General::sessionExpiredHandle(false);
                    $this->chat();
                }
                elseif(@$_GET['sid'] && @$_GET['admin']){
                    $this->isAdmin = true;
                    $this->chatAdmin();
                }
                break;
        }
        
    }
	private function getOrderNumbers($uid=false){
		$whereUID = '';
		if ($uid)
			$whereUID = ' AND `userid`='.$uid;
		$userTicketsQ = "
            SELECT distinct `orderid` FROM `site_support`
            WHERE  `parent`=0 $whereUID
            ";
		$cms = new CMS();
		$cms->Check();
		$result = mysql_query($userTicketsQ);
		$arOrderID=array(Lang::get('all'));
		while($t = mysql_fetch_assoc($result)){
			$t['orderid'] = trim($t['orderid']);
			if (!empty($t['orderid']))
				$arOrderID[] = $t['orderid'];
		}
		return $arOrderID;
	}
	private function SetFilter(){
		$arFilter=array();
		if (isset($_POST['clearFilter'])){
			$_SESSION['arSubFilter']['ticket_pub_order_number']=0;
			$_SESSION['arSubFilter']['ticket_pub_date_from']='';
			$_SESSION['arSubFilter']['ticket_pub_date_to']='';
			$_SESSION['arSubFilter']['ticket_pub_new']='';
		}
		elseif (isset($_POST['filter'])){
			if (!empty($_POST['ticket_pub_order_number'])){
				$arFilter['ticket_pub_order_number'] = $_POST['ticket_pub_order_number'];
				$_SESSION['arSubFilter']['ticket_pub_order_number'] = $_POST['ticket_pub_order_number'];
			}
			else
				$_SESSION['arSubFilter']['ticket_pub_order_number']=0;

			if (!empty($_POST['ticket_pub_date_from'])){
				$arFilter['ticket_pub_date_from'] = $_POST['ticket_pub_date_from'];
				$_SESSION['arSubFilter']['ticket_pub_date_from'] = $_POST['ticket_pub_date_from'];
			}
			else
				$_SESSION['arSubFilter']['ticket_pub_date_from']='';

			if (!empty($_POST['ticket_pub_date_to'])){
				$arFilter['ticket_pub_date_to'] = $_POST['ticket_pub_date_to'];
				$_SESSION['arSubFilter']['ticket_pub_date_to'] = $_POST['ticket_pub_date_to'];
			}
			else
				$_SESSION['arSubFilter']['ticket_pub_date_to']='';

			if (isset($_POST['ticket_pub_new'])){
				$arFilter['ticket_pub_new'] = $_POST['ticket_pub_new'];
				$_SESSION['arSubFilter']['ticket_pub_new'] = $_POST['ticket_pub_new'];
			}
			else
				$_SESSION['arSubFilter']['ticket_pub_new']='';
		}
		else{
			if (isset($_SESSION['arSubFilter']['ticket_pub_order_number']))
				$arFilter['ticket_pub_order_number'] = $_SESSION['arSubFilter']['ticket_pub_order_number'];
			if (isset($_SESSION['arSubFilter']['ticket_pub_date_from']))
				$arFilter['ticket_pub_date_from'] = $_SESSION['arSubFilter']['ticket_pub_date_from'];
			if (isset($_SESSION['arSubFilter']['ticket_pub_date_to']))
				$arFilter['ticket_pub_date_to'] = $_SESSION['arSubFilter']['ticket_pub_date_to'];
			if (isset($_SESSION['arSubFilter']['ticket_pub_new']))
				$arFilter['ticket_pub_new'] = $_SESSION['arSubFilter']['ticket_pub_new'];
		}
		if (!isset($_SESSION['arSubFilter']['ticket_pub_order_number'])){
			$_SESSION['arSubFilter']['ticket_pub_order_number'] = 0;
		}
		if (!isset($_SESSION['arSubFilter']['ticket_pub_new'])&&empty ($arFilter)){
			$arFilter['ticket_pub_new'] = 1;
		}
		return $arFilter;
	}
}

?>