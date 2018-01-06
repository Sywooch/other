<?php if(!is_home()) : ?>
<div id="sidebar">


     <div class="search widget">

	

		<?php get_search_form(); ?>

	

	</div><!-- /search -->
		

	<?php $ad1img = get_option('wordpressbling_ad1img'); ?>

	<?php $ad1url = get_option('wordpressbling_ad1url'); ?>

	<?php $ad2img = get_option('wordpressbling_ad2img'); ?>

	<?php $ad2url = get_option('wordpressbling_ad2url'); ?>

	<?php $ad3img = get_option('wordpressbling_ad3img'); ?>

	<?php $ad3url = get_option('wordpressbling_ad3url'); ?>

	<?php $ad4img = get_option('wordpressbling_ad4img'); ?>

	<?php $ad4url = get_option('wordpressbling_ad4url'); ?>

    <?php $ad5img = get_option('wordpressbling_ad5img'); ?>

	<?php $ad5url = get_option('wordpressbling_ad5url'); ?>

    <?php $ad6img = get_option('wordpressbling_ad6img'); ?>

	<?php $ad6url = get_option('wordpressbling_ad6url'); ?>

    <?php $ad7img = get_option('wordpressbling_ad7img'); ?>

	<?php $ad7url = get_option('wordpressbling_ad7url'); ?>
    
    <?php $ad8img = get_option('wordpressbling_ad8img'); ?>

	<?php $ad8url = get_option('wordpressbling_ad8url'); ?>
    
	<?php if(!empty($ad1img) || !empty($ad2img) || !empty($ad3img) || !empty($ad4img) || !empty($ad5img) ||!empty($ad6img) ||!empty($ad7img) ||!empty($ad8img)) : ?>

	

	<div class="ads widget">

	

	<?php if(!empty($ad1img)) : ?><a href="<?php echo $ad1url ?>"><img src="<?php echo $ad1img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad2img)) : ?><a href="<?php echo $ad2url ?>"><img src="<?php echo $ad2img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad3img)) : ?><a href="<?php echo $ad3url ?>"><img src="<?php echo $ad3img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad4img)) : ?><a href="<?php echo $ad4url ?>"><img src="<?php echo $ad4img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad5img)) : ?><a href="<?php echo $ad5url ?>"><img src="<?php echo $ad5img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad6img)) : ?><a href="<?php echo $ad6url ?>"><img src="<?php echo $ad6img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad7img)) : ?><a href="<?php echo $ad7url ?>"><img src="<?php echo $ad7img; ?>" alt="" /></a><?php endif; ?>
     
    <?php if(!empty($ad8img)) : ?><a href="<?php echo $ad8url ?>"><img src="<?php echo $ad8img; ?>" alt="" /></a><?php endif; ?>

		

	</div><!-- /ads -->

	

	<?php endif; ?>
	
	<?php 

	$display = get_option('wordpressbling_displaytabs'); 

	if(!empty($display)) : ?>

		

	<?php include(TEMPLATEPATH . '/tabswidget.php');  ?>

	<?php endif; ?>
	

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>

	<?php endif; ?>



</div><!-- /sidebar -->
<?php else: ?>
       


<div id="sidebar">

    <?php $rss = get_option('wordpressbling_rss'); ?>
    <?php $facebook = get_option('wordpressbling_facebook'); ?>
    <?php $twitter = get_option('wordpressbling_twitter'); ?>
    <?php $mail = get_option('wordpressbling_mail'); ?>
    
 
    <div class="rss " style="margin-bottom:30px;margin-left:7px;">
	

    <a rel="nofollow" href="<?php echo $rss ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_assets/img/rss.png" width="270"  /></a>
    <a rel="nofollow" href="<?php echo $mail ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_assets/img/mail.png" width="270" /></a>
    <a rel="nofollow" href="<?php echo $facebook ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_assets/img/facebook.png" width="270"/></a>
    <a rel="nofollow" href="<?php echo $twitter ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_assets/img/twitter.png" width="270" /></a>
    


	</div><!-- /rss -->	
   

<div class="search widget">

	

		<?php get_search_form(); ?>

	

	</div><!-- /search -->
		

	<?php $ad1img = get_option('wordpressbling_ad1img'); ?>

	<?php $ad1url = get_option('wordpressbling_ad1url'); ?>

	<?php $ad2img = get_option('wordpressbling_ad2img'); ?>

	<?php $ad2url = get_option('wordpressbling_ad2url'); ?>

	<?php $ad3img = get_option('wordpressbling_ad3img'); ?>

	<?php $ad3url = get_option('wordpressbling_ad3url'); ?>

	<?php $ad4img = get_option('wordpressbling_ad4img'); ?>

	<?php $ad4url = get_option('wordpressbling_ad4url'); ?>

    <?php $ad5img = get_option('wordpressbling_ad5img'); ?>

	<?php $ad5url = get_option('wordpressbling_ad5url'); ?>

    <?php $ad6img = get_option('wordpressbling_ad6img'); ?>

	<?php $ad6url = get_option('wordpressbling_ad6url'); ?>

    <?php $ad7img = get_option('wordpressbling_ad7img'); ?>

	<?php $ad7url = get_option('wordpressbling_ad7url'); ?>
    
    <?php $ad8img = get_option('wordpressbling_ad8img'); ?>

	<?php $ad8url = get_option('wordpressbling_ad8url'); ?>
    
	<?php if(!empty($ad1img) || !empty($ad2img) || !empty($ad3img) || !empty($ad4img) || !empty($ad5img) ||!empty($ad6img) ||!empty($ad7img) ||!empty($ad8img)) : ?>

	

	<div class="ads widget">

	

	<?php if(!empty($ad1img)) : ?><a href="<?php echo $ad1url ?>"><img src="<?php echo $ad1img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad2img)) : ?><a href="<?php echo $ad2url ?>"><img src="<?php echo $ad2img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad3img)) : ?><a href="<?php echo $ad3url ?>"><img src="<?php echo $ad3img; ?>" alt="" /></a><?php endif; ?>

	<?php if(!empty($ad4img)) : ?><a href="<?php echo $ad4url ?>"><img src="<?php echo $ad4img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad5img)) : ?><a href="<?php echo $ad5url ?>"><img src="<?php echo $ad5img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad6img)) : ?><a href="<?php echo $ad6url ?>"><img src="<?php echo $ad6img; ?>" alt="" /></a><?php endif; ?>
    
    <?php if(!empty($ad7img)) : ?><a href="<?php echo $ad7url ?>"><img src="<?php echo $ad7img; ?>" alt="" /></a><?php endif; ?>
     
    <?php if(!empty($ad8img)) : ?><a href="<?php echo $ad8url ?>"><img src="<?php echo $ad8img; ?>" alt="" /></a><?php endif; ?>

		

	</div><!-- /ads -->

	

	<?php endif; ?>
	
	<?php 

	$display = get_option('wordpressbling_displaytabs'); 

	if(!empty($display)) : ?>

		

	<?php include(TEMPLATEPATH . '/tabswidget.php');  ?>

	<?php endif; ?>
	

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>

	<?php endif; ?>

</div>
<?php endif; ?>