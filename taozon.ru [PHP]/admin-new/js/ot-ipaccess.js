var IpAccessPage = Backbone.View.extend({
    "el": $("#ip-wrapper")[0],
    "events": {        
		"click .ot_show_deletion_dialog_modal": "confirmDelete", 
		"click .ot_add_ip_button": "addIp",
        "click .ot_hide_ip_button": "clearAndHideIpForm",        
        "keyup #add-ip-value": "clickAddIp",
    },
	confirmDelete: function(e) {
        e.preventDefault();
        var target;
        if ($(e.target).hasClass('icon-remove-sign')) {
            target = $(e.target).parent();
        } else {
            target = $(e.target);
        }
		var ip = $(target).attr('ip');        		
        var action = $(target).attr('action');
        var msg = _.template(trans.get('delete_warning'), {item: escapeData(ip)});
        
		modalDialog(trans.get('Confirm_needed'), msg, function(){
            var $button = $(target).button('loading');
			$.post(
                action,
                {
                    ip : ip
                },
                function (data) {
                    if (! data.error) {			  
				        showMessage(trans.get('Ip_is_deleted'));
                        location.reload();
				    } else {				        
                        showError(data.message);
                        $button.button('reset');
				    }
                }, 'json'
            );
        });		
        return false;
    },
	addIp: function(e) {
        e.preventDefault();        
        var $button = this.$(e.target).button('loading');        
        $.post(
            'index.php?cmd=IpAccess&do=addIp',
            {
                ip : $("#add-ip-value").val()
            },
            function (data) {
                if (! data.error) {			  
				    showMessage(trans.get('Ip_added'));
                    location.reload();
				} else {
				    $button.button('reset');
                    showError(data.message);
				}
            }, 'json'
        );
        return false;
    },
	clickAddIp: function(e) {        
        if (e.keyCode == 13) {
            $('.ot_add_ip_button').click();
        }   
        e.preventDefault();
        return false;        
    },
	clearAndHideIpForm: function(e) {        
        $('#showIpForm').click();
        $("#add-ip-value").val('')
        return false;        
    }
});

$(function(){
    new IpAccessPage();		    
});
