<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *  
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
 
defined('_JEXEC') or die('Restricted access');
?>
<!-- Blog post actions -->

<?php if( $params->get( 'showcommentcount' , 0 ) || $params->get( 'showhits' , 0 ) || $params->get( 'showreadmore' , true ) ){ ?>
<div class="mod-post-meta small">
	<?php $url = EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id=' . $post->id . $menuItemId ); ?>

	<?php if($params->get('showcount', true)) : ?>
	<span>
		<a href="<?php echo $url; ?>" class="post-comments"><?php echo JText::sprintf( 'MOD_EASYBLOGMOSTCOMMENTEDPOST_COUNT', $post->comment_count );?></a>
	</span>
	<?php endif; ?>

    <?php if( $params->get( 'showhits' , true ) ): ?>
	<span>
		<a href="<?php echo $url;?>"><?php echo JText::sprintf( 'MOD_EASYBLOGMOSTCOMMENTEDPOST_HITS' , $post->hits );?></a>
	</span>
	<?php endif; ?>

	<?php if( $params->get( 'showreadmore' , true ) ): ?>
	<span>
		<a href="<?php echo $url; ?>" class="post-more"><?php echo JText::_('MOD_EASYBLOGMOSTCOMMENTEDPOST_READMORE'); ?></a>
	</span>
	<?php endif; ?>
</div>
<?php } ?>


<?php if($params->get('showlatestcomment', true)) { ?>
	<?php
		$commentorLink  = '';
		$commentorURL   = '';
		if( !empty($post->commentor->id) )
		{
			$commentorURL 	= EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $post->commentor->id . $menuItemId );
			$commentorLink	= '<a href="'.$commentorURL.'">'. $post->commentor->nickname .'</a>';
		}
		else
		{
			$commentorLink	= $post->commentor->nickname;
		}
	?>

	<div class="post-comment">
	<?php
		// process comment. strip html tags, bbcode tags and then add emoticons
		$comment		= strip_tags($post->comment);
		$commentLength	= JString::strlen($comment);
		$desiredLength	= 150;
		$trimmedComment	= JString::substr($comment, 0, $desiredLength);

		$comment        = '"' . $comment . '"';
		$comment		= EasyBlogCommentHelper::parseBBCode( $comment );

		echo ($commentLength > $desiredLength) ? $trimmedComment . '...' : $comment ;
	?>
	</div>

	<div class="mod-post-author at-bottom small clearfix">

		<?php if( $params->get( 'showavatar', true ) ){ ?>
		<?php	if( empty( $post->commentor->id) ) { ?>
	                <img src="<?php echo $post->commentor->getAvatar();?>" width="30" title="<?php echo $post->commentor->nickname; ?>" class="avatar" />
		<?php    } else { ?>
					<a href="<?php echo $commentorURL; ?>" class="mod-avatar" alt="<?php echo $post->commentor->nickname; ?>">
			              <img src="<?php echo $post->commentor->getAvatar();?>" width="30" title="<?php echo $post->commentor->nickname; ?>" class="avatar" />
			        </a>
		<?php 	 } ?>
		<?php } ?>

		<?php echo JText::sprintf('MOD_EASYBLOGMOSTCOMMENTEDPOST_COMMENTED_BY', $commentorLink); ?>
	</div>

<?php } else { ?>
	<?php if( $params->get( 'showavatar', true ) || $params->get( 'showauthor' ) || $params->get( 'showdate' , true ) ) { ?>

	<div class="mod-post-author at-bottom small clearfix">
		<?php if( $params->get( 'showavatar', true ) ){ ?>
			<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $post->author->id . $menuItemId ); ?>" class="mod-avatar" alt="<?php echo $post->author->getName(); ?>">
	            <img src="<?php echo $post->author->getAvatar();?>" width="30" title="<?php echo $post->author->getName(); ?>" class="avatar" />
	        </a>
		<?php } ?>

		<?php $source = $post->source == '' ? '' : '_' . $post->source; ?>
		<?php require( JModuleHelper::getLayoutPath('mod_easyblogmostcommentedpost', 'source' . $source  ) ); ?>

	</div>

	<?php } ?>
<?php } ?>