var UsersForm = new Backbone.Collection();
var RolesFormPage = Backbone.View.extend({
    "el": ".roles-form-wrapper",
    "events": {
        "click button.cancel" : "cancelEdit",
        "click div.tree_rights h4 input" : "clickInputRootRights",
        "click div.tree_rights ul input" : "clickInputRights",
        "change .template_role select" : "changedTemplateRole",
        "keyup input#RoleName": "onKeyUpInput",
    },
    render: function()
    {
        return this;
    },
    initialize: function(){
        this.render();
    },
    changedTemplateRole: function(ev){
        var target = this.$(ev.currentTarget);
        if (target.val()) {
            $('input.not_from_template').attr('disabled', 'disabled');

            if (target.val() == "SuperAdmin") {
                $('input.not_from_template').prop('checked', true);
            } else {
                $('input.not_from_template').prop('checked', false);
                
                $(".roles-form-wrapper .well").append('<i class="ot-preloader-medium preloader-centered"></i>');        
                $.post(
                    '?cmd=roles&do=getRightsList',
                    {
                        'rolename': target.val()
                    },
                    function (data) {  
                        $('.ot-preloader-medium').remove();              
                        if (! data.error) { 
                            $.each( data.ids, function( key, value ){
                                $('input.right-' + value).prop('checked', true);
                            });                  
                            
                        } else {
                            showError(data.message ? data.message : trans.get('Notify_error'));
                        }
                    }, 'json'
                );
            }
        } else {
            $('input.not_from_template').removeAttr('disabled');
        }
    },
    cancelEdit: function(ev){
        ev.preventDefault();
        var target = this.$(ev.currentTarget);
        location.href = target.data('action');
    },
    clickInputRootRights: function(ev){
        var target = $(ev.currentTarget);
        var level = target.data('level');
        var checked = target.is(':checked');
        this.checkNextInputRights(target.parent(), level, checked);
    },
    clickInputRights: function(ev){
        var target = $(ev.currentTarget);
        var level = target.data('level');
        var checked = target.is(':checked');

        this.checkNextInputRights(target.parent().parent(), level, checked);
    },
    checkNextInputRights: function(element, level, checked){
        var input = $(element.next().find('input'));
        if (input.data('level') > level) {
            if (checked) {
                input.prop('checked', true);
            } else {
                input.prop('checked', false);
            }
        } else {
            return;
        }
        this.checkNextInputRights(input.parent().parent(), level, checked);
    },
    onKeyUpInput: function(ev){
        var target = this.$(ev.currentTarget);
        var value = target.val();
        target.val(value.replace(/[^A-zА-яЁё0-9]+/g,''));
    }
});

$(function(){
    var UF = new RolesFormPage();
});
