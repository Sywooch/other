var Pricing = new Backbone.Collection();
var PricingPage = Backbone.View.extend({
    "el": $("#pricing-wrapper")[0],
    "events": {
        "click #add-currency": "add",
        "click #save-currency": "save",
        "click .remove-currency": "deleteCurrency",
        "click .ot_add_rate": "addRate",
        "change #syncmode": "changeSyncMode",
        "click .delete-rate": "deleteRate",
        "click .delete-unsafed-rate": "deleteUnSavedRate"        
    },
    "select": $('select[name="new_currency"]'),
    "firstRateSelect": $('#add-rate-from'),
    "secondRateSelect": $('#add-rate-to'),
    "select2Selector": '.select2-container',
    "addBtn" : $('#add-currency'),
    "currency_list": [],
    "currency_rates": [], 
    "syncModes": ['WithCB', 'No', 'WithHub'],    
    initialize: function() {
        this.$('.ot_sortable').sortable({
            handle: 'i.icon-move'
        });
        this.updateSelect();
        this.changeSyncMode();
        $('.ot_inline_popup_text_editable').editable({
            emptytext: 'Не заполнено',
            mode: 'popup',
        });
    },
    add: function(e) {
        e.preventDefault();
        if (this.addBtn.hasClass('disabled')) {
            return false;
        }
        if (this.select.find('option').length == 0) {
            showError(trans.get('Notify_error'));
            return false;
        }
        this.addBtn.attr('disabled', 'disabled');

        var self = this;
        $.get('templates/pricing/underscore_templates/currency.html?' + Math.random(), function (tpl) {
            var newItemHtml = _.template(tpl, {'Code': self.select.val()});
            self.$('#chosenItems').append(newItemHtml);
            self.select.find('option[value="' + self.select.val() + '"]').remove();
            self.$(self.select2Selector).find('a span').text(self.select.find('option:first').text());
            self.updateSelect();
        });
        if (self.select.val() != 'CNY') {
            $('<option value="' + self.select.val() + '">'+ self.select.val() + '</option>').appendTo(this.firstRateSelect);        
            $('<option value="' + self.select.val() + '">'+ self.select.val() + '</option>').appendTo(this.secondRateSelect);
        }
        this.addBtn.removeAttr('disabled');

        return false;
    },
    addRate: function(e) {
        e.preventDefault();
        this.serialize();
        var firstCurrency = this.firstRateSelect.val(); 
        var secondCurrency = this.secondRateSelect.val(); 
        var rate = parseFloat(this.$('#add-rate-count').val());
        var issetRate = false;        
        if (firstCurrency == secondCurrency) {
            showError(trans.get('Unable_to_set_the_rate_of_one_currency'));
            return false;
        }
        $.each(this.currency_rates, function(l, value) {
            if ((value[0] == firstCurrency && value[1] == secondCurrency) || (value[1] == firstCurrency && value[0] == secondCurrency)) {                
                issetRate = true;
            }
        });
        if ((firstCurrency == '') || (secondCurrency == '')) {
            showError(trans.get('Must_set_ratings'));
            return false;
        } 
        if (issetRate) {
            showError(trans.get('Such_or_reverse_rate_already_exists'));
            return false;
        }        
        if (isNaN(rate)) {
            showError(trans.get('You_must_set_the_rate'));
            return false;
        }
        $.get('templates/pricing/underscore_templates/rate.html?' + Math.random(), function (tpl) {
            var newItemHtml = _.template(tpl, {'rate': [firstCurrency, secondCurrency, rate]});
            self.$('.ot_currency_list').append(newItemHtml);
        }); 
        
        this.firstRateSelect.find(":first").attr("selected", "selected");
        this.secondRateSelect.find(":first").attr("selected", "selected");
        this.$('#add-rate-count').val('');
        return false;
    },
    changeSyncMode: function() {
        var self = this;
        var currentSync = self.$('#syncmode').val();         
        $.each(self.syncModes, function(l, name) {            
            self.$('#' + name).hide();           
        });      
        self.$('#' + currentSync).show();       
        return false;
    },
    deleteRate: function(e) {
        e.preventDefault();
        var target;
        if (this.$(e.target).hasClass('icon-remove')) {
            target = this.$(e.target).parent();
        } else {
            target = this.$(e.target);
        }        
        var firstCode = $(target).parent().attr('first');
        var secondCode = $(target).parent().attr('second');
        
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_the_selected_rate') + firstCode + ' - ' + secondCode + '?', function(){            
            
            $(target).removeAttr('disabled').addClass('disabled');
            $.post('index.php?cmd=pricing&do=RemoveRate', {'firstCode' : firstCode, 'secondCode' : secondCode}, function (data) {
                target.removeClass('disabled').find('i').attr('class', 'icon-remove font-14');
                if (! data.error) {
                    $(target).parent().remove();                    
                    showMessage(trans.get('Rate_was_deleted'));
                } else {
                    showError(data);
                    $(target).removeAttr('disabled').removeClass('disabled');
                }
            }, 'json');
        });       
        
        return false;
    },
    deleteUnSavedRate: function(e) {
        e.preventDefault();     
        var target;
        if (this.$(e.target).hasClass('icon-remove')) {
            target = this.$(e.target).parent();
        } else {
            target = this.$(e.target);
        }
        var firstCode = $(target).parent().attr('first');
        var secondCode = $(target).parent().attr('second');
        
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_the_selected_rate') + firstCode + ' - ' + secondCode + '?', function(){            
            $(target).parent().remove();                    
            showMessage(trans.get('Rate_was_deleted'));               
        });       
        
        return false;
    },    
    save: function(callback) {
        var self = this;

        this.$('#save-currency').attr('disabled', 'disabled');
        this.serialize();
        this.$('#currency-order').empty();
        $.each(this.currency_list, function(l, name) {
            self.$('#currency-order').append($('<input>').attr({
                name: 'currency[]',
                type: 'hidden',
                value: name
            }));
        });
        $.each(this.currency_rates, function(l, name) {
            self.$('#currency-order').append($('<input>').attr({
                name: 'rates[]',
                type: 'hidden',
                value: name
            }));
        });
        var marginValue = self.$('#'+self.$('#syncmode').val()).find('#ot_CB_currency_extra').val();
        this.$('#currency-order').append($('<input>').attr({
            name: 'margin_value',
            type: 'hidden',
            value: marginValue
        }));
        this.$('#currency-order').append($('<input>').attr({
            name: 'syncMode',
            type: 'hidden',
            value: self.$('#syncmode').val()
        }));
        
        
        var form = this.$('#currency-order');
        $.post(
            'index.php?cmd=pricing&do=saveCurrency',
            form.serialize(),
            function (data) {
                self.$('#save-currency').removeAttr('disabled');
                if (! data.error) {
                    self.$('#save-currency').attr('disabled', 'disabled');
                    self.$('.badge').removeClass('badge-success').addClass('badge');
                    showMessage(data.message ? data.message : trans.get('Notify_success'));
                    setTimeout(function() { window.location.reload() }, 5000);
                } else {
                    showError(data);
                }
                if ('function' === typeof callback) {
                    callback(data);
                }
            }, 'json'
        );
    },
    serialize: function() {        
        var currency_list = [];
        $.each(this.$('.ot_sortable li'), function() {
            currency_list.push($(this).attr('data-name'));
        });
        this.currency_list = currency_list;
        
        var currency_rates = [];
        $.each(this.$('.ot_currency_list li'), function() {
            currency_rates.push([$(this).attr('first'), $(this).attr('second'), $(this).find('a').text()]);            
        });        
        
        this.currency_rates = currency_rates;        
        this.currency_mode = this.$('#syncmode').val();        
    },
    deleteCurrency: function(ev) {
        this.serialize();
        if (this.currency_list.length < 2) {
            showError(trans.get('Currency_cant_be_deleted'));
            return false;
        }
        var item = $(ev.target).parent().parent();
        item.remove();
        $('<option value="' + item.data('name') + '">' + item.data('name') + '</option>').appendTo(this.select);
        
        if (item.data('name') != 'CNY') {
            this.firstRateSelect.find('option[value="' + item.data('name') + '"]').remove();
            this.secondRateSelect.find('option[value="' + item.data('name') + '"]').remove();
        }
        this.updateSelect();

        return true;
    },
    updateSelect: function () {
        var select2 = $(this.select2Selector);
        if (this.select.find('option').length == 0) {
            this.addBtn.removeAttr('disabled').addClass('disabled');
            select2.addClass('select2-container-disabled');
            select2.find('a').addClass('select2-default').off();
            select2.find('a span').text(trans.get('All_currencies_chosen'));
        } else {
            this.addBtn.removeAttr('disabled').removeClass('disabled');
            select2.removeClass('select2-container-disabled');
            select2.find('a').removeClass('select2-default');
            select2.find('a span').text(this.select.find('option:first').text());
            this.select.select2();
        }
    }
});

$(function() {
    new PricingPage();
});