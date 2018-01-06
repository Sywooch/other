<?php

get_header(); ?>


<div id="nav" style="margin-bottom:40px;">


			<?php if ( has_nav_menu( 'secondary-menu' ) ) { ?>


				<?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'categories group', 'container' => '', 'fallback_cb' => '') ); ?>


			<?php } else { ?>


				<ul class="categories group" style="border-bottom:1px solid #d6d6d6;">


					<?php wp_list_categories('title_li=&exclude=1'); ?>


				</ul>


			<?php } ?>


		</div><!-- /nav -->
<div id="content" class="group">

<div id="main">






	<div class="next group">
	

		<ol class="group">


			<li>

				<p><?php _e("Извините, но по Вашему запросу ничего не было найдено!", "framework") ?></p>

			</li>

			


				

		</ol>

	<div class="wp-pagenavi" style="width:545px;color:#ed2b50; text-align:center;padding:10px 10px;"> <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
					<div class="alignright" style="float:right;font-weight: bold;"><?php next_posts_link('Предыдущие записи &raquo;') ?></div>
					<div class="alignleft"  style="float:left;font-weight: bold;" ><?php previous_posts_link('&laquo; Следующие записи') ?></div>
					<?php } ?>            <div class="clr"></div>
          </div>

	</div><!-- /next -->

	




</div><!-- /main -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>