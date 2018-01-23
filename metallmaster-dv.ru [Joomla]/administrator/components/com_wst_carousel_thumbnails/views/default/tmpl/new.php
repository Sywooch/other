<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
include(JPATH_ROOT.'/libraries/joomla/html/html/select.php');
?>

<style type="text/css">
<!--
.style2 {font-size: 12px;}
-->
</style>

<form action="<?php echo JRoute::_('index.php?option=com_wst_carousel_thumbnails');?>" method="post" name="adminForm" id="adminForm" class="adminForm">
 <table cellpadding="0" cellspacing="0" width="100%" class="adminlist">
    <tr valign="top">
        <td width="50%" valign="top">
			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
			<tr>
			  <td height="40" colspan="2"><h2>New image settings</h2></td>
			  </tr>
			<tr>
				<td width="100" height="40"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_IMAGE');?></td>
                <td valign="top"><div style="padding:3px; text-align:left;">
                                <img src="<?php if(strlen($this->item->image_name)>0) echo '../components/com_wst_carousel_thumbnails/photos/s_'.$this->item->image_name; ?>" name="preiwslike" width="100" height="100" id="preiwslike" />
                                </div>
                                <input type="text" name="image_name"  id="image" value="<?php echo($this->item->image_name);?>" readonly="readonly" />
                                * <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_IMAGE_DESCRIPTION');?>
                </td>
			</tr>
			<tr>
				<td width="100"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_TOOLTIP');?></td>
		    <td>
		          <input type="text" name="tooltip"  id="action" value="<?php echo($this->item->tooltip);?>"/>
			    
			    * <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_TOOLTIP_DESCRIPTION');?>
            </td>
			</tr>
            <tr>
				<td width="100"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_DESCRIPTION');?></td>
                <td>
				  <input type="text" name="description" size="50" value="<?php echo($this->item->description);?>" />
				  
				  * <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_DESCRIPTION_DESCRIPTION');?>
                </td>
			</tr>
            <tr>
				<td width="100"><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_ORDERING');?></td>
				<td>
				  <input type="text" name="ordering"  value="<?php echo($this->item->ordering);?>" />
				  
				  * <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_ORDERING_DESCRIPTION');?>
                </td>
			</tr>
            
			<tr>
				<td><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_PUBLISHED');?></td>
                <td><?php echo JHTMLSelect::booleanlist('published',null,$this->item->published,'Yes','No',false);?></td>
			</tr>
			</table>
			</td>
            
            <td width="50%" valign="top">
                <table border="0" width="100%" cellpadding="0" cellspacing="0" class="nekaTabe">
                    <tr>
                        <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><h2><?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_UPLOADED_IMAGES');?></h2>
                            <hr style="border:1px dotted #CCCCCC;"  />
                        </td>
                    </tr>
                    <tr>
                        <td width="62%" valign="middle">
                        <?php 
                        
            			$handle=opendir('../components/com_wst_carousel_thumbnails/photos/');
            			$index=0;
            			$div='';
            			while(!false==($file=readdir($handle))){
            				if ($file != "." && $file != ".." && (strtoupper(substr($file,-4))==".PNG" || strtoupper(substr($file,-4))==".JPG" || strtoupper(substr($file,-4))==".GIF") && strpos($file,"s_",0)===0) {
                        		?><a onclick='document.getElementById("image").value="<?php echo substr($file,2);?>";document.getElementById("preiwslike").src="<?php echo '../components/com_wst_carousel_thumbnails/photos/'.$file;?>";' onmouseover="document.getElementById('slika<?php echo $index;?>').style.visibility='visible';" onmouseout="document.getElementById('slika<?php echo $index;?>').style.visibility='hidden';" ><?php echo substr($file,2);?></a><br />
                        <?php
                    			$div.='<div style="visibility:hidden;position:absolute;margin-top:-40px;margin-left:20px;padding:5px;" id="slika'.$index.'"><img src="../components/com_wst_carousel_thumbnails/photos/'.$file.'" width="100" height="100"></div>';
            					$index++;
            				}
            			}
            			echo '</td><td>'.$div.'</td></tr>';	
            			?>
                    <tr>
                        <td valign="top"><hr style="border:1px dotted #CCCCCC;"  />
                            * <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_UPLOADED_IMAGES_DESCRIPTION1');?>
                        <br />
                        ** <?php echo JText::_('WST_CAROUSEL_THUMBNAILS_NEW_UPLOADED_IMAGES_DESCRIPTION2');?>
                        </td>
                    </tr>
               </table>
			</td>
            
            
		  </tr>
		</table>
<input type="hidden" name="option" value="com_wst_carousel_thumbnails" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="id" value="<?php echo $this->item->id;?>" />
 </form>
