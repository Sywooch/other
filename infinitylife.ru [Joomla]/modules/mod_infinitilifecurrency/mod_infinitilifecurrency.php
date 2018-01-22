<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeCurrency
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author      Vladislav Fursov
 */

defined('_JEXEC') or die;


function get_web_page( $url )
{
    $uagent = "Opera/9.80 (Windows NT 6.1; WOW64) Presto/2.12.388 Version/12.14";

    $ch = curl_init(str_replace(" ","%20",$url));;

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   // возвращает веб-страницу
    curl_setopt($ch, CURLOPT_HEADER, 0);           // не возвращает заголовки
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);   // переходит по редиректам
    curl_setopt($ch, CURLOPT_ENCODING, "");        // обрабатывает все кодировки
    curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);        // таймаут ответа
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);       // останавливаться после 10-ого редиректа

    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$filename = dirname(__FILE__) . '/daily.xml';
$time = 0;
if(file_exists($filename)){
    $time = time() - filemtime($filename);
}

if($time > 60*60 || !file_exists($filename)){
    $url = "http://www.cbr.ru/scripts/XML_daily.asp?";
    set_time_limit(0);

    $result = get_web_page($url);
    if (($result['errno'] != 0 )||($result['http_code'] != 200)){

    } else{
        $fp = fopen ($filename, 'w+');//This is the file where we save the    information

        $page = $result['content'];
        fwrite($fp, $page);

        fclose($fp);
    }

}

$xml = simplexml_load_file($filename);

if(isset($xml)){
    $arr = array();
    $curr = array();
    foreach($xml as $val){
        $arr[strtolower(trim($val->CharCode))] = $val->Value;
    }

    $configCurr = explode(",", $params->get("currency"));
    foreach($configCurr as $val){
        $curr[$val] = $arr[strtolower(trim($val))];
    }
}
require JModuleHelper::getLayoutPath('mod_infinitilifecurrency', $params->get('layout', 'default'));
