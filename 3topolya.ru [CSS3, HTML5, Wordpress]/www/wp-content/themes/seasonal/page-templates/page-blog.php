<?php 
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>



	<div id="primary" class="content-area">
		<main id="main" class="site-main tmp4" role="main" itemscope="" itemtype="http://schema.org/Blog">
       
       		<?php get_sidebar( 'banner' ); ?>
       
			<?php 
			/*
            $blogstyle = esc_attr(get_theme_mod( 'blog_style', 'blog-full' ) );
                    
                switch ($blogstyle) {
                    
                    // Default full featured image style
                    case "blog-full" :                         						
						if ( have_posts() ) :
							if ( is_home() && ! is_front_page() ) : 
								echo '<header><h1 class="page-title screen-reader-text">' . single_post_title() . '</h1></header>';	endif; 	
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', get_post_format() );
							endwhile;
								seasonal_blog_pagination();
							else :
								get_template_part( 'template-parts/content', 'none' ); 
						endif;						
                    break;		        
            
                    // Small featured image style
                    case "blog-small" : 
						echo '<div class="blog-small">';               
						if ( have_posts() ) :
							if ( is_home() && ! is_front_page() ) : 
								echo '<header><h1 class="page-title screen-reader-text">' . single_post_title() . '</h1></header>';	endif; 	
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'small' );
							endwhile;
								seasonal_blog_pagination();
							else :
								get_template_part( 'template-parts/content', 'none' ); 
						endif;
						echo '</div>'; 
                    break;			        
                
                }
				*/ 
            ?> 
            
            
            
            
            
 
        <?php // Display blog posts on any page @ http://m0n.co/l
        $temp = $wp_query; $wp_query= null;
        $wp_query = new WP_Query(); $wp_query->query('showposts=6' . '&paged='.$paged);
        while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
        
        <header class="entry-header">
			<?php seasonal_post_header(); ?>
        	<div class="category-list">      
            <?php if( esc_attr(get_theme_mod( 'show_categories', 1 ) ) ) {
                seasonal_categories_list();
            } ?>
        	</div>      
 
 			<?php seasonal_post_thumbnail(); ?>        
 
 			<div class="entry-meta">
            <?php seasonal_entry_meta(); ?>
        	</div>
    	</header><!-- .entry-header -->

 
        
  		<div class="entry-content">
    	<?php
			/* translators: %s: Name of current post */		
			the_content( sprintf(
				__( 'Continue reading %s', 'seasonal' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );		
			
    	// load our nav is our post is split into multiple pages
		seasonal_multipage_nav(); 
    	?>
  		</div><!-- .entry-content -->

        <footer class="entry-footer">
  		<?php
    		if( is_single() && esc_attr(get_theme_mod( 'show_tags_list', 1 ) ) ) {
      		seasonal_tags_list( '<div class="entry-tags">', '</div>' );
    		}
  		?>
  		</footer><!-- .entry-footer -->
        
        <!--<h2><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></h2>-->
        <?php // the_excerpt(); ?>
        
        
        
        </article><!-- #post-## -->
        
 
        <?php endwhile; ?>
 
        <?php if ($paged > 1) { ?>
 
        <nav id="nav-posts">
            <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
            <div class="next"><?php previous_posts_link('Newer Posts &raquo;'); ?></div>
        </nav>
 
        <?php } else { ?>
 
        <nav id="nav-posts">
            <div class="prev"><?php next_posts_link('&laquo; Previous Posts'); ?></div>
        </nav>
 
        <?php } ?>
 
        <?php wp_reset_postdata(); ?>
 
  
            
            
            
            
            
        
            <?php get_sidebar( 'bottom' ); ?>
            
        	<?php get_template_part( 'template-parts/site-footer' ); ?>                   

		</main><!-- .site-main -->
	</div><!-- .content-area -->
    
    
<?php get_footer(); ?>
