<?php
#
# �������
# ��� ������� ������ ��������� � ����� �������
#

# ��������� �������������
$skin = array();



# ����� ������
$skin['form'] = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<form name="searchform" method="post" action="/search/">
						<tr valign="top">
							<td id="search-bg"><input id="search-input" type="text" name="word" value="{word}" maxlength="255" value="�����..." onfocus="if (this.value=='�����...') this.value='';" onblur="if (this.value==''){this.value='�����...'}"></td>
							<td>&nbsp;</td>
							<td align="right"><input style="border:0;background:transparent;" src="/style/search-btn.gif" type="image" width="48" height="25"></td>
						</tr>
						</form>
						<tr>
							<td colspan="3"><img alt="" src="/style/search-mirror.gif" width="210" height="23"></td>
						</tr>
					</table>
EOF;


# ���� ����������� ������
$skin['result'] = <<<EOF
<p>����� ������� ����������� �� ������� �<b>{word}</b>�: {count}</p>
<ol id="search">
{result}
</ol>
<table align="center" border="0" cellpadding="0" cellspacing="0"><tr><td nowrap id="sort">{arrows}</td></tr></table>

EOF;

# ���� ����� ����������� ������
$skin['item'] = <<<EOF
<li value="{num}"><a href="{alias}"><b>{title}</b></a><br>
<span>{body}</span>
<a href="{alias}">http://{host}{alias}</a><br><br></li>

EOF;



# ����������� ������ ���
$skin['noresult'] = <<<EOF
<p>����� �� ������� �<b style="color:red;">{word}</b>�</p>
<p style="color:red;">������� ���������� ���� ����� �� �����������.</p>
EOF;



?>