<?php
#
#  �������
#
#  Modified	:
#  Version	: 1.0
#  Programmer	: Kormishin Vladimir
#


$_search_form = <<<EOF
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="searchform">
		<form name="searchform" method="post" action="/search/">
		<tr valign="top"><td class="fieldname">����� �� ��������</td></tr>
		<tr valign="middle">
		<td width="99%"><input class="searchformfield" type="text" id="search_word" name="search_word" value="�����" OnFocus="if ($('#search_word').val()=='�����') $('#search_word').val('');" OnBlur="if ($('#search_word').val()=='') $('#search_word').val('�����');" maxlength=150 border="0"></td>
		<td width="1%"  style="padding: 0px 0px 0px 8px;" valign="bottom"><input type="image" src="/i/b_search.gif" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;"></td>
		</tr>
		<tr><td height="12"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td></tr>
		</form>
</table>
EOF;


// ����� ����������� ������
$_search_result_value = '
<li value="{NUM}"><a href="{ALIAS}">{TITLE}</a><div style="margin-bottom: 3px;">{BODY}</div></li>
<br>';

$_search_result = <<<EOF
<p>����� ������� ����������� �� ������� �<b>{SEARCHWORD}</b>�: {COUNTRESULT}</p>
<ol>
{RESULT}
</ol>
<!-- ��������� ������� -->
		<div align="right">
		<table border="0" cellpadding="0" cellspacing="0"><tr><td style="padding-right: 16px;">
		<div id="numeration">
		{NAVIGATION}	
		</div>
		</td></tr></table>
		</div>
	<!-- ��������� ������� -->
<br>

EOF;

$_search_noresult = <<<EOF
<p>����� �� ������� �<b>{SEARCHWORD}</b>�</p>
<p style="color:red;">������� ���������� ���� ����� �� �����������.</p>
EOF;

?>