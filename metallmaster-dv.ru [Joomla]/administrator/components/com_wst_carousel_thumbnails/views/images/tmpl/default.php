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

$tabs	=& JPane::getInstance('sliders',array('startOffset'=>1, 'startTransition'=>1));
echo $tabs->startPane('configuration');
	
    echo $tabs->startPanel(JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_PANE_UPLOAD'), 'configuration-globalpage');
    ?>
    
    <script>
    
    Joomla.submitbutton = function(task)
    {
    	if(task=="upload")
            document.getElementById("adminFormUp").submit();
        else if (task=="delete" && $('adminForm').boxchecked.value == 0 )
        {
    	   alert('<?php  echo JText::_('WST_CAROUSEL_THUMBNAILS_NO_SELECTION');?>');
           return false;
        }    
        else
            Joomla.submitform(task);
        return true;
    }
    
</script>

    <form action="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails&controller=images');?>" method="post" id="adminFormUp" class="adminForm" enctype="multipart/form-data">
    <br /><br />
      
    
    <table  cellpadding="4" cellspacing="0" width="100%" class="adminlist">
   	<thead>
        
    </thead>
    <tbody>
        <tr>
            <td>
            <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_UPLOAD_IMAGE_DESC');?> <br />
            <br />
            <input type="file" name="file" />
            <br /><br />
            
            </td>
            
       </tr> 
   </tbody>
   </table>
   <input type="hidden" name="option" value="com_wst_carousel_thumbnails" />
	<input type="hidden" name="task" value="upload" />
</form>
    <?php    
    echo $tabs->endPanel();
	
    echo $tabs->startPanel(JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_PANE_IMAGES'), 'configuration-frontpage');
    ?>
    <form action="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails&controller=images'); ?>" method="post" name="adminForm" id="adminForm" class="adminForm">

    
    
	<div class="clr"> </div>
    <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
            <thead>
                <tr>
                    <th width="20"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->images); ?>);" /></th>
                    <th width="70"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_IMAGES'); ?></th>
                    <th class="title" ><div align="left"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_IMAGE_NAME');?></div></th>
					
                </tr>
            </thead>
            <tbody>
<?php
    	$k = 0;
       	for($i=0; $i < count( $this->images ); $i++) {
           	$item = $this->images[$i];
            $checked = JHTML::_('grid.id', $i, $item->id );
        	$img='../components/com_wst_carousel_thumbnails/photos/s_'.strtolower($item->image_name);
            
?>
        	<tr class="<?php echo "row$k"; ?>">
            	<td><?php echo $checked; ?></td>
            	<td><div align="center"><img src="<?php echo $img;?>" width="100" height="100" /></div></td>
            	<td><?php echo $item->image_name ; ?></td>
				
<?php $k = 1 - $k; ?>
        	</tr>
<?php } ?>
        </tbody>
        
        </table>
    
	<input type="hidden" name="option" value="com_wst_carousel_thumbnails" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
</form>
    <?php
    echo $tabs->endPanel();
    
    echo $tabs->endPane(); 
?>