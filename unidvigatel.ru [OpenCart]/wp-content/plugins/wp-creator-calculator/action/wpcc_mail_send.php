<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
echo wpcc_mail_send($_POST['wpcc_mail_send_id'],$_POST);
?>