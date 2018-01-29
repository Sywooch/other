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
<?php if( $posts ){ ?>
<div class="mod_imagewall ezb-mod <?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<?php
		$i	= 1;
	?>
	<?php foreach( $posts as $post ){
		$menuItemId = modImageWallHelper::_getMenuItemId($post, $params);
	?>
	<span class="item-wrapper">
		<a href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=entry&id=' . $post->id . $menuItemId ); ?>" title="<?php echo $post->title; ?>">
			<?php echo $post->media; ?>

			<span class="item-title"><?php echo $post->title; ?></span>
		</a>
		<?php if( $i % $params->get( 'columns' , 4 ) == 0 ){ ?>
		<div class="clear"></div>
		<?php } ?>
		
		<?php $i++; ?>
	</span>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php } ?>

