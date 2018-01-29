<script language="javascript" type="text/javascript" src="../js/tiny_mce/tiny_mce_src.js"></script>
<script type="text/javascript" src="js/lang.js"></script>
<script src="js/serializeobject.js" type="text/javascript"></script>
<script type="text/javascript">
	tinyMCE.init({
        mode : "exact",
        elements : "PublicationText",
        theme : "advanced",
        plugins : "table,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
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
        content_css : "css/style_editor.css"
	});

    function ajaxfilemanager(field_name, url, type, win)
    {
        var ajaxfilemanagerurl = "../js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
        switch (type) {
            case "image":
                break;
            case "media":
                break;
            case "flash":
                break;
            case "file":
                break;
            default:
                return false;
        }
        tinyMCE.activeEditor.windowManager.open({
            url: "../js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
            width: 782,
            height: 440,
            inline : "yes",
            close_previous : "no"
        },{
            window : win,
            input : field_name
        });
    }

    $(function(){
    
    $('#send_test_email')
        .button()
        .live('click', function(e){
            e.preventDefault();
            
            var params = $('#form1').serializeObject();
            
            $.ajax({
                url: 'index.php?cmd=newsletter&do=sendTestLetter',
                type: 'post',
                data: params
            })
            .success(function(data){
                alert(data);
            })
            .error(function(xhr, ajaxOptions, thrownError){
                if(thrownError == 'SessionExpired'){
                    window.location = 'index.php?cmd=login';
                }
                else{
                    show_error(thrownError + '<br />' + xhr.responseText);
                }
            });
            
    });
    
});

</script>

<br/>
<div>
	<br/>
	<?if ($needSendTo==0):?>
	<form id="form1" action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;&amp;cmd=newsletter" method="post">
            <table>
                <tr>
                    <td>
                        <b><?=LangAdmin::get('sub_publication_title')?>:</b><br/>
                        <input type="text" name="PublicationTitle" value="<?=$publication['title']?>" />
                    </td>
                    <td>
                        <b><?=LangAdmin::get('send_to_email')?>:</b><br/>
                        <input type="text" name="TestEmail" value="<? echo isset($siteConfig[1]['notification_email']) ? $siteConfig[1]['notification_email'] : ''; ?>" />
                        <button id="send_test_email"><?=LangAdmin::get('send')?></button>
                    </td>
                </tr>
            </table>
		
                
		<input type="hidden" name="active_tab" value="1" />
		<b><?=LangAdmin::get('sub_publication_text')?>:</b><br/>
		<textarea class="text ui-widget-content ui-corner-all" id="PublicationText" name="PublicationText" style="height: 360px; width: 100%"><?=$publication['text']?></textarea>

                <br/>
                
		<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="save" name="submit" type="submit" role="button" aria-disabled="false">
			<span class="ui-button-text"><?=LangAdmin::get('sub_publication_save')?></span>
		</button>
<!---		<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="preview" name="submit" type="submit" role="button" aria-disabled="false">
			<span class="ui-button-text"><?=LangAdmin::get('sub_publication_preview')?></span>
		</button>
--->
		<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" value="send" name="submit" type="submit" role="button" aria-disabled="false">
			<span class="ui-button-text"><?=LangAdmin::get('sub_publication_send')?></span>
		</button>
	</form>
	<?else:?>
	<?=LangAdmin::get('sub_need_to_send')?><?=$needSendTo?>
	<?endif?>
</div>