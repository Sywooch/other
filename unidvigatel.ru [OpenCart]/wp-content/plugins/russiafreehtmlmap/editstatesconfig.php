<?php

$states = get_option('russiafree-html5map_map_data');
$states = json_decode($states, true);

if(isset($_POST['act_type']) && $_POST['act_type'] == 'russiafree_map_plugin_states_save') {

    foreach($states as $s_id=>$vals)
    {
        if(isset($_POST['name'][$vals['id']]))
            $states[$s_id]['name'] = $_POST['name'][$vals['id']];

        if(isset($_POST['URL'][$vals['id']]))
            $states[$s_id]['link'] = stripslashes($_POST['URL'][$vals['id']]);

        if(isset($_POST['info'][$vals['id']]))
            $states[$s_id]['comment'] = strip_tags($_POST['info'][$vals['id']]);

        if(isset($_POST['image'][$vals['id']]))
            $states[$s_id]['image'] = $_POST['image'][$vals['id']];

        if(isset($_POST['color'][$vals['id']]))
            $states[$s_id]['color_map'] = $_POST['color'][$vals['id']];

        if(isset($_POST['color_'][$vals['id']]))
            $states[$s_id]['color_map_over'] = $_POST['color_'][$vals['id']];

        if(isset($_POST['descr'][$vals['id']]))
            update_option('russiafree-html5map_state_info_'.$vals['id'], stripslashes($_POST['descr'][$vals['id']]));
    }

    update_option('russiafree-html5map_map_data', json_encode($states));
}



echo "<h2>" . __( 'Настройки регионов', 'russiafree-html5-map' ) . "</h2>";
?>
<script>
    var imageFieldId = false;
    jQuery(function(){
        jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

        jQuery('.color~.colorpicker').each(function(){
            var me = this;

            jQuery(this).farbtastic(function(color){

                var textColor = this.hsl[2] > 0.5 ? '#000' : '#fff';

                jQuery(me).prev().prev().css({
                    background: color,
                    color: textColor
                }).val(color);

                if(jQuery(me).next().find('input').attr('checked') == 'checked') {
                    return;
                    var dirClass = jQuery(me).prev().prev().hasClass('colorSimple') ? 'colorSimple' : 'colorOver';

                    jQuery('.'+dirClass).css({
                        background: color,
                        color: textColor
                    }).val(color);
                }

            });

            jQuery.farbtastic(this).setColor(jQuery(this).prev().prev().val());

            jQuery(jQuery(this).prev().prev()[0]).bind('change', function(){
                jQuery.farbtastic(me).setColor(this.value);
            });

            jQuery(this).hide();
            jQuery(this).prev().prev().bind('focus', function(){
                jQuery(this).next().next().fadeIn();
            });
            jQuery(this).prev().prev().bind('blur', function(){
                jQuery(this).next().next().fadeOut();
            });
        });

        jQuery('.stateinfo input:radio').click(function(){
            //alert(jQuery(this).attr('id'));
            var el_id = jQuery(this).attr('id').substring(1);
            if(jQuery(this).attr('id').charAt(0)=='n'){
                jQuery("#URL"+el_id).attr("value", "");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='d'){
                jQuery("#URL"+el_id).attr("value", "#");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='o'){
                jQuery("#URL"+el_id).attr("value", "http://");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeIn(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='m'){
                jQuery("#URL"+el_id).attr("value", "javascript:usa_map_set_state_text("+el_id+");");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeIn(0);
            }
        });

        jQuery('.colorSimpleCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorSimpleCh').attr('checked', false);
                this.checked = true;
            }
        });

        jQuery('.colorOverCh').bind('click', function(){
            if(this.checked) {
                jQuery('.colorOverCh').attr('checked', false);
                this.checked = true;
            }
        });

        window.send_to_editorArea = window.send_to_editor;

        window.send_to_editor = function(html) {
            if(imageFieldId === false) {
                window.send_to_editorArea(html);
            }
            else {
                var imgurl = jQuery('img',html).attr('src');
                jQuery('#'+imageFieldId).val(imgurl);
                imageFieldId = false;

                tb_remove();
            }

        }

    });

    function adjustSubmit() {
        if(jQuery('.colorOverCh:checked').length > 0) {
            var ch = jQuery('.colorOverCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorOver').val(color);
        }

        if(jQuery('.colorSimpleCh:checked').length > 0) {
            var ch = jQuery('.colorSimpleCh:checked')[0];
            var color = jQuery(ch).parent().prev().prev().prev().val();
            jQuery('.colorSimple').val(color);
        }
    }
</script>

<form method="POST" class="russiafree-html5-map" onsubmit="adjustSubmit()">
    <p>Настройки на этой странице позволяют настроить цвета и добавить информацию для регионов.</p>
	<p class="help">* Термин "регион" означает одно из следующих: страна, республика, край, область, штат, округ или район, в зависимости от конкретного плагина.</p>
    <select name="state_select" onchange="jQuery('.stateinfo').hide(); jQuery('#stateinfo-'+this.value).show(); tinyMCE.execCommand('mceAddControl', true, 'descr'+this.value)">
        <option value=0>Выбрать регион</option>
        <?php
        foreach($states as $s_id=>$vals)
        {
            ?>
            <option value="<?php echo $vals['id']?>"><?php echo $vals['name']?></option>
            <?php
        }
        ?>
    </select>

    <?php
	
	$mce_options = array(
		//'media_buttons' => false,
		'textarea_rows' => 20
	);
	
    foreach($states as $s_id=>$vals)
    {
        $rad_nill = "";
        $rad_def = "";
        $rad_other = "";
        $rad_more = "";
        $style_input = "";
        $style_area = "";
		
		$mce_options['textarea_name'] = "descr[{$vals['id']}]";
		
        if(trim($vals['link']) == "") $rad_nill = "checked";
        elseif(trim($vals['link']) == "#") $rad_def = "checked";
        elseif(stripos($vals['link'], "javascript:usa_map_set_state_text") === false ) $rad_other = "checked";
        else $rad_more = "checked";

        if(($rad_nill == "checked")||($rad_def == "checked")||($rad_more == "checked")) $style_input = "display: none;";
        if(($rad_nill == "checked")||($rad_def == "checked")||($rad_other == "checked")) $style_area = "display: none;";
        ?>
        <div style="display: none" id="stateinfo-<?php echo $vals['id']?>" class="stateinfo">
            <span class="title">Наименование: </span><input class="" type="text" name="name[<?php echo $vals['id']?>]" value="<?php echo $vals['name']?>" />
            <span class="tipsy-q" original-title="Наименование региона">[?]</span><br />
            <span class="title">При клике происходит следующее: </span>
            <input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="n<?php echo $vals['id']?>" value="nill" <?php echo $rad_nill?> >&nbsp;Ничего <span class="tipsy-q" original-title="Нет реакции на клик по региону">[?]</span>
            <!--input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="d<?php echo $vals['id']?>" value="def" <?php echo $rad_def?> >&nbsp;Show popup balloon on the map <span class="tipsy-q" original-title="Display a popup balloon with the specified information">[?]</span-->
            <input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="o<?php echo $vals['id']?>" value="other" <?php echo $rad_other?> >&nbsp;Открыть ссылку <span class="tipsy-q" original-title="При клике по региону открывается ссылка">[?]</span>
            <input type="radio" name="URLswitch[<?php echo $vals['id']?>]" id="m<?php echo $vals['id']?>" value="more" <?php echo $rad_more?> >&nbsp;Информация рядом с картой <span class="tipsy-q" original-title="Отобразить инфомрацию сбоку или ниже карты (адреса, телефоны и т.д.)">[?]</span><br />
            <div style="<?php echo $style_input; ?>" id="stateURL<?php echo $vals['id']?>">
                <span class="title">URL: </span><input style="width: 240px;" class="" type="text" name="URL[<?php echo $vals['id']?>]" id="URL<?php echo $vals['id']?>" value="<?php echo $vals['link']?>" />
                <span class="tipsy-q" original-title="Целевой URL">[?]</span></br>
            </div>
            <div style="<?php echo $style_area; ?>" id="stateDescr<?php echo $vals['id']?>"><br />
                <span class="title">Описание: <span class="tipsy-q" original-title="Это поле для ввода дополнительной информации, отображаемой рядом или ниже карты">[?]</span> </span>
                <?php wp_editor((get_option('russiafree-html5map_state_info_'.$vals['id'])), 'descr'.$vals['id'], $mce_options); ?>
                <!--textarea style="width: 100%" class="" rows="10" cols="45" id="descr<?php echo $vals['id']?>" name="descr[<?php echo $vals['id']?>]"><?php echo get_option('russiafree-html5map_state_info_'.$vals['id']);  ?></textarea--></br>
            </div>
            <span class="title">Всплывающее окно: <span class="tipsy-q" original-title="Здесь вы можете добавить текст для всплывающего окна">[?]</span> </span><textarea style="width:100%" class="" rows="10" cols="45" name="info[<?php echo $vals['id']?>]"><?php echo $vals['comment']?></textarea><br />
            <?php
            if(1) // just disable if((int)$tariff == 2)
            {
                ?>
                <span class="title">Цвет: </span><input <?php if((int)$tariff == 1) { echo ' disabled'; }?> class="color colorSimple" type="text" name="color[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map']?>" style="background-color: #<?php echo $vals['color_map']?>"  />
                <span class="tipsy-q" original-title='Цвет региона'>[?]</span><div class="colorpicker"></div>
                <label><input class="colorSimpleCh" type="checkbox" /> Применить для всех регионов</label>
                <br />
                <span class="title">Цвет при наведении: </span><input <?php if((int)$tariff == 1) { echo ' disabled'; }?> class="color colorOver" type="text" name="color_[<?php echo $vals['id']?>]" value="<?php echo $vals['color_map_over']?>" style="background-color: #<?php echo $vals['color_map_over']?>"  />
                <span class="tipsy-q" original-title='Цвет региона при наведении мыши'>[?]</span><div class="colorpicker"></div>
                <label><input class="colorOverCh" type="checkbox" /> Применить для всех регионов</label>
                <br />
                <?php
            }


            ?>
            <!--<span class="title">Frame: </span><input class="" type="text" name="frame[<?php echo $vals['id']?>]" value="<?php echo $vals['frame']?>" /><br />-->
            <span class="title">Изображение: </span><input onclick="imageFieldId = this.id; tb_show('Test', 'media-upload.php?type=image&tab=library&TB_iframe=true');" class="" type="text" id="image-<?php echo $vals['id']?>" name="image[<?php echo $vals['id']?>]" value="<?php echo $vals['image']?>" />
            <span class="tipsy-q" original-title="В этом поле определяется путь к изображению для всплывающего окна">[?]</span><br />
        </div>
        <?php
    }
    ?>



    <input type="hidden" name="act_type" value="russiafree_map_plugin_states_save" />
    <p class="submit"><input type="submit" value="Сохранить изменения" class="button-primary" id="submit" name="submit"></p>
</form>

