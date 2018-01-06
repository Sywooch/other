<?php

get_header(); ?>



<div id="content" class="group">
<div id="nav">


			<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>


				<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'categories group', 'container' => '', 'fallback_cb' => '') ); ?>


			<?php } else { ?>


				<ul class="categories group">


					<?php wp_list_categories('title_li=&exclude=1'); ?>
                    <?php wp_list_pages('title_li'); ?>


				</ul>


			<?php } ?>


		</div><!-- /nav -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/_assets/js/jquery-easing-1.3.pack.js"></script>
<div class="header_h2">
 <div class="accord_top">
    <div id="feature_wrap">
          <!-- ###################################################################### -->
      <div id="featured">
	<?php 



	$slider_cat = get_option('wordpressbling_feat'); $slider_cat_id = get_cat_id($slider_cat);

	$slidernum = get_option('wordpressbling_slidernum');

		



	$query = new WP_Query('showposts='.$slidernum.'&cat='.$slider_cat_id.'');

	if ($query->have_posts()) :

?>
<?php while ($query->have_posts()) : $query->the_post(); ?>
        <div class="featured">
         <a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail', true);?>" title="<?php the_title_attribute(); ?>" width="715" height="470" /></a> 
         <div class="slidertit">
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка на <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          </div>
        </div>
        
       <?php endwhile; ?>
	   <?php endif; ?>
        <!-- end .featured -->
      </div>
      <!-- end #featured -->
      <!-- ###################################################################### -->
    </div>
    <?php wp_reset_query() ?>
  </div>
    <div class="clr"></div>
             </div> 
<div id="main">



	

	

	<?php $latest = get_option('wordpressbling_latest'); ?>

	<?php $next = get_option('wordpressbling_next'); ?>	
	
	<?php $layout = get_option('wordpressbling_postLayout'); ?>

	<?php 
	
	query_posts('posts_per_page='.$latest.'');

	if ( have_posts() ) : ?>

	

	

	<?php endif; wp_reset_query(); /* end loop */ ?>

	

	<?php 

	query_posts('posts_per_page='.$next.'&offset='.$latest.'');

	if ( have_posts() ) : ?>

		
	<div class="next group">

	

		<ol class="group">

			<?php while ( have_posts() ) : the_post(); ?>

			

			<li>

				<h33><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h33>

				<a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail', true);?>" alt="Изображение" width="585" height="300" /></a>
				<p><?php the_content_rss('', TRUE, '', 95); ?></p>
                <div class="bottompost"> <div class="fdate"><?php the_time('M d, Y'); ?>  //  <?php the_category(', '); ?>  //  <?php the_author_posts_link(); ?> <?php if (current_user_can('edit_post', $post->ID)) { ?>  //  <?php edit_post_link('Редактировать', '', ''); } ?></div><div class="readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="Читать далее <?php the_title(); ?>" >Читать далее </a></div></div>
                 
			</li>

			

			<?php endwhile; ?>

				

		</ol>

	

	</div><!-- /next -->

	

	<?php endif; wp_reset_query(); /* end loop */ ?>

<div id="smoke1"></div><div id="smoke2"></div>

</div><!-- /main -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>