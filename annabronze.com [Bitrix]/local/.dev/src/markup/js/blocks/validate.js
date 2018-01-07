jQuery(document).ready(function () {
    /* placeholder */
    jQuery('input, textarea').placeholder();

    /* validate the form*/
    jQuery.validator.addMethod("regx", function (value, element, regexpr) {
        return regexpr.test(value);
    });
    jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    });
}
)
jQuery.extend(true, window, {
    ad_shop: {
        checkJquery:function(_val){
            if (!(_val instanceof jQuery)) {
                throw 'Тип аргумента должен быть "jQuery"';
            }
            return true;
        },
        clearForm: function(_form){
            if(this.checkJquery(_form)){
                var inputJq = _form.find('input, textarea');

                inputJq.each(function(i, v){
                    var name = inputJq.eq(i).attr('name');
                    var type = inputJq.eq(i).attr('type');
                    if(name != 'sessid' && type != 'submit' && name!='default-error-text' && name!='language_id'){
                        inputJq.eq(i).val('');
                        inputJq.eq(i).attr('placeholder',inputJq.eq(i).attr('data-value'));
                    }
                });

                _form.find('select option:first').attr("selected", true);
            }
        },
        trimInput: function(_form){
            if(this.checkJquery(_form)){
                var inputJq = _form.find('input, textarea');
                inputJq.each(function(i, v){
                    inputJq.eq(i).val(inputJq.eq(i).val().trim());
                });
            }
        },
        validate: {
            rules: {
                'REGISTER[LOGIN]':{
                    required: true,
                    minlength: 2
                },
                'REGISTER[EMAIL]':{
                    required: true,
                    regx: /^[a-zA-Z\u0400-\u04ff0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?\.(?:[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?)+$/
                },
                'REGISTER[PASSWORD]':{
                    required: true,
                    minlength: 6
                },
                'REGISTER[CONFIRM_PASSWORD]':{
                    required: true,
                    minlength: 6
                },
              /* USER_PASSWORD:{
                    required: true,
                    minlength: 6
                },*/
                USER_LOGIN:{
                    required: true,
                    minlength: 2
                    //regx: /^[a-zA-Z\u0400-\u04ff0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?\.(?:[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?)+$/
                },
                USER_EMAIL:{
                    required: true,
                    regx: /^[a-zA-Z\u0400-\u04ff0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?\.(?:[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?)+$/
                },
                name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    regx: /^[a-zA-Z\u0400-\u04ff0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?\.(?:[a-zA-Z\u0400-\u04ff0-9](?:[a-zA-Z\u0400-\u04ff0-9-]{0,61}[a-zA-Z\u0400-\u04ff0-9])?)+$/
                },
            }
        }
    }
});
