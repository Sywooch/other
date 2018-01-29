$(function(){
    //$('input').css({'border-style':'solid','border-color': '#bd4247'});
    $('#bank-save').click(function(){
        var $button = $(this).button('loading');
        var action = $(this).closest('form').attr('action');

        $.post(action, $(this).closest('form').serializeArray(), function(data){
        })
            .success(function(){
                $('.input-xlarge').css({'border-color': '#ccc'});
                $button.button('reset');
                $('#bank-save').parent().parent().removeClass('error').addClass('success');
                $('#bank-save').next().remove();
                $('#bank-save').parent().append(
                    $('<p></p>').addClass('help-inline').text('Данные успешно сохранены')
                );
            })
            .error(function(xhr, ajaxOptions, thrownErro){
                $('.input-xlarge').css({'border-color': '#ccc'});
                $button.button('reset');
                if(thrownErro == 1){
                    var fields = eval(xhr.responseText);
                    $.each(fields, function(key, value){
                        $('#ot_'+value).css({'border-style':'solid','border-color': '#bd4247'});
                    });
                    $('#bank-save').parent().parent().removeClass('success').addClass('error');
                    $('#bank-save').next().remove();
                    $('#bank-save').parent().append(
                        $('<p></p>').addClass('help-inline').text('Неверно заполнены поля')
                    );
                }
            });
    });
});