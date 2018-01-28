<?php // no direct access
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

$itemId	= modEasyBlogMostActiveBloggerHelper::_getMenuItemId($params);

?>

<div id="ezblog-latestblogger" class="ezb-mod eblog-module-latestblogger<?php echo $params->get( 'moduleclass_sfx' ) ?>">
	<?php if($easyblogInstalled): ?>
		<?php if(!empty($bloggers)):
            foreach($bloggers as $blogger) :

            $posterURL      = EasyBlogRouter::_('index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $blogger->id . $itemId );
            $posterLink     = '<a href="'.$posterURL.'">'.$blogger->profile->getName().'</a>';
            $posterWebsite  = '<a href="'.$blogger->profile->getWebsite().'" target="_blank">'.$blogger->profile->getWebsite().'</a>';
        ?>
		<div class="mod-item">
            <div class="mod-author-brief">
                <?php if ($params->get('showavatar', true)) : ?>
                <?php //author's avatar
					$width  = $params->get('avatarwidth', '50');
					$height = $params->get('avatarheight', '50');

					$width  = empty( $width ) ? '50' : $width;
					$height  = empty( $height ) ? '50' : $height;

				?>
                <a href="<?php $posterURL; ?>" class="mod-avatar">
                    <img class="avatar" src="<?php echo $blogger->profile->getAvatar();?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" alt="<?php echo $blogger->profile->getName(); ?>" />
                </a>
                <?php endif;?>
            
                <?php //author's name & link ?>
                <div class="mod-author-name"><?php echo $posterLink; ?></div>

                <?php //author's total post ?>
                <?php if($params->get('showcount', true)) : ?>
                <div class="mod-author-post small"><?php echo JText::sprintf('MOD_EASYBLOGMOSTACTIVEBLOGGER_COUNT', $blogger->post_count);?></div>
                <?php endif; ?>
            </div>

			<?php if($params->get('showwbiotext', true)) { ?>
            <div class="mod-author-bio">
                <?php if( $blogger->profile->getBiography() != '' ) : ?>
			        <?php echo (JString::strlen( strip_tags( $blogger->profile->getBiography() ) ) > 50) ? JString::substr( strip_tags( $blogger->profile->getBiography() ), 0, 50) . '...' : $blogger->profile->getBiography() ; ?>
			    <?php else: ?>
			        ...
			    <?php endif; ?>
            </div>
			<?php } ?>

            <?php //author's link ?>
            <?php if($params->get('showwebsite', true) && $blogger->profile->getWebsite() != '' && !($blogger->profile->getWebsite() == 'http://')) : ?>
            <div class="mod-author-link small"><?php echo $posterWebsite;?></div>
            <?php endif; ?>
        </div>
    	<?php endforeach; ?>


	<?php else: ?>
    <div class="mod-item-nothing">
		<?php echo JText::_('MOD_EASYBLOGMOSTACTIVEBLOGGER_NO_BLOGGER'); ?>
    </div>
	<?php endif; ?>
		

	<?php else: ?>
    <div class="mod-item-notinstalled">
		<?php echo JText::_('MOD_EASYBLOGMOSTACTIVEBLOGGER_EASYBLOG_NOT_INSTALLED'); ?>
    </div>
	<?php endif; ?>
</div>
