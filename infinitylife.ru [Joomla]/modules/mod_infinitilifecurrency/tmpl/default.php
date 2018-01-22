<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeСurrency
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author Vladislav Fursov
 */

defined('_JEXEC') or die;
?>

<div class="currency <?php echo $moduleclass_sfx ?>">
    <span>
        <?php foreach($curr as $key=>$val){
            $val = str_replace(",", ".", $val);
                echo '<div class="'.$key.'">'.round($val, 2).' руб.</div>' ;
            }?>
    </span>
</div>
