<?
#
#  ������ docs
#


# ����������� ����� � ����� ����� ������
$free_form['form_fields'] = <<<EOF
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_naznach"><b>����� �������� �������</b></span> </td>
		<td width="5">&nbsp;</td>
		<td>			
			<select id="naznach" name="naznach" style="width:300px;">
				
			<option value=""></option>
				{catalog_list}
			</select>
		</td>
</tr>
<tr>
		<td colspan=3><br><i>��� ���� ����������� ��� ����������</i><br><input type="button" value="���������" onClick="onFormOrderSubmit()"></td>
</tr>
</table>
EOF;



$free_form['send_done'] = <<<EOF
��� �������� ������ ���������� ����� ����������.<br>
�� ����������� �������� ��� ���������� �������.
EOF;




# ������ ������� � ��� ���������������� ������� � ����� � ������
$_free_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>������������.</b>
<br><br>
������������ ������� ���������� �������: <b>{catalog_title}</b>
<br><br><br>
���������� ������ ������������:<br>
<b>�������:</b> {f}<br>
<b>���:</b> {i}<br>
<b>��������:</b> {o}<br>
<b>����� ��������:</b> {adress}
<br><br>
--<br>
C ���������, best-mos.ru
<br>
<br>



</body>
</html>
EOF;


?>
