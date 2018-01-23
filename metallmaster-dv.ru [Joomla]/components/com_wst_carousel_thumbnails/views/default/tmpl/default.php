<?php

/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC');
?>

<script type="text/javascript" src="<?php echo 'administrator/components/com_wst_carousel_thumbnails/js/swfobject.js';?>"></script>
		<script type="text/javascript">
		var flashvars = {};
		flashvars.xml_file = "<?php echo 'components/com_wst_carousel_thumbnails/flashmo_230_photo_list.xml';?>";
		var params = {};
		params.allowfullscreen = true;
		var attributes = {};
		swfobject.embedSWF("<?php echo 'components/com_wst_carousel_thumbnails/flashmo_230_carousel.swf?xml_file=components/com_wst_carousel_thumbnails/flashmo_230_photo_list.xml';?>", "flashmo_carousel", "<?php echo $this->config->width;?>", "<?php echo $this->config->width;?>", "9.0.0", false, flashvars, params, attributes);
		</script>

	
		<div id="flashmo_carousel">
			<div id="alternative_content">
				
			</div>
            
		</div>
        <div style=" color:#CCC; text-align:center; padding:5px; border-top:1px dotted #CCCCCC;"> Joomla Component WST Carousel Thumbnails by <a href="http://www.webmasterstand.com/" target="_blank" style="color:#ccc; text-decoration:none;">webmasterstand.com</a></div>