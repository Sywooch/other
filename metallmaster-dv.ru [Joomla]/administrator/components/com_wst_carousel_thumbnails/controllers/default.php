<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
 
class WstCarouselThumbnailsControllerDefault extends JController
{
    function __construct()
    {
  		parent::__construct();
  		$this->registerTask('unpublish','publish');
   	}
        
    function display($tpl = false) 
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'Default')); 
        parent::display($tpl);
    }
    
    function newImage()
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'Default')); 
        JRequest::setVar('layout', JRequest::getCmd('layout', 'new'));
        parent::display();
    }
    
    function save()
    {
        $model = JModel::getInstance('Default','WstCarouselThumbnailsModel');
        if($model->save($_POST))
        {
            $this->createXml();
            JFactory::getApplication()->enqueueMessage(JText::_('WST_CAROUSEL_THUMBNAILS_NEW_IMAGE_OK'));
        }
        else
            JError::raiseWarning( 500,JText::_('WST_CAROUSEL_THUMBNAILS_NEW_IMAGE_ERROR'));
        JRequest::setVar('view', JRequest::getCmd('view', 'Default'));
        parent::display();
    }
    
    function publish()
    {
  		$task = JRequest::getWord('task');
  		$db 	=& JFactory::getDBO();
  		$cids = JRequest::getVar( 'cid' , array() , '' , 'array' );
  		JArrayHelper::toInteger($cid);
  		if (count( $cids ) < 1) {
 			JError::raiseWarning(500, JText::_('WST_CAROUSEL_THUMBNAILS_NO_SELECTION', true ) );
  		}
  		else{
 			if ($task == 'publish') {
				$state = 1;
 			} else {
				$state = 0;
 			}
 			foreach( $cids as $cid ){
				$db->setQuery("UPDATE #__wst_carousel_thumbnails set published=".$state." WHERE id=".$cid);
                $db->query();
 			}
 			if($task== 'publish')
				$msg=JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_PUBLISHED', true );
 			else
				$msg=JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_UNPUBLISHED', true );
            JFactory::getApplication()->enqueueMessage($msg);
            $this->createXml();
        }
        JRequest::setVar('view', JRequest::getCmd('view', 'default')); 
        parent::display();
	   }
       
       function orderup(){
            $db	=& JFactory::getDBO();
            $cid = JRequest::getVar('cid', array(), 'request', 'array');
            $db->setQuery("SELECT * FROM #__wst_carousel_thumbnails WHERE id='".$cid[0]."'");
            $rows = $db->loadObjectList();
            $row=$rows[0];
            $current=$row->ordering;
            $newValue=$current-1;
            $db->setQuery("UPDATE #__wst_carousel_thumbnails SET ordering='".$current."' WHERE ordering='".$newValue."'");
            if (!$db->query()) {
                JError::raiseWarning( 500, JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
            }
            $db->setQuery("UPDATE #__wst_carousel_thumbnails SET ordering='".$newValue."' WHERE id='".$cid[0]."'");
            if (!$db->query()) {
                JError::raiseWarning( 500, JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
            }
            $this->createXml();
            JRequest::setVar('view', JRequest::getCmd('view', 'default')); 
            parent::display();
         }
       
        function orderdown(){
            $db	=& JFactory::getDBO();
            $cid = JRequest::getVar('cid', array(), 'request', 'array');
            $db->setQuery("SELECT * FROM #__wst_carousel_thumbnails WHERE id='".$cid[0]."'");
            $rows = $db->loadObjectList();
            $row=$rows[0];
            $current=$row->ordering;
            $newValue=$current+1;
            $db->setQuery("UPDATE #__wst_carousel_thumbnails SET ordering='".$current."' WHERE ordering='".$newValue."'");
            if (!$db->query()) {
                JError::raiseWarning( 500, JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
            }
            $db->setQuery("UPDATE #__wst_carousel_thumbnails SET ordering='".$newValue."' WHERE id='".$cid[0]."'");
            if (!$db->query()) {
                JError::raiseWarning( 500,JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
            }
            $this->createXml();
            JRequest::setVar('view', JRequest::getCmd('view', 'default')); 
            parent::display();
       }
       
       function saveOrder(){
            $db	=& JFactory::getDBO();
            $cid = JRequest::getVar('cid', array(), 'request', 'array');
            $order=$_REQUEST['order'];
            for($i=0;$i<count($cid);$i++){
                $db->setQuery("UPDATE #__wst_carousel_thumbnails SET ordering='".$order[$i]."' WHERE id='".$cid[$i]."'");
                if (!$db->query()) {
                    JError::raiseWarning( 500, JText::_("WST_CAROUSEL_THUMBNAILS_ERROR_SAVIG_DATA") );
                }
            }
            $this->createXml();
            JRequest::setVar('view', JRequest::getCmd('view', 'default')); 
            parent::display();
        }
    
    function config()
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'Default')); 
        JRequest::setVar('layout', JRequest::getCmd('layout', 'config'));
        parent::display();
    }
    
    function saveConfig()
    {
        $model = JModel::getInstance('Default','WstCarouselThumbnailsModel');
        if($model->saveConfig($_POST))
        {
            $this->createXml();
            JFactory::getApplication()->enqueueMessage(JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SAVE_OK'));
        }
        else
            JError::raiseWarning( 500,JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG SAVE_ERROR'));
        
        JRequest::setVar('view', JRequest::getCmd('view', 'Default'));
        JRequest::setVar('layout', JRequest::getCmd('layout', 'config'));
        parent::display();
    }
    
    function deleteImage()
    {
        $cids = JRequest::getVar( 'cid' , array() , '' , 'array' );
        if(count($cids)>0)
        {
            $model = JModel::getInstance('Default','WstCarouselThumbnailsModel');
            if($model->delete($cids))
            {
                JFactory::getApplication()->enqueueMessage(JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_DELETE_OK'));    
            }
            else
            {
                JError::raiseWarning( 500,JText::_('WST_CAROUSEL_THUMBNAILS_IMAGES_DELETE_ERROR') );
            }
        }
        else
        {
            JError::raiseWarning( 500,JText::_('WST_CAROUSEL_THUMBNAILS_NO_SELECTION') );
        }
        JRequest::setVar('view', JRequest::getCmd('view', 'default'));
        parent::display();
    }
    
    function upload()
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'images')); 
        JRequest::setVar('layout', JRequest::getCmd('layout', 'default'));
        parent::display();
    }
    
    function createXml()
    {
        $model = JModel::getInstance('Default','WstCarouselThumbnailsModel');
        $config=$model->getConfig();
        $images=$model->getAllImages();
        
        $write_string='<?xml version="1.0" encoding="utf-8"?>
                        <photos>
                        	<config 
                        		show_tooltip="'.$config->show_tooltip.'"
                        		follow_mouse="'.$config->follow_mouse.'"
                        		folder="components/com_wst_carousel_thumbnails/photos/"
                        		css_file="administrator/components/com_wst_carousel_thumbnails/css/wst_carousel_thumbnails.css"
                        		tween_duration="'.$config->tween_duration.'"
                        		rotation_speed="'.$config->rotation_speed.'"
                        		radius_x="'.$config->radius_x.'"
                        		radius_y="'.$config->radius_y.'"
                        		tn_border_size="'.$config->tn_border_size.'"
                        		tn_border_color="'.$config->tn_border_color.'"
                        		photo_border_size="'.$config->photo_border_size.'"
                        		photo_border_color="'.$config->photo_border_color.'"
                        		bar_status="'.$config->bar_status.'"
                        		dragger_x="'.$config->dragger_x.'"
                        		dragger_y="'.$config->dragger_y.'">
                        	</config>';
            
            
                       
            foreach($images as $img){
                $write_string.="<photo>
                        		<thumbnail>s_".$img->image_name."</thumbnail>
                        		<filename>".$img->image_name."</filename>
                        		<tooltip>".$img->tooltip."</tooltip>
                        		<description>".$img->description."</description>
                        	</photo>";
            }
            $write_string.="</photos>";
            if(file_exists(JPATH_SITE.'/components/com_wst_carousel_thumbnails/flashmo_230_photo_list.xml'))
    			unlink(JPATH_SITE.'/components/com_wst_carousel_thumbnails/flashmo_230_photo_list.xml');
    		$fp=fopen(JPATH_SITE.'/components/com_wst_carousel_thumbnails/flashmo_230_photo_list.xml','w');
    		fwrite($fp, $write_string) or die("Error writing to file");
    		fclose($fp);
    }
}

?>