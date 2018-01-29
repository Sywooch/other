var oData;
var FullItemInfo;
var confObject;
var confId;
var basketID;
var isChangingConfigProcess = false;

function equals(x,y)
{
    if(x == undefined)
        return false;
    if(y == undefined)
        return false;
    var p;
    for(p in y) {
        if(typeof(x[p])=='undefined') {return false;}
    }

    for(p in y) {
        if (y[p]) {
            switch(typeof(y[p])) {
                case 'object':
                    if (!y[p].equals(x[p])) {return false;}break;
                case 'function':
                    if (typeof(x[p])=='undefined' ||
                        (p != 'equals' && y[p].toString() != x[p].toString()))
                        return false;
                    break;
                default:
                    if (y[p] != x[p]) {return false;}
            }
        } else {
            if (x[p])
                return false;
        }
    }

    for(p in x) {
        if(typeof(y[p])=='undefined') {return false;}
    }

    return true;
}

function getConfigurationObject(){
    confObject = {};
    for(var i in FullItemInfo.configurations){
        confObject[i] = $('#'+i).val();
    }
}

function searchConfig(){
    confId = 0;
    for(var i in FullItemInfo.item_with_config){
        if(equals(FullItemInfo.item_with_config[i].config, confObject)){
            confId = i;
            break;
        }
    }
}

//// Преобразует число в строку формата 1_separator000_separator000._decimal
// _number - число любое, целое или дробное не важно
// _decimal - число знаков после запятой
// _separator - разделитель разрядов
function sdf_FTS(_number, _decimal, _separator) {
    // определяем, количество знаков после точки, по умолчанию выставляется 2 знака
    var decimal=(typeof(_decimal)!='undefined')?_decimal:2;

    // определяем, какой будет сепаратор [он же разделитель] между разрядами
    var separator=(typeof(_separator)!='undefined')?_separator:'';

    // преобразовываем входящий параметр к дробному числу, на всяк случай, если вдруг
    // входящий параметр будет не корректным
    var r=parseFloat(_number)

    // так как в javascript нет функции для фиксации дробной части после точки
    // то выполняем своеобразный fix
    var exp10=Math.pow(10,decimal);// приводим к правильному множителю
    r=Math.round(r*exp10)/exp10;// округляем до необходимого числа знаков после запятой

    // преобразуем к строгому, фиксированному формату, так как в случае вывода целого числа
    // нули отбрасываются не корректно, то есть целое число должно
    // отображаться 1.00, а не 1
    rr=Number(r).toFixed(decimal).toString().split('.');

    // разделяем разряды в больших числах, если это необходимо
    // то есть, 1000 превращаем 1 000
    b=rr[0].replace(/(\d{1,3}(?=(\d{3})+(?:\.\d|\b)))/g,"\$1"+separator);
    if (_decimal != 0) {
        r = b + '.' + rr[1];
    } else {
        r = b;
    }
    return r;// возвращаем результат
}

function setCosts(elemid, num){
    showOverlay();
    $.get(
        'index.php?p=editbasketitemquantity&id=' + elemid + '&num=' + num,
        function(data) {
            var sign;
            $(data.Basket.Elements).each(function(k, item){
                sign = item.CurrencySign;
                //$('#price-1-' + item.Id).html(sdf_FTS(parseFloat(priceWithoutDiscount), price_round_decimals, '&nbsp;') + '&nbsp;' + sign);
                //$('#count-'+item.Id).val(item.Quantity[0]);
                $('#total-price-'+item.Id).html(sdf_FTS(parseFloat(item.Cost), price_round_decimals, '&nbsp;') + '&nbsp;' + sign);
            });
            sign = $('span.totalPrice').attr('sign');

            try {
                var cost = data.Basket.CollectionSummaries.Taobao.TotalCost.ConvertedPriceList.Internal[0];
                $('#taobaoItems .totalPrice').html(sdf_FTS(parseFloat(cost), price_round_decimals, '&nbsp;') +'&nbsp;'+ sign);
            } catch (e) {
                $('#taobaoItems .totalPrice').html(sdf_FTS(parseFloat(data.Basket.taoItemsTotalCost), price_round_decimals, '&nbsp;') +'&nbsp;'+ sign);
            }
            try {
                cost = data.Basket.CollectionSummaries.Warehouse.TotalCost.ConvertedPriceList.Internal[0];
                $('#whItems .totalPrice').html(sdf_FTS(parseFloat(cost), price_round_decimals, '&nbsp;') +'&nbsp;'+ sign);
            } catch (e) {
                $('#whItems .totalPrice').html(sdf_FTS(parseFloat(data.Basket.whItemsTotalCost), price_round_decimals, '&nbsp;') +'&nbsp;'+ sign);
            }
            $('#items-cost').html(sdf_FTS(parseFloat(data.ElementsCost), price_round_decimals, '&nbsp;') +'&nbsp;'+ sign);
            hideOverlay();
            if( data.error ){
                $('#message').html(data.error);
                $("#dialog-form").dialog("open");
            }
        }, 'json'
    );
}

function showOverlay(){
    var h = $('#overlay').parent().height();
    $('#overlay').css({
        height: h+'px',
        display: 'block'
    });
}

function hideOverlay(){
    var h = $('#overlay').parent().height();
    $('#overlay').hide();
}

function check_weight_step1() {
    var result = true;
    $.each($('.change-weight'), function() {
        if (!($(this).attr('value')) || ($(this).attr('value')==0)) {
            $("#dialog").dialog("open");
            result = false;
            return;
        }
    });
    return result;
}


function add_group_to_note () {
    var checkboxes = $('input[name=deleter]');
    var count = checkboxes.filter(':checked').length;
    if (count == 0) {        
        $("#dialog-empty").dialog("open");
        return;
    }
    if (count) {
        showOverlay();
        checkboxes.each(function() {
            var itemid = $(this).val();
            if($(this).is(':checked')) {
                $.get(
                    'index.php', 
                    {
                        p: 'move_to_favourites',
                        id: itemid
                    },
                    function(data) {
                        count--;
                        if (!count) {
                            document.location.href = "index.php?p=basket";
                        }
                    }
                );
            }
        });    
    }
}

function saveNewConfig () {
    if (! isChangingConfigProcess) {
        isChangingConfigProcess = true;
        $('#ch_con').prepend('<h1>'+trans.saving+'....</h1>');
        getConfigurationObject();
        searchConfig();
        $('#setconfig').val(basketID);
        $('#newconfig').val(confId);
        
        $('#pictureURL').val($('#'+basketID+'_pictureURL').val());
        for(var i in confObject) {            
            for(var j in FullItemInfo.configurations[i].values){
                if (FullItemInfo.configurations[i].values[j].id == confObject[i]) {
                    if (FullItemInfo.configurations[i].values[j].imageurl != '') {
                        $('#pictureURL').val(FullItemInfo.configurations[i].values[j].imageurl);
                        console.log(FullItemInfo.configurations[i].values[j].imageurl);
                    }
                }
            }
            
        }
        
        ctext = '';
        ctext_chy = '';
        
        for(var i in FullItemInfo.configurations){
            ctext += FullItemInfo.configurations[i].name+' : '+$('#'+i+' option:selected').text()+';';
            ctext_chy += $('#'+i).attr('name_cny')+' : '+$('#'+i+' option:selected').attr('op_cny')+';';
        }

        EndedPrice = 0;
            //Если есть акции
        if (FullItemInfo.Promotions['Id']!=undefined) {
            for(var i in FullItemInfo.Promotions['ConfiguredItems']){
                if (FullItemInfo.Promotions['ConfiguredItems'][i].Id==confId) {
                    for(var j in FullItemInfo.Promotions['ConfiguredItems'][i].Price.ConvertedPriceList){
                        if (FullItemInfo.Promotions['ConfiguredItems'][i].Price.ConvertedPriceList[j].Sign==$('#'+basketID+'_currencyName').val()) {
                            EndedPrice = FullItemInfo.Promotions['ConfiguredItems'][i].Price.ConvertedPriceList[j].Val;
                        }
                    }
                }
            }
        } else {
            for(var i in FullItemInfo.item_with_config[confId].ConvertedPriceList){
                if (FullItemInfo.item_with_config[confId].ConvertedPriceList[i].Sign==$('#'+basketID+'_currencyName').val()) {
                    EndedPrice = FullItemInfo.item_with_config[confId].ConvertedPriceList[i].Val;
                }
            }
        }

        $('#price').val(EndedPrice);
        $('#itemConfiguration').val(ctext);
        $('#itemConfigurationChina').val(ctext_chy);
        $('#item_id').val($('#'+basketID+'_id').val());
        $('#quantity').val($('#'+basketID+'_quantity').val());
        $('#itemTitle').val($('#'+basketID+'_itemTitle').val());
        $('#promoId').val($('#'+basketID+'_promoId').val());
        $('#categoryId').val($('#'+basketID+'_categoryId').val());
        $('#categoryName').val($('#'+basketID+'_categoryName').val());
        $('#currencyName').val($('#'+basketID+'_currencyName').val());
        $('#externalURL').val($('#'+basketID+'_externalURL').val());
        
        $('#vendorId').val($('#'+basketID+'_vendorId').val());
        $('#weight').val($('#'+basketID+'_weight').val());

        if (FullItemInfo.item_with_config[confId].quantity==0) {
            $('.save-config').prop('disabled',false);
            $('.cancel-changes').prop('disabled', false);
            $('.alert-change-form').html('Товара данной конфигурации нет в наличии.');
        } else {
            $('#changeform').submit();
        }
    }    
}

$(function(){
    var show_save_dialog_result = true;

    $('.tabs li a').on('click', function(){
        switch ($(this).parent().attr('tab')) {
            case 'whItems':
                $('.whStats').show();
                $('.taoStats').hide();
            break;

            case 'taobaoItems':
            default:
                $('.whStats').hide();
                $('.taoStats').show();
            break;
        }
    });

    $('.plus').click(function(){
        var input_id = $(this).attr('rel');
        var quan = parseInt($('#'+input_id).val());
        quan++;
        $('#'+input_id).val(quan);

        setCosts($(this).attr('itemid'), quan);
    });
    $('.minus').click(function(){
        var input_id = $(this).attr('rel');
        var quan = parseInt($('#'+input_id).val());
        if(quan > 1)
            quan--;
        $('#'+input_id).val(quan);

        setCosts($(this).attr('itemid'), quan);
    });
    $('.quantity').change(function(){
        var n = $(this).val();
        if (!(!isNaN(parseFloat(n)) && isFinite(n)))
        {
            $(this).val(1);
            setCosts($(this).attr('itemid'), $(this).val());
        } else {
            setCosts($(this).attr('itemid'), $(this).val());
        }
    });

    $('.tostep1').click(function(ev){
        ev.preventDefault();

        show_save_dialog_result = false;
        $('.copy').click();

        var timerId = setInterval(function(){
            var to_step1 = true;
            $.each($('.copy'), function(index, elem){
                if ($(elem).attr('is-change-comment') == 'true') {
                    to_step1 = false;
                }
            });

            if (to_step1) {
                if (timerId) {
                    clearInterval(timerId);
                }
                location.href = $('a.tostep1').attr('href');
            }
        }, 500);
    });

    $('.comment-area').bind('paste click', function(ev){
        var itemid = $(this).attr('itemid');
        $('#copy_' + itemid).attr('is-change-comment', 'true');
    });

    $('.copy').click(function(){
        var is_change = $(this).attr("is-change-comment");
        if (is_change == 'false') return;

        showOverlay();

        var itemid = $(this).attr('itemid');
        var comment = $('textarea[itemid="'+itemid+'"]').val();
        
        $.post(
            'index.php?p=editbasketitemcomment',
            {                
                id: itemid,
                comment: comment
            },
            function(data) {
                $('.comment[itemid="'+itemid+'"]').val(comment);
                hideOverlay();

                if( data.error ){
                    show_save_dialog_result = true;
                    $('#message').html(data.error);
                }
                else{
                    $('#copy_' + itemid).attr('is-change-comment', 'false');
                    $('#message').html($('#comment_saved').val()+'!');
                }
                if (show_save_dialog_result) {
                    $("#dialog-form").dialog("open");
                }
            }
        );
    });

    $('#makeOrderBtn').on('click', function(){
        var url = $(this).attr('href');
        params = {type: 'taobao'};
        if ($('#whItems').is(':visible')) {
            params = {type: 'warehouse'};
        }
        $(this).attr('href', $.param.querystring(url, params));
        return true;
    });

    /**
     * Step 1
     */
    var active_row = 0;
    $('.change-weight').click(function(){
        active_row = $(this);
    });
    $('.change-weight').change(function() {
        var elemid = $(this).attr('itemid');
        var weight = $(this).val();
        weight = weight.replace(/\,/, '.');
        if (isNaN(weight)) weight = 0;
        if (weight < 0) weight = 0;
        showOverlay();
        $.get('index.php',{
            p: 'editorderweight',
            id: elemid,
            w: weight
        }, function(data){
            var total = parseInt(0);
            var sign = ' '+$('#sign').html();
            $(data.Elements).each(function(k, item){
                var w = parseFloat(item.Quantity.replace(/\,/, '.')*item.Weight);
                $('.row-weight[itemid="'+item.Id+'"]').html(w.toFixed(2) + sign);
                total+=parseFloat(item.Quantity.replace(/\,/, '.')*item.Weight);
                total = Math.round(total * 100) / 100;
            });
            total = Math.round(total * 100) / 100;
            $('#total_w').html(total+sign);
            hideOverlay();
        }, 'json');
    });
    /*$('#next').click(function(){
        if(active_row){
            $.ajaxSetup({
                async: false
            });
            active_row.change();
        }
        return true;
    });*/
    $('.change-config').click(function() {       
        $("#change-window").dialog("open");
        isChangingConfigProcess = true;
        $('#ch_con').html('<h1>'+trans.loading+'....</h1>');
        basketID = $(this).attr('basketid');
		var conf_names = '';
        var basketId = $(this).attr('basketid');
        $.ajax({
            url: 'index.php?p=get_item_config&itemid=' + $(this).attr('itemid'),
            success: function(data) {
                $('#ch_con').html('');
                oData = JSON.parse(data); 
                FullItemInfo = oData.Item;          
                var currentConfigId = $('#' + basketId + '_ConfigurationId').val();
                if (oData.Item.item_with_config[currentConfigId] != undefined) {
                    var currentConfig = oData.Item.item_with_config[currentConfigId].config;
                } else {
                    var currentConfig = false
                }                
                $.each(oData.Item.configurations, function(i, config){                    
                    $('#ch_con').append(config.name+': ');
                    if (config.name_cny==undefined) {
                        name_cny_selecter = '';
                    } else {
                        name_cny_selecter = config.name_cny;
                    }
                    var s = $("<select id='"+i+"' name='"+i+"' name_cny='"+ name_cny_selecter +"'/> ");					
                    $.each(config.values, function(j, confs){
						if (confs.alias!='') {conf_names = confs.alias;} else {conf_names = confs.name;}						
                        if ((currentConfig != false) && (currentConfig[i] == confs.id)) {
                            $("<option />", {value: confs.id, text: conf_names, op_cny:confs.name_cny, selected:'selected'}).appendTo(s);
                         } else {
                            $("<option />", {value: confs.id, text: conf_names, op_cny:confs.name_cny}).appendTo(s);
                         }
                    });
                    s.appendTo("#ch_con");
                    $('#ch_con').append('<br>');
                });
                isChangingConfigProcess = false;
            }

        });
    });
    
    $('input[name=deleter]').change(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().css('background-color', '#FFCC99');
        } else {
            $(this).parent().parent().css('background-color', 'transparent');
        }
    });
    
    $('input[name=deleter_all]').click (function () {
        var thisCheck = $(this);
        if (thisCheck.is(':checked')) {
            $('input[name=deleter]').each(function(){
                $(this).attr("checked","checked");
                $(this).parent().parent().css('background-color', '#FFCC99');
            });
        } else {
            $('input[name=deleter]').each(function(){
                $(this).removeAttr("checked");
                $(this).parent().parent().css('background-color', 'transparent');
            });
        }

    });
});





