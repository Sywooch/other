<?php

/**
 * Support system of site.
 * Functionality:
 * - view tickets
 * - write answers to tickets
 */
class Support extends GeneralUtil {
    public function defaultAction(){
        $this->checkAuth();
        $this->linkCms();

        $perpage = 20;
        $from = (isset($_GET['from'])) ? $_GET['from'] : 0;
		
		$perpage_t2 = 20;
        $from_t2 = (isset($_GET['from_t2'])) ? $_GET['from_t2'] : 0;
		
        $tickets = $this->showTickets(0, $from, $perpage);

        chdir(ADMIN_ABSOLUTE_PATH);
        include TPL_DIR.'support.php';
    }

    private function showTickets($userid = 0, $from = 0, $perpage = 20){
        global $otapilib;
        $categories = $otapilib->GetTicketCatogories();
        $catNames = array();
        foreach ($categories as $category){
            $catNames[$category['CategoryId']] = $category['Name'];
        }
        $arFilter=$this->SetFilter();

        $result = $this->getSearchTicketsQ(@$_SESSION['arSubFilter']['ticket_user_id'], $from, $perpage,$arFilter);
        $sid = $_SESSION['sid'];
        $userList = $this->getUsers($sid);
        $orderList = $this->getOrderNumbers(@$_SESSION['arSubFilter']['ticket_user_id']);
        $tickets = array();
        if(!$result) return array(
            'totalcount' => 0,
            'filterUserList' => $userList,
            'filterOrderList' => $orderList,
            'content'    => $tickets
        );
        while($t = mysql_fetch_assoc($result)){

            $unreadCount = $this->cms->getTicketMessagesCount($t['id'], 'In', 0);
            if(!$t['read']) $unreadCount++;
            $orderid = $t['orderid'] ?  $t['orderid'] : '';
            $tickets[] = array(
                'id' => $t['id'],
                'order_id' => $t['orderid'],
                'category' => @$catNames[$t['categoryid']],
                'subject' => $t['subject'],
                'orderid' => $orderid,
                'ticketid' => 'Ticket-'.$t['id'],
                'createddate' => date('Y-m-d H:i', $t['added']),
                'msgcount' => $this->cms->getTicketMessagesCount($t['id'])+1,
				'notAnswered' => $t['direction']=='Answer'||($t['direction']=='In'&&$unreadCount>0),
                'newmsgcount' => $unreadCount,
                'user' => $userList[$t['userid']]
            );
        }
        return array(
            'totalcount' => $this->getTicketsCountQ($userid, $from, $perpage),
            'filterUserList' => $userList,
            'filterOrderList' => $orderList,
            'content'    => $tickets
        );
    }

    private function getSearchTicketsQ($userid, $from, $perpage,$arFilter){
        $where = array();
        if ($userid)
            $where[] = "`s`.`userid`='$userid'";
        if (array_key_exists('ticket_order_number',$arFilter)&&!empty($arFilter['ticket_order_number']))
            $where[] = "`s`.`orderid` like '%".$arFilter['ticket_order_number']."%'";
        if (array_key_exists('ticket_date_from',$arFilter)&&!empty($arFilter['ticket_date_from']))
            $where[] = "`s`.`added`>".strtotime($arFilter['ticket_date_from']);
        if (array_key_exists('ticket_date_to',$arFilter)&&!empty($arFilter['ticket_date_to']))
            $where[] = "`s`.`added`<".strtotime($arFilter['ticket_date_to']);
        if (array_key_exists('ticket_new',$arFilter)&&!empty($arFilter['ticket_new']))
            $where[] = "(`s`.`direction`='Answer' OR `s`.read=0)";

        if (!empty($where))
            $whereUser = implode(' AND ',$where).' AND ';
        else
            $whereUser='';
		/*
        $userTicketsQ = "
            SELECT * FROM `site_support` as s
            WHERE $whereUser `parent`=0
            ORDER BY `added` DESC
            LIMIT $from, $perpage
            ";
		*/
		$userTicketsQ = "
            SELECT * FROM `site_support` as s
            WHERE $whereUser `parent`=0
            ORDER BY `added` DESC";
        $result = mysql_query($userTicketsQ);
        return $result;
    }

    private function getTicketsCountQ($userid, $from, $perpage){
        $whereUser = $userid ? "`userid`='$userid' AND " : '';

        $userTicketsQ = "
            SELECT COUNT(*) FROM `site_support` 
            WHERE $whereUser `parent`=0
            ORDER BY `added` DESC
            ";
        $cms = new CMS();
        $cms->Check();
        $result = mysql_query($userTicketsQ);
        return $result ? mysql_result($result, 0) : 0;
    }
    private function getUsers($sid){
        global $otapilib;
        $userTicketsQ = "
            SELECT distinct `userid` FROM `site_support`
            WHERE  `parent`=0
            ";
        $cms = new CMS();
        $cms->Check();

        if(defined('CFG_MULTI_CURL') && CFG_MULTI_CURL){
            $result = mysql_query($userTicketsQ);
            $otapilib->InitMulti();
            while($t = mysql_fetch_assoc($result)){
                $otapilib->GetUserInfoForOperator($sid, $t['userid']);
            }
            $otapilib->MultiDo();
        }

        $result = mysql_query($userTicketsQ);
        $arResult=array(array('Id'=>0,'Login'=>LangAdmin::get('all')));
        while($t = mysql_fetch_assoc($result)){
            $arResult[$t['userid']] = $otapilib->GetUserInfoForOperator($sid, $t['userid']);
        }

        if(defined('CFG_MULTI_CURL') && CFG_MULTI_CURL){
            $otapilib->StopMulti();
        }

        return $arResult;

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
        $arOrderID=array(LangAdmin::get('all'));
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
            $_SESSION['arSubFilter']['ticket_order_number']=0;
            $_SESSION['arSubFilter']['ticket_date_from']='';
            $_SESSION['arSubFilter']['ticket_date_to']='';
            $_SESSION['arSubFilter']['ticket_user_id']=false;
            $_SESSION['arSubFilter']['ticket_new']='';
        }
        elseif (isset($_POST['filter'])){
            if (!empty($_POST['ticket_order_number'])){
                $arFilter['ticket_order_number'] = $_POST['ticket_order_number'];
                $_SESSION['arSubFilter']['ticket_order_number'] = $_POST['ticket_order_number'];
            }
            else
                $_SESSION['arSubFilter']['ticket_order_number']=0;

            if (!empty($_POST['ticket_date_from'])){
                $arFilter['ticket_date_from'] = $_POST['ticket_date_from'];
                $_SESSION['arSubFilter']['ticket_date_from'] = $_POST['ticket_date_from'];
            }
            else
                $_SESSION['arSubFilter']['ticket_date_from']='';

            if (!empty($_POST['ticket_date_to'])){
                $arFilter['ticket_date_to'] = $_POST['ticket_date_to'];
                $_SESSION['arSubFilter']['ticket_date_to'] = $_POST['ticket_date_to'];
            }
            else
                $_SESSION['arSubFilter']['ticket_date_to']='';

            if (!empty($_POST['ticket_user_id'])){
                $arFilter['ticket_user_id'] = $_POST['ticket_user_id'];
                $_SESSION['arSubFilter']['ticket_user_id'] = $_POST['ticket_user_id'];
            }
            else
                $_SESSION['arSubFilter']['ticket_user_id']=false;

            if (isset($_POST['ticket_new'])){
                $arFilter['ticket_new'] = $_POST['ticket_new'];
                $_SESSION['arSubFilter']['ticket_new'] = $_POST['ticket_new'];
            }
            else
                $_SESSION['arSubFilter']['ticket_new']='';
        }
        else{
            if (isset($_SESSION['arSubFilter']['ticket_order_number']))
                $arFilter['ticket_order_number'] = $_SESSION['arSubFilter']['ticket_order_number'];
            if (isset($_SESSION['arSubFilter']['ticket_date_from']))
                $arFilter['ticket_date_from'] = $_SESSION['arSubFilter']['ticket_date_from'];
            if (isset($_SESSION['arSubFilter']['ticket_date_to']))
                $arFilter['ticket_date_to'] = $_SESSION['arSubFilter']['ticket_date_to'];
            if (isset($_SESSION['arSubFilter']['ticket_user_id']))
                $arFilter['ticket_user_id'] = $_SESSION['arSubFilter']['ticket_user_id'];
            if (isset($_SESSION['arSubFilter']['ticket_new']))
                $arFilter['ticket_new'] = $_SESSION['arSubFilter']['ticket_new'];
        }
        if (!isset($_SESSION['arSubFilter']['ticket_order_number'])){
            $_SESSION['arSubFilter']['ticket_order_number'] = 0;
        }
        if (!isset($_SESSION['arSubFilter']['ticket_new'])&&empty ($arFilter)){
            $arFilter['ticket_new'] = 1;
        }
        return $arFilter;
    }
}

?>
