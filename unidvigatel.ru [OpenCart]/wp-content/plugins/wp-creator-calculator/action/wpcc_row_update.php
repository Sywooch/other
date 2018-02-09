<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;

if (current_user_can('administrator')) {

	$array = $_POST['arrayorder'];
	
	if ($_POST['update'] == "update"){
	
		$count = 1;
		foreach ($array as $id) {
			$res = $wpdb->query("UPDATE wp_wpcc SET wpcc_order = " . $count . " WHERE wpcc_id = '$id'");
			$count ++;
		}
	}
}
?>