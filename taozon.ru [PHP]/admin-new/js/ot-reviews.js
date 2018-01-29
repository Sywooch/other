var Reviews = new Backbone.Collection();
var Reviews = Backbone.View.extend({
    "el": ".reviews_wrapper",
    "events": {
    	"click .accept-item-btn": "acceptItem",
    	"click .ot_show_deletion_dialog_modal": "deleteItem", 
        "click .accept-items-btn": "acceptItems",
        "click .delete-items-btn": "deleteItems",
        "change input.row-checkbox": "toggleRow",
        "change input.rows-checkbox": "toggleRows"
    },
    toggleRows: function(e){
        var self = this.$(e.target);
        self.parents('thead').next().find('input[type=checkbox]').prop('checked', self.is(':checked'));
    	if ($(e.currentTarget).is(':checked')) {
    		$('tbody tr').addClass('selected_item');
    	} else {
    		$('tbody tr').removeClass('selected_item');
    	}
    	
    	var count = $('input[type=checkbox]:checked').length;
    	if ( count > 0) {
    		$('.delete-items-btn').removeClass('active');
    		$('.accept-items-btn').removeClass('active');
    	} else {
    		$('.delete-items-btn').addClass('active');
    		$('.accept-items-btn').addClass('active');
    	}
    },	
    toggleRow: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	if ($(e.currentTarget).is(':checked')) {
    		$(tr).addClass('selected_item');
    	} else {
    		$(tr).removeClass('selected_item');
    	}
    	var count = $('input[type=checkbox]:checked').length;
    	if ( count > 0 ) {
    		$('.delete-items-btn').removeClass('active');
    		$('.accept-items-btn').removeClass('active');
    	} else {
    		$('.delete-items-btn').addClass('active');
    		$('.accept-items-btn').addClass('active');
    	}
    },
    acceptItems: function(e) {
    	var ids = [];
    	var trs = [];
    	$('input.row-checkbox:checked').each(function(){
    		var tr = $(this).closest('tr');
    		ids.push($(tr).attr('id'));
    		trs.push(tr);
    	});
    	if (ids.length > 0) {
	    	$('.accept-item-btn i').removeClass('icon-ok');
	    	$('.accept-item-btn i').addClass('ot-preloader-micro');
	    	$('.btn').button('toggle');
	    	$('.accept-items-btn').button('toggle');
	    	$('.delete-items-btn').button('toggle');
	    	$.post(
	                "index.php?cmd=reviews&do=acceptReview",
	                {
	                    "ids": ids.join(';'),
	                },
	                function (data) {
	                	$('.accept-item-btn i').removeClass('ot-preloader-micro');
	                	$('.accept-item-btn i').addClass('icon-ok');
	                	$('.btn').button('toggle');
	                	$('.accept-items-btn').button('toggle');
	                	$('.delete-items-btn').button('toggle');
	                	if (! data.error) {
	                		showMessage(trans.get("reviews::Reviews_accepted"));
	                		location.reload();
	                	} else {
	                		showError(data);
	                	}
	                	var count = $('input[type=checkbox]:checked').length;
	                	if ( count > 0) {
	                		$('.delete-items-btn').removeClass('active');
	                		$('.accept-items-btn').removeClass('active');
	                	} else {
	                		$('.delete-items-btn').addClass('active');
	                		$('.accept-items-btn').addClass('active');
	                	}
	                	
	                }, 'json'
	            );
    	}
    },
    deleteItems: function(e) {
    	var ids = [];
    	var trs = [];
    	$('input.row-checkbox:checked').each(function(){
    		var tr = $(this).closest('tr');
    		ids.push($(tr).attr('id'));
    		trs.push(tr);
    	});
    	
    	var callback = function(){
        	$('.ot_show_deletion_dialog_modal i').removeClass('icon-ok');
        	$('.ot_show_deletion_dialog_modal i').addClass('ot-preloader-micro');
        	$('.btn').button('toggle');
        	$('.accept-items-btn').button('toggle');
        	$('.delete-items-btn').button('toggle');
        	$.post(
                    "index.php?cmd=reviews&do=deleteReview",
                    {
                        "ids": ids.join(';'),
                    },
                    function (data) {
                    	$('.accept-items-btn').button('toggle');
                    	$('.delete-items-btn').button('toggle');
                    	$('.ot_show_deletion_dialog_modal i').removeClass('ot-preloader-micro');
                    	$('.ot_show_deletion_dialog_modal i').addClass('icon-ok');
                    	$('.btn').button('toggle');
                    	if (! data.error) {
                    		showMessage(trans.get("reviews::Reviews_deleted"));
                    		location.reload();
                    	} else {
                    		showError(data);
                    	}
                    	var count = $('input[type=checkbox]:checked').length;
                    	if ( count > 0) {
                    		$('.delete-items-btn').removeClass('active');
                    		$('.accept-items-btn').removeClass('active');
                    	} else {
                    		$('.delete-items-btn').addClass('active');
                    		$('.accept-items-btn').addClass('active');
                    	}
                    }, 'json'
                );    		
    	};
    	
    	if (ids.length > 0) {
    		modalDialog(trans.get('Confirm_needed'), trans.get('reviews::Really_delete_reviews'), callback, {'confirm': trans.get('Delete'), 'cancel': trans.get('Cancel')});
    	}
    },
    deleteItem: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var id = $(tr).attr('id');
    	var ids = [];
    	ids.push(id);
    	
    	var callback = function(){
        	$('.ot_show_deletion_dialog_modal i', tr).removeClass('icon-ok');
        	$('.ot_show_deletion_dialog_modal i', tr).addClass('ot-preloader-micro');
        	$('.btn', tr).button('toggle');
        	$('.accept-items-btn').button('toggle');
        	$('.delete-items-btn').button('toggle');
        	$.post(
                    "index.php?cmd=reviews&do=deleteReview",
                    {
                        "ids": ids.join(';'),
                    },
                    function (data) {
                    	$('.accept-items-btn').button('toggle');
                    	$('.delete-items-btn').button('toggle');
                    	$('.ot_show_deletion_dialog_modal i', tr).removeClass('ot-preloader-micro');
                    	$('.ot_show_deletion_dialog_modal i', tr).addClass('icon-ok');
                    	$('.btn', tr).button('toggle');
                    	if (! data.error) {
                    		showMessage(trans.get("reviews::Review_deleted"));
                    		$(tr).remove();
                    	} else {
                    		showError(data);
                    	}
                    	
                    }, 'json'
                );
    	} ;
    	
    	modalDialog(trans.get('Confirm_needed'), trans.get('reviews::Really_delete_review'), callback, {'confirm': trans.get('Delete'), 'cancel': trans.get('Cancel')});
    }, 
    acceptItem: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var id = $(tr).attr('id');
    	var ids = [];
    	ids.push(id);
    	$('.accept-item-btn i', tr).removeClass('icon-ok');
    	$('.accept-item-btn i', tr).addClass('ot-preloader-micro');
    	$('.btn', tr).button('toggle');
    	$('.accept-items-btn').button('toggle');
    	$('.delete-items-btn').button('toggle');
    	$.post(
                "index.php?cmd=reviews&do=acceptReview",
                {
                    "ids": ids.join(';'),
                },
                function (data) {
                	$('.accept-item-btn i', tr).removeClass('ot-preloader-micro');
                	$('.accept-item-btn i', tr).addClass('icon-ok');
                	$('.btn', tr).button('toggle');
                	$('.accept-items-btn').button('toggle');
                	$('.delete-items-btn').button('toggle');
                	if (! data.error) {
                		showMessage(trans.get("reviews::Review_accepted"));
                		$(tr).remove();
                	} else {
                		showError(data);
                	}
                }, 'json'
            );
    },
    render: function()
    {
        return this;
    },
    initialize: function() 
    {
        this.render();
		$('.delete-items-btn').addClass('active');
		$('.accept-items-btn').addClass('active');
        
    },
});

$(function() {
    var U = new Reviews();
});
