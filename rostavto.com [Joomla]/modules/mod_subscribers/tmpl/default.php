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

$itemId	= modEasyBlogSubscribers::_getMenuItemId($params);
?>
<div id="ezblog-subscribers" class="ezb-mod mod_subscribers<?php echo $params->get( 'moduleclass_sfx' ) ?>">

	<?php if( $subscribers ){ ?>
		<div class="mod-subscribers clearfix">
			<?php foreach( $subscribers as $subscriber ){ ?>
				<a href="<?php echo EasyBlogRouter::_( 'index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $subscriber->id . $itemId );?>" class="mod-avatar">
					<img src="<?php echo $subscriber->getAvatar();?>" class="avatar" width="30" title="<?php echo $subscriber->getName(); ?>" />
				</a>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if( $subscribers || $guests != 0 ){ ?>
	<div class="mod-subscribers-text">
	    <?php if( $guests != 0 ){ ?>
			<?php echo JText::sprintf( 'MOD_SUBSCRIBERS_AND_GUESTS' , $guests );?>
		<?php } ?>
		<?php echo JText::_( 'MOD_SUBSCRIBERS_ARE_FOLLOWING' ); ?>
	</div>
	<?php } ?>
	<div class="mod-subscribers-action">
		<a href="javascript:eblog.subscription.show('<?php echo $subscribeType; ?>' , '<?php echo $id; ?>');">
			<?php echo JText::_( 'MOD_SUBSCRIBERS_FOLLOW' );?>
		</a>
	</div>
</div>

