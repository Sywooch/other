<?php

session_start();
$_SESSION['key'] = $_POST['key'];

include('../lib/timer.php');
include('../lib/Curl.class.php');
include('../otapilib.php');

$key = @$_POST['key'] ? $_POST['key'] : 'opendemo';
define('CFG_SERVICE_INSTANCEKEY', $key);
define('CFG_SERVICE_APPKEY', '');
define('CFG_SERVICE_APPPASSWORD', '');

$otapilib = new OTAPIlib();
$res = $otapilib->GetRootCategoryInfoList();
print $otapilib->error_code;
