<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "полуприцеп, самосвальный, бортовой, шторный");
$APPLICATION->SetTitle("Neman - полуприцепы для России");
?><!--if lt IE 8
  p.error-browser
      | Ваш браузер&nbsp;
      em устарел!&nbsp;
      a(href="http://browsehappy.com/") Выберите новую версию браузера здесь&nbsp;
      | для правильного отображения сайта.
  --> <button class="button-aside"> </button>
<div class="header animated bounceInDown b2-anim-1">
	<div class="wrap">
		<div class="B B_logo">
 <img src="/bitrix/templates/neman/img/logo.png">
			<p class="slogan">
				 полуприцепы для России
			</p>
		</div>
		<div class="B">
			<div class="contacts">
				<p>
					 Бесплатно со всех телефонов РФ
				</p>
				<div class="phone">
					 <?=ins('include/phone.php')?>
				</div>
			</div>
 <a href="#zvanok" class="BTN BTN_sm ICN"><img src="/bitrix/templates/neman/img/icons/phone-back.png"><span>Обратный <br>
			 звонок</span></a>
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
		<li data-menuanchor="contacts" class="contacts-link" style="list-style:none;margin:0px padding:0px;"><a href="#contacts" id="cont" class="BTN BTN_xs">Контакты</a></li>
	</div>
 <nav>
	<ul id="menu" class="M M_vt">
		<li data-menuanchor="main" class="companylink"><a href="#main">Главная</a> </li>
		<li data-menuanchor="company" class="companylink"><a href="#company">Компания</a> </li>
		<li class="parent" data-menuanchor="products"><a href="#products/0">Продукция</a>
		<?=get_product_menus();?> </li>
		<li data-menuanchor="clients" class="clients-link"><a href="#clients">Клиенты</a> </li>
		<li data-menuanchor="services" class="services-link"><a href="#services">Сервис</a> </li>
		<li data-menuanchor="contacts" class="contacts-link"><a href="#contacts">Контакты</a> </li>
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
				<h1 class="TL ">О компании</h1>
			</div>
			<div class="BG info-comp">
				<p>
					 <?=ins('include/text1.php')?>
				</p>
			</div>
			<div class="BG BG_wide BG_wide-2 ">
				<h2 class="TL">Преимущества <em>Neman</em> </h2>
			</div>
			 <?=get_prim();?>
		</div>
	</div>
 </section>
	<?=get_product();?> <section id="idClients" style="background-image: url(/bitrix/templates/neman/img/content/clients/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-3">
				<h1 class="TL">Наши клиенты</h1>
			</div>
			 <?=get_klient();?>
			<div class="BG BG_wide BG_wide-4">
				<h2 class="TL">Отзывы наших клиентов</h2>
			</div>
			 <?=get_rev();?>
		</div>
	</div>
 </section> <section id="idServices" style="background-image: url(/bitrix/templates/neman/img/content/services/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-5">
				<h1 class="TL">Сервис</h1>
			</div>
			 <?=get_servis();?>
		</div>
	</div>
 </section> <section id="idContacts" style="background-image: url(/bitrix/templates/neman/img/content/contacts/page-bg.jpg)" class="section">
	<div class="intro">
		<div class="wrap">
			<div class="BG BG_wide BG_wide-6 ">
				<h1 class="TL">Контакты производства и представительств</h1>
			</div>
			<div class="W W_map">
				<div class="B B_map">
 <img src="/bitrix/templates/neman/img/content/contacts/map.png" alt=""> <span class="dots moskva"></span> <span class="dots peterburg"></span> <span class="dots chelab"></span> <span class="dots krasnodar"></span>
				</div>
				<div class="B kaliningrad">
 <strong class="TL BTN">Калининград</strong>
					<?=ins('include/text3.php')?>
				</div>
			</div>
			<div class="W W_accordion">
				<div class="header-acord">
 <strong class="TL">Представительства:</strong>
					<div class="contacts">
						<p>
							 Бесплатно по всей России
						</p>
						<div class="phone">
							 8 800 333 55 39
						</div>
					</div>
				</div>
				<div class="B accordeon-item moskva-item">
					<div class="acord-item">
 <strong class="_right">+7 (495) 928-35-33 <span class="arrow-flag accordeon-trigger trigger-1"></span></strong><strong class="TL BTN accordeon-trigger trigger-1">Москва</strong><span class="adrres">МО, г. Химки, ул Заводская владение 11</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">схема проезда</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">распечатать</a>
						</div>
						 время работы: с 9:00 до 18:00
					</div>
				</div>
				<div class="B accordeon-item peterburg-item">
					<div class="acord-item">
 <strong class="_right">+7 (812) 924-17-55<span class="arrow-flag accordeon-trigger trigger-2"></span></strong><strong class="TL BTN accordeon-trigger trigger-2">Санкт-Петербург</strong><span class="adrres">Пискаревский проспект, д. 150/2, оф. С-301</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">схема проезда</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">распечатать</a>
						</div>
						 время работы: с 9:00 до 18:00
					</div>
				</div>
				<div class="B accordeon-item krasnodar-item">
					<div class="acord-item">
 <strong class="_right">+7 (861) 244-55-70<span class="arrow-flag accordeon-trigger trigger-3"></span></strong><strong class="TL BTN accordeon-trigger trigger-3">Краснодар</strong><span class="adrres">Динской район, Новотитаровское с/п, Аэродром</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">схема проезда</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">распечатать</a>
						</div>
						 время работы: с 9:00 до 18:00
					</div>
				</div>
				<div class="B accordeon-item chelab-item">
					<div class="acord-item">
 <strong class="_right">+7 (351) 224-72-25<span class="arrow-flag accordeon-trigger trigger-4"></span></strong><strong class="TL BTN accordeon-trigger trigger-4">Челябинск</strong><span class="adrres">ул. Ушакова д. 1А</span>
					</div>
					<div class="text">
						<div class="_right">
 <a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">схема проезда</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">распечатать</a>
						</div>
						 время работы: с 9:00 до 18:00
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
 <strong class="TL">Оставьте заявку</strong>
				</div>
				<div class="B">
 <input id="name" name="name" type="text" placeholder="Ваше имя" class="required">
				</div>
				<div class="B">
<!--
 <input id="type" name="type" type="text" placeholder="Тип запроса" class="required">
-->
<select class="type" id="type" name="type">
<option disabled>Тип запроса</option>
<option value="Самосвальный полуприцеп">Самосвальный полуприцеп</option>
<option value="Бортовой полуприцеп">Бортовой полуприцеп</option>
<option value="Шторный полуприцеп">Шторный полуприцеп</option>
<option value="Ремонт и запчасти">Ремонт и запчасти</option>
<option value="Другое">Другое</option>
</select>

				</div>
				<div class="B">
 <input id="phone" name="phone" type="text" placeholder="Телефон" class="required">
				</div>
				<div class="B">
 <input id="" name="" type="submit" value="Отправить" class="BTN BTN_md">
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
			<h5>Заявка принята, спасибо</h5>
			<p>
				 окно закроется через сек...
			</p>
 <span class="close"> <img src="/bitrix/templates/neman/img/icons/close.png" alt=""> </span>
		</div>
	</div>
</div>
<div class="gen_zvanok" id="zvanok">
	<div class="content_for">
		<h3 class="zvanok_title">Заказать обратный звонок</h3>
		<table cellpadding="0" cellspacing="0" width="300px;">
		<tbody>
		<tr>
			<td>
 <input type="text" id="names" placeholder="Ваше имя">
			</td>
		</tr>
		<tr>
			<td>
 <input type="text" id="phoness" placeholder="Ваш номер телефона">
			</td>
		</tr>
		<tr>
			<td>
				<div class="B">
 <input class="sends" name="" type="submit" value="Отправить">
				</div>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>