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

function setCosts(elemid, num){
    $('#add-to-basket-'+elemid+' input[name="quantity"]').val(num);
    showOverlay();
    $.get(
        'index.php?p=editnoteitemquantity&id=' + elemid + '&num=' + num,
        function(data) {
            var total = parseInt(0);
            var sign;
            $(data).each(function(k, item){
                sign = item.CurrencySign;
                $('#price-1-'+item.Id).text(sdf_FTS(Math.round(item.Cost / item.Quantity), 2 , ' ')   );
                //$('#count-'+item.Id).val(item.Quantity);
                $('#total-price-'+item.Id).html(sdf_FTS(parseFloat(item.Cost), 2 , ' ') + " " +   item.CurrencySign);
                total+=parseFloat(item.Cost);
            });
            $('#price').html(sdf_FTS(Math.round(total*10)/10, 2 , ' ') + " " + sign);
            hideOverlay();
        }, 'json'
    );
}

$(function(){
    $('input[name=deleter]').change(function() {
        if($(this).is(':checked')) {
            $(this).parent().parent().css('background-color', '#FFCC99');
        } else {
            $(this).parent().parent().css('background-color', 'white');
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
                $(this).parent().parent().css('background-color', 'white');
            });
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
    $('.copy').click(function(){
        var itemid = $(this).attr('itemid');
        var comment = $('textarea[itemid="'+itemid+'"]').val();

        $.get(
            'index.php', 
            {
                p: 'editnoteitemcomment',
                id: itemid,
                comment: comment
            },
            function(data) {
            }
        );
        $('#message').html($('#comment_saved').val()+'!');
        $("#dialog-form").dialog("open");
    });
    
    $('.add-to-basket').click(function(){
        var itemid = $(this).attr('itemid');
        $('#add-to-basket-'+itemid).submit();
        return false;
    });
});


function add_group_to_basket () {
    var checkboxes = $('input[name=deleter]');
    var count = checkboxes.filter(':checked').length;
    
    if (count) {
        showOverlay();
        checkboxes.each(function() {
            var itemid = $(this).val();
            if($(this).is(':checked')) {
                $.get(
                    'index.php', 
                    {
                        p: 'MoveItemFromNoteToBasket',
                        id: itemid
                    },
                    function(data) {
                        count--;
                        if (!count) {
                            document.location.href = "index.php?p=supportlist";
                        }
                    }
                );
            }
        });    
    }
}
