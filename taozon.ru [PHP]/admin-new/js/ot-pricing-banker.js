var Banker = new Backbone.Collection();
var BankerPage = Backbone.View.extend({
    "el": $("#banker-wrapper")[0],
    "events": {
        "click .remove-price-group": "removePriceGroup",
        "click a.btn_save": "savePriceGroup",
        "click .icon-remove": "removePriceGroupInterval",
        "click #add-interval-btn": "addPriceGroupInterval",
        "change #price-group-type": "priceGroupTypeChange"
    },
    initialize: function() 
    {
        this.checkAbility4Delete();
    },
    priceGroupTypeChange: function(e) {
    	var description = $('#price-group-type option:selected').data('description');
    	$('div.price-group-type-description').text(description);
    },
    addPriceGroupInterval: function(e)
    {
    	var tmp = $('table#intervals tr.price-group-interval:last input:radio').attr('name');
    	$('table#intervals tr.price-group-interval:last input:radio').attr('name', 'margin_type[][' + new Date().getTime() + ']');
    	var html = $('table#intervals tr.price-group-interval:last').html();
    	$('table#intervals tr.price-group-interval:last input:radio').attr('name', tmp);
    	$('table#intervals').append('<tr style="border-top: 1px dotted #D3D3D3;" class="price-group-interval">' + html + '</tr>');
    	$('table#intervals tr.price-group-interval:last input[type="text"]').val('');
    	$('table#intervals tr.price-group-interval:last input[type="hidden"]').val('');
    	$('table#intervals tr.price-group-interval:last input:radio:first').attr('checked','checked');
        this.checkAbility4Delete();
    },
    removePriceGroupInterval: function(e)
    {
    	var count = $('table#intervals tr.price-group-interval').length;
    	var tr = $(e.currentTarget).closest('tr');
    	if (count==1) {
    		showError(trans.get('Price_group_must_have_at_least_one_interval'));
    	}
    	else {
    		$(tr).remove();
    	}
        this.checkAbility4Delete();
    	
    },
    checkAbility4Delete: function(){
        var count = $('table#intervals tr.price-group-interval').length;
        if(count == 1) {
            $('i.icon-remove').hide();
        } else {
            $('i.icon-remove').show();
        }
    },
    removePriceGroup: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var groupId = $(tr).attr('id');
    	
    	modalDialog(trans.get('Confirm_needed'), trans.get('Really_remove_this_price_group'), function() {
    		$.post('index.php?cmd=pricing&do=deletePriceGroup', { 'id' : groupId}, function (data) {
                if (data.result != 'error') {
                	$(tr).remove();
                }
            }, 'json');    		
        });
    	
    	return false;
    },
    savePriceGroup: function(e) 
    {
    	var isValid = true;
    	var validation = function() {
    		var value = $(this).val();
    		if (value == '')
    			return true;
    		var value = parseFloat(value);
    		if (isNaN(value)) {
    			isValid = false;
    			return false;
    		}
    		if (!isNaN(value) && value < 0) {
    			isValid = false;
    			return false;
    		}
    		return true;
    	};
    	$('input[name="margin[]"]').each(validation);
    	$('input[name="margin_fixed[]"]').each(validation);
    	$('input[name="limit[]"]').each(validation);
    	$('input[name="delivery[]"]').each(validation);
    	$('input[name="delivery-all"]').each(validation);
    	
    	var messages = [];
    	if(!isValid) {
    		messages.push(trans.get('Price_group_values_must_be_greater_than_zero'));
    	}

        var name = $('#name').val();
    	if (name.trim() == '') {
    		messages.push(trans.get('Must_be_enter_price_group_name'));
    		isValid = false;
    	}
        
    	if(!isValid) {
    		showError(messages.join('<br/>'));
    		return false;
    	}
    	
    	$('#priceGroupForm').ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
            	if(data && data.result && data.result == 'ok') {
            		showMessage(trans.get('Price_group_saved_successfully'));
            		document.location.href = 'index.php?cmd=pricing&do=banker';
            	} else {
            		showError(data);
            	}
             }
        });
    }
});

$(function() {
    new BankerPage();
});