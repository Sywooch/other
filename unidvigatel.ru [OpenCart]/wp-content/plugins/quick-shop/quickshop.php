<?php
/*
Plugin Name: Quick Shop (RUS)
Plugin URI: http://www.zackdesign.biz/category/wp-plugins/quick-shop
Description: Быстрая и легкая корзина с виджетами!
Author: Перевод на русский - GAV
Version: 2.2.1
Author URI: http://blogav.ru
*/

require_once('quickshop_class.php');

global $quickShop;

if ( class_exists('quickShop') ) $quickShop = new quickShop();

if ( isset($quickShop) )
{
$quickShop->pluginPath = str_replace('\\', '/', ABSPATH) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/';
// added by RavanH for MU compatibility >>
if ( dirname(dirname(plugin_basename(__FILE__))) == WPMU_PLUGIN_URL )
$quickShop->pluginURL = WPMU_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)) . '/';
else
$quickShop->pluginURL = WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)) . '/';
//<<

add_action('init',           array($quickShop, 'init'));
add_action('plugins_loaded', array($quickShop, 'quickshop_widgets'));
add_action('admin_menu',     array($quickShop, 'quickshop_options_page'));

add_filter('the_content', array($quickShop, 'content_filter'));
add_filter('whitelist_options', array($quickShop, 'whitelist_options')); // added by RavanH for MU compatibility

add_shortcode('quickshop', array($quickShop, 'shortcode'));

// CForms2 API for Emailer
if (!function_exists('my_cforms_action()'))
{
function my_cforms_action($cformsdata)
{
global $quickShop;
$_SESSION['qscart'] = array();
$quickShop->update_quantity();
}
}

}
?>