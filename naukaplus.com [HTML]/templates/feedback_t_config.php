<?php
#
#        ������������� ��������� ���������� ��� ������ ����������� �������
#




#-----------------------
// ��������� ��� ������
#-----------------------



$skin['name'] = <<<EOF
�� �� ��������� ���� "���"
EOF;

$skin['email'] = <<<EOF
�� �� ��������� ���� "E-mail"
EOF;

$skin['email_error'] = <<<EOF
�������� email �����������
EOF;

$skin['post'] = <<<EOF
�� �� ��������� ���� "���������"
EOF;

$skin['adress'] = <<<EOF
�� �� ��������� ���� "�����"
EOF;

$skin['phone'] = <<<EOF
�� �� ��������� ���� "�������"
EOF;

// ����� �������� ��� ������ ������
$skin['error'] = <<<EOF
<span style='color:red;'><li> {ERROR} </span>
EOF;


// ����� �������� ��� ������ ������
$skin['success'] = <<<EOF
��������� ����������.
EOF;



# ����� ����� ��� �������� �����
$skin['body'] = <<<EOF
<div id="content">
	<div style="color:red;margin-bottom:20px;">{error}</div>
	<div style="color:green;margin-bottom:20px;">{success}</div>
	<form method="post" name="F1">
	<table border="0" cellpadding="0" cellspacing="4">
	
	<tr valign="middle">
	<td align="right">���<font color="red">*</font></td>
	<td><input name="comeback_name_need" class="text" value="{name}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	<tr valign="middle">
	<td align="right">��������</td>
	<td><input name="comeback_company" class="text" value="{company}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	<tr valign="middle">
	<td align="right">�������<font color="red">*</font></td>
	<td><input name="comeback_phone_need" class="text" value="{phone}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	
	<!-- tr valign="middle">
	<td align="right">���������<font color="red">*</font></td>
	<td><input name="comeback_post_need" class="text" value="{post}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	<tr valign="middle">
	<td align="right">�����<font color="red">*</font></td>
	<td><input name="comeback_adress_need" class="text" value="{adress}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	
	<tr valign="middle">
	<td align="right">�������<font color="red">*</font></td>
	<td><input name="comeback_phone_need" class="text" value="{phone}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	
	<tr valign="middle">
	<td align="right">����</td>
	<td><input name="comeback_faks" class="text" value="{faks}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr -->
	
	
	<tr valign="middle">
	<td align="right">E-mail<font color="red">*</font></td>
	<td><input name="comeback_email_need" class="text" value="{email}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	
	<tr valign="middle">
	<td align="right">���� ������</td>
	<td><input name="comeback_subject" class="text" value="{subject}" style="width: 360px; padding-left: 2px;" size="3" type="text"></td>
	</tr>
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>

	<tr valign="middle">
	<td align="right" valign="top">����� ���������</td>
	<td><textarea name="comeback_text" style="padding-left: 2px; width: 360px; height: 120px; vertical-align: top;" size=30>{text}</textarea>
	</td>
	</tr>
	
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>
	
	<tr valign="middle">
	<td align="right">&nbsp;</td>
	<td><input class="reg" value="���������" type="submit"></td>
	</tr>
	
	<tr><td><table border=0 cellpadding=0 cellspacing=0><td height="8"></td></table></td></tr>

	</table>
	</form>
</div>
EOF;


?>