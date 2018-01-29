var NewsletterEdit = Backbone.View.extend({
    "el": "#content",
    "events": {
        "click button.btn_preloader": "enablePreLoader",
        "click #test-newsletter": "testNewsletter"
    },
    enablePreLoader: function(ev) {
        $(ev.target).attr('disabled', 'disabled');
        var form = $(ev.target).closest('form');
        form.append($('<input>').attr({'name': $(ev.target).attr('name'), 'type': 'hidden'}).val($(ev.target).val()));
        form.submit();
    },
    testNewsletter: function() {
        var that = this;
        this.$('#test-newsletter').attr('disabled', 'disabled');
        var text = tinyMCE.editors[0].getContent();
        $('#text').val(text);
        $.post('index.php?cmd=Newsletters&do=test', this.$('#edit-form').serializeArray(), function(data) {
            if (data.error != 'Ok') {
                showError(data.message);
            } else {
                showMessage('Тестовое письмо успешно отправлено');
            }
            that.$('#test-newsletter').removeAttr('disabled');
        }, 'json');
        return false;
    }
});

$(function(){
    new NewsletterEdit();

    tinyMCE.init({
        mode : "exact",
        elements : "text",
        theme : "advanced",
        height: 800,
        width: "100%",
        plugins : "table,heading,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
        relative_urls: false,
        convert_urls: false,
        theme_advanced_buttons1_add_before : "newdocument,separator",
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
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
        force_p_newlines : false,
        content_css : "/css/style_editor.css"
    });
});