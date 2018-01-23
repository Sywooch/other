<?php
/**
 * Шаблон акции
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */
  if(! defined("DIAFAN"))
{
	$path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<insert name="show_head">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/mincss.css" rel="stylesheet">
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
	<script type="text/javascript" src="/js/jcarusel.js"></script>
	<script type="text/javascript" src="/js/js.js"></script>
	<link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
</head>

<body>

<div class="wrapper">

	<header class="header">
		<div class="contain">
				<div class="left">
					<div class="logo">
					  <a href="/"><img src="/files/logo.png" alt="" title="" /></a>
					</div>
				</div>
				<div class="center">
					<div class="slogan">Интернет-магазин товаров для бани, сауны и хамам</div>
					<insert name="show_block" module="menu" id="1" template="leftmenu">

				</div>
				<div class="right">
					<div class="phone"><span>(495) 120-22-95</span></div>

						<!--<insert name="show_block" module="menu" id="4" template="left4menu">-->
					<ul class="menu contact">
						<li><a href="javascript:void(0);"  class="show_forms">ОБРАТНАЯ СВЯЗЬ</a></li>
						<li><a href="/about/">КОНТАКТЫ</a></li>
					</ul>
					<div class="userblock">
						<ul class="menu user">
							<li><a href="/user/" class="login"  class="wm">ЛИЧНЫЙ КАБИНЕТ</a></li>
							<li><insert name="show_block" module="site" id="7" template="user"></li>
						</ul>
					</div>
					<form action="#" method="post" id="contact" accept-charset="UTF-8" style="display:none;">
						<div class="form-item">
							<input title="" type="text" value="" id="nama2"  size="15" maxlength="128" class="form-text" placeholder="ВАШЕ ИМЯ">
						</div>
						<div class="form-item">
							<input title="" type="text" value="" id="phone2" size="15" maxlength="128" class="form-text" placeholder="НОМЕР ТЕЛЕФОНА">
						</div>
						<div class="form-item">
							<button class="send_pozvani">ПОЗВОНИТЕ МНЕ</button>
						</div>
					</form>
				</div>
				<div class="clear"></div>
		</div>
	</header><!-- .header-->

	<div class="middle">
		<div class="contain">
		
			<div class="container">
				<main class="content">
					<div class="content_top">
				<insert name="show_block" module="menu" id="3" template="left2menu">
						<div class="center">
							<insert name="show_search" module="search" template="top">
						</div>
						<insert name="show_block" module="cart">
						<div class="clear"></div>
					</div>
					<insert name="show_breadcrumb"> 				
					<insert name="show_body">
					<insert name="show_block" module="shop" images="1" count="100" action_only="y" template="action_page">
					
					
										
				</main><!-- .content -->
			</div><!-- .container-->

			<aside class="left-sidebar">
			<insert name="show_block" module="shop" template="menus">

				<insert name="show_block" module="bs" count="2" cat_id="1">
				<insert name="show_block" module="news" count="2">
				
			</aside><!-- .left-sidebar -->
		</div>
	</div><!-- .middle-->

</div><!-- .wrapper -->

<footer class="footer tmp6">
	<div class="contain">
				<div class="left">
					<div class="logo">
					  <a href="#"><img src="/files/logo.png" alt="" title="" /></a>
					</div>
					<div class="phone"><span>(495) 120-22-95</span></div>
				</div>
				<div class="center">
					<div class="block">
						<h2 class="title">О нас</h2>
						<ul class="fmenu">
							<li><a href="/about/">О компании</a></li>
							<li><a href="/contacts/">Контакты</a></li>
							<li><a href="/deliver/">Доставка</a></li>
							<li><a href="/news/">Новости</a></li>
						</ul>
					</div>
					<div class="block">
						<h2 class="title">Посетителям</h2>
						<ul class="fmenu">
							<li><a href="/user/">Личный кабинет</a></li>
							<li><a href="/articles/">Полезные советы</a></li>
							<li><a href="/shares/">Скидки и акции</a></li>
							<li><a href="/shop/">Каталог</a></li>
						</ul>
					</div>
				</div>
				<div class="right">
					
					<div class="diz">Художник Мария Путилина</div>
				</div>
				<div class="clear"></div>
	</div>
</footer><!-- .footer -->
<div id="message"  style="display:none;">
	<div class="contentm">
	ТОВАР ДОБАВЛЕН В КОРЗИНУ
	<ul class="action">
		<li><a href="javascript:void(0);"  class="aaaaaa">продолжить покупки</a></li>
		<li><a href="/shop/cart/" class="s">оформить заказ</a></li>
	</ul>
	<div class="kpon"></div>
	</div>
</div>
</body>
</html>