<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.html.pane');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$listOrder	= $this->escape($this->state->get('list.orderingImg'));
$listDirn	= $this->escape($this->state->get('list.directionImg'));

?>
<form action="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails');?>" method="post" id="adminForm" class="adminForm" name="adminForm">
    <br /><br />
    <table cellpadding="4" cellspacing="1" border="0"  class="adminlist">
        <thead>
            <th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
            <th width="150"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_PREVIEW'); ?></th>
            <th class="title" ><div align="left"><?php echo JHtml::_('grid.sort', 'WST_CAROUSEL_THUMBNAILS_IMAGES_TOOLTIP', 'tooltip', $listDirn, $listOrder); ?></div></th>
            <th class="title" ><div align="left"><?php echo JHtml::_('grid.sort', 'WST_CAROUSEL_THUMBNAILS_IMAGES_DESCRIPTION', 'description', $listDirn, $listOrder); ?></div></th>
            <th colspan="2" width="5%"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_REORDER'); ?></th>
            <th width="2%"><?php echo JHtml::_('grid.sort', 'WST_CAROUSEL_THUMBNAILS_IMAGES_ORDERING', 'ordering', $listDirn, $listOrder); ?></th>
            <th width="1%"><a href="javascript: saveorder( <?php echo count( $this->items )-1; ?> )"><img src="components/com_wst_carousel_thumbnails/images/filesave.png" border="0" width="16" height="16" alt="<?php echo JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_IMAGES_SAVE_ORDER'); ?>" /></a></th>
            <th width="70"><?php echo JHtml::_('grid.sort', 'WST_CAROUSEL_THUMBNAILS_IMAGES_PUBLISHED', 'published', $listDirn, $listOrder); ?></th>
        </thead>
    	<tbody>
         <?php
    	$k = 0;
       	for($i=0; $i < count( $this->items ); $i++) {
           	$item = $this->items[$i];
        	$published = JHTML::_('grid.published', $item, $i );
            
         	$checked = JHTML::_('grid.id', $i, $item->id );
                $img='../components/com_wst_carousel_thumbnails/photos/s_'.strtolower($item->image_name);
            
?>
        	<tr class="<?php echo "row$k"; ?>">
            	<td><?php echo $checked; ?></td>
            	<td><div align="center"><img src="<?php echo $img;?>" width="100" height="100" /></div></td>
            	<td><a href="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails&task=newImage&id='.$item->id);?>" alt="<?php JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_EDIT_IMAGE');?>"><?php echo $item->tooltip ; ?></a></td>
				<td><?php echo $item->description; ?></td>
                <td><?php if($i!=0){?><a href="#reorder" onclick="return listItemTask('cb<?php echo $i;?>','orderup')" title="Move Up"><img src="components/com_wst_carousel_thumbnails/images/uparrow.png" width="12" height="12" border="0" alt="<?php JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_MOVE_UP');?>" /></a><?php }?></td>
                <td><?php if($i!=(count($this->items)-1)){?><a href="#reorder" onclick="return listItemTask('cb<?php echo $i;?>','orderdown')" title="Move Down"><img src="components/com_wst_carousel_thumbnails/images/downarrow.png" width="12" height="12" border="0" alt="<?php echo JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_MOVE_DOWN');?>" /></a><?php }?></td>
                <td colspan="2" align="center"><input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" class="text_area" style="text-align: center" /></td>
                <td align="center"><?php echo $published; ?></td>
<?php           $k = 1 - $k; ?>
        	</tr>
<?php } ?>   
            
        </tbody>
    </table>

    <input type="hidden" name="option" value="com_wst_carousel_thumbnails" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="" />
    <input type="hidden" name="filter_order" value="<?php  echo $listOrder; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php  echo $listDirn; ?>" />
	<?php echo JHtml::_('form.token'); ?>
</form>