<? if($package_info){?>
<h2><?=LangAdmin::get('editing_a_parcel')?> <?=$package_info['id']?></h2>

<? if(@$new_package) { ?>
    <small style="color:green; font-weight: bold;"><?=LangAdmin::get('make_a_well_established')?>!</small>
<? } ?>

<? if (isset($error)) { ?>
    <font color="red"><?=$error?></font>
<? } ?>
<form action="index.php?cmd=orders&do=updatepackage&pid=<?=$package_info['id']?>&id=<?=$order_info['salesorderinfo']['id']?>" method="POST">

<table>
    <tr>
        <td><?=LangAdmin::get('zip_code_trekking')?></td>
        <td><input name="DeliveryTrackingNum" value="<?=$package_info['deliverytrackingnum']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('weight')?></td>
        <td><input name="Weight" value="<?=(float)$package_info['weight']?>"/></td></tr>
<?/*
    <tr>
        <td><?=LangAdmin::get('manually_change_in_the_price')?></td>
        <td>
            <select name="ManualPrice">
                <option value="1" <? if((int)$package_info['manualprice'] == 1) print 'selected';?>>да</option>
                <option value="0" <? if((int)$package_info['manualprice'] == 0) print 'selected';?>>нет</option>
            </select>
        </td></tr>
*/?>
    <input type="hidden" name="ManualPrice" value="1">
    <tr>
        <td><?=LangAdmin::get('status')?></td>
        <td>
            <select name="status">
                <? foreach ($statuses as $status) { ?>
                    <option name="status" value="<?=$status['id']?>" <? if((int)$package_info['statuscode'] == $status['id']) print 'selected';?>><?=$status['name']?></option>
                <? } ?>
            </select>
            <input type="hidden" name="old_status" value="<?=(int)$package_info['statuscode']?>">
        </td></tr>
    <tr>
        <td>
            <?=LangAdmin::get('shipping')?><br/> 
            <small><?=LangAdmin::get('used_to_manually_change_the_price')?></small>
        </td>
        <td>
            <input name="PriceInternal" value="<?=(float)$package_info['priceinternal']?>"/>
            <?=$package_info['currencysigncust']?>
        </td></tr>
    <? if (defined('CFG_BUYINCHINA')) { ?>
        <tr>
            <td>
                <?=LangAdmin::get('additional_shipping')?>
            </td>
            <? $disabled = ((float)$package_info['priceinternal'] > 0) ? '' : 'disabled'; ?>
            <td>
                <input type="hidden" name="PriceCurrencyCode" value="CNY" <?=$disabled?>/>
                <input type="text" name="AdditionalPrice" value="<?=round((float)$package_info['additionalprice'])?>" <?=$disabled?>/> 
                CNY
            </td>
        </tr>
    <? } ?>
    <tr>
        <td><?=LangAdmin::get('id_of_the_mode_of_delivery')?></td>
        <td>
            <? if($delivery_models) { ?>
                <select name="DeliveryModeId">
                    <? foreach($delivery_models as $model) { ?>
                        <option value="<?=$model['id']?>" <? if((string)$package_info['deliverymodeid'] == $model['id']) print 'selected';?>><?=$model['name']?></option>
                    <? } ?>
                </select>
            <? } else { ?> 
                    <input disabled="disabled" name="DeliveryModeId" value="<?=(string)$package_info['deliverymodeid']?>"/>
            <? } ?>
            
        </td></tr>  <!--deliverymodename -->
    <tr>
        <td><?=LangAdmin::get('last_name')?></td>
        <td><input name="DeliveryContactLastname" value="<?=$package_info['deliverycontactlastname']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('name')?></td>
        <td><input name="DeliveryContactFirstname" value="<?=$package_info['deliverycontactfirstname']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('middle_name')?></td>
        <td><input name="DeliveryContactMiddlename" value="<?=$package_info['deliverycontactmiddlename']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('phone')?></td>
        <td><input name="DeliveryContactPhone" value="<?=$package_info['deliverycontactphone']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('country')?></td>
        <td><input name="DeliveryCountry" value="<?=$package_info['deliverycountry']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('zip_code')?></td>
        <td><input name="DeliveryPostalCode" value="<?=(int)$package_info['deliverypostalcode']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('region')?></td>
        <td><input name="DeliveryRegionName" value="<?=$package_info['deliveryregionname']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('city')?></td>
        <td><input name="DeliveryCity" value="<?=$package_info['deliverycity']?>"/></td></tr>
    <tr>
        <td><?=LangAdmin::get('address')?></td>
        <td><input name="DeliveryAddress" value="<?=$package_info['deliveryaddress']?>"/></td></tr>
</table>
<button id="saveupdatedpackage" title="<?=LangAdmin::get('save')?>"><?=LangAdmin::get('save')?></button>
<button id="canceleditpackage" title="<?=LangAdmin::get('cancellation')?>"><?=LangAdmin::get('cancellation')?></button>
<button id="printpackage" value="<?=$package_info['id']?>" title="<?=LangAdmin::get('printpackage')?>"><?=LangAdmin::get('print')?></button>
</form>
    <? //var_dump($order_info); ?>

<script>
$("input[name=PriceInternal]").keyup(function () {
    if ($(this).val() > 0) {
        $("input[name=AdditionalPrice]").removeAttr('disabled');
    } else {
        $("input[name=AdditionalPrice]").attr('disabled','disabled')
    }
    //$("div").text(str);
})
$('#saveupdatedpackage')
    .button()
    .click(function () {
        $(this).submit();
});

$('#canceleditpackage')
    .button()
    .click(function () {
        window.location('<?=$pageurl?>&do=orderinfo&id=<?=$order_info['salesorderinfo']['id']?>&tab=3');
});

$("#printpackage")
	.button()
	.click(function () {
		var pid = $(this).val();
		window.open('http://<?=$_SERVER['SERVER_NAME']?>/admin/index.php?cmd=orders&do=printpackage&id=<?=$order_info['salesorderinfo']['id']?>&pid='+pid,'_blank');
		return false;
	});
</script>
<? }  else { ?>
    <h3><?=LangAdmin::get('no_data_received_on_the_premise')?>!</h3>
<? } ?>
