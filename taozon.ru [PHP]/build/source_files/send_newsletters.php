<?php

include_once 'config.php';
include_once 'config/config.php';

General::init();
if(!CMS::IsFeatureEnabled('Newsletter')) die;

$cms = new CMS();
$cms->Check();
$toSend = array();
$sendCount = 5;
$settings = $cms->getSiteConfig();
if ($settings[0]) $settings = $settings[1];
if (isset($settings['send_count'])&&(int)$settings['send_count']>0)
	$sendCount = $settings['send_count'];
	


$subscribes = array();
$cms->Check();
$res = mysql_query('SELECT `subscription`, `email` FROM `subscription` WHERE send=1 LIMIT '.$sendCount);
if ($res) while($row = mysql_fetch_assoc($res)){
	if (!array_key_exists($row['subscription'],$subscribes)&&file_exists(CFG_APP_ROOT.'/cache/'.$row['subscription'].'Publication.dat')){
		$subscribes[$row['subscription']]= unserialize(file_get_contents(CFG_APP_ROOT.'/cache/'.$row['subscription'].'Publication.dat'));
		$subscribes[$row['subscription']]['sended']=array();
	} elseif (!file_exists(CFG_APP_ROOT.'/cache/'.$row['subscription'].'Publication.dat')){
		if (!isset ($subscribes[$row['subscription']]['sended']))
			$subscribes[$row['subscription']]['sended']=array();
		$subscribes[$row['subscription']]['sended'][] = $row['email'];
		
	}

	if (isset($subscribes[$row['subscription']]['title'])){
		$cms->sendEmail($row['email'],$subscribes[$row['subscription']]['title'],$subscribes[$row['subscription']]['text']);
			//Учет проделаной рассылки		
		$subscribes[$row['subscription']]['sended'][] = $row['email'];			
		
			
	}
}
foreach ($subscribes as $sub=>$value){
	if (count ($value['sended'])>0){
		$res = mysql_query('UPDATE `subscription` SET send=0 WHERE `subscription`="'.$sub.'" AND email in ("'.implode('","',$value['sended']).'")');
		$res = mysql_query('SELECT t1.subscription as ID, COUNT(t1.email) as ItemCount from (select distinct subscription, email from `subscription` where subscription="'.$sub.'" and send=1 group by email) as t1 group by t1.subscription');
		$row = mysql_fetch_assoc($res);
		if ($row===false&&file_exists(CFG_APP_ROOT.'/cache/'.$sub.'Publication.dat')){
			unlink(CFG_APP_ROOT.'/cache/'.$sub.'Publication.dat');
		}
	}
}


//Учет конца рассылки
$res_letter = mysql_query('SELECT * FROM `subscription` WHERE send=1');
if ($res_letter && mysql_num_rows($res_letter)>0) {
	//echo "Не Кончиличь";
	//продолжаем в след раз		
	//Учет сделаной рассылки по времени
	if (isset($settings['send_time'])) {
		$dte=time();
		$res_letter = mysql_query('UPDATE `site_config` SET  `value` = "'.$dte.'" WHERE  `key` = "'."send_time".'"');
	} else {
		$dte=time();
		$res_letter = mysql_query('INSERT INTO `site_config` (`id`, `key`, `value`) VALUES (NULL, "'."send_time".'", "'.$dte.'")');
	}
} else {
	//Заканчиваем
	//echo "Кончиличь";
	$res_letter = mysql_query('DELETE FROM `site_config` WHERE  `key` = "'."send_time".'";');		
}


?>