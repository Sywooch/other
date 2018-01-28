<?php
/**
 * Шаблон страницы "Скидки и Акции"
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

<insert name="show_search" module="search" template="top">

</div>
</div>

<div class="wrapp_site">

<div class="wrapp_list_catalog">

<div class="wrapp_cart_box">
<insert name="show_block" module="cart">
</div>

<insert name="show_include" file="search">

<a class="reset">Свернуть</a>

<div class="clear"></div>
</div>
            
            
<div class="wrapp_left_content">
<?php /* <insert name="show_path"> */ ?>

<div class="cont">
<insert name="show_body">
<insert name="get_shop_list_" sa="1">
<<insert name="show_bodys">
</div>  

</div>            

<div class="wrapp_right_box">
<insert name="show_include" file="style_for_help_win">
<insert name="show_include" file="help_message_for_search">
<insert name="show_inders_linck">
<div class="baner-block1">
	<insert name="show_block" module="site" id="62">
</div>

<insert name="show_sidebar_content">

<div class="baner-block2">
	<insert name="show_block" module="site" id="63">
</div>

</div>

</div>

<div class="clear"></div>

<insert name="show_include" file="footer">