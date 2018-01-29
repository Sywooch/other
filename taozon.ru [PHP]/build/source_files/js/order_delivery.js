$(function(){
    $('#country').change(function(){
        var code = $(this).find('option:selected').attr('code');
        var weight = $('[name="total_weight"]').val();
        $.get('index.php',{
            'p': 'get_delivery',
            'code' : code, 
            'weight': weight
        }, function(data){
            console.log(data);
            
            $('#deliveries-list tbody').empty();
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
                                        .text(parseFloat(del.Price[0]).toFixed(2)+del.CurrencySign)
                                )
                        )
                );
            }
        }, 'json');
    });
});