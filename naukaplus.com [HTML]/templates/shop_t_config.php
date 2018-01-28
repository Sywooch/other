<?php
#
# �������
# ��� ������� ������ ��������� � ����� �������
#

# ��������� �������������
$skin = array();








# ��������� ������� � ������ �� ������� (������� �����)
$skin['empty'] = <<<EOF
					<div id="shopcart-mirror">
						<a href="/{mod_name}/cart/"><img alt="" src="/style/shopcart.gif" width="63" height="58"></a>
						<img alt="" src="/style/shopcart-mirror.gif" width="63" height="33">
					</div>
								<h3>���� ������� �����</h3>

EOF;


# ��������� ������� � ������ �� ������� (������� �� �����)
$skin['full'] = <<<EOF
					<div id="shopcart-mirror">
						<a href="/{mod_name}/cart/"><img alt="" src="/style/shopcart.gif" width="63" height="58"></a>
						<img alt="" src="/style/shopcart-mirror.gif" width="63" height="33">
					</div>
								<h3>� ����� �������</h3>
								�������: <span>{count}</span><br>
								<!-- �� �����: <span>{sum}</span> -->

EOF;





#------------------------------------------------------------------------------

# ���������� ������ ������������� �������
$skin['attend'] = '<p><a href="{alias}">{title}</a></p>';





#------------------------------------------------------------------------------
# ������ �������
#------------------------------------------------------------------------------


# ������ �������
$skin['cart_begin'] = <<<EOF
<form method="post" action="/{mod_name}/calc/">
<table rules="rows" border="1" style="border-collapse:collapse;" bordercolor="#a1a000" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
	<tr>
		<th>���</th>
		<th width="100%">������������</th>
		<th nowrap>���-��</th>
		<th>����</th>
		<th>�����</th>
		<th></th>
	</tr>

EOF;



# ���� ����� �������
$skin['cart_item'] = <<<EOF
	<tr>
			<td>{id}</td>
			<td><a href="{alias}">{title}</a></td>
			<td align=center><input class="num" maxlength="3" type="text" name="count[{id}]" value="{count}"></td>
			<td class="price" nowrap>{price}</td>
			<td class="price" nowrap>{total}</td>
			<td class="price"><a href="/shop/del/{id}/"><img alt="" src="/style/delete.gif"></a></td>
	</tr>

EOF;





# ��������� ������� 
$skin['cart_end'] = <<<EOF
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr valign="top">
			<td>
				<table border="0" style="border:1px solid #a1a000;" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
					<tr>
						<td><input name="order_lico" checked value="ur" type="radio"></td>
						<td class="price" nowrap>��. ����</td>
						<td>&nbsp;</td>
						<td><input name="order_lico" value="fiz" type="radio"></td>
						<td class="price" nowrap>���. ����</td>
					</tr>
					<tr>
						<td colspan="5" align="center"><input type="submit" id="order" name="order" value="" style="width:132px;height:22px;background:url(/style/contract.gif) no-repeat;border:0;margin-bottom:6px;" title="�������� �����"></td>
					</tr>

				</table>
			</td>
			<td width="54"><table border="0" cellpadding="0" cellspacing="0" width="54"><tr><td></td></tr></table></td>
			<td>
				<table border="0" style="border:1px solid #a1a000;" cellpadding="0" cellspacing="0" width="100%" id="shop-table">
					<tr>
						<!-- td>�����:</td>
						<td align="center">{total}</td>
						<td align="center"><input type="submit" name="calc" value="" style="width:17px;height:22px;background:url(/style/res.gif) no-repeat;border:0;" title="�����������"></td -->
                                                <td><b>����� ���� ������</b> ��������� � ������ ���������</td>
					</tr>
				</table>
			</td>
	</tr>
</table>
</form>

EOF;


# � ������, ���� ������� � �������, � ������� �����
$skin['cart_empty'] = '<div>���� ������� �����</div>';

#------------------------------------------------------------------------------




# � ������, ���� ��������-���������� - ��� ��� ���������� ������������
$skin['error_catalog'] = '���������� �������� ������ � ��������-���������';



#------------------------------------------------------------------------------


# ����� ������ ��� ������
$skin['ur_order'] = <<<EOF
<p><b>����� ���������� ���� ������,  ��� ������  ������������ � ����� ��������� ��������� �� �� ���������� ��� ����� � ��������� �� ������</b></p>
<form method=post id="fur" action="/shop/thankyou/">
<p><font color="red" id="error">{error}</font></p>
<input type="hidden" value="{lico}" name="lico">
<table border="0" cellpadding="0" cellpadding="0" width="100%" id="register">

<tr>
<th>���������� ���� (���):</th>
<td><input name="lname" id="lname" value="{lname}" type="text"  title="����������� ���������"></td>
</tr>

<tr>
<th>����� E-mail:</th>
<td><input name="email" id="email" value="{email}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>�������:</th>
<td><input name="phone" id="phone" value="{phone}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>��������:</th>
<td><input name="company" id="company" value="{company}" type="text" title="����������� ���������"></td>
</tr>

<!-- tr valign="top">
<th>����������� �����:</th>
<td><textarea name="uradress" id="uradress">{uradress}</textarea></td>
</tr>

<tr>
<th>���:</th>
<td><input name="inn" id="inn" value="{inn}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>���:</th>
<td><input name="kpp" id="kpp" value="{kpp}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>����:</th>
<td><input name="bank" id="bank" value="{bank}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>���:</th>
<td><input name="bik" id="bik" value="{bik}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>�/�:</th>
<td><input name="rschet" id="rschet" value="{rschet}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>����/����:</th>
<td><input name="cschet" id="cschet" value="{cschet}" type="text" title="����������� ���������"></td>
</tr -->

<tr>
<th>������ �������� (�������):</th>
<td><select name="delivery">
	<option value="���������">���������
	<option value="�������� ������������ ���������">�������� ������������ ���������
	<option value="�������� �� �����">�������� �� �����
</select></td>
</tr>

<tr>
<td colspan="2" align="center"><input class="button" value="��������� ����������" type="button" onClick="verifFormUr();">
</td>
</tr>

</table>
</form>
EOF;


# ����� ������ ��� �����
$skin['fiz_order'] = <<<EOF
<p><b>����� ���������� ���� ������,  ��� ������  ������������ � ����� ��������� ��������� �� �� ���������� ��� ����� � ��������� �� ������</b></p>
<form method=post id="ffiz" action="/shop/thankyou/">
<p><font color="red" id="error">{error}</font></p>
<input type="hidden" value="{lico}" name="lico">
<table border="0" cellpadding="0" cellpadding="0" width="100%" id="register">

<tr>
<th>���:</th>
<td><input name="lname" id="lname" value="{lname}" type="text"  title="����������� ���������"></td>
</tr>

<!-- tr>
<th>���:</th>
<td><input name="fname" id="fname" value="{fname}" type="text"  title="����������� ���������"></td>
</tr -->

<tr>
<th>����� E-mail:</th>
<td><input name="email" id="email" value="{email}" type="text" title="����������� ���������"></td>
</tr>

<tr>
<th>�������:</th>
<td><input name="phone" id="phone" value="{phone}" type="text" title="����������� ���������"></td>
</tr>

<!-- tr>
<th>���������� ������:</th>
<td><input name="pasport" id="pasport" value="{pasport}" type="text" title="����������� ���������"></td>
</tr>

<tr valign="top">
<th>�����:</th>
<td><textarea name="adress" id="adress">{adress}</textarea></td>
</tr -->

<tr>
<th>������ �������� (�������):</th>
<td><select name="delivery">
	<option value="���������">���������
	<option value="�������� ������������ ���������">�������� ������������ ���������
	<option value="�������� �� �����">�������� �� �����
</select></td>
</tr>

<tr>
<td colspan="2" align="center">	
	<input class="button" value="��������� ����������" type="button" onClick="verifFormFiz();">
</td>
</tr>

</table>
</form>
EOF;


# ��������� ������
$skin['error_email'] = '�� ������� �������� "e-mail"<br>';



# ����� ���������
$skin['success'] = '<h3>���������� �� �����</h3>� ��������� ����� � ���� �������� ���� ���������';






#------------------------------------------------------------------------------


# ������ �������
$skin['mail_cart_begin'] = <<<EOF
<table cellspacing=1 cellpadding=1 border=1 width=100%>
	<tr>
		<th>���</th>
		<th>������������</th>
		<th>���-��</th>
		<th>����</th>
		<th>�����</th>
		
	</tr>
EOF;



# ���� ����� �������
$skin['mail_cart_item'] = <<<EOF
	<tr>
			<td align="center">{id}</td>
			<td>{title}</td>
			<td align=center>{count}</td>
			<td align=center>{price}</td>
			<td align=center>{total}</td>
			
	</tr>
EOF;





# ��������� ������� 
$skin['mail_cart_end'] = '
	<tr>
			<td colspan="3"></td>
			<td align="center">�����:</td>
			<td align="center"><b>��������� � ���������</b></td>
</table>
</form>
';


#------------------------------------------------------------------------------




# ������ ����������� ��� ������������
$skin['subject_foruser'] = '����� �� ����� {host}';
$skin['mail_foruser'] = '
<html>
<body>
������������!<br><br><br>
�� ����� {host} �� ������ ����� ��� �������� ����� �� ��������� ������������ �� ��������:<br>
{goods}
<br><br>
���� �� �� ������ �����, �� �� ���������, � ������ ������� ������.<br>
<br><br><br>

{mail_footer}
</body>
</html>
';

# ������ ����������� ��� ���������
$skin['subject_formanager'] = '����� �{order_num} �� ����� {host}';
$skin['mail_formanager'] = '
<html>
<body>
������������!<br><br><br>
�� ����� {host} ��� �������� � ���������� ����� �� ��������� ������������ �� ��������:<br>
{goods}
<br><br>
���������� � ������������:<br><br>
{user}

{mail_footer}
</body>
</html>
';



# ������ � ������������ � ������ ��������� - �����
$skin['user_ur'] = <<<EOF
���: {lname}<br>
����� E-mail: {email}<br>
�������: {phone}<br>
��������: {company}<br>
������ ��������: {delivery}<br>
EOF;
//����������� �����: {uradress}<br>
//���: {inn}<br>
//���: {kpp}<br>
//����: {bank}<br>
//���: {bik}<br>
//�/�: {rschet}<br>
//����/����: {cschet}<br>


# ������ � ������������ � ������ ��������� - ������
$skin['user_fiz'] = <<<EOF
���: {lname}<br>
����� E-mail: {email}<br>
�������: {phone}<br>
������ ��������: {delivery}<br>
EOF;
//���: {fname}<br>
//���������� ������: {pasport}<br>
//�����: {adress}<br>
#------------------------------------------------------------------------------




# ����� ��� ������������� ������
$skin['approve'] = <<<EOF
<h3>����� ����������.</h3>
���� ��������� ���������� ��������������� ���������� � � ��������� ����� �������� � ����. 
EOF;

# ����� ��� ��������� ������������� ������
$skin['is_approve'] = <<<EOF
��� ����� ��� ��� ���������� �����.<br>
���������� ������������ �� ���������. 
EOF;




#------------------------------------------------------------------------------
# ������ ������������
#------------------------------------------------------------------------------


# ������� �������
$skin['statistic_status'][0] = '�� ����������';
$skin['statistic_status'][1] = '����������';
$skin['statistic_status'][2] = '� ���������';
$skin['statistic_status'][3] = '�������';
$skin['statistic_status'][4] = '��������';
$skin['statistic_status'][100] = '������';


$skin['no_statistic'] = <<<EOF
��� ����������������� ������������ ������� ������� �� ��������.<br>
�� ������ <a href="/users/reg/">������������������</a> � ��������������. 
EOF;


# ������ �������
$skin['statistic_empty'] = <<<EOF
<h3>������� ������� �����. �� ��� ������ �� ����������</h3>
EOF;


# ������ �������
$skin['statistic_begin'] = <<<EOF
<table cellspacing=1 cellpadding=1 border=1 width=100%>
	<tr>
		<th>����� ������</th>
		<th>���� ������</th>
		<th>�����</th>
		<th>������</th>
	</tr>
EOF;



# ���� ����� �������
$skin['statistic_item'] = <<<EOF
	<tr>
			<td align="center">{id}</td>
			<td>{rectime}</td>
			<td align=center>{total}</td>
			<td align=center>{status}{extend}</td>			
	</tr>
EOF;





# ��������� ������� 
$skin['statistic_end'] = '	
</table>
';




#------------------------------------------------------------------------------











?>