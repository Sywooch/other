       function addCategory() {
        var title = $('#addcat_title').val();
				if (!title) return false;
        var desc = $('#addcat_desc').val();
        var lang = $('#addcat_lang option:selected').val();
				var d = {'addcategory':1, 'title':title, 'desc':desc,'lang':lang, 'cmd':'digest', 'do':'addcat'};
				$.ajax({url: '',
				 				type:'GET',
								data: d,
								success: function(dt){
									$("#popup").bPopup().close(); 
									$("select#category").html('');
									var list = $("select#category");
									arr = $.parseJSON(dt);
									$.each(arr, function(index, itemData){
										if(itemData.title == title)
											var option = new Option(itemData.title, itemData.cid, false, true);
										else
											var option = new Option(itemData.title, itemData.cid);

										list.append(option);
									})
								}
				});
		}
		
		function checklogin()
		{
    		$.ajax({
        		url: "index.php?do=checklogin",
    			}).done(function ( data ) {
        		if (data == 'SessionExpired') location.href='index.php?expired';
    		});
		}
		setInterval('checklogin();', 1000*30);
		
		
	
     createUploader();
		
        
    
     $("#dialog-form").dialog({
        autoOpen:false,
        height:315,
        width:350,
        modal:true,
        buttons:{
            "Закрыть":function () {
                $(this).dialog("close");
            }
        },
        close:function () {
        }
    });

    function createUploader() {
		  
        var uploader = new qq.FileUploader({
            element:document.getElementById('file-uploader'),
            action:'utils/Upload.php?resize',
            debug:true,
            template:'<div class="qq-uploader">' +
                '<div class="qq-upload-drop-area"><span></span></div>' +
                '<div class="qq-upload-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">Выберите изображение</div>' +
                '<ul class="qq-upload-list"></ul>' +
                '</div>',
            onComplete:function (id, fileName, responseJSON) {
                var url = responseJSON.url;
                $('#news-img').attr('src', url);
                $('[name="image"]').val(url);
                $('#dialog-form').dialog("close");
            }
        });
    }