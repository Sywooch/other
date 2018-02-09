<?php get_header(); ?>

<section class="content">
	
	<div class="pad group">
	  <div id="banner">
	  <object type="application/x-shockwave-flash" data="http://www.weltrade.com/upload/partner/swf/ru/728x90/wt_pamm_bank_728x90.swf" width="680" height="90"><param name="movie" value="http://www.weltrade.com/upload/partner/swf/ru/728x90/wt_pamm_bank_728x90.swf"><param name="wmode" value="transparent"><param name="allowScriptAccess" value="sameDomain" /><param name="FlashVars" value="domaine=http://www.weltrade.com.ua/lp/pamm3/?r1=ipartner&r2=6167"></object>
	  </div>
		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ): the_post(); ?>
				<?php get_template_part('content'); ?>		
			<?php endwhile; ?>
			
			<?php get_template_part('inc/pagination'); ?>
			
		<?php endif; ?>			
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>