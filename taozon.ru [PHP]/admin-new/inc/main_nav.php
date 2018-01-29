<?php
$request = new RequestWrapper();
$path = RightsManager::defaultPath();
$cmd = $request->getValue('cmd') ? ucfirst($request->getValue('cmd')) : $path['cmd'];
$action = $request->getValue('do') ? $request->getValue('do') : $path['do'];
$url = new AdminUrlWrapper();
$url->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

$adminStructure = simplexml_load_file(dirname(dirname(__FILE__)) . '/cfg/admin_structure.xml');
$currentAdminPartXPath = $adminStructure->xpath('//part/page[@cmd="'.strtolower($cmd).'" and (@do="*" or @do="'.$action.'")]/..');
$currentAdminPart = (string)$currentAdminPartXPath[0]['name'];
?>

<!--<li data-route="orders" class="disabled"><a data-href="<?/*=$url->AssignClearCmd('toolbar')*/?>"><i class="icon-home"></i><?/*=LangAdmin::get('Toolbar')*/?></a></li>-->

<? $disabled = (! RightsManager::isAvailableCmd('orders')); ?>
<? if (! $disabled) { ?>
<li data-route="orders" class="<?=$disabled ? 'disabled' : ''?>">
    <a href="<?=$disabled ? 'javascript:;' : $url->AssignClearCmd('orders');?>">
        <i class="icon-shopping-cart"></i><span class="hidden-tablet"> <?=LangAdmin::get('Orders')?></span>
    </a>
</li>
<? } ?>

<? $disabled = (! RightsManager::isAvailableCmd('pricing')); ?>
<? if (! $disabled) { ?>
<li data-route="pricing" class="<?=$disabled ? 'disabled' : ''?>">
    <a href="<?=$disabled ? 'javascript:;' : $url->AssignClearCmd('pricing');?>">
        <i class="icon-">＄</i><?=LangAdmin::get('Pricing')?>
    </a>
</li>
<? } ?>

<? $disabled = (! (RightsManager::isAvailableCmd('promo') || RightsManager::isAvailableCmd('referral') || RightsManager::isAvailableCmd('newsletters'))); ?>
<? if (! $disabled) { ?>
<li data-route="promo">
    <a href="<?=$url->AssignClearCmd('promo')?>"><i class="icon-flag"></i><?=LangAdmin::get('Seo')?></a>
</li>
<? } ?>

<li data-route="contents">
    <a href="<?=$url->AssignClearCmd('contents')?>"><i class="icon-file"></i><?=LangAdmin::get('Contents')?></a>
</li>

<? $disabled = (! RightsManager::hasRight(RightsManager::RIGHT_CATALOGMANAGEMENT)); ?>
<? if (! $disabled) { ?>
<li data-route="catalog" class="<?=$disabled ? 'disabled' : ''?>">
    <a href="<?=$disabled ? 'javascript:;' : $url->AssignClearCmd('categories')?>">
        <i class="icon-list-alt"></i><span class="hidden-tablet"> <?=LangAdmin::get('Catalog')?></span>
    </a>
</li>
<? } ?>

<? $disabled = (! RightsManager::isAvailableCmd('users')); ?>
<? if (! $disabled) { ?>
<li data-route="users" class="<?=$disabled ? 'disabled' : ''?>">
    <a href="<?=$disabled ? 'javascript:;' : $url->AssignClearCmd('users')?>">
        <i class="icon icon-black icon-group"></i><?=LangAdmin::get('Users')?>
    </a>
</li>
<? } ?>

<li data-route="site_configuration"><a href="<?=$url->AssignClearCmd('SiteConfiguration')?>"><i class="icon-wrench"></i><?=LangAdmin::get('Configuration')?></a></li>

<? $disabled = (! RightsManager::isAvailableCmd('reports')); ?>
<? if (! $disabled) { ?>
<li data-route="reports" class="<?=$disabled ? 'disabled' : ''?>">
    <a href="<?=$disabled ? 'javascript:;' : $url->AssignClearCmd('Reports')?>">
        <i class="icon-bar-chart"></i><?=LangAdmin::get('Reports')?>
    </a>
</li>
<? } ?>

<!--
<? if (CMS::IsFeatureEnabled('ReferralProgram')) { ?>
    <li data-route="referral" <? if($url->GetCmd() == 'referral') {?>class="active"<?}?>>
        <a href="<?=$url->AssignClearCmd('referral')?>"><i class="icon icon-black icon-plus"></i><span class="hidden-tablet"> <?=LangAdmin::get('Referral_system')?></span></a>
    </li>
<? } ?>
-->

<?=Plugins::invokeEvent('onAdminNewMainMenuRender', array('url' => $url))?>

<script>
    $('[data-route="<?=$currentAdminPart?>"]').addClass('active');
</script>
