<?

/***************************************************************************
*  ���� ������� � ������� �����                                            *
*  ������ ��������                                                         *
*  Version: 3.0                                                            *
***************************************************************************/

/***************************************************************************
*  ��������� �����. ������������� ����. �� ������!                        */
$_menu = array();
/* ���, ��� ����������� ����, ����� �������� �������-����������.           *
***************************************************************************/

/*������� ����*/

$_menu['static']['begin']      = '
		<table width="100%" border="0" cellpadding="0" cellspacing="0" id="menu">
		<tr valign="middle">';
$_menu['static']['active']     = '
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<td width="1%" height="32" style="background: url(/i/topmenu_left_a.gif) no-repeat left bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			<td width="98%" align="center" style="background: url(/i/topmenu_a.gif) repeat-x left bottom;">
			<table width="80" border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<span>{TITLE}</span>
			</td>
			<td width="1%" style="background: url(/i/topmenu_right_a.gif) no-repeat right bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			</td>
			</table>
		</td>';
$_menu['static']['inactive']   = '
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<td width="1%" height="32" style="background: url(/i/topmenu_left.gif) no-repeat left bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			<td width="98%" align="center" style="background: url(/i/topmenu_p.gif) repeat-x left bottom;">
			<table width="80" border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<a href="{ALIAS}">{TITLE}</a>
			</td>
			<td width="1%" style="background: url(/i/topmenu_right.gif) no-repeat right bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			</td>
			</table>
		</td>';
$_menu['static']['now']        = '
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<td width="1%" height="32" style="background: url(/i/topmenu_left_a.gif) no-repeat left bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			<td width="98%" align="center" style="background: url(/i/topmenu_a.gif) repeat-x left bottom;">
			<table width="80" border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<span>{TITLE}</span>
			</td>
			<td width="1%" style="background: url(/i/topmenu_right_a.gif) no-repeat right bottom;"><table width="8" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			</td>
			</table>
		</td>';
$_menu['static']['delimiter']  = '
		<td width="1%" height="32" style="background: url(/i/topmenu_d.gif) repeat-x left bottom;"><table width="2" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>';
$_menu['static']['end']        = '
		</tr>
		</table>';

/*������ ����*/

$_menu['bottom']['begin']      = '
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="background: url(/i/corner_5.gif) repeat-x left top;">
	<tr valign="top">
	<td height="35">
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
<div id="bottommenu" align="center">';
$_menu['bottom']['active']     = '
<span>{TITLE}</span>';
$_menu['bottom']['inactive']   = '
<a href="{ALIAS}">{TITLE}</a>';
$_menu['bottom']['now']        = '
<a href="{ALIAS}">{TITLE}</a>';
$_menu['bottom']['delimiter']  = '
<span>&nbsp;|&nbsp;</span>';
$_menu['bottom']['end']        = '
</div>
	</td>
	</tr>
	</table>';

/*���� ��������*/

$_menu['catalog']['begin']      = "<h3>���� ��������</h3>";
$_menu['catalog']['active']     = "{TITLE}";
$_menu['catalog']['inactive']   = "<a href={ALIAS}>{TITLE}</a>";
$_menu['catalog']['now']        = "<a href={ALIAS}>{TITLE}</a>";
$_menu['catalog']['delimiter']  = "<br>";
$_menu['catalog']['end']        = '';

/*
 * ������ ����������� �������� ���������, ���������� �� ���� static
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_child_menu['static']['begin']      = "<h3>���� �����������</h3>";
$_child_menu['static']['active']     = "{TITLE}";
$_child_menu['static']['inactive']   = "<a href={ALIAS}>{TITLE}</a>";
$_child_menu['static']['now']        = "<a href={ALIAS}>{TITLE}</a>";
$_child_menu['static']['delimiter']  = "<br>";
$_child_menu['static']['end']        = '';

/*
 * ������ �������� �������� �������� ���������, ���������� �� ���� static
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_adjacent_menu['static']['begin']      = "<h3>���� �����������</h3>";
$_adjacent_menu['static']['active']     = "{TITLE}";
$_adjacent_menu['static']['inactive']   = "<a href={ALIAS}>{TITLE}</a>";
$_adjacent_menu['static']['now']        = "<a href={ALIAS}>{TITLE}</a>";
$_adjacent_menu['static']['delimiter']  = "<br>";
$_adjacent_menu['static']['end']        = '';

/*
 * ������!
 * ���� � ��������� menu2
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_menu['menu2']['begin']                 = "<table border=0 cellspacing=0 cellpadding=0 width=100% align=center><tr valign=top><td width=50%><ul>";
$_menu['menu2']['active']                = "<li>{TITLE}</li>";
$_menu['menu2']['inactive']              = "<li><a href={ALIAS}>{TITLE}</a></li>";
$_menu['menu2']['now']                   = "<li><a href={ALIAS}>{TITLE}</a></li>";
$_menu['menu2']['delimiter']             = '';
$_menu['menu2']['megadelimiter']['50%']  = "</ul></td><td width=50%><ul>";
$_menu['menu2']['end']                   = "</td></tr></table></ul>";

/*
 * ������!
 * ������ ����������� �������� ���������, ���������� �� ���� static (������ � ������������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_child_menu_with_childs['static']['begin']      = "<ul>";
$_child_menu_with_childs['static']['active']     = '';
$_child_menu_with_childs['static']['inactive']   = "<li><a href={ALIAS}>{TITLE}</a></li>";
$_child_menu_with_childs['static']['now']        = '';
$_child_menu_with_childs['static']['delimiter']  = '';
$_child_menu_with_childs['static']['end']        = "</ul>";

/*
 * ������!
 * ������ ����������� �������� ���������, ���������� �� ���� static (��� �����������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_child_menu_without_childs['static']['begin']      = "<ul>";
$_child_menu_without_childs['static']['active']     = '';
$_child_menu_without_childs['static']['inactive']   = "<li><a href={ALIAS}>{TITLE}</a></li>";
$_child_menu_without_childs['static']['now']        = '';
$_child_menu_without_childs['static']['delimiter']  = '';
$_child_menu_without_childs['static']['end']        = "</ul>";

/*���������*/

$_pagenaviagation['startnavi']      = '';
$_pagenaviagation['pages_all']      = '';
$_pagenaviagation['page_start']     = '';
$_pagenaviagation['page_previous']  = '';
$_pagenaviagation['page_current']   = '
<div class="numbercur"><span>{PAGE}</span></div>';
$_pagenaviagation['page_link']      = '
<div class="number"><a href="{BASE_URL}{END}{NUM}">{PAGE}</a></div>';
$_pagenaviagation['page_next']      = '';
$_pagenaviagation['page_end']       = '';

?>