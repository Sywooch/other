<?php
/**
 * @version		3.0.x
 * @package		Simple Image Gallery Pro
 * @author		JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		http://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<ul class="container">
    <?php
    $i = 0;
    foreach ($gallery as $count => $photo): ?>
        <li class="thumb">
        <span>
            <a href="<?php echo $photo->sourceImageFilePath; ?>" class="sigProLink<?php echo $extraClass; ?>"
               rel="<?php echo $relName; ?>[gallery<?php echo $gal_id; ?>]"
               title="<?php //echo $photo->downloadLink; ?>"
               target="_blank"<?php echo $customLinkAttributes; ?>>
                <img class="sigProImg" src="<?php echo $transparent; ?>"
                     style="background-image:url('<?php echo $photo->thumbImageFilePath; ?>');">
            </a>
        </span>
        </li>
    <?php endforeach; ?>
    <div class="clr"></div>
</ul>