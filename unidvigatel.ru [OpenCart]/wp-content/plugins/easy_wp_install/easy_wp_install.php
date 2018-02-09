<?php
    /*
    Plugin Name: Easy Basket WordPress Plugin
    Plugin URI: http://www.easybasket.co.uk
    Description: Plugin for installing Easy Basket, Free AJAX Shopping Cart with Paypal & Google Checkout
    Author: Tim Dodgson
    Version: 1.0
    Author URI: http://www.easybasket.co.uk
    */

	function easy_wp_head() {
		$css = get_option('easy_cssname'); 
		$location = get_option('easy_location');
		$ebenabledd = get_option('easy_enabledd');
		$ebenablesh = get_option('easy_enablesh');

		if ($ebenabledd == "true") {
			$dd = "dragdrop;";
		} else {
			$dd = "";
		}
		if ($ebenablesh == "true") {
			$sh = "showhide;";
		} else {
			$sh = "";
		}

		echo  "<meta name='easybasket' content='location=$location;".$dd.$sh."' />
			<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js'></script>
			<script type='text/javascript' src='".$location."easybasket.js'></script>
			<link rel='stylesheet' href='".$location."skins/$css' type='text/css'/>";
		if ($ebenabledd == "true") {
			echo "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js'></script>";
		}
	};
	
	function easy_wp_admin() {
		include('easy.php');
	}

	function easy_basket() {
		$skin = get_option('easy_skinname');
		echo "<div style='margin-bottom:1em;' class='easybasket' data-url='skin=$skin'></div>";
	}
	
	function widget_easybasket_init() {
		wp_register_sidebar_widget('easy_basket_widget', 'Easy Basket', 'easy_basket');
	}
	
	function easybasket_plugin_actions($links) {
		$settings_link = '<a href="'.get_bloginfo('wpurl').'/wp-admin/admin.php?page=easy_wp_install/easy_wp_install.php">Settings</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}
	
	function load_jquery() {	
		echo  "<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js'></script>
			<script type='text/javascript' src='../wp-content/plugins/easy_wp_install/settings.js'></script>";	
	}
	
	function wpr_admin_menu(){
		 add_menu_page('Easy Basket', 'Easy Basket',8,__FILE__);
		 add_submenu_page(__FILE__, 'Dashboard', 'Install', 8, __FILE__,"easy_wp_admin");
		 add_submenu_page(__FILE__, 'Configure', 'Configure', 8, "easy_wp_install/settings.php");
	}
	
	$plugin = plugin_basename(__FILE__);
	add_filter( 'plugin_action_links_' . $plugin, 'easybasket_plugin_actions' );
	add_action('wp_head', 'easy_wp_head');
	add_action("plugins_loaded", "widget_easybasket_init");
	add_action('admin_menu','wpr_admin_menu');
	add_action('admin_head', 'load_jquery');
?>