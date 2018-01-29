<?
include (TPL_ABSOLUTE_PATH."header.php");

$perpage = (isset($_GET['ps'])) ? $_GET['ps'] : '20';
$page = (isset($_SESSION['admin_zakaz_page'])) ? $_SESSION['admin_zakaz_page'] : 1;
$page = (isset($_GET['p'])) ? $_GET['p'] : $page;
if ((isset($_GET['p']))) $_SESSION['admin_zakaz_page'] = $_GET['p'];
$count = count($orders);

$pages = array(10, 20, 50, 100);

$status_order = array('', LangAdmin::get('created_by'), LangAdmin::get('awaiting_payment'), LangAdmin::get('in_processing'),
                LangAdmin::get('posted'), LangAdmin::get('canceled'), LangAdmin::get('under_consideration'), LangAdmin::get('paid'));
?>

<script>
$(function() {
        $( "#fromdate" ).datepicker();
        $( "#todate" ).datepicker();
});
</script>

<div class="main"><div class="canvas clrfix">

<!-- .col700 -->
<div class="col700 clrfix avisited">
<!-- <div class="main"><div class="canvas clrfix"> -->

    <!-- Filters -->
    <form action="index.php" method="GET">
        
        <div class="grid_3">
            <p>
                <label><?=LangAdmin::get('order_number')?>: </label>
                <input type="text" name="filter[number]"/>
            </p>
        </div>
        
        <div class="grid_3">
            <p>
                <label><?=LangAdmin::get('date_from')?>:</label>
                <input type="text" name="filter[fromdate]" id="fromdate" value="<?=@$_GET['filter']['fromdate']?>"/>
            </p>
        </div>
        
        <div class="grid_3">
            <p>
                <label><?=LangAdmin::get('date_to')?>:<br/> </label>
                <input type="text" name="filter[todate]" id="todate" value="<?=@$_GET['filter']['todate']?>"/>
            </p>
        </div>
        
        <div class="grid_4">
            <p>
            <select name="filter[status]" class="combolist">
                <option value=""><?=LangAdmin::get('select_the_status_of')?></option>
                <? foreach($status_list as $status) { ?>
                    <option value="<?=$status?>" <? if(isset($_GET['filter']) && $_GET['filter']['status'] == $status) print 'selected'; ?>><?=$status?></option>
                <? } ?>
            </select>
            </p>
        </div>
        
        <div class="grid_4">
            <label><?=LangAdmin::get('operators')?>:</label>
            <select name="filter[operatorid]" class="combolist">
                <option value=""><?=LangAdmin::get('choose_a_operator')?></option>
                <? foreach($operator_list as $operator) { ?>
                    <option value=""></option>
                    <? $operator_fio = $operator['firstname'] . ' ' . $operator['middlename'] . ' ' . $operator['lastname'];  ?>
                    <option value="<?=$operator_fio?>_<?=$operator['operatorid']?>" <? if(isset($_GET['filter']) && $_GET['filter']['operatorid'] == $operator_fio.'_'.$operator['operatorid']) print 'selected'; ?>><?=$operator_fio.'_'.$operator['operatorid'];?></option>
                <? } ?>
            </select>
        </div>

        <div class="grid_2">
            <p>
                <label>&nbsp;<br/><br/></label>
                <input type="submit" value="<?=LangAdmin::get('apply_filters')?>" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
            </p>
        </div>
        <?=@$onRenderFilterOrdersForm?>

        <input type="hidden" name="cmd" value="orders"/>
        <input type="hidden" name="p" value="1">
        
        <!-- <?=LangAdmin::get('name_of_client')?>:<input type="text" name="filter[client]"/>  
        <?=LangAdmin::get('name_of_operator')?>:<input type="text" name="filter[operator]"/> -->    
    </form>

    <span style="float:right; margin-top: 40px;"><a href="index.php?cmd=orders"><?=LangAdmin::get('reset_filters')?></a></span>
    
    <div style="clear:both;">
        <? $from = ($page - 1)*$perpage + 1; ?>
        <? $end =  min($from + $perpage - 1, count($orders)); ?>

        <strong><?=LangAdmin::get('found')?> <?=count($orders);?> <?=LangAdmin::get('orders')?> 
        <? if(count($orders)) { ?>
            ; <?=LangAdmin::get('showing')?>: <?=LangAdmin::get('with')?> <?=$from?> <?=LangAdmin::get('on')?> <?=$end?>
        <? } ?>
        </strong><br/><br/>

        <? if(isset($error)) {?> <strong style="color:red;"><?=$error;?></strong> <? } ?>
        <? if(isset($success)) {?> <strong style="color:green;"><?=$success;?></strong> <? } ?>
    </div>
    
 
    <? if(count($orders)){ //var_dump($orders);?>
    <h2><?=LangAdmin::get('orders')?></h2><br/>
    <div style="float:right;">
        <select name="perpage">
            <? foreach ($pages as $perpagecount) { ?>
            <? $selected = ($perpagecount==$perpage) ? ' selected' : ''; ?>
            <option value="<?=$perpagecount?>" <?=$selected?>><?=$perpagecount?></option>
            <? } ?>
        </select> <br/>
    </div>

    <div class="grid_16">
    <table id="orders">
        <thead>
            <tr>
                <th><?=LangAdmin::get('order_number')?></th>
                <th><?=LangAdmin::get('creation_time')?></th>
                <th><?=LangAdmin::get('amount')?></th>
                <th><?=LangAdmin::get('paid')?></th>
                <th><?=LangAdmin::get('name_of_purchaser')?></th>
                <? if(defined('CFG_TAO141')){ ?><th></th><? } ?>
                <th><?=LangAdmin::get('name_of_operator')?></th>
                <th><?=LangAdmin::get('order_status')?></th>
                <th><?=LangAdmin::get('steps_to_order')?></th>
            </tr>
        </thead>
        
        <tfoot>
        <tr>
            <td colspan="8" class="pagination">
                <? $curpage = $page; ?>
                <? $maxpage = ceil($count/$perpage); ?>
                <? for($i=1; $i <= $maxpage; $i++){ ?>
                    <? if($maxpage == 1) break; ?>
                    <? if ($curpage == $i) { ?>
                        <span class="active curved"><?=$i?></span>
                    <? }else{ ?>
                        <a class="curved" href="<?=$pageurl?>&p=<?=$i?>"><?=$i?></a>
                    <? } ?>
                <? } ?>
            </td>
        </tr>
        </tfoot>

        <tbody>
            <? $count_orders = 1; ?>
            <? for($i=$from; $i<=$from + $perpage; $i++){ ?>
                <? if($count_orders > $perpage) break; ?>
                <? if(!isset($orders[$i-1])) continue; ?>
                <? $order = $orders[$i-1];?>           
                <? $cur = $order['currencysign']; ?>
                <? $pay = round((float)$order['totalamount'] - (float)$order['remainamount'], 2); ?>
                <tr>
                    <td><a href="index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=orders&do=orderinfo&id=<?=$order['id']?>"><?=$order['id']?></a></td>
                    <td><?=$order['createddatetime']?></td>
                    <td><span class="pr"><nobr><?=round((float)$order['totalamount'],2).' '.$cur; ?></nobr></span></td> 
                    <td><span class="pr"><nobr><?=round((float)$order['totalamount'] - (float)$order['remainamount'],2).' '.$cur; ?></nobr></span></td>
                    <td>
                        <span><?=@$order['custname']; ?></span> <br/>
                        <button class="touser" value="<?=@$order['custid']?>"><?=LangAdmin::get('go')?></button><br/>
                    </td>
                    <? if(defined('CFG_TAO141')){ ?>
                    <td>
                        <span></span> <br/>
                        <button onclick="window.location = 'index.php?&sid=&cmd=OrdersExport&order=<?=$order['id']?>';">Экспорт</button><br/>
                    </td>
                    <? } ?>
                    <td><span class="pr"><?=@$order['operatorname']; ?></span></td>
                    <td>
                        <?=$order['statusname']?>
                    </td>
                    <td>
                        <? if((int)$order['cancancel']) { ?> 
                            <button class="cancelorder" value="<?=$order['id']?>"><?=LangAdmin::get('cancel')?></button><br/><br/>
                        <? } ?>

                        <? if((int)$order['canclose']) { ?>  
                            <button class="closeorder" value="<?=$order['id']?>"><?=LangAdmin::get('close')?></button><br/><br/>
                        <? } ?>

                        <? if((int)$order['canclosecancel']) { ?>  
                            <button class="closecancelorder" value="<?=$order['id']?>"><?=LangAdmin::get('cancel')?> и закрыть</button><br/><br/>
                        <? } ?>
                            
                        <? if((int)$order['canrestore']) { ?>  
                            <button class="restoreorder" value="<?=$order['id']?>"><?=LangAdmin::get('restore_the_line')?></button><br/><br/>
                        <? } ?> 
                        
                        <? if((int)$order['canpurchaseitems']) { ?>  
                            <!--<button class="purchaseorder" value="<=$order['id']?>">Заказать товар у <?=LangAdmin::get('on')?><?=LangAdmin::get('with')?>тавщика</button><br/><br/>-->
                        <? } ?>
                    </td>
                </tr>
                <? $count_orders++; ?>
            <?  }  ?>
        </tbody>
    </table>
    </div>
    <br/><br/>
    <? } ?>
</div>
        <!-- /.col700 -->
</div></div><!-- /.main -->

<script type="text/javascript" src="js/jquery.combobox.js"></script>
<script type="text/javascript">
    
$('select[name=perpage]').change(function() {
    var count = $('select[name=perpage] option:selected').val();
    //alert(count);
    location.href = 'index.php?cmd=orders&ps=' + count + '&sid=';
});

function sh(id)
{
    if (document.getElementById(id).style.display != 'block')
    {
        document.getElementById(id).style.display = 'block';
    } else {
        document.getElementById(id).style.display = 'none';
    }
}
function edit(elm, field, id)
{
    //
    if (document.getElementById('ed_'+field+id)) return;
    elm.id = 'sh_'+field+id;
    var value = elm.innerHTML;
    elm.innerHTML = '<input class="editor" id="ed_'+field+id+'" value="'+value+'"><input class="editorb" type="button" value=">>" onclick="save(this, \''+field+'\', \''+id+'\')">';
    document.getElementById('ed_'+field+id).focus();
}
function select(elm, field, id)
{
    //
    if (document.getElementById('ed_'+field+id)) return;
    elm.id = 'sh_'+field+id;
    var value = elm.innerHTML;
    elm.innerHTML = '<select class="editors" id="ed_'+field+id+'"onchange="save(this, \''+field+'\', \''+id+'\')">'+//'<option value="'+value+'">'+value+'</option>'+
        '<option value="<?=LangAdmin::get('created_by')?>"><?=LangAdmin::get('created_by')?></option>'+
        '<option value="<?=LangAdmin::get('waiting_for_payment')?>"><?=LangAdmin::get('waiting_for_payment')?></option>'+
        '<option value="<?=LangAdmin::get('in_processing')?>"><?=LangAdmin::get('in_processing')?></option>'+
        '<option value="<?=LangAdmin::get('waiting_for_additional_payments')?>"><?=LangAdmin::get('waiting_for_additional_payments')?></option>'+
        '<option value="<?=LangAdmin::get('posted')?>"><?=LangAdmin::get('posted')?></option>'+
        '</select>';
    document.getElementById('ed_'+field+id).focus();
}
function select2(elm, field, id)
{
    //
    if (document.getElementById('ed_'+field+id)) return;
    elm.id = 'sh_'+field+id;
    var value = elm.innerHTML;
    elm.innerHTML = '<select class="editors" id="ed_'+field+id+'"onchange="save(this, \''+field+'\', \''+id+'\')">'+'<option value="'+value+'">'+value+'</option>'+
        '<option value="Выкуп у <?=LangAdmin::get('on')?><?=LangAdmin::get('with')?>тавщика">Выкуп у <?=LangAdmin::get('on')?><?=LangAdmin::get('with')?>тавщика</option>'+
        '<option value="Уточнение ве<?=LangAdmin::get('with')?>а">Уточнение ве<?=LangAdmin::get('with')?>а</option>'+
        '<option value="Изменение <?=LangAdmin::get('with')?>тоимо<?=LangAdmin::get('with')?>ти">Изменение <?=LangAdmin::get('with')?>тоимо<?=LangAdmin::get('with')?>ти</option>'+
        '<option value="<?=LangAdmin::get('posted')?>"><?=LangAdmin::get('posted')?></option>'+
        '<option value="От<?=LangAdmin::get('with')?>ут<?=LangAdmin::get('with')?>твует у <?=LangAdmin::get('on')?><?=LangAdmin::get('with')?>тавщика">От<?=LangAdmin::get('with')?>ут<?=LangAdmin::get('with')?>твует у <?=LangAdmin::get('on')?><?=LangAdmin::get('with')?>тавщика</option>'+
        '<option value="<?=LangAdmin::get('temporarily_out_of_stock')?>"><?=LangAdmin::get('temporarily_out_of_stock')?></option>'+
        '<option value="<?=LangAdmin::get('no_configuration_requested')?>"><?=LangAdmin::get('no_configuration_requested')?></option>'+
        '<option value="<?=LangAdmin::get('canceled')?>"><?=LangAdmin::get('canceled')?></option>'+
        '</select>';
    document.getElementById('ed_'+field+id).focus();
}
function save(elm, field, id)
{
    //
    //alert(document.getElementById('ed_'+field+id).value);
    var server_url = 'index.php?cmd=orders&sid=<?=$GLOBALS['ssid']?>&do=setvalue&id='+id+'&field='+field+'&value='+document.getElementById('ed_'+field+id).value;
    $.ajax({
        url: server_url,
        success: function(data) {
            if (data == 'RELOGIN') location.href='index.php?expired';
            document.getElementById('sh_'+field+id).innerHTML = data;
        },
        error: function() {

        }
    });
    
}

$(function(){
    $('.combolist').combobox();
});

$("button")
    .button();

$(".cancelorder")
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = '<?=$pageurl?>&do=cancel&id=' + id;
});

$(".closeorder")
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = '<?=$pageurl?>&do=close&id='+ id;
});

$(".closecancelorder")
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = '<?=$pageurl?>&do=closecancel&id='+ id;
});

$('.restoreorder')
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = 'index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=orders&do=orderinfo&id='+ id;
});

$('.purchaseorder')
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = 'index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=orders&do=purchaseitems&id='+ id;
});

$('.touser')
    .button()
    .click(function () {
        var id = $(this).val();
        window.location.href = 'index.php?sid=<?=$GLOBALS['ssid'];?>&cmd=users&do=userinfo&id='+ id;
});

</script>

<?=@Plugins::invokeEvent('onRenderAdminOrdersList')?>

<?
include (TPL_ABSOLUTE_PATH."footer.php");
?>	