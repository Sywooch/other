$(function(){
    $('#Country').change(function(){
        var code = $(this).find('option:selected').attr('code');
        var weight = $('[name="total_weight"]').val();
        $('#deliveries-list tbody').empty();
        $('#adr_spinner').show();
        $.get('index.php',{
            'p': 'get_delivery',
            'code' : code,
            'weight': weight
        }, function(data){

            $('#adr_spinner').hide();
            $('#empty_deliveries').hide();
            if (data.data.length) {
                $('.toast-container').remove();
            } else {
                //$('#empty_deliveries').show();
                $().toastmessage('showToast', {'text': trans.get('empty_deliveries'), 'sticky' : true, 'type': 'error'});
            }
            for(var i in data.data){
                var del = data.data[i];
                $('#deliveries-list tbody').append(
                    $('<tr></tr>')
                        .append(
                            $('<td width="5%"></td>')
                                .append(
                                    $('<input type="radio" name="model" />')
                                        .val(del.Id)
                                )
                        )
                        .append(
                            $('<td></td>')
                                .append(
                                    $('<strong></strong>')
                                        .text(del.Name)
                                )
                                .append($('<br />'))
                                .append(
                                    $('<span></span>')
                                        .text(del.Description)
                                )
                        )
                        .append(
                            $('<td></td>')
                                .append(
                                    $('<b></b>')
                                        .text(del.Price+del.CurrencySign)
                                )
                        )
                );
            }
            $('#deliveries-list tbody input[type="radio"]:first').attr('checked', 'checked');
            $('#error_message').hide();
        }, 'json');
    });
});