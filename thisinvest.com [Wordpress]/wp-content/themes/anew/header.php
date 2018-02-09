<!DOCTYPE html> 
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">

  <?php if( is_page( array( 1017, 1021 ) ) ) { 
      echo '<meta name="viewport" content="width=1400">';
  } else {
      echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
  } ?>

	<title><?php wp_title(''); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<meta name="AForex" content="VIGI8">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1531920100409047',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<div id="fbgl"></div>
<div id="wrapper">

	<header id="header">
		<?php // putRevSlider( "single-slider" ) ?>
        <div  class="fullwidthbanner-container">
          
        </div>
        <div class="container slide-over">
            <?php if ( ot_get_option('header-image') == '' ): ?>
            <div class="pad group">
                <?php echo alx_site_title(); ?>
                <?php if ( !ot_get_option('site-description') ): ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
                <?php //alx_social_links() ; ?>
            </div>
            <?php endif; ?>
            <?php if ( ot_get_option('header-image') ): ?>
                <a href="<?php echo home_url('/'); ?>" rel="home">
                    <img class="site-image" src="<?php echo ot_get_option('header-image'); ?>" alt="<?php get_bloginfo('name'); ?>">
                </a>
            <?php endif; ?>
        </div><!--/.container-->
        
        <?php if (has_nav_menu('topbar')): ?>
			<nav class="nav-container group" id="nav-topbar">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				
				<div class="container">	
					<div class="toggle-search"><i class="fa fa-search"></i></div>
					<div class="search-expand">
						<div class="search-expand-inner">
							<?php get_search_form(); ?>
						</div>
					</div>
                    <div class="toggle-subscribe"><i class="fa fa-envelope-o"></i></div>
					<div class="subscribe-expand">
						<div class="subscribe-expand-inner">
							<?php if (!dynamic_sidebar("subscribe-widget-area") ) : ?> 
                            	<div>Подписка отключена</div> 
                            <?php endif; ?>
						</div>
					</div>
                    <div class="toggle-account"><i class="fa fa-user"></i></div>
                    <div class="account-expand">
                        <div class="account-expand-inner">
                            <?php if ( function_exists('dynamic_sidebar') )
                               if (is_user_logged_in()) { dynamic_sidebar('login-widget-area'); };
                            ?>
                            <?php do_action( 'wordpress_social_login' ); ?>
                        </div>
                    </div>

				</div><!--/.container-->
				
			</nav><!--/#nav-topbar-->
		<?php endif; ?>
		
	</header><!--/#header-->
	
	<div id="page" class="container">
		<div class="main group">