<?

/***************************************************************************
*  ������ �������                                                        *
*  ������ ���������� ������                                              *
*  Version: 3.0                                                             *
*  Copyright: ����������� �����������                                                  *
***************************************************************************/

/*
 * �������� ���� ������ (������ ���� ������ � ���������� �� ���������)
 *
 * �������� ����� ������
 * $_articles - ��������� ��� ������ ����� ������
 * $_articles_delimiter - ����������� ����� ��������
 *
 * ���������� ����������
 * {DOCUMENTDATE(d F Y)} - ���� � ����� �������, �������������� ���������� � PHP �������� date()
 * {ALIAS} - ������ �� ������
 * {SBODY} - ����� ������
 */

$date_format = "d-m-Y";
$_date_format_cur['main'] = "d F Y H:i";
$_date_format_cur['last'] = "d F Y H:i";

$_articles['main']['begin'] = <<<EOF
	<h2>������</h2>
	<div id="articles">
EOF;

		//<!--<td>{ARTICLES_IMAGE}</td>-->
$_articles['main']['item'] = <<<EOF
		<table>
		<tr>
        <td>{ARTICLES_IMAGE}</td>
		<td valign="top">
		
		<div class="date">{DATE}</div>
		<a href="{ALIAS}">{TITLE}</a>
		<div style="margin-top: 4px;">{SBODY}</div>
		</td>
		</tr>
		</table>			
		
EOF;

$_articles['main']['separator'] = <<<EOF
		<table border=0 cellpadding=0 cellspacing=0><td height="24"></td></table>
EOF;

$_articles['main']['end'] = <<<EOF
</div>
EOF;

/*
 * ���� ��������� ������ (������ ���������� ��������� ������)
 * �������� - ���������� ��������� ����� ������
 * ���������� ���������� - ���������� ��������� ����� ������
 */
$_articles['last']['begin'] = <<<EOF
	<h2>������</h2>
		<div id="lastarticles">
EOF;

$_articles['last']['item'] = <<<EOF
		<div class="date">{DATE}</div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<div class="header"><a href="{ALIAS}">{TITLE}</a></div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<p class="ptext">{SBODY}</p>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
EOF;

$_articles['last']['separator'] = <<<EOF
EOF;

$_articles['last']['end'] = <<<EOF
	</div>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="16"></td></tr></table>
	<div><a href="/articles/">��� ������</a></div>
EOF;

// ���������� ��������, ��������� ��� �������� ������
// ����� �������� ���:
//<img src='{IMG_AV}'  align='left'> 
//<a href='{IMG_BIG}' target='new'><img src='{IMG}'  align='left'></a>
//<img src='{IMG_BIG}'  align='left'>
//$_articles_img = "<a target='_new' href='{IMG_BIG}'><img border='0' style=\"border:1px solid navy;margin:0px 10px 10px 0px;\" src='{IMG}' align='left'></a>";
//<img>  ��� ������� �������� ������
$_articles_img = "<img border='0' style=\"solid navy;margin:0px 10px 10px 0px; width:200px; float:left;\" src='{IMG}' >";
//<img>  ��� ��������� �������� ������
$_articles_image = "<a href={ALIAS}><img style=\"margin: 3px 10px 10px 0px; width:90px; \" src='{IMG_AV}' align='left'></a>"; // ����� �������� � ������ ������

/*
$_articles_cat = "<a href={ALIAS}>{TITLE}</a>";
$_articles_cat_delimeter = "<br>�����������<br>";
*/

# ���� ���������
$_articles_categories_menu['begin']      = "<h1>���������</h1>
<div id=menu2><ul>
";
$_articles_categories_menu['allcats']   = "��� ���������
";
$_articles_categories_menu['active']     = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_articles_categories_menu['inactive']   = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_articles_categories_menu['delimiter']  = "
";
$_articles_categories_menu['end']        = "</ul></div>
";

# ���� �� �����
$_articles_years_menu['begin']      = "<h1>����</h1>
<div id=menu2><ul>
";
$_articles_years_menu['allyears']   = "��� ����";
$_articles_years_menu['active']     = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_articles_years_menu['inactive']   = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_articles_years_menu['delimiter']  = "";
$_articles_years_menu['end']        = "</ul></div>";

# ��������� �� �������� ���������� ������
$_articles_categories_current['title']      = "<b><a href='{ALIAS}'>{TITLE}</a></b>";
$_articles_categories_current['delimiter']  = "|";

?>