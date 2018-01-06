<?php

get_header(); ?>


<div id="nav" style="margin-bottom:40px;">


			<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>


				<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'categories group', 'container' => '', 'fallback_cb' => '') ); ?>


			<?php } else { ?>


				<ul class="categories group">


					<?php wp_list_categories('title_li=&exclude=1'); ?>
                    <?php wp_list_pages('title_li'); ?>

				</ul>


			<?php } ?>


		</div><!-- /nav -->

<div id="content" class="group">

<div id="main">



	
	<?php if (have_posts()) : ?>

    <div class="latests">
	<div class="next group">
	

		<ol class="group">

			<?php while ( have_posts() ) : the_post(); ?>

			

			<li style="width:555px;">

				<h22><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h22>

				<p><?php the_content(''); ?></p>

			</li>

			

			<?php endwhile; ?>

				


	</div><!-- /next -->
    </div><!-- /latests -->
	
    <?php comments_template(); ?>


	<?php endif; wp_reset_query(); /* end loop */ ?>



</div><!-- /main -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>