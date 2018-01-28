<?php
/**
* @Copyright ((c) bigemot.ru
* @ http://bigemot.ru/
* @license    GNU/GPL
*/

defined('_JEXEC') or die;
require_once JPATH_ADMINISTRATOR.'/components/com_quickform/helpers/quickform.php';

$reqForm=JRequest::getInt('formreq', NULL);
if($reqForm){
	header ("Content-type: text/html; charset=utf-8");
	require_once(JPATH_ADMINISTRATOR."/components/com_quickform/helpers/form.php");
	
	$contents = new QuickForm((int)$reqForm);
	echo $contents->ajaxHTML();
	exit;
}
	
JRequest::checkToken() or jexit( 'Invalid Token' );
require_once JPATH_COMPONENT.'/helpers/class.php';

if(JRequest::getCmd( 'task')!='form')return;
if(!JRequest::getInt('id', NULL))return;

$post = JRequest::get('post');
$db		= JFactory::getDBO();
$user = JFactory::getUser();

$qfCheck = new qfCheck;
$row = $qfCheck->getClonerQuery((int)$post['id']);


$groups	= $user->getAuthorisedViewLevels();
if(!in_array($row->access, $groups))return;

$start=(float)str_replace(',','.',$row->price);
$sum=$GLOBALS['qfSum']=0;
$c=$row->calc?1:0;
$params=json_decode($row->params, TRUE);

if(!$tmpl=$params['tmpl']) $tmpl='default';
$html =$qfCheck->getFilds($row->cod,$c, $post['id'],$tmpl) ;

$res=NULL;
if($c){
	$arr=explode(';',$GLOBALS['qfSum']);
	if(!$params['formul']){
		$sum=$start;
		foreach($arr as $ar){
			if($ar{0}=='*')$sum*=substr($ar, 1);
			elseif($ar{0}=='=')$sum=substr($ar, 1);
			elseif($ar{0}=='-')$sum-=substr($ar, 1);
			elseif($ar{0}=='+')$sum+=substr($ar, 1);
		}
		$res=$sum;
	}
	elseif($params['formul']==1){
		foreach($arr as $ar){
			if($ar{0}=='*')$start*=substr($ar, 1);
			elseif($ar{0}=='=')$start=substr($ar, 1);
			elseif($ar{0}=='-')$sum-=substr($ar, 1);
			elseif($ar{0}=='+')$sum+=substr($ar, 1);
		}
		$res=$start+$sum;
	}
	elseif($params['formul']==2){
		$sum=$start;
		$mul=1;
		foreach($arr as $ar){
			if($ar{0}=='*')$mul*=substr($ar, 1);
			elseif($ar{0}=='=')$sum=substr($ar, 1);
			elseif($ar{0}=='-')$sum-=substr($ar, 1);
			elseif($ar{0}=='+')$sum+=substr($ar, 1);
		}
		$res=$sum*$mul;
	}
}

include JPATH_COMPONENT.'/helpers/mailtmpl/'.$tmpl.'.php';


if(strpos($mailHtml, '_claster')) $mailHtml = preg_replace("/(_claster)(.+?)(claster_)/e", "qfCheck::clasterreplace('\\2',".$c.")", $mailHtml);
if($tmpl=='json'){
	$mailHtml= preg_replace('/(<td style=[^>]*?>)([^<]*?)(<\/td><\/tr>)/', '\\1\\2\\3,<br/>', $mailHtml);
	$mailHtml= preg_replace('/(<td style=[^>]*?>)([^<]*?)(<\/td>)/', '"\\2",', $mailHtml);
	$mailHtml= str_replace(array('<tr>','</tr>'), '', $mailHtml);
	$mailHtml= str_replace(',,', '', $mailHtml);
}


//echo $mailHtml;die;


$mailer = JFactory::getMailer();
$jAp = JFactory::getApplication();

$lsFromEmail = $jAp->getCfg('mailfrom');
$lsFromName  = $jAp->getCfg('fromname');
$lsFrom 	 = array($lsFromEmail, $lsFromName);

if($row->toemail){
	$arr=explode(',',$row->toemail);
	foreach($arr as $ar){
		$mailer->addRecipient(trim($ar));
	}
}
else $mailer->addRecipient($lsFromEmail);

if($post['back'])$mailer->addRecipient($post['email']);

$mailer->setSender($lsFrom);
$mailer->addReplyTo($lsFrom);
$mailer->setSubject(JText::_('MESSAGE').' '.$_SERVER['HTTP_HOST']);
$mailer->setBody($mailHtml);
$mailer->isHTML(true);

$files = $jAp->input->files->get( 'qffile', array(), 'array' );
foreach ( $files as $file ) {
	$mailer->addAttachment( $file['tmp_name'], $file['name'] ); 
}


if ($mailer->Send() !== true)$msg=JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST');
else {
	$msg=JText::_('COM_MAILTO_EMAIL_SENT');
	
	$fields = array(
		'st_formid' => (int)$row->id, 
		'st_date' => gmdate('Y-m-d H:i:s'),
		'st_form' => $mailHtml, 
		'st_title' => $row->title, 
		'st_cur' => $row->cur, 
		'st_price' => $start+$sum, 
		'st_ip' => $qfCheck->getip(), 
		'params' => '', 
		'st_user' => $user->get('id'), 
		'st_status' => 0
	);
	foreach($fields as $key=>$value){
		$v_key.=",$key";
		$v_value.=",'$value'";
	}
	$v_key=substr($v_key, 1);
	$v_value=substr($v_value, 1);

	$db->setQuery("INSERT INTO `#__quickform_ps` ($v_key) VALUES ($v_value)");
	$db->query();
	
	$db->setQuery("UPDATE `#__quickform` SET hits = ( hits + 1 ) WHERE id = ".(int)$row->id);
	$db->query();
}

if($_SERVER['HTTP_REFERER'])$link=$_SERVER['HTTP_REFERER'];
else $link='/';

$jAp->redirect($link,$msg);
