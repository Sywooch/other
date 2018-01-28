<?php
/**
 * Шаблон без каталога товаров
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
 
if(! defined("DIAFAN"))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title><insert name="show_title"></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="<insert name="show_description">">
<meta name="keywords" content="<insert name="show_keywords">">
<meta content="<insert value="Russian">" name="language">
<meta content="DiAfan http://www.diafan.ru/" name="author">
<link href="<insert name="path">css/default.css" rel="stylesheet" type="text/css">
<link href="<insert name="path">css/style.css" rel="stylesheet" type="text/css">
<link rel="alternate" type="application/rss+xml" title="RSS" href="<insert name="path_url">news/rss/">
<insert name="show_js">
      
<script type="text/javascript" src="<insert name="path">js/hoverIntent.js" charset="UTF-8"></script>
<script type="text/javascript" src="<insert name="path">js/superfish.js" charset="UTF-8"></script>
<link href="<insert name="path">css/menu.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
   $(document).ready(function() {  $('ul.sf-menu').superfish(); });
</script>

</head>
<body <insert name="show_protect">>
<insert name="show_presto">
	<div class="popup-container-background"></div>
	<div class="page">
		<div class="page_top">
			<div class="page_bottom">
				<div class="main">
				
					<div class="head">
						
						<div class="home_icon">
							<insert name="show_href" rewrite="" img="img/home.png" img_act="img/home_act.png"  alt="Главная страница" alt2="First page">
						</div>
						<div class="feedback_icon">
						<insert name="show_href" rewrite="feedback" img="img/feedback.png"  img_act="img/feedback_act.png" alt="Обратная связь" alt2="Feedback">
						</div>
						<div class="map_icon">
							<insert name="show_href" rewrite="map" img="img/map.png"  img_act="img/map_act.png" alt="Карта сайта" alt2="Site Map">
						</div>
						
						<div class="logo">
							<h2><insert name="show_href" rewrite="" alt="title"></h2>
						</div>
						
						<div class="top_phone_text">
							Контактный телефон
						</div>
						<div class="top_phone">
							495 567-09-12<br>
							495 561-28-01
						</div>
						
						<div class="top_clock_text">
							Часы работы
						</div>
						<div class="top_clock">
							09:00-19:00
						</div>
						
						<div class="add_favorites">
							<a onclick="add2Fav(this)" href="#">
								<span>Добавить в избранное</span>
							</a>
						</div>
						
						<insert name="show_block" module="languages">
						
						<insert name="show_search" module="search" template="top">
						
						<div class="top_menu">
							<div class="top_menu_right">
								<div class="top_menu_x">
									<insert name="show_block" module="menu" id="1" template="topmenu">
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="content">
					<table cellpadding="0" cellspacing="0" width="100%"><tr>
						<td class="col_left">
							
							<div class="left_menu">
							<div class="left_menu_top"></div>
							<div class="left_menu_bottom"></div>
								<insert name="show_block" module="menu" id="3" template="default">
							</div>
							
							<insert name="show_block" module="clauses" images="1">
							
							<insert name="show_block" module="faq" count="2" often="0">
							
							<insert name="show_block" module="files" count="1" images="1">
							
						</td>
						
						<td class="col_center">
							<insert name="show_path">
							<insert name="show_body">
							<insert name="show_images" module="site">
							<insert name="show_links" module="site">
							<insert name="show_previous_next" module="site">
							<insert name="show_comments" module="site">
							<insert name="show_tags" module="site">	
							<insert name="show_social_links">
							<insert name="show_block" module="banners" count="all">
				
						</td>
						
						<td class="col_right">
							<insert name="show_inders_linck">
							<insert name="show_login" module="registration">

							<insert name="show_block" module="news" count="3" images="1" cat_id="1">

							<insert name="show_calendar" module="news" only_news="1">

							<insert name="show_block" module="tags">
							
							<insert name="show_block" module="votes">
							
							<insert name="show_block" module="photo" sort="rand" count="1" cat_id="1">
						
						</td>
						</tr></table>
						
					</div>
					
					<div class="bottom">
					
						<div class="copyright">
							&copy; <insert name="show_year" year="2003">
						</div>
						<div class="bottom_menu">
							<insert name="show_block" module="menu" separator_1=" | " count_level="1">
						</div>
						<div class="now_online">
							<insert name="show_block" module="users">
						</div>
						<insert name="show_include" file="diafan">
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<insert name="show_block" module="consultant">
</body>
</html>
