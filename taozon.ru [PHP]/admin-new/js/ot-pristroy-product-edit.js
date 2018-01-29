var PristroyEditPage = Backbone.View.extend({
    "el": ".pristroy-form-wrapper",
    "events": {
        "click #submit_btn": "saveProduct",
        "click .thumbnails button.ot_show_deletion_dialog_modal": "removeImage"
    },
    removeImage: function(ev) 
    {
    	var target = ev.target;
    	var self = this;
    	var li = $(target).closest('li');
    	if ($('.file_name', li).val() != '' || $( '.file', li).val() != '' ) {
    		modalDialog('', trans.get('Removing_item_images_confirmation'), function(){
    			$( '.file_name', li).val('');
    			$( '.file', li).val('');
        			self.saveProduct(ev, 1);    		
        		});
    	}
    	return false;
    },
    render: function()
    {
        var self = this;

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

        return this;
    },
    initialize: function()
    {
        this.render();
    },
    updateProductStatus: function(ev)
    {
        ev.preventDefault();
        if (! $(ev.target).hasClass('disabled')) {
            this.$('input[name=status]').val($(ev.target).data('status'));
            this.saveProduct(ev, 1);
        }
        return false;
    },
    saveProduct: function(ev, reloadPage) 
    {
        ev.preventDefault();
        var btn = this.$('#submit_btn');
        btn.button('loading').siblings('button').addClass('disabled');
        if (! $('#uploaded_image').is('img')) {
            $('input[name=existing_uploaded_image]').val('');
        }
        btn.closest('form').ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
                btn.button('reset').siblings('button').removeClass('disabled');
                if (! data.error) {
                    showMessage(trans.get('Data_updated_successfully'));
                    if ('undefined' !== typeof reloadPage) {
                        window.location.reload();
                    }
                    else {
                    	window.location.href = $('a#cancel_btn').attr('href');
                    }
                } else {
                    showError(data);
                }
             }
        });
        return false;
    }
});

$(function(){
    var PE = new PristroyEditPage();
});
