<?
include ("templates/header.php");
?>
<div class="main"><div class="canvas clrfix editnews">
    <form action="" enctype="multipart/form-data" method="POST" class="addform"
          id="dialog-form" title="<?=LangAdmin::get('add')?>">
        <div id="file-uploader"></div>
    </form>
	<? if (@$news['id']==='new') { ?>
    <h1><?=LangAdmin::get('add_news')?></h1>
	<? } else { ?>
    <h1><?=LangAdmin::get('editing_a_news')?> (ID: <?=@$news['id']?>)</h1>
	<? } ?>
	<form action="?cmd=news&do=editsave" method="post">
	<input type="hidden" name="id" value="<?=@$news['id']?>">
	<input type="hidden" name="cms" value="1">
    <p><label><?=LangAdmin::get('title')?>: <input type="edit" name="title" value="<?=@$news['title']?>"></label></p>
    <p><label><?=LangAdmin::get('brief')?>: <textarea name="brief"><?=@$news['brief']?></textarea></label></p>
		<p><label><?=LangAdmin::get('image')?>: <img src="<?=@$news['image']?>" id="news-img">  <input type="hidden" name="image" value="<?=@$news['image']?>"></label>&nbsp;&nbsp;<input type="button" value="<?=LangAdmin::get('add_change_image')?>" onclick="$('#dialog-form').dialog('open');" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"></p>

    <p>
        <label>
            <?=LangAdmin::get('language')?>: 
            <select name="lang">
                <?
                foreach($webui->Settings->Languages->NamedProperty as $v){
                    $lang = (string)$v->Name;
                    $lang_desc = (string)$v->Description;
                    
                    $selected = '';
                    if(@$news['lang_code'] == $lang){
                        $selected = ' selected';
                    }
                    ?>
                    <option value="<?=$lang?>"<?=$selected?>><?=$lang_desc?></option>
                    <?
                }
                ?>
            </select>
        </label>
    </p>
	<p><input type="submit" value=" <?=LangAdmin::get('save')?> " class="ui-button ui-widget ui-state-default ui-corner-all"></p>
    </form>
	<br clear="all">
</div></div>

<script type="text/javascript">
    $(function () {
        createUploader();
        
    });
    $("#dialog-form").dialog({
        autoOpen:false,
        height:315,
        width:350,
        modal:true,
        buttons:{
            "<?=LangAdmin::get('close')?>":function () {
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
                '<div class="qq-upload-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><?=LangAdmin::get('select_a_picture')?></div>' +
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

</script>

<?
include ("templates/footer.php");
?>
