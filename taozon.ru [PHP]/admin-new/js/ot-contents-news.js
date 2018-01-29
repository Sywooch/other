var Contents = new Backbone.Collection();
var ContentsPage = Backbone.View.extend(
{
    "el": ".contents-wrapper",
    "events": {
		"click a.ot_show_deletion_dialog_modal": "removeNews",
		"click a.edit_news": "editNews",
		"click form.ot_edit_news_form button.btn-primary": "saveNews",
    },
    render: function()
    {
        return this;
    },
    initialize: function()
    {
        this.render();
        
        tinyMCE.init({
            mode : "exact",
            elements : "news-content, news-preview",
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
    },
    saveNews: function(e)
    {
        e.preventDefault();
        var target = this.$(e.target);        
    	var form = $(e.currentTarget).closest('form');    	
    	var content = tinyMCE.editors[0].getContent(); 
    	$('#news-content', form).val(content);
    	var preview = tinyMCE.editors[1].getContent(); 
    	$('#news-preview', form).val(preview);    	
        var $button = target.button('loading');
        $(form).ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
                if(data && data.result && data.result == 'ok') {
                    showMessage(trans.get('contents::Page_saved_successfully'));
                    document.location.href = 'index.php?cmd=contents&do=news';
                } else {
                    showError(data);
                    $button.button('reset');
                }
            }
        });
        
    	return false;
    },
    removeNews: function(e)
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var newsId = $(tr).attr('id');
    	
    	modalDialog(trans.get('Confirm_needed'), trans.get('contents::Really_remove_this_news'), function() {
    		$.post('index.php?cmd=contents&do=deleteNews', { 'id' : newsId}, function (data) {
                if (data.result == 'ok') {
                	$(tr).remove();
                }
            }, 'json');    		
        }, {'confirm':trans.get('Delete'), 'cancel':trans.get('Cancel')});
    },
    editNews: function(e) 
    {
    	var tr = $(e.currentTarget).closest('tr');
    	var newsId = $(tr).attr('id');
    	document.location.href = 'index.php?cmd=contents&do=editNews&id='+newsId;
    },
});

$(function()
{
    var P = new ContentsPage();
});
