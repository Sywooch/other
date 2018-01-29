<?php
namespace Referral\Repository;

class PresentsRepository
{
    /**
     * @var \CMS
     */
    protected $cms;
    /**
     * @param \CMS $cms
     */
    public function __construct($cms){
        $this->cms = $cms;
    }

    public function GetGiftsForUser($referralUserId, $isSent = 0){
        $userIdSafe = $this->cms->escape($referralUserId);
        $isSentSafe = $this->cms->escape($isSent);
        $gifts = $this->cms->queryMakeArray("
            SELECT `p`.`referral_order_id`, `p`.`sent`
            FROM `site_referrals_presents` `p`
                INNER JOIN `site_referral_orders` `o` ON `p`.`referral_order_id` = `o`.`id`
                INNER JOIN `site_referrals` `r` ON `o`.`referral_id` = `r`.`id`
            WHERE `r`.`parent_id`='$userIdSafe' and `p`.`sent`=$isSentSafe
        ", array('site_referrals_presents'));

        return $gifts;
    }

    public function GetGiftsFromUser($referralUserId, $isSent = 0){
        $userIdSafe = $this->cms->escape($referralUserId);
        $isSentSafe = $this->cms->escape($isSent);
        $gifts = $this->cms->queryMakeArray("
            SELECT `p`.`referral_order_id`, `p`.`sent`
            FROM `site_referrals_presents` `p`
                INNER JOIN `site_referral_orders` `o` ON `p`.`referral_order_id` = `o`.`id`
            WHERE `o`.`referral_id`='$userIdSafe' and `p`.`sent`=$isSentSafe
        ", array('site_referrals_presents'));

        return $gifts;
    }

    /**
     * Добавление подарка после оплаты заказа
     * @param $referralOrderId
     * @return int
     */
    public function RegisterGift($referralOrderId){
        $orderIdSafe = $this->cms->escape($referralOrderId);
        $this->cms->query("
            INSERT INTO `site_referrals_presents`
            SET `sent`=0, `referral_order_id`='$orderIdSafe'
        ", array('site_referrals_presents'));

        return $this->cms->insertedId();
    }

    /**
     * @param $referralOrderId
     * @return bool
     */
    public function SendGift($referralOrderId){
        $orderIdSafe = $this->cms->escape($referralOrderId);
        $this->cms->query("
            UPDATE `site_referrals_presents`
            SET `sent`=1
            WHERE `referral_order_id`='$orderIdSafe'
        ", array('site_referrals_presents'));

        return true;
    }

    /**
     * @param $referralId
     * @return bool
     */
    public function SendGiftFromUser($referralId){
        $referralIdSafe = $this->cms->escape($referralId);
        $this->cms->query("
            UPDATE `site_referrals_presents`
            SET `sent`=1
            WHERE `referral_order_id` IN (SELECT `id` FROM `site_referral_orders` WHERE `referral_id`=$referralIdSafe)
        ", array('site_referrals_presents'));

        return true;
    }
}
