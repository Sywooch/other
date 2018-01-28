<?php
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);
JHtml::_('behavior.caption');
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));

?><?php if(($_GET["id"] == 2) || ($_SERVER['REQUEST_URI'] == "/")) {?><?php } else { ?>



				   
				   
		<h1 ><?php echo $this->escape($this->item->title); ?> </h1>
 <div class="content-box" >		   
				   <?php }  ?>
	<?php echo $this->item->text; ?>
