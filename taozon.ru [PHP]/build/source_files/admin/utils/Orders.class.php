<?php

class Orders extends GeneralUtil {

    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'orders';
    protected $_template_path = 'orders/';

    public $error = '';

    function defaultAction()
    {
        global $otapilib;
        $this->checkAuth();

        $perPage = (isset($_GET['ps'])) ? $_GET['ps'] : 20;
        $pageNum = (isset($_GET['p'])) ? $_GET['p'] : 1;

        $sort = isset($_GET['sort']) ? $_GET['sort'] : array();
        $filter = isset($_GET['filter']) ? $_GET['filter'] : array();
		$filterState=false;

		if (defined('CFG_BUYINCHINA')){
			if (isset($filter['status'])&&$filter['status']==-1) {
				$filterState=$filter['status'];
				unset ($filter['status']);
			}
		}

        $xml =  $this->getOrderSearchParameters($sort, $filter);

        if (CFG_MULTI_CURL)
        {
            // Инициализируем
            $otapilib->InitMulti();
            if ($filterState!==false)
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml,0,1000);
            else
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml, ($pageNum-1)*$perPage, $perPage);
            if (!isset($_SESSION['$status_list']))
            {
                $status_list = $otapilib->GetOrderStatusList($_SESSION['sid']);
            }
            // Делаем запросы
            $otapilib->MultiDo();
            if ($filterState!==false)
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml,0,1000);
            else
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml, ($pageNum-1)*$perPage, $perPage);
            $status_list = $otapilib->GetOrderStatusList($_SESSION['sid']);
            // Сбрасываем
            $otapilib->StopMulti();
        } else {
            if ($filterState!==false)
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml,0,1000);
            else
                    $orders = $otapilib->SearchOrders($_SESSION['sid'], $xml, ($pageNum-1)*$perPage, $perPage);
            $status_list = $otapilib->GetOrderStatusList($_SESSION['sid']);
        }
		if (defined('CFG_BUYINCHINA')){
			if ($filterState!==false){
				$arOrders=array();
				foreach ($orders['Content'] as $order) {
					if (strpos($order['StatusName'],'Ожидает оплаты')===false)
						$arOrders[] = $order;
				}
				$orders['Content'] = $arOrders;
				$orders['TotalCount'] = count($orders['Content']);
				$orders['Content'] = array_slice($orders['Content'], ($pageNum-1)*$perPage, $perPage);
			}
			$status_list[]=array(
				'id'=>-1,
				'Id'=>-1,
				'name'=>LangAdmin::get('except_awaiting_payment'),
				'Name'=>LangAdmin::get('except_awaiting_payment')
			);
		}
        if($orders === false){
            $orders = array();
            $orders['Content'] = $otapilib->GetSalesOrdersListForOperator($_SESSION['sid'], '<OrderFilter></OrderFilter>');
            $orders['TotalCount'] = count($orders['Content']);
            $orders['Content'] = array_slice($orders['Content'], ($pageNum-1)*$perPage, $perPage);
        }
        $pageurl = $this->_getPageURL();
        $onRenderFilterOrdersForm = Plugins::onRenderFilterOrdersForm();
        $onRenderNotificationForm = Plugins::onRenderNotificationForm();
        $pagination = Pagination::getPages((float)$orders['TotalCount'], $perPage, $pageNum);
        
        $orders = isset($orders['Content']) ? $orders['Content'] : array();
        
        $this->tpl->assign('pageurl', $pageurl);
        $this->tpl->assign('orders', Permission::filter_orders($orders));
        $this->tpl->assign('error', isset($error)?$error:'');
        $this->tpl->assign('status_list', $status_list);
        $this->tpl->assign('onRenderFilterOrdersForm', $onRenderFilterOrdersForm);
        $this->tpl->assign('onRenderNotificationForm', $onRenderNotificationForm);
        $this->tpl->assign('sorting', isset($_GET['sort']) ? $_GET['sort'] : array());
        $this->tpl->assign('perpage', $perPage);
        $this->tpl->assign('pagination', $pagination);

        print $this->fetchTemplate();
    }

    private function prepareDateForFilter($date, $last = false){
        $time = strtotime($date);
        if ($last)
        {
            return date("Y-m-d\T23:59:59", $time);
        } else {
            return date("Y-m-d\T00:00:00", $time);
        }
    }

    private function getOrderSearchParameters($sort, $filters){
        $xml = new SimpleXMLElement('<OrderSearchParameters></OrderSearchParameters>');

        if(isset($filters['fromdate']) && $filters['fromdate'])
            $xml->addChild('CreationDateFrom', $this->prepareDateForFilter($filters['fromdate']));
        if(isset($filters['todate']) && $filters['todate'])
            $xml->addChild('CreationDateTo', $this->prepareDateForFilter($filters['todate'], true));
        if(isset($filters['status']) && $filters['status'])
            $xml->addChild('StatusId', $filters['status']);
        if(isset($filters['number']) && $filters['number'])
            $xml->addChild('Id', $filters['number']);
        if(isset($filters['client_surname']) && $filters['client_surname'])
            $xml->addChild('RecipientLastName', htmlspecialchars($filters['client_surname']));

        $filtersArray = array();
        foreach($sort as $sortName => $sortVal){
            $filtersArray[] = $sortName.':'.$sortVal;
        }
        $xml->addChild('OrderBy', implode(';', $filtersArray));

        return $xml->asXML();
    }

    function orderinfoAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $error = '';
            $order_info = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 0);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            if(!$order_info) $error .= $otapilib->error_message;

            $cms = new CMS();
            $cms->Check();
            $orderUnreadTicketsQ = "
                SELECT COUNT(*) FROM `site_support`
                WHERE `orderid`='".$order_info['SalesOrderInfo']['Id']."' AND `read`=0 AND `direction`='In'
                ORDER BY `added` DESC
                ";
            $unread = @mysql_result(mysql_query($orderUnreadTicketsQ), 0);

            $orderReadTicketsQ = "
                SELECT COUNT(*) FROM `site_support`
                WHERE `orderid`='".$order_info['SalesOrderInfo']['Id']."' AND `direction`='In'
                ORDER BY `added` DESC
                ";

            $total = @mysql_result(mysql_query($orderReadTicketsQ), 0);

            $order_info['total_tickets'] = $total;
            $order_info['unread_tickets'] = $unread;

            $usedStatusList = array();
			$filteredSalesLinesList  = array();
			if (CFG_MULTI_CURL)
            {
                // Инициализируем
                $otapilib->InitMulti();

                if(@$order_info['salesorderinfo']['custid']) {
                    $user_account = $otapilib->GetAccountInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
                    if(!$user_account) $error .= $otapilib->error_message;
                }
                foreach($order_info['saleslineslist'] as $item)
                {
                    $otapilib->GetLineAvailableStatusList($sid, $id, $item['id']);
                    break;
                }
                $package_list = $otapilib->GetSalesPackageList($sid, $id);

                // Делаем запросы
                $otapilib->MultiDo();

                if(@$order_info['salesorderinfo']['custid']) {
                    $user_account = $otapilib->GetAccountInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
                    if(!$user_account) $error .= $otapilib->error_message;
                }
                $status_list = array();
                $r = false;
                foreach($order_info['saleslineslist'] as $item)
                {
                    if (!$r) $r = $otapilib->GetLineAvailableStatusList($sid, $id, $item['id']);
                    $status_list[$item['id']] = $r;
					if (defined('CFG_BUYINCHINA')){
						if (!empty($item['StatusName'])&&!in_array($item['StatusName'],$usedStatusList))
							$usedStatusList[] = $item['StatusName'];
						if (isset($_GET['filter']['state'])&&!empty($_GET['filter']['state'])&&$_GET['filter']['state']!==$item['StatusName'])
							continue;
						$filteredSalesLinesList[] = $item;
					}
				}
				if (defined('CFG_BUYINCHINA')){$order_info['saleslineslist']=$filteredSalesLinesList;}
                $package_list = $otapilib->GetSalesPackageList($sid, $id);
                if(!$package_list) $error .= $otapilib->error_message;

                // Сбрасываем
                $otapilib->StopMulti();
            } else {
                if(@$order_info['salesorderinfo']['custid']) {
                    $user_account = $otapilib->GetAccountInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
                    if(!$user_account) $error .= $otapilib->error_message;
                }
                $status_list = array();
                $r = false;
				foreach($order_info['saleslineslist'] as $item)
				{
					if (!$r) $r = $otapilib->GetLineAvailableStatusList($sid, $id, $item['id']);
					$status_list[$item['id']] = $r;
					if (defined('CFG_BUYINCHINA')){
						if (!empty($item['StatusName'])&&!in_array($item['StatusName'],$usedStatusList))
							$usedStatusList[] = $item['StatusName'];
						if (isset($_GET['filter']['state'])&&!empty($_GET['filter']['state'])&&$_GET['filter']['state']!==$item['StatusName'])
							continue;
						$filteredSalesLinesList[] = $item;
					}
				}
				if (defined('CFG_BUYINCHINA')){$order_info['saleslineslist']=$filteredSalesLinesList;}
				$package_list = $otapilib->GetSalesPackageList($sid, $id);
                if(!$package_list) $error .= $otapilib->error_message;
            }
			if (defined('CFG_BUYINCHINA')){
				$currency_list = $otapilib->GetCurrencyList($sid);
				$currency_settings = $otapilib->GetInstanceCurrenciesSettings($sid);
				$course=0;
				foreach ($currency_settings['CurrencyRateList'] as $courseData){
					if ($courseData['FirstCode']==$user_account['CurrencyCodeCust'] && $courseData['SecondCode']=='CNY')
						$course = (float)$courseData['Rate'];
					if ($courseData['FirstCode']==$order_info['salesorderinfo']['CurrencyCode'] && $courseData['SecondCode']=='CNY')
						$courseForOrder = (float)$courseData['Rate'];
				}
				foreach ($currency_list as $data){
					if ($data['Code']=='CNY'){
						$user_account['availablecustCNYsign'] = $data['Sign'];
						$user_account['AvailableCustCNYsign'] = $data['Sign'];
						$order_info['salesorderinfo']['CNYsign'] = $data['Sign'];
						$CNYsign = $data['Sign'];
						break;
					}
				}
				if (@$courseForOrder!=0){
					$caseSettings = $otapilib->GetShowcase($sid);
					$order_info['salesorderinfo']['GoodsAmountCNY'] = $order_info['salesorderinfo']['goodsamountCNY'] =
						(float)$order_info['salesorderinfo']['GoodsAmount']*$courseForOrder;
					if (isset($caseSettings->Settings->MarginPercentage))
						$order_info['salesorderinfo']['GoodsAmountCNY'] = $order_info['salesorderinfo']['goodsamountCNY'] =
							$order_info['salesorderinfo']['GoodsAmountCNY']/(100+(float)$caseSettings->Settings->MarginPercentage)*100;
					$order_info['salesorderinfo']['DeliveryAmountCNY'] = $order_info['salesorderinfo']['deliveryamountCNY'] =
						(float)$order_info['salesorderinfo']['DeliveryAmount']*$courseForOrder;
					$order_info['salesorderinfo']['TotalAmountCNY'] = $order_info['salesorderinfo']['totalamountCNY'] =
						$order_info['salesorderinfo']['deliveryamountCNY']+$order_info['salesorderinfo']['goodsamountCNY'];
				}
				if ($course!=0){
					$user_account['availablecustCNY'] = $user_account['availablecust']*$course;
					$user_account['AvailableCustCNY'] = $user_account['AvailableCust']*$course;
				}
			}
			//====================================Переписка с пользователм ================================
			//получае весь спислк тикетов этого пользователя
			$ticketid = -1;
			$cms = new CMS();
        	$status = $cms->Check();
			$arFilter=$this->SetFilter();
			if($status){            	
            	$ticketlist = $cms->getTicketInfoList($order_info['salesorderinfo']['custid'],$arFilter);
				foreach ($ticketlist as $item){
					if (($item['OrderId']==$order_info['salesorderinfo']['id']) and ($item['CategoryId']=='Common')) {
						$ticketid = $item['ticketid'];
					}
				}
				
			}        	
			if ($ticketid==-1) {  
				if(@$_POST['send']){
					//Если отпрвили форму сохраняем					
        			if($status){
            			$cms->createTicket($order_info['salesorderinfo']['custid'], $_POST['SalesId'], $_POST['CategoryId'], $_POST['Subject'], $_POST['Text']); 						
						header('Location: index.php?sid='.$sid.'&cmd=orders&do=orderinfo&id='.$order_info['salesorderinfo']['id'].'#tabs-5');          		
       				}
            	} else {
                	//Еси чата еще нет        
            		$subjectChat = 'Заказ';
					$categoryIdChat = 'Common';
            	}			    
				
			} else {
				//Выводим переписку
				if(@$_POST['send']) {            		
					if($status){
						$id = str_replace('Ticket-', '', $ticketid);
            			$cms->createTicketMessage($order_info['salesorderinfo']['custid'], $id, $_POST['Text'], 'true');		
						header('Location: index.php?sid='.$sid.'&cmd=orders&do=orderinfo&id='.$order_info['salesorderinfo']['id'].'#tabs-5');				
					}            		
        		} else {
					if($status){
            			$id = str_replace('Ticket-', '', $ticketid);
            			$chat['TicketMessageList'] = $cms->getTicketMessageList($order_info['salesorderinfo']['custid'], $id, false);						
        			}
				}
				
			}			
			//=============================================================================================
			$pageurl = $this->_getPageURL();

            $tab_number = (isset($_GET['tab'])) ? $_GET['tab'] : 1;

            if(isset($_GET['error'])) $error = $_GET['error'];

            include(TPL_ABSOLUTE_PATH.'orders/order.php');

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }
	function printpackageAction()
	{
		if (Login::auth())
		{
			global $otapilib;
			$id = @$_GET['id'];
			$sid = $_SESSION['sid'];
			$error = '';
			$order_info = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 0);
			if ($otapilib->error_message == 'SessionExpired')
			{
				header('Location: index.php?expired');
				die;
			}
			if(!$order_info) $error .= $otapilib->error_message;

			if (CFG_MULTI_CURL)
			{
				// Инициализируем
				$otapilib->InitMulti();

				if(@$order_info['salesorderinfo']['custid']) {
					$user_info = $otapilib->GetUserInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
					if(!$user_info) $error .= $otapilib->error_message;
				}
				$package_list = $otapilib->GetSalesPackageList($sid, $id);

				// Делаем запросы
				$otapilib->MultiDo();

				if(@$order_info['salesorderinfo']['custid']) {
					$user_info = $otapilib->GetUserInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
					if(!$user_info) $error .= $otapilib->error_message;
				}
				$package_list = $otapilib->GetSalesPackageList($sid, $id);
				if(!$package_list) $error .= $otapilib->error_message;

				// Сбрасываем
				$otapilib->StopMulti();
			} else {
				if(@$order_info['salesorderinfo']['custid']) {
					$user_info = $otapilib->GetUserInfoForOperator($sid, $order_info['salesorderinfo']['custid']);
					if(!$user_info) $error .= $otapilib->error_message;
				}
				$package_list = $otapilib->GetSalesPackageList($sid, $id);
				if(!$package_list) $error .= $otapilib->error_message;
			}
			$pid = $_GET['pid'];

			if(isset($_GET['error'])) $error = $_GET['error'];

			include(TPL_ABSOLUTE_PATH.'orders/printshipping.php');

		} else {
			include(TPL_ABSOLUTE_PATH.'login.php');
		}
	}

	function cancelAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            /*
            $result = $otapilib->GetWebUISettings($sid);
            */
            $order_info_1 = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            $r = $otapilib->CancelSalesOrderForOperator($sid, $id);

            if(!$r){
                $error = LangAdmin::get('error').': ' . $otapilib->error_message;
            } else {
                $success = 'Заказ '.$id. ' отменен.';

                $order_info_2 = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
                if(!$order_info_2) $error = $otapilib->error_message;

                if($order_info_1['salesorderinfo']['statuscode'] != $order_info_2['salesorderinfo']['statuscode']) {
                    Users::sendEmailChangeStatus($order_info_1['salesorderinfo']['statusname'], $order_info_2['salesorderinfo']['statusname'], $order_info_1['salesorderinfo']['custid'], $id);
                }
            }

            $orders = $otapilib->GetSalesOrdersListForOperator($sid, '');
            if(!$orders) $error = $otapilib->error_message;

            $operator_list = $otapilib->GetSalesOperatorInfoList($sid);
            if(!$operator_list) $error .= $otapilib->error_message;

            if(isset($_GET['filter']))
            {
                //var_dump($_GET['filter']); die;
                $orders = $this->_filterOrders($orders, $_GET['filter']);
            }

            $orders  = array_reverse($orders);
            $pageurl = $this->_getPageURL();

            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function cancelitemAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $orderid = $_GET['id'];
        $itemid  = $_GET['itemid'];
        $r = $otapilib->CancelLineSalesOrderForOperator($sid, $orderid, $itemid);
        if(!$r) print $otapilib->error_message;
            else print 'Ok';
        die;
    }

    function separateAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $orderid = $_GET['id'];
        $itemid  = $_GET['itemid'];
        $qty     = $_GET['separate'];

        $xmlSplitData ='<OrderLineSplitData>';
        $xmlSplitData.= "<SeparatedItemsCount>{$qty}</SeparatedItemsCount>";
        $xmlSplitData.='</OrderLineSplitData>';

        $r = $otapilib->SplitOrderLineForOperator($sid, $orderid, $itemid, $xmlSplitData);

        if ($otapilib->error_message == 'SessionExpired') {
                print "RELOGIN";
                die;
        }
        if(!$r) print $otapilib->error_message;
        else print 'Ok';

        die;
    }
    
    function setadditionalAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $orderid = $_GET['id'];
        $additional  = $_GET['additional'];

        $xmlUpdateData = "<OrderUpdateData>";
        $xmlUpdateData.= "<AdditionalInfo>{$additional}</AdditionalInfo>";
        $xmlUpdateData.= "</OrderUpdateData>";

        $r = $otapilib->UpdateOrderForOperator($sid, $orderid, $xmlUpdateData);

        if ($otapilib->error_message == 'SessionExpired') {
                print "RELOGIN";
                die;
        }
        if(!$r) print $otapilib->error_message;
        else print 'Ok';

        die;
    }

    function changeweightAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $orderid = $_GET['id'];
        $weight  = $_GET['new_weight'];
        $xmlUpdateData = "<OrderUpdateData><Weight>{$weight}</Weight></OrderUpdateData>";

        $r = $otapilib->UpdateOrderForOperator($sid, $orderid, $xmlUpdateData);

        if ($otapilib->error_message == 'SessionExpired') {
                print "RELOGIN";
                die;
        }
        if(!$r) print $otapilib->error_message;
        else print 'Ok';

        die;
    }

    function closeAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $r = $otapilib->CloseSalesOrderForOperator($sid, $id);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }

            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function closecancelAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $r = $otapilib->CloseCancelSalesOrderForOperator($sid, $id);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }

            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function restoreAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $r = $otapilib->RestoreSalesOrderForOperator($sid, $id);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            header('Location: '.$_SERVER['HTTP_REFERER']);
            die();
        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function changestatusAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        if (!isset($_SESSION['sid'])) {
            echo 'RELOGIN';
            die;
        }
        $sid = @$_SESSION['sid'];
        $orderid = $_GET['id'];
        $itemid  = $_GET['itemid'];
        $status  = $_GET['status'];
        $comment = $_GET['comment'];
        $quantity = (int)$_GET['qty'];
        $taobaoid = isset($_GET['taobaoid']) ? $_GET['taobaoid'] : '';
        
        $status_name_cur  = isset($_GET['status_cur']) ? $_GET['status_cur'] : '';
        $status_name_new  = isset($_GET['status_new']) ? $_GET['status_new'] : '';

        $order_info_1 = $otapilib->GetSalesOrderDetailsForOperator($sid, $orderid, '', 1);
        
        $r = $otapilib->ChangeLineStatus($sid, $orderid, $itemid, $status, $comment, $quantity);
        if ($otapilib->error_message == 'SessionExpired') {
            echo 'RELOGIN';
            die;
        }

        if(!$r) print $otapilib->error_message;
        else {
            if ($status_name_cur != $status_name_new) {
                $user_id = $order_info_1['salesorderinfo']['custid'];
                Users::sendEmailChangeStatus($status_name_cur, $status_name_new, 
                        $user_id, $orderid, $taobaoid);
            }
            print 'Ok';
        }
        die;
    }

    function changepriceAction()
    {
        global $otapilib;
        @define('NO_DEBUG', true);
        if (!isset($_SESSION['sid'])) {
            echo 'RELOGIN';
            die;
        }
        $sid = @$_SESSION['sid'];
        $orderid = $_GET['id'];
        $itemid  = $_GET['itemid'];
        $new_price  = $_GET['new_price'];

        $LineData = '<OrderLineUpdateData><InternalPrice>'.$new_price.'</InternalPrice><StatusId>3</StatusId></OrderLineUpdateData>';
        $r = $otapilib->UpdateOrderLineForOperator($sid, $orderid, $itemid, $LineData);
        if ($otapilib->error_message == 'SessionExpired') {
            echo 'RELOGIN';
            die;
        }

        if(!$r) print $otapilib->error_message;
            else print 'Ok';
        die;
    }

    function makepackageAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            
            //$order_info = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 0);
            //if(!$order_info) $error .= $otapilib->error_message;
            //$delivery_models = $otapilib->GetDeliveryModesWithPrice('RU', (float)$order_info['salesorderinfo']['packagesweight']);
            $delivery_models = $otapilib->GetDeliveryModesWithPrice('RU', 0);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            if(!$delivery_models) $error .= $otapilib->error_message;

            $pageurl = $this->_getPageURL();

            $tab_number = 3;
            $action = 'createpackage';

            include(TPL_ABSOLUTE_PATH.'orders/order.php');

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function savenewpackageAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $user = @$_GET['user'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            
            $r = $otapilib->CreatePackage($sid, $id);
            if(!$r) {
                $error .= $otapilib->error_message;
                header('location:index.php?sid=&cmd=orders&do=orderinfo&id='.$id);
            } else {
                Users::sendEmailCreatePackage($user, $id, $r['id']);
                header('location:index.php?cmd=orders&do=packageinfo&id='.$id.'&new&pid='.$r['id']);
            }

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function deletepackageAction()
    {

        global $otapilib;
        @define('NO_DEBUG', true);
        $sid = $_SESSION['sid'];
        $id = $_GET['id'];

        $r = $otapilib->DeletePackage($sid, $id);

        if(!$r) print $otapilib->error_message;
        else print 'Ok';

        die;
    }

    function packageinfoAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $pid = @$_GET['pid'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            $order_info = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 0);
            if(!$order_info) $error .= $otapilib->error_message;
            if (CFG_MULTI_CURL)
            {
                // Инициализируем
                $otapilib->InitMulti();

                $delivery_models = $otapilib->GetDeliveryModesWithPrice('RU', (float)$order_info['salesorderinfo']['packagesweight']);
                $package_info = $otapilib->GetPackage($sid, $pid);
                $processlog = $otapilib->GetSalesProcessLog($sid, $id);
                $statuses = $otapilib->GetPackageAvailableStatusList($sid, $pid);

                // Делаем запросы
                $otapilib->MultiDo();

                $delivery_models = $otapilib->GetDeliveryModesWithPrice('RU', (float)$order_info['salesorderinfo']['packagesweight']);
                if(!$delivery_models) $error .= $otapilib->error_message;
                $package_info = $otapilib->GetPackage($sid, $pid);
                if(!$package_info) $error .= $otapilib->error_message;
                $processlog = $otapilib->GetSalesProcessLog($sid, $id);
                //if(!$processlog) $error .= ' || GetSalesProcessLog: '.$otapilib->error_message;
                $statuses = $otapilib->GetPackageAvailableStatusList($sid, $pid);
                if(!$statuses) $error .= ' || GetPackageAvailableStatusList: '.$otapilib->error_message;

                // Сбрасываем
                $otapilib->StopMulti();
            } else {
                $delivery_models = $otapilib->GetDeliveryModesWithPrice('RU', (float)$order_info['salesorderinfo']['packagesweight']);
                if(!$delivery_models) $error .= $otapilib->error_message;
                $package_info = $otapilib->GetPackage($sid, $pid);
                if(!$package_info) $error .= $otapilib->error_message;
                $processlog = $otapilib->GetSalesProcessLog($sid, $id);
                //if(!$processlog) $error .= ' || GetSalesProcessLog: '.$otapilib->error_message;
                $statuses = $otapilib->GetPackageAvailableStatusList($sid, $pid);
                if(!$statuses) $error .= ' || GetPackageAvailableStatusList: '.$otapilib->error_message;
            }

            //var_dump($statuses);
            $pageurl = $this->_getPageURL();
            //var_dump($package_info); die;
            $tab_number = 3;
            $action = 'editpackage';
            $new_package = (isset($_GET['new'])) ? true : false;
            include(TPL_ABSOLUTE_PATH.'orders/order.php');
        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function updatepackageAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $pid = @$_GET['pid'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            if (CFG_MULTI_CURL)
            {
                // Инициализируем
                $otapilib->InitMulti();

                $otapilib->UpdatePackage($sid, $pid, $this->_generatePackageFields());
                if ($_POST['status'] != $_POST['old_status']) $otapilib->ChangePackageStatus($sid, $pid, $_POST['status'], date('d.m.Y'), '');

                // Делаем запросы
                $otapilib->MultiDo();

                $r = $otapilib->UpdatePackage($sid, $pid, $this->_generatePackageFields());
                if(!$r) $error .= $otapilib->error_message;
                if ($_POST['status'] != $_POST['old_status'])
                {
                    $r = $otapilib->ChangePackageStatus($sid, $pid, $_POST['status'], date('d.m.Y'), '');
                    if(!$r) $error .= $otapilib->error_message;
                }

                // Сбрасываем
                $otapilib->StopMulti();
            } else {
                $r = $otapilib->UpdatePackage($sid, $pid, $this->_generatePackageFields());
                if(!$r) $error .= $otapilib->error_message;
                if ($_POST['status'] != $_POST['old_status'])
                {
                    $r = $otapilib->ChangePackageStatus($sid, $pid, $_POST['status'], date('d.m.Y'), '');
                    if(!$r) $error .= $otapilib->error_message;
                }
            }
            $message = ($error) ? '&error='.$error : '';

            header('Location: index.php?cmd=orders&do=orderinfo&id='.$id.'&tab=3'.$message);
            include(TPL_ABSOLUTE_PATH.'orders/order.php');

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function paymentreserveAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            $order_info_1 = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
            if(!$order_info_1) $error .= $otapilib->error_message;

            $r = $otapilib->GetSalesPaymentInfo($sid, $id);
            //var_dump($r);
            if(!$r) {
                $error .= $otapilib->error_message;
            } else {
                $amount = min((float)$r['custbalanceavail'], (float)$r['salesamount'] - (float)$r['salespaid']);
                $r = $otapilib->SalesPaymentReserve($sid, $id, $amount);

                $order_info_2 = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
                if(!$order_info_2) $error .= $otapilib->error_message;

                if($order_info_1['salesorderinfo']['statuscode'] != $order_info_2['salesorderinfo']['statuscode']) {
                    Users::sendEmailChangeStatus($order_info_1['salesorderinfo']['statusname'], $order_info_2['salesorderinfo']['statusname'], $order_info_1['salesorderinfo']['custid'], $id);
                }
            }

            if(!$r) { $error .= $otapilib->error_message; }

            $_GET['error'] = (isset($_GET['error'])) ? $_GET['error'].$error : $error;

            $this->orderinfoAction();

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function purchaseitemsAction()
    {
        if (Login::auth())
        {
            global $otapilib;
            $id = @$_GET['id'];
            $sid = $_SESSION['sid'];
            $error = '';
            /*
            $result = $otapilib->GetWebUISettings($sid);
            if ($otapilib->error_message == 'SessionExpired')
            {
                header('Location: index.php?expired');
                die;
            }
            */
            $order_info = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
            if(!$order_info) $error .= $otapilib->error_message;

            if($order_info)
            {
                $saleLineList = '<SalesLinePurchInfoList>';
                foreach($order_info['saleslineslist'] as $item)
                {
                   $saleLineList .= '<SalesLinePurchInfo>';
                   $saleLineList .= '<SalesId>'.$id.'</SalesId>';
                   $saleLineList .= '<SalesLineId>'.$item['id'].'</SalesLineId>';
                   $saleLineList .= '<OperatorComment>'.$item['operatorcomment'].'</OperatorComment>';
                   $saleLineList .= '<PurchPrice>'.(float)$item['pricecust'].'</PurchPrice>';
                   $saleLineList .= '<PurchDelivery>'.(float)$item['pricecust'].'</PurchDelivery>';
                   $saleLineList .= '<PurchQty>'.(int)$item['qty'].'</PurchQty>';
                   $saleLineList .= '<VendPurchId>'.$item['vendid'].'</VendPurchId>';
                   $saleLineList .= '<PurchaseStatus>'.'1'.'</PurchaseStatus>';
                   $saleLineList .= '</SalesLinePurchInfo> ';
                }
                $saleLineList .= '</SalesLinePurchInfoList>';

                $r = $otapilib->PurchaseItems($sid, $saleLineList);
                if(!$r) $error .= $otapilib->error_message;

            }

            $_GET['error'] = (isset($_GET['error'])) ? $_GET['error'].$error : $error;
            $_GET['tab'] = 2;

            $this->orderinfoAction();

        } else {
            include(TPL_ABSOLUTE_PATH.'login.php');
        }
    }

    function updatepurchaseAction()
    {
        global $otapilib;
        @define('NO_DEBUG','true');

        $id = @$_GET['id'];
        $sid = $_SESSION['sid'];
        $error = '';
        /*
        $result = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired')
        {
            echo 'RELOGIN';
            die;
        }
        */
        $purchase_list = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 1);
        if(!$purchase_list) $error .= $otapilib->error_message;

        $purchased_list = $otapilib->GetSalesOrderDetailsForOperator($sid, $id, '', 2);
        if(!$purchased_list) $error .= $otapilib->error_message;

        include(TPL_ABSOLUTE_PATH.'orders/purchase.php');

    }

    function updatehistoryAction()
    {
        global $otapilib;
        @define('NO_DEBUG','true');

        $id = @$_GET['id'];
        $sid = $_SESSION['sid'];
        $error = '';
        /*
        $result = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired')
        {
            echo 'RELOGIN';
            die;
        }
        */
        $processlog = $otapilib->GetSalesProcessLog($sid, $id);
        if(!$processlog) $error = $otapilib->error_message;

        include(TPL_ABSOLUTE_PATH.'orders/processlog.php');
    }

    public static function OK(){
        print 'OK';
    }
    
    public static function filterOrders($orders, $filter)
    {
        global $otapilib;
        
        $filtered_orders = array();
        $sid = $_SESSION['sid']; 
        
        if(isset($filter['operatorid']) && $filter['operatorid'] != '')
        {
            $a = explode('_', $filter['operatorid']);
            $operator_id = $a[1];
            //echo ' $operator_id = '.$operator_id.'   ';
            $orders = $otapilib->GetSalesOrdersListForOperator($sid, '<OrderFilter><SalesResponsible>'.$operator_id.'</SalesResponsible></OrderFilter>');

            if(!$orders) { echo 'error = '.$otapilib->error_message;}
        }
        foreach($orders as $order)
        {
            if(isset($filter['status']) && $filter['status'] != '')
            {
                if($order['statusname'] != $filter['status']) continue;
            }
            
            if(isset($filter['number']) && $filter['number'] != '')
            {
                if($order['id'] != $filter['number']) continue;
            }

            if(isset($filter['fromdate']) && $filter['fromdate'] != '')
            {     
                if(self::checkTime($filter['fromdate'], $order) > 0) continue;
                
            }
            
            if(isset($filter['todate']) && $filter['todate'] != '')
            {     
                if(self::checkTime($filter['todate'], $order, 1) < 0) continue;
                
            }
            
            $filtered_orders[] = $order;
        }
        
        return $filtered_orders;
    }

    public static function checkTime($filter_time, $order, $day = 0)
    {     
        $filter_time = explode('/', $filter_time);

        $orderdate  = explode(' ', $order['createddatetime']);
        $orderdate1 = explode('.', $orderdate[0]);
        $orderdate2 = explode(':', $orderdate[1]);

        $timestamp_filter = mktime(0,0,0, $filter_time[0], 
                $filter_time[1]+$day, $filter_time[2]);

        $timestamp_order  = mktime($orderdate2[0], $orderdate2[1], $orderdate2[2],
                             $orderdate1[1], $orderdate1[0], $orderdate1[2]);
        
        return ($timestamp_filter - $timestamp_order);
    }
    
    private function _getPageURL()
    {
        $pageurl = 'index.php?';
            
        $params = explode('&', $_SERVER['QUERY_STRING']);

        foreach($params as $param){
            @list($key, $value) = explode('=', $param);
            if(in_array($key, array('error', 'success', 'do', 'id', 'p'))) continue;

            $pageurl .= "&$key=$value";
        }

		return $pageurl;
    }

	private function _sortByDate ($orders = array()) {
        $t = true;
        while ($t) {
            $t = false;
            for ($i = 0; $i < count($orders) - 1; $i++) {
                $swap = false;
                
                $date  = explode(' ', $orders[$i]['createddatetime']);
                $date11 = explode('.', $date[0]); // годы
                $date12 = explode(':', $date[1]); // дни 
                
                $date  = explode(' ', $orders[$i+1]['createddatetime']);
                $date21 = explode('.', $date[0]);
                $date22 = explode(':', $date[1]);
                
                $timestamp1  = mktime($date12[0], $date12[1], $date12[2],
                             $date11[1], $date11[0], $date11[2]);
                
                $timestamp2  = mktime($date22[0], $date22[1], $date22[2],
                             $date21[1], $date21[0], $date21[2]);

                if ($timestamp2 > $timestamp1) {
                    $temp = $orders[$i + 1];
                    $orders[$i + 1] = $orders[$i];
                    $orders[$i] = $temp;
                    $t = true;
                }
            }
        }
        return $orders;
    }
    
    private function _generatePackageFields()
    { 
        //var_dump(@$_POST);
        $xmlParams = new SimpleXMLElement('<PackageAdminUpdateInfo></PackageAdminUpdateInfo>');
        if (@$_POST['DeliveryTrackingNum']) $xmlParams->addChild('DeliveryTrackingNum', @htmlspecialchars(@$_POST['DeliveryTrackingNum']));
        if (@$_POST['Weight']) $xmlParams->addChild('Weight', @$_POST['Weight']);
        if (@$_POST['ManualPrice']) $xmlParams->addChild('ManualPrice', @$_POST['ManualPrice']);
        if (defined('CFG_BUYINCHINA')) {
            if ((float)@$_POST['PriceInternal'] > 0) {
                $xmlParams->addChild('Price', (float)@$_POST['PriceInternal']);
                $xmlParams->addChild('AdditionalPrice', (float)@$_POST['AdditionalPrice']);
                $xmlParams->addChild('PriceCurrencyCode', (string)@$_POST['PriceCurrencyCode']);
            }
        } else {
            $xmlParams->addChild('PriceInternal', @$_POST['PriceInternal']);
        }
        if (@$_POST['DeliveryModeId']) $xmlParams->addChild('DeliveryModeId', @$_POST['DeliveryModeId']);
        
        if (@$_POST['DeliveryContactLastname']) $xmlParams->addChild('DeliveryContactLastname', @$_POST['DeliveryContactLastname']);
        if (@$_POST['DeliveryContactFirstname']) $xmlParams->addChild('DeliveryContactFirstname', @$_POST['DeliveryContactFirstname']);
        if (@$_POST['DeliveryContactMiddlename']) $xmlParams->addChild('DeliveryContactMiddlename', @$_POST['DeliveryContactMiddlename']);

        if (@$_POST['DeliveryContactPhone']) $xmlParams->addChild('DeliveryContactPhone', htmlspecialchars(@$_POST['DeliveryContactPhone']));
        if (@$_POST['DeliveryCountry']) $xmlParams->addChild('DeliveryCountry', htmlspecialchars(@$_POST['DeliveryCountry']));
        if (@$_POST['DeliveryPostalCode']) $xmlParams->addChild('DeliveryPostalCode', htmlspecialchars(@$_POST['DeliveryPostalCode']));
        if (@$_POST['DeliveryRegionName']) $xmlParams->addChild('DeliveryRegionName', @$_POST['DeliveryRegionName']);
        if (@$_POST['DeliveryCity']) $xmlParams->addChild('DeliveryCity', @$_POST['DeliveryCity']);
        if (@$_POST['DeliveryAddress']) $xmlParams->addChild('DeliveryAddress', @$_POST['DeliveryAddress']);

        return str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
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