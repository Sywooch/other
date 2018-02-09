<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb;
$wpcc_id = intval($_GET['wpcc_id']);

if($wpcc_id > '0') {
	echo do_shortcode('[wpcc id="'.$wpcc_id.'"]');
} else {
	echo 'No ID.';
}
?>