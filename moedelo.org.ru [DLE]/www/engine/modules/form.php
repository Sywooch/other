<?php	function dump($var, $stop = 1)
	{
		echo '<pre>';
		print_r($var);
		echo '</pre>';
		if ($stop == 1)
			exit;
	}
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

######### Конфигурациия Скрипта ##########
$db_project="form_project"; 		// Имя Таблицы для Проектов.
$db_items="form_items"; 		// Название Таблицы для компонетов Проекта.
##########################################
//==========Дальше Лудше ничего не трогать===========//
if(!defined('DATALIFEENGINE')) { die("Hacking attempt!"); }
$fid = array();
if(!$_GET['id']) { echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL={$config['http_home_url']}'>"; exit; }
   if(!@include_once ROOT_DIR.'/language/'.$config['langs'].'/form/user.lng') { echo "<center><h3>Error, loadings of a language package</h3></center>"; }
$row2=$db->super_query("SELECT * FROM `$db_project` WHERE id={$_GET['id']}"); $file_st="ok";
if ($is_logged)
{ $group=$member_id['user_group']; $name=$member_id['name']; $emailo=$member_id['email']; if($group==1) { $gr="yes"; } } else { $group=0; }
if($group==$row2['gr'] || $row2['gr']==0 || $gr=="yes") {
$code.="<div class='atitle'><h1>{$row2['title']}</h1></div>";
$res=$db->query("SELECT * FROM `$db_items` WHERE id_project='{$_GET['id']}' ORDER BY pos"); $row=$db->get_row($res);
$code.="<form action='' enctype='multipart/form-data' method='post'>";
if($row['id']) { 

if($row2['title_ok']==1) { $fs="<font color='red' size=2>*</font> <b>{$form_lang['USER_TEXT_1']}</b><br>"; $typ="text"; $onbr="<br><br>"; } else { $typ="hidden"; $onbr=""; } $pole.="$fs<input type='$typ' name='subject' value='{$row2['title_def']}' style='width:300px;'>$onbr";
if($row2['from_ok']==1) { $pole.="<font color='red' size=2>*</font> <b>{$form_lang['USER_TEXT_2']}</b><br><input type='text' name='email' value='$emailo' style='width:300px;'><br><br>"; }
do
{
$id=$row['id']; $objz="";
$name="pole_".$id;
if($row['objaz']==1) { $objz="<font color='red' size=2>*</font>"; }
if($row['type']=="text") { $pole.="<div style='margin:7px 0'>$objz <b>{$row['title']}</b><div style='padding:3px;'><input type='{$row['type']}' maxlength='{$row['max']}' name='$name' class='f_input' value='{$row['value']}'></div></div>"; }
elseif($row['type']=="radio" or $row['type']=="checkbox") { $id=$row['id']; $pole.="<div style='margin:7px 0'>$objz <b>{$row['title']}</b><div style='padding-top:8px;'>".radio($id)."</div></div>"; }
elseif($row['type']=="select") { $id=$row['id']; $pole.="<div style='margin:7px 0 11px 0; display:inline-block; *display:inline'><b>{$row['title']}</b> $objz ".radio($id)."</div>"; }
elseif($row['type']=="file") { $pole.="$objz <b>{$row['title']}</b><br><input type='{$row['type']}' name='file-id-{$id}' class='f_input2'><input type='hidden' name='size' value='{$row['max']}'>"; }
else { 
if($row['max']!="") { $val=explode(",",$row['max']); } else { $val[0]=50; $val[1]=5; }
$pole.="<div style='margin:7px 0'>$objz <b>{$row['title']}</b><div style='padding:3px;'><textarea cols='{$val[0]}' rows='{$val[1]}' class='f_textarea'  name='$name'>{$row['value']}</textarea></div></div>"; }
}
while($row=$db->get_row($res));
			$code.="<p>$pole</p>";

$res=$db->query("SELECT `id` FROM `$db_items` WHERE id_project='{$_GET['id']}' AND `type`=\"file\" ORDER BY pos"); 
$i = 0;
while($r=$db->get_row($res))
{
	$fid[] = $r['id'];
}
//dump($fid);
//=======Прикрепление файла======//


if(!empty($fid))
{
	for($i = 0; $i < sizeof($fid); $i++)
	{
		$key = 'file-id-' . $fid[$i];
		//dump($key);
		if(is_uploaded_file($_FILES[$key]['tmp_name'])) 
		{
			$uploaddir=ROOT_DIR."/uploads/form/";
			$file_name=$_FILES[$key]["name"];
			$uploadfile=$uploaddir.$file_name;
			$size=$_POST['size']*1024;
			if($_FILES[$key]['size'] > $size) 
			{
				$file_st="error"; msgbox($form_lang['USER_TEXT_3'],"<center><font color='red' size=2>{$form_lang['USER_TEXT_4']} {$_POST['size']} Kb.</font></center>");
			} 
			else
			{
				if(move_uploaded_file($_FILES[$key]['tmp_name'], $uploadfile))
				{
					echo $uploadfile;
					$file[$i]=$uploadfile; 
				} 
			}
		}
	}
}
//=============================//

if($_POST['email']) { $from_email=$_POST['email']; } else { $from_email=$config['admin_mail']; }

if($row2['code']==1) { 
$code.=<<<HTML
<script language='JavaScript' type="text/javascript">
function reload () {

	var rndval = new Date().getTime(); 

	document.getElementById('dle-captcha').innerHTML = '<a onclick="reload(); return false;" href="#">{$lang['reload_code']}</a><br><img src="{$path['path']}engine/modules/antibot.php?rndval=' + rndval + '" border="0" width="120" height="50">';

};
</script>
HTML;
$code.="<p><font color='red' size=2>*</font> <b>{$form_lang['USER_TEXT_5']}</b><br>
<span id='dle-captcha'><a onclick='reload(); return false;' href='#'>{$lang['reload_code']}</a><br><img src='{$path['path']}engine/modules/antibot.php' alt='{$lang['sec_image']}' border='0'></span>
<br><input type='text' name='passe' style='width:113px;'></p>";
}
$code.="<p><input type='submit' name='ok' class='bbcodes' style='margin:8px 0' value='{$form_lang['USER_TEXT_6']}'></form></p>";
$code.="{$form_lang['USER_TEXT_7']} <font color='red' size=2>*</font> {$form_lang['USER_TEXT_8']}";
}
#####
if($row2['code']==1) {
if($_POST['passe']==$_SESSION['sec_code_session']) { $stop_code="ok"; } else { $stop_code="err"; }
} else { $stop_code="ok"; }

if($_POST['ok']) {

// инициализация переменной, сообщающей об ошибке. 
$obz = '';

$res=$db->query("SELECT * FROM `$db_items` WHERE id_project='{$_GET['id']}'"); $row=$db->get_row($res);
	do
	{
		if($row['objaz']==1) 
		{
			$name="pole_".$row['id'];
		
			// Если поле обязательное, то проверяем его на корректность //
			switch( $row['type'] )
			{
				case 'text':
				case 'textarea':
				{
					if($_POST[$name]=="") 
					{
						//print 'te';
						$obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>";
					}
					break;
				}
				case 'radio':
				{
					if (!(isset($_POST[ $name ]) && $_POST[ $name ] !== ''))
					{
						//print 'ra: '.$_POST[$name];
						$obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>";
					}
					break;
				}
				case 'checkbox':
				{
					$values = explode(',', $row['value']);
					$count_sel = 0;
					for($i=0; $i<count($values); $i++) {
						if (isset($_POST[$name.'_'.$i])) {
							$count_sel++;
						}
					}
					if ($count_sel == 0) {
						$obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>";
					}
				
					/*
					if (!isset($_POST[$name])) 
					{
						//print 'chk: '.$_POST[$name];
						$obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>";
					}
					*/
					break;
				}
				case 'select':
				{
					/*if (!isset($_POST[$name]) || 
						 empty($_POST[$name]) || 
						 (is_array($_POST[$name]) && count($_POST[$name])==0) || 
						 (!is_array($_POST[$name]) && ($_POST[$name] == '-1'))) */
					if (@$_POST[ $name ] === '')
					{
						//print 'sel';
						$obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>";
					}
					break;
				}
			}
			
			//$name="pole_".$row['id'];
			//if($_POST[$name]=="") { $obz="<center><font color='red' size=2>{$form_lang['USER_TEXT_9']}</font>"; }
		}
	} while($row=$db->get_row($res));
if($file_st!="error") {
if(!$obz) {
 if ($stop_code=="ok") { 
$subject=$_POST['subject'];
$msg=msg();
$row2=$db->super_query("SELECT * FROM `$db_project` WHERE id={$_GET['id']}");
if($row2['email']!="") {
print '';
XMail($from_email, $row2['email'], $subject, $msg);
} else { 
$val=explode(",",$row2['email2']); foreach($val as $v) { XMail($from_email, $v, $subject, $msg);}
}

} else { msgbox($form_lang['USER_TEXT_3'],"<center><font color='red' size=2>{$form_lang['USER_TEXT_10']}</font></center>"); }
 } else { msgbox($form_lang['USER_TEXT_3'],$obz."<br>{$form_lang['USER_TEXT_7']} <font color='red' size=2>*</font> {$form_lang['USER_TEXT_8']}</center>"); }
     } 
}



} else { $code.="<center><h1>{$row2['text_not_prav']}</h1></center>"; }
//-------Функции-------//
### Функция Отправки на email
function XMail($from, $to, $subject, $msg) {
global $form_lang,$config,$file;

/*
print 'from: '.$from."\n";
print 'to: '.$to."\n";
print 'subject: '.$subject."\n";
print 'msg: '.$msg."\n";
print 'file: '.$file."\n";
*/
if(isset($file))
{		
	$un        = strtoupper(uniqid(time()));
	$head      = "From: $from\n";
	$head     .= "To: $to\n";
	$head     .= "Subject: $subject\n";
	$head     .= "X-Mailer: PHPMail Tool\n";
	$head     .= "Reply-To: $from\n";
	$head     .= "Mime-Version: 1.0\n";
	$head     .= "Content-Type:multipart/mixed;";
	$head     .= "boundary=\"----------".$un."\"\n";
	$zag = "";
	$zag      .= "------------".$un."\nContent-Type:text/html; charset=\"windows-1251\"\n";
	$zag      .= "Content-Transfer-Encoding: 8bit\n\n$msg\n";
	$zag      .= "------------".$un."\n";
	for($i = 0; $i < sizeof($file); $i++)
	{
		$f         = @fopen($file[$i],"rb");	
		$zag      .= "Content-Type: application/octet-stream;";
		$zag      .= "name=\"".basename($file[$i])."\"\n";
		$zag      .= "Content-Transfer-Encoding:base64\n";
		$zag      .= "Content-Disposition:attachment;";
		$zag      .= "filename=\"".basename($file[$i])."\"\n";
		$zag      .= chunk_split(base64_encode(fread($f,filesize($file[$i]))))."\n";
	}
} 
else 
{
    $un        = strtoupper(uniqid(time()));
    $head      = "From: $from\n";
    $head     .= "To: $to\n";
    $head     .= "Subject: $subject\n";
    $head     .= "X-Mailer: PHPMail Tool\n";
    $head     .= "Reply-To: $from\n";
    $head     .= "Mime-Version: 1.0\n";
	
	/*
    $head     .= "Content-Type:multipart/mixed;";
    $head     .= "boundary=\"----------".$un."\"\n";
    $zag       = "------------".$un."\nContent-Type:text/html; charset=\"windows-1251\"\n";
    $zag      .= "Content-Transfer-Encoding: 8bit\n$msg\n";
    $zag      .= "------------".$un."\n";
	*/
	
	$head .= "Content-Type: text/html; charset=windows-1251\n";
	//$head .= "Content-Length: ".strlen($msg)."\n";
	
	$zag = $msg;
}
//print 'before mail send'."\n";

$result=mail("$to", $subject, $zag, $head);
//print 'mail send, result: '.$result."\n";
if ($result!=TRUE) { msgbox($form_lang['USER_TEXT_13']," {$form_lang['USER_TEXT_11']} <a href='{$config['http_home_url']}'>{$form_lang['USER_TEXT_12']}</a>");
 	 } else  { msgbox($form_lang['USER_TEXT_13']," {$form_lang['USER_TEXT_14']} <a href='{$config['http_home_url']}'>{$form_lang['USER_TEXT_12']}</a>"); }
if($file) { unlink($file); }
} 
### Функция Сборки текста сообщения
function msg()
{
	global $db_items,$db_project,$db,$form_lang;
	
	$date=date("d/m/Y - H:i:s");
	
	$proj_id = intval(@$_GET['id']);
	
	$res=$db->query("SELECT * FROM `$db_items` WHERE id_project='{$proj_id}'"); 
	$row=$db->get_row($res);
	do
	{
		$id=$row['id'];
		$name="pole_".$id; 
		unset($tex);
		
		if($row['type']=="radio" or $row['type']=="select") 
		{ 
			$n=$_POST[$name]; 
			$array = $row['value']; 
			$val = explode(";",$array); 
			$tex="{$val[$n]}"; 
		}
		
		if($row['type']=="checkbox") 
		{ 
			$array = $row['value']; 
			$val=explode(";",$array); 
			foreach($val as $k=>$v) 
			{ 
				$name2="pole_".$id."_".$k;
				//$name2 = 'pole_'.$id;
				if ( isset($_POST[$name2]) ) 
				{ 
					$tex.="{$val[$k]}<br>"; 
				} 
			} 
		}
		
		if($row['type']=="text" || $row['type'] == 'textarea') 
		{ 
			$tex=$_POST[$name]; 
		}

		$msg.="<dl><dt><font size=4>{$row['title']}</font></dt>";
		$msg.="<dd><font size=3>{$tex}</font></dd></dl>";
	} while( $row = $db->get_row($res) );
	
	$msg.="<br><b>{$form_lang['USER_TEXT_15']}</b> $date";
	return $msg;

}



### Функция Сборка полей типа: (radio,checkbox,select)
function radio($id)
{
global $db_items,$db;
$val=array();
$ro=$db->super_query("SELECT * FROM `$db_items` WHERE id='$id'"); $array=$ro['value'];
$val=explode(";",$array);
$pol="";
foreach($val as $n=>$v)
 {
 $name="pole_".$ro['id'];  $name2="pole_".$ro['id']."_".$n; 
if($ro['type']=="checkbox") { $pol.="<input name='$name2' value=$n type='{$ro['type']}'>&nbsp;{$val[$n]}<div style='padding-bottom:8px'> </div>"; }
elseif($ro['type']=="radio") { $pol.="<input name='$name' value=$n type='{$ro['type']}'>&nbsp;{$val[$n]}<div style='padding-bottom:8px'> </div>"; } 
elseif($ro['type']=="select") { $sel1="<select name='$name'><option value=''></option>"; $pol.="<option value=$n>{$val[$n]}</option>"; $sel2="</select>&nbsp;&nbsp;"; }

 }
return $sel1.$pol.$sel2;
}
//-------Подгружаем шаблон-------//
     $tpl->load_template('form.tpl');
     $tpl->set('{code}', $code);
     $tpl->compile('content');
     $tpl->clear();
?>
