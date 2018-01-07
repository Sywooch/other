//Форма подписки
function showAuthPopup() {
    var authForm=$('#authform');
    var authFormLink=$('#authFormLink');
    $.fancybox(authFormLink,{
        scrolling : 'no',
        afterClose : function() {
            var url = '/local/include/ajax_is_auth.php';
            if(languageId == 'en') {
                url = '/en' + url;
            }
            $.ajax({
                url: url,
                type: "POST",
                success: function (reply) {
                    if(reply){

                        if(IS_BASKET_PAGE){
                            if(languageId == 'en') {
                                window.location.pathname = '/en/order/';
                            }else{
                                window.location.pathname = '/order/';
                            }
                        }else{
                            window.location.reload();
                        }
                    }
                },
                error: function () {
                    console.log('Error');
                }
            });
        }
    });
}

var IS_BASKET_PAGE = 0;

jQuery(document).ready(function () {
    var formJq = jQuery('#subscribe-form');
    var subscrBut=formJq.find('.b-subscribe__btn');
    if($(".js-basket-table__is-basket-page").length){
        IS_BASKET_PAGE = 1;
    }


    /*Инициализация проверки формы*/
    formJq.validate({
        errorPlacement: function (error, element) {
            element.parents('form').addClass('_is-errors');

        },
        success:function(success,element){
            console.log(success);
            console.log(element);
            $(element).parents('form').removeClass('_is-errors');
        },
        rules: ad_shop.validate.rules
    });

    /*Отправка формы*/
    subscrBut.on('click', _funcSubscr = function () {
        var _this = jQuery(this);
        var defaultErrorText= formJq.find('input[name="default-error-text"]').val();
        var languageID=formJq.find('input[name="language_id"]').val();
        var ulr='/local/include/ajax_subscribe.php';
        if(languageID==='en'){
            ulr='/en/local/include/ajax_subscribe.php';
        }
        if (formJq.valid()) {
            ad_shop.trimInput(formJq);
            _this.off('click');
            $.ajax({
                url: ulr,
                type: "POST",
                data: formJq.serialize(),
                dataType: 'json',
                success: function (reply) {
                    ad_shop.clearForm(formJq);
                    console.log(reply);
                    if(reply.result){
                        console.log(1);
                        formJq.removeClass('_is-errors');
                        formJq.addClass('_is-success');
                        if(reply.message!==null)
                        {
                            formJq.find('.b-subscribe__form-success').text(reply.message);
                        }
                    }
                    else{
                        console.log(2);
                        formJq.removeClass('_is-success');
                        formJq.addClass('_is-errors');
                        if(reply.message!==null)
                        {
                            formJq.find('.b-subscribe__form-errors').text(reply.message);
                        }
                    }

                    _this.on('click', _funcSubscr);
                },
                error: function () {
                    _this.on('click', _funcSubscr);
                }
            });
        }
        else{
            formJq.removeClass('_is-success');
            formJq.addClass('_is-errors');
            formJq.find('.b-subscribe__form-errors').html(defaultErrorText);
        }
        return false;
    });

 /*   var regForm=$('#regForm_form');
    var regButton=regForm.find('input[name="register_submit_button"]');
    regForm.validate({
        errorPlacement: function (error, element) {
            element.parents('.b-form__row').addClass('_is-errors');
        },
        success:function(success,element){
            $(element).parents('.b-form__row').removeClass('_is-errors');
        },
        rules: ad_shop.validate.rules
    });
    regForm.find('input[type="text"],input[type="password"]').on('change',function(){

        if (regForm.valid()) {
            regButton.show();
        }
        else{
            regButton.hide();
        }
    });*/
   /* regButton.on('click', _funcRegister = function () {
        var _this = jQuery(this);
        if (regForm.valid()) {
            ad_shop.trimInput(regForm);
            _this.off('click');
            $.ajax({
                url: '/local/include/ajax_register.php',
                type: "POST",
                data: regForm.serialize(),
                dataType: 'json',
                success: function (reply) {
                    console.log(reply);
                    if(reply.valid){
                        //regForm.submit();
                        location.reload();
                        ad_shop.clearForm(regForm);
                        console.log('great');
                    }
                    else{
                        if(reply.email_error){
                            var text= $('input[name="email-exist"]').val();
                            $('input[name="REGISTER[EMAIL]"]').next().text(text);
                            $('input[name="REGISTER[EMAIL]"]').parents('.b-form__row').addClass('_is-errors');
                        }
                        else{
                            var text= $('input[name="invalid-email"]').val();
                            $('input[name="REGISTER[EMAIL]"]').next().text(text);
                            $('input[name="REGISTER[EMAIL]"]').parents('.b-form__row').removeClass('_is-errors');
                        }

                        if(reply.password_error){
                            $('input[name="REGISTER[PASSWORD]"]').parents('.b-form__row').addClass('_is-errors');
                            $('input[name="REGISTER[CONFIRM_PASSWORD]').parents('.b-form__row').addClass('_is-errors');
                        }
                        else{
                            $('input[name="REGISTER[PASSWORD]"]').parents('.b-form__row').removeClass('_is-errors');
                            $('input[name="REGISTER[CONFIRM_PASSWORD]').parents('.b-form__row').removeClass('_is-errors');
                        }

                    }

                    //authForm.submit();
                    _this.on('click', _funcRegister);
                },
                error: function () {
                    _this.on('click', _funcRegister);
                }
            });
        }
        return false;
    });
*/
    /*$('a.fancybox').on('click',function(){
        console.log( $(this).attr('href'));
        $.fancybox.close();
        $.fancybox({
            'href' : $(this).attr('href'),

        });

    });*/


    var authForm=$('#authform');
    var authFormLink=$('#authFormLink');

    $(document).on('click', '#authFormLink', function () {
        showAuthPopup();

    });




    var authFormLinkOrder=$('#authFormLinkOrder');

    $(document).on('click', '#authFormLinkOrder', function () {
        showAuthPopup();
    });



    $(document).on('click', '.regFormLink', function () {

        $.fancybox($('#regForm'),{
            scrolling : 'no',
            afterClose : function() {
                var url = '/local/include/ajax_is_auth.php';
                if(languageId == 'en') {
                    url = '/en' + url;
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    success: function (reply) {


                        if(reply){
                            if(IS_BASKET_PAGE){
                                if(languageId == 'en') {
                                    window.location.pathname = '/en/order/';
                                }else{
                                    window.location.pathname = '/order/';
                                }

                            }else{

                                if(languageId == 'en') {
                                    window.location.pathname = '/en/personal/';
                                }else{
                                    window.location.pathname = '/personal/';
                                }

                                
                            }
                        }
                    },
                    error: function () {
                        console.log('Error');
                    }
                });
            }
        });
    });

    $('.linkForgotPassword').fancybox({
        'scrolling'   : 'no',
        afterClose:function() {
            //$('#forgotpasswordForm').submit();
            //location.reload();
        }
    });


    $('#forgotpasswordForm').find('input[type="text"]').on('input',function(){
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var res= pattern.test($(this).val());
        if(res){
            $('#forgotpasswordForm').find('input[name="send_account_info"]').attr('type','submit');
            $('#forgotpasswordForm').find('input[name="send_account_info"]').show();
            $(this).parents('.b-form__row').removeClass('_is-errors');
        }
        else{
            $('#forgotpasswordForm').find('input[name="send_account_info"]').attr('type','');
            $(this).parents('.b-form__row').addClass('_is-errors');
            $('#forgotpasswordForm').find('input[name="send_account_info"]').hide();
        }
    });

   /* var forgotpassForm=$('#forgotpasswordForm');
    var forgotpassButton=forgotpassForm.find('input[type="submit"]');
   */
    /*forgotpassButton.on('click', _funcForgotPassword = function () {
        console.log(1);
    });*/

   /* forgotpassButton.on('click', _funcForgotPassword = function () {
        var _this = jQuery(this);
        if (forgotpassForm.valid()) {
            ad_shop.trimInput(forgotpassForm);
            _this.off('click');
            forgotpassForm.submit();

        }
        else{
            return false;
        }

    });*/

  /*  $('#forgotpasswordForm').validate({
        errorPlacement: function (error, element) {
            element.parents('.b-form__row').addClass('_is-errors');
        },
        success:function(success,element){
            $(element).parents('.b-form__row').removeClass('_is-errors');
        },
        rules: ad_shop.validate.rules
    });
    */

    if(languageId == 'en') {



        $('#forgotpasswordForm').submit(function(){
            var email = $("[name='USER_EMAIL']").val();

            $.ajax({
                url: "/en/local/include/ajax_en_sent_forgot_password_mail.php",
                type: "POST",
                data: "email="+email,
                success: function (reply) {
               
                }
            });

        });


    }



});


//форма авторизации