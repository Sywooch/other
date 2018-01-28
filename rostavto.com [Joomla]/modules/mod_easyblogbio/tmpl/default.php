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

$itemId	= modEasyBlogBioHelper::_getMenuItemId($params);
?>
<div class="ezb-mod mod_easyblogbio">
	<div class="mod-author-brief">
		<?php if ($params->get('showavatar', true)) { ?>
		<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id='.$blogger->id . $itemId );?>" class="mod-avatar">
            <img src="<?php echo $blogger->getAvatar();?>" class="avatar" width="50" />
        </a>
		<?php } ?>
	    <div class="eztc">
	        <div class="mod-author-name">
	            <a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id='.$blogger->id . $itemId );?>">
	            	<b><?php echo $blogger->getName();?></b>
	            </a>
	        </div>
	        <div class="mod-author-post small">
	        	<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id='.$blogger->id . $itemId );?>"><?php echo JText::_( 'MOD_EASYBLOGBIO_VIEW_ALLPOSTS' ); ?></a>
	        </div>
		</div>
	</div>
	<?php if ($params->get('showbio', true)) { ?>
    <div><?php echo JString::substr( strip_tags( $blogger->getBiography() ) , 0 , $params->get( 'biolimit' ) );?>...</div>
	<?php } ?>
</div>