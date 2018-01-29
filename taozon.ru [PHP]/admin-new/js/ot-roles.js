var RolesForm = new Backbone.Collection();
var RolesFormPage = Backbone.View.extend({
    "el": ".roles-wrapper",
    "events": {
        "click .rolesActions a.remove_role": "removeRoleAction",
    },
    render: function()
    {
        return this;
    },
    initialize: function(){
        this.render();
    },
    removeRoleAction: function(ev){
        ev.preventDefault();
        var target = this.$(ev.currentTarget);
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_remove_these_roles'), function(){
            $.post(target.data('action'), {'name': target.data('name')}, function (data) {
            }).success(function(){
                location.reload();
            }).error(function(xhr, ajaxOptions, thrownErro){
                showError(xhr.responseText);
            });
            
        });
        return false;
    }
});

$(function(){
    var UF = new RolesFormPage();
});
