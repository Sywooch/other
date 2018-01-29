<?php
namespace Referral\Repository;

class OrderRepository
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

    /**
     * @throws \DBException
     */
    public function AddOrder($referralId, $orderId, $purchase){
        $referralIdSafe = $this->cms->escape($referralId);
        $orderIdSafe = $this->cms->escape($orderId);
        $purchaseSafe = $this->cms->escape($purchase);

        $this->cms->query(
            "INSERT INTO `site_referral_orders` (`referral_id`, `order_id`, `purchase`)
            VALUES($referralIdSafe, '$orderIdSafe', $purchaseSafe)",
            array('site_referral_orders')
        );

        return $this->cms->insertedId();
    }

    /**
     * @throws \DBException
     */
    public function DeleteOrder($orderId){
        $orderIdSafe = $this->cms->escape($orderId);
        $this->cms->query(
            "DELETE FROM `site_referral_orders`
            WHERE `order_id` = '$orderIdSafe'",
            array('site_referral_orders')
        );
    }

    /**
     * @throws \DBException
     * @return bool
     */
    public function ExistOrdersForUser($referralUserId){
        $userIdSafe = $this->cms->escape($referralUserId);
        return (bool)$this->cms->querySingleValue("
            SELECT COUNT(*) FROM `site_referral_orders`
            WHERE `referral_id` = $userIdSafe
        ", array('site_referral_orders'));
    }
}
