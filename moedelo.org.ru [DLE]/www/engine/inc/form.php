<?php
//==================================================
//---------------------------------------------
// Script: form.php
//---------------------------------------------
// 	> Copyright (c) 2008
//	> Author: KorsaR -aKa- Стас
//	> Date: 04/07/2008
//	> WebSite: http://KorsaR.ZnPortal.ru/
//	> From: Russia(Moscow/Zhukovsky)
//----------------------------------------------
// All Rights Reserved.
//----------------------------------------------
//==================================================
######### Конфигурациия Скрипта ##########
$db_project="form_project"; 		// Имя Таблицы для Проектов.
$db_items="form_items"; 		// Название Таблицы для компонетов Проекта.
##########################################
//==========Дальше Лудше ничего не трогать===========//
if(!defined('DATALIFEENGINE')) { die("Hacking attempt!"); }
if( $member_id['user_group'] != 1 ) { msg("Error!", $lang['addnews_denied'], $lang['db_denied']); }
   if(!@include_once ROOT_DIR.'/language/'.$config['langs'].'/form/admin.lng') { echo "<center><h3>Error, loadings of a language package</h3></center>"; }
//------------------------------------//
function main_form()
{
global $db,$db_project,$db_items,$form_lang;
$all=$db->super_query("SELECT count(*) as count FROM `$db_project`"); $all=$all['count'];
$code.="<center><hr width='70%'>{$form_lang['all_form']} $all<hr width='70%'>";
$code.="<font size=3><a href='admin.php?mod={$_GET['mod']}&page=add_form'>{$form_lang['add_form']}</a></font></center>";
$res=$db->query("SELECT * FROM `$db_project` ORDER BY date DESC"); $row=$db->get_row($res);  
if($row['id'])
{
	do
	{
$code.="<dl><dt><small><i>{$row['date']}</i></small><br>";
$code.="<font size=4><a href='index.php?do=form&id={$row['id']}'>{$row['title']}</a></font></dt>";
$code.="<dd><a href='admin.php?mod={$_GET['mod']}&page=form_edit&id={$row['id']}'>[ {$form_lang['edit_form']} ]</a>&nbsp;<a href='admin.php?mod={$_GET['mod']}&page=edit_form&id={$row['id']}'>[ {$form_lang['comp_form']} ]</a>&nbsp;<a href='admin.php?mod={$_GET['mod']}&delete={$row['id']}'>[ {$form_lang['del_form']} ]</a></dd></dl><br>";
	}
	while($row=$db->get_row($res));
}
echo $code;
}

//--------Удаление Формы--------//
if($_GET['delete'])
{
$code2.="<br><center><font style='font-size:14px;'><b>{$form_lang['yesdel_form']}</b></font><br><a href='admin.php?mod={$_GET['mod']}&delete={$_GET['delete']}&f=ok'>[ {$form_lang['yes_form']} ]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin.php?mod={$_GET['mod']}'>[ {$form_lang['no_form']} ]</a></center>";
if($f=="ok")
{ 
$res=$db->query("DELETE FROM `$db_items` WHERE id_project={$_GET['delete']}");
$res2=$db->query("DELETE FROM `$db_project` WHERE id={$_GET['delete']}");
if($res==TRUE && $res2==TRUE) { $code2=""; $code2.="<br><center><font color='green'>{$form_lang['ok_del_form']}</font></center>"; $code2.="<META HTTP-EQUIV='Refresh' CONTENT='2; URL={$config['http_home_url']}admin.php?mod={$_GET['mod']}'>"; }
}
}

//--------Создание Новой Формы--------//
function add_form()
{
global $group_list,$lang,$db,$db_project,$db_items,$form_lang;
$texts=$form_lang['def_prav_form']; $s1="checked"; $f1="checked"; $c2="checked"; $te=$form_lang['greit_form'];

if($_GET['page']=="form_edit") { $row=$db->super_query("SELECT * FROM `$db_project` WHERE id={$_GET['id']}"); $texts=$row['text_not_prav']; $te=$form_lang['edits_form'];
if($row['title_ok']==1) { $s2=""; $s1="checked"; } else { $s1=""; $s2="checked"; }
if($row['from_ok']==1) { $f2=""; $f1="checked"; } else { $f1=""; $f2="checked"; }
if($row['code']==1) { $c2=""; $c1="checked"; } else { $c1=""; $c2="checked"; }
}
$code.="<form action='' method='post'><table>";
$code.="<tr><td width='350px'><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_name_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['name_form']}</b></font>&nbsp;<br><br></td><td><input type='text' name='title' value='{$row['title']}' style='width:300px;' class='edit'><br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_email_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['email_form']}</b></font>&nbsp;<br><br></td><td><input type='text' name='email' value='{$row['email']}' style='width:300px;' class='edit'><br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_email2_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['email2_form']}</b></font>&nbsp;<br><br></td><td><input type='text' name='email2' value='{$row['email2']}' style='width:600px;' class='edit'><br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_code_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['code_form']}</b></font>&nbsp;<br><br></td><td><input type='radio' name='code' class='edit' value='1' $c1>{$form_lang['yes_form']}&nbsp;<input type='radio' name='code' class='edit' value='0' $c2>{$form_lang['no_form']}<br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_from_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['from_form']}</b></font>&nbsp;<br><br></td><td><input type='radio' name='from_ok'class='edit' value=1 $f1>{$form_lang['yes_form']}&nbsp;<input type='radio' name='from_ok' class='edit' value=0 $f2>{$form_lang['no_form']}<br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_title_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['title_form']}</b></font>&nbsp;<br><br></td><td><input type='radio' name='title_ok'class='edit' value=1 $s1>{$form_lang['yes_form']}&nbsp;<input type='radio' name='title_ok' class='edit' value=0 $s2>{$form_lang['no_form']}<br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_tit_def_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['title_def_form']}</b></font>&nbsp;<br><br></td><td><input type='text' name='title_def' value='{$row['title_def']}' style='width:300px;' class='edit'><br><br></td></tr>";

$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_gr_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><b>{$form_lang['gr_form']}</b></font>&nbsp;<br><br></td><td>";

$res3=$db->query("SELECT * FROM ". PREFIX ."_usergroups"); $row3=$db->get_row($res3); 
$sel2=""; if($row['gr']==0) { $sel2="selected"; }
$code.="<select name='gr'><option value='0' $sel2>- {$form_lang['all_gr_form']} -</option>";
do
{
$sel="";
if($row['gr']==$row3['id']) { $sel="selected"; }
$code.="<option value={$row3['id']} $sel>{$row3['group_name']}</option>";
}
while($row3=$db->get_row($res));

$code.="</select><br><br></td></tr>";
$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_no_prav_form']}', this, event, '250px')\">[?]</a>&nbsp;<font size=2><center><b>{$form_lang['no_prav_form']}</b></center></font>&nbsp;<br><br></td><td><textarea cols=50 rows=5 name=text_not_prav>$texts</textarea><br><br></td></tr>";
$code.="<tr><td colspan='2'><center><input type='submit' class='buttons' name='greit_form' style='width:80%;' value='$te'></center></td></tr>";
$code.="</table></form>";
echo $code;
}

//--------Занесение значений Новой Формы в БД--------//
if($_POST['greit_form'])
{
foreach($_POST as $k=>$v) { $_POST[$k]=strip_tags($_POST[$k]); }
if($_POST['greit_form']=="{$form_lang['greit_form']}") {
$add_ok="ok";
$query="INSERT INTO `$db_project` (title,email,email2,code,title_ok,from_ok,title_def,text_not_prav,gr) values ('{$_POST['title']}','{$_POST['email']}','{$_POST['email2']}','{$_POST['code']}','{$_POST['title_ok']}','{$_POST['from_ok']}','{$_POST['title_def']}','{$_POST['text_not_prav']}','{$_POST['gr']}')";
 $r=$form_lang['ok_greit']; } else { $r=$form_lang['ok_edit']; $query="UPDATE `$db_project` SET title='{$_POST['title']}',email='{$_POST['email']}',email2='{$_POST['email2']}',code='{$_POST['code']}',title_ok='{$_POST['title_ok']}',from_ok='{$_POST['from_ok']}',title_def='{$_POST['title_def']}',text_not_prav='{$_POST['text_not_prav']}',gr='{$_POST['gr']}' WHERE id={$_GET['id']}"; }

if($_POST['title']!="")
		{
			if($_POST['title']!="" && $_POST['email']!="" || $_POST['email2']!="" && $_POST['gr']!="")
				{
		$res=$db->query($query);
		if($res==TRUE) { if($add_ok=="ok") { $id=$db->insert_id(); $sa="<a href='admin.php?mod={$_GET['mod']}&page=edit_form&id=$id'>{$form_lang['pereitikzap']}</a>"; } $code2.="<br><br><font color='green'><center><b> {$form_lang['yspeshno']} $r!</b><br>$sa</center></font>"; } else { $code2.="<br><br><font color='red'><center><b>{$form_lang['forma_ne']} $r!<br>{$form_lang['povtorite']}</b></center></font>"; }
				} else { $code2.="<br><br><font color='red'><center><b>{$form_lang['objz_pole']}</b></center></font>"; }
		} else { $code2.="<br><br><font color='red'><center><b>{$form_lang['weneykazali']}</b></center></font>"; }
$code2.="<META HTTP-EQUIV='Refresh' CONTENT='2; URL={$config['http_home_url']}admin.php?mod=form'>";
}
//--------Наполнение Новой Формы--------//
function edit_form()
{
global $db,$db_items,$form_lang;
$res=$db->query("SELECT * FROM `$db_items` WHERE id_project={$_GET['id']}"); $row=$db->get_row($res);
$code.="<h2>{$form_lang['spisokkomp']}</h2><center><table width='100%'><tr><td></td>
<td align='center'><b>{$form_lang['nazvpole']}</b></td>
<td align='center'><b>{$form_lang['tippole']}</b></td>
<td align='center'><b>{$form_lang['maxsimv']}</b><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_maxsimv']}', this, event, '340px')\">[?]</a></td>
<td align='center'><b>{$form_lang['znach_poyml']}</b></td>
<td align='center'><b>{$form_lang['pozpole']}</b><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_pozpole']}', this, event, '340px')\">[?]</a></td>
<td align='center'><b>{$form_lang['objz_pole']}</b></td></tr>";
if($row['id'])
{
 do
 {
$d1=""; $d2=""; $s1=""; $s2=""; $s3=""; $s4=""; $s5=""; $s6="";
$id=$row['id'];
$title="title_".$id;
$type="type_".$id;
$max="max_".$id;
$value="value_".$id;
$objaz="objaz_".$id;
$pos="pos_".$id;
if($row['type']=="text") { $s1="selected"; }
elseif($row['type']=="textarea") { $s2="selected"; }
elseif($row['type']=="radio") { $s3="selected"; }
elseif($row['type']=="checkbox") { $s4="selected"; }
elseif($row['type']=="select") { $s5="selected"; }
elseif($row['type']=="file") { $s6="selected"; }
if($row['objaz']==1) { $d1="checked"; } else { $d2="checked"; }

$code.="<form action='' method='post'><tr><td align='center'><input type='submit' class='buttons' title='{$form_lang['edit_danpole']}' value='ок' style='heght:2px;' name='edit_item'>&nbsp;
<a href='admin.php?mod={$_GET['mod']}&page={$_GET['page']}&del={$id}&id={$_GET['id']}'><img src='/uploads/form/del.png' title='{$form_lang['del_danPole']}' border=0></a></td>
<td align='center'><input type='text' name='{$title}' value='{$row['title']}' style='width:180px;' class='edit'></td>";
$code.="<td align='center'><select name='{$type}' style='width:170px;'><option value='text' $s1>{$form_lang['text']}</option><option value='textarea' $s2>{$form_lang['textarea']}</option><option value='radio' $s3>{$form_lang['radio']}</option><option value='checkbox' $s4>{$form_lang['checkbox']}</option><option value='select' $s5>{$form_lang['select']}</option><option value='file' $s6>{$form_lang['file']}</option></select></td>";
$code.="<td align='center'><input type='text' name='{$max}' value='{$row['max']}' style='width:60px;' class='edit'></td>";
$code.="<td align='center'><input type='text' name='{$value}' value='{$row['value']}' style='width:190px;' class='edit'></td>";
$code.="<td align='center'><input type='text' name='{$pos}' value='{$row['pos']}' style='width:45px;' class='edit'></td>";
$code.="<td align='center'><input type='radio' name='{$objaz}' value=1 $d1>{$form_lang['yes_form']}&nbsp;<input type='radio' name='{$objaz}' value=0 $d2>{$form_lang['no_form']}</td></tr>";
$code.="<input type='hidden' name='id' value='{$id}'></form>";
 }
 while($row=$db->get_row($res));
} else { $code.="<tr><td colspan='6' align='center'><br><b>{$form_lang['non_compn']}</b></td></tr>"; }
$code.="</table></center><br><hr width='90%' />";

$code.="<form action='' method='post'><h3>{$form_lang['add_new_compn']}</h3>";
$code.="<table>";
$code.="<tr><td><font color='red' size=2>*</font> <b>{$form_lang['nazvpole']}</b><br><input type='text' name='title' style='width:250px;' class='edit'><br><br></td></tr>";

$code.="<tr><td><font color='red' size=2>*</font> <b>{$form_lang['tippole']}</b><br><select name='type' style='width:250px;'><option value='0'></option><option value='text'>{$form_lang['text']}</option><option value='textarea'>{$form_lang['textarea']}</option><option value='radio'>{$form_lang['radio']}</option><option value='checkbox'>Ф{$form_lang['checkbox']}</option><option value='select'>{$form_lang['select']}</option><option value='file'>{$form_lang['file']}</option</select><br><br></td></tr>";

$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_maxsimv']}', this, event, '340px')\">[?]</a> <b>{$form_lang['maxsimv']}</b><br><input type='text' name='max' style='width:250px;' class='edit'><br><br></td></tr>";

$code.="<tr><td><a href='#' class='hintanchor' onMouseover=\"showhint('{$form_lang['op_ymlch']}', this, event, '340px')\">[?]</a> <b>{$form_lang['znach_poyml']}</b><br><input type='text' name='value' style='width:250px;' class='edit'><br><br></td></tr>";

$code.="<tr><td><b>{$form_lang['objz_for_zp']}</b><br><input type='radio' name='objaz' value=1 checked>{$form_lang['yes_form']}&nbsp;<input type='radio' name='objaz' value=0>{$form_lang['no_form']}<br></td></tr>";
$code.="<tr><td><br><input type='submit' class='buttons' name='add_item' style='width:250px;' value='{$form_lang['add']}'></td></tr></table></form>";
echo $code;
}
//--------Занесение нового компонента Формы в БД--------//
if($_POST['add_item'])
{
foreach($_POST as $k=>$v) { $_POST[$k]=strip_tags($_POST[$k]); }
$query="INSERT INTO `$db_items` (title,id_project,type,value,objaz,pos,max) values ('{$_POST['title']}','{$_GET['id']}','{$_POST['type']}','{$_POST['value']}','{$_POST['objaz']}','0','{$_POST['max']}')";

if($_POST['title']!="")
		{
			if($_POST['title']!="" && $_POST['type']!="0")
				{
		$res=$db->query($query);
		if($res==TRUE) { $code2.="<br><br><font color='green'><center><b>{$form_lang['pole_ok_sozd']}</b></center></font>"; } else { $code2.="<br><br><font color='red'><center><b>{$form_lang['pole_no_sozd']}</b></center></font>"; }
				} else { $code2.="<br><br><font color='red'><center><b>{$form_lang['objz_pole']}</b></center></font>"; }
$code2.="<META HTTP-EQUIV='Refresh' CONTENT='2; URL={$config['http_home_url']}admin.php?mod={$_GET['mod']}&page=edit_form&id={$_GET['id']}'>";
		} else { $code2.="<br><br><font color='red'><center><b>{$form_lang['weneykazalipol']}</b></center></font>"; }
}
//--------Редактирование компонента Формы в БД--------//
if($_POST['edit_item'])
{
$id=$_POST['id'];
$title="title_".$id;
$type="type_".$id;
$max="max_".$id;
$value="value_".$id;
$objaz="objaz_".$id; $pos="pos_".$id;
foreach($_POST as $k=>$v) { $_POST[$k]=strip_tags($_POST[$k]); }
$query="UPDATE `$db_items` SET title='{$_POST[$title]}',type='{$_POST[$type]}',value='{$_POST[$value]}',max='{$_POST[$max]}',objaz='{$_POST[$objaz]}',pos='{$_POST[$pos]}' WHERE id='{$id}'";

			if($_POST[$title]!="" && $_POST[$type]!="0")
				{
		$res=$db->query($query);
		if($res==TRUE) { $code2.="<br><br><font color='green'><center><b>{$form_lang['pole_ok_edit']}</b></center></font>"; } else { $code2.="<br><br><font color='red'><center><b>{$form_lang['pole_no_edit']}</b></center></font>"; }
				} else { $code2.="<br><br><font color='red'><center><b>{$form_lang['objz_pole']}</b></center></font>"; }
$code2.="<META HTTP-EQUIV='Refresh' CONTENT='2; URL={$config['http_home_url']}admin.php?mod={$_GET['mod']}&page={$_GET['page']}&id={$_GET['id']}'>";
}
//--------Удаление компонента Формы из БД--------//
if($_GET['del']>0)
{
$res=$db->query("DELETE FROM `$db_items` WHERE id={$_GET['del']}");
		if($res==TRUE) { $code2.="<br><br><font color='green'><center><b>{$form_lang['pole_ok_del']}</b></center></font>"; } else { $code2.="<br><br><font color='red'><center><b>{$form_lang['pole_no_del']}</b></center></font>"; }
$code2.="<META HTTP-EQUIV='Refresh' CONTENT='2; URL={$config['http_home_url']}admin.php?mod={$_GET['mod']}&page={$_GET['page']}&id={$_GET['id']}'>";
}
//------------------------------------//
echoheader("", "");
echo <<<HTML
<div style="padding-top:5px;padding-bottom:2px;">
<table width="100%">
    <tr>
        <td width="4"><img src="engine/skins/images/tl_lo.gif" width="4" height="4" border="0"></td>
        <td background="engine/skins/images/tl_oo.gif"><img src="engine/skins/images/tl_oo.gif" width="1" height="4" border="0"></td>
        <td width="6"><img src="engine/skins/images/tl_ro.gif" width="6" height="4" border="0"></td>
    </tr>
    <tr>
        <td background="engine/skins/images/tl_lb.gif"><img src="engine/skins/images/tl_lb.gif" width="4" height="1" border="0"></td>
        <td style="padding:5px;" bgcolor="#FFFFFF">
<table width="100%">
    <tr>
        <td bgcolor="#EFEFEF" height="29" style="padding-left:10px;"><div class="navigation"><a href='{$config['http_home_url']}admin.php?mod={$_GET['mod']}'>{$form_lang['name_script']}</a></div></td>
    </tr>
</table>
<div class="unterline"></div>
<table width="100%">
    <tr>
    <td style="padding:2px;" colspan="2">
HTML;
echo $code2."<br>";
switch($_GET['page'])
{
case "add_form"  : add_form(); 		break;
case "edit_form" : edit_form(); 	break;
case "form_edit" : add_form();  	break;

default : main_form();
}
echo <<<HTML
</td></tr>
</table>
<br><br></td>

	<td background="engine/skins/images/tl_rb.gif"><img src="engine/skins/images/tl_rb.gif" width="6" height="1" border="0"></td>
    </tr>
    <tr>
        <td><img src="engine/skins/images/tl_lu.gif" width="4" height="6" border="0"></td>
        <td background="engine/skins/images/tl_ub.gif"><img src="engine/skins/images/tl_ub.gif" width="1" height="6" border="0"></td>
        <td><img src="engine/skins/images/tl_ru.gif" width="6" height="6" border="0"></td>
    </tr>
</table>
</div>
HTML;
echofooter();
?>
