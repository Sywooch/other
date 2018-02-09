		</div><!--/.main-->
	</div><!--/.container-inner-->

	<?php if ( is_home() ): ?>
		<div id="bottom-logo">
			<div class="container">
				<?php dynamic_sidebar( 'bottom-logo-area' ); ?>
			</div>
		</div>
	<?php endif; ?>
	<footer id="footer">	
		
		<?php if ( has_nav_menu( 'footer' ) ): ?>
			<nav class="nav-container group" id="nav-footer">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap"><?php wp_nav_menu( array('theme_location'=>'footer','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=>false) ); ?></div>
			</nav><!--/#nav-footer-->
		<?php endif; ?>
		
		<section id="footer-bottom">
			<div class="container">
			
				<a id="back-to-top" href="#"><i class="fa fa-angle-up"></i></a>

                <?php front_end_load(); ?>

                <?php // footer widgets
					$total = 4;
					if ( ot_get_option( 'footer-widgets' ) != '' ) {
						
						$total = ot_get_option( 'footer-widgets' );
						if( $total == 1) $class = 'one-full';
						if( $total == 2) $class = 'one-half';
						if( $total == 3) $class = 'one-third';
						if( $total == 4) $class = 'one-fourth';
						}

						if ( ( is_active_sidebar( 'footer-1' ) ||
							   is_active_sidebar( 'footer-2' ) ||
							   is_active_sidebar( 'footer-3' ) ||
							   is_active_sidebar( 'footer-4' ) ) && $total > 0 ) 
				{ ?>	
				
					<div class="pad group">
						<?php $i = 0; while ( $i < $total ) { $i++; ?>
							<?php if ( is_active_sidebar( 'footer-' . $i ) ) { ?>
				
								<div class="footer-widget-<?php echo $i; ?> grid <?php echo $class; ?> <?php if ( $i == $total ) { echo 'last'; } ?>">
									<?php dynamic_sidebar( 'footer-' . $i ); ?>
								</div>
				
							<?php } ?>
						<?php } ?>
					</div><!--/.pad-->

				<?php } ?>

			</div><!--/.container-->
		</section><!--/#footer-bottom-->

		<section id="footer-bottom-last">
			<div class="container">
				<div class="pad group">			
						<div class="grid three-fourth">
						
							<?php if ( ot_get_option('footer-logo') ): ?>
								<img id="footer-logo" src="<?php echo ot_get_option('footer-logo'); ?>" alt="<?php get_bloginfo('name'); ?>">
							<?php endif; ?>
							
							<div id="copyright">
								<?php if ( ot_get_option( 'copyright' ) ): ?>
									<p><?php echo ot_get_option( 'copyright' ); ?></p>
								<?php else: ?>
									<p><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e('All Rights Reserved.','anew'); ?></p>
								<?php endif; ?>
							</div><!--/#copyright-->
							
						</div>		
						<div class="grid one-fourth last">	
							<?php alx_social_links() ; ?>
						</div>	
					</div><!--/.pad-->
			</div><!--/.container-->
		</section><!--/#footer-bottom-last-->
		
	</footer><!--/#footer-->

</div><!--/#wrapper-->

<?php wp_footer(); ?>

<?php global $is_iphone;
	if( !$is_iphone ) { ?>
	<script type="text/javascript">
	    jQuery(window).scroll(function(){
	  	if (jQuery(window).scrollTop()>jQuery("#header").height()){
	            jQuery("#nav-topbar").addClass("to_top");
	        }
	        else
	        {
	            jQuery("#nav-topbar").removeClass("to_top");
	        }
	    });
	</script>
<?php }; ?>

<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery('#fbgl').click(function(){
	        jQuery('.toggle-search, .toggle-subscribe, .toggle-account').removeClass('active');
	        jQuery('.search-expand, .subscribe-expand, .account-expand').hide();
	        jQuery('#fbgl').hide();
	    });
	});
</script>

</body>
</html>