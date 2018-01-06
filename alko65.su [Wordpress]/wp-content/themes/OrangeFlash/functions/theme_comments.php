<?php 

function websource_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li id="comment-<?php comment_ID() ?>">
   	<div class="meta">
   		<?php echo get_avatar($comment,$size='80'); ?>
   		<?php printf(__('<cite>%s</cite>'), get_comment_author_link()) ?>
   		<span class="time"><?php comment_time('h:i A'); ?></span>
   		<span class="date"><?php comment_date('d/n/Y'); ?></span>
   	</div>
   	<div class="comment">
   		<?php comment_text(); ?>
   		<div class="reply">
   		   <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
   		</div>
   	</div>
<?php }  