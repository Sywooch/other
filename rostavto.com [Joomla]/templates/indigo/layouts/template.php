<?php
/**
* @package   yoo_nano2
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
// get template configuration

include($this['path']->path('layouts:template.config.php'));
?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">
<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>


<div id="wrapper_body">
<div class="wrapper clearfix">


<style type="text/css">
.left_col .left_banner div{
margin:0px !important;
padding:0px !important;
}

.left_col .left_banner{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 

}

.left_col .menu_autosalony{
width:150px; 
height:40px;
margin:0px !important;
padding:0px !important;  

}


#header{
z-index:10 !important;
}



div#maximenuck ul.maximenuck li.maximenuck div.floatck div.floatck.fixRight, 
div#maximenuck ul.maximenuck li.level1.parent.menu_right div.floatck div.floatck{

margin-right:-155px;

}


.titreck{
margin-top:6px !important;

}


.menu_autosalony {
margin-top:10px !important;
}

.menu_autosalony .module{

margin-left:0px;
margin-right:0px;
margin-bottom:0px;

}

.maximenuckh{
}

.maximenuck{
background-color:#EEE !important;
color:#444 !important;
border:1px solid transparent !important;

}


div#maximenuck ul.maximenuck{
height:41px !important;
-webkit-border-radius:0px !important;
border-radius:0px !important;
background-color:#EEE !important;
background:-moz-linear-gradient(top, #EEE 0%, #EEE 100%) !important;
background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#EEE), color-stop(100%,#EEE))

}



ul.maximenuck{
padding:0px !important;

}

.maxiroundedcenter li{
list-style-type: none !important;
}




a.maximenuck{

border:0px !important;
}


div#maximenuck ul.maximenuck li.maximenuck.level1{
padding:0px !important;
width:100% !important;

}


div#maximenuck ul.maximenuck li.maximenuck.level1{
margin-top:0px !important;
}


div#maximenuck ul.maximenuck li.level1.parent > a, div#maximenuck ul.maximenuck li.level1.parent > span.separator{
padding-right:2px !important;
}


div#maximenuck ul.maximenuck li div.floatck{
background:#EEE !important;
background:-moz-linear-gradient(top, #EEE, #EEE) !important;
background:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#EEE), to(#EEE)) !important;

}


div#maximenuck ul.maximenuck li div.floatck div.maximenuck2{
width:140px !important;

}

.fixRight{
border:1px solid #DDD !important;
width:140px !important;
}

li.maximenuck .fixRight{

}


div#maximenuck ul.maximenuck li ul.maximenuck2 li.maximenuck{
padding:0px !important;
margin:0px !important;

}

.fixRight{
padding-bottom:5px !important;
}

.maximenuck{
text-align:center !important;
}


div#maximenuck ul.maximenuck:hover{
background-color:#a74949 !important;
color:white !important;

}



div#maximenuck ul.maximenuck li.maximenuck.level1:hover > a span.titreck, div#maximenuck ul.maximenuck li.maximenuck.level1.active > a span.titreck, div#maximenuck ul.maximenuck li.maximenuck.level1:hover > span.separator, div#maximenuck ul.maximenuck li.maximenuck.level1.active > span.separator{
color:white !important;
}


div#maximenuck ul.maximenuck li.maximenuck.level1.parent:hover, div#maximenuck ul.maximenuck li.maximenuck.level1.parent:hover{
background-color:#a74949 !important;
}


div#maximenuck ul.maximenuck li.maximenuck.level1:hover, div#maximenuck ul.maximenuck li.maximenuck.level1.active{
background-color:#a74949 !important;
}


div#maximenuck ul.maximenuck li.maximenuck ul.maximenuck2 li:hover > a, div#maximenuck ul.maximenuck li.maximenuck ul.maximenuck2 li:hover > h2 a, div#maximenuck ul.maximenuck li.maximenuck ul.maximenuck2 li:hover > h3 a, div#maximenuck ul.maximenuck li.maximenuck ul.maximenuck2 li.active > a{
color:white !important;

}

div#maximenuck ul.maximenuck li ul.maximenuck2 li.maximenuck:hover{
background-color:#a74949 !important;

}




.menu_kodi_regionov .module{

margin-left:0px;
margin-right:0px;
margin-bottom:0px;

}

.left_col .menu_kodi_regionov{
width:150px; 
height:40px;
margin-left:0px !important;
margin-bottom:0px !important;
margin-right:0px !important;
padding:0px !important;  

}

.menu_kodi_regionov {
margin-top:10px !important;
}


.menu_kodi_regionov .module{
margin-top:0px !important;

}


div#maximenuck ul.maximenuck li div.floatck{
width:140px;

}


div#maximenuck ul.maximenuck li div.floatck{
margin-left:-2px !important;

}




.left_col .video_formula1 div{
margin:0px !important;
padding:0px !important;
}

.left_col .video_formula1{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
height:300px;
}

</style>
<div align="center" class="left_col">

<div class="menu_autosalony"><?php echo $this['modules']->render('menu-autosalony'); ?></div>

<div class="left_banner"><?php echo $this['modules']->render('left-banner1'); ?></div>


<div class="menu_kodi_regionov"><?php echo $this['modules']->render('menu-kodi-regionov'); ?></div>


<div class="video_formula1"><?php echo $this['modules']->render('video-formula1'); ?></div>


<div class="left_banner"><?php echo $this['modules']->render('left-banner2'); ?></div>



</div>

		<header id="header">

		<div id="headerbar" class="clearfix">

				<?php if ($this['modules']->count('absolute')) : ?>

	<div id="absolute">
	<a id="adsm" href="http://rostavto.com/board/%D0%B4%D0%BE%D0%B1%D0%B0%D0%B2%D0%B8%D1%82%D1%8C%20%D0%BE%D0%B1%D1%8A%D1%8F%D0%B2%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5"><span id="adsm" class="button">Подать объявление</span></a>
	<span id="auth" class="button">Авторизация</span>
<div id="autorization">
		<?php echo $this['modules']->render('absolute'); ?>
</div>
	</div>

	<?php endif; ?>

				<?php if ($this['modules']->count('logo')) : ?>

<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>

				<?php endif; ?>


				<?php if($this['modules']->count('headerbar')) : ?>

				<?php echo $this['modules']->render('headerbar'); ?>



				<?php endif; ?>

<div class="pbutton" align="center">
<a href="https://play.google.com/store/apps/details?id=ru.rostavto.rostavtoclient" target="_blank">
<img src="../magazin/image/data/android.jpg" width="80">
</a>&nbsp;&nbsp;<a href="#"><img src="../magazin/image/data/iphone.jpg" width="80"></a>
</div>
<div class="contact" style="display:none;">

<img src="/templates/indigo/images/protector2.png" width="80"></div>

<style type="text/css">
.top-banner{
background-color:transparent; width:470px; height:170px; position:absolute; top:10px; left:260px;
}

.top-banner div{
margin:0px !important;
padding:0px !important;  
}
</style>

<div class="top-banner">
<?php echo $this['modules']->render('top-banner'); ?>
</div>




			<?php if ($this['modules']->count('toolbar-l + toolbar-r') || $this['config']->get('date')) : ?>

			<div id="toolbar" class="clearfix">



				<?php if ($this['modules']->count('toolbar-l') || $this['config']->get('date')) : ?>

				<div id="time" class="float-right">Дата:



					<?php if ($this['config']->get('date')) : ?>

					<time datetime="<?php echo $this['config']->get('datetime'); ?>"><?php echo $this['config']->get('actual_date'); ?></time>

					<?php endif; ?>



					<?php echo $this['modules']->render('toolbar-l'); ?>



				</div>

				<?php endif; ?>
				
				
				<div id="price_benzin" class="float-right">
				Цены на бензин: -
				</div>



				<?php if ($this['modules']->count('toolbar-r')) : ?>

				<div class="float-right"><?php echo $this['modules']->render('toolbar-r'); ?></div>

				<?php endif; ?>



			</div>

			<?php endif; ?>



			<?php if ($this['modules']->count('logo + headerbar')) : ?>



			<?php endif; ?>



			<?php if ($this['modules']->count('menu + search')) : ?>





			<?php if ($this['modules']->count('banner')) : ?>

			<div id="banner"><?php echo $this['modules']->render('banner'); ?></div>

			<?php endif; ?>

			<?php if ($this['modules']->count('search')) : ?>

			<div id="search"><?php echo $this['modules']->render('search'); ?></div>

				<?php endif; ?>

			</div>

		</header>

<div id="menubar" class="clearfix">



				<?php if ($this['modules']->count('menu')) : ?>

				<nav id="menu"><?php echo $this['modules']->render('menu'); ?></nav>

				<?php endif; ?>


			</div>

			<?php endif; ?>

		<?php if ($this['modules']->count('top-a')) : ?>

		<section id="top-a" class="grid-block"><?php echo $this['modules']->render('top-a', array('layout'=>$this['config']->get('top-a'))); ?></section>

		<?php endif; ?>





		<?php if ($this['modules']->count('innertop + innerbottom + sidebar-a + sidebar-b') || $this['config']->get('system_output')) : ?>

<div id="main" class="grid-block">


<div id="maininner" class="grid-box">




<!-- content -->

				<?php if ($this['modules']->count('breadcrumbs')) : ?>

				<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>

				<?php endif; ?>



<?php if ($this['config']->get('system_output')) : ?>

<section id="content" class="grid-block"><?php echo $this['template']->render('content'); ?>
				</section>

				<?php endif; ?>
<!-- inner top -->

<?php if ($this['modules']->count('innertop')) : ?>
<div class="container">


    <ul class="tabs">
        <li><a href="#tab1">Автомобильные новости</a></li>
        <li><a href="#tab2">События</a></li>
				<li><a href="#tab3">Новости пользователей</a></li>


    </ul>
<div class="tab_container">
        <div id="tab1" class="tab_content">
				<?php echo $this['modules']->render('innertop', array('layout'=>$this['config']->get('innertop'))); ?>
       </div>
				<?php endif; ?>





<!-- inner bottom -->

				<?php if ($this['modules']->count('innerbottom')) : ?>
 <div id="tab2" class="tab_content">
				<?php echo $this['modules']->render('innerbottom', array('layout'=>$this['config']->get('innerbottom'))); ?>
        </div>

<?php if ($this['modules']->count('top-b')) : ?>
<div id="tab3" class="tab_content">
	<h4 style="margin:15px -20px 0 20px"><a href="/collective-add">[ Добавить новость ]</a></h4>
<?php echo $this['modules']->render('top-b', array('layout'=>$this['config']->get('top-b'))); ?>
</div>
<?php endif; ?>

    </div>
</div>
				<?php endif; ?>
</div>

<!-- maininner end -->



			<?php if ($this['modules']->count('sidebar-a')) : ?>

			<aside id="sidebar-a" class="grid-box"><?php echo $this['modules']->render('sidebar-a', array('layout'=>'stack')); ?></aside>

			<?php endif; ?>



			<?php if ($this['modules']->count('sidebar-b')) : ?>

			<aside id="sidebar-b" class="grid-box"><?php echo $this['modules']->render('sidebar-b', array('layout'=>'stack')); ?></aside>

			<?php endif; ?>



		</div>

		<?php endif; ?>

		<!-- main end -->



		<?php if ($this['modules']->count('bottom-a')) : ?>

		<section id="bottom-a" class="grid-block"><?php echo $this['modules']->render('bottom-a', array('layout'=>$this['config']->get('bottom-a'))); ?></section>

		<?php endif; ?>



		<?php if ($this['modules']->count('bottom-b')) : ?>

		<section id="bottom-b" class="grid-block"><?php echo $this['modules']->render('bottom-b', array('layout'=>$this['config']->get('bottom-b'))); ?></section>

		<?php endif; ?>

<?php if ($this['modules']->count('footer + debug') || $this['config']->get('warp_branding') || $this['config']->get('totop_scroller')) : ?>

		<footer id="footer">



			<?php if ($this['config']->get('totop_scroller')) : ?>

			<a id="totop-scroller" href="#page"></a>

			<?php endif; ?>



			<?php

				echo $this['modules']->render('footer');

				$this->output('warp_branding');

				echo $this['modules']->render('debug');

			?>
 <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter27022521 = new Ya.Metrika({id:27022521, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } });  var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="//mc.yandex.ru/watch/27022521" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
		</footer>


<style type="text/css">
.right_col2 .rigth_banner div{
margin:0px !important;
padding:0px !important;
}

.right_col2 .rigth_banner{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
/*height:300px;*/
}

.right_col2 .pravila_pdd{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
height:160px;
}

.right_col2 .pravila_pdd div{
margin:0px !important;
padding:0px !important;
}



.phocagallery-box-file{
float:none !important;
}


.right_col2 .shemy_dtp div{
margin:0px !important;
padding:0px !important;
}

.right_col2 .shemy_dtp{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
height:160px;
}



.right_col2 .avtourist div{
margin:0px !important;
padding:0px !important;
}

.right_col2 .avtourist{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
height:160px;
}



.right_col2 .video_test_draiv div{
margin:0px !important;
padding:0px !important;
}

.right_col2 .video_test_draiv{
margin:0px !important;
padding:0px !important;  
margin-top:10px !important;
width:150px; 
height:300px;
}

</style>

<div align="center" class="right_col2">

<div class="rigth_banner"><?php echo $this['modules']->render('right-banner1'); ?></div>

<div class="video_test_draiv"><?php echo $this['modules']->render('video-test-draiv'); ?></div>

<div align="center" class="pravila_pdd"><?php echo $this['modules']->render('pravila-pdd'); ?></div>

<div class="rigth_banner"><?php echo $this['modules']->render('right-banner2'); ?></div>

<div align="center" class="shemy_dtp"><?php echo $this['modules']->render('shemy-dtp'); ?></div>

<div align="center" class="avtourist"><?php echo $this['modules']->render('avtourist'); ?></div>

<div class="rigth_banner"><?php echo $this['modules']->render('right-banner3'); ?></div>


</div>



<div class="right_col"></div>
		<?php endif; ?>

</div>


<?php echo $this->render('footer'); ?>

</body>

</html>