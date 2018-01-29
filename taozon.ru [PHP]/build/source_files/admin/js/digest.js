$(document).ready(function() {
        $("#createAddCat").bind("click", function() {

            $("#popup").bPopup();
            return false
        });
        editBlock();
        document.getElementById('insert_item').style.display = 'none';
    });
    
    function showPrompt()
    {
			var ids = prompt("<?=LangAdmin::get('enter_id')?>","");

				d = {'cmd':'digest','do':'getitems', 'ids':ids};
        if (ids != null)
        {
					$.ajax({
						url:'',
						type:'GET',
						data: d,
						success: function(data) {
							//alert(data);
							$('#edit_content').html($('#edit_content').html()+'\n <br>'+data);							
							//tinyMCE.execInstanceCommand('edit_content', "mceInsertContent", false, data);
						}
					});
        }
    }

    function saveBlock()
    {
        $('#feditor').submit();
    }
    function editBlock()
    {
        $('#edit_content').css('width', 700);
		$('#edit_content').css('height', 400);
        $('#edit_content').show();

        tinyMCE.init({
            mode : "exact",
            elements : "edit_content",
            theme : "advanced",
            plugins : "table,heading,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
            theme_advanced_buttons1_add_before : "newdocument,separator",
            theme_advanced_buttons1_add_before : "fontselect,fontsizeselect,h1,h2,h3,h4,h5,h6,separator",
            theme_advanced_buttons1_add : "fontselect,fontsizeselect",
            theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle,separator,insertdate,inserttime",
            theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
            theme_advanced_buttons3_add_before : "tablecontrols,separator",
            theme_advanced_buttons3_add : "flash,advhr,emotions,media,nonbreaking,separator,fullscreen,mybutton",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            extended_valid_elements : "hr[class|width|size|noshade],table[class|width|size|noshade]",
            file_browser_callback : "ajaxfilemanager",
            paste_use_dialog : false,
            theme_advanced_resizing : true,
            theme_advanced_resize_horizontal : true,
            apply_source_formatting : true,
            force_br_newlines : false,
            force_p_newlines : true,
            relative_urls : true,
            content_css : "css/style_editor.css", //+ new Date().getTime(),
            content_css : "css/style.css",
            init_instance_callback : "myCustomInitInstance",
            setup: function(ed){
                ed.addButton('mybutton',
                { title : 'My button',
                    'class' : 'MyCoolBtn',
                    onclick : function() {
                        ed.focus();
                        ed.selection.setContent('<h2>' + ed.selection.getContent() + '</h2>');
                    }
                }
            );
            }
        });
    }

    function myCustomInitInstance(){}   