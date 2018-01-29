<?php
class Notifier
{
    public static function notifyAdminOnSuccessOrder($order)
    {
        $bodyBlock = new Email();
        $bodyBlock->setTemplate('success_order');
        $bodyBlock->setData(array('orderId' => (string)$order['Id'], 'amount' => (string)$order['TotalAmount']));
        $from_name = str_replace(" ", "", General::$siteConf['notification_send_from']);
        $email = str_replace(" ", "", General::$siteConf['notification_email']);
        $email = explode(';', $email);
        foreach ($email as $item) {
            General::mail_utf8($item, $from_name, $item,
                sprintf(Lang::get('new_order'), (string)$order['Id']), $bodyBlock->Generate());
        }
    }

    public static function notifyAdminOnNewTicket($userid, $id)
    {
        $bodyBlock = new Email();
        $bodyBlock->setTemplate('new_ticket');
        $bodyBlock->setData(array('userid' => $userid, 'id' => $id));
        $from_name = General::getSiteConfig('notification_send_from') ?
            str_replace(" ", "", General::$siteConf['notification_send_from']) : '';
        $email = General::getSiteConfig('notification_email') ?
            str_replace(" ", "", General::$siteConf['notification_email']) : '';
        $email = explode(';', $email);
        foreach ($email as $item) {
            General::mail_utf8($item, $from_name, $item,
                sprintf(Lang::get('new_order'), (string)$order['Id']), $bodyBlock->Generate());
        }
    }

    public static function notifyUserOnSuccessOrder($order)
    {
        $bodyBlock = new Email();
        $bodyBlock->setTemplate('success_order_user');
        $bodyBlock->setData(array('orderId' => (string)$order['Id'], 'amount' => (string)$order['TotalAmount']));
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        global $otapilib;
        $userData = $otapilib->GetUserInfo($sid);
        $email = $userData['Email'];
        $from_name = str_replace(" ", "", General::$siteConf['notification_send_from']);
        $adminemail = str_replace(" ", "", General::$siteConf['notification_email']);
        $adminemail = explode(';', $adminemail);
        $adminemail = @$adminemail[0];
        General::mail_utf8($email, $from_name, $adminemail,
            sprintf(Lang::get('new_order'), (string)$order['Id']), $bodyBlock->Generate());
    }
}
