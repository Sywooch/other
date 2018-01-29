<?php
global $otapilib;

$cms = new CMS();
$status = $cms->Check();
if ($cms->checkTable ('site_support'))
	$unreadCount = $cms->getTicketMessagesCount(false, 'In', 0);
else
	$unreadCount=0;
$newMessages = $unreadCount>0&&defined ('ADVANCED_SUPPORT_INTERFACE')?' ('.$unreadCount.')':'';

$menu = array();
$menu[] = array('cmd' => 'cmsadmin', 'label' => LangAdmin::get('content'), 'active' => @$_GET['cmd']=='cmsadmin' && !@$_GET['do']);
$menu[] = array('cmd' => 'cmsadmin', 'do' => 'menu', 'label' => LangAdmin::get('menu_manager'), 'active' => @$_GET['cmd']=='cmsadmin' && @$_GET['do'] == 'menu');
$menu[] = array('cmd' => '', 'label' => LangAdmin::get('settings'), 'active' => !isset($_GET['cmd']) && !isset($_GET['do']));
$menu[] = array('cmd' => 'siteConfiguration', 'label' => LangAdmin::get('site_configuration'), 'active' => null);
//Кэш
$menu[] = array('cmd' => 'caching', 'label' => LangAdmin::get('caching'), 'active' => null);
//
$menu[] = array('cmd' => '', 'do' => 'case', 'label' => LangAdmin::get('pricing'), 'active' => !isset($_GET['cmd']) && @$_GET['do'] == 'case');
if(CMS::IsFeatureEnabled('CurrencyRateEnhance'))
    $menu[] = array('cmd' => '', 'do' => 'pricing', 'label' => LangAdmin::get('pricing').' NEW', 'active' => !isset($_GET['cmd']) && @$_GET['do'] == 'pricing' );
$menu[] = array('cmd' => 'category', 'label' => LangAdmin::get('categories'), 'active' => null);
if($_SESSION['active_lang_admin']==='ru'&&CMS::IsFeatureEnabled('SberbankInvoice'))
    $menu[] = array('cmd' => 'sb_invoice', 'label' => LangAdmin::get('quittance'), 'active' => null);
$menu[] = array('cmd' => 'orders', 'label' => LangAdmin::get('orders'), 'active' => null);
$menu[] = array('cmd' => 'users', 'label' => LangAdmin::get('members'), 'active' => null);
if(CMS::IsFeatureEnabled('Discount'))
    $menu[] = array('cmd' => 'discount', 'label' => LangAdmin::get('adm_discount'), 'active' => null);
if(CMS::IsFeatureEnabled('Newsletter'))
	$menu[] = array('cmd' => 'newsletter', 'label' => LangAdmin::get('subscribe'), 'active' => null);
if(CMS::IsFeatureEnabled('News'))
    $menu[] = array('cmd' => 'news', 'label' => LangAdmin::get('news'), 'active' => null);
if(defined('CFG_DIGEST')) 
    $menu[] = array('cmd' => 'digest', 'label' => LangAdmin::get('digest'), 'active' => null);
if(CMS::IsFeatureEnabled('ProductComments'))
    $menu[] = array('cmd' => 'reviews', 'label' => LangAdmin::get('reviews'), 'active' => null);

$menu[] = array('cmd' => 'set', 'label' => LangAdmin::get('collections'), 'active' => null);
$menu[] = array('cmd' => 'Set2', 'label' => LangAdmin::get('collections').' New', 'active' => null);

$menu[] = array('cmd' => 'brands', 'label' => LangAdmin::get('brands'), 'active' => null);
$menu[] = array('cmd' => 'banners', 'label' => LangAdmin::get('banners'), 'active' => null);
$menu[] = array('cmd' => 'update', 'label' => LangAdmin::get('update'), 'active' => null);
if (defined('KEY_REFERRAL_SYSTEM'))
	$menu[] = array('cmd' => 'referrals', 'label' => 'Бонусная программа', 'active' => null);
$menu[] = array('cmd' => 'langTranslations', 'label' => LangAdmin::get('translations'), 'active' => null);
$menu[] = array('cmd' => 'support', 'label' => LangAdmin::get('support_requests').$newMessages, 'active' => null);
//if(CMS::IsFeatureEnabled('DeliveryCalculator'))
    //$menu[] = array('cmd' => 'calculator', 'label' => LangAdmin::get('calculator'), 'active' => null);
if (defined('MY_GOODS_SYSTEM')) {
    $menu[] = array('cmd' => 'my_categories', 'label' => 'Свои категории', 'active' => null);
    $menu[] = array('cmd' => 'my_goods', 'label' => 'Свои товары', 'active' => null);
}
$menu[] = array('cmd' => 'filtering', 'label' => LangAdmin::get('content_filtering'), 'active' => null);

if(CMS::IsFeatureEnabled('Order'))
    $menu[] = array('cmd' => 'order_settings', 'label' => LangAdmin::get('order_settings'), 'active' => null);

$menu[] = array('cmd' => 'ServiceCallCounter', 'label' => LangAdmin::get('service_counter'), 'active' => null);
$menu[] = array('cmd' => 'Delivery', 'label' => LangAdmin::get('delivery'), 'active' => null);
if (defined('CFG_BUYINCHINA')) $menu[] = array('cmd' => 'FinReport', 'label' => 'Управление финансами', 'active' => null);


if(@$_SESSION['sid'])
    $menu[] = array('cmd' => 'logout', 'label' => LangAdmin::get('logout'), 'active' => null);
else
    $menu[] = array('cmd' => 'login', 'label' => LangAdmin::get('logout'), 'active' => null);

$newMenu = Plugins::invokeEvent('onTopAdminMenuRender', array('menu' => $menu));
if($newMenu){
    $menu = $newMenu;
}

if (defined('SEND_EMAIL_NOTIFICATION')) {
$notify = array('cmd' => 'notification', 'label' => LangAdmin::get('notify'), 'active' => null);//$onRenderNotificationForm
    array_unshift($menu, $notify);
}

if (isset($_SESSION['sid']) && defined('BUY_IN_CHINA')) { // GetInstanceUserRoleList
    $notify = array('cmd' => 'adminusers', 'label' => LangAdmin::get('Adminusers'), 'active' => null);
    array_unshift($menu, $notify);
    /*if (!count($current_roles)) {
       array_unshift($menu, $notify);
    } else {
        foreach ($current_roles as $r) {
            if ($r['name'] == 'SuperAdmin') {
                array_unshift($menu, $notify);
                break;
            }
        }
    }*/
}
/*
$randomset = array('cmd' => 'randomset', 'label' => LangAdmin::get('randomset'), 'active' => null);
array_unshift($menu, $randomset);
*/
foreach ($menu as $key => $item) {
    if ($item['active'] === null) {
        $item['active'] = @$_GET['cmd'] == $item['cmd'];
    }

    $item['url'] = BASE_DIR . 'index.php?sid=' . $GLOBALS['ssid'];

    if (!empty($item['cmd'])) {
        $item['url'] .= '&amp;cmd=' . $item['cmd'];
    }
    if (isset($item['do'])) {
        $item['url'] .= '&amp;do=' . $item['do'];
    }

    $menu[$key] = $item;
}

?>

<form action="index.php" method="post">
    <input type="hidden" id="lang" name="lang" value="" />
    <input type="hidden" id="from-lang" name="from" value="<?=$_SERVER['REQUEST_URI']?>" />
</form>

<script type="text/javascript">
$(function(){
    $('#ru, #en').click(function(){
        $('#lang').val( $(this).attr('id') );
        $('#lang').closest('form').submit();
        return false;
    });
    $('#<?=$_SESSION['active_lang_admin']?>').wrap('<span class="active" />');
});
<? if (@$_GET['cmd'] != 'login') {?>
function checklogin()
{
    $.ajax({
        url: "index.php?do=checklogin",
    }).done(function ( data ) {
        if (data == 'SessionExpired') location.href='index.php?expired';
    });
}
setInterval('checklogin();', 1000*60);
<? } ?>
</script>

<ul id="navigation">
    <li><a href="#" id="ru">Russian</a></li>
    <li><a href="#" id="en">English</a></li>
    <li style="clear: both; display: block; height: 10px"> </li>

    <? if (isset($_SESSION['sid']) /*&& defined('BUY_IN_CHINA')*/) { ?>
        <? $menu = Permission::filter_menu($menu); ?>
    <? } ?>

    <? if (isset($_SESSION['sid'])) foreach ($menu as $item) { ?>
        <? if ($item['active']){ ?>
            <li><span class="active"><?= $item['label'] ?></span></li>
        <? } else { ?>
            <li><a href="<?= $item['url'] ?>" <?=isset($item['blank'])?'target="_blank"':''?>><?= $item['label'] ?></a></li>
        <? } ?>
    <? } ?>
</ul>

