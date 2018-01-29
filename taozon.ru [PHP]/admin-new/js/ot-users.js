var Users = new Backbone.Collection();
var UsersPage = Backbone.View.extend({
    "el": ".users-wrapper",
    "events": {
        "change #perpage": "changePerPageLimit",
        "click #checkAll input": "toggleCheckAll",
        "click .top-user-actions li.ot-bulkActivateUser": "bulkActivateUserAction",
        "click .top-user-actions li.ot-bulkBanUser": "bulkBanUserAction",
        "click .top-user-actions li.ot-bulkRemoveUser": "bulkRemoveUserAction",
        "click .top-user-actions li.ot-bulkUnbanUser": "bulkUnbanUserAction",
        "click .userActions ul li.activateUser": "activateUserAction",
        "click .userActions ul li.banUser": "banUserAction",
        "click .userActions ul li.unbanUser": "unbanUserAction",
        "click .userActions ul li.removeUser": "removeUserAction",
        "click .userActions ul li.loginAsUser": "loginAsUserAction",        
        "click .export-actions li.ot-exportUsers": "exportUsers",
    },
    render: function()
    {
        //$('#data_table_sorting').dataTable();
        this.$('.ot_sortable').sortable({
            handle: 'i.icon-move'
        });
        this.$(".select_searched_list").select2();
    
        return this;
    },
    "currency_list": [],
    initialize: function(){
        this.render();
    },
    changePerPageLimit: function(ev){
        this.$('input[name=perpage]').val(this.$('#perpage').find('option:selected').val());
        this.$('#filters').submit();
    },
    bulkActivateUserAction: function(ev){
        ev.preventDefault();
		var target = this.$(ev.target);
		var button = target.parents('ul:first').prev();
        
		var self = this;
		
		var ids = [];
		$('input[name=ids]:checked').each(function() {
			ids.push(this.value);
        })
		if (ids.length == 0) {
			showError(trans.get('No_users_checked'));
			button.removeClass('disabled').find('i').attr('class', 'icon-cog');
			return false;
		}	
				
		modalDialog(trans.get('Confirm_needed'), trans.get('Really_activate_these_users'), function(){
			button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(target.data('action'), {'ids': ids}, function (data) {
            }).success(function(){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                $.each(ids, function(key, val) {				                      
					$('tr[id=' + val + ']').find('.userStatus span').attr('class', 'text-success').text(trans.get('Is_active'));
					$('tr[id=' + val + ']').find('.activateUser').remove();
				});
                showMessage(trans.get('Users_are_activated'));
            }).error(function(xhr, ajaxOptions, thrownErro){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                showError(xhr.responseText);
            });
            
        }); 
        return false;
    },
    bulkBanUserAction: function(ev){
        ev.preventDefault();
		var target = this.$(ev.target);
		var button = target.parents('ul:first').prev();
        
		var self = this;
		
		var ids = [];
		$('input[name=ids]:checked').each(function() {
			ids.push(this.value);
        })
		if (ids.length == 0) {
			showError(trans.get('No_users_checked'));
			button.removeClass('disabled').find('i').attr('class', 'icon-cog');
			return false;
		}	
				
		modalDialog(trans.get('Confirm_needed'), trans.get('Really_ban_these_users'), function(){
			button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(target.data('action'), {'ids': ids}, function (data) {
            }).success(function(){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                $.each(ids, function(key, val) {				                      
					$('tr[id=' + val + ']').find('.userStatus span').attr('class', 'text-error').text(trans.get('Is_banned'));
					self.toggleBanUserAction($('tr[id=' + val + ']').find('.banUser'));
				});
                showMessage(trans.get('Users_are_banned'));
            }).error(function(xhr, ajaxOptions, thrownErro){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                showError(xhr.responseText);
            });
            
        }); 
        return false;
    },
    bulkRemoveUserAction: function(ev){
        ev.preventDefault();
		var target = this.$(ev.target);
		var button = target.parents('ul:first').prev();        
		
		var ids = [];
		$('input[name=ids]:checked').each(function() {
			ids.push(this.value);
        })
		if (ids.length == 0) {
			showError(trans.get('No_users_checked'));
			button.removeClass('disabled').find('i').attr('class', 'icon-cog');
			return false;
		}	
		
		modalDialog(trans.get('Confirm_needed'), trans.get('Really_remove_these_users'), function(){
			button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(target.data('action'), {'ids': ids}, function (data) {
            }).success(function(){
				location.reload();
            }).error(function(xhr, ajaxOptions, thrownErro){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                showError(xhr.responseText);
            });
            
        });
        return false;
    },
    bulkUnbanUserAction: function(ev){
        ev.preventDefault();
		var target = this.$(ev.target);
		var button = target.parents('ul:first').prev();
        
		var self = this;
		
		var ids = [];
		$('input[name=ids]:checked').each(function() {
			ids.push(this.value);
        })
		if (ids.length == 0) {
			showError(trans.get('No_users_checked'));
			button.removeClass('disabled').find('i').attr('class', 'icon-cog');
			return false;
		}	
		
		modalDialog(trans.get('Confirm_needed'), trans.get('Really_unban_these_users'), function(){
			button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(target.data('action'), {'ids': ids}, function (data) {
            }).success(function(){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                $.each(ids, function(key, val) {				                      
					$('tr[id=' + val + ']').find('.userStatus span').attr('class', 'text-success').text(trans.get('Is_active'));
					self.toggleBanUserAction($('tr[id=' + val + ']').find('.banUser'));
				});
                showMessage(trans.get('Users_are_banned'));
            }).error(function(xhr, ajaxOptions, thrownErro){
				button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                showError(xhr.responseText);
            });
            
        }); 		
        return false;
    },
    editUserAction: function(ev){
        ev.preventDefault();
        showError('editUserAction: Not implemented yet');
        return false;
    },
    activateUserAction: function(ev){
        ev.preventDefault();
        var target = this.$(ev.target);
        var button = target.parents('ul:first').prev();
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
        var self = this;
        $.post(
            target.data('action'),
            {'id': target.parents('tr').attr('id')},
            function (data) {
                button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                if (! data.error) {
                    target.parents('tr').find('.userStatus span').attr('class', 'text-success').text(trans.get('Is_active'));
                    target.remove();
                    showMessage(trans.get('User_is_activated'));
                } else {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
            }, 'json'
        );
        return false;
    },
    banUserAction: function(ev) {
        ev.preventDefault();
        var target = this.$(ev.target);
        var button = target.parents('ul:first').prev();
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
        var self = this;
        $.post(
            target.data('action'),
            {'id': target.parents('tr').attr('id')},
            function (data) {
                button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                if (! data.error) {
                    target.parents('tr').find('.userStatus span').attr('class', 'text-error').text(trans.get('Is_banned'));
                    self.toggleBanUserAction(target.parent());
                    showMessage(trans.get('User_is_banned'));
                } else {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
            }, 'json'
        );
        return false;
    },
    unbanUserAction: function(ev){
        ev.preventDefault();
        var target = this.$(ev.target);
        if (target.parent().hasClass('disabled')) {
            return;
        }
        var button = target.parents('ul:first').prev();
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
        var self = this;
        $.post(
            target.data('action'),
            {'id': target.parents('tr').attr('id')},
            function (data) {
                button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                if (! data.error) {
                    target.parents('tr').find('.userStatus span').attr('class', 'text-success').text(trans.get('Is_active'));
                    self.toggleBanUserAction(target.parent());
                    showMessage(trans.get('User_is_unbanned'));
                } else {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
            }, 'json'
        );
        return false;
    },
    removeUserAction: function(ev){
        ev.preventDefault();
        confirmDialog(trans.get('Really_delete_this_user'), function(){
            var target = this.$(ev.target);
            var button = target.parents('ul:first').prev();
            button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
            button.parent().removeClass('open');
            $.post(
                target.data('action'),
                {'id': target.parents('tr').attr('id')},
                function (data) {
                    button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                    if (! data.error) {
                        showMessage(data.message ? data.message : trans.get('Notify_success'));
                        target.parents('tr').remove();
                    } else {
                        showError(data.message ? data.message : trans.get('Notify_error'));
                    }
                }, 'json'
            );
        });
        return false;
    },
    loginAsUserAction: function(ev) {
        var target = this.$(ev.target);

        /*$.post(
            target.data('action'),
            {'login': target.data('login')},
            function (data) {
                if (! data.error) {
                    $('#site_form').submit();
                } else {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
            }, 'json'
        );
        return false;*/
    },
    toggleCheckAll: function(ev){
        var self = this.$(ev.target);
        self.parents('thead').next().find('input[type=checkbox]').prop('checked', self.is(':checked'));
    },
    toggleBanUserAction: function (li) {
        if (li.attr('class') == 'banUser') {
            li.find('a').html('<i class="icon-ok"></i> ' + trans.get('Unban'));
            li.attr('class', 'unbanUser');
        } else {
            li.find('a').html('<i class="icon-ban-circle"></i> ' + trans.get('Ban'));
            li.attr('class', 'banUser');
        }
    },
    exportUsers: function(ev){
        ev.preventDefault();		
        var dataType = this.$(ev.target).parent().data('type');        
		var button = this.$('.export-users');        
        var stepLoader = 1 / (Math.ceil(this.$(ev.target).parent().data('count') / 10));
        
        button.addClass('disabled').find('i').attr('class', 'ot-preloader-micro');
        button.parent().removeClass('open');
           
        var ladda = Ladda.create(this.$('.ladda-progress-button')[0]);        
        ladda.start();
        this.exportUsersLoader(dataType, 0, stepLoader, button, ladda);       
        
        return false;
    },
    exportUsersLoader: function(dataType, position, stepLoader, button, ladda){
        var self = this;
        $.get('?cmd=users&do=exportUsers&type=' + dataType + '&position=' + position, function (data) {
            if (! data.error) {
                if (data.type != '') {
                    button.removeClass('disabled').find('i').attr('class', 'icon-cog');
                    ladda.stop();
                    window.location = '?cmd=users&do=dowmloadExportUsersFile&type=' + data.type + '&totalCount=' + data.totalCount;
                } else {
                    position = position + 100;                    
                    ladda.setProgress(stepLoader + (stepLoader * (position / 100)));                    
                    self.exportUsersLoader(dataType, position, stepLoader, button, ladda); 
                }  
            } else {
                showError(data.message ? data.message : trans.get('Notify_error'));                   
            }
        }, 'json'); 
        return false;
    }
});


$(function(){
    var U = new UsersPage();
});

$('#filters input.input-medium').each(function(){
    var self = $(this);
    var param = self.data('param');
    self.typeahead({
        source: function (query, process) {
            return $.post('index.php?cmd=users&do=ajaxSearch', {query: query, param: param}, function(data){
                if (data.items) {
                    var items = _.find(data.items, function(item){
                        if ('undefined' !== typeof item[param]) {
                            return item[param];
                        }
                    });
                } else if (data.error) {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
                var items = items || [];

                return process(items);
            }, 'json');
        }
    });
});
