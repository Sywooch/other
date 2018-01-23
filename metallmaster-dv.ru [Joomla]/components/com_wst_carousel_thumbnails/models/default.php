<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.modellist');
class WstCarouselThumbnailsModelDefault extends JModelList
{    
    function getConfig()
    {
        $id=1;
        $table = $this->getTable('WstCarouselThumbnailsConfig', 'Table');
        if(!$table->load($id))
            return false;
        return $table;
    }
    
}

?>