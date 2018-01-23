<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined( '_JEXEC' ) or die( 'Restricted access' );  
 
 class TableWstCarouselThumbnailsImages extends JTable{
    public $id=null;
 	public $image_name = null;
 	
 	
 	function __construct(&$db){
		parent::__construct( '#__wst_carousel_thumbnails_images', 'id', $db );
	}
}
?>