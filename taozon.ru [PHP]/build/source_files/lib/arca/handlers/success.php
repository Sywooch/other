<?php
header('Content-Type: text/html; charset=utf-8');
$GLOBALS['script_start_time'] = microtime(true);
$GLOBALS['trace'] = array();

include(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
include(dirname(dirname(dirname(dirname(__FILE__)))).'/config/config.php');

$_SESSION['active_lang_admin'] = @$_SESSION['active_lang_admin'] ? $_SESSION['active_lang_admin'] : 'ru';

if(!isset($_POST['orderID'])){
    header('Location: /index.php?p=paymentfail');
}
else{
    try{
        $A = new Arca();
        $A->onUserPaidSuccess($_POST['orderID']);

        $cms = new CMS();
        $cms->Check();
        $page = $cms->GetPageByAlias('arka_success');
        if(!$page){
            $pageId = $cms->CreatePage(
                array(
                    'alias' => 'arka_success',
                    'title' => 'Оплата успешно произведена',
                    'lang'  => 'ru',
                    'pagetitle' => '',
                    'seo_keywords' => '',
                    'seo_description' => '',
                )
            );
            $pageInfo = $cms->GetFullPageById($pageId);
            $cms->UpdateBlockByID($pageInfo['block_id'],
                '<p>Оплата успешно произведена. Деньги поступят на вас счет в течение 10-15 минут.</p>');
        }

        header('Location: /index.php?p=arka_success');
    }
    catch(Exception $e){
        header('Location: /index.php?p=paymentfail');
    }
}
