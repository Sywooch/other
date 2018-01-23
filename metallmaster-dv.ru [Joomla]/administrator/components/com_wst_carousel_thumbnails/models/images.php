<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
 
jimport('joomla.application.component.modellist');
 
class WstCarouselThumbnailsModelImages extends JModelList
{
    function getImages()
    {
        $db	=& JFactory::getDBO();
 		$db->setQuery("SELECT * FROM #__wst_carousel_thumbnails_images");
    	$rows = $db->loadObjectList();
        return $rows;    
    }
    
    function deleteImages($cids)
    {
        $db = JFactory::getDBO();
        jimport('joomla.filesystem.file');
        require_once(JPATH_SITE.'/administrator/components/com_wst_carousel_thumbnails/tables/wstcarouselthumbnailsimages.php');
        $img= new TableWstCarouselThumbnailsImages($db);
        $obrisano=true;
        foreach($cids as $cid)
        {
            $img->load($cid);

            if ( JFile::exists(JPATH_SITE.'/components/com_wst_carousel_thumbnails/photos/'.strtolower($img->image_name)))
                JFile::delete(JPATH_SITE.'/components/com_wst_carousel_thumbnails/photos/'.strtolower($img->image_name));
            if ( JFile::exists(JPATH_SITE.'/components/com_wst_carousel_thumbnails/photos/s_'.strtolower($img->image_name)))
                JFile::delete(JPATH_SITE.'/components/com_wst_carousel_thumbnails/photos/s_'.strtolower($img->image_name));
            if(!$img->delete($cid))
                $obrisano=false;
        }
            
        if($obrisano)
            return true;
        else
            return false;
    }
}

?>