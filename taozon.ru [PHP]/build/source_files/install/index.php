<?php
if(@$_GET['action'] == 'setlang'){
    @include ('action.setlang.php');
}

header('Content-Type: text/html; charset=utf-8'); 
require_once('../config.php');
require_once('../config/config.php');
session_cache_expire(60*24);

if(!isset($_SESSION['active_lang']))
    $_SESSION['active_lang'] = 'ru';
Lang::getTranslations(dirname(__FILE__).'/langs/');

include ('header.php');
$action = @$_GET['action'] ? $_GET['action'] : 'welcome';

if (file_exists('../userdata/finish')) $action = 'finish';

if (!@include ('action.' . $action . '.php')) {
    die ('<div class="bigtitle"><div class="wrap clrfix"><h1>'.Lang::get('invalid_install_action_attempted').'. [action=' . $action . ']</h1></div></div>'.'
        <div class="main"><div class="wrap clrfix">
        <div class="bgr-panel mt20">
            <a href="index.php" class="btn fll">'.Lang::get('back_to_start').'</a>
        </div>
        
        ');
}

include ('footer.php');
