<?

/***************************************************************************
*  ���� ������� � ������� �����                                            *
*  ������ ����������                                                       *
*  Version: 3.0                                                            *
*  Copyright: �Web Otdel�                                                  *
***************************************************************************/

/***************************************************************************
*  ��������� �����. ������������� ����. �� ������!                        */
$_menu = array();
/* ���, ��� ����������� ����, ����� �������� �������-����������.           *
***************************************************************************/


/*
 * �������� ������������ ���� � ��������� static
 *
 * �������� ����
 * begin - ������ �����
 * active - ������� ����� ���� (������)
 * inactive - ������� ����� ���� (����� ���������� ��������� �� ���� ��������)
 * now - ������������ ����� ���� �������� ���������
 * delimiter - ����������� ����� �������� ����
 * megadelimiter - ���������� �����������, ����� HTML-���
 * end - ����� �����
 *
 * ���������� ����������
 * {TITLE} - �������� ��������� (������ ����)
 * {ALIAS} - ������ �� ��������
 * {SBODY} - ����� ���������
 * {AUTHOR} - ����� ���������
 * {DOCUMENTDATE(d F Y)} - ���� � ����� �������, �������������� ���������� � PHP �������� date()
 * {COUNTCHILDS} - ���������� ����������� ���������
 */
$_menu['static']['begin']      = <<<EOF
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="menu-bg">
			<tr id="tr_3">

EOF;
$_menu['static']['active']     = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td id="menu-bg-over">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><span>{TITLE}</span></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['inactive']   = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td onMouseOver="this.id='menu-bg-over';" onMouseOut="this.id='';" onclick="document.location='{ALIAS}';">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><a href="{ALIAS}">{TITLE}</a></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['now']        = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td id="menu-bg-over" onclick="document.location='{ALIAS}';">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><a href="{ALIAS}">{TITLE}</a></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['delimiter']  = <<<EOF

EOF;
$_menu['static']['end']        = <<<EOF
			</tr>
		</table>

EOF;

/*
 * ������ ����������� �������� ���������, ���������� �� ���� static
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_child_menu['static']['begin']      = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="td_4"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
							<td class="title"><h1></h1></td>
						</tr>
						<tr>
							<td><table border="0" cellpadding="0" cellspacing="0" height="10"><tr><td></td></tr></table></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>
<ul id="navigation">

EOF;
$_child_menu['static']['active']     = <<<EOF
<li class="li">{TITLE}</li>

EOF;
$_child_menu['static']['inactive']   = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_child_menu['static']['now']        = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_child_menu['static']['delimiter']  = <<<EOF

EOF;
$_child_menu['static']['end']        = <<<EOF
		</ul>
							</td>
						</tr>
					</table>

EOF;

/*
 * ������ �������� �������� �������� ���������, ���������� �� ���� static
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_adjacent_menu['static']['begin']      = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="td_4"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
							<td class="title"><h1></h1></td>
						</tr>
						<tr>
							<td><table border="0" cellpadding="0" cellspacing="0" height="10"><tr><td></td></tr></table></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>
<ul id="navigation">

EOF;
$_adjacent_menu['static']['active']     = <<<EOF
<li class="li">{TITLE}</li>

EOF;
$_adjacent_menu['static']['inactive']   = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_adjacent_menu['static']['now']        = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_adjacent_menu['static']['delimiter']  = <<<EOF

EOF;
$_adjacent_menu['static']['end']        = <<<EOF
		</ul>
							</td>
						</tr>
					</table>

EOF;


/*
 * ������!
 * ���� � ��������� menu2
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_menu['menu2']['begin']                 = <<<EOF
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center><tr valign=top><td width=50%><ul>
EOF;
$_menu['menu2']['active']                = <<<EOF
<li>{TITLE}</li>
EOF;
$_menu['menu2']['inactive']              = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menu['menu2']['now']                   = <<<EOF
<li><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menu['menu2']['delimiter']             = <<<EOF

EOF;
$_menu['menu2']['megadelimiter']['50%']  = <<<EOF
</ul></td><td width=50%><ul>
EOF;
$_menu['menu2']['end']                   = <<<EOF
</td></tr></table></ul>
EOF;


/*
 * ������!
 * ������ ����������� �������� ���������, ���������� �� ���� static (������ � ������������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_child_menu_with_childs['static']['begin']      = <<<EOF
<ul>
EOF;
$_child_menu_with_childs['static']['active']     = <<<EOF

EOF;
$_child_menu_with_childs['static']['inactive']   = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_child_menu_with_childs['static']['now']        = <<<EOF

EOF;
$_child_menu_with_childs['static']['delimiter']  = <<<EOF

EOF;
$_child_menu_with_childs['static']['end']        = <<<EOF
</ul>
EOF;

/*
 * ������!
 * ������ ����������� �������� ���������, ���������� �� ���� static (��� �����������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_child_menu_without_childs['static']['begin']      = <<<EOF
<ul>
EOF;
$_child_menu_without_childs['static']['active']     = <<<EOF

EOF;
$_child_menu_without_childs['static']['inactive']   = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_child_menu_without_childs['static']['now']        = <<<EOF

EOF;
$_child_menu_without_childs['static']['delimiter']  = <<<EOF

EOF;
$_child_menu_without_childs['static']['end']        = <<<EOF
</ul>
EOF;


/*
 * ������!
 * �������� ���� static � ���� ��������������� ������ ����������
 * �������� - ���������� ��������� ���� (megadelimiter ������ ��� 1-�� ������)
 * ���������� ���������� - ���������� ��������� ����
 * ��� ������� ������ �������� ���� ����� ����������� ��������
 * ���������� ������ ������� ��������� �������
 * ������� depth - ������� ��������� ���� (��� �������� 0 ���� ����� ������������ �� ���������� ������)
 *
 * ������� 1
 */
$_menutree['static']['begin']['1']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['1']           = <<<EOF
<li type=circle>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['1']         = <<<EOF
<li type=circle><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['1']              = <<<EOF
<li type=circle><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['delimiter']['1']        = <<<EOF

EOF;
$_menutree['static']['end']['1']              = <<<EOF
</ul>
EOF;
$_menutree['static']['megadelimiter']['50%']  = <<<EOF

EOF;
$_menutree['static']['depth']                 = 0;
/*
 * ������� 2
 */
$_menutree['static']['begin']['2']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['2']           = <<<EOF
<li type=disc>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['2']         = <<<EOF
<li type=disc><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['2']              = <<<EOF

EOF;
$_menutree['static']['delimiter']['2']        = <<<EOF

EOF;
$_menutree['static']['end']['2']              = <<<EOF
</ul>
EOF;
/*
 * ������� 3
 */
$_menutree['static']['begin']['3']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['3']           = <<<EOF
<li type=square>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['3']         = <<<EOF
<li type=square><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['3']              = <<<EOF

EOF;
$_menutree['static']['delimiter']['3']        = <<<EOF

EOF;
$_menutree['static']['end']['3']              = <<<EOF
</ul>
EOF;


/*
 * ������!
 * �������� ���� static � ���� ��� ���������� ������ ����������
 * �������� - ���������� ��������� ���� (megadelimiter ������ ��� 1-�� ������)
 * ���������� ���������� - ���������� ��������� ����
 * ��� ������� ������ �������� ���� ����� ����������� ��������
 * ���������� ������ ������� ��������� �������
 * ������� depth - ������� ��������� ���� (��� �������� 0 ���� ����� ������������ �� ���������� ������)
 *
 * ������� 1
 */
$_menuexpanded['static']['begin'][1]              = <<<EOF
<ul>
EOF;
$_menuexpanded['static']['active'][1]             = <<<EOF
<li type=circle>{TITLE}</li>
EOF;
$_menuexpanded['static']['inactive'][1]           = <<<EOF
<li type=circle><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['now'][1]                = <<<EOF
<li type=circle><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['delimiter'][1]          = <<<EOF

EOF;
$_menuexpanded['static']['end'][1]                = <<<EOF
</ul>
EOF;
$_menuexpanded['static']['megadelimiter']['50%']  = <<<EOF

EOF;
$_menuexpanded['static']['depth']                 = 0;
/*
 * ������� 2
 */
$_menuexpanded['static']['begin'][2]              = <<<EOF
<ul>
EOF;
$_menuexpanded['static']['active'][2]             = <<<EOF
<li type=disc>{TITLE}</li>
EOF;
$_menuexpanded['static']['inactive'][2]           = <<<EOF
<li type=disc><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['now'][2]                = <<<EOF

EOF;
$_menuexpanded['static']['delimiter'][2]          = <<<EOF

EOF;
$_menuexpanded['static']['end'][2]                = <<<EOF
</ul>
EOF;


/*
 * ���������
 *
 * �������� ��������� (��������� � ���������, ������ �������� �������)
 * startnavi - ������� �������� � ��������� �������� �� javascript
 * pages_all - ����� ���������� �������
 * page_start - ������ ��������
 * page_previous - ���������� ��������
 * page_current - ������� ��������
 * page_link - ������� �������� (������)
 * page_next - ��������� ��������
 * page_end - ��������� ��������
 *
 * ���������� ���������� (������� � ������������ ��������� ��������� �� ������ ��������)
 * {UB}, {TP}, {PP}, {TYPE} - ���������� �������� � ��������� �������� �� javascript
 * {PAGES} - �����, ������������ ����� ���������� �������
 * {BASE_URL}{END} � {BASE_URL}{END}{NUM} - ������ �� ��������
 * {PAGE} - ����� ��������
 */
$_pagenaviagation['startnavi']      = "";
$_pagenaviagation['pages_all']      = "";
$_pagenaviagation['page_start']     = '';
$_pagenaviagation['page_previous']  = '
<span class="sort_lnk"><a class="sortarr" href={BASE_URL}{END}{NUM}>&lt;</a></span>';
$_pagenaviagation['page_current']   = '
<span class="sort_cur">{PAGE}</span>';
$_pagenaviagation['page_link']      = '
<span class="sort_lnk"><a class="sort" href={BASE_URL}{END}{NUM}>{PAGE}</a>';
$_pagenaviagation['page_next']      = '
<span class="sort_lnk"><a class="sortarr" href={BASE_URL}{END}{NUM}>&gt;</a></span>';
$_pagenaviagation['page_end']       = '';

?>