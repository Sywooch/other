<?php

class Pay extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'pay'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/pay/';

    /**
     * @var CMS
     */
    private $cms;

    public function __construct()
    {
        $this->cms = new CMS();
        $this->cms->Check();
        parent::__construct(true);
    }

    protected function setVars()
    {
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
            header('Location: index.php?p=login');
        }
        $this->_pay();
    }

    private function paymentXML($Amount, $CurrencyCode, $PaymentSystemId, $OrderId, $SuccessUrl, $FailUrl,
                                $IsPartialPayment){
        $xml = new SimpleXMLElement('<PaymentRequest></PaymentRequest>');
        $xml->addChild('Amount', htmlspecialchars($Amount));
        $xml->addChild('CurrencyCode', $CurrencyCode);
        $xml->addChild('PaymentSystemId', htmlspecialchars($PaymentSystemId));
        if(@$OrderId) $xml->addChild('OrderId', htmlspecialchars($OrderId));
        $xml->addChild('SuccessUrl', htmlspecialchars($SuccessUrl));
        $xml->addChild('FailUrl', htmlspecialchars($FailUrl));
        $xml->addChild('IsPartialPayment', htmlspecialchars($IsPartialPayment));

        if(htmlspecialchars(@$_GET['Custom'][$PaymentSystemId])){
            $xml->addChild('Custom', htmlspecialchars($_GET['Custom'][$PaymentSystemId]));
        }
        return $xml->asXML();
    }

    private function _getUrls($isOrder, $isDeposit, $isArca){
        if($isOrder){
            $successUrl = 'http://'.$_SERVER["HTTP_HOST"].'/index.php?p=paymentsuccess';
            $failureUrl = 'http://'.$_SERVER["HTTP_HOST"].'/index.php?p=paymenterror';
        }
        if($isDeposit){
            $successUrl = 'http://'.$_SERVER["HTTP_HOST"].'/index.php?p=depositsuccess';
            $failureUrl = 'http://'.$_SERVER["HTTP_HOST"].'/index.php?p=depositfail';
        }
        if($isArca){
            $successUrl = 'http://'.$_SERVER["HTTP_HOST"].'/lib/arca/handlers/success.php';
            $failureUrl = 'http://'.$_SERVER["HTTP_HOST"].'/lib/arca/handlers/fail.php';
        }
        return array($successUrl, $failureUrl);
    }

    private function _sberbankPay($sid){
        global $otapilib;
        $this->_template='sberbank';
        CMS::CheckStatic();
        $data = CMS::getSiteConfig();
        if ($data[0]){
            $data[1]['INN_of_payee']=str_split($data[1]['INN_of_payee'],1);
            $data[1]['account_number_of_payee']=str_split($data[1]['account_number_of_payee'],1);
            $data[1]['bank_identification_code']=str_split($data[1]['bank_identification_code'],1);
            $data[1]['correspondent_bank_account']=str_split($data[1]['correspondent_bank_account'],1);
            $this->tpl->assign('quittanceData', $data[1]);
            if (CFG_MULTI_CURL)
            {
                $otapilib->InitMulti();
                $otapilib->GetAccountInfo($sid);
                $otapilib->GetUserInfo($sid);
                $otapilib->MultiDo();
                $accountinfo = $otapilib->GetAccountInfo($sid);
                $userinfo = $otapilib->GetUserInfo($sid);
                $otapilib->StopMulti();
            } else {
                $accountinfo = $otapilib->GetAccountInfo($sid);
                $userinfo = $otapilib->GetUserInfo($sid);
            }
            $this->tpl->assign('accountinfo', $accountinfo);
            $this->tpl->assign('userInfo', $userinfo);

            if(isset($_GET['orderid'])){
                $order_info = $otapilib->GetSalesOrderDetails($sid, $_GET['orderid']);
                $t_amount = (float)$order_info['salesorderinfo']['totalamount'];
            }
            $this->tpl->assign('money', isset($_GET['orderid']) ? $_GET['money'] : $t_amount);
        }
        else{
            $this->tpl->assign('quittanceData', array());
        }
    }

    private function _getPayForm($sid, $orderId, $paymentId, $cur){
        global $otapilib;

        $this->_template = 'pay_form';
        $pid = $paymentId;

        $isArca = substr($paymentId,0 ,4) == 'arca';
        $isOrder = isset($orderId) && !$isArca;
        $isDeposit = !isset($orderId) && !$isArca;
        list($successUrl, $failureUrl) = $this->_getUrls($isOrder, $isDeposit, $isArca);

        if ($pid=='sberbank'){
            return $this->_sberbankPay($sid);
        }

        if($orderId){
            $order_info = $otapilib->GetSalesOrderDetails($sid, $orderId);
            $t_amount = (float)$order_info['salesorderinfo']['totalamount'];
        }
        else{
            $t_amount = (float)$_GET['money'];
        }

        $amount = number_format($t_amount, 2, '.', '');
        $xml = $this->paymentXML($amount, $cur, $pid, $orderId, $successUrl,  $failureUrl, 'false');
        $form = $otapilib->GetPaymentParameters($_SESSION[CFG_SITE_NAME.'loginUserData']['sid'], $xml);
        $this->tpl->assign('payment_error', $otapilib->error_message);

        if($isArca && $form !== false){
            $form['Parameters'] = array_map(array($this, '_formatAmount'), $form['Parameters']);

            $A = new Arca();
            $result = $A->savePayment($form, $paymentId);
            $_SESSION['arca_payment_id'] = $result;
            if(!$result[0]) $this->tpl->assign('payment_error', $result[1]);
        }
        $this->tpl->assign('form', $form);

        return $form;
    }

    private function _getPayModes(){
        global $otapilib;

        $methods = $otapilib->GetPaymentModes();
        $methods['sberbank'] = CMS::GetQuittanceMethod();
        if (empty ($methods['sberbank'])) unset ($methods['sberbank']);
        if($otapilib->error_code == 'NotFound' && !$methods){
            $this->tpl->assign('methods_error', Lang::get('ps_not_available'));
        }
        else{
			$site_config = $this->cms->getSiteConfig();

            $method_groups = array();
            if(isset($site_config[1]['payment_in_cash']) && $site_config[1]['payment_in_cash']== 'checked'){
                $method_groups[Lang::get('payment_in_cash')][] = array(
                    'Id' => "payment_in_cash",
                    'Name' =>Lang::get('payment_in_cash'),
                    'Description' => "",
                    'PaymSortCode' =>"Cashless",
                    'PaymSortText' =>Lang::get('payment_in_cash'),
                    'ImageURL' =>"",
                    'PaymentSystem' =>"",
                    'CustomField' =>"None",
                    'customfield' =>"None"
                );
            }
            foreach ($methods as $method) {
                $group_key 	 = $method['paymsorttext'];

                if($group_key == '' || !$group_key)
                    $group_key = Lang::get('other_payments');
                $method_groups[$group_key][] = $method;
            }

            // Reordering other group in the end
            if(isset($method_groups[Lang::get('other_payments')])){
                $other_methods = $method_groups[Lang::get('other_payments')];
                unset($method_groups[Lang::get('other_payments')]);
                $method_groups[Lang::get('other_payments')] = $other_methods;
            }

            $this->tpl->assign('method_groups', $method_groups);
            $this->tpl->assign('methods', $methods);

        }
        $this->tpl->assign('enter_money', 1);

        return true;
    }

    private function _pay(){
        global $otapilib;

        $sid = Session::getUserSession();
        if (isset($GLOBALS['$otapilib->GetUserInfo']))
        {
            $user = $GLOBALS['$otapilib->GetUserInfo'];
        } else {
            $user = $otapilib->GetUserInfo($sid);
            $GLOBALS['$otapilib->GetUserInfo'] = $user;
        }
        $orderId = isset($_GET['orderid']) ? $_GET['orderid'] : '';
        $currency = $_SESSION[CFG_SITE_NAME.'loginUserData']['currencycode'];

        if(isset($_GET['paymentId'])){
			
			if($_GET['paymentId']=="payment_in_cash"){ // If payment in cash
				
				$site_config = $this->cms->getSiteConfig();
				
				if( isset($site_config[1]['notification_email'])){
					$email = str_replace(" ", "", $site_config[1]['notification_email']);
                                        $email = explode(';', $email);
				}
				else {
					$email = false;
				}	
					
				if($email) {
                     foreach ($email as $item) {
                         if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
                             General::mail_utf8($item,$user['Login'],$item, 'Payment in cash', 'Sum to pay: '.$_GET['money'].'. <br> User: '.$user['Login']);
                         }
                     }
				}
				
				// ??? - Assign blank template but don't get any form ???
                header('Location: ' . UrlGenerator::generateContentUrl('cash_payment'));
			} // END if payment in cash
			else{
				$form = $this->_getPayForm($sid, $orderId, $_GET['paymentId'], $currency);
				if(SCRIPT_NAME == 'pay_form_json'){
					$this->_template = 'pay_form_json';
					$this->tpl->assign('form', $form);
				}
			}
        }
        elseif(@$_GET['money'] || @$_GET['orderid'] || isset($_GET['pay'])){
            return $this->_getPayModes();
        }
    }

    private function _formatAmount($p){
        if($p['Name'] == 'amount'){
            $p['Value'] = number_format($p['Value'], 2, '.', '');
            $p['value'] = number_format($p['Value'], 2, '.', '');
        }

        return $p;
    }
}

?>