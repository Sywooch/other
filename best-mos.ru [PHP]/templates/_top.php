<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">

<html>
<head>
<title><?=$title?></title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<meta name='yandex-verification' content='45065f221f8651e0' />
<link href="/templates/_se3.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/templates/fancy.css" />
<link rel="stylesheet" type="text/css" href="/templates/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/templates/client_form2.css" />
<script type="text/javascript" src="/templates/jquery.js"></script>
<script type="text/javascript" src="/templates/jquery.treeview.js"></script>
<script type="text/javascript" src="/templates/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.9.1.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
	$.noConflict();
</script>

<script type="text/javascript" src="/templates/se_func.js"></script>
</head>

<body style="background:url(/i/bg_grin2.jpg) repeat-x left; background-position:0 105px;">
<div style="position:absolute; z-index:20; top:110px; left:3px;"><img src="/i/plet_l.png" /></div>
<!-- <div style="position:absolute; z-index:25; top:110px; right:3px;"><img src="/i/plet_r.png" /></div>-->

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="background:url(/i/plet_r.png) no-repeat right; background-position:100% 110px; margin-right:3px;">

<!-- Разметка сайта -->
<tr valign="top">
<td width="5%" height="18"><table width="20" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td width="12%"><table width="220" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td width="72%"><table width="540" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td width="8%"><table width="160" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td width="3%"><table width="18" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
</tr>
<!-- Разметка сайта -->

<!-- Верхняя часть сайта -->
<tr valign="top" style="background: url(/i/bg_top.gif) repeat-x left bottom;">
<td ><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td colspan="2">

	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr valign="top">
	<td width="5%">
		
		<table border="0" cellpadding="0" cellspacing="0" width="100"><tr><td height="1"></td></tr></table>
		<!-- Логотип -->
		<a href="/"><img id="company_logo" border="0" src="/i/logo.gif" alt="Логотип компании Бест"></a>
		<!-- Логотип -->
	
	</td>
	<td width="1%"><table width="10" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td>
	
		<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background: url(/i/planka1.gif) repeat-x left top;">
		<tr valign="top">
		<td>
			
			<!-- Корзина и Форма входа -->
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr valign="center">
			<td width="1%" height="35" style="background: url(/i/planka1_left.gif) no-repeat left top;"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			<td width="28%">
			
				<!-- Вход в корзину -->
					<div class="basket_ico"><div id="basket_val"><?=$shop_vars['cart']?></div></div>
				<!-- Вход в корзину -->
			
			</td>
			<td width="2%" height="35" style="background: url(/i/planka1_center.gif) no-repeat center top;"><table width="26" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			<td width="68%">
			
				<!-- Форма входа-->
<?=$login_panel?>
				<!-- Форма входа-->
			
			</td>
			<td width="1%" height="35" style="background: url(/i/planka1_right.gif) no-repeat right top;"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
			</tr>
			</table>
			<!-- Корзина и Форма входа -->
		
		</td>
		</tr>
		</table>
	
		<table border="0" cellpadding="0" cellspacing="0"><tr><td height="21"></td></tr></table>
	
		<!-- Главное меню -->
<?=menu('static')?>
		<!-- Главное меню -->
	
	</td>
	</tr>
	</table>

</td>
<td>

	<!-- icons -->
	<div id="icons" align="right">
		<table height="13" width="70%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td height="15" width="25%"><table width="32" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
		<td width="50%"><table width="58" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
		<td width="25%"><table width="32" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
		</tr>
		<tr valign="bottom">
		<td align="center"><a href="/sitemap/"><img width=18 height=14 border="0" src="/i/imap.gif" alt="Карта сайта"></a></td>
		<td align="center"><a href="mailto:zakaz@best-mos.ru"><img width=18 height=14 border="0" name="imail" src="/i/imail.gif" alt="Написать письмо"></a></td>
		<td align="center"><a href="/"><img width=18 height=14 border="0" src="/i/ihome.gif" alt="На главную"></a></td>
		</tr>
		</table>
	</div>
	<!-- Icons -->
	
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="32"></td></tr></table>
		
	<!-- Contacts -->
	<div id="phone" align="right">
	<table border=0 cellpadding=0 cellspacing=0>
	<tr valign="top">
	<td style="padding: 8px 4px 0px 0px;" align="right"><div class="code">(495)</div></td>
	<td><div class="number"><span id="ya-phone-1">640-2-641</span></div></td>
	</tr>
	</table>
	</div>
	<!-- Contacts -->

</td>
<td></td>
</tr>

<tr valign="top">
<td colspan="5" height="20"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
</tr>

<tr valign="top">
<td ><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
<td style="background: url(/i/bg_orange_dot.gif) repeat-y right top;">

	<table width="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr>
	<td width="1%" height="11"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td width="98%"></td>
	<td width="1%" style="background: url(/i/corner_1_rt.gif) no-repeat right top;"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	</tr>
	
	<tr bgcolor="#FFFFFF">
	<td height="12" style="background:#FFFFFF url(/i/corner_1_lt.gif) no-repeat left top;"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td colspan="2" style="background:#FFFFFF url(/i/bg_orange_dot.gif) repeat-x left top;"></td>
	</tr>
	
	<tr valign="top" bgcolor="#FFFFFF">
	<td style="background:#FFFFFF  url(/i/bg_orange_dot.gif) repeat-y left top;"></td>
	<td>
		<!-- Catalog menu -->
		<h2>Каталог</h2>
		<div id="ex2" style="display:none;">
			<?=$catalog_tree?>
		</div>
		<!-- Catalog menu -->
		<br>
		<!-- Catalog menu -->
		<h2>Архив каталогов</h2>
		<div id="ex3"  style="display:none;">
			<?=$catalog_tree_archive?>
		</div>
		<!-- Catalog menu -->
	</td>
	<td></td>
	</tr>
	
	<tr bgcolor="#FFFFFF">
	<td height="12" style="background:#FFFFFF  url(/i/corner_1_lb.gif) no-repeat left top;"><table border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td colspan="2" style="background:#FFFFFF  url(/i/bg_orange_dot.gif) repeat-x left bottom;"></td>
	</tr>
	</table>
	
	
	<!-- ******************************* -->

		
	<!-- вершки и корешки-->
    <div id="verski">
    	<table  border="0" cellpadding="0" cellspacing="0"><tr><td height="20"></td></tr></table>
        	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-right:#ff8a00 1px solid;">
        	<tr>
        	<td  valign="top"  style="background:url(/i/banner.jpg) left no-repeat;">
        		<a href="http://lllll.ru/"  target="_blank"><img src="/i/pic.gif" width="200" height="103" alt="Вершки и корешки - садово-огородный рай" title="Вершки и корешки - садово-огородный рай"  /></a>
        	</td>
        	</tr>
    	</table>
    </div>
    <!-- ******************************* -->
	
<? if ($news_last_onmain != '') { ?>	
	
	<!-- Форма Новости -->
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="20"></td></tr></table>
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td width="1%" height="1" style="background: url(/i/corner_3_t.gif) no-repeat left top;"><table width="15" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td width="99%" style="background: url(/i/bg_orange_dot.gif) repeat-x left top;"></td>
	</tr>
	
	<tr>
	<td height="12" style="background: url(/i/corner_3_lt.gif) no-repeat left top;"></td>
	<td colspan style="background: url(/i/corner_3_bg.gif) repeat-y right top;"></td>
	</tr>
	
	<tr>
	<td style="background:#FFFFFF  url(/i/bg_orange_dot.gif) repeat-y left top;"></td>
	<td colspan style="background:#FFFFFF  url(/i/corner_3_bg.gif) repeat-y right top; padding-right:12px;">
	
		<!--   -->  
		<?=$news_last_onmain?>
		<!--   -->
			
	</td>
	</tr>
	
	<tr>
	<td height="12" style="background: url(/i/corner_3_lb.gif) no-repeat left top;"></td>
	<td colspan style="background: url(/i/corner_3_bg.gif) repeat-y right top;"></td>
	</tr>
	
	<tr>
	<td height="1" style="background: url(/i/corner_3_t.gif) no-repeat left top;"></td>
	<td colspan style="background: url(/i/bg_orange_dot.gif) repeat-x left top;"></td>
	</tr>
	
	</table>
	
<?}?>	

	
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="20"></td></tr></table>
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td width="1%" height="11"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td width="98%">
		<!-- ********************* Место под банеры ********************* -->
	</td>
	<td width="1%"><table width="12" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	</tr>
	</table>

</td>
<td colspan style="background:#FFFFFF url(/i/bg_orange_dot.gif) repeat-y right top;">

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td width="1%" height="11" style="background: url(/i/corner_2_t.gif) no-repeat right top;"><table width="16" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td width="98%" style="background: url(/i/bg_orange_dot.gif) repeat-x left top;"><table width="16" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	<td width="1%" style="background: url(/i/corner_2_rt.gif) no-repeat right top;"><table width="16" border="0" cellpadding="0" cellspacing="0"><tr><td></td></tr></table></td>
	</tr>
	
	<tr valign="top">
	<td></td>
	<td>