<?php
#
# �������
# ��� ������� ������ ��������� � ����� �������
#

# ��������� �������������
$skin = array();



// ���������� ���������� �������
$skin['login_form']        = <<<EOF
<form method="post">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr>
	<td colspan=2>
		<font color=#EE0000>{error}</font>
		<table border=0 cellspacing=0 cellpadding=0 height=5><td></td></table>
	</td>
</tr>
<tr>
	<td>
		<input type=text name='login' class=reg style="width: 100" onfocus="this.value=''" value="�����" size=14 maxlength=20>
	</td>
	<td>		
	</td>
</tr>
<tr>
	<td>
		<input type='password' onfocus="this.value=''" name='password' class=reg style="width: 100" value="������" size=14 maxlength=20>
	</td>
	<td><input type=submit class=reg style="background-color: #FDF0DE" value="Ok"></td>
</tr>
<tr>
	<td colspan=2>
		<a href='/users/reg/'>�����������</a>
		<br>
		<a href='/users/restore/'>����� ������?</a>
	</td>
</tr>
</table>
</form>
EOF;




# ���� � ����������� �� �������������� �����������
$skin['user_block']        = <<<EOF
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr>
	<td>
		<span class="reg_title">������������, <b>{user_fname} ({user_name})</b></span>
	</td>
</tr>

<tr>
	<td>
		<a href="/users/edit/"><font class="reg_title">�������</font></a>
		<br>
		<a href="/users/logout/">�����</a>		
	</td>
</tr>
</table>
EOF;


$skin['restore_form']        = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/dorestore/">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">
<tr valign=top>	
	<td>������� ��� E-mail:</td>
	<td><input type=text name='user_email' class=text value="" style="width:135" size=3></td>
	<td><input type=submit value="�������"></td>
</tr>
</table>
</form>
EOF;


# ������ ������ ������������
$skin['restore_success'] = <<<EOF
������ ������� ������ �� �����, ��������� ���� ��� �����������.<br>
�� ������ ������� �� <a href="/">������� ��������</a> �����.
EOF;


$skin['reg_form'] = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/doreg/">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">

<tr>
<th>�����:</th>
<td><input name="user_name" value="{user_name}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>������:</th>
<td><input name="user_pass" class="text" value="{user_pass}" type="password" title="����������� ���������"></td>
</tr>

<tr>
<th>������ ������:</td>
<td><input name="user_pass2" class="text" value="{user_pass2}" type="password" title="����������� ���������"></td>
</tr>

<tr>
<th>E-mail:</td>
<td><input name="user_email" class="text" value="{user_email}" type="text" title="����������� ���������"></td>
</tr>

{extend}

<tr>
<th></th>
<td><img border="0" src="/users/captcha/"></td>
</tr>

<tr>
<th></th>
<td>������� ���, ������� �� ������ ����:<br><input name="captcha" class="text" value="" type="text"></td>
</tr>

<tr>
<td colspan="2" align="center"><input class="button" value="���������" type="submit"></td>
</tr>

</table>
</form>

EOF;



// ����������� ���� ��� �����������
$skin['reg_form_extend']        = <<<EOF
<tr>
<th>�������:</td>
<td><input name="user_lname" value="{user_lname}" type="text"></td>
</tr>

<tr>
<th>���:</td>
<td><input name="user_fname" value="{user_fname}" type="text"></td>
</tr>

<tr>
<th>���������:</td>
<td><input name="user_role" class="text" value="{user_role}" type="text"></td>
</tr>

<tr>
<th>���:</td>
<td><input name="user_inn" class="text" value="{user_inn}" type="text"></td>
</tr>

<tr>
<th>���������� �������:</td>
<td><input name="user_phone" class="text" value="{user_phone}" type="text"></td>
</tr>

<tr>
<th>����������� �����:</td>
<td><input name="user_factadr" class="text" value="{user_factadr}" type="text"></td>
</tr>

<tr>
<th>����������� �������:</td>
<td><input name="user_uradr" class="text" value="{user_uradr}" type="text"></td>
</tr>

EOF;


// ���������, ����� �� ����� ����������� ��� ����������
# �������� ������� � reg_form_extend_necessary ������ ���� ����� �� ��� � ���� � reg_form_extend
# ������ ��� ��� �������� ������� ������������ �� ���������� �����
$skin['reg_form_extend_necessary'] = array();
$skin['reg_form_extend_necessary']['user_lname'] = '�� ��������� ���� "�������"<br>';
$skin['reg_form_extend_necessary']['user_fname'] = '�� ��������� ���� "���"<br>';
$skin['reg_form_extend_necessary']['user_role'] = '�� ��������� ���� "���������"<br>';
$skin['reg_form_extend_necessary']['user_inn'] = '�� ��������� ���� "���"<br>';
$skin['reg_form_extend_necessary']['user_phone'] = '�� ��������� ���� "���������� �������"<br>';
$skin['reg_form_extend_necessary']['user_factadr'] = '�� ��������� ���� "����������� �����"<br>';
$skin['reg_form_extend_necessary']['user_uradr'] = '�� ��������� ���� "����������� �������"<br>';






# �������� �����������
$skin['reg_success'] = <<<EOF
�� ������� ������������������ � ����� �������.<br>
��������� � ������ ��������� ������� ���������� ��� �� ����������� �����.<br>
�� ������ ������� �� <a href="/">������� ��������</a> �����.
EOF;



$skin['edit_form'] = <<<EOF
<font color="red">{error}</font>
<form method=post action="/users/doedit/">
<input type="hidden" name="user_id" value="{user_id}">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="register">

<tr>
<th>�����:</td>
<td>{user_name}</td>
<td></td>
</tr>

<tr>
<th>������:</td>
<td><input name="user_pass" class="text" value="{user_pass}" type="password"></td>
</tr>

<tr>
<th>������ ������:</td>
<td><input name="user_pass2" class="text" value="{user_pass}" type="password"></td>
</tr>

<tr>
<th>E-mail:</td>
<td><input name="user_email" class="text" value="{user_email}" type="text"  title="����������� ���������"></td>
</tr>

{extend}

<tr>
<th></th>
<td><input class="button" value="���������" type="submit"></td>
</tr>

</table>
</form>

EOF;

# �������� �����������
$skin['edit_success'] = <<<EOF
������� �����e�.<br><br>
�� ������ ������� �� <a href="/">������� ��������</a> �����.
EOF;



# ������������ ���������� ���� �����������
$skin['approve_success'] = <<<EOF
��� ������� ������� �����������.<br>
�������������� ������ ����� �� ������� ��������.<br><br>
�� ������ ������� �� <a href="/">������� ��������</a> �����.
EOF;


# ��� ������������� ����������� - ������
$skin['approve_error'] = <<<EOF
��� ������� �� ������� ������������.<br>
������ ����� ��������� �� ���������� � ����� ���� ������. ���������� � �������������� �����.<br><br>
�� ������ ������� �� <a href="/">������� ��������</a> �����.
EOF;


?>