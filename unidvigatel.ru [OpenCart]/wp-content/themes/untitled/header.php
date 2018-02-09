<!DOCTYPE html>

<html <?php language_attributes(); ?>><head>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" background="http://unidvigatel.com/wp-content/themes/untitled/bak.jpg">
  <tr>
    <td><a href="http://unidvigatel.com/katalog.html"><script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="1000" height="50" id="FlashID">
  <param name="movie" value="http://unidvigatel.com/wp-content/themes/untitled/323.swf">
  <object type="application/x-shockwave-flash" data="http://unidvigatel.com/wp-content/themes/untitled/323.swf" width="1000" height="50">
    <!--<![endif]-->
    <param name="quality" value="high">
    <param name="wmode" value="opaque">
    <param name="swfversion" value="8.0.35.0">
    <param name="expressinstall" value="http://unidvigatel.com/wp-content/themes/untitled/Scripts/expressInstall.swf">
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script></a></td>
  </tr>
</table>




<meta charset="<?php bloginfo('charset') ?>" />
<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
<!-- Created by Artisteer v4.0.0.58475 -->
<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, 

width = device-width">
<!--[if lt IE 9]><script 

src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
remove_action('wp_head', 'wp_generator');
if (is_singular() && get_option('thread_comments')) {
	wp_enqueue_script('comment-reply');
}
wp_head();
?>
</head>
<body <?php body_class(); ?>>

<div id="art-main">
    <div class="art-sheet clearfix">

<?php if(theme_has_layout_part("header")) : ?>
<header class="clearfix art-header<?php echo (theme_get_option('theme_header_clickable') ? ' 

clickable' : ''); ?>"><?php get_sidebar('header'); ?>



    <div class="art-shapes">


            </div>

<nav class="art-nav clearfix">
    <?php
	echo theme_get_menu(array(
			'source' => theme_get_option('theme_menu_source'),
			'depth' => theme_get_option('theme_menu_depth'),
			'menu' => 'primary-menu',
			'class' => 'art-hmenu'
		)
	);
?> 
    </nav>

                    
</header>
<?php endif; ?>

<div class="art-layout-wrapper clearfix">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content clearfix">

