<?php
#
#	������������� ��������� ���������� ��� ������ ����������� �������
#
#  Modified	:
#  Version	: 1.0
#  Programmer	: Kormishin Vladimir
#

/******  ���������  ********************************************/
define('CATALOG_TABLE', TABLENAME_PREFIX.'catalog');
define('CATALOG_FOLDER', 'catalog');
define('TABLE_CATALOG_CATEGORIES', TABLENAME_PREFIX.'catalog_categories');
define('TABLE_CATALOG_PROPERTIES', TABLENAME_PREFIX.'catalog_properties');
/***************************************************************/

// �������� - �� ��������
// �������� �����: {IMG_AV},{IMG_AV_WIDTH},{IMG_AV_HEIGHT},{FILE_AV_SIZE}
// �������� �����: {IMG_BIG},{IMG_BIG_WIDTH},{IMG_BIG_HEIGHT},{FILE_BIG_SIZE}
// �������� �����: {IMG},{IMG_WIDTH},{IMG_HEIGHT},{FILE_SIZE}
$_catalog_img = '<img border="0" src="{IMG}" align="left" style="margin: 0px 20px 20px 0px;">';


// ������ ��� ����� ������� ������� �� ������� ��������
$_catalog_hotlist[0]['begin'] = '';
$_catalog_hotlist[0]['item'] = '
	<div align="center" class="preview">
		<div><a href="{ALIAS}"><img src="{IMG_AV}" style="border: 1px solid #999999;" /></a></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="12"></td></tr></table>
		<div class="catheader"><a href="{ALIAS}"><b>{TITLE}</b></a></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
		<div class="arttext"></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
		<div class="price">{PRICE} ���.</div>
	</div>
';
$_catalog_hotlist[0]['separator'] = '';
$_catalog_hotlist[0]['end'] = '';

// ������ ��� ����� ������� ������� �� ��������� ���������
$_catalog_hotlist[1]['begin'] = '
		<h2>����� ������</h2>
		<div id="sleaders">';
$_catalog_hotlist[1]['item'] = '
			<div>
			<table align="center" width="120" border="0" cellpadding="0" cellspacing="0"><tr valign="middle"><td height="160"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center"><a href="{ALIAS}">{TITLE}</a></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" class="inbasketform" align="center">
				<tr valign="bottom">
				<td class="price">{PRICE}</td><td><span>&nbsp;&nbsp;���.&nbsp;&nbsp;</span></td>
				</tr>
			</table>
			</div>';
$_catalog_hotlist[1]['separator'] = '	
			<table width="100%" border="0" cellpadding="0" cellspacing="0" height="32"><tr><td></td></tr></table>';
$_catalog_hotlist[1]['end'] = '
			<table width="100%" border="0" cellpadding="0" cellspacing="0" height="16"><tr><td></td></tr></table>
		</div>';

# ���� ���������
$catalog_categories_menu = '';

# �������� ������
$catalog_properties = '';


/*
 * ������ ����������� �������� ���������, ���������� �� ���� static
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_catalog_child_menu['begin']      = '<tr><td>';
$_catalog_child_menu['active']     = '';
$_catalog_child_menu['inactive']   = '
	<div align="center" class="preview">
<h1>$_catalog_child_menu</h1>
		<div><a href="{ALIAS}"><img src="{img_av}" style="border: 1px solid #999999;" /></a></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="12"></td></tr></table>
		<div class="catheader"><a href="{ALIAS}"><b>{TITLE}</b></a></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
		<div class="arttext"></div>
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
		<div class="price">{PRICE} ���.</div>
	</div>
';
$_catalog_child_menu['now']        = '';
$_catalog_child_menu['delimiter']  = '';
$_catalog_child_menu['end']        = '</td></tr>
	<tr><td>
<br><br>
	</td></tr>';


/*
 * ������ ����������� �������� ���������, ���������� �� ���� static (������ � ������������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */
$_catalog_child_menu_with_childs['begin']      = '<tr><td>';
$_catalog_child_menu_with_childs['active']     = '';
$_catalog_child_menu_with_childs['inactive']   = '
			<div align="center" class="el">
			<table align="center" width="120" border="0" cellpadding="0" cellspacing="0"><tr valign="middle"><td height="160"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td align="center"><a href="{ALIAS}">{TITLE}</a></td></tr></table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			</div>
';
$_catalog_child_menu_with_childs['now']        = '';
$_catalog_child_menu_with_childs['delimiter']  = '';
$_catalog_child_menu_with_childs['end']        = '</td></tr>';

/*
 * ������ ����������� �������� ���������, ���������� �� ���� static (��� �����������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_catalog_child_menu_without_childs['begin']      = '<tr><td>';
$_catalog_child_menu_without_childs['active']     = '';
$_catalog_child_menu_without_childs['inactive']   = '
			<div align="center" class="el">
			<table align="center" width="120" border="0" cellpadding="0" cellspacing="0"><tr valign="middle"><td height="160"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" class="lot">���:{ID}</td>
				</tr>			
				<tr>
					<td align="center"><a href="{ALIAS}">{TITLE}</a></td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" class="inbasketform">
				<form name="inbasket_form" method="post" id="{good_id}" action="/shop/put/">
<input type="hidden" value="{good_id}" name="good_id">
<input type="hidden" value="{PRICE}" name="good_price">
<input type="hidden" value="{TITLE}" name="good_title">
<input type="hidden" value="{CATALOG_ID}" name="good_catalog_id">
				<tr valign="bottom">
				<td class="price">{PRICE}</td><td><span>&nbsp;&nbsp;���.&nbsp;&nbsp;</span></td><td><input class="inbasketformfield"  name="buy_count" type="text" name="inbasketformfield" value="1" maxlength=3 border="0"></td><td><span>&nbsp;&nbsp;��.</span></td>
				<td>
				<div style="position: relative; width: 25px; height: 22px;">
					<div style="position: absolute;">
						<div class="tobasket">						
							<img src="/i/b_inbask.jpg" onmouseover="this.src=\'/i/b_inbask_a.jpg\';" onmouseout="this.src=\'/i/b_inbask.jpg\';" onClick=\'putGoodToBasket("{good_id}");\' style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
						</div>
					</div>
				</div>
				</td>
				</tr>
				</form>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			</div>
';

$_catalog_child_menu_without_childs['now']        = '';
$_catalog_child_menu_without_childs['delimiter']  = '';
$_catalog_child_menu_without_childs['end']        = '</td></tr>';




// �������� ������, �� ������ ������ � �������
$_catalog_child_menu_without_childs_archive['begin']      = '<tr><td>';
$_catalog_child_menu_without_childs_archive['active']     = '';
$_catalog_child_menu_without_childs_archive['inactive']   = '
			<div align="center" class="el">
			<table align="center" width="120" border="0" cellpadding="0" cellspacing="0"><tr valign="middle"><td height="160"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" class="lot">�������� �����</td>
				</tr>			
				<tr>
					<td align="center"><a href="{ALIAS}">{TITLE}</a></td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			<table border="0" cellpadding="0" cellspacing="0" class="inbasketform">
				<tr valign="bottom">
				<!-- td class="price">{PRICE}</td><td><span>&nbsp;&nbsp;���.&nbsp;&nbsp;</td -->
				<td>				
				</td>
				</tr>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" height="8"><tr><td></td></tr></table>
			</div>
';

$_catalog_child_menu_without_childs_archive['now']        = '';
$_catalog_child_menu_without_childs_archive['delimiter']  = '';
$_catalog_child_menu_without_childs_archive['end']        = '</td></tr>';


/*
 * ������ ����������� �������� ���������, ���������� �� ���� static (��� �����������)
 * �������� - ���������� ��������� ����
 * ���������� ���������� - ���������� ��������� ����
 */

$_catalog_category_child_menu['begin']      = '<div style="width: 100%;">
';
$_catalog_category_child_menu['active']     = '<div style="float: left; margin: 0px 10px 10px 0px; width: 160px; height: 160px;"><form method="post" action="/shop/put/"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a><div style="font-size: 10px; line-height: 14px;"><a href="{ALIAS}">{TITLE}</a><br>����: {PRICE}<br><input type="hidden" value="{good_id}" name="good_id">
<input type="text" style="width: 24px; text-align: center;" name="buy_count" value="1" maxlength="3">
<input type="submit" style="text-align: center;" value="� �������">
</form></div></div>
';
$_catalog_category_child_menu['inactive']   = '<div style="float: left; margin: 0px 10px 10px 0px; width: 160px; height: 160px;"><form method="post" action="/shop/put/"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a><div style="font-size: 10px; line-height: 14px;"><a href="{ALIAS}">{TITLE}</a><br>����: {PRICE}<br><input type="hidden" value="{good_id}" name="good_id">
<input type="text" style="width: 24px; text-align: center;" name="buy_count" value="1" maxlength="3">
<input type="submit" style="text-align: center;" value="� �������">
</form></div></div>
';
$_catalog_category_child_menu['now']        = '<div style="float: left; margin: 0px 10px 10px 0px; width: 160px; height: 160px;"><form method="post" action="/shop/put/"><a href="{ALIAS}"><img border="0" src="{IMG_AV}"></a><div style="font-size: 10px; line-height: 14px;"><a href="{ALIAS}">{TITLE}</a><br>����: {PRICE}<br><input type="hidden" value="{good_id}" name="good_id">
<input type="text" style="width: 24px; text-align: center;" name="buy_count" value="1" maxlength="3">
<input type="submit" style="text-align: center;" value="� �������">
</form></div></div>
';
$_catalog_category_child_menu['delimiter']  = "";
$_catalog_category_child_menu['end']        = '</div>
';


$NavigatorBorder['top']['left'] = '
<div>
';
$NavigatorImages['left']= '<DIV style="FLOAT: left; MARGIN: 0px 10px 10px 0px;"><a href="{ALIAS}"><img src="{IMG_AV}" width="{IMG_AV_WIDTH}" height="{IMG_AV_HEIGHT}" style="border:2px solid #336699;">{TITLE}</a><br>����: {PRICE}</div>';
$NavigatorLinks['left']['active']="";
$NavigatorLinks['left']['inactive']="";
$NavigatorBorder['bottom']['left'] = "
</div>
";

$NavigatorBorder['top']['center'] = '
<div>
';
$NavigatorPhotoData = '<DIV style="FLOAT: left; MARGIN: 0px 10px 10px 0px;"><img src="{IMG_AV}" width="{IMG_AV_WIDTH}" height="{IMG_AV_HEIGHT}" style="border:2px solid #dbe3ec;">{TITLE}<br>����: {PRICE}</div>';
$NavigatorBorder['bottom']['center'] = "
</div>
";

$NavigatorBorder['top']['right'] = '
<div>
';
$NavigatorImages['right']= '<DIV style="FLOAT: left; MARGIN: 0px 10px 10px 0px;"><a href="{ALIAS}"><img src="{IMG_AV}" width="{IMG_AV_WIDTH}" height="{IMG_AV_HEIGHT}" style="border:2px solid #336699;">{TITLE}</a><br>����: {PRICE}</div>';
$NavigatorLinks['right']['active']="";
$NavigatorLinks['right']['inactive']="";
$NavigatorBorder['bottom']['right'] = "
</div>
";


# ���� ���������
$_catalog_categories_menu['begin']      = "<h1>���������</h1>
<ul>
";
$_catalog_categories_menu['active']     = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_catalog_categories_menu['inactive']   = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_catalog_categories_menu['now']        = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_catalog_categories_menu['delimiter']  = "
";
$_catalog_categories_menu['end']        = "
</ul>
";

/*
 * ����� ������� ������
 * {TITLE} - �������� ��������
 * {VALUE} - �������� ��������
 */

$_catalog_child_properties['begin']      = "";
$_catalog_child_properties['property']   = "<b>{TITLE}:</b> {VALUE}";
$_catalog_child_properties['delimiter']  = "<br>";
$_catalog_child_properties['end']        = "";


# ����� ���������� � ������� �� �������� ��������� ������
# {good_id} - id ������
$_catalog_putincart = <<<EOF
<form method="post" action="/shop/put/" name="form_put">
<input type="hidden" value="{good_id}" name="good_id">
<input type="hidden" value="{good_price}" name="good_price">
<input type="hidden" value="{good_title}" name="good_title">
<input type="hidden" value="{good_catalog_id}" name="good_catalog_id">
					<td>
						<table border="0" cellpadding="0" cellspacing="0" class="inbasketform">
							<tr valign="bottom">
								<td><input class="inbasketformfield" type="text" name="buy_count" value="1" maxlength=3 border="0"><table border="0" cellpadding="0" cellspacing="0" height="2"><tr><td></td></tr></table></td>
								<td><span>&nbsp;&nbsp;��.</span><table border="0" cellpadding="0" cellspacing="0" height="4"><tr><td></td></tr></table></td>
							</tr>
						</table>
					</td>
					<td>
<div style="position: relative; width: 26px; height: 24px;">
	<div style="position: absolute; ">
		<input type="image"  src="/i/b_inbask.jpg" onmouseover="this.src='/i/b_inbask_a.jpg';" onmouseout="this.src='/i/b_inbask.jpg';" style="cursor: hand; cursor: pointer; padding: 0px; margin: 0px;">
	</div>
</div>
					</td>
</form>

EOF;

#---------------------------------------------------
# ���������� �������������� ���� �� ��������
#---------------------------------------------------
$_catalog_menuexpanded['begin'][1]              = '<ul id="navigation">
';
$_catalog_menuexpanded['inactive'][1]           = '<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded['inactive_end'][1]       = '</li>
';
$_catalog_menuexpanded['end'][1]                = '</ul>
';
/*
 * ������� 2
 */
$_catalog_menuexpanded['begin'][2]              = '	<ul>
';
$_catalog_menuexpanded['inactive'][2]           = '	<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded['inactive_end'][2]       = '	</li>
';
$_catalog_menuexpanded['end'][2]                = '	</ul>
';

/*
 * ������� 3
 */
$_catalog_menuexpanded['begin'][3]              = '		<ul>
';
$_catalog_menuexpanded['inactive'][3]           = '		<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
/*
$_catalog_menuexpanded['inactive'][3]           = <<<EOF
<li {class}><a href="javascript:void(0)" onclick="$this;">{TITLE}</a>
EOF;
*/
$_catalog_menuexpanded['inactive_end'][3]       = '		</li>
';
$_catalog_menuexpanded['end'][3]                = '		</ul>
';

/*
 * ������� 4
 */
$_catalog_menuexpanded['begin'][4]              = '			<ul>
';
$_catalog_menuexpanded['inactive'][4]           = '			<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded['inactive_end'][4]       = '			</li>
';
$_catalog_menuexpanded['end'][4]                = '			</ul>
';



#---------------------------------------------------
# ���������� �������������� ���� �� ��������
#---------------------------------------------------
$_catalog_menuexpanded_archive['begin'][1]              = '<ul id="navigation_archive">
';
$_catalog_menuexpanded_archive['inactive'][1]           = '<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded_archive['inactive_end'][1]       = '</li>
';
$_catalog_menuexpanded_archive['end'][1]                = '</ul>
';
/*
 * ������� 2
 */
$_catalog_menuexpanded_archive['begin'][2]              = '	<ul>
';
$_catalog_menuexpanded_archive['inactive'][2]           = '	<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded_archive['inactive_end'][2]       = '	</li>
';
$_catalog_menuexpanded_archive['end'][2]                = '	</ul>
';

/*
 * ������� 3
 */
$_catalog_menuexpanded_archive['begin'][3]              = '		<ul>
';
$_catalog_menuexpanded_archive['inactive'][3]           = '		<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded_archive['inactive_end'][3]       = '		</li>
';
$_catalog_menuexpanded_archive['end'][3]                = '		</ul>
';

/*
 * ������� 4
 */
$_catalog_menuexpanded_archive['begin'][4]              = '			<ul>
';
$_catalog_menuexpanded_archive['inactive'][4]           = '			<li {class}><a href="/{ALIAS}">{TITLE}</a>
';
$_catalog_menuexpanded_archive['inactive_end'][4]       = '			</li>
';
$_catalog_menuexpanded_archive['end'][4]                = '			</ul>
';

#---------------------------------------------------
# ���������� ���� �� ��������
#---------------------------------------------------
$_catalog_path_item_active    = '<a href="{ALIAS}">{TITLE}</a>&nbsp;<span>&raquo;</span>&nbsp;';
$_catalog_path_item_unactive  = '{TITLE}';
// c ������- �� ��� �� �������� $_catalog_path_delimiter      = '';



#---------------------------------------------------
# ���������� �������
#---------------------------------------------------
$_catalog_gallery = array();
$_catalog_gallery['begin'] = <<<EOF
<a id="custom" href="javascript:;">��� ���� ({count})</a>
<script type="text/javascript">
var imageList = [
EOF;
$_catalog_gallery['item'] = <<<EOF
{url: "{alias}", title: "{title}"}
EOF;
$_catalog_gallery['end'] = <<<EOF
];
</script>
EOF;

?>