<?php
/*
 * @package		mod_easyblogmostcommentedpost
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
<div class="ezb-mod mod_easyblogmostcommentedpost<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<?php if(!empty($posts)){ ?>

	<?php foreach($posts as $post){

		$menuItemId = modEasyBlogMostCommentedPostHelper::_getMenuItemId($post, $params);

		$url 		= EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id=' . $post->id . $menuItemId );
		$postLink	= '<a href="'.$url.'"><b>'.$post->title.'</b></a>';
	?>
	<div class="mod-item">

		<?php if( !empty( $post->source ) ){ ?>
			<?php require( JModuleHelper::getLayoutPath('mod_easyblogmostcommentedpost', $post->source . '_item' ) ); ?>
		<?php } else { ?>

			<?php if(  $params->get( 'photo_show' , 1 ) ){ ?>
				<?php if( $post->getImage() ){ ?>
					<div class="mod-post-image align-<?php echo $params->get( 'alignment' , 'default' );?>">
						<a href="<?php echo $url; ?>"><img src="<?php echo $post->getImage()->getSource('module');?>" /></a>
					</div>
				<?php } else { ?>
					<!-- Legacy for older style -->
					<?php if( $post->media ){ ?>
					<div class="mod-post-image align-<?php echo $params->get( 'alignment' , 'default' );?>">
						<a href="<?php echo $url; ?>"><?php echo $post->media;?></a>
					</div>
					<?php }  ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>


		<div class="mod-post-title">
			<?php echo $postLink; ?>
		</div>

		<div class="mod-post-type">
			<a href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=categories&layout=listings&id=' . $post->category_id . $menuItemId );?>"><?php echo $post->getCategoryName();?></a>
		</div>

		<?php if( $params->get( 'showintro' ) ){ ?>
		<div class="mod-post-content">
		 	<?php
		 	if($post->protect)
			{
				echo $post->content;
			}
			else
			{
				$summary = ($params->get( 'showintro' ) == '1')? strip_tags( $post->intro ) : strip_tags( $post->content ) ;

				if( $textcount == 0 )
				{
					echo $summary;
				}
				else
				{
					if( !empty($summary) )
						echo JString::substr( $summary, 0 , $textcount ) . '...';
				}
			}
			?>
		</div>
		<?php } ?>

		<?php if( $params->get( 'showratings', true ) && $post->showRating ): ?>
		<div class="mod-post-rating blog-rating small"><?php echo EasyBlogHelper::getHelper( 'ratings' )->getHTML( $post->id , 'entry' , JText::_( 'MOD_EASYBLOGMOSTCOMMENTEDPOST_RATEBLOG' ) , 'mod-mostcommentedpost-' . $post->id , $disabled );?></div>
		<?php endif; ?>

		<!-- Author metadata -->
		<?php require( JModuleHelper::getLayoutPath('mod_easyblogmostcommentedpost', 'default_meta' ) ); ?>
	</div>
	<?php } ?>

	<?php }else{ ?>
		<?php echo JText::_('MOD_EASYBLOGMOSTCOMMENTEDPOST_NO_POST'); ?>
	<?php } ?>
</div>
