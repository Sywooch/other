<?php
/*
Plugin Name: Интерактивная карта России для WordPress
Plugin URI: http://fla-shop.com.ru
Description: Интерактивная карта Российской Федерации имеет широкий спектр настроек - цвета, целевые ссылки, а также всплывающие окна. Краткая инструкция: 1) Кликните "Activate" для активации плагина, 2) Отредактируейте настройки карты и регионов, и 3) Для установки карты на странице вставьте тег <strong>[russiafree-html5map]</strong> в тексте страницы или поста.
Version: 1.0
Author: Fla-shop.com
Author URI: http://fla-shop.com.ru
License: 
*/ 

add_action('admin_menu', 'russiafree_map_plugin_menu');

function russiafree_map_plugin_menu() {

    add_menu_page(__('Интерактивная карта России','russiafree-html5-map'), __('Интерактивная карта России','russiafree-html5-map'), 'manage_options', 'russiafree-map-plugin-options', 'russiafree_map_plugin_options' );

    add_submenu_page('russiafree-map-plugin-options', __('Настройки регионов','russiafree-html5-map'), __('Настройки регионов','russiafree-html5-map'), 'manage_options', 'russiafree-map-plugin-states', 'russiafree_map_plugin_states');
    add_submenu_page('russiafree-map-plugin-options', __('Предпросмотр карты','russiafree-html5-map'), __('Предпросмотр карты','russiafree-html5-map'), 'manage_options', 'russiafree-map-plugin-view', 'russiafree_map_plugin_view');

}

function russiafree_map_plugin_options() {
    include('editmainconfig.php');
}

function russiafree_map_plugin_states() {
    include('editstatesconfig.php');
}

function russiafree_map_plugin_view() {
    echo russiafree_map_plugin_content('[russiafree-html5map]');
}

add_action('admin_init','russiafree_map_plugin_scripts');

function russiafree_map_plugin_scripts(){
    if ( is_admin() ){

        wp_register_style('jquery-tipsy', plugins_url('/static/css/tipsy.css', __FILE__));
        wp_enqueue_style('jquery-tipsy');
        wp_register_style('russiafree-html5-mapadm', plugins_url('/static/css/mapadm.css', __FILE__));
        wp_enqueue_style('russiafree-html5-mapadm');
        wp_enqueue_style('farbtastic');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('farbtastic');
        wp_enqueue_script('tiny_mce');
        wp_register_script('jquery-tipsy', plugins_url('/static/js/jquery.tipsy.js', __FILE__));
        wp_enqueue_script('jquery-tipsy');

    }
    else {

        wp_register_style('russiafree-html5-map-style', plugins_url('/static/css/map.css', __FILE__));
        wp_enqueue_style('russiafree-html5-map-style');
        wp_register_script('raphael', plugins_url('/static/js/raphael-min.js', __FILE__));
        wp_enqueue_script('raphael');
        wp_register_script('russiafree-html5-map-js', plugins_url('/static/js/map.js', __FILE__));
        wp_enqueue_script('russiafree-html5-map-js');
        wp_enqueue_script('jquery');

    }
}

add_action('wp_enqueue_scripts', 'russiafree_map_plugin_scripts_method');

function russiafree_map_plugin_scripts_method() {
    wp_enqueue_script('jquery');
}

/*add_action( 'admin_enqueue_scripts', 'russiafree_map_plugin_load_custom_wp_admin' );

function russiafree_map_plugin_load_custom_wp_admin() {
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('tiny_mce');
}*/

add_filter('the_content', 'russiafree_map_plugin_content', 10);

function russiafree_map_plugin_content($content) {

    $dir = WP_PLUGIN_URL.'/russiafreehtmlmap/static/';
    $siteURL = get_site_url();

    $stateInfoArea = get_option('russiafree-html5map_statesInfoArea', 'bottom');

    $mapInit = "
        <div class='russiafreehtmlmap$stateInfoArea'>
            <link href='{$dir}/css/map.css' rel='stylesheet' type='text/css'>
            <script type='text/javascript' src='{$dir}js/raphael-min.js'></script>
            <script type='text/javascript' src='{$siteURL}/index.php?russiafreemap_js_data=true'></script>
            <script type='text/javascript' src='{$dir}js/map.js'></script>
            <script>
                function usa_map_set_state_text(state) {
                    jQuery('#russiafreehtmlmapStateInfo').html('Loading...');
                    jQuery.ajax({
                        type: 'POST',
                        url: '{$siteURL}/index.php?russiafreemap_get_state_info='+state,
                        success: function(data, textStatus, jqXHR){
                            jQuery('#russiafreehtmlmapStateInfo').html(data);
                        },
                        dataType: 'text'
                    });
                }
            </script>
            <div id='russiafreehtmlmapStateInfo'></div>
            <div style='clear: both'></div>
		</div>
    ";

    $content = str_ireplace(array(
        '<russiafree-html5map></russiafree-html5map>',
        '<russiafree-html5map />',
        '[russiafree-html5map]'
    ), $mapInit, $content);

    return $content;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'russiafree_map_plugin_settings_link' );

function russiafree_map_plugin_settings_link($links) {
    $settings_link = '<a href="admin.php?page=russiafree-map-plugin-options">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}

add_action( 'parse_request', 'russiafree_map_plugin_wp_request' );

function russiafree_map_plugin_wp_request( $wp ) {
    if( isset($_GET['russiafreemap_js_data']) ) {

        header( 'Content-Type: application/javascript' );
       ?>
    var
        mapWidth		= <?php echo get_option('russiafree-html5map_mapWidth')?>,
        mapHeight		= <?php echo get_option('russiafree-html5map_mapHeight')?>,

        shadowWidth		= <?php echo get_option('russiafree-html5map_shadowWidth')?>,
        shadowOpacity		= <?php echo get_option('russiafree-html5map_shadowOpacity')?>,
        shadowColor		= "<?php echo get_option('russiafree-html5map_shadowColor')?>",
        shadowX			= <?php echo get_option('russiafree-html5map_shadowX')?>,
        shadowY			= <?php echo get_option('russiafree-html5map_shadowY')?>,

        iPhoneLink		= <?php echo get_option('russiafree-html5map_iPhoneLink')?>,

        isNewWindow		= <?php echo get_option('russiafree-html5map_isNewWindow')?>,

        borderColor		= "<?php echo get_option('russiafree-html5map_borderColor')?>",
        borderColorOver		= "<?php echo get_option('russiafree-html5map_borderColorOver')?>",

        nameColor		= "<?php echo get_option('russiafree-html5map_nameColor')?>",
        nameFontSize		= "<?php echo get_option('russiafree-html5map_nameFontSize')?>",
        nameFontWeight		= "<?php echo get_option('russiafree-html5map_nameFontWeight')?>",

        overDelay		= <?php echo get_option('russiafree-html5map_overDelay')?>,
        nameStroke		= false,

        map_data = <?php echo get_option('russiafree-html5map_map_data')?>;
        <?php

        exit;
    }

    if(isset($_GET['russiafreemap_get_state_info'])) {
        $stateId = (int) $_GET['russiafreemap_get_state_info'];

        echo nl2br(get_option('russiafree-html5map_state_info_'.$stateId));

        exit;
    }
}

register_activation_hook( __FILE__, 'russiafree_map_plugin_activation' );

function russiafree_map_plugin_activation() {
    $initialStatesPath = dirname(__FILE__).'/static/settings_tpl.json';
    add_option('russiafree-html5map_map_data', file_get_contents($initialStatesPath));
    add_option('russiafree-html5map_mapWidth', 610);
    add_option('russiafree-html5map_mapHeight', 360);
    add_option('russiafree-html5map_shadowWidth', 2);
    add_option('russiafree-html5map_shadowOpacity', 0.3);
    add_option('russiafree-html5map_shadowColor', "black");
    add_option('russiafree-html5map_shadowX', 1);
    add_option('russiafree-html5map_shadowY', 2);
    add_option('russiafree-html5map_iPhoneLink', "true");
    add_option('russiafree-html5map_isNewWindow', "false");
    add_option('russiafree-html5map_borderColor', "#ffffff");
    add_option('russiafree-html5map_borderColorOver', "#ffffff");
    add_option('russiafree-html5map_nameColor', "#ffffff");
    add_option('russiafree-html5map_nameFontSize', "12px");
    add_option('russiafree-html5map_nameFontWeight', "bold");
    add_option('russiafree-html5map_overDelay', 300);
    add_option('russiafree-html5map_statesInfoArea', "bottom");

    for($i = 1; $i <= 83; $i++) {
        add_option('russiafree-html5map_state_info_'.$i, '');
    }
}

register_deactivation_hook( __FILE__, 'russiafree_map_plugin_deactivation' );

function russiafree_map_plugin_deactivation() {

}

register_uninstall_hook( __FILE__, 'russiafree_map_plugin_uninstall' );

function russiafree_map_plugin_uninstall() {
    delete_option('russiafree-html5map_map_data');
    delete_option('russiafree-html5map_mapWidth');
    delete_option('russiafree-html5map_mapHeight');
    delete_option('russiafree-html5map_shadowWidth');
    delete_option('russiafree-html5map_shadowOpacity');
    delete_option('russiafree-html5map_shadowColor');
    delete_option('russiafree-html5map_shadowX');
    delete_option('russiafree-html5map_shadowY');
    delete_option('russiafree-html5map_iPhoneLink');
    delete_option('russiafree-html5map_isNewWindow');
    delete_option('russiafree-html5map_borderColor');
    delete_option('russiafree-html5map_borderColorOver');
    delete_option('russiafree-html5map_nameColor');
    delete_option('russiafree-html5map_nameFontSize');
    delete_option('russiafree-html5map_nameFontWeight');
    delete_option('russiafree-html5map_overDelay');
    delete_option('russiafree-html5map_statesInfoArea');

    for($i = 1; $i <= 83; $i++) {
        delete_option('russiafree-html5map_state_info_'.$i);
    }
}

