<?php
#
# �������
# ��� ������� ������ ��������� � ����� �������
#

# ��������� �������������
$skin = array();



# ������ ����
$skin['timestamp'] = <<<EOF
d.m.Y
EOF;

# ���� ����� �� ������ ��������� ����������� ������� ������ 
$skin['last'] = <<<EOF
						<tr><td></td><td>
							<p class="date">{timestamp}</p>
							<p>{title}</p>
							<p class="link"><a href="{alias}">�����</a></p>
						</td><td></td></tr>
						<tr><td></td><td id="news-dot"></td><td></td></tr>

EOF;


# ���� ����� �� ������ ������/��������� ������� ������ 
$skin['best'] = <<<EOF
<p>{timestamp} <a href="{alias}">{title}</a></p>

EOF;



# ���� � ������
$skin['menu_withchilds']['begin']			= <<<EOF
<ul>
EOF;
$skin['menu_withchilds']['item']			= <<<EOF
<li><h2><a href="{alias}">{title}</a></h2>TEST</li>
EOF;
$skin['menu_withchilds']['delimiter']		= <<<EOF

EOF;
$skin['menu_withchilds']['end']				= <<<EOF
</ul>
EOF;

# ���� ��� �����
$skin['menu_withoutchilds']['begin']			= <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">

EOF;
$skin['menu_withoutchilds']['item']			= <<<EOF
						<tr valign="top">
						<td>
							<table align="left" border="0" cellpadding="0" cellspacing="0">
								<tr valign="top">
									<td><img src="{img_th}"></td>
									<td id="news-shadow-right"><img alt="" src="/style/news-shadow-top-right.gif" width="6" height="6"></td>
								</tr>
								<tr>
									<td id="news-shadow-bottom"><img alt="" src="/style/news-shadow-bottom-left.gif" width="6" height="6"></td>
									<td><img alt="" src="/style/news-shadow-bottom-right.gif" width="6" height="6"></td>
								</tr>
							</table>
			 				<table border="0" cellpadding="0" cellspacing="0">
								<tr valign="top">
									<td><p class="date">{timestamp}</p></td>
									<td><table border="0" cellpadding="0" cellspacing="0" width="36"><tr><td></td></tr></table></td>
									<td width="100%"><p><a href="{alias}">{title}</a></p></td>
								</tr>
								<tr>
									<td colspan="3"><table border="0" cellpadding="0" cellspacing="0" height="10"><tr><td></td></tr></table></td>
								</tr>
							</table>
							<p>{sbody}</p>
							<p class="link"><a href="{alias}">�����</a></p>
						</td></tr>
						<tr><td colspan="2" id="nnews-dot"></td></tr>

EOF;
$skin['menu_withoutchilds']['delimiter']		= <<<EOF
						<tr><td colspan="2"><table border="0" cellpadding="0" cellspacing="0" height="36"><tr><td></td></tr></table></td></tr>

EOF;
$skin['menu_withoutchilds']['end']				= <<<EOF
					</table>

EOF;




#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
# ���������� �������
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------

$skin['photomultiupload_form'] = <<<EOF
<!-- �������� ���������� � �������� �� ������ ����  -->
EOF;



?>