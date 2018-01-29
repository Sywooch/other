<?php
error_reporting(~E_NOTICE);

if(@$_GET['action'] == 'setlang'){
    @include ('action.setlang.php');
}

header('Content-Type: text/html; charset=utf-8'); 
require_once('../config.php');
require_once('../config/config.php');
session_cache_expire(60*24);

Lang::getTranslations(dirname(__FILE__).'/langs/');

include ('header.php');
$action = @$_GET['action'] ? $_GET['action'] : 'welcome';

if (file_exists('../userdata/finishupdate')) $action = 'finishupdate';

if (!@include ('update.' . $action . '.php')) {
    die ('Invalid install action attempted. [action=' . $action . ']');
}

include ('footer.php');
