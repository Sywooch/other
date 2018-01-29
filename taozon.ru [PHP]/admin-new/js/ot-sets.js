var Sets = new Backbone.Collection();
var SetsPage = Backbone.View.extend({
    "el": ".sets_wrapper",
    "events": {
    	"click #save-order": "saveItemsOrder",
    	
    	"click .ot_sortable_brands li .ot_show_deletion_dialog_modal": "deleteBrand",
    	"click .ot_sortable_sellers li .ot_show_deletion_dialog_modal": "deleteSeller",
    	"click .ot_sortable_items li .ot_show_deletion_dialog_modal": "deleteItem",
    	
    	"click #add-from-list-submit": "addFromList",
    	"click .ot_show_edit_seller_dialog_modal" : "editSeller",
    	"click .ot_add_seller_to_selection .btn-primary": "addSeller",
    	"click .ot_add_brand_from_link .btn-primary" : "addBrand",
    	"submit form": "addBrandFormSubmit",
    	"click .ot_add_recommended_from_link .btn-primary" : "addRecommendedItem",
    	"click .ot_add_recommended_from_file #upload-btn" : "addRecommendedItemsFromFile",
    	"click .ot_add_warehouse_from_link .btn-primary" : "addWarehouseItem",
    	"click .ot_sortable_items li .ot_show_edit_selections_product_window" : "editProduct",
    	"click .cancel-btn": "resetForm"
    },
    
    addBrandFormSubmit: function()
    {
    	return false;
    },
    resetForm: function(e)
    {
    	var form = $(e.currentTarget).closest('form');
    	$(form)[0].reset();
    },
    render: function()
    {
        return this;
    },
    initialize: function() 
    {
        var self = this;
        this.render();
        
        $(".ot_sortable_cols").sortable({
        	handle: 'i.icon-move',
            afterMove: function() {
            	$('#save-order').removeClass('disabled');
            	$('#save-order').removeAttr('disabled');
            }
        });
               
        $('.ot_add_brand_from_list').bind('shown', function() {
        	$('.ot_add_brand_from_list').css('height', 'auto');
        });
        $('.ot_add_brand_from_link').bind('shown', function() {
        	$('.ot_add_brand_from_link').css('height', 'auto');
        });
        $('.ot_add_brand_from_list').bind('show', function() {
        	$('.ot_add_brand_from_link').css('height', '0px');
        	$('.ot_add_brand_from_link').removeClass('in');
        });
        $('.ot_add_brand_from_link').bind('show', function() {
        	$('.ot_add_brand_from_list').css('height', '0px');
        	$('.ot_add_brand_from_list').removeClass('in');
        });
        
        $('.ot_add_recommended_from_file').bind('shown', function() {
        	$('.ot_add_recommended_from_file').css('height', 'auto');
        });
        $('.ot_add_recommended_from_link').bind('shown', function() {
        	$('.ot_add_recommended_from_link').css('height', 'auto');
        });
        $('.ot_add_recommended_from_file').bind('show', function() {
        	$('.ot_add_recommended_from_link').css('height', '0px');
        	$('.ot_add_recommended_from_link').removeClass('in');
        });
        $('.ot_add_recommended_from_link').bind('show', function() {
        	$('.ot_add_recommended_from_file').css('height', '0px');
        	$('.ot_add_recommended_from_file').removeClass('in');
        });

        tinyMCE.init({
        	mode : "exact",
        	elements : "description",
        	theme : "advanced",
        	height: 230,
        	plugins : "table,heading,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
        	theme_advanced_buttons1_add_before : "newdocument,separator",
        	theme_advanced_buttons1_add_before : "fontselect,fontsizeselect,h1,h2,h3,h4,h5,h6,separator",
        	theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle,separator,insertdate,inserttime",
        	theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
        	theme_advanced_buttons3_add_before : "tablecontrols,separator",
        	theme_advanced_buttons3_add : "flash,advhr,emotions,media,nonbreaking,separator,fullscreen",
        	theme_advanced_toolbar_location : "top",
        	theme_advanced_toolbar_align : "left",
        	extended_valid_elements : "hr[class|width|size|noshade],ul[class=listUL],ol[class=listOL],script[language|type|src], object[width|height|classid|codebase|embed|param],param[name|value],embed[param|src|type|width|height|flashvars|wmode], iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
            media_strict: false,
        	file_browser_callback : "ajaxfilemanager",
        	paste_use_dialog : false,
        	theme_advanced_resizing : true,
        	theme_advanced_resize_horizontal : true,
        	apply_source_formatting : true,
        	force_br_newlines : true,
        	forced_root_block : "div",
	        force_p_newlines : false,
	        relative_urls : true,
	        heading_clear_tag : "p",
	        content_css : "../css/style.css"
        });
        $('.ot_inline_help').clickover();
        
        
        
    },
    addBrand: function(e)
    {
		var options = {
				success: function(data) {
					$('.ot_add_brand_from_link form .btn').removeClass('disabled');
					$('.ot_add_brand_from_link form .btn').removeAttr('disabled');
					if (data.result == 'ok') {
						var brands = data.brands;
						for ( var i in brands) {
							var brand = brands[i];
							//create brand item
                    		$('.ot_sortable_brands').append($('.ot_sortable_brands .ot-brand-template').html());
                    		$('.ot_sortable_brands li:last').attr('id', brand.id);
                    		$('.ot_sortable_brands li:last img').attr('src', brand.PictureUrl);
                    		$('.ot_sortable_brands li:last img').attr('alt', escapeData(brand.name));
                    		$('.ot_sortable_brands li:last h3').html(escapeData(brand.name));
                    		$('.ot_sortable_brands li:last').removeClass('ot-brand-template');
                    		$('.ot_sortable_brands li:last').show();
                    		var listItem = $('.ot_add_brand_from_list .span3 input[value="' + brand.id + '"]');
                    		if (listItem.length) {
                    			var span3 = $(listItem).closest('.span3');
                    			$(span3).remove();
                    			
                    		}
						}
						$('.ot_add_brand_from_link form')[0].reset();
					}
					else {
						showError(data.message);
					}
				},
				'dataType':'json'
		};
		
		$('.ot_add_brand_from_link form .btn').addClass('disabled');
		$('.ot_add_brand_from_link form .btn').attr('disabled', 'disabled');
		$('.ot_add_brand_from_link form').ajaxSubmit(options);
		return false;
    },
    saveItemsOrder: function(e)
    {
    	var type = $(e.currentTarget).attr('itemType');
    	var contentType = $(e.currentTarget).attr('itemContentType');
    	var cid = $(e.currentTarget).attr('cid');
    	if (! cid) {
    		cid = 0;
    	}
    	
    	var ids = [];
    	$('.ot_sortable_cols li:visible').each(function() {
    		ids.push($(this).attr('id'));
    	});
    	
    	$('#save-order').addClass('btn_preloader');
    	$('#save-order').button('loading');
    	$.post(
                "index.php?cmd=Sets&do=saveItemsOrder",
                {
                    "ids": ids.join(';'),
                    "type": type,
                    "contentType": contentType,
                    "cid": cid
                },
                function (data) {
//                	$('#save-order').button('reset');
                	$('#save-order').removeClass('btn_preloader');
                	if ( !data.error) {
                		showMessage(trans.get("Items_order_saved"));
                		$('#save-order').addClass('disabled');
                    	$('#save-order').attr('disabled', 'disabled');
                	} else {
                		showError(data.message);
                	}
                }, 'json'
            );
    },    
    
    deleteSeller: function(e)
    {
        var li = $(e.currentTarget).closest('li');
        var id = $(li).attr('id');
    	var language = $('#currentLang').data('lang');
        
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_this_seller_from_sets'), function() {
            $.post(
                    "index.php?cmd=Sets&do=deleteItem",
                    {
                        "id": id,
                        "contentType": "Vendor",
                        "type": "Best"
                    },
                    function (data) {
                    	if ( !data.error) {
                    		// add item to list
                    		$(li).remove();
                    		showMessage(trans.get("Seller_deleted"));
                    	} else {
                    		showError(data.message);
                    	}
                    }, 'json'
                );
            
        });
    	
    },
    deleteBrand: function(e)
    {
        var li = $(e.currentTarget).closest('li');
        var id = $(li).attr('id');
        
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_this_brand_from_sets'), function() {
            $.post(
                    "index.php?cmd=Sets&do=deleteItem",
                    {
                        "id": id,
                        "contentType": "Brand",
                        "type": "Best"
                    },
                    function (data) {
                    	if ( !data.error) {
                    		// add item to list
                    		$('span.no-more-brands').hide();
                    		$('.ot_add_brand_from_list .row-fluid').append($('.ot_add_brand_from_list .brand-item-template').html());
                    		$('.ot_add_brand_from_list .span3:last input').val(id);
                    		$('.ot_add_brand_from_list .span3:last img').attr('src', $('img', li).attr('src'));
                    		$('.ot_add_brand_from_list .span3:last .brand-name').html($('h3', li).html());
                    		$('.ot_add_brand_from_list .span3:last').show();
                    		$(li).remove();
                    		showMessage(trans.get("Brand_deleted"));
                    	} else {
                    		showError(data.message);
                    	}
                    }, 'json'
                );
            
        });
    },
    deleteItem: function(e)
    {
        var li = $(e.currentTarget).closest('li');
        var type = $(li).attr('type');
        var id = $(li).attr('id');
        var cid = $(li).attr('cid');
        if(! cid) {
        	cid = 0;
        }
        
        modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_this_item_from_sets'), function() {
            $.post(
                    "index.php?cmd=Sets&do=deleteItem",
                    {
                        "id": id,
                        "contentType": "Item",
                        "type": type,
                        "cid": cid
                    },
                    function (data) {
                    	if ( !data.error) {
                    		$(li).remove();
                    		showMessage(trans.get("Item_deleted"));
                    	} else {
                    		showError(data.message);
                    	}
                    }, 'json'
                );
            
        });
    	
    },
    addFromList: function(e) {
    	var form = $(e.currentTarget).closest('form');
    	var ids = [];
    	$('input[type="checkbox"]:checked').each(function() {
    		var id = $(this).val();
    		ids.push(id);
    	});
    	if (ids.length > 0) {
    		$('#ids', form).val(ids.join(';'));
    		var options = {
    				success: function(data) {
    		    		$('.cancel-btn', form).removeClass('disabled');
    					$('#add-from-list-submit', form).button('reset');

    					if (data.result = 'ok') {
    						var brands = data.brands;
    						for ( var i in brands) {
    							var brand = brands[i];
    							//create brand item
                        		$('.ot_sortable_brands').append($('.ot_sortable_brands .ot-brand-template').html());
                        		$('.ot_sortable_brands li:last').attr('id', brand.id);
                        		$('.ot_sortable_brands li:last img').attr('src', brand.PictureUrl);
                        		$('.ot_sortable_brands li:last img').attr('alt', escapeData(brand.name));
                        		$('.ot_sortable_brands li:last h3').html(escapeData(brand.name));
                        		$('.ot_sortable_brands li:last').removeClass('ot-brand-template');
                        		$('.ot_sortable_brands li:last').show();
                        		var checkbox = $('.ot_add_brand_from_list input[type="checkbox"][value="'+brand.id+'"]');
                        		var span3 = $(checkbox).closest('.span3');
                        		$(span3).remove();
    						}
    						var cnt = $('form.well input[type="checkbox"]:visible').length;
    						if (cnt == 0) {
    							$('span.no-more-brands').show();
    	    					$('#add-from-list-submit', form).removeAttr('reset');
    						}
    					}
    					$(form)[0].reset();
    					$('#add-from-list-submit', form).removeAttr('reset');
    				},
    				'dataType':'json'
    		}; 

    		$('.cancel-btn', form).addClass('disabled');
			$('#add-from-list-submit', form).button('loading');

    		$(form).ajaxSubmit(options);
    		
    		return true;
    	} else {
    		showError('Brands_not_selected');
    		return false;
    	}
    },
    editSeller: function(e)
    {
    	var li = $(e.currentTarget).closest('li');
    	var sellerId = $(li).attr('id');
    	var displayName = $(li).attr('display-name');
        if (displayName == '') {
            displayName = $(li).attr('id');
        }
    	var displayImg = $('img', li).attr('src');
    	var language = $('#currentLang').data('lang');
    	$('#currentLang').val(language);
    	
    	$('.ot_edit_seller_dialog_modal #displayName').val(displayName);
    	$('.ot_edit_seller_dialog_modal #sellerId').val(sellerId);
    	$('.ot_edit_seller_dialog_modal img').attr('src', displayImg);
    	$('.ot_edit_seller_dialog_modal #existing_image').val(displayImg);
    	
    	$('.ot_edit_seller_dialog_modal').on('hide', function() {
    		$('.ot_edit_seller_dialog_modal form input[name!="type"]').val('');
    	});
    	
    	$('.ot_edit_seller_dialog_modal .btn-primary').unbind('click').click(function() {
    		$('.ot_edit_seller_dialog_modal .btn').addClass('disabled');
    		$('.ot_edit_seller_dialog_modal .btn').attr('disabled', 'disabled');
    		
    		var options = {
    				success: function(data) {
    					$('.ot_edit_seller_dialog_modal .btn').removeClass('disabled');
    					$('.ot_edit_seller_dialog_modal .btn').removeAttr('disabled');
    					if (data.result == 'ok') {
    						$('img', li).attr('alt', data.seller['displayName']);
    						$('img', li).attr('src', data.seller['pictureurl']);
    						$('h3', li).html(data.seller['displayName']);
    						$(li).attr('display-name', data.seller['displayName']);
    						$('.ot_edit_seller_dialog_modal').modal('hide');
    					}
    					else {
    						showError(data.message);
    					}
    					$('.ot_edit_seller_dialog_modal form')[0].reset();
    				},
    				'dataType':'json'
    		};
    		$('.ot_edit_seller_dialog_modal form').ajaxSubmit(options);
    	});
    	
    	$('.ot_edit_seller_dialog_modal').modal('show');
    },
    addSeller: function (e) 
    {
    	var form = $(e.currentTarget).closest('form');
    	var url = $('#sellerId', form).val();
    	var name = $('#displayName', form).val();
    	
    	if (url.length == 0) {
    		showError(trans.get("Seller_url_or_id_is_required"));
    		return false;
    	}

		var options = {
				success: function(data) {
					$('.ot_add_seller_to_selection form .btn').removeClass('disabled');
					$('.ot_add_seller_to_selection form .btn').removeAttr('disabled');
					if (data.result == 'ok') {
						var sellers = data.sellers;
						for ( var i in sellers) {
							var seller = sellers[i];
							if ( $('.ot_sortable_sellers li[id="'+seller.id+'"]').length == 0 ) {
								$('.ot_sortable_sellers').append($('.ot_sortable_sellers .ot-seller-template').html());
								$('.ot_sortable_sellers li:last').attr('id', seller.id);
                                $('.ot_sortable_sellers li:last').attr('display-name', seller.displayName);
								$('.ot_sortable_sellers li:last img').attr('src', seller.PictureUrl);
								$('.ot_sortable_sellers li:last img').attr('alt', seller.displayName);
								$('.ot_sortable_sellers li:last h3').html(seller.displayName);
								$('.ot_sortable_sellers li:last').removeClass('ot-seller-template');
								$('.ot_sortable_sellers li:last').show();
							}  
						}
						$('.ot_add_seller_to_selection form')[0].reset();
					}
					else {
						showError(data.message);
					}
				},
				'dataType':'json'
		};
		
		$('.ot_add_seller_to_selection form .btn').addClass('disabled');
		$('.ot_add_seller_to_selection form .btn').attr('disabled', 'disabled');
		$('.ot_add_seller_to_selection form').ajaxSubmit(options);

		return true;
    	
    },
    addWarehouseItem: function(e)
    {
    	var form = $(e.currentTarget).closest('form');
    	var url = $('#urlId', form).val();
    	
    	if (url.length == 0) {
    		showError(trans.get("Item_url_or_id_is_required"));
    		return false;
    	}

		var options = {
				success: function(data) {
					$('.ot_add_warehouse_from_link form .btn').removeClass('disabled');
					$('.ot_add_warehouse_from_link form .btn').removeAttr('disabled');

					if (data.result == 'ok') {
						var items = data.items;
						for ( var i in items) {
							var item = items[i];
							if ( $('.ot_sortable_items li[id="'+item.id+'"]').length == 0 ) {
								$('.ot_sortable_items').append($('.ot_sortable_items .ot-item-template').html());
								$('.ot_sortable_items li:last').attr('id', item.id);
								$('.ot_sortable_items li:last img').attr('src', item.MainPictureUrl);
								$('.ot_sortable_items li:last img').attr('alt', item.title);
								$('.ot_sortable_items li:last h3').html(item.title);
								$('.ot_sortable_items li:last').removeClass('ot-item-template');
								$('.ot_sortable_items li:last').show();
							}  
						}
						$('.ot_add_warehouse_from_link form')[0].reset();
					}
					else {
						showError(data.message);
					}
				},
				'dataType':'json'
		};
		$('.ot_add_warehouse_from_link form .btn').addClass('disabled');
		$('.ot_add_warehouse_from_link form .btn').attr('disabled', 'disabled');

		$('.ot_add_warehouse_from_link form').ajaxSubmit(options);

		return true;

    	
    },
    addRecommendedItem: function(e)
    {
    	var form = $(e.currentTarget).closest('form');
    	var url = $('#urlId', form).val();
    	
    	if (url.length == 0) {
    		showError(trans.get("Item_url_or_id_is_required"));
    		return false;
    	}

		var options = {
				success: function(data) {
					$('.ot_add_recommended_from_link form .btn').removeClass('disabled');
					$('.ot_add_recommended_from_link form .btn').removeAttr('disabled');

					if (data.result == 'ok') {
						var items = data.items;
						for ( var i in items) {
							var item = items[i];
							if ( $('.ot_sortable_items li[id="'+item.id+'"]').length == 0 ) {
								$('.ot_sortable_items').append($('.ot_sortable_items .ot-item-template').html());
								$('.ot_sortable_items li:last').attr('id', item.id);
								$('.ot_sortable_items li:last img').attr('src', item.MainPictureUrl);
								$('.ot_sortable_items li:last img').attr('alt', item.title);
								$('.ot_sortable_items li:last h3').html(item.title);
								$('.ot_sortable_items li:last').removeClass('ot-item-template');
								$('.ot_sortable_items li:last').show();
							}  
						}
						$('.ot_add_recommended_from_link form')[0].reset();
					}
					else {
						showError(data.message);
					}
				},
				'dataType':'json'
		};
		$('.ot_add_recommended_from_link form .btn').addClass('disabled');
		$('.ot_add_recommended_from_link form .btn').attr('disabled', 'disabled');

		$('.ot_add_recommended_from_link form').ajaxSubmit(options);

		return true;
    },
    addRecommendedItemsFromFile: function(e) 
    {
    	var form = $(e.currentTarget).closest('form');
    	var file = $('#itemsFile', form).val();
    	if (file.length == 0 ) {
    		showError(trans.get("Items_file_required"));
    		return false;
    	}

		var options = {
				success: function(data) {
					$('.btn', form).removeClass('disabled');
					$('.btn', form).removeAttr('disabled');

					if (data.result == 'ok') {
						var items = data.items;
						for ( var i in items) {
							var item = items[i];
							if ( $('.ot_sortable_items li[id="'+item.id+'"]').length == 0 ) {
								$('.ot_sortable_items').append($('.ot_sortable_items .ot-item-template').html());
								$('.ot_sortable_items li:last').attr('id', item.id);
								$('.ot_sortable_items li:last img').attr('src', item.MainPictureUrl);
								$('.ot_sortable_items li:last img').attr('alt', item.title);
								$('.ot_sortable_items li:last h3').html(item.title);
								$('.ot_sortable_items li:last').removeClass('ot-item-template');
								$('.ot_sortable_items li:last').show();
							}  
						}
						$(form)[0].reset();
					}
					else {
						showError(data.message);
					}
				},
				'dataType':'json'
		};
		$('.btn',form).addClass('disabled');
		$('.btn',form).attr('disabled', 'disabled');

		$(form).ajaxSubmit(options);    	
    	
    },
    editProduct: function(e) 
    {
    	var li = $(e.currentTarget).closest('li');
    	var name = $('h3', li).text();
    	var id = $(li).attr('id');
    	var language = $('#currentLang').data('lang');
    	$('#currentLang').val(language);
    	var form = $('.ot_edit_selections_product_dialog_window form');
    	
    	$('.ot_edit_selections_product_dialog_window #itemId').val(id);
    	$('.ot_edit_selections_product_dialog_window #displayName').val(name);
    	
    	$('.ot_edit_selections_product_dialog_window .editableform-loading').show();

		$('.ot_edit_selections_product_dialog_window .btn-primary').addClass('disabled');
       
        $.post(
                "index.php?cmd=Sets&do=getItemInfo",
                {
                    "id" : id,
                    "language" : language
                },
                function (data) {
            		$('.ot_edit_selections_product_dialog_window .btn-primary').removeClass('disabled');

                    if (data.result == 'ok') {
                    	$('.ot_edit_selections_product_dialog_window #displayName').attr('value', data.title);
                    	$('.ot_edit_selections_product_dialog_window #description').val(data.description);
                    	if (tinyMCE.editors.length > 0) {
                    		tinyMCE.editors[0].setContent(data.description);
                    	}
                    	$('.ot_edit_selections_product_dialog_window .editableform-loading').hide();

                    }
                }, 'json'
            );

    	
        var width = jQuery(window).width();
        var left = (width-690) / 2; 
        $('.ot_edit_selections_product_dialog_window').css('width', '690px');
        $('.ot_edit_selections_product_dialog_window').css('left', left+'px');
        $('.ot_edit_selections_product_dialog_window').css('margin-left', '0px');
        
    	$('.ot_edit_selections_product_dialog_window .modal-footer .btn-primary').unbind('click').click(function() {
    		$('.ot_edit_selections_product_dialog_window .btn').addClass('disabled');
    		$('.ot_edit_selections_product_dialog_window .btn').attr('disabled', 'disabled');
    		
        	if (tinyMCE.editors.length > 0) {
        		$('#description', form).val(tinyMCE.editors[0].getContent());
        	}

    		var options = {
    				success: function(data) {
    		    		$('.ot_edit_selections_product_dialog_window .btn').removeClass('disabled');
    		    		$('.ot_edit_selections_product_dialog_window .btn').removeAttr('disabled');

    					if (data.result == 'ok') {
    						var desc = $('#description', form).val();
    						var title = $('#displayName', form).val();
    						$('.item-description', li).html(desc);
    						$('h3', li).html(title);
    						$('.ot_edit_selections_product_dialog_window').modal('hide');
    						//$(form)[0].reset();
    					}
    					else {
    						showError(data.message);
    					}
    				},
    				'dataType':'json'
    		};
    		$(form).ajaxSubmit(options);    	
    	});
    	
    	$('.ot_edit_selections_product_dialog_window').on('hide', function() {
    		$('.ot_edit_selections_product_dialog_window form input[name!="type"]').val('');
        	if (tinyMCE.editors.length > 0) {
        		tinyMCE.editors[0].setContent('');
        	}

    	});
    	
    	$('.ot_edit_selections_product_dialog_window').modal('show');
    }
});

$(function() {
    var U = new SetsPage();
});
