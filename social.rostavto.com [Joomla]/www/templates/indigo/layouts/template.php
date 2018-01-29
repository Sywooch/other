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
<div class="left_col"></div>

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

<div class="contact"><img src="../magazin/image/data/protector.png"></div>


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
<!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=24633998&amp;from=informer" target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/24633998/3_1_FFFFFFFF_EFEFEFFF_0_pageviews" style="width:88px; height:31px; border:0;" onclick="try{Ya.Metrika.informer({i:this,id:24633998,lang:'ru'});return false}catch(e){}"/></a> <!-- /Yandex.Metrika informer -->  <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter24633998 = new Ya.Metrika({id:24633998, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } });  var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="//mc.yandex.ru/watch/24633998" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
		</footer>
<div class="right_col"></div>
		<?php endif; ?>

</div>


<?php echo $this->render('footer'); ?>

</body>

</html>
