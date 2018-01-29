<?
include ("header.php");
$cid = @$_GET['cid'];
?>

<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/edit_descr.js"></script>

<div class="windialog" id="dialog-form" title="<?=LangAdmin::get('editing_the_name_of_the_goods')?>">
    <p class="validateTips"></p>
    <b><?=LangAdmin::get('product_name')?>:</b><br/>
    <textarea class="text ui-widget-content ui-corner-all" id="Title" name="Title" style="height: 360px; width: 510px"></textarea>
</div>    
<div class="windialog" id="dialog-form-descr" title="<?=LangAdmin::get('edit_the_description_of_the_goods')?>">
    <p class="validateTips"></p>
    <b><?=LangAdmin::get('description_of_goods')?>:</b><br/>
    <input type="hidden" name="ItemId" value="" />
    <textarea class="text ui-widget-content ui-corner-all" id="Description" name="Description" style="height: 360px; width: 510px"></textarea>
</div>    

<div class="main"><div class="canvas clrfix">

    <?
    if(isset($_SESSION['clear_cache'])){
        print '<div style="background-color: #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px"><h2 style="margin: 0;">'.LangAdmin::get('clear_cache_to_apply_changes').'</h2></div>';
        unset($_SESSION['clear_cache']);
    }
    ?>
        <div class="col700">
            <div class="tuning">
                
                <div id="tabs">
                    <ul>
                        <li id="itab3"><a href="#tabs-3"><?=LangAdmin::get('brands')?></a></li>
                        <li id="itab4"><a href="#tabs-4"><?=LangAdmin::get('vendors_set')?></a></li>
                    </ul>
                    
                    <span id="error" style="color:red;font-weight: bold;">
                        <? if(isset($error)) { print $error; } ?>
                    </span>
                    
                    <div id="tabs-3">
                        <div id="best-brands" class="block-container" >
                            <div class="brands-sets-block" style="display: none">
                                <select class="brands-sets-list">
                                    <option value=""><?=LangAdmin::get('choose_a_selection_of')?></option>
                                    <? foreach( $brandsSets as $bS ){ ?>
                                    <option value="<?=$bS?>" <? if(@$_COOKIE['BrandSet'] == $bS) print 'selected'; ?>><?=$bS?></option>
                                    <? } ?>
                                </select>
                            </div>

                            <br/>
                            <div id="brands-ajax-wrapper">
                            <? if (empty($brands)) {?>
                                <h3><?=LangAdmin::get('empty')?>!</h3>
                            <? } else { ?>
                                <ul class="sortable">
                                    <? foreach($brands as $item){ ?>
                                        <li class="sortlist w200" id="rec<?=$item['id']?>">
                                            <table class="valign-top nowidth">
                                                <tr>
                                                    <td width="50"><a href="../index.php?p=search&search=&brand=<?=$item['id'];?>"><img src="<?=$item['pictureurl'];?>" alt="" width="40px" height="40px"/></a></td>
                                                    <td width="50"><?=$item['Name'];?></td>
                                                    <td width="15"><a href="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=del&amp;cmd=brands&amp;id=<?=$item['id'];?>">
                                                        <img src="<?=TPL_DIR;?>i/del.png" width="12" height="12" align="middle" style="vertical-align:middle"/>
                                                    </a></td>
                                                </tr>
                                            </table>
                                        </li> 
                                        <?}?>
                                </ul>
                            <? } ?>
                            </div>
                            <div id="bands-forms" style="display: none">
                                <div class="clear"></div>
                                <div id="saveBestBrands" style="display:none;float:right;">
                                    <form action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=saveorder&amp;cmd=Set" method="post">
                                        <input type="hidden" id="pop_ids" name="ids" value=""/>
                                        <input type="hidden" name="isBrand" value="1"/>
                                        <input type="hidden" name="brandSet" value=""/>
                                        <input type="hidden" name="return" value="<?= $_SERVER['REQUEST_URI'] ?>" />
                                        <button type="submit" name="submit" value="save"><?=LangAdmin::get('save_citations')?></button>
                                    </form>
                                </div>
                                <div class="clear"></div>
                                <h3><?=LangAdmin::get('addition')?></h3>
                                <small class="ihint"><?=LangAdmin::get('adding_a_brand_is_by_its_identifier')?></small>
                                <form id="formBestBrands" action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=add&amp;cmd=Set" method="post">
                                    <input type="text" name="itemid" value="" class="text ui-widget-content ui-corner-all"/><br><br>
                                    <input type="hidden" name="isBrand" value="1"/>
                                    <input type="hidden" name="brandSet" value=""/>
                                    <button type="submit" name="submit" value="add"><?=LangAdmin::get('add_brand_to_favorites')?></button>
                                </form>
                                <br/><br/>
                                <form action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=delall&amp;cmd=Set" method="post">
                                    <input type="hidden" name="isBrand" value="1"/>
                                    <input type="hidden" name="brandSet" value=""/>
                                    <input type="hidden" name="type" value="Best"/>
                                    <button type="submit" name="submit" value="delete-all"><?=LangAdmin::get('clear_all')?></button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div id="tabs-4"><? require TPL_DIR.'vendor_set.php'; ?></div>

                </div>
            </div>
        </div>

</div></div><!-- /.main -->

<script type="text/javascript" src="js/jquery.combobox.js"></script>
<script type="text/javascript">
    
var shstat = new Array(<?=$hidden_popular?>,<?=$hidden_recom?>);

$(function(){
    $('#tabs').tabs();
    
    $('li[id^=itab]').each(function() {
        $(this).removeClass('ui-tabs-selected').removeClass('ui-state-active');
    });
    $('div[id^=tabs-]').each(function() {
        $(this).addClass('ui-tabs-hide');
    });
    
    var tab_number = <? echo (isset($_GET['active_tab'])) ? $_GET['active_tab'] : 1; ?>;
    $("#itab" + tab_number).addClass('ui-tabs-selected').addClass('ui-state-active');
    $("#tabs-" + tab_number).removeClass('ui-tabs-hide');
    
    $('.brands-sets-list').change(function(){
        var brandSetType = $(this).val();
        if(brandSetType){
            $('#bands-forms').show();
        }
        else{
            $('#bands-forms').hide();
        }
        $('#saveBestBrands').find('[value="save"]').closest('div').hide();
        $.post('index.php?cmd=Set&do=getBrandSet',{type: brandSetType},function(data){
            $('#brands-ajax-wrapper').empty();
            if(data.length){
                
                $('#brands-ajax-wrapper').append($('<ul class="sortable"></ul>'));
                var ul = $('#brands-ajax-wrapper .sortable');

                $(data).each(function(k, brand){
                    var row = $('<tr></tr>');
                    var c1 = $('<td></td>')
                        .attr('width', '50')
                        .append(
                        $('<a></a>')
                            .attr('href', '../index.php?p=search&search=&brand='+brand.Id)
                            .append(
                            $('<img />')
                                .attr({
                                    src: brand.PictureUrl,
                                    width: '40px',
                                    height: '40px'
                                })
                        )
                    );

                    var c2 = $('<td class=""></td>')
                        .attr('width', '50')
                        .text(brand.Name);

                    var deleteUrl = '<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&do=del&cmd=set&isBrand=1&type='+brandSetType+'&id='+brand.Id+'&return='+encodeURI('<?= $_SERVER['REQUEST_URI'] ?>');

                    var c3 = $('<td></td>')
                        .attr('width', '15')
                        .append(
                        $('<a></a>')
                            .attr('href', deleteUrl)
                            .append(
                            $('<img />')
                                .attr({
                                    src: '<?=TPL_DIR;?>i/del.png',
                                    width: 12,
                                    height: 12,
                                    align: 'middle'
                                })
                                .css('vertical-align', 'middle')
                        )
                    );
                    row.append(c1);
                    row.append(c2);
                    row.append(c3);

                    var table = $('<table></table>').addClass('valign-top nowidth').append(row);
                    ul.append($('<li></li>').addClass('sortlist').append(table));
                });
                ul.sortable({
                    change: function(event, ui) { 
                        $('#saveBestBrands').find('[value="save"]').closest('div').show();
                    }
                });

            }
            else{
                $('#brands-ajax-wrapper').html('<p><?=LangAdmin::get('empty')?>!</p>');
            }
            $('[name="brandSet"]').val(brandSetType);
        }, 'json');
    });
    
    $('.brands-sets-list').val('Best').change();
    $('.brands-sets-list').combobox();
    
    $( ".sortable" ).sortable({
        change: function(event, ui) { 
            $(event.target).next().next().find('[value="save"]').closest('div').show();
        }
    });
    
    $('button[type="submit"]').button();
    $('button[type="submit"][value="save"]').click(function(){
        var sortable = $(this).closest('div.block-container').find('.sortable');
        
        var result = $(sortable).sortable('toArray');
        var str = '';
        $.each( result, function(i, value){
            str += value.substr(3) + ';';
        });
        $(this).closest('form').find('[name="ids"]').val(str);
        
        $(this).closest('form').submit();
    });
});

function save_state(block)
{
    if(block == 'pop')
    {
        if (shstat[0] == 1)
        {
            $('#popular').hide();
            shstat[0] = 0;
        } else {
            $('#popular').show();
            shstat[0] = 1;
        }
    }
    
    if(block == 'rec')
    {
        if (shstat[1] == 1)
        {
            $('#recommend').hide();
            shstat[1] = 0;
        } else {
            $('#recommend').show();
            shstat[1] = 1;
        }
    }
    
    if(block == 'best-brands'){
        if (shstat[2] == 1)
        {
            $('#best-brands').hide();
            shstat[2] = 0;
        } else {
            $('#best-brands').show();
            shstat[2] = 1;
        }
    }
    $.get('index.php',{
        cmd: 'set',
        'do': 'savestat',
        statp: shstat[0],
        statr: shstat[1],
        statbb: shstat[2],
        sid: '<?=$GLOBALS['ssid']?>'
    });
}

</script>


<?
include ("footer.php");
?>