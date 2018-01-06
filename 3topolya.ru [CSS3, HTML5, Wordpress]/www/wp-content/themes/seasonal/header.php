<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package Seasonal
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
<link href="/media/3topolya/css/home/fonts.css" rel="stylesheet" type="text/css">


<link href="/media/3topolya/css/common2.css" rel="stylesheet" type="text/css">
<!--<link href="/media/3topolya/css/form.css" rel="stylesheet" type="text/css" />
<link href="/media/3topolya/css/home/layout.css" rel="stylesheet" type="text/css">
<link href="/media/3topolya/css/home/themes.css" rel="stylesheet" type="text/css">
<link href="/media/3topolya/css/home/fonts.css" rel="stylesheet" type="text/css">
<link href="/media/3topolya/css/home/promo_popup.css" rel="stylesheet" type="text/css">
<link href="/media/3topolya/css/home/animations.css" rel="stylesheet" type="text/css">-->

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
</head>

<body <?php body_class(); ?>>



<header class="winter_head">



      <div class="bg">
      
        <div class="centered clearfix">
        
          <div class="logo">
            <a href="/" title="На главную"><img src="/media/3topolya/images_inner/inner_logo.png"></a>
          </div>
       


	<nav class="secondary-navigation">
           <div class="toggle-buttons">
              <button class="nav-toggle toggle-button">
<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
</button>
                                   
           </div>
        </nav>




<!--<div class="site-navigation">-->
          <div class="main-menu nav-collapse collapse primary-navigation">
            <ul class="menu cfx nav nav-menu">
              <li class="menu-item"><a href="/about-us/" title="О студии">О студии</a></li>
              <li class="menu-item"><a href="/portfolio/" title="Портфолио">Портфолио</a></li>
              <li class="menu-item"><a href="/project-prices/" title="Услуги и цены">Услуги и цены</a></li>
              <li class="menu-item"><a href="/video/" title="Видео">Видео</a></li>
              <!--<li class="menu-item"><a href="/reviews/" title="Отзывы">Отзывы</a></li>-->
              <li class="menu-item"><a href="/contact-us/" title="Контакты">Контакты</a></li>
              <li class="menu-item"><a href="/category" title="Блог">Блог</a></li>
            </ul>  
          </div>
<!--</div>-->




        
          <div class="contacts">
            <a class="number clients" href="tel:+74996860682">клиентам <em><gisphone class="_gis-phone-highlight-wrap js_gis-phone-highlight-wrap-aec62efb16c33e5a8ba8762a498ff8de _gis-phone-highlight-phone-wrap" data-ph-parsed="true">+7 (499) 686-06-82</gisphone></em></a>
            <a class="number partners" href="tel:+79151194723">партнерам <em><gisphone class="_gis-phone-highlight-wrap js_gis-phone-highlight-wrap-15c63edb962023b20d0268d7156979fd _gis-phone-highlight-phone-wrap" data-ph-parsed="true">+7 (915) 119-47-23</gisphone></em></a>
            <!--<div class="phone">
              <div class="number comagic_phone">+7 (499) 686-06-82</div>
            </div>
            <div class="js-show-callback-form call-request">
              перезвонить?
            </div>-->
          </div>




        
        </div>
        
        <div class="border"></div>
      </div>
      <div class="objects"></div>







</div>


</header>


<div class="container_head container_head1">
		<div class="site-navigation">
               
                <?php 
                // Primary Menu
                      wp_nav_menu( array( 
                            'theme_location'  => 'primary',  
                            'menu_class'      => 'nav-menu',
                            'container'       => 'nav',  
                            'container_class' => 'primary-navigation'
                      ) ); 
                ?>                 
              
               </div><!-- .site-navigation -->

</div>


<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'seasonal' ); ?></a>    
        
<!--
	<div class="sidebar">
            <div class="sidebar-inner">
           
                      
              <header id="masthead" class="site-header" role="banner">
                <div class="site-branding">
                <?php         
                // Header logo image
                  if( get_header_image() ) : ?>
                  
                      <div class="header-image">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                          <img src="<?php header_image(); ?>" height="<?php esc_attr_e( get_custom_header()->height ); ?>" 
                          width="<?php esc_attr_e( get_custom_header()->width ); ?>" alt="<?php esc_attr_e( get_bloginfo( 'title' ) ); ?>" />
                        </a>
                      </div>                 
                <?php 
                  endif;            
                // Site title & tagline
                if( get_theme_mod( 'show_site_title', 1 ) ) {  
                        if ( is_front_page() && is_home() ) : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php else : ?>
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <?php endif;
					  }
            	if ( get_theme_mod( 'show_tagline', 1 ) ) : {
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                            <h2 class="site-description"><?php echo $description; ?></h2>
                        <?php endif;				 		  		  
					  }
				endif;		  
				  
				  
                  // Social links
                  if ( has_nav_menu( 'social' ) ) :
                        echo '<nav class="social-menu" role="navigation">';
                            
                        wp_nav_menu( array(
                            'theme_location' => 'social',
                            'depth'          => 1,
                            'container' => false,
                            'menu_class'         => 'social',
                            'link_before'    => '<span class="screen-reader-text">',
                            'link_after'     => '</span>',
                        ) );
                            
                        echo '</nav>';
                    endif;          
                ?>
                <nav class="secondary-navigation">
                    <div class="toggle-buttons">
                      <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <button class="nav-toggle toggle-button"><?php _e( 'Menu', 'seasonal' ); ?></button>
                      <?php endif; ?>             
                    </div>
                </nav>    
                            
                <div class="site-navigation">
               
                <?php 
                // Primary Menu
                      wp_nav_menu( array( 
                            'theme_location'  => 'primary',  
                            'menu_class'      => 'nav-menu',
                            'container'       => 'nav',  
                            'container_class' => 'primary-navigation'
                      ) ); 
                ?>                 
              
          <!--      </div><!-- .site-navigation -->
                
          <!--      </div><!-- .site-branding -->
                       
         <!--     </header><!-- .site-header -->
             
        <!--    </div><!-- .sidebar-inner -->
        <!--</div><!-- .sidebar -->
  
  <div id="content" class="site-content">



<div class="container_head container_head2">
		<div class="site-navigation">
               
                <?php 
                // Primary Menu
                      wp_nav_menu( array( 
                            'theme_location'  => 'primary',  
                            'menu_class'      => 'nav-menu',
                            'container'       => 'nav',  
                            'container_class' => 'primary-navigation'
                      ) ); 
                ?>                 
              
               </div><!-- .site-navigation -->

</div>