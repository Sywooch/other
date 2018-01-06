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
$doc->addScript('modules/mod_filterednews/scripts/scroller.js'); 
?>
<script type="text/javascript" language="javascript">
<!--
var FN_Pausecontent_<?php echo $filterednews_id; ?>=new Array();
<?php
$rowItems = (int)$params->get('scroll_items', 1) ? (int)$params->get('scroll_items', 1) : 1;
$contents = array();
for($i=0;$i<count($list);$i++) :
	$list[$i]->content = preg_replace( "/[\n\t\r]+/",' ',$list[$i]->content);
	$list[$i]->content = str_replace( "'", "\\'",$list[$i]->content ); 
	$contents[floor($i/$rowItems)][] = '<div>'.$list[$i]->content.'</div>';
endfor;
for($i=0;$i<count($contents);$i++) : ?>
	FN_Pausecontent_<?php echo $filterednews_id; ?>[<?php echo $i; ?>]='<?php echo implode('', $contents[$i])  ?>';
<?php endfor; ?>
new FN_Pausescroller(FN_Pausecontent_<?php echo $filterednews_id; ?>, "fn_scroller_<?php echo $filterednews_id; ?>", "", <?php echo $params->get('delay', 3000) ?>);
-->
</script>
