<?php

// Подключаем файл с паролями от сервиса
require_once('config.php');

// Подключаем конфигурационный файл
require_once('config/config.php');

define('RESPONSE_OK', 1);
define('RESPONSE_NO_ADMIN', 2);
define('RESPONSE_SEND_ERROR', 3);

define('MESSAGE_1', 'Произведена оплата заказа ');
define('MESSAGE_2', 'Пополнение счета');
define('MESSAGE_3', 'Сумма: ');
define('MESSAGE_4', 'Внешний номер платежа (в платежной системе): ');
define('MESSAGE_5', 'Внутренний номер платежа: ');
define('MESSAGE_6', 'Номер счета: ');
define('MESSAGE_7', 'Страница покупателя: ');

if (count($_GET)) {
    $income_params = $_GET;
} else {
    $income_params = $_POST;
}

//www.site_name.com/pay_notify.php?accountId=12&amount=60&currency=ru&externalTransactionId=sed4rds&internalTransactionId=565gfdgv5&salesId=OR-00000013

$cms = new CMS();
$cmsStatus = $cms->Check();
$r = $cms->getSiteConfig();

if ($r[0] && isset($r[1]['site_admin_email'])) {
    $params = array();
    /*if (isset($income_params['email'])) {
        $params['to'] = $income_params['email'];
    } else {
        $params['to'] = $r[1]['site_admin_email'];
    }*/

    $params['to'] = $r[1]['site_admin_email'];

    $params['subject'] = (isset($income_params['salesId'])) ? 
                MESSAGE_1 . $income_params['salesId'] : MESSAGE_2;
    
    $params['message'] = $params['subject'] . '<br/>';
    
    if (isset($income_params['amount'])) {
        $params['message'] .= MESSAGE_3 . $income_params['amount'];
        if (isset($income_params['currency'])) {
            $params['message'] .= ' ' . $income_params['currency'];
        }
        $params['message'] .= '<br/>';
    }
    
    if (isset($income_params['externalTransactionId'])) {
        $params['message'] .= MESSAGE_4 . $income_params['externalTransactionId'] . '<br/>';;
    }
    
    if (isset($income_params['internalTransactionId'])) {
        $params['message'] .= MESSAGE_5 . $income_params['internalTransactionId'] . '<br/>';;
    }

    if (isset($income_params['accountId'])) {
        $params['message'] .= MESSAGE_6 . $income_params['accountId'] . '<br/>';;
    }

    if (isset($income_params['userId'])) {
        $params['message'] .= MESSAGE_7 . '<a href="http://'.rtrim($_SERVER['HTTP_HOST'],'/').'/admin/index.php?cmd=users&do=userinfo&id='.$income_params['userId'].'">Ссылка</a>' . '<br/>';;
    }

    echo sendEmail($params);
    
} else {
    echo RESPONSE_NO_ADMIN;
}


function sendEmail($params) {
    try {
        require_once CFG_APP_ROOT.'/lib/phpmailer/class.phpmailer.php';
        $mail = new PHPMailer;
        $mail->Subject = $params['subject'];
        $mail->From = 'noreply@' . preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
        
        $mail->FromName = CFG_SITE_NAME;
        $mail->IsHTML(true);
        $mail->CharSet = 'utf-8';

        $mail->Body = $params['message'];

        $mail->AddAddress($params['to']);
        $mail->Send();
    }
    catch(phpmailerException $e){
        //print $e->getMessage();
        return RESPONSE_SEND_ERROR;
    }
    return  RESPONSE_OK;
}