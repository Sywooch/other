<?php echo do_shortcode("[metaslider id=160]"); ?>

<?php global $wp_locale;

if (isset($wp_locale)) {

	$wp_locale->text_direction = 'ltr';

} ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset') ?>" />

<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>

<!-- Created by Artisteer v4.1.0.60046 -->

<meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">

<!--[if lt IE 9]><script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



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

    <div id="art-header-bg">

            </div>

<nav class="art-nav">

    <div class="art-nav-inner"> <a href="http://unidvigatel.com/"><img src="http://unidvigatel.com/wp-content/uploads/2013/07/home.jpg" width="180" ></a>
    <?php

	echo theme_get_menu(array(

			'source' => theme_get_option('theme_menu_source'),

			'depth' => theme_get_option('theme_menu_depth'),

			'menu' => 'primary-menu',

			'class' => 'art-hmenu'

		)

	);

	get_sidebar('nav'); 

?> 

        <img src="http://unidvigatel.com/wp-content/uploads/2013/07/phone.jpg" width="180" ></div>

</nav>

<div class="art-sheet clearfix">

<P align="center">&#1043;&#1040;&#1051;&#1045;&#1056;&#1045;&#1071; | 6 &#1055;&#1056;&#1048;&#1063;&#1048;&#1053; | &#1048;&#1053;&#1060;&#1056;&#1054;&#1043;&#1056;&#1040;&#1060;&#1048;&#1050;&#1040;</P>

<?php if(theme_has_layout_part("header")) : ?>

<header class="art-header<?php echo (theme_get_option('theme_header_clickable') ? ' clickable' : ''); ?>"><?php get_sidebar('header'); ?></header>

<?php endif; ?>



<div class="art-layout-wrapper">

                <div class="art-content-layout">

                    <div class="art-content-layout-row">

                        <?php get_sidebar(); ?>

                        <div class="art-layout-cell art-content">

