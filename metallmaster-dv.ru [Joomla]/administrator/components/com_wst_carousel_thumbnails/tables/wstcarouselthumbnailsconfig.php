<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined( '_JEXEC' ) or die( 'Restricted access' );  
 
 class TableWstCarouselThumbnailsConfig extends JTable{
    public $id = null;
 	public $width = null;
	public $show_tooltip = null;
	public $follow_mouse = null;
	public $tween_duration = null;
    public $rotation_speed = null;
	public $radius_x = null;
    public $radius_y = null;
    public $tn_border_size = null;
    public $tn_border_color = null;
    public $photo_border_size = null;
    public $photo_border_color = null;
    public $bar_status = null;
    public $dragger_x = null;
    public $dragger_y = null;
 	
 	
 	function __construct(&$db){
		parent::__construct( '#__wst_carousel_thumbnails_config', 'id', $db );
	}
}
?>