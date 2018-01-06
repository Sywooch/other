<?php
/*------------------------------------------------------------------------
# mod_filterednews - Filtered News Module
# ------------------------------------------------------------------------
# author    Jesús Vargas Garita
# copyright Copyright (C) 2010 joomlahill.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomlahill.com
# Technical Support:  Forum - http://www.joomlahill.com/forum
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$doc = JFactory::getDocument();
$doc->addScript('modules/mod_filterednews/scripts/slider.js');
 
?>

<div id="fn_slider_<?php echo $filterednews_id; ?>" class="fn_slider_<?php echo $filterednews_id; ?>">
  <div class="opacitylayer">
    <?php foreach ($list as $item) : ?>
    <div class="fn_news" style="display:none;">
	    <?php echo $item->content; ?>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<div class="fn_pagination_<?php echo $filterednews_id; ?>" id="paginate-fn_slider_<?php echo $filterednews_id; ?>"></div>
<?php

$doc = JFactory::getDocument();

$doc->addScriptDeclaration("
window.addEventListener('load', function(){
    FN_ContentSlider('fn_slider_". $filterednews_id."', ".$params->get('delay', 3000).", '".$params->get('next ', '')."');
}, false);");