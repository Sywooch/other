<?php
#
# ������� ������
#


//-------------------------------------
// ���������������� �����
//-------------------------------------

$_subscribe_form = <<<EOF
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="scribeform">
		<form method="post">
		<tr valign="top"><td class="fieldname">�������� �� �������<br><b>{RESULT}</b></td></tr>
		<tr valign="middle">
		<td width="99%"><input class="scribeformfield" type="text" id="subscribe" name="subscribe" value="��� e-mail" OnFocus="if ($('#subscribe').val()=='��� e-mail') $('#subscribe').val('');" OnBlur="if ($('#subscribe').val()=='') $('#subscribe').val('��� e-mail');" maxlength=150 border="0"></td>
		<td width="1%"  style="padding: 0px 0px 0px 8px;" valign="bottom"><input type="image"  src="/i/b_scribe.gif" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
		
		</td>
		</tr>
		<tr><td height="12"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td></tr>
		</form>
		</table>
EOF;





//-------------------------------------
// ����������������� �����
//-------------------------------------

// ���� ������ ��������
$_subscribe_subject = "�������� �������� ����� fssmo.ru";


// ������ ������� ��� ������ �������
$_subscribe_news = <<<EOF
<table border="0"><tr>
<td>{DOCUMENTDATE}</td><td>{TITLE}</td>
</tr><tr>
<td></td><td>{SBODY}</td>
</tr><tr>
<td></td><td><a href="{ALIAS}">{ALIAS}</a></td>
</tr></table>
<br />
<br />
EOF;



// ������ ������
$_subscribe_mail = <<<EOF
<h2>������� ����� {HOST}</h2><br>
{MAIL}


��� �������� ������ email �� ������ �������� ��������� �� <a href="{DEL_ALIAS}">���� ������</a>.
<br><br>
--<br>
� ���������, {COMPANY}!
EOF;

$_subscribe_mail_info = <<<EOF
<html>
<body>
������������!<br><br>
��� ������������� ��������, ��������� �� <a href="{ALIAS}">������</a>.
<br><br>
--<br>
� ���������, {COMPANY}

</body>
</html>
EOF;

?>