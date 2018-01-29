<?php
include_once dirname(__FILE__) . '/config.php';
include_once dirname(__FILE__) . '/config/config.php';
include_once dirname(__FILE__) . '/referral/ReferralSystem.class.php';

use Referral\ReferralSystem;

$cms = new CMS();
$cms->Check();
$R = new ReferralSystem($cms, array(
    'min_purchase_for_gift' => defined('LIMIT_FOR_BONUS_REFERRAL_SYSTEM') ? LIMIT_FOR_BONUS_REFERRAL_SYSTEM : 35
));
$R->doMethod(new \RequestWrapper());
