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
<?php if( $params->get( 'enableratings' ) )
{
	$disabled = false;
}
else
{
	$disabled = true;
}?>
<div id="ezblog-topblog" class="ezb-mod ezblog-topblog<?php echo $params->get( 'moduleclass_sfx' ) ?>">
<?php
if( $result )
{
	foreach( $result as $blog )
	{

		$menuItemId = modTopBlogsHelper::_getMenuItemId($blog, $params);
		$url		= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $blog->id . $menuItemId );
?>
	<div class="mod-item">






		<?php if( $params->get( 'photo_show') ){ ?>
			<?php if( !empty( $blog->source ) ){ ?>
				<?php require( JModuleHelper::getLayoutPath('mod_topblogs', $blog->source . '_item' ) ); ?>
			<?php } else { ?>

				<?php if( $blog->getImage() ){ ?>
					<div class="mod-post-image align-<?php echo $params->get( 'alignment' , 'default' );?>">
						<a href="<?php echo $url; ?>"><img src="<?php echo $blog->getImage()->getSource('module');?>" /></a>
					</div>
				<?php } else { ?>
					<!-- Legacy for older style -->
					<?php if( $blog->media ){ ?>
					<div class="mod-post-image align-<?php echo $params->get( 'alignment' , 'default' );?>">
						<a href="<?php echo $url; ?>"><?php echo $blog->media;?></a>
					</div>
					<?php }  ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>

		<div class="mod-post-title">
			<a href="<?php echo $url;?>"><?php echo $blog->title; ?></a>
		</div>
 <?php if( $params->get( 'category_title') ){?>
		<div class="mod-post-type">
			<a href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=categories&layout=listings&id=' . $blog->category_id . $menuItemId );?>"><?php echo $blog->getCategoryName();?></a>
		</div>
<?php }?>
		<?php if( $params->get( 'showintro' , 1 ) ){ ?>
		<div class="mod-post-content clearfix">

			<?php if( $blog->protect ){ ?>
				<?php echo  $blog->content; ?>
			<?php } else { ?>
				<?php echo $blog->summary;?>
			<?php } ?>

			<?php if( $params->get( 'showreadmore' , true ) && ( !empty( $blog->intro) && !empty($blog->content) ) ){ ?>
			<div class="mod-post-more">
				<a href="<?php echo $url; ?>"><?php echo JText::_('MOD_TOPBLOGS_READMORE'); ?></a>
			</div>
			<?php } ?>

		</div>
		<?php } ?>


		<?php if( $params->get( 'showratings', true ) && $blog->showRating ): ?>
		<div class="mod-post-rating blog-rating">
			<?php echo EasyBlogHelper::getHelper( 'ratings' )->getHTML( $blog->id , 'entry' , JText::_( 'MOD_TOPBLOGS_RATEBLOG' ) , 'mod-toprated-' . $blog->id , $disabled);?>
		</div>
		<?php endif; ?>

		<?php require( JModuleHelper::getLayoutPath('mod_topblogs', 'default_meta' ) ); ?>
	</div>
<?php
	}
}
else
{
?>
	<div><?php echo JText::_('MOD_TOPBLOGS_NO_BLOGS_YET'); ?></div>
<?php
}
?>
</div>
