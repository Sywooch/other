<?php
#
# �������
# ��� ������� ������ ��������� � ����� �������
#

//////////////////////////////////////////////////////
//������� ����������� �������� url
function request_url()
{
  $result = ''; // ���� ��������� ����
  $default_port = 80; // ���� ��-���������
 
  // � �� � ����������-�� �� ����������?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // � ����������! ������� ��������...
    $result .= 'https://';
    // ...� ������������ �������� ����� ��-���������
    $default_port = 443;
  } else {
    // ������� ����������, ������� ��������
    $result .= 'http://';
  }
  // ��� �������, ����. site.com ��� www.site.com
  $result .= $_SERVER['SERVER_NAME'];
 
  // � ���� � ��� ��-���������?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // ���� ���, �� ������� ���� � URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // ��������� ����� ������� (���� � GET-���������).
  $result .= $_SERVER['REQUEST_URI'];
  // ���, ����� ����������!
  return $result;
}
////////////////////////////////////////////////////////

# ��������� �������������
$skin = array();


#------------------------------------------------------

# ������������ - ���� �����
$skin['overlink'] = array(); 
$skin['overlink']['item'] = <<<EOF
<a id="tmp1" href="{alias}">{title}</a>
EOF;
$skin['overlink']['delimiter'] = '<br>';


#------------------------------------------------------

# ������ ����
$skin['timestamp'] = <<<EOF
d.m.Y

EOF;

#------------------------------------------------------

# ���� ����� �� ������ ��������� ����������� ������� ������ 
$skin['last'] = <<<EOF
<tr>
	<form action="/shop/add/" method="post">
		<td><a id="tmp2" href="{alias}">{title}</a></td>
		<td class="price" nowrap>{price}</td>
		{basket_add}
		</td>
	</form>
</tr>

EOF;

#------------------------------------------------------

# ���� ����� �� ������ ������ ������� ������
$skin['best'] = <<<EOF
									<div style="width:160px;height:360px;float:left;border:none;margin:0 8px 0 0;">
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr valign="top">
												<td class="cat-top"><img alt="" src="{img_th}" width="150"></td>
												<td class="main-shadow-right"><img alt="" src="/style/main-shadow-top-right.gif" width="10" height="10"></td>
											</tr>
											<tr>
												<td class="cat-bottom"><p><a id="tmp3" href="{alias}">{title}</a></p></td>
												<td class="main-shadow-right"></td>
											</tr>
											<tr>
												<td class="main-shadow-bottom"><img alt="" src="/style/main-shadow-bottom-left.gif" width="10" height="10"></td>
												<td><img alt="" src="/style/main-shadow-bottom-right.gif" width="10" height="10"></td>
											</tr>
										</table>
									</div>

EOF;

#------------------------------------------------------

# ���� ����� �� ������ ��������� �������������
$skin['history'] = <<<EOF
<p><a id="tmp4" href="{alias}"><img alt="" src="{img_th}" />{title}</a></p>

EOF;

#------------------------------------------------------

# ���� ����� �� ������ ����������� ������� 
$skin['analog'] = <<<EOF
<p><a id="tmp5" href="{alias}">{title}</a></p>

EOF;

#------------------------------------------------------


# ���� ����� �� ������ ��������� �������������
$skin['path_item'] = <<<EOF
<a id="tmp6" href="{alias}">{title}</a>

EOF;
$skin['path_curitem'] = <<<EOF
{title}

EOF;
$skin['path_delimiter'] = <<<EOF
 &raquo; 

EOF;

#------------------------------------------------------

# ���� � ������
$skin['menu_withchilds']['begin']	= <<<EOF
						<tr valign="top">
							<td></td>
							<td>
<div id="catalog">

EOF;
$skin['menu_withchilds']['item']	= <<<EOF
<div id="cat-out" onMouseOver="this.id='cat-over';" onMouseOut="this.id='cat-out';">
	<a id="tmp8" href="{alias}">{title}</a>
</div>

EOF;
$skin['menu_withchilds']['delimiter']	= <<<EOF
<br>

EOF;
$skin['menu_withchilds']['end']		= <<<EOF
</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3"><table border="0" cellpadding="0" cellspacing="0" height="12"><tr><td></td></tr></table></td>
						</tr>
						<tr>
							<td></td>
							<td id="nnews-dot"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="3"><table border="0" cellpadding="0" cellspacing="0" height="36"><tr><td></td></tr></table></td>
						</tr>

EOF;

# ���� ��� �����
$skin['menu_withoutchilds']['begin']	= <<<EOF
						<tr valign="top">
							<td></td>
							<td>
<table rules="rows" border="1" style="border-collapse:collapse;" bordercolor="#a1a000" cellpadding="0" cellspacing="0" width="100%" id="cat-table">
	<tr>
		<th width="100%">������������</th>
		<th>����</th>
		<th nowrap>���-��</th>
		<th>������</th>
	</tr>

EOF;
$skin['menu_withoutchilds']['item']	= <<<EOF
	<tr>
	<form action="/shop/add/" method="post">
		<td><a id="tmp9" href="{alias}">{title}</a></td>
		<td class="price" nowrap>{price}</td>
		{basket_add}
		</td>
	</form>
	</tr>

EOF;
$skin['menu_withoutchilds']['delimiter']		= <<<EOF

EOF;
$skin['menu_withoutchilds']['end']				= <<<EOF
</table>
							</td>
							<td></td>
						</tr>
						

EOF;

#------------------------------------------------------

# ����� ���������� ������ � ������� ��� ������� �������
$skin['basket_add_for_MenuWithoutChild'] = <<<EOF
		<td>
			<input type="hidden" name="good_id" value="{id}">
			<input class="num" type="text" maxlength="3" name="good_count" value="1" title="����������">
		</td>
		<td class="price">
			<input type="image" src="/style/shop.gif">
		</td>


EOF;

#------------------------------------------------------

# ����� ���������� ������ � ������� ��� �������� ������
$skin['basket_add_for_GoodPage'] = <<<EOF
<form id="f_basket" action="/shop/add/" method="post">
	<td>
		<input type="hidden" name="good_id" value="{id}">
		<input class="num" type="text" maxlength="3" name="good_count" value="1" title="����������"> ��.
	</td>
	<td>
		<span onClick="forms['f_basket'].submit();" style="cursor:pointer;"><u>��������<br>� �������</u></span>
	</td>
	<td>
		<input type="image" src="/style/cart.gif">
	</td>
</form>


EOF;





#---------------------------------------------------
# ���������� �������������� ���� �� ��������
#---------------------------------------------------
$skin['menuexpanded']['begin'][1]              = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="td_4"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
							<td class="title"><h1>�������</h1></td>
						</tr>
						<tr>
							<td><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>
<ul id="navigation">

EOF;
$skin['menuexpanded']['inactive'][1]           = <<<EOF
<li {class}><a id="tmp11" href="{alias}">{title}</a>

EOF;
$skin['menuexpanded']['inactive_end'][1]       = <<<EOF
</li>

EOF;
$skin['menuexpanded']['end'][1]                = <<<EOF
</ul>
							</td>
						</tr>
					</table>

EOF;
/*
 * ������� 2
 */
 
 
 
$skin['menuexpanded']['begin'][2]              = <<<EOF
<ul>

EOF;
$skin['menuexpanded']['inactive'][2]           = <<<EOF
<li {class} id=""><a id="tmp12" href="{alias}">{title}</a>

EOF;
$skin['menuexpanded']['inactive_end'][2]       = <<<EOF
</li>

EOF;
$skin['menuexpanded']['end'][2]                = <<<EOF
</ul>

EOF;

/*
 * ������� 3
 */
$skin['menuexpanded']['begin'][3]              = <<<EOF
		<ul>

EOF;
$skin['menuexpanded']['inactive'][3]           = <<<EOF
		<li {class}><a id="tmp13" href="{alias}">{title}</a>

EOF;
$skin['menuexpanded']['inactive_end'][3]       = <<<EOF
		</li>

EOF;
$skin['menuexpanded']['end'][3]                = <<<EOF
		</ul>

EOF;

/*
 * ������� 4
 */
$skin['menuexpanded']['begin'][4]              = <<<EOF
			<ul>

EOF;
$skin['menuexpanded']['inactive'][4]           = <<<EOF
			<li {class}><a id="tmp14" href="{alias}">{title}</a>

EOF;
$skin['menuexpanded']['inactive_end'][4]       = <<<EOF
			</li>

EOF;
$skin['menuexpanded']['end'][4]                = <<<EOF
			</ul>

EOF;






#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
# ���������� �������
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------
#-----------------------------------------------------------------------

$skin['photomultiupload_form'] = <<<EOF
<br><br>
<script type="text/javascript" src="/{folder_templates}/js/{mod_name}_jquery.MultiFile.js"></script>
<script type="text/javascript" src="/{folder_templates}/js/{mod_name}_jquery.form.js"></script>										
<script type="text/javascript" src="/{folder_templates}/js/{mod_name}_jquery.blockUI.js"></script>
<script type="text/javascript" src="/{folder_templates}/js/{mod_name}_lib.js"></script>

<b>�������� ����� � ����</b><br>������ ���� �� ������ ��������� {file_size_mb} ��<br>����������� ��� ����: jpg
<form id="uploadForm" action="/{folder_admin}/{mod_name}/photomultiupload/{curpid}/" method="post" enctype="multipart/form-data">
	<input name="MAX_FILE_SIZE" value="{file_size}" type="hidden"/>
	<input name="fileToUpload[]" id="fileToUpload" class="MultiFile" type="file" accept="jpg"/>
	<input value="���������" type="submit"/>
</form>	
<div id="uploadOutput"></div>

EOF;



?>