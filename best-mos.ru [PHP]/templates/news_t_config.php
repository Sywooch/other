<?

/***************************************************************************
*  ������ ��������                                                        *
*  ������ ���������� ��������                                              *
*  Version: 3.0                                                            *
*  Copyright: ����������� �����������                                                  *
***************************************************************************/

/*
 * �������� ���� �������� (������ ���� �������� � ���������� �� ���������)
 *
 * �������� ����� ��������
 * $_news - ��������� ��� ������ ����� �������
 * $_news_delimiter - ����������� ����� ���������
 *
 * ���������� ����������
 * {DOCUMENTDATE(d F Y)} - ���� � ����� �������, �������������� ���������� � PHP �������� date()
 * {ALIAS} - ������ �� �������
 * {SBODY} - ����� �������
 */

$date_format = "d-m-Y";
$_date_format_cur['main'] = "d F Y H:i";
$_date_format_cur['last'] = "d F Y H:i";

$_news['main']['begin'] = <<<EOF
	<h2>�������</h2>
	<div id="news">
EOF;

$_news['main']['item'] = <<<EOF
		<div class="date">{DATE}</div>
		<a href="{ALIAS}">{TITLE}</a>
		<div style="margin-top: 4px;">{SBODY}</div>
EOF;

$_news['main']['separator'] = <<<EOF
		<table border=0 cellpadding=0 cellspacing=0><td height="24"></td></table>
EOF;

$_news['main']['end'] = <<<EOF
</div>
EOF;

/*
 * ���� ��������� �������� (������ ���������� ��������� ��������)
 * �������� - ���������� ��������� ����� ��������
 * ���������� ���������� - ���������� ��������� ����� ��������
 */
$_news['last']['begin'] = <<<EOF
	<h2 style="color:#FF8A00;">�������</h2>
		<div id="lastnews">
EOF;

$_news['last']['item'] = <<<EOF
		<div class="date">{DATE}</div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<div class="header"><a href="{ALIAS}">{TITLE}</a></div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<p class="ptext">{SBODY}</p>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
EOF;

$_news['last']['separator'] = <<<EOF
EOF;

$_news['last']['end'] = <<<EOF
	</div>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="16"></td></tr></table>
	<div><a href="/news/">��� �������</a></div>
EOF;

// ���������� ��������, ��������� ��� �������� �������
// ����� �������� ���:
// <img src='{IMG_AV}'  align='left'> {IMG_AV_WIDTH},{IMG_AV_HEIGHT},{FILE_AV_SIZE}<hr>
// <a href='{IMG_BIG}' target='new'><img src='{IMG}'  align='left'></a> {IMG_WIDTH},{IMG_HEIGHT},{FILE_SIZE}<hr>
// <img src='{IMG_BIG}'  align='left'> {IMG_BIG_WIDTH},{IMG_BIG_HEIGHT},{FILE_BIG_SIZE}
$_news_img = "<a target='_new' href='{IMG_BIG}'><img border='0' style=\"border:1px solid navy;margin:0px 10px 10px 0px;\" src='{IMG}' align='left'></a>";
$_news_image = "<img style=\"margin: 3px 10px 10px 0px;\" src='{IMG_AV}' align='left'>"; // ����� �������� � ������ ��������

/*
$_news_cat = "<a href={ALIAS}>{TITLE}</a>";
$_news_cat_delimeter = "<br>�����������<br>";
*/

# ���� ���������
$_news_categories_menu['begin']      = "<h1>���������</h1>
<div id=menu2><ul>
";
$_news_categories_menu['allcats']   = "��� ���������
";
$_news_categories_menu['active']     = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_news_categories_menu['inactive']   = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_news_categories_menu['delimiter']  = "
";
$_news_categories_menu['end']        = "</ul></div>
";

# ���� �� �����
$_news_years_menu['begin']      = "<h1>����</h1>
<div id=menu2><ul>
";
$_news_years_menu['allyears']   = "��� ����";
$_news_years_menu['active']     = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_news_years_menu['inactive']   = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_news_years_menu['delimiter']  = "";
$_news_years_menu['end']        = "</ul></div>";

# ��������� �� �������� ���������� �������
$_news_categories_current['title']      = "<b><a href='{ALIAS}'>{TITLE}</a></b>";
$_news_categories_current['delimiter']  = "|";

?>