<div class="tabs widget">
<?php 

	$wpop = get_option('wordpressbling_wpop');

	$wlate = get_option('wordpressbling_wlate');

	$wcom = get_option('wordpressbling_wcom');

	?>
	

	
  <div class="popular widget">
		<h4>Popular posts</h4>
	   <div class="wrap">


			<ol> 
			<?php $popular = new WP_Query('orderby=comment_count&posts_per_page='.$wpop.''); while ($popular->have_posts()) : $popular->the_post();?>
            <li>

					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail', true);?>" alt="Post Pic" width="50" height="50" /></a>

					<?php the_content_rss('', TRUE, '', 12); ?>

				</li>

			<?php endwhile; ?>	
            
            
            
            
            </ol>

       </div><!-- /wrap -->
 </div><!-- /popular -->
				




  <div class="Recent widget">
		<h4>Latest posts</h4>
	   <div class="wrap">

			<ol>

			<?php query_posts('posts_per_page='.$wlate.'');

			if ( have_posts() ) : while ( have_posts() ) : the_post();?>

				<li>

					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail', true);?>" alt="Post Pic" width="50" height="50" /></a>

					<?php the_content_rss('', TRUE, '', 12); ?>

				</li>

			<?php endwhile; endif; ?>	

			</ol>

       </div><!-- /wrap -->
 </div><!-- /popular -->







</div><!-- /tabs -->