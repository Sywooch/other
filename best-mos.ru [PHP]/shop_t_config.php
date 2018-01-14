<?
#
#  ������ shop
#

#---------------------------------------------------------------------------------------------------
# ������ � �������� � � �������
#---------------------------------------------------------------------------------------------------

# ������ �� ������� - ������
$_shop_cartlink_empty = <<<EOF
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="24"><div class="basketlink"><a href="/shop/cart/">����&nbsp;�������</a>&nbsp;</div></td>
		<td align="right" style="background: url(/i/i_basket.gif) no-repeat left; padding-left: 40px; cursor:pointer;" onClick="document.location='/shop/cart/';">�����</td>
	</tr>
</table>
EOF;

# ������ �� ������� - ������
$_shop_cartlink_full = <<<EOF
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="24"><div class="basketlink"><a href="/shop/cart/">����&nbsp;�������</a>&nbsp;</div></td>
		<td align="right" style="background: url(/i/i_basket-f.gif) no-repeat left top; padding-left: 40px;cursor:pointer;" onClick="document.location='/shop/cart/';"><a href="/shop/cart/" class="coll">�������:<b>&nbsp;{goods_count}</b></a></td>
	</tr>
</table>
EOF;


# ����� �������� - �����
$_shop_cart['pre_begin'] = <<<EOF
{SHOP_INFO}
<br><br>
EOF;

$_shop_cart['post_after_reception'] = '<tr>
		<td height="36"></td>
		<td style="color:#FFFFFF;font-weight:bold; background:#93be50 url(/i/bg_line.gif) repeat-x left bottom;" >
		<nobr><input type="radio" name="type_pay_{CATALOG_ID}" value="post_after_reception" {checked_post_after_reception} onClick="choose_payment_method();"> ���������� �����<br></td>
		<td>�����, ������������ �� ����� ��� ��������� ��������� �����������</td>
	</tr>';


$_shop_cart['post_perevod'] = '
<tr><td width="" height=\"34\"></td><td bgcolor="#93be50" style="color:#FFFFFF;font-weight:bold;"><nobr><input type="radio" name="type_pay_{CATALOG_ID}" value="post_perevod" {checked_post_perevod} onClick="mainFormSend();"> ��������� ����������</td>
<td>�.�. ������������ ����� ��������� ������ �������� ��� ���������� ���������, ��������� ����� ������������ �� ����� ��� ��������� ��������� �����������</td>
</tr>';

//$_shop_cart['limit_owerflow'] = '<tr><td colspan=3 style="color: red;">�������� ���� ��������, ��� � ������������ � <a href="/help/rules_{CAT_ID}/">��������� ��������</a> , ������ ���������� ���� {LIMIT} ��� ����������� ������ �� �������� ��������� ����������.</td></tr>';
$_shop_cart['limit_owerflow'] = '';


# ������ �������
$_shop_cart['begin'] = <<<EOF
<p>{INFO}</p>
<h2>{CATALOG_TITLE}</h2>
{OPLATA_BLOCK}
<br>
<table cellspacing=0 cellpadding=4 border=1 width=100% style="border-collapse:collapse;" rules=rows bordercolor="#A7A6AA">
	<tr>
		<th>�����</th>
		<th>������������</th>
		<th>���-��</th>
		<th>����, ���.</th>
		<th>�����, ���.</th>
		<th>&nbsp;</th>
</tr>
EOF;

$_shop_cart['oplata_block'] = <<<EOF
<table cellspacing=0 cellpadding=4 border="0" width=100%>
	<tr bgcolor="#cae6a1">
		<td><nobr><b>������ ������</b></nobr></td>
		<td colspan="2"><b> (<font color="red">����������� �������</font>):</b></td>
	</tr>
	<tr style="height:10px;">
		<td colspan="3"></td>
	</tr>
	{LIMIT_OVERFLOW}
	{POST_AFTER_RECEPTION}
	{POST_PEREVOD}    
    {POST_CREDIT}
	<tr style="height:10px;">
		<td colspan="3"></td>
	</tr>
	<tr style="display:{DISLPAY};">
		<td align=right></td>		
		<td colspan="2" style="border:#FF9900 1px solid;">{predoplata_error}������� �����: <input type="text" style="width: 60px; text-align: center; background: #fff; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; margin: 0px; height: 20px;" name="predoplata_sum[{CATALOG_ID}]" value={PREDOPLATA_{CATALOG_ID}}  onBlur="mainFormSend();"></td>
	</tr>
</table>
EOF;

$_shop_cart['item'] = <<<EOF
	<tr>
		<td>{ID}</td>
		<td>{TITLE}</td>
		<td align=center><input type="text" id="count{ID}" name="count[{ID}]" style="width: 24px; text-align: center; background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; padding: 0px 2px 0px 2px; margin: 0px; height: 20px;" onfocus="this.select();" value="{COUNT}" maxlength="3" onBlur="mainFormSend();"></td>
		<td align=center>{COST}</td><input type="hidden" value="{COST}" id="cost{ID}">
		<td align=center id="sumhtml{ID}">{SUM}</td><input type="hidden" value="{SUM}" id="sum{ID}">
		<td><a href="/shop/del/{ID}/">����������</a></td>
</tr>
EOF;

$_shop_cart['sum_error'] = <<<EOF
<font color="red">����� ���������� ������ ���� �� ����� {persent}% �� ��������� ������: {predoplata}</font><br>
EOF;

# �������� 
$_shop_cart['end'] = '
</table>
<br>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<tr><td align=right>������� ��������:</td>
<td>
	{delivery_select}
</td></tr>
<tr><td align=right>����� �� ��������: </td><td><nobr><b>{PRE_TOTAL}</b></td></tr>
<tr><td align=right>������:</td><td><nobr><b>{SKIDKA}</b></td></tr>
<tr><td align=right>������������:</td><td><nobr><b>{KOMPLEKT}</b></td></tr>
<tr><td align=right>{TOTAL_TITLE} </td><td><nobr><b>{TOTAL}</b></td></td></tr>
<tr><td colspan=2 align=center><i>{SBOR}</i></td></tr>
</table>
';

# �������� ������ �� ���� �������
$_shop_cart['after_end'] = <<<EOF
<!-- h2>����� �� ������</h2>
<hr style="height:1px;border:1px solid #A7A6AA;" noshade>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<tr><th align="right" id="totalhtml">����� ���� �� ���������: </td><td><nobr>{PRE_TOTAL}</th></tr>
<tr><td align="right"><b>������:</b> </td><td><nobr>{SKIDKA}</td></tr>
<tr><td align="right"><b>����� �� �������:</b> </td><td><nobr>{PRE_TOTAL-SKIDKA}</td></tr>
<tr><td align="right"><b>������������:</b> </td><td><nobr>{KOMPLEKT}</td></tr>
<tr><td align="right"><b>���������� ������������������:</b> </td><td><nobr>{PREDOPLATA}</td></tr>
<tr><th align="right" id="totalhtml">����� �� ������: </td><td><nobr>{TOTAL}</th></tr -->


<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td colspan=2 align="center">
{order_button}<input type="button" value="�����������" onClick="mainFormSend();" style="background: transparent; border: 1px solid #A7A6AA; font-size: 14px; color: #F8941D; height: 22px;">
</td></tr>
<input type="hidden" value="{TOTAL}" id="total">
</table>

<script>
// ���������� ������� enter
$("input").keypress(function (e) {	
      if (e.which == 13) {
		mainFormSend();	
      }
});
</script>

EOF;

# � ������, ���� ������� � �������, � ������� �����
$_shop_cart_empty = '<div>���� ������� �����</div>';


# � ������, ���� ������� � �������, � ������� �����
$_shop_cart_needauth = '<font color="red"><b>��� ����������� ���������� ������ ����������<br><a href="/authorization/reg/">������ ��������� ����������/�����������</a></b></font><br><br>';


#---------------------------------------------------------------------------------------------------
# �����: ������ � �������� � � �������
#---------------------------------------------------------------------------------------------------


#---------------------------------------------------------------------------------------------------
# ������ � ������ ������ � �����������
#---------------------------------------------------------------------------------------------------

# ����� ������ ��� ������������������ �������������
$_shop_order['begin'] = <<<EOF
<h1>���������� ������</h1>
<input type="radio" name="first_buy" value="yes" {yes} onClick="onOrder()"> ��������� ��� ������� ��������<br>
<input type="radio" name="first_buy" value="no" {no} onClick="onOrder()"> ��������� ��� ����
<br><br>
EOF;

$_shop_order['choose_payment_method'] = <<<EOF
<h2>������ ������</h2>
<p>����������, �������� �������� ������ ������ ������ ������:</p>
<input type="hidden" name="prepay" value="{pay_summ}"/>
<input type="hidden" name="delivery" value="{delivery}"/>
<div style="padding-left:20px">
<label class="radio">
    <input type="radio" name="pay_method" id="optionsRadios1" value="bank" checked>���������� �������</label>		
<label class="radio">
    <input type="radio" name="pay_method" id="optionsRadios2" value="post">�������� �������</label>
<label class="radio">		
    <input type="radio" name="pay_method" id="optionsRadios2" value="card">���������� ����� (Visa ��� MasterCard)</label>
<br><br>
<button type="button" class="btn btn-success" onclick="onFormOrderSubmit();">�������� �����</button>
<div>
EOF;


# ����� ������ ��� �������������������� �������������
$_shop_order['body_first_buy'] = <<<EOF
<b>{ADDING_TEXT}</b><br><br>
<input type="hidden" id="first_buy" value="yes">
<table border=0 cellspacing=0 cellpadding=0 width="100%">
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td style="width:200px;" align="right"><span>� ���� �������� ������!</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit" id="myindex"  name="myindex" value="" onKeyUp="onMyIndex()"> <input type="button" value="���������" onClick="onMyIndex();"></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td style="width:200px;" align="right"><span id="span_region">������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" id="region"  name="region" onChange="onChangeRegion();">{regions}</select></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_rayon">�����:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" disabled="disabled"  id="rayon" name="rayon" onChange="onChangeRayon();"></select></span></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_gorod">�������� ���������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><select class="reg_inpit" disabled="disabled" id="gorod" name="gorod" onChange="onChangeGorod();"></select></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_adress">����� ��������� ���������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea class="reg_inpit" DISABLED name="adress" id="adress"></textarea></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_adress_deliver">����� ��������:<br>(�����, �����, ���, ��������)</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea  class="reg_inpit" name="adress_deliver" id="adress_deliver"></textarea></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_f">�������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit" type=text id="f" name="f"></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_i">���:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit"  type=text name="i" id="i" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_o">��������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input class="reg_inpit"  type=text id="o" name="o" value=""></td></tr>
		
		{docs}
		
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_email">E-mail:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="email" name="email" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_phone">���������� �������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="phonenum" name="phone" value=""></td></tr>
	<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_comment">����������� � ������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><textarea style="width:300px;" id="comment" name="comment"></textarea></td></tr>
	<tr>

<tr height="25"><td colspan="3"></td></tr>			
		
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_user_name">�����:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="user_name" name="user_name" value=""></td></tr>
	

<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd">������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd" name="passwd" value=""></td></tr>
		
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';">
		<td align="right"><span id="span_passwd2">������, ������:</span> </td>
		<td width="5">&nbsp;</td>
		<td><input style="width:300px;"  type=text id="passwd2" name="passwd2" value=""></td></tr>		
		
<tr>
	<td colspan=3><br><i>��� ���� ����������� ��� ���������� (����� �����������)</i><br><input type="button" value="��������� �����" onClick="onFormOrderSubmit()"></td></tr>
</table>
<a href="/shop/cart/">��������� � �������</a>  
EOF;


# ����� ������ ��� �������������������� �������������
$_shop_order['body_not_first_buy'] = <<<EOF
<input type="hidden" id="first_buy" value="no">
<table border=0 cellspacing=0 cellpadding=0 width="100%">
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td width="200" align="right"><span id="span_email">������� ��� email:</span> </td><td width="5">&nbsp;</td><td><input style="width:300px;" type=text id="email" name="email" value=""></td></tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td width="200" align="right"><span id="span_index">�������� ��� �������� ������:</span> </td><td width="5">&nbsp;</td><td><input style="width:300px;" type=text id="index" name="index" value=""></td></tr>
<tr onmouseover="this.style.background='#CCFFCC';" onmouseout="this.style.background='';"><td align="right"><span id="span_comment">����������� � ������:</span> </td><td width="5">&nbsp;</td><td><textarea style="width:300px;" id="comment" name="comment"></textarea></td></tr>
<tr><td colspan=3><br><i>��� ���� ����������� ��� ���������� (����� �����������)</i><br><input type="button" value="��������� �����" onClick="onFormOrderSubmit()"></td></tr>
</table>
EOF;

//<script>window.scroll(0,0);</script>
$_shop_order['do_order'] = <<<EOF
<input type="hidden" id="first_buy" value="no">
<b>{f} {i} {o}</b>, �� ����� ����, ��� �� ���������� ���� ����� �� ����� ��������!<br><br>
<i>����������� � ������:</i><br><textarea style="width:300px;" id="comment" name="comment"></textarea>
<br><br>
<b>������ �� �� �������� �����?</b> <input type="button" value="��������" onClick="onFormOrderSubmit()" onclick="yaCounter7397239.reachGoal('ORDER'); return true;"><br>
<a href="/shop/cart/">��������� � �������</a>  
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ������ ������ � �����������
#---------------------------------------------------------------------------------------------------



#---------------------------------------------------------------------------------------------------
# ������ � ��������� �������������� ����� ������������
#---------------------------------------------------------------------------------------------------


# ����� �������� - �����
$_shop_cart_formail['pre_begin'] = <<<EOF
{SHOP_MAIL_INFO}
<br><br>
EOF;

# ������ �������
$_shop_cart_formail['begin'] = <<<EOF
<p>{INFO}</p>
<h2>{CATALOG_TITLE}</h2>
<table cellspacing=0 cellpadding=4 border=0>
<tr><th>�����</th><th>������������</th><th>����������</th><th>����,���.</th><th>�����,���.</th></tr>
EOF;

$_shop_cart_formail['item'] = <<<EOF
<tr>
	<td>{ID}</td><td>{TITLE}</td><td align=center>{COUNT}</td><td align=center>{COST}</td><td align=center>{SUM}</td>	
</tr>
EOF;

$_shop_cart_formail['sum_error'] = <<<EOF
EOF;

# �������� 
$_shop_cart_formail['end'] = '
<tr><td colspan=4 align=right>����� �� ��������: </td><td align=center><nobr><b>{PRE_TOTAL}</b></nobr></td></td></tr>
<tr><td colspan=3></td><td align=right>������:</td><td align=center><nobr><b>{SKIDKA}</b></nobr></td></tr>
<tr><td colspan=3></td><td align=right>������������:</td><td align=center><nobr><b>{KOMPLEKT}</b></nobr></td></tr>
<tr><td colspan=4 align=right>{TOTAL_TITLE} </td><td align=center><nobr><b>{TOTAL}</b></nobr></td></td></tr>
<tr><td colspan=2></td><td  colspan=3 align=center><i>{SBOR}</i></td></tr>	
</table><br><br>
';

# �������� ������ �� ���� �������
$_shop_cart_formail['after_end'] = <<<EOF
<h2>����� �� ������</h2>
<hr style="height:1px;border:1px solid #A7A6AA;" noshade>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><td width=50%></td><td width=50%></td></tr>
<table cellspacing=0 cellpadding=4 border=0 align=center>
<tr><th align="right" id="totalhtml">����� ���� �� ���������: </td><td><nobr>{PRE_TOTAL}</nobr></th></tr>
<tr><td align="right"><b>������:</b> </td><td><nobr>{SKIDKA}</nobr></td></tr>
<tr><td align="right"><b>����� �� �������:</b> </td><td><nobr>{PRE_TOTAL-SKIDKA}</nobr></td></tr>
<tr><td align="right"><b>������������:</b> </td><td><nobr>{KOMPLEKT}</nobr></td></tr>
<tr><td align="right"><b>���������� ������������������:</b> </td><td><nobr>{PREDOPLATA}</nobr></td></tr>
<tr><th align="right" id="totalhtml">�����: </td><td><nobr>{TOTAL}</nobr></th></tr>

</table>
EOF;

# ������ ������� � ��� ���������������� ������� � ����� � ������
$_shop_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>������������,</b> {f} {i}!
<br><br>
���� ��������������� ������ � ������� best-mos.ru:
<br><br>
�����: <b>{user_email}</b><br>
������: <b>{user_pass}</b>
<br><br>
����������� �� ��� ��������� ��������� ������ ����� ��� �� ����� ���������� ������ ������!!!
<!-- h2>���������� � ������<br>����������� ����������� �����, ������� �� ������ <a href="{ALIAS}">{ALIAS}</a></h2 -->

{ORDER}
<br>
<br>
--<br>
C ���������, best-mos.ru
<br>
<br>



</body>
</html>
EOF;

$_orderdel_mail_message = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
<b>������������,</b> {f} {i}!
<br><br>
�� ������ �������� ���� ����������� �������� ������ ������ �� {order_date} 
<br>
<br>
--<br>
C ���������, best-mos.ru
<br>
<br>



</body>
</html>
EOF;

# ����� ������, ������� �� ����!
$_shop_OrderDo_done = <<<EOF
<h1>���������� ������</h1>
<b>��� ����� ��������.</b><br><br>
�� ��� e-mail ������� ������ � ������ ����������� � ������.<br><br>
�� ������ ����������� ������� � ��������� ������ �������� � ������� - <a href="/shop/ordersinfo/">������� �������</a>
EOF;



# ��������� ��� ������������, �������������� ���� �����
$_shop_confirm_ok = <<<EOF
<h1>������������� ������</h1>
�� ����������� �����. �������.<br>
<i>��� ������� ����� �����������, ������� �� ��������� � ���������!</i>
EOF;

# ��������� ��� ������������, �������������� ���� �����
$_shop_confirm_error1 = <<<EOF
<h1>������������� ������</h1>
��� ����� ��� ���������� � ��������� � ���������.<br>
<i>��� ������� ����� �����������, ������� �� ��������� � ���������!</i>
EOF;

# ��������� ��� ������������, �������������� ���� �����
$_shop_confirm_error2 = <<<EOF
<h1>������������� ������</h1>
������! �������� �� ������� �� ���� �� ��������� ������ ��� �� �� ��������. ���������!<br>
<i>��� ������� ����� �����������, ������� �� ��������� � ���������!</i>
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ��������� �������������� ����� ������������
#---------------------------------------------------------------------------------------------------



#---------------------------------------------------------------------------------------------------
# ������ � ��������� ������� �� ������� ������� ����� XML
#---------------------------------------------------------------------------------------------------

$_shop_xml['begin'] = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<dataroot>
EOF;

$_shop_xml_ZakazOUT['item'] = <<<EOF
<order>
<ZakazID>{order_id}</ZakazID> 
<DTReg>{order_time}</DTReg>
<ClientID>{user_id}</ClientID> 
<PredoplataSum>{predoplata_sum}</PredoplataSum>
<Comment>{comment}</Comment>
<UserUpdate>{user_is_active}</UserUpdate>
<AuthorID>{author_id}</AuthorID>
</order>
EOF;

$_shop_xml_ZakazPozOUT['item'] = <<<EOF
<item>
<ZakazID>{id_order}</ZakazID> 
<CatalogID>{catalog_id}</CatalogID>
<LotID>{lot_id}</LotID>
<LotCount>{lot_count}</LotCount>
<PositionStatus>{zakaz_status}</PositionStatus> 
</item>
EOF;

$_shop_xml['end'] = <<<EOF
</dataroot>
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ��������� ������� �� ������� ������� ����� XML
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# ������ � ������������ ������ ��� �������� ������������
#---------------------------------------------------------------------------------------------------

$_shop_oplata_bank = <<<EOF
<table height="400" cellspacing="1" cellpadding="1" border="1" width="100%">
    <tbody>
        <tr>
            <td style="width:142px;">������
            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr style="height:230px;">
                        <td valign="top" style="width:142px;">&nbsp;</td>
                    </tr>
            </table>
            ���������</td>
            <td valign="top">
            <p><b>����������</b>: <u>{company}<br />
            </u><b>���</b>: <u>{kpp}</u>&nbsp;&nbsp;&nbsp;&nbsp; <b>���</b>: <u>{inn}</u>&nbsp;&nbsp; <b>��� �����</b>: <u>{okato}<br />
            </u><b>�/��</b>.: <u>{rschot}</u>&nbsp;&nbsp; <b>�</b>: <u>{bank}<br />
            </u><b>���</b>: <u>{bik}</u>&nbsp;&nbsp;&nbsp; <b>�/��</b>.: {kschot}<br />
            <b>��� ��������� ������������� (���)</b>: <u>{kbk}</u><br />
            <b>�����</b>: <u>������ �� �������� {catalog_title}<br />
            </u><b>����������</b>: <u>{f} {i} {o}<br />
            </u><b>����� �����������</b>: <u>{adress}<br />
            </u><b>��� �����������</b>: ______________________________<br />
            <b>� �/��. �����������</b>: ______________________________</p>
            <p><b>�����</b>: {predoplata} ���. <u>&nbsp; 00&nbsp;&nbsp; </u>���.&nbsp;</p>
            <p><b>�������</b>: _________ <b>����</b>: &quot;_____&quot; ________ 200___�.</p>
            </td>
        </tr>
        <tr>
            <td valign="bottom">
            <p>���������</p>
            <p>������</p>
            </td>
            <td valign="top">
            <p><b>����������</b>: <u>{company}<br />
            </u><b>���</b>: <u>{kpp}</u>&nbsp;&nbsp;&nbsp;&nbsp; <b>���</b>: <u>{inn}</u>&nbsp;&nbsp; <b>��� �����</b>: <u>{okato}<br />
            </u><b>�/��</b>.: <u>{rschot}</u>&nbsp;&nbsp; <b>�</b>: <u>{bank}<br />
            </u><b>���</b>: <u>{bik}</u>&nbsp;&nbsp;&nbsp; <b>�/��</b>.: {kschot}<br />
            <b>��� ��������� ������������� (���)</b>: <u>{kbk}</u><br />
            <b>�����</b>: <u>������ �� �������� {catalog_title}<br />
            </u><b>����������</b>: <u>{f} {i} {o}<br />
            </u><b>����� �����������</b>: <u>{adress}<br />
            </u><b>��� �����������</b>: _______________________________<br />
            <b>� �/��. �����������</b>: _______________________________</p>
            <p><b>�����</b>: {predoplata} ���. <u>&nbsp; 00&nbsp;&nbsp; </u>���.&nbsp;</p>
            <p><b>�������</b>: _________ <b>����</b>: &quot;_____&quot; ________ 200___�.</p>
            </td>
        </tr>
    </tbody>
</table>
EOF;


$_shop_olpata_pochta = <<<EOF
<table height="393" cellspacing="1" cellpadding="1" border="1" width="100%">
    <tbody>
        <tr>
            <td style="width:170px;">&nbsp;</td>
            <td valign="top">
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td width="150">
                        <p><img src="http://www.best-mos.ru/i/gerb.gif"></p>                        
                        <p>&nbsp;</p>
                        <p>�______________<br />
                        (�� �.�.11)</p>
                        </td>
                        <td width="20">
                        <p>&nbsp;</p>
                        <p><b>�<br />
                        �<br />
                        �<br />
                        �<br />
                        �</b></p>
                        </td>
                        <td align="right" valign="top">�.112�</td>
                    </tr>
                </tbody>
            </table>
            </p>
            <p><b>�������� �������&nbsp; (�����������)&nbsp;</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>�� </b>{predoplata} <b>���</b>.&nbsp;<u> 00&nbsp;</u> <b>���</b>.</p>
            <p><u>{predoplata_word}</u> <b>���</b>.&nbsp;<u> 00&nbsp;</u> <b>���</b>.</p>
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td><b>����</b>:</td>
                        <td>{company_adress}, ��� {inn}, ��� {kpp}, �/�{rschot} � {bank}, �/�{kschot}, ��� {bik}</td>
                    </tr>
                    <tr>
                        <td><b>����</b>:</td>
                        <td>{company}</td>
                    </tr>
                </tbody>
            </table>
            </p>
            <p><b>�� ����</b>: {f} {i} {o}<br />
            <b>�����</b>: {adress}<br />
            <b>���������</b>: ������ �� �������� {catalog_title}</p>
            <p>
            <table cellspacing="1" cellpadding="1" border="0" width="100%">
                <tbody>
                    <tr>
                        <td align="right">
                        <p>__________________<br />
                        ������� ���������</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            </p>
            </td>
        </tr>
    </tbody>
</table>
EOF;


$_shop_oplata_html = <<<EOF
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
</head>
<body>
{blank}
</body>
</html>
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ������������ ������ ��� �������� ������������
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# ������ � ������������ ������� ������������
#---------------------------------------------------------------------------------------------------

$zakaz_status = array();
$zakaz_status[0] = '�����';  // ��� ������
$zakaz_status[1] = '����������'; // ��� ������
$zakaz_status[2] = '������ � ���������'; // ��� ������
$zakaz_status[3] = '������';	// ��� �������
$zakaz_status[4] = '�������/';	// ��� �������
$zakaz_status[5] = '��������';	// ��� �������
$zakaz_status[6] = '�����, �����������';  // ��� ������
$zakaz_status[7] = '��������� ������������';
$zakaz_status[8] = '������ ������';  // ��� �������
$zakaz_status[9] = '�������';
$zakaz_status[10] = '����� � ������';
$zakaz_status[11] = '�������';

$_shop_ordersinfo['best'] = <<<EOF
<script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove();
        $(".div_ord_info2").remove();		

		$('#savepasswd').bind('click',function(){
			if ( $('#newpass').val() != $('#retpass').val() ) {
				alert("����� ������ � ������������� �� ���������!");
			}
			else if ($('#newpass').val().length < 6) {
				alert("����� ������ ������ ���� ����� ����� ��������!");
			}
			else {
				$.post('/shop/setpasswd/ajax/',{   oldpass:$('#oldpass').val(),
												   newpass:$('#newpass').val(),
												   login: $('#login').val()
												 }, function(callback) {
													 	switch (callback) {
													 		case '0':
													 			alert("������ ������� �������");
													 			break;
													 		case '-2':
													 			alert("������ ������ ������. ����������, ������� �� ���� ��� ���");
													 		 	break;
													 		case '-1':
													 			alert("�� ����� �������� ������ ������. ����������, ���������� ��� ���");
													 			break;
													 	}
													 	$('#oldpass').attr('value','');
													 	$('#newpass').attr('value','');
													 	$('#retpass').attr('value','');
				});
			}
		});
    });
</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">��� ������</a></li>
		<li><a href="#tabs-2">��� ������</a></li>
		<li><a href="#tabs-3">����� ������</a></li>
		<!--<li><a href="#tabs-3">��� �����������</a></li>-->
	</ul>
<div id="tabs-1" style="text-align: center">
	<h4>������� �������</h4>
	<table align="center" style="width: 70%" id="ord_table" class="table table-striped table-hover table-bordered">
	    <thead>
	        <th>#</th>
	        <th>� ������</th>
	        <th>���� ������</th>
	        <th>����� ������</th>
	        <th>������</th>
	        <th></th>
	    </thead>
	    	<tbody>
	    	{orders_body}
	    </tbody>
	</table>
</div>
<div id="tabs-2">
    <div>
		<div id="auth">
			</form>			
			<form class="form-horizontal" id="creds_form" name="credetnial_form" method="POST" action="/shop/save_creds/">
				<!-- <div class="control-group">
						<label class="control-label" for="changePassw">������� ������</label>
						<div class="controls">
								<div class="form-inline">
									<input type="password" id="oldpass" class="input-medium" placeholder="������ ������">
									<input type="password" id="newpass"  class="input-medium" placeholder="����� ������">
									<button type="button" id="savepasswd" class="btn">���������</button>
								</div>
						</div>
				</div>-->
				<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
						<input type="text"  id="email" name="email" value="{email}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="phone">�������</label>
						<div class="controls">
						<input type="text"  id="phone" name="phone" value="{phone}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="post_index">�������� ������</label>
						<div class="controls">
						<input readonly="readonly" type="text"   id="post_index" value="{index}" name="post_index"  >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="oblast">�������</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="oblast" name="oblast" value="{oblast}">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="raion">�����</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="raion" name="raion" value="{raion}" ">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="town">�����</label>
						<div class="controls">
						<input type="text" readonly="readonly"  id="street" name="town" value="{town}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="house">����� ��������</label>
						<div class="controls">
						<input type="text"  id="house" class="input-xxlarge" name="house" value="{shipping}">
						</div>
				</div>
				<div class="control-group">
						<label class="control-label" for="c_name">����������</label>
						<div class="controls">
						<input type="text"  id="c_name" class="input-xxlarge" name="c_name" value="{client}">
						</div>
				</div>
				<div class="control-group">
						<div class="controls">
								<button type="submit" id="sbmt" class="btn" value="���������">���������</button>
						</div>
				</div>
				<!--
				E-mail: <input type="text" class="form_field" id="login" name="login" value="{email}" placeholder="�����">
				���������� �������: <input type="text" class="form_field" id="phone" name="phone" value="{phone}">
				�������� ������: <input type="text" class="form_field" id="post_index" value="{index}" name="post_index" >
				�������: <input type="text" class="form_field" id="oblast" name="oblast" value="{oblast}" >
				�����: <input type="text" class="form_field" id="raion" name="raion" value="{raion}" >
				�����: <input type="text" class="form_field" id="street" name="town" value="{town}">
				����� ��������: <input type="text"   class="form_field" id="house" name="house" value="{shipping}">
				<input type="submit" id="sbmt" value="���������">-->
			</form>
		</div>
	</div>
</div>
<div id="tabs-3">
	<form class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="login">�����</label>
			<div class="controls">
				<input class="input-medium" type="text" id="login" value="{current_login}">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="oldpass">C����� ������</label>
			<div class="controls">
				<input class="input-medium" type="password" id="oldpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="newpass">����� ������</label>
			<div class="controls">
				<input class="input-medium" type="password" id="newpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="retpass">����� ������ ��� ���</label>
			<div class="controls">
				<input class="input-medium" type="password" id="retpass">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="button" id="savepasswd" class="btn">���������</button>
			</div>
		</div>
	</form>
			
</div>

<!--<div id="tabs-3" style="text-align: center">
		<h4>������ �������� �����������</h4>
		<table align="center" style="width: 98%; font-size: 9pt; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<tr>
						<th style="width: 100px; text-align:center">���� �����������</th>
						<th style="width: 100px; text-align:center">��� �����������</th>
						<th style="width: 120px; text-align:center">��� ��������</th>
						<th style="width: 180px; text-align:center">���</th>
						<th style="width: 160px; text-align:center">����� ������</th>
						<th style="width: 160px; text-align:center">����� ����������� �������</th>
					</tr>
		</table>
</div>--> <!-- end of tabs3
EOF;


$_shop_ordersinfo['begin'] = <<<EOF
<script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove(); 
        $(".div_ord_info2").remove();
					

		$('#savepasswd').bind('click',function(){
			if ( $('#newpass').val() != $('#retpass').val() ) {
				alert("����� ������ � ������������� �� ���������!");
			}
			else if ($('#newpass').val().length < 6) {
				alert("����� ������ ������ ���� ����� ����� ��������!");
			}
			else {
				$.post('/shop/setpasswd/ajax/',{   oldpass:$('#oldpass').val(), 
												   newpass:$('#newpass').val(),
												   login: $('#login').val() 
												 }, function(callback) { 												 	
													 	switch (callback) {
													 		case '0':
													 			alert("������ ������� �������");
													 			break;
													 		case '-2':
													 			alert("������ ������ ������. ����������, ������� �� ���� ��� ���");
													 		 	break;
													 		case '-1':
													 			alert("�� ����� �������� ������ ������. ����������, ���������� ��� ���");						 			
													 			break;
													 	}
													 	$('#oldpass').attr('value','');
													 	$('#newpass').attr('value','');
													 	$('#retpass').attr('value','');
				});
			}
		});      
    });
</script>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">��� ������</a></li>
		<li><a href="#tabs-2">��� ������</a></li>
		<li><a href="#tabs-3">����� ������</a></li>
		<!--<li><a href="#tabs-3">��� �����������</a></li>-->
	</ul>
<div id="tabs-1" style="text-align: center">
	<h4>������� �������</h4>
	<table align="center" style="width: 70%" id="ord_table" class="table table-striped table-hover table-bordered">
	    <thead>
	        <th>#</th>
	        <th>� ������</th>
	        <th>���� ������</th>
	        <th>����� ������</th>
	        <th>������</th>
	        <th></th>
	    </thead>
	    	<tbody>
	    	{orders_body}
	    </tbody>
	</table>
</div>
<div id="tabs-2">
    <div>
		<div id="auth">
			</form>
			<!--<div class="alert alert-error" style="font-size:14pt">
				<h4>��������!</h4>
				�������� ����� �������� ������ ������:����� ������ ���� �������� ������� �������� ��������.<br />������������� ��� ��������� ������ ��������� ���� �� ���� �������� �������� 
                ������ ������ �� ����� ����������.
			</div> -->
			<form class="form-horizontal" id="creds_form" name="credetnial_form" method="POST" action="/shop/save_creds/">
				<!-- <div class="control-group">
						<label class="control-label" for="changePassw">������� ������</label>
						<div class="controls">							
								<div class="form-inline">
									<input type="password" id="oldpass" class="input-medium" placeholder="������ ������">
									<input type="password" id="newpass"  class="input-medium" placeholder="����� ������">									
									<button type="button" id="savepasswd" class="btn">���������</button>
								</div>						
						</div>
				</div>-->				 
				<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
						<input type="text"  id="email" name="email" value="{email}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="phone">�������</label>
						<div class="controls">
						<input type="text"  id="phone" name="phone" value="{phone}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="post_index">�������� ������</label>
						<div class="controls">
						<input readonly="readonly" type="text"   id="post_index" value="{index}" name="post_index"  >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="oblast">�������</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="oblast" name="oblast" value="{oblast}">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="raion">�����</label>
						<div class="controls">
						<input type="text" readonly="readonly" id="raion" name="raion" value="{raion}" ">
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="town">�����</label>
						<div class="controls">
						<input type="text" readonly="readonly"  id="street" name="town" value="{town}" >
						</div>
				</div>
				 <div class="control-group">
						<label class="control-label" for="house">����� ��������</label>
						<div class="controls">
						<input type="text"  id="house" class="input-xxlarge" name="house" value="{shipping}">
						</div>
				</div>
				<div class="control-group">
						<label class="control-label" for="c_name">����������</label>
						<div class="controls">
						<input type="text"  id="c_name" class="input-xxlarge" name="c_name" value="{client}">
						</div>
				</div>
				<div class="control-group">						
						<div class="controls">
								<button type="submit" id="sbmt" class="btn" value="���������">���������</button>
						</div>
				</div>
				<!--
				E-mail: <input type="text" class="form_field" id="login" name="login" value="{email}" placeholder="�����"> 
				���������� �������: <input type="text" class="form_field" id="phone" name="phone" value="{phone}">
				�������� ������: <input type="text" class="form_field" id="post_index" value="{index}" name="post_index" >	
				�������: <input type="text" class="form_field" id="oblast" name="oblast" value="{oblast}" >	
				�����: <input type="text" class="form_field" id="raion" name="raion" value="{raion}" >	
				�����: <input type="text" class="form_field" id="street" name="town" value="{town}">					
				����� ��������: <input type="text"   class="form_field" id="house" name="house" value="{shipping}">							
				<input type="submit" id="sbmt" value="���������">-->
			</form>
		</div>
	</div>	
</div> 
<div id="tabs-3">
	<form class="form-horizontal">
		<div class="control-group">
			<label class="control-label" for="login">�����</label>
			<div class="controls">
				<input class="input-medium" type="text" id="login" value="{current_login}">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="oldpass">C����� ������</label>
			<div class="controls">
				<input class="input-medium" type="password" id="oldpass">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="newpass">����� ������</label>
			<div class="controls">
				<input class="input-medium" type="password" id="newpass">			
			</div>		
		</div>
		<div class="control-group">
			<label class="control-label" for="retpass">����� ������ ��� ���</label>
			<div class="controls">
				<input class="input-medium" type="password" id="retpass">			
			</div>		
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="button" id="savepasswd" class="btn">���������</button>
			</div>
		</div>
	</form>
				 
</div>

<!--<div id="tabs-3" style="text-align: center">	
		<h4>������ �������� �����������</h4>
		<table align="center" style="width: 98%; font-size: 9pt; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<tr>						
						<th style="width: 100px; text-align:center">���� �����������</th>
						<th style="width: 100px; text-align:center">��� �����������</th>
						<th style="width: 120px; text-align:center">��� ��������</th>				
						<th style="width: 180px; text-align:center">���</th>				
						<th style="width: 160px; text-align:center">����� ������</th>	
						<th style="width: 160px; text-align:center">����� ����������� �������</th>										
					</tr>
		</table>	
</div>--> <!-- end of tabs3 
EOF;


$_shop_ordersinfo['already_paid'] = "<tr><td colspan=5><p>�������� ������� ������ ��� ��������</p></td></tr>";

$_shop_ordersinfo['payment_rejected'] = "<tr><td colspan=5><p>�� ���������� �� ������ �������� ����� ������</p></td></tr>";

$_shop_ordersinfo['transaction_active'] = "<tr><td colspan=5><p>������������ �������� ������. �������� ������ �������� ����������</p></td></tr>";

$_shop_ordersinfo['payment_custom_notify'] = "<tr><td colspan=5><p>{custom_message}</p></td></tr>";


$_shop_ordersinfo['not_paid'] = <<<EOF
<script type="text/javascript">
	function goToPayment() {
		var selectedVal = $("#dost_cost$c").attr('value');			
		if ( ($("#dost_cost$c").val() != "") || (typeof($("#dost_cost$c").val()) != 'undefined') ) {
			window.location.href="/shop/confirm/{order_db_id}/"; 
		}
		else alert("�� ������ ������ ��������!");
	}

	function cancelPayment() {
		if (confirm("��������:� ���������� �� �� ������� �������� ���� �����! �� ������������� ������������� ����� �� �������� ������� ������?")) {
			window.location.href="/shop/orderdel/{order_db_id}/";
		}
	}
</script>

<tr id="act_buttons">
	<td colspan=3><p style="margin-left: 3px" class="text-info">����� � ������: <strong><span id="dost_cost{count}">�������� ������� ��������</span></strong></p>
		<input id="dost_cost_inp{count}" type="hidden" value=""/> 
		<button onClick='goToPayment()'   class="btn btn-success">�������� ��������</button>
		<button onClick='cancelPayment()' class="btn btn-danger">���������� �� ��������</button>
	</td>
</tr>					
EOF;

$_shop_ordersinfo['body_best'] = <<<EOF
<script type="text/javascript">
	$(document).ready(function () {

		$("#btndel-{count}").bind('click',function(){
			if (confirm("�� ������������� ������ ������� ��� �����? �������� ������ �������� ����� ����������")) {
				var order_id={order_id};
				alert(order_id);
				$.post('/shop/ordelete/ajax',{order:order_id},function(data){
					if (data=='1')						
						window.location.href="/shop/ordersinfo/";
					else {
						alert("��������� ������ ��� �������� ������.");											
					}
				});				
			} 			
		});

		$("#btn-{count}").bind('click',function(){
		        	$("#dialog-{count}").dialog({
		            modal: true,
		            width: 1000,
		            height: 'auto'
		        	});
					$('.ui-dialog-titlebar-close').css('float','right');
		        });

				$("#span_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });

				$("#button_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });
		
				/*var order='{order_no}';
				$('input[tag="i-{count}"]').bind('click',function(){
					var cost = $(this).attr('value');
					var idDost = $(this).attr('dtype');
					$('#dost_cost').empty().html(cost + ' ���.').attr('value',cost);
					$.post('/shop/updatesumm/ajax/',{order:order, summ:cost, dost:idDost});
				});*/
	});
</script>
<tr>
	<td>{count}</td>
	<td>{order_id}</td>
	<td>{order_time}</td>
	<td>{total} ���.</td>	
	<td>{item_status}</td>
	<td style="width: 90px">
		<button type="button" id="btn-{count}" class="btn btn-info btn-mini">���������...</button>
		<div id="dialog-{count}" style="display: none" title="����������� �� ������">
	    	<!-- ORDER DETAILS -->
		    	<div style="width: 1000px; height:auto; min-height: 370px">
		    	<h3 style="margin-left: 10px">������ ������ � {order_no}: </h3>
		    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
					<thead>
					<tr>
						<th align="center"><b>���</b></th>
						<th>��������</th>
						<th align="center"><b>����</b></th>
						<th align="center"><b>���-��</b></th>
						<th align="center"><b>�����</b></th>
						<th align="right"><b>������</b></th>
						<th align="center"><b>C�����</b></th>
						<th align="center"><b>��������.</b></th>
						<th align="center"><b>�����</b></th>
					</tr>
					<thead
>					<tbody>
						{items}
					</tbody>
				</table>
				<div style="margin-left: 10px">				
					<p>������������������ ����������: <strong>{prepay_announced} �.</strong></p>
					<p>��������� ����������: <strong>{prepay_charged} �.</strong> </p>				
					<p>��������������� ������: <strong>{discount} �.</strong></p>					
					<p>��������� ������������: <strong>{packing} �.</strong></p>
					<h2>�����: <strong>{total} �.</strong></h2>
					{pay_btn}
				<div>

		
				<!--<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<thead>
						<th style="width: 220px">������ ��������</th>
						<th style="width: 100px">���� ��������</th>
						<th style="width: 100px">���������</th>
						<th style="width: 60px">�����</th>
						<th style="width: auto">����������� � ������</th>
					</thead>
					<tbody>
						{delivery_options}
						{delivery_controls}
					</tbody>
				</table>-->
				</div>
			<!-- END OF ORDER DETAILS -->
		</div>
	</td>
	<!--<td style="width: 50px">
		<button type="button" id="btndel-{count}" class="btn btn-danger btn-mini">�������...</button>
	</td>-->
</tr>
EOF;



$_shop_ordersinfo['body'] = <<<EOF
<script type="text/javascript">
	$(document).ready(function () {
		$("#btn-{count}").bind('click',function(){
		        	$("#dialog-{count}").dialog({
		            modal: true,       
		            width: 1000,    
		            height: 'auto'                         
		        	});
					$('.ui-dialog-titlebar-close').css('float','right');
		        });

				$("#span_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });

				$("#button_{order_id}").click(function(){
			        $("#div_{order_id}").slideToggle("fast");
			        $(this).toggleClass("active");
			    });	  

				/*var order='{order_no}';  
				$('input[tag="i-{count}"]').bind('click',function(){
					var cost = $(this).attr('value');			
					var idDost = $(this).attr('dtype');
					$('#dost_cost').empty().html(cost + ' ���.').attr('value',cost);
					$.post('/shop/updatesumm/ajax/',{order:order, summ:cost, dost:idDost});
				});*/
	});
</script>
<tr>
	<td>{count}</td>
	<td>{order_id}</td>
	<td>{order_time}</td>
	<td>{total} ���.</td>
	<td>{item_status}</td>
	<td style="width: 90px">
		<button type="button" id="btn-{count}" class="btn btn-info btn-mini">���������...</button>
		<div id="dialog-{count}" style="display: none" title="����������� �� ������">    
	    	<!-- ORDER DETAILS -->
		    	<div style="width: 1000px; min-height: 500px">
		    	<h3 style="margin-left: 10px">������ ������ � {n_zakaz}: </h3>
		    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
					<thead>
					<tr>
						<th align="center"><b>���</b></th>
						<th>��������</th>
						<th align="center"><b>����</b></th>
						<th align="center"><b>���-��</b></th>
						<th align="center"><b>�����</b></th>
						<th align="right"><b>������</b></th>
						<th align="center"><b>C�����</b></th>
						<th align="center"><b>��������.</b></th>
						<th align="center"><b>�����</b></th>				
					</tr>
					<thead>
					<tbody>
						{items}
					</tbody>
				</table>
				<h3 style="margin-left: 10px">�������� ������ �������� ������: </h3>		
				<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
					<thead>
						<th style="width: 220px">������ ��������</th>
						<th style="width: 100px">���� ��������</th>
						<th style="width: 100px">���������</th>
						<th style="width: 60px">�����</th>	
						<th style="width: auto">����������� � ������</th>				
					</thead>
					<tbody>						
						{delivery_options}						
						{delivery_controls}
					</tbody>				
				</table>			
				</div>
			<!-- END OF ORDER DETAILS -->		
		</div>
	</td>
</tr>
EOF;


$_shop_ordersinfo['item'] = <<<EOF
EOF;


$_shop_ordersinfo['old_begin'] = '<h3>������� �������</h3><ol>';

$_shop_ordersinfo['old_item'] = <<<EOF
    <p>
	    <li type="1"><span style="font-size:14;cursor:hand; cursor:pointer;color:blue;" id="span_{order_id}"><b>����� �{order_id} �� {order_time} �� ����� {total} ���.</b></span><input id="button_{order_id}" type="button" value="���������"><br>
		    <div class="div_ord_info2">
		    ������: <b>{item_status}</b>&nbsp{pay_link}<br>
		    - ������������������ ���������� = {predoplata} ���.<br>
		    - �������� ���������� � ������� {predoplata_fact} ���.
		    </div>
	    </li>
	</p>
<div id="div_{order_id}" style="display: none;">
<div id="div_ord_info">����� �� {order_time} �� ����� {total} ���. � ������ ���������� ({predoplata})<br>
- ������������������ ���������� = {predoplata} ���.<br>
- �������� ���������� � ������� {predoplata_fact} ���.<br>
+ �������� ������� �� ��������� ������ ������ (������� �������� �������� ����� �� ����� �� ����� ����������) 
</div>
<table class="ordertable" cellspacing=0 cellpadding=4 border=1 width=98% style="border-collapse:collapse;" rules=rows bordercolor="#A7A6AA">
		<tr>
			<td align="center"><b>���</b></td>
			<td><b>��������</b></td>
			<td align="center"><b>����</b></td>
			<td align="center"><b>����������</b></td>
			<td align="center"><b>�����</b></td>
			<td align="right"><b>������</b></td>
			<td align="center"><b>C�����</b></td>
			<td align="center"><b>������������</b></td>
			<td align="center"><b>����� �� �������</b></td>
			<td></td>
		</tr>
		{items}
	</table>
<br>
{total_part}
</div>
<script>
$("#span_{order_id}").click(function(){
        $("#div_{order_id}").slideToggle("fast");
        $(this).toggleClass("active");
    });
$("#button_{order_id}").click(function(){
        $("#div_{order_id}").slideToggle("fast");
        $(this).toggleClass("active");
    });

$(function(){
	$('#tabs>ul').remove();
});
</script>
EOF;

$_shop_ordersinfo1['item'] = <<<EOF
		<tr>
			<td>{count}</td>
			<td>{order_id}</td>
			<td>{order_time}</td>
			<td>{total} ���.</td>
			<td>{item_status}</td>
			<td style="width: 90px">
				<button type="button" id="btn-{count}" class="btn btn-info btn-mini">���������...</button>
			</td>
		</tr>
	<!--	{tab_terminator}
	</div>   <!-- /tabs-1 -->
    
    </div>     
    <div id="dialog-{count}" style="display: none" title="����������� �� ������">    
    	<!-- ORDER DETAILS -->
	    	<div style="width: 1000px; min-height: 500px">
	    	<h3 style="margin-left: 10px">������ ������: </h3>
	    	<table align="center" style="width: 990px; font-size: 9pt" id="ord_details" class="table table-striped table-hover table-bordered">
				<thead>
				<tr>
					<th align="center"><b>���</b></th>
					<th>��������</th>
					<th align="center"><b>����</b></th>
					<th align="center"><b>���-��</b></th>
					<th align="center"><b>�����</b></th>
					<th align="right"><b>������</b></th>
					<th align="center"><b>C�����</b></th>
					<th align="center"><b>��������.</b></th>
					<th align="center"><b>�����</b></th>				
				</tr>
				<thead>
				<tbody>
					{items}
				</tbody>
			</table>
			<h3 style="margin-left: 10px">�������� ������ �������� ������: </h3>		
			<table align="center" style="width: 98%; font-size: 9pt"; margin-left: 10px; font-size: 9pt" id="shipper_details" class="table table-striped table-bordered">
				<thead>
					<th style="width: 220px">������ ��������</th>
					<th style="width: 100px">���� ��������</th>
					<th style="width: 100px">���������</th>
					<th style="width: 60px">�����</th>	
					<th style="width: auto">����������� � ������</th>				
				</thead>
				<tbody>
					{delivery_options}
					<tr>
						<td colspan=3><p style="margin-left: 3px" class="text-info">����� � ������: <strong><span id="dost_cost">{dost_cost}</span></strong></p>
						<!-- <button onClick='if ($("#dost_cost").val() != "") window.location.href="/shop/confirm/{order_db_id}/"; else alert("�� ������ ������ ��������!")' class="btn btn-success">�������� ��������</button> -->
						<button onClick='window.location.href="/shop/orderdel/{order_db_id}/"' class="btn btn-danger">���������� �� ��������</button></td>
					</tr>					
				</tbody>				
			</table>			
			</div>
		<!-- END OF ORDER DETAILS -->		
	</div> -->

    <script type="text/javascript">
    $(document).ready(function () {
        $("#tabs").tabs();
        $("#div_ord_info").remove(); 
        $(".div_ord_info2").remove();
		//$("#company_logo").attr("src","/i/logo_temp.png");
		//$("#verski").remove();
		$(".number").empty().html("640 5771");	

        $("#btn-{count}").bind('click',function(){
        	$("#dialog-{count}").dialog({
            modal: true,       
            width: 1000,    
            height: 'auto'                         
        	});
			$('.ui-dialog-titlebar-close').css('float','right');
        });

		$("#span_{order_id}").click(function(){
	        $("#div_{order_id}").slideToggle("fast");
	        $(this).toggleClass("active");
	    });

		$("#button_{order_id}").click(function(){
	        $("#div_{order_id}").slideToggle("fast");
	        $(this).toggleClass("active");
	    });	  

		var order='{order_no}';  
		$('input[tag="i-{count}"]').bind('click',function(){
			var cost = $(this).attr('value');			
			$('#dost_cost').empty().html(cost).attr('value',cost);
			$.post('/shop/updatesumm/ajax/',{order:order, summ:cost});
		});
    });
    </script>
EOF;

$_shop_ordersinfo['total_part'] = <<<EOF
- ��������������� ������ = {skidka} ���.<br>
- ��������� ������������ = {komplekt} ���.<br>
- ����� = {z_sum} ���.<br>
EOF
; 

$_shop_ordersinfo['good_new_ogld'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td colspan=3>&nbsp</td>	
</tr>
EOF;

$_shop_ordersinfo['good_new_best'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td align="center">{skidka_sum}</td>
	<td align="center">{compl_sum}</td>
	<td align="center">{z_sum}</td>
</tr>
EOF;

$_shop_ordersinfo['good_new'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td colspan=3>&nbsp</td>
	<td><a href="/shop/cancelitem/{item_id}/" onClick="if (confirm('�� �������, ��� ������ ���������� �� ���� �������?')) return true; else return false;">����������</a></td>
</tr>
EOF;

$_shop_ordersinfo['good'] = <<<EOF
<tr>
	<td align="center">{lot_id}</td>
	<td>{title}</td>
	<td align="center">{kat_price}</td>
	<td align="center">{lot_count}</td>
	<td align="center">{total}</td>
	<td align="right">{zakaz_status}</td>
	<td align="center">{skidka_sum}</td>
	<td align="center">{compl_sum}</td>
	<td align="center">{z_sum}</td>
	<td></td>
</tr>
EOF;


$_shop_ordersinfo['empty'] = <<<EOF
<b>� ��������� �� ��� ������ �� ����������</b>
EOF;


#---------------------------------------------------------------------------------------------------
# �����: ������ � ������������ ������� ������������
#---------------------------------------------------------------------------------------------------




#---------------------------------------------------------------------------------------------------
# ������ � ������� ������������� �������
#---------------------------------------------------------------------------------------------------

# ������������� ������
$_shop_attend['begin'] = <<<EOF
<p><b>C  ���� ������� ���� ����� ����������</b></p>
<ul>
EOF;

// <DIV style="FLOAT: left; MARGIN: 0px 10px 10px 0px;"><a href="{ALIAS}"><img src="{PHOTO_THUMB}" style="border:2px solid #336699;"><center>{TITLE}</center></a></div>
$_shop_attend['item'] = <<<EOF
<li>
<a href="{ALIAS}">{TITLE}</a>
</li>
EOF;

$_shop_attend['end'] = <<<EOF
</ul>
EOF;

#---------------------------------------------------------------------------------------------------
# �����: ������ � ������� ������������� �������
#---------------------------------------------------------------------------------------------------


// ��� ������, ���������� ����� ����������� ��� ����������� �� �������
$_shop_form_after_auth = <<<EOF
<form method="post" action="/shop/orderdo/">
<input type="hidden" name="first_buy" value="no">
����������� � ������:<br>
<textarea style="width:300px;" id="comment" name="comment"></textarea><br>
<input value="�������� �����" type="submit" onClick="$('#cartform').attr('action', '/shop/orderdo/ajax/');">
</form> 
<a href="/shop/cart/">��������� � �������</a>
EOF;
?>
