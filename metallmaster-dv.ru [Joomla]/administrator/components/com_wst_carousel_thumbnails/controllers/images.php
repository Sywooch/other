<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
 
class WstCarouselThumbnailsControllerImages extends JController
{
    function display($tpl = false) 
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'images')); 
        parent::display($tpl);
    }
    
    function img()
    {
        JRequest::setVar('controller','default');
        JRequest::setVar('view','default');
        JRequest::setVar('layout','default'); 
        parent::display();
    }
    
    function upload()
    {
        include(JPATH_SITE.'/administrator/components/com_wst_carousel_thumbnails/inc/SimpleImage.php');
        require_once(JPATH_SITE.'/administrator/components/com_wst_carousel_thumbnails/tables/wstcarouselthumbnailsimages.php');
		$base_Dir=JPATH_SITE.'/components/com_wst_carousel_thumbnails/photos/';
        $db	=& JFactory::getDBO();
        $db->setQuery("SELECT image_name FROM #__wst_carousel_thumbnails order by image_name desc limit 1");
	    $rows = $db->loadObjectList();
		if(count($rows)>0)
        {
            $temp=$rows[0]->image_name;
            $t=(int)substr($temp,6,3)+1;
            switch(strlen($t))
            {
                case 1:
                   $userfile= (isset($_FILES['file']['name']) ? "photo_00".$t.substr($_FILES['file']['name'],-4) : "");
                   break;
                case 2:
                   $userfile= (isset($_FILES['file']['name']) ? "photo_0".$t.substr($_FILES['file']['name'],-4) : "");
                   break;
                case 3:
                    $userfile= (isset($_FILES['file']['name']) ? "photo_".$t.substr($_FILES['file']['name'],-4) : "");
                   break; 
            }
        }
        else
        {
            $userfile= (isset($_FILES['file']['name']) ? "photo_001.".substr($_FILES['file']['name'],-4) : ""); 
        }
        
        $type=strtoupper(substr($userfile,-4));
		$up=false;
		if($type=='.PNG' || $type=='.JPG' || $type=='.GIF'){
		  $up=true;
		}
		if (empty($userfile)) {
		  JError::raiseWarning( 500, JText::_('WST_CAROUSEL_THUMBNAILS_SELECT_IMAGE_TO_UPLOAD'));
		}
		else if (file_exists($base_Dir.$userfile)) {
		  JError::raiseWarning( 500, JText::_('WST_CAROUSEL_THUMBNAILS_IMAGE_ALREADY_EXISTS'));
		}
		else if (!$up){
		  JError::raiseWarning( 500, JText::_('WST_CAROUSEL_THUMBNAILS_IMAGE_TYPE'));				
		}
        else if (move_uploaded_file($_FILES['file']['tmp_name'], $base_Dir.strtolower($userfile))) {
            $image = new SimpleImage();
      		$image->load( $base_Dir.$userfile);
			$image->resize(100,100);
            $image->save($base_Dir."s_".$userfile);
            $img= new TableWstCarouselThumbnailsImages($db);
            $img->id=null;
            $img->image_name=$userfile;
            $img->store();
			JFactory::getApplication()->enqueueMessage(JText::_('WST_CAROUSEL_THUMBNAILS_IMAGE_UPLOAD_OK'));
  	     } else {
 		     JError::raiseWarning( 500, JText::_('WST_CAROUSEL_THUMBNAILS_IMAGE_UPLOAD_ERROR'));  
         }
         JRequest::setVar('view', JRequest::getCmd('view', 'images'));
         parent::display();  
    }
    
    function delete()
    {
        $model = JModel::getInstance('Images','WstCarouselThumbnailsModel');
        $cids = JRequest::getVar( 'cid' , array() , '' , 'array' );
        if($model->deleteImages($cids))
        {
            JFactory::getApplication()->enqueueMessage(JText::_('WSR_CAROUSEL_THUMBNAILS_DELETE_IMAGES'));
        }
        else
            JError::raiseWarning( 500,JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
        JRequest::setVar('view', JRequest::getCmd('view', 'images'));
        parent::display();
    }
}

?>