<?php
/**
 * Основной шаблон сайта
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
<html> 
<insert name="show_include" file="header">
<body>
<insert name="show_presto">
<div class="popup-container-background"></div>


<div class="wrapp_site">
<insert name="show_popup_factorys">
<div class="wrapp_heder">

<a href="<insert name="path">" class="logo" >
<img src="<insert name="path">img/logo.png" alt="" title="" />
</a>
                
<div class="slogan_box">
<p>
Салон-магазин <br/>
<span class="color_sl">«Плитка &amp; ступени»</span>
на Бабушкинской
<span class="small_sl">
Большой выбор по доступным ценам
</span>
</p>
</div>
                
<div class="contact_box">
<div class="title_contact"><a href="/contacts/">Контактная информация</a></div>
<div class="box_phone">
<insert name="show_block" module="site" id="23">
</div>
<div class="small_cont">
<insert name="show_block" module="site" id="24">
</div>
<insert name="show_include" file="add_to_favorites">
</div>

<insert name="show_block" module="menu" id="1" template="topmenu">
                
</div>
</div>

<div class="clear"></div>

<div class="wrapp_top_menu">
<div class="wrapp_site">
<insert name="show_block" module="menu" id="4" template="menu">

<div class="wrapp_cart_box_main_pg">
	<noindex><insert name="show_block" module="cart"></noindex>
</div>

</div>
</div>

<div class="wrapp_site">

<div class="wrapp_list_catalog">

<div class="search_from_main_pg">
<insert name="show_search" module="search" template="top">
</div>

<insert name="show_include" file="search">

<a class="reset">Свернуть</a>

<div class="clear"></div>

</div>

<div class="wrapp_left_content">

<insert name="show_block" module="site" id="33">

<div class="title_box">Скидки и Акции</div>

<div class="wrapp_carusel">
<insert name="show_include" file="new_action">
</div>

<div class="title_box">Хиты и новинки</div>

<div class="wrapp_carusel">
<insert name="show_new_and_actions2">
</div>
                
<insert name="show_block" module="site" id="34">

<div class="title_box">Популярные фабрики</div>

<insert name="show_popular_fabric">

<div class="cont no-shop">
<insert name="show_body">
</div>

</div>

<div class="wrapp_right_box">
<insert name="show_include" file="help_message_for_search">
<insert name="show_inders_linck">
<div class="baner-block1">
	<noindex><insert name="show_block" module="site" id="62"></noindex>
</div>
 
<div class="title_box">Новости</div>
<noindex><insert name="show_block" module="news" count="3" site_id="35"> </noindex>

<div class="baner-block2">
	<noindex><insert name="show_block" module="site" id="63"></noindex>
</div>

</div>

</div>

<div class="clear"></div>

<insert name="show_include" file="footer">