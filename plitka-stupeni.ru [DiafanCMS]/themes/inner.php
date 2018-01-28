<?php
/**
 * Внутренняя страница
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
<style>
	.path a, .path span{
		color: #C6CACB;
	}
	.path{
		color: #374B59;
		margin-bottom: 6px;
	}
</style>
<script>
	$(document).ready(function(){
		if($('.text_t').text() == ''){
			$('.text_t').remove();
		}
		var peremennaya;
		$('.cont-mini').each(function(){
			//console.log($(this));
			// flag - need to delete?
			peremennaya = true;
			if($(this).find('img').length > 0){
				// if block has images - not delete
				peremennaya = false;
			}
			//console.log(peremennaya);
			if(peremennaya){
				$(this).remove();
			}
		});
		// $('img').attr('height', $('img').height());
	});
</script>
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
<?php /* <insert name="show_path"> */ ?>
<insert name="show_path" separator="&#9658;">
<div class="cont no-shop">
<insert name="show_body">
<insert name="show_bodys">
</div>  

</div>                      

<div class="wrapp_right_box">
<insert name="show_include" file="help_message_for_search">
<insert name="show_inders_linck">
<div class="baner-block1">
	<noindex><insert name="show_block" module="site" id="62"></noindex>
</div>

<insert name="show_sidebar_content">

<div class="baner-block2">
	<noindex><insert name="show_block" module="site" id="63"></noindex>
</div>

</div>

</div>

<div class="clear"></div>

<insert name="show_include" file="footer">