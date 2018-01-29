var Promo = new Backbone.Collection();
var PromoPage = Backbone.View.extend({
    "el": ".well",
    "events": {
        "click #updateSiteMap" : "updateSiteMapAction", 
        "click a.ot-footer-text" : "editFooterText"
        
    },
    render: function()
    {
        return this;
    },
    initialize: function(){
        this.render();
        
        $('.confirmDialog').on('shown',function() {
            var width = jQuery(window).width();
            var left = (width-690) / 2; 
            $('.confirmDialog').css('width', '690px');
            $('.confirmDialog').css('left', left+'px');
            $('.confirmDialog').css('margin-left', '0px');
//            $('.confirmDialog').off('hidden.restoreDefaults');
            if (tinyMCE.editors.length==0) {
                tinyMCE.init({
                    mode : "exact",
                    elements : "footer-text",
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
                if (tinyMCE.editors.length > 0) {
                	tinyMCE.editors[0].setContent($('div.footer-text-tmp').html());
                }
                
            }
            $('.confirmDialog .mceEditor').show();
        });
        
    },
    editFooterText: function(e)
    {
    	var content = $('div.footer-text').html();
    	content = content.replace(new RegExp("footer-text-tmp", 'g'), "footer-text");
    	
        if (tinyMCE.editors.length > 0) {
            tinyMCE.remove(tinyMCE.editors[0]);
        }
    	
    	modalDialog(trans.get('Edit_footer_text'), content, function(body) {
            var footerText = tinyMCE.editors[0].getContent();
            $.post(
                    "index.php?cmd=Promo&do=save",
                    {
                        "name" : "footer_text",
                        "value": footerText,
                    },
                    function (data) {
                    	if (!data.error) {
                    		if(footerText) {
                    			$('a.ot-footer-text').text(footerText);
                    		} else {
                    			$('a.ot-footer-text').text(trans.get('Empty_value'));
                    		}
                    		
                    		$('#footer-text-tmp').html(footerText);
                    		$('.confirmDialog .close').trigger('click');
                    	}
                    }, 'json'
                );
            return false;
    	});
    },
    updateSiteMapAction: function(ev)
    {
        var updateBtn = this.$('#updateSiteMap');
        var updatingBtn = this.$('#updatingSiteMap');
        updatingBtn.removeClass('disabled');
        updatingBtn.show();
        updateBtn.hide();
        jQuery.ajax($(updateBtn).attr('action'),{
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
            	updatingBtn.hide();
                updateBtn.show();
                if (typeof data.error !=='undefined' && data.error == '1') {
                    showError(trans.get('Sitemap_updating_error'));
                } else {
                	showMessage(trans.get('Sitemap_updated_successfully'));
                }
             },
             error: function(){
                 showError(trans.get('Sitemap_updating_error'));
                 updatingBtn.hide();
                 updateBtn.show();
             }
        });
        return false;
    }
});

$(function(){
    var C = new PromoPage();
});
