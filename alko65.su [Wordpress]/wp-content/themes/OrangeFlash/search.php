<?php

get_header(); ?>


<div id="nav">


			<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>


				<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'categories group', 'container' => '', 'fallback_cb' => '') ); ?>


			<?php } else { ?>


				<ul class="categories group">


					<?php wp_list_categories('title_li=&exclude=1'); ?>


				</ul>


			<?php } ?>


		</div><!-- /nav -->
<div id="content" class="group">



<div id="main">



	<div class="next group">
	
<h3>

			<?php printf( __( 'Результаты поиска по запросу: %s', 'twentyten' ), '' . get_search_query() . '' ); ?>

			</h3>
		<ol class="group">
           <?php if (have_posts()) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

			

			<li>

				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

				<a href="<?php the_permalink();?>"><img src="<?php echo get_post_meta($post->ID, 'thumbnail', true);?>" alt="Изображение" width="125" height="125" /></a>
 <div class="fdate"><?php the_time('M d, Y'); ?>  //  <?php the_category(', '); ?>  //  <?php the_author_posts_link(); ?> <?php if (current_user_can('edit_post', $post->ID)) { ?>  //  <?php edit_post_link('Редактировать', '', ''); } ?></div>
				<?php the_content_rss('', TRUE, '', 50); ?>

			</li>

			

			<?php endwhile; ?>

				

		</ol>

	<div class="wp-pagenavi" style="width:545px;color:#ed2b50; text-align:center;padding:10px 10px;"> <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
				<div class="alignright" style="float:right;font-weight: bold;"><?php next_posts_link('Предыдущие записи &raquo;') ?></div>
					<div class="alignleft"  style="float:left;font-weight: bold;" ><?php previous_posts_link('&laquo; Следующие записи') ?></div>
					<?php } ?>            <div class="clr"></div>
          </div>

	</div><!-- /next -->

	

	<?php endif; wp_reset_query(); /* end loop */ ?>



</div><!-- /main -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>