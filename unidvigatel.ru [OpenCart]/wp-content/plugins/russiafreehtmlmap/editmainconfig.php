<?php
if(isset($_POST['act_type']) && $_POST['act_type'] == 'russiafree_map_plugin_main_save') {
    update_option('russiafree-html5map_nameFontSize', $_POST['name_font_size'].'px');
    update_option('russiafree-html5map_borderColor', $_POST['borders_color']);
    update_option('russiafree-html5map_nameColor', $_POST['name_color']);
    update_option('russiafree-html5map_mapWidth', $_POST['mapWidth']);
    update_option('russiafree-html5map_mapHeight', $_POST['mapHeight']);
    update_option('russiafree-html5map_statesInfoArea', $_POST['statesArea']);
}



echo "<h2>" . __( 'Общие настройки карты', 'russiafree-html5-map' ) . "</h2>";
?>
<script xmlns="http://www.w3.org/1999/html">
    jQuery(function(){
        jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

        jQuery('.color~.colorpicker').each(function(){
            jQuery(this).farbtastic(jQuery(this).prev().prev());
            jQuery(this).hide();
            jQuery(this).prev().prev().bind('focus', function(){
                jQuery(this).next().next().fadeIn();
            });
            jQuery(this).prev().prev().bind('blur', function(){
                jQuery(this).next().next().fadeOut();
            });
        });

    });
</script>

<form method="POST" class="russiafree-html5-map">
    <p>На этой странице можно выбрать общие настройки карты. Чтобы выбрать цвет, кликните в поле с кодом цвета, выберите цвет, затем кликните в любом месте вне цветового круга.</p>
    <h3 class="settings-chapter">
        Настройки карты
    </h3>
    <span class="title">Цвет границ: </span><input class="color" type="text" name="borders_color" value="<?php echo get_option('russiafree-html5map_borderColor'); ?>" style="background-color: #<?php echo get_option('russiafree-html5map_borderColor'); ?>" readonly />
        <span class="tipsy-q" original-title="Цвет границ регионов">[?]</span><div class="colorpicker"></div><br />

    <span class="title">Ширина карты: </span><input class="span2" type="text" name="mapWidth" value="<?php echo get_option('russiafree-html5map_mapWidth'); ?>" />
    <span class="tipsy-q" original-title="Ширина карты">[?]</span><br />

    <span class="title">Высота карты: </span><input class="span2" type="text" name="mapHeight" value="<?php echo get_option('russiafree-html5map_mapHeight'); ?>" />
    <span class="tipsy-q" original-title="Высота карты">[?]</span><br />

    <h3 class="settings-chapter">
        Настройки отображения дополнительной информации
    </h3>
    <?php $statesArea = get_option('russiafree-html5map_statesInfoArea', 'bottom'); ?>
    <span class="title">Отображать дополнительную информацию: </span>
    <label>Правее карты: <input type="radio" name="statesArea" value="right" <?php echo $statesArea == 'right'?'checked':''?> /></label>
    <label>Ниже карты: <input type="radio" name="statesArea" value="bottom" <?php echo $statesArea == 'bottom'?'checked':''?> /></label>
    <span class="tipsy-q" original-title="Эта настройка определяет местоположение блока с дополнительной информацией">[?]</span><br />

    <h3 class="settings-chapter">
        Настройки шрифта для кодов регионов
    </h3>
    <span class="title">Размер шрифта: </span><input class="span2" type="text" name="name_font_size" value="<?php echo preg_replace('/[^\d]+/i', '', get_option('russiafree-html5map_nameFontSize')); ?>" />
    <span class="tipsy-q" original-title="Размер шрифта кодов регионов">[?]</span><br />

    <span class="title">Цвет: </span><input id='color' class="color" type="text" name="name_color" value="<?php echo get_option('russiafree-html5map_nameColor'); ?>" style="background-color: #<?php echo get_option('russiafree-html5map_nameColor'); ?>" readonly />
    <span class="tipsy-q" original-title="Цвет шрифта кодов регионов">[?]</span><div class="colorpicker"></div><br />

    <input type="hidden" name="act_type" value="russiafree_map_plugin_main_save" />
    <p class="submit"><input type="submit" value="Сохранить изменения" class="button-primary" id="submit" name="submit"></p>
</form>

