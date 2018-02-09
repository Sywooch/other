<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;
$wpcc_id = intval($_GET['wpcc_id']);

if($wpcc_id > '0') {
	$wpcc_text = $wpdb->get_results("SELECT * FROM `wp_wpcc` WHERE `wpcc_cat` = '$wpcc_id' AND `wpcc_type` NOT IN ('textblock') ORDER BY `wpcc_order`");
	if(count($wpcc_text) > '0') {
		foreach($wpcc_text as $wpcc_text_row) {
			echo $wpcc_text_row->wpcc_to.$wpcc_text_row->wpcc_id.$wpcc_text_row->wpcc_af;
		}
	} else {
		_e('Formula is empty', 'wpcc');
	}
} else {
	echo 'No ID.';
}
?>