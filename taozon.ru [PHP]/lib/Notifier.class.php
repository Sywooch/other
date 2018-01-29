<?php

OTBase::import('system.lib.helpers.EmailHelper');
OTBase::import('system.lib.helpers.TextHelper');

class Notifier
{
    public static function sendAdminTestLetter($params)
    {
        $emails = str_replace(" ", "", $params['TestEmail']);
        $emails = explode(';', $emails);
        $from_name = isset($params['site_config']['notification_send_from_name']) ? $params['site_config']['notification_send_from_name'] : '';

        foreach ($emails as $item) {
            General::mail_utf8($item, $from_name, $item, $params['PublicationTitle'], $params['PublicationText']);
        }
    }

    public static function generalNotification($template, $title, $data, $predefinedEmail = '')
    {
        Lang::getTranslations('', General::getConfigValue('admin_letter_lang'));
        $bodyBlock = EmailHelper::getInstance();
        $bodyBlock->setTemplate($template);
        $bodyBlock->setData($data);
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        $email = $predefinedEmail ? $predefinedEmail : str_replace(" ", "", General::getConfigValue('notification_email'));
        $email = explode(';', $email);
        $text = $bodyBlock->generate();
        foreach ($email as $item) {
            General::mail_utf8($item, $from_name, $from_mail, $title, $text);
        }
        Lang::getTranslations('', Session::getActiveLang());
    }

    public static function generalUserNotification($emails,$template,$title,$data){
        if(General::getConfigValue($template)){
            $text = self::prepareTextMessage(General::getConfigValue($template), $data);
        }
        else{
            $bodyBlock = EmailHelper::getInstance();
            $bodyBlock->setTemplate($template);
            $bodyBlock->setData($data);
            $text = $bodyBlock->generate();
        }
        $adminEmails = str_replace(" ", "", General::getConfigValue('notification_email'));
        $adminEmails = explode(';', $adminEmails);

        $emails = str_replace(" ", "", $emails);
        $emails = explode(';', $emails);
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        foreach ($emails as $email) {
            if(!file_exists(CFG_APP_ROOT . '/cache/mails/'))
                @mkdir(CFG_APP_ROOT . '/cache/mails/', 0777);
            @file_put_contents(CFG_APP_ROOT . '/cache/mails/' . time() . '_' . $template . '_' . $email . '.txt', $text);
            General::mail_utf8($email, $from_name, $from_mail, $title, nl2br($text));
        }
    }

    /*
     * Сообщение админу о том что пытаются оплатить заказа наличными со страницы заказа
     */
    public static function notifyAdminOnPaymentInCash($order, $user, $paymentSum)
    {
        $params = array(
            'currency' => (string)$order['CurrencySign'],
            'username' => $user['login'],
            'orderId' => (string)$order['id'],
            'first_name' => $user['firstname'],
            'last_name' => $user['lastname'],
            'middle_name' => $user['middlename'],
            'payment_sum' => TextHelper::formatPrice($paymentSum),
            'payment_sum_text' => TextHelper::formatPrice((float)$order['totalamount'], $order['currencysign']),
            'date' => date('Y-m-d H:i:s', strtotime((string)$order['CreatedDateTime'])),
        );

        if (! General::getConfigValue('email_order_pay_cash')) {
            $params['user'] = $user;

            $bodyBlock = EmailHelper::getInstance();
            $bodyBlock->setTemplate('payment_in_cash_order');
            $bodyBlock->setData($params);
            $text = $bodyBlock->generate();

            unset( $params['user']);
        } else {
            $text = General::getConfigValue('email_order_pay_cash');
        }
        $text = self::prepareTextMessage($text, $params);

        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        $email = str_replace(" ", "", General::getConfigValue('notification_email'));
        $email = explode(';', $email);
        foreach ($email as $item) {
            General::mail_utf8($item, $from_name, $from_mail, Lang::get('payment_in_cash'), $text);
        }
    }

    public static function notifyAdminWithdrawMoney ($user, $availableSum, $withdrawSum, $comment)
    {
        if (! General::getConfigValue('email_money_withdrawal')) {
            $bodyBlock = EmailHelper::getInstance();
            $bodyBlock->setTemplate('email_money_withdrawal');
            $bodyBlock->setData(array('username' => $user['login'],'first_name' => $user['firstname'],'last_name' => $user['lastname'],'middle_name' => $user['middlename'],'withdraw_sum' => TextHelper::formatPrice($withdrawSum),'available_sum' => TextHelper::formatPrice($availableSum),'currency' => !empty($user['currencysign']) ? (string)$user['currencysign'] : '','comment' => $comment ));
            $text = $bodyBlock->generate();
        } else {
            $text = General::getConfigValue('email_money_withdrawal');
            $text = self::prepareTextMessage($text, array('username' => $user['login'],'first_name' => $user['firstname'],'last_name' => $user['lastname'],'middle_name' => $user['middlename'],'withdraw_sum' => TextHelper::formatPrice($withdrawSum),'available_sum' => TextHelper::formatPrice($availableSum),'currency' => !empty($user['currencysign']) ? (string)$user['currencysign'] : '','comment' => $comment,
            ));
        }
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        $email = str_replace(" ", "", General::getConfigValue('notification_email'));
        $email = explode(';', $email);
        foreach ($email as $item) {
            General::mail_utf8($item, $from_name, $from_mail, Lang::get('Withdrawals'), $text);
        }
    }

    public static function notifyUserOnSuccessOrder($order, $profile)
    {
        $sid = Session::getUserSession();
        global $otapilib;
        $userData = $otapilib->GetUserInfo($sid);
        if (empty($userData['Email'])) {
            return false;
        }
        $email = $userData['Email'];
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');        
        $orderId = OrdersProxy::normalizeOrderId((string)$order['id']);
        $amount = TextHelper::formatPrice((float)$order['TotalAmount']);

        if (! General::getConfigValue('email_order')) {
            $bodyBlock = EmailHelper::getInstance();
            $bodyBlock->setTemplate('success_order_user');
            $bodyBlock->setData(array('orderId' => $orderId, 'amount' => $amount));
            $text = $bodyBlock->generate();
            $convertNewLines = false;
        } else {
            $text = General::getConfigValue('email_order');

            $user = array(
                'firstname' => $userData['firstname'],
                'middlename' => $userData['middlename'],
                'lastname' => $userData['lastname'],
            );

            if (empty($userData['firstname']) && empty($userData['firstname']) 
                    && empty($userData['firstname'])) {
                $user = array(
                'firstname' => $profile['firstname'],
                'middlename' => $profile['middlename'],
                'lastname' => $profile['lastname'],
            );
            }
            $text = str_replace(
                array('{{first_name}}', '{{last_name}}', '{{middle_name}}', 
                        '{{orderid}}', '{{amount}}', '{{username}}'),
                array($user['firstname'], $user['lastname'], $user['middlename'], 
                    $orderId, $amount, Session::getUserDataByKey('username')),
                $text
            );
            $convertNewLines = true;
        }
        General::mail_utf8($email, $from_name, $from_mail, Lang::get('new_order', array('orderId' => $orderId)), $text, $convertNewLines);
    }

    public static function notifyUserOnOrderNeedSurcharge($order)
    {
        global $otapilib;
        $sid = Session::get('sid');

        $orderId = OrdersProxy::normalizeOrderId((string)$order['salesorderinfo']['id']);

        $userData = $otapilib->GetUserInfoForOperator($sid, $order['salesorderinfo']['custid']);
        if (empty($userData['Email'])) {
            return false;
        }
        $email = $userData['Email'];

        if (! General::getConfigValue('email_order_need_surcharge')) {
            $notification_params = array('orderId' => $orderId,
                  'amount'  => TextHelper::formatPrice($order['salesorderinfo']['remainamount']),
                  'username' => $userData['login'],
                  'currency' => (string)$order['salesorderinfo']['currencysign']);

            $text  = LangAdmin::get('order_need_surcharge') . ' ' . $orderId;

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($email, $from_name, $from_mail, sprintf(LangAdmin::get('change_in_order'), $orderId), $text);
        } else {
            $notification_params = array(
                $orderId,
                TextHelper::formatPrice($order['salesorderinfo']['remainamount']),
                (string)$order['salesorderinfo']['currencysign'],
                $userData['login']
            );

            $mailblock = General::getConfigValue('email_order_need_surcharge');
            $mailblock = str_replace(array('{{orderid}}', '{{surcharge}}', '{{currency}}', '{{username}}'), $notification_params, $mailblock);

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($email, $from_name, $from_mail, sprintf(LangAdmin::get('change_in_order'), $orderId), $mailblock,true);
        }
    }

    public static function notifyUserOnTicketAnswer($data)
    {
        if (empty($data['email'])) {
            return false;
        }

        if (! General::getConfigValue('email_ticket_answer')) {

            $bodyBlock = EmailHelper::getInstance();
            $bodyBlock->setTemplate('ticket_answer');
            $bodyBlock->setData(array('ticket_id' => (string)$data['ticket_id'], 'txt_message' => (string)$data['txt_message']));
            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            $mailblock = $bodyBlock->generate();
            if (!isset($_SESSION['mail_as_text'])) {
                General::mail_utf8($data['email'], $from_name, $from_mail,Lang::get('new_ticket_answer'), $mailblock);
            } else {
                General::mail_utf8_txt($data['email'], $from_name, $from_mail,Lang::get('new_ticket_answer'), $mailblock);
            }

        } else {
            $mailblock = General::getConfigValue('email_ticket_answer');

            $mailblock = str_replace(array('{{ticketid}}', '{{txtmessage}}'), array($data['ticket_id'], $data['txt_message']), $mailblock);

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            if (!isset($_SESSION['mail_as_text'])) {
                General::mail_utf8($data['email'], $from_name, $from_mail,Lang::get('new_ticket_answer'), $mailblock,true);
            } else {
                General::mail_utf8_txt($data['email'], $from_name, $from_mail,Lang::get('new_ticket_answer'), $mailblock,true);
            }
        }
    }

    private static function prepareTextMessage($text, array $params)
    {
        foreach ($params as $key => $value) {
            $text = str_replace('{{' . $key . '}}', $value, $text);
        }
        return $text;
    }

    public static function notifyUserOnRegister($email, $username, $password)
    {
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        if (! General::getConfigValue('email_register')) {
            $block = new RegisterEmail();
            General::mail_utf8(
                $email,
                $from_name,
                $from_mail,
                Lang::get('register_data'),
                $block->generate(array($username, $password))
            );
        } else {
            $mailblock = General::getConfigValue('email_register');
            $mailblock = str_replace(array('{{username}}', '{{password}}'), array($username, $password), $mailblock);
            General::mail_utf8(
                $email,
                $from_name,
                $from_mail,
                Lang::get('register_data'),
                $mailblock,
                true
            );
        }
    }

    public static function notifyUserOnRecovery($email, $code, $username, $password){
        $from_name = General::getConfigValue('notification_send_from_name');
        $from_mail = General::getConfigValue('notification_send_from');
        if($code){
            if (! General::getConfigValue('email_recover_code')) {                
                $block = new RecoveryEmail();
                $Body = $block->generate(array('code', $code, ''));
                General::mail_utf8($email, $from_name, $from_mail, Lang::get('pass_recovery'), $Body);
            } else {                
                $mailblock = General::getConfigValue('email_recover_code');
                $url = "<a href=\"http://".$_SERVER['HTTP_HOST']."".dirname($_SERVER['PHP_SELF']).""."index.php?p=login&code=".$code."\">".Lang::get('recover')."</a>";
                $mailblock = str_replace(array('{{code}}'), array($url), $mailblock);
                General::mail_utf8($email, $from_name, $from_mail, Lang::get('pass_recovery'), $mailblock,true);
            }
        } else {
            if (! General::getConfigValue('email_recover')) {                
                $block = new RecoveryEmail();
                $Body = $block->generate(array('userdata', $username, $password));
                General::mail_utf8($email, $from_name, $from_mail, Lang::get('pass_recovery'), $Body);
            } else {                
                $mailblock = General::getConfigValue('email_recover');
                $mailblock = str_replace(array('{{username}}', '{{password}}'), array($username, $password), $mailblock);
                General::mail_utf8($email, $from_name, $from_mail, Lang::get('pass_recovery'), $mailblock,true);
            }
        }

    }

    public static function sendEmailChangeStatus ($status1, $status2, $user_id, $order_id, $taobao_item_id = '', $email = '') {
        global $otapilib;
        $sid = Session::get('sid');

        if (empty($email)) {
            $user = $otapilib->GetUserInfoForOperator($sid, $user_id);
            if (!$user) $error = $otapilib->error_message;
        } else {
            $user['email'] = $email;
        }
        if ($user['email']) {
            $to = $user['email'];
            if ($taobao_item_id) {
                $subject  = Lang::get('change_status_line').' '.$taobao_item_id;
                $subject .= ' (' . Lang::get('order'). ': '.(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id). ')';
                $message  = $subject . '<br/>';
            } else {
                $subject  = Lang::get('change_status').' '.(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id);
                $message  = Lang::get('change_status').' '.(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id).'<br/>';
            }
            $message .= $status1 . ' ---> '. $status2.'<br/>';
            $message .= Lang::get('get_more_info').' ';
            $message .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?p=privateoffice">'.LangAdmin::get('link1').'</a>';

            if (General::getConfigValue('email_cngstatus'))
                $message = General::getConfigValue('email_cngstatus');


            $message = str_replace(array('{{orderid}}', '{{oldstatus}}', '{{newstatus}}'), array((defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id), $status1, $status2), $message);

            $params['email'] = $user['email'];
            $params['subject'] = $subject;
            $params['message'] = $message;
            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($params['email'], $from_name, $from_mail, $params['subject'], $params['message'],true);


        }
    }

    public static function sendEmailCreatePackage ($user_id, $order_id, $package_id, $email = '') {
        global $otapilib;
        $sid = Session::get('sid');

        if (empty($email)) {
            $user = $otapilib->GetUserInfoForOperator($sid, $user_id);
            if (!$user) $error = $otapilib->error_message;
        } else {
            $user['email'] = $email;
        }

        if ($user['email']) {
            $message  = LangAdmin::get('create_package').' '.$package_id.' ';
            $message .= LangAdmin::get('in_order').' '.(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id).'<br/>';
            $message .= LangAdmin::get('get_more_info').' ';
            $message .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?p=privateoffice">'.LangAdmin::get('link1').'</a>';


            if (General::getConfigValue('email_crtpackage'))
                $message = General::getConfigValue('email_crtpackage');


            $message = str_replace(array('{{orderid}}', '{{packageid}}'), array((defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, (string)$order_id):(string)$order_id), $package_id), $message);


            $params['email'] = $user['email'];
            $params['subject'] = Lang::get('create_package').' '.$package_id;
            $params['message'] = $message;

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($params['email'], $from_name, $from_mail, $params['subject'], $params['message'],true);
        }
    }

    public static function notifyUserOnChangeItemPrice ($user, $order, $itemid, $new_price) {
        if ($user['email']) {

            $message  = LangAdmin::get('update_order') . ' ' .(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, $order['salesorderinfo']['id']):$order['salesorderinfo']['id']). '<br/>';
            $message .= LangAdmin::get('change_item_price').' '.$itemid.'<br/>';
            $message .= LangAdmin::get('new_price_is').' '.TextHelper::formatPrice($new_price, $order['salesorderinfo']['currencysign']).'<br/>';
            $message .= LangAdmin::get('get_more_info').' ';



            if (General::getConfigValue('email_change_item_price'))
                $message = General::getConfigValue('email_change_item_price');


            $params1 = array('{{orderid}}', '{{itemid}}', '{{newprice}}', '{{currency}}');
            $params2 = array(
                (defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, $order['salesorderinfo']['id']):$order['salesorderinfo']['id']),
                $itemid,
                TextHelper::formatPrice($new_price),
                $order['salesorderinfo']['currencysign']
            );
            $message = str_replace($params1, $params2, $message);

            $message .= '<a href="'.UrlGenerator::generateOrderDetailsUrl($order['salesorderinfo']['id'], array('tab' => 2),true).'">'.LangAdmin::get('link1').'</a>';


            $params['email'] = $user['email'];
            $params['subject'] = Lang::get('update_order').' '.(defined('CFG_PREFIX_REPLACE_ORD')?str_replace('ORD', CFG_PREFIX_REPLACE_ORD, $order['salesorderinfo']['id']):$order['salesorderinfo']['id']);
            $params['message'] = $message;

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($params['email'], $from_name, $from_mail, $params['subject'], $params['message'],true);
        }
    }

    public static function notifyUserOnChangePackagePrice ($user, $order, $package_id, $new_price, $old_price) {
        $orderId = $order['salesorderinfo']['id'];
        $currency = $order['salesorderinfo']['currencysign'];
        if ($user['email']) {
            $message  = LangAdmin::get('update_order') . ' ' .OrdersProxy::normalizeOrderId($orderId). '<br/>';
            $message .= LangAdmin::get('change_package_price').' '.$package_id.'<br/>';
            $message .= LangAdmin::get('old_price_is').' '.TextHelper::formatPrice($old_price, $currency).'<br/>';
            $message .= LangAdmin::get('new_price_is').' '.TextHelper::formatPrice($new_price, $currency).'<br/>';
            $message .= LangAdmin::get('get_more_info').' ';
            $message .= '<a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?p=orderdetails&orderid=' . $orderId . '">'.LangAdmin::get('link1').'</a>';

            if (General::getConfigValue('email_change_package_price')) {
                $message = General::getConfigValue('email_change_package_price');
            }

            $params1 = array('{{orderid}}', '{{packageid}}', '{{newprice}}', '{{oldprice}}', '{{currency}}');
            $params2 = array(OrdersProxy::normalizeOrderId($orderId), $package_id, TextHelper::formatPrice($new_price), TextHelper::formatPrice($old_price), $currency);
            $message = str_replace($params1, $params2, $message);

            $params['email'] = $user['email'];
            $params['subject'] = Lang::get('update_order').' '.OrdersProxy::normalizeOrderId($orderId);
            $params['message'] = $message;

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($params['email'], $from_name, $from_mail, $params['subject'], $params['message'],true);
        }
    }

    public static function notifyUserOnChangePackageStatus(
            $user, $order, $packageId, $oldStatusId, $newStatusId, $oldStatus, $newStatus
    ) {
        if ($user['email']) {
            $orderId = $order['salesorderinfo']['id'];

            if (General::getConfigValue('email_change_package_status')) {
                $message = General::getConfigValue('email_change_package_status');

                $placeholders = self::getPlaceholdersNotifyUserOnChangePackageStatus(
                        $user['login'], $user['firstname'], $user['lastname'], $user['middlename'],
                        OrdersProxy::normalizeOrderId($orderId), $packageId,
                        $oldStatusId, $newStatusId, $oldStatus, $newStatus,
                        '<a target="_blank" href="'.UrlGenerator::generateOrderDetailsUrl($orderId, array(), true).'">'.UrlGenerator::generateOrderDetailsUrl($orderId, array(), true).'</a>'
                );
                $message = self::strReplaceForArray($placeholders, $message);
            } else {
                $message  = LangAdmin::get('Сhange_package_status').' '.$packageId.'<br/>';
                $message .= LangAdmin::get('Old_package_status').' "'.$oldStatus.'"<br/>';
                $message .= LangAdmin::get('New_package_status').' "'.$newStatus.'"<br/>';
                $message .= LangAdmin::get('get_more_info').' ';
                $message .= '<a target="_blank" href="'.UrlGenerator::generateOrderDetailsUrl($orderId, array(), true).'">'.LangAdmin::get('link1').'</a>';
            }

            $params['email'] = $user['email'];
            $params['subject'] = LangAdmin::get('Сhange_package_status').' '.$packageId;
            $params['message'] = $message;

            $from_name = General::getConfigValue('notification_send_from_name');
            $from_mail = General::getConfigValue('notification_send_from');
            General::mail_utf8($params['email'], $from_name, $from_mail, $params['subject'], $params['message'], true);
        }
    }

    public static function getPlaceholdersNotifyUserOnChangePackageStatus(
            $login = '', $firstName = '', $lastName = '', $middleName = '', $orderId = '', $packageId = '',
            $oldStatusId = '', $newStatusId = '', $oldStatus = '', $newStatus = '', $linkToOrder = ''
    ) {
        $placeholders = array(
            '{{login}}' => $login,
            '{{first_name}}' => $firstName,
            '{{last_name}}' => $lastName,
            '{{middle_name}}' => $middleName,
            '{{order_id}}' => $orderId,
            '{{package_id}}' => $packageId,
            '{{old_status_id}}' => $oldStatusId,
            '{{new_status_id}}' => $newStatusId,
            '{{old_status}}' => $oldStatus,
            '{{new_status}}' => $newStatus,
            '{{link_to_order}}' => $linkToOrder,
        );
        return $placeholders;
    }

    public static function strReplaceForArray($arrayKeyValue, $text)
    {
        $placeholders = array();
        $values = array();
        foreach ($arrayKeyValue as $placeholder => $value) {
            $placeholders[] = $placeholder;
            $values[] = $value;
        }
        return str_replace($placeholders, $values, $text);
    }
}
