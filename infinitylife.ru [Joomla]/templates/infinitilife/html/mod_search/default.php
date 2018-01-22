<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div class="social">
    <a href="" class="ok"></a>
    <a href="http://instagram.com/infinitilife.ru" class="instagram"></a>
    <a href="http://vk.com/infinitiliferu" class="vk"></a>
    <a href="https://www.facebook.com/groups/inflife/" class="fb"></a>
    <a href="http://twitter.com/InfinitilifeBlg" class="twitter"></a>
    <a href="http://www.youtube.com/channel/UCfKCdjvxUmMrVzNlOmZnzig" class="youtube"></a>
    <a href="" class="google"></a>
</div>
<div class="search <?php echo $moduleclass_sfx ?>">
    <form  method="post"><!-- action="<?php echo JRoute::_('index.php');?>" --> 
        <input type="text" placeholder="Поиск" name="searchword" maxlength="<?php echo $maxlength?>">
        <input type="submit" onclick="return false;" />
        
        <input type="hidden" name="task" value="search" /> 
        <input type="hidden" name="option" value="com_search" />
        <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
    </form>
</div>