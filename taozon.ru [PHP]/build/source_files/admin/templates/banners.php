<?
include ("header.php");
$cid = @$_GET['cid'];
?>

<div class="tuning">

    <form action="index.php?cmd=banners&do=add" enctype="multipart/form-data" method="POST" class="addform"
          id="dialog-form" title="<?=LangAdmin::get('add')?>">
        <div id="upload_img2"><span></span></div>
        <p class="validateTips"></p>
        <label style="display: inline-block; width: 100px"><?=LangAdmin::get('name')?>*:</label>
        <input type="text" value="" name="desc" id="name" class="text ui-widget-content ui-corner-all"/>
        <br/><br/>
        <label style="display: inline-block; width: 100px"><?=LangAdmin::get('link')?>:</label>
        <input type="text" value="" name="link" id="link" class="text ui-widget-content ui-corner-all"/>
        <br/><br/>
        <label style="display: inline-block; width: 100px"><?=LangAdmin::get('language')?>:</label>
        <select name="language">
        <?
            foreach($data->Settings->Languages->NamedProperty as $v){
                ?>
                <option value="<?=(string)$v->Name?>"><?=(string)$v->Description?></option>
                <?
                $lang = (string)$v->Name;
                $lang_desc = (string)$v->Description;
            }
        ?>
        </select>
        <br/><br/>

        <label style="display: inline-block; width: 300px"><?=LangAdmin::get('banner_image')?>*:</label><br />
        <input  type="file" name="qqfile"/>
        <!-- <input type="hidden" name="PictureUrl" width="100px" height="100px"/> -->
    </form>
    <div id="" style="float:right;">
        <input type="button" value="<?=LangAdmin::get('add')?>..." onclick="$('#dialog-form').dialog('open');"
               class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><br/><br/>
    </div>
    <p><strong><?=LangAdmin::get('banner_description')?></strong></p>
    <ul id="sort_ban">
        <? if (isset($banners)) foreach ($banners as $banner) { ?>
        <li class="sortlist" id="b<?=$banner['id']?>">
            <table class="valign-top nowidth">
                <tr>
                    <td>
                        <a href="">
                            <? if (@strpos($banner['ban'], '.swf') !== false) { ?>
                                <object width="695" height="330">
                                    <param name="movie" value="<?=$banner['ban']?>">
                                    <embed src="<?=$banner['ban']?>" width="695" height="330">
                                    </embed>
                                </object>
                            <? }  else { ?>
                                <img src="<?=$banner['ban']?>" alt="" width="120px"/>
                            <? } ?>
                        </a>
                    </td>
                    <td width="70%" style="vertical-align: top;">
                        <span><strong><?=LangAdmin::get('description')?>:</strong>&nbsp;<?=$banner['desc']?><br/></span>
                        <span><strong><?=LangAdmin::get('link')?>:</strong>&nbsp;<?=$banner['link']?><br /></span>
                        <span><strong><?=LangAdmin::get('language')?>:</strong>&nbsp;<?=$banner['language']?></span>
                    </td>
                    <td style="vertical-align: top"><a class="ui-button ui-icon ui-icon-trash" href="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=del&amp;cmd=banners&amp;id=<?=$banner['id'];?>&amp;return=<?= urlencode($_SERVER['REQUEST_URI']) ?>"></a></td>
                </tr>
            </table>
        </li>
        <? }?>
    </ul>
    <div id="save1" style="display:none;float:right;">
        <form action="<?=BASE_DIR;?>index.php?sid=<?=$GLOBALS['ssid'];?>&amp;do=saveorder&amp;cmd=banners"
              method="post">
            <input type="hidden" id="ids" name="ids" value=""/>
            <input type="hidden" name="return" value="<?= $_SERVER['REQUEST_URI'] ?>" />
            <button id="submit1save"><?=LangAdmin::get('save')?></button>
        </form>
    </div>
</div>

<?=Plugins::invokeEvent('onRenderBannersPage')?>
<script type="text/javascript">
    $(function () {
        $("#sort_ban").sortable();
        $("#sort_ban").disableSelection();
        createUploader();
        
    });
    $("#sort_ban").sortable({
        change:function (event, ui) {
            $("#save1").show();
        }
    });
    $("#dialog-form").dialog({
        autoOpen:false,
        height:300,
        width:350,
        modal:true,
        buttons:{
            "<?=LangAdmin::get('add')?>":function () {
                this.submit();
            },
            "<?=LangAdmin::get('cancellation')?>":function () {
                $(this).dialog("close");
            }
        },
        close:function () {
        }
    });

    $("#upload_img2").dialog({
        autoOpen:false,
        height:380,
        width:730,
        modal:true,
        close:function () {
        }
    });

    $("#submit1save")
        .button()
        .click(function () {
            var result = $('#sort_ban').sortable('toArray');
            var str = '';
            $.each(result, function (i, value) {
                str += value.substr(1) + ';';

            });
            $('#ids').val(str);
            $("#submit1save").submit();
        });

    function createUploader() {
        var uploader = new qq.FileUploader({
            element:document.getElementById('file-uploader'),
            action:'utils/Upload.php',
            debug:true,
            template:'<div class="qq-uploader">' +
                '<div class="qq-upload-drop-area"><span></span></div>' +
                '<div class="qq-upload-button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><?=LangAdmin::get('select_a_picture')?></div>' +
                '<ul class="qq-upload-list"></ul>' +
                '</div>',
            onComplete:function (id, fileName, responseJSON) {
                var url = responseJSON.url;
                if (url.indexOf('.swf') + 1) {
                    $("#upload_img2").empty().append('<div></div>');
                    $('#upload_img2 div').html('<object width="695" height="330">' + 
                        '<param name="movie" value="' + url + '">' +
                        '<embed src="' + url + '" width="695" height="330">' +
                        '</embed>' + '</object>');
                } else {
                    $('#upload_img2').empty().append($('<img />').attr('src', url + '?' + Math.random()));
                    
                }
                $('#upload_img2').dialog('open');
                $('[name="PictureUrl"]').val(responseJSON.url);
            }
        });
    }

</script>

<?
include ("footer.php");
?>