
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>


<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico">



	<!-- Meta tags -->


	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />





	<!-- Title -->


	<title><?php wp_title( '|', true, 'right' ); ?></title>


	


	<link rel="profile" href="http://gmpg.org/xfn/11" />


	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />


	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	


	<?php


		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );


		wp_enqueue_script("jquery");


		wp_head();


	?>


	


	<!-- Scripts -->


	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/jquery-easing-1.3.pack.js"></script>


	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/jquery-easing-compatibility.1.2.pack.js"></script>


	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/coda-slider.1.1.1.pack.js"></script>


	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/cufon.js"></script>


	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/ChaparralPro.font.js"></script>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/jquery-easing-1.3.pack.js"></script>
<!-- Cufon -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_assets/js/cufon-yui.js"></script>
<script type="text/javascript">
Cufon.replace('h22,h33,h34,h44');
</script>	


	<?php $slidernum = get_option('wordpressbling_slidernum'); ?>


	


	
	
	<?php wp_head(); ?>
	
	<?php global $options; foreach ($options as $value) { if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); } } ?>





</head>





<body <?php body_class(); ?>>



<?php if(!is_home()) : ?>
<div id="containers" style="background:none;">
<?php else: ?>
<div id="containers">
<?php endif; ?>
<div id="container">


	<div id="header" class="group">


		<?php $logo = get_option('wordpressbling_logo'); ?>


		<?php if(empty($logo)) : ?>	


		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1> <span><?php bloginfo( 'description' ); ?></span>


		<?php else : ?>


		<h1 class="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo $logo; ?>" alt="" /></a></h1>


		<?php endif; ?>

	
	</div><!-- /header -->