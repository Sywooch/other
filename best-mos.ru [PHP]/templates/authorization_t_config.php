<?
#
#  ������ �������� ����� �����
#
#  Modified         :
#  Version          : 1.0
#  Programmer       : Kormishin Vladimir
#


/****** ����� ����� **********************************************************/

// ����� �����������
// ����� � ����� �����
$auth_panel_guest        = <<<EOF
				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="enterform">
				<form method="post" action="/authorization/login/">
				<tr valign="middle">
				<td width="20%">					
					��� �����
				</td>
				<td width="40%">										
					<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
<input class="enterformfield" type="text" name="username" value="��� �����" maxlength="50" border="0" onfocus="this.value=''">
					</td></tr></table>
				</td>
				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
				<td width="12%">
					������
				</td>				
				<td width="40%">
					<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
<input class="enterformfield" type="Password" name="userpass" value="password" maxlength="50" border="0" onfocus="this.value=''">
					</td></tr></table>
				</td>
				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
				<td width="10%">
					<table width="30" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table>
					<table border="0" cellpadding="0" cellspacing="0"><tr><td>
<input type="image"  src="/i/button_ok.gif" onmouseover="this.src='/i/button_ok_a.gif';" onmouseout="this.src='/i/button_ok.gif';" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
					</td></tr></table>
				</td>
				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
				<td width="8%">
				<div class="passrem"><a href="/authorization/remember/">������ ������?</a><div>
				</td>
				</tr>
				</form>
				</table>
EOF;


// ����� �����������
// ��������� �� �������� �����������, ������� � ������� �������������� �� �������
$auth_panel_guest2        = <<<EOF
<b>������� ����� � ������ ���� �� ��� ���� ���������������� �����:</b><br><br>

                                <form method="post" name="login" action="/authorization/login/">
                                <input type="hidden" value="/shop/login/" name="referer">

				<table border=0 cellspacing=0 cellpadding=0 width="100%">
				
                                <tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
                                    <td style="width:200px;" align="right"><span>��� �����</span> </td>
                                    <td width="5">&nbsp;</td>
                                    <td><input class="enterformfield" type="text" name="username" value="" maxlength="50" border="0" onfocus="this.value=''"></td></tr>

                                <tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
                                    <td style="width:200px;" align="right"><span>������</span> </td>
                                    <td width="5">&nbsp;</td>
                                    <td><input class="enterformfield" type="Password" name="userpass" value="" maxlength="50" border="0" onfocus="this.value=''"></td></tr>

                                <tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
                                    <td style="width:200px;" align="right"></td>
                                    <td width="5">&nbsp;</td>
                                    <td>
                                        <input type="submit" value="�����">
                                        <div class="passrem"><a href="/authorization/remember/">������ ������?</a><div>
                                    </td></tr>
                                </table>
				</form>
<br><br><br>
EOF;



//$auth_panel_guest2        = <<<EOF
//���� �� ��� ��������� ������������������ ������������� ������ �����, ����� ������� ���� ������ � ������:
//<br>
//
//				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="enterform">
//				<form method="post" action="/authorization/login/">
//				<input type="hidden" value="{REFERER}" name="referer">
//				<tr valign="bottom">
//
//				<td width="40%">
//
//					<table width="92" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table>
//					<div class="fieldname">��� �����</div>
//					<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
//<input class="enterformfield" type="text" name="username" value="��� �����" maxlength="50" border="0" onfocus="this.value=''">
//					</td></tr></table>
//				</td>
//				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
//				<td width="40%">
//					<table width="92" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table>
//					<div class="fieldname">������</div>
//					<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td>
//<input class="enterformfield" type="Password" name="userpass" value="password" maxlength="50" border="0" onfocus="this.value=''">
//					</td></tr></table>
//				</td>
//				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
//				<td width="10%">
//					<table width="30" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table>
//					<table border="0" cellpadding="0" cellspacing="0"><tr><td>
//<input type="image" width="30" height="15" src="/i/button_ok.gif" onmouseover="this.src='/i/button_ok_a.gif';" onmouseout="this.src='/i/button_ok.gif';" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
//					</td></tr></table>
//				</td>
//				<td width="5%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
//				<td align="5%">
//				<div class="passrem"><a href="/authorization/remember/">������ ������?</a><div>
//				</td>
//				</tr>
//				</form>
//				</table>
//<br><br><br>
//EOF;

/*
<span class=reg_title><font color=#EE0000>{ERROR}</font></span>
*/


// ���� �������������� ������
$auth_panel_user        = <<<EOF
<div id="path">
	<div style="float: right;">
		<a class="office" id="edit_url" href="/authorization/edit/"><b>{i} {f}</b></a> 
		&nbsp;<span>&raquo;</span>&nbsp;
		<a class="office" href="/authorization/out/">�����</a>
		&nbsp;<span>&raquo;</span>&nbsp;
		<a class="office" href="/shop/ordersinfo/">������</a>
	</div>
	<div class="office">������ �������</div>
</div>
EOF;

#-----------------------------------------------------------------------------------
# �������������� ������
#-----------------------------------------------------------------------------------

// ����� �������������� ������
$auth_remember        = <<<EOF
<h1>�������������� ������</h1>
<table border="0" cellspacing="0" cellpadding="0">
<tr valign="middle" height="25">
<td><b>������� ��� �����:</b></td>
<td>&nbsp;<input type="text" name="user_name" value="" style="background: transparent; border: 1px solid #A7A6AA; width: 300px; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; height: 20px;">&nbsp;</td>
</tr>
<tr valign="middle" height="25">
<td><b>������� ��� e-mail:</b></td>
<td>&nbsp;<input type="text" name="email" value="" style="background: transparent; border: 1px solid #A7A6AA; width: 300px; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; height: 20px;">&nbsp;</td>
</tr>
<tr valign="middle" height="25">
<td>&nbsp;</td>
<td>&nbsp;<input type="submit" value="�������" style="background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; height: 20px;"></td>
</tr>
</table>

<script>
$(document).ready(function(){
	$('#profile_edit').attr('action', '/authorization/doremember/');
	$('#profile_edit').attr('id', 'doremember');
	
});
</script>
EOF;

// ������������ ������, �� ������
$auth_remember_done = <<<EOF
<h1>�������������� ������</h1>
<p>������ ������� ������ �� ��������� �����.</p>
<p>������� �� <a href="/">������� ��������</a> �����.</p>
EOF;

// ������������ ������, �� ������
$auth_remember_error = <<<EOF
<h1>�������������� ������</h1>
<p>������������ � ���������� ������� � e-mail �� ������.</p>
<p>������� �� <a href="/">������� ��������</a> �����.</p>
EOF;

# ������ ������� � ��� ���������������� ������� � ����� � ������
$_auth_remember_mail = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>������������,</b> {f} {i}!
<br><br>
���� ��������������� ������ � ������� best-mos.ru:
<br><br>
�����: <b>{user_name}</b><br>
������: <b>{user_pass}</b>

<br>{INFO_BLOCK}
<br>
<br>
--<br>
C ���������, best-mos.ru
</body>
</html>
EOF;

#-----------------------------------------------------------------------------------
# �����: �������������� ������
#-----------------------------------------------------------------------------------


#-----------------------------------------------------------------------------------
# �������������� �������
#-----------------------------------------------------------------------------------

// �������������� �������
$auth_edit_form = <<<EOF
<table border="0" cellpadding="0" cellspacing="4">


<tr>
<td align="right"><b><span id="span_email">�����:</span></b></td>
<td>&nbsp;{user_name}</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_email">��� e-mail:</span></b></td>
<td>&nbsp;<input id="email"  name="email" value="{email}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_user_pass">������:</span></b></td>
<td>&nbsp;<input id="user_pass" name="user_pass" value="" size="3" type="password">&nbsp;</td>
<td>��������� ��� ����� ������</td>
</tr>

<tr>
<td align="right"><b><span id="span_user_pass2">��������� ������:</span></b></td>
<td>&nbsp;<input id="user_pass2" name="user_pass2" value="" size="3" type="password">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"></td>
<td>&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_index">�������� ������:</span></b></td>
<td>&nbsp;<input id="index" name="index" value="{index}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>



<tr valign="top">
<td align="right"><b><span id="span_adress_deliver">����� ��������:</span></b></td>
<td colspan=2>&nbsp;<textarea id="adress_deliver" name="adress_deliver">{adress_deliver}</textarea></td>
</tr>

<tr>
<td align="right"><b><span id="span_f">�������:</span></b></td>
<td>&nbsp;<input id="f" name="f" value="{f}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_i">���:</span></b></td>
<td>&nbsp;<input id="i" name="i" value="{i}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_o">��������:</span></b></td>
<td>&nbsp;<input id="o" name="o" value="{o}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span id="span_phone">���������� �������:</span></b></td>
<td>&nbsp;<input id="phonenum" name="phone" value="{phone}" size="3" type="text">&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right"><b><span>�������� ��������� ��������:</span></b></td>
<td>&nbsp;<input style="width: 20px; border:0;" name="subscribe" type="checkbox" {CHECKED}>&nbsp;</td>
<td></td>
</tr>

<tr>
<td align="right">&nbsp;</td>
<td colspan="2"><table border="0" cellpadding="0" cellspacing="0" height="5"><tbody><tr><td></td></tr></tbody></table>&nbsp;<input style="width: 200px;" value="���������" type="button" onClick="onEditFormSubmit()"></td>
</tr>

</table>


EOF;

$auth_edit_done = <<<EOF
<h1>������ �������, �������������� �������</h1>
<p>�� ������� �������� ���� ������ ������ � ����� �������.</b>
EOF;

#-----------------------------------------------------------------------------------
# �����: �������������� �������
#-----------------------------------------------------------------------------------

#-------------------------------------------------------------------------------------------------------
# ���������� ��������� ��� ������ ��� ���������� ������
#-------------------------------------------------------------------------------------------------------



# ������������ ���� � ����, �� ������ �� �������
$auth_shopauth_nopass = <<<EOF
<h2>�����������</h2>
�� ���������� ������ ������� ������, �� �������� ������ �������.<br><br>
���������� <a href="/authorization/remember/">������������ ������</a>, <a href="/authorization/auth/">��������������</a> ���  <a href="javascript:history.back();">��������� � �����������</a>
EOF;

# ������������ ���� � ����
$auth_shopreg_isset_user = <<<EOF
<h2>�����������</h2>
���� ������ ���� ���������������� ���� �����.<br>
������ ������������� ��������� ���� email � ������. 
EOF;

# ������������ ���� � ����
$auth_shopreg_do = <<<EOF
<h2>�����������</h2>
�� ��� E-mail ���������� ������ � ����������� � ������.<br>
<b>��� ���������� ����������� ����� ������� �� ������, ��������� � ������.</b>  
EOF;

#-------------------------------------------------------------------------------------------------------
# �����: ���������� ��������� ��� ������ ��� ���������� ������
#-------------------------------------------------------------------------------------------------------


#---------------------------------------------------------------------------------------------------
# ������ � ��������� �������� �� ������� ������� ����� XML
#---------------------------------------------------------------------------------------------------

$_auth_xml['begin'] = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<dataroot>
EOF;

$_auth_xml['item'] = <<<EOF
<client>
<ClientID>{user_id}</ClientID>
<F>{f}</F>
<I>{i}</I>
<O>{o}</O>
<PostInd>{index}</PostInd>
<Adr>{adress_deliver}</Adr>
<DTReg>{user_rectime}</DTReg>
<E_mail>{user_email}</E_mail>
<Tel>{phone}</Tel>
<NewsSubscribe>{subscribe}</NewsSubscribe>
<ClientStatus>{user_is_active}</ClientStatus>
<AuthorId>{user_parent}</AuthorId>
</client>
EOF;

$_auth_xml['end'] = <<<EOF
</dataroot>
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ��������� �������� �� ������� ������� ����� XML
#---------------------------------------------------------------------------------------------------


$_auth = array();


# �������������� ����, ������������� � ����� �����������, ������ �� ��������
$_auth['reg_form'] = <<<EOF


<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_phone">���������� �������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="phonenum" name="phone" value=""></td></tr>
		
<tr height="25"><td colspan="3"></td></tr>			
		
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_user_name">�����:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="user_name" name="user_name" value=""></td></tr>
	

<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd">������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd" name="passwd" value=""></td></tr>
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd2">������, ������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd2" name="passwd2" value=""></td></tr>		
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_email">E-mail:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="email" name="email" value=""></td></tr>		
		
<tr>
		<td colspan=3><br><i>��� ���� ����������� ��� ����������</i><br><input type="button" value="������������������" onClick="onRegSubmit()"></td></tr>
</table>

<script>
$(document).ready(function(){
	$('#profile_edit').attr('action', '/authorization/doedit/');
	$('#profile_edit').attr('id', 'profile_reg');
	
});
</script>
EOF;


$_auth['reg_done'] = <<<EOF
�� ������� ������������������ � ����� �������.
<br>������ ������ ���� ����� � ������ � ����� ����������� � ���������� � ������.
<br><a href="/authorization/auth/">�����������</a>
EOF;






/****** �����: ����� ����� ****************************************************/

?>