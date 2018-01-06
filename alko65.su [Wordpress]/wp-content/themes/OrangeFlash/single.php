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
				
 <div class="fdate" style="width:555px;"><?php the_time('M d, Y'); ?>  //  <?php the_category(', '); ?>  //  <?php the_author_posts_link(); ?> <?php if (current_user_can('edit_post', $post->ID)) { ?>  //  <?php edit_post_link('Редактировать', '', ''); } ?></div>
				<p><?php the_content(''); ?></p>

			</li>

			

			<?php endwhile; ?>

				


	</div><!-- /next -->
    </div><!-- /latests -->
    		</ol>

	<h22>Схожие записи</h22>  
	<ol class="related-posts-thumbs">

    <?php
    //for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
    echo '';
    $first_tag = $tags[0]->term_id;
    $args=array(
    'tag__in' => array($first_tag),
    'post__not_in' => array($post->ID),
    'showposts'=>5,
    'caller_get_posts'=>1
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
		
    
		    <div class="relatedpost">
   <a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка на <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</div>


    <?php
    endwhile;
    }
    wp_reset_query();
    }
    ?>

</ol>    
<h22>Об авторе</h22>

	<div class="author">
        
		<?php echo get_avatar( get_the_author_email(), '80' ); ?>

		<p><?php the_author_link(); ?> опубликовал <?php the_author_posts(); ?> на сайте <?php bloginfo('name'); ?></p>

		<p><?php the_author_meta('user_description'); ?></p>

	</div>
    <?php comments_template(); ?>


	<?php endif; wp_reset_query(); /* end loop */ ?>



</div><!-- /main -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>