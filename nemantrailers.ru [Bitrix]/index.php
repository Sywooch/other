<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "����������, ������������, ��������, �������");
$APPLICATION->SetTitle("Neman - ����������� ��� ������");
?><!--if lt IE 8
  p.error-browser
      | ��� �������&nbsp;
      em �������!&nbsp;
      a(href="http://browsehappy.com/") �������� ����� ������ �������� �����&nbsp;
      | ��� ����������� ����������� �����.
  --> <button class="button-aside"> </button>
<div class="header animated bounceInDown b2-anim-1">
	<div class="wrap">
		<div class="B B_logo">
 <img src="/bitrix/templates/neman/img/logo.png">
			<p class="slogan">
				 ����������� ��� ������
			</p>
		</div>
		<div class="B">
			<div class="contacts">
				<p>
					 ��������� �� ���� ��������� ��
				</p>
				<div class="phone">
					 <?=ins('include/phone.php')?>
				</div>
			</div>
 <a href="#zvanok" class="BTN BTN_sm ICN"><img src="/bitrix/templates/neman/img/icons/phone-back.png"><span>�������� <br>
			 ������</span></a>
		</div>
	</div>
</div>
 <aside class="column as-col animated bounceInRight b2-anim-2">
<div class="ins">
	<div>
		<div class="B B_logo">
 <a href="#"><img src="/bitrix/templates/neman/img/logo-small.png"></a>
		</div>
		<div class="contacts">
			<div class="phone">
				 <?=ins('include/phone.php')?>
			</div>
			<p>
				 <?=ins('include/text2.php')?>
			</p>
		</div>
		<li data-menuanchor="contacts" class="contacts-link" style="list-style:none;margin:0px padding:0px;"><a href="#contacts" id="cont" class="BTN BTN_xs">��������</a></li>
	</div>
 <nav>
	<ul id="menu" class="M M_vt">
		<li data-menuanchor="main" class="companylink"><a href="#main">�������</a> </li>
		<li data-menuanchor="company" class="companylink"><a href="#company">��������</a> </li>
		<li class="parent" data-menuanchor="products"><a href="#products/0">���������</a>
		<?=get_product_menus();?> </li>
		<li data-menuanchor="clients" class="clients-link"><a href="#clients">�������</a> </li>
		<li data-menuanchor="services" class="services-link"><a href="#services">������</a> </li>
		<li data-menuanchor="contacts" class="contacts-link"><a href="#contacts">��������</a> </li>
	</ul>
 </nav>
</div>
 </aside>
<div id="fullPage" style="padding-top:20px;">
 <section id="idMain" class="section mainslide">
	<?=get_main_bg();?>
	<div class="intro intro_footer">
		 <?=get_product_gl();?>
	</div>
 </section> <section id="idCompany" style="background-image: url(/bitrix/templates/neman/img/content/company/page-bg.jpg)" class="section companilide">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-1">
				<h1 class="TL ">� ��������</h1>
			</div>
			<div class="BG info-comp">
				<p>
					 <?=ins('include/text1.php')?>
				</p>
			</div>
			<div class="BG BG_wide BG_wide-2 ">
				<h2 class="TL">������������ <em>Neman</em> </h2>
			</div>
			 <?=get_prim();?>
		</div>
	</div>
 </section>
	<?=get_product();?> <section id="idClients" style="background-image: url(/bitrix/templates/neman/img/content/clients/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-3">
				<h1 class="TL">���� �������</h1>
			</div>
			 <?=get_klient();?>
			<div class="BG BG_wide BG_wide-4">
				<h2 class="TL">������ ����� ��������</h2>
			</div>
			 <?=get_rev();?>
		</div>
	</div>
 </section> <section id="idServices" style="background-image: url(/bitrix/templates/neman/img/content/services/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-5">
				<h1 class="TL">������</h1>
			</div>
			 <?=get_servis();?>
		</div>
	</div>
 </section> <section id="idContacts" style="background-image: url(/bitrix/templates/neman/img/content/contacts/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-6 ">
				<h1 class="TL">�������� ������������ � ����������������</h1>
			</div>
			<div class="W W_map">
				<div class="B B_map">
 <img src="/bitrix/templates/neman/img/content/contacts/map.png" alt=""> <span class="dots moskva"></span> <span class="dots peterburg"></span> <span class="dots chelab"></span> <span class="dots krasnodar"></span>
				</div>
				<div class="B kaliningrad">
 <strong class="TL BTN">�����������</strong>
					<?=ins('include/text3.php')?>
				</div>
			</div>
			<div class="W W_accordion">
				<div class="header-acord">
 <strong class="TL">�����������������:</strong>
					<div class="contacts">
						<p>
							 ��������� �� ���� ������
						</p>
						<div class="phone">
							 8 800 333 55 39
						</div>
					</div>
				</div>
				<div class="B accordeon-item moskva-item">
					<div class="acord-item">
 <strong class="_right">+7 (495) 928-35-33 <span class="arrow-flag accordeon-trigger trigger-1"></span></strong><strong class="TL BTN accordeon-trigger trigger-1">������</strong><span class="adrres">��, �. �����, �� ��������� �������� 11</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">����� �������</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">�����������</a>
						</div>
						 ����� ������: � 9:00 �� 18:00
					</div>
				</div>
				<div class="B accordeon-item peterburg-item">
					<div class="acord-item">
 <strong class="_right">+7 (812) 924-17-55<span class="arrow-flag accordeon-trigger trigger-2"></span></strong><strong class="TL BTN accordeon-trigger trigger-2">�����-���������</strong><span class="adrres">������������ ��������, �. 150/2, ��. �-301</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">����� �������</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">�����������</a>
						</div>
						 ����� ������: � 9:00 �� 18:00
					</div>
				</div>
				<div class="B accordeon-item krasnodar-item">
					<div class="acord-item">
 <strong class="_right">+7 (861) 244-55-70<span class="arrow-flag accordeon-trigger trigger-3"></span></strong><strong class="TL BTN accordeon-trigger trigger-3">���������</strong><span class="adrres">������� �����, ��������������� �/�, ��������</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">����� �������</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">�����������</a>
						</div>
						 ����� ������: � 9:00 �� 18:00
					</div>
				</div>
				<div class="B accordeon-item chelab-item">
					<div class="acord-item">
 <strong class="_right">+7 (351) 224-72-25<span class="arrow-flag accordeon-trigger trigger-4"></span></strong><strong class="TL BTN accordeon-trigger trigger-4">���������</strong><span class="adrres">��. ������� �. 1�</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">����� �������</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">�����������</a>
						</div>
						 ����� ������: � 9:00 �� 18:00
					</div>
				</div>
			</div>
		</div>
	</div>
 </section>
</div>
<div class="footer animated bounceInUp b2-anim-3">
	<div class="wrap">
		<form class="form" id="callback">
			<div class="R">
				<div class="B">
 <strong class="TL">�������� ������</strong>
				</div>
				<div class="B">
 <input id="name" name="name" type="text" placeholder="���� ���" class="required">
				</div>
				<div class="B">
<!--
 <input id="type" name="type" type="text" placeholder="��� �������" class="required">
-->
<select class="type" id="type" name="type">
<option disabled>��� �������</option>
<option value="������������ ����������">������������ ����������</option>
<option value="�������� ����������">�������� ����������</option>
<option value="������� ����������">������� ����������</option>
<option value="������ � ��������">������ � ��������</option>
<option value="������">������</option>
</select>

				</div>
				<div class="B">
 <input id="phone" name="phone" type="text" placeholder="�������" class="required">
				</div>
				<div class="B">
 <input id="" name="" type="submit" value="���������" class="BTN BTN_md">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="zayavka-prinata" id="zayavka">
	<div class="wrapper-z">
		<div class="left form-z">
 <img src="/bitrix/templates/neman/img/icons/check.png" alt="">
		</div>
		<div class="right form-z">
			<h5>������ �������, �������</h5>
			<p>
				 ���� ��������� ����� ���...
			</p>
 <span class="close"> <img src="/bitrix/templates/neman/img/icons/close.png" alt=""> </span>
		</div>
	</div>
</div>
<div class="gen_zvanok" id="zvanok">
	<div class="content_for">
		<h3 class="zvanok_title">�������� �������� ������</h3>
		<table cellpadding="0" cellspacing="0" width="300px;">
		<tbody>
		<tr>
			<td>
 <input type="text" id="names" placeholder="���� ���">
			</td>
		</tr>
		<tr>
			<td>
 <input type="text" id="phoness" placeholder="��� ����� ��������">
			</td>
		</tr>
		<tr>
			<td>
				<div class="B">
 <input class="sends" name="" type="submit" value="���������">
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>