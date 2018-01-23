<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
include('../libraries/joomla/html/html/select.php');

?>

<form action="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails'); ?>" method="post" name="adminForm" id="adminForm" class="adminForm" >
    
   
    <table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminlist">
    <thead>
        <tr>
    		<th class="title"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_NAME');?></th>
			<th class="title"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_VALUE');?></th>
    		<th class="title"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_DESCRIPTION');?></th>
        </tr>
    </thead>
	<tbody>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_WIDTH');?></td>
            <td width="246"><input type="text" name="width" value="<?php echo $this->config->width;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_WIDTH_DESC');?> Image Width or Height (depends if the image is landscape or portrait) must be maximum this value</td>
        </tr>
        <!--
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SHOWTOOLTIP');?></td>
            <td width="246">
                <select name="show_tooltip">
                    <option value="1" <?php if($this->config->show_tooltip==1) echo 'selected="selected"'; ?>><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SHOWTOOLTIP_SHOW');?></option>
                    <option value="0" <?php if($this->config->show_tooltip==0) echo 'selected="selected"'; ?>><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SHOWTOOLTIP_NO');?></option>
                </select></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SHOWTOOLTIP_DESC');?></td>

        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_FOLOWMOUSE');?></td>
            <td width="246">
                <select name="follow_mouse">
                    <option value="1" <?php if($this->config->follow_mouse==1) echo 'selected="selected"'; ?>><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_FOLOWMOUSE_YES');?></option>
                    <option value="0" <?php if($this->config->follow_mouse==0) echo 'selected="selected"'; ?>><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_FOLOWMOUSE_NO');?></option>
                </select></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_FOLOWMOUSE_DESC');?></td>

        </tr>
        -->
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_TWEENDURATION');?></td>
            <td width="246"><input type="text" name="tween_duration" value="<?php echo $this->config->tween_duration;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_TWEENDURATION_DESC');?></td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_ROTATIONSPEEN');?></td>
            <td width="246"><input type="text" name="rotation_speed" value="<?php echo $this->config->rotation_speed;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_WIDTH_DESC');?></td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_RADIUSX');?></td>
            <td width="246"><input type="text" name="radius_x" value="<?php echo $this->config->radius_x;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_RADIUSX_DESC');?> Carousel radius on X axis</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_RADIUSY');?></td>
            <td width="246"><input type="text" name="radius_y" value="<?php echo $this->config->radius_y;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_RADIUSY_DESC');?> Carousel radius on Y axis</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BORDERSIZE');?></td>
            <td width="246"><input type="text" name="tn_border_size" value="<?php echo $this->config->tn_border_size;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BORDERSIZE_DESC');?> Thumbnail border size</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BORDERCOLOR');?></td>
            <td width="246"><input type="text" name="tn_border_color" value="<?php echo $this->config->tn_border_color;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BORDERCOLOR_DESC');?> Thumbnail border color</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_PHOTOBORDERSIZE');?></td>
            <td width="246"><input type="text" name="photo_border_size" value="<?php echo $this->config->photo_border_size;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_PHOTOBORDERSIZE_DESC');?> Photo (big image) border size</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_PHOTOBORDERCOLOR');?></td>
            <td width="246"><input type="text" name="photo_border_color" value="<?php echo $this->config->photo_border_color;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_PHOTOBORDERCOLOR_DESC');?> Photo (big image) border color</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BARSTATUS');?></td>
            <td width="246"><input type="text" name="bar_status" value="<?php echo $this->config->bar_status;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_BARSTATUS_DESC');?> 1 - Always show Close button Navigation Arros and Description; 0 - On Mouse Click show/hide Close button Navigation Arros and Description</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_DRAGGERX');?></td>
            <td width="246"><input type="text" name="dragger_x" value="<?php echo $this->config->dragger_x;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_DRAGGERX_DESC');?> Navigation arrows below the carousel thumbnails - position on X axis</td>
        </tr>
        <tr>
            <td width="109"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_DRAGGERY');?></td>
            <td width="246"><input type="text" name="dragger_y" value="<?php echo $this->config->dragger_y;?>" /></td>
            <td width="378" bgcolor="#CCCCCC"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_DRAGGERY_DESC');?> Navigation arrows below the carousel thumbnails - position on Y axis</td>
        </tr>
    </tbody>
    </table>

    <input type="hidden" name="option" value="com_wst_carousel_thumbnails" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="id" value="1" />
    
</form>