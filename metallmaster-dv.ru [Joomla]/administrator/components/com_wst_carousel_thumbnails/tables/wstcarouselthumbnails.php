<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined( '_JEXEC' ) or die( 'Restricted access' );  
 
 class TableWstCarouselThumbnails extends JTable{
    public $id=null;
 	public $image_name = null;
 	public $tooltip = null;
    public $description = null;
    public $ordering = null;
 	public $published = null;
 	
 	
 	function __construct(&$db){
		parent::__construct( '#__wst_carousel_thumbnails', 'id', $db );
	}
}
?>