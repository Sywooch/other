var SearchProviders = new Backbone.Collection();
var SearchProvidersConfig = Backbone.View.extend({
    "el": $("#global-wrapper")[0],
    "events": {
        "mouseup #add-search": "add",
        "click #save-search": "save",
        "click .icon-remove": "deleteSearch",
        "click .icon-pencil": "editSearchTitle",
        "click .editable-submit": "saveSearchTitle",
        "click .editable-submit .icon-ok": "saveSearchTitle",
        "click .ot_sortable_list_editable": "antiEditableClick",
        "click .ot-save-theme": "saveTheme"
    },
    "select": $('select[name="new_search"]'),
    "select2Selector": '.select2-container',
    "addBtn" : $('#add-search'),
    "usedSearchs": [],
    "unUsedSearchs": [],
    initialize: function(){
        this.$('.ot_sortable').sortable({
            handle: 'i.icon-move'
        });
        this.initSearchEditables();
        this.updateSelect();
    },
    save: function (callback) {        
        this.serialize();
        var button = this.$('#save-search').button('loading');
        var params = {'usedSearchs': this.usedSearchs, 'unUsedSearchs': this.unUsedSearchs};
        var that = this;

        $.post(
            'index.php?cmd=SiteConfiguration&do=saveSearchOrder',
            params,
            function (data) {
                button.button('reset');
                if (! data.error) {
                    self.$('.badge').removeClass('badge-success').addClass('badge');
                    showMessage(data.message ? data.message : trans.get('Notify_success'));
                    that.initSearchEditables();
                } else {
                    showError(data.message ? data.message : trans.get('Notify_error'));
                }
                if ('function' === typeof callback) {
                    callback(data);
                }
            }, 'json'
        );
        
    },
    serialize: function(){
        var usedSearchs = [];
        $.each(this.$('.ot_sortable li'), function(){
            if ($(this).find('span.badge').is('span')) {
                usedSearchs.push($(this).attr('data-name'));
            }
        });        
        var unUsedSearchs = [];
        $.each(this.$('.new_search option'), function(){
            unUsedSearchs.push($(this).val());            
        });
        
        this.usedSearchs = usedSearchs;
        this.unUsedSearchs = unUsedSearchs;
    },
    deleteSearch: function (ev) {
        this.serialize();
        if (this.usedSearchs.length < 2) {
            showError(trans.get('Last_search_type_can_not_delete'));
            return false;
        }

        var item = $(ev.target).parent().parent();
        $('<option value="'+item.data('name')+'">'+item.text()+'</option>').appendTo(this.select);
        item.remove();

        this.updateSelect();
        return true;
    },
    add: function(ev){
        ev.preventDefault();
        if (this.addBtn.hasClass('disabled')) {
           return false;
        }        
        this.addBtn.addClass('disabled').attr('disabled', true);
        
        if (this.select.find('option').length == 0) {
            showError(trans.get('Nothing_to_add'));
            return false;
        }

        var option = this.select.find('option[value="'+this.select.val()+'"]');
        var search = {'Name': option.attr('value'), 'Description': option.text()};
        var newItemHtml = renderTemplate('site_config/item', {'search': search});
        option.remove();
        this.$('#chosenItems').append(newItemHtml);
        this.$(this.select2Selector).find('a span').text(this.select.find('option:first').text());
        this.updateSelect();        
        return false;
    },
    updateSelect: function () {
        var select2 = $(this.select2Selector);
        if (this.select.find('option').length == 0) {
            this.addBtn.removeAttr('disabled').addClass('disabled');
            select2.addClass('select2-container-disabled');
            select2.find('a').addClass('select2-default').off();
            select2.find('a span').text(trans.get('All_search_types_are_selected'));
        } else {
            this.addBtn.removeAttr('disabled').removeClass('disabled');
            select2.removeClass('select2-container-disabled');
            select2.find('a').removeClass('select2-default');
            select2.find('a span').text(this.select.find('option:first').text());
            this.select.select2();
        }
    },
    saveTheme: function(ev){
        var that = this;
        this.$(ev.target).closest('.ot-save-theme').attr('disabled', 'disabled');

        $.each(Themes.models, function(key, theme){
            if(activeTheme != theme.get('name'))
                return true;
            var availableThemeTemplate = renderTemplate('themes/available-theme-button', {name: theme.get('name')});
            var element = that.$('.ot-save-image-button-wrapper[data-theme="'+theme.get('name')+'"]');
            element.html(availableThemeTemplate);
            element.closest('.thumbnail').removeClass('selected_item').find('h3').css('font-weight', 'normal');
        });

        activeTheme = that.$(ev.target).closest('.ot-save-image-button-wrapper').data('theme');
        $.post('index.php?cmd=SiteConfiguration&do=save', {name: 'current_site_theme', value: activeTheme}, function(){
            that.$(ev.target).closest('.thumbnail').addClass('selected_item');
            that.$(ev.target).closest('.thumbnail').find('h3').css('font-weight', 'bold');
            var currentThemeTemplate = renderTemplate('themes/current-theme-button');
            that.$(ev.target).closest('.ot-save-image-button-wrapper').html(currentThemeTemplate);
        });

        return false;
    },
    initSearchEditables: function () {
        this.$('.ot_sortable_list_editable').editable({            
            type: 'text',
            mode: 'inline',
            inputclass: 'input-block-level',
            clear: false
        });                
    },
    antiEditableClick: function(ev)
    {                       
        ev.preventDefault();
        this.$(ev.target).editable('toggle');
        return false;
    },
    editSearchTitle: function(ev)
    {
        ev.preventDefault();
        var target = this.$(ev.target);
		var button = target.parent().find('.ot_sortable_list_editable');
        button.editable('toggle'); 
        $('.editable-container').find('.editable-cancel').remove();
        var oldTitle = target.parents('li').find('.ot_sortable_list_editable').html();
        $('.editable-container').find('input.input-block-level').val(oldTitle);
        return false;
    },
    saveSearchTitle: function(ev)
    {
        /** <!-- Проверяем на опцию запрета вне каталогв -> */
        var foundElement = $(ev.target).parent().parent();
        if ($(ev.target).hasClass('icon-ok')) {
            var loadingElement = foundElement.parent().parent().parent().parent().find('.editableform-loading');
            foundElement = foundElement.parent().find('.limit_items_by_catalog');            
        } else {
            var loadingElement = foundElement.parent().parent().parent().find('.editableform-loading');
            foundElement = foundElement.find('.limit_items_by_catalog');            
        }
        if (foundElement.html()) {
            foundElement.parent().parent().hide();
            loadingElement.show();            
            $.post(
                'index.php?cmd=SiteConfiguration&do=save',
                {'name': 'limit_items_by_catalog', 'pk': 1, 'value' :  foundElement.val()},
                function (data) {
                    if (! data.error) {
                        location.reload();
                    } else {
                        showError(data);
                    }
                }, 'json'
            );
            return false;
        }

        var line = this.$(ev.target).parents('li');
        var oldTitle = line.find('.ot_sortable_list_editable').html();
        var searchTitle = line.find('input.input-block-level').val();
        if (oldTitle == searchTitle) {
            return true;
        }
        var searchProvider = line.attr('data-name');
        var loading = line.find('.editableform-loading');
        var editableform = line.find('.editableform');
        editableform.hide();
        loading.show();
        $.post(
            'index.php?cmd=SiteConfiguration&do=saveSearchTitle',
            {'search_provider': searchProvider, 'search_title': searchTitle},
            function (data) {
                if (! data.error) {
                    line.find('.editable-container').empty().remove();
                    line.find('.ot_sortable_list_editable').html(escapeData(searchTitle)).show();
                    showMessage(data.message ? data.message : trans.get('Notify_success'));
                } else {
                    showError(data);
                    editableform.show();
                }
                loading.hide();
            }, 'json'
        );
        return false;
    }
});


var Config = new Backbone.Collection();
var ConfigPage = Backbone.View.extend({
    "el": ".config-wrapper",
    "events": {
        "mouseup #saveLogoBtn": "saveLogoAction"
    },
    render: function()
    {
        return this;
    },
    initialize: function(){
        this.render();
    },
    saveLogoAction: function(ev)
    {
        ev.preventDefault();
        var btn = this.$('#saveLogoBtn');
        if (btn.attr('disabled')) {
            return;
        }
        btn.button('loading').siblings('button').addClass('disabled');
        if (! $('.fileupload-preview img').is('img')) {
            $('input[name=existing_logo]').val('');
            $('input[name=delete_logo]').val('1');
        }
        btn.parents('form:first').ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
                btn.button('reset').siblings('button').removeClass('disabled');
                if (data && 'undefined' !== typeof data.logoUrl) {
                    $('.fileupload-preview').html('<img src="' + data.logoUrl + '" />');
                    $('input[name=existing_logo]').val(data.logoUrl);
                    $('input[name=delete_logo]').val('0');
                    showMessage(trans.get('Data_updated_successfully'));
                } else {
                    showError(data);
                }
             }
        });
        return false;
    }
});

$(function(){
    var C = new ConfigPage();
    var S = new SearchProvidersConfig();
});
