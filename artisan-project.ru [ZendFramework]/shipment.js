$(function(){
    /*
	$('input.req_checkbox').each(function(){        
        is_available_goods = $(this).parents('tr').next('tr').find('.good_checkbox').length;
        if(!is_available_goods){
            $(this).attr('disabled', 'disabled');
        }
    });
	*/
	
    $('input.good_checkbox').each(function(){ 
        count = $(this).parents('tr').find('.gd_count').first().text();
            count = count.replace(',', '.');
            count = parseFloat(count);
        remains = $(this).parents('tr').find('.gd_remains').first().text();
            remains = remains.replace(',', '.');
            remains = parseFloat(remains);
        diff = count - remains;
        if(diff > 0){
            $(this).attr('disabled', 'disabled');
        }
    });
    
    $('input.req_checkbox').click(function(){
        checked = $(this).get(0).checked; 
        $(this).parents('tr').next('tr').find('.goods_list').show();
        available_goods = $(this).parents('tr').next('tr').find('.good_checkbox').length;
        if(checked){
            $(this).parents('tr').next('tr').find('.good_checkbox').each(function(){
                $(this).get(0).checked = true;
                count = $(this).parents('tr').find('.gd_count').first().text();
                    count = count.replace(',', '.');
                    count = parseFloat(count);
                remains = $(this).parents('tr').find('.gd_remains').first().text();
                    remains = remains.replace(',', '.');
                    remains = parseFloat(remains);
                diff = count - remains;
                if(diff > 0){
                    article = $(this).parents('tr').find('.gd_article').first().text();
                    alert('<span style="color: red;">Остаток на складе по артикулу '+article+' недостаточен для формирования отгрузки</span>');
                    $(this).get(0).checked = false;
                    available_goods -= 1;
                }
            });
            if(!available_goods){
                alert('<span style="color: red;">Ни один из товаров не может быть отгружен</span>');
                $(this).get(0).checked = false;
            }
        }
        else{
            $(this).parents('tr').next('tr').find('.good_checkbox').each(function(){
                $(this).get(0).checked = false;
            })
        }
    });
    $('.open_shipment_goods').toggle(function(){
        $(this).parents('tr').next('tr').find('.goods_list').show();
    }, function(){
        $(this).parents('tr').next('tr').find('.goods_list').hide();
    });
    $('#shipment-registr').click(function(){
        $('#shipment-f').show();
    });   
    
});

function check_ship_time(){
    $.ajax({
        url: "http://json-time.appspot.com/time.json?callback=?",
        async: false,
        success: function(response){
            current_date = new Date(response.datetime);
            TZoffset = current_date.getTimezoneOffset();
            lim_h = $("#shipment-f").attr("data-shiptime");
            lim = parseInt(lim_h) - 4 - TZoffset/60;
            cur_h=current_date.getHours();
            date = $("#shipment_form_sdate").val();
            day = date.substr(8, 2);
            month = date.substr(5, 2);
            year = date.substr(0, 4);
            chosen = new Date(year, month-1, day);
            diff = chosen.getTime() - current_date.getTime();
            if(cur_h >= lim){
                if(diff < 86400000){
                    $("#shipment_form_sdate").val('');
                    alert("К сожалению, на данную дату отгрузка недоступна. Просим вас указать другой день отгрузки.<br/> Обращаем внимание, что если заявка создаётся до "+lim+":00 текущего дня, то отгрузка возможна начиная с завтрашнего дня. Если заявка создаётся после "+lim+":00 текущего дня, то отгрузка возможна не ранее, чем послезавтра.");
                }
            }
            else{              
                if(diff < 0){
                    $("#shipment_form_sdate").val('');
                    alert("К сожалению, на данную дату отгрузка недоступна. Просим вас указать другой день отгрузки.<br/> Обращаем внимание, что если заявка создаётся до "+lim+":00 текущего дня, то отгрузка возможна начиная с завтрашнего дня. Если заявка создаётся после "+lim+":00 текущего дня, то отгрузка возможна не ранее, чем послезавтра.");
                }
            }
        },
        dataType: "json"
    });
}