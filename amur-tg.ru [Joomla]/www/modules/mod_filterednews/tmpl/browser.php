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
$doc->addScript('modules/mod_filterednews/scripts/browser.js'); 
?>

<div id="fn_container_<?php echo $filterednews_id; ?>">
  <div id="fn_marquee_<?php echo $filterednews_id; ?>" style="position: absolute;">
   <?php foreach ($list as $item) : ?>
    <div class="fn_news">
      <?php echo $item->content; ?>
	  <div style="clear:both"></div>
    </div>
   <?php endforeach; ?>
  </div>
</div>
<script type="text/javascript" language="javascript">
<!--
var FN_Browser_<?php echo $filterednews_id; ?> = new FN_Browser("fn_marquee_<?php echo $filterednews_id; ?>","fn_container_<?php echo $filterednews_id; ?>","FN_Browser_<?php echo $filterednews_id; ?>",<?php echo $params->get('delay', 3000) ?>);
-->
</script>
