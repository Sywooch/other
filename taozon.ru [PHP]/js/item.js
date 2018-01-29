if (!Array.prototype.filter)
{
    Array.prototype.filter = function(fun /*, thisp */)
    {
        "use strict";

        if (this === void 0 || this === null)
            throw new TypeError();

        var t = Object(this);
        var len = t.length >>> 0;
        if (typeof fun !== "function")
            throw new TypeError();

        var res = [];
        var thisp = arguments[1];
        for (var i = 0; i < len; i++)
        {
            if (i in t)
            {
                var val = t[i]; // in case fun mutates this
                if (fun.call(thisp, val, i, t))
                    res.push(val);
            }
        }

        return res;
    };
}

var I_count = 0;
var actionRecountTotalPriceRequest = false;
var cartid;
var suppid;
var preLoadDescription = false;
var staticConvertedPriceList;
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

var Item = {};
Item.equals = function(x,y)
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


Item.resetForms = function(){
	/*
    $('#basket-action').find('i').removeClass('removeitem').addClass('additem');
    $('#basket-action').removeClass('remove-action').addClass('add-action');
    var i = $('#basket-action span i');
    $('#basket-action span').empty().text($('#add_to_cart').html()).prepend(i);
    $('#note-action').removeClass('btn-remove').addClass('btn-add');
    iteminfo.confid = 0;
	*/
}

Item.clearPrices = function(){
    $('#c_promo_cost').html('');
    $('#c_cost, .c_cost').css('text-decoration', 'none');

    $('.c_cost, .c_promo, .br-promo').remove();
}

Item.getConfigurationText = function(){
    Item.ctext = '';
    Item.ctext_chy = '';
    for(var i in iteminfo.configurations){
        Item.ctext += configurations[i].cname+': '+configurations[i].val[$('#'+i).val()]+' <br>';
/* *** */
        Item.ctext_chy += $('#cname'+i).attr('config_chy')+' '+$('#val'+$('#'+i).val()).attr('config_chy')+' <br>';
/* *** */
    }
    $('#c_cur').html(Item.ctext);
}

Item.getConfigurationObject = function(){
    Item.confObject = {};
    for(var i in iteminfo.configurations){
        Item.confObject[i] = $('#'+i).val();
        
    }
}

Item.searchConfig = function(){
    Item.confId = 0;
    Item.found = true;

    $('.add_to_basket').show();
    
    $('.remove_from_basket').hide();
    $('.remove_from_note').hide();

    for(var i in iteminfo.item_with_config){
        Item.found = false;
        if(Item.equals(iteminfo.item_with_config[i].config, Item.confObject)){
            Item.confId = i;
            iteminfo.confid = i;
            Item.found = true;
            break;
        }
    }
}

Item.checkAddedByUserToCarts = function(){
    $('.add_to_basket').show();
    $('.remove_from_basket').hide();
    $('.add_to_note').show();
    $('.remove_from_note').hide();

    for(var i in iteminfo.addedToCart){
        if (iteminfo.confid==iteminfo.addedToCart[i].configurationid) {
            $('.add_to_basket').hide();
            $('.remove_from_basket').show();
            cartid = iteminfo.addedToCart[i].id;
            iteminfo.addedToCartId = iteminfo.addedToCart[i].id;

        }
    }

    for(var i in iteminfo.addedToNote){
        if (iteminfo.confid==iteminfo.addedToNote[i].configurationid) {
            $('.add_to_note').hide();
            $('.remove_from_note').show();
            suppid = iteminfo.addedToNote[i].id;
            iteminfo.addedToNoteId = iteminfo.addedToNote[i].id;

        }
    }
}

Item.deleteFormCart = function(conf_id){
    for(var i in iteminfo.addedToCart){
        if (conf_id==iteminfo.addedToCart[i].id) {
            delete iteminfo.addedToCart[i];
        }
    }
}

Item.deleteFormNote = function(conf_id){
    for(var i in iteminfo.addedToNote){
        if (conf_id==iteminfo.addedToNote[i].id) {
            delete iteminfo.addedToNote[i];
        }
    }
}

Item.setItemProperties = function (obj) {
    if (obj != undefined)
        var conf = obj;
    else
        var conf = iteminfo.item_with_config[Item.confId];


    delta = {};
    if (typeof conf === 'undefined') {
        //Нет конфига - нельзя купить!        
        $('.add_to_basket').addClass('disabled');
        $('.add_to_note').addClass('disabled');
        return 0;
    }


    if (conf != undefined) {
        $('.add_to_basket').removeClass('disabled');
        $('.add_to_note').removeClass('disabled');
        if (iteminfo.configurations && conf != undefined) {
            $('#c_count').html(conf.quantity + ' ' + langs.pcs);
            $('input#quantity').attr('max', conf.quantity);
        }
        if (conf.quantity != undefined)
            iteminfo.maxcount = conf.quantity;
    }
    $('#c_cost').html('');
    for (var i in conf.PriceWithoutDelivery) {
        var cpl = conf.PriceWithoutDelivery[i];

        delta[cpl.Sign] = 0;

        if (i != 0)
            $('#c_cost').append('<br class="br-promo" />');
        $('#c_cost').append(
            $('<b></b>')
                .addClass('c_cost')
//                .text((parseFloat(cpl.Val)+parseFloat(delta[cpl.Sign])).toFixed(iteminfo.CFG_ROUND_DECIMALS)+cpl.Sign)
                .text(sdf_FTS(parseFloat(cpl.Val), iteminfo.CFG_ROUND_DECIMALS, ' ') + ' ' + cpl.Sign)
                .attr('sign', cpl.Sign)
        );
    }    
    
    calculateOneTotalPrice(conf.ConvertedPriceList); 
    
    if (iteminfo.promo != null) {
        //promo_static добавили чтобы избежать конфликта в iteminfo.promo.Id        
        if (typeof iteminfo.promo_static !== 'undefined') {
            if (typeof iteminfo.promo_static.Id === 'undefined') {
                for (var j in iteminfo.promo) {
                    if (iteminfo.promo[j].Id != Item.confId)
                        continue;

                    if (typeof iteminfo.promo[j].Price.PriceWithoutDelivery === 'undefined') {
                        continue;
                    }
                    var p = iteminfo.promo[j].Price.PriceWithoutDelivery.ConvertedPriceList;

                    calculateOneTotalPrice(iteminfo.promo[j].Price.ConvertedPriceList); 
                
                    $('.c_cost').css({
                        'text-decoration': 'line-through',
                        'color': '#676767'
                    });
                    for (i in p) {
                        $(' <b class="c_promo"> ' + sdf_FTS(parseFloat(p[i].Val), iteminfo.CFG_ROUND_DECIMALS, ' ') + ' ' + p[i].Sign + '</b>').insertAfter($('b[sign="' + p[i].Sign + '"]'));
                    }
                    break;
                }            
            } else {
                var p = iteminfo.promo_static.Price.PriceWithoutDelivery.ConvertedPriceList;                
                calculateOneTotalPrice(iteminfo.promo_static.Price.ConvertedPriceList);
                $('.c_cost').css({
                    'text-decoration': 'line-through',
                    'color': '#676767'
                });

                for (i in p) {
                    $(' <b class="c_promo"> ' + sdf_FTS(parseFloat(p[i].Val), iteminfo.CFG_ROUND_DECIMALS, ' ') + ' ' + p[i].Sign + '</b>').insertAfter($('b[sign="' + p[i].Sign + '"]'));
                }

            }
        }
    }
}

Item.setDefaultConfig = function(configId){
    if(typeof configId == 'undefined' || !configId)
        return ;
    if(typeof iteminfo.item_with_config[configId] == 'undefined')
        return;
    if(typeof iteminfo.item_with_config[configId].config == 'undefined')
        return;
    for(var i in iteminfo.item_with_config[configId].config){
        if(typeof i == 'undefined')
            continue;
        $('#'+i).val(iteminfo.item_with_config[configId].config[i]);
    }
}

Item.changeConf = function(){
    if(iteminfo.isvalidpromotions == 'false')
        getPromotions();
    iteminfo.isvalidpromotions = true;
    if(iteminfo.configurations){
        Item.resetForms();
        Item.clearPrices();
        Item.getConfigurationText();
        Item.getConfigurationObject();
        Item.searchConfig();
        if(Item.found)
            Item.checkAddedByUserToCarts();
                
        Item.setItemProperties();
    }
    else{
        Item.checkAddedByUserToCarts();
        Item.setItemProperties(iteminfo.price);
    }

    $('#c_cur_row').show();
    recountTotalPrice();
}

function changeconfig(confid){
    Item.setDefaultConfig(confid);
    Item.changeConf();
    if((!confid || confid==undefined || confid == '') && iteminfo.confid){
        if(document.location.href.split('#').length>1){
            document.location.href=document.location.href.split('#')[0]+'#'+iteminfo.confid;
        }
        else{
            document.location.href=document.location.href+'#'+iteminfo.confid;
        }
				
    }
}


function showOverlay(){
    var h = $('#overlay').parent().height();
    $('#overlay').css({
        height: h+'px',
        display: 'block'
    });
}
function hideOverlay(){
    $('#overlay').hide();
}
function wrapperRecountTotalPrice(i_count_local) {
    setTimeout(function() {
        if (i_count_local == I) {
            $('#total').html('<img src="i/ajax-loader-transparent.gif" />');
            if (iteminfo.count != 1) {
                recountTotalPrice();
            } else {
                Item.changeConf();
            }
        }
    }, 500);
}
function recountTotalPrice() {
	
    actionRecountTotalPriceRequest = true;	
	iteminfopost = {
        id: iteminfo.id,
        promoid: iteminfo.promoid,
		confid: iteminfo.confid,
		count: iteminfo.count
    };
    if (iteminfo.count != 1) {        
        $.post('index.php?p=getprice',iteminfopost,function(data){		
            $('#total').html('');            
            for(var i in data['prices']){
                if(typeof window['onItemPricesReceived'] == 'function'){
                    window.onItemPricesReceived(data['prices'][i]);
                }
                $('#total').append(
                    $('<div></div>')
                        .addClass('mb5')
//                     .html(data['prices'][i]+i)
                        .html(sdf_FTS(data['prices'][i], iteminfo.CFG_ROUND_DECIMALS, ' ') + ' '+i)
                    );
            }            
        }, 'json');
    } 
    I = 0;
    actionRecountTotalPriceRequest = false;
}

function getPromotions(){
    var mPromo;
    if (iteminfo.count != 1) {        
        $.ajax({url: 'index.php?p=getpromotions&itemid='+iteminfo.id,
            dataType: 'json',
            success: function(data){
                if (!data) return;
                if (data[0] == 'NotAvailable') {
                    setTimeout(getPromotions, 3000);
                    return;
                } else {
                    iteminfo.promoid = data.PromoId;
                    delete data.PromoId;
                    mPromo = data;
                    
                }
            }
        });
    } else {        
        mPromo = iteminfo.promo_static;
    }
    iteminfo.promo = mPromo;
    Item.clearPrices();
                
    if (iteminfo.configurations) {                    
        Item.setItemProperties();
    } else {        
        if (mPromo[0] != null) {
            iteminfo.promo_static = mPromo[0];
        } else {
            iteminfo.promo_static = mPromo;
        }
        Item.setItemProperties(iteminfo.price);
    }    
    recountTotalPrice();
}

function calculateOneTotalPrice(data){
    $('#total').html('');
    for (var i in data) {
            var cpl = data[i];
            if(typeof window['onItemPricesReceived'] == 'function'){
                window.onItemPricesReceived(cpl.Val);
            }
            $('#total').append(
                $('<div></div>')
                .addClass('mb5')
                .html(sdf_FTS(cpl.Val, iteminfo.CFG_ROUND_DECIMALS, ' ') + ' '+cpl.Sign)
            );
        }
}

function tr_desc()
{
    $('#tr_but').hide();
    document.getElementById('photos-inner').innerHTML = $('#translation_loading').html()+'...';
    $.ajax({
        url: 'index.php?p=itemdescriptiontranslated&itemid='+iteminfo.id,
        success: function(data) {
            $('#photos-inner').html(data);
        }
    });
}
function itemtraderateinfo(){
    if ($('#TAOBAOcomments').html()) return;
    $('#TAOBAOcomments').html('<div class="spinner"></div>');
    $.ajax({
        url: 'index.php?p=itemtraderateinfo&itemid='+iteminfo.id,
        success: function(data) {
            $('#TAOBAOcomments').html(data);
        }
    });
}

function add_to_basket(){
    
    var conf_id = iteminfo.confid;
    var conf_item = '';
    if(Item.ctext != undefined)
        conf_item = Item.ctext.split(' <br>').join(';').substr(0, Item.ctext.split(' <br>').join(';').length-1);
    else
        conf_item = '';

    var conf_item_china = '';
    if(Item.ctext_chy != undefined)
        conf_item_china = Item.ctext_chy.split(' <br>').join(';').substr(0, Item.ctext_chy.split(' <br>').join(';').length-1);
    else
        conf_item_china = '';

    var quantity = $('#quantity').val();

    if(isNaN(iteminfo.maxcount) || iteminfo.maxcount == 0){
        $().toastmessage('showToast', {'text': $('#item_not_exist').html(), 'stayTime': 6000, 'type': 'warning'});
        return false;
    }

    showOverlay();
    var params = $('#addToBasket').serializeArray();
    params[params.length] = {name: 'quantity', value: quantity};
    params[params.length] = {name: 'configurationId', value: conf_id};
    params[params.length] = {
        name: 'itemConfiguration',
        value: conf_item
            .split(' ').filter(function(data){return data;}).join(' ')
            .split(' \n ').join('')
    };
    params[params.length] = {name: 'itemConfigurationChina', value: conf_item_china};
    params[params.length] = {name: 'promoId', value: iteminfo.promoid};
	params[params.length] = {name: 'ItemURL', value: location.href};
	
	
	
    $.post('index_ajax.php?p=add_to_basket', params, function(data){        	
        var i = data.Count;
        $('.mydata.basket i').text(i);
		
		iteminfo.addedToCart.push({configurationid:conf_id, id:data.itemId});

		$('.add_to_basket').hide();
		$('.remove_from_basket').show();
        hideOverlay();
        $().toastmessage('showToast', {'text': $('#good_added_to_cart').html(), 'stayTime': 6000, 'type': 'success'});
    }, 'json')
        .error(function(xhr, ajaxOptions, thrownError){
            hideOverlay();
            $().toastmessage('showToast', {'text': $('#good_not_added').html() + "<br /><b>" + xhr.responseText + "</b>", 'stayTime': 6000, 'type': 'error'});
        });

    return true;
}

function add_to_note(){
    showOverlay();

    var conf_id = iteminfo.confid;
    var conf_item = '';
    if(Item.ctext != undefined)
        conf_item = Item.ctext.split(' <br>').join(';').substr(0, Item.ctext.split(' <br>').join(';').length-1);
    var quantity = $('#quantity').val();

    var params = $('#addToFavourites').serializeArray();
    params[params.length] = {name: 'quantity', value: quantity};
    params[params.length] = {name: 'configurationId', value: conf_id};
    params[params.length] = {name: 'itemConfiguration', value: conf_item};
    params[params.length] = {name: 'promoId', value: iteminfo.promoid};

    $.post('index_ajax.php?p=add_to_favourites', params, function(data){
		
        var i = data.Count;
        $('.mydata.favorites i').text(i);
                
		iteminfo.addedToNote.push({configurationid:conf_id, id:data.itemId});
        
        $('.mydata.favorites i').text(data.Count);
		
		
		$('.add_to_note').hide();
		$('.remove_from_note').show();
        
        hideOverlay();
        $().toastmessage('showToast', {'text': langs.good_added_to_fav, 'stayTime': 6000, 'type': 'success'});
    }, 'json')
        .error(function(xhr, ajaxOptions, thrownError){
            hideOverlay();
            $().toastmessage('showToast', {'text': $('#good_not_added').html() + "<br /><b>" + xhr.responseText + "</b>", 'stayTime': 6000, 'type': 'error'});
        });
}

function remove_from_basket(){
	
    showOverlay();	
    var params = {
        p: 'basketremove',
        addedToCartId: iteminfo.addedToCartId
    };
	
    $.get('index.php', params, function(data){
        if(data.Success == 'Ok'){            
            var i = data.Count;
            $('.mydata.basket i').text(i);
			
			$('.add_to_basket').show();
			$('.remove_from_basket').hide();	
            
			Item.deleteFormCart(iteminfo.addedToCartId);
            
            hideOverlay();
            $().toastmessage('showToast', {'text': $('#good_deleted_from_basket').html(), 'stayTime': 6000, 'type': 'success'});

        } else {
            hideOverlay();
            $().toastmessage('showToast', {'text': $('#product_not_removed').html(), 'stayTime': 6000, 'type': 'error'});
        }
    }, 'json');

    return true;
}

function remove_from_note(){
    showOverlay();
	
    
    $.get('index.php?p=supportlistremove&',
        {
            p: 'supportlistremove',
            id: iteminfo.addedToNoteId
        },
        function(data){
            var i = $('.mydata.favorites i').text();
            
            
            if(data.Success == 'Ok'){               
                $('.mydata.favorites i').text(parseInt(i)-1);
                var i = data.Count;
                $('.mydata.favorites i').text(i);
				
				$('.add_to_note').show();
				$('.remove_from_note').hide();				
				Item.deleteFormNote(iteminfo.addedToNoteId);
                hideOverlay();
                $().toastmessage('showToast', {'text': langs.good_removed_from_fav, 'stayTime': 6000, 'type': 'success'});
            } else {
                hideOverlay();
                $().toastmessage('showToast', {'text': langs.product_not_removed, 'stayTime': 6000, 'type': 'error'});
            }
        }, 'json');
}


function init(iteminfoAjax, langsAjax){
    if(iteminfoAjax != undefined)
        iteminfo = iteminfoAjax;
    if(langsAjax != undefined)
        langs = langsAjax;
    
    changeconfig(window.location.hash.replace("#",""));
    
    $('#product-tabs li a').click(function(){
        $('#product-tabs li').removeClass('active');
        $(this).parent().addClass('active');
        $('.tabs-content div.tab').hide();
        $('div#'+$(this).parent().attr('tab')).show();

        return false;
    });
    $('#product-tabs li').click(function(){
        $('#product-tabs li').removeClass('active');
        $(this).addClass('active');
        $('.tabs-content div.tab').hide();
        $('div#'+$(this).attr('tab')).show();
    });
    
    $('[attr="tab2"]').click(function(){
        if (preLoadDescription == false) {
            $('#photos-inner').html('<div class="spinner"></div>');
            $.ajax({
                url: 'index.php?p=itemdescription&itemid='+iteminfo.id,
                success: function(data) {
                    $('#photos-inner').html(data);
                    preLoadDescription = true;
                }
            });
        }
        return false;
    });
    
    $('#basket-action.add-action').live('click', function(){
        if ($('.add_to_basket').hasClass('disabled')) {
            $().toastmessage('showToast', {'text': langs.sell_not_allowed_without_config, 'stayTime': 6000, 'type': 'warning'});
        } else {
            add_to_basket();
        }
        return false;
    });
    $('#basket-action.remove-action').live('click',function(){
        remove_from_basket();
        return false;
    });
    $('#note-action.btn-add').live('click', function(){
        if ($('.add_to_note').hasClass('disabled')) {
            $().toastmessage('showToast', {'text': langs.sell_not_allowed_without_config, 'stayTime': 6000, 'type': 'warning'});
        } else {
            add_to_note();
        }
        return false;
    });
    $('#note-action.btn-remove').live('click', function(){
        remove_from_note();
        return false;
    });

    $('#main-image').closest('a').colorbox();

    $('.plus').click(function(){
        if (actionRecountTotalPriceRequest) return false;
        var q = parseInt($('#quantity').val());
        var m = parseInt($('#quantity').attr('max'));
        if (q >= m) {
            $('#quantity').val(m);
            return false;
        }
        $('#quantity').val(parseInt(q)+1);
        iteminfo.count = parseInt(q)+1;

        I++;
        wrapperRecountTotalPrice(I);
    });

    $('.minus').click(function(){
        if (actionRecountTotalPriceRequest) return false;
        var q = parseInt($('#quantity').val());
        if(q>1){
            $('#quantity').val(parseInt(q)-1);
            iteminfo.count = parseInt(q)-1;
        }

        I++;
        wrapperRecountTotalPrice(I);
    });

    $('#quantity').keydown(function() {
        if (actionRecountTotalPriceRequest) return false;
    });

    $('#quantity').keyup(function() {
        if (actionRecountTotalPriceRequest) return false;
        var q = parseInt($('#quantity').val());
        var m = parseInt($('#quantity').attr('max'));
        if (q > m) {
            $('#quantity').val(m);
            q = m;
        }
        if (q > 0) {
            iteminfo.count = q;
        }

        I++;
        wrapperRecountTotalPrice(I);
    });

    $('.switch').click(function(){

        $('#main-image').attr('src', $('#main-image').attr('default'));

        var img = new Image();
        var switchClass = $(this);
        img.onload = function(){
            $('#main-image').attr('src', switchClass.attr('mini-pic')); //+'_310x310.jpg'
            $('#main-image').closest('a').attr('href', switchClass.attr('mainpic'));
            $('#main-image').closest('a').colorbox();
        }
        img.src = $(this).attr('href'); //+'_310x310.jpg'

        return false;
    });

    
	
	//$('#total').html('');

    startconf = false;
	//Выводим картинку если такова есть
	//Ищем конфигурацию
	for(var i in iteminfo.item_with_config){
		if (i==iteminfo.confid) {
			startconf = iteminfo.item_with_config[i].config;			
		}
	///	alert(JSON.stringify(iteminfo.item_with_config[i]));
		       
    }
	
	//выводим ее параметры в зависисмоти от конфига
    if(startconf)
	for(var i in startconf){		
		for(var j in iteminfo.configurations){
			if (i==j) {
				for(var z in iteminfo.configurations[j].values){
					if (startconf[i]==iteminfo.configurations[j].values[z].id) {						
						if ((iteminfo.configurations[j].values[z].imageurl!='') && (iteminfo.configurations[j].values[z].imageurl!=undefined)) {
							//Наконец выставляем каринку
							//alert(iteminfo.configurations[j].values[z].imageurl);
							$('#main-image').attr('src', iteminfo.configurations[j].values[z].imageurl+'_310x310.jpg');                            
                            $('#main-image-href').attr('href', iteminfo.configurations[j].values[z].imageurl);
                            $('#configPicture').val(iteminfo.configurations[j].values[z].imageurl);
                            $('#configPictureFav').val(iteminfo.configurations[j].values[z].imageurl);
						}						
					}						
				}				
			}      
   		}  
    }
	
	
	
	
}

function item_debug(message){
    if(iteminfo.debug){
        $('#item-info').append($('<div></div>').text(message));
    }
}

init();
$(function(){
    $('body').append($('<a></a>').attr({'id': 'changeconfig'}));
    $('#changeconfig').click(function(){
        changeconfig();
        return false;
    });
		
	
});