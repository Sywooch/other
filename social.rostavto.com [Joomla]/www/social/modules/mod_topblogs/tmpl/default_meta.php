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
	<?php if( $params->get( 'showcommentcount', true ) ): ?>
	<span class="rated-item-comments"><a href="<?php echo $url;?>#comments"><?php echo JText::sprintf( 'MOD_TOPBLOGS_COMMENTS' , EasyBlogHelper::getHelper( 'Comment' )->getCommentCount( $blog ) );?></a></span>
	<b>&middot;</b>
	<?php endif; ?>
	<?php if( $params->get( 'showhits' , true ) ): ?>
	<span class="rated-item-hits"><a href="<?php echo $url;?>"><?php echo JText::sprintf( 'MOD_TOPBLOGS_HITS' , $blog->hits );?></a></span>
	<b>&middot;</b>
	<?php endif; ?>
	<?php if( $params->get( 'showreadmore' , true ) ): ?>
	<a href="<?php echo $url; ?>" class="post-more"><?php echo JText::_('MOD_TOPBLOGS_READMORE'); ?></a>
	<?php endif; ?>
</div>
<?php } ?>

<?php if( $params->get( 'showavatar', true ) || $params->get( 'showauthor' ) || $params->get( 'showdate' , true ) ) { ?>

<div class="mod-post-author at-bottom">
	<?php if( $params->get( 'showavatar', true ) ){ ?>
		<a class="mod-avatar" href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $blog->author->id . $menuItemId ); ?>" alt="<?php echo $blog->author->getName(); ?>">
                  <img src="<?php echo $blog->author->getAvatar();?>" width="30" title="<?php echo $blog->author->getName(); ?>" class="ezavatar" />
              </a>
	<?php } ?>

	<?php $source = $blog->source == '' ? '' : '_' . $blog->source; ?>
	<?php $post = $blog;?>
	<?php require( JModuleHelper::getLayoutPath('mod_topblogs', 'source' . $source  ) ); ?>
</div>
<?php } ?>