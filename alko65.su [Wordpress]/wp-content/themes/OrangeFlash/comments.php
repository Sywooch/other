
<?php if ( post_password_required() ) : ?>

				<p>Эта запись защищена паролем. Введите пароль, чтобы просмотреть комментарии.</p>

<?php

		/* Stop the rest of comments.php from being processed,

		 * but don't kill the script entirely -- we still have

		 * to fully load the template.

		 */

		return;

	endif;

?>



<?php

	// You can start editing here -- including this comment!

?>



<div class="commentarea">



<?php if ( have_comments() ) : ?>



			<!-- STARKERS NOTE: The following h3 id is left intact so that comments can be referenced on the page -->

			<h4 id="comments-title"><?php

			printf( _n( '1 комментарий к записи "%2$s"', '%1$s комментариев к записи "%2$s"', get_comments_number(), 'twentyten' ),

			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );

			?></h4>



<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

				<?php previous_comments_link( __( '&larr; Предыдущие записи', 'twentyten' ) ); ?>

				<?php next_comments_link( __( 'Следующие записи &rarr;', 'twentyten' ) ); ?>

<?php endif; /* check for comment navigation */ ?>



			<ul>

				<?php

					wp_list_comments( array( 'callback' => 'websource_comment' ) );

				?>

			</ul>



<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

				<?php previous_comments_link( __( '&larr; Предыдущие записи', 'twentyten' ) ); ?>

				<?php next_comments_link( __( 'Следующие записи &rarr;', 'twentyten' ) ); ?>

<?php endif; // check for comment navigation ?>



<?php else : // or, if we don't have comments:



	/* If there are no comments and comments are closed,

	 * let's leave a little note, shall we?

	 */

	if ( ! comments_open() ) :

?>

	<p><?php _e( 'Комментарии закрыты.', 'twentyten' ); ?></p>

<?php endif; /* end ! comments_open() */ ?>







<?php endif; /* end have_comments() */ ?>



<?php comment_form(); ?>



</div><!-- /commentarea -->



